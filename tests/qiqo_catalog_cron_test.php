<?php

define('QIQO_CATALOG_CRON_LIBRARY_ONLY', true);
require __DIR__ . '/../scripts/configure_qiqo_catalog_cron.php';
function catalogCronAssert($condition, $message) { if (!$condition) throw new RuntimeException($message); }

$line = qiqoCatalogCronLine('/runtime/php', "/work/Ital Cro's shop");
catalogCronAssert(strpos($line, '52 * * * * ') === 0 && strpos($line, escapeshellarg("/work/Ital Cro's shop/scripts/run_qiqo_catalog_cycle.php")) !== false,
    'The managed line must use minute 52 and shell-quote absolute paths, including quotes/spaces.');
$current = "MAILTO=owner@example.test\n# existing jobs\n*/5 * * * * curl 'https://example.test/existing?key=private'\n\n";
$plan = qiqoCatalogCronPlan($current, $line);
catalogCronAssert($plan['contents'] === $current . $line . "\n" && $plan['changed'] && $plan['managed_entries'] === 1,
    'Appending the catalog job must preserve every byte of unrelated environment, comments, commands and blank lines.');
$again = qiqoCatalogCronPlan($plan['contents'], $line);
catalogCronAssert(!$again['changed'] && $again['contents'] === $plan['contents'], 'Repeated configuration must be exactly idempotent.');
$old = str_replace('52 * * * *', '7 */6 * * *', $line);
$replacement = qiqoCatalogCronPlan("# before\n" . $old . "\n# after\n", $line);
catalogCronAssert($replacement['contents'] === "# before\n" . $line . "\n# after\n", 'Only the one marked catalog line may change.');
catalogCronAssert(qiqoCatalogCronPlan('', $line)['contents'] === $line . "\n", 'An empty crontab must get one newline-terminated entry.');
catalogCronAssert(qiqoCatalogCronPlan('# existing comment', $line)['contents'] === '# existing comment' . "\n" . $line . "\n",
    'A missing final newline must not merge a catalog entry with existing content.');
foreach ([$line . "\n" . $line . "\n", "52 * * * * php /other/run_qiqo_catalog_cycle.php\n",
    '# italcro-qiqo-catalog-managed' . "\n", "* * * * * echo ambiguous # italcro-qiqo-catalog-managed\n",
    '# commented run_qiqo_catalog_cycle.php # italcro-qiqo-catalog-managed' . "\n"] as $ambiguous) {
    try { qiqoCatalogCronPlan($ambiguous, $line); throw new LogicException('Ambiguous cron accepted.'); }
    catch (RuntimeException $expected) { if ($expected instanceof LogicException) throw $expected; }
}
foreach ([['/runtime/php', '/work/percent%shop'], ['/runtime/php', "/work/new\nline"]] as $paths) {
    try { qiqoCatalogCronLine($paths[0], $paths[1]); throw new LogicException('Unsafe cron path accepted.'); }
    catch (RuntimeException $expected) { if ($expected instanceof LogicException) throw $expected; }
}
echo "Catalog crontab quoting, exact preservation, idempotence and ambiguous-duplicate protection passed.\n";
