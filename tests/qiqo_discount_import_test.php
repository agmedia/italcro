<?php
require_once __DIR__ . '/../upload/system/library/qiqo/discount_import.php';

function discountImportAssert($condition, $message) {
    if (!$condition) { throw new RuntimeException($message); }
}

$directory = sys_get_temp_dir() . '/qiqo-discount-reader-' . bin2hex(random_bytes(6));
mkdir($directory, 0700);
$files = [];
$read = static function ($name, $content) use ($directory, &$files) {
    $path = $directory . '/' . $name;
    $files[] = $path;
    if (substr($name, -3) === '.gz') {
        file_put_contents($path, gzencode($content));
    } else { file_put_contents($path, $content); }
    return iterator_to_array(QiqoDiscountImport::rows($path));
};
$reject = static function ($name, $content) use ($read) {
    try { $read($name, $content); } catch (RuntimeException $error) { return; }
    throw new RuntimeException('Invalid export was accepted: ' . $name);
};
try {
    $rows = $read('discounts.csv', "\xEF\xBB\xBFpartner;artikal;rabat\n17;0405054;12,5\n18;405054;0\n");
    discountImportAssert(count($rows) === 2 && $rows[0]['article'] === '0405054', 'CSV must preserve leading-zero article codes.');
    discountImportAssert($rows[0]['discount'] === '12.5000' && $rows[1]['discount'] === '0.0000', 'Article-specific zero rebate is legitimate.');
    $xml = '<?xml version="1.0"?><soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/"><soap:Body><qPartnerArtikalRabatWebResponse xmlns="http://www.qiqo.hr/"><qPartnerArtikalRabatWebResult><diffgr:diffgram xmlns:diffgr="urn:schemas-microsoft-com:xml-diffgram-v1"><NewDataSet xmlns=""><Table><partner>17</partner><artikal>405054</artikal><rabat>25.125</rabat></Table><Table><partner>18</partner><artikal>0405054</artikal><rabat>100</rabat></Table></NewDataSet></diffgr:diffgram></qPartnerArtikalRabatWebResult></qPartnerArtikalRabatWebResponse></soap:Body></soap:Envelope>';
    $rows = $read('discounts.xml.gz', $xml);
    discountImportAssert(count($rows) === 2 && $rows[1]['discount'] === '100.0000', 'Compressed SOAP DiffGram export must stream every row.');
    $reject('truncated.xml', substr($xml, 0, -20));
    $reject('fault.xml', '<Envelope><Fault/><NewDataSet><Table><partner>1</partner><artikal>A</artikal><rabat>2</rabat></Table></NewDataSet></Envelope>');
    $reject('entity.xml', '<!DOCTYPE NewDataSet [<!ENTITY private SYSTEM "file:///etc/passwd">]><NewDataSet><Table><partner>1</partner><artikal>&private;</artikal><rabat>2</rabat></Table></NewDataSet>');
    $reject('missing.csv', "partner,artikal\n1,A\n");
    $reject('blank.csv', "partner,artikal,rabat\n1,A,\n");
    $reject('bad-tail.csv', "partner,artikal,rabat\n1,A,10\n2,B,101\n");
    $reject('unclosed-quote.csv', "partner,artikal,rabat\n1,A,\"10");
    $reject('bad-quote.csv', "partner,artikal,rabat\n1,A,\"10\"0\n");
    $reject('duplicate-header.csv', "partner,artikal,rabat,rabat\n1,A,10,20\n");
    $reject('duplicate-field.xml', '<NewDataSet><Table><partner>1</partner><artikal>A</artikal><rabat>10</rabat><rabat>20</rabat></Table></NewDataSet>');
    $truncatedGzip = $directory . '/truncated.xml.gz';
    $files[] = $truncatedGzip;
    file_put_contents($truncatedGzip, substr(gzencode($xml), 0, -8));
    $rejected = false;
    try { iterator_to_array(QiqoDiscountImport::rows($truncatedGzip)); } catch (RuntimeException $error) { $rejected = true; }
    discountImportAssert($rejected, 'A complete XML inside a truncated gzip file must be rejected.');
    echo "QIQO discount export reader tests passed.\n";
} finally {
    foreach ($files as $path) { unlink($path); }
    rmdir($directory);
}
