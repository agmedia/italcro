<?php
require_once __DIR__ . '/../upload/system/library/qiqo/discount_job.php';

function discountJobAssert($condition, string $message): void {
    if (!$condition) { throw new RuntimeException($message); }
}
function discountJobEnvelope(string $inner): string {
    return '<?xml version="1.0"?><s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/"><s:Body><qPartnerArtikalRabatWebResponse xmlns="http://www.qiqo.hr/"><qPartnerArtikalRabatWebResult><d:diffgram xmlns:d="urn:schemas-microsoft-com:xml-diffgram-v1">' . $inner . '</d:diffgram></qPartnerArtikalRabatWebResult></qPartnerArtikalRabatWebResponse></s:Body></s:Envelope>';
}
function discountJobRow($partner, $article, $discount): string {
    return '<Table><partner>' . $partner . '</partner><artikal>' . $article . '</artikal><rabat>' . $discount . '</rabat></Table>';
}
$directory = sys_get_temp_dir() . '/qiqo-job-test-' . bin2hex(random_bytes(5));
mkdir($directory, 0700);
mkdir($directory . '/upload', 0700);
$xml = $directory . '/response.xml';
$read = static function (string $content, bool $allowEmpty = false) use ($xml): array {
    file_put_contents($xml, $content);
    return iterator_to_array(QiqoDiscountJob::responseRows($xml, $allowEmpty));
};
$reject = static function (string $content, bool $allowEmpty = false) use ($read): void {
    try { $read($content, $allowEmpty); } catch (RuntimeException $error) { return; }
    throw new RuntimeException('An invalid ERP response was accepted.');
};
try {
    $valid = discountJobEnvelope('<NewDataSet xmlns="">' . discountJobRow(103, '0405054', '18') . discountJobRow(104, '405056', '0') . '</NewDataSet>');
    $rows = $read($valid);
    discountJobAssert(count($rows) === 2 && $rows[0]['article'] === '0405054' && $rows[0]['discount'] === '18.0000' && $rows[1]['discount'] === '0.0000', 'Strict reader must preserve SKU, article zero rebate and all rows.');
    $reject(substr($valid, 0, -30));
    $reject(str_replace('qPartnerArtikalRabatWebResponse', 'qPartnerWebResponse', $valid));
    $reject(str_replace('http://www.qiqo.hr/', 'http://wrong.example/', $valid));
    $reject('<NewDataSet>' . discountJobRow(103, 'A', 18) . '</NewDataSet>');
    $reject(str_replace('<s:Body>', '<s:Body><s:Fault><faultstring>PRIVATE ERP MESSAGE</faultstring></s:Fault>', $valid));
    $reject(discountJobEnvelope('<NewDataSet xmlns="">' . discountJobRow(103, 'A', '101') . '</NewDataSet>'));
    $reject(discountJobEnvelope('<NewDataSet xmlns=""><Table><partner>103</partner><artikal>A</artikal><rabat>18</rabat><rabat>19</rabat></Table></NewDataSet>'));
    $reject(discountJobEnvelope('<NewDataSet xmlns=""><Table><partner>103</partner><artikal>A</artikal><rabat><nested>18</nested></rabat></Table></NewDataSet>'));
    $reject(str_replace('<?xml version="1.0"?>', '<?xml version="1.0"?><!DOCTYPE x [<!ENTITY secret SYSTEM "file:///etc/passwd">]>', $valid));
    $reject(discountJobEnvelope(''));
    $reject(discountJobEnvelope('<NewDataSet xmlns=""/>'));
    discountJobAssert($read(discountJobEnvelope(''), true) === [] && $read(discountJobEnvelope('<NewDataSet xmlns=""/>'), true) === [], 'Only a successful structured incremental response may be empty.');
    $reject(discountJobEnvelope('<Other/>'), true);
    $reject(str_replace('<d:diffgram', '<unexpected/><d:diffgram', discountJobEnvelope('')), true);
    $first = QiqoDiscountJob::create($directory, 17);
    $again = QiqoDiscountJob::create($directory, 17);
    discountJobAssert($first['id'] === $again['id'] && $again['existing'] === true, 'Repeated clicks must join one active job.');
    discountJobAssert(QiqoDiscountJob::status($directory, '../../etc/passwd') === null, 'Job IDs must never accept paths.');
    QiqoDiscountJob::fail($directory, $first['id'], 'password=PRIVATE');
    $failed = QiqoDiscountJob::status($directory, $first['id']);
    discountJobAssert($failed['state'] === 'failed' && $failed['error'] === 'sync_failed' && strpos(json_encode($failed), 'PRIVATE') === false, 'Only allowlisted safe errors may reach the UI.');
    $next = QiqoDiscountJob::create($directory, 17);
    discountJobAssert($next['id'] !== $first['id'], 'A failed job must allow a new attempt.');
    // Generate a large fixture on disk; consuming the generator must not retain it in memory.
    $file = fopen($xml, 'wb');
    $wrapper = discountJobEnvelope('REPLACE');
    [$start, $end] = explode('REPLACE', $wrapper);
    fwrite($file, $start . '<NewDataSet xmlns="">');
    for ($i = 0; $i < 60000; ++$i) { fwrite($file, discountJobRow(103, 'SKU' . $i, 18)); }
    fwrite($file, '</NewDataSet>' . $end); fclose($file);
    $before = memory_get_usage(true);
    $count = 0;
    foreach (QiqoDiscountJob::responseRows($xml, false) as $row) { ++$count; }
    discountJobAssert($count === 60000 && memory_get_peak_usage(true) - $before < 12 * 1024 * 1024, 'Large responses must stream through bounded memory.');
    echo "QIQO background job tests passed (SOAP identity, malformed/fault/empty responses, strict fields, singleton jobs, safe status and 60,000 streaming rows).\n";
} finally {
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory, FilesystemIterator::SKIP_DOTS), RecursiveIteratorIterator::CHILD_FIRST);
    foreach ($iterator as $entry) { $entry->isDir() ? rmdir($entry->getPathname()) : unlink($entry->getPathname()); }
    rmdir($directory);
}
