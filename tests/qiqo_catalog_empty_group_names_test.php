<?php

// Reuse the catalog writer fixture and run its complete baseline contract first.
require __DIR__ . '/qiqo_catalog_reimport_test.php';

$unusedBlankGroups = array_merge($groups, [['id' => '999', 'naziv' => '', 'podnaziv' => '']]);
$unused = QiqoSyncGuard::normalizeCatalogRows([$article], $unusedBlankGroups, $partners);
catalogAssert($unused['valid'] && count($unused['rows']) === 1 && $unused['rows'][0]['name'] === 'Novi naziv',
    'An unreferenced blank group must not block or alter a valid article.');

$blankGroups = [['id' => '10', 'naziv' => '', 'podnaziv' => '']];
$blank = QiqoSyncGuard::normalizeCatalogRows([$article], $blankGroups, $partners);
catalogAssert($blank['valid'] && $blank['rows'][0]['name'] === '',
    'A referenced blank ERP name must be deferred without fabricating a title.');
foreach ([
    [['id' => '', 'naziv' => '']],
    [['id' => str_repeat('1', 65), 'naziv' => '']],
    [['id' => "bad\nkey", 'naziv' => '']],
    [['id' => '10', 'naziv' => str_repeat('x', 256)]],
    [['id' => '10', 'naziv' => ''], ['id' => '10', 'naziv' => 'Conflicting label']],
] as $invalidGroups) {
    catalogAssert(!QiqoSyncGuard::normalizeCatalogRows([$article], $invalidGroups, $partners)['valid'],
        'Empty labels must not weaken group ID, length or conflicting duplicate validation.');
}

$activeArticle = array_merge($article, ['aktivan' => 'true', 'zaliha' => '5']);
$savedLocal = array_merge($local, ['name' => 'Postojeći lokalni naziv', 'meta_title' => 'Postojeći poseban SEO naslov']);
list($model, $db) = catalogFixture($activeArticle, $blankGroups, $partners, $savedLocal, $unreturned);
$preview = $model->reconcileCatalog();
catalogAssert($preview['success'] && $preview['missing_erp_names'] === 1 && $preview['retained_local_names'] === 1 && $preview['unresolved_names'] === 0 && !$db->mutationQueries(),
    'Dry run must report the retained exact-SKU title without writing.');
$result = $model->reconcileCatalog(true);
catalogAssert($result['success'] && $db->rows[5965]['name'] === $savedLocal['name'] && $db->rows[5965]['meta_title'] === $savedLocal['meta_title'],
    'An empty ERP label must preserve both the saved name and a customized meta title.');
catalogAssert((float)$db->rows[5965]['quantity'] === 5.0 && (int)$db->rows[5965]['status'] === 1 && $db->rows[22] === $unreturned,
    'Stock may refresh while active status and products absent from the feed remain intact.');
$db->queries = [];
$again = $model->reconcileCatalog(true);
catalogAssert($again['success'] && $again['unchanged'] === 1 && !$db->mutationQueries(),
    'Preserving local titles must remain idempotent on the next import.');

$metaOnlyLocal = array_merge($local, ['name' => '', 'meta_title' => 'Valjan postojeći naslov']);
list($model, $db) = catalogFixture($activeArticle, $blankGroups, $partners, $metaOnlyLocal, $unreturned);
$result = $model->reconcileCatalog(true);
catalogAssert($result['success'] && $result['retained_local_names'] === 1 && $db->rows[5965]['name'] === $metaOnlyLocal['meta_title'] && $db->rows[5965]['meta_title'] === $metaOnlyLocal['meta_title'],
    'An existing product meta title may supply its missing name without inventing ERP text.');

list($model, $db) = catalogFixture($activeArticle, $blankGroups, $partners, $local, $unreturned);
$result = $model->reconcileCatalog(true);
catalogAssert($result['success'] && $result['missing_erp_names'] === 1 && $result['unresolved_names'] === 1 && $result['retained_local_names'] === 0,
    'An existing SKU with no ERP or local name must still refresh numeric fields and report the unresolved title.');
catalogAssert($db->rows[5965]['name'] === '' && $db->rows[5965]['meta_title'] === '' && (float)$db->rows[5965]['quantity'] === 5.0 && (int)$db->rows[5965]['status'] === 1,
    'An unresolved existing title must remain unaltered while stock updates, without fabricating a name or disabling the product.');

list($model, $db) = catalogFixture($activeArticle, $groups, $partners, $savedLocal, $unreturned);
$model->feed->groups[] = ['id' => '11', 'naziv' => ''];
$model->feed->articles[] = array_merge($activeArticle, ['id' => 'NEW-UNNAMED', 'kataloggrupa' => '11']);
$result = $model->reconcileCatalog(true);
catalogAssert(!$result['success'] && $result['error'] === 'missing_catalog_name' && $result['missing_name_sku'] === 'NEW-UNNAMED' && !$result['partial'] && !$db->mutationQueries(),
    'A new unnamed SKU at the end of the feed must prevent every write, including earlier valid updates.');

echo "QIQO empty group-name reconciliation tests passed.\n";
