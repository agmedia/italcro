<?php

if (PHP_SAPI !== 'cli') {
	http_response_code(404);
	exit(1);
}

function qiqoBackupHelp() {
	echo "Usage: php scripts/backup_qiqo_database.php --output-dir=/absolute/private/directory [--apply] [--table-locks]\n";
	echo "Without --apply, performs a read-only preflight and creates no files.\n";
	echo "--apply requires OpenCart maintenance mode to already be enabled.\n";
	echo "Creates a full SQL database dump with a global read lock (including MyISAM),\n";
	echo "checks the dump completion marker, and writes a SHA-256 checksum.\n";
	echo "--table-locks explicitly holds READ locks on every base table in this database\n";
	echo "using a dedicated connection, instead of requiring a global read lock.\n";
	echo "The output directory must be outside the web document root and private (0700).\n";
	echo "Credentials are read from upload/config.php, never from command arguments.\n";
}

function qiqoBackupDirectory($path) {
	if ($path === '' || $path[0] !== '/' || strpos($path, "\0") !== false || preg_match('#(?:^|/)\.\.?(?:/|$)#', $path)) {
		throw new RuntimeException('Output directory must be an absolute path without . or .. components.');
	}
	$path = rtrim($path, '/');
	$missing = array();
	$parent = $path === '' ? '/' : $path;
	while (!file_exists($parent) && !is_link($parent)) {
		array_unshift($missing, basename($parent));
		$parent = dirname($parent);
	}
	$resolved = realpath($parent);
	if ($resolved === false || !is_dir($resolved)) {
		throw new RuntimeException('Output directory has an invalid parent directory.');
	}
	$base = rtrim($resolved, '/');
	return $missing ? $base . '/' . implode('/', $missing) : ($base === '' ? '/' : $base);
}

function qiqoBackupIsWithin($path, $root) {
	return $path === $root || strpos($path, rtrim($root, '/') . '/') === 0;
}

function qiqoBackupExecutable() {
	foreach (array('mysqldump', 'mariadb-dump') as $name) {
		foreach (explode(PATH_SEPARATOR, (string)getenv('PATH')) as $directory) {
			if ($directory === '' || $directory[0] !== '/') {
				continue;
			}
			$path = $directory . '/' . $name;
			if (is_file($path) && is_executable($path)) {
				return realpath($path);
			}
		}
	}
	throw new RuntimeException('mysqldump or mariadb-dump is required on PATH.');
}

function qiqoBackupOptionValue($value) {
	$value = (string)$value;
	if (strpos($value, "\0") !== false) {
		throw new RuntimeException('Database configuration contains an unsupported value.');
	}
	return '"' . str_replace(array('\\', '"', "\n", "\r", "\t"), array('\\\\', '\\"', '\\n', '\\r', '\\t'), $value) . '"';
}

function qiqoBackupWritePrivateFile($path, $contents) {
	$file = @fopen($path, 'xb');
	if ($file === false) {
		throw new RuntimeException('Cannot create a private backup file.');
	}
	try {
		if (!chmod($path, 0600)) {
			throw new RuntimeException('Cannot protect the backup file permissions.');
		}
		$length = strlen($contents);
		$written = 0;
		while ($written < $length) {
			$bytes = fwrite($file, substr($contents, $written));
			if ($bytes === false || $bytes === 0) {
				throw new RuntimeException('Cannot finish writing a private backup file.');
			}
			$written += $bytes;
		}
		if (!fflush($file)) {
			throw new RuntimeException('Cannot flush a private backup file.');
		}
	} finally {
		fclose($file);
	}
}

function qiqoBackupConfirmedEmptyObjects($db, $type) {
	$schema = $db->real_escape_string(DB_DATABASE);
	$sql = $type === 'routines'
		? "SELECT COUNT(*) AS total FROM information_schema.ROUTINES WHERE ROUTINE_SCHEMA = '" . $schema . "'"
		: "SELECT COUNT(*) AS total FROM information_schema.EVENTS WHERE EVENT_SCHEMA = '" . $schema . "'";
	$result = $db->query($sql);
	if ($result === false || (int)$result->fetch_assoc()['total'] !== 0) {
		return false;
	}
	// Empty metadata alone is insufficient: privilege filtering can hide objects.
	$grants = $db->query('SHOW GRANTS FOR CURRENT_USER()');
	if ($grants === false) {
		return false;
	}
	while ($grant = $grants->fetch_row()) {
		if (!preg_match('/^GRANT (.+) ON (.+?) TO /i', $grant[0], $match)) {
			continue;
		}
		$scope = str_replace(array('`', '\\_', '\\%'), array('', '_', '%'), $match[2]);
		if ($scope !== '*.*' && $scope !== DB_DATABASE . '.*') {
			continue;
		}
		$privileges = array_map('trim', explode(',', strtoupper($match[1])));
		if (in_array('ALL PRIVILEGES', $privileges, true)
			|| ($type === 'events' && in_array('EVENT', $privileges, true))
			|| ($type === 'routines' && (in_array('EXECUTE', $privileges, true) || in_array('ALTER ROUTINE', $privileges, true) || in_array('CREATE ROUTINE', $privileges, true) || ($scope === '*.*' && in_array('SHOW_ROUTINE', $privileges, true))))) {
			return true;
		}
	}
	return false;
}

$secretDirectory = null;
$optionPath = null;
$process = null;
$partialPath = null;
$completedPath = null;
$lockDb = null;
$lockConnectionId = null;
$cleanup = function () use (&$secretDirectory, &$optionPath, &$process, &$lockDb) {
	if (is_resource($process)) {
		@proc_terminate($process);
		@proc_close($process);
		$process = null;
	}
	if ($lockDb instanceof mysqli) {
		@$lockDb->query('UNLOCK TABLES');
		@$lockDb->close();
		$lockDb = null;
	}
	if ($optionPath !== null && is_file($optionPath)) {
		@unlink($optionPath);
	}
	if ($secretDirectory !== null && is_dir($secretDirectory)) {
		@rmdir($secretDirectory);
	}
	return ($optionPath === null || !file_exists($optionPath)) && ($secretDirectory === null || !file_exists($secretDirectory));
};
register_shutdown_function($cleanup);

if (function_exists('pcntl_async_signals') && function_exists('pcntl_signal')) {
	pcntl_async_signals(true);
	foreach (array(SIGINT, SIGTERM) as $signal) {
		pcntl_signal($signal, function ($received) use ($cleanup) {
			if (!$cleanup()) {
				fwrite(STDERR, "Unable to remove protected temporary database options.\n");
			}
			fwrite(STDERR, "Backup interrupted; any SQL output remains marked .partial.\n");
			exit(128 + $received);
		});
	}
}

try {
	$outputArgument = null;
	$apply = false;
	$tableLocks = false;
	for ($i = 1; $i < $argc; $i++) {
		$argument = $argv[$i];
		if ($argument === '--help' || $argument === '-h') {
			qiqoBackupHelp();
			exit(0);
		} elseif ($argument === '--apply') {
			$apply = true;
		} elseif ($argument === '--table-locks') {
			$tableLocks = true;
		} elseif ($argument === '--output-dir' && isset($argv[$i + 1])) {
			if ($outputArgument !== null) {
				throw new RuntimeException('Specify --output-dir only once.');
			}
			$outputArgument = $argv[++$i];
		} elseif (strpos($argument, '--output-dir=') === 0 && $outputArgument === null) {
			$outputArgument = substr($argument, strlen('--output-dir='));
		} else {
			throw new RuntimeException('Unknown or duplicate argument. Use --help for usage.');
		}
	}
	if ($outputArgument === null) {
		throw new RuntimeException('--output-dir is required. Use --help for usage.');
	}
	$outputDirectory = qiqoBackupDirectory($outputArgument);

	$projectRoot = dirname(__DIR__);
	require $projectRoot . '/upload/config.php';
	$documentRoots = array(realpath($projectRoot . '/upload'), realpath(dirname(rtrim(DIR_APPLICATION, '/\\'))));
	foreach ($documentRoots as $documentRoot) {
		if ($documentRoot !== false && qiqoBackupIsWithin($outputDirectory, $documentRoot)) {
			throw new RuntimeException('Refusing to store database backups inside the web document root.');
		}
	}
	if (is_dir($outputDirectory) && ((fileperms($outputDirectory) & 0077) !== 0 || !is_writable($outputDirectory))) {
		throw new RuntimeException('Existing output directory must be private (0700) and writable.');
	}
	if (is_dir($outputDirectory) && function_exists('posix_geteuid') && fileowner($outputDirectory) !== posix_geteuid()) {
		throw new RuntimeException('Existing output directory must belong to the current operating-system user.');
	}
	$executable = qiqoBackupExecutable();
	if (!function_exists('proc_open') || !extension_loaded('mysqli') || PHP_VERSION_ID < 70400) {
		throw new RuntimeException('PHP 7.4+, mysqli and proc_open are required.');
	}

	mysqli_report(MYSQLI_REPORT_OFF);
	$db = @new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE, (int)DB_PORT);
	if ($db->connect_errno || !$db->set_charset('utf8mb4')) {
		throw new RuntimeException('Database connection failed.');
	}
	$tablePrefix = str_replace('`', '``', DB_PREFIX);
	$maintenanceResult = $db->query("SELECT value, serialized FROM `" . $tablePrefix . "setting` WHERE store_id = 0 AND `code` = 'config' AND `key` = 'config_maintenance'");
	if ($maintenanceResult === false) {
		throw new RuntimeException('Cannot read the existing maintenance setting.');
	}
	$maintenance = $maintenanceResult->num_rows > 0;
	while ($setting = $maintenanceResult->fetch_assoc()) {
		$maintenance = $maintenance && (string)$setting['value'] === '1' && (string)$setting['serialized'] === '0';
	}
	$engineResult = $db->query("SELECT ENGINE, COUNT(*) AS total FROM information_schema.TABLES WHERE TABLE_SCHEMA = '" . $db->real_escape_string(DB_DATABASE) . "' AND TABLE_TYPE = 'BASE TABLE' GROUP BY ENGINE");
	if ($engineResult === false || $engineResult->num_rows === 0) {
		throw new RuntimeException('Cannot verify the database tables.');
	}
	$tableCount = 0;
	$nontransactionalCount = 0;
	while ($engine = $engineResult->fetch_assoc()) {
		$tableCount += (int)$engine['total'];
		if (strtoupper((string)$engine['ENGINE']) !== 'INNODB') {
			$nontransactionalCount += (int)$engine['total'];
		}
	}
	$skipRoutines = qiqoBackupConfirmedEmptyObjects($db, 'routines');
	$skipEvents = qiqoBackupConfirmedEmptyObjects($db, 'events');

	if (!$apply) {
		echo "Read-only preflight passed: " . $tableCount . " tables (" . $nontransactionalCount . " non-InnoDB); maintenance " . ($maintenance ? 'enabled' : 'disabled') . ".\n";
		echo "Output directory: " . $outputDirectory . "\n";
		echo 'Lock mode: ' . ($tableLocks ? 'dedicated database table READ locks' : 'global read lock') . ".\n";
		echo 'Routine/event objects: ' . ($skipRoutines ? 'no routines confirmed' : 'routines included') . '; ' . ($skipEvents ? 'no events confirmed' : 'events included') . ".\n";
		$db->close();
		echo "No files created. Use --apply after enabling maintenance mode to create the locked database backup.\n";
		exit(0);
	}
	if (!$maintenance) {
		throw new RuntimeException('OpenCart maintenance mode must already be enabled before --apply.');
	}
	if ($tableLocks) {
		$tablesResult = $db->query("SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_SCHEMA = '" . $db->real_escape_string(DB_DATABASE) . "' AND TABLE_TYPE = 'BASE TABLE' ORDER BY TABLE_NAME");
		if ($tablesResult === false || $tablesResult->num_rows !== $tableCount) {
			throw new RuntimeException('Cannot enumerate every base table for the explicit database READ locks.');
		}
		$lockNames = array();
		while ($table = $tablesResult->fetch_assoc()) {
			$lockNames[] = '`' . str_replace('`', '``', DB_DATABASE) . '`.`' . str_replace('`', '``', $table['TABLE_NAME']) . '` READ';
		}
		$lockDb = $db;
		$lockConnectionId = (int)$db->thread_id;
		if (!$lockNames || !$lockDb->query('LOCK TABLES ' . implode(', ', $lockNames))) {
			throw new RuntimeException('Cannot acquire READ locks on every database base table. Check database LOCK TABLES and SELECT privileges.');
		}
		echo 'Holding READ locks on ' . count($lockNames) . " base tables until the dump process finishes.\n";
	} else {
		$db->close();
	}

	umask(0077);
	if (!is_dir($outputDirectory) && !@mkdir($outputDirectory, 0700, true)) {
		throw new RuntimeException('Cannot create the private output directory.');
	}
	if (realpath($outputDirectory) !== $outputDirectory || (fileperms($outputDirectory) & 0077) !== 0) {
		throw new RuntimeException('Output directory changed or is not private; backup stopped.');
	}
	$runId = gmdate('Ymd\THis\Z') . '-' . bin2hex(random_bytes(6));
	$secretDirectory = $outputDirectory . '/.qiqo-backup-options-' . $runId;
	if (!mkdir($secretDirectory, 0700)) {
		throw new RuntimeException('Cannot create the protected temporary options directory.');
	}
	$optionPath = $secretDirectory . '/mysql.cnf';
	$options = "[client]\n";
	foreach (array('host' => DB_HOSTNAME, 'user' => DB_USERNAME, 'password' => DB_PASSWORD, 'port' => (int)DB_PORT) as $name => $value) {
		$options .= $name . '=' . qiqoBackupOptionValue($value) . "\n";
	}
	qiqoBackupWritePrivateFile($optionPath, $options);
	unset($options);

	$completedPath = $outputDirectory . '/qiqo-database-' . $runId . '.sql';
	$partialPath = $completedPath . '.partial';
	$dump = @fopen($partialPath, 'xb');
	if ($dump === false || !chmod($partialPath, 0600)) {
		throw new RuntimeException('Cannot create the protected SQL output file.');
	}
	$command = array($executable, '--defaults-extra-file=' . $optionPath, '--quick', '--skip-single-transaction', '--skip-force');
	$command[] = $tableLocks ? '--skip-lock-all-tables' : '--lock-all-tables';
	if ($tableLocks) {
		$command[] = '--skip-lock-tables';
	}
	$command[] = $skipRoutines ? '--skip-routines' : '--routines';
	$command[] = $skipEvents ? '--skip-events' : '--events';
	$command = array_merge($command, array('--triggers', '--hex-blob', '--no-tablespaces', '--default-character-set=utf8mb4', '--comments', '--dump-date', '--databases', DB_DATABASE));
	$descriptors = array(0 => array('pipe', 'r'), 1 => $dump, 2 => array('pipe', 'w'));
	$process = @proc_open($command, $descriptors, $pipes, null, null, array('bypass_shell' => true));
	if (!is_resource($process)) {
		fclose($dump);
		throw new RuntimeException('Cannot start the database dump process.');
	}
	fclose($pipes[0]);
	$stderr = '';
	while (!feof($pipes[2])) {
		$chunk = fread($pipes[2], 8192);
		if ($chunk === false) {
			break;
		}
		if (strlen($stderr) < 65536) {
			$stderr .= $chunk;
		}
	}
	fclose($pipes[2]);
	$exitCode = proc_close($process);
	$process = null;
	$flushed = fflush($dump);
	fclose($dump);
	if ($tableLocks) {
		$connectionCheck = $lockDb->query('SELECT CONNECTION_ID() AS id');
		if ($connectionCheck === false || (int)$connectionCheck->fetch_assoc()['id'] !== $lockConnectionId) {
			throw new RuntimeException('The dedicated table-lock connection was lost; the SQL dump remains partial.');
		}
	}
	if (!$cleanup()) {
		throw new RuntimeException('Cannot remove protected temporary database options; backup remains partial.');
	}
	if ($exitCode !== 0 || !$flushed) {
		$reason = preg_match('/access denied|permission denied/i', $stderr) ? ' Check database dump permissions.' : '';
		unset($stderr);
		throw new RuntimeException('Database dump failed (exit ' . $exitCode . ').' . $reason);
	}
	unset($stderr);

	$size = filesize($partialPath);
	$tail = fopen($partialPath, 'rb');
	if ($size === false || $size < 1 || $tail === false) {
		throw new RuntimeException('The SQL dump is empty or unreadable.');
	}
	fseek($tail, max(0, $size - 65536));
	$ending = stream_get_contents($tail);
	fclose($tail);
	if ($ending === false || !preg_match('/(?:^|\n)-- Dump completed on [^\r\n]+\s*$/D', $ending)) {
		throw new RuntimeException('The SQL dump is missing its final completion marker.');
	}
	$hash = hash_file('sha256', $partialPath);
	if ($hash === false) {
		throw new RuntimeException('Cannot calculate the SQL dump checksum.');
	}
	$checksumPath = $completedPath . '.sha256';
	qiqoBackupWritePrivateFile($checksumPath . '.partial', $hash . '  ' . basename($completedPath) . "\n");
	if (file_exists($completedPath) || file_exists($checksumPath) || !rename($partialPath, $completedPath) || !rename($checksumPath . '.partial', $checksumPath)) {
		throw new RuntimeException('Cannot finalize the SQL dump and checksum files.');
	}
	echo "Backup complete: " . $completedPath . " (" . $size . " bytes)\n";
	echo "SHA-256: " . $hash . "\n";
	echo "Checksum file: " . $checksumPath . "\n";
} catch (Throwable $error) {
	if (!$cleanup()) {
		fwrite(STDERR, "Unable to remove protected temporary database options.\n");
	}
	fwrite(STDERR, $error->getMessage() . "\n");
	if ($partialPath !== null && is_file($partialPath)) {
		fwrite(STDERR, 'Incomplete SQL retained at: ' . $partialPath . "\n");
	} elseif ($completedPath !== null && is_file($completedPath)) {
		fwrite(STDERR, 'SQL output retained at: ' . $completedPath . "\n");
	}
	exit(1);
}
