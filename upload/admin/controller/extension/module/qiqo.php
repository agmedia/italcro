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

                case 'update_image':
                    $count = $this->model_extension_module_qiqo->updateImages();
                    $this->session->data['success'] = "Ažurirano slika: {$count} artikala.";
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

        // Layout
        $data['header']      = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer']      = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('extension/module/qiqo', $data));
    }

}
