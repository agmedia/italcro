<?php

require_once __DIR__ . '/../upload/system/library/qiqo/pricing_resolver.php';

function assertClose($expected, $actual, $message)
{
    if (abs((float)$expected - (float)$actual) > 0.000001) {
        throw new RuntimeException($message . ': expected ' . $expected . ', got ' . $actual);
    }
}

function assertSameValue($expected, $actual, $message)
{
    if ($expected !== $actual) {
        throw new RuntimeException($message . ': expected ' . var_export($expected, true) . ', got ' . var_export($actual, true));
    }
}

$sku300970Actions = [
    ['indicator' => 'P', 'quantity' => 0, 'price' => 0, 'discount' => 22],
    ['indicator' => 'P', 'quantity' => 24, 'price' => 0, 'discount' => 25],
    ['indicator' => 'P', 'quantity' => 240, 'price' => 0, 'discount' => 28],
];

$catalog = QiqoPricingResolver::resolve(1.94, 15, 'partner', $sku300970Actions, 1, false, false);
assertClose(1.649, $catalog['final_unit_price'], 'Catalog must ignore action discount');
assertClose(15, $catalog['discount_percent'], 'Catalog label must show partner discount');
assertSameValue('partner', $catalog['price_source'], 'Catalog price source');

$article = QiqoPricingResolver::resolve(100, 12.5, 'article', [], 1, false, false);
assertClose(87.5, $article['final_unit_price'], 'Article discount overrides partner before resolver');
assertSameValue('article', $article['price_source'], 'Article price source');

$free = QiqoPricingResolver::resolve(100, 100, 'article', [], 1, false, false);
assertClose(0, $free['final_unit_price'], 'A valid 100% base rebate must remain a zero price');
assertClose(100, $free['old_unit_price'], 'A 100% rebate must retain the old VPC for display');

foreach ([[1, 22], [23.9999, 22], [24, 25], [239.9999, 25], [240, 28]] as $case) {
    [$quantity, $discount] = $case;
    $pricing = QiqoPricingResolver::resolve(1.94, 15, 'partner', $sku300970Actions, $quantity, true, false);
    assertClose($discount, $pricing['discount_percent'], 'Action tier label at quantity ' . $quantity);
    assertClose(1.94 * (1 - $discount / 100), $pricing['final_unit_price'], 'Action tier price at quantity ' . $quantity);
    assertSameValue('action_percent', $pricing['price_source'], 'Action tier source at quantity ' . $quantity);
}

$lowerAction = QiqoPricingResolver::resolve(
    100,
    20,
    'partner',
    [['indicator' => 'P', 'quantity' => 0, 'price' => 0, 'discount' => 10]],
    1,
    true,
    false
);
assertClose(90, $lowerAction['final_unit_price'], 'Eligible action rebate is final even when lower than partner rebate');

$withProforma = [
    ['indicator' => 'P', 'quantity' => 0, 'price' => 0, 'discount' => 22],
    ['indicator' => 'X', 'quantity' => 0, 'price' => 0, 'discount' => 3],
];
assertClose(22, QiqoPricingResolver::resolve(100, 15, 'partner', $withProforma, 1, true, false)['discount_percent'], 'X must not apply outside proforma');
assertClose(25, QiqoPricingResolver::resolve(100, 15, 'partner', $withProforma, 1, true, true)['discount_percent'], 'X must add to eligible proforma action');

$xOnly = [['indicator' => 'X', 'quantity' => 0, 'price' => 0, 'discount' => 3]];
$xOnlyStandard = QiqoPricingResolver::resolve(100, 15, 'partner', $xOnly, 1, true, false);
assertClose(15, $xOnlyStandard['discount_percent'], 'X-only row must not apply outside proforma');
assertClose(85, $xOnlyStandard['final_unit_price'], 'Non-proforma X-only row keeps base rebate');
$xOnlyProforma = QiqoPricingResolver::resolve(100, 15, 'partner', $xOnly, 1, true, true);
assertClose(18, $xOnlyProforma['discount_percent'], 'X-only proforma row must augment base rebate');
assertClose(82, $xOnlyProforma['final_unit_price'], 'X-only proforma final price');
assertClose(0, $xOnlyProforma['action_regular_discount'], 'X-only row has no regular action rebate');
assertClose(3, $xOnlyProforma['action_x_discount'], 'X-only row exposes its extra rebate');

$absoluteNet = QiqoPricingResolver::resolve(
    100,
    20,
    'partner',
    [
        ['indicator' => 'C', 'quantity' => 0, 'price' => 90, 'discount' => 0],
        ['indicator' => 'X', 'quantity' => 0, 'price' => 0, 'discount' => 5],
    ],
    1,
    true,
    true
);
assertClose(90, $absoluteNet['final_unit_price'], 'C net price must be absolute');
assertClose(0, $absoluteNet['discount_percent'], 'C net price hides percent label');
assertSameValue('action_net', $absoluteNet['price_source'], 'C net price source');

$c100 = QiqoPricingResolver::resolve(
    0.1229,
    15,
    'partner',
    [['indicator' => 'C', 'quantity' => 0, 'price' => 7.74, 'discount' => 0]],
    100,
    true,
    false,
    'C-100'
);
assertClose(0.0774, $c100['final_unit_price'], 'C-100 action net must normalize to unit price');
assertClose(0.0774, $c100['action_net_price'], 'C-100 action snapshot must be normalized');

echo "Qiqo pricing resolver tests passed.\n";
