<?php
class ControllerInformationLeaflet extends Controller {
    public function index() {
        $this->load->language('information/leaflet');
        $this->load->model('catalog/leaflet');
        $this->document->setTitle($this->language->get('heading_title'));
        $this->document->setDescription($this->language->get('text_intro'));
        $this->document->addStyle('catalog/view/theme/default/stylesheet/leaflet.css');
        $this->document->addLink($this->url->link('information/leaflet'), 'canonical');

        $data = [];
        foreach (['heading_title', 'text_intro', 'text_empty', 'text_published', 'text_pdf', 'button_view', 'button_download'] as $key) {
            $data[$key] = $this->language->get($key);
        }
        $data['breadcrumbs'] = [
            ['text' => $this->language->get('text_home'), 'href' => $this->url->link('common/home')],
            ['text' => $data['heading_title'], 'href' => $this->url->link('information/leaflet')]
        ];
        $imageBase = rtrim((string)($this->config->get('config_ssl') ?: $this->config->get('config_url')), '/') . '/image/';
        $data['leaflets'] = [];
        foreach ($this->model_catalog_leaflet->getLeaflets() as $leaflet) {
            $id = (int)$leaflet['leaflet_id'];
            $thumbnail = (string)($leaflet['thumbnail'] ?? '');
            $cover = LeafletFiles::validThumbnail($thumbnail)
                ? $imageBase . implode('/', array_map('rawurlencode', explode('/', $thumbnail))) : '';
            $bytes = max(0, (int)($leaflet['pdf_size'] ?? 0));
            $data['leaflets'][] = [
                'title' => $leaflet['title'],
                'published_at' => $leaflet['published_at'],
                'date' => date($this->language->get('date_format'), strtotime($leaflet['published_at'])),
                'thumbnail' => $cover,
                'size' => $bytes > 0 ? ($bytes >= 1048576 ? number_format($bytes / 1048576, 1) . ' MB' : max(1, (int)ceil($bytes / 1024)) . ' KB') : '',
                'view' => $this->url->link('information/leaflet/view', 'leaflet_id=' . $id, true),
                'download' => $this->url->link('information/leaflet/download', 'leaflet_id=' . $id, true)
            ];
        }

        foreach (['column_left', 'column_right', 'content_top', 'content_bottom', 'footer', 'header'] as $part) {
            $data[$part] = $this->load->controller('common/' . $part);
        }
        $this->response->setOutput($this->load->view('information/leaflet', $data));
    }

    public function view() {
        $this->streamPdf('inline');
    }

    public function download() {
        $this->streamPdf('attachment');
    }

    private function streamPdf(string $disposition): void {
        $this->load->model('catalog/leaflet');
        $requestedId = $this->request->get['leaflet_id'] ?? '';
        $id = is_string($requestedId) || is_int($requestedId) ? (string)$requestedId : '';
        $leaflet = preg_match('/^[1-9][0-9]*$/D', $id) ? $this->model_catalog_leaflet->getLeaflet((int)$id) : [];
        $path = $leaflet ? $this->model_catalog_leaflet->pdfPath($leaflet) : null;
        $file = $path !== null ? @fopen($path, 'rb') : false;
        if (!$file) {
            $this->load->controller('error/not_found');
            return;
        }
        $stat = fstat($file);
        if (!$stat || $stat['size'] <= 0 || headers_sent()) {
            fclose($file);
            $this->load->controller('error/not_found');
            return;
        }

        $original = basename(str_replace('\\', '/', (string)$leaflet['original_filename']));
        $original = trim((string)preg_replace('/[\x00-\x1F\x7F]/', '', $original));
        if ($original === '' || strtolower(pathinfo($original, PATHINFO_EXTENSION)) !== 'pdf') {
            $original = 'letak-' . (int)$leaflet['leaflet_id'] . '.pdf';
        }
        while (ob_get_level() > 0) {
            if (!@ob_end_clean()) { break; }
        }
        header('Content-Type: application/pdf');
        header('Content-Disposition: ' . $disposition . '; filename="letak-' . (int)$leaflet['leaflet_id'] . '.pdf"; filename*=UTF-8\'\'' . rawurlencode($original));
        header('Content-Length: ' . (int)$stat['size']);
        header('X-Content-Type-Options: nosniff');
        header('Cache-Control: no-store, max-age=0');
        if (($this->request->server['REQUEST_METHOD'] ?? 'GET') !== 'HEAD') {
            fpassthru($file);
        }
        fclose($file);
        exit;
    }
}
