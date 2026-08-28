<?php
/**
 * Name: Ajax Live Options
 * Apply Version: 2.3.X.X
 * Version: 2.3.X.X
 * Author: 		Denise (rei7092@gmail.com)
 */
class ControllerExtensionBaselLiveOptions extends Controller {
		private $error = array(); 
		private $data  = array();
	
	public function __construct($params) {
    	parent::__construct($params);

		$this->options_container       = '.product-info';
		$this->special_price_container = '.live-price-new';
		$this->price_container         = '.live-price';
		$this->tax_price_container     = '.live-price-tax';
	}
	public function index() { 
 
		$json           = array();
		$options_makeup = $options_makeup_notax = 0;
		$currency_code = $this->session->data['currency'];

		if (isset($this->request->get['product_id'])) {
			$product_id = (int)$this->request->get['product_id'];
		} else {
			$product_id = 0;
		}

		if (isset($this->request->post['quantity'])) {
			$quantity_value = str_replace(array(' ', "\xc2\xa0"), '', trim((string)$this->request->post['quantity']));
			if (strpos($quantity_value, ',') !== false) {
				$quantity_value = str_replace('.', '', $quantity_value);
				$quantity_value = str_replace(',', '.', $quantity_value);
			}
			$quantity = (float)$quantity_value;
		} else {
			$quantity = 1.0;
		}

		if ($quantity <= 0) {
			$quantity = 1.0;
		}

		$this->load->model('catalog/product');

		// Cache name
		if (isset($this->request->post['option']) && is_array($this->request->post['option'])) {
			$options_hash = serialize($this->request->post['option']);
		} else {
			$options_hash = '';
		}

			$product_info = $this->model_catalog_product->getProduct($product_id);
			// Prepare data
			if ($product_info) {
					$resolved_price_raw = isset($product_info['base_price']) ? (float)$product_info['base_price'] : (float)$product_info['price'];
					$resolved_special_raw = 0.0;
					$has_resolved_special = false;
					$sku = trim((string)$product_info['sku']);
				$is_single_article = empty($product_info['mpn']) || !isset($product_info['mpn_count']) || (int)$product_info['mpn_count'] <= 1;

				// Grouped MPN roots are navigation shells. Their own legacy special
				// must never overwrite the per-SKU rows rendered by the product page.
				if (!$is_single_article) {
					$json['success'] = false;
					$this->response->addHeader('Content-Type: application/json');
					$this->response->setOutput(json_encode($json));
					return;
				}

				if ($this->customer->isLogged() && $sku !== '') {
					$base_unit = isset($product_info['base_price']) ? (float)$product_info['base_price'] : (float)$product_info['price'];
					if ($base_unit > 0) {
						$pricing_map = $this->model_catalog_product->getQiqoPricingMap(
							(int)$this->customer->getId(),
							array($sku => $quantity),
							array($sku => $base_unit),
							false,
							false
						);

						if (isset($pricing_map[$sku])) {
							$pricing = $pricing_map[$sku];
							$has_resolved_special = isset($pricing['old_unit_price']) && $pricing['old_unit_price'] !== false;
							$resolved_price_raw = isset($pricing['old_unit_price']) && $pricing['old_unit_price'] !== false
								? (float)$pricing['old_unit_price']
								: (float)$pricing['base_unit_price'];
							$resolved_special_raw = isset($pricing['old_unit_price']) && $pricing['old_unit_price'] !== false
								? (float)$pricing['final_unit_price']
								: 0.0;
						}
					}
				}

				if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
					$this->data['price'] = $this->tax->calculate($resolved_price_raw, $product_info['tax_class_id'], $this->config->get('config_tax'));
				} else {
					$this->data['price'] = false;
				}

				if ($has_resolved_special) {
					$this->data['special'] = $this->tax->calculate($resolved_special_raw, $product_info['tax_class_id'], $this->config->get('config_tax'));
				} else {
					$this->data['special'] = false;
				}

				// If some options are selected
				if (isset($this->request->post['option']) && $this->request->post['option']) {
					$option_tax = $this->config->get('config_tax') ? 'P' : false;
					foreach ($this->model_catalog_product->getProductOptions($product_id) as $option) { 
						foreach ($option['product_option_value'] as $option_value) {
							if (isset($this->request->post['option'][$option['product_option_id']])) {
								if(is_array($this->request->post['option'][$option['product_option_id']])){
									foreach ($this->request->post['option'][$option['product_option_id']] as $product_option_id) {
										if($product_option_id == $option_value['product_option_value_id']){
											$options_makeup += $this->get_options_makeup($option_value, $product_info['tax_class_id'], $option_tax);
											$options_makeup_notax += $this->get_options_makeup($option_value, 0, $option_tax);
										}
									}
								}
								elseif($this->request->post['option'][$option['product_option_id']] == $option_value['product_option_value_id']){
									$options_makeup += $this->get_options_makeup($option_value, $product_info['tax_class_id'], $option_tax);
									$options_makeup_notax += $this->get_options_makeup($option_value, 0, $option_tax);
								}
							}
						}
					}
				}

				if ($this->data['price']) {
					$json['new_price']['price'] = $this->currency->format(($this->data['price'] + $options_makeup) * $quantity, $currency_code);

						if($currency_code=='HRK'){
		               $json['new_price']['priceeur'] = $this->currency->format(($this->data['price'] + $options_makeup) * $quantity, 'EUR');
		            }
		            else{
		                $json['new_price']['priceeur'] = '';
		            }
				} else {
					$json['new_price']['price'] = false;
					  $json['new_price']['priceeur'] = '';
				}

				if ($has_resolved_special) {
					$json['new_price']['special'] = $this->currency->format(($this->data['special'] + $options_makeup) * $quantity, $currency_code);

					if($currency_code=='HRK'){
		               $json['new_price']['specialeur'] = $this->currency->format(($this->data['special'] + $options_makeup) * $quantity, 'EUR');
		            }
		            else{
		                $json['new_price']['specialeur'] = '';
		            }
				} else {
					$json['new_price']['special'] = false;
					  $json['new_price']['specialeur'] = '';
				}

				if ($this->config->get('config_tax')) {
					$resolved_tax_raw = $has_resolved_special ? $resolved_special_raw : $resolved_price_raw;
					$json['new_price']['tax'] = $this->currency->format(($resolved_tax_raw + $options_makeup_notax) * $quantity, $currency_code );

						if($currency_code=='HRK'){
		               $json['new_price']['taxeur'] = $this->currency->format(($resolved_tax_raw + $options_makeup_notax) * $quantity, 'EUR' );

		            }
		            else{
		                $json['new_price']['taxeur'] = '';
		            }


				} else {
					$json['new_price']['tax'] = false;
					     $json['new_price']['taxeur'] = '';
				}
				
				$json['success'] = true;
				} else {
					$json['success'] = false;
				}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
  	}
	private function get_options_makeup($option_value, $tax_class_id, $tax_type, $param = 'price'){
		$options_makeup = 0;
		if (!$option_value['subtract'] || ($option_value['quantity'] > 0)) {
			if ((($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) && (float)$option_value[$param]) {
				$price = $this->tax->calculate($option_value[$param], $tax_class_id, $tax_type);
			} else {
				$price = false;
			}
			if ($price) {
				if ($option_value[$param.'_prefix'] === '+') {
					$options_makeup = $options_makeup + (float)$price;
				} else {
					$options_makeup = $options_makeup - (float)$price;
				}
			}
			unset($price);
		}
		return $options_makeup;
	}

	function js() {
		header('Content-Type: application/javascript'); 
		$product_id = isset($this->request->get['product_id']) ? (int)$this->request->get['product_id'] : 0;

		$js = <<<HTML
			var price_with_options_ajax_call = function() {
				$.ajax({
					type: 'POST',
					url: 'index.php?route=extension/basel/live_options/index&product_id=$product_id',
					data: $('{$this->options_container} input[type=\'text\'], {$this->options_container} input[type=\'number\'], {$this->options_container} input[type=\'hidden\'], {$this->options_container} input[type=\'radio\']:checked, {$this->options_container} input[type=\'checkbox\']:checked, {$this->options_container} select, {$this->options_container} textarea'),
					dataType: 'json',
					
					success: function(json) {
						if (json.success) {
							
							if ($('{$this->options_container} {$this->tax_price_container}').length > 0 && json.new_price.tax) {
								animation_on_change_price_with_options('{$this->options_container} {$this->tax_price_container}', json.new_price.tax + ' <small>' + json.new_price.taxeur + '</small>');
							}
							if ($('{$this->options_container} {$this->special_price_container}').length > 0 && json.new_price.special) {
								animation_on_change_price_with_options('{$this->options_container} {$this->special_price_container}', json.new_price.special + ' <small>' + json.new_price.specialeur + '</small>');
							}
							if ($('{$this->options_container} {$this->price_container}').length > 0 && json.new_price.price) {
								animation_on_change_price_with_options('{$this->options_container} {$this->price_container}', json.new_price.price + ' <small>' + json.new_price.priceeur + '</small>');
							}
						}
					},
					error: function(error) {
						console.log('error: '+error);
					}
				});
			}
			
			var animation_on_change_price_with_options = function(selector_class_or_id, new_html_content) {
				$(selector_class_or_id).fadeOut(250, function() {
					$(this).html(new_html_content).fadeIn(150);
				});
			}

			$(document).on('change', '{$this->options_container} input[type=\'text\'], {$this->options_container} input[type=\'number\'], {$this->options_container} input[type=\'hidden\'], {$this->options_container} input[type=\'radio\']:checked, {$this->options_container} input[type=\'checkbox\'], {$this->options_container} select, {$this->options_container} textarea, {$this->options_container} input[name=\'quantity\']', function () {
				
			price_with_options_ajax_call();
			});
		
HTML;
echo $js;
exit;
	}
}
