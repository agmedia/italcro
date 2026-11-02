<?php

require_once __DIR__ . '/discount_job.php';
require_once __DIR__ . '/sync_diagnostics.php';

/** The scheduler can run only this fixed list of existing read-ERP synchronizers. */
final class QiqoScheduledSync
{
    public const TASKS = ['stock', 'prices', 'actions', 'partners', 'discounts'];

    public static function authorized(array $keys, string $task, string $token): bool
    {
        return in_array($task, self::TASKS, true) && strlen($token) >= 32
            && isset($keys[$task]) && is_string($keys[$task])
            && hash_equals($keys[$task], hash('sha256', $token));
    }

    public static function run(string $root, string $task): array
    {
        if (!in_array($task, self::TASKS, true)) throw new InvalidArgumentException('Unknown scheduled task.');
        $root = realpath($root);
        $directory = dirname(QiqoDiscountJob::directory($root)) . '/cron';
        if (!is_dir($directory) && !mkdir($directory, 0700, true)) throw new RuntimeException('Cannot create cron directory.');
        $lock = fopen($directory . '/run.lock', 'c');
        if (!$lock || !flock($lock, LOCK_EX | LOCK_NB)) {
            if ($lock) fclose($lock);
            return ['success' => true, 'task' => $task, 'skipped' => 'another_sync_running'];
        }
        @chmod($directory . '/run.lock', 0600);
        $started = microtime(true);
        $config = null;
        $model = null;
        try {
            require_once $root . '/upload/config.php';
            if (is_file($root . '/upload/env.php')) require_once $root . '/upload/env.php';
            require_once DIR_STORAGE . 'vendor/autoload.php';
            foreach (['engine/registry.php', 'engine/model.php', 'library/config.php', 'library/db/mysqli.php',
                'library/db.php', 'library/log.php', 'library/cache.php', 'library/cache/file.php'] as $file) {
                require_once DIR_SYSTEM . $file;
            }
            require_once $root . '/upload/admin/model/extension/module/qiqo.php';
            $db = new DB(DB_DRIVER, DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);
            $config = new Config();
            foreach ($db->query('SELECT `key`, value, serialized FROM `' . DB_PREFIX . 'setting` WHERE store_id=0')->rows as $row) {
                $config->set($row['key'], $row['serialized'] ? json_decode($row['value'], true) : $row['value']);
            }
            date_default_timezone_set($config->get('config_timezone') ?: 'Europe/Zagreb');
            if ($config->get('config_maintenance')) return ['success' => true, 'task' => $task, 'skipped' => 'maintenance'];
            $registry = new Registry();
            $registry->set('db', $db);
            $registry->set('config', $config);
            $registry->set('cache', new Cache('file'));
            $model = new ModelExtensionModuleQiqo($registry);
            if ($task === 'discounts') {
                // Never initiate the multi-million-row first import from a scheduler.
                if ((string)$config->get('qiqo_partner_article_initial_complete') !== '1') {
                    throw new RuntimeException('Initial discount import is not complete.');
                }
                $job = QiqoDiscountJob::create($root, 0);
                if (!empty($job['existing'])) return ['success' => true, 'task' => $task, 'skipped' => 'discount_job_running'];
                if (!QiqoDiscountJob::run($root, $job['id'])) throw new RuntimeException('Discount job failed.');
                $state = QiqoDiscountJob::status($root, $job['id']);
                $counts = ['rows' => (int)($state['rows'] ?? 0)];
            } elseif ($task === 'partners') {
                $counts = $model->syncPartnerBaseData();
                if (empty($counts['_success'])) throw new RuntimeException('Partner synchronization failed.');
                unset($counts['_success']);
            } else {
                $methods = ['stock' => 'updateQuantities', 'prices' => 'updatePrices', 'actions' => 'syncActionPrices'];
                $count = $model->{$methods[$task]}();
                if ($count < 0 || ($task === 'actions' && $count === 0)) throw new RuntimeException('ERP synchronization failed.');
                $counts = ['rows' => $count];
            }
            $result = ['success' => true, 'task' => $task, 'counts' => $counts, 'finished_at' => gmdate('c'),
                'duration_seconds' => round(microtime(true) - $started, 2)];
            if (method_exists($model, 'getSyncWarnings')) $result['warnings'] = $model->getSyncWarnings();
            return self::recordResult($directory, $task, $result, $config);
        } catch (Throwable $error) {
            // Do not publish raw transport/SQL exceptions or ERP/customer records.
            $result = ['success' => false, 'task' => $task, 'error' => 'sync_failed', 'finished_at' => gmdate('c')];
            if ($model && method_exists($model, 'getSyncWarnings')) $result['warnings'] = $model->getSyncWarnings();
            return self::recordResult($directory, $task, $result, $config);
        } finally {
            flock($lock, LOCK_UN);
            fclose($lock);
        }
    }

    private static function recordResult(string $directory, string $task, array $result, $config): array
    {
        try {
            $diagnostic = QiqoSyncDiagnostics::observe($directory, $task, $result, $config);
            $result['status'] = $diagnostic['status'];
            $result['notification'] = $diagnostic['notification'];
        } catch (Throwable $diagnosticError) {
            $result['status'] = empty($result['success']) ? 'failure' : (!empty($result['warnings']) ? 'warning' : 'success');
            $result['notification'] = ['sent' => false, 'error' => 'diagnostics_failed'];
        }
        file_put_contents($directory . '/' . $task . '-last.json', json_encode($result), LOCK_EX);
        @chmod($directory . '/' . $task . '-last.json', 0600);
        return $result;
    }
}
