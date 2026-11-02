<?php

if (PHP_SAPI !== 'cli') { http_response_code(404); exit(1); }
if (count($argv) !== 1) {
    fwrite(STDERR, "Usage: php scripts/run_qiqo_catalog_cycle.php\nUses confirmed catalog settings; previews before maintenance/backup/apply.\n");
    exit(2);
}
umask(0077);
ini_set('display_errors', '0');
@set_time_limit(0);
try {
    $root = dirname(__DIR__);
    require $root . '/upload/config.php';
    if (is_file($root . '/upload/env.php')) require_once $root . '/upload/env.php';
    require_once DIR_STORAGE . 'vendor/autoload.php';
    foreach (['engine/registry.php', 'engine/model.php', 'library/config.php', 'library/db/mysqli.php',
        'library/db.php', 'library/log.php', 'library/cache.php', 'library/cache/file.php'] as $file) {
        require_once DIR_SYSTEM . $file;
    }
    require_once $root . '/upload/admin/model/extension/module/qiqo.php';
    require_once DIR_SYSTEM . 'library/qiqo/catalog_cycle.php';
    $db = new DB(DB_DRIVER, DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);
    $config = new Config();
    foreach ($db->query('SELECT `key`,value,serialized FROM `' . DB_PREFIX . 'setting` WHERE store_id=0')->rows as $row) {
        $config->set($row['key'], $row['serialized'] ? json_decode($row['value'], true) : $row['value']);
    }
    date_default_timezone_set($config->get('config_timezone') ?: 'Europe/Zagreb');
    $registry = new Registry();
    $registry->set('db', $db); $registry->set('config', $config); $registry->set('cache', new Cache('file'));
    $model = new ModelExtensionModuleQiqo($registry);
    $result = QiqoCatalogCycle::run($root, $db, $config, $model);
    echo json_encode($result, JSON_UNESCAPED_SLASHES) . PHP_EOL;
    exit($result['success'] ? 0 : 1);
} catch (Throwable $error) {
    fwrite(STDERR, "Catalog cycle failed; inspect the private catalog status and maintenance state.\n");
    exit(1);
}
