<?php

if (PHP_SAPI !== 'cli') {
	http_response_code(404);
	exit(1);
}

if ($argc < 2) {
	fwrite(STDERR, "Usage: php scripts/run_sql_migration.php <migration.sql> [migration.sql ...]\n");
	exit(2);
}

$projectRoot = dirname(__DIR__);
require $projectRoot . '/upload/config.php';

$db = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE, (int)DB_PORT);
if ($db->connect_errno) {
	fwrite(STDERR, "Database connection failed.\n");
	exit(1);
}
$db->set_charset('utf8mb4');

for ($argument = 1; $argument < $argc; $argument++) {
	$path = realpath($argv[$argument]);
	if (!$path || pathinfo($path, PATHINFO_EXTENSION) !== 'sql' || strpos($path, $projectRoot . DIRECTORY_SEPARATOR) !== 0) {
		fwrite(STDERR, "Invalid migration path: " . $argv[$argument] . "\n");
		exit(2);
	}

	$sql = file_get_contents($path);
	if ($sql === false) {
		fwrite(STDERR, "Cannot read migration: " . basename($path) . "\n");
		exit(2);
	}

	$delimiter = ';';
	$statement = '';
	$statementCount = 0;
	$lines = preg_split('/\R/', $sql);

	foreach ($lines as $lineNumber => $line) {
		$trimmed = trim($line);
		if (preg_match('/^DELIMITER\s+(\S+)$/i', $trimmed, $matches)) {
			$delimiter = $matches[1];
			continue;
		}
		if ($trimmed === '' || strpos($trimmed, '--') === 0) {
			continue;
		}

		// Migration files in this project use SQL line comments, including after a
		// completed statement. Remove those comments before delimiter detection.
		$line = preg_replace('/\s+--.*$/', '', $line);
		$statement .= $line . "\n";
		$check = rtrim($statement);
		if (substr($check, -strlen($delimiter)) !== $delimiter) {
			continue;
		}

		$statement = substr($check, 0, -strlen($delimiter));
		if (trim($statement) !== '') {
			$result = $db->query($statement);
			if ($result === false) {
				fwrite(STDERR, basename($path) . ':' . ($lineNumber + 1) . ' failed: ' . $db->error . "\n");
				exit(1);
			}
			if ($result instanceof mysqli_result) {
				$result->free();
			}
			$statementCount++;
		}
		$statement = '';
	}

	if (trim($statement) !== '') {
		fwrite(STDERR, basename($path) . ": unterminated SQL statement.\n");
		exit(1);
	}

	echo basename($path) . ': OK (' . $statementCount . " statements)\n";
}

$db->close();
