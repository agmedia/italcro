<?php

if (PHP_SAPI !== 'cli') {
	http_response_code(404);
	exit(1);
}

require __DIR__ . '/../upload/config.php';

function adminSmokeAssert($condition, $message) {
	if (!$condition) {
		throw new RuntimeException($message);
	}
}

function adminSmokeRequest($cookieFile, $url, array $post = null) {
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
		CURLOPT_USERAGENT => 'Italcro local QIQO admin smoke test'
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
		throw new RuntimeException('Admin HTTP request failed: ' . $error);
	}
	if (preg_match('/Deprecated:|Fatal error:|Return type of Illuminate/i', $body)) {
		throw new RuntimeException('PHP diagnostics leaked into admin response.');
	}
	return array('status' => $status, 'url' => $effectiveUrl, 'body' => $body);
}

$db = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE, (int)DB_PORT);
if ($db->connect_errno) {
	throw new RuntimeException('Local database connection failed.');
}
$username = 'codex_rev3_smoke';
$password = 'LocalAdminSmoke!2026';
$cookieFile = tempnam(sys_get_temp_dir(), 'italcro-admin-smoke-');
$testOrderId = 2147483647;
$uncertainOrderId = 2147483646;
$processingOrderId = 2147483645;
$settingRows = array();
foreach (array('qiqo_order_send_enabled', 'qiqo_order_allow_insecure_http') as $settingKey) {
	$result = $db->query("SELECT setting_id, value FROM oc_setting WHERE store_id = 0 AND `key` = '" . $db->real_escape_string($settingKey) . "' ORDER BY setting_id");
	while ($result && $row = $result->fetch_assoc()) {
		$settingRows[] = $row;
	}
}
$db->query("DELETE FROM oc_user WHERE username = '" . $db->real_escape_string($username) . "'");
$db->query("DELETE FROM oc_qiqo_order_outbox WHERE order_id IN ('" . $testOrderId . "', '" . $uncertainOrderId . "', '" . $processingOrderId . "')");

try {
	$db->query("UPDATE oc_setting SET value = 'false' WHERE store_id = 0 AND `key` = 'qiqo_order_send_enabled'");
	$db->query("UPDATE oc_setting SET value = 'off' WHERE store_id = 0 AND `key` = 'qiqo_order_allow_insecure_http'");
	$salt = substr(bin2hex(random_bytes(8)), 0, 9);
	$passwordHash = sha1($salt . sha1($salt . sha1($password)));
	$db->query("INSERT INTO oc_user SET user_group_id = 1, username = '" . $db->real_escape_string($username) . "',
		password = '" . $passwordHash . "', salt = '" . $salt . "', firstname = 'Codex', lastname = 'Rev3 test',
		email = 'codex-admin-smoke@italcro.local', image = '', code = '', ip = '127.0.0.1', status = 1, date_added = NOW()");
	adminSmokeAssert($db->insert_id > 0, 'Could not create temporary admin user.');

	$xssMarker = '</pre><script id="qiqo-outbox-xss">alert(1)</script>';
	$testPayload = json_encode(array('narudzba' => array('napomena' => $xssMarker, 'stavke' => array())), JSON_UNESCAPED_SLASHES);
	$db->query("INSERT INTO oc_qiqo_order_outbox SET
		order_id = '" . $testOrderId . "', order_status_id = 1,
		partner_code = 'TEST', delivery_place_code = 'TEST', sales_rep_code = 'TEST', currency_code = 'EUR',
		payload_json = '" . $db->real_escape_string($testPayload) . "',
		payload_hash = '" . hash('sha256', $testPayload) . "', status = 'pending',
		date_added = NOW(), date_modified = NOW()");
	$testOutboxId = (int)$db->insert_id;
	adminSmokeAssert($testOutboxId > 0, 'Could not create temporary outbox row.');
	$db->query("INSERT INTO oc_qiqo_order_outbox SET
		order_id = '" . $uncertainOrderId . "', order_status_id = 1,
		partner_code = 'TEST', delivery_place_code = 'TEST', sales_rep_code = 'TEST', currency_code = 'EUR',
		payload_json = '" . $db->real_escape_string($testPayload) . "',
		payload_hash = '" . hash('sha256', $testPayload) . "', status = 'uncertain',
		last_error_code = 'TEST_UNCERTAIN', date_added = NOW(), date_modified = NOW()");
	$uncertainOutboxId = (int)$db->insert_id;
	adminSmokeAssert($uncertainOutboxId > 0, 'Could not create temporary uncertain outbox row.');
	$db->query("INSERT INTO oc_qiqo_order_outbox SET
		order_id = '" . $processingOrderId . "', order_status_id = 1,
		partner_code = 'TEST', delivery_place_code = 'TEST', sales_rep_code = 'TEST', currency_code = 'EUR',
		payload_json = '" . $db->real_escape_string($testPayload) . "',
		payload_hash = '" . hash('sha256', $testPayload) . "', status = 'processing', locked_at = NOW(),
		date_added = NOW(), date_modified = NOW()");
	$processingOutboxId = (int)$db->insert_id;
	adminSmokeAssert($processingOutboxId > 0, 'Could not create temporary processing outbox row.');

	$base = 'https://italcro.test/admin/';
	$loginPage = adminSmokeRequest($cookieFile, $base . 'index.php?route=common/login');
	adminSmokeAssert($loginPage['status'] === 200, 'Admin login page is not reachable.');
	$login = adminSmokeRequest($cookieFile, $base . 'index.php?route=common/login', array('username' => $username, 'password' => $password));
	adminSmokeAssert($login['status'] === 200 && strpos($login['url'], 'user_token=') !== false, 'Temporary admin login failed.');
	parse_str((string)parse_url($login['url'], PHP_URL_QUERY), $query);
	$userToken = isset($query['user_token']) ? $query['user_token'] : '';
	adminSmokeAssert($userToken !== '', 'Admin user token is missing after login.');

	$qiqo = adminSmokeRequest($cookieFile, $base . 'index.php?route=extension/module/qiqo&user_token=' . urlencode($userToken));
	adminSmokeAssert($qiqo['status'] === 200 && strpos($qiqo['body'], 'NarudzbaSend') !== false, 'QIQO page does not expose the NarudzbaSend outbox link.');
	adminSmokeAssert(strpos($qiqo['body'], 'qiqo_full_snapshot_confirmed=0') !== false, 'Admin page does not explain the fail-closed FULL snapshot gate.');
	adminSmokeAssert((bool)preg_match('/value="sync_action_prices_full"[^>]*disabled/', $qiqo['body']), 'Destructive action-price FULL button must be disabled by default.');

	$actionCacheBefore = $db->query("SELECT COUNT(*) AS total,
		COALESCE(SUM(CRC32(CONCAT_WS('|', article_code, indicator, quantity, price, discount))), 0) AS signature
		FROM oc_qiqo_action_price")->fetch_assoc();
	$partnerDiscountBefore = $db->query("SELECT COUNT(*) AS total,
		COALESCE(SUM(CRC32(CONCAT_WS('|', partner_id, article_code, discount))), 0) AS signature
		FROM oc_qiqo_partner_article_discount")->fetch_assoc();
	$enabledProductsBefore = $db->query("SELECT COUNT(*) AS total FROM oc_product WHERE status = 1")->fetch_assoc();

	foreach (array('sync_action_prices_full', 'sync_partner_discounts', 'disable_missing') as $blockedAction) {
		$blocked = adminSmokeRequest($cookieFile, $base . 'index.php?route=extension/module/qiqo&user_token=' . urlencode($userToken), array(
			'action' => $blockedAction
		));
		adminSmokeAssert(stripos($blocked['body'], 'blokiran') !== false, 'Destructive action ' . $blockedAction . ' did not fail closed before any ERP call.');
	}

	$actionCacheAfter = $db->query("SELECT COUNT(*) AS total,
		COALESCE(SUM(CRC32(CONCAT_WS('|', article_code, indicator, quantity, price, discount))), 0) AS signature
		FROM oc_qiqo_action_price")->fetch_assoc();
	$partnerDiscountAfter = $db->query("SELECT COUNT(*) AS total,
		COALESCE(SUM(CRC32(CONCAT_WS('|', partner_id, article_code, discount))), 0) AS signature
		FROM oc_qiqo_partner_article_discount")->fetch_assoc();
	$enabledProductsAfter = $db->query("SELECT COUNT(*) AS total FROM oc_product WHERE status = 1")->fetch_assoc();
	adminSmokeAssert($actionCacheAfter === $actionCacheBefore, 'Blocked action-price FULL changed the live cache.');
	adminSmokeAssert($partnerDiscountAfter === $partnerDiscountBefore, 'Blocked partner-discount FULL changed the live cache.');
	adminSmokeAssert($enabledProductsAfter === $enabledProductsBefore, 'Blocked disable-missing action changed product statuses.');

	$outbox = adminSmokeRequest($cookieFile, $base . 'index.php?route=extension/module/qiqo/orderOutbox&user_token=' . urlencode($userToken));
	adminSmokeAssert($outbox['status'] === 200 && strpos($outbox['body'], 'qiqo_order_send_enabled=0') !== false, 'Outbox page does not show the safe disabled state.');
	adminSmokeAssert(strpos($outbox['body'], 'qiqo_order_allow_insecure_http=1') !== false, 'Plain HTTP transport warning is missing.');
	adminSmokeAssert(strpos($outbox['body'], 'pending') !== false, 'Outbox page is missing the temporary integration-test row.');
	adminSmokeAssert(strpos($outbox['body'], $xssMarker) === false, 'Customer-controlled payload is rendered as executable admin HTML.');
	adminSmokeAssert(strpos($outbox['body'], '&lt;/pre&gt;&lt;script') !== false, 'Escaped payload marker is not visible for safe operator review.');

	adminSmokeRequest($cookieFile, $base . 'index.php?route=extension/module/qiqo/orderOutboxAction&user_token=' . urlencode($userToken), array(
		'outbox_id' => $uncertainOutboxId,
		'outbox_action' => 'rebuild'
	));
	$uncertainStatus = $db->query("SELECT status FROM oc_qiqo_order_outbox WHERE outbox_id = '" . $uncertainOutboxId . "'")->fetch_assoc()['status'];
	adminSmokeAssert($uncertainStatus === 'uncertain', 'Uncertain outcome must not be reset through payload rebuild.');

	$pendingLockName = 'qiqo_order_export_' . substr(sha1(DB_DATABASE . ':oc_' . $testOrderId), 0, 40);
	$pendingLockResult = $db->query("SELECT GET_LOCK('" . $db->real_escape_string($pendingLockName) . "', 0) AS acquired")->fetch_assoc();
	adminSmokeAssert((int)$pendingLockResult['acquired'] === 1, 'Could not acquire the pending rebuild test lock.');
	adminSmokeRequest($cookieFile, $base . 'index.php?route=extension/module/qiqo/orderOutboxAction&user_token=' . urlencode($userToken), array(
		'outbox_id' => $testOutboxId,
		'outbox_action' => 'rebuild'
	));
	$db->query("SELECT RELEASE_LOCK('" . $db->real_escape_string($pendingLockName) . "')");
	$lockedRebuildStatus = $db->query("SELECT status FROM oc_qiqo_order_outbox WHERE outbox_id = '" . $testOutboxId . "'")->fetch_assoc()['status'];
	adminSmokeAssert($lockedRebuildStatus === 'pending', 'Payload rebuild must not run while the order lifecycle lock is active.');

	adminSmokeRequest($cookieFile, $base . 'index.php?route=extension/module/qiqo/orderOutboxAction&user_token=' . urlencode($userToken), array(
		'outbox_id' => $processingOutboxId,
		'outbox_action' => 'mark_uncertain'
	));
	$processingStatus = $db->query("SELECT status FROM oc_qiqo_order_outbox WHERE outbox_id = '" . $processingOutboxId . "'")->fetch_assoc()['status'];
	adminSmokeAssert($processingStatus === 'processing', 'A live processing lease must not be released by another operator.');
	$db->query("UPDATE oc_qiqo_order_outbox SET locked_at = DATE_SUB(NOW(), INTERVAL 10 MINUTE) WHERE outbox_id = '" . $processingOutboxId . "'");
	$processingLockName = 'qiqo_order_export_' . substr(sha1(DB_DATABASE . ':oc_' . $processingOrderId), 0, 40);
	$lockResult = $db->query("SELECT GET_LOCK('" . $db->real_escape_string($processingLockName) . "', 0) AS acquired")->fetch_assoc();
	adminSmokeAssert((int)$lockResult['acquired'] === 1, 'Could not acquire the temporary active export lock.');
	adminSmokeRequest($cookieFile, $base . 'index.php?route=extension/module/qiqo/orderOutboxAction&user_token=' . urlencode($userToken), array(
		'outbox_id' => $processingOutboxId,
		'outbox_action' => 'mark_uncertain'
	));
	$lockedProcessingStatus = $db->query("SELECT status FROM oc_qiqo_order_outbox WHERE outbox_id = '" . $processingOutboxId . "'")->fetch_assoc()['status'];
	adminSmokeAssert($lockedProcessingStatus === 'processing', 'An active named export lock must prevent stale-processing recovery.');
	$db->query("SELECT RELEASE_LOCK('" . $db->real_escape_string($processingLockName) . "')");
	adminSmokeRequest($cookieFile, $base . 'index.php?route=extension/module/qiqo/orderOutboxAction&user_token=' . urlencode($userToken), array(
		'outbox_id' => $processingOutboxId,
		'outbox_action' => 'mark_uncertain'
	));
	$staleProcessingStatus = $db->query("SELECT status FROM oc_qiqo_order_outbox WHERE outbox_id = '" . $processingOutboxId . "'")->fetch_assoc()['status'];
	adminSmokeAssert($staleProcessingStatus === 'uncertain', 'A stale processing lease must be quarantined for ERP verification.');

	$pending = $db->query("SELECT outbox_id, attempts FROM oc_qiqo_order_outbox WHERE outbox_id = '" . $testOutboxId . "' LIMIT 1")->fetch_assoc();
	adminSmokeAssert((bool)$pending, 'Pending outbox row is missing.');
	$sendAttempt = adminSmokeRequest($cookieFile, $base . 'index.php?route=extension/module/qiqo/orderOutboxAction&user_token=' . urlencode($userToken), array(
		'outbox_id' => (int)$pending['outbox_id'],
		'outbox_action' => 'send'
	));
	adminSmokeAssert(strpos($sendAttempt['body'], 'sigurnosno isključeno') !== false, 'Disabled send action did not return a safety error.');
	$attemptsAfter = (int)$db->query("SELECT attempts FROM oc_qiqo_order_outbox WHERE outbox_id = '" . (int)$pending['outbox_id'] . "'")->fetch_assoc()['attempts'];
	adminSmokeAssert($attemptsAfter === (int)$pending['attempts'], 'Disabled send action must not contact ERP or increment attempts.');

	echo "Local QIQO admin smoke tests passed.\n";
} finally {
	foreach ($settingRows as $settingRow) {
		$db->query("UPDATE oc_setting SET value = '" . $db->real_escape_string($settingRow['value']) . "' WHERE setting_id = '" . (int)$settingRow['setting_id'] . "'");
	}
	$db->query("DELETE FROM oc_qiqo_order_outbox WHERE order_id IN ('" . $testOrderId . "', '" . $uncertainOrderId . "', '" . $processingOrderId . "')");
	$db->query("DELETE FROM oc_user WHERE username = '" . $db->real_escape_string($username) . "'");
	if ($cookieFile && is_file($cookieFile)) {
		unlink($cookieFile);
	}
	$db->close();
}
