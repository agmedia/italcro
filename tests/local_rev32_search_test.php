<?php

if (PHP_SAPI !== 'cli') {
	http_response_code(404);
	exit(1);
}

require __DIR__ . '/../upload/config.php';
if (!in_array(DB_HOSTNAME, array('localhost', '127.0.0.1', '::1'), true)) {
	throw new RuntimeException('This read-only regression check requires the local database.');
}

foreach (array('engine/registry.php', 'engine/model.php', 'library/config.php', 'library/db.php', 'library/db/mysqli.php', 'helper/utf8.php') as $file) {
	require_once DIR_SYSTEM . $file;
}
require __DIR__ . '/../upload/catalog/model/catalog/product.php';
require DIR_SYSTEM . 'library/msmart_search.php';

function searchCheck($condition, $message) {
	if (!$condition) {
		throw new RuntimeException($message);
	}
}

$db = new DB(DB_DRIVER, DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);
$config = new Config();
foreach ($db->query("SELECT `key`, value, serialized FROM " . DB_PREFIX . "setting WHERE store_id = 0")->rows as $setting) {
	$config->set($setting['key'], $setting['serialized'] ? json_decode($setting['value'], true) : $setting['value']);
}
$language = $db->query("SELECT language_id FROM " . DB_PREFIX . "language WHERE code = 'hr-hr' LIMIT 1")->row;
$config->set('config_language_id', (int)$language['language_id']);
$config->set('config_store_id', 0);
$settings = (array)$config->get('msmart_search_s');
$settings['history_enabled'] = false;
$settings['required_number_of_results'] = 1;
$config->set('msmart_search_s', $settings);

$registry = new Registry();
$registry->set('db', $db);
$registry->set('config', $config);
$model = new ModelCatalogProduct($registry);

$ctrl = new stdClass();
$ctrl->config = $config;
$ctrl->db = $db;
$ctrl->model_catalog_product = $model;
$ctrl->request = (object)array('get' => array());
$ctrl->customer = new class {
	public function isLogged() { return false; }
};
$ctrl->load = new class {
	public function model($route) {
		if ($route !== 'catalog/product') {
			throw new RuntimeException('Numeric article search must not run phrase substitution.');
		}
	}
};

// Run the actual autocomplete controller in an isolated process: its endpoint intentionally exits.
if (isset($argv[1]) && $argv[1] === '--autocomplete') {
	$phrase = isset($argv[2]) ? $argv[2] : '';
	$mode = isset($argv[3]) ? $argv[3] : 'tabs';
	$expectResults = isset($argv[4]) && $argv[4] === 'found';
	searchCheck(QiqoCatalogSearch::isArticleCode($phrase), 'Autocomplete regression requires a numeric code.');
	$config->set('msmart_search_lf', array('enabled' => 1, 'mode' => $mode, 'limit' => 10, 'enabled_categories' => 1, 'show_price' => 0));
	$config->set('config_customer_price', 1);
	$registry->set('model_catalog_product', $model);
	$registry->set('customer', $ctrl->customer);
	$registry->set('request', (object)array('get' => array('phrase' => $phrase)));
	$registry->set('load', new class {
		public function model($route) {}
	});
	$registry->set('language', new class {
		public function load($route) {}
		public function get($key) { return $key; }
	});
	$registry->set('model_extension_module_msmart_search', new class {
		public function checkPhrase($phrase) {
			throw new RuntimeException('A numeric autocomplete must not expand into names or fuzzy categories.');
		}
	});
	$registry->set('model_tool_image', new class {
		public function resize($image, $width, $height) { return null; }
	});
	$registry->set('url', new class {
		public function link($route, $query, $ssl = null) { return 'https://italcro.test/index.php?route=' . $route . '&' . $query; }
	});
	require DIR_SYSTEM . 'engine/controller.php';
	require __DIR__ . '/../upload/catalog/controller/extension/module/msmart_search.php';
	ob_start();
	register_shutdown_function(function () use ($model, $phrase, $mode, $expectResults) {
		$output = ob_get_clean();
		if (!preg_match('#<div id="mss-response">([^<]+)</div>#', $output, $match)) {
			fwrite(STDERR, "Autocomplete did not produce its expected response.\n");
			exit(1);
		}
		$response = json_decode(base64_decode($match[1]), true);
		if (!is_array($response) || (bool)$response['results'] !== $expectResults) {
			fwrite(STDERR, "Autocomplete results do not match the complete article code.\n");
			exit(1);
		}
		foreach ($response['results'] as $result) {
			$product = $result['type'] === 'product' ? $model->getProduct($result['id']) : false;
			if (!$product || ($product['sku'] !== $phrase && $product['model'] !== $phrase) || isset($result['extra_phrase'])) {
				fwrite(STDERR, "Numeric autocomplete returned an unrelated expanded result.\n");
				exit(1);
			}
		}
		echo 'Numeric autocomplete ' . $mode . ' (' . ($expectResults ? 'exact match' : 'missing code') . ") passed.\n";
	});
	$controller = new ControllerExtensionModuleMsmartSearch($registry);
	$controller->autocomplete();
}

// Select a numeric fragment that really exists inside a barcode but is not an article code or complete barcode.
$fragment = $db->query("SELECT SUBSTRING(p.model, 4, 6) AS term
	FROM " . DB_PREFIX . "product p
	WHERE p.status = 1 AND p.model REGEXP '^[0-9]{10,}$'
	AND NOT EXISTS (SELECT 1 FROM " . DB_PREFIX . "product exact_product
		WHERE exact_product.sku = SUBSTRING(p.model, 4, 6) OR exact_product.model = SUBSTRING(p.model, 4, 6))
	LIMIT 1")->row;
searchCheck(!empty($fragment['term']), 'A barcode-fragment regression example is required.');

$filter = array('filter_name' => $fragment['term'], 'filter_tag' => $fragment['term'], 'sort' => 'p.sort_order', 'order' => 'ASC', 'start' => 0, 'limit' => 20);
searchCheck(!$model->getProducts($filter), 'Barcode fragments must not return unrelated products in the standard search.');
searchCheck((int)$model->getTotalProducts($filter) === 0, 'The standard search total must agree for a missing code.');
$smart = Msmart_Search::make($ctrl)->filterData($filter);
searchCheck(!$smart->getProducts(), 'Mega Smart Search must not fall back to barcode substrings.');
searchCheck($smart->getTotalProducts() === 0, 'Mega Smart Search must return zero for the missing exact code.');

$known = $db->query("SELECT sku FROM " . DB_PREFIX . "product WHERE status = 1 AND date_available <= NOW() AND sku REGEXP '^[0-9]{6}$' ORDER BY product_id LIMIT 1")->row;
searchCheck(!empty($known['sku']), 'An active numeric article is required.');
$filter['filter_name'] = $known['sku'];
$filter['filter_tag'] = $known['sku'];
$products = $model->getProducts($filter);
searchCheck((bool)$products, 'A complete numeric SKU must remain searchable.');
$smartProducts = $smart->reset()->filterData($filter)->getProducts();
searchCheck((bool)$smartProducts && $smart->getTotalProducts() > 0, 'Mega Smart Search must find and count a complete SKU.');
foreach (array_merge($products, $smartProducts) as $product) {
	searchCheck($product['sku'] === $known['sku'] || $product['model'] === $known['sku'], 'Numeric search returned a product with a different code.');
}

foreach (array('tabs', 'standard') as $mode) {
	foreach (array($known['sku'] => 'found', $fragment['term'] => 'missing') as $phrase => $expected) {
		$process = proc_open(array(PHP_BINARY, '-d', 'error_reporting=24575', __FILE__, '--autocomplete', (string)$phrase, $mode, $expected), array(0 => array('pipe', 'r'), 1 => array('pipe', 'w'), 2 => array('pipe', 'w')), $pipes);
		searchCheck(is_resource($process), 'Could not start the isolated autocomplete check.');
		fclose($pipes[0]);
		$output = stream_get_contents($pipes[1]);
		$error = stream_get_contents($pipes[2]);
		fclose($pipes[1]);
		fclose($pipes[2]);
		searchCheck(proc_close($process) === 0, 'Autocomplete check failed: ' . $error . $output);
		echo $output;
	}
}

$legacy = $db->query("SELECT pd.name, pd.meta_title, p.mpn FROM " . DB_PREFIX . "product p INNER JOIN " . DB_PREFIX . "product_description pd USING (product_id) WHERE p.product_id = 9399 AND pd.language_id = '" . (int)$config->get('config_language_id') . "'")->row;
searchCheck((bool)$legacy, 'The reported article 9399 is required for its title regression.');
$expectedName = trim((string)$legacy['name']) !== '' ? trim((string)$legacy['name']) : trim((string)$legacy['meta_title']);
$legacyProduct = $model->getProduct(9399);
searchCheck($expectedName !== '' && $legacyProduct['name'] === $expectedName, 'An article with an empty imported name must use its product meta title.');
searchCheck($legacyProduct['mpn'] === $legacy['mpn'], 'Display-name fallback must preserve the product group.');
$request = curl_init('https://italcro.test/index.php?route=product/product&product_id=9399&search=509431');
curl_setopt_array($request, array(CURLOPT_RETURNTRANSFER => true, CURLOPT_TIMEOUT => 20, CURLOPT_SSL_VERIFYPEER => false, CURLOPT_SSL_VERIFYHOST => 0));
$page = curl_exec($request);
$status = (int)curl_getinfo($request, CURLINFO_HTTP_CODE);
curl_close($request);
searchCheck($status === 200 && is_string($page) && preg_match('/<h1[^>]*id="page-title"[^>]*>(.*?)<\/h1>/s', $page, $heading) === 1, 'The reported article must render its product heading over HTTP.');
searchCheck(trim(html_entity_decode(strip_tags($heading[1]), ENT_QUOTES, 'UTF-8')) === $expectedName, 'The rendered product heading must retain the full fallback name after cache and SEO modifications.');
echo "Reported article 9399 display name, product grouping and rendered HTTP heading passed.\n";

$filter['filter_name'] = 'cipele radne';
$filter['filter_tag'] = 'cipele radne';
searchCheck((bool)$model->getProducts($filter), 'Ordinary product-name search must remain available.');

echo "Revizija 3.2 search checks passed (barcode fragment, exact SKU, autocomplete, totals, text search and product heading).\n";
