<?php
// All writes use temporary tables on this connection; the local catalog is untouched.
require __DIR__ . '/../upload/config.php';
if (!in_array(DB_HOSTNAME, ['localhost','127.0.0.1','::1'], true)) throw new RuntimeException('Local only.');
require DIR_SYSTEM.'engine/registry.php';
require DIR_SYSTEM.'engine/model.php';
require DIR_SYSTEM.'library/config.php';
require DIR_SYSTEM.'library/qiqo/article_rules.php';
function agconf($key) { return $key === 'qiqo.categories' ? [1=>'Redovna',2=>'Nova redovna'] : null; }
require __DIR__.'/../upload/admin/model/extension/module/qiqo.php';
class Rev33Db {
    private $db;
    public function __construct() { $this->db = new mysqli(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_DATABASE,(int)DB_PORT); }
    public function escape($s) { return $this->db->real_escape_string($s); }
    public function query($s) {
        if (strpos($s,"SHOW TABLES LIKE '")===0) $rows=[['present'=>1]];
        else { $r=$this->db->query($s); if($r===false) throw new RuntimeException($this->db->error); $rows=$r instanceof mysqli_result?$r->fetch_all(MYSQLI_ASSOC):[]; }
        return (object)['rows'=>$rows,'row'=>$rows[0]??[],'num_rows'=>count($rows)];
    }
}
$db=new Rev33Db();$p=DB_PREFIX;
$db->query("CREATE TEMPORARY TABLE `{$p}qiqo_article_classification` (article_code VARCHAR(64) PRIMARY KEY,classification INT)");
$db->query("CREATE TEMPORARY TABLE `{$p}product` (product_id INT PRIMARY KEY,sku VARCHAR(64))");
$db->query("CREATE TEMPORARY TABLE `{$p}product_to_category` (product_id INT,category_id INT,PRIMARY KEY(product_id,category_id))");
$db->query("CREATE TEMPORARY TABLE `{$p}category_description` (category_id INT,name VARCHAR(64))");
$db->query("INSERT INTO `{$p}product` VALUES (1,'513056'),(2,'FUTURE801'),(3,'REGULAR')");
$db->query("INSERT INTO `{$p}category_description` VALUES (309,'Rasprodaja'),(7,'Redovna'),(77,'Nova redovna')");
$db->query("INSERT INTO `{$p}product_to_category` VALUES (1,55),(1,56),(2,55),(2,88),(3,309),(3,7),(3,8)");
$r=new Registry();$r->set('db',$db);$r->set('config',new Config());$model=new ModelExtensionModuleQiqo($r);
$feed=[['id'=>'513056','gid'=>'800'],['id'=>'FUTURE801','gid'=>'801'],['id'=>'REGULAR','gid'=>'1']];
foreach([1,2] as $run) {
    if($model->syncArticleClassifications($feed)!==3) throw new RuntimeException('Classification sync failed.');
    $links=$db->query("SELECT * FROM `{$p}product_to_category` ORDER BY product_id,category_id")->rows;
    if($links!=[['product_id'=>'1','category_id'=>'309'],['product_id'=>'2','category_id'=>'309'],['product_id'=>'3','category_id'=>'7'],['product_id'=>'3','category_id'=>'8']]) throw new RuntimeException('Clearance must have only Rasprodaja; regular categories must remain.');
}
// Repair stale assignments again even when the ERP classification did not change.
$db->query("INSERT INTO `{$p}product_to_category` VALUES (1,55),(2,88)");
$model->syncArticleClassifications($feed);
if($db->query("SELECT * FROM `{$p}product_to_category` WHERE product_id IN (1,2) AND category_id<>309")->num_rows) throw new RuntimeException('Repeated import retained a stale clearance category.');
$map=QiqoArticleRules::classifications($db,['513056','FUTURE801','REGULAR']);
if($map!=['513056'=>800,'FUTURE801'=>801,'REGULAR'=>1]) throw new RuntimeException('Pricing classification lookup failed.');
try { $model->syncArticleClassifications([['id'=>'513056','gid'=>'1'],['id'=>'BAD','gid'=>'bad']]);throw new LogicException('Invalid feed accepted.'); }
catch(UnexpectedValueException $expected) {}
if(QiqoArticleRules::classifications($db,['513056'])['513056']!==800) throw new RuntimeException('Invalid tail partially overwrote classifications.');
$model->syncArticleClassifications([['id'=>'513056','gid'=>'2']]);
$links=$db->query("SELECT category_id FROM `{$p}product_to_category` WHERE product_id=1 ORDER BY category_id")->rows;
if($links!==[['category_id'=>'77']]) throw new RuntimeException('Leaving clearance must use the new ERP category without restoring old assignments.');
$model->syncArticleClassifications([['id'=>'513056','gid'=>'800']]);
$links=$db->query("SELECT category_id FROM `{$p}product_to_category` WHERE product_id=1 ORDER BY category_id")->rows;
if($links!==[['category_id'=>'309']]) throw new RuntimeException('Returning to clearance must again remove the regular category.');
// The full catalog path persists metadata without applying global delta category rules.
$before=$db->query("SELECT * FROM `{$p}product_to_category` ORDER BY product_id,category_id")->rows;
$persist=new ReflectionMethod(ModelExtensionModuleQiqo::class,'persistCatalogClassifications');$persist->setAccessible(true);
$persist->invoke($model,['REGULAR'=>800]);
if($db->query("SELECT * FROM `{$p}product_to_category` ORDER BY product_id,category_id")->rows!==$before) throw new RuntimeException('Metadata-only full persistence changed category links.');
if(QiqoArticleRules::classifications($db,['REGULAR'])['REGULAR']!==800) throw new RuntimeException('Full metadata-only persistence failed.');
echo "Clearance-only category, regular categories, repeated repair, transitions and validation passed.\n";
