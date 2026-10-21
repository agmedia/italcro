<?php
// Temporary tables shadow the catalog only on this test connection.
if (PHP_SAPI !== 'cli') {
    http_response_code(404);
    exit(1);
}
require __DIR__ . '/../upload/config.php';
require DIR_SYSTEM . 'engine/registry.php';
require DIR_SYSTEM . 'engine/model.php';
require DIR_SYSTEM . 'library/config.php';
require DIR_APPLICATION . 'model/catalog/new_product.php';
if (!in_array(DB_HOSTNAME, ['127.0.0.1', 'localhost', '::1'], true)) {
    throw new RuntimeException('This fixture is restricted to a local database.');
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
date_default_timezone_set('Europe/Zagreb');

function newListingAssert($condition, $message) {
    if (!$condition) {
        throw new RuntimeException($message);
    }
}

class NewListingTestDb {
    private $db;
    public $catalogQueries = [];
    public function __construct() {
        $this->db = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE, (int)DB_PORT);
        $this->db->set_charset('utf8mb4');
    }
    public function escape($value) { return $this->db->real_escape_string($value); }
    public function query($sql) {
        if (strpos($sql, 'SELECT p.product_id,') === 0 || strpos($sql, 'SELECT COUNT(*) AS total FROM (') === 0) {
            $this->catalogQueries[] = $sql;
            newListingAssert(strpos($sql, 'qiqo_introduced_at') === false, 'New listing SQL must not depend on an ERP date column or migration.');
        }
        // MySQL cannot open one temporary table twice in a statement. Give the
        // outer join an identical copy while exercising the production query.
        if (strpos($sql, 'SELECT p.product_id,') === 0) {
            $split = strrpos($sql, ') n');
            $outer = substr($sql, $split);
            $outer = str_replace(DB_PREFIX . 'product p ON', DB_PREFIX . 'product_outer p ON', $outer);
            $outer = str_replace(DB_PREFIX . 'product_description pd ON', DB_PREFIX . 'product_description_outer pd ON', $outer);
            $sql = substr($sql, 0, $split) . $outer;
        }
        $result = $this->db->query($sql);
        if ($result === false) { throw new RuntimeException($this->db->error); }
        $rows = $result instanceof mysqli_result ? $result->fetch_all(MYSQLI_ASSOC) : [];
        return (object)['rows' => $rows, 'row' => $rows ? $rows[0] : [], 'num_rows' => count($rows)];
    }
}

$db = new NewListingTestDb();
$db->query('CREATE TEMPORARY TABLE `' . DB_PREFIX . 'product` (product_id INT PRIMARY KEY, date_added DATETIME NULL, mpn VARCHAR(64), status INT, date_available DATE, model VARCHAR(64), sort_order INT)');
$db->query('CREATE TEMPORARY TABLE `' . DB_PREFIX . 'product_to_store` (product_id INT, store_id INT)');
$db->query('CREATE TEMPORARY TABLE `' . DB_PREFIX . 'product_description` (product_id INT, language_id INT, name VARCHAR(64))');
$db->query('CREATE TEMPORARY TABLE `' . DB_PREFIX . 'review` (product_id INT, rating INT, status INT)');
[$cutoff, $now] = QiqoNewProduct::dateWindow(60);
$cutoffDate = new DateTimeImmutable($cutoff);
$nowDate = new DateTimeImmutable($now);
$recent = $nowDate->modify('-5 minutes')->format('Y-m-d H:i:s');
$yesterday = $nowDate->modify('-1 day')->format('Y-m-d H:i:s');
$inside = $cutoffDate->modify('+1 minute')->format('Y-m-d H:i:s');
$old = $cutoffDate->modify('-1 minute')->format('Y-m-d H:i:s');
$older = $cutoffDate->modify('-1 hour')->format('Y-m-d H:i:s');
$future = $nowDate->modify('+1 day')->format('Y-m-d H:i:s');
$futureSameDay = $nowDate->modify('+1 hour')->format('Y-m-d H:i:s');
$futureAvailable = $nowDate->modify('+1 day')->format('Y-m-d');
$fixtures = [
    [1, $recent, 'A', 1, 0], [2, $yesterday, 'A', 1, 0],
    [3, $inside, '', 1, 0], [4, $old, '', 1, 0],
    [5, null, '', 1, 0], [6, $future, '', 1, 0],
    [7, $recent, '', 0, 0], [8, $recent, '', 1, 1],
    [9, '2000-01-01 00:00:00', '', 1, 0], [10, $older, '', 1, 0],
    [11, $recent, '', 1, 0], [12, $recent, '', 1, 0],
    [13, $futureSameDay, '', 1, 0],
];
$fixtureDates = [];
foreach ($fixtures as [$id, $date, $mpn, $status, $store]) {
    $fixtureDates[$id] = $date;
    $dateSql = $date === null ? 'NULL' : "'" . $db->escape($date) . "'";
    $available = $id === 11 ? $futureAvailable : '2020-01-01';
    $language = $id === 12 ? 2 : 3;
    $db->query("INSERT INTO `" . DB_PREFIX . "product` VALUES ($id, $dateSql, '$mpn', $status, '$available', '$id', $id)");
    $db->query("INSERT INTO `" . DB_PREFIX . "product_to_store` VALUES ($id, $store)");
    $db->query("INSERT INTO `" . DB_PREFIX . "product_description` VALUES ($id, $language, 'Article $id')");
}
$db->query('CREATE TEMPORARY TABLE `' . DB_PREFIX . 'product_outer` AS SELECT * FROM `' . DB_PREFIX . 'product`');
$db->query('CREATE TEMPORARY TABLE `' . DB_PREFIX . 'product_description_outer` AS SELECT * FROM `' . DB_PREFIX . 'product_description`');
$registry = new Registry();
$config = new Config();
$config->set('config_language_id', 3);
$config->set('config_store_id', 0);
$config->set('newlabel_status', 60);
$registry->set('config', $config);
$registry->set('db', $db);
$registry->set('load', new class { public function model($route) {} });
$registry->set('model_catalog_product', new class($fixtureDates, $config) {
    private $dates;
    private $config;
    public function __construct($dates, $config) { $this->dates = $dates; $this->config = $config; }
    public function getProduct($id) {
        $product = ['product_id' => (int)$id, 'date_added' => $this->dates[$id]];
        $product['qiqo_is_new'] = QiqoNewProduct::isNew($product, (int)$this->config->get('newlabel_status'));
        return $product;
    }
});
$model = new ModelCatalogNewProduct($registry);
newListingAssert($model->getTotalProducts() === 2, 'Only two active groups added within the configured 60 days in the current store/language should be new.');
newListingAssert(array_keys($model->getProducts()) === [1, 3], 'Related variants must group before pagination.');
newListingAssert(array_keys($model->getProducts(['start' => 1, 'limit' => 1])) === [3], 'New product pagination must match its total.');
newListingAssert(count($model->getProducts(['sort' => 'untrusted;sql'])) === 2, 'Unsupported sorting must use the safe default.');
newListingAssert(array_keys($model->getProducts(['sort' => 'p.date_added', 'order' => 'ASC'])) === [3, 1], 'Date-added sorting must use the qualified group timestamp.');
foreach ($model->getProducts() as $product) {
    newListingAssert($product['qiqo_is_new'] === true, 'Every listed representative must also receive the same new-product badge.');
}
foreach ([0, -1] as $disabledDays) {
    $config->set('newlabel_status', $disabledDays);
    newListingAssert($model->getTotalProducts() === 0 && $model->getProducts() === [], 'Disabled or negative configured label periods must disable the Novo list.');
}
$config->set('newlabel_status', 30);
newListingAssert($model->getTotalProducts() === 1 && array_keys($model->getProducts()) === [1], 'A 30-day setting must exclude articles added 60 days ago.');
$config->set('newlabel_status', 90);
newListingAssert($model->getTotalProducts() === 4 && array_keys($model->getProducts()) === [1, 3, 4, 10], 'A 90-day setting must include older eligible rows without future, unavailable or unrelated-store rows.');
foreach ($db->catalogQueries as $sql) {
    newListingAssert(strpos($sql, 'p.date_added >=') !== false && strpos($sql, 'p.date_added <=') !== false, 'Count and listing SQL must share both date_added bounds.');
}

// Exercise generated OCMOD controllers as well as source: installed filter
// extensions rewrite the special-list query anchors during every refresh.
if (in_array('--http', $argv, true)) {
    $host = strtolower((string)parse_url(HTTPS_SERVER, PHP_URL_HOST));
    newListingAssert(in_array($host, ['localhost', '127.0.0.1', '::1'], true) || substr($host, -5) === '.test', 'HTTP smoke checks are restricted to a local/test hostname.');
foreach (['product/special' => 'Akcije', 'product/new_product' => 'Novo'] as $route => $title) {
    $request = curl_init(rtrim(HTTPS_SERVER, '/') . '/index.php?route=' . $route);
    curl_setopt_array($request, [CURLOPT_RETURNTRANSFER => true, CURLOPT_SSL_VERIFYPEER => false, CURLOPT_SSL_VERIFYHOST => 0, CURLOPT_CONNECTTIMEOUT => 5, CURLOPT_TIMEOUT => 30]);
    $body = curl_exec($request);
    $status = (int)curl_getinfo($request, CURLINFO_HTTP_CODE);
    curl_close($request);
    newListingAssert($body !== false && $status === 200, 'Catalog listing must render after OCMOD refresh: ' . $route);
    newListingAssert(!preg_match('/Fatal error|Parse error|Uncaught|Deprecated:|Warning:/i', $body), 'Catalog listing leaked PHP diagnostics: ' . $route);
    newListingAssert(preg_match('/<h1[^>]*>\s*' . preg_quote($title, '/') . '\s*<\/h1>/', $body) === 1, 'Catalog listing heading must match its route: ' . $route);
}
}
echo "QIQO new-product SQL datetime/configured-period fixtures passed; real catalog unchanged. Optional --http checks only local/test hosts.\n";
