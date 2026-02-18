<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: text/plain; charset=utf-8');

echo "===== CUSTOMER AUTH API DEBUG START =====\n";

$url      = 'http://195.29.121.190:9988/WebQReaderNew.asmx';
$korisnik = 'AGMedia';
$lozinka  = 'TUde23!$zS';
$datum    = date('Y-m-d\TH:i:s', strtotime('-2 year'));

function fetch_table(string $url, string $korisnik, string $lozinka, string $datum, string $method): array
{
    $soapAction = "http://www.qiqo.hr/{$method}";
    $xml = '<?xml version="1.0" encoding="utf-8"?>
<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
               xmlns:xsd="http://www.w3.org/2001/XMLSchema"
               xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <' . $method . ' xmlns="http://www.qiqo.hr/">
      <korisnik>' . htmlspecialchars($korisnik) . '</korisnik>
      <lozinka>' . htmlspecialchars($lozinka) . '</lozinka>
      <datum>' . $datum . '</datum>
    </' . $method . '>
  </soap:Body>
</soap:Envelope>';

    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_POST            => true,
        CURLOPT_POSTFIELDS      => $xml,
        CURLOPT_RETURNTRANSFER  => true,
        CURLOPT_TIMEOUT         => 30,
        CURLOPT_CONNECTTIMEOUT  => 10,
        CURLOPT_HTTPHEADER      => [
            'Content-Type: text/xml; charset=utf-8',
            'SOAPAction: "' . $soapAction . '"',
        ],
    ]);

    $response  = curl_exec($ch);
    $httpCode  = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlError = curl_error($ch);
    curl_close($ch);

    if ($response === false || trim((string)$response) === '') {
        return [
            '__meta' => ['http' => $httpCode, 'curl_error' => $curlError, 'error' => 'empty_response'],
            '__rows' => []
        ];
    }

    $response = preg_replace('/[\x00-\x1F\x7F]/u', '', $response);
    $response = preg_replace('/&#x[0-9A-F]+;/i', '', $response);
    $response = preg_replace('/&#[0-9]+;/', '', $response);
    $response = str_replace(["\x1F", "\x1E", "\x1D", "\x1C"], '', $response);
    $response = mb_convert_encoding($response, 'UTF-8', 'UTF-8');

    libxml_use_internal_errors(true);
    $xmlResponse = simplexml_load_string($response);
    if ($xmlResponse === false) {
        $errors = [];
        foreach (libxml_get_errors() as $err) {
            $errors[] = trim($err->message);
        }
        return [
            '__meta' => ['http' => $httpCode, 'curl_error' => $curlError, 'error' => implode('; ', $errors)],
            '__rows' => []
        ];
    }

    $nsSOAP = 'http://schemas.xmlsoap.org/soap/envelope/';
    $nsQIQO = 'http://www.qiqo.hr/';
    $nsDIFF = 'urn:schemas-microsoft-com:xml-diffgram-v1';

    $body = $xmlResponse->children($nsSOAP)->Body ?? null;
    $result = $body ? ($body->children($nsQIQO)->{$method . 'Response'}->{$method . 'Result'} ?? null) : null;
    $diffgram = $result ? ($result->diffgram ?? $result->children($nsDIFF)->diffgram ?? null) : null;
    $newDataSet = $diffgram ? ($diffgram->NewDataSet ?? $diffgram->children()->NewDataSet ?? null) : null;

    if (!$newDataSet) {
        return [
            '__meta' => ['http' => $httpCode, 'curl_error' => $curlError, 'error' => 'missing_newdataset'],
            '__rows' => []
        ];
    }

    $nodeName = null;
    foreach ($newDataSet->children() as $child) {
        $nodeName = $child->getName();
        break;
    }

    $rows = [];
    if ($nodeName) {
        foreach ($newDataSet->{$nodeName} as $item) {
            $row = [];
            foreach ($item as $key => $value) {
                $row[$key] = trim((string)$value);
            }
            $rows[] = $row;
        }
    }

    return [
        '__meta' => ['http' => $httpCode, 'curl_error' => $curlError, 'node' => $nodeName],
        '__rows' => $rows
    ];
}

$methods = [
    'qPartnerWeb',
    'qMjestoIsporukeWeb',
    'qPartnerArtikalRabatWeb',
    'qAkcijskiCjenikWeb',
];

foreach ($methods as $method) {
    $result = fetch_table($url, $korisnik, $lozinka, $datum, $method);
    $rows = $result['__rows'];
    $meta = $result['__meta'];

    echo "\n--- {$method} ---\n";
    echo "HTTP: " . ($meta['http'] ?? '-') . "\n";
    echo "Node: " . ($meta['node'] ?? '-') . "\n";
    echo "Rows: " . count($rows) . "\n";

    if (!empty($meta['curl_error'])) {
        echo "cURL error: {$meta['curl_error']}\n";
    }
    if (!empty($meta['error'])) {
        echo "Parse/API error: {$meta['error']}\n";
    }

    if (!empty($rows[0]) && is_array($rows[0])) {
        echo "Columns: " . implode(', ', array_keys($rows[0])) . "\n";
        echo "Sample row:\n";
        print_r($rows[0]);
    } else {
        echo "No rows returned.\n";
    }
}

echo "\n===== CUSTOMER AUTH API DEBUG END =====\n";
