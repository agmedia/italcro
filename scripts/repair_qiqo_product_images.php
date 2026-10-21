<?php

// Only link missing Novo images to verified existing files. No downloads.
if (PHP_SAPI !== 'cli') { http_response_code(404); exit(1); }
$options = getopt('', ['apply', 'report:', 'help']);
if (isset($options['help'])) {
    echo "Usage: php scripts/repair_qiqo_product_images.php [--apply --report=/private/existing-directory/report.json]\n";
    echo "Default is read-only planning; --report writes an exclusive private backup/report. No images are downloaded or overwritten.\n";
    exit(0);
}
umask(0077);
ini_set('display_errors', '0');
$root = dirname(__DIR__);
$apply = isset($options['apply']);
$db = null; $locked = false; $reportPath = null;
$result = ['success' => false, 'dry_run' => !$apply, 'eligible' => 0, 'preserved' => 0,
    'planned' => 0, 'updated' => 0, 'conflicted' => 0, 'unresolved' => 0,
    'unresolved_skus' => [], 'cache_cleared' => null, 'report' => null];

function repairImageReport(string $path, array $report, bool $replace = false): void {
    $temporary = $replace ? $path . '.' . bin2hex(random_bytes(6)) . '.tmp' : $path;
    $file = @fopen($temporary, 'xb');
    if (!$file) { throw new RuntimeException('private_report_unavailable'); }
    @chmod($temporary, 0600);
    try {
        $json = json_encode($report, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        if ($json === false || fwrite($file, $json . "\n") !== strlen($json) + 1 || !fflush($file)) {
            throw new RuntimeException('private_report_unavailable');
        }
    } finally { fclose($file); }
    if ($replace && !@rename($temporary, $path)) { @unlink($temporary); throw new RuntimeException('private_report_unavailable'); }
}

function repairImageCanonical(string $source): ?string {
    $paths = QiqoCatalogImage::paths($source);
    foreach ($paths as $path) { if (strpos($path, 'Photo/') === 0) { return $path; } }
    return $paths ? $paths[0] : null;
}

/** Validate the actual stored path; Photo/Slike aliases do not make a broken main image valid. */
function repairImageFile(string $stored, string $imageRoot): ?string {
    if ($stored === '' || preg_match('/[\x00-\x1F\x7F]/', $stored)) { return null; }
    $file = realpath($imageRoot . $stored);
    return $file !== false && strpos($file, $imageRoot) === 0 && is_file($file)
        && is_readable($file) && @getimagesize($file) !== false ? $file : null;
}

try {
    if ($apply && empty($options['report'])) { throw new RuntimeException('apply_requires_private_report'); }
    require $root . '/upload/config.php';
    if (is_file($root . '/upload/env.php')) { require_once $root . '/upload/env.php'; }
    require_once DIR_SYSTEM . 'library/qiqo/new_product.php';
    require_once DIR_SYSTEM . 'library/qiqo/catalog_image.php';
    $webRoot = realpath($root . '/upload');
    if (isset($options['report'])) {
        $requested = (string)$options['report'];
        $directory = realpath(dirname($requested));
        if ($requested === '' || $requested[0] !== '/' || preg_match('/[\x00-\x1F\x7F]/', $requested)
            || !$directory || !is_dir($directory) || !is_writable($directory)
            || !$webRoot || $directory === $webRoot || strpos($directory . '/', $webRoot . '/') === 0
            || in_array(basename($requested), ['', '.', '..'], true)) { throw new RuntimeException('report_must_be_private_existing_directory'); }
        $reportPath = $directory . '/' . basename($requested);
        if (file_exists($reportPath) || is_link($reportPath)) { throw new RuntimeException('report_already_exists'); }
        $result['report'] = $reportPath;
    }
    if (!preg_match('/^[a-zA-Z0-9_]*$/D', DB_PREFIX)) { throw new RuntimeException('invalid_table_prefix'); }
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $db = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE, (int)DB_PORT);
    $db->set_charset('utf8mb4');
    $settings = [];
    $rows = $db->query("SELECT `key`,value FROM `" . DB_PREFIX . "setting` WHERE store_id=0 AND `key` IN ('newlabel_status','config_timezone','config_language')");
    while ($row = $rows->fetch_assoc()) {
        if (isset($settings[$row['key']])) { throw new RuntimeException('duplicate_store_setting'); }
        $settings[$row['key']] = $row['value'];
    }
    date_default_timezone_set((new DateTimeZone($settings['config_timezone'] ?? 'Europe/Zagreb'))->getName());
    $days = (int)($settings['newlabel_status'] ?? 0);
    $result['period_days'] = $days;
    if (empty($settings['config_language'])) { throw new RuntimeException('catalog_language_missing'); }
    $language = $db->query("SELECT language_id FROM `" . DB_PREFIX . "language` WHERE code='" . $db->real_escape_string($settings['config_language']) . "' LIMIT 1")->fetch_assoc();
    if (!$language) { throw new RuntimeException('catalog_language_missing'); }
    $lockName = $db->real_escape_string(DB_PREFIX . 'qiqo_product_catalog_write');
    $locked = (int)$db->query("SELECT GET_LOCK('" . $lockName . "',0) n")->fetch_assoc()['n'] === 1;
    if (!$locked) { throw new RuntimeException('catalog_sync_busy'); }
    $imageRoot = realpath(DIR_IMAGE);
    if (!$imageRoot) { throw new RuntimeException('image_root_missing'); }
    $imageRoot = rtrim($imageRoot, '/\\') . DIRECTORY_SEPARATOR;
    $hashColumn = $db->query("SHOW COLUMNS FROM `" . DB_PREFIX . "product` LIKE 'image_hash'")->num_rows > 0;
    $products = []; $targets = []; $donors = []; $plans = []; $unresolved = [];
    $window = $days > 0 ? QiqoNewProduct::dateWindow($days) : null;
    $result['window'] = $window;
    if ($window) {
        $products = $db->query("SELECT p.product_id,p.sku,p.upc,p.image" . ($hashColumn ? ',p.image_hash' : '') . " FROM `" . DB_PREFIX . "product` p
            WHERE p.status=1 AND p.date_available<=NOW() AND TRIM(p.sku)<>''
                AND p.date_added>='" . $db->real_escape_string($window[0]) . "' AND p.date_added<='" . $db->real_escape_string($window[1]) . "'
                AND EXISTS (SELECT 1 FROM `" . DB_PREFIX . "product_to_store` ps WHERE ps.product_id=p.product_id AND ps.store_id=0)
                AND EXISTS (SELECT 1 FROM `" . DB_PREFIX . "product_description` pd WHERE pd.product_id=p.product_id AND pd.language_id=" . (int)$language['language_id'] . ")
            ORDER BY p.product_id")->fetch_all(MYSQLI_ASSOC);
    }
    $result['eligible'] = count($products);
    foreach ($products as $product) {
        if (repairImageFile((string)$product['image'], $imageRoot)) { ++$result['preserved']; continue; }
        $canonical = repairImageCanonical((string)$product['upc']);
        $targets[] = ['product' => $product, 'canonical' => $canonical];
    }
    // Donors are selected only by exact source-path candidates, never by MPN or basename.
    $sourceValues = [];
    foreach ($targets as $target) {
        $sourceValues[(string)$target['product']['upc']] = true;
        foreach (QiqoCatalogImage::paths((string)$target['product']['upc']) as $path) { $sourceValues[$path] = true; }
        if ($target['canonical'] !== null && strpos($target['canonical'], 'Photo/') === 0) {
            $suffix = substr($target['canonical'], 6);
            foreach (['Slike//SRV-TS01/Svasta/Italcro/Photo/' . $suffix, '//SRV-TS01/Svasta/Italcro/Photo/' . $suffix,
                '\\\\SRV-TS01\\Svasta\\Italcro\\Photo\\' . str_replace('/', '\\', $suffix)] as $source) { $sourceValues[$source] = true; }
        }
    }
    unset($sourceValues['']);
    foreach (array_chunk(array_keys($sourceValues), 200) as $batch) {
        $quoted = array_map(static function ($source) use ($db) { return "'" . $db->real_escape_string($source) . "'"; }, $batch);
        $rows = $db->query('SELECT product_id,upc,image FROM `' . DB_PREFIX . "product` WHERE image<>'' AND upc IN (" . implode(',', $quoted) . ') ORDER BY product_id');
        while ($row = $rows->fetch_assoc()) {
            $canonical = repairImageCanonical((string)$row['upc']);
            if ($canonical === null || isset($donors[$canonical])) { continue; }
            $file = repairImageFile((string)$row['image'], $imageRoot);
            if ($file) { $donors[$canonical] = ['file' => $file, 'product_id' => (int)$row['product_id']]; }
        }
    }
    foreach ($targets as $target) {
        $product = $target['product'];
        $found = QiqoCatalogImage::resolve((string)$product['upc'], [DIR_IMAGE, rtrim(DIR_IMAGE, '/\\') . '/Portals/0']);
        $file = $found ? $found['path'] : null;
        $donorId = null;
        if (!$file && $target['canonical'] !== null && isset($donors[$target['canonical']])) {
            $file = $donors[$target['canonical']]['file'];
            $donorId = $donors[$target['canonical']]['product_id'];
        }
        if (!$file || strpos($file, $imageRoot) !== 0) {
            $unresolved[] = ['product_id' => (int)$product['product_id'], 'sku' => $product['sku'], 'upc' => $product['upc'], 'old_image' => $product['image']];
            continue;
        }
        $hash = sha1_file($file);
        if ($hash === false) { throw new RuntimeException('image_hash_failed'); }
        $plans[] = ['product_id' => (int)$product['product_id'], 'sku' => $product['sku'], 'upc' => $product['upc'],
            'canonical_source' => $target['canonical'], 'old_image' => $product['image'],
            'old_image_hash' => $product['image_hash'] ?? null, 'new_image' => substr($file, strlen($imageRoot)),
            'new_image_hash' => $hash, 'source_product_id' => $donorId];
    }
    $result['planned'] = count($plans); $result['unresolved'] = count($unresolved);
    $result['unresolved_skus'] = array_column($unresolved, 'sku');
    $report = ['created_at' => date('c'), 'phase' => 'prepared', 'result' => $result, 'plans' => $plans, 'unresolved' => $unresolved];
    // The immutable pre-change values are safely on disk before the first UPDATE.
    if ($reportPath) { repairImageReport($reportPath, $report); }
    if ($apply) {
        foreach ($plans as $plan) {
            $file = repairImageFile($plan['new_image'], $imageRoot);
            if (repairImageFile((string)$plan['old_image'], $imageRoot)
                || !$file || sha1_file($file) !== $plan['new_image_hash']) { ++$result['conflicted']; continue; }
            $sql = 'UPDATE `' . DB_PREFIX . "product` SET image='" . $db->real_escape_string($plan['new_image']) . "'";
            if ($hashColumn) { $sql .= ",image_hash='" . $db->real_escape_string($plan['new_image_hash']) . "'"; }
            $oldImage = $plan['old_image'] === null ? 'NULL' : "BINARY '" . $db->real_escape_string($plan['old_image']) . "'";
            $oldSource = $plan['upc'] === null ? 'NULL' : "BINARY '" . $db->real_escape_string($plan['upc']) . "'";
            $sql .= ' WHERE product_id=' . $plan['product_id']
                . ' AND BINARY image <=> ' . $oldImage . ' AND BINARY upc <=> ' . $oldSource;
            $db->query($sql);
            if ($db->affected_rows === 1) { ++$result['updated']; }
            else { ++$result['conflicted']; }
        }
        if ($result['updated'] > 0) {
            try {
                require_once DIR_SYSTEM . 'library/cache.php';
                require_once DIR_SYSTEM . 'library/cache/file.php';
                $cache = new Cache('file'); $cache->delete('product'); $cache->delete('megamenu');
                $result['cache_cleared'] = true;
            } catch (Throwable $ignored) { $result['cache_cleared'] = false; }
        }
    }
    $result['success'] = true;
    if ($reportPath) {
        $report['phase'] = $apply ? 'complete' : 'dry_run'; $report['result'] = $result;
        $report['finished_at'] = date('c'); repairImageReport($reportPath, $report, true);
    }
    echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . PHP_EOL;
} catch (Throwable $error) {
    $safe = ['apply_requires_private_report', 'private_report_unavailable', 'report_must_be_private_existing_directory',
        'report_already_exists', 'invalid_table_prefix', 'duplicate_store_setting', 'catalog_language_missing', 'catalog_sync_busy', 'image_root_missing', 'image_hash_failed'];
    $result['error'] = in_array($error->getMessage(), $safe, true) ? $error->getMessage() : 'image_repair_failed';
    echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . PHP_EOL;
    exit(1);
} finally {
    if ($locked && $db) { try { $db->query("SELECT RELEASE_LOCK('" . $lockName . "')"); } catch (Throwable $ignored) {} }
    if ($db) { $db->close(); }
}
