<?php

if (PHP_SAPI !== 'cli') {
	http_response_code(404);
	exit(1);
}

require __DIR__ . '/../upload/config.php';

function rev31MigrationAssert($condition, $message) {
	if (!$condition) {
		throw new RuntimeException($message);
	}
}

$db = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE, (int)DB_PORT);
if ($db->connect_errno) {
	throw new RuntimeException('Local database connection failed.');
}
$db->set_charset('utf8mb4');

$fixtureOrderIds = array(
	'pending_v1' => 2147483601,
	'failed_v1' => 2147483602,
	'verified_v1' => 2147483603,
	'rebuilding_v1' => 2147483604,
	'sent_v1' => 2147483605,
	'uncertain_v1' => 2147483606,
	'processing_v1' => 2147483607,
	'pending_v2' => 2147483608
);
$originalInitialComplete = null;
$setting = $db->query("SELECT value FROM oc_setting WHERE store_id = 0 AND `key` = 'qiqo_partner_article_initial_complete' ORDER BY setting_id DESC LIMIT 1");
if ($setting && $setting->num_rows) {
	$originalInitialComplete = (string)$setting->fetch_assoc()['value'];
}

try {
	$db->query("DELETE FROM oc_qiqo_order_outbox WHERE order_id IN (" . implode(',', $fixtureOrderIds) . ")");
	foreach ($fixtureOrderIds as $name => $orderId) {
		$status = strstr($name, '_', true);
		if ($name === 'verified_v1') {
			$status = 'verified_not_sent';
		}
		$version = substr($name, -2) === 'v2' ? 2 : 1;
		$payload = '{"fixture":"' . $name . '"}';
		$db->query("INSERT INTO oc_qiqo_order_outbox SET
			order_id = '" . (int)$orderId . "', order_status_id = 1,
			payload_json = '" . $db->real_escape_string($payload) . "',
			payload_hash = '" . hash('sha256', $payload) . "',
			payload_contract_version = '" . $version . "', status = '" . $db->real_escape_string($status) . "',
			date_added = NOW(), date_modified = NOW()");
	}

	// Prove that an already verified initial import is never reset by a repeated
	// migration. The test restores the local value in finally.
	$db->query("UPDATE oc_setting SET value = '1' WHERE store_id = 0 AND `key` = 'qiqo_partner_article_initial_complete'");

	$migration = realpath(__DIR__ . '/../upload/migration/2026-10-06_rev31_api_contract.sql');
	$runner = realpath(__DIR__ . '/../scripts/run_sql_migration.php');
	$command = escapeshellarg(PHP_BINARY) . ' -d error_reporting=' . escapeshellarg('E_ALL & ~E_DEPRECATED')
		. ' ' . escapeshellarg($runner) . ' ' . escapeshellarg($migration);
	for ($run = 1; $run <= 2; $run++) {
		passthru($command, $exitCode);
		rev31MigrationAssert($exitCode === 0, 'Rev3.1 migration run ' . $run . ' failed.');
	}

	$expected = array(
		'pending_v1' => 'blocked',
		'failed_v1' => 'blocked',
		'verified_v1' => 'blocked',
		'rebuilding_v1' => 'blocked',
		'sent_v1' => 'sent',
		'uncertain_v1' => 'uncertain',
		'processing_v1' => 'processing',
		'pending_v2' => 'pending'
	);
	foreach ($fixtureOrderIds as $name => $orderId) {
		$row = $db->query("SELECT status, payload_contract_version FROM oc_qiqo_order_outbox WHERE order_id = '" . (int)$orderId . "'")->fetch_assoc();
		rev31MigrationAssert($row && $row['status'] === $expected[$name], 'Unexpected migrated status for ' . $name . '.');
		rev31MigrationAssert((int)$row['payload_contract_version'] === (substr($name, -2) === 'v2' ? 2 : 1), 'Migration changed the payload version for ' . $name . '.');
	}

	$sendSetting = $db->query("SELECT COUNT(*) AS total, MIN(value) AS min_value, MAX(value) AS max_value
		FROM oc_setting WHERE store_id = 0 AND `key` = 'qiqo_order_send_enabled'")->fetch_assoc();
	rev31MigrationAssert((int)$sendSetting['total'] === 1 && $sendSetting['min_value'] === '0' && $sendSetting['max_value'] === '0', 'Send gate is not uniquely disabled.');

	$initialSetting = $db->query("SELECT COUNT(*) AS total, MIN(value) AS min_value, MAX(value) AS max_value
		FROM oc_setting WHERE store_id = 0 AND `key` = 'qiqo_partner_article_initial_complete'")->fetch_assoc();
	rev31MigrationAssert((int)$initialSetting['total'] === 1 && $initialSetting['min_value'] === '1' && $initialSetting['max_value'] === '1', 'Repeated migration reset the verified initial-import gate.');

	echo "QIQO Rev3.1 migration tests passed.\n";
} finally {
	$db->query("DELETE FROM oc_qiqo_order_outbox WHERE order_id IN (" . implode(',', $fixtureOrderIds) . ")");
	if ($originalInitialComplete !== null) {
		$db->query("UPDATE oc_setting SET value = '" . $db->real_escape_string($originalInitialComplete) . "' WHERE store_id = 0 AND `key` = 'qiqo_partner_article_initial_complete'");
	}
	$db->close();
}
