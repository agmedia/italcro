<?php

// 🔹 Priprema podataka za autentifikaciju i datum
$korisnik = 'AGMedia';   // <-- upiši svoj korisnički naziv
$lozinka  = 'TUde23!$zS';   // <-- upiši svoju lozinku
$datum    = date('Y-m-d\TH:i:s', strtotime('-2 year'));

// 🔹 SOAP XML zahtjev
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

$url = 'http://195.29.121.190:9988/WebQReaderNew.asmx';

// 🔹 Pošalji zahtjev
$ch = curl_init($url);
curl_setopt_array($ch, [
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $xml,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => [
        'Content-Type: text/xml; charset=utf-8',
        'SOAPAction: "http://www.qiqo.hr/qKatalogGrupaWeb"',
    ],
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curlError = curl_error($ch);
curl_close($ch);

echo "===== DEBUG INFO =====\n";
echo "HTTP status: $httpCode\n";
echo "cURL error: " . ($curlError ?: 'nema') . "\n";
echo "Duljina odgovora: " . strlen($response) . " bajtova\n";
echo "=======================\n\n";

// 🔹 Ako nema odgovora
if ($response === false || strlen(trim($response)) === 0) {
    echo "⚠️ Nema odgovora od servera ili SOAPAction nije prepoznat.\n";
    exit;
}

// 🧹 Čišćenje QIQO XML-a od neispravnih znakova
// 1️⃣ Ukloni sve kontrolne znakove osim tab/newline/carriage return
$response = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]/u', '', $response);

// 2️⃣ Ukloni nevažeće XML entitete poput &#x1F;, &#x1E;, &#x1C; itd.
$response = preg_replace('/&#x(?:1C|1D|1E|1F|0[0-9A-F]);?/i', '', $response);
$response = preg_replace('/&#(?:28|29|30|31);?/i', '', $response); // decimalne reference

// 3️⃣ Opcionalno normaliziraj encoding (ponekad pomaže)
$response = mb_convert_encoding($response, 'UTF-8', 'UTF-8');

// 🔹 Snimi puni odgovor za debug
file_put_contents('debug_feed_groups_raw_full.xml', $response);

// ----------------------------------------------------
// 1️⃣ Parsiraj SOAP envelope
// ----------------------------------------------------
libxml_use_internal_errors(true);
$xmlResponse = simplexml_load_string($response);

if ($xmlResponse === false) {
    echo "❌ Greška u XML-u:\n";
    foreach (libxml_get_errors() as $e) echo $e->message;
    echo "\nPogledaj debug_feed_groups_raw_full.xml\n";
    exit;
}

$nsSOAP = 'http://schemas.xmlsoap.org/soap/envelope/';
$nsQIQO = 'http://www.qiqo.hr/';
$nsDIFF = 'urn:schemas-microsoft-com:xml-diffgram-v1';

// ----------------------------------------------------
// 2️⃣ Dođi do qKatalogGrupaWebResult
// ----------------------------------------------------
$body = $xmlResponse->children($nsSOAP)->Body;
$result = $body->children($nsQIQO)
    ->qKatalogGrupaWebResponse
    ->qKatalogGrupaWebResult;

if (!$result) {
    die("❌ Nema qKatalogGrupaWebResult čvora.\n");
}

// ----------------------------------------------------
// 3️⃣ Unutar result nalazi se diffgr:diffgram → NewDataSet
// ----------------------------------------------------
$children = $result->children($nsDIFF);
if (!$children->diffgram) {
    $children = $result->children(); // fallback
}
$diffgram = $children->diffgram ?? null;
if (!$diffgram) die("❌ diffgram nije pronađen.\n");

$newDataSet = $diffgram->NewDataSet ?? null;
if (!$newDataSet) {
    $newDataSet = $diffgram->children()->NewDataSet ?? null;
}
if (!$newDataSet) die("❌ Nema NewDataSet unutar diffgrama.\n");

// ----------------------------------------------------
// 4️⃣ Izvuci sve <KatalogGrupa> elemente
// ----------------------------------------------------
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
        'izmjena'   => (string) $g->izmjena,
    ];
}

// ----------------------------------------------------
// 5️⃣ JSON rezultat
// ----------------------------------------------------
if (empty($records)) {
    echo "⚠️ 0 grupa pronađeno.\n";
    file_put_contents('debug_feed_groups_parsed.xml', $response);
    exit;
}

echo "✅ Uspješno parsirano " . count($records) . " grupa.\n\n";
header('Content-Type: application/json; charset=utf-8');
echo json_encode($records, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
