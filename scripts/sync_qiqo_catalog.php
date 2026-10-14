<?php

// Repeatable catalog reconciliation. Dry run is the default; this command
// never enables FULL snapshots or disables products absent from a feed.
if (PHP_SAPI !== 'cli') {
    http_response_code(404);
    exit(1);
}

$apply = false;
$since = '-2 years';
$options = [];
foreach (array_slice($argv, 1) as $argument) {
    if ($argument === '--apply') {
        $apply = true;
    } elseif ($argument === '--allow-nontransactional') {
        $options['allow_nontransactional'] = true;
    } elseif (strpos($argument, '--backup=') === 0) {
        $options['backup_path'] = substr($argument, strlen('--backup='));
    } elseif (strpos($argument, '--since=') === 0) {
        $since = substr($argument, strlen('--since='));
        $date = DateTime::createFromFormat('!Y-m-d', $since);
        if (!$date || $date->format('Y-m-d') !== $since) {
            fwrite(STDERR, "--since must be a valid YYYY-MM-DD date.\n");
            exit(2);
        }
    } elseif ($argument === '--help') {
        echo "Usage: php scripts/sync_qiqo_catalog.php [--since=YYYY-MM-DD] [--apply]\n";
        echo "MyISAM apply additionally requires maintenance mode, --allow-nontransactional and --backup=/private/path/backup.sql.gz.\n";
        exit(0);
    } else {
        fwrite(STDERR, "Unknown option. Use --help.\n");
        exit(2);
    }
}

try {
    require dirname(__DIR__) . '/upload/config.php';
    if (is_file(dirname(__DIR__) . '/upload/env.php')) {
        require_once dirname(__DIR__) . '/upload/env.php';
    }
    require_once DIR_STORAGE . 'vendor/autoload.php';
    foreach (['engine/registry.php', 'engine/model.php', 'library/config.php',
        'library/db/mysqli.php', 'library/db.php', 'library/log.php'] as $file) {
        require_once DIR_SYSTEM . $file;
    }
    require_once dirname(__DIR__) . '/upload/admin/model/extension/module/qiqo.php';

    $db = new DB(DB_DRIVER, DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);
    $config = new Config();
    foreach ($db->query("SELECT `key`, `value`, `serialized` FROM `" . DB_PREFIX . "setting` WHERE store_id = 0")->rows as $row) {
        $config->set($row['key'], $row['serialized'] ? json_decode($row['value'], true) : $row['value']);
    }
    if ($config->get('config_timezone')) {
        date_default_timezone_set((new DateTimeZone($config->get('config_timezone')))->getName());
    }
    $registry = new Registry();
    $registry->set('db', $db);
    $registry->set('config', $config);
    $model = new ModelExtensionModuleQiqo($registry);
    $result = $model->reconcileCatalog($apply, $since, $options);
    echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . PHP_EOL;
    exit($result['success'] ? 0 : 1);
} catch (Throwable $error) {
    // Database adapters may include SQL or account details in exceptions.
    fwrite(STDERR, "Catalog command failed; inspect the private QIQO log.\n");
    exit(1);
}
