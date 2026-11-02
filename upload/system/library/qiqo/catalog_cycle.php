<?php

require_once __DIR__ . '/discount_job.php';
require_once __DIR__ . '/sync_diagnostics.php';
require_once __DIR__ . '/catalog_backup.php';

/** CLI-only catalog cycle: preview, private full backup, maintenance apply, restore. */
final class QiqoCatalogCycle
{
    public static function run(string $root, $db, $config, $model, ?callable $backupRunner = null): array
    {
        if (PHP_SAPI !== 'cli') throw new RuntimeException('Catalog cycles require CLI.');
        $root = realpath($root);
        if (!$root || !is_dir($root . '/upload') || is_link($root . '/.qiqo-private')) {
            throw new RuntimeException('Invalid project directory.');
        }
        $private = dirname(QiqoDiscountJob::directory($root));
        if (realpath($private) !== $root . '/.qiqo-private') throw new RuntimeException('Invalid private directory.');
        $cronDirectory = self::directory($private . '/cron');
        $cycleDirectory = self::directory($private . '/catalog-cycles');
        $lock = fopen($cronDirectory . '/run.lock', 'c');
        if (!$lock || !flock($lock, LOCK_EX | LOCK_NB)) {
            if ($lock) fclose($lock);
            return ['success' => true, 'task' => 'catalog', 'skipped' => 'another_sync_running'];
        }
        @chmod($cronDirectory . '/run.lock', 0600);
        $started = microtime(true);
        $result = ['success' => false, 'task' => 'catalog', 'phase' => 'preflight'];
        $lockName = DB_PREFIX . 'qiqo_product_catalog_write';
        $dbLocked = false;
        $maintenanceChanged = false;
        $keepMaintenance = false;
        $maintenanceRows = [];
        $runDirectory = null;
        $activePath = $cronDirectory . '/catalog-active.json';
        $ownedMarker = false;
        $finished = false;
        // PHP fatal errors/exit do not run finally. Before apply, restoration is safe;
        // once apply starts, an unreported write outcome must remain under maintenance.
        register_shutdown_function(static function () use (&$finished, &$maintenanceChanged, &$keepMaintenance,
            &$maintenanceRows, &$result, &$ownedMarker, $activePath, $db, $config, $cronDirectory, $started) {
            if ($finished || !$maintenanceChanged) return;
            $interrupted = ['success' => false, 'task' => 'catalog', 'error' => 'catalog_cycle_interrupted',
                'phase' => $result['phase'] ?? 'unknown', 'finished_at' => gmdate('c'),
                'duration_seconds' => round(microtime(true) - $started, 2), 'warnings' => $result['warnings'] ?? []];
            if (!$keepMaintenance) {
                try {
                    self::restoreMaintenance($db, $config, $maintenanceRows);
                    $interrupted['maintenance_restored'] = true;
                } catch (Throwable $error) { $interrupted['maintenance_held'] = true; }
            } else {
                $interrupted['maintenance_held'] = true;
            }
            try { $interrupted['diagnostics'] = QiqoSyncDiagnostics::observe($cronDirectory, 'catalog', $interrupted, $config); }
            catch (Throwable $error) { $interrupted['diagnostics'] = ['error' => 'diagnostics_failed']; }
            try {
                self::write($cronDirectory . '/catalog-last.json', $interrupted);
                if ($ownedMarker && !empty($interrupted['maintenance_restored']) && is_file($activePath)) @unlink($activePath);
            }
            catch (Throwable $error) { /* Leave maintenance held if status storage is unavailable. */ }
        });
        try {
            do {
                $acquired = $db->query("SELECT GET_LOCK('" . $db->escape($lockName) . "', 0) AS acquired");
                if ((int)($acquired->row['acquired'] ?? 0) !== 1) {
                    $result = ['success' => true, 'task' => 'catalog', 'skipped' => 'another_catalog_running'];
                    break;
                }
                $dbLocked = true;
                $maintenanceRows = $db->query("SELECT setting_id,value,serialized FROM `" . DB_PREFIX
                    . "setting` WHERE store_id=0 AND code='config' AND `key`='config_maintenance' ORDER BY setting_id")->rows;
                if (!$maintenanceRows) throw new RuntimeException('Maintenance setting is missing.');
                $alreadyMaintenance = false;
                foreach ($maintenanceRows as $row) {
                    if ((string)$row['serialized'] !== '0' || !in_array((string)$row['value'], ['0', '1'], true)) {
                        throw new RuntimeException('Maintenance setting is invalid.');
                    }
                    $alreadyMaintenance = $alreadyMaintenance || (string)$row['value'] === '1';
                }
                // A SIGKILL cannot run PHP shutdown handlers. A previous owned marker
                // always requires review, even if the last completed status says success.
                if (file_exists($activePath) || is_link($activePath)) {
                    $previousCycle = !is_link($activePath) && is_file($activePath)
                        ? json_decode((string)file_get_contents($activePath), true) : [];
                    $result = ['success' => false, 'task' => 'catalog', 'error' => 'catalog_recovery_required',
                        'recovery_required' => true, 'maintenance_held' => $alreadyMaintenance];
                    if (is_array($previousCycle) && preg_match('/^[a-z_]{1,32}$/D', (string)($previousCycle['phase'] ?? ''))) {
                        $result['recovery_phase'] = $previousCycle['phase'];
                    }
                    if (is_array($previousCycle) && is_array($previousCycle['warnings'] ?? null)) $result['warnings'] = $previousCycle['warnings'];
                    break;
                }
                if ($alreadyMaintenance) {
                    $result = ['success' => true, 'task' => 'catalog', 'skipped' => 'maintenance'];
                    $previous = is_file($cronDirectory . '/catalog-last.json')
                        ? json_decode((string)file_get_contents($cronDirectory . '/catalog-last.json'), true) : [];
                    if (!empty($previous['maintenance_held'])) {
                        $result['success'] = false;
                        $result['error'] = 'catalog_previous_partial_requires_review';
                        $result['maintenance_held'] = true;
                    }
                    break;
                }
                $result['phase'] = 'preview';
                $preview = $model->reconcileCompleteCatalog(false);
                $result['preview'] = $preview;
                $result['warnings'] = $preview['warnings'] ?? [];
                if (empty($preview['success'])) {
                    $result['error'] = $preview['error'] ?? 'catalog_preview_failed';
                    break;
                }
                // The read-only preview is useful before confirmation; unattended apply is not.
                if (empty($preview['snapshot_confirmed'])) {
                    $result['error'] = 'catalog_snapshot_not_confirmed';
                    break;
                }
                if (array_key_exists('has_changes', $preview) && !$preview['has_changes']) {
                    $result['success'] = true;
                    $result['phase'] = 'complete';
                    $result['skipped'] = 'unchanged';
                    break;
                }
                $runDirectory = self::directory($cycleDirectory . '/cycle-' . gmdate('Ymd\THis\Z') . '-' . bin2hex(random_bytes(6)));
                $result['phase'] = 'maintenance';
                $marker = ['version' => 1, 'task' => 'catalog', 'run_id' => basename($runDirectory),
                    'phase' => 'maintenance_pending', 'started_at' => gmdate('c'),
                    'original_maintenance' => $maintenanceRows, 'warnings' => $result['warnings']];
                self::write($activePath, $marker);
                $ownedMarker = true;
                $maintenanceChanged = true;
                $ids = array_map(static function ($row) { return (int)$row['setting_id']; }, $maintenanceRows);
                $db->query("UPDATE `" . DB_PREFIX . "setting` SET value='1',serialized=0 WHERE setting_id IN (" . implode(',', $ids) . ')');
                $config->set('config_maintenance', '1');
                $result['phase'] = 'backup';
                $marker['phase'] = 'backup';
                self::write($activePath, $marker);
                $backup = $backupRunner ? $backupRunner($root, $runDirectory) : self::backup($root, $runDirectory);
                $digest = self::verifyBackup($backup, $runDirectory);
                $result['backup'] = ['path' => $backup, 'sha256' => $digest];
                $result['phase'] = 'apply';
                $marker['phase'] = 'apply';
                $marker['backup'] = ['path' => $backup, 'sha256' => $digest];
                self::write($activePath, $marker);
                // A thrown/fatal apply cannot prove rollback. Keep maintenance until inspected.
                $keepMaintenance = true;
                $applied = $model->reconcileCompleteCatalog(true, ['allow_nontransactional' => true, 'backup_path' => $backup]);
                $result['counts'] = $applied;
                $warnings = [];
                foreach (array_merge($result['warnings'], $applied['warnings'] ?? []) as $warning) {
                    $warnings[hash('sha256', json_encode($warning))] = $warning;
                }
                $result['warnings'] = array_values($warnings);
                $keepMaintenance = !empty($applied['partial']);
                if (empty($applied['success']) || !empty($applied['partial'])) {
                    $result['error'] = !empty($applied['error']) ? $applied['error']
                        : (!empty($applied['partial']) ? 'catalog_apply_partial' : 'catalog_apply_failed');
                    break;
                }
                $result['success'] = true;
                $result['phase'] = 'complete';
                $marker['phase'] = 'complete';
                self::write($activePath, $marker);
                self::write($runDirectory . '/cycle.json', ['version' => 1, 'success' => true,
                    'backup' => basename($backup), 'sha256' => $digest, 'finished_at' => gmdate('c'),
                    'completed_at_unix' => microtime(true)]);
                self::retain($cycleDirectory, 3);
            } while (false);
        } catch (Throwable $error) {
            $result['success'] = false;
            $result['error'] = 'catalog_cycle_failed';
        } finally {
            if ($maintenanceChanged && !$keepMaintenance) {
                try {
                    self::restoreMaintenance($db, $config, $maintenanceRows);
                    $result['maintenance_restored'] = true;
                } catch (Throwable $restoreError) {
                    $result['success'] = false;
                    $result['error'] = 'maintenance_restore_failed';
                    $result['maintenance_held'] = true;
                }
            } elseif ($maintenanceChanged) {
                $result['maintenance_held'] = true;
            }
            if ($ownedMarker && empty($result['maintenance_held'])) {
                if (!is_file($activePath) || is_link($activePath) || !unlink($activePath)) {
                    $result['success'] = false;
                    $result['error'] = 'catalog_marker_cleanup_failed';
                    $result['recovery_required'] = true;
                }
            }
            $result['finished_at'] = gmdate('c');
            $result['duration_seconds'] = round(microtime(true) - $started, 2);
            $finished = true;
            try {
                $result['diagnostics'] = QiqoSyncDiagnostics::observe($cronDirectory, 'catalog', $result, $config);
            } catch (Throwable $diagnosticError) {
                $result['diagnostics'] = ['error' => 'diagnostics_failed'];
            }
            try { self::write($cronDirectory . '/catalog-last.json', $result); }
            finally {
                if ($dbLocked) {
                    try { $db->query("SELECT RELEASE_LOCK('" . $db->escape($lockName) . "') AS released"); }
                    catch (Throwable $lockError) { /* Connection close releases its named locks. */ }
                }
                flock($lock, LOCK_UN);
                fclose($lock);
            }
        }
        return $result;
    }

    private static function restoreMaintenance($db, $config, array $rows): void
    {
        foreach ($rows as $row) {
            $db->query("UPDATE `" . DB_PREFIX . "setting` SET value='" . $db->escape((string)$row['value'])
                . "',serialized='" . (int)$row['serialized'] . "' WHERE setting_id=" . (int)$row['setting_id']);
        }
        $config->set('config_maintenance', '0');
    }

    private static function directory(string $path): string
    {
        if (is_link($path) || (!is_dir($path) && !mkdir($path, 0700, true)) || realpath($path) !== $path
            || !chmod($path, 0700)) throw new RuntimeException('Cannot protect catalog cycle directory.');
        return $path;
    }

    private static function backup(string $root, string $directory): string
    {
        if (!function_exists('proc_open')) throw new RuntimeException('Backup process is unavailable.');
        $log = $directory . '/backup-run.log';
        self::write($log, []);
        $command = [PHP_BINARY, $root . '/scripts/backup_qiqo_database.php', '--output-dir=' . $directory,
            '--apply', '--table-locks'];
        $process = proc_open($command, [0 => ['pipe', 'r'], 1 => ['file', $log, 'a'], 2 => ['file', $log, 'a']], $pipes,
            $root, null, ['bypass_shell' => true]);
        if (!is_resource($process)) throw new RuntimeException('Cannot start catalog backup.');
        fclose($pipes[0]);
        if (proc_close($process) !== 0) throw new RuntimeException('Catalog backup did not finish.');
        $files = glob($directory . '/qiqo-database-*.sql');
        if (count($files) !== 1) throw new RuntimeException('Catalog backup is missing.');
        return $files[0];
    }

    private static function verifyBackup(string $path, string $directory, int $maxAge = 3600): string
    {
        return QiqoCatalogBackup::verify($path, $directory, null, $maxAge)['sha256'];
    }

    private static function write(string $path, array $value): void
    {
        $temporary = tempnam(dirname($path), '.catalog-');
        if ($temporary === false) throw new RuntimeException('Cannot create private catalog status.');
        try {
            if (!chmod($temporary, 0600) || file_put_contents($temporary, json_encode($value, JSON_UNESCAPED_SLASHES), LOCK_EX) === false
                || !rename($temporary, $path)) throw new RuntimeException('Cannot write private catalog status.');
        } finally { if (is_file($temporary)) @unlink($temporary); }
    }

    private static function retain(string $directory, int $keep): void
    {
        $completed = [];
        foreach (glob($directory . '/cycle-*', GLOB_ONLYDIR) as $candidate) {
            if (is_link($candidate) || realpath(dirname($candidate)) !== $directory
                || !preg_match('/^cycle-\d{8}T\d{6}Z-[a-f0-9]{12}$/D', basename($candidate))
                || is_link($candidate . '/cycle.json') || !is_file($candidate . '/cycle.json')) continue;
            $manifest = json_decode((string)file_get_contents($candidate . '/cycle.json'), true);
            if (!is_array($manifest) || ($manifest['version'] ?? null) !== 1 || empty($manifest['success'])
                || !isset($manifest['backup'], $manifest['sha256']) || basename($manifest['backup']) !== $manifest['backup']) continue;
            try {
                $hash = self::verifyBackup($candidate . '/' . $manifest['backup'], $candidate, 0);
                if (!hash_equals($manifest['sha256'], $hash)) continue;
            } catch (Throwable $error) { continue; }
            $allowed = [$manifest['backup'], $manifest['backup'] . '.sha256', 'cycle.json', 'backup-run.log'];
            foreach (array_diff(scandir($candidate), ['.', '..']) as $entry) {
                if (!in_array($entry, $allowed, true) || is_link($candidate . '/' . $entry) || !is_file($candidate . '/' . $entry)) continue 2;
            }
            $completed[$candidate] = (float)($manifest['completed_at_unix'] ?? filemtime($candidate . '/cycle.json'));
        }
        arsort($completed, SORT_NUMERIC);
        foreach (array_slice(array_keys($completed), $keep) as $old) {
            foreach (array_diff(scandir($old), ['.', '..']) as $entry) {
                if (!unlink($old . '/' . $entry)) throw new RuntimeException('Cannot remove an expired verified catalog backup.');
            }
            if (!rmdir($old)) throw new RuntimeException('Cannot remove expired catalog backup directory.');
        }
    }
}
