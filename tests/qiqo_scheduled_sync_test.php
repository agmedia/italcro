<?php
require __DIR__.'/../upload/system/library/qiqo/scheduled_sync.php';
$token=str_repeat('a',64);$keys=['stock'=>hash('sha256',$token),'prices'=>hash('sha256',str_repeat('b',64))];
foreach ([['stock',$token,true],['prices',$token,false],['stock','',false],['orders',$token,false],['catalog',$token,false],['discounts',$token,false]] as $case) {
    if(QiqoScheduledSync::authorized($keys,$case[0],$case[1])!==$case[2])throw new RuntimeException('Cron authorization/scoping failed.');
}
try { QiqoScheduledSync::run(dirname(__DIR__),'orders');throw new LogicException('Order task accepted.'); }
catch(InvalidArgumentException $expected) {}
echo "Scheduled task allowlist and per-task authorization passed.\n";

$root=sys_get_temp_dir().'/italcro-cron-lock-'.bin2hex(random_bytes(6));
mkdir($root,0700);mkdir($root.'/upload',0700);
$directory=dirname(QiqoDiscountJob::directory($root)).'/cron';mkdir($directory,0700);
$lock=fopen($directory.'/run.lock','c');flock($lock,LOCK_EX);
$result=QiqoScheduledSync::run($root,'stock');
if(empty($result['success'])||($result['skipped']??'')!=='another_sync_running')throw new RuntimeException('Overlapping cron was not skipped.');
flock($lock,LOCK_UN);fclose($lock);
file_put_contents($root.'/upload/config.php',"<?php throw new RuntimeException('Injected bootstrap failure.');");
$result=QiqoScheduledSync::run($root,'prices');
if($result['success']!==false||$result['error']!=='sync_failed'||!is_file($directory.'/prices-last.json'))throw new RuntimeException('Failed worker was not reported privately.');
$iterator=new RecursiveIteratorIterator(new RecursiveDirectoryIterator($root,FilesystemIterator::SKIP_DOTS),RecursiveIteratorIterator::CHILD_FIRST);
foreach($iterator as $item){if($item->isDir())rmdir($item->getPathname());else unlink($item->getPathname());}rmdir($root);
echo "Scheduled job overlap prevention and private failure status passed.\n";
