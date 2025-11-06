<?php

class ControllerExtensionModuleQiqo extends Controller
{

    private $error = [];


    public function index()
    {
        $this->load->language('extension/module/qiqo');
        $this->document->setTitle($this->language->get('heading_title'));
        $this->load->model('extension/module/qiqo');

        if ($this->request->server['REQUEST_METHOD'] == 'POST' && isset($this->request->post['action'])) {

            switch ($this->request->post['action']) {
                case 'import':
                    $count = $this->model_extension_module_qiqo->importArticles();
                    $this->session->data['success'] = "Import završen. Uvezeno {$count} novih artikala.";
                    break;

                case 'update_qty':
                    $count = $this->model_extension_module_qiqo->updateQuantities();
                    $this->session->data['success'] = "Ažurirano količina: {$count} artikala.";
                    break;

                case 'update_price':
                    $count = $this->model_extension_module_qiqo->updatePrices();
                    $this->session->data['success'] = "Ažurirano cijena: {$count} artikala.";
                    break;

                case 'update_assets':
                    $count = $this->model_extension_module_qiqo->updateAssets();
                    $this->session->data['success'] = "Sinkronizacija dovršena ({$count} datoteka).";
                    $this->response->redirect($this->url->link('extension/module/qiqo', 'user_token=' . $this->session->data['user_token'], true));
                    break;

                case 'import_brands':
                    $count = $this->model_extension_module_qiqo->importBrands();
                    $this->session->data['success'] = "Dodano {$count} novih proizvođača (brendova).";
                    break;

                case 'link_brands':
                    $only_empty = !empty($this->request->post['only_empty']); // true ako je checkbox označen
                    $count = $this->model_extension_module_qiqo->linkProductsToBrands($only_empty);
                    $mode  = $only_empty ? 'samo prazni' : 'svi proizvodi (force)';
                    $this->session->data['success'] = "Povezano {$count} proizvoda ({$mode}).";
                    break;

                case 'update_names':
                    $count = $this->model_extension_module_qiqo->updateProductNamesFromERP();
                    $this->session->data['success'] = "Nazivi artikala ažurirani za {$count} proizvoda (dimmodel).";
                    $this->response->redirect($this->url->link('extension/module/qiqo', 'user_token=' . $this->session->data['user_token'], true));
                    break;

                case 'link_related':
                    $count = $this->model_extension_module_qiqo->linkRelatedByPicpath();
                    $this->session->data['success'] = "Dodano {$count} povezanih proizvoda (prema istom picpath).";
                    $this->response->redirect($this->url->link('extension/module/qiqo', 'user_token=' . $this->session->data['user_token'], true));
                    break;


                case 'clear_log':
                    $log_file = DIR_LOGS . 'qiqo.log';
                    if (file_exists($log_file)) {
                        file_put_contents($log_file, ''); // isprazni log
                        $this->session->data['success'] = 'Log je uspješno obrisan.';
                    } else {
                        $this->session->data['error'] = 'Log datoteka ne postoji.';
                    }
                    $this->response->redirect($this->url->link('extension/module/qiqo', 'user_token=' . $this->session->data['user_token'], true));
                    break;

            }

            $this->response->redirect($this->url->link('extension/module/qiqo', 'user_token=' . $this->session->data['user_token'], true));
        }

        $data['heading_title'] = $this->language->get('heading_title');
        $data['action']        = $this->url->link('extension/module/qiqo', 'user_token=' . $this->session->data['user_token'], true);
        $data['cancel']        = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true);
        $data['success']       = $this->session->data['success'] ?? '';
        unset($this->session->data['success']);

        $data['last_log'] = $this->model_extension_module_qiqo->getLastLog();
        $data['upload_action'] = $this->url->link('extension/module/qiqo/uploadLogos', 'user_token=' . $this->session->data['user_token'], true);

        // Layout
        $data['header']      = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer']      = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('extension/module/qiqo', $data));
    }


    public function uploadLogos()
    {
        $this->load->language('extension/module/qiqo');
        $this->load->model('extension/module/qiqo');

        $upload_dir = DIR_STORAGE . 'upload/logo-brands/';

        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        // ZIP upload
        if (!empty($this->request->files['zip_file']['name'])) {
            $zip = new ZipArchive();
            $tmp_name = $this->request->files['zip_file']['tmp_name'];

            if ($zip->open($tmp_name) === true) {
                $zip->extractTo($upload_dir);
                $zip->close();
                $this->session->data['success'] = 'ZIP datoteka uspješno raspakirana u ' . $upload_dir;
            } else {
                $this->session->data['error'] = 'Ne mogu otvoriti ZIP datoteku.';
            }
        }

        // Multiple file upload
        if (!empty($this->request->files['images'])) {
            foreach ($this->request->files['images']['tmp_name'] as $i => $tmp) {
                $name = $this->request->files['images']['name'][$i];
                $ext  = strtolower(pathinfo($name, PATHINFO_EXTENSION));
                if (!in_array($ext, ['jpg','jpeg','png'])) continue;

                $dest = $upload_dir . basename($name);

                // Ako već postoji, provjeri hash
                if (file_exists($dest)) {
                    $old_hash = sha1_file($dest);
                    $new_hash = sha1_file($tmp);
                    if ($old_hash === $new_hash) {
                        continue; // ista slika, preskoči
                    }
                }

                move_uploaded_file($tmp, $dest);
            }

            $this->session->data['success'] = 'Slike uspješno uploadane u ' . $upload_dir;
        }

        $this->response->redirect($this->url->link('extension/module/qiqo', 'user_token=' . $this->session->data['user_token'], true));
    }


}
