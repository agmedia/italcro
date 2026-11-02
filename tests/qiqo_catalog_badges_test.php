<?php

error_reporting(E_ALL & ~E_DEPRECATED);
$autoload = __DIR__ . '/../storage/vendor/autoload.php';
require_once is_file($autoload) ? $autoload : __DIR__ . '/../upload/system/storage/vendor/autoload.php';
$themeRoot = __DIR__ . '/../upload/catalog/view/theme';
$twig = new Twig\Environment(new Twig\Loader\FilesystemLoader($themeRoot), ['autoescape' => false, 'cache' => false]);

function catalogBadgeAssert($condition, $message) {
    if (!$condition) throw new RuntimeException($message);
}
function catalogBadgeNodes($html, $class) {
    $doc = new DOMDocument();
    libxml_use_internal_errors(true);
    $doc->loadHTML('<!doctype html><html><body>' . $html . '</body></html>');
    libxml_clear_errors();
    return (new DOMXPath($doc))->query('//*[contains(concat(" ",normalize-space(@class)," ")," ' . $class . ' ")]');
}

foreach ([[15, false], [0, false], [0, true]] as $case) {
    [$rebate, $clearance] = $case;
    // A legacy special with no resolved rebate must never produce an empty box.
    $product = ['product_id' => 2122, 'name' => 'Test', 'href' => '#', 'thumb' => 'test.jpg',
        'sku' => '402264', 'price' => '5.39 EUR', 'special' => '3.29 EUR', 'minimum' => 1,
        'quantity' => 12, 'is_single_article' => true, 'qiqo_discount_percent' => $rebate,
        'qiqo_clearance' => $clearance, 'qiqo_action' => true];
    foreach (['basel/template/product/single_product.twig', 'basel/template/extension/module/basel_products.twig'] as $template) {
        $html = $twig->render($template, ['product' => $product, 'salebadge_status' => 2,
            'tabs' => [['products' => [$product]]], 'module' => 1]);
        $badges = catalogBadgeNodes($html, 'sale_badge');
        catalogBadgeAssert($badges->length === ($rebate > 0 ? 1 : 0), 'Resolved rebate must control sale badge visibility: ' . $template);
        if ($badges->length) catalogBadgeAssert(trim($badges->item(0)->textContent) === '-15%', 'Image badge must show the customer/article rebate');
        $r = catalogBadgeNodes($html, 'clearance_badge');
        catalogBadgeAssert($r->length === ($clearance ? 1 : 0), 'R must appear only for clearance: ' . $template);
        catalogBadgeAssert(catalogBadgeNodes($html, 'action_badge')->length === ($clearance ? 0 : 1), 'Clearance must not advertise inapplicable actions');
        if ($r->length) catalogBadgeAssert(trim($r->item(0)->textContent) === 'R' && $r->item(0)->getAttribute('title') === 'Rasprodaja', 'R must have a readable explanation');
    }

    $html = $twig->render('basel/template/product/product.twig', [
        'thumb' => 'test.jpg', 'is_single_article' => true, 'price' => '5.39 EUR', 'special' => '3.29 EUR',
        'sale_badge' => $rebate ? '-15%' : false, 'qiqo_discount_percent' => $rebate,
        'qiqo_clearance' => $clearance, 'show_variant_prices' => true,
        'same_mpn_products' => [['product_id' => 2122, 'code' => '402264', 'vpc' => '5.39 EUR',
            'final_price' => '4.58 EUR', 'qiqo_discount_percent' => $rebate, 'qiqo_clearance' => $clearance,
            'qiqo_action' => true, 'qiqo_action_conditions' => [['indicator' => 'P', 'discount' => '-25%']]]],
    ]);
    catalogBadgeAssert(catalogBadgeNodes($html, 'sale_badge')->length === ($rebate ? 1 : 0), 'Product image must not infer a net action percentage');
    catalogBadgeAssert(catalogBadgeNodes($html, 'clearance_badge')->length === ($clearance ? 1 : 0), 'Product image clearance badge');
    catalogBadgeAssert(catalogBadgeNodes($html, 'clearance_mark')->length === ($clearance ? 1 : 0), 'Variant table clearance marker');
    catalogBadgeAssert(catalogBadgeNodes($html, 'qiqo-action-button')->length === ($clearance ? 0 : 1), 'Clearance rows must show R instead of A');
    catalogBadgeAssert(catalogBadgeNodes($html, 'qiqo-action-modal')->length === ($clearance ? 0 : 1), 'Clearance must not display irrelevant action conditions');
}

$group = ['product_id' => 1, 'name' => 'Mixed group', 'is_single_article' => false,
    'qiqo_clearance' => true, 'qiqo_action' => true];
$groupHtml = $twig->render('basel/template/product/single_product.twig', ['product' => $group]);
catalogBadgeAssert(catalogBadgeNodes($groupHtml, 'clearance_badge')->length === 1
    && catalogBadgeNodes($groupHtml, 'action_badge')->length === 1, 'Mixed groups may retain A for a different eligible non-clearance variant');

$css = file_get_contents($themeRoot . '/basel/stylesheet/stylesheet.css');
catalogBadgeAssert(preg_match('/\.clearance_badge,\s*\.clearance_mark\s*\{[^}]*background:\s*#c62828\s*;[^}]*color:\s*#ffffff\s*;/s', $css) === 1, 'Clearance R must use red with white text');
echo "Catalog badge templates passed (customer/article percentage, no empty net-price badges, red R on cards/detail/variants).\n";
