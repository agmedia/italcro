<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: text/plain; charset=utf-8');

$debugToken = 'komercijalisti-debug';

if (!isset($_GET['token']) || $_GET['token'] !== $debugToken) {
    http_response_code(403);
    echo "Forbidden\n";
    exit;
}

$url      = 'http://195.29.121.190:9988/WebQReaderNew.asmx';
$korisnik = 'AGMedia';
$lozinka  = 'TUde23!$zS';
$datum    = isset($_GET['since']) && trim((string)$_GET['since']) !== ''
    ? date('Y-m-d\TH:i:s', strtotime((string)$_GET['since']))
    : date('Y-m-d\TH:i:s', strtotime('-2 years'));
$method   = 'qKomercijalistWeb';

echo "===== QIQO SALES REPS DEBUG START =====\n";
echo "Method: {$method}\n";
echo "Since: {$datum}\n\n";

$soapAction = "http://www.qiqo.hr/{$method}";
$xml = '<?xml version="1.0" encoding="utf-8"?>
<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
               xmlns:xsd="http://www.w3.org/2001/XMLSchema"
               xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <' . $method . ' xmlns="http://www.qiqo.hr/">
      <korisnik>' . htmlspecialchars($korisnik, ENT_XML1, 'UTF-8') . '</korisnik>
      <lozinka>' . htmlspecialchars($lozinka, ENT_XML1, 'UTF-8') . '</lozinka>
      <datum>' . $datum . '</datum>
    </' . $method . '>
  </soap:Body>
</soap:Envelope>';

$ch = curl_init($url);
curl_setopt_array($ch, [
    CURLOPT_POST           => true,
    CURLOPT_POSTFIELDS     => $xml,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT        => 45,
    CURLOPT_CONNECTTIMEOUT => 10,
    CURLOPT_HTTPHEADER     => [
        'Content-Type: text/xml; charset=utf-8',
        'SOAPAction: "' . $soapAction . '"',
    ],
]);

$response  = curl_exec($ch);
$httpCode  = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curlError = curl_error($ch);
curl_close($ch);

echo "HTTP: {$httpCode}\n";
echo "cURL error: " . ($curlError ?: '-') . "\n";
echo "Response bytes: " . strlen((string)$response) . "\n\n";

if ($response === false || trim((string)$response) === '') {
    echo "No SOAP response.\n";
    echo "===== QIQO SALES REPS DEBUG END =====\n";
    exit;
}

$response = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]/u', '', $response);
$response = preg_replace('/&#x(?:1C|1D|1E|1F|0[0-9A-F]);?/i', '', $response);
$response = preg_replace('/&#(?:28|29|30|31);?/i', '', $response);
$response = str_replace(["\x1F", "\x1E", "\x1D", "\x1C"], '', $response);
$response = mb_convert_encoding($response, 'UTF-8', 'UTF-8');

libxml_use_internal_errors(true);
$xmlResponse = simplexml_load_string($response);

if ($xmlResponse === false) {
    echo "XML parse errors:\n";
    foreach (libxml_get_errors() as $error) {
        echo "- " . trim($error->message) . "\n";
    }
    echo "\nRaw preview:\n" . substr($response, 0, 4000) . "\n";
    echo "===== QIQO SALES REPS DEBUG END =====\n";
    exit;
}

$nsSOAP = 'http://schemas.xmlsoap.org/soap/envelope/';
$nsQIQO = 'http://www.qiqo.hr/';
$nsDIFF = 'urn:schemas-microsoft-com:xml-diffgram-v1';

$body = $xmlResponse->children($nsSOAP)->Body ?? null;
$result = $body ? ($body->children($nsQIQO)->{$method . 'Response'}->{$method . 'Result'} ?? null) : null;

if (!$result) {
    echo "Missing {$method}Result node.\n";
    echo "\nRaw preview:\n" . substr($response, 0, 4000) . "\n";
    echo "===== QIQO SALES REPS DEBUG END =====\n";
    exit;
}

$diffgram = $result->children($nsDIFF)->diffgram ?? null;

if (!$diffgram) {
    foreach ($result->children() as $child) {
        if (stripos($child->getName(), 'diffgram') !== false) {
            $diffgram = $child;
            break;
        }
    }
}

if (!$diffgram) {
    echo "Missing diffgram node.\n";
    echo "\nRaw preview:\n" . substr($response, 0, 4000) . "\n";
    echo "===== QIQO SALES REPS DEBUG END =====\n";
    exit;
}

$newDataSet = $diffgram->NewDataSet ?? $diffgram->children()->NewDataSet ?? null;

if (!$newDataSet) {
    echo "Missing NewDataSet node.\n";
    echo "\nRaw preview:\n" . substr($response, 0, 4000) . "\n";
    echo "===== QIQO SALES REPS DEBUG END =====\n";
    exit;
}

$nodeName = null;
foreach ($newDataSet->children() as $child) {
    $nodeName = $child->getName();
    break;
}

echo "Node: " . ($nodeName ?: '-') . "\n";

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

echo "Rows: " . count($rows) . "\n";

if ($rows) {
    echo "Columns: " . implode(', ', array_keys($rows[0])) . "\n\n";
    echo "First rows:\n";
    foreach (array_slice($rows, 0, 20) as $row) {
        echo json_encode($row, JSON_UNESCAPED_UNICODE) . "\n";
    }
} else {
    echo "No rows parsed.\n";
    echo "\nRaw preview:\n" . substr($response, 0, 4000) . "\n";
}

echo "\n===== QIQO SALES REPS DEBUG END =====\n";
