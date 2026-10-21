<?php
require_once __DIR__ . '/../upload/system/library/qiqo/catalog_image.php';

function catalogImagePathAssert($condition, string $message): void {
    if (!$condition) { throw new RuntimeException($message); }
}

$suffix = '7LijepilaSilikoni/0700620055.jpg';
foreach (['Slike//SRV-TS01/Svasta/Italcro/Photo/' . $suffix,
    '\\\\SRV-TS01\\Svasta\\Italcro\\Photo\\' . str_replace('/', '\\', $suffix),
    '//srv-ts01/svasta/italcro/photo/' . $suffix] as $source) {
    catalogImagePathAssert(QiqoCatalogImage::paths($source) === ['Photo/' . $suffix, 'Slike/' . $suffix], 'Only the known ERP UNC share must map to Photo and Slike candidates.');
}
catalogImagePathAssert(QiqoCatalogImage::paths('Slike/foo.jpg') === ['Slike/foo.jpg', 'Photo/foo.jpg'], 'A normal Slike path must retain its exact path first.');
catalogImagePathAssert(QiqoCatalogImage::paths('Photo/foo.jpg') === ['Photo/foo.jpg', 'Slike/foo.jpg'], 'A Photo path must retain its exact path first.');
catalogImagePathAssert(QiqoCatalogImage::paths('catalog/products/405054/foo.jpg') === ['catalog/products/405054/foo.jpg'], 'Existing catalog paths must not gain guessed alternatives.');
catalogImagePathAssert(QiqoCatalogImage::paths('/Slike/foo%20bar.jpg') === ['Slike/foo bar.jpg', 'Photo/foo bar.jpg'], 'One URL encoding layer and ERP leading slash must normalize safely.');
foreach (['../outside.png', 'Slike/../outside.png', 'Slike/./foo.png', 'Slike/%2e%2e/outside.png',
    'Slike/%252e%252e/outside.png', "Slike/a\0.png", "Slike/a\n.png", 'Slike/a%00.png',
    'https://external.invalid/a.png', 'file:///private/a.png', 'data:image/png;base64,AA==', 'C:\\Photo\\a.jpg',
    '//OTHER/Svasta/Italcro/Photo/a.jpg', '//SRV-TS010/Svasta/Italcro/Photo/a.jpg',
    '//SRV-TS01/Other/Italcro/Photo/a.jpg', 'Slike//OTHER/Svasta/Italcro/Photo/a.jpg',
    'Slike//SRV-TS01/Svasta/Italcro/Photo/../outside.jpg', 'Slike/folder/', ''] as $source) {
    catalogImagePathAssert(QiqoCatalogImage::paths($source) === [], 'Unsafe, ambiguous or unknown-share image path must be rejected.');
}

$directory = sys_get_temp_dir() . '/qiqo-image-paths-' . bin2hex(random_bytes(6));
$imageRoot = $directory . '/images';
$portalRoot = $directory . '/portal';
mkdir($directory, 0700); mkdir($imageRoot, 0700); mkdir($portalRoot, 0700);
$png = base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/x8AAwMCAO+aN1sAAAAASUVORK5CYII=');
try {
    mkdir($imageRoot . '/Slike'); mkdir($portalRoot . '/Photo');
    file_put_contents($imageRoot . '/Slike/foo.jpg', $png);
    file_put_contents($portalRoot . '/Photo/foo.jpg', $png);
    file_put_contents($portalRoot . '/Photo/only-local.jpg', $png);
    file_put_contents($portalRoot . '/Photo/not-image.jpg', 'not an image');
    file_put_contents($directory . '/outside.jpg', $png);
    $before = hash_file('sha256', $imageRoot . '/Slike/foo.jpg');
    $found = QiqoCatalogImage::resolve('Slike/foo.jpg', [$portalRoot, $imageRoot]);
    catalogImagePathAssert($found && $found['path'] === realpath($imageRoot . '/Slike/foo.jpg') && $found['relative'] === 'Slike/foo.jpg', 'Exact source paths must win over aliases across all supplied roots.');
    $found = QiqoCatalogImage::resolve('Slike//SRV-TS01/Svasta/Italcro/Photo/only-local.jpg', [$imageRoot, $portalRoot]);
    catalogImagePathAssert($found && $found['path'] === realpath($portalRoot . '/Photo/only-local.jpg') && $found['root'] === realpath($portalRoot), 'Known UNC images must resolve within the supplied Portal root.');
    catalogImagePathAssert(QiqoCatalogImage::resolve('Photo/not-image.jpg', [$portalRoot]) === null, 'A matching extension cannot substitute for actual valid image content.');
    catalogImagePathAssert(QiqoCatalogImage::resolve('../outside.jpg', [$imageRoot]) === null, 'Relative traversal must never escape an image root.');
    symlink($directory . '/outside.jpg', $imageRoot . '/Slike/escape.jpg');
    symlink($directory, $imageRoot . '/escape-dir');
    symlink($imageRoot . '/Slike/foo.jpg', $imageRoot . '/Slike/inside.jpg');
    catalogImagePathAssert(QiqoCatalogImage::resolve('Slike/escape.jpg', [$imageRoot]) === null
        && QiqoCatalogImage::resolve('escape-dir/outside.jpg', [$imageRoot]) === null, 'Realpath containment must reject escaping file and directory symlinks.');
    catalogImagePathAssert(QiqoCatalogImage::resolve('Slike/inside.jpg', [$imageRoot])['path'] === realpath($imageRoot . '/Slike/foo.jpg'), 'An internal symlink resolving within an explicitly allowed root may be reused.');
    catalogImagePathAssert(QiqoCatalogImage::resolve('Photo/missing.jpg', [$portalRoot, $directory . '/missing', null]) === null, 'Missing roots and files must return no match without external requests.');
    catalogImagePathAssert(hash_file('sha256', $imageRoot . '/Slike/foo.jpg') === $before, 'Resolving an image must never rewrite its contents.');
    echo "QIQO image path tests passed (known ERP UNC, Slike/Photo aliases, exact-path precedence, traversal/protocol/control rejection, valid content and realpath containment; no network).\n";
} finally {
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory, FilesystemIterator::SKIP_DOTS), RecursiveIteratorIterator::CHILD_FIRST);
    foreach ($iterator as $entry) { ($entry->isDir() && !$entry->isLink()) ? rmdir($entry->getPathname()) : unlink($entry->getPathname()); }
    rmdir($directory);
}
