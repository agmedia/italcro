<?php

require_once __DIR__ . '/../upload/system/engine/registry.php';
require_once __DIR__ . '/../upload/system/engine/model.php';
define('DIR_STORAGE', __DIR__ . '/../storage/');
define('DIR_SYSTEM', __DIR__ . '/../upload/system/');
define('DB_PREFIX', 'test_');
class Log {
    public static $messages = [];
    public function __construct($file) {}
    public function write($message) { self::$messages[] = $message; }
}
require_once __DIR__ . '/../upload/admin/model/extension/module/qiqo.php';

function existingUpdateAssert($condition, $message) {
    if (!$condition) throw new RuntimeException($message);
}
function existingUpdateClose($expected, $actual, $message) {
    existingUpdateAssert(abs((float)$expected - (float)$actual) < 0.00000001, $message);
}
class ExistingUpdateFeed {
    public $rows = [];
    public $success = true;
    public $fail = false;
    public $calls = 0;
    public function getArticles($since = '-2 years') {
        $this->calls++;
        if ($this->fail) throw new RuntimeException('Injected transport failure.');
        return $this->rows;
    }
    public function getLastFetchResult() { return ['success' => $this->success]; }
}
class ExistingUpdateModel extends ModelExtensionModuleQiqo {
    public $feed;
    protected function createCatalogConnection() { return $this->feed; }
}
class ExistingUpdateCache {
    public $deleted = [];
    public function delete($prefix) { $this->deleted[] = $prefix; }
}
class ExistingUpdateDb {
    public $rows;
    public $queries = [];
    public $quantityType = 'int(11)';
    public $busy = false;
    public $updates = 0;
    public $failUpdate = 0;
    public function escape($value) { return addslashes((string)$value); }
    private function result($rows) {
        return (object)['num_rows' => count($rows), 'row' => $rows ? reset($rows) : [], 'rows' => array_values($rows)];
    }
    public function query($sql) {
        $this->queries[] = $sql;
        if (strpos($sql, 'GET_LOCK(') !== false) return $this->result([['acquired' => $this->busy ? 0 : 1]]);
        if (strpos($sql, 'RELEASE_LOCK(') !== false) return $this->result([['released' => 1]]);
        if (strpos($sql, 'SHOW COLUMNS') === 0) {
            return $this->result([['Field' => 'present', 'Type' => $this->quantityType]]);
        }
        if (preg_match('/^SELECT ([a-z_, ]+) FROM `test_product`$/', $sql, $matches)) {
            $fields = array_flip(explode(', ', $matches[1]));
            return $this->result(array_map(static function ($row) use ($fields) {
                return array_intersect_key($row, $fields);
            }, $this->rows));
        }
        if (preg_match('/^UPDATE `test_product` SET /', $sql)) {
            if (++$this->updates === $this->failUpdate) throw new RuntimeException('Injected write failure.');
            preg_match_all('/`?([a-z_]+)`?\s*=\s*\'((?:\\\\.|[^\'])*)\'/i', $sql, $matches, PREG_SET_ORDER);
            $values = [];
            foreach ($matches as $match) $values[$match[1]] = stripslashes($match[2]);
            $id = (int)$values['product_id'];
            unset($values['product_id']);
            $this->rows[$id] = array_merge($this->rows[$id], $values);
            return true;
        }
        throw new RuntimeException('Unexpected SQL in existing-product update: ' . $sql);
    }
    public function productReads() {
        return array_values(array_filter($this->queries, static function ($sql) {
            return strpos($sql, 'SELECT product_id, sku, ') === 0;
        }));
    }
    public function mutations() {
        return array_values(array_filter($this->queries, static function ($sql) {
            return preg_match('/^(?:INSERT|UPDATE|ALTER|DELETE|CREATE|DROP|TRUNCATE)\b/', $sql);
        }));
    }
}
function existingUpdateFixture($feedRows) {
    $registry = new Registry();
    $db = new ExistingUpdateDb();
    $row = ['product_id' => 1, 'sku' => '440700', 'quantity' => 2, 'minimum' => 1,
        'ean' => '', 'sort_order' => 99, 'pak' => 0, 'jm' => '', 'pakkol' => 0,
        'price' => 2, 'vpc' => 2, 'cent' => '', 'partner' => 20, 'status' => 1,
        'image' => 'local.jpg', 'date_added' => '2020-01-01', 'qiqo_introduced_at' => '2019-01-01'];
    $db->rows = [1 => $row, 2 => array_merge($row, ['product_id' => 2, 'sku' => 'LEGACY']),
        3 => array_merge($row, ['product_id' => 3, 'sku' => 'ABSENT-FROM-FEED'])];
    $registry->set('db', $db);
    $registry->set('cache', new ExistingUpdateCache());
    $model = new ExistingUpdateModel($registry);
    $model->feed = new ExistingUpdateFeed();
    $model->feed->rows = $feedRows;
    return [$model, $db, $registry->get('cache')];
}

$stock = ['id' => '440700', 'zaliha' => '2.7E1', 'pak' => '1', 'pakkol' => '12,34565',
    'jm' => 'KOM', 'sortkatalog' => '7', 'aktivan' => 'true'];
$legacy = array_merge($stock, ['id' => 'LEGACY', 'zaliha' => '-2.5', 'pak' => '12', 'pakkol' => '12']);
$missingStock = array_merge($stock, ['id' => 'NEW-SKU']);
list($model, $db, $cache) = existingUpdateFixture([$stock, $stock, $legacy, $missingStock]);
$before = $db->rows;
existingUpdateAssert($model->updateQuantities() === 2, 'Stock count must include only changed existing products.');
existingUpdateAssert(count($db->productReads()) === 1 && count($db->mutations()) === 2,
    'Stock must use one bulk product read and one write per changed product.');
existingUpdateClose(27, $db->rows[1]['quantity'], 'Scientific ERP stock must retain its value.');
existingUpdateClose(12.3457, $db->rows[1]['pakkol'], 'Pack size must match four-decimal storage.');
existingUpdateAssert((int)$db->rows[1]['minimum'] === 13 && $db->rows[1]['jm'] === 'KOM'
    && $db->rows[1]['ean'] === 'KOM', 'Stock must preserve established packaging and unit updates.');
existingUpdateClose(-3, $db->rows[2]['quantity'], 'Legacy integer stock must round negative ties away from zero.');
existingUpdateAssert((int)$db->rows[2]['pak'] === 12 && (int)$db->rows[2]['minimum'] === 1,
    'Legacy numeric pak values must not become a pack flag.');
existingUpdateAssert(count($db->rows) === 3 && $db->rows[3] === $before[3],
    'Stock must not add unknown SKUs or alter products absent from the feed.');
foreach (['price', 'vpc', 'cent', 'partner', 'status', 'image', 'date_added', 'qiqo_introduced_at'] as $field) {
    existingUpdateAssert($db->rows[1][$field] === $before[1][$field], 'Stock must preserve unrelated field ' . $field);
}
existingUpdateAssert($cache->deleted === ['product', 'megamenu'], 'Changed stock must invalidate catalog caches.');
$db->queries = [];
existingUpdateAssert($model->updateQuantities() === 0 && !$db->mutations() && count($db->productReads()) === 1,
    'Repeated stock sync must not rewrite products or their modification date.');
existingUpdateAssert($cache->deleted === ['product', 'megamenu'], 'Unchanged stock need not invalidate caches.');

list($model, $db) = existingUpdateFixture([array_merge($stock, ['zaliha' => '2.71236'])]);
$db->quantityType = 'decimal(15,4)';
existingUpdateAssert($model->updateQuantities() === 1, 'Decimal quantity storage must support stock updates.');
existingUpdateClose(2.7124, $db->rows[1]['quantity'], 'Stock must round to the declared decimal scale.');
$db->queries = [];
existingUpdateAssert($model->updateQuantities() === 0 && !$db->mutations(), 'Decimal stock rounding must be idempotent.');
list($model, $db) = existingUpdateFixture([array_merge($stock, ['zaliha' => '2.71236123'])]);
$db->quantityType = 'decimal(15,8)';
$db->rows[1] = array_merge($db->rows[1], ['quantity' => 2.71236122, 'minimum' => 13,
    'ean' => 'KOM', 'sort_order' => 7, 'pak' => 1, 'jm' => 'KOM', 'pakkol' => 12.3457]);
existingUpdateAssert($model->updateQuantities() === 1, 'A stock change at the declared decimal scale must not be suppressed.');
existingUpdateAssert($db->rows[1]['quantity'] === '2.71236123', 'Stock must retain the declared decimal precision.');
list($model, $db) = existingUpdateFixture([array_merge($stock, ['zaliha' => '2.6645352591003757E-15'])]);
existingUpdateAssert($model->updateQuantities() === 1 && (float)$db->rows[1]['quantity'] === 0.0,
    'ERP floating stock residue must normalize to zero.');

$c100 = ['id' => '440700', 'cijena' => '12.3456789', 'cent' => 'C100'];
$zeroPrice = ['id' => 'LEGACY', 'cijena' => '0', 'cent' => ''];
list($model, $db, $cache) = existingUpdateFixture([$c100, $c100, $zeroPrice,
    ['id' => 'NEW-SKU', 'cijena' => '99.99', 'cent' => '']]);
$before = $db->rows;
existingUpdateAssert($model->updatePrices() === 2, 'Price count must include only changed existing products.');
existingUpdateAssert(count($db->productReads()) === 1 && count($db->mutations()) === 2,
    'Prices must use one bulk product read and one write per changed product.');
existingUpdateClose(0.1234568, $db->rows[1]['price'], 'C-100 unit prices must retain seven-decimal rounding.');
existingUpdateClose(12.3456789, $db->rows[1]['vpc'], 'Original ERP VPC must be preserved separately.');
existingUpdateAssert($db->rows[1]['cent'] === 'C-100' && (float)$db->rows[2]['price'] === 0.0,
    'Cent aliases must normalize and a valid zero price must remain authoritative.');
existingUpdateAssert(count($db->rows) === 3 && $db->rows[3] === $before[3],
    'Prices must not add unknown SKUs or alter products absent from the feed.');
foreach (['quantity', 'minimum', 'ean', 'sort_order', 'pak', 'jm', 'pakkol', 'partner', 'status', 'image', 'date_added'] as $field) {
    existingUpdateAssert($db->rows[1][$field] === $before[1][$field], 'Prices must preserve unrelated field ' . $field);
}
existingUpdateAssert($cache->deleted === ['product', 'megamenu'], 'Changed prices must invalidate catalog caches.');
$db->queries = [];
existingUpdateAssert($model->updatePrices() === 0 && !$db->mutations() && count($db->productReads()) === 1,
    'Repeated price sync must not rewrite products or their modification date.');
existingUpdateAssert($cache->deleted === ['product', 'megamenu'], 'Unchanged prices need not invalidate caches.');
foreach ([['vpc' => 1], ['cent' => '']] as $difference) {
    list($model, $db) = existingUpdateFixture([$c100]);
    $db->rows[1] = array_merge($db->rows[1], ['price' => 0.1234568, 'vpc' => 12.3456789, 'cent' => 'C-100'], $difference);
    existingUpdateAssert($model->updatePrices() === 1, 'An independent VPC or cent change must also update pricing.');
}
list($model, $db) = existingUpdateFixture([['id' => '440700', 'cijena' => '12345678.1234567', 'cent' => '']]);
existingUpdateAssert($model->updatePrices() === 1 && $db->rows[1]['price'] === '12345678.1234567',
    'Fixed decimal SQL values must avoid losing large-price precision through PHP default float formatting.');
$db->queries = [];
existingUpdateAssert($model->updatePrices() === 0 && !$db->mutations(), 'Large decimal prices must remain idempotent.');

foreach (['updateQuantities' => [$stock, $legacy], 'updatePrices' => [$c100, $zeroPrice]] as $method => $validRows) {
    $bad = $method === 'updateQuantities' ? array_merge($legacy, ['zaliha' => 'NaN'])
        : array_merge($zeroPrice, ['cijena' => '']);
    list($model, $db, $cache) = existingUpdateFixture([$validRows[0], $bad]);
    existingUpdateAssert($model->$method() === -1 && !$db->mutations() && !$db->productReads() && !$cache->deleted,
        'An invalid tail row must reject the whole batch before reads or writes: ' . $method);
    $conflict = $method === 'updateQuantities' ? array_merge($validRows[0], ['zaliha' => '999'])
        : array_merge($validRows[0], ['cijena' => '999']);
    list($model, $db) = existingUpdateFixture([$validRows[0], $conflict]);
    existingUpdateAssert($model->$method() === -1 && !$db->mutations(), 'Conflicting duplicate SKUs must reject the batch: ' . $method);
    foreach (['success', 'fail'] as $failure) {
        list($model, $db) = existingUpdateFixture($validRows);
        $model->feed->$failure = $failure === 'fail';
        existingUpdateAssert($model->$method() === -1 && !$db->mutations() && !$db->productReads(),
            'Transport failure must preserve all products: ' . $method . ' ' . $failure);
    }
    list($model, $db) = existingUpdateFixture($validRows);
    $db->busy = true;
    existingUpdateAssert($model->$method() === -1 && !$db->mutations() && $model->feed->calls === 0,
        'Concurrent catalog writers must prevent even the ERP fetch: ' . $method);
    list($model, $db) = existingUpdateFixture([]);
    existingUpdateAssert($model->$method() === 0 && !$db->mutations() && !$db->productReads(),
        'A successful empty feed must preserve products without schema changes: ' . $method);
    list($model, $db, $cache) = existingUpdateFixture($validRows);
    $second = $db->rows[2];
    $db->failUpdate = 2;
    existingUpdateAssert($model->$method() === -1 && $db->rows[2] === $second,
        'A write failure must be reported without claiming success: ' . $method);
    existingUpdateAssert($cache->deleted === ['product', 'megamenu'],
        'Any writes persisted before a failure must also invalidate stale caches: ' . $method);
    existingUpdateAssert(strpos(end($db->queries), 'RELEASE_LOCK(') !== false,
        'The catalog lock must be released after a write failure: ' . $method);
}

echo "QIQO existing-product stock and price update tests passed.\n";
