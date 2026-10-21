<?php

require_once __DIR__ . '/../upload/system/library/qiqo/new_product.php';
require_once __DIR__ . '/../upload/system/library/qiqo/primary_menu.php';

function newProductAssert($condition, $message) {
    if (!$condition) {
        throw new RuntimeException($message);
    }
}

$previousTimezone = date_default_timezone_get();
date_default_timezone_set('Europe/Zagreb');
try {
    $now = '2026-10-21 12:34:56';
    newProductAssert(QiqoNewProduct::dateWindow(60, $now) === ['2026-08-22 12:34:56', $now], 'The configured 60 days must produce a rolling SQL datetime window.');
    foreach ([null, '', '0000-00-00', '0000-00-00 00:00:00', '2026-02-30 12:00:00', '2026-10-21 25:00:00',
        '2026-10-21 12:34:57', '2026-10-22', '2026-08-22 12:34:55'] as $date) {
        newProductAssert(!QiqoNewProduct::isNew(['date_added' => $date, 'qiqo_introduced_at' => '2026-10-21', 'date_available' => '2026-10-21'], 60, $now),
            'Only a valid product.date_added inside the configured window may establish newness: ' . var_export($date, true));
    }
    foreach (['2026-08-22 12:34:56', '2026-09-01 01:02:03', '2026-10-21 12:34:56', '2026-10-21'] as $date) {
        newProductAssert(QiqoNewProduct::isNew(['date_added' => $date, 'qiqo_introduced_at' => '2000-01-01'], 60, $now), 'The rolling bounds are inclusive and SQL DATE values mean midnight.');
    }
    newProductAssert(!QiqoNewProduct::isNew(['qiqo_introduced_at' => '2026-10-21', 'date_available' => '2026-10-21'], 60, $now), 'ERP introduction and availability dates must never substitute for missing product.date_added.');
    newProductAssert(!QiqoNewProduct::isNew(['date_added' => '2000-01-01', 'qiqo_introduced_at' => '2026-10-21'], 60, $now), 'A recent ERP introduction must not override an old catalog creation date.');
    foreach ([0, -1, -60] as $days) {
        newProductAssert(!QiqoNewProduct::isNew(['date_added' => $now], $days, $now), 'Zero or negative label periods must disable newness.');
        $rejected = false;
        try { QiqoNewProduct::dateWindow($days, $now); } catch (InvalidArgumentException $error) { $rejected = true; }
        newProductAssert($rejected, 'A disabled period cannot produce a usable listing window.');
    }
    newProductAssert(!QiqoNewProduct::isNew(['date_added' => '2026-09-01 00:00:00'], 30, $now)
        && QiqoNewProduct::isNew(['date_added' => '2026-09-01 00:00:00'], 60, $now), 'Changing the configured label period must change list/badge eligibility.');
    newProductAssert(QiqoNewProduct::dateWindow(1, '2024-03-01 10:11:12') === ['2024-02-29 10:11:12', '2024-03-01 10:11:12'], 'Calendar-day subtraction must honor a leap day.');
    newProductAssert(QiqoNewProduct::dateWindow(1, '2023-03-01 10:11:12') === ['2023-02-28 10:11:12', '2023-03-01 10:11:12'], 'Calendar-day subtraction must honor a non-leap February.');
    newProductAssert(QiqoNewProduct::dateWindow(1, '2026-10-25 12:00:00') === ['2026-10-24 12:00:00', '2026-10-25 12:00:00'], 'Store-local calendar days must retain wall-clock time across a daylight-saving change.');
    newProductAssert(QiqoNewProduct::dateWindow(1, '2026-03-29 12:00:00') === ['2026-03-28 12:00:00', '2026-03-29 12:00:00'], 'The spring daylight-saving boundary must retain store-local time too.');
} finally {
    date_default_timezone_set($previousTimezone);
}

function menuRow($name, $link = '') {
    return ['name' => [3 => $name], 'link' => $link, 'submenu' => []];
}
$original = [menuRow('Naslovnica', '/'), menuRow('Brza narudžba', 'brza-narudzba'), menuRow('Rasprodaja', 'rasprodaja'), menuRow('Akcije', 'index.php?route=product/special'), menuRow('Novo u ponudi'), menuRow('Usluge i ponuda'), menuRow('Brandovi', 'brandovi'), menuRow('Blog', 'blog'), menuRow('Letak')];
$menu = QiqoPrimaryMenu::normalize($original, 3, 'index.php?route=product/new_product');
newProductAssert(array_column(array_column($menu, 'name'), 3) === ['Naslovnica', 'Brza narudžba', 'Novo', 'Akcije', 'Blog', 'Brandovi', 'Letak', 'Rasprodaja', 'Usluge i ponuda'], 'Requested menu sequence must be stable while retaining unrelated links.');
newProductAssert($menu[2]['link'] === 'index.php?route=product/new_product', 'Novo must point to the filtered page.');
newProductAssert($menu[6]['link'] === 'index.php?route=information/leaflet', 'Letak must always open the internal leaflet page.');
newProductAssert(QiqoPrimaryMenu::normalize($menu, 3, 'index.php?route=product/new_product') === $menu, 'Menu normalization must be idempotent.');
$withoutNew = [menuRow('Brza narudžba', 'brza-narudzba'), menuRow('Akcije', 'akcije')];
newProductAssert(count(QiqoPrimaryMenu::normalize($withoutNew, 3, 'novo')) === 4, 'Missing Novo and Letak links must be added.');
$unrelated = [menuRow('Kontakt', 'kontakt')];
newProductAssert(QiqoPrimaryMenu::normalize($unrelated, 3, 'novo') === $unrelated, 'Unrelated menus must be preserved.');

$activeMenu = QiqoPrimaryMenu::normalize($original, 3, 'novo', 'letak', ['route' => 'information/leaflet']);
newProductAssert($activeMenu[6]['link'] === 'letak' && $activeMenu[6]['qiqo_active'], 'Letak must use the generated internal URL and mark the current route.');
newProductAssert(count(array_filter($activeMenu, static function ($row) { return $row['qiqo_active']; })) === 1, 'Only the matching primary destination may be current.');
$activeMenu = QiqoPrimaryMenu::normalize($original, 3, 'novo', 'letak', ['route' => 'product/new_product', 'page' => 2, 'sort' => 'p.price']);
newProductAssert($activeMenu[2]['qiqo_active'], 'Pagination and sorting must retain the Novo active state.');
$activeMenu = QiqoPrimaryMenu::normalize($original, 3, 'novo', 'letak', ['route' => 'information/information', '_request_uri' => '/brza-narudzba?sort=name']);
newProductAssert($activeMenu[1]['qiqo_active'], 'SEO links must retain their active state with listing query parameters.');
$activeMenu = QiqoPrimaryMenu::normalize($original, 3, 'novo', 'letak', ['route' => 'product/special', 'page' => 3]);
newProductAssert($activeMenu[3]['qiqo_active'], 'Akcije must remain current when opened through its route rather than its SEO link.');

echo "QIQO new-product date and navigation tests passed.\n";
