<?php
// EasyCron calls a separate key per task over HTTPS. No admin session is needed.
ini_set('display_errors', '0');
umask(0077);
header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store');
$root = dirname(__DIR__);
require_once __DIR__ . '/system/library/qiqo/scheduled_sync.php';
$task = isset($_GET['task']) && is_string($_GET['task']) ? $_GET['task'] : '';
$token = isset($_SERVER['HTTP_X_QIQO_CRON_KEY']) ? (string)$_SERVER['HTTP_X_QIQO_CRON_KEY'] : '';
$keys = @json_decode((string)@file_get_contents($root . '/.qiqo-private/cron/auth.json'), true);
if ($_SERVER['REQUEST_METHOD'] !== 'POST'
    || (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === 'off')
    || !QiqoScheduledSync::authorized(is_array($keys) ? $keys : [], $task, $token)) {
    http_response_code(404);
    echo json_encode(['success' => false]);
    exit;
}
@set_time_limit(600);
try {
    $result = QiqoScheduledSync::run($root, $task);
    http_response_code($result['success'] ? 200 : 502);
    echo json_encode($result);
} catch (Throwable $error) {
    http_response_code(502);
    echo json_encode(['success' => false, 'error' => 'sync_failed']);
}
