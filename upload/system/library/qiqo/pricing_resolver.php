<?php

final class QiqoPricingResolver
{
    public static function resolve(
        $baseUnit,
        $baseDiscount,
        $baseSource,
        array $actionRows,
        $quantity,
        $includeAction,
        $isProforma,
        $cent = ''
    ): array {
        $baseUnit = max(0.0, (float)$baseUnit);
        $baseDiscount = self::clampDiscount($baseDiscount);
        $quantity = max(0.0, (float)$quantity);
        $baseSource = in_array($baseSource, ['article', 'partner'], true) ? $baseSource : 'list';

        $finalUnit = $baseUnit;
        $oldUnit = false;
        $source = 'list';
        $displayDiscount = 0.0;
        $effectiveDiscount = 0.0;
        $actionApplied = false;

        if ($baseUnit > 0 && $baseDiscount > 0) {
            $finalUnit = $baseUnit * (1 - ($baseDiscount / 100));
            $oldUnit = $baseUnit;
            $source = $baseSource;
            $displayDiscount = $baseDiscount;
            $effectiveDiscount = $baseDiscount;
        }

        $action = self::resolveAction($actionRows, $quantity, (bool)$isProforma, $cent);
        $resolvedActionDiscount = (float)$action['discount'];

        if ($includeAction && $baseUnit > 0) {
            // Qiqo C net price is an absolute price. It is not combined with a
            // partner/article rebate or the X proforma rebate.
            if ($action['net_price'] !== null && $action['net_price'] > 0) {
                $finalUnit = (float)$action['net_price'];
                $oldUnit = $baseUnit;
                $source = 'action_net';
                $displayDiscount = 0.0;
                $effectiveDiscount = max(0.0, (($baseUnit - $finalUnit) / $baseUnit) * 100);
                $actionApplied = true;
                $resolvedActionDiscount = 0.0;
            } else {
                // X is an extra proforma rebate. When there is no eligible
                // C/P percentage action, it augments the article/partner base
                // rebate instead of replacing it.
                if (empty($action['has_regular_discount']) && $action['x_discount'] > 0) {
                    $resolvedActionDiscount = self::clampDiscount($baseDiscount + $action['x_discount']);
                }

                if ($resolvedActionDiscount > 0) {
                    // An eligible action rebate is the final rebate for the line;
                    // it does not stack with the partner/article rebate.
                    $finalUnit = $baseUnit * (1 - ($resolvedActionDiscount / 100));
                    $oldUnit = $baseUnit;
                    $source = 'action_percent';
                    $displayDiscount = $resolvedActionDiscount;
                    $effectiveDiscount = $resolvedActionDiscount;
                    $actionApplied = true;
                }
            }
        }

        $unitScale = self::isC100($cent) ? 7 : 5;
        $finalUnit = round($finalUnit, $unitScale);
        if ($action['net_price'] !== null) {
            $action['net_price'] = round((float)$action['net_price'], $unitScale);
        }

        return [
            'base_unit_price' => $baseUnit,
            'old_unit_price' => $oldUnit,
            'final_unit_price' => (float)$finalUnit,
            'price_source' => $source,
            'discount_percent' => round($displayDiscount, 4),
            'effective_discount_percent' => round($effectiveDiscount, 4),
            'base_discount_percent' => round($baseDiscount, 4),
            'action_discount' => round($resolvedActionDiscount, 4),
            'action_regular_discount' => round((float)$action['regular_discount'], 4),
            'action_x_discount' => round((float)$action['x_discount'], 4),
            'action_net_price' => $action['net_price'] !== null ? (float)$action['net_price'] : null,
            'action_applied' => $actionApplied,
            'has_action' => !empty($actionRows),
        ];
    }

    public static function resolveAction(array $rows, $quantity, $isProforma, $cent = ''): array
    {
        $quantity = max(0.0, (float)$quantity);
        $cDiscount = 0.0;
        $pAlwaysDiscount = 0.0;
        $pTierQuantity = -1.0;
        $pTierDiscount = 0.0;
        $xDiscount = 0.0;
        $netPrice = null;

        foreach ($rows as $row) {
            $indicator = strtoupper(trim((string)($row['indicator'] ?? '')));
            $threshold = (float)($row['quantity'] ?? 0);
            $price = (float)($row['price'] ?? 0);
            $discount = self::clampDiscount($row['discount'] ?? 0);

            if ($indicator === 'C' && $price > 0) {
                $normalizedPrice = self::isC100($cent) ? $price / 100 : $price;
                if ($netPrice === null || $normalizedPrice < $netPrice) {
                    $netPrice = $normalizedPrice;
                }
            } elseif ($indicator === 'C' && $discount > $cDiscount) {
                $cDiscount = $discount;
            }

            if ($indicator === 'P') {
                if ($threshold <= 0 && $discount > $pAlwaysDiscount) {
                    $pAlwaysDiscount = $discount;
                } elseif ($threshold > 0 && $quantity >= $threshold) {
                    if ($threshold > $pTierQuantity || ($threshold == $pTierQuantity && $discount > $pTierDiscount)) {
                        $pTierQuantity = $threshold;
                        $pTierDiscount = $discount;
                    }
                }
            }

            if ($isProforma && $indicator === 'X' && $discount > $xDiscount) {
                $xDiscount = $discount;
            }
        }

        if ($netPrice !== null && $netPrice > 0) {
            return [
                'net_price' => $netPrice,
                'discount' => 0.0,
                'regular_discount' => 0.0,
                'x_discount' => $xDiscount,
                'has_regular_discount' => false,
            ];
        }

        $regularDiscount = self::clampDiscount(max($cDiscount, $pAlwaysDiscount, $pTierDiscount));

        return [
            'net_price' => null,
            'discount' => self::clampDiscount($regularDiscount + $xDiscount),
            'regular_discount' => $regularDiscount,
            'x_discount' => $xDiscount,
            'has_regular_discount' => $regularDiscount > 0,
        ];
    }

    public static function isC100($cent): bool
    {
        return strtoupper((string)preg_replace('/[^A-Z0-9]/i', '', (string)$cent)) === 'C100';
    }

    private static function clampDiscount($discount): float
    {
        return max(0.0, min(100.0, (float)$discount));
    }
}
