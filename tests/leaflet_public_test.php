<?php

require_once __DIR__ . '/../upload/system/engine/registry.php';
require_once __DIR__ . '/../upload/system/engine/model.php';
require_once __DIR__ . '/../upload/system/engine/controller.php';
require_once __DIR__ . '/../storage/vendor/autoload.php';

$temporary = sys_get_temp_dir() . '/leaflet-public-' . bin2hex(random_bytes(6));
mkdir($temporary, 0700);
mkdir($temporary . '/download', 0700);
mkdir($temporary . '/download/leaflets', 0700);
mkdir($temporary . '/image', 0700);
define('DIR_SYSTEM', __DIR__ . '/../upload/system/');
define('DIR_DOWNLOAD', $temporary . '/download/');
define('DIR_IMAGE', $temporary . '/image/');
define('DB_PREFIX', 'fixture_');
require_once __DIR__ . '/../upload/catalog/model/catalog/leaflet.php';
require_once __DIR__ . '/../upload/catalog/controller/information/leaflet.php';

function leafletCheck($condition, string $message): void {
    if (!$condition) { throw new RuntimeException($message); }
}

final class LeafletFixtureDb {
    public $rows = [];
    public $queries = [];
    public $tableExists = true;
    public function escape($value) { return addslashes($value); }
    public function query($sql) {
        $this->queries[] = $sql;
        if (strpos($sql, 'SHOW TABLES') === 0) {
            $rows = $this->tableExists ? [['table' => DB_PREFIX . 'leaflet']] : [];
        } elseif (preg_match('/WHERE leaflet_id = (\d+)/', $sql, $matches)) {
            $rows = array_values(array_filter($this->rows, function ($row) use ($matches) { return $row['leaflet_id'] === (int)$matches[1]; }));
        } else { $rows = $this->rows; }
        return (object)['rows' => $rows, 'row' => $rows[0] ?? [], 'num_rows' => count($rows)];
    }
}

final class LeafletFixtureLanguage {
    private $strings;
    public function __construct() {
        $_ = ['text_home' => 'Početna'];
        require __DIR__ . '/../upload/catalog/language/hr-hr/information/leaflet.php';
        $this->strings = $_;
    }
    public function get($key) { return $this->strings[$key] ?? $key; }
}

final class LeafletFixtureDocument {
    public function setTitle($value) {}
    public function setDescription($value) {}
    public function addStyle($value) {}
    public function addLink($value, $type) {}
}

final class LeafletFixtureConfig {
    public function get($key) { return $key === 'config_ssl' ? 'https://shop.invalid/' : 'http://shop.invalid/'; }
}

final class LeafletFixtureUrl {
    public function link($route, $arguments = '', $secure = false) {
        return 'https://shop.invalid/index.php?route=' . $route . ($arguments !== '' ? '&' . $arguments : '');
    }
}

final class LeafletFixtureResponse {
    public $output = '';
    public function setOutput($value) { $this->output = $value; }
}

final class LeafletFixtureLoader {
    public $theme = 'basel';
    public $data = [];
    public $notFound = 0;
    private $registry;
    public function __construct($registry) { $this->registry = $registry; }
    public function language($route) {}
    public function model($route) {}
    public function controller($route) {
        if ($route === 'error/not_found') { $this->notFound++; $this->registry->get('response')->setOutput('404'); }
        return '';
    }
    public function view($route, $data) {
        $this->data = $data;
        $loader = new Twig\Loader\FilesystemLoader(__DIR__ . '/../upload/catalog/view/theme/' . $this->theme . '/template');
        $twig = new Twig\Environment($loader, ['autoescape' => false, 'cache' => false]);
        return $twig->render($route . '.twig', $data);
    }
}

try {
    $filename = str_repeat('a', 32) . '.pdf';
    $pdf = "%PDF-1.4\n1 0 obj\n<< /Type /Catalog >>\nendobj\ntrailer\n<< /Root 1 0 R >>\n%%EOF\n";
    file_put_contents(DIR_DOWNLOAD . 'leaflets/' . $filename, $pdf);
    file_put_contents($temporary . '/outside.pdf', $pdf);
    $symlink = str_repeat('b', 32) . '.pdf';
    symlink($temporary . '/outside.pdf', DIR_DOWNLOAD . 'leaflets/' . $symlink);
    mkdir(DIR_IMAGE . 'catalog'); mkdir(DIR_IMAGE . 'catalog/leaflets');
    file_put_contents(DIR_IMAGE . 'catalog/leaflets/cover.png', base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/x8AAwMCAO+aN1sAAAAASUVORK5CYII='));
    $valid = [
        'leaflet_id' => 1, 'title' => 'Letak <script>alert(1)</script> & ponude',
        'published_at' => date('Y-m-d'), 'status' => 1, 'sort_order' => 0,
        'filename' => $filename, 'original_filename' => 'Privatni-naziv.pdf',
        'pdf_size' => strlen($pdf), 'thumbnail' => 'catalog/leaflets/cover.png'
    ];
    $invalid = [
        ['status' => 0],
        ['published_at' => date('Y-m-d', strtotime('+1 day'))],
        ['published_at' => '2026-02-30'],
        ['published_at' => '0000-00-00'],
        ['title' => '  '],
        ['filename' => str_repeat('c', 32) . '.pdf'],
        ['filename' => '../../outside.pdf'],
        ['filename' => $symlink]
    ];
    $db = new LeafletFixtureDb();
    $db->rows = [$valid];
    foreach ($invalid as $offset => $change) { $db->rows[] = array_replace($valid, ['leaflet_id' => $offset + 2], $change); }
    $registry = new Registry(); $registry->set('db', $db);
    $model = new ModelCatalogLeaflet($registry);
    leafletCheck(array_column($model->getLeaflets(), 'leaflet_id') === [1], 'Only published, valid private PDFs may appear publicly.');
    leafletCheck($model->getLeaflet(1) === $valid, 'Today’s leaflet must be immediately available.');
    leafletCheck($model->getLeaflet(0) === [], 'A nonpositive identifier must be rejected.');
    foreach ($db->rows as $row) {
        if ($row['leaflet_id'] !== 1) { leafletCheck($model->getLeaflet($row['leaflet_id']) === [], 'Direct PDF routes must reject unpublished, invalid and unsafe records.'); }
    }
    foreach ($db->queries as $sql) {
        if (strpos($sql, 'SELECT') === 0) {
            leafletCheck(strpos($sql, "status = '1'") !== false && strpos($sql, "published_at <= '" . date('Y-m-d') . "'") !== false, 'Database queries must enforce publication before returning rows.');
        }
    }
    $absentDb = new LeafletFixtureDb(); $absentDb->tableExists = false;
    $absentRegistry = new Registry(); $absentRegistry->set('db', $absentDb);
    leafletCheck((new ModelCatalogLeaflet($absentRegistry))->getLeaflets() === [], 'A deployment without the migration must show an empty page.');
    leafletCheck(count($absentDb->queries) === 1, 'A public request must never create schema.');

    $response = new LeafletFixtureResponse(); $loader = new LeafletFixtureLoader($registry);
    $request = (object)['get' => [], 'server' => ['REQUEST_METHOD' => 'GET']];
    foreach (['model_catalog_leaflet' => $model, 'language' => new LeafletFixtureLanguage(), 'document' => new LeafletFixtureDocument(),
        'config' => new LeafletFixtureConfig(), 'url' => new LeafletFixtureUrl(), 'response' => $response, 'load' => $loader, 'request' => $request] as $key => $value) { $registry->set($key, $value); }
    $controller = new ControllerInformationLeaflet($registry);
    foreach (['basel', 'default'] as $theme) {
        $loader->theme = $theme; $controller->index();
        leafletCheck(strpos($response->output, '<script>') === false && strpos($response->output, '&lt;script&gt;') !== false, 'Leaflet titles must be escaped in ' . $theme . '.');
        leafletCheck(strpos($response->output, 'https://shop.invalid/image/catalog/leaflets/cover.png') !== false, 'A validated public cover must render in ' . $theme . '.');
        leafletCheck(strpos($response->output, 'route=information/leaflet/view&amp;leaflet_id=1') !== false
            && strpos($response->output, 'route=information/leaflet/download&amp;leaflet_id=1') !== false, 'View and download routes must both render in ' . $theme . '.');
        foreach ([$filename, 'Privatni-naziv.pdf', DIR_DOWNLOAD] as $private) { leafletCheck(strpos($response->output, $private) === false, 'Private storage metadata must never enter the page.'); }
        $db->rows = []; $controller->index();
        leafletCheck(strpos($response->output, 'Trenutačno nema objavljenih letaka.') !== false, 'An empty listing needs clear human copy in ' . $theme . '.');
        $db->rows = [$valid];
    }
    $db->rows = [array_replace($valid, ['thumbnail' => '../outside.pdf'])]; $controller->index();
    leafletCheck($loader->data['leaflets'][0]['thumbnail'] === '', 'An invalid cover must use the PDF fallback.');
    foreach (['../1', '0', '1 OR 1=1', ['1']] as $invalidId) {
        $request->get = ['leaflet_id' => $invalidId]; $before = $loader->notFound; $controller->download();
        leafletCheck($loader->notFound === $before + 1, 'Malformed download identifiers must return the normal 404.');
    }
    $db->rows = [array_replace($valid, ['status' => 0])]; $request->get = ['leaflet_id' => '1'];
    $before = $loader->notFound; $controller->view();
    leafletCheck($loader->notFound === $before + 1, 'Unpublished PDF streams must return the normal 404.');
    echo "Public leaflet visibility, private PDF paths, both templates and download guards passed.\n";
} finally {
    $items = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($temporary, FilesystemIterator::SKIP_DOTS), RecursiveIteratorIterator::CHILD_FIRST);
    foreach ($items as $item) {
        if ($item->isDir() && !$item->isLink()) { rmdir($item->getPathname()); } else { unlink($item->getPathname()); }
    }
    rmdir($temporary);
}
