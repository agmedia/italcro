<?php
// Controller fixture only: no database, ERP, HTTP session or live services.
require_once __DIR__ . '/../upload/system/engine/registry.php';
require_once __DIR__ . '/../upload/system/engine/controller.php';
require_once __DIR__ . '/../upload/catalog/controller/account/wishlist.php';

function wishlistAssert($condition, string $message): void {
    if (!$condition) { throw new RuntimeException($message); }
}
function wishlistNear($expected, $actual, string $message): void {
    wishlistAssert(abs((float)$expected - (float)$actual) < 0.000001, $message);
}

final class QiqoWishlistFixtureProducts {
    public $products;
    public $pricingCalls = [];
    public $actionCalls = [];
    public $optionCalls = [];
    public $profileCalls = [];
    public function __construct(array $products) { $this->products = $products; }
    public function getProduct($id) { return $this->products[$id] ?? false; }
    public function getProductOptions($id) {
        $this->optionCalls[] = $id;
        return $id === 104 ? [['required' => 1]] : [['required' => 0]];
    }
    public function getProfiles($id) { $this->profileCalls[] = $id; return $id === 105 ? [['recurring_id' => 7]] : []; }
    public function getQiqoActionDetailsMap($skus) {
        $this->actionCalls[] = $skus;
        return ['405054' => [['indicator' => 'P', 'quantity' => 400, 'price' => 0, 'discount' => 22]],
            '405056' => [['indicator' => 'C', 'quantity' => 100, 'price' => 40, 'discount' => 0]]];
    }
    public function getQiqoPricingMap($customerId, $quantities, $basePrices, $applyActions, $proforma) {
        $this->pricingCalls[] = [$customerId, $quantities, $basePrices, $applyActions, $proforma];
        $discounts = ['405054' => 18, '405056' => 15, 'PIPE125' => 20, 'OPT' => 10, 'REC' => 5];
        $prices = [];
        foreach ($quantities as $sku => $quantity) {
            $discount = $discounts[$sku];
            $prices[$sku] = ['base_unit_price' => $basePrices[$sku], 'final_unit_price' => $basePrices[$sku] * (1 - $discount / 100),
                'discount_percent' => $discount, 'action_applied' => false];
        }
        return $prices;
    }
}

final class QiqoWishlistFixtureSaved {
    public $ids;
    public $deleted = [];
    public function __construct(array $ids) { $this->ids = $ids; }
    public function getWishlist() { return array_map(static function ($id) { return ['product_id' => $id]; }, $this->ids); }
    public function deleteWishlist($id) { $this->deleted[] = $id; }
}
final class QiqoWishlistFixtureLoad {
    public $viewData;
    public function language($route) {}
    public function model($route) {}
    public function controller($route) { return ''; }
    public function view($route, $data) { $this->viewData = $data; return 'wishlist fixture'; }
}
final class QiqoWishlistFixtureCurrency {
    public function format($value, $currency) { return $currency . ' ' . number_format((float)$value, 2, '.', ''); }
}

$makeProduct = static function (int $id, string $sku, array $overrides = []): array {
    return array_replace(['product_id' => $id, 'sku' => $sku, 'mpn' => 'TIPLA-MS-GROUP', 'model' => 'BARCODE-' . $id,
        'name' => 'TIPLA MS', 'name_add' => 'M-8', 'description_add' => '', 'ean' => 'KOM', 'jm' => 'KOM',
        'image' => '', 'quantity' => 100, 'minimum' => 1, 'pakkol' => 1, 'pak' => 0, 'cent' => '',
        'base_price' => 10, 'price' => 10, 'vpc' => 10], $overrides);
};
$products = [
    101 => $makeProduct(101, '405054', ['base_price' => 0.3215, 'price' => 0.3215, 'vpc' => 32.15, 'cent' => 'C-100', 'pakkol' => 200, 'pak' => 1]),
    102 => $makeProduct(102, '405056', ['name_add' => 'M-10', 'base_price' => 0.4848, 'price' => 0.4848, 'vpc' => 48.48, 'cent' => 'C100', 'pakkol' => 50, 'pak' => 1]),
    103 => $makeProduct(103, 'PIPE125', ['mpn' => 'PIPE-GROUP', 'name' => 'Cijev', 'name_add' => '1,25 m', 'jm' => 'MET', 'ean' => 'MET']),
    104 => $makeProduct(104, 'OPT', ['mpn' => 'OPTION-GROUP']),
    105 => $makeProduct(105, 'REC', ['mpn' => 'PLAN-GROUP']),
    106 => $makeProduct(106, '', ['mpn' => 'MISSING-SKU-GROUP'])
];
$model = new QiqoWishlistFixtureProducts($products);
$saved = new QiqoWishlistFixtureSaved([101, 102, 103, 104, 105, 106, 999]);
$load = new QiqoWishlistFixtureLoad();
$response = new class {
    public $output;
    public function setOutput($output) { $this->output = $output; }
    public function redirect($url) { throw new RuntimeException('Unexpected wishlist redirect.'); }
};
$registry = new Registry();
foreach ([
    'load' => $load,
    'model_catalog_product' => $model,
    'model_account_wishlist' => $saved,
    'model_tool_image' => new class { public function resize($image, $width, $height) { return 'fixture/' . $image; } },
    'customer' => new class { public function isLogged() { return true; } public function getId() { return 103; } },
    'config' => new class { public function get($key) { return $key === 'config_customer_price' ? true : null; } },
    'currency' => new QiqoWishlistFixtureCurrency(),
    'session' => (object)['data' => ['currency' => 'EUR']],
    'request' => (object)['get' => [], 'post' => []],
    'response' => $response,
    'document' => new class { public function setTitle($title) {} },
    'language' => new class { public function get($key) { return $key; } },
    'url' => new class { public function link($route, $arguments = '', $secure = false) { return '/' . $route . ($arguments !== '' ? '?' . $arguments : ''); } }
] as $name => $service) { $registry->set($name, $service); }

(new ControllerAccountWishList($registry))->index();
$data = $load->viewData;
$rows = [];
foreach ($data['products'] as $product) { $rows[$product['product_id']] = $product; }
wishlistAssert(array_keys($rows) === [101, 102, 103, 104, 105, 106], 'Wishlist must preserve every exact saved product ID, including grouped siblings.');
wishlistAssert($rows[101]['can_add_to_cart'] && $rows[102]['can_add_to_cart'] && $rows[103]['can_add_to_cart'], 'A selected SKU must remain directly addable even when it has a group MPN.');
wishlistAssert($rows[101]['is_selected_article'] && $rows[102]['is_selected_article'] && $rows[103]['is_selected_article'], 'Grouped variants with exact saved SKUs must be recognized as selected articles.');
wishlistAssert($rows[101]['code'] === '405054' && $rows[102]['code'] === '405056'
    && $rows[101]['href'] === '/product/product?product_id=101' && $rows[102]['href'] === '/product/product?product_id=102', 'Grouped siblings must retain distinct SKU values and product links.');
wishlistAssert($rows[101]['vpc'] === 'EUR 32.15' && $rows[101]['final_price'] === 'EUR 26.36'
    && $rows[102]['vpc'] === 'EUR 48.48' && $rows[102]['final_price'] === 'EUR 41.21', 'C-100 grouped rows must display per-hundred VPC and customer-specific rebate prices.');
wishlistNear(18, $rows[101]['qiqo_discount_percent'], 'First grouped variant must retain the article rebate.');
wishlistNear(15, $rows[102]['qiqo_discount_percent'], 'Second grouped variant must retain its own customer rebate.');
wishlistAssert($rows[101]['qiqo_action'] && $rows[102]['qiqo_action'] && $rows[101]['qiqo_action_conditions'][0]['discount'] === '-22%', 'Action conditions must be available for every selected grouped SKU without applying action prices to the listing.');
wishlistAssert(!$rows[104]['can_add_to_cart'] && $rows[104]['selection_label'] === 'Odaberi opcije'
    && $rows[104]['final_price'] !== false, 'A known SKU with a required option must retain price but require option selection.');
wishlistAssert(!$rows[105]['can_add_to_cart'] && $rows[105]['selection_label'] === 'Odaberi plan'
    && $rows[105]['final_price'] !== false, 'Recurring products must retain price but require a plan selection.');
wishlistAssert(!$rows[106]['is_selected_article'] && !$rows[106]['can_add_to_cart'] && $rows[106]['final_price'] === false
    && $rows[106]['vpc'] === false && !$rows[106]['qiqo_action'], 'Missing-SKU rows must remain blocked and hide unavailable article prices/actions.');
wishlistAssert(!in_array(106, $model->optionCalls, true) && !in_array(104, $model->profileCalls, true), 'Selection checks must avoid missing articles and preserve required-option precedence.');
wishlistNear(200, $rows[101]['minimumifc100'], 'C-100 M8 must preserve its 200-piece step.');
wishlistNear(50, $rows[102]['minimumifc100'], 'C-100 M10 must preserve its 50-piece step.');
wishlistNear(1.25, $rows[103]['minimumifc100'], 'Fractional meter variants must preserve their decimal step.');
wishlistAssert($rows[103]['decimal_quantity'] && $rows[103]['packaging'] === 'MET 1,25' && $data['wishlist_has_c100'], 'Fractional packaging and C-100 display flags must survive variant selection.');
wishlistAssert(count($model->pricingCalls) === 1, 'All wishlist variants must share one batched customer-pricing request.');
[$customer, $quantities, $basePrices, $actionsApplied, $proforma] = $model->pricingCalls[0];
wishlistAssert($customer === 103 && array_keys($quantities) === [405054, 405056, 'PIPE125', 'OPT', 'REC']
    && array_keys($basePrices) === array_keys($quantities) && $actionsApplied === false && $proforma === false,
    'The customer-pricing batch must include every known exact SKU and exclude missing SKUs.');
wishlistNear(200, $quantities[405054], 'Pricing batch must use the M8 pack quantity.');
wishlistNear(50, $quantities[405056], 'Pricing batch must use the M10 pack quantity.');
wishlistNear(1.25, $quantities['PIPE125'], 'Pricing batch must use fractional packaging.');
wishlistAssert($model->actionCalls === [['405054', '405056', 'PIPE125', 'OPT', 'REC']], 'Action lookup must include every exact SKU, including grouped variants.');
wishlistAssert($saved->deleted === [999] && $response->output === 'wishlist fixture', 'Deleted products must be removed while the wishlist renders normally.');

echo "QIQO wishlist controller tests passed (exact grouped variants, batched customer prices/actions, C-100 and fractional quantities, required options, recurring plans and missing SKU guards).\n";
