<?php
/**
 * feed_partner.php
 * Dohvaća partnere iz QIQO ERP sistema preko SOAP metode qPartnerWeb
 * i ispisuje JSON rezultat.
 */

// 🔹 Autentifikacija i datum (po potrebi možeš prilagoditi period)
$korisnik = 'AGMedia';
$lozinka  = 'TUde23!$zS';
$datum    = date('Y-m-d\TH:i:s', strtotime('-2 year'));

// 🔹 SOAP zahtjev
$xml = '<?xml version="1.0" encoding="utf-8"?>
<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
               xmlns:xsd="http://www.w3.org/2001/XMLSchema"
               xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <qPartnerWeb xmlns="http://www.qiqo.hr/">
      <korisnik>' . htmlspecialchars($korisnik) . '</korisnik>
      <lozinka>' . htmlspecialchars($lozinka) . '</lozinka>
      <datum>' . $datum . '</datum>
    </qPartnerWeb>
  </soap:Body>
</soap:Envelope>';

$url = 'http://195.29.121.190:9988/WebQReaderNew.asmx';

// 🔹 Pošalji SOAP request
$ch = curl_init($url);
curl_setopt_array($ch, [
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $xml,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => [
        'Content-Type: text/xml; charset=utf-8',
        'SOAPAction: "http://www.qiqo.hr/qPartnerWeb"',
    ],
]);

$response   = curl_exec($ch);
$httpCode   = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curlError  = curl_error($ch);
curl_close($ch);

// 🔹 Debug info
echo "===== DEBUG INFO =====\n";
echo "HTTP status: $httpCode\n";
echo "cURL error: " . ($curlError ?: 'nema') . "\n";
echo "Duljina odgovora: " . strlen($response) . " bajtova\n";
echo "=======================\n\n";

if ($response === false || strlen(trim($response)) === 0) {
    echo "⚠️ Nema odgovora od servera ili SOAPAction nije prepoznat.\n";
    exit;
}

// 🧹 Očisti XML od loših znakova
$response = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]/u', '', $response);
$response = preg_replace('/&#x(?:1C|1D|1E|1F|0[0-9A-F]);?/i', '', $response);
$response = mb_convert_encoding($response, 'UTF-8', 'UTF-8');

// 🔹 Spremi RAW XML za debug
file_put_contents('debug_feed_partner_raw.xml', $response);

// ----------------------------------------------------
// 1️⃣ Parsiraj SOAP envelope
// ----------------------------------------------------
libxml_use_internal_errors(true);
$xmlResponse = simplexml_load_string($response);

if ($xmlResponse === false) {
    echo "❌ Greška u XML-u:\n";
    foreach (libxml_get_errors() as $e) echo $e->message;
    echo "\nPogledaj debug_feed_partner_raw.xml\n";
    exit;
}

$nsSOAP = 'http://schemas.xmlsoap.org/soap/envelope/';
$nsQIQO = 'http://www.qiqo.hr/';
$nsDIFF = 'urn:schemas-microsoft-com:xml-diffgram-v1';

// ----------------------------------------------------
// 2️⃣ Dođi do qPartnerWebResult
// ----------------------------------------------------
$body   = $xmlResponse->children($nsSOAP)->Body;
$result = $body->children($nsQIQO)
    ->qPartnerWebResponse
    ->qPartnerWebResult;

if (!$result) {
    die("❌ Nema qPartnerWebResult čvora.\n");
}

// ----------------------------------------------------
// 3️⃣ Unutar result nalazi se diffgr:diffgram → NewDataSet
// ----------------------------------------------------
$children = $result->children($nsDIFF);
if (!$children->diffgram) {
    $children = $result->children();
}
$diffgram = $children->diffgram ?? null;
if (!$diffgram) die("❌ diffgram nije pronađen.\n");

$newDataSet = $diffgram->NewDataSet ?? null;
if (!$newDataSet) {
    $newDataSet = $diffgram->children()->NewDataSet ?? null;
}
if (!$newDataSet) die("❌ Nema NewDataSet unutar diffgrama.\n");

// ----------------------------------------------------
// 4️⃣ Izvuci sve <Partner> elemente
// ----------------------------------------------------
$records = [];
foreach ($newDataSet->Partner as $p) {
    $records[] = [
        'id'          => (int) $p->id,
        'naziv'       => trim((string) $p->naziv),
        'adresa'      => trim((string) $p->adresa),
        'mjesto'      => trim((string) $p->mjesto),
        'pbr'         => trim((string) $p->pbr),
        'drzava'      => trim((string) $p->drzava),
        'oib'         => trim((string) $p->oib),
        'email'       => trim((string) $p->email),
        'telefon'     => trim((string) $p->telefon),
        'mobitel'     => trim((string) $p->mobitel),
        'web'         => trim((string) $p->web),
        'kontakt_osoba' => trim((string) $p->kontakt_osoba),
        'tip'         => trim((string) $p->tip),
        'vrsta'       => trim((string) $p->vrsta),
        'status'      => trim((string) $p->status),
        'izmjena'     => (string) $p->izmjena,
    ];
}

// ----------------------------------------------------
// 5️⃣ Ispiši JSON rezultat
// ----------------------------------------------------
if (empty($records)) {
    echo "⚠️ 0 partnera pronađeno.\n";
    file_put_contents('debug_feed_partner_parsed.xml', $response);
    exit;
}

echo "✅ Uspješno parsirano " . count($records) . " partnera.\n\n";
header('Content-Type: application/json; charset=utf-8');
echo json_encode($records, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
