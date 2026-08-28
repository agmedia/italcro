<?php
class ControllerExtensionBaselLiveSearch extends Controller {
	public function index() {
		$json = array();
		if (isset($this->request->get['filter_name'])) {
			$search = $this->request->get['filter_name'];
		} else {
			$search = '';
		}
		$tag           = $search;
		$category_id   = 0;
		$sub_category  = '';
		$sort          = 'p.sort_order';
		$order         = 'ASC';
		$page          = 1;
		$limit         = 5;
		$search_result = 0;
		$name_limit    = 25;
		$error         = false;
		
		$currency_code = $this->session->data['currency'];

		if(!$error){
		
		$this->load->language('basel/basel_theme');
		$json['basel_text_view_all'] = $this->language->get('basel_text_view_all');
		$json['search_url'] = $this->url->link('product/search');
		$json['basel_text_no_result'] = $this->language->get('basel_text_no_result');
		
			if (isset($this->request->get['filter_name'])) {
				$this->load->model('catalog/product');
				$this->load->model('tool/image');
				$filter_data = array(
					'filter_name'         => $search,
					'filter_tag'          => $tag,
					'filter_category_id'  => $category_id,
					'filter_sub_category' => $sub_category,
					'sort'                => $sort,
					'order'               => $order,
					'start'               => ($page - 1) * $limit,
					'limit'               => $limit
				);
				
					$results = $this->model_catalog_product->getProducts($filter_data);
					$search_result = $this->model_catalog_product->getTotalProducts($filter_data);
					$image_width        = $this->config->get('theme_default_image_cart_width');
					$image_height       = $this->config->get('theme_default_image_cart_height');
					$title_length       = '100';
					$qiqo_price_map = array();

					if ($this->customer->isLogged() && $results) {
						$sku_quantities = array();
						$base_unit_prices = array();

							foreach ($results as $candidate) {
								$is_grouped = !empty($candidate['mpn']) && isset($candidate['mpn_count']) && (int)$candidate['mpn_count'] > 1;
								$sku = trim((string)$candidate['sku']);
							$base_unit = isset($candidate['base_price']) ? (float)$candidate['base_price'] : (float)$candidate['price'];
							$quantity = isset($candidate['pakkol']) && (float)$candidate['pakkol'] > 0
								? (float)$candidate['pakkol']
								: (isset($candidate['minimum']) && (float)$candidate['minimum'] > 0 ? (float)$candidate['minimum'] : 1.0);

								if (!$is_grouped && $sku !== '' && $base_unit > 0) {
								$sku_quantities[$sku] = $quantity;
								$base_unit_prices[$sku] = $base_unit;
							}
						}

						if ($sku_quantities) {
							$qiqo_price_map = $this->model_catalog_product->getQiqoPricingMap(
								(int)$this->customer->getId(),
								$sku_quantities,
								$base_unit_prices,
								false,
								false
							);
						}
					}

					foreach ($results as $result) {
					if ($result['image']) {
						$image = $this->model_tool_image->resize($result['image'], $image_width, $image_height);
					} else {
						$image = $this->model_tool_image->resize('placeholder.png', $image_width, $image_height);
					}

							$is_grouped = !empty($result['mpn']) && isset($result['mpn_count']) && (int)$result['mpn_count'] > 1;
								$display_price = isset($result['base_price']) ? (float)$result['base_price'] : (float)$result['price'];
								$display_special = 0.0;
								$has_display_special = false;
							$sku = trim((string)$result['sku']);

								if (!$is_grouped && $sku !== '' && isset($qiqo_price_map[$sku])) {
								$pricing = $qiqo_price_map[$sku];
								$has_display_special = isset($pricing['old_unit_price']) && $pricing['old_unit_price'] !== false;
							$display_price = isset($pricing['old_unit_price']) && $pricing['old_unit_price'] !== false
								? (float)$pricing['old_unit_price']
								: (float)$pricing['base_unit_price'];
							$display_special = isset($pricing['old_unit_price']) && $pricing['old_unit_price'] !== false
								? (float)$pricing['final_unit_price']
								: 0.0;
						}

						$cent_normalized = strtoupper(preg_replace('/[^A-Z0-9]/i', '', isset($result['cent']) ? (string)$result['cent'] : ''));
						$display_multiplier = $cent_normalized === 'C100' ? 100 : 1;
						$display_price *= $display_multiplier;
						$display_special *= $display_multiplier;

							if (!$is_grouped && (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price'))) {
							$price = $this->currency->format($this->tax->calculate($display_price, $result['tax_class_id'], $this->config->get('config_tax')), $currency_code);

							if($this->session->data['currency']=='HRK'){
		                        $priceeur = $this->currency->format($this->tax->calculate($display_price, $result['tax_class_id'], $this->config->get('config_tax')), 'EUR');
	                    }
	                    else{
	                        $priceeur  ='';

	                    }
					} else {
						$price = false;
						  $priceeur  ='';
					}

							if ($has_display_special) {
							$special = $this->currency->format($this->tax->calculate($display_special, $result['tax_class_id'], $this->config->get('config_tax')), $currency_code);

							if($this->session->data['currency']=='HRK'){
		                        $specialeur = $this->currency->format($this->tax->calculate($display_special, $result['tax_class_id'], $this->config->get('config_tax')),  'EUR');
	                    }
	                    else{
	                        $specialeur  ='';

	                    }
					} else {
						$special = false;
						$specialeur  ='';
					}

					if (strlen($result['name']) > $title_length) {
						$name = utf8_substr(strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')), 0, $title_length) . '..';
					} else {
						$name = html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8');
					}

					
					$json['total'] = (int)$search_result;
					$json['products'][] = array(
						'product_id'  => $result['product_id'],
						'image'       => $image,
						'name' 		  => $name,
						'price'       => $price,
						'special'     => $special,
							'priceeur'       => $priceeur,
						'specialeur'     => $specialeur,
						'url'         => $this->url->link('product/product', 'product_id=' . $result['product_id'])
					);
				}
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}
