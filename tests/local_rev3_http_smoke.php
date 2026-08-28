<?php

if (PHP_SAPI !== 'cli') {
	http_response_code(404);
	exit(1);
}

require __DIR__ . '/../upload/config.php';

function smokeAssert($condition, $message) {
	if (!$condition) {
		throw new RuntimeException($message);
	}
}

function smokeRequest($cookieFile, $url, array $post = null) {
	$ch = curl_init($url);
	curl_setopt_array($ch, array(
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_MAXREDIRS => 8,
		CURLOPT_CONNECTTIMEOUT => 5,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_SSL_VERIFYPEER => false,
		CURLOPT_SSL_VERIFYHOST => 0,
		CURLOPT_COOKIEJAR => $cookieFile,
		CURLOPT_COOKIEFILE => $cookieFile,
		CURLOPT_USERAGENT => 'Italcro local Rev3 smoke test'
	));
	if ($post !== null) {
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
	}
	$body = curl_exec($ch);
	$status = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
	$effectiveUrl = (string)curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
	$error = curl_error($ch);
	curl_close($ch);
	if ($body === false) {
		throw new RuntimeException('HTTP request failed: ' . $error);
	}
	if (preg_match('/Deprecated:|Fatal error:|Return type of Illuminate/i', $body)) {
		throw new RuntimeException('PHP diagnostics leaked into ' . $url);
	}
	return array('status' => $status, 'url' => $effectiveUrl, 'body' => $body);
}

function cleanupSmokeCustomer(mysqli $db, $email) {
	$emailEscaped = $db->real_escape_string($email);
	$ids = array();
	$result = $db->query("SELECT customer_id FROM oc_customer WHERE email = '" . $emailEscaped . "'");
	while ($result && $row = $result->fetch_assoc()) {
		$ids[] = (int)$row['customer_id'];
	}
	foreach ($ids as $customerId) {
		foreach (array('oc_customer_qiqo_authorization', 'oc_customer_wishlist', 'oc_customer_ip', 'oc_customer_activity', 'oc_customer_search', 'oc_cart', 'oc_address') as $table) {
			$db->query("DELETE FROM `" . $table . "` WHERE customer_id = '" . $customerId . "'");
		}
		$db->query("DELETE FROM oc_customer WHERE customer_id = '" . $customerId . "'");
	}
	$db->query("DELETE FROM oc_customer_login WHERE email = '" . $emailEscaped . "'");
}

$db = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE, (int)DB_PORT);
if ($db->connect_errno) {
	throw new RuntimeException('Local database connection failed.');
}
$db->set_charset('utf8mb4');

$baseUrl = 'https://italcro.test/';
$email = 'codex-rev3-smoke@italcro.local';
$password = 'LocalRev3Smoke!2026';
$cookieFile = tempnam(sys_get_temp_dir(), 'italcro-smoke-');

cleanupSmokeCustomer($db, $email);

try {
	foreach (array('extension/feed/jeftinije', 'extension/feed/google_base') as $disabledFeedRoute) {
		$disabledFeed = smokeRequest($cookieFile, $baseUrl . 'index.php?route=' . $disabledFeedRoute);
		smokeAssert($disabledFeed['status'] === 404 && $disabledFeed['body'] === '', 'Legacy public price feed must fail closed: ' . $disabledFeedRoute);
	}

	$template = $db->query("SELECT c.customer_group_id, c.language_id, cqa.*
		FROM oc_customer c
		INNER JOIN oc_customer_qiqo_authorization cqa ON cqa.customer_id = c.customer_id
		WHERE c.customer_id = 103 LIMIT 1")->fetch_assoc();
	smokeAssert((bool)$template, 'Authorized template customer 103 is missing.');

	$salt = substr(bin2hex(random_bytes(8)), 0, 9);
	$passwordHash = sha1($salt . sha1($salt . sha1($password)));
	$db->query("INSERT INTO oc_customer SET
		customer_group_id = '" . (int)$template['customer_group_id'] . "', store_id = 0,
		language_id = '" . (int)$template['language_id'] . "', firstname = 'Codex', lastname = 'Rev3 test',
		email = '" . $db->real_escape_string($email) . "', telephone = '000000000', fax = '',
		password = '" . $passwordHash . "', salt = '" . $salt . "', cart = NULL, wishlist = NULL,
		newsletter = 0, address_id = 0, custom_field = '[]', ip = '127.0.0.1', status = 1,
		safe = 1, token = '', code = '', date_added = NOW(), approved = 1");
	$customerId = (int)$db->insert_id;
	smokeAssert($customerId > 0, 'Could not create temporary customer.');

	$address = $db->query("SELECT a.* FROM oc_customer c INNER JOIN oc_address a ON a.address_id = c.address_id WHERE c.customer_id = 103 LIMIT 1")->fetch_assoc();
	smokeAssert((bool)$address, 'Template delivery address is missing.');
	$db->query("INSERT INTO oc_address SET customer_id = '" . $customerId . "',
		firstname = 'Codex', lastname = 'Rev3 test', company = '" . $db->real_escape_string($address['company']) . "',
		address_1 = '" . $db->real_escape_string($address['address_1']) . "', address_2 = '" . $db->real_escape_string($address['address_2']) . "',
		city = '" . $db->real_escape_string($address['city']) . "', postcode = '" . $db->real_escape_string($address['postcode']) . "',
		country_id = '" . (int)$address['country_id'] . "', zone_id = '" . (int)$address['zone_id'] . "', custom_field = '[]'");
	$addressId = (int)$db->insert_id;
	$db->query("UPDATE oc_customer SET address_id = '" . $addressId . "' WHERE customer_id = '" . $customerId . "'");

	$db->query("INSERT INTO oc_customer_qiqo_authorization
		(customer_id, partner_id, delivery_place_id, sales_rep_id, partner_discount, approved_by_user_id, approved_at, date_modified)
		VALUES ('" . $customerId . "', '" . (int)$template['partner_id'] . "', '" . (int)$template['delivery_place_id'] . "', '" . (int)$template['sales_rep_id'] . "', '" . (float)$template['partner_discount'] . "', '" . (int)$template['approved_by_user_id'] . "', NOW(), NOW())");

	$product = $db->query("SELECT product_id FROM oc_product WHERE sku = '300970' AND status = 1 LIMIT 1")->fetch_assoc();
	smokeAssert((bool)$product, 'Test article 300970 is missing.');
	$productId = (int)$product['product_id'];
	$secondProduct = $db->query("SELECT product_id FROM oc_product WHERE status = 1 AND product_id <> '" . $productId . "' ORDER BY product_id LIMIT 1")->fetch_assoc();
	$db->query("INSERT INTO oc_customer_wishlist VALUES ('" . $customerId . "', '" . $productId . "', NOW())");
	$db->query("INSERT INTO oc_customer_wishlist VALUES ('" . $customerId . "', '" . (int)$secondProduct['product_id'] . "', NOW())");

	$loginPage = smokeRequest($cookieFile, $baseUrl . 'index.php?route=account/login');
	smokeAssert($loginPage['status'] === 200, 'Login page is not reachable.');
	$login = smokeRequest($cookieFile, $baseUrl . 'index.php?route=account/login', array('email' => $email, 'password' => $password));
	smokeAssert($login['status'] === 200 && strpos($login['url'], 'account/account') !== false, 'Temporary customer login failed.');

	$catalog = smokeRequest($cookieFile, $baseUrl . 'index.php?route=product/search&search=300970');
	smokeAssert($catalog['status'] === 200 && strpos($catalog['body'], '300970') !== false, 'Catalog search did not render article 300970.');
	$catalogText = preg_replace('/\s+/u', ' ', html_entity_decode(strip_tags($catalog['body']), ENT_QUOTES, 'UTF-8'));
	smokeAssert((bool)preg_match('/-?15(?:[,.]0+)?\s*%/', $catalogText), 'Catalog does not show the 15% customer/article discount.');
	smokeAssert((bool)preg_match('/1[,.]65\s*€/', $catalogText), 'Catalog does not show the expected base-discount price 1.65 EUR.');

	$liveSearch = smokeRequest($cookieFile, $baseUrl . 'index.php?route=extension/basel/live_search&filter_name=300970');
	$liveSearchJson = json_decode($liveSearch['body'], true);
	$liveSearchProduct = !empty($liveSearchJson['products'][0]) ? $liveSearchJson['products'][0] : array();
	smokeAssert(!empty($liveSearchProduct), 'Basel live search returned no product.');
	smokeAssert((bool)preg_match('/1[,.]65/', (string)$liveSearchProduct['special']), 'Basel live search bypassed base-only QIQO pricing.');

	$quickview = smokeRequest($cookieFile, $baseUrl . 'index.php?route=extension/basel/quickview&product_id=' . $productId);
	$quickviewText = preg_replace('/\s+/u', ' ', html_entity_decode(strip_tags($quickview['body']), ENT_QUOTES, 'UTF-8'));
	smokeAssert((bool)preg_match('/-?15(?:[,.]0+)?\s*%/', $quickviewText), 'Basel quickview does not show the base rebate.');
	smokeAssert((bool)preg_match('/1[,.]65\s*€/', $quickviewText), 'Basel quickview bypassed base-only QIQO pricing.');

	$productPage = smokeRequest($cookieFile, $baseUrl . 'index.php?route=product/product&product_id=' . $productId);
	$customerPriceSetting = $db->query("SELECT value FROM oc_setting WHERE store_id = 0 AND `key` = 'config_customer_price' ORDER BY setting_id DESC LIMIT 1")->fetch_assoc();
	if ($customerPriceSetting && !empty($customerPriceSetting['value'])) {
		preg_match_all('/<script[^>]+type=["\']application\/ld\+json["\'][^>]*>(.*?)<\/script>/is', $productPage['body'], $structuredBlocks);
		foreach ($structuredBlocks[1] as $structuredBlock) {
			$structured = json_decode(html_entity_decode($structuredBlock, ENT_QUOTES, 'UTF-8'), true);
			if (is_array($structured) && isset($structured['@type']) && $structured['@type'] === 'Product') {
				smokeAssert(!isset($structured['offers']), 'Buyer-only price leaked into public/cacheable Product JSON-LD.');
			}
		}
	}

	$liveOptions = smokeRequest($cookieFile, $baseUrl . 'index.php?route=extension/basel/live_options/index&product_id=' . $productId, array('quantity' => '1'));
	$liveOptionsJson = json_decode($liveOptions['body'], true);
	smokeAssert(!empty($liveOptionsJson['success']), 'Basel live options failed for a single article.');
	smokeAssert((bool)preg_match('/1[,.]65/', (string)$liveOptionsJson['new_price']['special']), 'Basel live options reintroduced an action/legacy price.');

	$grouped = $db->query("SELECT p.product_id
		FROM oc_product p
		WHERE p.status = 1 AND p.mpn <> ''
		  AND (SELECT COUNT(*) FROM oc_product p2 WHERE p2.status = 1 AND p2.mpn = p.mpn) > 1
		ORDER BY p.product_id LIMIT 1")->fetch_assoc();
	if ($grouped) {
		$groupedId = (int)$grouped['product_id'];
		$groupedQuickview = smokeRequest($cookieFile, $baseUrl . 'index.php?route=extension/basel/quickview&product_id=' . $groupedId);
		smokeAssert(!preg_match('/<button[^>]+id=["\']button-cart-quickview["\']/i', $groupedQuickview['body']), 'Grouped quickview still exposes root add-to-cart.');
		$groupedLiveOptions = smokeRequest($cookieFile, $baseUrl . 'index.php?route=extension/basel/live_options/index&product_id=' . $groupedId, array('quantity' => '1'));
		$groupedLiveOptionsJson = json_decode($groupedLiveOptions['body'], true);
		smokeAssert(empty($groupedLiveOptionsJson['success']), 'Grouped live options must fail closed.');

		$db->query("INSERT IGNORE INTO oc_customer_wishlist VALUES ('" . $customerId . "', '" . $groupedId . "', NOW())");
		$groupedWishlist = smokeRequest($cookieFile, $baseUrl . 'index.php?route=account/wishlist');
		smokeAssert(strpos($groupedWishlist['body'], "cart.add('" . $groupedId . "'") === false, 'Grouped wishlist row still exposes representative add-to-cart.');

		smokeRequest($cookieFile, $baseUrl . 'index.php?route=product/compare/add', array('product_id' => $groupedId));
		$groupedCompare = smokeRequest($cookieFile, $baseUrl . 'index.php?route=product/compare');
		smokeAssert(strpos($groupedCompare['body'], "cart.add('" . $groupedId . "'") === false, 'Grouped comparison row still exposes representative add-to-cart.');
	}

	$autocomplete = smokeRequest($cookieFile, $baseUrl . 'index.php?route=extension/module/quick_order/autocomplete&term=300970');
	$items = json_decode($autocomplete['body'], true);
	smokeAssert(is_array($items) && count($items) >= 1, 'Quick order search returned no JSON items.');
	$item = null;
	foreach ($items as $candidate) {
		if (isset($candidate['sku']) && (string)$candidate['sku'] === '300970') {
			$item = $candidate;
			break;
		}
	}
	smokeAssert((bool)$item, 'Quick order JSON is missing article 300970.');
	smokeAssert(abs((float)$item['qiqo_discount_percent'] - 22.0) < 0.00001, 'Quick order quantity 1 must use the 22% action tier.');
	smokeAssert(abs((float)$item['price_raw'] - 1.5132) < 0.00001, 'Quick order quantity 1 action price is incorrect.');

	$added = smokeRequest($cookieFile, $baseUrl . 'index.php?route=extension/module/quick_order/fastAdd', array('product_id' => $productId, 'quantity' => 1));
	$addedJson = json_decode($added['body'], true);
	smokeAssert(!empty($addedJson['success']), 'Could not add article 300970 to the cart.');

	$shippingMethods = smokeRequest($cookieFile, $baseUrl . 'index.php?route=extension/quickcheckout/shipping_method&address_id=' . $addressId);
	smokeAssert($shippingMethods['status'] === 200 && stripos($shippingMethods['body'], 'xshippingpro') !== false, 'Existing XShippingPro quotes disappeared after the cart pricing changes.');

	foreach (array(array(1, 22, 1.5132), array(24, 25, 1.455), array(240, 28, 1.3968)) as $tier) {
		smokeRequest($cookieFile, $baseUrl . 'index.php?route=extension/module/quick_order/updateQty', array('product_id' => $productId, 'quantity' => $tier[0]));
		$state = smokeRequest($cookieFile, $baseUrl . 'index.php?route=extension/module/quick_order/cartState');
		$stateJson = json_decode($state['body'], true);
		smokeAssert(!empty($stateJson['items'][0]), 'Cart state is empty at quantity ' . $tier[0] . '.');
		$cartItem = $stateJson['items'][0];
		smokeAssert(abs((float)$cartItem['qiqo_discount_percent'] - $tier[1]) < 0.00001, 'Wrong action tier at quantity ' . $tier[0] . '.');
		smokeAssert(abs((float)$cartItem['price_raw'] - $tier[2]) < 0.00001, 'Wrong cart price at quantity ' . $tier[0] . '.');
	}

	// Return to a deliberately tiny order and verify the former 150 EUR minimum no longer redirects to cart.
	smokeRequest($cookieFile, $baseUrl . 'index.php?route=extension/module/quick_order/updateQty', array('product_id' => $productId, 'quantity' => 1));
	$checkout = smokeRequest($cookieFile, $baseUrl . 'index.php?route=checkout/checkout');
	smokeAssert($checkout['status'] === 200 && strpos($checkout['url'], 'checkout/cart') === false, 'Checkout still blocks an order below the old 150 EUR minimum.');

	$beforeWishlist = (int)$db->query("SELECT COUNT(*) AS total FROM oc_customer_wishlist WHERE customer_id = '" . $customerId . "'")->fetch_assoc()['total'];
	$wishlist = smokeRequest($cookieFile, $baseUrl . 'index.php?route=account/wishlist');
	smokeAssert($wishlist['status'] === 200 && strpos($wishlist['body'], 'product-remove') !== false, 'Wishlist remove control is not rendered.');
	smokeRequest($cookieFile, $baseUrl . 'index.php?route=account/wishlist&remove=' . $productId);
	$afterWishlist = (int)$db->query("SELECT COUNT(*) AS total FROM oc_customer_wishlist WHERE customer_id = '" . $customerId . "'")->fetch_assoc()['total'];
	smokeAssert($afterWishlist === $beforeWishlist - 1, 'Wishlist removal did not delete exactly one item.');

	echo "Local Rev3 HTTP smoke tests passed.\n";
} finally {
	cleanupSmokeCustomer($db, $email);
	if ($cookieFile && is_file($cookieFile)) {
		unlink($cookieFile);
	}
	$db->close();
}
