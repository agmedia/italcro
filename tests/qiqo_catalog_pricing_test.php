<?php

// Exercise the real catalog model rather than mocking getQiqoPricingMap.
define('DIR_SYSTEM', __DIR__ . '/../upload/system/');
define('DB_PREFIX', 'test_');
require DIR_SYSTEM . 'engine/registry.php';
require DIR_SYSTEM . 'engine/model.php';
require DIR_SYSTEM . 'library/config.php';
require __DIR__ . '/../upload/catalog/model/catalog/product.php';

function catalogPricingAssert($condition, $message) {
    if (!$condition) throw new RuntimeException($message);
}
function catalogPricingNear($expected, $actual, $message) {
    catalogPricingAssert(abs($expected - $actual) < 0.000001, $message . ': ' . $actual);
}

final class CatalogPricingFixtureDb {
    public $queries = [];
    public $classificationReady = true;
    public function escape($value) { return addslashes((string)$value); }
    public function query($sql) {
        $this->queries[] = $sql;
        if (strpos($sql, 'SHOW TABLES') === 0) {
            $rows = !$this->classificationReady && strpos($sql, 'qiqo_article_classification') !== false ? [] : [['present' => 1]];
        } elseif (strpos($sql, 'customer_qiqo_authorization') !== false) {
            $rows = [['partner_id' => 700, 'partner_discount' => 8, 'base_discount' => 15, 'partner_active' => 1]];
        } elseif (strpos($sql, 'qiqo_partner_article_discount') !== false) {
            $rows = [['article_code' => '402264', 'discount' => 10], ['article_code' => '442076', 'discount' => 18],
                ['article_code' => '513056', 'discount' => 50], ['article_code' => '801001', 'discount' => 70]];
        } elseif (strpos($sql, 'INNER JOIN `test_qiqo_article_classification`') !== false) {
            $rows = [['sku' => '513056', 'mpn' => 'clearance-group'], ['sku' => '801001', 'mpn' => '801-group']];
        } elseif (strpos($sql, 'qiqo_article_classification') !== false) {
            $rows = [['article_code' => '513056', 'classification' => 800], ['article_code' => '801001', 'classification' => 801]];
        } elseif (strpos($sql, 'qiqo_action_price') !== false) {
            $rows = [
                ['article_code' => '402264', 'indicator' => 'C', 'quantity' => 0, 'price' => 3.29, 'discount' => 0],
                ['article_code' => '442076', 'indicator' => 'C', 'quantity' => 0, 'price' => 0, 'discount' => 0],
                ['article_code' => '442076', 'indicator' => 'P', 'quantity' => 0, 'price' => 0, 'discount' => 25],
                ['article_code' => '442076', 'indicator' => 'P', 'quantity' => 24, 'price' => 0, 'discount' => 28],
                ['article_code' => '513056', 'indicator' => 'C', 'quantity' => 0, 'price' => 0.4, 'discount' => 0],
                ['article_code' => '801001', 'indicator' => 'X', 'quantity' => 0, 'price' => 0, 'discount' => 3],
            ];
        } elseif (strpos($sql, 'SELECT sku, cent') !== false) {
            $rows = [];
        } else {
            throw new RuntimeException('Unexpected model query: ' . $sql);
        }
        return (object)['rows' => $rows, 'row' => $rows ? $rows[0] : [], 'num_rows' => count($rows)];
    }
}

$db = new CatalogPricingFixtureDb();
$registry = new Registry();
$registry->set('db', $db);
$registry->set('config', new Config());
$model = new ModelCatalogProduct($registry);
$quantities = ['402264' => 1, '442076' => 1, '513056' => 1, '801001' => 1];
$bases = ['402264' => 5.39, '442076' => 1.42, '513056' => 0.66, '801001' => 0.25];

$catalog = $model->getQiqoPricingMap(7, $quantities, $bases, false, false);
catalogPricingNear(4.5815, $catalog['402264']['final_unit_price'], 'Product 2122 must display the customer rebate instead of C net 3.29');
catalogPricingNear(15, $catalog['402264']['discount_percent'], 'Larger customer rebate must be visible');
catalogPricingNear(1.1644, $catalog['442076']['final_unit_price'], 'Catalog must use the larger article rebate instead of P action');
catalogPricingNear(18, $catalog['442076']['discount_percent'], 'Larger article rebate must be visible');
catalogPricingAssert(!$catalog['402264']['action_applied'] && !$catalog['442076']['action_applied'], 'Catalog must respect the false action argument');
catalogPricingAssert(!array_filter($db->queries, function ($sql) { return strpos($sql, 'qiqo_action_price') !== false; }), 'Base-only catalog pricing must not query action rows');

foreach ([false, true] as $proforma) {
    foreach ([false, true] as $includeActions) {
        $rows = $model->getQiqoPricingMap(7, $quantities, $bases, $proforma, $includeActions);
        foreach (['513056', '801001'] as $sku) {
            catalogPricingNear($bases[$sku], $rows[$sku]['final_unit_price'], 'Both clearance classifications must retain their ERP net price');
            catalogPricingNear(0, $rows[$sku]['discount_percent'], 'Clearance must have no additional rebate');
            catalogPricingAssert(!$rows[$sku]['action_applied'], 'Clearance must exclude all C/P/X actions');
        }
    }
}
$cart = $model->getQiqoPricingMap(7, $quantities, $bases, false, true);
catalogPricingNear(3.29, $cart['402264']['final_unit_price'], 'Cart must retain absolute C net price');
catalogPricingNear(0, $cart['402264']['discount_percent'], 'Absolute net price must not invent a rebate');
catalogPricingNear(1.065, $cart['442076']['final_unit_price'], 'Cart must apply the P action');
catalogPricingNear(25, $cart['442076']['discount_percent'], 'Cart P action rebate');
$quantities['442076'] = 24;
$tier = $model->getQiqoPricingMap(7, $quantities, $bases, false, true);
catalogPricingNear(28, $tier['442076']['discount_percent'], 'Cart must retain quantity tiers');

$products = [
    ['product_id' => 1, 'sku' => '513056', 'mpn' => '', 'mpn_count' => 1],
    ['product_id' => 2, 'sku' => '801001', 'mpn' => '', 'mpn_count' => 1],
    ['product_id' => 3, 'sku' => 'regular', 'mpn' => 'clearance-group', 'mpn_count' => 4],
    ['product_id' => 4, 'sku' => 'regular', 'mpn' => 'clearance-group', 'mpn_count' => 1],
];
for ($i = 5; $i <= 200; $i++) $products[] = ['product_id' => $i, 'sku' => 'ordinary-' . $i];
$db->queries = [];
catalogPricingAssert($model->getQiqoClearanceMap($products) === [1 => true, 2 => true, 3 => true], 'R must identify exact clearance articles and groups containing a clearance variant');
catalogPricingAssert(count($db->queries) === 2, 'Clearance lookup must use a fixed two queries for the whole listing');
$db->classificationReady = false;
catalogPricingAssert($model->getQiqoClearanceMap($products) === [], 'Missing migration must not mislabel ordinary products');

echo "Catalog model pricing passed (base-only C/P display, maximum rebate, cart net/tier actions, 800/801 net exemption and batched R classification).\n";
