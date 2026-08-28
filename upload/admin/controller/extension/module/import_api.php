<?php
class ControllerExtensionModuleImportApi extends Controller {
	const MAX_FEED_BYTES = 33554432;
	const FEED_TIMEOUT = 60;

	private $error = array();
	private $fields = array();

	public function index() {
		$this->load->language('extension/module/import_api');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');
		
		if (!is_dir('../image/api/')) {
			mkdir('../image/api/', 0777, true);
		}
		
		$data['extra_fields_number'] = 3;
		$data['extra_modifications_number'] = 4;
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('import_api', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true));
		}
		
		$data['user_token'] = $this->session->data['user_token'];


		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_module'),
			'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/module/import_api', 'user_token=' . $this->session->data['user_token'], 'SSL')
		);

		$data['test'] = $this->url->link('extension/module/import_api/test', 'user_token=' . $this->session->data['user_token'], 'SSL');
		$data['import'] = $this->url->link('extension/module/import_api/import', 'user_token=' . $this->session->data['user_token'], 'SSL');
		$data['action'] = $this->url->link('extension/module/import_api', 'user_token=' . $this->session->data['user_token'], 'SSL');

		$data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true);
		
		$data['oc_fields'] = ['unique', 'model', 'name', 'description', 'price', 'special', 'quantity', 'image', 'brand', 'category', 'category_parent', 'attribute_name', 'attribute_value', 'option', 'option_value', 'option_price', 'option_weight', 'option_quantity', 'images', 'sku', 'mpn', 'ean', 'upc', 'jan', 'isbn', 'location', 'weight', 'minimum', 'jm', 'pak', 'pakkol', 'vpc'];
		
		$data['import_api_fields'] = $this->config->get('import_api_fields') ?  html_entity_decode($this->config->get('import_api_fields'), ENT_QUOTES, 'UTF-8') : '';

		$data['api_fields'] = explode('##', $data['import_api_fields']);
		$config_fields = $this->config->get('import_api_field');
		$config_modifications = $this->config->get('import_api_modification');
		$config_combinations = $this->config->get('import_api_combination');
		
		if (isset($this->request->post['import_api_link'])) {
			$data['import_api_link'] = $this->request->post['import_api_link'];
		} else {
			$data['import_api_link'] = $this->config->get('import_api_link');
		}
		
		foreach($data['oc_fields'] as $oc_field){
			$data['saved_values'][$oc_field] = !empty($config_fields[$oc_field]) ? html_entity_decode($config_fields[$oc_field], ENT_QUOTES, 'UTF-8') : '';
			$data['entry_values'][$oc_field] = ($this->language->get('entry_field_' . $oc_field) != 'entry_field_' . $oc_field) ? $this->language->get('entry_field_' . $oc_field) : ucfirst($oc_field. ' field');			
		}
		
		for($i = 1; $i <= $data['extra_fields_number']; $i++){
			$data['saved_values']['field' . $i] = !empty($config_fields['field' . $i]) ? html_entity_decode($config_fields['field' . $i], ENT_QUOTES, 'UTF-8') : '';
			$data['entry_values']['field' . $i] = 'field' . $i;	
		}
		
		foreach($data['oc_fields'] as $oc_field){
			$data['saved_modifications'][$oc_field] = !empty($config_modifications[$oc_field]) ? $config_modifications[$oc_field] : '';
			$data['entry_modifications'][$oc_field] = ($this->language->get('entry_field_' . $oc_field) != 'entry_field_' . $oc_field) ? $this->language->get('entry_field_' . $oc_field) : ucfirst($oc_field. ' field');			
		}

		for($i = 1; $i <= $data['extra_modifications_number']; $i++){
			$data['saved_modifications']['modification' . $i] = !empty($config_modifications['modification' . $i]) ? $config_modifications['modification' . $i] : '';
			$data['entry_modifications']['modification' . $i] = 'modification' . $i;	
		}
		
		foreach($data['oc_fields'] as $oc_field){
			$data['saved_combinations'][$oc_field] = !empty($config_combinations[$oc_field]) ? $config_combinations[$oc_field] : '';
			$data['entry_combinations'][$oc_field] = ($this->language->get('entry_field_' . $oc_field) != 'entry_field_' . $oc_field) ? $this->language->get('entry_field_' . $oc_field) : ucfirst($oc_field. ' field');			
		}
		
		// Settings
		
		$this->load->model('localisation/tax_class');

		$data['tax_classes'] = $this->model_localisation_tax_class->getTaxClasses();

		if (isset($this->request->post['import_api_tax'])) {
			$data['import_api_tax'] = $this->request->post['import_api_tax'];
		} elseif (!empty($this->config->get('import_api_tax'))) {
			$data['import_api_tax'] = $this->config->get('import_api_tax');
		} else {
			$data['import_api_tax'] = 0;
		}
		
		$this->load->model('localisation/stock_status');

		$data['stock_statuses'] = $this->model_localisation_stock_status->getStockStatuses();

		if (isset($this->request->post['import_api_stock_status_id'])) {
			$data['import_api_stock_status_id'] = $this->request->post['import_api_stock_status_id'];
		} elseif (!empty($this->config->get('import_api_stock_status_id'))) {
			$data['import_api_stock_status_id'] = $this->config->get('import_api_stock_status_id');
		} else {
			$data['import_api_stock_status_id'] = 0;
		}
		
		$this->load->model('localisation/weight_class');

		$data['weight_classes'] = $this->model_localisation_weight_class->getWeightClasses();

		if (isset($this->request->post['import_api_weight_class_id'])) {
			$data['import_api_weight_class_id'] = $this->request->post['import_api_weight_class_id'];
		} elseif (!empty($this->config->get('import_api_weight_class_id'))) {
			$data['import_api_weight_class_id'] = $this->config->get('import_api_weight_class_id');
		} else {
			$data['import_api_weight_class_id'] = $this->config->get('config_weight_class_id');
		}
		
		if (isset($this->request->post['import_api_top_category'])) {
			$data['import_api_top_category'] = $this->request->post['import_api_top_category'];
		} elseif (!empty($this->config->get('import_api_top_category'))) {
			$data['import_api_top_category'] = $this->config->get('import_api_top_category');
		} else {
			$data['import_api_top_category'] = '';
		}
		
		if (isset($this->request->post['import_api_default_category'])) {
			$data['import_api_default_category'] = $this->request->post['import_api_default_category'];
		} elseif (!empty($this->config->get('import_api_default_category'))) {
			$data['import_api_default_category'] = $this->config->get('import_api_default_category');
		} else {
			$data['import_api_default_category'] = '';
		}
		
		if (isset($this->request->post['import_api_default_brand'])) {
			$data['import_api_default_brand'] = $this->request->post['import_api_default_brand'];
		} elseif (!empty($this->config->get('import_api_default_brand'))) {
			$data['import_api_default_brand'] = $this->config->get('import_api_default_brand');
		} else {
			$data['import_api_default_brand'] = '';
		}
		
		if (isset($this->request->post['import_api_attribute_group'])) {
			$data['import_api_attribute_group'] = $this->request->post['import_api_attribute_group'];
		} elseif (!empty($this->config->get('import_api_attribute_group'))) {
			$data['import_api_attribute_group'] = $this->config->get('import_api_attribute_group');
		} else {
			$data['import_api_attribute_group'] = 'General';
		}
		
		if (isset($this->request->post['import_api_default_option'])) {
			$data['import_api_default_option'] = $this->request->post['import_api_default_option'];
		} elseif (!empty($this->config->get('import_api_default_option'))) {
			$data['import_api_default_option'] = $this->config->get('import_api_default_option');
		} else {
			$data['import_api_default_option'] = 'Option';
		}
		
		if (isset($this->request->post['import_api_default_attribute'])) {
			$data['import_api_default_attribute'] = $this->request->post['import_api_default_attribute'];
		} elseif (!empty($this->config->get('import_api_default_attribute'))) {
			$data['import_api_default_attribute'] = $this->config->get('import_api_default_attribute');
		} else {
			$data['import_api_default_attribute'] = 'Attribute';
		}
		
		if (isset($this->request->post['import_api_multiplier'])) {
			$data['import_api_multiplier'] = $this->request->post['import_api_multiplier'];
		} elseif (!empty($this->config->get('import_api_multiplier'))) {
			$data['import_api_multiplier'] = $this->config->get('import_api_multiplier');
		} else {
			$data['import_api_multiplier'] = '';
		}
		
		if (isset($this->request->post['import_api_category_path'])) {
			$data['import_api_category_path'] = $this->request->post['import_api_category_path'];
		} elseif (!empty($this->config->get('import_api_category_path'))) {
			$data['import_api_category_path'] = $this->config->get('import_api_category_path');
		} else {
			$data['import_api_category_path'] = 0;
		}
		
		if (isset($this->request->post['import_api_start_index'])) {
			$data['import_api_start_index'] = $this->request->post['import_api_start_index'];
		} elseif (!empty($this->config->get('import_api_start_index'))) {
			$data['import_api_start_index'] = $this->config->get('import_api_start_index');
		} else {
			$data['import_api_start_index'] = 0;
		}
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/import_api', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/module/import_api')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->request->post['import_api_link']) {
			$this->error['warning'] = $this->language->get('error_link');
		}
		
		if (!$this->request->post['import_api_field']['unique']) {
			$this->error['warning'] = $this->language->get('error_unique');
		}

		return !$this->error;
	}
	
	public function fields(){
		$this->load->language('extension/module/import_api');
		$json = array();

		if (!isset($this->request->server['REQUEST_METHOD']) || $this->request->server['REQUEST_METHOD'] !== 'POST') {
			$this->sendAdminJson(array('error' => 'Method Not Allowed'), 405, array('Allow: POST'));

			return;
		}

		if (!$this->user->hasPermission('modify', 'extension/module/import_api')) {
			$this->sendAdminJson(array('error' => $this->language->get('error_permission')), 403);

			return;
		}

		$link = isset($this->request->post['import_api_link'])
			? html_entity_decode((string)$this->request->post['import_api_link'], ENT_QUOTES, 'UTF-8')
			: '';

		if (!$this->isAllowedImportSourceUrl($link)) {
			$this->sendAdminJson(array('error' => 'Import API izvor mora biti valjani HTTP ili HTTPS URL.'), 422);

			return;
		}

		try {
			$external_string = $this->fetchRemoteResource(
				$link,
				self::MAX_FEED_BYTES,
				self::FEED_TIMEOUT,
				'application/xml, text/xml;q=0.9, */*;q=0.1'
			);
		} catch (RuntimeException $e) {
			$external_string = false;
		}

		if($external_string === false){
			$json['error'] = 'External file not found. Check link in browser';
		} else {
			
			$json['error'] = '';
			$previous_errors = libxml_use_internal_errors(true);
			$ob = simplexml_load_string($external_string, 'SimpleXMLElement', LIBXML_NOCDATA | LIBXML_NONET);
			libxml_clear_errors();
			libxml_use_internal_errors($previous_errors);

			$json_string = $ob === false ? false : json_encode($ob);
			$php_array = $json_string === false ? null : json_decode($json_string, true);
			
			if(!is_array($php_array)){
				$json['error'] = 'File is not in xml format';
			} else {				
				$this->search_keys($php_array, 'FEED');
				
				$json['field'] = $this->fields;
				$json['fields'] = implode('##', $this->fields);
			}			
		}
		
		$this->sendAdminJson($json);
	}

	public function test() {
		$this->proxyCatalogImportAction('test');
	}

	public function import() {
		$this->proxyCatalogImportAction('import');
	}

	private function proxyCatalogImportAction($action) {
		$this->load->language('extension/module/import_api');

		if (!isset($this->request->server['REQUEST_METHOD']) || $this->request->server['REQUEST_METHOD'] !== 'POST') {
			$this->sendAdminJson(array('error' => 'Method Not Allowed'), 405, array('Allow: POST'));

			return;
		}

		if (!$this->user->hasPermission('modify', 'extension/module/import_api')) {
			$this->sendAdminJson(array('error' => $this->language->get('error_permission')), 403);

			return;
		}

		if (!in_array($action, array('test', 'import'), true)) {
			$this->sendAdminJson(array('error' => 'Invalid Import API action'), 400);

			return;
		}

		$post_data = $this->request->post;

		if ($action === 'test') {
			$view = isset($post_data['view']) ? (string)$post_data['view'] : '';
			if (!in_array($view, array('view-raw', 'view-split', 'view-grouping', 'view-modified'), true)) {
				$this->sendAdminJson(array('error' => 'Nepoznat Import API testni prikaz.'), 422);

				return;
			}
		}

		if (isset($post_data['start'])) {
			$post_data['start'] = max(0, (int)$post_data['start']);
		}
		if (isset($post_data['limit'])) {
			$post_data['limit'] = max(0, (int)$post_data['limit']);
		}

		$master_secret = (string)$this->config->get('config_encryption');

		if (strlen($master_secret) < 32) {
			$this->log->write('Import API signing is unavailable because config_encryption is missing.');
			$this->sendAdminJson(array('error' => 'Import API potpis nije konfiguriran.'), 503);

			return;
		}

		$body = http_build_query($post_data, '', '&', PHP_QUERY_RFC3986);
		$timestamp = (string)time();

		try {
			$nonce = bin2hex(random_bytes(24));
		} catch (Throwable $e) {
			$this->log->write('Import API could not generate a request nonce.');
			$this->sendAdminJson(array('error' => 'Import API potpis trenutno nije dostupan.'), 503);

			return;
		}

		$canonical = "v1\n" . $action . "\n" . $timestamp . "\n" . $nonce . "\n" . hash('sha256', $body);
		$signing_key = hash_hmac('sha256', 'italcro-import-api-v1', $master_secret, true);
		$signature = hash_hmac('sha256', $canonical, $signing_key);
		$url = rtrim(HTTP_CATALOG, '/') . '/index.php?route=extension/feed/import_api/' . $action;
		$ch = curl_init($url);

		if ($ch === false) {
			$this->sendAdminJson(array('error' => 'Interni Import API zahtjev nije moguće pokrenuti.'), 502);

			return;
		}

		curl_setopt_array($ch, array(
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => $body,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_FOLLOWLOCATION => false,
			CURLOPT_CONNECTTIMEOUT => 10,
			CURLOPT_TIMEOUT => $action === 'import' ? 120 : 90,
			CURLOPT_SSL_VERIFYPEER => true,
			CURLOPT_SSL_VERIFYHOST => 2,
			CURLOPT_PROTOCOLS => CURLPROTO_HTTP | CURLPROTO_HTTPS,
			CURLOPT_HTTPHEADER => array(
				'Content-Type: application/x-www-form-urlencoded',
				'Accept: application/json',
				'X-Import-Api-Timestamp: ' . $timestamp,
				'X-Import-Api-Nonce: ' . $nonce,
				'X-Import-Api-Signature: ' . $signature,
				'Cache-Control: no-store'
			),
			CURLOPT_USERAGENT => 'Italcro admin Import API proxy'
		));

		$response_body = curl_exec($ch);
		$status = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
		$curl_error = curl_error($ch);
		curl_close($ch);

		if ($response_body === false) {
			$this->log->write('Import API internal request failed: ' . $curl_error);
			$this->sendAdminJson(array('error' => 'Interni Import API zahtjev nije uspio.'), 502);

			return;
		}

		$decoded = json_decode($response_body, true);
		if (json_last_error() !== JSON_ERROR_NONE || !is_array($decoded)) {
			$this->log->write('Import API returned a non-JSON response with HTTP status ' . $status . '.');
			$this->sendAdminJson(array('error' => 'Import API je vratio neispravan odgovor.'), 502);

			return;
		}

		$this->sendAdminJson($decoded, $status);
	}

	private function isAllowedImportSourceUrl($url) {
		if ($url === '' || filter_var($url, FILTER_VALIDATE_URL) === false) {
			return false;
		}

		$parts = parse_url($url);
		$scheme = isset($parts['scheme']) ? strtolower($parts['scheme']) : '';

		return !empty($parts['host'])
			&& !isset($parts['user'])
			&& !isset($parts['pass'])
			&& in_array($scheme, array('http', 'https'), true);
	}

	private function fetchRemoteResource($url, $max_bytes, $timeout, $accept) {
		if (!$this->isAllowedImportSourceUrl($url) || !function_exists('curl_init')) {
			throw new RuntimeException('Udaljeni Import API URL nije dostupan.');
		}

		$data = '';
		$too_large = false;
		$ch = curl_init($url);
		if ($ch === false) {
			throw new RuntimeException('Udaljeni Import API sadržaj nije dostupan.');
		}

		$curl_options = array(
			CURLOPT_FOLLOWLOCATION => defined('CURLOPT_DISALLOW_USERNAME_IN_URL'),
			CURLOPT_MAXREDIRS => 3,
			CURLOPT_CONNECTTIMEOUT => 10,
			CURLOPT_TIMEOUT => max(1, (int)$timeout),
			CURLOPT_SSL_VERIFYPEER => true,
			CURLOPT_SSL_VERIFYHOST => 2,
			CURLOPT_PROTOCOLS => CURLPROTO_HTTP | CURLPROTO_HTTPS,
			CURLOPT_REDIR_PROTOCOLS => CURLPROTO_HTTP | CURLPROTO_HTTPS,
			CURLOPT_ENCODING => '',
			CURLOPT_HTTPHEADER => array('Accept: ' . $accept),
			CURLOPT_USERAGENT => 'Italcro admin Import API fetcher'
		);
		if (defined('CURLOPT_DISALLOW_USERNAME_IN_URL')) {
			$curl_options[constant('CURLOPT_DISALLOW_USERNAME_IN_URL')] = true;
		}
		curl_setopt_array($ch, $curl_options);
		curl_setopt($ch, CURLOPT_WRITEFUNCTION, function($curl, $chunk) use (&$data, &$too_large, $max_bytes) {
			$chunk_length = strlen($chunk);
			if (strlen($data) + $chunk_length > $max_bytes) {
				$too_large = true;

				return 0;
			}

			$data .= $chunk;

			return $chunk_length;
		});

		$result = curl_exec($ch);
		$status = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);

		if ($too_large) {
			throw new RuntimeException('Udaljeni Import API sadržaj prelazi dopuštenu veličinu.');
		}

		if ($result === false || $status < 200 || $status >= 300) {
			throw new RuntimeException('Udaljeni Import API sadržaj nije dostupan.');
		}

		return $data;
	}

	private function sendAdminJson($data, $status = 200, $headers = array()) {
		$status_text = array(
			200 => 'OK',
			400 => 'Bad Request',
			401 => 'Unauthorized',
			403 => 'Forbidden',
			404 => 'Not Found',
			405 => 'Method Not Allowed',
			409 => 'Conflict',
			422 => 'Unprocessable Entity',
			500 => 'Internal Server Error',
			502 => 'Bad Gateway',
			503 => 'Service Unavailable'
		);
		if (!isset($status_text[$status])) {
			$status = 502;
		}

		$protocol = !empty($this->request->server['SERVER_PROTOCOL']) ? $this->request->server['SERVER_PROTOCOL'] : 'HTTP/1.1';
		$text = $status_text[$status];

		$this->response->addHeader($protocol . ' ' . (int)$status . ' ' . $text);
		$this->response->addHeader('Content-Type: application/json; charset=utf-8');
		$this->response->addHeader('Cache-Control: no-store');

		foreach ($headers as $header) {
			$this->response->addHeader($header);
		}

		$output = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
		$this->response->setOutput($output === false ? '{"error":"JSON encoding failed"}' : $output);
	}
	
	function search_keys($array, $parent){
		if(isset($array[0])){
			$array = array('array('. count($array) .')' => $array[0]);
		}
		
		foreach($array as $key => $value){
			if(!is_array($value)){
				$this->fields[] = $parent.'->'.$key;
			} else {
				$this->search_keys($value, $parent .'->'. $key);
			}
		}		
	}
}
