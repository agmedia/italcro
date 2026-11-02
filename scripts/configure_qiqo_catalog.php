<?php

// Run only after reviewing the read-only complete historical catalog preview.
if (PHP_SAPI !== 'cli') { http_response_code(404); exit(1); }
require_once __DIR__ . '/../upload/system/library/qiqo/sync_guard.php';
$arguments = array_slice($argv, 1);
if ($arguments === ['--help']) {
    echo "Usage: php scripts/configure_qiqo_catalog.php --confirm-complete-snapshot=YYYY-MM-DD | --disable | --defer-unnamed=SKU,SKU\n";
    echo "Enables only complete article reconciliation; does not import, send mail or change other FULL gates.\n";
    exit(0);
}
$since = null;
$enabled = false;
$deferred = null;
if ($arguments === ['--disable']) {
    $since = '';
} elseif (count($arguments) === 1 && strpos($arguments[0], '--confirm-complete-snapshot=') === 0) {
    $since = substr($arguments[0], strlen('--confirm-complete-snapshot='));
    $enabled = QiqoSyncGuard::hasConfirmedFullSnapshotConfiguration(true, $since);
    if (!$enabled) $since = null;
} elseif (count($arguments) === 1 && strpos($arguments[0], '--defer-unnamed=') === 0) {
    $raw = substr($arguments[0], strlen('--defer-unnamed='));
    $deferred = $raw === '' ? [] : explode(',', $raw);
    if (count($deferred) > 100) $deferred = null;
    if ($deferred !== null) {
        foreach ($deferred as $sku) {
            if (!preg_match('/^[0-9]{1,64}$/D', $sku)) { $deferred = null; break; }
        }
    }
    if ($deferred !== null) { $deferred = array_values(array_unique($deferred)); sort($deferred, SORT_STRING); }
}
if ($since === null && $deferred === null) {
    fwrite(STDERR, "Provide a valid catalog configuration option. Use --help.\n");
    exit(2);
}
try {
    require dirname(__DIR__) . '/upload/config.php';
    require_once DIR_SYSTEM . 'library/db/mysqli.php';
    require_once DIR_SYSTEM . 'library/db.php';
    $db = new DB(DB_DRIVER, DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);
    $settings = $deferred !== null ? ['qiqo_catalog_deferred_unnamed_skus' => json_encode($deferred)]
        : ['qiqo_catalog_snapshot_since' => $since, 'qiqo_catalog_snapshot_confirmed' => $enabled ? '1' : '0'];
    foreach ($settings as $key => $value) {
        $rows = $db->query("SELECT setting_id FROM `" . DB_PREFIX . "setting` WHERE store_id=0 AND `key`='" . $key . "'");
        if (!$rows->num_rows) throw new RuntimeException('Apply the complete catalog settings migration first.');
        $db->query("UPDATE `" . DB_PREFIX . "setting` SET `value`='" . $db->escape($value)
            . "',serialized=0 WHERE store_id=0 AND `key`='" . $key . "'");
        $saved = $db->query("SELECT `value`,serialized FROM `" . DB_PREFIX . "setting` WHERE store_id=0 AND `key`='" . $key . "'");
        foreach ($saved->rows as $row) {
            if ($row['value'] !== $value || (int)$row['serialized'] !== 0) throw new RuntimeException('Setting verification failed.');
        }
    }
    echo json_encode($deferred !== null ? ['success' => true, 'deferred_unnamed_skus' => $deferred]
        : ['success' => true, 'enabled' => $enabled, 'since' => $since]) . PHP_EOL;
} catch (Throwable $error) {
    fwrite(STDERR, "Catalog configuration failed; complete catalog import was not run.\n");
    exit(1);
}
