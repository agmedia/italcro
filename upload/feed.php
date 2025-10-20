<?php

// 🔹 Priprema podataka za autentifikaciju i datum
$korisnik = 'AGMedia';   // <-- upiši svoj korisnički naziv
$lozinka  = 'TUde23!$zS';   // <-- upiši svoju lozinku
$datum    = date('Y-m-d\TH:i:s', strtotime('-120 day'));

$xml = '<?xml version="1.0" encoding="utf-8"?>
<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
               xmlns:xsd="http://www.w3.org/2001/XMLSchema"
               xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <qArtikliWeb xmlns="http://www.qiqo.hr/">
      <korisnik>' . htmlspecialchars($korisnik) . '</korisnik>
      <lozinka>' . htmlspecialchars($lozinka) . '</lozinka>
      <datum>' . $datum . '</datum>
    </qArtikliWeb>
  </soap:Body>
</soap:Envelope>';

$url = 'http://195.29.121.190:9988/WebQReaderNew.asmx';

$ch = curl_init($url);
curl_setopt_array($ch, [
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $xml,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => [
        'Content-Type: text/xml; charset=utf-8',
        'SOAPAction: "http://www.qiqo.hr/qArtikliWeb"',
    ],
]);

$response = curl_exec($ch);
curl_close($ch);

if (!$response) die("❌ Nema odgovora od servera");

libxml_use_internal_errors(true);
$xmlResponse = simplexml_load_string($response);

if ($xmlResponse === false) {
    echo "❌ Greška u XML-u:\n";
    foreach (libxml_get_errors() as $e) echo $e->message;
    exit;
}

$nsSOAP  = 'http://schemas.xmlsoap.org/soap/envelope/';
$nsQIQO  = 'http://www.qiqo.hr/';
$nsDIFF  = 'urn:schemas-microsoft-com:xml-diffgram-v1';

// Idi korak po korak
$body   = $xmlResponse->children($nsSOAP)->Body;
$result = $body->children($nsQIQO)
    ->qArtikliWebResponse
    ->qArtikliWebResult;

// unutar result imamo schema + diffgram
$children = $result->children($nsDIFF);
if (!$children->diffgram) {
    // ako SimpleXML ne vidi namespace, probaj bez
    $children = $result->children();
}

$diffgram = $children->diffgram ?? null;
if (!$diffgram) die("❌ diffgram nije pronađen.");

// unutar diffgram → NewDataSet → lines
$newDataSet = $diffgram->NewDataSet ?? null;
if (!$newDataSet) {
    // fallback ako namespace zeza
    $newDataSet = $diffgram->children()->NewDataSet ?? null;
}

if (!$newDataSet) die("❌ Nema NewDataSet unutar diffgrama.");

// 🔹 Parsiraj svaki <lines>
$records = [];
foreach ($newDataSet->lines as $line) {
    $records[] = [
        'gid'           => (int) $line->gid,
        'id'            => (int) $line->id,
        'sortid'        => (int) $line->sortid,
        'cent'          => (string) $line->cent,
        'jm'            => (string) $line->jm,
        'cijena'        => (float) $line->cijena,
        'pak'           => (int) $line->pak,
        'pakkol'        => (float) $line->pakkol,
        'zaliha'        => (float) $line->zaliha,
        'barcode'       => (string) $line->barcode,
        'izmjena'       => (string) $line->izmjena,
        'aktivan'       => ((string)$line->aktivan === 'true'),
        'kataloggrupa'  => (string) $line->kataloggrupa,
        'sortkatalog'   => (string) $line->sortkatalog,
        'opiskatalog'   => trim((string) $line->opiskatalog),
        'dimmodel'      => trim((string) $line->dimmodel),
    ];
}

// ✅ Ispis JSON-a
header('Content-Type: application/json; charset=utf-8');
echo json_encode($records, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
