<?php
$url = 'http://195.29.121.190:9988/WebQReaderNew.asmx';

$options = [
    'http' => [
        'method'  => 'GET',
        'header'  => "User-Agent: PHP\r\nAccept: */*\r\n"
        // If you need auth: "Authorization: Basic " . base64_encode("user:pass") . "\r\n"
    ]
];
$context = stream_context_create($options);

$result = @file_get_contents($url, false, $context);

if ($result === false) {
    $err = error_get_last();
    echo "Request failed: " . ($err['message'] ?? 'unknown error');
    exit(1);
}

// If the endpoint returns XML, pretty-print:
if (strpos($http_response_header[0] ?? '', '200') !== false) {
    $dom = new DOMDocument;
    $dom->preserveWhiteSpace = false;
    $dom->formatOutput = true;
    if ($dom->loadXML($result)) {
        echo $dom->saveXML();
    } else {
        echo $result; // not XML — just raw output
    }
} else {
    echo "HTTP response: " . ($http_response_header[0] ?? 'unknown');
    echo "\n\nBody:\n" . $result;
}