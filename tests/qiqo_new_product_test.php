<?php

require_once __DIR__ . '/../upload/system/library/qiqo/new_product.php';
require_once __DIR__ . '/../upload/system/library/qiqo/primary_menu.php';

function newProductAssert($condition, $message) {
    if (!$condition) {
        throw new RuntimeException($message);
    }
}

foreach ([null, '', '0000-00-00', '2026-02-30', '2026-10-15', '2026-07-13'] as $date) {
    newProductAssert(!QiqoNewProduct::isNew(['qiqo_introduced_at' => $date, 'date_added' => '2026-10-14', 'date_available' => '2026-10-14'], '2026-10-14'), 'Only a valid ERP date within the window may mark a product new: ' . var_export($date, true));
}
foreach (['2026-07-14', '2026-09-01', '2026-10-14'] as $date) {
    newProductAssert(QiqoNewProduct::isNew(['qiqo_introduced_at' => $date], '2026-10-14'), 'ERP dates within three calendar months are new.');
}
newProductAssert(!QiqoNewProduct::isNew(['date_added' => '2026-10-14'], '2026-10-14'), 'Reimport creation dates cannot imply newness.');
newProductAssert(QiqoNewProduct::dateWindow('2026-05-31') === ['2026-02-28', '2026-05-31'], 'Calendar subtraction must clamp a short month.');
newProductAssert(QiqoNewProduct::dateWindow('2024-05-31') === ['2024-02-29', '2024-05-31'], 'Calendar subtraction must handle leap years.');

function menuRow($name, $link = '') {
    return ['name' => [3 => $name], 'link' => $link, 'submenu' => []];
}
$original = [menuRow('Naslovnica', '/'), menuRow('Brza narudžba', 'brza-narudzba'), menuRow('Rasprodaja', 'rasprodaja'), menuRow('Akcije', 'index.php?route=product/special'), menuRow('Novo u ponudi'), menuRow('Usluge i ponuda'), menuRow('Brandovi', 'brandovi'), menuRow('Blog', 'blog'), menuRow('Letak')];
$menu = QiqoPrimaryMenu::normalize($original, 3, 'index.php?route=product/new_product');
newProductAssert(array_column(array_column($menu, 'name'), 3) === ['Naslovnica', 'Brza narudžba', 'Novo', 'Akcije', 'Blog', 'Brandovi', 'Letak', 'Rasprodaja', 'Usluge i ponuda'], 'Requested menu sequence must be stable while retaining unrelated links.');
newProductAssert($menu[2]['link'] === 'index.php?route=product/new_product', 'Novo must point to the filtered page.');
newProductAssert($menu[6]['link'] === '', 'The pending Letak URL must remain unset.');
newProductAssert(QiqoPrimaryMenu::normalize($menu, 3, 'index.php?route=product/new_product') === $menu, 'Menu normalization must be idempotent.');
$withoutNew = [menuRow('Brza narudžba', 'brza-narudzba'), menuRow('Akcije', 'akcije')];
newProductAssert(count(QiqoPrimaryMenu::normalize($withoutNew, 3, 'novo')) === 3, 'Missing Novo links must be added.');
$unrelated = [menuRow('Kontakt', 'kontakt')];
newProductAssert(QiqoPrimaryMenu::normalize($unrelated, 3, 'novo') === $unrelated, 'Unrelated menus must be preserved.');

echo "QIQO new-product date and navigation tests passed.\n";
