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

function newListingAssert($condition, $message) {
    if (!$condition) {
        throw new RuntimeException($message);
    }
}

class NewListingTestDb {
    private $db;
    public function __construct() {
        $this->db = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE, (int)DB_PORT);
        $this->db->set_charset('utf8mb4');
    }
    public function escape($value) { return $this->db->real_escape_string($value); }
    public function query($sql) {
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
$db->query('CREATE TEMPORARY TABLE `' . DB_PREFIX . 'product` (product_id INT PRIMARY KEY, qiqo_introduced_at DATE NULL, mpn VARCHAR(64), status INT, date_available DATE, model VARCHAR(64), sort_order INT)');
$db->query('CREATE TEMPORARY TABLE `' . DB_PREFIX . 'product_to_store` (product_id INT, store_id INT)');
$db->query('CREATE TEMPORARY TABLE `' . DB_PREFIX . 'product_description` (product_id INT, language_id INT, name VARCHAR(64))');
$db->query('CREATE TEMPORARY TABLE `' . DB_PREFIX . 'review` (product_id INT, rating INT, status INT)');
[$cutoff, $today] = QiqoNewProduct::dateWindow();
$old = (new DateTimeImmutable($cutoff))->modify('-1 day')->format('Y-m-d');
$future = (new DateTimeImmutable($today))->modify('+1 day')->format('Y-m-d');
$fixtures = [
    [1, $today, 'A', 1, 0], [2, $today, 'A', 1, 0],
    [3, $cutoff, '', 1, 0], [4, $old, '', 1, 0],
    [5, null, '', 1, 0], [6, $future, '', 1, 0],
    [7, $today, '', 0, 0], [8, $today, '', 1, 1],
];
foreach ($fixtures as [$id, $date, $mpn, $status, $store]) {
    $dateSql = $date === null ? 'NULL' : "'" . $db->escape($date) . "'";
    $db->query("INSERT INTO `" . DB_PREFIX . "product` VALUES ($id, $dateSql, '$mpn', $status, '2020-01-01', '$id', $id)");
    $db->query("INSERT INTO `" . DB_PREFIX . "product_to_store` VALUES ($id, $store)");
    $db->query("INSERT INTO `" . DB_PREFIX . "product_description` VALUES ($id, 3, 'Article $id')");
}
$db->query('CREATE TEMPORARY TABLE `' . DB_PREFIX . 'product_outer` AS SELECT * FROM `' . DB_PREFIX . 'product`');
$db->query('CREATE TEMPORARY TABLE `' . DB_PREFIX . 'product_description_outer` AS SELECT * FROM `' . DB_PREFIX . 'product_description`');
$registry = new Registry();
$config = new Config();
$config->set('config_language_id', 3);
$config->set('config_store_id', 0);
$registry->set('config', $config);
$registry->set('db', $db);
$registry->set('load', new class { public function model($route) {} });
$registry->set('model_catalog_product', new class { public function getProduct($id) { return ['product_id' => (int)$id]; } });
$model = new ModelCatalogNewProduct($registry);
newListingAssert($model->getTotalProducts() === 2, 'Only two active, dated groups in the current store should be new.');
newListingAssert(array_keys($model->getProducts()) === [1, 3], 'Related variants must group before pagination.');
newListingAssert(array_keys($model->getProducts(['start' => 1, 'limit' => 1])) === [3], 'New product pagination must match its total.');
newListingAssert(count($model->getProducts(['sort' => 'untrusted;sql'])) === 2, 'Unsupported sorting must use the safe default.');

// Exercise generated OCMOD controllers as well as source: installed filter
// extensions rewrite the special-list query anchors during every refresh.
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
echo "QIQO new-product SQL fixture and generated-controller HTTP tests passed; real catalog unchanged.\n";
