<?php
$options = getopt('', ['renderer:']);
if (isset($options['renderer'])) { define('LEAFLET_PDFTOPPM_BINARY', $options['renderer']); }
$directory = sys_get_temp_dir() . '/italcro-leaflet-files-' . bin2hex(random_bytes(6));
mkdir($directory, 0700); mkdir($directory . '/private', 0700); mkdir($directory . '/images', 0700);
define('DIR_DOWNLOAD', $directory . '/private/');
define('DIR_IMAGE', $directory . '/images/');
define('DIR_SYSTEM', __DIR__ . '/../upload/system/');
require_once DIR_SYSTEM . 'library/leaflet/files.php';
function leafletFileAssert($condition, string $message): void { if (!$condition) { throw new RuntimeException($message); } }
$fixture = is_file(__DIR__ . '/fixtures/leaflet.pdf') ? __DIR__ . '/fixtures/leaflet.pdf' : '/tmp/italcro-leaflet-qa/leaflet-fixture.pdf';
try {
    leafletFileAssert(is_file($fixture), 'The marked two-page PDF fixture must be available.');
    leafletFileAssert(LeafletFiles::validPdf($fixture), 'A genuine PDF must pass signature, MIME and size checks.');
    file_put_contents($directory . '/html.pdf', '<html>This is not a PDF.</html>');
    leafletFileAssert(!LeafletFiles::validPdf($directory . '/html.pdf'), 'An extension alone cannot validate a PDF.');
    $large = fopen($directory . '/oversized.pdf', 'wb'); fwrite($large, "%PDF-1.4\n"); ftruncate($large, LeafletFiles::MAX_BYTES + 1); fclose($large);
    leafletFileAssert(!LeafletFiles::validPdf($directory . '/oversized.pdf'), 'The PDF cap must be enforced before content processing.');
    foreach (['../leaflet.pdf', str_repeat('a', 32) . '.php', 'https://external.invalid/leaflet.pdf', "bad\0.pdf"] as $name) {
        leafletFileAssert(LeafletFiles::pdfPath($name) === null, 'Managed PDF names cannot contain paths, URLs or executable extensions.');
    }
    $filename = str_repeat('a', 32) . '.pdf';
    mkdir(DIR_DOWNLOAD . 'leaflets', 0700);
    copy($fixture, DIR_DOWNLOAD . 'leaflets/' . $filename); chmod(DIR_DOWNLOAD . 'leaflets/' . $filename, 0600);
    leafletFileAssert(LeafletFiles::pdfPath($filename) === realpath(DIR_DOWNLOAD . 'leaflets/' . $filename), 'A managed private PDF must resolve within its private directory.');
    $escaped = str_repeat('b', 32) . '.pdf';
    symlink($fixture, DIR_DOWNLOAD . 'leaflets/' . $escaped);
    leafletFileAssert(LeafletFiles::pdfPath($escaped) === null, 'A PDF symlink cannot escape private leaflet storage.');
    $rejected = false;
    try { LeafletFiles::storeUpload(['error' => UPLOAD_ERR_OK, 'tmp_name' => $fixture, 'name' => 'letak.pdf']); }
    catch (RuntimeException $error) { $rejected = true; }
    leafletFileAssert($rejected, 'A local filename cannot impersonate a genuine HTTP upload.');
    $png = base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/x8AAwMCAO+aN1sAAAAASUVORK5CYII=');
    file_put_contents(DIR_IMAGE . 'manual.png', $png);
    file_put_contents(DIR_IMAGE . 'fake.jpg', '<svg xmlns="http://www.w3.org/2000/svg"></svg>');
    symlink($fixture, DIR_IMAGE . 'outside.png');
    leafletFileAssert(LeafletFiles::validThumbnail('manual.png'), 'A genuine manual raster cover must remain available as a fallback.');
    leafletFileAssert(!LeafletFiles::validThumbnail('fake.jpg') && !LeafletFiles::validThumbnail('../html.pdf')
        && !LeafletFiles::validThumbnail('outside.png'), 'Covers require real raster content and image-root containment.');
    $before = hash_file('sha256', $fixture);
    $thumbnail = LeafletFiles::thumbnail($filename);
    if (isset($options['renderer'])) {
        leafletFileAssert($thumbnail !== '' && LeafletFiles::validThumbnail($thumbnail), 'An explicitly available PDF renderer must generate a validated first-page cover.');
        $image = imagecreatefromjpeg(DIR_IMAGE . $thumbnail);
        $color = imagecolorsforindex($image, imagecolorat($image, (int)(imagesx($image) / 2), (int)(imagesy($image) / 2)));
        imagedestroy($image);
        leafletFileAssert($color['blue'] > $color['red'], 'The generated cover must use the blue first page, not the red second page.');
    }
    if ($thumbnail !== '') {
        $coverHash = hash_file('sha256', DIR_IMAGE . $thumbnail);
        leafletFileAssert(LeafletFiles::thumbnail($filename) === $thumbnail && hash_file('sha256', DIR_IMAGE . $thumbnail) === $coverHash,
            'An existing valid generated cover must be reused without overwrite.');
    }
    LeafletFiles::archive(['leaflet_id' => 17, 'title' => '<Example>', 'filename' => $filename]);
    $archives = glob(DIR_DOWNLOAD . 'leaflets/archive-*.json');
    leafletFileAssert(count($archives) === 1 && json_decode(file_get_contents($archives[0]), true)['leaflet']['filename'] === $filename
        && (fileperms($archives[0]) & 0777) === 0600, 'Recovery metadata must be written privately before record replacement/deletion.');
    leafletFileAssert(hash_file('sha256', $fixture) === $before && is_file(DIR_DOWNLOAD . 'leaflets/' . $filename), 'Generating a cover or recovery archive must preserve original PDFs.');
    if (function_exists('proc_open')) {
        $render = new ReflectionMethod(LeafletFiles::class, 'render'); $render->setAccessible(true);
        leafletFileAssert($render->invoke(null, [PHP_BINARY, '-r', 'exit(1);']) === false
            && $render->invoke(null, [PHP_BINARY, '-r', 'exit(0);']) === true,
            'A failed renderer must never publish a partial output as a successful cover.');
    }
    echo "Leaflet private-file tests passed (PDF validation/cap, upload provenance, private paths, safe manual covers, recoverable metadata and first-page rendering when available).\n";
} finally {
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory, FilesystemIterator::SKIP_DOTS), RecursiveIteratorIterator::CHILD_FIRST);
    foreach ($iterator as $entry) { ($entry->isDir() && !$entry->isLink()) ? rmdir($entry->getPathname()) : unlink($entry->getPathname()); }
    rmdir($directory);
}
