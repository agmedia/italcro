<?php

// Installs only the explicitly marked native catalog job. The five EasyCron jobs stay separate.
if (PHP_SAPI !== 'cli') { http_response_code(404); exit(1); }

function qiqoCatalogCronLine(string $php, string $root): string
{
    foreach ([$php, $root] as $path) {
        if ($path === '' || $path[0] !== '/' || preg_match('/[\x00-\x1F\x7F%]/', $path)) {
            throw new RuntimeException('Cron paths must be absolute and contain no control characters or percent signs.');
        }
    }
    return '52 * * * * ' . escapeshellarg($php) . ' ' . escapeshellarg($root . '/scripts/run_qiqo_catalog_cycle.php')
        . ' >> ' . escapeshellarg($root . '/.qiqo-private/cron/catalog-cycle.log')
        . ' 2>&1 # italcro-qiqo-catalog-managed';
}

function qiqoCatalogCronPlan(string $current, string $managedLine): array
{
    if (strpos($current, "\0") !== false) throw new RuntimeException('Existing crontab is invalid.');
    $segments = preg_split('/(?<=\n)/', $current, -1, PREG_SPLIT_NO_EMPTY);
    $managed = [];
    foreach ($segments as $index => $segment) {
        $line = rtrim($segment, "\r\n");
        if (strpos($line, 'italcro-qiqo-catalog-managed') !== false) {
            if (!preg_match('/\s+# italcro-qiqo-catalog-managed\s*$/D', $line)
                || !preg_match('/^\s*[0-9*\/,\-]+\s+[0-9*\/,\-]+\s+[0-9*\/,\-]+\s+[0-9*\/,\-]+\s+[0-9*\/,\-]+\s+\S/', $line)
                || strpos($line, 'run_qiqo_catalog_cycle.php') === false) {
                throw new RuntimeException('An existing catalog marker is ambiguous.');
            }
            $managed[] = $index;
        } elseif (substr(ltrim($line), 0, 1) !== '#' && strpos($line, 'run_qiqo_catalog_cycle.php') !== false) {
            throw new RuntimeException('An unmanaged catalog job already exists; refusing to create a duplicate.');
        }
    }
    if (count($managed) > 1) throw new RuntimeException('Multiple managed catalog jobs exist; refusing an ambiguous update.');
    if ($managed) {
        $segments[$managed[0]] = $managedLine . "\n";
        $updated = implode('', $segments);
    } else {
        $updated = $current . ($current !== '' && substr($current, -1) !== "\n" ? "\n" : '') . $managedLine . "\n";
    }
    return ['contents' => $updated, 'changed' => $updated !== $current, 'managed_entries' => 1,
        'preserved_lines' => count($segments) - count($managed)];
}

function qiqoCatalogCronProcess(array $command, string $input = ''): array
{
    $process = proc_open($command, [0 => ['pipe', 'r'], 1 => ['pipe', 'w'], 2 => ['pipe', 'w']], $pipes,
        null, null, ['bypass_shell' => true]);
    if (!is_resource($process)) throw new RuntimeException('Cannot start crontab.');
    $offset = 0;
    while ($offset < strlen($input)) {
        $written = fwrite($pipes[0], substr($input, $offset));
        if ($written === false || $written === 0) {
            fclose($pipes[0]); fclose($pipes[1]); fclose($pipes[2]); proc_close($process);
            throw new RuntimeException('Cannot provide the updated crontab.');
        }
        $offset += $written;
    }
    fclose($pipes[0]);
    $stdout = stream_get_contents($pipes[1]); fclose($pipes[1]);
    $stderr = stream_get_contents($pipes[2]); fclose($pipes[2]);
    return ['exit' => proc_close($process), 'stdout' => $stdout, 'stderr' => $stderr];
}

function qiqoCatalogCronRead(): string
{
    $read = qiqoCatalogCronProcess(['crontab', '-l']);
    if ($read['exit'] === 0) return $read['stdout'];
    if ($read['exit'] === 1 && $read['stdout'] === '' && preg_match('/no crontab/i', $read['stderr'])) return '';
    throw new RuntimeException('Cannot read the existing crontab.');
}

// Pure planning tests load the functions without reading or changing the user's crontab.
if (defined('QIQO_CATALOG_CRON_LIBRARY_ONLY')) return;

$apply = false;
foreach (array_slice($argv, 1) as $argument) {
    if ($argument === '--apply' && !$apply) $apply = true;
    elseif ($argument === '--help') {
        echo "Usage: php scripts/configure_qiqo_catalog_cron.php [--apply]\n";
        echo "Default previews one managed hourly catalog job at minute 52; --apply preserves all other crontab entries and saves a private backup.\n";
        exit(0);
    } else { fwrite(STDERR, "Unknown or duplicate option. Use --help.\n"); exit(2); }
}

umask(0077);
$lock = null;
$backup = null;
try {
    $root = realpath(dirname(__DIR__));
    $php = realpath(PHP_BINARY);
    if (!$root || !$php || !is_executable($php) || !is_file($root . '/scripts/run_qiqo_catalog_cycle.php')) {
        throw new RuntimeException('The PHP runtime or catalog runner is unavailable.');
    }
    $line = qiqoCatalogCronLine($php, $root);
    $current = qiqoCatalogCronRead();
    $plan = qiqoCatalogCronPlan($current, $line);
    if ($apply) {
        foreach ([$root . '/.qiqo-private', $root . '/.qiqo-private/cron'] as $directory) {
            if (is_link($directory) || (!is_dir($directory) && !mkdir($directory, 0700))
                || realpath($directory) !== $directory || !chmod($directory, 0700)) {
                throw new RuntimeException('Cannot protect the cron configuration directory.');
            }
        }
        $directory = $root . '/.qiqo-private/cron';
        if (is_link($directory . '/crontab-configure.lock')) throw new RuntimeException('Invalid cron configuration lock.');
        $lock = fopen($directory . '/crontab-configure.lock', 'c');
        if (!$lock || !flock($lock, LOCK_EX)) throw new RuntimeException('Cannot lock cron configuration.');
        chmod($directory . '/crontab-configure.lock', 0600);
        $current = qiqoCatalogCronRead();
        $plan = qiqoCatalogCronPlan($current, $line);
        if ($plan['changed']) {
            $backup = $directory . '/crontab-before-' . gmdate('Ymd\THis\Z') . '-' . bin2hex(random_bytes(6)) . '.txt';
            $file = fopen($backup, 'xb');
            if (!$file || !chmod($backup, 0600)) throw new RuntimeException('Cannot create a private crontab backup.');
            try {
                if (fwrite($file, $current) !== strlen($current) || !fflush($file)) throw new RuntimeException('Cannot finish the crontab backup.');
            } finally { fclose($file); }
            $log = $directory . '/catalog-cycle.log';
            if (is_link($log) || (file_exists($log) && !is_file($log))) throw new RuntimeException('Invalid catalog log path.');
            $file = fopen($log, 'a');
            if (!$file || !chmod($log, 0600)) throw new RuntimeException('Cannot protect the catalog cron log.');
            fclose($file);
            if (qiqoCatalogCronRead() !== $current) throw new RuntimeException('Crontab changed during preparation; no update applied.');
            $write = qiqoCatalogCronProcess(['crontab', '-'], $plan['contents']);
            if ($write['exit'] !== 0) throw new RuntimeException('Crontab installation failed; the previous backup is retained.');
            if (qiqoCatalogCronRead() !== $plan['contents']) throw new RuntimeException('Installed crontab verification failed; inspect the private backup.');
        }
    }
    echo json_encode(['success' => true, 'dry_run' => !$apply, 'changed' => $plan['changed'], 'managed_line' => $line,
        'managed_entries' => $plan['managed_entries'], 'preserved_lines' => $plan['preserved_lines'], 'backup' => $backup], JSON_UNESCAPED_SLASHES) . PHP_EOL;
} catch (Throwable $error) {
    // Crontab stdout/stderr may contain unrelated URLs or access keys; never echo them.
    echo json_encode(['success' => false, 'error' => $error->getMessage(), 'backup' => $backup], JSON_UNESCAPED_SLASHES) . PHP_EOL;
    exit(1);
} finally {
    if (is_resource($lock)) { flock($lock, LOCK_UN); fclose($lock); }
}
