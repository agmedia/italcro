<?php
$korisnik = 'AGMedia';
$lozinka  = 'TUde23!$zS';
$datum    = date('Y-m-d\TH:i:s', strtotime('-2 year'));

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
$response = curl_exec($ch);
curl_close($ch);

// Očisti i parsiraj
$response = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]/u', '', $response);
$response = mb_convert_encoding($response, 'UTF-8', 'UTF-8');
$xmlResponse = simplexml_load_string($response);

$nsSOAP = 'http://schemas.xmlsoap.org/soap/envelope/';
$nsQIQO = 'http://www.qiqo.hr/';
$nsDIFF = 'urn:schemas-microsoft-com:xml-diffgram-v1';

$body   = $xmlResponse->children($nsSOAP)->Body;
$result = $body->children($nsQIQO)->qPartnerWebResponse->qPartnerWebResult;

// Preuzmi diffgram direktno (bez namespace children())
$diffgram = $result->diffgram ?? $result->children($nsDIFF)->diffgram;
$newDataSet = $diffgram->NewDataSet ?? $diffgram->children()->NewDataSet;

// Parsiraj <Partner>
$records = [];
foreach ($newDataSet->Partner as $p) {
    $records[] = [
        'id'      => (int) $p->id,
        'naziv'   => trim((string) $p->naziv),
        'oib'     => trim((string) $p->oib),
        'adresa'  => trim((string) $p->adresa),
        'mjesto'  => trim((string) $p->mjesto),
        'rabat'   => (float) $p->rabat,
        'aktivan' => ((string) $p->aktivan === 'true'),
        'izmjena' => (string) $p->izmjena
    ];
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($records, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
