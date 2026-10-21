<?php

require_once __DIR__ . '/discount_import.php';

/** Private, resumable-from-watermark background synchronization; PHP 7.4+. */
final class QiqoDiscountJob
{
    private const MAX_BYTES = 536870912;
    private const SOAP = 'http://schemas.xmlsoap.org/soap/envelope/';
    private const QIQO = 'http://www.qiqo.hr/';
    private const DIFF = 'urn:schemas-microsoft-com:xml-diffgram-v1';

    public static function directory(string $root): string
    {
        $root = realpath($root);
        if (!$root || !is_dir($root . '/upload')) { throw new RuntimeException('Invalid project directory.'); }
        $directory = $root . '/.qiqo-private/discount-jobs';
        if (!is_dir($directory) && !@mkdir($directory, 0700, true) && !is_dir($directory)) {
            throw new RuntimeException('Cannot create private job directory.');
        }
        @chmod(dirname($directory), 0700);
        @chmod($directory, 0700);
        // Also deny HTTP access if a hosting vhost exposes the project directory.
        $deny = dirname($directory) . '/.htaccess';
        if (!is_file($deny)) {
            if (file_put_contents($deny, "<IfModule mod_authz_core.c>\nRequire all denied\n</IfModule>\n<IfModule !mod_authz_core.c>\nDeny from all\n</IfModule>\n", LOCK_EX) === false) {
                throw new RuntimeException('Cannot protect private job directory.');
            }
            @chmod($deny, 0600);
        }
        return $directory;
    }

    public static function create(string $root, int $userId): array
    {
        $directory = self::directory($root);
        $control = fopen($directory . '/control.lock', 'c');
        if (!$control || !flock($control, LOCK_EX)) { throw new RuntimeException('Cannot lock background jobs.'); }
        @chmod($directory . '/control.lock', 0600);
        try {
            $active = @json_decode((string)@file_get_contents($directory . '/active.json'), true);
            if (is_array($active) && isset($active['id'])) {
                $state = self::status($root, (string)$active['id']);
                if ($state && in_array($state['state'], ['queued', 'running'], true)) {
                    $state['existing'] = true;
                    return $state;
                }
            }
            $id = bin2hex(random_bytes(16));
            $state = ['id' => $id, 'user_id' => $userId, 'state' => 'queued', 'phase' => 'queued',
                'message' => 'Uvoz je pripremljen za pokretanje u pozadini.', 'rows' => 0, 'bytes' => 0,
                'created_at' => gmdate('c'), 'updated_at' => gmdate('c'), 'heartbeat' => time()];
            self::write($directory . '/' . $id . '.json', $state);
            self::write($directory . '/active.json', ['id' => $id]);
            return $state;
        } finally { flock($control, LOCK_UN); fclose($control); }
    }

    public static function status(string $root, string $id): ?array
    {
        if (!preg_match('/^[a-f0-9]{32}$/D', $id)) { return null; }
        $path = self::directory($root) . '/' . $id . '.json';
        $state = @json_decode((string)@file_get_contents($path), true);
        if (!is_array($state) || ($state['id'] ?? '') !== $id) { return null; }
        $age = time() - (int)($state['heartbeat'] ?? 0);
        // A killed worker must not leave the admin showing "running" forever.
        $dead = isset($state['pid']) && function_exists('posix_kill') && !@posix_kill((int)$state['pid'], 0);
        if (($state['state'] === 'queued' && $age > 120)
            || ($state['state'] === 'running' && $age > 180 && $dead)) {
            self::fail($root, $id, 'worker_stopped');
            $state = json_decode((string)file_get_contents($path), true);
        }
        return $state;
    }

    public static function fail(string $root, string $id, string $code): void
    {
        if (!preg_match('/^[a-f0-9]{32}$/D', $id)) { return; }
        $path = self::directory($root) . '/' . $id . '.json';
        $state = @json_decode((string)@file_get_contents($path), true);
        if (!$state || !in_array($state['state'], ['queued', 'running'], true)) { return; }
        $state['state'] = 'failed';
        $state['phase'] = 'failed';
        $state['error'] = array_key_exists($code, self::errors()) ? $code : 'sync_failed';
        $state['message'] = self::errors()[$state['error']];
        $state['updated_at'] = gmdate('c');
        $state['heartbeat'] = time();
        self::write($path, $state);
    }

    /** The CLI supplies only an opaque id; configuration is loaded by its bootstrap. */
    public static function run(string $root, string $id): bool
    {
        $state = self::status($root, $id);
        if (!$state || $state['state'] !== 'queued') { return false; }
        $directory = self::directory($root);
        $handle = fopen($directory . '/' . $id . '.lock', 'c');
        if (!$handle || !flock($handle, LOCK_EX | LOCK_NB)) { if ($handle) { fclose($handle); } return false; }
        @chmod($directory . '/' . $id . '.lock', 0600);
        $db = null;
        $locked = false;
        $transaction = false;
        $committed = false;
        $source = $directory . '/' . $id . '.xml';
        $lastUpdate = 0;
        $update = static function (array $changes, bool $force = true) use (&$state, &$lastUpdate, $directory, $id) {
            $state = array_replace($state, $changes);
            if (!$force && microtime(true) - $lastUpdate < 2) { return; }
            $state['updated_at'] = gmdate('c');
            $state['heartbeat'] = time();
            self::write($directory . '/' . $id . '.json', $state);
            $lastUpdate = microtime(true);
        };
        try {
            $update(['state' => 'running', 'pid' => getmypid(), 'phase' => 'connecting', 'message' => 'Provjeravam ERP vezu i prethodno ažuriranje.']);
            foreach (['curl_init', 'mysqli_connect', 'libxml_use_internal_errors'] as $function) {
                if (!function_exists($function)) { throw self::error('runtime_missing'); }
            }
            if (!class_exists('XMLReader')) { throw self::error('runtime_missing'); }
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            $db = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE, (int)DB_PORT);
            $db->set_charset('utf8mb4');
            if (!preg_match('/^[a-zA-Z0-9_]*$/D', DB_PREFIX)) { throw self::error('configuration'); }
            $settingsTable = DB_PREFIX . 'setting';
            $settings = self::settings($db, $settingsTable);
            $zone = new DateTimeZone($settings['config_timezone'] ?? 'Europe/Zagreb');
            date_default_timezone_set($zone->getName());
            $runStartedAt = date('Y-m-d H:i:s');
            $initialSince = $settings['qiqo_partner_article_initial_since'] ?? '';
            if (!self::timestamp($initialSince) || $initialSince > $runStartedAt) { throw self::error('initial_date_missing'); }
            $lockName = $db->real_escape_string(DB_PREFIX . 'qiqo_partner_article_discount_incremental');
            $locked = (int)$db->query("SELECT GET_LOCK('" . $lockName . "',0) n")->fetch_assoc()['n'] === 1;
            if (!$locked) { throw self::error('sync_busy'); }
            $live = DB_PREFIX . 'qiqo_partner_article_discount';
            $sync = DB_PREFIX . 'qiqo_sync_state';
            foreach ([$live, $sync] as $table) {
                $engine = $db->query("SELECT ENGINE FROM information_schema.TABLES WHERE TABLE_SCHEMA=DATABASE() AND TABLE_NAME='" . $db->real_escape_string($table) . "'")->fetch_assoc();
                if (!$engine || strcasecmp($engine['ENGINE'], 'InnoDB') !== 0) { throw self::error('transaction_required'); }
            }
            $watermark = $db->query("SELECT last_sync_at FROM `" . $sync . "` WHERE feed_key='partner_article_discounts'")->fetch_assoc();
            $previousWatermark = $watermark ? $watermark['last_sync_at'] : null;
            $initial = ($settings['qiqo_partner_article_initial_complete'] ?? '') !== '1';
            if (!$initial && (!$previousWatermark || !self::timestamp($previousWatermark) || $previousWatermark > $runStartedAt)) {
                throw self::error('watermark_invalid');
            }
            if ($previousWatermark && $previousWatermark > $runStartedAt) { throw self::error('watermark_invalid'); }
            // Small overlap covers commits on the boundary and repeated runs are idempotent.
            $since = $initial ? $initialSince : max($initialSince, date('Y-m-d H:i:s', strtotime($previousWatermark) - 60));
            $update(['mode' => $initial ? 'initial' : 'incremental', 'since' => $since, 'watermark' => $runStartedAt,
                'phase' => 'downloading', 'message' => 'Preuzimam posebne rabate iz ERP-a. Prozor možete zatvoriti.']);
            self::download($source, $since, static function ($bytes) use ($update) { $update(['bytes' => $bytes], false); },
                static function (array $diagnostics) use ($update) { $update(['transport' => $diagnostics]); });
            $update(['phase' => 'validating', 'message' => 'Provjeravam cijeli ERP odgovor prije izmjene rabata.']);
            $db->query('CREATE TEMPORARY TABLE qiqo_admin_discount_stage LIKE `' . $live . '`');
            $db->query('ALTER TABLE qiqo_admin_discount_stage ADD COLUMN conflict TINYINT NOT NULL DEFAULT 0');
            $batch = [];
            $rows = 0;
            $flush = static function (array $values) use ($db) {
                if ($values) { $db->query('INSERT INTO qiqo_admin_discount_stage (partner_id,article_code,discount,date_added,date_modified) VALUES ' . implode(',', $values)
                    . ' ON DUPLICATE KEY UPDATE conflict=(conflict OR discount<>VALUES(discount))'); }
            };
            foreach (self::responseRows($source, !$initial, static function () use ($update) { $update([], false); }) as $row) {
                ++$rows;
                $batch[] = '(' . $row['partner'] . ",'" . $db->real_escape_string($row['article']) . "','" . $row['discount'] . "',NOW(),NOW())";
                if (count($batch) >= 1000) {
                    $flush($batch); $batch = [];
                    $update(['rows' => $rows, 'phase' => 'staging', 'message' => 'Provjereni rabati pripremaju se za spremanje.'], false);
                }
            }
            $flush($batch);
            $stats = $db->query('SELECT COUNT(*) unique_rows, COALESCE(SUM(conflict),0) conflicts FROM qiqo_admin_discount_stage')->fetch_assoc();
            if ((int)$stats['conflicts'] !== 0) { throw self::error('duplicate_conflict'); }
            if ($initial && $rows === 0) { throw self::error('initial_empty'); }
            $update(['rows' => $rows, 'unique_rows' => (int)$stats['unique_rows'], 'phase' => 'applying',
                'message' => 'Spremam provjerene rabate. Postojeći rabati izvan odgovora ostaju sačuvani.']);
            $db->begin_transaction();
            $transaction = true;
            $currentSettings = self::settings($db, $settingsTable, true);
            $current = $db->query("SELECT last_sync_at FROM `" . $sync . "` WHERE feed_key='partner_article_discounts' FOR UPDATE")->fetch_assoc();
            if (($currentSettings['qiqo_partner_article_initial_since'] ?? '') !== $initialSince
                || ($currentSettings['qiqo_partner_article_initial_complete'] ?? '') !== ($settings['qiqo_partner_article_initial_complete'] ?? '')
                || ($current ? $current['last_sync_at'] : null) !== $previousWatermark) {
                throw self::error('configuration_changed');
            }
            self::backup($db, $live, $directory . '/' . $id . '.backup.jsonl.gz', [
                'job' => $id, 'created_at' => gmdate('c'), 'settings' => $currentSettings,
                'previous_watermark' => $previousWatermark, 'feed' => 'partner_article_discounts'
            ], static function () use ($update) { $update([], false); });
            $update(['backup_available' => true]);
            $db->query('INSERT INTO `' . $live . '` (partner_id,article_code,discount,date_added,date_modified) SELECT partner_id,article_code,discount,NOW(),NOW() FROM qiqo_admin_discount_stage ON DUPLICATE KEY UPDATE discount=VALUES(discount),date_modified=NOW()');
            $db->query("INSERT INTO `" . $sync . "` (feed_key,last_sync_at,date_modified) VALUES ('partner_article_discounts','" . $db->real_escape_string($runStartedAt) . "',NOW()) ON DUPLICATE KEY UPDATE last_sync_at=VALUES(last_sync_at),date_modified=NOW()");
            $db->commit(); $transaction = false; $committed = true;
            // OpenCart setting tables may be MyISAM: readiness is published strictly after commit.
            if ($initial) {
                $db->query("UPDATE `" . $settingsTable . "` completion INNER JOIN `" . $settingsTable . "` baseline ON baseline.store_id=0 AND baseline.`key`='qiqo_partner_article_initial_since' AND baseline.value='" . $db->real_escape_string($initialSince) . "' SET completion.value='1',completion.serialized=0 WHERE completion.store_id=0 AND completion.`key`='qiqo_partner_article_initial_complete'");
                $published = self::settings($db, $settingsTable);
                if (($published['qiqo_partner_article_initial_complete'] ?? '') !== '1' || ($published['qiqo_partner_article_initial_since'] ?? '') !== $initialSince) {
                    throw self::error('completion_unconfirmed');
                }
            }
            $update(['state' => 'complete', 'phase' => 'complete', 'empty' => $rows === 0, 'finished_at' => gmdate('c'),
                'message' => $rows === 0 ? 'Ažuriranje je završeno. ERP nema novih promjena rabata.' : 'Ažuriranje je završeno. Posebni rabati kupaca spremljeni su i koriste se u obračunu cijena.']);
            return true;
        } catch (Throwable $error) {
            if ($transaction && $db) { try { $db->rollback(); } catch (Throwable $ignored) {} }
            $code = $error instanceof QiqoDiscountJobError ? $error->getMessage() : 'sync_failed';
            if ($committed) { $code = 'completion_unconfirmed'; }
            self::fail($root, $id, $code);
            return false;
        } finally {
            if (is_file($source)) { @unlink($source); }
            if ($locked && $db) { try { $db->query("SELECT RELEASE_LOCK('" . $lockName . "')"); } catch (Throwable $ignored) {} }
            if ($db) { $db->close(); }
            flock($handle, LOCK_UN); fclose($handle);
        }
    }

    /** Complete envelope validation precedes the bounded-memory, strict row reader. */
    public static function responseRows(string $path, bool $allowEmpty, ?callable $heartbeat = null): Generator
    {
        $count = self::validateEnvelope($path, $heartbeat);
        if ($count === 0) {
            if (!$allowEmpty) { throw self::error('initial_empty'); }
            return;
        }
        try { yield from QiqoDiscountImport::rows($path); }
        catch (Throwable $error) { throw self::error('invalid_response'); }
    }

    private static function validateEnvelope(string $path, ?callable $heartbeat): int
    {
        $previous = libxml_use_internal_errors(true);
        libxml_clear_errors();
        $reader = new XMLReader();
        $open = $reader->open($path, null, LIBXML_NONET | LIBXML_COMPACT);
        $seen = []; $stack = []; $rows = 0; $schemaDepth = null; $nodes = 0; $rowBytes = 0;
        try {
            if (!$open) { throw self::error('invalid_response'); }
            while ($reader->read()) {
                if ($heartbeat && (++$nodes % 10000) === 0) { $heartbeat(); }
                if (in_array($reader->nodeType, [XMLReader::DOC_TYPE, XMLReader::ENTITY_REF], true)) { throw self::error('invalid_response'); }
                if ($reader->nodeType === XMLReader::ELEMENT && $reader->localName === 'Fault') { throw self::error('erp_fault'); }
                if ($schemaDepth !== null) {
                    if ($reader->nodeType === XMLReader::END_ELEMENT && $reader->depth === $schemaDepth) { $schemaDepth = null; }
                    continue;
                }
                if ($reader->nodeType === XMLReader::ELEMENT) {
                    $depth = $reader->depth;
                    $name = $reader->localName;
                    $namespace = $reader->namespaceURI;
                    $parent = $stack[$depth - 1] ?? '';
                    $valid = false;
                    if ($depth === 0) { $valid = $name === 'Envelope' && $namespace === self::SOAP; }
                    elseif ($depth === 1) { $valid = $name === 'Body' && $namespace === self::SOAP && $parent === 'Envelope'; }
                    elseif ($depth === 2) { $valid = $name === 'qPartnerArtikalRabatWebResponse' && $namespace === self::QIQO && $parent === 'Body'; }
                    elseif ($depth === 3) { $valid = $name === 'qPartnerArtikalRabatWebResult' && $namespace === self::QIQO && $parent === 'qPartnerArtikalRabatWebResponse'; }
                    elseif ($depth === 4 && $name === 'schema' && $namespace === 'http://www.w3.org/2001/XMLSchema') {
                        if (isset($seen['schema'])) { throw self::error('invalid_response'); }
                        $seen['schema'] = true;
                        if (!$reader->isEmptyElement) { $schemaDepth = $depth; }
                        continue;
                    } elseif ($depth === 4) { $valid = $name === 'diffgram' && $namespace === self::DIFF && $parent === 'qPartnerArtikalRabatWebResult'; }
                    elseif ($depth === 5) { $valid = $name === 'NewDataSet' && $namespace === '' && $parent === 'diffgram'; }
                    elseif ($depth === 6) { $valid = $parent === 'NewDataSet' && $namespace === ''; ++$rows; $rowBytes = 0; }
                    elseif ($depth === 7) { $valid = $namespace === ''; }
                    if (!$valid || ($depth <= 5 && isset($seen[$name]))) { throw self::error('invalid_response'); }
                    if ($depth <= 5) { $seen[$name] = true; }
                    $stack[$depth] = $name;
                } elseif (in_array($reader->nodeType, [XMLReader::TEXT, XMLReader::CDATA, XMLReader::SIGNIFICANT_WHITESPACE], true)) {
                    if ($reader->depth < 8 && trim($reader->value) !== '') { throw self::error('invalid_response'); }
                    if ($reader->depth === 8 && ($rowBytes += strlen($reader->value)) > 65536) { throw self::error('invalid_response'); }
                }
            }
            foreach (['Envelope', 'Body', 'qPartnerArtikalRabatWebResponse', 'qPartnerArtikalRabatWebResult', 'diffgram'] as $required) {
                if (!isset($seen[$required])) { throw self::error('invalid_response'); }
            }
            if (libxml_get_errors()) { throw self::error('invalid_response'); }
            return $rows;
        } finally {
            if ($open) { $reader->close(); }
            libxml_clear_errors(); libxml_use_internal_errors($previous);
        }
    }

    private static function download(string $path, string $since, callable $progress, callable $diagnostics): void
    {
        $url = self::config(['QIQO_SOAP_URL', 'QIQO_URL'], 'qiqo.url');
        $username = self::config(['QIQO_USERNAME'], 'qiqo.username');
        $password = self::config(['QIQO_PASSWORD'], 'qiqo.password');
        $scheme = strtolower((string)parse_url($url, PHP_URL_SCHEME));
        $allowHttp = defined('QIQO_ALLOW_INSECURE_HTTP') ? constant('QIQO_ALLOW_INSECURE_HTTP') === 1 : getenv('QIQO_ALLOW_INSECURE_HTTP') === '1';
        if (!filter_var($url, FILTER_VALIDATE_URL) || !in_array($scheme, ['http', 'https'], true)
            || ($scheme === 'http' && !$allowHttp) || parse_url($url, PHP_URL_USER) || parse_url($url, PHP_URL_PASS)) { throw self::error('configuration'); }
        $escape = static function ($value) { return htmlspecialchars($value, ENT_XML1 | ENT_QUOTES, 'UTF-8'); };
        $body = '<?xml version="1.0" encoding="utf-8"?><soap:Envelope xmlns:soap="' . self::SOAP . '"><soap:Body><qPartnerArtikalRabatWeb xmlns="' . self::QIQO . '"><korisnik>' . $escape($username) . '</korisnik><lozinka>' . $escape($password) . '</lozinka><datum>' . $escape(str_replace(' ', 'T', $since)) . '</datum></qPartnerArtikalRabatWeb></soap:Body></soap:Envelope>';
        $file = fopen($path, 'xb');
        if (!$file) { throw self::error('private_storage'); }
        @chmod($path, 0600);
        $bytes = 0; $limit = false; $writeFailed = false;
        $curl = curl_init($url);
        try {
            // Never execute a partially configured request. Setting RETURNTRANSFER
            // after WRITEFUNCTION would also reset PHP's streaming callback.
            self::setCurlOptions($curl, [
                'CURLOPT_WRITEFUNCTION' => [CURLOPT_WRITEFUNCTION, static function ($handle, $chunk) use ($file, &$bytes, &$limit, &$writeFailed) {
                    $length = strlen($chunk);
                    if ($bytes + $length > self::MAX_BYTES) { $limit = true; return 0; }
                    $written = fwrite($file, $chunk);
                    if ($written !== $length) { $writeFailed = true; return 0; }
                    $bytes += $written;
                    return $written;
                }],
                // cPanel's libcurl 7.61 may expose XFERINFOFUNCTION in PHP while
                // rejecting it. The older progress callback has the same data.
                'CURLOPT_PROGRESSFUNCTION' => [CURLOPT_PROGRESSFUNCTION, static function ($handle, $total, $downloaded, $uploadTotal, $uploaded) use ($progress, &$bytes) { $progress($bytes); return 0; }],
                'CURLOPT_NOPROGRESS' => [CURLOPT_NOPROGRESS, false],
                'CURLOPT_POST' => [CURLOPT_POST, true],
                'CURLOPT_POSTFIELDS' => [CURLOPT_POSTFIELDS, $body],
                'CURLOPT_CONNECTTIMEOUT' => [CURLOPT_CONNECTTIMEOUT, 15],
                'CURLOPT_TIMEOUT' => [CURLOPT_TIMEOUT, 1200],
                'CURLOPT_LOW_SPEED_LIMIT' => [CURLOPT_LOW_SPEED_LIMIT, 256],
                'CURLOPT_LOW_SPEED_TIME' => [CURLOPT_LOW_SPEED_TIME, 120],
                'CURLOPT_FOLLOWLOCATION' => [CURLOPT_FOLLOWLOCATION, false],
                'CURLOPT_MAXREDIRS' => [CURLOPT_MAXREDIRS, 0],
                'CURLOPT_PROTOCOLS' => [CURLOPT_PROTOCOLS, CURLPROTO_HTTP | CURLPROTO_HTTPS],
                'CURLOPT_HTTPHEADER' => [CURLOPT_HTTPHEADER, ['Content-Type: text/xml; charset=utf-8', 'SOAPAction: "' . self::QIQO . 'qPartnerArtikalRabatWeb"']]
            ], $diagnostics);
            $ok = curl_exec($curl);
            $status = (int)curl_getinfo($curl, CURLINFO_HTTP_CODE);
            // Only numeric transport facts are persisted. Raw cURL messages may
            // contain URLs, account details or snippets of an upstream response.
            $diagnostics([
                'curl_errno' => curl_errno($curl),
                'http_status' => $status,
                'total_seconds' => round((float)curl_getinfo($curl, CURLINFO_TOTAL_TIME), 3),
                'name_lookup_seconds' => round((float)curl_getinfo($curl, CURLINFO_NAMELOOKUP_TIME), 3),
                'connect_seconds' => round((float)curl_getinfo($curl, CURLINFO_CONNECT_TIME), 3),
                'start_transfer_seconds' => round((float)curl_getinfo($curl, CURLINFO_STARTTRANSFER_TIME), 3),
                'downloaded_bytes' => $bytes
            ]);
            if ($limit) { throw self::error('response_limit'); }
            if ($writeFailed) { throw self::error('private_storage'); }
            if ($ok === false || $status < 200 || $status >= 300 || $bytes === 0) { throw self::error('transport_error'); }
            if (!fflush($file)) { throw self::error('private_storage'); }
            $progress($bytes);
        } finally { curl_close($curl); fclose($file); }
    }

    private static function setCurlOptions($curl, array $options, callable $diagnostics, ?callable $setter = null): void
    {
        $setter = $setter ?: static function ($handle, $option, $value) { return @curl_setopt($handle, $option, $value); };
        foreach ($options as $name => $option) {
            $ok = false;
            try { $ok = $setter($curl, $option[0], $option[1]); } catch (Throwable $ignored) {}
            if ($ok !== true) {
                $diagnostics(['setup_failed_option' => $name]);
                throw self::error('transport_configuration');
            }
        }
    }

    private static function config(array $names, string $key): string
    {
        foreach ($names as $name) {
            $value = defined($name) ? constant($name) : null;
            if (is_string($value) && trim($value) !== '') { return trim($value); }
            $value = getenv($name);
            if (is_string($value) && trim($value) !== '') { return trim($value); }
        }
        if (function_exists('agconf') && defined('OC_ENV')) {
            $value = agconf($key);
            if (is_string($value) && trim($value) !== '' && $value !== 'Env key not found!') { return trim($value); }
        }
        throw self::error('configuration');
    }

    /** An unbuffered pre-change backup remains private and never contains ERP credentials. */
    private static function backup(mysqli $db, string $live, string $path, array $metadata, callable $heartbeat): void
    {
        $temporary = tempnam(dirname($path), 'backup-');
        if (!$temporary) { throw self::error('private_storage'); }
        @chmod($temporary, 0600);
        $gzip = gzopen($temporary, 'wb6');
        $result = null;
        $closed = false;
        try {
            if (!$gzip) { throw self::error('private_storage'); }
            $write = static function (array $value) use ($gzip) {
                $line = json_encode($value, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . "\n";
                if (gzwrite($gzip, $line) !== strlen($line)) { throw self::error('private_storage'); }
            };
            $write(['type' => 'metadata', 'data' => $metadata]);
            $result = $db->query('SELECT partner_id,article_code,discount,date_added,date_modified FROM `' . $live . '`', MYSQLI_USE_RESULT);
            $rows = 0;
            while ($row = $result->fetch_assoc()) {
                $write(['type' => 'discount', 'data' => $row]);
                if ((++$rows % 1000) === 0) { $heartbeat(); }
            }
            $result->free(); $result = null;
            $write(['type' => 'complete', 'rows' => $rows]);
            if (!gzclose($gzip)) { $closed = true; throw self::error('private_storage'); }
            $closed = true;
            if (!rename($temporary, $path)) { throw self::error('private_storage'); }
        } finally {
            if ($result) { $result->free(); }
            if ($gzip && !$closed) { gzclose($gzip); }
            if (is_file($temporary)) { @unlink($temporary); }
        }
    }

    private static function settings(mysqli $db, string $table, bool $lock = false): array
    {
        $result = $db->query('SELECT `key`,value FROM `' . $table . "` WHERE store_id=0 AND `key` IN ('config_timezone','qiqo_partner_article_initial_since','qiqo_partner_article_initial_complete')" . ($lock ? ' FOR UPDATE' : ''));
        $settings = [];
        while ($row = $result->fetch_assoc()) {
            if (isset($settings[$row['key']])) { throw self::error('configuration'); }
            $settings[$row['key']] = $row['value'];
        }
        if (!isset($settings['qiqo_partner_article_initial_complete'])) { throw self::error('configuration'); }
        return $settings;
    }

    private static function timestamp(string $value): bool
    {
        $date = DateTime::createFromFormat('!Y-m-d H:i:s', $value);
        return $date && $date->format('Y-m-d H:i:s') === $value;
    }

    private static function write(string $path, array $value): void
    {
        $temporary = $path . '.' . bin2hex(random_bytes(6)) . '.tmp';
        if (file_put_contents($temporary, json_encode($value, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), LOCK_EX) === false) {
            throw new RuntimeException('Cannot persist background job status.');
        }
        @chmod($temporary, 0600);
        if (!@rename($temporary, $path)) { @unlink($temporary); throw new RuntimeException('Cannot publish background job status.'); }
    }

    private static function error(string $code): QiqoDiscountJobError { return new QiqoDiscountJobError($code); }

    private static function errors(): array
    {
        return [
            'sync_failed' => 'Ažuriranje nije uspjelo. Postojeći rabati su sačuvani. Pokušajte ponovno ili kontaktirajte održavanje.',
            'worker_stopped' => 'Pozadinsko ažuriranje je prekinuto. Pokrenite ga ponovno; zadnje potvrđeno ažuriranje ostaje sačuvano.',
            'launch_failed' => 'Server nije pokrenuo pozadinsko ažuriranje. Održavanje treba provjeriti PHP CLI i dozvole.',
            'runtime_missing' => 'Serveru nedostaje PHP podrška potrebna za siguran pozadinski uvoz.',
            'configuration' => 'ERP veza nije ispravno postavljena. Održavanje treba provjeriti privatnu konfiguraciju.',
            'initial_date_missing' => 'Nedostaje potvrđen početni datum ERP rabata. Održavanje treba postaviti početak uvoza.',
            'sync_busy' => 'Drugo ažuriranje rabata već je pokrenuto. Pričekajte završetak pa pokušajte ponovno.',
            'transaction_required' => 'Tablice rabata moraju podržavati sigurno spremanje s povratom u slučaju greške.',
            'watermark_invalid' => 'Datum zadnjeg ažuriranja rabata nije valjan. Održavanje treba provjeriti stanje sinkronizacije.',
            'transport_error' => 'ERP nije vratio potpun i uspješan odgovor. Rabati nisu promijenjeni. Pokušajte ponovno.',
            'transport_configuration' => 'Server nije prihvatio postavke ERP veze. Rabati nisu promijenjeni; održavanje treba provjeriti cURL podršku.',
            'response_limit' => 'ERP odgovor premašuje dopuštenu veličinu. Rabati nisu promijenjeni; kontaktirajte održavanje.',
            'private_storage' => 'Nema dovoljno privatnog prostora za ERP odgovor. Rabati nisu promijenjeni.',
            'invalid_response' => 'ERP odgovor je nepotpun ili sadrži neispravan rabat. Rabati nisu promijenjeni.',
            'erp_fault' => 'ERP je prijavio grešku. Rabati nisu promijenjeni. Pokušajte ponovno ili kontaktirajte održavanje.',
            'initial_empty' => 'ERP je za početni uvoz vratio prazan skup rabata. Uvoz nije potvrđen; postojeći rabati su sačuvani.',
            'duplicate_conflict' => 'ERP je vratio različite rabate za isti par kupac–artikl. Rabati nisu promijenjeni.',
            'configuration_changed' => 'Postavke ili datum sinkronizacije promijenjeni su tijekom uvoza. Pokrenite ažuriranje ponovno.',
            'completion_unconfirmed' => 'Rabati su spremljeni, ali završetak nije potvrđen. Održavanje treba provjeriti stanje prije sljedećeg uvoza.'
        ];
    }
}

final class QiqoDiscountJobError extends RuntimeException {}
