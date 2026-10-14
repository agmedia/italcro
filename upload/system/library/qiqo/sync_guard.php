<?php

final class QiqoSyncGuard
{
    /**
     * Destructive replacements are opt-in only after the ERP owner confirms
     * that the configured call returns a complete snapshot (not a delta).
     */
    public static function hasConfirmedFullSnapshotConfiguration($confirmed, string $since): bool
    {
        $confirmed = $confirmed === true || in_array(strtolower(trim((string)$confirmed)), ['1', 'true', 'yes'], true);
        if (!$confirmed || preg_match('/^(\d{4})-(\d{2})-(\d{2})$/', trim($since), $parts) !== 1) {
            return false;
        }

        return checkdate((int)$parts[2], (int)$parts[3], (int)$parts[1]);
    }

    /**
     * A destructive full-cache replacement is allowed only when transport and
     * parsing succeeded and the feed contains at least one row. An intentional
     * clear must be implemented as a separate, explicit administrative action.
     */
    public static function canReplaceFullCache(array $fetchResult, array $rows): bool
    {
        return !empty($fetchResult['success']) && count($rows) > 0;
    }

    /**
     * Validate and normalize the complete qAkcijskiCjenikWeb response before
     * any live-table write. Blank numeric cells are legitimate zeroes in the
     * ERP feed; malformed, out-of-range or conflicting duplicate rows reject
     * the entire batch.
     *
     * @return array{valid:bool,rows:array<int,array<string,mixed>>,invalid_rows:int}
     */
    public static function normalizeActionRows(array $rows): array
    {
        $normalized = [];
        $invalidRows = 0;

        foreach ($rows as $row) {
            if (!is_array($row)) {
                $invalidRows++;
                continue;
            }

            $article = self::firstValue($row, ['artikal', 'article_code', 'artikl', 'sifra', 'sifra_artikla', 'code']);
            $indicator = strtoupper(self::firstValue($row, ['indikator', 'indicator', 'oznaka', 'tip']));
            $quantityRaw = self::firstValue($row, ['kolicina', 'quantity', 'qty', 'kol'], true);
            $priceRaw = self::firstValue($row, ['cijena', 'price', 'neto_cijena', 'net_price'], true);
            $discountRaw = self::firstValue($row, ['rabat', 'discount', 'popust'], true);

            $quantity = self::parseDecimal($quantityRaw);
            $price = self::parseDecimal($priceRaw);
            $discount = self::parseDecimal($discountRaw);

            if ($article === '' || strlen($article) > 64 || !in_array($indicator, ['C', 'P', 'X'], true)
                || $quantity === null || $price === null || $discount === null
                || $quantity < 0 || $quantity > 99999999999.9999
                || $price < 0 || $price > 99999999.9999999
                || $discount < 0 || $discount > 100) {
                $invalidRows++;
                continue;
            }

            $item = [
                'article' => $article,
                'indicator' => $indicator,
                'quantity' => round($quantity, 4),
                'price' => round($price, 7),
                'discount' => round($discount, 4),
            ];
            $key = $article . '|' . $indicator . '|' . number_format($item['quantity'], 4, '.', '');

            if (isset($normalized[$key])) {
                $existing = $normalized[$key];
                if (abs($existing['price'] - $item['price']) > 0.0000001
                    || abs($existing['discount'] - $item['discount']) > 0.0001) {
                    $invalidRows++;
                }
                continue;
            }

            $normalized[$key] = $item;
        }

        return [
            'valid' => $invalidRows === 0,
            'rows' => array_values($normalized),
            'invalid_rows' => $invalidRows,
        ];
    }

    /**
     * Validate the complete qArtikliWeb snapshot before it may be used to
     * disable local products. A missing/malformed row rejects the whole
     * snapshot: silently skipping it could make a valid local SKU appear
     * absent and would turn a parser/schema change into a mass-disable.
     *
     * Identical duplicate article rows are harmless and collapse to one SKU.
     *
     * @return array{valid:bool,skus:array<int,string>,invalid_rows:int}
     */
    public static function normalizeArticleSkuRows(array $rows): array
    {
        $skus = [];
        $invalidRows = 0;

        foreach ($rows as $row) {
            if (!is_array($row)) {
                $invalidRows++;
                continue;
            }

            $sku = self::firstValue($row, ['id', 'artikal', 'article_code', 'artikl', 'sifra', 'sifra_artikla', 'code']);

            if ($sku === '' || strlen($sku) > 64 || preg_match('/[\x00-\x1F\x7F]/', $sku)) {
                $invalidRows++;
                continue;
            }

            $skus['sku:' . $sku] = $sku;
        }

        return [
            'valid' => $invalidRows === 0,
            'skus' => array_values($skus),
            'invalid_rows' => $invalidRows,
        ];
    }

    /**
     * Normalize qArtikliWeb prices without ever coercing a missing/blank/
     * malformed cijena cell to zero. One bad row rejects the complete manual
     * import/update batch so a schema drift cannot partially corrupt prices.
     *
     * @return array{valid:bool,rows:array<int,array<string,mixed>>,invalid_rows:int}
     */
    public static function normalizeArticlePriceRows(array $rows): array
    {
        $normalized = [];
        $invalidRows = 0;

        foreach ($rows as $row) {
            if (!is_array($row)) {
                $invalidRows++;
                continue;
            }

            $sku = self::firstValue($row, ['id', 'artikal', 'article_code', 'artikl', 'sifra', 'sifra_artikla', 'code']);
            $priceRaw = self::firstValue($row, ['cijena', 'price', 'vpc'], true);
            $price = trim($priceRaw) === '' ? null : self::parseDecimal($priceRaw);
            $centRaw = strtoupper(self::firstValue($row, ['cent']));
            $centNormalized = (string)preg_replace('/[^A-Z0-9]/', '', $centRaw);
            $cent = $centNormalized === 'C100' ? 'C-100' : '';

            if ($sku === '' || strlen($sku) > 64 || preg_match('/[\x00-\x1F\x7F]/', $sku)
                || $price === null || $price < 0 || $price > 99999999.9999999) {
                $invalidRows++;
                continue;
            }

            if ($centRaw !== '' && $centNormalized !== 'C100') {
                $invalidRows++;
                continue;
            }

            $item = [
                'sku' => $sku,
                'vpc' => round($price, 7),
                'price' => round($cent === 'C-100' ? $price / 100 : $price, 7),
                'cent' => $cent,
                'source' => $row,
            ];

            if (isset($normalized[$sku])) {
                $existing = $normalized[$sku];
                if (abs($existing['vpc'] - $item['vpc']) > 0.0000001 || $existing['cent'] !== $item['cent']) {
                    $invalidRows++;
                } elseif ($existing['source'] != $item['source']) {
                    // A duplicate SKU with different source columns is not a
                    // harmless duplicate for manual product creation.
                    $invalidRows++;
                }
                continue;
            }

            $normalized[$sku] = $item;
        }

        return [
            'valid' => $invalidRows === 0,
            'rows' => array_values($normalized),
            'invalid_rows' => $invalidRows,
        ];
    }

    /**
     * Manual creation additionally needs the legacy fields dereferenced by
     * importArticles(). Missing keys or malformed numeric cells reject the
     * whole batch before categories/products are written.
     */
    public static function validateArticleImportSchema(array $normalized): bool
    {
        if (empty($normalized['valid'])) {
            return false;
        }

        foreach ($normalized['rows'] as $item) {
            $row = isset($item['source']) && is_array($item['source']) ? $item['source'] : [];
            foreach (['id', 'kataloggrupa', 'gid', 'partner', 'barcode', 'aktivan', 'zaliha', 'pak', 'pakkol', 'sortid'] as $key) {
                if (!array_key_exists($key, $row)) {
                    return false;
                }
            }

            foreach (['gid', 'partner', 'zaliha', 'pak', 'pakkol', 'sortid'] as $key) {
                if (self::parseDecimal(trim((string)$row[$key])) === null) {
                    return false;
                }
            }

            if (!in_array(strtolower(trim((string)$row['aktivan'])), ['0', '1', 'false', 'true'], true)) {
                return false;
            }
        }

        return true;
    }

    /**
     * A repeated catalog import owns the ERP fields below, but never infers
     * deletions from absent rows. Validate the complete response before any
     * product is changed, including the fields used by the stock-only button.
     */
    public static function normalizeArticleStockRows(array $rows): array
    {
        $normalized = [];
        $invalidRows = 0;
        foreach ($rows as $source) {
            if (!is_array($source)) {
                $invalidRows++;
                continue;
            }
            $row = array_change_key_case($source, CASE_LOWER);
            $sku = trim((string)($row['id'] ?? ''));
            $required = ['zaliha', 'pak', 'pakkol', 'jm', 'sortkatalog', 'aktivan'];
            foreach ($required as $field) {
                if (!array_key_exists($field, $row)) {
                    $invalidRows++;
                    continue 2;
                }
            }
            $quantity = self::parseDecimal((string)$row['zaliha']);
            $pack = self::parseDecimal((string)$row['pakkol']);
            $sort = self::parseDecimal((string)$row['sortkatalog']);
            $pak = is_bool($row['pak']) ? ($row['pak'] ? '1' : '0') : strtolower(trim((string)$row['pak']));
            $active = is_bool($row['aktivan']) ? ($row['aktivan'] ? '1' : '0') : strtolower(trim((string)$row['aktivan']));
            $unit = trim((string)$row['jm']);
            if ($sku === '' || strlen($sku) > 64 || preg_match('/[\x00-\x1F\x7F]/', $sku)
                || $quantity === null || abs($quantity) > 2147483647
                || $pack === null || $pack < 0 || $pack > 2147483647
                || $sort === null || $sort != (int)$sort || abs($sort) > 2147483647
                || !in_array($pak, ['0', '1', 'false', 'true'], true)
                || !in_array($active, ['0', '1', 'false', 'true'], true)
                || strlen($unit) > 14) {
                $invalidRows++;
                continue;
            }
            $item = [
                'sku' => $sku,
                'quantity' => $quantity,
                'pak' => in_array($pak, ['1', 'true'], true) ? 1 : 0,
                'pakkol' => $pack,
                'jm' => $unit,
                'ean' => $unit,
                'sort_order' => (int)$sort,
                'status' => in_array($active, ['1', 'true'], true) ? 1 : 0,
            ];
            $item['minimum'] = $item['pak'] ? (int)ceil($pack > 0 ? $pack : 1) : 1;
            $key = 'sku:' . strtolower($sku);
            if (isset($normalized[$key]) && $normalized[$key] !== $item) {
                $invalidRows++;
                continue;
            }
            $normalized[$key] = $item;
        }
        return ['valid' => $invalidRows === 0, 'rows' => array_values($normalized), 'invalid_rows' => $invalidRows];
    }

    public static function normalizeCatalogRows(array $articles, array $groups, array $partners): array
    {
        $prices = self::normalizeArticlePriceRows($articles);
        $stock = self::normalizeArticleStockRows($articles);
        if (!$prices['valid'] || !$stock['valid']) {
            return ['valid' => false, 'rows' => [], 'error' => 'invalid_article_rows'];
        }
        $groupMap = [];
        foreach ($groups as $source) {
            $row = array_change_key_case((array)$source, CASE_LOWER);
            $id = trim((string)($row['id'] ?? ''));
            $name = trim((string)($row['naziv'] ?? ''));
            if ($id === '' || $name === '' || self::textLength($name) > 255
                || (isset($groupMap[$id]) && $groupMap[$id] !== $row)) {
                return ['valid' => false, 'rows' => [], 'error' => 'invalid_group_rows'];
            }
            $groupMap[$id] = $row;
        }
        $partnerMap = [];
        foreach ($partners as $source) {
            $row = array_change_key_case((array)$source, CASE_LOWER);
            $id = trim((string)($row['id'] ?? ''));
            if ($id === '' || (isset($partnerMap[$id]) && $partnerMap[$id] !== $row)) {
                return ['valid' => false, 'rows' => [], 'error' => 'invalid_partner_rows'];
            }
            $partnerMap[$id] = $row;
        }
        $stockMap = [];
        foreach ($stock['rows'] as $item) {
            $stockMap[$item['sku']] = $item;
        }
        $rows = [];
        foreach ($prices['rows'] as $price) {
            $row = array_change_key_case($price['source'], CASE_LOWER);
            foreach (['kataloggrupa', 'gid', 'partner', 'barcode'] as $field) {
                if (!array_key_exists($field, $row)) {
                    return ['valid' => false, 'rows' => [], 'error' => 'missing_article_fields'];
                }
            }
            $groupId = trim((string)$row['kataloggrupa']);
            $partnerId = trim((string)$row['partner']);
            $gid = trim((string)$row['gid']);
            if (!isset($groupMap[$groupId], $partnerMap[$partnerId], $stockMap[$price['sku']])
                || !preg_match('/^[0-9]+$/D', $gid) || (float)$gid > 2147483647
                || !preg_match('/^[0-9]+$/D', $partnerId) || (float)$partnerId > 2147483647
                || strlen($groupId) > 64 || self::textLength((string)$row['barcode']) > 64) {
                return ['valid' => false, 'rows' => [], 'error' => 'invalid_article_reference'];
            }
            $group = $groupMap[$groupId];
            $nameAdd = trim((string)($row['dimmodel'] ?? ''));
            if (self::textLength($nameAdd) > 255) {
                return ['valid' => false, 'rows' => [], 'error' => 'invalid_article_name'];
            }
            $rows[] = array_merge($stockMap[$price['sku']], [
                'model' => trim((string)$row['barcode']),
                'partner_id' => (int)$partnerId,
                'gid' => (int)$gid,
                'mpn' => $groupId,
                'vpc' => $price['vpc'],
                'price' => $price['price'],
                'cent' => $price['cent'],
                'name' => trim((string)$group['naziv']),
                'name_add' => $nameAdd,
                'description' => trim((string)($group['opis'] ?? '')),
                'description_add' => trim((string)($row['opiskatalog'] ?? '')),
                'image' => trim((string)($group['picpath'] ?? '')),
            ]);
        }
        return ['valid' => true, 'rows' => $rows, 'error' => ''];
    }

    private static function textLength(string $value): int
    {
        return function_exists('mb_strlen') ? mb_strlen($value, 'UTF-8') : strlen($value);
    }

    /**
     * A destructive status reconciliation needs both a successful transport /
     * parse result and a validated, non-empty full article snapshot.
     */
    public static function canDisableMissingArticles(array $fetchResult, array $normalized): bool
    {
        return !empty($fetchResult['success'])
            && !empty($normalized['valid'])
            && !empty($normalized['skus']);
    }

    /**
     * Reject unexpectedly small snapshots even after their structure has
     * validated. This is a final circuit breaker for truncated upstream data;
     * it is not a substitute for an ERP-confirmed full-snapshot contract.
     */
    public static function passesArticleSnapshotSanity(int $snapshotCount, int $localCount, float $minimumRatio = 0.8): bool
    {
        if ($snapshotCount <= 0 || $localCount < 0 || $minimumRatio <= 0 || $minimumRatio > 1) {
            return false;
        }

        return $localCount === 0 || ($snapshotCount / $localCount) >= $minimumRatio;
    }

    private static function firstValue(array $row, array $keys, bool $allowBlank = false): string
    {
        foreach ($keys as $key) {
            if (array_key_exists($key, $row) && ($allowBlank || trim((string)$row[$key]) !== '')) {
                return trim((string)$row[$key]);
            }
        }

        $normalizedKeys = [];
        foreach ($keys as $key) {
            $normalizedKeys[self::normalizeKey($key)] = true;
        }

        foreach ($row as $key => $value) {
            if (isset($normalizedKeys[self::normalizeKey((string)$key)]) && ($allowBlank || trim((string)$value) !== '')) {
                return trim((string)$value);
            }
        }

        return '';
    }

    private static function normalizeKey(string $key): string
    {
        $key = function_exists('utf8_strtolower') ? utf8_strtolower($key) : strtolower($key);
        $key = strtr($key, ['č' => 'c', 'ć' => 'c', 'đ' => 'd', 'š' => 's', 'ž' => 'z']);

        return (string)preg_replace('/[^a-z0-9]+/', '', $key);
    }

    private static function parseDecimal(string $value): ?float
    {
        $value = str_replace([' ', "\xc2\xa0"], '', trim($value));
        if ($value === '') {
            return 0.0;
        }

        if (strpos($value, ',') !== false && strpos($value, '.') !== false) {
            $value = str_replace('.', '', $value);
        }
        $value = str_replace(',', '.', $value);

        if (!preg_match('/^-?(?:\d+(?:\.\d+)?|\.\d+)$/', $value)) {
            return null;
        }

        $number = (float)$value;
        return is_finite($number) ? $number : null;
    }
}
