<?php
class ControllerProductProduct extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('product/product');
	if (isset($this->session->data['error'])) {
		$data['error_warning'] = $this->session->data['error'];

			unset($this->session->data['error']);
        }
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$this->load->model('catalog/category');

		if (isset($this->request->get['path'])) {
			$path = '';

			$parts = explode('_', (string)$this->request->get['path']);

			$category_id = (int)array_pop($parts);

			foreach ($parts as $path_id) {
				if (!$path) {
					$path = $path_id;
				} else {
					$path .= '_' . $path_id;
				}

				$category_info = $this->model_catalog_category->getCategory($path_id);

				if ($category_info) {
					$data['breadcrumbs'][] = array(
						'text' => $category_info['name'],
						'href' => $this->url->link('product/category', 'path=' . $path)
					);
				}
			}

			// Set the last category breadcrumb
			$category_info = $this->model_catalog_category->getCategory($category_id);

			if ($category_info) {
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

				if (isset($this->request->get['limit'])) {
					$url .= '&limit=' . $this->request->get['limit'];
				}

				$data['breadcrumbs'][] = array(
					'text' => $category_info['name'],
					'href' => $this->url->link('product/category', 'path=' . $this->request->get['path'] . $url)
				);
			}
		}

		$this->load->model('catalog/manufacturer');

		if (isset($this->request->get['manufacturer_id'])) {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_brand'),
				'href' => $this->url->link('product/manufacturer')
			);

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

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$manufacturer_info = $this->model_catalog_manufacturer->getManufacturer($this->request->get['manufacturer_id']);

			if ($manufacturer_info) {
				$data['breadcrumbs'][] = array(
					'text' => $manufacturer_info['name'],
					'href' => $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $this->request->get['manufacturer_id'] . $url)
				);
			}
		}

		if (isset($this->request->get['search']) || isset($this->request->get['tag'])) {
			$url = '';

			if (isset($this->request->get['search'])) {
				$url .= '&search=' . $this->request->get['search'];
			}

			if (isset($this->request->get['tag'])) {
				//$url .= '&tag=' . $this->request->get['tag'];
			}

			if (isset($this->request->get['description'])) {
				$url .= '&description=' . $this->request->get['description'];
			}

			if (isset($this->request->get['category_id'])) {
				$url .= '&category_id=' . $this->request->get['category_id'];
			}

			if (isset($this->request->get['sub_category'])) {
				$url .= '&sub_category=' . $this->request->get['sub_category'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_search'),
				'href' => $this->url->link('product/search', $url)
			);
		}

		if (isset($this->request->get['product_id'])) {
			$product_id = (int)$this->request->get['product_id'];
		} else {
			$product_id = 0;
		}

		$this->load->model('catalog/product');

		//$product_info = $this->model_catalog_product->getProduct($product_id);

        $store_id = (int)$this->config->get('config_store_id');
        $lang_id  = (int)$this->config->get('config_language_id');

       // Verzija cache-a za ovaj product (bump u adminu)
        $ppver = $this->ppCacheVersion($product_id);

        $base = "pp.$store_id.$lang_id.$product_id.v$ppver";

          // 1) Product
	        $key = $base . '.info';
	        $product_info = $this->ppCacheGet($key);
	        if ($product_info === false) {
	            $product_info = $this->model_catalog_product->getProduct($product_id);
	            $this->ppCacheSet($key, $product_info);
	        }
		        if ($product_info !== false && (!array_key_exists('base_price', $product_info) || !array_key_exists('pak', $product_info) || !array_key_exists('vpc', $product_info))) {
		            $product_info = $this->model_catalog_product->getProduct($product_id);
		            $this->ppCacheSet($key, $product_info);
		        }

					$data['qiqo_discount_percent'] = 0;
					$data['qiqo_action'] = false;
				$data['mpn_count'] = ($product_info && isset($product_info['mpn_count'])) ? (int)$product_info['mpn_count'] : 1;
				$data['is_single_article'] = !$product_info || empty($product_info['mpn']) || $data['mpn_count'] <= 1;
				if ($product_info) {
					$main_sku = trim((string)$product_info['sku']);
				if ($main_sku !== '') {
					$main_action_map = $this->model_catalog_product->getQiqoActionArticleMap(array($main_sku));
					$data['qiqo_action'] = !empty($main_action_map[$main_sku]);
				}

				if (!$data['qiqo_action'] && !empty($product_info['mpn'])) {
					$main_action_mpn_map = $this->model_catalog_product->getQiqoActionMpnMap(array((string)$product_info['mpn']));
					$data['qiqo_action'] = !empty($main_action_mpn_map[(string)$product_info['mpn']]);
				}

					if ($data['is_single_article'] && $this->customer->isLogged() && $main_sku !== '') {
						$main_minimum = ($product_info['minimum'] > 0) ? (int)$product_info['minimum'] : 1;
						$main_base_unit = isset($product_info['base_price']) ? (float)$product_info['base_price'] : (float)$product_info['price'];

					if ($main_base_unit > 0) {
						$main_map = $this->model_catalog_product->getQiqoPricingMap(
							(int)$this->customer->getId(),
							array($main_sku => $main_minimum),
							array($main_sku => $main_base_unit),
							false,
							false
						);

						if (isset($main_map[$main_sku])) {
							$main_pricing = $main_map[$main_sku];
							if (isset($main_pricing['old_unit_price']) && $main_pricing['old_unit_price'] !== false) {
								$product_info['price'] = (float)$main_pricing['old_unit_price'];
								$product_info['special'] = (float)$main_pricing['final_unit_price'];
							} else {
								$product_info['price'] = isset($main_pricing['base_unit_price']) ? (float)$main_pricing['base_unit_price'] : (float)$main_pricing['final_unit_price'];
								$product_info['special'] = null;
							}
							$data['qiqo_discount_percent'] = isset($main_pricing['base_discount_percent']) ? (float)$main_pricing['base_discount_percent'] : 0.0;
						}
					}
				}
			}


	        $minimum = ($product_info['minimum'] > 0) ? (int)$product_info['minimum'] : 1;

        $price_raw   = (float)$product_info['price'];
        $special_raw = (float)$product_info['special'];



// default
        $data['preview_price_old'] = false;
        $data['preview_price_new'] = false;

        if ($price_raw > 0) {
            // uvijek izračunaj "novo" (ako nema special, novo je regular)
            $new_unit = ($special_raw > 0) ? $special_raw : $price_raw;
            $new_total = $new_unit * $minimum;

            $data['preview_price_new'] = $this->currency->format(
                $this->tax->calculate($new_total, $product_info['tax_class_id'], $this->config->get('config_tax')),
                $this->session->data['currency']
            );

            // ako ima special, izračunaj i "staro"
            if ($special_raw > 0) {
                $old_total = $price_raw * $minimum;

                $data['preview_price_old'] = $this->currency->format(
                    $this->tax->calculate($old_total, $product_info['tax_class_id'], $this->config->get('config_tax')),
                    $this->session->data['currency']
                );
            }

            $data['preview_text_tax_included'] = false;

// samo ako imamo preview_price_new
            if ($new_total > 0) {
                $data['preview_text_tax_included'] = $this->currency->format(
                    $new_total, // ⬅️ BEZ PDV-a
                    $this->session->data['currency']
                );
            }

        }


        //$same_mpn_products = $this->model_catalog_product->getProductsByMPN($product_info['mpn'], $product_id);

		//check product page open from cateory page
		/*if (isset($this->request->get['path'])) {
			$parts = explode('_', (string)$this->request->get['path']);
						
			if(empty($this->model_catalog_product->checkProductCategory($product_id, $parts))) {
				$product_info = array();
			}
		}*/

		//check product page open from manufacturer page
		if (isset($this->request->get['manufacturer_id']) && !empty($product_info)) {
			if($product_info['manufacturer_id'] !=  $this->request->get['manufacturer_id']) {
				$product_info = array();
			}
		}


        if ($this->config->get('config_customer_price') && !$this->customer->isLogged()) {
            $data['attention'] = sprintf($this->language->get('text_login_price'), $this->url->link('account/login'), $this->url->link('account/register'));
        } else {
            $data['attention'] = '';
        }


        if ($product_info) {
			$url = '';



            if (isset($this->request->get['path'])) {
				$url .= '&path=' . $this->request->get['path'];
			}

			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}

			if (isset($this->request->get['manufacturer_id'])) {
				$url .= '&manufacturer_id=' . $this->request->get['manufacturer_id'];
			}

			if (isset($this->request->get['search'])) {
				$url .= '&search=' . $this->request->get['search'];
			}

			if (isset($this->request->get['tag'])) {
				//$url .= '&tag=' . $this->request->get['tag'];
			}

			if (isset($this->request->get['description'])) {
				$url .= '&description=' . $this->request->get['description'];
			}

			if (isset($this->request->get['category_id'])) {
				$url .= '&category_id=' . $this->request->get['category_id'];
			}

			if (isset($this->request->get['sub_category'])) {
				$url .= '&sub_category=' . $this->request->get['sub_category'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$data['breadcrumbs'][] = array(
				'text' => $product_info['name'],
				'href' => $this->url->link('product/product', $url . '&product_id=' . $this->request->get['product_id'])
			);

			$this->document->setTitle($product_info['meta_title']);
			$this->document->setDescription($product_info['meta_description']);
			$this->document->setKeywords($product_info['meta_keyword']);
			$this->document->addLink($this->url->link('product/product', 'product_id=' . $this->request->get['product_id']), 'canonical');
			$this->document->addScript('catalog/view/javascript/jquery/magnific/jquery.magnific-popup.min.js');
			$this->document->addStyle('catalog/view/javascript/jquery/magnific/magnific-popup.css');
			$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/moment/moment.min.js');
			$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/moment/moment-with-locales.min.js');
			$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js');
			$this->document->addStyle('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css');

			$data['heading_title'] = $product_info['name'];

			$data['text_minimum'] = sprintf($this->language->get('text_minimum'), $product_info['minimum']);
			$data['text_login'] = sprintf($this->language->get('text_login'), $this->url->link('account/login', '', true), $this->url->link('account/register', '', true));

			$this->load->model('catalog/review');

			$data['tab_review'] = sprintf($this->language->get('tab_review'), $product_info['reviews']);

			$data['product_id'] = (int)$this->request->get['product_id'];
			$data['manufacturer'] = $product_info['manufacturer'];
			$data['manufacturers'] = $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $product_info['manufacturer_id']);
			$data['model'] = $product_info['model'];
            $data['sku'] = $product_info['sku'];
            $data['ean'] = $product_info['ean'];
			$data['reward'] = $product_info['reward'];
			$data['points'] = $product_info['points'];
			$data['description'] = html_entity_decode($product_info['description'], ENT_QUOTES, 'UTF-8');

		/*	if ($product_info['quantity'] <= 0) {
				$data['stock'] = $product_info['stock_status'];
			} elseif ($this->config->get('config_stock_display')) {
				$data['stock'] = $product_info['quantity'];
			} else {
				$data['stock'] = $this->language->get('text_instock');
			}*/


            if(isset($product_info['stock_status']) ) {
              $data['stock'] = $product_info['stock_status'];
            } else {
				$data['stock'] = $this->language->get('text_instock');
			}



			$data['quantity'] = $product_info['quantity'];
			$this->load->model('tool/image');

			if ($product_info['image']) {
				$data['popup'] = $product_info['image'];
			} else {
				$data['popup'] = 'catalog/placeholders/placeholder.png';
			}

			if ($product_info['image']) {
				$data['thumb'] = $this->model_tool_image->resize($product_info['image'], $this->config->get('theme_' . $this->config->get('config_theme') . '_image_thumb_width'), $this->config->get('theme_' . $this->config->get('config_theme') . '_image_thumb_height'));
			} else {
				$data['thumb'] = 'image/catalog/placeholders/placeholder.png';
			}

			$data['images'] = array();

            // 2) Product images (raw lista)
            $key = $base . '.images';
            $results = $this->ppCacheGet($key);
            if ($results === false) {
                $results = $this->model_catalog_product->getProductImages($product_id);
                $this->ppCacheSet($key, $results);
            }

            $data['images'] = array();
            foreach ($results as $result) {
                $data['images'][] = array(
                    'popup'    => 'image/' . $result['image'],
                    'thumb'    => $this->model_tool_image->resize(
                        $result['image'],
                        $this->config->get('theme_' . $this->config->get('config_theme') . '_image_additional_width'),
                        $this->config->get('theme_' . $this->config->get('config_theme') . '_image_additional_height')
                    ),
                    'thumb_lg' => $this->model_tool_image->resize(
                        $result['image'],
                        $this->config->get('theme_' . $this->config->get('config_theme') . '_image_popup_width'),
                        $this->config->get('theme_' . $this->config->get('config_theme') . '_image_popup_height')
                    )
                );
            }





            if ($this->customer->isLogged() || !$this->config->get('config_customer_price')) {
				$data['price'] = $this->currency->format($this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);

				if($this->session->data['currency']=='HRK'){
                    $data['priceeur'] = $this->currency->format($this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax')), 'EUR');

                }
                else{
                    $data['priceeur'] = $this->currency->format($this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax')), 'HRK');

                }
			} else {
				$data['price'] = false;

				  $data['priceeur'] ='';
			}

			if (!is_null($product_info['special']) && (float)$product_info['special'] >= 0) {
				$data['special'] = $this->currency->format($this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);

				  if($this->session->data['currency']=='HRK'){
                    $data['specialeur'] = $this->currency->format($this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax')), 'EUR');
                }
                else{
                    $data['specialeur'] = $this->currency->format($this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax')), 'HRK');

                }


				$tax_price = (float)$product_info['special'];
			} else {
				$data['special'] = false;
				 $data['specialeur']  ='';
				$tax_price = (float)$product_info['price'];
			}

            $final_price = isset($product_info['special']) ? $product_info['special'] : $product_info['price'];

		

            $data['three_rates'] = number_format(($final_price / 3), '2', '.', '');
            $data['six_rates'] = number_format(($final_price / 6), '2', '.', '');
            $data['twelve_rates'] = number_format(($final_price / 12), '2', '.', '');

              if($this->session->data['currency']=='HRK'){

					$final_priceeur = $final_price / 7.53450;
		             $data['three_rateseur'] = number_format(($final_priceeur / 3), '2', '.', '');
		            $data['six_rateseur'] = number_format(($final_priceeur / 6), '2', '.', '');
		            $data['twelve_rateseur'] = number_format(($final_priceeur / 12), '2', '.', '');
	           } else{
			           	$final_priceeur = '';
			           	$data['three_rateseur'] = '';
			           	$data['six_rateseur'] = '';
			           	$data['twelve_rateseur'] = '';
	           }

            if(isset($product_info['special'])){
                $data['stedis'] = $product_info['price'] - $product_info['special'];

                $data['stedis'] = $this->currency->format($this->tax->calculate($data['stedis'], $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);

                if($this->session->data['currency']=='HRK'){
                    $data['stediseur'] = $this->currency->format($this->tax->calculate($data['stedis'], $product_info['tax_class_id'], $this->config->get('config_tax')), 'EUR');

                }
                else{
                   $data['stediseur'] = $this->currency->format($this->tax->calculate($data['stedis'], $product_info['tax_class_id'], $this->config->get('config_tax')), 'HRK');

                }
            }

            else{

                $data['stedis'] = '';
                  $data['stediseur']  ='';
            }



            if ($this->config->get('config_tax')) {
				$data['tax'] = $this->currency->format($tax_price, $this->session->data['currency']);
			} else {
				$data['tax'] = false;
			}

			$discounts = $this->model_catalog_product->getProductDiscounts($this->request->get['product_id']);

			$data['discounts'] = array();

			foreach ($discounts as $discount) {
				$data['discounts'][] = array(
					'quantity' => $discount['quantity'],
					'price'    => $this->currency->format($this->tax->calculate($discount['price'], $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency'])
				);
			}

			$data['options'] = array();

			foreach ($this->model_catalog_product->getProductOptions($this->request->get['product_id']) as $option) {
				$product_option_value_data = array();

				foreach ($option['product_option_value'] as $option_value) {
					if (!$option_value['subtract'] || ($option_value['quantity'] > 0)) {
						if ((($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) && (float)$option_value['price']) {
							$price = $this->currency->format($this->tax->calculate($option_value['price'], $product_info['tax_class_id'], $this->config->get('config_tax') ? 'P' : false), $this->session->data['currency']);
						} else {
							$price = false;
						}

						$product_option_value_data[] = array(
							'product_option_value_id' => $option_value['product_option_value_id'],
							'option_value_id'         => $option_value['option_value_id'],
							'name'                    => $option_value['name'],
							'image'                   => $this->model_tool_image->resize($option_value['image'], 50, 50),
							'price'                   => $price,
							'price_prefix'            => $option_value['price_prefix'],
                            'color'                    => isset($option_value['color']) ? $option_value['color'] : ''
						);
					}
				}

				$data['options'][] = array(
					'product_option_id'    => $option['product_option_id'],
					'product_option_value' => $product_option_value_data,
					'option_id'            => $option['option_id'],
					'name'                 => $option['name'],
					'type'                 => $option['type'],
					'value'                => $option['value'],
					'required'             => $option['required']
				);
			}

			if ($product_info['minimum']) {
				$data['minimum'] = $product_info['minimum'];
			} else {
				$data['minimum'] = 1;
			}




			$data['review_status'] = $this->config->get('config_review_status');

			if ($this->config->get('config_review_guest') || $this->customer->isLogged()) {
				$data['review_guest'] = true;
			} else {
				$data['review_guest'] = false;
			}

			if ($this->customer->isLogged()) {
				$data['customer_name'] = $this->customer->getFirstName() . '&nbsp;' . $this->customer->getLastName();
			} else {
				$data['customer_name'] = '';
			}

			$data['reviews'] = sprintf($this->language->get('text_reviews'), (int)$product_info['reviews']);
			$data['rating'] = (int)$product_info['rating'];

			// Captcha
			if ($this->config->get('captcha_' . $this->config->get('config_captcha') . '_status') && in_array('review', (array)$this->config->get('config_captcha_page'))) {
				$data['captcha'] = $this->load->controller('extension/captcha/' . $this->config->get('config_captcha'));
			} else {
				$data['captcha'] = '';
			}

			$data['share'] = $this->url->link('product/product', 'product_id=' . (int)$this->request->get['product_id']);

            $key = $base . '.attrs';
            $data['attribute_groups'] = $this->ppCacheGet($key);
            if ($data['attribute_groups'] === false) {
                $data['attribute_groups'] = $this->model_catalog_product->getProductAttributes($product_id);
                $this->ppCacheSet($key, $data['attribute_groups']);
            }

			$data['products'] = array();

			//$results = $this->model_catalog_product->getProductRelated($this->request->get['product_id']);

            $key = $base . '.related';
            $results = $this->ppCacheGet($key);
	            if ($results === false) {
	                $results = $this->model_catalog_product->getProductRelated($product_id);
	                $this->ppCacheSet($key, $results);
	            }

				$related_qiqo_price_map = array();
				$related_qiqo_action_article_map = array();
				$related_qiqo_action_mpn_map = array();
				if ($results) {
					$related_sku_quantities = array();
					$related_base_unit_prices = array();
					$related_action_skus = array();
					$related_action_mpns = array();

						foreach ($results as $r) {
							$r_sku = trim((string)$r['sku']);
							$r_mpn_count = isset($r['mpn_count']) ? (int)$r['mpn_count'] : 1;
							$r_is_single_article = empty($r['mpn']) || $r_mpn_count <= 1;
							$r_minimum = $r['minimum'] > 0 ? (int)$r['minimum'] : 1;
							$r_list_min = ((string)$r['cent'] === 'C-100') ? $r_minimum : 1;
							$r_base_unit = isset($r['base_price']) ? (float)$r['base_price'] : (float)$r['price'];

						if ($r_sku !== '') {
							$related_action_skus[] = $r_sku;

								if ($r_is_single_article && $this->customer->isLogged() && $r_base_unit > 0) {
									$related_sku_quantities[$r_sku] = $r_list_min;
									$related_base_unit_prices[$r_sku] = $r_base_unit;
								}
						}

						if (isset($r['mpn_count']) && (int)$r['mpn_count'] > 1 && !empty($r['mpn'])) {
							$related_action_mpns[] = (string)$r['mpn'];
						}
					}

					if ($this->customer->isLogged() && $related_sku_quantities) {
						$related_qiqo_price_map = $this->model_catalog_product->getQiqoPricingMap(
							(int)$this->customer->getId(),
							$related_sku_quantities,
							$related_base_unit_prices,
							false,
							false
						);
					}

					if ($related_action_skus) {
						$related_qiqo_action_article_map = $this->model_catalog_product->getQiqoActionArticleMap($related_action_skus);
					}

					if ($related_action_mpns) {
						$related_qiqo_action_mpn_map = $this->model_catalog_product->getQiqoActionMpnMap($related_action_mpns);
					}
				}

				$related_image_width = (int)$this->config->get('theme_' . $this->config->get('config_theme') . '_image_product_width');
				$related_image_height = (int)$this->config->get('theme_' . $this->config->get('config_theme') . '_image_product_height');

				if ($related_image_width <= 0) {
					$related_image_width = (int)$this->config->get('theme_' . $this->config->get('config_theme') . '_image_related_width');
				}

				if ($related_image_height <= 0) {
					$related_image_height = (int)$this->config->get('theme_' . $this->config->get('config_theme') . '_image_related_height');
				}

					foreach ($results as $result) {
						$row_sku_key = trim((string)$result['sku']);
						$mpn_count = isset($result['mpn_count']) ? (int)$result['mpn_count'] : 1;
						$is_single_article = empty($result['mpn']) || $mpn_count <= 1;
						$minimum = $result['minimum'] > 0 ? (int)$result['minimum'] : 1;
						$list_min = ((string)$result['cent'] === 'C-100') ? $minimum : 1;

					$display_price_unit = isset($result['base_price']) ? (float)$result['base_price'] : (float)$result['price'];
					$display_special_unit = 0.0;
					$qiqo_discount_percent = 0.0;
					$qiqo_action = ($row_sku_key !== '' && !empty($related_qiqo_action_article_map[$row_sku_key]))
						|| (isset($result['mpn_count']) && (int)$result['mpn_count'] > 1 && !empty($result['mpn']) && !empty($related_qiqo_action_mpn_map[(string)$result['mpn']]));

						if ($is_single_article && $row_sku_key !== '' && isset($related_qiqo_price_map[$row_sku_key])) {
							$row_pricing = $related_qiqo_price_map[$row_sku_key];
							$display_price_unit = isset($row_pricing['old_unit_price']) && $row_pricing['old_unit_price'] !== false
								? (float)$row_pricing['old_unit_price']
							: (float)$row_pricing['base_unit_price'];
						$display_special_unit = isset($row_pricing['old_unit_price']) && $row_pricing['old_unit_price'] !== false
							? (float)$row_pricing['final_unit_price']
							: 0.0;
						$qiqo_discount_percent = isset($row_pricing['base_discount_percent']) ? (float)$row_pricing['base_discount_percent'] : 0.0;
					}

					if ($result['image']) {
						$image = $this->model_tool_image->resize($result['image'], $related_image_width, $related_image_height);
					} else {
					$image = $this->model_tool_image->resize('placeholder.png', $related_image_width, $related_image_height);
				}

					if ($this->customer->isLogged() || !$this->config->get('config_customer_price')) {
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

					if ($display_special_unit > 0) {
						$special = $this->currency->format($this->tax->calculate($display_special_unit, $result['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);

						if($this->session->data['currency']=='HRK'){
	                        $specialeur = $this->currency->format($this->tax->calculate($display_special_unit, $result['tax_class_id'], $this->config->get('config_tax')),  'EUR');
	                    }
	                    else{
	                        $specialeur = $this->currency->format($this->tax->calculate($display_special_unit, $result['tax_class_id'], $this->config->get('config_tax')),  'HRK');

	                    }
						$tax_price = (float)$display_special_unit;
					} else {
						$special = false;
						$tax_price = (float)$display_price_unit;

					 $specialeur  ='';
				}
	
				if ($this->config->get('config_tax')) {
					$tax = $this->currency->format($tax_price, $this->session->data['currency']);
				} else {
					$tax = false;
				}

				if ($this->config->get('config_review_status')) {
					$rating = (int)$result['rating'];
				} else {
					$rating = false;
				}

                if ($this->config->get('config_customer_price') && !$this->customer->isLogged()) {
                    $data['attention'] = sprintf($this->language->get('text_login_price'), $this->url->link('account/login'), $this->url->link('account/register'));
                } else {
                    $data['attention'] = '';
                }

	                $price_raw   = (float)$display_price_unit;
	                $special_raw = (float)$display_special_unit;

// default: nema "stare" cijene
                $preview_price_alt = false;

// NOVO: ako ima special (>0) onda je novo = special, staro = price
                if ($special_raw > 0) {
	                    $preview_price_raw = $special_raw * $list_min;
	                    $preview_price_alt_raw = $price_raw * $list_min;

                    $preview_price_alt = $this->currency->format(
                        $this->tax->calculate(
                            $preview_price_alt_raw,
                            $result['tax_class_id'],
                            $this->config->get('config_tax')
                        ),
                        $this->session->data['currency']
                    );
                } else {
                    // nema akcije: novo = regular
	                    $preview_price_raw = $price_raw * $list_min;
                }

// NOVA (glavna) preview cijena
                $preview_price = ($preview_price_raw > 0) ? $this->currency->format(
                    $this->tax->calculate(
                        $preview_price_raw,
                        $result['tax_class_id'],
                        $this->config->get('config_tax')
                    ),
                    $this->session->data['currency']
                ) : false;

				$data['products'][] = array(
					'product_id'  => $result['product_id'],
					'thumb'       => $image,
					'name'        => $result['name'],
                    'ean'        => $result['ean'],
                    'name_add'        => $result['name_add'],
					'quantity'    => (int)$result['quantity'],
					'description' => utf8_substr(trim(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8'))), 0, $this->config->get('theme_' . $this->config->get('config_theme') . '_product_description_length')) . '..',
					   //  'attribute_groups'       => $this->model_catalog_product->getProductAttributes($result['product_id']),
					'price'       => $price,
					'special'     => $special,
	                    'mpn_count'       => $mpn_count,
	                    'mpn_artikl'  => $this->artiklLabel($mpn_count),
	                    'is_single_article' => $is_single_article,

                    // NEW
                    'preview_price'     => $preview_price,
                    'preview_price_alt' => $preview_price_alt,
	                    'attention'     => $data['attention'],
	                    'cent'  => $result['cent'],
	                    'sku'  => $result['sku'],
	                    'list_min'    => $list_min,
	                    'qiqo_discount_percent' => $qiqo_discount_percent,
	                    'qiqo_action' => $qiqo_action,
						'tax'         => $tax,
					'minimum'     => $result['minimum'] > 0 ? $result['minimum'] : 1,
					'rating'      => $rating,
					'href'        => $this->url->link('product/product', 'product_id=' . $result['product_id'])
				);
			}

			$data['tags'] = array();

			if ($product_info['tag']) {
				$tags = explode(',', $product_info['tag']);

				foreach ($tags as $tag) {
					$data['tags'][] = array(
						'tag'  => trim($tag),
						'href' => $this->url->link('product/search', 'tag=' . trim($tag))
					);
				}
			}

            // proizvodi s istim MPN-om (osim trenutnog)
            $mpn = isset($product_info['mpn']) ? trim($product_info['mpn']) : '';

            $mpn_products = array();
            if ($mpn !== '') {
                $mpn_key = "pp.$store_id.$lang_id.mpn." . md5($mpn) . ".include.v$ppver";
                $mpn_products = $this->ppCacheGet($mpn_key);
	                if ($mpn_products === false) {
	                   // $mpn_products = $this->model_catalog_product->getProductsByMPN($mpn, $product_id);

	                    $mpn_products = $this->model_catalog_product->getProductsByMPN($mpn);
	                    $this->ppCacheSet($mpn_key, $mpn_products);
	                } elseif ($mpn_products && (!array_key_exists('pak', reset($mpn_products)) || !array_key_exists('vpc', reset($mpn_products)))) {
	                    $mpn_products = $this->model_catalog_product->getProductsByMPN($mpn);
	                    $this->ppCacheSet($mpn_key, $mpn_products);
	                }
            } else {
                $mpn_products = array();
            }


// tablični prikaz varijanti: ako nema drugih, prikaži trenutni artikl kao jedan red
            if (count($mpn_products) > 0) {
                $data['same_mpn_products'] = array();
	                $data['same_mpn_has_c100'] = false;
	                $mpn_products = array_values($mpn_products);
	                usort($mpn_products, function ($a, $b) {
	                    return (int)$a['sort_order'] <=> (int)$b['sort_order'];
	                });

	                $mpn_qiqo_price_map = array();
	                $mpn_action_details_map = array();
	                $mpn_action_skus = array();

	                foreach ($mpn_products as $p_item) {
	                    $p_sku = trim((string)$p_item['sku']);
	                    if ($p_sku !== '') {
	                        $mpn_action_skus[] = $p_sku;
	                    }
	                }

	                if ($mpn_action_skus) {
	                    $mpn_action_details_map = $this->model_catalog_product->getQiqoActionDetailsMap($mpn_action_skus);
	                }

	                if ($this->customer->isLogged()) {
	                    $mpn_sku_quantities = array();
	                    $mpn_base_prices = array();

	                    foreach ($mpn_products as $p_item) {
                        $p_sku = trim((string)$p_item['sku']);
                        if ($p_sku === '') {
                            continue;
                        }

                        $p_minimum = ($p_item['minimum'] > 0) ? (int)$p_item['minimum'] : 1;
                        $p_min_qty = ((string)$p_item['cent'] === 'C-100') ? $p_minimum : 1;
                        $p_base_unit = isset($p_item['base_price']) ? (float)$p_item['base_price'] : (float)$p_item['price'];

                        if ($p_base_unit <= 0) {
                            continue;
                        }

                        $mpn_sku_quantities[$p_sku] = $p_min_qty;
                        $mpn_base_prices[$p_sku] = $p_base_unit;
                    }

	                    if ($mpn_sku_quantities) {
	                        $mpn_qiqo_price_map = $this->model_catalog_product->getQiqoPricingMap(
                            (int)$this->customer->getId(),
                            $mpn_sku_quantities,
                            $mpn_base_prices,
                            false,
                            false
                        );
                    }
                }

	                foreach ($mpn_products as $result) {

	                    $minimum = ($result['minimum'] > 0) ? (int)$result['minimum'] : 1;
	                    $pak = isset($result['pak']) ? (int)$result['pak'] : 0;
	                    $minimum_step = $this->qiqoMinimumStep($result['cent'], $pak, $minimum);

	                    $cent_normalized = strtoupper(preg_replace('/[^A-Z0-9]/', '', (string)$result['cent']));
	                    if ($cent_normalized === 'C100') {
	                        $data['same_mpn_has_c100'] = true;
	                    }

	                    $vpc_unit_raw = isset($result['base_price']) ? (float)$result['base_price'] : (float)$result['price'];
	                    $price_unit_raw = $vpc_unit_raw;
	                    $row_qiqo_discount_percent = 0.0;

	                    $row_sku = trim((string)$result['sku']);

	                    if ($row_sku !== '' && isset($mpn_qiqo_price_map[$row_sku])) {
	                        $row_pricing = $mpn_qiqo_price_map[$row_sku];
	                        $vpc_unit_raw = isset($row_pricing['base_unit_price']) ? (float)$row_pricing['base_unit_price'] : $vpc_unit_raw;
	                        $price_unit_raw = isset($row_pricing['final_unit_price']) ? (float)$row_pricing['final_unit_price'] : $vpc_unit_raw;
	                        $row_qiqo_discount_percent = isset($row_pricing['base_discount_percent']) ? (float)$row_pricing['base_discount_percent'] : 0.0;
	                    }

		                    $vpc_display_raw = (isset($result['vpc']) && (float)$result['vpc'] > 0)
		                        ? (float)$result['vpc']
		                        : $this->qiqoDisplayPriceRaw($vpc_unit_raw, $result['cent']);
		                    $price_display_raw = $this->qiqoDisplayPriceRaw($price_unit_raw, $result['cent']);
		                    if ($row_qiqo_discount_percent > 0 && $vpc_display_raw > 0) {
		                        $price_display_raw = $vpc_display_raw * (1 - ($row_qiqo_discount_percent / 100));
		                    }
	                    $action_conditions = ($row_sku !== '' && isset($mpn_action_details_map[$row_sku]))
	                        ? $this->formatQiqoActionConditions($mpn_action_details_map[$row_sku])
	                        : array();

	                    $data['same_mpn_products'][] = [
	                        'product_id' => $result['product_id'],
	                        'code'       => $result['sku'],
	                        'barcode'    => $result['model'],
	                        'ean'        => $result['ean'],
	                        'cent'       => $result['cent'],
	                        'pak'        => $pak,
	                        'name_add'   => $result['name_add'],
	                        'description_add' => $result['description_add'],
	                        'stock'      => $result['quantity'],
	                        'minimum'    => $minimum,
	                        'packaging'  => $this->formatQiqoPackaging($result['ean'], $minimum, $pak),
	                        'minimumifc100'    => $minimum_step,
	                        'qiqo_discount_percent' => $row_qiqo_discount_percent,
	                        'qiqo_action' => !empty($action_conditions),
	                        'qiqo_action_conditions' => $action_conditions,
	                        'vpc'        => $this->currency->format($vpc_display_raw, $this->session->data['currency']),
	                        'final_price' => $this->currency->format($price_display_raw, $this->session->data['currency']),
	                        'price'      => $this->currency->format($price_display_raw, $this->session->data['currency']),
	                        'special'    => false,
	                        'preview_price_new' => false,
	                        'preview_price_old' => false,
	                        'preview_price_ex_tax' => false,
	                        'price_value'   => $price_display_raw,
	                        'special_value' => 0,
	                    ];
	                }

            } else {
                $data['same_mpn_products'] = array();
                $data['same_mpn_has_c100'] = false;

	                $single_minimum = ($product_info['minimum'] > 0) ? (int)$product_info['minimum'] : 1;
	                $single_pak = isset($product_info['pak']) ? (int)$product_info['pak'] : 0;
	                $single_minimum_step = $this->qiqoMinimumStep($product_info['cent'], $single_pak, $single_minimum);

	                $single_cent_normalized = strtoupper(preg_replace('/[^A-Z0-9]/', '', (string)$product_info['cent']));
	                if ($single_cent_normalized === 'C100') {
	                    $data['same_mpn_has_c100'] = true;
	                }

	                $single_vpc_unit_raw = isset($product_info['base_price']) ? (float)$product_info['base_price'] : (float)$product_info['price'];
	                $single_price_unit_raw = $single_vpc_unit_raw;

	                $single_qiqo_discount_percent = 0.0;
	                $single_sku = trim((string)$product_info['sku']);
	                $single_action_details_map = ($single_sku !== '')
	                    ? $this->model_catalog_product->getQiqoActionDetailsMap(array($single_sku))
	                    : array();
	                $single_action_conditions = ($single_sku !== '' && isset($single_action_details_map[$single_sku]))
	                    ? $this->formatQiqoActionConditions($single_action_details_map[$single_sku])
	                    : array();

	                if ($this->customer->isLogged()) {
	                    if ($single_sku !== '') {
	                        $single_base_unit = isset($product_info['base_price']) ? (float)$product_info['base_price'] : (float)$product_info['price'];

	                        if ($single_base_unit > 0) {
	                            $single_map = $this->model_catalog_product->getQiqoPricingMap(
	                                (int)$this->customer->getId(),
	                                array($single_sku => $single_minimum_step),
	                                array($single_sku => $single_base_unit),
	                                false,
	                                false
	                            );

	                            if (isset($single_map[$single_sku])) {
	                                $single_pricing = $single_map[$single_sku];
	                                $single_vpc_unit_raw = isset($single_pricing['base_unit_price']) ? (float)$single_pricing['base_unit_price'] : $single_vpc_unit_raw;
	                                $single_price_unit_raw = isset($single_pricing['final_unit_price']) ? (float)$single_pricing['final_unit_price'] : $single_vpc_unit_raw;
	                                $single_qiqo_discount_percent = isset($single_pricing['base_discount_percent']) ? (float)$single_pricing['base_discount_percent'] : 0.0;
	                            }
	                        }
	                    }
	                }

		                $single_vpc_display_raw = (isset($product_info['vpc']) && (float)$product_info['vpc'] > 0)
		                    ? (float)$product_info['vpc']
		                    : $this->qiqoDisplayPriceRaw($single_vpc_unit_raw, $product_info['cent']);
		                $single_price_display_raw = $this->qiqoDisplayPriceRaw($single_price_unit_raw, $product_info['cent']);
		                if ($single_qiqo_discount_percent > 0 && $single_vpc_display_raw > 0) {
		                    $single_price_display_raw = $single_vpc_display_raw * (1 - ($single_qiqo_discount_percent / 100));
		                }

	                $data['same_mpn_products'][] = [
	                    'product_id' => $product_info['product_id'],
	                    'code'       => $product_info['sku'],
	                    'barcode'    => $product_info['model'],
	                    'ean'        => $product_info['ean'],
	                    'cent'       => $product_info['cent'],
	                    'pak'        => $single_pak,
	                    'name_add'   => $product_info['name_add'],
	                    'description_add' => isset($product_info['description_add']) ? $product_info['description_add'] : '',
	                    'stock'      => $product_info['quantity'],
	                    'minimum'    => $single_minimum,
	                    'packaging'  => $this->formatQiqoPackaging($product_info['ean'], $single_minimum, $single_pak),
	                    'minimumifc100' => $single_minimum_step,
	                    'qiqo_discount_percent' => $single_qiqo_discount_percent,
	                    'qiqo_action' => !empty($single_action_conditions),
	                    'qiqo_action_conditions' => $single_action_conditions,
	                    'vpc'        => $this->currency->format($single_vpc_display_raw, $this->session->data['currency']),
	                    'final_price' => $this->currency->format($single_price_display_raw, $this->session->data['currency']),
	                    'price'      => $this->currency->format($single_price_display_raw, $this->session->data['currency']),
	                    'special'    => false,
	                    'preview_price_new' => false,
	                    'preview_price_old' => false,
	                    'preview_price_ex_tax' => false,
	                    'price_value'   => $single_price_display_raw,
	                    'special_value' => 0,
	                ];
            }

			$data['recurrings'] = $this->model_catalog_product->getProfiles($this->request->get['product_id']);

			$this->model_catalog_product->updateViewed($this->request->get['product_id']);
			
			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');

			$this->response->setOutput($this->load->view('product/product', $data));
		} else {
			$url = '';

			if (isset($this->request->get['path'])) {
				$url .= '&path=' . $this->request->get['path'];
			}

			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}

			if (isset($this->request->get['manufacturer_id'])) {
				$url .= '&manufacturer_id=' . $this->request->get['manufacturer_id'];
			}

			if (isset($this->request->get['search'])) {
				$url .= '&search=' . $this->request->get['search'];
			}

			if (isset($this->request->get['tag'])) {
				$url .= '&tag=' . $this->request->get['tag'];
			}

			if (isset($this->request->get['description'])) {
				$url .= '&description=' . $this->request->get['description'];
			}

			if (isset($this->request->get['category_id'])) {
				$url .= '&category_id=' . $this->request->get['category_id'];
			}

			if (isset($this->request->get['sub_category'])) {
				$url .= '&sub_category=' . $this->request->get['sub_category'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_error'),
				'href' => $this->url->link('product/product', $url . '&product_id=' . $product_id)
			);

			$this->document->setTitle($this->language->get('text_error'));

			$data['continue'] = $this->url->link('common/home');

			$this->response->addHeader($this->request->server['SERVER_PROTOCOL'] . ' 404 Not Found');

			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');

			$this->response->setOutput($this->load->view('error/not_found', $data));
		}
	}

	public function review() {
		$this->load->language('product/product');

		$this->load->model('catalog/review');

		if (isset($this->request->get['page'])) {
			$page = (int)$this->request->get['page'];
		} else {
			$page = 1;
		}

		$data['reviews'] = array();

		$review_total = $this->model_catalog_review->getTotalReviewsByProductId($this->request->get['product_id']);

		$results = $this->model_catalog_review->getReviewsByProductId($this->request->get['product_id'], ($page - 1) * 5, 5);

		foreach ($results as $result) {
			$data['reviews'][] = array(
				'author'     => $result['author'],
				'text'       => nl2br($result['text']),
				'rating'     => (int)$result['rating'],
				'date_added' => date($this->language->get('date_format_short'), strtotime($result['date_added']))
			);
		}

		$pagination = new Pagination();
		$pagination->total = $review_total;
		$pagination->page = $page;
		$pagination->limit = 5;
		$pagination->url = $this->url->link('product/product/review', 'product_id=' . $this->request->get['product_id'] . '&page={page}');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($review_total) ? (($page - 1) * 5) + 1 : 0, ((($page - 1) * 5) > ($review_total - 5)) ? $review_total : ((($page - 1) * 5) + 5), $review_total, ceil($review_total / 5));

		$this->response->setOutput($this->load->view('product/review', $data));
	}

	public function write() {
		$this->load->language('product/product');

		$json = array();

		if (isset($this->request->get['product_id']) && $this->request->get['product_id']) {
			if ($this->request->server['REQUEST_METHOD'] == 'POST') {
				if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 25)) {
					$json['error'] = $this->language->get('error_name');
				}

				if ((utf8_strlen($this->request->post['text']) < 25) || (utf8_strlen($this->request->post['text']) > 1000)) {
					$json['error'] = $this->language->get('error_text');
				}
			
				if (empty($this->request->post['rating']) || $this->request->post['rating'] < 0 || $this->request->post['rating'] > 5) {
					$json['error'] = $this->language->get('error_rating');
				}

				// Captcha
				if ($this->config->get('captcha_' . $this->config->get('config_captcha') . '_status') && in_array('review', (array)$this->config->get('config_captcha_page'))) {
					$captcha = $this->load->controller('extension/captcha/' . $this->config->get('config_captcha') . '/validate');

					if ($captcha) {
						$json['error'] = $captcha;
					}
				}

				if (!isset($json['error'])) {
					$this->load->model('catalog/review');

					$this->model_catalog_review->addReview($this->request->get['product_id'], $this->request->post);

					$json['success'] = $this->language->get('text_success');
				}
			}
		} else {
			$json['error'] = $this->language->get('error_product');
		} 

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function getRecurringDescription() {
		$this->load->language('product/product');
		$this->load->model('catalog/product');

		if (isset($this->request->post['product_id'])) {
			$product_id = $this->request->post['product_id'];
		} else {
			$product_id = 0;
		}

		if (isset($this->request->post['recurring_id'])) {
			$recurring_id = $this->request->post['recurring_id'];
		} else {
			$recurring_id = 0;
		}

		if (isset($this->request->post['quantity'])) {
			$quantity = $this->request->post['quantity'];
		} else {
			$quantity = 1;
		}

		$product_info = $this->model_catalog_product->getProduct($product_id);
		
		$recurring_info = $this->model_catalog_product->getProfile($product_id, $recurring_id);

		$json = array();

		if ($product_info && $recurring_info) {
			if (!$json) {
				$frequencies = array(
					'day'        => $this->language->get('text_day'),
					'week'       => $this->language->get('text_week'),
					'semi_month' => $this->language->get('text_semi_month'),
					'month'      => $this->language->get('text_month'),
					'year'       => $this->language->get('text_year'),
				);

				if ($recurring_info['trial_status'] == 1) {
					$price = $this->currency->format($this->tax->calculate($recurring_info['trial_price'] * $quantity, $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
					$trial_text = sprintf($this->language->get('text_trial_description'), $price, $recurring_info['trial_cycle'], $frequencies[$recurring_info['trial_frequency']], $recurring_info['trial_duration']) . ' ';
				} else {
					$trial_text = '';
				}

				$price = $this->currency->format($this->tax->calculate($recurring_info['price'] * $quantity, $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);

				if ($recurring_info['duration']) {
					$text = $trial_text . sprintf($this->language->get('text_payment_description'), $price, $recurring_info['cycle'], $frequencies[$recurring_info['frequency']], $recurring_info['duration']);
				} else {
					$text = $trial_text . sprintf($this->language->get('text_payment_cancel'), $price, $recurring_info['cycle'], $frequencies[$recurring_info['frequency']], $recurring_info['duration']);
				}

				$json['success'] = $text;
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

    private function qiqoCentNormalized($cent) {
        return strtoupper(preg_replace('/[^A-Z0-9]/', '', (string)$cent));
    }

    private function qiqoIsC100($cent) {
        return $this->qiqoCentNormalized($cent) === 'C100';
    }

    private function qiqoMinimumStep($cent, $pak, $pakkol) {
        $step = 1;

        if ($this->qiqoIsC100($cent) || (int)$pak === 1) {
            $step = (int)$pakkol;
        }

        return $step > 0 ? $step : 1;
    }

    private function qiqoDisplayPriceRaw($price, $cent) {
        $price = (float)$price;

        return $this->qiqoIsC100($cent) ? ($price * 100) : $price;
    }

    private function formatQiqoNumber($value) {
        $value = (float)$value;

        if (abs($value - round($value)) < 0.00001) {
            return number_format($value, 0, ',', '.');
        }

        return rtrim(rtrim(number_format($value, 2, ',', '.'), '0'), ',');
    }

    private function formatQiqoPackaging($jm, $pakkol, $pak) {
        $parts = array();
        $jm = trim((string)$jm);

        if ($jm !== '') {
            $parts[] = $jm;
        }

        if ((float)$pakkol > 0) {
            $parts[] = $this->formatQiqoNumber($pakkol);
        }

        $label = trim(implode(' ', $parts));

        if ((int)$pak === 1) {
            $label .= '*';
        }

        return $label !== '' ? $label : '-';
    }

    private function formatQiqoActionConditions($rows) {
        $conditions = array();

        foreach ($rows as $row) {
            $price = isset($row['price']) ? (float)$row['price'] : 0.0;
            $discount = isset($row['discount']) ? (float)$row['discount'] : 0.0;
            $quantity = isset($row['quantity']) ? (float)$row['quantity'] : 0.0;

            $conditions[] = array(
                'indicator' => isset($row['indicator']) ? strtoupper(trim((string)$row['indicator'])) : '',
                'quantity'  => $quantity > 0 ? $this->formatQiqoNumber($quantity) : '-',
                'price'     => $price > 0 ? $this->currency->format($price, $this->session->data['currency']) : '-',
                'discount'  => $discount > 0 ? '-' . $this->formatQiqoNumber($discount) . '%' : '-'
            );
        }

        return $conditions;
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

    private function ppCacheVersion($product_id) {
        $key = 'ppver.' . (int)$product_id;
        $ver = $this->cache->get($key);

        if ($ver === false || $ver === null) {
            $ver = 1;
            $this->cache->set($key, $ver);
        }

        return (int)$ver;
    }

    private function ppCacheGet($key) {
        $value = $this->cache->get($key);
        return ($value === false || $value === null) ? false : $value;
    }

    private function ppCacheSet($key, $value) {
        $this->cache->set($key, $value);
        return $value;
    }

}
