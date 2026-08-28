<?php

if (PHP_SAPI !== 'cli') {
	http_response_code(404);
	exit(1);
}

require __DIR__ . '/../upload/config.php';
require_once DIR_SYSTEM . 'engine/registry.php';
require_once DIR_SYSTEM . 'engine/model.php';
require_once __DIR__ . '/../upload/catalog/model/extension/module/qiqo_order_outbox.php';

function lifecycleAssert($condition, $message) {
	if (!$condition) {
		throw new RuntimeException($message);
	}
}

class QiqoLifecycleDbResult {
	public $num_rows = 0;
	public $row = array();
	public $rows = array();

	public function __construct($result) {
		if ($result instanceof mysqli_result) {
			while ($item = $result->fetch_assoc()) {
				$this->rows[] = $item;
			}
			$result->free();
			$this->num_rows = count($this->rows);
			$this->row = $this->num_rows ? $this->rows[0] : array();
		}
	}
}

class QiqoLifecycleDb {
	private $connection;
	private $affected = 0;
	public $beforeQuery;

	public function __construct(mysqli $connection) {
		$this->connection = $connection;
	}

	public function query($sql) {
		if (is_callable($this->beforeQuery)) {
			$callback = $this->beforeQuery;
			$callback($sql, $this);
		}
		$result = $this->connection->query($sql);
		if ($result === false) {
			throw new RuntimeException('Lifecycle SQL failed: ' . $this->connection->error);
		}
		$this->affected = $this->connection->affected_rows;
		return new QiqoLifecycleDbResult($result);
	}

	public function escape($value) {
		return $this->connection->real_escape_string((string)$value);
	}

	public function countAffected() {
		return $this->affected;
	}
}

class QiqoLifecycleConfig {
	public $acceptedStatusIds = '1';
	public function get($key) {
		$values = array(
			'qiqo_order_accepted_status_ids' => $this->acceptedStatusIds,
			'qiqo_order_price_mode' => 'erp_display'
		);
		return isset($values[$key]) ? $values[$key] : null;
	}
}

class QiqoLifecycleLog {
	public function write($message) {}
}

$connection = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE, (int)DB_PORT);
if ($connection->connect_errno) {
	throw new RuntimeException('Local database connection failed.');
}
$connection->set_charset('utf8mb4');
$connection->begin_transaction();
$originalOrderStatus = null;

try {
	$order = $connection->query("SELECT order_status_id FROM oc_order WHERE order_id = 19 LIMIT 1")->fetch_assoc();
	lifecycleAssert($order && (int)$order['order_status_id'] === 1, 'Production-dump test order #19 is missing or not accepted.');
	$originalOrderStatus = (int)$order['order_status_id'];

	$connection->query("DELETE FROM oc_qiqo_order_outbox WHERE order_id = 19");
	$oldPayload = '{\"narudzba\":{\"napomena\":\"stale\",\"stavke\":[]}}';
	$connection->query("INSERT INTO oc_qiqo_order_outbox SET
		order_id = 19, order_status_id = 1, payload_json = '" . $connection->real_escape_string($oldPayload) . "',
		payload_hash = '" . hash('sha256', $oldPayload) . "', status = 'pending',
		date_added = NOW(), date_modified = NOW()");

	$registry = new Registry();
	$lifecycleDb = new QiqoLifecycleDb($connection);
	$registry->set('db', $lifecycleDb);
	$config = new QiqoLifecycleConfig();
	$registry->set('config', $config);
	$registry->set('log', new QiqoLifecycleLog());
	$model = new ModelExtensionModuleQiqoOrderOutbox($registry);

	$config->acceptedStatusIds = 'false,0,-1';
	$connection->query("UPDATE oc_order SET order_status_id = 0 WHERE order_id = 19");
	$model->enqueueOrder(19);
	$cancelled = $connection->query("SELECT status FROM oc_qiqo_order_outbox WHERE order_id = 19")->fetch_assoc();
	lifecycleAssert($cancelled['status'] === 'cancelled', 'Leaving an accepted status must invalidate an unsent payload.');

	$config->acceptedStatusIds = '1';
	$connection->query("UPDATE oc_order SET order_status_id = 1 WHERE order_id = 19");
	$model->enqueueOrder(19);
	$rebuilt = $connection->query("SELECT status, payload_json, payload_hash FROM oc_qiqo_order_outbox WHERE order_id = 19")->fetch_assoc();
	lifecycleAssert($rebuilt['status'] === 'pending', 'Returning to an accepted status must rebuild the cancelled snapshot.');
	lifecycleAssert($rebuilt['payload_json'] !== $oldPayload, 'Rebuilt snapshot must not retain stale order contents.');
	lifecycleAssert(hash_equals($rebuilt['payload_hash'], hash('sha256', $rebuilt['payload_json'])), 'Rebuilt payload hash is invalid.');

	// Reproduce a stale cancellation read racing with a concurrent re-accept.
	// The guarded UPDATE must observe the current accepted status and preserve
	// the pending export instead of cancelling it from the stale initial read.
	$connection->query("UPDATE oc_order SET order_status_id = 0 WHERE order_id = 19");
	$raceConnection = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE, (int)DB_PORT);
	lifecycleAssert(!$raceConnection->connect_errno, 'Could not open the lifecycle race connection.');
	$raceConnection->set_charset('utf8mb4');
	$lifecycleDb->beforeQuery = function ($sql, $dbWrapper) use ($raceConnection) {
		if (strpos($sql, "SET status = 'cancelled'") !== false) {
			$dbWrapper->beforeQuery = null;
			$raceConnection->query("UPDATE oc_order SET order_status_id = 1 WHERE order_id = 19");
		}
	};
	$model->enqueueOrder(19);
	$raceConnection->close();
	$raceResult = $connection->query("SELECT status FROM oc_qiqo_order_outbox WHERE order_id = 19")->fetch_assoc();
	lifecycleAssert($raceResult['status'] === 'pending', 'A stale cancellation read must not cancel a concurrently re-accepted order.');

	echo "QIQO outbox lifecycle tests passed.\n";
} finally {
	// Production dump uses MyISAM for orders, so transaction rollback alone does
	// not restore this fixture if an assertion fails midway through the test.
	if ($originalOrderStatus !== null) {
		$connection->query("UPDATE oc_order SET order_status_id = '" . (int)$originalOrderStatus . "' WHERE order_id = 19");
	}
	$connection->rollback();
	$connection->close();
}
