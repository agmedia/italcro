<?php
class ControllerCatalogLeaflet extends Controller {
    private $error = array();

    private function initialize() {
        $this->load->language('catalog/leaflet');
        $this->document->setTitle($this->language->get('heading_title'));
        if (!$this->user->hasPermission('access', 'catalog/leaflet')) {
            $this->response->addHeader('HTTP/1.1 403 Forbidden');
            $this->response->setOutput($this->language->get('error_permission')); return false;
        }
        $this->load->model('catalog/leaflet');
        require_once DIR_SYSTEM . 'library/leaflet/files.php';
        if (empty($this->session->data['leaflet_csrf'])) { $this->session->data['leaflet_csrf'] = bin2hex(random_bytes(24)); }
        return true;
    }

    public function index() { if ($this->initialize()) { $this->getList(); } }
    public function add() { $this->save(0); }
    public function edit() { $this->save((int)($this->request->get['leaflet_id'] ?? 0)); }

    private function save($id) {
        if (!$this->initialize()) { return; }
        // OpenCart Request::clean HTML-encodes incoming strings. Store raw
        // values once; templates escape them at their output boundary.
        if (($this->request->server['REQUEST_METHOD'] ?? '') === 'POST') {
            foreach (['title', 'thumbnail'] as $field) {
                if (isset($this->request->post[$field]) && is_string($this->request->post[$field])) {
                    $this->request->post[$field] = html_entity_decode($this->request->post[$field], ENT_QUOTES, 'UTF-8');
                }
            }
        }
        $old = $id ? $this->model_catalog_leaflet->getLeaflet($id) : array();
        if ($id && !$old) { $this->response->redirect($this->link('catalog/leaflet')); return; }
        if (($this->request->server['REQUEST_METHOD'] ?? '') === 'POST' && $this->validateForm($old)) {
            $data = $this->request->post;
            try {
                $changed = isset($this->request->files['pdf']) && (int)$this->request->files['pdf']['error'] !== UPLOAD_ERR_NO_FILE;
                $stored = $changed ? LeafletFiles::storeUpload($this->request->files['pdf']) : $old;
                foreach (['filename', 'original_filename', 'pdf_size'] as $field) { $data[$field] = $stored[$field]; }
                $data['title'] = trim($data['title']);
                $manual = (string)($data['thumbnail'] ?? '');
                if (($data['cover_mode'] ?? 'auto') === 'manual') {
                    $data['thumbnail'] = $manual;
                } else {
                    $data['thumbnail'] = LeafletFiles::thumbnail($data['filename']);
                    if ($data['thumbnail'] === '' && $manual !== '' && (!$changed || $manual !== ($old['thumbnail'] ?? '')) && LeafletFiles::validThumbnail($manual)) {
                        $data['thumbnail'] = $manual;
                    }
                    if ($data['thumbnail'] === '') { $this->session->data['leaflet_warning'] = $this->language->get('text_cover_unavailable'); }
                }
                if ($id) { $this->model_catalog_leaflet->editLeaflet($id, $data); }
                else { $id = $this->model_catalog_leaflet->addLeaflet($data); }
                $this->session->data['success'] = $this->language->get('text_success');
                $this->response->redirect($this->link('catalog/leaflet')); return;
            } catch (Throwable $error) {
                $this->error['warning'] = $this->language->get($error->getMessage() === 'leaflet_pdf' ? 'error_pdf' : 'error_storage');
            }
        }
        $this->getForm($id, $old);
    }

    public function delete() {
        if (!$this->initialize()) { return; }
        if ($this->validateMutation()) {
            try {
                foreach ((array)($this->request->post['selected'] ?? []) as $id) { $this->model_catalog_leaflet->deleteLeaflet((int)$id); }
                $this->session->data['success'] = $this->language->get('text_success');
                $this->response->redirect($this->link('catalog/leaflet')); return;
            } catch (Throwable $error) { $this->error['warning'] = $this->language->get('error_storage'); }
        }
        $this->getList();
    }

    public function download() {
        if (!$this->initialize()) { return; }
        $row = $this->model_catalog_leaflet->getLeaflet((int)($this->request->get['leaflet_id'] ?? 0));
        $path = $row ? LeafletFiles::pdfPath($row['filename']) : null;
        if (!$path) { $this->response->addHeader('HTTP/1.1 404 Not Found'); $this->response->setOutput($this->language->get('error_pdf_missing')); return; }
        $this->response->addHeader('Content-Type: application/pdf');
        $this->response->addHeader('Content-Disposition: attachment; filename="letak-' . (int)$row['leaflet_id'] . '.pdf"');
        $this->response->addHeader('X-Content-Type-Options: nosniff');
        $this->response->addHeader('Cache-Control: private, no-store');
        $this->response->setOutput(file_get_contents($path));
    }

    private function validateMutation() {
        if (!$this->user->hasPermission('modify', 'catalog/leaflet')) { $this->error['warning'] = $this->language->get('error_permission'); }
        elseif (($this->request->server['REQUEST_METHOD'] ?? '') !== 'POST'
            || !hash_equals((string)$this->session->data['leaflet_csrf'], (string)($this->request->post['csrf'] ?? ''))) {
            $this->error['warning'] = $this->language->get('error_csrf');
        }
        return !$this->error;
    }

    private function validateForm(array $old) {
        if (!$this->validateMutation()) { return false; }
        $title = trim((string)($this->request->post['title'] ?? ''));
        $length = function_exists('utf8_strlen') ? utf8_strlen($title) : strlen($title);
        if ($length < 1 || $length > 255) { $this->error['title'] = $this->language->get('error_title'); }
        $date = (string)($this->request->post['published_at'] ?? '');
        $parsed = DateTime::createFromFormat('!Y-m-d', $date);
        if (!preg_match('/^[1-9][0-9]{3}-[0-9]{2}-[0-9]{2}$/D', $date)
            || !$parsed || $parsed->format('Y-m-d') !== $date) { $this->error['published_at'] = $this->language->get('error_date'); }
        $thumbnail = (string)($this->request->post['thumbnail'] ?? '');
        if (strlen($thumbnail) > 255 || ($thumbnail !== '' && !LeafletFiles::validThumbnail($thumbnail))) { $this->error['thumbnail'] = $this->language->get('error_thumbnail'); }
        $upload = $this->request->files['pdf'] ?? ['error' => UPLOAD_ERR_NO_FILE];
        if ((int)$upload['error'] === UPLOAD_ERR_NO_FILE) {
            if (!$old || !LeafletFiles::pdfPath($old['filename'])) { $this->error['pdf'] = $this->language->get('error_pdf_required'); }
        } elseif ((int)$upload['error'] !== UPLOAD_ERR_OK) {
            $this->error['pdf'] = $this->language->get('error_upload');
        } elseif (!isset($upload['tmp_name']) || !is_uploaded_file($upload['tmp_name'])
            || !preg_match('/\.pdf$/iD', (string)$upload['name']) || !LeafletFiles::validPdf($upload['tmp_name'])) {
            $this->error['pdf'] = $this->language->get('error_pdf');
        }
        if ($this->error && !isset($this->error['warning'])) { $this->error['warning'] = $this->language->get('error_warning'); }
        return !$this->error;
    }

    private function link($route, $extra = '') { return $this->url->link($route, 'user_token=' . $this->session->data['user_token'] . $extra, true); }
    private function publicLink($id) {
        $base = defined('HTTPS_CATALOG') ? HTTPS_CATALOG : HTTP_CATALOG;
        return rtrim($base, '/') . '/index.php?route=information/leaflet/download&leaflet_id=' . (int)$id;
    }

    private function coverUrl($relative, $width, $height) {
        if (!LeafletFiles::validThumbnail((string)$relative)) { return $this->model_tool_image->resize('placeholder.png', $width, $height); }
        $file = realpath(rtrim(DIR_IMAGE, '/\\') . '/' . $relative);
        $info = @getimagesize($file);
        if ($info && $info[2] === IMAGETYPE_WEBP) {
            $root = rtrim(realpath(DIR_IMAGE), '/\\') . DIRECTORY_SEPARATOR;
            $path = substr($file, strlen($root));
            $base = defined('HTTPS_CATALOG') ? HTTPS_CATALOG : HTTP_CATALOG;
            return rtrim($base, '/') . '/image/' . implode('/', array_map('rawurlencode', explode('/', str_replace('\\', '/', $path))));
        }
        return $this->model_tool_image->resize($relative, $width, $height);
    }

    private function baseData() {
        $data = $this->language->all();
        $data['csrf'] = $this->session->data['leaflet_csrf'];
        $data['user_token'] = $this->session->data['user_token'];
        $data['error_warning'] = $this->error['warning'] ?? '';
        $data['success'] = $this->session->data['success'] ?? '';
        $data['notice'] = $this->session->data['leaflet_warning'] ?? '';
        unset($this->session->data['success'], $this->session->data['leaflet_warning']);
        $data['breadcrumbs'] = [['text' => $this->language->get('text_home'), 'href' => $this->link('common/dashboard')], ['text' => $this->language->get('heading_title'), 'href' => $this->link('catalog/leaflet')]];
        return $data;
    }

    private function getList() {
        $data = $this->baseData();
        $page = max(1, (int)($this->request->get['page'] ?? 1));
        $limit = max(1, (int)$this->config->get('config_limit_admin'));
        $sort = (string)($this->request->get['sort'] ?? 'published_at');
        $order = ($this->request->get['order'] ?? 'DESC') === 'ASC' ? 'ASC' : 'DESC';
        $data['add'] = $this->link('catalog/leaflet/add'); $data['delete'] = $this->link('catalog/leaflet/delete');
        $data['leaflets'] = [];
        $this->load->model('tool/image');
        foreach ($this->model_catalog_leaflet->getLeaflets(['start' => ($page - 1) * $limit, 'limit' => $limit, 'sort' => $sort, 'order' => $order]) as $row) {
            $row['thumb'] = $this->coverUrl($row['thumbnail'], 70, 95);
            $row['edit'] = $this->link('catalog/leaflet/edit', '&leaflet_id=' . (int)$row['leaflet_id']);
            $row['download'] = $this->link('catalog/leaflet/download', '&leaflet_id=' . (int)$row['leaflet_id']);
            $row['public_download'] = $this->publicLink($row['leaflet_id']);
            $data['leaflets'][] = $row;
        }
        $pagination = new Pagination(); $pagination->total = $this->model_catalog_leaflet->getTotalLeaflets();
        $pagination->page = $page; $pagination->limit = $limit;
        $pagination->url = $this->link('catalog/leaflet', '&page={page}'); $data['pagination'] = $pagination->render();
        $data['results'] = sprintf($this->language->get('text_total'), $pagination->total);
        $this->render('catalog/leaflet_list', $data);
    }

    private function getForm($id, array $old) {
        $data = $this->baseData();
        $data['text_form'] = $this->language->get($id ? 'text_edit' : 'text_add');
        $defaults = ['title' => '', 'published_at' => date('Y-m-d'), 'status' => 1, 'sort_order' => 0, 'thumbnail' => ''];
        foreach ($defaults as $field => $default) { $data[$field] = $this->request->post[$field] ?? $old[$field] ?? $default; }
        foreach (['title', 'published_at', 'thumbnail', 'pdf'] as $field) { $data['error_' . $field] = $this->error[$field] ?? ''; }
        $data['cover_mode'] = $this->request->post['cover_mode'] ?? ((!empty($old['thumbnail']) && strpos($old['thumbnail'], 'catalog/leaflets/') !== 0) ? 'manual' : 'auto');
        $data['pdf_name'] = $old['original_filename'] ?? '';
        $data['pdf_download'] = $id ? $this->link('catalog/leaflet/download', '&leaflet_id=' . $id) : '';
        $data['public_download'] = $id ? $this->publicLink($id) : '';
        $data['action'] = $this->link($id ? 'catalog/leaflet/edit' : 'catalog/leaflet/add', $id ? '&leaflet_id=' . $id : '');
        $data['cancel'] = $this->link('catalog/leaflet');
        $this->load->model('tool/image');
        $data['placeholder'] = $this->model_tool_image->resize('placeholder.png', 150, 200);
        $data['thumb'] = $this->coverUrl($data['thumbnail'], 150, 200);
        $this->render('catalog/leaflet_form', $data);
    }

    private function render($template, array $data) {
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');
        $this->response->setOutput($this->load->view($template, $data));
    }
}
