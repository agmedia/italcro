<?php
// Endpoint authorization and idempotent dispatch without any real worker or ERP call.
require_once __DIR__ . '/../upload/system/engine/registry.php';
require_once __DIR__ . '/../upload/system/engine/controller.php';
$root = sys_get_temp_dir() . '/qiqo-admin-' . bin2hex(random_bytes(6));
mkdir($root . '/upload/system/library/qiqo', 0700, true);
symlink(realpath(__DIR__ . '/../upload/system/library/qiqo/discount_job.php'), $root . '/upload/system/library/qiqo/discount_job.php');
define('DIR_SYSTEM', $root . '/upload/system/');
require_once __DIR__ . '/../upload/admin/controller/extension/module/qiqo.php';
class AdminJobResponse {
    public $headers = []; public $output;
    public function addHeader($value) { $this->headers[] = $value; }
    public function setOutput($value) { $this->output = json_decode($value, true); }
}
class AdminJobUser {
    public $id = 17; public $allowed = true;
    public function getId() { return $this->id; }
    public function hasPermission($kind, $route) { return $this->allowed; }
}
class AdminJobController extends ControllerExtensionModuleQiqo {
    public $launches = 0;
    protected function launchDiscountJob(string $root, string $id): bool { ++$this->launches; return true; }
}
function adminJobAssert($condition, $message) { if (!$condition) throw new RuntimeException($message); }
function adminJobCleanup($path) {
    if (is_link($path) || is_file($path)) { unlink($path); return; }
    foreach (new FilesystemIterator($path) as $child) adminJobCleanup($child->getPathname());
    rmdir($path);
}
try {
    $r = new Registry();
    $request = (object)['server' => ['REQUEST_METHOD' => 'POST'], 'post' => [], 'get' => []];
    $session = (object)['data' => ['qiqo_discount_job_csrf' => 'expected-secret']];
    $response = new AdminJobResponse(); $user = new AdminJobUser();
    foreach (['request' => $request, 'session' => $session, 'response' => $response, 'user' => $user] as $key => $value) $r->set($key, $value);
    $controller = new AdminJobController($r);
    $controller->discountJobStart();
    adminJobAssert(!$response->output['success'] && $controller->launches === 0 && !is_dir($root . '/.qiqo-private'), 'Missing CSRF must not create or launch a job.');
    $request->post['csrf'] = 'expected-secret'; $user->allowed = false;
    $controller->discountJobStart();
    adminJobAssert(!$response->output['success'] && $controller->launches === 0, 'Modify permission must be required.');
    $user->allowed = true; $request->server['REQUEST_METHOD'] = 'GET';
    $controller->discountJobStart();
    adminJobAssert(!$response->output['success'] && $controller->launches === 0, 'GET must never start an import.');
    $request->server['REQUEST_METHOD'] = 'POST';
    $controller->discountJobStart();
    adminJobAssert($response->output['success'] && $controller->launches === 1, 'An authorized POST must dispatch one job.');
    $id = $response->output['job']['id'];
    $controller->discountJobStart();
    adminJobAssert($response->output['success'] && $response->output['job']['id'] === $id && $controller->launches === 1, 'Repeated start must resume the existing job without launching another worker.');
    $request->get['job_id'] = $id;
    $controller->discountJobStatus();
    adminJobAssert($response->output['success'], 'Owner may read job status.');
    $user->id = 18;
    $controller->discountJobStatus();
    adminJobAssert(!$response->output['success'] && !isset($response->output['job']), 'Other users must not see private job status.');
    $controller->discountJobStart();
    adminJobAssert(!$response->output['success'] && $controller->launches === 1, 'A different owner must not relaunch or adopt an active job.');
    $request->get['job_id'] = '../../env.php';
    $controller->discountJobStatus();
    adminJobAssert(!$response->output['success'], 'Status IDs must not accept paths.');
    echo "QIQO discount admin endpoint tests passed.\n";
} finally { adminJobCleanup($root); }
