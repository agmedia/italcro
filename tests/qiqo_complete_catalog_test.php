<?php

define('DB_DATABASE', 'testdb');
// Reuse the feed/DB fixtures and run their delta-contract regressions first.
require __DIR__ . '/qiqo_catalog_reimport_test.php';

class CompleteCatalogDbStub extends CatalogDbStub
{
    public $failMissing = false;
    public $classificationRows = [];
    public $categoryRows = [];
    public $categoryLookup = ['Rasprodaja' => [309], 'Test category' => [20]];
    private $categorySnapshot;
    public function query($sql) {
        if (preg_match("/^SELECT DISTINCT cd.category_id .*WHERE cd.name='([^']+)'/", $sql, $m)) {
            $this->queries[] = $sql;
            $rows = array_map(static function ($id) { return ['category_id' => $id]; }, $this->categoryLookup[$m[1]] ?? []);
            return (object)['rows' => $rows, 'row' => $rows[0] ?? [], 'num_rows' => count($rows)];
        }
        if ($sql === 'START TRANSACTION') $this->categorySnapshot = $this->categoryRows;
        if ($sql === 'ROLLBACK') $this->categoryRows = $this->categorySnapshot;
        if (preg_match('/^INSERT IGNORE INTO `test_product_to_category` .*SELECT p.product_id,(\d+) FROM `test_product` p WHERE p.sku IN \((.*)\)$/', $sql, $m)) {
            $this->queries[] = $sql; preg_match_all("/'([^']+)'/", $m[2], $skuMatches);
            foreach ($this->rows as $product) {
                if (!in_array(strtolower($product['sku']), $skuMatches[1], true)) continue;
                $link = ['product_id' => (int)$product['product_id'], 'category_id' => (int)$m[1]];
                if (!in_array($link, $this->categoryRows)) $this->categoryRows[] = $link;
            }
            return true;
        }
        if (preg_match('/^DELETE pc FROM `test_product_to_category` .*p.sku IN \((.*)\) AND pc.category_id<>(\d+)$/', $sql, $m)) {
            $this->queries[] = $sql; preg_match_all("/'([^']+)'/", $m[1], $skuMatches);
            $ids = [];
            foreach ($this->rows as $product) if (in_array(strtolower($product['sku']), $skuMatches[1], true)) $ids[] = (int)$product['product_id'];
            $this->categoryRows = array_values(array_filter($this->categoryRows, static function ($row) use ($ids, $m) {
                return !in_array((int)$row['product_id'], $ids, true) || (int)$row['category_id'] === (int)$m[2];
            }));
            return true;
        }
        if ($sql === 'SELECT article_code,classification FROM `test_qiqo_article_classification`') {
            $this->queries[] = $sql;
            return (object)['rows' => $this->classificationRows];
        }
        if ($sql === 'SELECT product_id,category_id FROM `test_product_to_category`') {
            $this->queries[] = $sql;
            return (object)['rows' => $this->categoryRows];
        }
        if (preg_match("/^UPDATE `test_product` SET status = '0', date_modified = NOW\(\) WHERE product_id = '(\d+)' AND status <> '0'$/", $sql, $match)) {
            $this->queries[] = $sql;
            if ($this->failMissing) throw new RuntimeException('Injected missing-product write failure.');
            $this->rows[(int)$match[1]]['status'] = '0';
            return true;
        }
        return parent::query($sql);
    }
}

class CompleteCatalogTestModel extends CatalogTestModel
{
    public $classifications = [];
    public $failClassifications = false;
    public function syncArticleClassifications(array $articles): int {
        throw new RuntimeException('Complete imports must not apply global delta category rules to absent legacy rows.');
    }
    protected function persistCatalogClassifications(array $values): void {
        $this->classifications[] = $values;
        if ($this->failClassifications) throw new RuntimeException('Injected category failure.');
    }
}

function completeSource($sku, $active = 'true') {
    global $article;
    return array_merge($article, ['id' => $sku, 'aktivan' => $active]);
}

function completeStored($sku, $id, $active = 1) {
    global $groups, $partners, $local;
    $data = QiqoSyncGuard::normalizeCatalogRows([completeSource($sku)], $groups, $partners)['rows'][0];
    return array_merge($local, $data, ['product_id' => $id, 'partner' => 20,
        'description_product_id' => $id, 'status' => $active, 'meta_title' => $data['name']]);
}

function completeFixture() {
    global $groups, $partners;
    $db = new CompleteCatalogDbStub();
    $db->rows = [201 => completeStored('REACTIVATE', 201, 0),
        202 => completeStored('RETURNED-FALSE', 202), 203 => completeStored('MISSING', 203),
        204 => completeStored('UNCHANGED', 204)];
    foreach ($db->rows as $row) $db->categoryRows[] = ['product_id' => (int)$row['product_id'], 'category_id' => 20];
    $config = new Config();
    foreach (['confirmed' => '1', 'since' => '2000-01-01', 'min_ratio' => '0.1', 'max_deactivation_ratio' => '1'] as $key => $value) {
        $config->set('qiqo_catalog_snapshot_' . $key, $value);
    }
    $registry = new Registry();
    $registry->set('db', $db); $registry->set('config', $config); $registry->set('cache', new CatalogCacheSpy());
    $model = new CompleteCatalogTestModel($registry);
    $model->feed = new CatalogFeedStub();
    $model->feed->groups = $groups; $model->feed->partners = $partners;
    $model->feed->articles = [completeSource('REACTIVATE'), completeSource('RETURNED-FALSE', 'false'),
        completeSource('UNCHANGED'), completeSource('NEW-ACTIVE'), completeSource('NEW-INACTIVE', 'false')];
    return [$model, $db, $config, $registry];
}

list($model, $db, $config, $registry) = completeFixture();
$preview = $model->reconcileCompleteCatalog();
catalogAssert($preview['success'] && $preview['added'] === 1 && $preview['reactivated'] === 1
    && $preview['disabled'] === 2 && $preview['missing_active'] === 1 && $preview['missing_skus'] === ['MISSING']
    && $preview['new_inactive_skipped'] === 1, 'Complete preview must distinguish additions, false and missing products.');
catalogAssert($preview['classification_changes'] === 5 && $preview['has_changes'], 'Preview must include metadata drift when products need no other repair.');
catalogAssert(!$db->mutationQueries() && !$model->classifications && !$registry->get('cache')->deleted,
    'Complete preview must change neither products, categories nor caches.');
$applied = $model->reconcileCompleteCatalog(true);
catalogAssert($applied['success'] && $applied['added'] === 1 && $applied['disabled'] === 2
    && (int)$db->rows[201]['status'] === 1 && (int)$db->rows[202]['status'] === 0
    && (int)$db->rows[203]['status'] === 0 && $db->rows[101]['sku'] === 'NEW-ACTIVE',
    'Complete apply must create only active new products and hide false/missing products.');
catalogAssert(count($db->rows) === 5 && $db->rows[201]['date_added'] === '2020-01-01 00:00:00',
    'Complete reconciliation must retain existing product IDs/dates and never create absent inactive products.');
catalogAssert(!array_filter($db->mutationQueries(), static function ($sql) { return preg_match('/^DELETE\s+FROM\s+`test_product`/i', $sql); }),
    'Missing products must be hidden without deleting product/order history.');
$second = $model->reconcileCompleteCatalog(true);
catalogAssert($second['success'] && $second['added'] === 0 && $second['updated'] === 0 && $second['disabled'] === 0
    && count($model->classifications) === 2, 'Repeated complete apply must still repair category assignments without creating products again.');
$db->classificationRows = array_map(static function ($row) { return ['article_code' => $row['id'], 'classification' => $row['gid']]; }, $model->feed->articles);
$clean = $model->reconcileCompleteCatalog();
catalogAssert($clean['success'] && !$clean['has_changes'] && $clean['classification_changes'] === 0
    && $clean['category_changes'] === 0, 'An unchanged complete preview must certify no product/category/classification drift.');
$db->categoryRows[] = ['product_id' => 204, 'category_id' => 55];
$stale = $model->reconcileCompleteCatalog();
catalogAssert($stale['has_changes'] && $stale['category_changes'] === 1,
    'A regular product retaining any stale category must trigger a category repair even with unchanged product fields.');
$repaired = $model->reconcileCompleteCatalog(true);
$links204 = array_values(array_filter($db->categoryRows, static function ($row) { return (int)$row['product_id'] === 204; }));
catalogAssert($repaired['success'] && $links204 === [['product_id' => 204, 'category_id' => 20]],
    'Complete reconciliation must replace all old regular-category assignments with the single current ERP category.');

foreach (['unmapped', 'missing', 'ambiguous'] as $case) {
    list($model, $db) = completeFixture();
    if ($case === 'unmapped') $model->feed->articles[0]['gid'] = '999';
    if ($case === 'missing') $db->categoryLookup['Test category'] = [];
    if ($case === 'ambiguous') $db->categoryLookup['Test category'] = [20, 21];
    $result = $model->reconcileCompleteCatalog(true);
    catalogAssert(!$result['success'] && $result['error'] === 'catalog_category_mapping_failed'
        && $result['category_mapping_errors'] && !$db->mutationQueries(),
        'Missing/ambiguous ERP-to-category mapping must fail before any write: ' . $case);
}

foreach (['inactive_absent', 'active_absent', 'inactive_returned', 'normalized_inactive_absent'] as $case) {
    list($model, $db) = completeFixture();
    $db->duplicates = true;
    $db->rows[901] = completeStored('LEGACY-BARCODE', 901, 0);
    $db->rows[902] = completeStored($case === 'normalized_inactive_absent' ? ' legacy-barcode ' : 'LEGACY-BARCODE', 902,
        $case === 'active_absent' ? 1 : 0);
    $db->categoryRows[] = ['product_id' => 901, 'category_id' => 55];
    $db->categoryRows[] = ['product_id' => 902, 'category_id' => 88];
    $db->classificationRows[] = ['article_code' => 'LEGACY-BARCODE', 'classification' => 800];
    if ($case === 'inactive_returned') $model->feed->articles[] = completeSource('LEGACY-BARCODE');
    $original = [$db->rows[901], $db->rows[902]];
    $result = $model->reconcileCompleteCatalog(true);
    if (in_array($case, ['inactive_absent', 'normalized_inactive_absent'], true)) {
        catalogAssert($result['success'] && $result['ignored_inactive_duplicate_groups'] === 1
            && $result['ignored_inactive_duplicate_rows'] === 2 && [$db->rows[901], $db->rows[902]] === $original,
            'Entire inactive legacy duplicate groups outside the complete ERP response must remain untouched.');
        $legacyLinks = array_values(array_filter($db->categoryRows, static function ($row) { return in_array((int)$row['product_id'], [901, 902], true); }));
        catalogAssert($legacyLinks === [['product_id' => 901, 'category_id' => 55], ['product_id' => 902, 'category_id' => 88]],
            'Ignored inactive legacy category links must remain untouched, including stale clearance metadata.');
    } else {
        catalogAssert(!$result['success'] && $result['error'] === 'duplicate_local_sku' && !$db->mutationQueries(),
            'An active or ERP-present ambiguous SKU must always block the complete batch.');
    }
}

list($model, $db, $config) = completeFixture();
$config->set('qiqo_catalog_snapshot_confirmed', '0');
catalogAssert($model->reconcileCompleteCatalog()['success'], 'Unconfirmed historical data can be previewed safely.');
$db->queries = [];
catalogAssert($model->reconcileCompleteCatalog(true)['error'] === 'catalog_snapshot_not_confirmed' && !$db->queries,
    'Apply must be rejected before any ERP/DB work unless this catalog snapshot is explicitly confirmed.');
catalogAssert($model->reconcileCompleteCatalog(true, ['snapshot_since' => '2026-01-01'])['error'] === 'catalog_snapshot_not_confirmed',
    'A different requested date must not bypass the confirmed historical window.');
$config->set('qiqo_catalog_snapshot_since', '');
catalogAssert($model->reconcileCompleteCatalog()['error'] === 'catalog_snapshot_date_required', 'A rolling/default window is never a complete snapshot.');
catalogAssert($model->reconcileCompleteCatalog(false, ['snapshot_since' => '2000-01-01'])['success'],
    'An explicit historical preview must remain available before setting opt-in configuration.');

foreach (['empty', 'invalid_tail', 'transport', 'small_snapshot', 'deactivation_limit', 'skip_active'] as $failure) {
    list($model, $db, $config) = completeFixture();
    $options = [];
    if ($failure === 'empty') $model->feed->articles = [];
    if ($failure === 'invalid_tail') $model->feed->articles[] = ['id' => 'BAD'];
    if ($failure === 'transport') $model->feed->success = false;
    if ($failure === 'small_snapshot') { $model->feed->articles = [completeSource('UNCHANGED')]; $config->set('qiqo_catalog_snapshot_min_ratio', '0.8'); }
    if ($failure === 'deactivation_limit') $config->set('qiqo_catalog_snapshot_max_deactivation_ratio', '0.2');
    if ($failure === 'skip_active') $options['skip_unnamed_new'] = true;
    $result = $model->reconcileCompleteCatalog(true, $options);
    catalogAssert(!$result['success'] && !$db->mutationQueries() && !$model->classifications,
        'Unsafe snapshot must reject all mutations: ' . $failure);
}
foreach (['min_ratio', 'max_deactivation_ratio'] as $key) {
    foreach (['0', '-1', '1.1', 'NaN', 'oops'] as $bad) {
        list($model, $db, $config) = completeFixture();
        $config->set('qiqo_catalog_snapshot_' . $key, $bad);
        catalogAssert($model->reconcileCompleteCatalog(true)['error'] === 'invalid_catalog_snapshot_policy' && !$db->mutationQueries(),
            'Malformed snapshot limits must not disable guards.');
    }
}
list($model, $db) = completeFixture();
$model->feed->groups = [['id' => '10', 'naziv' => '']];
$model->feed->articles[] = completeSource('SECOND-UNNAMED');
$result = $model->reconcileCompleteCatalog(true);
catalogAssert($result['error'] === 'missing_catalog_name'
    && $result['missing_name_skus'] === ['NEW-ACTIVE', 'SECOND-UNNAMED'] && !$db->mutationQueries(),
    'Complete preflight must report every unnamed new active product before changing any product.');

$deferred = ['500172','503825','508223','502794','91317','444273','513735','400474','503713',
    '511644','480576','480573','507182','506806','501039','509503','514400'];
list($model, $db, $config) = completeFixture();
$config->set('qiqo_catalog_deferred_unnamed_skus', json_encode($deferred));
foreach ($deferred as $sku) $model->feed->articles[] = array_merge(completeSource($sku),
    ['kataloggrupa' => '0', 'dimmodel' => '', 'opiskatalog' => '']);
$result = $model->reconcileCompleteCatalog(true);
catalogAssert($result['success'] && $result['added'] === 1 && $result['deferred_unnamed_count'] === 17
    && $result['deferred_unnamed_skus'] === $deferred && count($result['warnings']) === 17,
    'Only the explicitly configured unnamed new active SKUs may be deferred while the rest of the full catalog applies.');
foreach ($deferred as $sku) {
    catalogAssert(!array_filter($db->rows, static function ($row) use ($sku) { return $row['sku'] === $sku; })
        && !array_key_exists($sku, $model->classifications[0]),
        'Deferred SKUs must create neither products nor classification rows.');
}
foreach ($result['warnings'] as $warning) catalogAssert($warning['code'] === 'deferred_catalog_name'
    && in_array($warning['article'], $deferred, true), 'Deferred articles must produce safe structured alert metadata.');
foreach ($model->feed->articles as &$row) if ($row['id'] === '500172') $row['kataloggrupa'] = '10'; unset($row);
$namedLater = $model->reconcileCompleteCatalog(true);
catalogAssert($namedLater['success'] && $namedLater['added'] === 1 && $namedLater['deferred_unnamed_count'] === 16
    && !in_array('500172', $namedLater['deferred_unnamed_skus'], true)
    && count(array_filter($db->rows, static function ($row) { return $row['sku'] === '500172'; })) === 1,
    'When ERP supplies a valid title, a formerly deferred SKU must import automatically even while still on the allowlist.');
$db->queries = [];
$model->feed->articles[] = array_merge(completeSource('UNAPPROVED'), ['kataloggrupa' => '0']);
$blocked = $model->reconcileCompleteCatalog(true);
catalogAssert(!$blocked['success'] && $blocked['error'] === 'missing_catalog_name'
    && $blocked['missing_name_skus'] === ['UNAPPROVED'] && !$db->mutationQueries(),
    'The exception list must never enable broad skipping of other unnamed new active products.');
foreach (['{}', '{"0":"500172"}', '[500172]', '[" 500172"]', '["bad\\nvalue"]', 'null', '[', ['500172']] as $invalid) {
    list($model, $db, $config) = completeFixture();
    $config->set('qiqo_catalog_deferred_unnamed_skus', $invalid);
    $blocked = $model->reconcileCompleteCatalog(true);
    catalogAssert(!$blocked['success'] && $blocked['error'] === 'invalid_catalog_deferred_unnamed_skus' && !$db->queries,
        'Malformed exception policy must fail before any ERP/DB mutation.');
}
foreach (['missing_product', 'classification'] as $failure) {
    list($model, $db) = completeFixture();
    $original = $db->rows;
    if ($failure === 'missing_product') $db->failMissing = true;
    else $model->failClassifications = true;
    $result = $model->reconcileCompleteCatalog(true);
    catalogAssert(!$result['success'] && !$result['partial'] && $db->rows === $original,
        'An InnoDB error must roll back additions/statuses together with category reconciliation: ' . $failure);
}
list($model, $db) = completeFixture();
$db->engine = 'MyISAM';
$result = $model->reconcileCompleteCatalog(true);
catalogAssert($result['error'] === 'maintenance_backup_required' && !$db->mutationQueries(),
    'Scheduled/CLI full apply must preserve the maintenance and private-backup requirement on MyISAM.');

// Completion logging happens after commit. It must never produce success=true/partial=true.
list($model, $db) = completeFixture();
Log::$failCatalogEnd = true;
try { $result = $model->reconcileCompleteCatalog(true); }
finally { Log::$failCatalogEnd = false; }
catalogAssert(!$result['success'] && $result['partial'] && $result['error'] === 'catalog_sync_failed'
    && (int)$db->rows[203]['status'] === 0, 'An exception after commit must report failure with a possibly committed outcome.');

foreach (['valid', 'log_file', 'missing_checksum', 'wrong_checksum', 'public_sql', 'public_checksum', 'stale_sql', 'stale_checksum', 'wrong_database'] as $case) {
    $directory = sys_get_temp_dir() . '/qiqo-complete-backup-' . bin2hex(random_bytes(6));
    mkdir($directory, 0700); $directory = realpath($directory);
    $path = $directory . '/qiqo-database-' . gmdate('Ymd\THis\Z') . '-012345abcdef.sql';
    try {
        $contents = "-- private test dump\nUSE `testdb`;\n-- Dump completed on 2026-11-02 12:00:00\n";
        if ($case === 'log_file') $contents = 'This is a readable nonempty log, not a database backup.';
        if ($case === 'wrong_database') $contents = str_replace('`testdb`', '`differentdb`', $contents);
        file_put_contents($path, $contents); chmod($path, 0600);
        file_put_contents($path . '.sha256', hash_file('sha256', $path) . '  ' . basename($path) . "\n"); chmod($path . '.sha256', 0600);
        if ($case === 'missing_checksum') unlink($path . '.sha256');
        if ($case === 'wrong_checksum') file_put_contents($path . '.sha256', str_repeat('0', 64) . '  ' . basename($path));
        if ($case === 'public_sql') chmod($path, 0644);
        if ($case === 'public_checksum') chmod($path . '.sha256', 0644);
        if ($case === 'stale_sql') touch($path, time() - 7200);
        if ($case === 'stale_checksum') touch($path . '.sha256', time() - 7200);
        list($model, $db, $config) = completeFixture();
        $db->engine = 'MyISAM'; $config->set('config_maintenance', '1');
        $result = $model->reconcileCompleteCatalog(true, ['allow_nontransactional' => true, 'backup_path' => $path]);
        if ($case === 'valid') {
            catalogAssert($result['success'] && $result['backup_sha256'] === hash_file('sha256', $path),
                'A complete CLI apply must accept a fresh protected completed matching-database SQL backup.');
        } else {
            catalogAssert(!$result['success'] && $result['error'] === 'maintenance_backup_required' && !$db->mutationQueries(),
                'Invalid direct complete-apply backup must reject every write: ' . $case);
        }
    } finally {
        foreach (glob($directory . '/*') as $file) unlink($file);
        rmdir($directory);
    }
}

echo "Complete catalog preview/apply, opt-in, active additions, false/missing hiding, truncation guards and rollback passed.\n";
