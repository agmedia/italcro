<?php

define('DB_PREFIX', 'oc_');
require_once __DIR__ . '/../upload/system/library/qiqo/order_payload.php';
require_once __DIR__ . '/../upload/system/library/qiqo/order_sender.php';

function assertOrderSame($expected, $actual, $message) {
	if ($expected !== $actual) {
		throw new RuntimeException($message . ': expected ' . var_export($expected, true) . ', got ' . var_export($actual, true));
	}
}

function assertOrderClose($expected, $actual, $message) {
	if (abs((float)$expected - (float)$actual) > 0.000001) {
		throw new RuntimeException($message . ': expected ' . $expected . ', got ' . $actual);
	}
}

class QiqoTestResult {
	public $num_rows;
	public $row;
	public $rows;
	public function __construct(array $rows) {
		$this->rows = $rows;
		$this->row = isset($rows[0]) ? $rows[0] : array();
		$this->num_rows = count($rows);
	}
}

class QiqoTestDb {
	public $salesRepCode = '137';
	public function query($sql) {
		if (strpos($sql, 'FROM `oc_order`') !== false) {
			return new QiqoTestResult(array(array(
				'order_id' => 42,
				'customer_id' => 103,
				'order_status_id' => 1,
				'currency_code' => 'EUR',
				'total' => '11.32',
				'comment' => 'Testna napomena'
			)));
		}
		if (strpos($sql, 'customer_qiqo_authorization') !== false) {
			return new QiqoTestResult(array(array(
				'partner_id' => 1020054,
				'delivery_place_id' => 311,
				'sales_rep_id' => 63,
				'partner_name' => 'Partner',
				'delivery_place_code' => '0079',
				'sales_rep_code' => $this->salesRepCode
			)));
		}
		if (strpos($sql, 'FROM `oc_order_product`') !== false) {
			return new QiqoTestResult(array(
				array('order_product_id' => 1, 'product_id' => 10, 'quantity' => '1000.0000', 'price' => '0.0083', 'total' => '8.3210', 'article_code' => '507817', 'cent' => 'C-100'),
				array('order_product_id' => 2, 'product_id' => 11, 'quantity' => '2.0000', 'price' => '1.5000', 'total' => '3.0000', 'article_code' => 'ABC-2', 'cent' => '')
			));
		}
		throw new RuntimeException('Unexpected query in payload test: ' . $sql);
	}
}

class QiqoTestConfig {
	public function get($key) {
		return $key === 'qiqo_order_price_mode' ? 'erp_display' : null;
	}
}

class QiqoTestRegistry {
	private $values;
	public function __construct($db, $config) {
		$this->values = array('db' => $db, 'config' => $config);
	}
	public function get($key) {
		return $this->values[$key];
	}
}

class QiqoTestOrderSender extends QiqoOrderSender {
	public function interpret($response, $username = 'user', $password = 'pass') {
		return $this->interpretSuccessResponse(200, $response, $username, $password);
	}
	public function classifyHttpFailure($status) {
		return $this->classifyHttpFailureState($status);
	}
}

$db = new QiqoTestDb();
$builder = new QiqoOrderPayload(new QiqoTestRegistry($db, new QiqoTestConfig()));
$result = $builder->build(42);
$order = $result['payload']['narudzba'];

assertOrderSame(1020054, $order['partner'], 'Partner code should be numeric');
assertOrderSame(137, $order['komercijalist'], 'Sales representative code should be numeric');
assertOrderSame('0079', $order['lokacija'], 'Delivery place must preserve leading zeroes');
assertOrderClose(0.8321, $order['stavke'][0]['cijena'], 'C-100 price must be restored to ERP per-100 basis');
assertOrderClose(1.5, $order['stavke'][1]['cijena'], 'Regular article price must remain per unit');
assertOrderSame('507817', $order['stavke'][0]['artikal'], 'SKU snapshot');
assertOrderSame('Testna napomena', $order['napomena'], 'Order note snapshot');
assertOrderSame(false, strpos($result['payload_json'], 'korisnik') !== false, 'Persisted payload must not contain a username');
assertOrderSame(false, strpos($result['payload_json'], 'lozinka') !== false, 'Persisted payload must not contain a password');

$db->salesRepCode = '';
try {
	$builder->build(42);
	throw new RuntimeException('Missing sales representative should block the payload.');
} catch (RuntimeException $e) {
	assertOrderSame(true, strpos($e->getMessage(), 'komercijalist') !== false, 'Missing sales representative validation');
}

$sender = new QiqoOrderSender();
$invalidEndpoint = $sender->send('file:///tmp/not-allowed', 'user', 'pass', $result['payload']);
assertOrderSame('failed', $invalidEndpoint['state'], 'Only HTTP(S) endpoints are allowed');
assertOrderSame('CONFIG_ENDPOINT', $invalidEndpoint['error_code'], 'Invalid endpoint error code');

$missingCredentials = $sender->send('http://127.0.0.1/', '', '', $result['payload']);
assertOrderSame('failed', $missingCredentials['state'], 'Missing credentials must fail before network I/O');
assertOrderSame('CONFIG_CREDENTIALS', $missingCredentials['error_code'], 'Missing credentials error code');

$testSender = new QiqoTestOrderSender();
foreach (array(null, '', 'OK', '0abc', 0.5) as $malformedCode) {
	$malformed = $testSender->interpret(json_encode(array('ErrorCode' => $malformedCode, 'ErrorDescription' => 'invalid')));
	assertOrderSame('uncertain', $malformed['state'], 'Malformed ErrorCode must never be accepted as sent');
}
$validZero = $testSender->interpret('{"ErrorCode":0,"ErrorDescription":"OK"}');
assertOrderSame('sent', $validZero['state'], 'Integer ErrorCode zero must be accepted');
$validFailure = $testSender->interpret('{"ErrorCode":7,"ErrorDescription":"Rejected"}');
assertOrderSame('failed', $validFailure['state'], 'Non-zero integer ErrorCode must be a confirmed failure');
foreach (array(301, 302, 307, 308, 408, 409, 425, 429, 500, 503) as $ambiguousStatus) {
	assertOrderSame('uncertain', $testSender->classifyHttpFailure($ambiguousStatus), 'Ambiguous HTTP status must require ERP verification');
}
assertOrderSame('failed', $testSender->classifyHttpFailure(400), 'Ordinary client rejection can be retried as a confirmed failure');
assertOrderSame('failed', $testSender->classifyHttpFailure(404), 'Not-found response is a confirmed failure');

$secret = 'p"ass\\word';
$echoedSecret = json_encode(array('ErrorCode' => 7, 'ErrorDescription' => $secret, 'echo' => $secret));
$redacted = $testSender->interpret($echoedSecret, 'user', $secret);
assertOrderSame(false, strpos($redacted['response'], $secret) !== false, 'Raw secret must be redacted from stored ERP response');
assertOrderSame(false, strpos($redacted['description'], $secret) !== false, 'Secret must be redacted from ERP description');
assertOrderSame(false, strpos($redacted['response'], 'echo') !== false, 'Unvalidated ERP fields must not be persisted');

echo "QIQO order payload tests passed.\n";
