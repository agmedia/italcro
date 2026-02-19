<?php
class ControllerCustomerCustomerApproval extends Controller {
	public function index() {
		$this->load->language('customer/customer_approval');

		$this->document->setTitle($this->language->get('heading_title'));

		if (isset($this->request->get['filter_name'])) {
			$filter_name = $this->request->get['filter_name'];
		} else {
			$filter_name = '';
		}

		if (isset($this->request->get['filter_email'])) {
			$filter_email = $this->request->get['filter_email'];
		} else {
			$filter_email = '';
		}

		if (isset($this->request->get['filter_customer_group_id'])) {
			$filter_customer_group_id = $this->request->get['filter_customer_group_id'];
		} else {
			$filter_customer_group_id = '';
		}

		if (isset($this->request->get['filter_type'])) {
			$filter_type = $this->request->get['filter_type'];
		} else {
			$filter_type = '';
		}

		if (isset($this->request->get['filter_date_added'])) {
			$filter_date_added = $this->request->get['filter_date_added'];
		} else {
			$filter_date_added = '';
		}

		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_email'])) {
			$url .= '&filter_email=' . urlencode(html_entity_decode($this->request->get['filter_email'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_customer_group_id'])) {
			$url .= '&filter_customer_group_id=' . $this->request->get['filter_customer_group_id'];
		}

		if (isset($this->request->get['filter_type'])) {
			$url .= '&filter_type=' . $this->request->get['filter_type'];
		}

		if (isset($this->request->get['filter_date_added'])) {
			$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
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
			'href' => $this->url->link('customer/customer_approval', 'user_token=' . $this->session->data['user_token'], true)
		);
		
		$data['filter_name'] = $filter_name;
		$data['filter_email'] = $filter_email;
		$data['filter_customer_group_id'] = $filter_customer_group_id;
		$data['filter_type'] = $filter_type;
		$data['filter_date_added'] = $filter_date_added;

		$data['user_token'] = $this->session->data['user_token'];

		if (isset($this->session->data['error_warning'])) {
			$data['error_warning'] = $this->session->data['error_warning'];
			unset($this->session->data['error_warning']);
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];
			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		$this->load->model('customer/customer_group');

		$data['customer_groups'] = $this->model_customer_customer_group->getCustomerGroups();

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('customer/customer_approval', $data));
	}

	public function customer_approval() {
		$this->load->language('customer/customer_approval');

		if (isset($this->request->get['filter_name'])) {
			$filter_name = $this->request->get['filter_name'];
		} else {
			$filter_name = '';
		}

		if (isset($this->request->get['filter_email'])) {
			$filter_email = $this->request->get['filter_email'];
		} else {
			$filter_email = '';
		}

		if (isset($this->request->get['filter_customer_group_id'])) {
			$filter_customer_group_id = $this->request->get['filter_customer_group_id'];
		} else {
			$filter_customer_group_id = '';
		}

		if (isset($this->request->get['filter_type'])) {
			$filter_type = $this->request->get['filter_type'];
		} else {
			$filter_type = '';
		}

		if (isset($this->request->get['filter_date_added'])) {
			$filter_date_added = $this->request->get['filter_date_added'];
		} else {
			$filter_date_added = '';
		}

		if (isset($this->request->get['page'])) {
			$page = (int)$this->request->get['page'];
		} else {
			$page = 1;
		}

		$data['customer_approvals'] = array();

		$filter_data = array(
			'filter_name'              => $filter_name,
			'filter_email'             => $filter_email,
			'filter_customer_group_id' => $filter_customer_group_id,
			'filter_type'              => $filter_type,
			'filter_date_added'        => $filter_date_added,
			'start'                    => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit'                    => $this->config->get('config_limit_admin')
		);

		$this->load->model('customer/customer_approval');

		$customer_approval_total = $this->model_customer_customer_approval->getTotalCustomerApprovals($filter_data);

		$results = $this->model_customer_customer_approval->getCustomerApprovals($filter_data);

		foreach ($results as $result) {
			$data['customer_approvals'][] = array(
				'customer_id'    => $result['customer_id'],
				'name'           => $result['name'],
				'email'          => $result['email'],
				'customer_group' => $result['customer_group'],
				'type_code'      => $result['type'],
				'type'           => $this->language->get('text_' . $result['type']),
				'date_added'     => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
				'approve'        => $this->url->link('customer/customer_approval/approve', 'user_token=' . $this->session->data['user_token'] . '&customer_id=' . $result['customer_id'] . '&type=' . $result['type'], true),
				'deny'           => $this->url->link('customer/customer_approval/deny', 'user_token=' . $this->session->data['user_token'] . '&customer_id=' . $result['customer_id'] . '&type=' . $result['type'], true),
				'edit'           => $this->url->link('customer/customer/edit', 'user_token=' . $this->session->data['user_token'] . '&customer_id=' . $result['customer_id'], true)
			);
		}

		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_email'])) {
			$url .= '&filter_email=' . urlencode(html_entity_decode($this->request->get['filter_email'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_customer_group_id'])) {
			$url .= '&filter_customer_group_id=' . $this->request->get['filter_customer_group_id'];
		}

		if (isset($this->request->get['filter_type'])) {
			$url .= '&filter_type=' . $this->request->get['filter_type'];
		}

		if (isset($this->request->get['filter_date_added'])) {
			$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
		}

		$pagination = new Pagination();
		$pagination->total = $customer_approval_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('customer/customer_approval/customer_approval', 'user_token=' . $this->session->data['user_token'] . $url . '&page={page}', true);

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($customer_approval_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($customer_approval_total - $this->config->get('config_limit_admin'))) ? $customer_approval_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $customer_approval_total, ceil($customer_approval_total / $this->config->get('config_limit_admin')));

		$this->response->setOutput($this->load->view('customer/customer_approval_list', $data));
	}

	public function approve() {
		$this->load->language('customer/customer_approval');

		$json = array();

		if (!$this->user->hasPermission('modify', 'customer/customer_approval')) {
			$json['error'] = $this->language->get('error_permission');
		} else {
			$this->load->model('customer/customer_approval');

			if ($this->request->get['type'] == 'customer') {
				$partner_id = isset($this->request->post['partner_id']) ? (int)$this->request->post['partner_id'] : 0;
				$delivery_place_id = isset($this->request->post['delivery_place_id']) ? (int)$this->request->post['delivery_place_id'] : 0;
				$sales_rep_id = isset($this->request->post['sales_rep_id']) ? (int)$this->request->post['sales_rep_id'] : 0;
				$partner_discount = isset($this->request->post['partner_discount']) ? (float)$this->request->post['partner_discount'] : 0;

				if (!$partner_id) {
					$json['error'] = 'Partner je obavezan.';
				}

				if (!$delivery_place_id && empty($json['error'])) {
					$json['error'] = 'Mjesto isporuke je obavezno.';
				}

				if (empty($json['error'])) {
					$partner = $this->model_customer_customer_approval->getQiqoPartnerById($partner_id);

					if (!$partner) {
						$json['error'] = 'Partner ne postoji u lokalnom cacheu. Pokreni partner sync.';
					} else {
						$places = $this->model_customer_customer_approval->getQiqoDeliveryPlacesByPartnerId($partner_id);
						$allowed_place_ids = array_column($places, 'delivery_place_id');

						if (!in_array($delivery_place_id, array_map('intval', $allowed_place_ids), true)) {
							$json['error'] = 'Odabrano mjesto isporuke ne pripada partneru.';
						}

						if (empty($json['error'])) {
							$reps = $this->model_customer_customer_approval->getQiqoSalesReps();

							if ($reps) {
								$allowed_rep_ids = array_map('intval', array_column($reps, 'sales_rep_id'));
								if (!$sales_rep_id || !in_array($sales_rep_id, $allowed_rep_ids, true)) {
									$json['error'] = 'Komercijalist je obavezan.';
								}
							}
						}
					}
				}

				if (empty($json['error'])) {
					if (!$partner_discount) {
						$partner_discount = (float)$partner['base_discount'];
					}

					$this->model_customer_customer_approval->saveCustomerQiqoAuthorization(
						$this->request->get['customer_id'],
						[
							'partner_id' => $partner_id,
							'delivery_place_id' => $delivery_place_id,
							'sales_rep_id' => $sales_rep_id,
							'partner_discount' => $partner_discount
						],
						$this->user->getId()
					);
					$this->model_customer_customer_approval->syncCustomerAddressFromDeliveryPlace(
						(int)$this->request->get['customer_id'],
						$delivery_place_id,
						$partner['name']
					);

					$this->model_customer_customer_approval->approveCustomer($this->request->get['customer_id']);
					$this->sendCustomerApprovedMail((int)$this->request->get['customer_id']);
				}
			} elseif ($this->request->get['type'] == 'affiliate') {
				$this->model_customer_customer_approval->approveAffiliate($this->request->get['customer_id']);
			}

			if (empty($json['error'])) {
				$json['success'] = $this->language->get('text_success');
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function partnerInfo() {
		$this->load->language('customer/customer_approval');

		$json = array();

		if (!$this->user->hasPermission('modify', 'customer/customer_approval')) {
			$json['error'] = $this->language->get('error_permission');
		} else {
			$partner_id = isset($this->request->get['partner_id']) ? (int)$this->request->get['partner_id'] : 0;

			$this->load->model('customer/customer_approval');

			$partner = $this->model_customer_customer_approval->getQiqoPartnerById($partner_id);

			if (!$partner) {
				$json['error'] = 'Partner nije pronađen.';
			} else {
				$places = $this->model_customer_customer_approval->getQiqoDeliveryPlacesByPartnerId($partner_id);
				$reps = $this->model_customer_customer_approval->getQiqoSalesReps();

				$json['partner'] = array(
					'partner_id' => (int)$partner['partner_id'],
					'name' => $partner['name'],
					'base_discount' => (float)$partner['base_discount']
				);
				$json['delivery_places'] = $places;
				$json['sales_reps'] = $reps;
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function deny() {
		$this->load->language('customer/customer_approval');

		$json = array();

		if (!$this->user->hasPermission('modify', 'customer/customer_approval')) {
			$json['error'] = $this->language->get('error_permission');
		} else {
			$this->load->model('customer/customer_approval');

			if ($this->request->get['type'] == 'customer') {
				$this->model_customer_customer_approval->denyCustomer($this->request->get['customer_id']);
			} elseif ($this->request->get['type'] == 'affiliate') {
				$this->model_customer_customer_approval->denyAffiliate($this->request->get['customer_id']);
			}

			$json['success'] = $this->language->get('text_success');
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	private function sendCustomerApprovedMail($customer_id) {
		$this->load->model('customer/customer');
		$customer_info = $this->model_customer_customer->getCustomer($customer_id);

		if (!$customer_info) {
			return;
		}

		$this->load->model('setting/store');
		$store_info = $this->model_setting_store->getStore($customer_info['store_id']);

		if ($store_info) {
			$store_name = html_entity_decode($store_info['name'], ENT_QUOTES, 'UTF-8');
			$store_url = $store_info['url'];
		} else {
			$store_name = html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8');
			$store_url = HTTP_CATALOG;
		}

		$this->load->model('localisation/language');
		$language_info = $this->model_localisation_language->getLanguage($customer_info['language_id']);
		$language_code = $language_info ? $language_info['code'] : $this->config->get('config_language');

		$language = new Language($language_code);
		$language->load($language_code);
		$language->load('mail/customer_approve');

		$subject = sprintf($language->get('text_subject'), $store_name);

		$data['text_welcome'] = sprintf($language->get('text_welcome'), $store_name);
		$data['text_login'] = $language->get('text_login');
		$data['text_service'] = $language->get('text_service');
		$data['text_thanks'] = $language->get('text_thanks');
		$data['login'] = $store_url . 'index.php?route=account/login';
		$data['store'] = $store_name;

		$mail = new Mail($this->config->get('config_mail_engine'));
		$mail->parameter = $this->config->get('config_mail_parameter');
		$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
		$mail->smtp_username = $this->config->get('config_mail_smtp_username');
		$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
		$mail->smtp_port = $this->config->get('config_mail_smtp_port');
		$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

		$mail->setTo($customer_info['email']);
		$mail->setFrom($this->config->get('config_email'));
		$mail->setSender($store_name);
		$mail->setSubject($subject);
		$mail->setText($this->load->view('mail/customer_approve', $data));
		$mail->send();
	}
}
