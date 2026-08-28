<?php

require_once __DIR__ . '/../upload/system/library/qiqo/sync_guard.php';

function assertSyncGuard($expected, array $fetchResult, array $rows, $message)
{
    $actual = QiqoSyncGuard::canReplaceFullCache($fetchResult, $rows);
    if ($actual !== $expected) {
        throw new RuntimeException($message . ': expected ' . var_export($expected, true) . ', got ' . var_export($actual, true));
    }
}

assertSyncGuard(false, ['success' => false], [], 'Transport/parser error must preserve live cache');
assertSyncGuard(false, ['success' => true, 'empty' => true], [], 'Explicitly empty full feed must preserve live cache');
assertSyncGuard(false, ['success' => false], [['id' => 1]], 'Rows cannot override a failed fetch status');
assertSyncGuard(true, ['success' => true, 'empty' => false], [['id' => 1]], 'Successful non-empty full feed may replace cache');

if (QiqoSyncGuard::hasConfirmedFullSnapshotConfiguration('0', '2020-01-01')) {
    throw new RuntimeException('Destructive full sync must be blocked by its default disabled configuration.');
}
if (QiqoSyncGuard::hasConfirmedFullSnapshotConfiguration('1', '')) {
    throw new RuntimeException('Destructive full sync needs an explicit snapshot inception date.');
}
if (QiqoSyncGuard::hasConfirmedFullSnapshotConfiguration('1', '2026-02-30')) {
    throw new RuntimeException('Destructive full sync must reject an invalid snapshot date.');
}
if (!QiqoSyncGuard::hasConfirmedFullSnapshotConfiguration('1', '2000-01-01')) {
    throw new RuntimeException('An explicitly confirmed full snapshot and valid inception date may pass the configuration gate.');
}

$validAction = QiqoSyncGuard::normalizeActionRows([
    ['artikal' => '300970', 'indikator' => 'P', 'kolicina' => '24', 'cijena' => '', 'rabat' => '25,5'],
    ['artikal' => '300970', 'indikator' => 'X', 'kolicina' => '0', 'cijena' => '0', 'rabat' => '3'],
    // Identical duplicates are harmless and collapse to one staged row.
    ['artikal' => '300970', 'indikator' => 'P', 'kolicina' => '24.0000', 'cijena' => '0', 'rabat' => '25.5000'],
]);
if (!$validAction['valid'] || count($validAction['rows']) !== 2) {
    throw new RuntimeException('Valid C/P/X action rows must normalize before a full swap.');
}
if ($validAction['rows'][1]['indicator'] !== 'X') {
    throw new RuntimeException('X proforma rows must remain in the normalized action feed.');
}

$malformedAction = QiqoSyncGuard::normalizeActionRows([
    ['artikal' => '300970', 'indikator' => 'P', 'kolicina' => '24', 'cijena' => 'not-a-number', 'rabat' => '25'],
]);
if ($malformedAction['valid'] || $malformedAction['invalid_rows'] !== 1) {
    throw new RuntimeException('A malformed action row must reject the complete full feed.');
}

$conflictingAction = QiqoSyncGuard::normalizeActionRows([
    ['artikal' => '300970', 'indikator' => 'P', 'kolicina' => '24', 'rabat' => '25'],
    ['artikal' => '300970', 'indikator' => 'P', 'kolicina' => '24', 'rabat' => '30'],
]);
if ($conflictingAction['valid']) {
    throw new RuntimeException('Conflicting duplicate action keys must reject the complete full feed.');
}

$validArticles = QiqoSyncGuard::normalizeArticleSkuRows([
    ['id' => '300970'],
    ['ID' => '507817'],
    ['id' => '300970'],
]);
if (!$validArticles['valid'] || $validArticles['skus'] !== ['300970', '507817']) {
    throw new RuntimeException('A valid qArtikliWeb snapshot must normalize and deduplicate its SKU set.');
}
if (!QiqoSyncGuard::canDisableMissingArticles(['success' => true], $validArticles)) {
    throw new RuntimeException('A successful, validated, non-empty article snapshot may reconcile product statuses.');
}

$emptyArticles = QiqoSyncGuard::normalizeArticleSkuRows([]);
if (QiqoSyncGuard::canDisableMissingArticles(['success' => true, 'empty' => true], $emptyArticles)) {
    throw new RuntimeException('An empty qArtikliWeb snapshot must never disable local products.');
}
if (QiqoSyncGuard::canDisableMissingArticles(['success' => false, 'error' => 'transport'], $validArticles)) {
    throw new RuntimeException('A failed qArtikliWeb fetch must never disable local products.');
}

$malformedArticles = QiqoSyncGuard::normalizeArticleSkuRows([
    ['id' => '300970'],
    ['unexpected' => '507817'],
]);
if ($malformedArticles['valid'] || $malformedArticles['invalid_rows'] !== 1
    || QiqoSyncGuard::canDisableMissingArticles(['success' => true], $malformedArticles)) {
    throw new RuntimeException('One malformed qArtikliWeb row must reject the complete destructive reconciliation.');
}
if (QiqoSyncGuard::passesArticleSnapshotSanity(799, 1000, 0.8)) {
    throw new RuntimeException('An unexpectedly small article snapshot must fail the destructive reconciliation sanity gate.');
}
if (!QiqoSyncGuard::passesArticleSnapshotSanity(800, 1000, 0.8)) {
    throw new RuntimeException('A snapshot at the configured minimum ratio must pass the final count sanity gate.');
}
if (QiqoSyncGuard::passesArticleSnapshotSanity(1000, 1000, 0.0)) {
    throw new RuntimeException('An invalid article snapshot ratio configuration must fail closed.');
}

$validArticlePrices = QiqoSyncGuard::normalizeArticlePriceRows([
    ['id' => '507817', 'cijena' => '1,06', 'cent' => 'C100'],
    ['id' => '300970', 'cijena' => '12.3456789', 'cent' => ''],
    ['id' => 'ZERO', 'cijena' => '0', 'cent' => ''],
]);
if (!$validArticlePrices['valid'] || abs($validArticlePrices['rows'][0]['price'] - 0.0106) > 0.0000001) {
    throw new RuntimeException('Article prices must normalize C-100 without losing precision.');
}

foreach ([
    [['id' => '507817']],
    [['id' => '507817', 'cijena' => '']],
    [['id' => '507817', 'cijena' => 'not-a-number']],
    [['id' => '507817', 'cijena' => '-1']],
    [['id' => '507817', 'cijena' => '100000000']],
    [['id' => '507817', 'cijena' => '1.06', 'cent' => 'unexpected']],
] as $invalidRows) {
    $invalidArticlePrices = QiqoSyncGuard::normalizeArticlePriceRows($invalidRows);
    if ($invalidArticlePrices['valid']) {
        throw new RuntimeException('Missing, blank or malformed article prices must reject the complete batch.');
    }
}

$identicalArticleDuplicate = QiqoSyncGuard::normalizeArticlePriceRows([
    ['id' => '507817', 'cijena' => '1.06', 'cent' => 'C-100'],
    ['id' => '507817', 'cijena' => '1.06', 'cent' => 'C-100'],
]);
if (!$identicalArticleDuplicate['valid'] || count($identicalArticleDuplicate['rows']) !== 1) {
    throw new RuntimeException('Identical article duplicates must collapse safely.');
}

$conflictingArticleDuplicate = QiqoSyncGuard::normalizeArticlePriceRows([
    ['id' => '507817', 'cijena' => '1.06', 'cent' => 'C-100'],
    ['id' => '507817', 'cijena' => '1.07', 'cent' => 'C-100'],
]);
if ($conflictingArticleDuplicate['valid']) {
    throw new RuntimeException('Conflicting duplicate article rows must reject the complete batch.');
}

$validImportSchema = QiqoSyncGuard::normalizeArticlePriceRows([[
    'id' => '507817', 'cijena' => '1.06', 'cent' => 'C-100', 'kataloggrupa' => '10',
    'gid' => '10', 'partner' => '20', 'barcode' => '123', 'aktivan' => 'true',
    'zaliha' => '5', 'pak' => '1', 'pakkol' => '500', 'sortid' => '1',
]]);
if (!QiqoSyncGuard::validateArticleImportSchema($validImportSchema)) {
    throw new RuntimeException('A complete qArtikliWeb import row must pass schema validation.');
}

$invalidImportSchema = QiqoSyncGuard::normalizeArticlePriceRows([[
    'id' => '507817', 'cijena' => '1.06', 'cent' => 'C-100',
]]);
if (QiqoSyncGuard::validateArticleImportSchema($invalidImportSchema)) {
    throw new RuntimeException('An incomplete qArtikliWeb import row must fail closed before writes.');
}

echo "Qiqo full-sync guard tests passed.\n";
