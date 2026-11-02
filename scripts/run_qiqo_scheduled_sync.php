<?php
if (PHP_SAPI !== 'cli') { http_response_code(404); exit(1); }
$options = getopt('', ['task:']);
require_once __DIR__ . '/../upload/system/library/qiqo/scheduled_sync.php';
if (!isset($options['task']) || !in_array($options['task'], QiqoScheduledSync::TASKS, true)) {
    fwrite(STDERR, "Usage: php scripts/run_qiqo_scheduled_sync.php --task=stock|prices|actions|partners|discounts\n");
    exit(2);
}
umask(0077);
ini_set('display_errors', '0');
@set_time_limit(600);
try {
    $result = QiqoScheduledSync::run(dirname(__DIR__), $options['task']);
    echo json_encode($result, JSON_UNESCAPED_SLASHES) . PHP_EOL;
    exit($result['success'] ? 0 : 1);
} catch (Throwable $error) {
    fwrite(STDERR, "Scheduled synchronization failed; see private status.\n");
    exit(1);
}
