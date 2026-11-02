<?php
require_once __DIR__ . '/../upload/system/library/qiqo/sync_diagnostics.php';
require_once __DIR__ . '/../upload/system/library/qiqo/sync_guard.php';

final class QiqoDiagnosticTestConfig
{
    public $values = [];
    public function get($key) { return $this->values[$key] ?? null; }
}
function diagnosticAssert($condition, string $message): void
{
    if (!$condition) throw new RuntimeException($message);
}

$directory = sys_get_temp_dir() . '/italcro-diagnostics-' . bin2hex(random_bytes(6));
$config = new QiqoDiagnosticTestConfig();
$sent = [];
$sender = static function ($email, $subject, $body) use (&$sent) {
    $sent[] = compact('email', 'subject', 'body');
};
$warnings = QiqoSyncGuard::normalizeActionRows([
    ['artikal' => '330470', 'indikator' => 'C', 'cijena' => '4.07'],
    ['artikal' => '330470', 'indikator' => 'C', 'cijena' => '4.06'],
])['warnings'];
$warningResult = ['success' => true, 'warnings' => $warnings];
$success = ['success' => true, 'warnings' => []];
$failure = ['success' => false, 'error' => 'secret transport or SQL exception must not be included'];
try {
    $result = QiqoSyncDiagnostics::observe($directory, 'actions', $warningResult, $config, $sender);
    diagnosticAssert($result['status'] === 'warning' && !$result['notification']['enabled'] && !$sent,
        'Email must be disabled until an explicit recipient is configured.');
    $state = json_decode(file_get_contents($directory . '/alerts-state.json'), true);
    diagnosticAssert($state['tasks']['actions']['status'] === 'warning', 'Warnings must be stored even when mail is disabled.');

    $config->values['qiqo_alert_email'] = 'owner@example.test';
    $result = QiqoSyncDiagnostics::observe($directory, 'actions', $warningResult, $config, $sender);
    diagnosticAssert($result['notification']['sent'] && count($sent) === 1, 'An enabled, previously unsent incident must notify once.');
    diagnosticAssert(strpos($sent[0]['body'], '330470') !== false && strpos($sent[0]['body'], '4.06, 4.07') !== false,
        'Duplicate net alerts must identify the SKU, conflicting prices and selected price.');
    QiqoSyncDiagnostics::observe($directory, 'actions', $warningResult, $config, $sender);
    QiqoSyncDiagnostics::observe($directory, 'partners', $warningResult, $config, $sender);
    diagnosticAssert(count($sent) === 1, 'An unchanged shared action incident must not notify again from either task.');

    $changed = $warningResult;
    $changed['warnings'][0]['prices'] = [4.05, 4.06, 4.07];
    QiqoSyncDiagnostics::observe($directory, 'actions', $changed, $config, $sender);
    diagnosticAssert(count($sent) === 2, 'A changed set of conflicting prices is a meaningful new notification.');
    QiqoSyncDiagnostics::observe($directory, 'actions', $success, $config, $sender);
    QiqoSyncDiagnostics::observe($directory, 'partners', $success, $config, $sender);
    QiqoSyncDiagnostics::observe($directory, 'actions', $warningResult, $config, $sender);
    diagnosticAssert(count($sent) === 3, 'An incident recurring after successful resolution must notify again.');

    $result = QiqoSyncDiagnostics::observe($directory, 'prices', $failure, $config, $sender);
    diagnosticAssert($result['status'] === 'failure' && $result['notification']['sent'] && count($sent) === 4,
        'A synchronization failure must notify with failure status.');
    QiqoSyncDiagnostics::observe($directory, 'prices', $failure, $config, $sender);
    diagnosticAssert(count($sent) === 4, 'A persistent identical failure must not spam the recipient.');
    diagnosticAssert(strpos($sent[3]['body'], 'secret') === false && strpos(file_get_contents($directory . '/alerts-state.json'), 'secret') === false,
        'Raw exception details must never be persisted or emailed by diagnostics.');
    QiqoSyncDiagnostics::observe($directory, 'prices', $success, $config, $sender);
    QiqoSyncDiagnostics::observe($directory, 'prices', $failure, $config, $sender);
    diagnosticAssert(count($sent) === 5, 'A failure after a completed recovery must notify again.');

    $failedSender = static function () { throw new RuntimeException('SMTP password=secret'); };
    $result = QiqoSyncDiagnostics::observe($directory, 'stock', $failure, $config, $failedSender);
    diagnosticAssert(!$result['notification']['sent'] && $result['notification']['error'] === 'mail_failed',
        'Delivery failure must be visible without exposing mail credentials.');
    QiqoSyncDiagnostics::observe($directory, 'stock', $failure, $config, $sender);
    diagnosticAssert(count($sent) === 6, 'A failed delivery must remain pending for retry.');

    $preflight = ['success' => false, 'error' => 'catalog_snapshot_too_small'];
    QiqoSyncDiagnostics::observe($directory, 'catalog', $preflight, $config, $sender);
    $held = ['success' => false, 'error' => 'catalog_cycle_failed', 'maintenance_held' => true];
    QiqoSyncDiagnostics::observe($directory, 'catalog', $held, $config, $sender);
    diagnosticAssert(count($sent) === 8 && strpos($sent[7]['body'], 'načinu održavanja') !== false,
        'A new maintenance-held outage must notify even after an earlier catalog preflight failure.');
    $held['error'] = 'catalog_previous_partial_requires_review';
    QiqoSyncDiagnostics::observe($directory, 'catalog', $held, $config, $sender);
    diagnosticAssert(count($sent) === 8, 'Subsequent unresolved maintenance-held cycles must not resend the same incident.');

    $deferred = [];
    for ($i = 0; $i < 17; $i++) $deferred[] = ['code' => 'deferred_catalog_name', 'article' => (string)(517000 + $i)];
    $catalogWarnings = ['success' => true, 'warnings' => $deferred];
    $result = QiqoSyncDiagnostics::observe($directory, 'catalog', $catalogWarnings, $config, $sender);
    diagnosticAssert($result['status'] === 'warning' && count($sent) === 9,
        'A successful catalog with explicitly deferred unnamed SKUs must send one data-quality warning.');
    foreach ($deferred as $warning) {
        diagnosticAssert(strpos($sent[8]['body'], $warning['article']) !== false,
            'The first deferred-name alert must contain every affected SKU.');
    }
    diagnosticAssert(strpos($sent[8]['body'], 'Dopunite naziv') !== false && strpos($sent[8]['body'], 'neto cijene') === false,
        'Deferred-name alerts must explain the ERP repair action separately from conflicting-price alerts.');
    QiqoSyncDiagnostics::observe($directory, 'catalog', $catalogWarnings, $config, $sender);
    diagnosticAssert(count($sent) === 9, 'The same seventeen deferred SKU warnings must not repeat every cycle.');
    $catalogWarnings['warnings'] = array_slice($deferred, 1);
    QiqoSyncDiagnostics::observe($directory, 'catalog', $catalogWarnings, $config, $sender);
    diagnosticAssert(count($sent) === 9, 'Resolving one deferred SKU must not resend the unchanged remaining warnings.');
    QiqoSyncDiagnostics::observe($directory, 'catalog', ['success' => true, 'warnings' => [$deferred[0]]], $config, $sender);
    diagnosticAssert(count($sent) === 10, 'A previously resolved deferred SKU becoming unnamed again must notify once.');
    QiqoSyncDiagnostics::observe($directory, 'stock', ['success' => true, 'warnings' => $deferred], $config, $sender);
    diagnosticAssert(count($sent) === 10, 'Only catalog outcomes may originate deferred-name incidents.');

    $config->values['qiqo_alert_email'] = "owner@example.test\r\nBcc: other@example.test";
    $result = QiqoSyncDiagnostics::observe($directory, 'discounts', $failure, $config, $sender);
    diagnosticAssert(!$result['notification']['enabled'] && count($sent) === 10, 'Injected recipient headers must be rejected.');

    // Exercise the production OpenCart Mail bootstrap with a fake adaptor and
    // sender. No sockets, SMTP server or actual mail are used by this test.
    $library = $directory . '/system/library';
    mkdir($library . '/mail', 0700, true);
    define('DIR_SYSTEM', $directory . '/system/');
    file_put_contents($library . '/mail/smtp.php', '<?php namespace Mail; class smtp {}');
    file_put_contents($library . '/mail.php', <<<'PHP'
<?php
class Mail {
    public static $messages = [];
    public $data = [];
    public function __construct($engine) {
        if ($engine !== 'smtp' || !class_exists('Mail\\smtp')) throw new RuntimeException('Mail adaptor not loaded.');
    }
    public function setTo($value) { $this->data['to'] = $value; }
    public function setFrom($value) { $this->data['from'] = $value; }
    public function setSender($value) { $this->data['sender'] = $value; }
    public function setSubject($value) { $this->data['subject'] = $value; }
    public function setText($value) { $this->data['text'] = $value; }
    public function send() {
        if ($this->smtp_hostname !== 'smtp.example.test' || $this->smtp_password !== 'safe&test') {
            throw new RuntimeException('Mail configuration was not passed to the adaptor.');
        }
        self::$messages[] = $this->data;
    }
}
PHP
    );
    $config->values = ['qiqo_alert_email' => 'owner@example.test', 'config_email' => 'shop@example.test',
        'config_name' => "Italcro\r\nInjected", 'config_mail_engine' => 'smtp', 'config_mail_smtp_hostname' => 'smtp.example.test',
        'config_mail_smtp_password' => 'safe&amp;test'];
    $result = QiqoSyncDiagnostics::observe($directory, 'catalog', $failure, $config);
    diagnosticAssert($result['notification']['sent'] && count(Mail::$messages) === 1,
        'Standalone workers must load the configured OpenCart Mail adaptor without a frontend autoloader.');
    diagnosticAssert(Mail::$messages[0]['from'] === 'shop@example.test' && strpos(Mail::$messages[0]['sender'], "\n") === false,
        'Store sender settings must be used safely.');
    clearstatcache();
    diagnosticAssert((fileperms($directory . '/alerts-state.json') & 0777) === 0600, 'Diagnostic state must remain private.');
    echo "Structured anomaly warnings, opt-in alerts, delivery failures and incident deduplication passed.\n";
} finally {
    if (is_dir($directory)) {
        $items = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory, FilesystemIterator::SKIP_DOTS), RecursiveIteratorIterator::CHILD_FIRST);
        foreach ($items as $item) {
            if ($item->isDir()) rmdir($item->getPathname()); else unlink($item->getPathname());
        }
    }
    if (is_dir($directory)) rmdir($directory);
}
