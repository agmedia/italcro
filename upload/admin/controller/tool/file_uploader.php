<?php
class ControllerToolFileUploader extends Controller {
    private $error = array();

    public function index() {
        $this->load->language('tool/file_uploader');

        $this->document->setTitle($this->language->get('heading_title'));

        $data['heading_title'] = $this->language->get('heading_title');
        $data['text_intro']    = $this->language->get('text_intro');
        $data['text_path']     = sprintf($this->language->get('text_path'), defined('DIR_PORTALS') ? DIR_PORTALS : 'DIR_PORTALS not defined');
        $data['entry_file']    = $this->language->get('entry_file');
        $data['button_upload'] = $this->language->get('button_upload');

        if (isset($this->session->data['error'])) {
            $data['error_warning'] = $this->session->data['error'];
            unset($this->session->data['error']);
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->session->data['success'])) {
            $data['success'] = $this->session->data['success'];
            unset($this->session->data['success']);
        } else {
            $data['success'] = '';
        }

        $data['action_upload'] = $this->url->link('tool/file_uploader/upload', 'user_token=' . $this->session->data['user_token'], true);
        $data['href_dashboard'] = $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true);
        $data['user_token'] = $this->session->data['user_token'];

        $data['header']      = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer']      = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('tool/file_uploader', $data));
    }

    public function upload() {
        $this->load->language('tool/file_uploader');

        if (!$this->user->hasPermission('modify', 'tool/file_uploader')) {
            $this->session->data['error'] = $this->language->get('error_permission');
            $this->response->redirect($this->url->link('tool/file_uploader', 'user_token=' . $this->session->data['user_token'], true));
            return;
        }

        if (!defined('DIR_PORTALS')) {
            $this->session->data['error'] = 'DIR_PORTALS konstanta nije definirana u config.php.';
            $this->response->redirect($this->url->link('tool/file_uploader', 'user_token=' . $this->session->data['user_token'], true));
            return;
        }

        if (empty($this->request->files['file']['name'])) {
            $this->session->data['error'] = $this->language->get('error_no_file');
            $this->response->redirect($this->url->link('tool/file_uploader', 'user_token=' . $this->session->data['user_token'], true));
            return;
        }

        $file = $this->request->files['file'];

        $allowed_ext = array('zip','rar','jpg','jpeg','png','pdf');
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        if (!in_array($ext, $allowed_ext)) {
            $this->session->data['error'] = sprintf($this->language->get('error_extension'), $ext);
            $this->response->redirect($this->url->link('tool/file_uploader', 'user_token=' . $this->session->data['user_token'], true));
            return;
        }

        if ($file['error'] != UPLOAD_ERR_OK) {
            $this->session->data['error'] = sprintf($this->language->get('error_upload'), $file['error']);
            $this->response->redirect($this->url->link('tool/file_uploader', 'user_token=' . $this->session->data['user_token'], true));
            return;
        }

        $target_dir = rtrim(DIR_PORTALS, '/\\') . DIRECTORY_SEPARATOR;

        if (!is_dir($target_dir)) {
            if (!mkdir($target_dir, 0755, true)) {
                $this->session->data['error'] = 'Ne mogu kreirati direktorij: ' . $target_dir;
                $this->response->redirect($this->url->link('tool/file_uploader', 'user_token=' . $this->session->data['user_token'], true));
                return;
            }
        }

        // očisti ime, ali ga NE mijenjaj
        $final_name = preg_replace('/[^a-zA-Z0-9_\.\-]/', '_', $file['name']);

        $target_file = $target_dir . $final_name;

// Ako fajl već postoji → pregazi ga
        if (file_exists($target_file)) {
            unlink($target_file);
        }

        if (!move_uploaded_file($file['tmp_name'], $target_file)) {
            $this->session->data['error'] = 'Ne mogu premjestiti uploadani fajl u: ' . $target_file;
            $this->response->redirect($this->url->link('tool/file_uploader', 'user_token=' . $this->session->data['user_token'], true));
            return;
        }

        $ext = strtolower(pathinfo($final_name, PATHINFO_EXTENSION));

        if ($ext === 'zip') {
            $result = $this->extractZip($target_file, $target_dir);
            if ($result['success']) {
                $this->session->data['success'] = sprintf($this->language->get('text_zip_success'), $final_name, $result['folder']);
            } else {
                $this->session->data['error'] = $result['error'];
            }
        } elseif ($ext === 'rar') {
            $result = $this->extractRar($target_file, $target_dir);
            if ($result['success']) {
                $this->session->data['success'] = sprintf($this->language->get('text_rar_success'), $final_name, $result['folder']);
            } else {
                $this->session->data['error'] = $result['error'];
            }
        } else {
            $this->session->data['success'] = sprintf($this->language->get('text_file_success'), $final_name);
        }

        $this->response->redirect($this->url->link('tool/file_uploader', 'user_token=' . $this->session->data['user_token'], true));
    }

    private function extractZip($file, $base_dir) {
        if (!class_exists('ZipArchive')) {
            return array(
                'success' => false,
                'error'   => 'ZipArchive ekstenzija nije dostupna na serveru.'
            );
        }

        $zip = new ZipArchive();
        if ($zip->open($file) === TRUE) {
            $folder_name  = pathinfo($file, PATHINFO_FILENAME);
            $extract_path = rtrim($base_dir, '/\\') . DIRECTORY_SEPARATOR . $folder_name . DIRECTORY_SEPARATOR;

            if (!is_dir($extract_path)) {
                mkdir($extract_path, 0755, true);
            }

            $zip->extractTo($extract_path);
            $zip->close();

            return array(
                'success' => true,
                'folder'  => $extract_path
            );
        } else {
            return array(
                'success' => false,
                'error'   => 'Ne mogu otvoriti ZIP arhivu: ' . basename($file)
            );
        }
    }

    private function extractRar($file, $base_dir) {
        $unrar_path = trim(@shell_exec('which unrar'));

        if (!$unrar_path) {
            return array(
                'success' => false,
                'error'   => 'UNRAR alat nije instaliran na serveru ili "which unrar" ne vraća putanju.'
            );
        }

        $folder_name  = pathinfo($file, PATHINFO_FILENAME);
        $extract_path = rtrim($base_dir, '/\\') . DIRECTORY_SEPARATOR . $folder_name . DIRECTORY_SEPARATOR;

        if (!is_dir($extract_path)) {
            mkdir($extract_path, 0755, true);
        }

        $cmd = escapeshellcmd($unrar_path . ' x -o+ ' . $file . ' ' . $extract_path);
        @shell_exec($cmd);

        $has_files = false;
        if (is_dir($extract_path)) {
            $files = scandir($extract_path);
            foreach ($files as $f) {
                if ($f != '.' && $f != '..') {
                    $has_files = true;
                    break;
                }
            }
        }

        if ($has_files) {
            return array(
                'success' => true,
                'folder'  => $extract_path
            );
        } else {
            return array(
                'success' => false,
                'error'   => 'Pokušao sam raspakirati RAR, ali izgleda da nije uspjelo ili je arhiva prazna.'
            );
        }
    }
}
