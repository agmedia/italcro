<?php
// Explicit configuration only: this command never sends an email.
if (PHP_SAPI !== 'cli') { http_response_code(404); exit(1); }
$arguments = array_slice($argv, 1);
if ($arguments === ['--help']) {
    echo "Usage: php scripts/configure_qiqo_alerts.php --email=recipient@example.com | --disable\n";
    echo "Saves the explicitly chosen ERP alert recipient. Does not send test messages.\n";
    exit(0);
}
$email = null;
if ($arguments === ['--disable']) {
    $email = '';
} elseif (count($arguments) === 1 && strpos($arguments[0], '--email=') === 0) {
    $email = trim(substr($arguments[0], strlen('--email=')));
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || preg_match('/[\r\n]/', $email)) $email = null;
}
if ($email === null) {
    fwrite(STDERR, "Provide one valid --email= recipient or --disable. Use --help.\n");
    exit(2);
}
try {
    require dirname(__DIR__) . '/upload/config.php';
    if (is_file(dirname(__DIR__) . '/upload/env.php')) require_once dirname(__DIR__) . '/upload/env.php';
    require_once DIR_SYSTEM . 'library/db/mysqli.php';
    require_once DIR_SYSTEM . 'library/db.php';
    $db = new DB(DB_DRIVER, DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);
    $table = DB_PREFIX . 'setting';
    $existing = $db->query("SELECT setting_id FROM `" . $table . "` WHERE store_id=0 AND `key`='qiqo_alert_email'");
    if ($existing->num_rows) {
        $db->query("UPDATE `" . $table . "` SET `value`='" . $db->escape($email)
            . "', serialized=0 WHERE store_id=0 AND `key`='qiqo_alert_email'");
    } else {
        $db->query("INSERT INTO `" . $table . "` SET store_id=0, `code`='qiqo', `key`='qiqo_alert_email', `value`='"
            . $db->escape($email) . "', serialized=0");
    }
    $saved = $db->query("SELECT `value`, serialized FROM `" . $table . "` WHERE store_id=0 AND `key`='qiqo_alert_email'");
    if (!$saved->num_rows) throw new RuntimeException('Setting was not saved.');
    foreach ($saved->rows as $row) {
        if ($row['value'] !== $email || (int)$row['serialized'] !== 0) throw new RuntimeException('Setting verification failed.');
    }
    echo json_encode(['success' => true, 'enabled' => $email !== '']) . PHP_EOL;
} catch (Throwable $error) {
    fwrite(STDERR, "Alert recipient configuration failed.\n");
    exit(1);
}
