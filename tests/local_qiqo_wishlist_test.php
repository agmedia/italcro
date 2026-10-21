<?php

// Exercises the local generated controllers and real HTTP/cart path only.
if (PHP_SAPI !== 'cli') { http_response_code(404); exit(1); }
require __DIR__ . '/../upload/config.php';
if (!in_array(DB_HOSTNAME, ['localhost', '127.0.0.1', '::1'], true)
    || parse_url(HTTPS_SERVER, PHP_URL_HOST) !== 'italcro.test'
    || !preg_match('/^[a-zA-Z0-9_]+$/D', DB_PREFIX)) {
    throw new RuntimeException('Wishlist HTTP regression requires the local Italcro installation.');
}

function wishlistHttpAssert($condition, string $message): void {
    if (!$condition) { throw new RuntimeException($message); }
}
function wishlistHttpRequest(string $cookie, string $route, ?array $post = null): array {
    $url = 'https://italcro.test/index.php?route=' . $route;
    for ($redirect = 0; $redirect < 8; ++$redirect) {
        $parts = parse_url($url);
        wishlistHttpAssert(($parts['host'] ?? '') === 'italcro.test'
            && in_array($parts['scheme'] ?? '', ['http', 'https'], true)
            && in_array($parts['port'] ?? (($parts['scheme'] ?? '') === 'https' ? 443 : 80), [80, 443], true),
            'HTTP regression must never leave the local installation.');
        $location = '';
        $curl = curl_init($url);
        curl_setopt_array($curl, [CURLOPT_RETURNTRANSFER => true, CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_RESOLVE => ['italcro.test:443:127.0.0.1', 'italcro.test:80:127.0.0.1'],
            CURLOPT_PROXY => '', CURLOPT_CONNECTTIMEOUT => 5, CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYPEER => false, CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_COOKIEJAR => $cookie, CURLOPT_COOKIEFILE => $cookie,
            CURLOPT_USERAGENT => 'Italcro local exact-SKU wishlist regression',
            CURLOPT_HEADERFUNCTION => static function ($handle, $header) use (&$location) {
                if (stripos($header, 'Location:') === 0) { $location = trim(substr($header, 9)); }
                return strlen($header);
            }]);
        if ($post !== null) {
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($post));
        }
        $body = curl_exec($curl);
        $status = (int)curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        wishlistHttpAssert(is_string($body), 'Local wishlist HTTP request failed.');
        wishlistHttpAssert(!preg_match('/(?:Fatal error|Parse error|Deprecated|Warning|Notice)(?:<\/b>)?:/i', $body),
            'PHP diagnostics appeared in the local HTTP response.');
        if ($status >= 300 && $status < 400 && $location !== '') {
            $url = strpos($location, '//') === 0 ? 'https:' . $location
                : (preg_match('#^https?://#', $location) ? $location : 'https://italcro.test/' . ltrim($location, '/'));
            $post = null;
            continue;
        }
        return ['status' => $status, 'url' => $url, 'body' => $body];
    }
    throw new RuntimeException('Too many local HTTP redirects.');
}
function wishlistHttpJson(array $response): array {
    $value = json_decode($response['body'], true);
    wishlistHttpAssert($response['status'] === 200 && is_array($value), 'Cart endpoint must return successful JSON.');
    return $value;
}
function wishlistHttpPrice(string $value): float {
    wishlistHttpAssert(strpos($value, '€') !== false && preg_match('/[0-9][0-9.,]*/u', $value, $match), 'Wishlist price must be visible in EUR.');
    $number = $match[0];
    if (strpos($number, ',') !== false && strrpos($number, ',') > (strrpos($number, '.') === false ? -1 : strrpos($number, '.'))) {
        $number = str_replace(',', '.', str_replace('.', '', $number));
    } else { $number = str_replace(',', '', $number); }
    return (float)$number;
}

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$db = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE, (int)DB_PORT);
$db->set_charset('utf8mb4');
$customerId = 0;
$email = 'codex-wishlist-' . bin2hex(random_bytes(6)) . '@italcro.local';
$password = bin2hex(random_bytes(16));
$cookie = tempnam(sys_get_temp_dir(), 'italcro-wishlist-');
chmod($cookie, 0600);
$prefix = DB_PREFIX;
try {
    $template = $db->query('SELECT c.customer_group_id,c.language_id,cqa.*,qp.base_discount FROM `' . $prefix . 'customer` c'
        . ' INNER JOIN `' . $prefix . 'customer_qiqo_authorization` cqa ON cqa.customer_id=c.customer_id'
        . ' INNER JOIN `' . $prefix . 'qiqo_partner` qp ON qp.partner_id=cqa.partner_id AND qp.active=1'
        . ' WHERE c.customer_id=103 LIMIT 1')->fetch_assoc();
    wishlistHttpAssert((bool)$template, 'Local authorised template customer 103 is required.');
    $expectedSkus = [6815 => '516187', 11146 => '516283', 13270 => '514050'];
    $products = [];
    $result = $db->query('SELECT p.*,pd.name_add FROM `' . $prefix . 'product` p'
        . ' INNER JOIN `' . $prefix . 'product_description` pd ON pd.product_id=p.product_id'
        . ' WHERE p.product_id IN (6815,11146,13270) AND p.status=1 AND p.date_available<=NOW()'
        . ' AND pd.language_id=' . (int)$template['language_id']);
    while ($row = $result->fetch_assoc()) {
        $id = (int)$row['product_id'];
        wishlistHttpAssert($row['sku'] === $expectedSkus[$id], 'Exact wishlist fixture SKU differs for product ' . $id);
        $products[$id] = $row;
    }
    wishlistHttpAssert(count($products) === 3, 'All three exact wishlist variants must exist locally.');
    $required = $db->query('SELECT COUNT(*) n FROM `' . $prefix . 'product_option` WHERE product_id IN (6815,11146,13270) AND required=1')->fetch_assoc();
    $profiles = $db->query('SELECT COUNT(*) n FROM `' . $prefix . 'product_recurring` WHERE product_id IN (6815,11146,13270)')->fetch_assoc();
    wishlistHttpAssert((int)$required['n'] === 0 && (int)$profiles['n'] === 0, 'Exact variants used by this HTTP fixture must not require options or recurring profiles.');

    $salt = substr(bin2hex(random_bytes(8)), 0, 9);
    $hash = sha1($salt . sha1($salt . sha1($password)));
    $db->query('INSERT INTO `' . $prefix . "customer` SET customer_group_id='" . (int)$template['customer_group_id']
        . "',store_id=0,language_id='" . (int)$template['language_id'] . "',firstname='Codex',lastname='Wishlist test',"
        . "email='" . $db->real_escape_string($email) . "',telephone='000000000',fax='',password='" . $hash
        . "',salt='" . $salt . "',cart=NULL,wishlist=NULL,newsletter=0,address_id=0,custom_field='[]',"
        . "ip='127.0.0.1',status=1,safe=1,token='',code='',date_added=NOW(),approved=1");
    $customerId = (int)$db->insert_id;
    wishlistHttpAssert($customerId > 0, 'Temporary customer creation failed.');
    $db->query('INSERT INTO `' . $prefix . 'customer_qiqo_authorization`'
        . ' (customer_id,partner_id,delivery_place_id,sales_rep_id,partner_discount,approved_by_user_id,approved_at,date_modified) VALUES ('
        . $customerId . ',' . (int)$template['partner_id'] . ',' . (int)$template['delivery_place_id'] . ','
        . (int)$template['sales_rep_id'] . ',' . (float)$template['partner_discount'] . ',' . (int)$template['approved_by_user_id'] . ',NOW(),NOW())');
    foreach ($expectedSkus as $id => $sku) {
        $db->query('INSERT INTO `' . $prefix . 'customer_wishlist` (customer_id,product_id,date_added) VALUES (' . $customerId . ',' . $id . ',NOW())');
    }
    wishlistHttpRequest($cookie, 'account/login');
    $login = wishlistHttpRequest($cookie, 'account/login', ['email' => $email, 'password' => $password]);
    wishlistHttpAssert($login['status'] === 200 && strpos($login['url'], 'account/account') !== false, 'Temporary authorised customer login failed.');

    $wishlist = wishlistHttpRequest($cookie, 'account/wishlist');
    wishlistHttpAssert($wishlist['status'] === 200, 'Wishlist page is not reachable.');
    $document = new DOMDocument();
    $previousErrors = libxml_use_internal_errors(true);
    $document->loadHTML($wishlist['body']);
    libxml_clear_errors(); libxml_use_internal_errors($previousErrors);
    $xpath = new DOMXPath($document);
    $steps = [];
    foreach ($expectedSkus as $id => $sku) {
        $rows = $xpath->query("//td[normalize-space(.)='" . $sku . "']/parent::tr");
        wishlistHttpAssert($rows->length === 1, 'Wishlist must contain one exact row for SKU ' . $sku);
        $row = $rows->item(0);
        $input = $xpath->query(".//input[@data-id='" . $id . "']", $row);
        wishlistHttpAssert($input->length === 1, 'Exact variant must expose a quantity input: ' . $sku);
        wishlistHttpAssert($xpath->query(".//button[@data-type='minus']", $row)->length === 1
            && $xpath->query(".//button[@data-type='plus']", $row)->length === 1, 'Exact variant must expose minus/plus controls: ' . $sku);
        $handlers = $xpath->query('.//button[contains(@onclick,"cart.add(")]', $row);
        wishlistHttpAssert($handlers->length === 1 && preg_match('/cart\.add\(\s*\'' . $id . '\'\s*,.+,\s*false\s*,\s*false\s*,\s*true\s*\)/s', $handlers->item(0)->getAttribute('onclick')),
            'Basel wishlist add must post the exact product ID with the fifth grouped-variant argument: ' . $sku);
        $step = (float)$input->item(0)->getAttribute('min-step');
        wishlistHttpAssert($step > 0 && abs((float)$input->item(0)->getAttribute('min') - $step) < 0.00001
            && abs((float)$input->item(0)->getAttribute('value') - $step) < 0.00001,
            'Wishlist quantity must start at its declared minimum step: ' . $sku);
        $steps[$id] = $step;
        $vpcNodes = $xpath->query('.//td[contains(concat(" ",normalize-space(@class)," ")," mpn-vpc ")]', $row);
        $finalNodes = $xpath->query('.//td[contains(concat(" ",normalize-space(@class)," ")," mpn-final-price ")]', $row);
        wishlistHttpAssert($vpcNodes->length === 1 && $finalNodes->length === 1, 'Exact variant must show both price columns: ' . $sku);
        $discount = $db->query('SELECT discount FROM `' . $prefix . 'qiqo_partner_article_discount` WHERE partner_id='
            . (int)$template['partner_id'] . " AND article_code='" . $db->real_escape_string($sku) . "' LIMIT 1")->fetch_assoc();
        $rebate = $discount ? (float)$discount['discount'] : (float)$template['base_discount'];
        $product = $products[$id];
        $vpc = (float)$product['vpc'] > 0 ? (float)$product['vpc'] : (float)$product['price']
            * (strtoupper(preg_replace('/[^A-Z0-9]/i', '', $product['cent'])) === 'C100' ? 100 : 1);
        wishlistHttpAssert(abs(wishlistHttpPrice($vpcNodes->item(0)->textContent) - round($vpc, 2)) < 0.0051,
            'Wishlist VPC must belong to its exact SKU: ' . $sku);
        wishlistHttpAssert(abs(wishlistHttpPrice($finalNodes->item(0)->textContent) - round($vpc * (1 - $rebate / 100), 2)) < 0.0051,
            'Wishlist final price must use the exact SKU customer rebate: ' . $sku);
    }

    foreach (['checkout/cart/add', 'extension/basel/basel_features/add_to_cart'] as $route) {
        $generic = wishlistHttpJson(wishlistHttpRequest($cookie, $route, ['product_id' => 6815, 'quantity' => $steps[6815]]));
        wishlistHttpAssert(empty($generic['success']) && !empty($generic['error']['warning']), 'Generic grouped-card add must remain blocked: ' . $route);
    }
    $count = $db->query('SELECT COUNT(*) n FROM `' . $prefix . 'cart` WHERE customer_id=' . $customerId)->fetch_assoc();
    wishlistHttpAssert((int)$count['n'] === 0, 'Rejected generic adds must not write any cart rows.');
    $quantities = [6815 => $steps[6815] * 2, 11146 => $steps[11146] * 3, 13270 => $steps[13270]];
    foreach ($quantities as $id => $quantity) {
        $added = wishlistHttpJson(wishlistHttpRequest($cookie, 'extension/basel/basel_features/add_to_cart',
            ['product_id' => $id, 'quantity' => $quantity, 'qiqo_grouped_variant' => 1]));
        wishlistHttpAssert(!empty($added['success']) && empty($added['redirect']) && empty($added['error']), 'Explicit exact variant must add directly: ' . $expectedSkus[$id]);
    }
    $cart = [];
    $result = $db->query('SELECT c.product_id,p.sku,c.quantity FROM `' . $prefix . 'cart` c INNER JOIN `' . $prefix
        . 'product` p ON p.product_id=c.product_id WHERE c.customer_id=' . $customerId);
    while ($row = $result->fetch_assoc()) {
        $id = (int)$row['product_id'];
        wishlistHttpAssert(isset($expectedSkus[$id]) && !isset($cart[$id]) && $row['sku'] === $expectedSkus[$id]
            && abs((float)$row['quantity'] - $quantities[$id]) < 0.00001, 'Cart row must retain its selected exact SKU and quantity.');
        $cart[$id] = $row;
    }
    wishlistHttpAssert(count($cart) === 3 && isset($cart[6815], $cart[11146]), 'Shoe sizes 43 and 46 must remain separate cart rows alongside the mesh variant.');
    echo "Local exact-SKU wishlist HTTP tests passed (three priced variants, quantity controls, Basel opt-in, generic guards and separate shoe cart rows).\n";
} finally {
    if ($customerId > 0) {
        foreach (['customer_qiqo_authorization', 'customer_wishlist', 'customer_ip', 'customer_activity', 'customer_search', 'cart', 'address'] as $table) {
            $db->query('DELETE FROM `' . $prefix . $table . '` WHERE customer_id=' . $customerId);
        }
        $db->query('DELETE FROM `' . $prefix . 'customer` WHERE customer_id=' . $customerId);
        $db->query('DELETE FROM `' . $prefix . "customer_login` WHERE email='" . $db->real_escape_string($email) . "'");
    }
    $db->close();
    if (is_file($cookie)) { unlink($cookie); }
}
