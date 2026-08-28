<?php
//set_time_limit(0);

class ControllerExtensionFeedImportApi extends Controller {
	const SIGNATURE_TTL = 120;
	const MAX_FEED_BYTES = 33554432;
	const MAX_IMAGE_BYTES = 10485760;
	const MAX_IMAGE_PIXELS = 40000000;
	const FEED_TIMEOUT = 60;
	const IMAGE_TIMEOUT = 20;

	private $settings = array();
	private $importer;
	private $languages;

    public function convertToOcProduct($product){

		$languages = $this->languages;

		$product_related = array();
		
		if(!empty($product['price'])){
			if(is_array($product['price'])){
				$product['price'] = current($product['price']);
			}
			
			if($this->config->get('import_api_multiplier')){
				$product['price'] *= $this->config->get('import_api_multiplier');
			}
			
			$price = $product['price'];
			
		} else {
			$price = 0;
		}
		
		if(!empty($product['quantity'])){
			if(is_array($product['quantity'])){
				$quantity = current($product['quantity']);
			} else {
				$quantity = $product['quantity'];
			}

		} else {
			$quantity = 0;
		}
		
		if(!empty($product['minimum'])){
			if(is_array($product['minimum'])){
				$minimum = current($product['minimum']);
			} else {
				$minimum= $product['minimum'];
			}

		} else {
			$minimum = 0;
		}
		
		if(!empty($product['weight'])){
			if(is_array($product['weight'])){
				$weight = current($product['weight']);
			} else {
				$weight = $product['weight'];
			}

		} else {
			$weight = 0;
		}
		
		$main_image_path = '';
		if(!empty($product['image'])){
			if(is_array($product['image'])){
				$product['image'] = current($product['image']);
			}
			
			$main_image_path = $this->getImagePath($product['image']);
		}
		
		$product_images = array();
		
		if(!empty($product['images'])){
			if(!is_array($product['images'])){
				$product['images'] = array($product['images']);
			}

			foreach($product['images'] as $image){
				$oc_path = $this->getImagePath($image);
				$product_images[] = array('image' => $oc_path, 'sort_order' => 0);
			}
		}
		
		$product_special = array();
		if(!empty($product['special'])){			
			if(is_array($product['special'])){
				$product['special'] = current($product['special']);
			}
			
			$product_special[0] = array (
				'customer_group_id' => (int)$this->config->get('config_customer_group_id'),
				'priority' => '',
				'price' => $this->config->get('import_api_multiplier') ? $this->config->get('import_api_multiplier') * $product['special'] :  $product['special'],
				'date_start' => '',
				'date_end' => '',
			);
		}
		
		if(!empty($product['name'])){			
			if(is_array($product['name'])){
				$product['name'] = current($product['name']);
			}			
			$name = $this->request->clean($product['name']);
		} else {
			$name = $this->request->clean($product['unique']);
		}
		
		if(!empty($product['location'])){			
			if(is_array($product['location'])){
				$product['location'] = current($product['location']);
			}			
			$location = $this->request->clean($product['location']);
		} else {
			$location = '';
		}

		if(!empty($product['description'])){			
			if(is_array($product['description'])){
				$product['description'] = current($product['description']);
			}			
			$description = $this->request->clean($product['description']);
		} else {
			$description = '';
		}

		$product_description = $this->generateProductDescriptions($name, $description, $languages);

		$product_attribute = array();
		
		if(!empty($product['attributes'])){
			$this->request->clean($product['attributes']);
			foreach($product['attributes'] as $attribute) {
				$product_attribute[] = $this->generateAttributeData($attribute, $languages);
			}
		}
		
		$product_option = array();
		
		if(!empty($product['options'])){
			$this->request->clean($product['options']);
			$product_option = $this->generateOptionData($product['options'], $languages, $price, $quantity, $weight);
		}
		
		$product_category = array();
		if(!empty($product['category_path'])){

			foreach($product['category_path'] as $path) {
				
				if($path['parent']){
					$path['parent'] = $this->request->clean($path['parent']);
					$parent_id = $this->model_module_oc_model->getCategoryId($path['parent'], $languages, $this->settings['top_category_id']);
				} else {
					$parent_id = $this->settings['top_category_id'];
				}
				
				if($this->settings['import_api_category_path']){
					$categories = explode('>', $path['value']);
				} else {
					$categories = array($path['value']);
				}
				
				foreach($categories as $category){
					if(!$category) continue;
					$category_name = $this->request->clean($category);
					$parent_id = $category_id = $this->model_module_oc_model->getCategoryId($category_name, $languages, $parent_id);
					$product_category[] = $category_id;
				}
			}			
		}

		$product_category = array_unique($product_category);
		
		if(!$product_category && $this->settings['top_category_id']){
			$product_category[] = $this->settings['top_category_id'];
		}
		
		if(!$product_category && $this->settings['default_category_id']){
			$product_category[] = $this->settings['default_category_id'];
		}
		
		if(empty($product['brand'])){
			$product['brand'] = $this->config->get('import_api_default_brand');
		}
		
		if(!empty($product['brand'])){
			$product['brand'] = $this->request->clean($product['brand']);
			$manufacturer_id = $this->model_module_oc_model->getManufacturerId($product['brand']);
		} else {
			$manufacturer_id = $this->settings['default_manufacturer_id'];
		}

		$oc_product = array(
			'product_description' => $product_description,
			'price' => $price,
			'tax_class_id' => $this->config->get('import_api_tax'),
			'quantity' => $quantity,
			'minimum' => $minimum,
			'subtract' => '1',
			'stock_status_id' => $this->config->get('import_api_stock_status_id'),
			'shipping' => '1',
			'date_available' => date('Y-m-d'),
			'length' => '',
			'width' => '',
			'height' => '',
			'length_class_id' => '1',
			'weight' => $weight,
			'weight_class_id' => $this->config->get('import_api_weight_class_id'),
			'status' => '1',
			'sort_order' => '1',
			'manufacturer_id' => $manufacturer_id,
			'product_category' => $product_category,
			'product_related' => $product_related,
			'product_store' => array (0 => '0'),		
			'product_attribute' => $product_attribute,		
			'product_option' => $product_option,		
			'product_special' => $product_special,		
			'image' => $main_image_path,
			'product_image' => $product_images,
			'points' => '',
			'location' => $location,
			//'keyword' => '',
		);
		
		$product_data_fields = ['model', 'sku', 'upc', 'ean', 'jan', 'isbn', 'mpn', 'location', 'points', 'minimum', 'jm', 'pak', 'pakkol', 'vpc'];
		
		foreach($product_data_fields as $field){
			if(isset($product[$field]) && is_array($product[$field])){
				$product[$field] = current($product[$field]);
			}
			
			$oc_product[$field] = isset($product[$field]) ? $this->request->clean($product[$field]) : '';
		}

		if ($oc_product['jm'] === '' && $oc_product['ean'] !== '') {
			$oc_product['jm'] = $oc_product['ean'];
		}

		if ((float)$oc_product['pakkol'] <= 0 && (float)$oc_product['minimum'] > 0) {
			$oc_product['pakkol'] = $oc_product['minimum'];
		}

		if ((int)$oc_product['pak'] === 1 && (float)$oc_product['pakkol'] > 0) {
			$oc_product['minimum'] = (int)ceil((float)$oc_product['pakkol']);
		}

		if ((float)$oc_product['vpc'] <= 0 && (float)$oc_product['price'] > 0) {
			$oc_product['vpc'] = $oc_product['price'];
		}
		
		return $oc_product;
	}

	public function generateProductDescriptions($name, $description, $languages){
		$product_description = array();
		foreach($languages as $language_id){
			$product_description[$language_id] = array (			 		
				'name' => $name,
				'description' => $description,
				'meta_title' => $name,
				'meta_description' => $name,
				'meta_keyword' => '',
				'tag' => ''
			);
		}
		
		return $product_description;
	}
	
	public function generateAttributeData($attribute, $languages){
		$attribute_id = $this->model_module_oc_model->getAttributeId($attribute['name'], $languages, $attribute['group']);
		
		foreach($languages as $language_id){
			$product_attribute_description[$language_id] = array(
				'text' => $attribute['text']
			);
		}
		
		$product_attribute = array(
		    'name' => $attribute['name'],
		    'attribute_id' => $attribute_id,
		    'product_attribute_description' => $product_attribute_description,
		);
		
		return $product_attribute;
	}
	
	public function generateOptionData($options, $languages, $price, $quantity, $weight){
		$product_option = array();
		foreach($options as $option){
			$option_id = $this->model_module_oc_model->getOptionId($option['option'], $languages);
			$option_value_id = $this->model_module_oc_model->getOptionValueId($option['option_value'], $languages, $option_id);
			
			$product_option_value = array(
				'option_value_id' => $option_value_id,
				'product_option_value_id' => '',
				'quantity' => $quantity,
				'subtract' => 1,
				'price_prefix' => '+',
				'price' =>  $this->config->get('import_api_multiplier') ?  $this->config->get('import_api_multiplier') * $option['price'] : $option['price'],
				'points_prefix' => '+',
				'points' => '',
				'weight_prefix' => '+',
				'weight' => $option['weight']
			);
			
			if(isset($product_option[$option_id])){
				$product_option[$option_id]['product_option_value'][] = $product_option_value;
			} else {
				$product_option[$option_id] = array(
					'product_option_id' => '',
					'name' => $option['option'],
					'option_id' => $option_id,
					'type' => 'select',
					'required' => 1,
					'product_option_value' => array($product_option_value)
				);
			}	
		}
		
		return $product_option;
	}
	
	public function generateAttributeGroup($value, $parent, $languages){		
		$attribute_id = $this->model_extension_module_oc_model->getAttributeId($value, $languages, $attribute_group_id);
	}
	
	public function getProductId($value, $table, $identifier = 'name'){		
		$query = $this->db->query("SELECT  product_id FROM `" . DB_PREFIX . $table . "` WHERE `". $identifier ."` = '" . $this->db->escape($value) . "'");

		if($query->num_rows){
			return $query->row['product_id'];
		} else {
			return 0;
		}	
	}
	
	public function getLanguages() {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "language WHERE status = '1'");
		foreach($query->rows as $row){
			$laguanges[] = $row['language_id'];
		}
		return $laguanges;
	}
	
	protected function getImagePath($url){
		$url = html_entity_decode(trim((string)$url), ENT_QUOTES, 'UTF-8');

		if (!$this->isAllowedImportSourceUrl($url)) {
			$this->log->write('Import API rejected an unsafe remote image URL.');

			return '';
		}

		try {
			$image_data = $this->fetchRemoteResource($url, self::MAX_IMAGE_BYTES, self::IMAGE_TIMEOUT, 'image/*');
		} catch (RuntimeException $e) {
			$this->log->write('Import API image download failed: ' . $e->getMessage());

			return '';
		}

		$image_info = @getimagesizefromstring($image_data);
		$mime = is_array($image_info) && isset($image_info['mime']) ? strtolower($image_info['mime']) : '';
		$extensions = array(
			'image/jpeg' => 'jpg',
			'image/png' => 'png',
			'image/gif' => 'gif',
			'image/webp' => 'webp'
		);

		if (!isset($extensions[$mime]) || empty($image_info[0]) || empty($image_info[1])) {
			$this->log->write('Import API rejected a remote file that is not a supported raster image.');

			return '';
		}

		$width = (int)$image_info[0];
		$height = (int)$image_info[1];
		if ($width > 12000 || $height > 12000 || $width * $height > self::MAX_IMAGE_PIXELS) {
			$this->log->write('Import API rejected a remote image with excessive dimensions.');

			return '';
		}

		$parts = parse_url($url);
		$source_name = isset($parts['path']) ? rawurldecode(basename($parts['path'])) : '';
		$stem = pathinfo($source_name, PATHINFO_FILENAME);
		$stem = preg_replace('/[^A-Za-z0-9_-]+/', '-', $stem);
		$stem = trim((string)$stem, '-_');
		$stem = $stem === '' ? 'image' : substr($stem, 0, 80);
		$name = $stem . '-' . substr(hash('sha256', $url), 0, 16) . '.' . $extensions[$mime];
		$directory = rtrim(DIR_IMAGE, '/\\') . DIRECTORY_SEPARATOR . 'api' . DIRECTORY_SEPARATOR;
		$target = $directory . $name;

		if (!is_dir($directory) || !is_writable($directory)) {
			$this->log->write('Import API image directory is unavailable or not writable.');

			return '';
		}

		if (is_file($target) && filesize($target) > 0) {
			return 'api/' . $name;
		}

		$temporary = tempnam($directory, 'import-image-');
		if ($temporary === false) {
			$this->log->write('Import API could not allocate a temporary image file.');

			return '';
		}

		$written = file_put_contents($temporary, $image_data, LOCK_EX);
		if ($written !== strlen($image_data) || !@rename($temporary, $target)) {
			@unlink($temporary);
			$this->log->write('Import API could not persist a downloaded image.');

			return is_file($target) ? 'api/' . $name : '';
		}

		@chmod($target, 0644);

		return 'api/' . $name;
	}

	public function test(){
		if (!$this->authorizeSignedRequest('test')) {
			return;
		}

		try {
			$json = array();
			$view = isset($this->request->post['view']) ? (string)$this->request->post['view'] : '';
			$allowed_views = array('view-raw', 'view-split', 'view-grouping', 'view-modified');

			if (!in_array($view, $allowed_views, true)) {
				throw new RuntimeException('Nepoznat Import API testni prikaz.');
			}

			$product_links = $this->getProductLinks('test');

			foreach($product_links as $link){
				$json[] = $this->importer->getAllData($link, $view);
			}

			$this->sendJson($json);
		} catch (RuntimeException $e) {
			$this->log->write('Import API test rejected: ' . $e->getMessage());
			$this->sendJson(array('error' => $e->getMessage()), 422);
		} catch (Throwable $e) {
			$this->log->write('Import API test failed: ' . $e->getMessage());
			$this->sendJson(array('error' => 'Import API test nije moguće izvršiti.'), 500);
		}
	}

	public function import(){
		if (!$this->authorizeSignedRequest('import')) {
			return;
		}

		try {
			$product_links = $this->getProductLinks();
			$execution_budget = (int)ini_get('max_execution_time');
			if ($execution_budget <= 0 || $execution_budget > 100) {
				$execution_budget = 100;
			}

			$products_created = 0;
			$products_updated = 0;

			$json['notice'] = '';
			$json['total'] = count($product_links);

			foreach($product_links as $link){
				$original_product = $this->importer->getAllData($link);
				$oc_product = $this->convertToOcProduct($original_product);

				$equivalent = $this->settings['unique_equivalent'];
				if($equivalent == 'name'){
					$dsc = current($oc_product['product_description']);
					$unique = $this->request->clean($dsc['name']);
				} else {
					$unique = $this->request->clean($original_product[$equivalent]);
				}

				$unique = is_array($unique) ? current($unique) : $unique;

				$product_id = $this->getProductId($unique, $this->settings['table_equivalent'], $equivalent);
				if($product_id){
					$this->model_module_oc_model->editProduct($product_id, $oc_product);
					$products_updated++;
				} else {
					$product_id = $this->model_module_oc_model->addProduct($oc_product);
					$products_created++;
				}

				if(isset($_SERVER["REQUEST_TIME"])){
					if(microtime(true) - $_SERVER["REQUEST_TIME"] > max(1, $execution_budget - 10)){
						$json['notice'] = 'time_out';
						break;
					}
				}
				//$product_related[] = $product_id;
			}

			$this->cache->delete('product');
			$this->cache->delete('manufacturer');
			$this->cache->delete('category');

			$json['products_created'] = $products_created;
			$json['products_updated'] = $products_updated;
			$this->sendJson($json);
		} catch (RuntimeException $e) {
			$this->log->write('Import API import rejected: ' . $e->getMessage());
			$this->sendJson(array('error' => $e->getMessage()), 422);
		} catch (Throwable $e) {
			$this->log->write('Import API import failed: ' . $e->getMessage());
			$this->sendJson(array('error' => 'Import API uvoz nije moguće izvršiti.'), 500);
		}
	}
	
	protected function getProductLinks($action = 'import'){

		$begin_character = 'FEED';
		
		$settings = $this->getModuleSettings();
		$settings['import_api_link'] = html_entity_decode($settings['import_api_link'], ENT_QUOTES, "UTF-8");

		if (!$this->isAllowedImportSourceUrl($settings['import_api_link'])) {
			throw new RuntimeException('Import API izvor mora biti valjani HTTP ili HTTPS URL.');
		}

		$external_string = $this->fetchRemoteResource(
			$settings['import_api_link'],
			self::MAX_FEED_BYTES,
			self::FEED_TIMEOUT,
			'application/xml, text/xml;q=0.9, */*;q=0.1'
		);

		$previous_errors = libxml_use_internal_errors(true);
		$ob = simplexml_load_string($external_string, 'SimpleXMLElement', LIBXML_NOCDATA | LIBXML_NONET);
		libxml_clear_errors();
		libxml_use_internal_errors($previous_errors);

		if ($ob === false) {
			throw new RuntimeException('Import API izvor nije valjani XML.');
		}
		
		//$ob = @simplexml_load_string($external_string);
		$json_string = @json_encode($ob);

		$json_array[$begin_character] = json_decode($json_string, true);

		$parts = explode('->', $settings['unique_field']);
		
		$identifier_field = $parts[count($parts) - 1];
		
	
		$importer = new Import($this->registry, $settings);
	  
		$importer->setJsonArray($json_array);
		$importer->findUniqueProductsIdentifier($json_array, $parts, $identifier_field);
		
		
		$product_links = $importer->getProductLinks();
		
		$this->importer = $importer;
		
		$start = $limit = 0;
		
		if($action == 'test'){
			$start = $settings['start'];
			$limit = 20;
		}
		
		if(isset($this->request->post['start'])){
			$start = max(0, (int)$this->request->post['start']);
		}
		
		if(isset($this->request->post['limit'])){
			$limit = max(0, (int)$this->request->post['limit']);
		}
		
		if($start && !$limit){
			$limit = count($product_links) - $start;
		}
		
		if($limit){
			$product_links = array_slice($product_links, $start, $limit);
		}
		
		return $product_links;
	}
	
	protected function getModuleSettings(){
		
		$this->load->model('catalog/product');
		$this->load->model('module/oc_model');
		
		$languages = $this->languages = $this->getLanguages();
		
		$settings_fields = array('link', 'attribute_group', 'default_brand', 'default_category', 'top_category', 'weight_class_id', 'stock_status_id', 'tax', 'default_option', 'category_path', 'multiplier');
		
		if(isset($this->request->post['import_api_field'])){
			if (!is_array($this->request->post['import_api_field'])) {
				throw new RuntimeException('Import API mapiranje polja nije valjano.');
			}
			
			$settings = array(
				'import_api_field' => $this->request->post['import_api_field'],
				'import_api_modification' => isset($this->request->post['import_api_modification']) && is_array($this->request->post['import_api_modification']) ? $this->request->post['import_api_modification'] : array(),
				'import_api_combination' => isset($this->request->post['import_api_combination']) && is_array($this->request->post['import_api_combination']) ? $this->request->post['import_api_combination'] : array(),
			);
			
			foreach($settings_fields as $field){
				$key = 'import_api_' . $field;
				$settings[$key] = isset($this->request->post[$key]) ? $this->request->post[$key] : '';
			}
			
		} else {
			
			$settings = array(
				'import_api_field' => $this->config->get('import_api_field'),
				'import_api_modification' =>  $this->config->get('import_api_modification'),
				'import_api_combination' =>  $this->config->get('import_api_combination'),
			);
			
			foreach($settings_fields as $field){
				$settings['import_api_'. $field] = $this->config->get('import_api_'. $field);
			}			
		}
		
		if(!empty($settings['import_api_field']['unique'])){
			$settings['unique_field'] = html_entity_decode($settings['import_api_field']['unique'], ENT_QUOTES, 'UTF-8');
		} else {
			throw new RuntimeException('Potrebno je postaviti jedinstveno Import API polje.');
		}
		
		if (isset($this->request->post['import_api_start_index'])){
			$settings['start'] = $this->request->post['import_api_start_index'];
		} elseif ($this->config->get('import_api_start_index')){
			$settings['start'] = $this->config->get('import_api_start_index');
		} else {
			$settings['start'] = 0;
		}
		
		if($settings['import_api_top_category']){
			$settings['top_category_id'] = $this->model_module_oc_model->getCategoryId($settings['import_api_top_category'], $languages, 0);
		} else {
			$settings['top_category_id'] = 0;
		}
		
		if($settings['import_api_default_category']){
			$settings['default_category_id'] = $this->model_module_oc_model->getCategoryId($this->config->get('import_api_default_category'), $languages, 0);
		} else {
			$settings['default_category_id'] = 0;
		}
		
		if($settings['import_api_default_brand']){
			$settings['default_manufacturer_id'] = $this->model_module_oc_model->getManufacturerId($this->config->get('import_api_default_brand'));
		} else {
			$settings['default_manufacturer_id'] = 0;
		}
		
		$possible_eq = ['model', 'sku', 'ean', 'mpn', 'upc', 'jan', 'isbn', 'location'];
		
		$settings['unique_equivalent'] = 'name';
		$settings['table_equivalent'] = 'product_description';
		
		foreach($possible_eq as $f){
			if(!empty($settings['import_api_field'][$f]) && $settings['import_api_field'][$f] == $settings['import_api_field']['unique']){
				$settings['unique_equivalent'] = $f;
				$settings['table_equivalent'] = 'product';
				break;
			}
		}

		$this->settings = $settings;
		
		return $settings;		
	}
	
	public function printSettings(){
		$this->sendJson(array('error' => 'Not Found'), 404);
	}

	public function product_links(){
		$this->sendJson(array('error' => 'Not Found'), 404);
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
		if (!$this->isAllowedImportSourceUrl($url)) {
			throw new RuntimeException('Udaljeni Import API URL nije dopušten.');
		}

		if (!function_exists('curl_init')) {
			throw new RuntimeException('HTTP dohvat za Import API nije dostupan.');
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
			CURLOPT_USERAGENT => 'Italcro Import API fetcher'
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

	private function authorizeSignedRequest($action) {
		if (!isset($this->request->server['REQUEST_METHOD']) || $this->request->server['REQUEST_METHOD'] !== 'POST') {
			$this->sendJson(array('error' => 'Method Not Allowed'), 405, array('Allow: POST'));

			return false;
		}

		$timestamp = isset($this->request->server['HTTP_X_IMPORT_API_TIMESTAMP'])
			? (string)$this->request->server['HTTP_X_IMPORT_API_TIMESTAMP']
			: '';
		$nonce = isset($this->request->server['HTTP_X_IMPORT_API_NONCE'])
			? strtolower((string)$this->request->server['HTTP_X_IMPORT_API_NONCE'])
			: '';
		$provided_signature = isset($this->request->server['HTTP_X_IMPORT_API_SIGNATURE'])
			? strtolower((string)$this->request->server['HTTP_X_IMPORT_API_SIGNATURE'])
			: '';

		if (!preg_match('/^[0-9]{9,11}$/D', $timestamp)
			|| !preg_match('/^[a-f0-9]{32,128}$/D', $nonce)
			|| !preg_match('/^[a-f0-9]{64}$/D', $provided_signature)) {
			$this->sendJson(array('error' => 'Unauthorized'), 401);

			return false;
		}

		if (abs(time() - (int)$timestamp) > self::SIGNATURE_TTL) {
			$this->sendJson(array('error' => 'Unauthorized'), 401);

			return false;
		}

		$master_secret = (string)$this->config->get('config_encryption');

		if (strlen($master_secret) < 32) {
			$this->log->write('Import API signing is unavailable because config_encryption is missing.');
			$this->sendJson(array('error' => 'Service Unavailable'), 503);

			return false;
		}

		$raw_body = file_get_contents('php://input');
		$raw_body = $raw_body === false ? '' : $raw_body;
		$canonical = "v1\n" . $action . "\n" . $timestamp . "\n" . $nonce . "\n" . hash('sha256', $raw_body);
		$signing_key = hash_hmac('sha256', 'italcro-import-api-v1', $master_secret, true);
		$expected_signature = hash_hmac('sha256', $canonical, $signing_key);

		if (!hash_equals($expected_signature, $provided_signature)) {
			$this->sendJson(array('error' => 'Unauthorized'), 401);

			return false;
		}

		try {
			if (!$this->isSignedRequestNonceStorageReady()) {
				$this->log->write('Import API nonce migration is required before signed requests can be accepted.');
				$this->sendJson(array('error' => 'Import API sigurnosna migracija nije primijenjena.'), 503);

				return false;
			}

			$nonce_consumed = $this->consumeSignedRequestNonce($nonce);
		} catch (Throwable $e) {
			$this->log->write('Import API nonce storage is unavailable: ' . $e->getMessage());
			$this->sendJson(array('error' => 'Service Unavailable'), 503);

			return false;
		}

		if (!$nonce_consumed) {
			$this->sendJson(array('error' => 'Request already used'), 409);

			return false;
		}

		return true;
	}

	private function consumeSignedRequestNonce($nonce) {
		$this->db->query("DELETE FROM `" . DB_PREFIX . "import_api_request_nonce`
			WHERE expires_at < NOW()");

		$nonce_hash = hash('sha256', $nonce);
		$this->db->query("INSERT IGNORE INTO `" . DB_PREFIX . "import_api_request_nonce`
			SET nonce_hash = '" . $this->db->escape($nonce_hash) . "',
				expires_at = DATE_ADD(NOW(), INTERVAL " . (self::SIGNATURE_TTL + 30) . " SECOND),
				date_added = NOW()");

		return $this->db->countAffected() === 1;
	}

	private function isSignedRequestNonceStorageReady() {
		$table = $this->db->escape(DB_PREFIX . 'import_api_request_nonce');
		$query = $this->db->query("SELECT COUNT(*) AS total
			FROM INFORMATION_SCHEMA.TABLES t
			WHERE t.TABLE_SCHEMA = DATABASE()
				AND t.TABLE_NAME = '" . $table . "'
				AND UPPER(t.ENGINE) = 'INNODB'
				AND t.TABLE_COLLATION = 'utf8mb4_unicode_ci'
				AND EXISTS (
					SELECT 1
					FROM INFORMATION_SCHEMA.COLUMNS c
					WHERE c.TABLE_SCHEMA = DATABASE()
						AND c.TABLE_NAME = t.TABLE_NAME
						AND c.COLUMN_NAME = 'nonce_hash'
						AND c.COLUMN_TYPE = 'char(64)'
						AND c.CHARACTER_SET_NAME = 'ascii'
						AND c.IS_NULLABLE = 'NO'
				)
				AND 1 = (
					SELECT COUNT(*)
					FROM INFORMATION_SCHEMA.STATISTICS s
					WHERE s.TABLE_SCHEMA = DATABASE()
						AND s.TABLE_NAME = t.TABLE_NAME
						AND s.INDEX_NAME = 'PRIMARY'
				)
				AND EXISTS (
					SELECT 1
					FROM INFORMATION_SCHEMA.STATISTICS s
					WHERE s.TABLE_SCHEMA = DATABASE()
						AND s.TABLE_NAME = t.TABLE_NAME
						AND s.INDEX_NAME = 'PRIMARY'
						AND s.COLUMN_NAME = 'nonce_hash'
						AND s.SEQ_IN_INDEX = 1
				)
				AND EXISTS (
					SELECT 1
					FROM INFORMATION_SCHEMA.STATISTICS s
					WHERE s.TABLE_SCHEMA = DATABASE()
						AND s.TABLE_NAME = t.TABLE_NAME
						AND s.INDEX_NAME = 'idx_expires_at'
						AND s.COLUMN_NAME = 'expires_at'
						AND s.SEQ_IN_INDEX = 1
				)");

		return !empty($query->row['total']);
	}

	private function sendJson($data, $status = 200, $headers = array()) {
		$status_text = array(
			200 => 'OK',
			401 => 'Unauthorized',
			404 => 'Not Found',
			405 => 'Method Not Allowed',
			409 => 'Conflict',
			422 => 'Unprocessable Entity',
			500 => 'Internal Server Error',
			503 => 'Service Unavailable'
		);
		$protocol = !empty($this->request->server['SERVER_PROTOCOL']) ? $this->request->server['SERVER_PROTOCOL'] : 'HTTP/1.1';
		$text = isset($status_text[$status]) ? $status_text[$status] : 'Error';

		$this->response->addHeader($protocol . ' ' . (int)$status . ' ' . $text);
		$this->response->addHeader('Content-Type: application/json; charset=utf-8');
		$this->response->addHeader('Cache-Control: no-store');

		foreach ($headers as $header) {
			$this->response->addHeader($header);
		}

		$output = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
		$this->response->setOutput($output === false ? '{"error":"JSON encoding failed"}' : $output);
	}
}
