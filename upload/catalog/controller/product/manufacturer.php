<?php
class ControllerProductManufacturer extends Controller {
	public function index() {
		$this->load->language('product/manufacturer');

		$this->load->model('catalog/manufacturer');

		$this->document->setTitle($this->language->get('heading_title'));

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_brand'),
			'href' => $this->url->link('product/manufacturer')
		);

		$data['categories'] = array();

		$results = $this->model_catalog_manufacturer->getManufacturers();

		foreach ($results as $result) {
			if (is_numeric(utf8_substr($result['name'], 0, 1))) {
				$key = '0 - 9';
			} else {
				$key = utf8_substr(utf8_strtoupper($result['name']), 0, 1);
			}

			if (!isset($data['categories'][$key])) {
				$data['categories'][$key]['name'] = $key;
			}

			$data['categories'][$key]['manufacturer'][] = array(
				'name' => $result['name'],
				'href' => $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $result['manufacturer_id'])
			);
		}

		$data['continue'] = $this->url->link('common/home');

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		$this->response->setOutput($this->load->view('product/manufacturer_list', $data));
	}

	public function info() {
		$this->load->language('product/manufacturer');

		$this->load->model('catalog/manufacturer');

		$this->load->model('catalog/product');

		$this->load->model('tool/image');

		if (isset($this->request->get['manufacturer_id'])) {
			$manufacturer_id = (int)$this->request->get['manufacturer_id'];
		} else {
			$manufacturer_id = 0;
		}

			if (isset($this->request->get['sort'])) {
				$sort = $this->request->get['sort'];
			} else {
				$sort = 'p.sort_order';
			}

			if (in_array($sort, ['p.price', 'ps.price'], true)) {
				$sort = 'p.sort_order';
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

		if (isset($this->request->get['limit'])) {
			$limit = (int)$this->request->get['limit'];
		} else {
			$limit = (int)$this->config->get('theme_' . $this->config->get('config_theme') . '_product_limit');
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_brand'),
			'href' => $this->url->link('product/manufacturer')
		);

		$manufacturer_info = $this->model_catalog_manufacturer->getManufacturer($manufacturer_id);

		if ($manufacturer_info) {
			$this->document->setTitle($manufacturer_info['name']);

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
				'text' => $manufacturer_info['name'],
				'href' => $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $this->request->get['manufacturer_id'] . $url)
			);

			$data['heading_title'] = $manufacturer_info['name'];

			$data['text_compare'] = sprintf($this->language->get('text_compare'), (isset($this->session->data['compare']) ? count($this->session->data['compare']) : 0));

			$data['compare'] = $this->url->link('product/compare');

			$data['products'] = array();

			$filter_data = array(
				'filter_manufacturer_id' => $manufacturer_id,
				'sort'                   => $sort,
				'order'                  => $order,
				'start'                  => ($page - 1) * $limit,
				'limit'                  => $limit
			);

			$product_total = $this->model_catalog_product->getTotalProducts($filter_data);

				$results = $this->model_catalog_product->getProducts($filter_data);

				$qiqo_price_map = array();
				$qiqo_action_article_map = array();
				$qiqo_action_mpn_map = array();

				if ($results) {
					$sku_quantities = array();
					$base_unit_prices = array();
					$action_skus = array();
					$action_mpns = array();

					foreach ($results as $r) {
						$sku = trim((string)$r['sku']);
						$mpn_count = isset($r['mpn_count']) ? (int)$r['mpn_count'] : 1;
						$is_single_article = empty($r['mpn']) || $mpn_count <= 1;
						$minimum = $this->qiqoPackQuantity($r);
						$pak = isset($r['pak']) ? (int)$r['pak'] : 0;
						$list_min = $this->qiqoMinimumStep($r['cent'], $pak, $minimum);
						$base_unit = isset($r['base_price']) ? (float)$r['base_price'] : (float)$r['price'];

						if ($sku !== '') {
							$action_skus[] = $sku;
							if ($is_single_article && $this->customer->isLogged() && $base_unit > 0) {
								$sku_quantities[$sku] = $list_min;
								$base_unit_prices[$sku] = $base_unit;
							}
						}

						if ($mpn_count > 1 && !empty($r['mpn'])) {
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
						|| ($mpn_count > 1 && !empty($result['mpn']) && !empty($qiqo_action_mpn_map[(string)$result['mpn']]));

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
					$image = $this->model_tool_image->resize($result['image'], $this->config->get('theme_' . $this->config->get('config_theme') . '_image_product_width'), $this->config->get('theme_' . $this->config->get('config_theme') . '_image_product_height'));
				} else {
					$image = $this->model_tool_image->resize('placeholder.png', $this->config->get('theme_' . $this->config->get('config_theme') . '_image_product_width'), $this->config->get('theme_' . $this->config->get('config_theme') . '_image_product_height'));
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

						if ($has_display_special) {
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
					   $specialeur  ='';
					$tax_price = (float)$display_price_unit;
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
                    $data['attention'] = '1';
                } else {
                    $data['attention'] = '';
                }

	                $price_raw   = (float)$display_price_unit;
	                $special_raw = (float)$display_special_unit;

// default: nema "stare" cijene
                $preview_price_alt = false;
				$preview_price_basis = strtoupper(preg_replace('/[^A-Z0-9]/', '', (string)$result['cent'])) === 'C100' ? 100.0 : $list_min;

				// A 100% rebate is a valid zero-price special, so use the explicit flag.
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
                    // nema akcije: novo = regular
                    $preview_price_raw = $price_raw * $preview_price_basis;
                }

// NOVA (glavna) preview cijena
				$preview_price = ($has_display_special || $preview_price_raw > 0) ? $this->currency->format(
                    $this->tax->calculate(
                        $preview_price_raw,
                        $result['tax_class_id'],
                        $this->config->get('config_tax')
                    ),
                    $this->session->data['currency']
                ) : false;


                $data['products'][] = array(
					'product_id'  => $result['product_id'],
					'quantity'    => isset($result['quantity']) ? (int)$result['quantity'] : 0,
					'thumb'       => $image,
					'name'        => $result['name'],
                    'name_add'        => $result['name_add'],
					'description' => utf8_substr(trim(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8'))), 0, $this->config->get('theme_' . $this->config->get('config_theme') . '_product_description_length')) . '..',
					'attribute_groups'       => $this->model_catalog_product->getProductAttributes($result['product_id']),
					'price'       => $price,
					'special'     => $special,
                    'preview_price'     => $preview_price,
                    'preview_price_alt' => $preview_price_alt,
                    'attention'     => $data['attention'],
	                    'mpn_count'       => $mpn_count,
	                    'mpn_artikl'  => $this->artiklLabel($mpn_count),
	                    'is_single_article' => $is_single_article,
                    'pak'  => $pak,
                    'cent'  => $result['cent'],
                    'sku'  => $result['sku'],
					'tax'         => $tax,
					'minimum'     => $minimum,
					'list_min'    => $list_min,
					'decimal_quantity' => $this->qiqoAllowsDecimalQuantity($result),
					'qiqo_discount_percent' => $qiqo_discount_percent,
					'qiqo_action' => $qiqo_action,
					'rating'      => $result['rating'],
					'href'        => $this->url->link('product/product', 'manufacturer_id=' . $result['manufacturer_id'] . '&product_id=' . $result['product_id'] . $url)
				);
			}

			$url = '';

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$data['sorts'] = array();

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_default'),
				'value' => 'p.sort_order-ASC',
				'href'  => $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $this->request->get['manufacturer_id'] . '&sort=p.sort_order&order=ASC' . $url)
			);

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_name_asc'),
				'value' => 'pd.name-ASC',
				'href'  => $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $this->request->get['manufacturer_id'] . '&sort=pd.name&order=ASC' . $url)
			);

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_name_desc'),
				'value' => 'pd.name-DESC',
				'href'  => $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $this->request->get['manufacturer_id'] . '&sort=pd.name&order=DESC' . $url)
			);

			if ($this->config->get('config_review_status')) {
				$data['sorts'][] = array(
					'text'  => $this->language->get('text_rating_desc'),
					'value' => 'rating-DESC',
					'href'  => $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $this->request->get['manufacturer_id'] . '&sort=rating&order=DESC' . $url)
				);

				$data['sorts'][] = array(
					'text'  => $this->language->get('text_rating_asc'),
					'value' => 'rating-ASC',
					'href'  => $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $this->request->get['manufacturer_id'] . '&sort=rating&order=ASC' . $url)
				);
			}

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_model_asc'),
				'value' => 'p.model-ASC',
				'href'  => $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $this->request->get['manufacturer_id'] . '&sort=p.model&order=ASC' . $url)
			);

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_model_desc'),
				'value' => 'p.model-DESC',
				'href'  => $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $this->request->get['manufacturer_id'] . '&sort=p.model&order=DESC' . $url)
			);

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			$data['limits'] = array();

			$limits = array_unique(array($this->config->get('theme_' . $this->config->get('config_theme') . '_product_limit'), 25, 50, 75, 100));

			sort($limits);

			foreach($limits as $value) {
				$data['limits'][] = array(
					'text'  => $value,
					'value' => $value,
					'href'  => $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $this->request->get['manufacturer_id'] . $url . '&limit=' . $value)
				);
			}

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$pagination = new Pagination();
			$pagination->total = $product_total;
			$pagination->page = $page;
			$pagination->limit = $limit;
			$pagination->url = $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $this->request->get['manufacturer_id'] .  $url . '&page={page}');

			$data['pagination'] = $pagination->render();

			$data['results'] = sprintf($this->language->get('text_pagination'), ($product_total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($product_total - $limit)) ? $product_total : ((($page - 1) * $limit) + $limit), $product_total, ceil($product_total / $limit));

			// http://googlewebmastercentral.blogspot.com/2011/09/pagination-with-relnext-and-relprev.html
			if ($page == 1) {
				$this->document->addLink($this->url->link('product/manufacturer/info', 'manufacturer_id=' . $this->request->get['manufacturer_id']), 'canonical');
			} else {
				$this->document->addLink($this->url->link('product/manufacturer/info', 'manufacturer_id=' . $this->request->get['manufacturer_id'] . '&page=' . $page), 'canonical');
			}
			
			if ($page > 1) {
				$this->document->addLink($this->url->link('product/manufacturer/info', 'manufacturer_id=' . $this->request->get['manufacturer_id'] . (($page - 2) ? '&page=' . ($page - 1) : '')), 'prev');
			}

			if ($limit && ceil($product_total / $limit) > $page) {
				$this->document->addLink($this->url->link('product/manufacturer/info', 'manufacturer_id=' . $this->request->get['manufacturer_id'] . '&page=' . ($page + 1)), 'next');
			}

			$data['sort'] = $sort;
			$data['order'] = $order;
			$data['limit'] = $limit;

			$data['continue'] = $this->url->link('common/home');

			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');

			$this->response->setOutput($this->load->view('product/manufacturer_info', $data));
		} else {
			$url = '';

			if (isset($this->request->get['manufacturer_id'])) {
				$url .= '&manufacturer_id=' . $this->request->get['manufacturer_id'];
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
				'href' => $this->url->link('product/manufacturer/info', $url)
			);

			$this->document->setTitle($this->language->get('text_error'));

			$data['heading_title'] = $this->language->get('text_error');

			$data['text_error'] = $this->language->get('text_error');

			$data['continue'] = $this->url->link('common/home');

			$this->response->addHeader($this->request->server['SERVER_PROTOCOL'] . ' 404 Not Found');

			$data['header'] = $this->load->controller('common/header');
			$data['footer'] = $this->load->controller('common/footer');
			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');

			$this->response->setOutput($this->load->view('error/not_found', $data));
		}
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
