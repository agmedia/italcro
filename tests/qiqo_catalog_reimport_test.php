<?php

require_once __DIR__ . '/../upload/system/engine/registry.php';
require_once __DIR__ . '/../upload/system/engine/model.php';
require_once __DIR__ . '/../upload/system/library/config.php';
define('DIR_STORAGE', __DIR__ . '/../storage/');
define('DIR_SYSTEM', __DIR__ . '/../upload/system/');
define('DB_PREFIX', 'test_');
class Log {
    public static $messages = [];
    public function __construct($file) {}
    public function write($message) { self::$messages[] = $message; }
}
function agconf($key, $default = null) {
    return $key === 'qiqo.categories' ? [10 => 'Test category'] : $default;
}
require_once __DIR__ . '/../upload/admin/model/extension/module/qiqo.php';

function catalogAssert($condition, $message) {
    if (!$condition) throw new RuntimeException($message);
}

class CatalogFeedStub {
    public $articles;
    public $groups;
    public $partners;
    public $success = true;
    public function getArticles($since = '-2 years') { return $this->articles; }
    public function getGroups($since = '-2 years') { return $this->groups; }
    public function getPartners($since = '-2 years') { return $this->partners; }
    public function getLastFetchResult() { return ['success' => $this->success]; }
}

class CatalogTestModel extends ModelExtensionModuleQiqo {
    public $feed;
    protected function createCatalogConnection() { return $this->feed; }
}

class CatalogCacheSpy {
    public $deleted = [];
    public $fail = false;
    public function delete($prefix) {
        if ($this->fail) throw new RuntimeException('Injected cache failure.');
        $this->deleted[] = $prefix;
    }
}

class CatalogDbStub {
    public $rows = [];
    public $queries = [];
    public $engine = 'InnoDB';
    public $quantityType = 'int(11)';
    public $duplicates = false;
    public $failDescription = false;
    public $busy = false;
    private $snapshot;
    private $lastId = 100;
    public function escape($value) { return addslashes((string)$value); }
    public function getLastId() { return $this->lastId; }
    private function result(array $rows) {
        return (object)['num_rows' => count($rows), 'row' => $rows ? reset($rows) : [], 'rows' => array_values($rows)];
    }
    private function assignments($sql) {
        preg_match_all('/`?([a-z_]+)`?\s*=\s*\'((?:\\\\.|[^\'])*)\'/i', $sql, $matches, PREG_SET_ORDER);
        $values = [];
        foreach ($matches as $match) $values[$match[1]] = stripslashes($match[2]);
        return $values;
    }
    public function query($sql) {
        $this->queries[] = $sql;
        if (strpos($sql, 'GET_LOCK(') !== false) return $this->result([['acquired' => $this->busy ? 0 : 1]]);
        if (strpos($sql, 'RELEASE_LOCK(') !== false) return $this->result([['released' => 1]]);
        if (strpos($sql, 'SHOW COLUMNS') === 0) {
            return $this->result([['Field' => 'present', 'Type' => strpos($sql, "LIKE 'quantity'") !== false ? $this->quantityType : 'varchar(64)']]);
        }
        if (strpos($sql, 'SHOW TABLE STATUS') === 0) {
            preg_match_all("/'(test_[a-z_]+)'/", $sql, $matches);
            $rows = [];
            foreach ($matches[1] as $name) $rows[] = ['Name' => $name, 'Engine' => $this->engine];
            return $this->result($rows);
        }
        if (strpos($sql, 'SELECT language_id') === 0) return $this->result([['language_id' => 3]]);
        if (strpos($sql, 'GROUP BY sku') !== false) return $this->result($this->duplicates ? [['sku' => '440700']] : []);
        if (strpos($sql, 'SELECT p.*') === 0) return $this->result($this->rows);
        if (strpos($sql, 'SELECT category_id') === 0) return $this->result([['category_id' => 20]]);
        if ($sql === 'START TRANSACTION') { $this->snapshot = $this->rows; return true; }
        if ($sql === 'ROLLBACK') { $this->rows = $this->snapshot; return true; }
        if ($sql === 'COMMIT') { $this->snapshot = null; return true; }
        if (preg_match('/^UPDATE `test_product` SET/', $sql)) {
            $values = $this->assignments($sql);
            $id = (int)$values['product_id'];
            unset($values['product_id']);
            $this->rows[$id] = array_merge($this->rows[$id], $values);
            return true;
        }
        if (preg_match('/^(UPDATE|INSERT INTO) `test_product_description`/', $sql)) {
            if ($this->failDescription) throw new RuntimeException('Injected description write failure.');
            $values = $this->assignments($sql);
            $id = (int)$values['product_id'];
            $values['description_product_id'] = $id;
            $this->rows[$id] = array_merge($this->rows[$id], $values);
            return true;
        }
        if (strpos($sql, 'INSERT INTO test_product SET') === 0) {
            $values = $this->assignments($sql);
            $id = ++$this->lastId;
            $this->rows[$id] = array_merge($values, ['product_id' => $id, 'description_product_id' => null]);
            return true;
        }
        if (strpos($sql, 'INSERT INTO test_product_description SET') === 0) {
            $values = $this->assignments($sql);
            $id = (int)$values['product_id'];
            $values['description_product_id'] = $id;
            $this->rows[$id] = array_merge($this->rows[$id], $values);
            return true;
        }
        if (strpos($sql, 'INSERT INTO test_product_to_') === 0) return true;
        throw new RuntimeException('Unexpected SQL in catalog test: ' . $sql);
    }
    public function mutationQueries() {
        return array_values(array_filter($this->queries, function ($sql) {
            return preg_match('/^(INSERT|UPDATE|DELETE|TRUNCATE|ALTER|CREATE|DROP)\b/', $sql);
        }));
    }
}

$article = ['id' => '440700', 'cijena' => '10.60', 'cent' => 'C-100',
    'kataloggrupa' => '10', 'gid' => '10', 'partner' => '20', 'barcode' => '123',
    'aktivan' => 'false', 'zaliha' => '0', 'pak' => '1', 'pakkol' => '12,5',
    'jm' => 'KOM', 'sortid' => '999', 'sortkatalog' => '7', 'dimmodel' => 'novi model',
    'opiskatalog' => "Opis 'artikla'"];
$groups = [['id' => '10', 'naziv' => 'Novi naziv', 'opis' => 'Opis grupe']];
$partners = [['id' => '20', 'naziv' => 'Partner']];
$normalized = QiqoSyncGuard::normalizeCatalogRows([$article], $groups, $partners);
catalogAssert($normalized['valid'], 'A complete ERP catalog row must be accepted.');
$expected = $normalized['rows'][0];
catalogAssert($expected['status'] === 0 && $expected['quantity'] === 0.0, 'ERP false and zero stock must remain authoritative.');
catalogAssert($expected['sort_order'] === 7 && $expected['minimum'] === 13, 'sortkatalog and decimal packaging must be normalized.');
catalogAssert(abs($expected['price'] - 0.106) < 0.00000001, 'C-100 price precision must survive the catalog import.');

$legacyPack = QiqoSyncGuard::normalizeArticleStockRows([array_merge($article,
    ['id' => '502287', 'pak' => '12', 'pakkol' => '12', 'jm' => 'KOM', 'sortkatalog' => '6', 'aktivan' => 'true'])]);
catalogAssert($legacyPack['valid'] && $legacyPack['rows'][0]['pak'] === 12 && $legacyPack['rows'][0]['minimum'] === 1,
    'Legacy numeric pak values must remain intact without enabling a different purchase constraint.');
foreach (['-1', '1.2', '128', '12oops', ''] as $badPak) {
    catalogAssert(!QiqoSyncGuard::normalizeArticleStockRows([array_merge($article, ['pak' => $badPak])])['valid'],
        'Malformed or out-of-range pak values must fail closed: ' . $badPak);
}

$residue = QiqoSyncGuard::normalizeArticleStockRows([array_merge($article,
    ['id' => '402577', 'zaliha' => '2.6645352591003757E-15', 'pak' => '1', 'pakkol' => '2.7',
        'jm' => 'MET', 'sortkatalog' => '3', 'aktivan' => 'true'])]);
catalogAssert($residue['valid'] && $residue['rows'][0]['quantity'] === 0.0,
    'The observed ERP scientific floating stock residue must normalize to zero.');
foreach (['-2.6645352591003757E-15', '1E-7', '-0.00000001'] as $tinyQuantity) {
    $stock = QiqoSyncGuard::normalizeArticleStockRows([array_merge($article, ['zaliha' => $tinyQuantity])]);
    catalogAssert($stock['valid'] && $stock['rows'][0]['quantity'] === 0.0, 'Tiny stock residue must normalize to zero.');
}
foreach (['2.7E1' => 27.0, '2E-7' => 0.0000002, '-1.5e2' => -150.0] as $rawQuantity => $quantity) {
    $stock = QiqoSyncGuard::normalizeArticleStockRows([array_merge($article, ['zaliha' => $rawQuantity])]);
    catalogAssert($stock['valid'] && $stock['rows'][0]['quantity'] === $quantity, 'Finite scientific quantities outside the residue threshold must remain intact.');
}
foreach (['2.6E', 'NaN', 'INF', '1E9999', '1E10', 'zero'] as $badQuantity) {
    $stock = QiqoSyncGuard::normalizeArticleStockRows([$article, array_merge($article, ['id' => 'BAD-STOCK', 'zaliha' => $badQuantity])]);
    catalogAssert(!$stock['valid'], 'Malformed, non-finite or out-of-range scientific stock must reject the batch: ' . $badQuantity);
}
catalogAssert(!QiqoSyncGuard::normalizeArticlePriceRows([['id' => 'PRICE', 'cijena' => '2.7E1']])['valid'],
    'Stock double compatibility must not relax the catalog price parser.');

$local = array_merge($expected, ['product_id' => 5965, 'partner' => 20, 'description_product_id' => 5965,
    'name' => '', 'name_add' => '', 'description' => 'stari opis', 'description_add' => '',
    'meta_title' => '', 'status' => 1, 'quantity' => 2, 'sort_order' => 999,
    'date_added' => '2020-01-01 00:00:00', 'qiqo_introduced_at' => '2019-11-02',
    'image' => 'catalog/local-photo.jpg', 'manufacturer_id' => 15]);
$unreturned = array_merge($local, ['product_id' => 22, 'sku' => 'NOT-IN-DELTA', 'status' => 1]);

function catalogFixture($article, $groups, $partners, $local, $unreturned) {
    $db = new CatalogDbStub();
    $db->rows = [5965 => $local, 22 => $unreturned];
    $registry = new Registry();
    $registry->set('db', $db);
    $registry->set('config', new Config());
    $registry->set('cache', new CatalogCacheSpy());
    $model = new CatalogTestModel($registry);
    $model->feed = new CatalogFeedStub();
    $model->feed->articles = [$article];
    $model->feed->groups = $groups;
    $model->feed->partners = $partners;
    return [$model, $db, $registry];
}

list($model, $db, $registry) = catalogFixture($article, $groups, $partners, $local, $unreturned);
$preview = $model->reconcileCatalog();
catalogAssert($preview['success'] && $preview['updated'] === 1 && $preview['disabled'] === 1, 'Dry run must report an existing SKU update and deactivation.');
catalogAssert(!$db->mutationQueries(), 'Dry run must not change data or schema.');
catalogAssert(!$registry->get('cache')->deleted, 'Dry run must not invalidate any cache.');
$result = $model->reconcileCatalog(true);
catalogAssert($result['success'] && $result['updated'] === 1 && $result['added'] === 0, 'Repeated import must update the existing product, not recreate it.');
catalogAssert($db->rows[5965]['name'] === 'Novi naziv' && $db->rows[5965]['name_add'] === 'novi model', 'Existing names and details must refresh.');
catalogAssert((int)$db->rows[5965]['status'] === 0 && (float)$db->rows[5965]['quantity'] === 0.0 && (int)$db->rows[5965]['sort_order'] === 7, 'Status, stock and ERP catalog order must refresh together.');
catalogAssert($db->rows[5965]['date_added'] === $local['date_added'] && $db->rows[5965]['qiqo_introduced_at'] === $local['qiqo_introduced_at'], 'Reimport must preserve both local creation and ERP introduction dates.');
catalogAssert($db->rows[5965]['image'] === $local['image'] && $db->rows[5965]['manufacturer_id'] === 15, 'Local photos and brands must be preserved.');
catalogAssert($db->rows[22] === $unreturned, 'A product absent from a delta must remain untouched.');
catalogAssert($registry->get('cache')->deleted === ['product', 'megamenu'], 'Applied imports must invalidate only the product and menu cache prefixes.');
$db->queries = [];
$second = $model->reconcileCatalog(true);
catalogAssert($second['success'] && $second['unchanged'] === 1 && !$db->mutationQueries(), 'An identical repeated import must be idempotent.');
catalogAssert($registry->get('cache')->deleted === ['product', 'megamenu', 'product', 'megamenu'], 'An applied unchanged catalog may refresh existing stale caches.');

list($model, $db, $registry) = catalogFixture($article, $groups, $partners, $local, $unreturned);
$registry->get('cache')->fail = true;
Log::$messages = [];
$result = $model->reconcileCatalog(true);
catalogAssert($result['success'] && !$result['partial'] && (int)$db->rows[5965]['status'] === 0, 'A cache failure must preserve the successful applied database result.');
catalogAssert((bool)array_filter(Log::$messages, function ($message) { return strpos($message, 'WARN catalog applied') !== false; }), 'A cache failure must emit a warning.');

foreach (['zaliha', 'sortkatalog', 'aktivan', 'cijena'] as $missing) {
    list($model, $db) = catalogFixture($article, $groups, $partners, $local, $unreturned);
    $badTail = array_merge($article, ['id' => 'BAD-TAIL']);
    unset($badTail[$missing]);
    $model->feed->articles[] = $badTail;
    $result = $model->reconcileCatalog(true);
    catalogAssert(!$result['success'] && !$db->mutationQueries(), 'A malformed tail row must prevent all catalog writes: ' . $missing);
}
list($model, $db) = catalogFixture($article, $groups, $partners, $local, $unreturned);
$model->feed->success = false;
catalogAssert(!$model->reconcileCatalog(true)['success'] && !$db->mutationQueries(), 'Failed transport must never mutate products.');
list($model, $db) = catalogFixture($article, [], $partners, $local, $unreturned);
catalogAssert(!$model->reconcileCatalog(true)['success'] && !$db->mutationQueries(), 'Missing group references must fail before writes.');
list($model, $db) = catalogFixture($article, $groups, $partners, $local, $unreturned);
$db->duplicates = true;
catalogAssert(!$model->reconcileCatalog(true)['success'] && !$db->mutationQueries(), 'Ambiguous local SKUs must not be updated arbitrarily.');
list($model, $db) = catalogFixture($article, $groups, $partners, $local, $unreturned);
$db->busy = true;
catalogAssert($model->reconcileCatalog(true)['error'] === 'sync_busy' && !$db->mutationQueries(), 'Concurrent catalog writers must be blocked.');
list($model, $db) = catalogFixture($article, $groups, $partners, $local, $unreturned);
$db->failDescription = true;
$result = $model->reconcileCatalog(true);
catalogAssert(!$result['success'] && !$result['partial'] && $db->rows[5965] === $local, 'An InnoDB write failure must roll back stock/status as well as details.');

list($model, $db, $registry) = catalogFixture($article, $groups, $partners, $local, $unreturned);
$db->engine = 'MyISAM';
catalogAssert($model->reconcileCatalog(true)['error'] === 'maintenance_backup_required' && !$db->mutationQueries(), 'MyISAM writes require explicit maintenance and backup.');
$backup = tempnam(sys_get_temp_dir(), 'qiqo-catalog-backup-test-');
file_put_contents($backup, '-- private test backup');
try {
    $options = ['allow_nontransactional' => true, 'backup_path' => $backup];
    catalogAssert(!$model->reconcileCatalog(true, '-2 years', $options)['success'], 'A backup cannot substitute for maintenance mode.');
    $registry->get('config')->set('config_maintenance', '1');
    $result = $model->reconcileCatalog(true, '-2 years', $options);
    catalogAssert($result['success'] && $result['backup_sha256'] === hash_file('sha256', $backup), 'Explicit backed-up maintenance apply must report its backup digest.');
} finally {
    unlink($backup);
}

list($model, $db) = catalogFixture(array_merge($article, ['id' => 'NEW-SKU', 'aktivan' => 'true']), $groups, $partners, $local, $unreturned);
$result = $model->reconcileCatalog(true);
catalogAssert($result['success'] && $result['added'] === 1 && isset($db->rows[101]), 'A new SKU must be added without changing existing product IDs.');
catalogAssert($db->rows[101]['name'] === 'Novi naziv' && $db->rows[101]['mpn'] === '10', 'New products must receive their group title and grouping reference.');

foreach (['2.5' => 3.0, '-2.5' => -3.0, '2.7' => 3.0] as $rawStock => $storedStock) {
    list($model, $db) = catalogFixture(array_merge($article, ['zaliha' => $rawStock, 'pakkol' => '12.34565']), $groups, $partners, $local, $unreturned);
    $result = $model->reconcileCatalog(true);
    catalogAssert($result['success'] && (float)$db->rows[5965]['quantity'] === $storedStock && (float)$db->rows[5965]['pakkol'] === 12.3457,
        'Applied values must match existing INT stock and four-decimal packaging storage.');
    $preview = $model->reconcileCatalog();
    catalogAssert($preview['success'] && $preview['updated'] === 0 && $preview['unchanged'] === 1,
        'Database rounding must not cause a perpetual catalog update.');
}
list($model, $db) = catalogFixture(array_merge($article, ['zaliha' => '2.71236']), $groups, $partners, $local, $unreturned);
$db->quantityType = 'decimal(15,4)';
catalogAssert($model->reconcileCatalog(true)['success'] && (float)$db->rows[5965]['quantity'] === 2.7124,
    'A decimal stock schema must retain its declared fractional precision.');
catalogAssert($model->reconcileCatalog()['updated'] === 0, 'Decimal stock rounding must also be idempotent.');

$unassigned = array_merge($article, ['kataloggrupa' => '0', 'partner' => '1615']);
$sentinel = QiqoSyncGuard::normalizeCatalogRows([$unassigned], $groups, $partners);
catalogAssert($sentinel['valid'] && $sentinel['rows'][0]['mpn'] === '' && $sentinel['rows'][0]['name'] === ''
    && $sentinel['rows'][0]['partner_id'] === 1615 && $sentinel['missing_partner_refs'] === 1,
    'Unassigned group zero must not group unrelated products; a valid missing ERP partner ID must be retained and reported.');
foreach (['-1', '1615x', '2147483648'] as $invalidPartner) {
    catalogAssert(!QiqoSyncGuard::normalizeCatalogRows([array_merge($unassigned, ['partner' => $invalidPartner])], $groups, $partners)['valid'],
        'Missing-partner compatibility must not accept malformed or out-of-range IDs.');
}
$savedTitle = array_merge($local, ['name' => 'Postojeći naziv', 'meta_title' => 'Postojeći SEO naziv']);
list($model, $db) = catalogFixture($unassigned, $groups, $partners, $savedTitle, $unreturned);
$result = $model->reconcileCatalog(true);
catalogAssert($result['success'] && $result['retained_local_names'] === 1 && $result['missing_partner_refs'] === 1
    && $db->rows[5965]['mpn'] === '' && (int)$db->rows[5965]['partner'] === 1615
    && $db->rows[5965]['name'] === $savedTitle['name'] && $db->rows[5965]['meta_title'] === $savedTitle['meta_title'],
    'Existing unassigned SKUs must retain their exact local title and receive validated stock/status/partner updates.');
$newUnassigned = array_merge($unassigned, ['id' => 'NEW-UNNAMED']);
list($model, $db) = catalogFixture($article, $groups, $partners, $local, $unreturned);
$model->feed->articles[] = $newUnassigned;
$result = $model->reconcileCatalog(true);
catalogAssert(!$result['success'] && $result['error'] === 'missing_catalog_name' && !$db->mutationQueries(),
    'Unnamed new SKUs must still reject all writes by default.');
$skipOptions = ['skip_unnamed_new' => true];
$result = $model->reconcileCatalog(true, '-2 years', $skipOptions);
catalogAssert($result['success'] && $result['updated'] === 1 && $result['added'] === 0 && $result['skipped_missing_names'] === 1
    && $result['skipped_skus'] === ['NEW-UNNAMED'] && count($db->rows) === 2,
    'An explicit skip may update valid existing SKUs while reporting, never creating, unnamed new ones.');
$again = $model->reconcileCatalog(false, '-2 years', $skipOptions);
catalogAssert($again['success'] && $again['updated'] === 0 && $again['skipped_missing_names'] === 1,
    'An explicitly partial named-catalog import must remain idempotent and keep reporting skipped SKUs.');
foreach ([['zaliha' => 'NaN'], ['kataloggrupa' => '999']] as $invalid) {
    list($model, $db) = catalogFixture($article, $groups, $partners, $local, $unreturned);
    $model->feed->articles[] = array_merge($newUnassigned, $invalid);
    $result = $model->reconcileCatalog(true, '-2 years', $skipOptions);
    catalogAssert(!$result['success'] && !$db->mutationQueries(),
        'Skipping unnamed new SKUs must never bypass stock or positive-group validation.');
}

echo "QIQO catalog reimport tests passed.\n";
