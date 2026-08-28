<?php

if (PHP_SAPI !== 'cli') {
	http_response_code(404);
	exit(1);
}

$enqueue = in_array('--enqueue', $argv, true);
$limit = 100;
foreach ($argv as $argument) {
	if (preg_match('/^--limit=([0-9]+)$/D', $argument, $matches)) {
		$limit = max(1, min(1000, (int)$matches[1]));
	}
}

require dirname(__DIR__) . '/upload/config.php';
require_once DIR_SYSTEM . 'engine/registry.php';
require_once DIR_SYSTEM . 'engine/model.php';
require_once dirname(__DIR__) . '/upload/catalog/model/extension/module/qiqo_order_outbox.php';
require_once DIR_SYSTEM . 'library/qiqo/order_export_lock.php';

class QiqoReconcileDbResult {
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

class QiqoReconcileDb {
	private $connection;
	private $affected = 0;

	public function __construct(mysqli $connection) {
		$this->connection = $connection;
	}

	public function query($sql) {
		$result = $this->connection->query($sql);
		if ($result === false) {
			throw new RuntimeException('Reconciliation SQL failed: ' . $this->connection->error);
		}
		$this->affected = $this->connection->affected_rows;

		return new QiqoReconcileDbResult($result);
	}

	public function escape($value) {
		return $this->connection->real_escape_string((string)$value);
	}

	public function countAffected() {
		return $this->affected;
	}
}

class QiqoReconcileConfig {
	private $values;

	public function __construct(array $values) {
		$this->values = $values;
	}

	public function get($key) {
		return array_key_exists($key, $this->values) ? $this->values[$key] : null;
	}
}

class QiqoReconcileLog {
	public function write($message) {
		fwrite(STDERR, preg_replace('/[\x00-\x1F\x7F]/', ' ', (string)$message) . PHP_EOL);
	}
}

function qiqoReconcileAcceptedIds($value) {
	$values = is_array($value) ? $value : preg_split('/\s*,\s*/', trim((string)$value), -1, PREG_SPLIT_NO_EMPTY);
	$ids = array();
	foreach ((array)$values as $candidate) {
		$candidate = trim((string)$candidate);
		if (preg_match('/^[1-9][0-9]*$/D', $candidate)) {
			$id = (int)$candidate;
			if ($id > 0) {
				$ids[$id] = $id;
			}
		}
	}

	return $ids ? array_values($ids) : array(1);
}

$connection = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE, (int)DB_PORT);
if ($connection->connect_errno) {
	fwrite(STDERR, "Local database connection failed.\n");
	exit(1);
}
$connection->set_charset('utf8mb4');

try {
	$settings = array();
	$result = $connection->query("SELECT `key`, `value`, `serialized` FROM `" . DB_PREFIX . "setting` WHERE store_id = 0");
	while ($result && $row = $result->fetch_assoc()) {
		$settings[$row['key']] = $row['serialized'] ? json_decode($row['value'], true) : $row['value'];
	}

	$start_at = isset($settings['qiqo_order_outbox_start_at']) ? trim((string)$settings['qiqo_order_outbox_start_at']) : '';
	$date = DateTime::createFromFormat('!Y-m-d H:i:s', $start_at);
	if (!$date || $date->format('Y-m-d H:i:s') !== $start_at) {
		throw new RuntimeException('qiqo_order_outbox_start_at nedostaje ili nije valjan; povijesne narudžbe neće se zahvaćati.');
	}

	$accepted_ids = qiqoReconcileAcceptedIds(isset($settings['qiqo_order_accepted_status_ids']) ? $settings['qiqo_order_accepted_status_ids'] : '1');
	$sql = "SELECT o.order_id
		FROM `" . DB_PREFIX . "order` o
		INNER JOIN `" . DB_PREFIX . "customer_qiqo_authorization` cqa ON cqa.customer_id = o.customer_id
		INNER JOIN `" . DB_PREFIX . "qiqo_partner` qp ON qp.partner_id = cqa.partner_id AND qp.active = '1'
		INNER JOIN `" . DB_PREFIX . "qiqo_delivery_place` qdp ON qdp.delivery_place_id = cqa.delivery_place_id AND qdp.partner_id = cqa.partner_id
		INNER JOIN `" . DB_PREFIX . "qiqo_sales_rep` qsr ON qsr.sales_rep_id = cqa.sales_rep_id AND qsr.active = '1'
		LEFT JOIN `" . DB_PREFIX . "qiqo_order_outbox` qo ON qo.order_id = o.order_id
		WHERE qo.outbox_id IS NULL
		  AND o.customer_id > 0
		  AND o.order_status_id IN (" . implode(',', $accepted_ids) . ")
		  AND o.date_added >= '" . $connection->real_escape_string($start_at) . "'
		ORDER BY o.order_id ASC
		LIMIT " . $limit;
	$missing = $connection->query($sql);
	if ($missing === false) {
		throw new RuntimeException('Reconciliation candidate query failed: ' . $connection->error);
	}
	$order_ids = array();
	while ($row = $missing->fetch_assoc()) {
		$order_ids[] = (int)$row['order_id'];
	}

	echo 'Missing eligible outbox rows since ' . $start_at . ': ' . count($order_ids) . PHP_EOL;
	if (!$order_ids) {
		exit(0);
	}
	echo 'Order IDs: ' . implode(', ', $order_ids) . PHP_EOL;
	if (!$enqueue) {
		echo "Dry run only. Re-run with --enqueue after reviewing the IDs.\n";
		exit(2);
	}

	$db = new QiqoReconcileDb($connection);
	$registry = new Registry();
	$registry->set('db', $db);
	$registry->set('config', new QiqoReconcileConfig($settings));
	$registry->set('log', new QiqoReconcileLog());
	$model = new ModelExtensionModuleQiqoOrderOutbox($registry);
	$failed = 0;

	foreach ($order_ids as $order_id) {
		if (!QiqoOrderExportLock::acquire($db, $order_id, 5)) {
			fwrite(STDERR, 'Order #' . $order_id . ": busy; skipped.\n");
			$failed++;
			continue;
		}

		try {
			$outbox_id = $model->enqueueOrder($order_id);
			if (!$outbox_id) {
				fwrite(STDERR, 'Order #' . $order_id . ": no outbox row created.\n");
				$failed++;
				continue;
			}
			$status = $connection->query("SELECT status FROM `" . DB_PREFIX . "qiqo_order_outbox` WHERE outbox_id = '" . (int)$outbox_id . "'")->fetch_assoc();
			echo 'Order #' . $order_id . ' -> outbox #' . (int)$outbox_id . ' (' . ($status ? $status['status'] : 'unknown') . ')' . PHP_EOL;
		} finally {
			QiqoOrderExportLock::release($db, $order_id);
		}
	}

	exit($failed ? 1 : 0);
} catch (Throwable $e) {
	fwrite(STDERR, $e->getMessage() . PHP_EOL);
	exit(1);
} finally {
	$connection->close();
}
