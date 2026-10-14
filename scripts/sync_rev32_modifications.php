<?php
// Patch only the changed badge condition, preserving installed theme customizations.
if (PHP_SAPI !== 'cli') { http_response_code(404); exit(1); }
if (in_array('--help', $argv, true)) {
    echo "Usage: php scripts/sync_rev32_modifications.php [--apply]\nDefault: read-only check. Refresh OpenCart modifications after applying.\n";
    exit(0);
}
require dirname(__DIR__) . '/upload/config.php';
$old = <<<'CODE'
if (strtotime($result['date_available']) > strtotime('-' . $this->config->get('newlabel_status') . ' day')) {
CODE;
$new = <<<'CODE'
if (!empty($result['qiqo_is_new'])) {
CODE;
try {
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $db = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE, (int)DB_PORT);
    $db->set_charset('utf8mb4');
    $table = DB_PREFIX . 'modification';
    $rows = $db->query("SELECT modification_id,xml FROM `" . $table . "` WHERE code='basel_theme'");
    if ($rows->num_rows !== 1) { throw new RuntimeException('Expected exactly one installed Basel modification.'); }
    $row = $rows->fetch_assoc();
    $oldCount = substr_count($row['xml'], $old);
    $newCount = substr_count($row['xml'], $new);
    if ($oldCount === 0 && $newCount === 1) { echo "Basel ERP date badge condition already applied.\n"; exit(0); }
    if ($oldCount !== 1 || $newCount !== 0) { throw new RuntimeException('Installed badge code differs; review before changing it.'); }
    $xml = str_replace($old, $new, $row['xml']);
    if (simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NONET) === false) {
        throw new RuntimeException('Patched modification XML is invalid.');
    }
    if (!in_array('--apply', $argv, true)) { echo "DRY RUN: one Basel badge condition would change; other installed customizations preserved.\n"; exit(0); }
    $db->query("UPDATE `" . $table . "` SET xml='" . $db->real_escape_string($xml) . "' WHERE modification_id=" . (int)$row['modification_id']
        . " AND SHA2(xml,256)='" . hash('sha256', $row['xml']) . "'");
    if ($db->affected_rows !== 1) { throw new RuntimeException('Modification changed concurrently; no patch applied.'); }
    echo "Applied Basel ERP date badge condition; refresh modifications next.\n";
} catch (Throwable $error) {
    fwrite(STDERR, ($error instanceof mysqli_sql_exception ? 'Modification database operation failed.' : $error->getMessage()) . PHP_EOL);
    exit(1);
}
