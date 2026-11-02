<?php

// Repeatable catalog reconciliation. Dry run is the default; this command
// never enables FULL snapshots. --complete-snapshot is a separately gated,
// historical reconciliation that hides (never deletes) false/missing products.
if (PHP_SAPI !== 'cli') {
    http_response_code(404);
    exit(1);
}

$apply = false;
$since = '-2 years';
$options = [];
$completeSnapshot = false;
$explicitSince = false;
foreach (array_slice($argv, 1) as $argument) {
    if ($argument === '--apply') {
        $apply = true;
    } elseif ($argument === '--complete-snapshot') {
        $completeSnapshot = true;
    } elseif ($argument === '--allow-nontransactional') {
        $options['allow_nontransactional'] = true;
    } elseif ($argument === '--skip-unnamed-new') {
        $options['skip_unnamed_new'] = true;
    } elseif (strpos($argument, '--backup=') === 0) {
        $options['backup_path'] = substr($argument, strlen('--backup='));
    } elseif (strpos($argument, '--since=') === 0) {
        $since = substr($argument, strlen('--since='));
        $explicitSince = true;
        $date = DateTime::createFromFormat('!Y-m-d', $since);
        if (!$date || $date->format('Y-m-d') !== $since) {
            fwrite(STDERR, "--since must be a valid YYYY-MM-DD date.\n");
            exit(2);
        }
    } elseif ($argument === '--help') {
        echo "Usage: php scripts/sync_qiqo_catalog.php [--complete-snapshot] [--since=YYYY-MM-DD] [--skip-unnamed-new] [--apply]\n";
        echo "--skip-unnamed-new skips and reports only new SKUs without an ERP title; all critical feed validation remains mandatory.\n";
        echo "--complete-snapshot previews adds/reactivations and false/missing deactivations from an explicit historical date.\n";
        echo "Complete apply requires qiqo_catalog_snapshot_confirmed=1 and the same configured qiqo_catalog_snapshot_since date.\n";
        echo "Count/active-deactivation limits remain enforced. Active SKUs without names cannot be skipped in complete mode.\n";
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
    if ($apply) {
        require_once DIR_SYSTEM . 'library/cache.php';
        require_once DIR_SYSTEM . 'library/cache/file.php';
        $registry->set('cache', new Cache('file'));
    }
    $model = new ModelExtensionModuleQiqo($registry);
    if ($completeSnapshot) {
        if ($explicitSince) $options['snapshot_since'] = $since;
        $result = $model->reconcileCompleteCatalog($apply, $options);
    } else {
        $result = $model->reconcileCatalog($apply, $since, $options);
    }
    echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . PHP_EOL;
    exit($result['success'] ? 0 : 1);
} catch (Throwable $error) {
    // Database adapters may include SQL or account details in exceptions.
    fwrite(STDERR, "Catalog command failed; inspect the private QIQO log.\n");
    exit(1);
}
