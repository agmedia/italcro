<?php

define('DB_PREFIX', 'test_');
define('DB_DATABASE', 'testdb');
require __DIR__ . '/../upload/system/library/qiqo/catalog_cycle.php';

function cycleAssert($condition, $message) { if (!$condition) throw new RuntimeException($message); }
class CycleConfig {
    public $values = ['config_maintenance' => '0'];
    public function get($key) { return $this->values[$key] ?? null; }
    public function set($key, $value) { $this->values[$key] = $value; }
}
class CycleDb {
    public $maintenance = [['setting_id' => 12, 'value' => '0', 'serialized' => '0'],
        ['setting_id' => 19, 'value' => '0', 'serialized' => '0']];
    public $queries = [];
    public $busy = false;
    public $restoreFails = false;
    public $statePath;
    public $activePath;
    public function escape($value) { return addslashes($value); }
    public function query($sql) {
        $this->queries[] = $sql;
        if (strpos($sql, 'SELECT GET_LOCK(') === 0) return (object)['row' => ['acquired' => $this->busy ? 0 : 1]];
        if (strpos($sql, 'SELECT RELEASE_LOCK(') === 0) return (object)['row' => ['released' => 1]];
        if (strpos($sql, 'SELECT setting_id') === 0) return (object)['rows' => $this->maintenance];
        if (strpos($sql, "SET value='1',serialized=0 WHERE setting_id IN (") !== false) {
            if ($this->activePath) {
                $active = json_decode(file_get_contents($this->activePath), true);
                cycleAssert(($active['phase'] ?? '') === 'maintenance_pending'
                    && $active['original_maintenance'][0]['value'] === '0',
                    'Durable ownership must be persisted before enabling maintenance.');
            }
            foreach ($this->maintenance as &$row) $row['value'] = '1'; unset($row);
            if ($this->statePath) file_put_contents($this->statePath, json_encode($this->maintenance));
            return true;
        }
        if (preg_match("/SET value='([01])',serialized='0' WHERE setting_id=(\d+)$/", $sql, $m)) {
            if ($this->restoreFails) throw new RuntimeException('Injected restore failure.');
            foreach ($this->maintenance as &$row) if ((int)$row['setting_id'] === (int)$m[2]) $row['value'] = $m[1]; unset($row);
            if ($this->statePath) file_put_contents($this->statePath, json_encode($this->maintenance));
            return true;
        }
        throw new RuntimeException('Unexpected SQL in cycle test.');
    }
}
class CycleModel {
    public $preview = ['success' => true, 'snapshot_confirmed' => true, 'fetched' => 10, 'added' => 1, 'disabled' => 1];
    public $applied = ['success' => true, 'partial' => false, 'added' => 1, 'disabled' => 1];
    public $calls = [];
    public $throwApply = false;
    public $exitApply = false;
    public function reconcileCompleteCatalog($apply = false, $options = []) {
        $this->calls[] = [$apply, $options];
        if ($apply && $this->exitApply) exit(43);
        if ($apply && $this->throwApply) throw new RuntimeException('Injected unexpected apply failure.');
        return $apply ? $this->applied : $this->preview;
    }
}
function cycleRoot() {
    $root = sys_get_temp_dir() . '/italcro-cycle-test-' . bin2hex(random_bytes(6));
    mkdir($root, 0700); mkdir($root . '/upload', 0700);
    return realpath($root);
}
function cycleCleanup($root) {
    $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($root, FilesystemIterator::SKIP_DOTS), RecursiveIteratorIterator::CHILD_FIRST);
    foreach ($files as $file) { if ($file->isDir() && !$file->isLink()) rmdir($file->getPathname()); else unlink($file->getPathname()); }
    rmdir($root);
}
function cycleBackup($root, $directory) {
    $path = $directory . '/qiqo-database-' . gmdate('Ymd\THis\Z') . '-' . bin2hex(random_bytes(6)) . '.sql';
    file_put_contents($path, "-- private test database dump\nUSE `testdb`;\n-- Dump completed on 2026-11-02 12:00:00\n");
    chmod($path, 0600);
    file_put_contents($path . '.sha256', hash_file('sha256', $path) . '  ' . basename($path) . "\n");
    chmod($path . '.sha256', 0600);
    return $path;
}

if (in_array($argv[1] ?? '', ['--fatal-in-backup', '--fatal-in-apply', '--sigkill-in-backup'], true)) {
    $root = $argv[2];
    $db = new CycleDb(); $db->statePath = $root . '/maintenance-state.json';
    $config = new CycleConfig(); $model = new CycleModel();
    $model->exitApply = $argv[1] === '--fatal-in-apply';
    $runner = $model->exitApply ? 'cycleBackup' : static function () use ($argv) {
        if ($argv[1] === '--sigkill-in-backup') posix_kill(getmypid(), 9);
        exit(42);
    };
    QiqoCatalogCycle::run($root, $db, $config, $model, $runner);
    exit(1);
}

$root = cycleRoot();
try {
    $db = new CycleDb(); $config = new CycleConfig(); $model = new CycleModel();
    $db->activePath = $root . '/.qiqo-private/cron/catalog-active.json';
    $model->preview['warnings'] = [['code' => 'deferred_catalog_name', 'article' => '500172']];
    $model->applied['warnings'] = $model->preview['warnings'];
    $backups = 0;
    $runner = static function ($root, $directory) use ($db, $model, &$backups) {
        cycleAssert(count($model->calls) === 1 && !$model->calls[0][0] && $db->maintenance[0]['value'] === '1',
            'Full snapshot preview must finish before maintenance and backup.');
        $active = json_decode(file_get_contents($root . '/.qiqo-private/cron/catalog-active.json'), true);
        cycleAssert(($active['phase'] ?? '') === 'backup' && $active['original_maintenance'][0]['value'] === '0',
            'A durable owned marker with the original settings must exist before backup/maintenance work.');
        $backups++;
        return cycleBackup($root, $directory);
    };
    $result = QiqoCatalogCycle::run($root, $db, $config, $model, $runner);
    cycleAssert($result['success'] && !empty($result['maintenance_restored']) && $backups === 1
        && count($model->calls) === 2 && $db->maintenance[0]['value'] === '0' && $db->maintenance[1]['value'] === '0'
        && $model->calls[1][1]['backup_path'] === $result['backup']['path'],
        'Successful catalog cycle must use a verified backup and restore every maintenance setting row.');
    cycleAssert($result['warnings'] === [['code' => 'deferred_catalog_name', 'article' => '500172']]
        && ($result['diagnostics']['status'] ?? '') === 'warning', 'Preview/apply warnings must reach diagnostics once at the top level.');
    cycleAssert(!file_exists($db->activePath), 'A safely completed/restored cycle must clear only its own marker.');
    $last = json_decode(file_get_contents($root . '/.qiqo-private/cron/catalog-last.json'), true);
    cycleAssert($last['success'] && (fileperms($root . '/.qiqo-private/cron/catalog-last.json') & 0077) === 0,
        'Catalog result must be saved privately.');
    $lock = fopen($root . '/.qiqo-private/cron/run.lock', 'c'); flock($lock, LOCK_EX);
    $skipped = QiqoCatalogCycle::run($root, $db, $config, $model, $runner);
    flock($lock, LOCK_UN); fclose($lock);
    cycleAssert(($skipped['skipped'] ?? '') === 'another_sync_running', 'Catalog cycles must share the five cron jobs filesystem lock.');
    // Four additional verified successes must retain only the newest three; unknown directories stay untouched.
    mkdir($root . '/.qiqo-private/catalog-cycles/manual-backup', 0700);
    file_put_contents($root . '/.qiqo-private/catalog-cycles/manual-backup/keep.txt', 'retained');
    for ($i = 0; $i < 4; $i++) {
        $db = new CycleDb(); $config = new CycleConfig(); $model = new CycleModel();
        $result = QiqoCatalogCycle::run($root, $db, $config, $model, 'cycleBackup');
        cycleAssert($result['success'] && is_file($result['backup']['path']), 'Retention must keep the current verified backup.');
    }
    cycleAssert(count(glob($root . '/.qiqo-private/catalog-cycles/cycle-*/cycle.json')) === 3
        && is_file($root . '/.qiqo-private/catalog-cycles/manual-backup/keep.txt'),
        'Retention must remove only expired completed verified cycles, never unrelated files.');
} finally { cycleCleanup($root); }

foreach (['maintenance', 'db_busy', 'preview_failure', 'unconfirmed', 'unchanged', 'backup_failure', 'corrupt_backup', 'apply_rollback', 'apply_partial', 'success_partial', 'apply_throw', 'restore_failure'] as $case) {
    $root = cycleRoot();
    try {
        $db = new CycleDb(); $config = new CycleConfig(); $model = new CycleModel();
        $backupCalls = 0;
        if ($case === 'maintenance') $db->maintenance[0]['value'] = '1';
        if ($case === 'db_busy') $db->busy = true;
        if ($case === 'preview_failure') $model->preview = ['success' => false, 'error' => 'catalog_snapshot_too_small'];
        if ($case === 'unconfirmed') $model->preview['snapshot_confirmed'] = false;
        if ($case === 'unchanged') $model->preview['has_changes'] = false;
        if ($case === 'unchanged') $model->preview['warnings'] = [['code' => 'deferred_catalog_name', 'article' => '500172']];
        if ($case === 'apply_rollback') $model->applied = ['success' => false, 'partial' => false, 'error' => 'catalog_sync_failed'];
        if ($case === 'apply_partial') $model->applied = ['success' => false, 'partial' => true, 'error' => 'catalog_sync_failed'];
        if ($case === 'success_partial') $model->applied = ['success' => true, 'partial' => true, 'error' => ''];
        if ($case === 'apply_throw') $model->throwApply = true;
        if ($case === 'restore_failure') $db->restoreFails = true;
        $runner = static function ($root, $directory) use ($case, &$backupCalls) {
            $backupCalls++;
            if ($case === 'backup_failure') throw new RuntimeException('Injected backup failure.');
            $path = cycleBackup($root, $directory);
            if ($case === 'corrupt_backup') file_put_contents($path, 'Truncated dump');
            return $path;
        };
        $result = QiqoCatalogCycle::run($root, $db, $config, $model, $runner);
        if (in_array($case, ['maintenance', 'db_busy', 'preview_failure', 'unconfirmed', 'unchanged'], true)) {
            cycleAssert($backupCalls === 0 && count($model->calls) <= 1, 'A skipped/unsafe preview must never enable backup/apply: ' . $case);
            if ($case === 'unchanged') cycleAssert($result['success'] && ($result['skipped'] ?? '') === 'unchanged' && $db->maintenance[0]['value'] === '0',
                'No-drift cycles must leave the site open and create no backup.');
            if ($case === 'unchanged') cycleAssert($result['warnings'] === $model->preview['warnings']
                && ($result['diagnostics']['status'] ?? '') === 'warning', 'Unchanged deferred-only cycles must still report the warning to diagnostics.');
        } elseif (in_array($case, ['backup_failure', 'corrupt_backup', 'apply_rollback'], true)) {
            cycleAssert(!$result['success'] && !empty($result['maintenance_restored']) && $db->maintenance[0]['value'] === '0',
                'A pre-apply/rolled-back failure must restore maintenance: ' . $case);
        } else {
            cycleAssert(!$result['success'] && !empty($result['maintenance_held']) && $db->maintenance[0]['value'] === '1',
                'A partial/unknown apply or failed restoration must require inspection before reopening: ' . $case);
            if ($case === 'success_partial') cycleAssert(!glob($root . '/.qiqo-private/catalog-cycles/cycle-*/cycle.json'),
                'A contradictory success=true/partial=true must never create a successful retention manifest.');
            $nextModel = new CycleModel();
            $next = QiqoCatalogCycle::run($root, $db, $config, $nextModel, $runner);
            cycleAssert(!$next['success'] && ($next['error'] ?? '') === 'catalog_recovery_required'
                && !$nextModel->calls, 'An unresolved partial cycle must remain a failed incident on the next run.');
        }
    } finally { cycleCleanup($root); }
}
foreach (['--fatal-in-backup' => 0, '--fatal-in-apply' => 1] as $mode => $held) {
    $root = cycleRoot();
    try {
        $process = proc_open([PHP_BINARY, __FILE__, $mode, $root], [0 => ['pipe', 'r'], 1 => ['pipe', 'w'], 2 => ['pipe', 'w']], $pipes);
        cycleAssert(is_resource($process), 'Cannot start shutdown regression test.');
        fclose($pipes[0]); stream_get_contents($pipes[1]); fclose($pipes[1]); stream_get_contents($pipes[2]); fclose($pipes[2]);
        $exit = proc_close($process);
        $last = json_decode(file_get_contents($root . '/.qiqo-private/cron/catalog-last.json'), true);
        $state = json_decode(file_get_contents($root . '/maintenance-state.json'), true);
        cycleAssert($exit === ($held ? 43 : 42) && !$last['success'] && $last['error'] === 'catalog_cycle_interrupted'
            && (int)$state[0]['value'] === $held && !empty($last[$held ? 'maintenance_held' : 'maintenance_restored']),
            'Unexpected process exit must restore pre-apply maintenance or hold an unknown apply outcome.');
    } finally { cycleCleanup($root); }
}
if (function_exists('posix_kill')) {
    $root = cycleRoot();
    try {
        $cronDirectory = dirname(QiqoDiscountJob::directory($root)) . '/cron'; mkdir($cronDirectory, 0700);
        file_put_contents($cronDirectory . '/catalog-last.json', json_encode(['success' => true, 'task' => 'catalog']));
        $process = proc_open([PHP_BINARY, __FILE__, '--sigkill-in-backup', $root],
            [0 => ['pipe', 'r'], 1 => ['pipe', 'w'], 2 => ['pipe', 'w']], $pipes);
        cycleAssert(is_resource($process), 'Cannot start SIGKILL regression test.');
        fclose($pipes[0]); stream_get_contents($pipes[1]); fclose($pipes[1]); stream_get_contents($pipes[2]); fclose($pipes[2]);
        $exit = proc_close($process);
        $markerPath = $cronDirectory . '/catalog-active.json';
        $marker = json_decode(file_get_contents($markerPath), true);
        $state = json_decode(file_get_contents($root . '/maintenance-state.json'), true);
        $previous = json_decode(file_get_contents($cronDirectory . '/catalog-last.json'), true);
        cycleAssert($exit !== 0 && ($marker['phase'] ?? '') === 'backup' && $state[0]['value'] === '1'
            && $previous['success'] === true && (fileperms($markerPath) & 0777) === 0600,
            'SIGKILL must leave the durable ownership marker even when the previous completed status says success.');
        $db = new CycleDb(); $db->maintenance = $state;
        $model = new CycleModel(); $config = new CycleConfig();
        $next = QiqoCatalogCycle::run($root, $db, $config, $model, 'cycleBackup');
        cycleAssert(!$next['success'] && ($next['error'] ?? '') === 'catalog_recovery_required'
            && !empty($next['maintenance_held']) && !empty($next['recovery_required']) && !$model->calls
            && is_file($markerPath) && $db->maintenance[0]['value'] === '1',
            'The next cycle must hold an interrupted owned import for review instead of reporting a successful maintenance skip.');
    } finally { cycleCleanup($root); }
}
echo "Catalog cycles: preview/backup/apply ordering, locks, maintenance recovery, partial safety and verified retention passed.\n";
