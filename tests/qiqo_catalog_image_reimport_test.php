<?php

$imageRoot = sys_get_temp_dir() . '/qiqo-image-reimport-' . bin2hex(random_bytes(6));
mkdir($imageRoot, 0700);
define('DIR_IMAGE', $imageRoot . '/');
$outsideImage = tempnam(sys_get_temp_dir(), 'qiqo-outside-image-');
try {
    // Reuse the tested catalog feed/database fixture and run its baseline contracts.
    require __DIR__ . '/qiqo_catalog_reimport_test.php';
    $png = base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/x8AAwMCAO+aN1sAAAAASUVORK5CYII=');
    mkdir($imageRoot . '/Slike');
    mkdir($imageRoot . '/catalog');
    file_put_contents($imageRoot . '/Slike/exact.png', $png);
    file_put_contents($imageRoot . '/catalog/local.png', $png);
    file_put_contents($imageRoot . '/catalog/corrupt.png', 'not an image');
    $source = 'Slike//SRV-TS01/Svasta/Italcro/Photo/exact.png';
    $imageGroups = [['id' => '10', 'naziv' => 'Novi naziv', 'opis' => 'Opis grupe', 'picpath' => $source]];
    $imageData = QiqoSyncGuard::normalizeCatalogRows([$article], $imageGroups, $partners)['rows'][0];
    $matching = array_merge($local, $imageData, ['partner' => $imageData['partner_id'],
        'meta_title' => $imageData['name'], 'image' => '', 'upc' => 'preserved-original-source']);

    foreach (['', 'catalog/missing.png', 'catalog/corrupt.png'] as $oldImage) {
        $saved = array_merge($matching, ['image' => $oldImage, 'image_hash' => 'stale-image-hash']);
        list($model, $db) = catalogFixture($article, $imageGroups, $partners, $saved, $unreturned);
        $preview = $model->reconcileCatalog();
        catalogAssert($preview['success'] && $preview['updated'] === 1 && !$db->mutationQueries(),
            'An image-only repair must appear in preview without product or filesystem writes.');
        $applied = $model->reconcileCatalog(true);
        catalogAssert($applied['success'] && $applied['updated'] === 1 && $applied['added'] === 0
            && $db->rows[5965]['image'] === 'Slike/exact.png',
            'A blank, missing-file or corrupt main image must fill from the exact local ERP source.');
        catalogAssert($db->rows[5965]['image_hash'] === sha1_file($imageRoot . '/Slike/exact.png'),
            'A repaired main image must refresh the optional image hash.');
        foreach (['upc', 'date_added', 'qiqo_introduced_at', 'manufacturer_id'] as $field) {
            catalogAssert($db->rows[5965][$field] === $saved[$field], 'Image repair must preserve ' . $field . '.');
        }
        catalogAssert($db->rows[22] === $unreturned && count($db->rows) === 2,
            'An image repair must not affect other products or create new records.');
        $db->queries = [];
        $again = $model->reconcileCatalog(true);
        catalogAssert($again['success'] && $again['updated'] === 0 && $again['unchanged'] === 1 && !$db->mutationQueries(),
            'A repeated import must never rewrite an already repaired image.');
    }

    $saved = array_merge($matching, ['image' => 'catalog/local.png']);
    list($model, $db) = catalogFixture($article, $imageGroups, $partners, $saved, $unreturned);
    catalogAssert($model->reconcileCatalog()['unchanged'] === 1,
        'A valid local main image must take priority over a different ERP image.');
    $model->feed->articles[0]['zaliha'] = '3';
    $applied = $model->reconcileCatalog(true);
    catalogAssert($applied['success'] && $applied['updated'] === 1 && $db->rows[5965]['image'] === 'catalog/local.png'
        && $db->rows[5965]['upc'] === $saved['upc'],
        'Updating other ERP fields must preserve a valid main image and its original source metadata.');

    foreach (['Slike/unavailable.png', 'Slike/other-directory/exact.png',
        'Slike//UNKNOWN/Svasta/Italcro/Photo/exact.png', 'https://example.invalid/exact.png'] as $unavailable) {
        $unavailableGroups = [array_merge($imageGroups[0], ['picpath' => $unavailable])];
        list($model, $db) = catalogFixture($article, $unavailableGroups, $partners, $matching, $unreturned);
        $result = $model->reconcileCatalog(true);
        catalogAssert($result['success'] && $result['unchanged'] === 1 && !$db->mutationQueries()
            && $db->rows[5965]['image'] === '',
            'An unavailable or unsafe exact source must not invent an image or trigger a repair.');
    }

    mkdir($imageRoot . '/Portals'); mkdir($imageRoot . '/Portals/0'); mkdir($imageRoot . '/Portals/0/Photo');
    file_put_contents($imageRoot . '/Portals/0/Photo/portal.png', $png);
    $portalGroups = [array_merge($imageGroups[0], ['picpath' => '\\\\SRV-TS01\\Svasta\\Italcro\\Photo\\portal.png'])];
    list($model, $db) = catalogFixture($article, $portalGroups, $partners, $matching, $unreturned);
    $result = $model->reconcileCatalog(true);
    catalogAssert($result['success'] && $result['updated'] === 1 && $db->rows[5965]['image'] === 'Portals/0/Photo/portal.png'
        && is_file(DIR_IMAGE . $db->rows[5965]['image']),
        'A file found under Portals/0 must be stored relative to the web image root.');

    file_put_contents($outsideImage, $png);
    symlink($outsideImage, $imageRoot . '/Slike/escaped.png');
    $escapedGroups = [array_merge($imageGroups[0], ['picpath' => 'Slike/escaped.png'])];
    list($model, $db) = catalogFixture($article, $escapedGroups, $partners, $matching, $unreturned);
    catalogAssert($model->reconcileCatalog(true)['unchanged'] === 1 && !$db->mutationQueries(),
        'Image sources that resolve outside DIR_IMAGE must never be assigned.');

    list($model, $db) = catalogFixture(array_merge($article, ['id' => 'NEW-WITH-IMAGE']), $imageGroups, $partners, $matching, $unreturned);
    $created = $model->reconcileCatalog(true);
    catalogAssert($created['success'] && $created['added'] === 1 && $db->rows[101]['image'] === 'Slike/exact.png'
        && $db->rows[101]['upc'] === $source,
        'New imports must resolve known UNC images and retain their unmodified ERP source for later maintenance.');
    catalogAssert(!is_dir($imageRoot . '/catalog/qiqo'), 'These local image repairs must never create remote-download directories.');
    echo "QIQO exact-source image reimport tests passed (image-only planning, valid-image preservation, UNC/Portals paths, missing/unsafe sources and idempotence).\n";
} finally {
    if (is_file($outsideImage)) { unlink($outsideImage); }
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($imageRoot, FilesystemIterator::SKIP_DOTS), RecursiveIteratorIterator::CHILD_FIRST);
    foreach ($iterator as $entry) {
        if ($entry->isLink() || !$entry->isDir()) { unlink($entry->getPathname()); }
        else { rmdir($entry->getPathname()); }
    }
    rmdir($imageRoot);
}
