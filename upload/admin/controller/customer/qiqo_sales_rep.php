<?php
class ControllerCustomerQiqoSalesRep extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('customer/qiqo_sales_rep');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('customer/qiqo_sales_rep');

		$this->getList();
	}

	public function add() {
		$this->denyManualMutation();
	}

	public function edit() {
		$this->denyManualMutation();
	}

	public function delete() {
		$this->denyManualMutation();
	}

	protected function getList() {
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'name';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}

		if (isset($this->request->get['page'])) {
			$page = (int)$this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('customer/qiqo_sales_rep', 'user_token=' . $this->session->data['user_token'] . $url, true)
		);

		$data['sales_reps'] = array();

		$filter_data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit' => $this->config->get('config_limit_admin')
		);

		$sales_rep_total = $this->model_customer_qiqo_sales_rep->getTotalSalesReps();
		$results = $this->model_customer_qiqo_sales_rep->getSalesReps($filter_data);

		foreach ($results as $result) {
			$data['sales_reps'][] = array(
				'sales_rep_id'  => $result['sales_rep_id'],
				'code'          => $result['code'],
				'name'          => $result['name'],
				'active'        => $result['active'],
				'date_modified' => date($this->language->get('date_format_short'), strtotime($result['date_modified']))
			);
		}

		if (isset($this->session->data['error_warning'])) {
			$data['error_warning'] = $this->session->data['error_warning'];
			unset($this->session->data['error_warning']);
		} elseif (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];
			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		if (isset($this->request->post['selected'])) {
			$data['selected'] = (array)$this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}

		$url = '';

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['sort_code'] = $this->url->link('customer/qiqo_sales_rep', 'user_token=' . $this->session->data['user_token'] . '&sort=code' . $url, true);
		$data['sort_name'] = $this->url->link('customer/qiqo_sales_rep', 'user_token=' . $this->session->data['user_token'] . '&sort=name' . $url, true);
		$data['sort_active'] = $this->url->link('customer/qiqo_sales_rep', 'user_token=' . $this->session->data['user_token'] . '&sort=active' . $url, true);
		$data['sort_date_modified'] = $this->url->link('customer/qiqo_sales_rep', 'user_token=' . $this->session->data['user_token'] . '&sort=date_modified' . $url, true);

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $sales_rep_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('customer/qiqo_sales_rep', 'user_token=' . $this->session->data['user_token'] . $url . '&page={page}', true);

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($sales_rep_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($sales_rep_total - $this->config->get('config_limit_admin'))) ? $sales_rep_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $sales_rep_total, ceil($sales_rep_total / $this->config->get('config_limit_admin')));

		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('customer/qiqo_sales_rep_list', $data));
	}

	private function denyManualMutation() {
		$this->session->data['error_warning'] = 'Komercijalisti se sinkroniziraju isključivo iz qKomercijalistWeb; ručne izmjene nisu dopuštene.';

		$this->response->redirect($this->url->link('customer/qiqo_sales_rep', 'user_token=' . $this->session->data['user_token'], true));
	}

	protected function getForm() {
		$data['text_form'] = !isset($this->request->get['sales_rep_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['code'])) {
			$data['error_code'] = $this->error['code'];
		} else {
			$data['error_code'] = '';
		}

		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = '';
		}

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('customer/qiqo_sales_rep', 'user_token=' . $this->session->data['user_token'] . $url, true)
		);

		if (!isset($this->request->get['sales_rep_id'])) {
			$data['action'] = $this->url->link('customer/qiqo_sales_rep/add', 'user_token=' . $this->session->data['user_token'] . $url, true);
		} else {
			$data['action'] = $this->url->link('customer/qiqo_sales_rep/edit', 'user_token=' . $this->session->data['user_token'] . '&sales_rep_id=' . $this->request->get['sales_rep_id'] . $url, true);
		}

		$data['cancel'] = $this->url->link('customer/qiqo_sales_rep', 'user_token=' . $this->session->data['user_token'] . $url, true);

		if (isset($this->request->get['sales_rep_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$sales_rep_info = $this->model_customer_qiqo_sales_rep->getSalesRep($this->request->get['sales_rep_id']);
		}

		if (isset($this->request->post['code'])) {
			$data['code'] = $this->request->post['code'];
		} elseif (!empty($sales_rep_info)) {
			$data['code'] = $sales_rep_info['code'];
		} else {
			$data['code'] = '';
		}

		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} elseif (!empty($sales_rep_info)) {
			$data['name'] = $sales_rep_info['name'];
		} else {
			$data['name'] = '';
		}

		if (isset($this->request->post['active'])) {
			$data['active'] = $this->request->post['active'];
		} elseif (!empty($sales_rep_info)) {
			$data['active'] = $sales_rep_info['active'];
		} else {
			$data['active'] = 1;
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('customer/qiqo_sales_rep_form', $data));
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'customer/qiqo_sales_rep')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ((utf8_strlen(trim($this->request->post['code'])) < 1) || (utf8_strlen(trim($this->request->post['code'])) > 64)) {
			$this->error['code'] = $this->language->get('error_code');
		}

		if ((utf8_strlen(trim($this->request->post['name'])) < 2) || (utf8_strlen(trim($this->request->post['name'])) > 255)) {
			$this->error['name'] = $this->language->get('error_name');
		}

		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}

		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'customer/qiqo_sales_rep')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
}
