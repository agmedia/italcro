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
	public $shippingCode = 'xshippingpro.xshippingpro1';
	public $productRows = array(
		array('order_product_id' => 1, 'product_id' => 10, 'quantity' => '1000.0000', 'price' => '0.0083', 'total' => '8.3210', 'article_code' => '507817', 'cent' => 'C-100'),
		array('order_product_id' => 2, 'product_id' => 11, 'quantity' => '2.0000', 'price' => '1.5000', 'total' => '3.0000', 'article_code' => 'ABC-2', 'cent' => '')
	);
	public $totalRows = array(
		array('code' => 'sub_total', 'total_value' => '11.3210'),
		array('code' => 'shipping', 'total_value' => '1.5000'),
		array('code' => 'tax', 'total_value' => '0.3750'),
		array('code' => 'total', 'total_value' => '13.1960')
	);
	public function query($sql) {
		if (strpos($sql, 'FROM `oc_order`') !== false) {
			return new QiqoTestResult(array(array(
				'order_id' => 42,
				'customer_id' => 103,
				'order_status_id' => 1,
				'currency_code' => 'EUR',
				'shipping_code' => $this->shippingCode,
				'total' => '13.1960',
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
			return new QiqoTestResult($this->productRows);
		}
		if (strpos($sql, 'FROM `oc_order_total`') !== false) {
			return new QiqoTestResult($this->totalRows);
		}
		throw new RuntimeException('Unexpected query in payload test: ' . $sql);
	}
}

class QiqoTestConfig {
	public $legacyPriceMode = 'per_piece';
	public function get($key) {
		if ($key === 'qiqo_order_price_mode') {
			return $this->legacyPriceMode;
		}
		if ($key === 'qiqo_order_pickup_location_code') {
			return '0001';
		}
		if ($key === 'qiqo_order_delivery_shipping_codes') {
			return 'xshippingpro.xshippingpro1';
		}
		return null;
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
assertOrderSame(2, $result['payload_contract_version'], 'Payload must use the confirmed contract version');
assertOrderClose(12.82, $order['ukupno'], 'Order total must be net item totals plus delivery, rounded to two decimals');
assertOrderClose(1000.0, $order['stavke'][0]['kolicina'], 'C-100 quantity must remain expressed in pieces');
assertOrderClose(0.8321, $order['stavke'][0]['cijena'], 'C-100 price must be restored to ERP per-100 basis');
assertOrderClose(1.5, $order['stavke'][1]['cijena'], 'Regular article price must remain per unit');
$recomputedItems = ($order['stavke'][0]['cijena'] / 100 * $order['stavke'][0]['kolicina'])
	+ ($order['stavke'][1]['cijena'] * $order['stavke'][1]['kolicina']);
assertOrderClose($order['ukupno'], round($recomputedItems + 1.5, 2), 'Header total must be reproducible from exported five-decimal prices');
assertOrderSame('507817', $order['stavke'][0]['artikal'], 'SKU snapshot');
assertOrderSame('Testna napomena', $order['napomena'], 'Order note snapshot');
assertOrderSame(false, strpos($result['payload_json'], 'korisnik') !== false, 'Persisted payload must not contain a username');
assertOrderSame(false, strpos($result['payload_json'], 'lozinka') !== false, 'Persisted payload must not contain a password');

$db->shippingCode = 'pickup.pickup';
$db->totalRows = array(
	array('code' => 'sub_total', 'total_value' => '11.3210'),
	array('code' => 'shipping', 'total_value' => '0.0000'),
	array('code' => 'tax', 'total_value' => '0.0000'),
	array('code' => 'total', 'total_value' => '11.3210')
);
$pickupResult = $builder->build(42);
assertOrderSame('0001', $pickupResult['payload']['narudzba']['lokacija'], 'Store pickup must use the ERP pickup location');
assertOrderClose(11.32, $pickupResult['payload']['narudzba']['ukupno'], 'Store pickup total must not add delivery');
$db->shippingCode = 'xshippingpro.xshippingpro1';
$db->totalRows = array(
	array('code' => 'sub_total', 'total_value' => '11.3210'),
	array('code' => 'shipping', 'total_value' => '1.5000'),
	array('code' => 'tax', 'total_value' => '0.3750'),
	array('code' => 'total', 'total_value' => '13.1960')
);

$db->totalRows[] = array('code' => 'coupon', 'total_value' => '-1.0000');
try {
	$builder->build(42);
	throw new RuntimeException('Unsupported non-zero total components must block the payload.');
} catch (RuntimeException $e) {
	assertOrderSame(true, strpos($e->getMessage(), 'nepodržanu total komponentu') !== false, 'Unsupported total validation');
}
array_pop($db->totalRows);

$validTotals = $db->totalRows;
$db->totalRows = array();
try {
	$builder->build(42);
	throw new RuntimeException('Missing order totals must block the payload.');
} catch (RuntimeException $e) {
	assertOrderSame(true, strpos($e->getMessage(), 'obavezne stavke') !== false, 'Missing order totals validation');
}

$db->totalRows = $validTotals;
unset($db->totalRows[1]);
$db->totalRows = array_values($db->totalRows);
try {
	$builder->build(42);
	throw new RuntimeException('Missing shipping total must block the payload.');
} catch (RuntimeException $e) {
	assertOrderSame(true, strpos($e->getMessage(), 'obavezne stavke') !== false, 'Missing shipping total validation');
}

$db->totalRows = $validTotals;
$db->totalRows[0]['total_value'] = '11.0000';
try {
	$builder->build(42);
	throw new RuntimeException('Mismatched subtotal must block the payload.');
} catch (RuntimeException $e) {
	assertOrderSame(true, strpos($e->getMessage(), 'ne odgovara zbroju stavki') !== false, 'Subtotal mismatch validation');
}

$db->totalRows = $validTotals;
$db->totalRows[3]['total_value'] = '99.0000';
try {
	$builder->build(42);
	throw new RuntimeException('Inconsistent grand total must block the payload.');
} catch (RuntimeException $e) {
	assertOrderSame(true, strpos($e->getMessage(), 'ne odgovara osnovici') !== false, 'Grand total integrity validation');
}

$db->totalRows = $validTotals;
$db->totalRows[1]['total_value'] = '-0.0100';
try {
	$builder->build(42);
	throw new RuntimeException('Negative shipping must block the payload.');
} catch (RuntimeException $e) {
	assertOrderSame(true, strpos($e->getMessage(), 'ne smije biti negativan') !== false, 'Negative delivery validation');
}

$originalProductRows = $db->productRows;
$db->productRows = array(
	array('order_product_id' => 1, 'product_id' => 10, 'quantity' => '100000.0000', 'price' => '0.1235', 'total' => '12345.6789', 'article_code' => 'ROUNDING', 'cent' => '')
);
$db->totalRows = array(
	array('code' => 'sub_total', 'total_value' => '12345.6789'),
	array('code' => 'shipping', 'total_value' => '0.0000'),
	array('code' => 'tax', 'total_value' => '0.0000'),
	array('code' => 'total', 'total_value' => '12345.6789')
);
try {
	$builder->build(42);
	throw new RuntimeException('Material five-decimal line drift must block the payload.');
} catch (RuntimeException $e) {
	assertOrderSame(true, strpos($e->getMessage(), 'pet decimala') !== false, 'Five-decimal line reconstruction validation');
}
$db->productRows = $originalProductRows;

$db->productRows = array(
	array('order_product_id' => 1, 'product_id' => 10, 'quantity' => '100000.0000', 'price' => '0.1235', 'total' => '12345.6789', 'article_code' => 'ROUND-UP', 'cent' => ''),
	array('order_product_id' => 2, 'product_id' => 11, 'quantity' => '100000.0000', 'price' => '0.1235', 'total' => '12345.3211', 'article_code' => 'ROUND-DOWN', 'cent' => '')
);
$db->totalRows = array(
	array('code' => 'sub_total', 'total_value' => '24691.0000'),
	array('code' => 'shipping', 'total_value' => '0.0000'),
	array('code' => 'tax', 'total_value' => '0.0000'),
	array('code' => 'total', 'total_value' => '24691.0000')
);
try {
	$builder->build(42);
	throw new RuntimeException('Opposite line-rounding errors must not cancel each other out.');
} catch (RuntimeException $e) {
	assertOrderSame(true, strpos($e->getMessage(), 'njezin neto iznos') !== false, 'Per-line five-decimal reconstruction validation');
}
$db->productRows = $originalProductRows;

$db->productRows = array(
	array('order_product_id' => 1, 'product_id' => 10, 'quantity' => '6.0000', 'price' => '0.2058', 'total' => '1.2350', 'article_code' => 'CENT-BOUNDARY', 'cent' => '')
);
$db->totalRows = array(
	array('code' => 'sub_total', 'total_value' => '1.2350'),
	array('code' => 'shipping', 'total_value' => '0.0000'),
	array('code' => 'tax', 'total_value' => '0.0000'),
	array('code' => 'total', 'total_value' => '1.2350')
);
try {
	$builder->build(42);
	throw new RuntimeException('Five-decimal drift across a cent boundary must block the payload.');
} catch (RuntimeException $e) {
	assertOrderSame(true, strpos($e->getMessage(), 'zaokruženi neto ukupni') !== false, 'Rounded header cent-boundary validation');
}
$db->productRows = $originalProductRows;

$db->shippingCode = 'pickup.pickup';
$db->totalRows = $validTotals;
try {
	$builder->build(42);
	throw new RuntimeException('Pickup with delivery fee must block the payload.');
} catch (RuntimeException $e) {
	assertOrderSame(true, strpos($e->getMessage(), 'ne smije sadržavati trošak dostave') !== false, 'Pickup delivery fee validation');
}
$db->shippingCode = 'xshippingpro.xshippingpro1';
$db->totalRows = $validTotals;

$db->shippingCode = 'unknown.unknown';
try {
	$builder->build(42);
	throw new RuntimeException('Unknown shipping methods must block the payload.');
} catch (RuntimeException $e) {
	assertOrderSame(true, strpos($e->getMessage(), 'nije odobren') !== false, 'Unknown shipping method validation');
}
$db->shippingCode = 'xshippingpro.xshippingpro1';

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
