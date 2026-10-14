<?php

if (PHP_SAPI !== 'cli') { http_response_code(404); exit(1); }
require dirname(__DIR__) . '/upload/config.php';
require_once DIR_SYSTEM . 'library/qiqo/discount_import.php';

$options = getopt('', ['source:', 'expected-count:', 'sha256:', 'since:', 'watermark:', 'apply', 'help']);
if (isset($options['help']) || !isset($options['source'], $options['expected-count'], $options['sha256'], $options['since'], $options['watermark'])) {
    echo "Usage: php scripts/import_qiqo_partner_discounts.php --source=/private/export.xml.gz --expected-count=N --sha256=ERP_MANIFEST_HASH --since='YYYY-MM-DD HH:MM:SS' --watermark='YYYY-MM-DD HH:MM:SS' [--apply]\n";
    echo "Default: validate the complete export in a temporary staging table; no live discounts or settings change.\n";
    exit(isset($options['help']) ? 0 : 2);
}

function discountImportTimestamp($value) {
    $date = DateTime::createFromFormat('!Y-m-d H:i:s', (string)$value);
    return $date && $date->format('Y-m-d H:i:s') === $value;
}

$db = null;
$locked = false;
$transaction = false;
$committed = false;
try {
    if (!preg_match('/^[1-9][0-9]*$/D', $options['expected-count']) || !preg_match('/^[a-f0-9]{64}$/iD', $options['sha256'])
        || !discountImportTimestamp($options['since']) || !discountImportTimestamp($options['watermark'])
        || $options['since'] > $options['watermark']) {
        throw new RuntimeException('Expected count and export time interval must be explicit and valid.');
    }
    $source = realpath($options['source']);
    if (!$source || !is_file($source) || !is_readable($source)) {
        throw new RuntimeException('ERP export is not readable.');
    }
    $checksum = hash_file('sha256', $source);
    if (!hash_equals(strtolower($options['sha256']), $checksum)) {
        throw new RuntimeException('Export checksum does not match the ERP manifest.');
    }
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $db = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE, (int)DB_PORT);
    $db->set_charset('utf8mb4');
    $settingTable = DB_PREFIX . 'setting';
    $timezone = $db->query("SELECT value FROM `" . $settingTable . "` WHERE store_id=0 AND `key`='config_timezone'")->fetch_assoc();
    if ($timezone && $timezone['value'] !== '') {
        $zone = new DateTimeZone($timezone['value']);
        date_default_timezone_set($zone->getName());
    }
    if (strtotime($options['watermark']) > time() + 300) {
        throw new RuntimeException('Export watermark cannot be in the future.');
    }
    $liveTable = DB_PREFIX . 'qiqo_partner_article_discount';
    $stateTable = DB_PREFIX . 'qiqo_sync_state';
    $lock = $db->real_escape_string(DB_PREFIX . 'qiqo_partner_article_discount_incremental');
    $locked = (int)$db->query("SELECT GET_LOCK('" . $lock . "',0) n")->fetch_assoc()['n'] === 1;
    if (!$locked) { throw new RuntimeException('Another discount import or sync is running.'); }
    $initialRows = $db->query("SELECT value FROM `" . $settingTable . "` WHERE store_id=0 AND `key`='qiqo_partner_article_initial_since'");
    $initial = $initialRows->fetch_assoc();
    if ($initialRows->num_rows !== 1 || !$initial || $initial['value'] !== $options['since']) {
        throw new RuntimeException('Export start must match the configured initial import date.');
    }
    foreach ([$liveTable, $stateTable] as $table) {
        $engine = $db->query("SELECT ENGINE FROM information_schema.TABLES WHERE TABLE_SCHEMA=DATABASE() AND TABLE_NAME='" . $db->real_escape_string($table) . "'")->fetch_assoc();
        if (!$engine || strcasecmp($engine['ENGINE'], 'InnoDB') !== 0) {
            throw new RuntimeException('Discounts and sync state must support transactional rollback.');
        }
    }
    $state = $db->query("SELECT last_sync_at FROM `" . $stateTable . "` WHERE feed_key='partner_article_discounts'")->fetch_assoc();
    if ($state && $state['last_sync_at'] > $options['watermark']) {
        throw new RuntimeException('Export predates the current discount watermark; newer data must be preserved.');
    }
    $db->query("CREATE TEMPORARY TABLE qiqo_discount_import_stage LIKE `" . $liveTable . "`");
    $db->query('ALTER TABLE qiqo_discount_import_stage ADD COLUMN conflict TINYINT NOT NULL DEFAULT 0');
    $flush = static function (array $batch) use ($db) {
        if ($batch) {
            $db->query('INSERT INTO qiqo_discount_import_stage (partner_id,article_code,discount,date_added,date_modified) VALUES ' . implode(',', $batch)
                . ' ON DUPLICATE KEY UPDATE conflict=(conflict OR discount<>VALUES(discount))');
        }
    };
    $rows = 0;
    $batch = [];
    foreach (QiqoDiscountImport::rows($source) as $row) {
        ++$rows;
        $batch[] = '(' . $row['partner'] . ",'" . $db->real_escape_string($row['article']) . "','" . $row['discount'] . "',NOW(),NOW())";
        if (count($batch) >= 1000) { $flush($batch); $batch = []; }
    }
    $flush($batch);
    $stats = $db->query('SELECT COUNT(*) unique_rows, COALESCE(SUM(conflict),0) conflicts FROM qiqo_discount_import_stage')->fetch_assoc();
    if ($rows !== (int)$options['expected-count'] || (int)$stats['conflicts'] !== 0 || !hash_equals($checksum, hash_file('sha256', $source))) {
        throw new RuntimeException('Export count, duplicate validation or checksum failed; live data preserved.');
    }
    echo 'Validated rows=' . $rows . ' unique=' . $stats['unique_rows'] . ' sha256=' . $checksum . PHP_EOL;
    if (!isset($options['apply'])) {
        echo "DRY RUN: live discounts, initial-complete flag and watermark preserved.\n";
        exit(0);
    }
    $db->begin_transaction();
    $transaction = true;
    $initialRows = $db->query("SELECT value FROM `" . $settingTable . "` WHERE store_id=0 AND `key`='qiqo_partner_article_initial_since' FOR UPDATE");
    $initial = $initialRows->fetch_assoc();
    $current = $db->query("SELECT last_sync_at FROM `" . $stateTable . "` WHERE feed_key='partner_article_discounts' FOR UPDATE")->fetch_assoc();
    if ($initialRows->num_rows !== 1 || !$initial || $initial['value'] !== $options['since']
        || ($current && $current['last_sync_at'] > $options['watermark'])) {
        throw new RuntimeException('Import configuration or watermark changed during staging; live data preserved.');
    }
    $db->query("INSERT INTO `" . $liveTable . "` (partner_id,article_code,discount,date_added,date_modified) SELECT partner_id,article_code,discount,NOW(),NOW() FROM qiqo_discount_import_stage ON DUPLICATE KEY UPDATE discount=VALUES(discount),date_modified=NOW()");
    $watermark = $db->real_escape_string($options['watermark']);
    $db->query("INSERT INTO `" . $stateTable . "` (feed_key,last_sync_at,date_modified) VALUES ('partner_article_discounts','" . $watermark . "',NOW()) ON DUPLICATE KEY UPDATE last_sync_at=VALUES(last_sync_at),date_modified=NOW()");
    $flag = $db->query("SELECT setting_id FROM `" . $settingTable . "` WHERE store_id=0 AND `key`='qiqo_partner_article_initial_complete'");
    if ($flag->num_rows !== 1) { throw new RuntimeException('Initial import completion setting must exist exactly once.'); }
    $db->commit();
    $transaction = false;
    $committed = true;
    // Legacy settings may be MyISAM. Publish readiness only after the cache
    // and watermark commit; a crash before this leaves the browser gate closed.
    $since = $db->real_escape_string($options['since']);
    $db->query("UPDATE `" . $settingTable . "` completion INNER JOIN `" . $settingTable . "` initial ON initial.store_id=0 AND initial.`key`='qiqo_partner_article_initial_since' AND initial.value='" . $since . "' SET completion.value='1',completion.serialized=0 WHERE completion.store_id=0 AND completion.`key`='qiqo_partner_article_initial_complete'");
    $ready = $db->query("SELECT value FROM `" . $settingTable . "` WHERE store_id=0 AND `key`='qiqo_partner_article_initial_complete'")->fetch_assoc();
    $initial = $db->query("SELECT value FROM `" . $settingTable . "` WHERE store_id=0 AND `key`='qiqo_partner_article_initial_since'")->fetch_assoc();
    if (!$ready || $ready['value'] !== '1' || !$initial || $initial['value'] !== $options['since']) {
        throw new RuntimeException('Cache committed, but completion flag could not be confirmed; review import settings.');
    }
    echo 'APPLIED: verified export upserted; no existing discounts deleted; watermark=' . $options['watermark'] . PHP_EOL;
} catch (Throwable $error) {
    if ($transaction && $db) { $db->rollback(); }
    // Database/transport exception messages can contain private rows or configuration.
    fwrite(STDERR, ($error instanceof mysqli_sql_exception
        ? ($committed ? 'Cache committed; completion flag not confirmed. Review settings before incremental sync.' : 'Database import failed; live transaction rolled back.')
        : $error->getMessage()) . PHP_EOL);
    exit(1);
} finally {
    if ($locked && $db) { $db->query("SELECT RELEASE_LOCK('" . $lock . "')"); }
    if ($db) { $db->close(); }
}
