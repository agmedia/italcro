<?php

define('DIR_SYSTEM', __DIR__ . '/../upload/system/');
define('DB_PREFIX', 'oc_');

require_once __DIR__ . '/../upload/system/library/cart/cart.php';

final class QiqoCartTestResult
{
    public $num_rows = 0;
    public $row = [];
    public $rows = [];
}

final class QiqoCartTestDb
{
    public $grouped = true;
    public $writes = [];

    public function escape($value)
    {
        return addslashes((string)$value);
    }

    public function query($sql)
    {
        $result = new QiqoCartTestResult();

        if (strpos($sql, 'SELECT `mpn` FROM oc_product') !== false) {
            $result->num_rows = 1;
            $result->row = ['mpn' => $this->grouped ? 'GROUP-1' : ''];
        } elseif (strpos($sql, 'SELECT COUNT(*) AS total FROM oc_product') !== false) {
            $result->num_rows = 1;
            $result->row = ['total' => $this->grouped ? 2 : 1];
        } elseif (strpos($sql, 'SELECT COUNT(*) AS total FROM oc_cart') !== false) {
            $result->num_rows = 1;
            $result->row = ['total' => 0];
        } elseif (strpos($sql, 'INSERT INTO oc_cart') === 0 || strpos($sql, 'UPDATE oc_cart SET quantity') === 0) {
            $this->writes[] = $sql;
        }

        return $result;
    }
}

final class QiqoCartTestConfig
{
    public function get($key)
    {
        return $key === 'config_store_id' ? 0 : null;
    }
}

final class QiqoCartTestCustomer
{
    public function getId() { return 1; }
}

final class QiqoCartTestSession
{
    public $data = [];
    public function getId() { return 'test-session'; }
}

final class QiqoCartTestRegistry
{
    private $services;

    public function __construct($db)
    {
        $this->services = [
            'config' => new QiqoCartTestConfig(),
            'customer' => new QiqoCartTestCustomer(),
            'session' => new QiqoCartTestSession(),
            'db' => $db,
            'tax' => new stdClass(),
            'weight' => new stdClass(),
        ];
    }

    public function get($key) { return $this->services[$key]; }
}

$db = new QiqoCartTestDb();
$cart = new \Cart\Cart(new QiqoCartTestRegistry($db));

if ($cart->add(10, 1) !== false || $db->writes) {
    throw new RuntimeException('A generic add must not select the representative SKU of a grouped MPN.');
}

if ($cart->add(10, 1, [], 0, true) !== true || count($db->writes) !== 1) {
    throw new RuntimeException('An explicitly selected grouped variant must remain addable.');
}

$db->grouped = false;
if ($cart->add(11, 1) !== true || count($db->writes) !== 2) {
    throw new RuntimeException('A normal single article must remain addable.');
}

echo "QIQO cart grouped-product guard tests passed.\n";
