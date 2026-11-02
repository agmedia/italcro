<?php
require_once __DIR__ . '/../upload/system/library/qiqo/sync_guard.php';
require_once __DIR__ . '/../upload/system/library/qiqo/pricing_resolver.php';
require_once __DIR__ . '/../upload/system/library/qiqo/sync_diagnostics.php';

function actionDuplicateAssert($condition, string $message): void
{
    if (!$condition) throw new RuntimeException($message);
}
// Actual ERP conflicts observed on 2026-11-02: three SKUs, three duplicate
// P thresholds each. Only price=0 pure percentage rows may use this rule.
$conflicts = [
    '403985' => [0 => [0, 22], 10 => [20, 25], 35 => [25, 30]],
    '403989' => [0 => [0, 22], 10 => [20, 25], 35 => [30, 35]],
    '403990' => [0 => [0, 22], 10 => [20, 25], 35 => [25, 30]],
];
$raw = [];
foreach ($conflicts as $sku => $tiers) {
    foreach ($tiers as $quantity => $rates) {
        foreach ($rates as $discount) $raw[] = ['artikal' => (string)$sku, 'indikator' => 'P',
            'kolicina' => (string)$quantity, 'cijena' => '0', 'rabat' => (string)$discount];
    }
}
$normal = QiqoSyncGuard::normalizeActionRows($raw);
$reversed = QiqoSyncGuard::normalizeActionRows(array_reverse($raw));
actionDuplicateAssert($normal['valid'] && $normal['invalid_rows'] === 0 && count($normal['rows']) === 9
    && count($normal['warnings']) === 9 && $normal['warnings'] === $reversed['warnings'],
    'All nine observed pure P conflicts must normalize with stable warnings in either order.');
foreach ($normal['warnings'] as $warning) {
    actionDuplicateAssert($warning['code'] === 'duplicate_action_percent'
        && $warning['discounts'] === array_map('floatval', $conflicts[$warning['article']][(int)$warning['quantity']])
        && $warning['selected_discount'] === (float)max($warning['discounts']),
        'Each warning must retain every ERP rate and the selected maximum.');
}
foreach ($conflicts as $sku => $tiers) {
    $before = [];
    foreach ($raw as $row) {
        if ($row['artikal'] !== (string)$sku) continue;
        $before[] = ['indicator' => $row['indikator'], 'quantity' => (float)$row['kolicina'],
            'price' => (float)$row['cijena'], 'discount' => (float)$row['rabat']];
    }
    $after = array_values(array_filter($normal['rows'], static function ($row) use ($sku) { return $row['article'] === (string)$sku; }));
    $reverseAfter = array_values(array_filter($reversed['rows'], static function ($row) use ($sku) { return $row['article'] === (string)$sku; }));
    foreach ([0, 1, 9.9999, 10, 34.9999, 35, 100] as $quantity) {
        foreach ([false, true] as $includeAction) {
            $oldPrice = QiqoPricingResolver::resolve(100, 12, 'partner', $before, $quantity, $includeAction, false);
            foreach ([$after, $reverseAfter] as $rows) {
                $newPrice = QiqoPricingResolver::resolve(100, 12, 'partner', $rows, $quantity, $includeAction, false);
                actionDuplicateAssert($newPrice['final_unit_price'] === $oldPrice['final_unit_price']
                    && $newPrice['discount_percent'] === $oldPrice['discount_percent'],
                    'P deduplication must preserve existing cart/catalog pricing at every boundary and source order.');
            }
        }
    }
}
foreach ([
    [['artikal' => 'A', 'indikator' => 'P', 'cijena' => '0', 'rabat' => '20'],
     ['artikal' => 'A', 'indikator' => 'P', 'cijena' => '1', 'rabat' => '25']],
    [['artikal' => 'A', 'indikator' => 'C', 'cijena' => '0', 'rabat' => '20'],
     ['artikal' => 'A', 'indikator' => 'C', 'cijena' => '0', 'rabat' => '25']],
    [['artikal' => 'A', 'indikator' => 'C', 'cijena' => '1', 'rabat' => '0'],
     ['artikal' => 'A', 'indikator' => 'C', 'cijena' => '0', 'rabat' => '0']],
    [['artikal' => 'A', 'indikator' => 'X', 'cijena' => '0', 'rabat' => '3'],
     ['artikal' => 'A', 'indikator' => 'X', 'cijena' => '0', 'rabat' => '5']],
] as $invalid) {
    actionDuplicateAssert(!QiqoSyncGuard::normalizeActionRows($invalid)['valid'],
        'Mixed net/percentage or other indicator conflicts must remain rejected.');
}
$mixedGroup = QiqoSyncGuard::normalizeActionRows([
    ['artikal' => 'A', 'indikator' => 'P', 'cijena' => '0', 'rabat' => '20'],
    ['artikal' => 'A', 'indikator' => 'P', 'cijena' => '0', 'rabat' => '25'],
    ['artikal' => 'A', 'indikator' => 'P', 'cijena' => '1', 'rabat' => '30'],
]);
actionDuplicateAssert(!$mixedGroup['valid'] && !$mixedGroup['warnings'],
    'An invalid mixed-price group must not claim a valid pure-P maximum was selected.');

$directory = sys_get_temp_dir() . '/qiqo-action-duplicate-' . bin2hex(random_bytes(6));
$config = new class { public function get($key) { return $key === 'qiqo_alert_email' ? 'owner@example.test' : null; } };
$messages = [];
$sender = static function ($to, $subject, $body) use (&$messages) { $messages[] = $body; };
try {
    $result = ['success' => true, 'warnings' => $normal['warnings']];
    $observed = QiqoSyncDiagnostics::observe($directory, 'actions', $result, $config, $sender);
    actionDuplicateAssert($observed['status'] === 'warning' && count($messages) === 1,
        'The nine P conflicts must send one warning message through the fake transport.');
    foreach (array_keys($conflicts) as $sku) actionDuplicateAssert(strpos($messages[0], (string)$sku) !== false, 'Each conflicted SKU must be included.');
    actionDuplicateAssert(strpos($messages[0], '0%, 22%') !== false && strpos($messages[0], '20%, 25%') !== false
        && strpos($messages[0], 'količina 35') !== false && strpos($messages[0], 'veći rabat') !== false,
        'The alert must explain the quantity thresholds, conflicting rates and existing maximum-discount rule.');
    QiqoSyncDiagnostics::observe($directory, 'actions', $result, $config, $sender);
    QiqoSyncDiagnostics::observe($directory, 'partners', $result, $config, $sender);
    actionDuplicateAssert(count($messages) === 1, 'Unchanged P conflicts must not repeat across action/partner jobs.');
    $result['warnings'][0]['discounts'][] = 23;
    QiqoSyncDiagnostics::observe($directory, 'actions', $result, $config, $sender);
    actionDuplicateAssert(count($messages) === 2, 'A changed P rate set must produce a meaningful new alert.');
} finally {
    foreach (glob($directory . '/*') ?: [] as $file) unlink($file);
    if (is_dir($directory)) rmdir($directory);
}
echo "Observed nine P conflicts preserve resolver pricing, invalid-conflict guards and deduplicated alerts.\n";
