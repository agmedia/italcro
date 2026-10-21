<?php
// Local-only integration coverage for uploads, publication and PDF delivery.
if (PHP_SAPI !== 'cli') exit(1);
require __DIR__ . '/../upload/config.php';
if (!in_array(DB_HOSTNAME, ['localhost', '127.0.0.1', '::1'], true)) throw new RuntimeException('Local database required.');
require DIR_SYSTEM . 'library/leaflet/files.php';
function leafletHttpAssert($value, $message) { if (!$value) throw new RuntimeException($message); }
function leafletHttpRequest($cookie, $route, $post = null, $admin = true) {
    $url = 'https://italcro.test/' . ($admin ? 'admin/' : '') . 'index.php?route=' . $route;
    $headers = [];
    $ch = curl_init($url);
    curl_setopt_array($ch, [CURLOPT_RETURNTRANSFER => true, CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_MAXREDIRS => 5, CURLOPT_CONNECTTIMEOUT => 5, CURLOPT_TIMEOUT => 45,
        CURLOPT_SSL_VERIFYPEER => false, CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_COOKIEFILE => $cookie, CURLOPT_COOKIEJAR => $cookie,
        CURLOPT_HEADERFUNCTION => static function ($ch, $line) use (&$headers) { $headers[] = trim($line); return strlen($line); }]);
    if ($post !== null) { curl_setopt($ch, CURLOPT_POST, true); curl_setopt($ch, CURLOPT_POSTFIELDS, $post); }
    $body = curl_exec($ch);
    $result = ['body' => $body, 'status' => (int)curl_getinfo($ch, CURLINFO_HTTP_CODE),
        'url' => curl_getinfo($ch, CURLINFO_EFFECTIVE_URL), 'type' => curl_getinfo($ch, CURLINFO_CONTENT_TYPE), 'headers' => implode("\n", $headers)];
    curl_close($ch);
    leafletHttpAssert(is_string($body) && !preg_match('/(?:Fatal error|Parse error|Deprecated|Warning)<\/b>:/i', $body), 'HTTP/PHP response failed.');
    return $result;
}
function leafletHttpCsrf($body) {
    preg_match('/name="csrf"[^>]*value="([^"]+)"/', $body, $match);
    leafletHttpAssert(!empty($match[1]), 'Leaflet form must expose a CSRF token.');
    return html_entity_decode($match[1], ENT_QUOTES, 'UTF-8');
}
$db = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE, (int)DB_PORT);
$db->set_charset('utf8mb4');
$tag = 'leaflet_' . bin2hex(random_bytes(5));
$cookie = tempnam(sys_get_temp_dir(), 'leaflet-http-');
$anonymous = tempnam(sys_get_temp_dir(), 'leaflet-anon-');
$fake = tempnam(sys_get_temp_dir(), 'leaflet-invalid-');
file_put_contents($fake, 'This is not a PDF.');
$fixture = __DIR__ . '/fixtures/leaflet.pdf';
leafletHttpAssert(LeafletFiles::validPdf($fixture), 'Valid two-page fixture required.');
$userId = 0; $groupId = 0; $ids = []; $managedFiles = []; $manualCover = '';
$storageBefore = glob(rtrim(DIR_DOWNLOAD, '/\\') . '/leaflets/*') ?: [];
try {
    $permissions = ['access' => ['common/dashboard', 'catalog/leaflet'], 'modify' => ['catalog/leaflet']];
    $db->query('INSERT INTO `' . DB_PREFIX . "user_group` SET name='" . $tag . "',permission='" . $db->real_escape_string(json_encode($permissions)) . "'");
    $groupId = (int)$db->insert_id;
    $password = bin2hex(random_bytes(16)); $salt = substr(bin2hex(random_bytes(8)), 0, 9);
    $hash = sha1($salt . sha1($salt . sha1($password)));
    $db->query('INSERT INTO `' . DB_PREFIX . "user` SET user_group_id=" . $groupId . ",username='" . $tag
        . "',password='" . $hash . "',salt='" . $salt . "',firstname='Codex',lastname='Leaflet QA',"
        . "email='leaflet-test@italcro.local',image='',code='',ip='127.0.0.1',status=1,date_added=NOW()");
    $userId = (int)$db->insert_id;
    leafletHttpRequest($cookie, 'common/login');
    $login = leafletHttpRequest($cookie, 'common/login', http_build_query(['username' => $tag, 'password' => $password]));
    parse_str((string)parse_url($login['url'], PHP_URL_QUERY), $query);
    $token = (string)($query['user_token'] ?? '');
    leafletHttpAssert($token !== '', 'Temporary administrator login failed.');
    $suffix = '&user_token=' . rawurlencode($token);
    $form = leafletHttpRequest($cookie, 'catalog/leaflet/add' . $suffix);
    $csrf = leafletHttpCsrf($form['body']);
    $title = $tag . ' <img src=x onerror=alert(1)>';
    $post = ['csrf' => $csrf, 'title' => $title, 'published_at' => date('Y-m-d'),
        'status' => '0', 'sort_order' => '0', 'thumbnail' => '', 'cover_mode' => 'auto'];
    $count = static function () use ($db, $tag) { return (int)$db->query('SELECT COUNT(*) n FROM `' . DB_PREFIX . "leaflet` WHERE title LIKE '" . $tag . "%'")->fetch_assoc()['n']; };
    foreach (['csrf', 'date', 'pdf'] as $bad) {
        $invalid = $post;
        if ($bad === 'csrf') $invalid['csrf'] = 'invalid';
        if ($bad === 'date') $invalid['published_at'] = '2026-02-30';
        $invalid['pdf'] = new CURLFile($bad === 'pdf' ? $fake : $fixture, 'application/pdf', 'Letak.pdf');
        leafletHttpRequest($cookie, 'catalog/leaflet/add' . $suffix, $invalid);
        leafletHttpAssert($count() === 0, 'Invalid CSRF/date/PDF must not create a leaflet: ' . $bad);
    }
    $add = $post; $add['pdf'] = new CURLFile($fixture, 'application/pdf', 'Probni & letak.pdf');
    $saved = leafletHttpRequest($cookie, 'catalog/leaflet/add' . $suffix, $add);
    leafletHttpAssert($count() === 1, 'A valid PDF upload must create one draft.');
    $row = $db->query('SELECT * FROM `' . DB_PREFIX . "leaflet` WHERE title LIKE '" . $tag . "%' ORDER BY leaflet_id DESC LIMIT 1")->fetch_assoc();
    $id = (int)$row['leaflet_id']; $ids[] = $id; $managedFiles[] = $row['filename'];
    leafletHttpAssert(LeafletFiles::pdfPath($row['filename']) !== null && $row['original_filename'] === 'Probni & letak.pdf', 'PDF must be stored privately with its original download name.');
    $draft = leafletHttpRequest($anonymous, 'information/leaflet', null, false);
    leafletHttpAssert(strpos($draft['body'], $tag) === false, 'Draft must not appear publicly.');
    leafletHttpAssert(leafletHttpRequest($anonymous, 'information/leaflet/download&leaflet_id=' . $id, null, false)['status'] === 404, 'Draft download must return 404.');
    $adminPdf = leafletHttpRequest($cookie, 'catalog/leaflet/download&leaflet_id=' . $id . $suffix);
    leafletHttpAssert($adminPdf['status'] === 200 && hash('sha256', $adminPdf['body']) === hash_file('sha256', $fixture), 'Administrator must be able to download the exact draft PDF.');
    $editRoute = 'catalog/leaflet/edit&leaflet_id=' . $id . $suffix;
    $publish = $post; $publish['status'] = '1'; $publish['published_at'] = date('Y-m-d', strtotime('+2 days'));
    leafletHttpRequest($cookie, $editRoute, $publish);
    leafletHttpAssert(leafletHttpRequest($anonymous, 'information/leaflet/view&leaflet_id=' . $id, null, false)['status'] === 404, 'Scheduled leaflet must not be exposed early.');
    $publish['published_at'] = date('Y-m-d');
    leafletHttpRequest($cookie, $editRoute, $publish);
    $page = leafletHttpRequest($anonymous, 'information/leaflet', null, false);
    leafletHttpAssert($page['status'] === 200 && strpos($page['body'], htmlspecialchars($title, ENT_QUOTES, 'UTF-8')) !== false
        && strpos($page['body'], $title) === false, 'Published title must be visible and HTML escaped.');
    leafletHttpAssert(strpos($page['body'], $row['filename']) === false, 'Private storage names must never appear in public HTML.');
    foreach (['view' => 'inline', 'download' => 'attachment'] as $action => $disposition) {
        $pdf = leafletHttpRequest($anonymous, 'information/leaflet/' . $action . '&leaflet_id=' . $id, null, false);
        leafletHttpAssert($pdf['status'] === 200 && strpos($pdf['type'], 'application/pdf') === 0
            && hash('sha256', $pdf['body']) === hash_file('sha256', $fixture)
            && stripos($pdf['headers'], 'Content-Disposition: ' . $disposition) !== false
            && stripos($pdf['headers'], 'X-Content-Type-Options: nosniff') !== false, 'PDF streaming must preserve bytes, type and disposition: ' . $action);
    }
    $manualCover = 'catalog/leaflets/' . $tag . '.png';
    if (!is_dir(dirname(DIR_IMAGE . $manualCover))) mkdir(dirname(DIR_IMAGE . $manualCover), 0755, true);
    file_put_contents(DIR_IMAGE . $manualCover, base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/x8AAwMCAO+aN1sAAAAASUVORK5CYII='));
    $publish['cover_mode'] = 'manual'; $publish['thumbnail'] = $manualCover;
    leafletHttpRequest($cookie, $editRoute, $publish);
    $page = leafletHttpRequest($anonymous, 'information/leaflet', null, false);
    leafletHttpAssert(strpos($page['body'], $manualCover) !== false, 'A selected manual cover must be displayed.');
    $replace = $publish; $replace['pdf'] = new CURLFile($fixture, 'application/pdf', 'Zamjenski letak.pdf');
    leafletHttpRequest($cookie, $editRoute, $replace);
    $replacement = $db->query('SELECT * FROM `' . DB_PREFIX . 'leaflet` WHERE leaflet_id=' . $id)->fetch_assoc();
    $managedFiles[] = $replacement['filename'];
    leafletHttpAssert($replacement['filename'] !== $row['filename'] && LeafletFiles::pdfPath($row['filename']) !== null, 'Replacing a PDF must preserve its previous private file for recovery.');
    $permissions['modify'] = [];
    $db->query('UPDATE `' . DB_PREFIX . "user_group` SET permission='" . $db->real_escape_string(json_encode($permissions)) . "' WHERE user_group_id=" . $groupId);
    $denied = $publish; $denied['status'] = '0'; leafletHttpRequest($cookie, $editRoute, $denied);
    leafletHttpAssert((int)$db->query('SELECT status FROM `' . DB_PREFIX . 'leaflet` WHERE leaflet_id=' . $id)->fetch_assoc()['status'] === 1, 'A user without modify permission must not change publication.');
    $permissions['modify'] = ['catalog/leaflet'];
    $db->query('UPDATE `' . DB_PREFIX . "user_group` SET permission='" . $db->real_escape_string(json_encode($permissions)) . "' WHERE user_group_id=" . $groupId);
    leafletHttpRequest($cookie, 'catalog/leaflet/delete' . $suffix, ['csrf' => 'invalid', 'selected[0]' => $id]);
    leafletHttpAssert($count() === 1, 'Invalid CSRF must not delete a record.');
    leafletHttpRequest($cookie, 'catalog/leaflet/delete' . $suffix, ['csrf' => $csrf, 'selected[0]' => $id]);
    leafletHttpAssert($count() === 0 && LeafletFiles::pdfPath($replacement['filename']) !== null, 'Deleting a record must retain its private PDF for recovery.');
    leafletHttpAssert(leafletHttpRequest($anonymous, 'information/leaflet/download&leaflet_id=' . $id, null, false)['status'] === 404, 'Removed publication must no longer be downloadable publicly.');
    echo "Local leaflet HTTP checks passed: multipart upload, CSRF/date/PDF rejection, permission, draft/scheduling, escaped publication, exact PDF bytes, inline/download, manual cover, replacement and recovery.\n";
} finally {
    foreach ($ids as $id) $db->query('DELETE FROM `' . DB_PREFIX . 'leaflet` WHERE leaflet_id=' . (int)$id);
    if ($userId) $db->query('DELETE FROM `' . DB_PREFIX . 'user` WHERE user_id=' . $userId);
    if ($groupId) $db->query('DELETE FROM `' . DB_PREFIX . 'user_group` WHERE user_group_id=' . $groupId);
    foreach ($managedFiles as $filename) {
        $file = LeafletFiles::pdfPath($filename); if ($file) unlink($file);
        $cover = DIR_IMAGE . 'catalog/leaflets/' . substr($filename, 0, 32) . '.jpg'; if (is_file($cover)) unlink($cover);
    }
    foreach (array_diff(glob(rtrim(DIR_DOWNLOAD, '/\\') . '/leaflets/archive-*.json') ?: [], $storageBefore) as $archive) {
        $record = json_decode(file_get_contents($archive), true);
        if (in_array((int)($record['leaflet']['leaflet_id'] ?? 0), $ids, true)) unlink($archive);
    }
    if ($manualCover && is_file(DIR_IMAGE . $manualCover)) unlink(DIR_IMAGE . $manualCover);
    foreach ([$cookie, $anonymous, $fake] as $temporary) if (is_file($temporary)) unlink($temporary);
    $db->close();
}
