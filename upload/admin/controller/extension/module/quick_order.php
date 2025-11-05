<?php
class ControllerExtensionModuleQuickOrder extends Controller {
    private $error = [];

    public function index() {
        $this->load->language('extension/module/quick_order');
        $this->document->setTitle($this->language->get('heading_title'));
        $this->load->model('setting/setting');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->model_setting_setting->editSetting('module_quick_order', $this->request->post);
            $this->session->data['success'] = $this->language->get('text_success');
            $this->response->redirect($this->url->link('marketplace/extension','user_token=' . $this->session->data['user_token'].'&type=module', true));
        }

        $data['heading_title']   = $this->language->get('heading_title');
        $data['text_edit']       = $this->language->get('text_edit');
        $data['entry_status']    = $this->language->get('entry_status');
        $data['button_save']     = $this->language->get('button_save');
        $data['button_cancel']   = $this->language->get('button_cancel');

        $data['error_warning'] = $this->error['warning'] ?? '';

        $data['breadcrumbs'] = [
            ['text'=>$this->language->get('text_home'),'href'=>$this->url->link('common/dashboard','user_token='.$this->session->data['user_token'],true)],
            ['text'=>$this->language->get('text_extension'),'href'=>$this->url->link('marketplace/extension','user_token='.$this->session->data['user_token'].'&type=module',true)],
            ['text'=>$this->language->get('heading_title'),'href'=>$this->url->link('extension/module/quick_order','user_token='.$this->session->data['user_token'],true)]
        ];

        $data['action'] = $this->url->link('extension/module/quick_order','user_token='.$this->session->data['user_token'],true);
        $data['cancel'] = $this->url->link('marketplace/extension','user_token='.$this->session->data['user_token'].'&type=module',true);

        $data['module_quick_order_status'] = $this->request->post['module_quick_order_status'] ??
            $this->config->get('module_quick_order_status');

        $data['header']      = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer']      = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('extension/module/quick_order', $data));
    }

    protected function validate() {
        if (!$this->user->hasPermission('modify', 'extension/module/quick_order')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        return !$this->error;
    }
}
