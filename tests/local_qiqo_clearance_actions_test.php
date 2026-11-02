<?php

// Only connection-local temporary tables are written. Permanent catalog data
// remains untouched; this test is refused for every non-loopback database.
require __DIR__ . '/../upload/config.php';
if (!in_array(DB_HOSTNAME, ['localhost', '127.0.0.1', '::1'], true)) throw new RuntimeException('Local only.');
foreach (['engine/registry.php', 'engine/model.php', 'library/config.php'] as $file) require_once DIR_SYSTEM . $file;
require __DIR__ . '/../upload/catalog/model/catalog/product.php';
require __DIR__ . '/../upload/catalog/model/extension/maza/tf_product.php';
function clearanceActionsAssert($condition, $message) {
    if (!$condition) throw new RuntimeException($message);
}
final class ClearanceActionsDb {
    private $db;
    public function __construct() {
        $this->db = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE, (int)DB_PORT);
        $this->db->set_charset('utf8mb4');
        $this->db->query("SET SESSION sql_mode='NO_ZERO_IN_DATE,NO_ENGINE_SUBSTITUTION'");
    }
    public function escape($value) { return $this->db->real_escape_string((string)$value); }
    public function query($sql) {
        // MySQL SHOW TABLES does not enumerate temporary tables.
        if (strpos($sql, 'SHOW TABLES LIKE ') === 0) $rows = [['present' => 1]];
        else {
            $result = $this->db->query($sql);
            if ($result === false) throw new RuntimeException('Temporary fixture query failed (' . $this->db->errno . ').');
            $rows = $result instanceof mysqli_result ? $result->fetch_all(MYSQLI_ASSOC) : [];
        }
        return (object)['rows' => $rows, 'row' => $rows[0] ?? [], 'num_rows' => count($rows)];
    }
}
final class ClearanceActionsProductModel extends ModelCatalogProduct {
    public function getProduct($id) { return ['product_id' => (int)$id]; }
}
$db = new ClearanceActionsDb();
$p = DB_PREFIX;
// Existing production tables can use different utf8mb4 collations. Joining
// their implicit string columns must not cause MySQL error 1267.
$db->query("CREATE TEMPORARY TABLE `{$p}qiqo_article_classification` (article_code VARCHAR(64) PRIMARY KEY, classification INT) DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci");
$db->query("CREATE TEMPORARY TABLE `{$p}qiqo_action_price` (article_code VARCHAR(64), indicator CHAR(1), quantity DECIMAL(12,4), price DECIMAL(12,7), discount DECIMAL(9,4)) DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
$db->query("CREATE TEMPORARY TABLE `{$p}product` (product_id INT PRIMARY KEY, sku VARCHAR(64), mpn VARCHAR(64), status INT, date_available DATE, price DECIMAL(12,7), sort_order INT) DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
$db->query("CREATE TEMPORARY TABLE `{$p}product_to_store` (product_id INT, store_id INT)");
$db->query("CREATE TEMPORARY TABLE `{$p}product_description` (product_id INT, language_id INT, name VARCHAR(64))");
$db->query("CREATE TEMPORARY TABLE `{$p}review` (product_id INT, status INT, rating INT)");
$db->query("INSERT INTO `{$p}qiqo_article_classification` VALUES ('513056',800),('FUT801',801),('REG-A',1)");
$db->query("INSERT INTO `{$p}product` VALUES (1,'513056','MIXED',1,'2000-01-01',0.66,0),(2,'REG-A','MIXED',1,'2000-01-01',2,0),
    (3,'FUT801','CLEARONLY',1,'2000-01-01',0.25,0),(4,'ZERO','ZERO',1,'2000-01-01',1,0),
    (5,'XONLY','XONLY',1,'2000-01-01',1,0),(6,'INACTIVE','CLEARONLY',0,'2000-01-01',1,0)");
$db->query("INSERT INTO `{$p}product_to_store` VALUES (1,0),(2,0),(3,0),(4,0),(5,0),(6,0)");
$db->query("INSERT INTO `{$p}product_description` VALUES (1,1,'800'),(2,1,'Regular'),(3,1,'801'),(4,1,'Zero'),(5,1,'X'),(6,1,'Inactive')");
$db->query("INSERT INTO `{$p}qiqo_action_price` VALUES ('513056','C',0,0.4,0),('513056','P',0,0,20),('REG-A','P',0,0,25),
    ('FUT801','C',0,0.2,0),('FUT801','X',0,0,3),('ZERO','C',0,0,0),('XONLY','X',0,0,3),('INACTIVE','C',0,0.3,0)");
$config = new Config();
$config->set('config_store_id', 0);
$config->set('config_language_id', 1);
$registry = new Registry();
$registry->set('db', $db);
$registry->set('config', $config);
$model = new ClearanceActionsProductModel($registry);
$skus = ['513056', 'REG-A', 'FUT801', 'ZERO', 'XONLY'];
clearanceActionsAssert($model->getQiqoClearanceMap([
    ['product_id' => 1, 'sku' => '513056'], ['product_id' => 2, 'sku' => 'REG-A'], ['product_id' => 3, 'sku' => 'FUT801'],
]) === [1 => true, 3 => true], 'Clearance R classification joins must tolerate mixed table collations.');
clearanceActionsAssert($model->getQiqoActionArticleMap($skus) === ['REG-A' => true], 'Clearance, zero and X-only rows must have no A badge.');
$details = $model->getQiqoActionDetailsMap($skus);
clearanceActionsAssert(array_keys($details) === ['REG-A'] && $details['REG-A'][0]['discount'] === 25.0, 'Only applicable non-clearance action conditions may be displayed.');
clearanceActionsAssert($model->getQiqoActionMpnMap(['MIXED', 'CLEARONLY', 'XONLY']) === ['MIXED' => true], 'Mixed group keeps A for its regular variant; clearance-only group must not.');
clearanceActionsAssert($model->getQiqoProformaExtraDiscountMap($skus) === ['XONLY' => 3.0], 'Clearance must not advertise an inapplicable X proforma discount.');
clearanceActionsAssert(array_keys($model->getProductSpecials(['start' => 0, 'limit' => 20])) === [2], 'Akcije listing must exclude clearance and irrelevant rows before pagination.');
clearanceActionsAssert((int)$model->getTotalProductSpecials() === 1, 'Akcije total must agree with clearance exclusion.');
$maza = new ModelExtensionMazaTfProduct($registry);
$method = new ReflectionMethod($maza, 'getQiqoActionSpecialBySku');
$method->setAccessible(true);
clearanceActionsAssert($method->invoke($maza, '513056', 0.66) === null && $method->invoke($maza, 'FUT801', 0.25) === null, 'Maza action filters must exclude both clearance classifications.');
clearanceActionsAssert(abs($method->invoke($maza, 'REG-A', 2) - 1.5) < 0.000001, 'Regular Maza action result must remain available.');
$method = new ReflectionMethod($maza, 'getQiqoActionSpecialSql');
$method->setAccessible(true);
$specialSql = $method->invoke($maza, 'p.price', false);
$filtered = $db->query("SELECT p.product_id, {$specialSql} AS special FROM `{$p}product` p WHERE p.product_id IN (1,2,3) ORDER BY p.product_id")->rows;
clearanceActionsAssert($filtered[0]['special'] === null && $filtered[2]['special'] === null && abs((float)$filtered[1]['special'] - 1.5) < 0.000001, 'Maza correlated SQL must agree with exact-SKU checks.');
echo "Clearance action SQL passed (800/801 no A/conditions/X, mixed eligible group, Akcije pagination/total and Maza filters).\n";
