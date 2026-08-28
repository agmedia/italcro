<?php  
class ControllerExtensionModuleBaselProducts extends Controller {
	public function index($setting) {

    	$this->load->model('catalog/product');
		$this->load->model('extension/basel/basel');
		$this->load->language('basel/basel_theme');	
  		
		$data['basel_button_quickview'] = $this->language->get('basel_button_quickview');
		$data['basel_text_new'] = $this->language->get('basel_text_new');
		$data['basel_text_out_of_stock'] = $this->language->get('basel_text_out_of_stock');
		$data['basel_text_days'] = $this->language->get('basel_text_days');
		$data['basel_text_hours'] = $this->language->get('basel_text_hours');
		$data['basel_text_mins'] = $this->language->get('basel_text_mins');
		$data['basel_text_secs'] = $this->language->get('basel_text_secs');
		
		$data['button_cart'] = $this->language->get('button_cart');
		$data['button_wishlist'] = $this->language->get('button_wishlist');
		$data['button_compare'] = $this->language->get('button_compare');
		$data['text_tax'] = $this->language->get('text_tax');
		
		// RTL support
		$data['direction'] = $this->language->get('direction');
		if ($this->language->get('direction') == 'rtl') { $data['tooltip_align'] = 'right'; } else { $data['tooltip_align'] = 'left'; }
		
		// Block title
		$data['block_title'] = $setting['use_title'];
		$data['title_preline'] = false;
		$data['title'] = false;
		$data['title_subline'] = false;
		$data['link_title'] = false;
		
		$data['contrast'] = $setting['contrast'];
		$data['items_mobile_fw'] = $this->config->get('items_mobile_fw');
		
		if (!empty($setting['title_pl'][$this->config->get('config_language_id')])) {
		$data['title_preline'] = html_entity_decode($setting['title_pl'][$this->config->get('config_language_id')], ENT_QUOTES, 'UTF-8');
		}
		if (!empty($setting['title_m'][$this->config->get('config_language_id')])) {
		$data['title'] = html_entity_decode($setting['title_m'][$this->config->get('config_language_id')], ENT_QUOTES, 'UTF-8');
		}
		if (!empty($setting['title_b'][$this->config->get('config_language_id')])) {
		$data['title_subline'] = html_entity_decode($setting['title_b'][$this->config->get('config_language_id')], ENT_QUOTES, 'UTF-8');
		}
		if (!empty($setting['link_title'][$this->config->get('config_language_id')])) {
		$data['link_title'] = html_entity_decode($setting['link_title'][$this->config->get('config_language_id')], ENT_QUOTES, 'UTF-8');
		}
		
		$data['tabstyle'] = $setting['tabstyle'];
		$data['carousel'] = $setting['carousel'];
		$data['carousel_a'] = $setting['carousel_a'];
		$data['carousel_b'] = $setting['carousel_b'];
		$data['columns'] = $setting['columns'];
		$data['rows'] = $setting['rows'];
		$data['use_margin'] = $setting['use_margin'];
		$data['margin'] = $setting['margin'];
		$data['img_width'] = $setting['image_width'];
		$data['use_button'] = $setting['use_button'];
		$data['link_href'] = $setting['link_href'];
		$data['countdown_status'] = $setting['countdown'];	
		$data['basel_list_style'] = $this->config->get('basel_list_style');
		$data['stock_badge_status'] = $this->config->get('stock_badge_status');
		$data['basel_text_out_of_stock'] = $this->language->get('basel_text_out_of_stock');
		$data['default_button_cart'] = $this->language->get('button_cart');
		$data['salebadge_status'] = $this->config->get('salebadge_status');
		
		static $module = 0;
		
		$data['tabs'] = array();

		$this->load->model('tool/image');
		
		$tabs = $this->config->get('showintabs_tab');
		
		$tabs = isset($tabs) ? $tabs : array();

    	foreach ($tabs as $key => $tab) {
			if(in_array($key, $setting['selected_tabs']['tabs'])) {
				if (!empty($tab['title'][$this->config->get('config_language_id')])) {
					$title = $tab['title'][$this->config->get('config_language_id')];
				}else{
					$title = 'Tab';
				}	
	
				$products = array();
	
				switch ($tab['data_source']) {
					case 'SP': //Select Products
						$results = $this->getSelectProducts($tab,$setting['limit']);
						break;
					case 'PG': //Product Group
						$results = $this->getProductGroups($tab,$setting['limit']);
						break;
					case 'CQ': //Custom Query
						$results = $this->getCustomQuery($tab,$setting['limit']);
						break;
					default: // Empty
						$this->log->write('SHOW_IN_TAB::ERROR: The tab don\'t have product configured.');
						break;
				}
				
				if (isset($results)) {
				$qiqo_price_map = array();
				$qiqo_action_article_map = array();
				$qiqo_action_mpn_map = array();

				if ($results) {
					$sku_quantities = array();
					$base_unit_prices = array();
					$action_skus = array();
					$action_mpns = array();

						foreach ($results as $r) {
							$sku_key = trim((string)$r['sku']);
							$r_mpn_count = isset($r['mpn_count']) ? (int)$r['mpn_count'] : 1;
							$r_is_single_article = empty($r['mpn']) || $r_mpn_count <= 1;
							$r_minimum = $this->qiqoPackQuantity($r);
							$r_pak = isset($r['pak']) ? (int)$r['pak'] : 0;
							$r_list_min = $this->qiqoMinimumStep($r['cent'], $r_pak, $r_minimum);
							$r_base_unit = isset($r['base_price']) ? (float)$r['base_price'] : (float)$r['price'];

							if ($sku_key !== '') {
								$action_skus[] = $sku_key;

								if ($r_is_single_article && $this->customer->isLogged() && $r_base_unit > 0) {
									$sku_quantities[$sku_key] = $r_list_min;
									$base_unit_prices[$sku_key] = $r_base_unit;
								}
							}

						if (isset($r['mpn_count']) && (int)$r['mpn_count'] > 1 && !empty($r['mpn'])) {
							$action_mpns[] = (string)$r['mpn'];
						}
					}

					if ($this->customer->isLogged() && $sku_quantities) {
						$qiqo_price_map = $this->model_catalog_product->getQiqoPricingMap(
							(int)$this->customer->getId(),
							$sku_quantities,
							$base_unit_prices,
								false,
								false
						);
					}

					if ($action_skus) {
						$qiqo_action_article_map = $this->model_catalog_product->getQiqoActionArticleMap($action_skus);
					}

					if ($action_mpns) {
						$qiqo_action_mpn_map = $this->model_catalog_product->getQiqoActionMpnMap($action_mpns);
					}
				}

					foreach ($results as $result) {
						$sku_key = trim((string)$result['sku']);
						$mpn_count = isset($result['mpn_count']) ? (int)$result['mpn_count'] : 1;
						$is_single_article = empty($result['mpn']) || $mpn_count <= 1;
						$minimum = $this->qiqoPackQuantity($result);
						$pak = isset($result['pak']) ? (int)$result['pak'] : 0;
						$list_min = $this->qiqoMinimumStep($result['cent'], $pak, $minimum);

					$display_price_unit = isset($result['base_price']) ? (float)$result['base_price'] : (float)$result['price'];
					$display_special_unit = 0.0;
					$has_display_special = false;
					$qiqo_discount_percent = 0.0;
					$qiqo_action = ($sku_key !== '' && !empty($qiqo_action_article_map[$sku_key]))
						|| (isset($result['mpn_count']) && (int)$result['mpn_count'] > 1 && !empty($result['mpn']) && !empty($qiqo_action_mpn_map[(string)$result['mpn']]));

						if ($is_single_article && $sku_key !== '' && isset($qiqo_price_map[$sku_key])) {
						$pricing = $qiqo_price_map[$sku_key];
						$has_display_special = isset($pricing['old_unit_price']) && $pricing['old_unit_price'] !== false;
							$display_price_unit = isset($pricing['old_unit_price']) && $pricing['old_unit_price'] !== false
								? (float)$pricing['old_unit_price']
								: (float)$pricing['base_unit_price'];
						$display_special_unit = isset($pricing['old_unit_price']) && $pricing['old_unit_price'] !== false
							? (float)$pricing['final_unit_price']
							: 0.0;
							$qiqo_discount_percent = isset($pricing['discount_percent']) ? (float)$pricing['discount_percent'] : 0.0;
					}

					if ($result['image']) {
					$image = $this->model_tool_image->resize($result['image'], $setting['image_width'], $setting['image_height']);
					} else {
					$image = $this->model_tool_image->resize('placeholder.png', $setting['image_width'], $setting['image_height']);
					}
					
					$images = $this->model_catalog_product->getProductImages($result['product_id']);
					if(isset($images[0]['image']) && !empty($images[0]['image'])){
					$images =$images[0]['image'];
				   	} else {
					$images = false;
					}
					
					if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
						$price = $this->currency->format($this->tax->calculate($display_price_unit, $result['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);

						if($this->session->data['currency']=='HRK'){
                        $priceeur = $this->currency->format($this->tax->calculate($display_price_unit, $result['tax_class_id'], $this->config->get('config_tax')), 'EUR');
	                    }
	                    else{
	                        $priceeur = $this->currency->format($this->tax->calculate($display_price_unit, $result['tax_class_id'], $this->config->get('config_tax')), 'HRK');

	                    }
					} else {
						$price = false;
						$priceeur  ='';
					}
							
					if ($has_display_special) {
						$special = $this->currency->format($this->tax->calculate($display_special_unit, $result['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);

						if($this->session->data['currency']=='HRK'){
                        $specialeur = $this->currency->format($this->tax->calculate($display_special_unit, $result['tax_class_id'], $this->config->get('config_tax')),  'EUR');
                    }
                    else{
                        $specialeur = $this->currency->format($this->tax->calculate($display_special_unit, $result['tax_class_id'], $this->config->get('config_tax')),  'HRK');

                    }
						$date_end = $this->model_extension_basel_basel->getSpecialEndDate($result['product_id']);
					} else {
						$special = false;
						 $specialeur  ='';
						$date_end = false;
					}
					
					if ($has_display_special && ($this->config->get('salebadge_status'))) {
						if ($this->config->get('salebadge_status') == '2') {
							$sale_badge = '-' . number_format(((($this->tax->calculate($display_price_unit, $result['tax_class_id'], $this->config->get('config_tax')))-($this->tax->calculate($display_special_unit, $result['tax_class_id'], $this->config->get('config_tax'))))/(($this->tax->calculate($display_price_unit, $result['tax_class_id'], $this->config->get('config_tax')))/100)), 0, ',', '.') . '%';
						} else {
							$sale_badge = $this->language->get('basel_text_sale');
						}		
					} else {
						$sale_badge = false;
					}

					$image2 = $this->model_catalog_product->getProductImages($result['product_id']);
					if(isset($image2[0]['image']) && !empty($image2[0]['image']) && $this->config->get('basel_thumb_swap')){
						$image2 = $image2[0]['image'];
					} else {
						$image2 = false;
					}

					if (strtotime($result['date_available']) > strtotime('-' . $this->config->get('newlabel_status') . ' day')) {
						$is_new = true;
					} else {
						$is_new = false;
					}
					if ($this->config->get('config_tax')) {
					$tax = $this->currency->format($has_display_special ? $display_special_unit : $display_price_unit, $this->session->data['currency']);
					} else {
						$tax = false;
					}	
					if ($this->config->get('config_review_status')) {
						$rating = $result['rating'];
					} else {
						$rating = false;
					}

                    if ($this->config->get('config_customer_price') && !$this->customer->isLogged()) {
                        $data['attention'] = '1';
                    } else {
                        $data['attention'] = '';
                    }

                    $price_raw = (float)$display_price_unit;
                    $special_raw = (float)$display_special_unit;
                    $preview_price_alt = false;
					$preview_price_basis = strtoupper(preg_replace('/[^A-Z0-9]/', '', (string)$result['cent'])) === 'C100' ? 100.0 : $list_min;

					if ($has_display_special) {
                        $preview_price_raw = $special_raw * $preview_price_basis;
                        $preview_price_alt_raw = $price_raw * $preview_price_basis;

                        $preview_price_alt = $this->currency->format(
                            $this->tax->calculate(
                                $preview_price_alt_raw,
                                $result['tax_class_id'],
                                $this->config->get('config_tax')
                            ),
                            $this->session->data['currency']
                        );
                    } else {
                        $preview_price_raw = $price_raw * $preview_price_basis;
                    }

// Formatirana preview cijena u aktivnoj valuti
					$preview_price = ($has_display_special || $preview_price_raw > 0) ? $this->currency->format(
                        $this->tax->calculate(
                            $preview_price_raw,
                            $result['tax_class_id'],
                            $this->config->get('config_tax')
                        ),
                        $this->session->data['currency']
                    ) : false;
					
					$products[] = array(
						'product_id' => $result['product_id'],
						'quantity'  => isset($result['quantity']) ? (int)$result['quantity'] : 0,
						'thumb'   	 => $image,
						'thumb2' 	 => $this->model_tool_image->resize($image2, $setting['image_width'], $setting['image_height']),
						'sale_end_date' => $date_end['date_end'] ?? '',
						'name'    	 => $result['name'],
                        'name_add'        => $result['name_add'],
						'price'   	 => $price,
						'attribute_groups'       => $this->model_catalog_product->getProductAttributes($result['product_id']),

                        'attention'     => $data['attention'],
						'new_label'  => $is_new,
						'sale_badge' => $sale_badge,
                        'special' 	 => $special,
                        'pak'  => $pak,
                        'cent'  => $result['cent'],
                        'sku'  => $result['sku'],
                        'list_min' => $list_min,
                        'decimal_quantity' => $this->qiqoAllowsDecimalQuantity($result),
                        'qiqo_discount_percent' => $qiqo_discount_percent,
                        'qiqo_action' => $qiqo_action,

                        // NEW
                        'preview_price'     => $preview_price,
                        'preview_price_alt' => $preview_price_alt,

	                        'mpn_count'       => $mpn_count,
	                        'mpn_artikl'  => $this->artiklLabel($mpn_count),
	                        'is_single_article' => $is_single_article,
							'tax'        => $tax,
						'minimum'    => $minimum,
						'rating'     => $rating,
						'reviews'    => sprintf($this->language->get('text_reviews'), (int)$result['reviews']),
						'href'    	 => $this->url->link('product/product', 'product_id=' . $result['product_id']),
					);
				}
				}

				$data['tabs'][] = array(
					'title' => $title,
					'products' => $products
				);
			}
    	}
		
		
    	$data['button_cart'] = $this->language->get('button_cart');
		
		$data['module'] = $module++;

		if ($this->config->get('theme_default_directory') == 'basel')
		return $this->load->view('extension/module/basel_products', $data);
		
  	}

  	private function getProductGroups( $tabInfo , $limit ){
  		$results = array();

  		switch ( $tabInfo['product_group'] ) {
  			case 'BS':
  				$results = $this->model_catalog_product->getBestSellerProducts($limit);
  				break;
  			case 'LA':
  				$results = $this->model_catalog_product->getLatestProducts($limit);
  				break;
  			case 'SP':
  				$results = $this->model_catalog_product->getProductSpecials(array('start' => 0,'limit' => $limit));
  				break;
  			case 'PP':
  				$results = $this->model_catalog_product->getPopularProducts($limit);
  				break;
  		}
  		return $results;
  	}

  	private function getSelectProducts( $tabInfo , $limit ){
  		$results = array();

  		if(isset($tabInfo['products'])){
  			$limit_count = 0;
			foreach ( $tabInfo['products'] as $product ) {
				if ($limit_count++ == $limit) break;
				$product_info = $this->model_catalog_product->getProduct($product['product_id']);
				if ($product_info) {
					$results[$product['product_id']] = $this->model_catalog_product->getProduct($product['product_id']);
				}
			}
		}

		return $results;

  	}

  	private function getCustomQuery( $tabInfo , $limit){
  		$results = array();

  		if ( $tabInfo['sort'] == 'rating' || $tabInfo['sort'] == 'p.date_added') {
  			$order = 'DESC';
  		}else{
  			$order = 'ASC';
  		}

  		$data = array(
  			'filter_category_id' => $tabInfo['filter_category']=='ALL' ? '' : $tabInfo['filter_category'], 
  			'filter_manufacturer_id' => $tabInfo['filter_manufacturer']=='ALL' ? '' : $tabInfo['filter_manufacturer'], 
  			'sort' => $tabInfo['sort'], 
  			'order' => $order,
  			'start' => 0,
  			'limit' => $limit
  		);

  		$results = $this->model_catalog_product->getProducts($data);

		return $results;
  	}

    function artiklLabel($broj) {
        $broj = abs($broj) % 100;
        $jedinica = $broj % 10;

        if ($broj > 10 && $broj < 20) {
            return "artikala";
        }

        if ($jedinica == 1) {
            return "artikl";
        }

        if ($jedinica >= 2 && $jedinica <= 4) {
            return "artikla";
        }

        return "artikala";
    }

    private function qiqoPackQuantity($product) {
        $jm = isset($product['jm']) && trim((string)$product['jm']) !== '' ? $product['jm'] : (isset($product['ean']) ? $product['ean'] : '');
        $attribute = isset($product['name_add']) ? str_replace(',', '.', trim((string)$product['name_add'])) : '';
        if (strtoupper(trim((string)$jm)) === 'MET' && preg_match('/(^|[^0-9])([0-9]+(?:\\.[0-9]+)?)\\s*m([^a-z0-9]|$)/i', $attribute, $match)) {
            $meter_length = (float)$match[2];
            if ($meter_length > 0 && abs($meter_length - round($meter_length)) > 0.00001) {
                return $meter_length;
            }
        }

        $pakkol = isset($product['pakkol']) ? (float)$product['pakkol'] : 0.0;
        if ($pakkol <= 0) {
            $pakkol = isset($product['minimum']) ? (float)$product['minimum'] : 1.0;
        }

        return $pakkol > 0 ? $pakkol : 1.0;
    }

    private function qiqoMinimumStep($cent, $pak, $pakkol) {
        $cent_normalized = strtoupper(preg_replace('/[^A-Z0-9]/', '', (string)$cent));
        $step = ($cent_normalized === 'C100' || (int)$pak === 1 || abs((float)$pakkol - round((float)$pakkol)) > 0.00001) ? (float)$pakkol : 1.0;

        return $step > 0 ? $step : 1.0;
    }

    private function qiqoJm($product) {
        if (isset($product['jm']) && trim((string)$product['jm']) !== '') {
            return $product['jm'];
        }

        return isset($product['ean']) ? $product['ean'] : '';
    }

    private function qiqoAllowsDecimalQuantity($product) {
        $jm = strtoupper(trim((string)$this->qiqoJm($product)));
        $pakkol = $this->qiqoPackQuantity($product);
        $attribute = isset($product['name_add']) ? str_replace(',', '.', trim((string)$product['name_add'])) : '';

        return abs($pakkol - round($pakkol)) > 0.00001
            || ($jm === 'MET' && preg_match('/(^|[^0-9])\\d+\\.\\d+\\s*m([^a-z0-9]|$)/i', $attribute));
    }

}
