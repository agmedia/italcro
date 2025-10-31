<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: text/plain; charset=utf-8');

echo "===== FEED KATALOG GRUPA DEBUG START =====\n";

// 🔹 Postavke
$korisnik = 'AGMedia';
$lozinka  = 'TUde23!$zS';
$datum    = date('Y-m-d\TH:i:s', strtotime('-2 year'));
$url      = 'http://195.29.121.190:9988/WebQReaderNew.asmx';

// 🔹 SOAP envelope
$xml = '<?xml version="1.0" encoding="utf-8"?>
<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
               xmlns:xsd="http://www.w3.org/2001/XMLSchema"
               xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <qKatalogGrupaWeb xmlns="http://www.qiqo.hr/">
      <korisnik>' . htmlspecialchars($korisnik) . '</korisnik>
      <lozinka>' . htmlspecialchars($lozinka) . '</lozinka>
      <datum>' . $datum . '</datum>
    </qKatalogGrupaWeb>
  </soap:Body>
</soap:Envelope>';

echo "SOAP XML:\n$xml\n\n";

// 🔹 cURL poziv
$ch = curl_init($url);
curl_setopt_array($ch, [
    CURLOPT_POST            => true,
    CURLOPT_POSTFIELDS      => $xml,
    CURLOPT_RETURNTRANSFER  => true,
    CURLOPT_TIMEOUT         => 30,
    CURLOPT_CONNECTTIMEOUT  => 10,
    CURLOPT_HTTPHEADER      => [
        'Content-Type: text/xml; charset=utf-8',
        'SOAPAction: "http://www.qiqo.hr/qKatalogGrupaWeb"',
    ],
]);
$response  = curl_exec($ch);
$httpCode  = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curlError = curl_error($ch);
curl_close($ch);

echo "HTTP code: {$httpCode}\n";
echo "cURL error: " . ($curlError ?: 'nema') . "\n";
echo "Duljina odgovora: " . strlen($response) . " bajtova\n\n";

if ($response === false || trim($response) === '') {
    echo "❌ Nema odgovora od servera.\n";
    exit;
}

// 🔹 Očisti XML od loših znakova
$response = preg_replace('/[\x00-\x1F\x7F]/u', '', $response);
$response = preg_replace('/&#x[0-9A-F]+;/i', '', $response);
$response = preg_replace('/&#[0-9]+;/', '', $response);
$response = str_replace(["\x1F", "\x1E", "\x1D", "\x1C"], '', $response);
$response = mb_convert_encoding($response, 'UTF-8', 'UTF-8');

file_put_contents('debug_feed_group_raw.xml', $response);
echo "XML očišćen i spremljen u debug_feed_group_raw.xml\n\n";

// 🔹 Parsiranje XML-a
libxml_use_internal_errors(true);
$xmlResponse = simplexml_load_string($response);

if ($xmlResponse === false) {
    echo "❌ Greška u XML parsiranju:\n";
    foreach (libxml_get_errors() as $err) echo $err->message;
    exit;
}

$nsSOAP = 'http://schemas.xmlsoap.org/soap/envelope/';
$nsQIQO = 'http://www.qiqo.hr/';
$nsDIFF = 'urn:schemas-microsoft-com:xml-diffgram-v1';

$body   = $xmlResponse->children($nsSOAP)->Body ?? null;
if (!$body) { echo "❌ Nema SOAP Body.\n"; exit; }

$result = $body->children($nsQIQO)->qKatalogGrupaWebResponse->qKatalogGrupaWebResult ?? null;
if (!$result) { echo "❌ Nema qKatalogGrupaWebResult čvora.\n"; exit; }

$diffgram = $result->diffgram ?? $result->children($nsDIFF)->diffgram ?? null;
if (!$diffgram) { echo "❌ Nema diffgram čvora.\n"; exit; }

$newDataSet = $diffgram->NewDataSet ?? $diffgram->children()->NewDataSet ?? null;
if (!$newDataSet) { echo "❌ Nema NewDataSet čvora.\n"; exit; }

// 🔹 Parsiraj <KatalogGrupa>
$records = [];
foreach ($newDataSet->KatalogGrupa as $g) {
    $records[] = [
        'id'        => (int) $g->id,
        'naziv'     => trim((string) $g->naziv),
        'podnaziv'  => trim((string) $g->podnaziv),
        'opis'      => trim((string) $g->opis),
        'picpath'   => trim((string) $g->picpath),
        'logopath'  => trim((string) $g->logopath),
        'blister'   => (int) $g->blister,
        'izmjena'   => (string) $g->izmjena
    ];
}

echo "✅ Parsirano grupa: " . count($records) . "\n\n";
print_r(array_slice($records, 0, 5)); // prva 5 radi pregleda

echo "\n===== FEED KATALOG GRUPA DEBUG END =====\n";
