<?php

/** Policy for complete catalog reconciliation; never interpret a delta as absence. */
final class QiqoCatalogSync
{
    public static function policy($config, bool $apply, array $options = []): array
    {
        $configuredSince = trim((string)$config->get('qiqo_catalog_snapshot_since'));
        $requestedSince = trim((string)($options['snapshot_since'] ?? $configuredSince));
        $confirmed = QiqoSyncGuard::hasConfirmedFullSnapshotConfiguration(
            $config->get('qiqo_catalog_snapshot_confirmed'), $configuredSince
        );
        $policy = ['confirmed' => $confirmed, 'since' => $requestedSince, 'error' => '',
            'min_ratio' => 0.8, 'max_deactivation_ratio' => 0.2, 'deferred_unnamed_skus' => []];
        if (!QiqoSyncGuard::hasConfirmedFullSnapshotConfiguration(true, $requestedSince)) {
            $policy['error'] = 'catalog_snapshot_date_required';
        } elseif ($apply && (!$confirmed || $requestedSince !== $configuredSince)) {
            $policy['error'] = 'catalog_snapshot_not_confirmed';
        }
        foreach (['min_ratio', 'max_deactivation_ratio'] as $key) {
            $raw = $config->get('qiqo_catalog_snapshot_' . $key);
            if ($raw === null || $raw === '') continue;
            if (!is_numeric($raw) || !is_finite((float)$raw) || (float)$raw <= 0 || (float)$raw > 1) {
                $policy['error'] = 'invalid_catalog_snapshot_policy';
            } else {
                $policy[$key] = (float)$raw;
            }
        }
        $deferred = $config->get('qiqo_catalog_deferred_unnamed_skus');
        if ($deferred !== null && $deferred !== '') {
            $decoded = is_string($deferred) && substr(ltrim($deferred), 0, 1) === '[' ? json_decode($deferred, true) : null;
            if (!is_array($decoded) || array_values($decoded) !== $decoded) {
                $policy['error'] = 'invalid_catalog_deferred_unnamed_skus';
            } else {
                foreach ($decoded as $sku) {
                    if (!is_string($sku) || trim($sku) !== $sku || $sku === '' || strlen($sku) > 64
                        || preg_match('/[\x00-\x1F\x7F]/', $sku)) {
                        $policy['error'] = 'invalid_catalog_deferred_unnamed_skus';
                        break;
                    }
                    $policy['deferred_unnamed_skus'][] = $sku;
                }
                $policy['deferred_unnamed_skus'] = array_values(array_unique($policy['deferred_unnamed_skus']));
            }
        }
        return $policy;
    }

    public static function guard(array $policy, int $snapshotCount, int $localCount,
        int $localActive, int $wouldDisable): string
    {
        if ($snapshotCount <= 0) return 'catalog_snapshot_empty';
        if (!QiqoSyncGuard::passesArticleSnapshotSanity($snapshotCount, $localCount, $policy['min_ratio'])) {
            return 'catalog_snapshot_too_small';
        }
        if ($localActive > 0 && $wouldDisable / $localActive > $policy['max_deactivation_ratio']) {
            return 'catalog_deactivation_limit';
        }
        return '';
    }
}
