<?php

// Exercise the generated OCMOD controllers through Herd, not just source PHP.
if (PHP_SAPI !== 'cli') exit(1);
require __DIR__ . '/../upload/config.php';
if (!in_array(DB_HOSTNAME, ['localhost', '127.0.0.1', '::1'], true)) {
    throw new RuntimeException('This HTTP smoke check requires the local installation.');
}

function rev32HttpPage($route) {
    $curl = curl_init('https://italcro.test/index.php?route=' . $route);
    curl_setopt_array($curl, [CURLOPT_RETURNTRANSFER => true, CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_MAXREDIRS => 5, CURLOPT_CONNECTTIMEOUT => 5, CURLOPT_TIMEOUT => 30,
        CURLOPT_SSL_VERIFYPEER => false, CURLOPT_SSL_VERIFYHOST => 0]);
    $body = curl_exec($curl);
    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);
    if (!is_string($body) || $status !== 200 || preg_match('/(?:Parse error|Fatal error|Warning|Deprecated|Notice)<\/b>:/i', $body)) {
        throw new RuntimeException('Local HTTP/OCMOD page failed: ' . $route);
    }
    return $body;
}

$home = rev32HttpPage('common/home');
preg_match_all('/<span class="top">([^<]+)<\/span>/u', $home, $matches);
$labels = array_map(function ($label) { return trim(html_entity_decode($label, ENT_QUOTES, 'UTF-8')); }, $matches[1]);
$expected = ['Brza narudžba', 'Novo', 'Akcije', 'Blog', 'Brandovi', 'Letak'];
$menus = 0;
foreach ($labels as $index => $label) {
    if ($label === 'Brza narudžba') {
        if (array_slice($labels, $index, count($expected)) !== $expected) {
            throw new RuntimeException('Primary menu order differs from the requested sequence.');
        }
        $menus++;
    }
}
if ($menus !== 2) throw new RuntimeException('Both desktop and mobile menus must be checked.');

foreach (['product/special' => 'Akcije', 'product/new_product' => 'Novo'] as $route => $title) {
    $body = rev32HttpPage($route);
    if (!preg_match('/<h[1-6][^>]*id="page-title"[^>]*>\s*' . preg_quote($title, '/') . '\s*<\/h[1-6]>/u', $body)) {
        throw new RuntimeException('Listing title missing: ' . $route);
    }
}
$search = rev32HttpPage('product/search&search=99999999999999999999999999');
if (strpos($search, 'Nema artikla koji odgovaraju traženom kriteriju.') === false) {
    throw new RuntimeException('An unknown numeric article code must show the empty search state.');
}

echo "Revizija 3.2 local HTTP checks passed (desktop/mobile menu, Akcije, Novo, numeric empty search and generated OCMOD PHP).\n";
