<?php

final class QiqoNewProduct
{
    /** The theme's period applies to the article's original webshop creation. */
    public static function isNew(array $product, int $days, ?string $now = null): bool
    {
        if ($days <= 0 || !isset($product['date_added']) || !is_string($product['date_added'])) {
            return false;
        }
        $added = self::timestamp(trim($product['date_added']));
        if ($added === null) {
            return false;
        }
        [$cutoff, $now] = self::dateWindow($days, $now);
        return $added >= $cutoff && $added <= $now;
    }

    /** Use the same store-local timestamps for SQL filtering and badges. */
    public static function dateWindow(int $days, ?string $now = null): array
    {
        if ($days <= 0) {
            throw new InvalidArgumentException('The new-product period must be positive.');
        }
        $now = self::timestamp($now === null ? date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME'] ?? time()) : $now);
        if ($now === null) {
            throw new InvalidArgumentException('Invalid current timestamp.');
        }
        $date = new DateTimeImmutable($now);
        return [$date->modify('-' . $days . ' days')->format('Y-m-d H:i:s'), $now];
    }

    private static function timestamp(string $value): ?string
    {
        if (preg_match('/^\d{4}-\d{2}-\d{2}$/D', $value)) {
            $value .= ' 00:00:00';
        }
        if (!preg_match('/^(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})$/D', $value, $parts)
            || !checkdate((int)$parts[2], (int)$parts[3], (int)$parts[1])
            || (int)$parts[4] > 23 || (int)$parts[5] > 59 || (int)$parts[6] > 59) {
            return null;
        }
        $date = DateTimeImmutable::createFromFormat('!Y-m-d H:i:s', $value);
        return $date && $date->format('Y-m-d H:i:s') === $value ? $value : null;
    }
}
