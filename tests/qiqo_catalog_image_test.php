<?php

require_once __DIR__ . '/../upload/system/engine/registry.php';
require_once __DIR__ . '/../upload/system/engine/model.php';
define('DIR_STORAGE', __DIR__ . '/../storage/');
define('DIR_SYSTEM', __DIR__ . '/../upload/system/');
$root = sys_get_temp_dir() . '/qiqo-image-test-' . bin2hex(random_bytes(6));
mkdir($root, 0700);
define('DIR_IMAGE', $root . '/');
$imageBase = 'Env key not found!';
function agconf($key, $default = null) { global $imageBase; return $default ?: $imageBase; }
require __DIR__ . '/../upload/admin/model/extension/module/qiqo.php';
$method = new ReflectionMethod(ModelExtensionModuleQiqo::class, 'downloadImage');
$method->setAccessible(true);
$model = new ModelExtensionModuleQiqo(new Registry());
$image = base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/x8AAwMCAO+aN1sAAAAASUVORK5CYII=');
function imageCheck($condition, $message) { if (!$condition) throw new RuntimeException($message); }
try {
    mkdir($root . '/Slike');
    file_put_contents($root . '/Slike/local.png', $image);
    $imageBase = 'https://configured.example.invalid/';
    imageCheck($method->invoke($model, 'Slike\\local.png') === 'Slike/local.png', 'An existing image must be reused without contacting its configured remote host.');
    imageCheck($method->invoke($model, 'Slike//SRV-TS01/Svasta/Italcro/Photo/local.png') === 'Slike/local.png', 'The known malformed ERP UNC path must resolve its exact local Slike suffix.');
    imageCheck($method->invoke($model, '\\\\SRV-TS01\\Svasta\\Italcro\\Photo\\local.png') === 'Slike/local.png', 'The known raw UNC source must reuse the exact existing local image.');
    imageCheck($method->invoke($model, 'Photo/local.png') === 'Slike/local.png', 'The ERP Photo prefix may resolve the exact Slike path.');
    mkdir($root . '/Portals'); mkdir($root . '/Portals/0'); mkdir($root . '/Portals/0/Photo');
    file_put_contents($root . '/Portals/0/Photo/portal.png', $image);
    imageCheck($method->invoke($model, 'Slike//SRV-TS01/Svasta/Italcro/Photo/portal.png') === 'Portals/0/Photo/portal.png', 'An exact Portals image must return a usable path relative to DIR_IMAGE.');
    $imageBase = 'Env key not found!';
    imageCheck($method->invoke($model, 'Slike/missing.png') === '', 'Missing image configuration must return immediately without a guessed host.');
    imageCheck(!is_dir($root . '/catalog'), 'Missing configuration must not create download directories.');
    foreach (['../outside.png', 'Slike/%2e%2e/outside.png', 'https://external.invalid/image.png', "Slike/bad\0.png", '\\\\OTHER\\Svasta\\Italcro\\Photo\\local.png'] as $path) {
        imageCheck($method->invoke($model, $path) === '', 'Unsafe image paths must be rejected.');
    }
    $imageBase = 'www.qiqo.hr';
    imageCheck($method->invoke($model, 'Slike/missing.png') === '', 'A bare image host must never receive a guessed URL scheme.');
    imageCheck(!is_dir($root . '/catalog'), 'Invalid image-host configuration must not create directories.');
    mkdir($root . '/catalog'); mkdir($root . '/catalog/qiqo');
    file_put_contents($root . '/catalog/qiqo/cached.png', $image);
    $before = hash_file('sha256', $root . '/catalog/qiqo/cached.png');
    imageCheck($method->invoke($model, 'Slike/cached.png') === 'catalog/qiqo/cached.png', 'An existing imported image must remain reusable.');
    imageCheck(hash_file('sha256', $root . '/catalog/qiqo/cached.png') === $before, 'An existing image must never be overwritten.');
    $imageBase = 'file:///private/';
    imageCheck($method->invoke($model, 'Slike/absent.png') === '', 'Invalid image URL schemes must not trigger a request.');
    echo "QIQO image reuse/path/configuration tests passed; no network requests.\n";
} finally {
    foreach (['Slike/local.png', 'catalog/qiqo/cached.png', 'Portals/0/Photo/portal.png'] as $file) if (is_file($root . '/' . $file)) unlink($root . '/' . $file);
    foreach (['catalog/qiqo', 'catalog', 'Slike', 'Portals/0/Photo', 'Portals/0', 'Portals', ''] as $directory) if (is_dir($root . '/' . $directory)) rmdir($root . '/' . $directory);
}
