<?php
// Local integration only: all writes are isolated to random fixture tables.
require __DIR__ . '/../upload/config.php';
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$db = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE, (int)DB_PORT);
$db->set_charset('utf8mb4');
$prefix = 'r32d_' . bin2hex(random_bytes(4)) . '_';
$directory = sys_get_temp_dir() . '/' . $prefix;
mkdir($directory, 0700);
mkdir($directory . '/scripts', 0700);
mkdir($directory . '/upload', 0700);
$files = [];
$tables = ['setting', 'qiqo_sync_state', 'qiqo_partner_article_discount'];
function importIntegrationAssert($condition, $message) {
    if (!$condition) { throw new RuntimeException($message); }
}
try {
    $config = "<?php\n";
    foreach (['DB_HOSTNAME' => DB_HOSTNAME, 'DB_USERNAME' => DB_USERNAME, 'DB_PASSWORD' => DB_PASSWORD,
        'DB_DATABASE' => DB_DATABASE, 'DB_PORT' => DB_PORT, 'DB_PREFIX' => $prefix, 'DIR_SYSTEM' => DIR_SYSTEM] as $name => $value) {
        $config .= 'define(' . var_export($name, true) . ',' . var_export($value, true) . ");\n";
    }
    $configFile = $directory . '/upload/config.php';
    $files[] = $configFile;
    file_put_contents($configFile, $config);
    chmod($configFile, 0600);
    $scriptFile = $directory . '/scripts/import_qiqo_partner_discounts.php';
    $files[] = $scriptFile;
    copy(__DIR__ . '/../scripts/import_qiqo_partner_discounts.php', $scriptFile);
    $db->query("CREATE TABLE `" . $prefix . "setting` (setting_id INT AUTO_INCREMENT PRIMARY KEY,store_id INT NOT NULL,`key` VARCHAR(100) NOT NULL,value TEXT NOT NULL,serialized TINYINT NOT NULL DEFAULT 0) ENGINE=MyISAM");
    $db->query("CREATE TABLE `" . $prefix . "qiqo_sync_state` (feed_key VARCHAR(64) PRIMARY KEY,last_sync_at DATETIME NOT NULL,date_modified DATETIME NOT NULL) ENGINE=InnoDB");
    $db->query("CREATE TABLE `" . $prefix . "qiqo_partner_article_discount` (partner_id INT NOT NULL,article_code VARCHAR(64) NOT NULL,discount DECIMAL(10,4) NOT NULL,date_added DATETIME NOT NULL,date_modified DATETIME NOT NULL,PRIMARY KEY(partner_id,article_code)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
    $db->query("INSERT INTO `" . $prefix . "setting` (store_id,`key`,value) VALUES (0,'config_timezone','Europe/Zagreb'),(0,'qiqo_partner_article_initial_since','2026-08-01 00:00:00'),(0,'qiqo_partner_article_initial_complete','0')");
    $db->query("INSERT INTO `" . $prefix . "qiqo_partner_article_discount` VALUES (17,'PRESERVE',7,NOW(),NOW())");
    date_default_timezone_set('Europe/Zagreb');
    $watermark = date('Y-m-d H:i:s', time() - 60);
    $run = static function ($content, $expected, $apply, $badHash = false) use ($directory, $scriptFile, $watermark, &$files) {
        $source = $directory . '/export-' . count($files) . '.csv';
        $files[] = $source;
        file_put_contents($source, $content);
        $command = [PHP_BINARY, $scriptFile, '--source=' . $source, '--expected-count=' . $expected,
            '--sha256=' . ($badHash ? str_repeat('0', 64) : hash_file('sha256', $source)),
            '--since=2026-08-01 00:00:00', '--watermark=' . $watermark];
        if ($apply) { $command[] = '--apply'; }
        $process = proc_open($command, [0 => ['pipe', 'r'], 1 => ['pipe', 'w'], 2 => ['pipe', 'w']], $pipes);
        if (!is_resource($process)) { throw new RuntimeException('Cannot launch import integration fixture.'); }
        fclose($pipes[0]);
        $output = stream_get_contents($pipes[1]) . stream_get_contents($pipes[2]);
        fclose($pipes[1]); fclose($pipes[2]);
        return [proc_close($process), $output];
    };
    $count = static function () use ($db, $prefix) { return (int)$db->query('SELECT COUNT(*) n FROM `' . $prefix . 'qiqo_partner_article_discount`')->fetch_assoc()['n']; };
    $ready = static function () use ($db, $prefix) { return $db->query("SELECT value FROM `" . $prefix . "setting` WHERE `key`='qiqo_partner_article_initial_complete'")->fetch_assoc()['value']; };
    $csv = "partner,artikal,rabat\n17,0405054,0\n18,405054,25\n";
    [$status, $output] = $run($csv, 2, false);
    importIntegrationAssert($status === 0 && $count() === 1 && $ready() === '0', 'Dry run must preserve cache and completion flag. ' . $output);
    [$status, $output] = $run($csv, 3, true);
    importIntegrationAssert($status !== 0 && $count() === 1 && $ready() === '0', 'Count mismatch must never publish discounts.');
    [$status, $output] = $run($csv, 2, true, true);
    importIntegrationAssert($status !== 0 && $count() === 1 && $ready() === '0', 'Wrong manifest checksum must fail before live writes.');
    [$status, $output] = $run("partner,artikal,rabat\n17,A,\"10", 1, true);
    importIntegrationAssert($status !== 0 && $count() === 1 && $ready() === '0', 'Truncated quoted CSV must preserve cache and watermark.');
    $conflicts = "partner,artikal,rabat\n";
    for ($i = 0; $i < 1001; ++$i) { $conflicts .= '17,A' . $i . ",10\n"; }
    $conflicts .= "17,A0,20\n";
    [$status, $output] = $run($conflicts, 1002, true);
    importIntegrationAssert($status !== 0 && $count() === 1 && $ready() === '0', 'Conflicting duplicate across staging batches must not affect live data.');
    [$status, $output] = $run($csv, 2, true);
    importIntegrationAssert($status === 0 && $count() === 3 && $ready() === '1', 'Verified export must commit before enabling incremental sync. ' . $output);
    $zero = $db->query("SELECT discount FROM `" . $prefix . "qiqo_partner_article_discount` WHERE partner_id=17 AND article_code='0405054'")->fetch_assoc();
    importIntegrationAssert($zero && (float)$zero['discount'] === 0.0, 'Explicit article rebate of zero must be retained.');
    $state = $db->query("SELECT last_sync_at FROM `" . $prefix . "qiqo_sync_state` WHERE feed_key='partner_article_discounts'")->fetch_assoc();
    importIntegrationAssert($state && $state['last_sync_at'] === $watermark, 'Watermark must match the store-local verified export time.');
    [$status, $output] = $run($csv, 2, true);
    importIntegrationAssert($status === 0 && $count() === 3, 'Reimport must be idempotent and preserve absent discounts. ' . $output);
    echo "Local discount import integration passed (staging, MyISAM settings, checksum/count, malformed tail, duplicate conflict, zero rebate, idempotence and watermark).\n";
} finally {
    foreach (array_reverse($tables) as $table) { $db->query('DROP TABLE IF EXISTS `' . $prefix . $table . '`'); }
    foreach ($files as $file) { if (is_file($file)) { unlink($file); } }
    rmdir($directory . '/scripts'); rmdir($directory . '/upload'); rmdir($directory);
    $db->close();
}
