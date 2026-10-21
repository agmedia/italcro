<?php

error_reporting(E_ALL & ~E_DEPRECATED);
require_once __DIR__ . '/../upload/system/library/qiqo/primary_menu.php';
$autoload = __DIR__ . '/../storage/vendor/autoload.php';
require_once is_file($autoload) ? $autoload : __DIR__ . '/../upload/system/storage/vendor/autoload.php';

function headerNavigationAssert(bool $condition, string $message): void
{
    if (!$condition) {
        throw new RuntimeException($message);
    }
}

$twig = new Twig\Environment(new Twig\Loader\FilesystemLoader(__DIR__ . '/../upload/catalog/view/theme'), [
    'cache' => false,
    'autoescape' => false,
]);
$rows = [];
foreach (['Brza narudžba', 'Novo', 'Akcije', 'Blog', 'Brandovi', 'Letak', 'Rasprodaja'] as $name) {
    $rows[] = ['name' => [3 => $name], 'link' => 'index.php?route=product/category&path=99', 'submenu' => [], 'icon' => 'no_image'];
}
$menu = QiqoPrimaryMenu::normalize($rows, 3, 'index.php?route=product/new_product', 'index.php?route=information/leaflet', ['route' => 'information/leaflet']);
$name = 'Denis "Primjer" Bakša ' . str_repeat('Dugi naziv ', 12);

foreach ([[false, false], [true, false], [false, true]] as $state) {
    [$logged, $admin] = $state;
    $data = [
        'name' => 'ItalCro', 'home' => '/', 'primary_menu' => 1,
        'primary_menu_desktop' => $menu, 'primary_menu_mobile' => $menu, 'lang_id' => 3,
        'logged' => $logged, 'is_admin_logged' => $admin, 'customer_display_name' => $name,
        'account' => 'account', 'login' => 'login', 'logout' => 'logout',
        'text_account' => 'Moj račun', 'text_compare' => 'Usporedba',
        'wishlist' => 'wishlist', 'compare' => 'compare', 'shopping_cart' => 'cart',
        'basel_text_category' => 'Kategorije proizvoda',
    ];
    $html = $twig->render('basel/template/common/headers/header6.twig', $data)
        . $twig->render('basel/template/common/mobile-nav.twig', $data);
    $document = new DOMDocument();
    $previous = libxml_use_internal_errors(true);
    $document->loadHTML('<?xml encoding="utf-8" ?>' . $html);
    libxml_clear_errors();
    libxml_use_internal_errors($previous);
    $xpath = new DOMXPath($document);
    $eye = $xpath->query('//button[@id="togglePrices"]');
    headerNavigationAssert($eye->length === ($logged || $admin ? 1 : 0), 'Price visibility control must remain available to signed-in customers and admins.');
    if ($eye->length) {
        headerNavigationAssert(strpos($eye->item(0)->getAttribute('class'), 'hidden-xs') === false, 'Price visibility control must also be available on mobile.');
    }
    foreach (['//nav[contains(@class,"italcro-primary-nav")]', '//nav[@id="italcro-mobile-navigation"]'] as $nav) {
        $current = $xpath->query($nav . '//a[@aria-current="page"]');
        headerNavigationAssert($current->length === 1 && strpos($current->item(0)->getAttribute('href'), 'information/leaflet') !== false, 'Both menus must identify the current internal Letak page.');
        $labels = [];
        foreach ($xpath->query($nav . '//ul[contains(@class,"categories")][1]/li/a/span[@class="top"]') as $label) {
            $labels[] = trim($label->textContent);
        }
        headerNavigationAssert($labels === ['Brza narudžba', 'Novo', 'Akcije', 'Blog', 'Brandovi', 'Letak', 'Rasprodaja'], 'All seven primary destinations must remain in the same order on desktop and mobile.');
    }
    headerNavigationAssert($xpath->query('//button[@aria-controls="italcro-mobile-navigation"]')->length === 1, 'The mobile trigger must remain a native, labelled button.');
    headerNavigationAssert($xpath->query('//nav[@id="italcro-mobile-navigation"][@inert][@aria-hidden="true"]')->length === 1, 'Closed mobile navigation must stay outside keyboard focus.');
    if ($logged) {
        $account = $xpath->query('//a[contains(@class,"account-shortcut")]')->item(0);
        headerNavigationAssert($account && $account->getAttribute('title') === $name, 'A long customer name must remain safely available in the account tooltip.');
    }
}

echo "QIQO header navigation render tests passed.\n";
