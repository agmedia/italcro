<?php
class ControllerProductSpecial extends Controller {
	public function index() {
		$this->load->language('product/special');

		$this->load->model('catalog/product');

		$this->load->model('tool/image');

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'p.price';
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
			$limit = $this->config->get('theme_' . $this->config->get('config_theme') . '_product_limit');
		}

		$this->document->setTitle($this->language->get('heading_title'));

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
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

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('product/special', $url)
		);

		$data['text_compare'] = sprintf($this->language->get('text_compare'), (isset($this->session->data['compare']) ? count($this->session->data['compare']) : 0));

		$data['compare'] = $this->url->link('product/compare');

		$data['products'] = array();

		$filter_data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $limit,
			'limit' => $limit
		);

		$product_total = $this->model_catalog_product->getTotalProductSpecials();

		$results = $this->model_catalog_product->getProductSpecials($filter_data);

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
				$r_minimum = $r['minimum'] > 0 ? (int)$r['minimum'] : 1;
				$r_pak = isset($r['pak']) ? (int)$r['pak'] : 0;
				$r_cent_normalized = strtoupper(preg_replace('/[^A-Z0-9]/', '', (string)$r['cent']));
				$r_list_min = ($r_cent_normalized === 'C100' || $r_pak === 1) ? $r_minimum : 1;
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
			$minimum = $result['minimum'] > 0 ? (int)$result['minimum'] : 1;
			$pak = isset($result['pak']) ? (int)$result['pak'] : 0;
			$cent_normalized = strtoupper(preg_replace('/[^A-Z0-9]/', '', (string)$result['cent']));
			$list_min = ($cent_normalized === 'C100' || $pak === 1) ? $minimum : 1;

			$display_price_unit = isset($result['base_price']) ? (float)$result['base_price'] : (float)$result['price'];
			$display_special_unit = (!is_null($result['special']) && (float)$result['special'] > 0) ? (float)$result['special'] : 0.0;
			$qiqo_discount_percent = 0.0;
			$qiqo_action = ($sku_key !== '' && !empty($qiqo_action_article_map[$sku_key]))
				|| (isset($result['mpn_count']) && (int)$result['mpn_count'] > 1 && !empty($result['mpn']) && !empty($qiqo_action_mpn_map[(string)$result['mpn']]));

			if ($is_single_article && $sku_key !== '' && isset($qiqo_price_map[$sku_key])) {
				$pricing = $qiqo_price_map[$sku_key];

				if (isset($pricing['old_unit_price']) && $pricing['old_unit_price'] !== false) {
					$display_price_unit = (float)$pricing['old_unit_price'];
					$display_special_unit = (float)$pricing['final_unit_price'];
				} else {
					$display_price_unit = (float)$pricing['base_unit_price'];
				}

				$qiqo_discount_percent = isset($pricing['base_discount_percent']) ? (float)$pricing['base_discount_percent'] : 0.0;
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

            $minimum = $result['minimum'] > 0 ? (int)$result['minimum'] : 1;

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
				'quantity'    => isset($result['quantity']) ? (int)$result['quantity'] : 0,
				'thumb'       => $image,
				'name'        => $result['name'],
                'name_add'        => $result['name_add'],
				'description' => utf8_substr(trim(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8'))), 0, $this->config->get('theme_' . $this->config->get('config_theme') . '_product_description_length')) . '..',
				'attribute_groups'       => $this->model_catalog_product->getProductAttributes($result['product_id']),
				'price'       => $price,
                'sku'  => $result['sku'],
                // NEW
                'preview_price'     => $preview_price,
                'preview_price_alt' => $preview_price_alt,
				'special'     => $special,
                'mpn_count'       => $mpn_count,
                'mpn_artikl'  => $this->artiklLabel($mpn_count),
                'is_single_article' => $is_single_article,
                'pak'  => $pak,
                'cent'  => $result['cent'],
				'tax'         => $tax,
				'minimum'     => $result['minimum'] > 0 ? $result['minimum'] : 1,
				'list_min'    => $list_min,
				'qiqo_discount_percent' => $qiqo_discount_percent,
				'qiqo_action' => $qiqo_action,
				'rating'      => $result['rating'],
				'href'        => $this->url->link('product/product', 'product_id=' . $result['product_id'] . $url)
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
			'href'  => $this->url->link('product/special', 'sort=p.sort_order&order=ASC' . $url)
		);

		$data['sorts'][] = array(
			'text'  => $this->language->get('text_name_asc'),
			'value' => 'pd.name-ASC',
			'href'  => $this->url->link('product/special', 'sort=pd.name&order=ASC' . $url)
		);

		$data['sorts'][] = array(
			'text'  => $this->language->get('text_name_desc'),
			'value' => 'pd.name-DESC',
			'href'  => $this->url->link('product/special', 'sort=pd.name&order=DESC' . $url)
		);

		$data['sorts'][] = array(
			'text'  => $this->language->get('text_price_asc'),
			'value' => 'ps.price-ASC',
			'href'  => $this->url->link('product/special', 'sort=ps.price&order=ASC' . $url)
		);

		$data['sorts'][] = array(
			'text'  => $this->language->get('text_price_desc'),
			'value' => 'ps.price-DESC',
			'href'  => $this->url->link('product/special', 'sort=ps.price&order=DESC' . $url)
		);

		if ($this->config->get('config_review_status')) {
			$data['sorts'][] = array(
				'text'  => $this->language->get('text_rating_desc'),
				'value' => 'rating-DESC',
				'href'  => $this->url->link('product/special', 'sort=rating&order=DESC' . $url)
			);

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_rating_asc'),
				'value' => 'rating-ASC',
				'href'  => $this->url->link('product/special', 'sort=rating&order=ASC' . $url)
			);
		}

		$data['sorts'][] = array(
				'text'  => $this->language->get('text_model_asc'),
				'value' => 'p.model-ASC',
				'href'  => $this->url->link('product/special', 'sort=p.model&order=ASC' . $url)
		);

		$data['sorts'][] = array(
			'text'  => $this->language->get('text_model_desc'),
			'value' => 'p.model-DESC',
			'href'  => $this->url->link('product/special', 'sort=p.model&order=DESC' . $url)
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
				'href'  => $this->url->link('product/special', $url . '&limit=' . $value)
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
		$pagination->url = $this->url->link('product/special', $url . '&page={page}');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($product_total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($product_total - $limit)) ? $product_total : ((($page - 1) * $limit) + $limit), $product_total, ceil($product_total / $limit));

		// http://googlewebmastercentral.blogspot.com/2011/09/pagination-with-relnext-and-relprev.html
		if ($page == 1) {
		    $this->document->addLink($this->url->link('product/special', '', true), 'canonical');
		} else {
		    $this->document->addLink($this->url->link('product/special', 'page='. $page , true), 'canonical');
		}		
		
		if ($page > 1) {
			$this->document->addLink($this->url->link('product/special', (($page - 2) ? '&page='. ($page - 1) : ''), true), 'prev');
		}

		if ($limit && ceil($product_total / $limit) > $page) {
		    $this->document->addLink($this->url->link('product/special', 'page='. ($page + 1), true), 'next');
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

		$this->response->setOutput($this->load->view('product/special', $data));
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
}
