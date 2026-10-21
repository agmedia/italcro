<?php
// Integration uses only random fixture tables and a loopback SOAP server.
require __DIR__ . '/../upload/config.php';
require_once DIR_SYSTEM . 'library/qiqo/discount_job.php';
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$db = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE, (int)DB_PORT);
$db->set_charset('utf8mb4');
$prefix = 'qjob_' . bin2hex(random_bytes(4)) . '_';
$directory = sys_get_temp_dir() . '/' . $prefix;
mkdir($directory, 0700); mkdir($directory . '/upload', 0700); mkdir($directory . '/scripts', 0700);
symlink(DIR_SYSTEM, $directory . '/upload/system');
$tables = ['setting', 'qiqo_sync_state', 'qiqo_partner_article_discount'];
$server = null;
function jobIntegrationAssert($condition, string $message): void { if (!$condition) { throw new RuntimeException($message); } }
function jobIntegrationSoap(string $content): string {
    return '<?xml version="1.0"?><s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/"><s:Body><qPartnerArtikalRabatWebResponse xmlns="http://www.qiqo.hr/"><qPartnerArtikalRabatWebResult><d:diffgram xmlns:d="urn:schemas-microsoft-com:xml-diffgram-v1">' . ($content === '' ? '' : '<NewDataSet xmlns="">' . $content . '</NewDataSet>') . '</d:diffgram></qPartnerArtikalRabatWebResult></qPartnerArtikalRabatWebResponse></s:Body></s:Envelope>';
}
function jobIntegrationRow($partner, $article, $discount): string { return '<Table><partner>' . $partner . '</partner><artikal>' . $article . '</artikal><rabat>' . $discount . '</rabat></Table>'; }
try {
    $socket = stream_socket_server('tcp://127.0.0.1:0', $errno, $error);
    if (!$socket) { throw new RuntimeException('Cannot reserve fixture port.'); }
    $address = stream_socket_get_name($socket, false); fclose($socket);
    $router = $directory . '/router.php';
    file_put_contents($router, '<?php file_put_contents(__DIR__."/request.xml",file_get_contents("php://input")); http_response_code((int)file_get_contents(__DIR__."/http-status")); header("Content-Type: text/xml"); readfile(__DIR__."/response.xml");');
    file_put_contents($directory . '/http-status', '200');
    $server = proc_open([PHP_BINARY, '-S', $address, $router], [0 => ['file', '/dev/null', 'r'], 1 => ['file', $directory . '/server.log', 'a'], 2 => ['file', $directory . '/server.log', 'a']], $pipes);
    if (!is_resource($server)) { throw new RuntimeException('Cannot launch fixture HTTP server.'); }
    $online = false;
    for ($i = 0; $i < 50; ++$i) {
        $connection = @stream_socket_client('tcp://' . $address, $errno, $error, 0.1);
        if ($connection) { fclose($connection); $online = true; break; }
        usleep(20000);
    }
    jobIntegrationAssert($online, 'Fixture HTTP server did not start.');
    $config = "<?php\n";
    foreach (['DB_HOSTNAME' => DB_HOSTNAME, 'DB_USERNAME' => DB_USERNAME, 'DB_PASSWORD' => DB_PASSWORD,
        'DB_DATABASE' => DB_DATABASE, 'DB_PORT' => DB_PORT, 'DB_PREFIX' => $prefix, 'DIR_SYSTEM' => DIR_SYSTEM,
        'QIQO_SOAP_URL' => 'http://' . $address . '/soap', 'QIQO_USERNAME' => 'fixture<&', 'QIQO_PASSWORD' => 'PRIVATE<&', 'QIQO_ALLOW_INSECURE_HTTP' => 1] as $name => $value) {
        $config .= 'define(' . var_export($name, true) . ',' . var_export($value, true) . ");\n";
    }
    file_put_contents($directory . '/upload/config.php', $config); chmod($directory . '/upload/config.php', 0600);
    copy(__DIR__ . '/../scripts/run_qiqo_discount_job.php', $directory . '/scripts/run_qiqo_discount_job.php');
    $db->query('CREATE TABLE `' . $prefix . 'setting` (setting_id INT AUTO_INCREMENT PRIMARY KEY,store_id INT NOT NULL,`key` VARCHAR(100) NOT NULL,value TEXT NOT NULL,serialized TINYINT NOT NULL DEFAULT 0) ENGINE=MyISAM');
    $db->query('CREATE TABLE `' . $prefix . 'qiqo_sync_state` (feed_key VARCHAR(64) PRIMARY KEY,last_sync_at DATETIME NOT NULL,date_modified DATETIME NOT NULL) ENGINE=InnoDB');
    $db->query('CREATE TABLE `' . $prefix . 'qiqo_partner_article_discount` (partner_id INT NOT NULL,article_code VARCHAR(64) NOT NULL,discount DECIMAL(10,4) NOT NULL,date_added DATETIME NOT NULL,date_modified DATETIME NOT NULL,PRIMARY KEY(partner_id,article_code)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4');
    $db->query("INSERT INTO `" . $prefix . "setting` (store_id,`key`,value) VALUES (0,'config_timezone','Europe/Zagreb'),(0,'qiqo_partner_article_initial_since','2026-08-01 00:00:00'),(0,'qiqo_partner_article_initial_complete','0')");
    $db->query("INSERT INTO `" . $prefix . "qiqo_partner_article_discount` VALUES (103,'405054',18,NOW(),NOW())");
    $run = static function (string $response, int $http = 200) use ($directory): array {
        file_put_contents($directory . '/response.xml', $response);
        file_put_contents($directory . '/http-status', (string)$http);
        $job = QiqoDiscountJob::create($directory, 17);
        $process = proc_open([PHP_BINARY, $directory . '/scripts/run_qiqo_discount_job.php', '--job=' . $job['id']], [0 => ['pipe', 'r'], 1 => ['pipe', 'w'], 2 => ['pipe', 'w']], $pipes);
        if (!is_resource($process)) { throw new RuntimeException('Cannot start fixture worker.'); }
        fclose($pipes[0]); $output = stream_get_contents($pipes[1]) . stream_get_contents($pipes[2]); fclose($pipes[1]); fclose($pipes[2]);
        $exit = proc_close($process);
        jobIntegrationAssert(strpos($output, 'PRIVATE') === false, 'Worker output leaked private details.');
        return [$exit, QiqoDiscountJob::status($directory, $job['id']), $output];
    };
    $count = static function () use ($db, $prefix): int { return (int)$db->query('SELECT COUNT(*) n FROM `' . $prefix . 'qiqo_partner_article_discount`')->fetch_assoc()['n']; };
    $ready = static function () use ($db, $prefix): string { return $db->query("SELECT value FROM `" . $prefix . "setting` WHERE `key`='qiqo_partner_article_initial_complete'")->fetch_assoc()['value']; };
    $watermark = static function () use ($db, $prefix) { return $db->query("SELECT last_sync_at FROM `" . $prefix . "qiqo_sync_state` WHERE feed_key='partner_article_discounts'")->fetch_assoc(); };
    [$exit, $job] = $run(jobIntegrationSoap(''));
    jobIntegrationAssert($exit !== 0 && $job['error'] === 'initial_empty' && $count() === 1 && $ready() === '0' && !$watermark(), 'Empty initial response must preserve cache, state and readiness.');
    [$exit, $job] = $run(jobIntegrationSoap(jobIntegrationRow(104, 'A', 25)), 500);
    jobIntegrationAssert($exit !== 0 && $job['error'] === 'transport_error' && $count() === 1 && !$watermark(), 'HTTP failures must preserve live data and watermark.');
    $valid = jobIntegrationSoap(jobIntegrationRow(104, 'A', 25));
    [$exit, $job] = $run(substr($valid, 0, -20));
    jobIntegrationAssert($exit !== 0 && $job['error'] === 'invalid_response' && $count() === 1 && !$watermark(), 'Truncated responses must never apply a partial stage.');
    $conflicts = '';
    for ($i = 0; $i < 1001; ++$i) { $conflicts .= jobIntegrationRow(104, 'A' . $i, 25); }
    $conflicts .= jobIntegrationRow(104, 'A0', 30);
    [$exit, $job] = $run(jobIntegrationSoap($conflicts));
    jobIntegrationAssert($exit !== 0 && $job['error'] === 'duplicate_conflict' && $count() === 1 && $ready() === '0' && !$watermark(), 'Conflicting duplicates across staging batches must preserve live cache and flags.');
    [$exit, $job] = $run(jobIntegrationSoap(jobIntegrationRow(104, 'A', 25) . jobIntegrationRow(105, 'ZERO', 0)));
    jobIntegrationAssert($exit === 0 && $job['state'] === 'complete' && $job['rows'] === 2 && $count() === 3 && $ready() === '1' && $watermark(), 'Successful background initial sync must publish all valid rows, watermark and readiness.');
    $saved = $db->query("SELECT discount FROM `" . $prefix . "qiqo_partner_article_discount` WHERE partner_id=103 AND article_code='405054'")->fetch_assoc();
    jobIntegrationAssert($saved['discount'] === '18.0000', 'Existing absent manual pair must remain intact.');
    $backup = QiqoDiscountJob::directory($directory) . '/' . $job['id'] . '.backup.jsonl.gz';
    $backupLines = explode("\n", trim(gzdecode(file_get_contents($backup))));
    jobIntegrationAssert(count($backupLines) === 3 && json_decode($backupLines[2], true)['rows'] === 1, 'A completed private pre-change backup must exist before writes.');
    $request = file_get_contents($directory . '/request.xml');
    jobIntegrationAssert(strpos($request, '<datum>2026-08-01T00:00:00</datum>') !== false && strpos($request, 'fixture&lt;&amp;') !== false, 'SOAP must use persisted initial baseline and XML-escaped credentials.');
    $firstWatermark = $watermark()['last_sync_at'];
    [$exit, $job] = $run(jobIntegrationSoap(''));
    jobIntegrationAssert($exit === 0 && $job['empty'] === true && $job['mode'] === 'incremental' && $count() === 3 && $ready() === '1', 'Valid empty incremental sync must preserve all rows and remain ready.');
    $expectedSince = (new DateTime($firstWatermark, new DateTimeZone('Europe/Zagreb')))->modify('-60 seconds')->format('Y-m-d\TH:i:s');
    jobIntegrationAssert(strpos(file_get_contents($directory . '/request.xml'), '<datum>' . $expectedSince . '</datum>') !== false, 'Incremental request must overlap the previous store-local watermark by one minute.');
    $beforeFailure = $watermark()['last_sync_at'];
    [$exit, $job] = $run(jobIntegrationSoap(jobIntegrationRow(104, 'A', 101)));
    jobIntegrationAssert($exit !== 0 && $count() === 3 && $watermark()['last_sync_at'] === $beforeFailure && $ready() === '1', 'Invalid incremental row must preserve all live rows, readiness and watermark.');
    $lock = $db->real_escape_string($prefix . 'qiqo_partner_article_discount_incremental');
    $db->query("SELECT GET_LOCK('" . $lock . "',0)");
    [$exit, $job] = $run(jobIntegrationSoap(jobIntegrationRow(104, 'A', 30)));
    $db->query("SELECT RELEASE_LOCK('" . $lock . "')");
    jobIntegrationAssert($exit !== 0 && $job['error'] === 'sync_busy' && $count() === 3, 'Background sync must share the live import advisory lock.');
    echo "Local QIQO background integration passed (real CLI + loopback SOAP, rollback/staging, conflict, backup, preserved existing pair, zero rebate, readiness, overlap and shared lock).\n";
} finally {
    if (is_resource($server)) { proc_terminate($server); proc_close($server); }
    foreach (array_reverse($tables) as $table) { $db->query('DROP TABLE IF EXISTS `' . $prefix . $table . '`'); }
    $db->close();
    unlink($directory . '/upload/system');
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory, FilesystemIterator::SKIP_DOTS), RecursiveIteratorIterator::CHILD_FIRST);
    foreach ($iterator as $entry) { $entry->isDir() ? rmdir($entry->getPathname()) : unlink($entry->getPathname()); }
    rmdir($directory);
}
