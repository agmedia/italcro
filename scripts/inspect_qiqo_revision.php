<?php

// Read-only Rev3.4 verification. This entry point never constructs Cart,
// starts a session, runs an importer, changes configuration or updates products.
if (PHP_SAPI !== 'cli') { http_response_code(404); exit(1); }
$options = ['erp' => false, 'customer' => null, 'partner' => null];
foreach (array_slice($argv, 1) as $argument) {
    if ($argument === '--help') {
        echo "Usage: php scripts/inspect_qiqo_revision.php [--erp] [--customer=ID | --partner=ID]\n";
        echo "Default: read-only website counts, classifications/categories and Rev3.4 target articles.\n";
        echo "--erp additionally reads articles/actions since 2000-01-01 and compares active website SKUs.\n";
        echo "--customer / --partner selects an existing authorized customer for catalog/cart price checks.\n";
        echo "Only SELECT/SHOW queries are permitted; no cart/session/order/product/configuration writes.\n";
        exit(0);
    } elseif ($argument === '--erp') {
        $options['erp'] = true;
    } elseif (preg_match('/^--(customer|partner)=([1-9][0-9]*)$/D', $argument, $match)
        && strlen($match[2]) <= 10 && (float)$match[2] <= 2147483647) {
        $options[$match[1]] = (int)$match[2];
    } else {
        fwrite(STDERR, "Unknown or invalid option. Use --help.\n");
        exit(2);
    }
}
if ($options['customer'] && $options['partner']) {
    fwrite(STDERR, "Select either --customer or --partner, not both.\n");
    exit(2);
}
ini_set('display_errors', '0');
error_reporting(E_ALL & ~E_DEPRECATED);
@set_time_limit(300);

final class QiqoRevisionReadOnlyDb {
    private $db;
    public $queries = 0;
    public function __construct($db) { $this->db = $db; }
    public function query($sql) {
        if (!preg_match('/^\s*(SELECT|SHOW|DESCRIBE|EXPLAIN)\b/i', $sql)) {
            throw new RuntimeException('Read-only query rejected.');
        }
        $this->queries++;
        return $this->db->query($sql);
    }
    public function escape($value) { return $this->db->escape((string)$value); }
}

function revisionTableExists($db, $suffix) {
    return (bool)$db->query("SHOW TABLES LIKE '" . $db->escape(DB_PREFIX . $suffix) . "'")->num_rows;
}
function revisionInList($db, array $values) {
    return implode(',', array_map(function ($value) use ($db) { return "'" . $db->escape($value) . "'"; }, $values));
}
function revisionPriceSummary(array $row) {
    return array_intersect_key($row, array_flip(['base_unit_price', 'final_unit_price', 'price_source',
        'discount_percent', 'base_discount_percent', 'action_applied', 'action_net_price']));
}
function revisionMinimum(array $row) {
    $pack = (float)($row['pakkol'] ?? 0);
    if ($pack <= 0) $pack = (float)($row['minimum'] ?? 1);
    $unit = strtoupper(trim((string)($row['jm'] ?? $row['ean'] ?? '')));
    $attribute = str_replace(',', '.', (string)($row['name_add'] ?? ''));
    if ($unit === 'MET' && preg_match('/(^|[^0-9])([0-9]+(?:\.[0-9]+)?)\s*m([^a-z0-9]|$)/i', $attribute, $match)
        && (float)$match[2] > 0 && abs((float)$match[2] - round((float)$match[2])) > 0.00001) {
        $pack = (float)$match[2];
    }
    $pack = $pack > 0 ? $pack : 1.0;
    return QiqoPricingResolver::isC100($row['cent'] ?? '') || (int)($row['pak'] ?? 0) === 1
        || abs($pack - round($pack)) > 0.00001 ? $pack : 1.0;
}

$stage = 'bootstrap';
ob_start();
try {
    $root = dirname(__DIR__);
    require $root . '/upload/config.php';
    if (is_file($root . '/upload/env.php')) require_once $root . '/upload/env.php';
    require_once DIR_STORAGE . 'vendor/autoload.php';
    foreach (['engine/registry.php', 'engine/model.php', 'library/config.php', 'library/db/mysqli.php', 'library/db.php'] as $file) {
        require_once DIR_SYSTEM . $file;
    }
    require_once $root . '/upload/catalog/model/catalog/product.php';
    require_once DIR_SYSTEM . 'library/qiqo/sync_guard.php';
    $db = new QiqoRevisionReadOnlyDb(new DB(DB_DRIVER, DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT));
    $config = new Config();
    foreach ($db->query('SELECT `key`, value, serialized FROM `' . DB_PREFIX . 'setting` WHERE store_id=0')->rows as $setting) {
        $config->set($setting['key'], $setting['serialized'] ? json_decode($setting['value'], true) : $setting['value']);
    }
    $config->set('config_store_id', 0);
    $language = $db->query("SELECT language_id FROM `" . DB_PREFIX . "language` WHERE code = '" . $db->escape($config->get('config_language') ?: 'hr-hr') . "' LIMIT 1")->row;
    $config->set('config_language_id', (int)($language['language_id'] ?? 1));
    date_default_timezone_set($config->get('config_timezone') ?: 'Europe/Zagreb');
    $registry = new Registry();
    $registry->set('db', $db);
    $registry->set('config', $config);
    $model = new ModelCatalogProduct($registry);
    $targets = ['500953', '517480', '513056', '516839', '442076', '301012'];
    $stage = 'website';
    $report = ['success' => true, 'read_only' => true, 'checked_at' => date('c'),
        'maintenance' => (bool)$config->get('config_maintenance')];
    $report['website_counts'] = $db->query('SELECT COUNT(*) AS total, SUM(status=1) AS enabled, SUM(status=0) AS inactive,
        SUM(status=1 AND date_available<=NOW()) AS enabled_available FROM `' . DB_PREFIX . 'product`')->row;
    $classificationReady = revisionTableExists($db, 'qiqo_article_classification');
    $actionReady = revisionTableExists($db, 'qiqo_action_price');
    $report['classification_table_ready'] = $classificationReady;
    $report['action_table_ready'] = $actionReady;
    $report['clearance_categories'] = $db->query("SELECT c.category_id, c.status, cd.name,
        COUNT(DISTINCT p2c.product_id) AS products, COUNT(DISTINCT CASE WHEN p.status=1 THEN p.product_id END) AS enabled_products
        FROM `" . DB_PREFIX . "category` c INNER JOIN `" . DB_PREFIX . "category_description` cd USING(category_id)
        LEFT JOIN `" . DB_PREFIX . "product_to_category` p2c USING(category_id)
        LEFT JOIN `" . DB_PREFIX . "product` p ON p.product_id=p2c.product_id
        WHERE cd.name='Rasprodaja' AND cd.language_id='" . (int)$config->get('config_language_id') . "'
        GROUP BY c.category_id, c.status, cd.name ORDER BY c.category_id")->rows;
    if ($classificationReady) {
        $report['clearance_classifications'] = $db->query('SELECT ac.classification, COUNT(DISTINCT ac.article_code) AS classified_skus,
            COUNT(DISTINCT p.product_id) AS website_products, COUNT(DISTINCT CASE WHEN p.status=1 THEN p.product_id END) AS enabled_products
            FROM `' . DB_PREFIX . 'qiqo_article_classification` ac LEFT JOIN `' . DB_PREFIX . 'product` p ON p.sku=ac.article_code
            WHERE ac.classification IN (800,801) GROUP BY ac.classification ORDER BY ac.classification')->rows;
        $report['clearance_with_multiple_categories'] = (int)$db->query('SELECT COUNT(*) AS total FROM (
            SELECT p.product_id FROM `' . DB_PREFIX . 'product` p INNER JOIN `' . DB_PREFIX . 'qiqo_article_classification` ac ON ac.article_code=p.sku
            INNER JOIN `' . DB_PREFIX . 'product_to_category` p2c ON p2c.product_id=p.product_id
            WHERE ac.classification IN (800,801) GROUP BY p.product_id HAVING COUNT(DISTINCT p2c.category_id)>1) duplicate_categories')->row['total'];
    }
    $products = $db->query('SELECT p.product_id, p.sku, p.status, p.price, p.vpc, p.cent, p.quantity, p.pak, p.pakkol, p.minimum, p.mpn, p.jm, p.ean, pd.name_add, p.date_available
        FROM `' . DB_PREFIX . 'product` p LEFT JOIN `' . DB_PREFIX . 'product_description` pd
        ON pd.product_id=p.product_id AND pd.language_id=' . (int)$config->get('config_language_id') . '
        WHERE p.sku IN (' . revisionInList($db, $targets) . ') OR p.product_id=2122 ORDER BY p.product_id')->rows;
    $skus = array_values(array_unique(array_merge($targets, array_column($products, 'sku'))));
    $classificationMap = QiqoArticleRules::classifications($db, $skus);
    $categoryMap = [];
    if ($products) {
        foreach ($db->query('SELECT p2c.product_id, p2c.category_id, cd.name FROM `' . DB_PREFIX . 'product_to_category` p2c
            INNER JOIN `' . DB_PREFIX . 'category_description` cd ON cd.category_id=p2c.category_id
            WHERE p2c.product_id IN (' . implode(',', array_map('intval', array_column($products, 'product_id'))) . ')
            AND cd.language_id=' . (int)$config->get('config_language_id') . ' ORDER BY p2c.product_id, p2c.category_id')->rows as $row) {
            $categoryMap[(int)$row['product_id']][] = ['category_id' => (int)$row['category_id'], 'name' => $row['name']];
        }
    }
    $report['targets'] = [];
    foreach ($products as $row) {
        $report['targets'][] = ['product_id' => (int)$row['product_id'], 'sku' => $row['sku'], 'status' => (int)$row['status'],
            'unit_price' => (float)$row['price'], 'vpc' => (float)$row['vpc'], 'cent' => $row['cent'],
            'quantity' => (float)$row['quantity'], 'minimum_step' => revisionMinimum($row),
            'classification' => $classificationMap[$row['sku']] ?? null, 'categories' => $categoryMap[(int)$row['product_id']] ?? []];
    }
    $report['missing_target_skus'] = array_values(array_diff($targets, array_column($products, 'sku')));
    $actionRows = $actionReady ? $db->query('SELECT article_code, indicator, quantity, price, discount FROM `' . DB_PREFIX . 'qiqo_action_price`
        WHERE article_code IN (' . revisionInList($db, $skus) . ') ORDER BY article_code, indicator, quantity')->rows : [];
    $report['target_actions'] = $actionRows;
    $report['target_display_action_flags'] = $model->getQiqoActionArticleMap($skus);
    $report['target_display_action_conditions'] = $model->getQiqoActionDetailsMap($skus);

    $stage = 'pricing';
    $report['pricing'] = ['skipped' => 'select_customer_or_partner'];
    if ($options['customer'] || $options['partner']) {
        $where = $options['customer'] ? 'cqa.customer_id=' . $options['customer'] : 'cqa.partner_id=' . $options['partner'];
        $authorized = $db->query('SELECT cqa.customer_id, cqa.partner_id FROM `' . DB_PREFIX . 'customer_qiqo_authorization` cqa
            INNER JOIN `' . DB_PREFIX . 'qiqo_partner` qp ON qp.partner_id=cqa.partner_id
            INNER JOIN `' . DB_PREFIX . 'customer` c ON c.customer_id=cqa.customer_id
            WHERE ' . $where . ' AND qp.active=1 AND c.status=1 ORDER BY cqa.customer_id LIMIT 1')->row;
        if (!$authorized) {
            $report['pricing'] = ['skipped' => 'no_active_authorized_customer'];
        } else {
            $customerId = (int)$authorized['customer_id'];
            $auth = $model->getCustomerQiqoAuthorization($customerId);
            require_once DIR_SYSTEM . 'library/cart/cart.php';
            $reflection = new ReflectionClass('Cart\\Cart');
            $cart = $reflection->newInstanceWithoutConstructor();
            $cart->db = $db;
            $cart->config = $config;
            $cart->session = (object)['data' => []];
            $cart->customer = new class($customerId) {
                private $id;
                public function __construct($id) { $this->id = $id; }
                public function getId() { return $this->id; }
            };
            $cartPrice = $reflection->getMethod('applyQiqoCartPrice');
            $cartPrice->setAccessible(true);
            $cases = [];
            foreach ($products as $row) {
                if ((float)$row['price'] <= 0 || trim($row['sku']) === '') continue;
                $sku = $row['sku'];
                $quantities = [1.0, revisionMinimum($row)];
                foreach ($actionRows as $action) {
                    if ($action['article_code'] === $sku && strtoupper($action['indicator']) === 'P' && (float)$action['quantity'] > 0) {
                        $quantities[] = (float)$action['quantity'];
                    }
                }
                $quantities = array_values(array_unique($quantities));
                sort($quantities, SORT_NUMERIC);
                foreach ($quantities as $quantity) {
                    $catalog = $model->getQiqoPricingMap($customerId, [$sku => $quantity], [$sku => (float)$row['price']], false, false);
                    $cartMap = $model->getQiqoPricingMap($customerId, [$sku => $quantity], [$sku => (float)$row['price']], false, true);
                    $cartUnit = $cartPrice->invoke($cart, $sku, (float)$row['price'], $quantity, $row['cent'], (float)$row['price']);
                    $matched = isset($cartMap[$sku]) && abs($cartUnit - $cartMap[$sku]['final_unit_price']) < 0.000001;
                    $cases[] = ['sku' => $sku, 'quantity' => $quantity,
                        'catalog' => isset($catalog[$sku]) ? revisionPriceSummary($catalog[$sku]) : null,
                        'cart' => isset($cartMap[$sku]) ? revisionPriceSummary($cartMap[$sku]) : null,
                        'actual_cart_unit_price' => (float)$cartUnit, 'cart_model_matches_actual_cart' => $matched];
                }
            }
            $report['pricing'] = ['customer_id' => $customerId, 'partner_id' => (int)$authorized['partner_id'],
                'partner_discount' => (float)$auth['partner_discount'],
                'all_cart_prices_match' => !array_filter($cases, function ($case) { return !$case['cart_model_matches_actual_cart']; }),
                'cases' => $cases];
        }
    }

    if ($options['erp']) {
        $stage = 'erp';
        $erp = new Agmedia\Api\Connection\Soap\Qiqo();
        $articles = $erp->getArticles('2000-01-01');
        $articleFetch = $erp->getLastFetchResult();
        $actions = $erp->getActionPriceList('2000-01-01');
        $actionFetch = $erp->getLastFetchResult();
        $stock = QiqoSyncGuard::normalizeArticleStockRows($articles);
        $actionNormalized = QiqoSyncGuard::normalizeActionRows($actions);
        $erpRows = [];
        $erpTargets = [];
        $activeErp = [];
        foreach ($stock['rows'] as $row) if ($row['status']) $activeErp[$row['sku']] = true;
        foreach ($articles as $source) {
            $row = array_change_key_case((array)$source, CASE_LOWER);
            $sku = trim((string)($row['id'] ?? ''));
            $erpRows[$sku] = $row;
            if (in_array($sku, $skus, true)) {
                $erpTargets[] = array_intersect_key($row, array_flip(['id', 'aktivan', 'gid', 'kataloggrupa', 'vpc', 'cijena', 'cent', 'zaliha', 'pak', 'pakkol']));
            }
        }
        $report['erp'] = ['since' => '2000-01-01', 'article_fetch_success' => !empty($articleFetch['success']),
            'article_rows' => count($articles), 'article_validation_ok' => $stock['valid'], 'invalid_article_rows' => $stock['invalid_rows'],
            'active_skus' => count($activeErp), 'target_articles' => $erpTargets, 'action_fetch_success' => !empty($actionFetch['success']),
            'action_rows' => count($actions), 'normalized_action_rows' => count($actionNormalized['rows']),
            'action_validation_ok' => $actionNormalized['valid'], 'action_warnings' => $actionNormalized['warnings'] ?? [],
            'target_actions' => array_values(array_filter($actionNormalized['rows'], function ($row) use ($skus) { return in_array($row['article'], $skus, true); }))];
        if (!empty($articleFetch['success']) && $articles && $stock['valid']) {
            $missing = [];
            $inactive = [];
            $activeWebsite = [];
            foreach ($db->query('SELECT product_id,sku FROM `' . DB_PREFIX . 'product` WHERE status=1 ORDER BY product_id')->rows as $row) {
                $sku = (string)$row['sku'];
                $activeWebsite[$sku] = true;
                if (!isset($erpRows[$sku])) $missing[] = ['product_id' => (int)$row['product_id'], 'sku' => $sku];
                elseif (!isset($activeErp[$sku])) $inactive[] = ['product_id' => (int)$row['product_id'], 'sku' => $sku];
            }
            $report['erp']['active_website_comparison'] = ['active_website_skus' => count($activeWebsite),
                'website_skus_missing_erp_count' => count($missing), 'website_skus_missing_erp' => $missing,
                'website_skus_inactive_erp_count' => count($inactive), 'website_skus_inactive_erp' => $inactive,
                'erp_active_skus_missing_or_inactive_website' => array_values(array_diff(array_keys($activeErp), array_keys($activeWebsite)))];
        } else {
            $report['erp']['active_website_comparison'] = ['skipped' => 'article_snapshot_failed_validation'];
        }
        if (empty($articleFetch['success']) || !$articles || !$stock['valid'] || empty($actionFetch['success']) || !$actionNormalized['valid']) {
            $report['success'] = false;
        }
    }
    $report['read_queries'] = $db->queries;
    ob_end_clean();
    echo json_encode($report, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_SUBSTITUTE) . PHP_EOL;
    exit($report['success'] ? 0 : 1);
} catch (Throwable $error) {
    ob_end_clean();
    // Exceptions can contain SQL, account information or transport credentials.
    echo json_encode(['success' => false, 'read_only' => true, 'error' => 'inspection_failed', 'stage' => $stage]) . PHP_EOL;
    exit(1);
}
