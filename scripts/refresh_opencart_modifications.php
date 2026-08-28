<?php

if (PHP_SAPI !== 'cli') {
	http_response_code(404);
	exit(1);
}

$projectRoot = dirname(__DIR__);
chdir($projectRoot . '/upload/admin');
require 'config.php';
require DIR_SYSTEM . 'startup.php';

class ItalcroCliUser {
	public function hasPermission($type, $route) {
		return true;
	}
}

class ItalcroCliDocument {
	public function setTitle($title) {}
}

class ItalcroCliRedirect extends RuntimeException {}

class ItalcroCliResponse {
	public function redirect($url, $status = 302) {
		throw new ItalcroCliRedirect($url, $status);
	}
}

function italcroRemoveRefreshTree($path, $expectedParent) {
	$expectedParent = realpath($expectedParent);
	$parent = realpath(dirname($path));

	if (!$expectedParent || !$parent || $parent !== $expectedParent || strpos(basename($path), 'modification.refresh-') !== 0) {
		throw new RuntimeException('Refusing to remove an unexpected refresh path.');
	}

	if (!file_exists($path)) {
		return;
	}

	$iterator = new RecursiveIteratorIterator(
		new RecursiveDirectoryIterator($path, FilesystemIterator::SKIP_DOTS),
		RecursiveIteratorIterator::CHILD_FIRST
	);

	foreach ($iterator as $item) {
		if ($item->isLink() || $item->isFile()) {
			if (!unlink($item->getPathname())) {
				throw new RuntimeException('Unable to remove refresh file: ' . $item->getPathname());
			}
		} elseif (!rmdir($item->getPathname())) {
			throw new RuntimeException('Unable to remove refresh directory: ' . $item->getPathname());
		}
	}

	if (!rmdir($path)) {
		throw new RuntimeException('Unable to remove refresh directory: ' . $path);
	}
}

$registry = new Registry();
$config = new Config();
$config->load('default');
$config->load('admin');
$db = new DB(DB_DRIVER, DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);
$maintenanceQuery = $db->query("SELECT setting_id, value, serialized FROM " . DB_PREFIX . "setting WHERE store_id = '0' AND `code` = 'config' AND `key` = 'config_maintenance' ORDER BY setting_id ASC");

if (!$maintenanceQuery->num_rows) {
	fwrite(STDERR, "Missing config_maintenance setting; refresh aborted.\n");
	exit(1);
}

$maintenanceRows = $maintenanceQuery->rows;
$maintenance = false;

foreach ($maintenanceRows as $maintenanceRow) {
	if ((string)$maintenanceRow['value'] === '1') {
		$maintenance = true;
	}
}

$config->set('config_maintenance', $maintenance);
$registry->set('config', $config);
$registry->set('db', $db);
$registry->set('event', new Event($registry));
$registry->set('language', new Language('hr-hr'));
$registry->set('document', new ItalcroCliDocument());
$registry->set('request', new Request());
$registry->set('response', new ItalcroCliResponse());
$registry->set('url', new Url(HTTP_SERVER, HTTPS_SERVER));
$registry->set('user', new ItalcroCliUser());
$registry->set('session', (object)array('data' => array('user_token' => 'cli')));
$registry->set('load', new Loader($registry));

require_once DIR_APPLICATION . 'controller/marketplace/modification.php';
$controller = new ControllerMarketplaceModification($registry);
$modificationDirectory = rtrim(DIR_MODIFICATION, '/\\');
$modificationParent = dirname($modificationDirectory);
$storageDirectory = realpath(DIR_STORAGE);
$resolvedModificationParent = realpath($modificationParent);

if (!$storageDirectory || !$resolvedModificationParent || $storageDirectory !== $resolvedModificationParent || basename($modificationDirectory) !== 'modification' || !is_dir($modificationDirectory) || is_link($modificationDirectory)) {
	fwrite(STDERR, "Unexpected modification directory; refresh aborted.\n");
	exit(1);
}

$refreshId = getmypid() . '-' . bin2hex(random_bytes(6));
$backupDirectory = $modificationParent . '/modification.refresh-backup-' . $refreshId;
$partialDirectory = $modificationParent . '/modification.refresh-partial-' . $refreshId;
$refreshSucceeded = false;
$refreshPrepared = false;
$failure = null;

try {
	$db->query("UPDATE " . DB_PREFIX . "setting SET `value` = '1', serialized = '0' WHERE store_id = '0' AND `code` = 'config' AND `key` = 'config_maintenance'");

	if (!rename($modificationDirectory, $backupDirectory)) {
		throw new RuntimeException('Unable to create the modification rollback directory.');
	}

	if (!mkdir($modificationDirectory, 0777, true)) {
		rename($backupDirectory, $modificationDirectory);
		throw new RuntimeException('Unable to create a fresh modification directory.');
	}

	$refreshPrepared = true;

	if (is_file($backupDirectory . '/index.html')) {
		copy($backupDirectory . '/index.html', $modificationDirectory . '/index.html');
	}

	$controller->refresh(array('redirect' => 'common/dashboard'));
} catch (ItalcroCliRedirect $redirect) {
	$refreshSucceeded = true;
} catch (Throwable $throwable) {
	$failure = $throwable;
} finally {
	foreach ($maintenanceRows as $maintenanceRow) {
		$db->query("UPDATE " . DB_PREFIX . "setting SET `value` = '" . $db->escape($maintenanceRow['value']) . "', serialized = '" . (int)$maintenanceRow['serialized'] . "' WHERE setting_id = '" . (int)$maintenanceRow['setting_id'] . "'");
	}

	if ($refreshPrepared && !$refreshSucceeded) {
		if (is_dir($modificationDirectory)) {
			if (!rename($modificationDirectory, $partialDirectory)) {
				$failure = $failure ?: new RuntimeException('Unable to quarantine the partial modification directory.');
			}
		}

		if (!is_dir($modificationDirectory) && is_dir($backupDirectory) && !rename($backupDirectory, $modificationDirectory)) {
			$failure = $failure ?: new RuntimeException('Unable to restore the previous modification directory.');
		}

		if (is_dir($partialDirectory)) {
			italcroRemoveRefreshTree($partialDirectory, $modificationParent);
		}
	}
}

if (!$refreshSucceeded) {
	fwrite(STDERR, "OpenCart modification refresh failed" . ($failure ? ': ' . $failure->getMessage() : '') . ".\n");
	exit(1);
}

italcroRemoveRefreshTree($backupDirectory, $modificationParent);
echo "OpenCart modifications refreshed; maintenance state restored.\n";
exit(0);
