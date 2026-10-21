<?php

if (PHP_SAPI !== 'cli') { http_response_code(404); exit(1); }
$options = getopt('', ['job:']);
if (!isset($options['job']) || !preg_match('/^[a-f0-9]{32}$/D', $options['job'])) {
    fwrite(STDERR, "Usage: php scripts/run_qiqo_discount_job.php --job=OPAQUE_JOB_ID\n");
    exit(2);
}
umask(0077);
@set_time_limit(0);
ini_set('display_errors', '0');
ini_set('log_errors', '0'); // Raw transport/database exceptions must never reach a public PHP log.
$root = dirname(__DIR__);
require_once $root . '/upload/system/library/qiqo/discount_job.php';
try {
    require $root . '/upload/config.php';
    if (is_file($root . '/upload/env.php')) { require_once $root . '/upload/env.php'; }
    if (defined('DIR_STORAGE') && is_file(DIR_STORAGE . 'vendor/autoload.php')) { require_once DIR_STORAGE . 'vendor/autoload.php'; }
    $ok = QiqoDiscountJob::run($root, $options['job']);
    echo $ok ? "QIQO discount job complete.\n" : "QIQO discount job did not complete; see its private status.\n";
    exit($ok ? 0 : 1);
} catch (Throwable $error) {
    try { QiqoDiscountJob::fail($root, $options['job'], 'sync_failed'); } catch (Throwable $ignored) {}
    fwrite(STDERR, "QIQO discount job failed; inspect its private status.\n");
    exit(1);
}
