<?php

if (PHP_SAPI !== 'cli') {
	http_response_code(404);
	exit(1);
}

require __DIR__ . '/../upload/config.php';
require_once DIR_SYSTEM . 'engine/registry.php';
require_once DIR_SYSTEM . 'engine/model.php';
require_once __DIR__ . '/../upload/admin/model/extension/module/qiqo_order_outbox.php';

function contractGateAssert($condition, $message) {
	if (!$condition) {
		throw new RuntimeException($message);
	}
}

class QiqoContractGateDbResult {
	public $num_rows = 0;
	public $row = array();
	public $rows = array();

	public function __construct($result) {
		if ($result instanceof mysqli_result) {
			while ($row = $result->fetch_assoc()) {
				$this->rows[] = $row;
			}
			$result->free();
			$this->num_rows = count($this->rows);
			$this->row = $this->num_rows ? $this->rows[0] : array();
		}
	}
}

class QiqoContractGateDb {
	private $connection;
	private $affected = 0;

	public function __construct(mysqli $connection) {
		$this->connection = $connection;
	}

	public function query($sql) {
		$result = $this->connection->query($sql);
		if ($result === false) {
			throw new RuntimeException('Contract-gate SQL failed: ' . $this->connection->error);
		}
		$this->affected = $this->connection->affected_rows;
		return new QiqoContractGateDbResult($result);
	}

	public function escape($value) {
		return $this->connection->real_escape_string((string)$value);
	}

	public function countAffected() {
		return $this->affected;
	}
}

class QiqoContractGateConfig {
	public function get($key) {
		$values = array(
			'qiqo_order_send_enabled' => '1',
			'qiqo_order_allow_insecure_http' => '0',
			'qiqo_order_endpoint' => 'https://127.0.0.1:1/this-must-never-be-contacted',
			'qiqo_order_accepted_status_ids' => '1'
		);
		return isset($values[$key]) ? $values[$key] : null;
	}
}

class QiqoContractGateLog {
	public function write($message) {}
}

$connection = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE, (int)DB_PORT);
if ($connection->connect_errno) {
	throw new RuntimeException('Local database connection failed.');
}
$connection->set_charset('utf8mb4');
$orderId = 19;
$originalUsername = getenv('QIQO_ORDER_USERNAME');
$originalPassword = getenv('QIQO_ORDER_PASSWORD');

try {
	$order = $connection->query("SELECT order_status_id FROM oc_order WHERE order_id = '" . $orderId . "' LIMIT 1")->fetch_assoc();
	contractGateAssert($order && (int)$order['order_status_id'] === 1, 'Production-dump order #19 is missing or not accepted.');
	$existing = $connection->query("SELECT outbox_id FROM oc_qiqo_order_outbox WHERE order_id = '" . $orderId . "' LIMIT 1");
	contractGateAssert($existing && $existing->num_rows === 0, 'Outbox fixture order #19 is already in use; refusing to overwrite it.');

	$payload = '{"narudzba":{"fixture":"legacy-v1"}}';
	$connection->query("INSERT INTO oc_qiqo_order_outbox SET
		order_id = '" . $orderId . "', order_status_id = 1,
		payload_json = '" . $connection->real_escape_string($payload) . "',
		payload_hash = '" . hash('sha256', $payload) . "', payload_contract_version = 1,
		status = 'pending', attempts = 0, date_added = NOW(), date_modified = NOW()");
	$outboxId = (int)$connection->insert_id;
	contractGateAssert($outboxId > 0, 'Could not create the legacy outbox fixture.');

	putenv('QIQO_ORDER_USERNAME=contract-gate-test');
	putenv('QIQO_ORDER_PASSWORD=contract-gate-test');

	$registry = new Registry();
	$registry->set('db', new QiqoContractGateDb($connection));
	$registry->set('config', new QiqoContractGateConfig());
	$registry->set('log', new QiqoContractGateLog());
	$model = new ModelExtensionModuleQiqoOrderOutbox($registry);

	try {
		$model->send($outboxId);
		throw new RuntimeException('Legacy v1 payload unexpectedly passed the send gate.');
	} catch (RuntimeException $error) {
		contractGateAssert(strpos($error->getMessage(), 'starom API ugovoru') !== false, 'Legacy payload was not rejected by the contract-version gate.');
	}

	$row = $connection->query("SELECT status, attempts, locked_at, last_error_code
		FROM oc_qiqo_order_outbox WHERE outbox_id = '" . $outboxId . "'")->fetch_assoc();
	contractGateAssert($row['status'] === 'blocked', 'Legacy payload was not left blocked.');
	contractGateAssert((int)$row['attempts'] === 0, 'Legacy payload reached a network-attempt path.');
	contractGateAssert($row['locked_at'] === null, 'Legacy payload retained a processing lock.');
	contractGateAssert($row['last_error_code'] === 'PAYLOAD_CONTRACT_MISMATCH', 'Legacy payload has the wrong block reason.');

	echo "QIQO outbox contract gate tests passed.\n";
} finally {
	$connection->query("DELETE FROM oc_qiqo_order_outbox WHERE order_id = '" . $orderId . "'");
	if ($originalUsername === false) {
		putenv('QIQO_ORDER_USERNAME');
	} else {
		putenv('QIQO_ORDER_USERNAME=' . $originalUsername);
	}
	if ($originalPassword === false) {
		putenv('QIQO_ORDER_PASSWORD');
	} else {
		putenv('QIQO_ORDER_PASSWORD=' . $originalPassword);
	}
	$connection->close();
}
