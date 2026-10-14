<?php

final class QiqoNewProduct
{
    /** Only the ERP introduction date establishes whether an article is new. */
    public static function isNew(array $product, ?string $today = null): bool
    {
        $introduced = isset($product['qiqo_introduced_at']) ? trim((string)$product['qiqo_introduced_at']) : '';
        if (!self::isDate($introduced)) {
            return false;
        }

        [$cutoff, $today] = self::dateWindow($today);
        return $introduced >= $cutoff && $introduced <= $today;
    }

    /** Match calendar-month subtraction, including the last day of short months. */
    public static function dateWindow(?string $today = null): array
    {
        $today = $today === null ? date('Y-m-d') : $today;
        if (!self::isDate($today)) {
            throw new InvalidArgumentException('Invalid current date.');
        }

        $date = new DateTimeImmutable($today);
        $month = $date->modify('first day of this month')->modify('-3 months');
        $day = min((int)$date->format('j'), (int)$month->format('t'));
        return [$month->setDate((int)$month->format('Y'), (int)$month->format('n'), $day)->format('Y-m-d'), $today];
    }

    private static function isDate(string $value): bool
    {
        return preg_match('/^(\d{4})-(\d{2})-(\d{2})$/', $value, $parts) === 1
            && checkdate((int)$parts[2], (int)$parts[3], (int)$parts[1]);
    }
}
