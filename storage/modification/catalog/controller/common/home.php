<?php
class ControllerCommonHome extends Controller {
	public function index() {
		
		 $this->document->setTitle(nl2br($this->config->get('config_meta_title' . $this->config->get('config_language_id'))));
	
		$this->document->setDescription($this->config->get('config_meta_description'));
		$this->document->setKeywords($this->config->get('config_meta_keyword'));

		if (isset($this->request->get['route'])) {
			$this->document->addLink($this->config->get('config_url'), 'canonical');
		}

		

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');

			$this->load->model('extension/module/hb_seo_snippets');	
			$this->model_extension_module_hb_seo_snippets->home_social();
            $this->model_extension_module_hb_seo_snippets->knowledge_graph();
		    $this->model_extension_module_hb_seo_snippets->site_search();
			$this->model_extension_module_hb_seo_snippets->local_business();
			
		$data['header'] = $this->load->controller('common/header');

		$this->response->setOutput($this->load->view('common/home', $data));
	}
}
