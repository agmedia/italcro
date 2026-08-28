<?php
class ControllerProductCompare extends Controller {
	public function index() {
		$this->load->language('product/compare');

		$this->load->model('catalog/product');

		$this->load->model('tool/image');

		if (!isset($this->session->data['compare'])) {
			$this->session->data['compare'] = array();
		}

		if (isset($this->request->get['remove'])) {
			$key = array_search($this->request->get['remove'], $this->session->data['compare']);

			if ($key !== false) {
				unset($this->session->data['compare'][$key]);

				$this->session->data['success'] = $this->language->get('text_remove');
			}

			$this->response->redirect($this->url->link('product/compare'));
		}

		$this->document->setTitle($this->language->get('heading_title'));

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('product/compare')
		);

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		$data['review_status'] = $this->config->get('config_review_status');

		$data['products'] = array();

		$data['attribute_groups'] = array();

		$product_info_map = array();
		$sku_quantities = array();
		$base_unit_prices = array();

		foreach ($this->session->data['compare'] as $product_id) {
			$product_info = $this->model_catalog_product->getProduct($product_id);
			$product_info_map[(int)$product_id] = $product_info;

			if (!$product_info || !$this->customer->isLogged()) {
				continue;
			}

			$sku = trim((string)$product_info['sku']);
			$is_single_article = empty($product_info['mpn']) || !isset($product_info['mpn_count']) || (int)$product_info['mpn_count'] <= 1;
			$base_unit = isset($product_info['base_price'])
				? (float)$product_info['base_price']
				: (float)$product_info['price'];

			if ($is_single_article && $sku !== '' && $base_unit > 0) {
				$sku_quantities[$sku] = 1.0;
				$base_unit_prices[$sku] = $base_unit;
			}
		}

		$qiqo_price_map = array();
		if ($this->customer->isLogged() && $sku_quantities) {
			$qiqo_price_map = $this->model_catalog_product->getQiqoPricingMap(
				(int)$this->customer->getId(),
				$sku_quantities,
				$base_unit_prices,
				false,
				false
			);
		}

		foreach ($this->session->data['compare'] as $key => $product_id) {
			$product_info = isset($product_info_map[(int)$product_id]) ? $product_info_map[(int)$product_id] : false;

			if ($product_info) {
				$sku = trim((string)$product_info['sku']);
				$is_single_article = empty($product_info['mpn']) || !isset($product_info['mpn_count']) || (int)$product_info['mpn_count'] <= 1;
				$display_price_unit = isset($product_info['base_price'])
					? (float)$product_info['base_price']
					: (float)$product_info['price'];
					$display_special_unit = 0.0;
					$qiqo_discount_percent = 0.0;
					$has_display_special = false;

				if ($is_single_article && $sku !== '' && isset($qiqo_price_map[$sku])) {
					$pricing = $qiqo_price_map[$sku];
					$display_price_unit = isset($pricing['old_unit_price']) && $pricing['old_unit_price'] !== false
						? (float)$pricing['old_unit_price']
						: (float)$pricing['base_unit_price'];
					$display_special_unit = isset($pricing['old_unit_price']) && $pricing['old_unit_price'] !== false
						? (float)$pricing['final_unit_price']
						: 0.0;
						$qiqo_discount_percent = isset($pricing['discount_percent'])
							? (float)$pricing['discount_percent']
							: 0.0;
						$has_display_special = isset($pricing['old_unit_price']) && $pricing['old_unit_price'] !== false;
				}

					$display_multiplier = strtoupper(preg_replace('/[^A-Z0-9]/i', '', isset($product_info['cent']) ? (string)$product_info['cent'] : '')) === 'C100' ? 100 : 1;
					$display_vpc = isset($product_info['vpc']) && (float)$product_info['vpc'] > 0
						? (float)$product_info['vpc']
						: $display_price_unit * $display_multiplier;
				$display_price_unit = $display_vpc;
					$display_special_unit = $has_display_special
						? $display_vpc * (1 - ($qiqo_discount_percent / 100))
						: 0.0;

				if ($product_info['image']) {
					$image = $this->model_tool_image->resize($product_info['image'], $this->config->get('theme_' . $this->config->get('config_theme') . '_image_compare_width'), $this->config->get('theme_' . $this->config->get('config_theme') . '_image_compare_height'));
				} else {
					$image = false;
				}

				if ($is_single_article && ($this->customer->isLogged() || !$this->config->get('config_customer_price'))) {
					$price = $this->currency->format($this->tax->calculate($display_price_unit, $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
				} else {
					$price = false;
				}

					if ($has_display_special) {
					$special = $this->currency->format($this->tax->calculate($display_special_unit, $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
				} else {
					$special = false;
				}

				if ($product_info['quantity'] <= 0) {
					$availability = $product_info['stock_status'];
				} elseif ($this->config->get('config_stock_display')) {
					$availability = $product_info['quantity'];
				} else {
					$availability = $this->language->get('text_instock');
				}

				$attribute_data = array();

				$attribute_groups = $this->model_catalog_product->getProductAttributes($product_id);

				foreach ($attribute_groups as $attribute_group) {
					foreach ($attribute_group['attribute'] as $attribute) {
						$attribute_data[$attribute['attribute_id']] = $attribute['text'];
					}
				}

				$data['products'][$product_id] = array(
					'product_id'   => $product_info['product_id'],
					'name'         => $product_info['name'],
					'name_add'     => $product_info['name_add'],
					'thumb'        => $image,
					'price'        => $price,
					'special'      => $special,
					'is_single_article' => $is_single_article,
					'qiqo_discount_percent' => $qiqo_discount_percent,
					'description'  => utf8_substr(strip_tags(html_entity_decode($product_info['description'], ENT_QUOTES, 'UTF-8')), 0, 200) . '..',
					'description_add' => $product_info['description_add'] ? trim(strip_tags(html_entity_decode($product_info['description_add'], ENT_QUOTES, 'UTF-8'))) : '',
					'description_full' => trim(strip_tags(html_entity_decode($product_info['description'], ENT_QUOTES, 'UTF-8'))),
					'model'        => $product_info['model'],
					'sku'          => $product_info['sku'],
					'manufacturer' => $product_info['manufacturer'],
					'availability' => $availability,
					'minimum'      => $product_info['minimum'] > 0 ? $product_info['minimum'] : 1,
					'rating'       => (int)$product_info['rating'],
					'reviews'      => sprintf($this->language->get('text_reviews'), (int)$product_info['reviews']),
					'weight'       => $this->weight->format($product_info['weight'], $product_info['weight_class_id']),
					'length'       => $this->length->format($product_info['length'], $product_info['length_class_id']),
					'width'        => $this->length->format($product_info['width'], $product_info['length_class_id']),
					'height'       => $this->length->format($product_info['height'], $product_info['length_class_id']),
					'attribute'    => $attribute_data,
					'href'         => $this->url->link('product/product', 'product_id=' . $product_id),
					'remove'       => $this->url->link('product/compare', 'remove=' . $product_id)
				);

				foreach ($attribute_groups as $attribute_group) {
					$data['attribute_groups'][$attribute_group['attribute_group_id']]['name'] = $attribute_group['name'];

					foreach ($attribute_group['attribute'] as $attribute) {
						$data['attribute_groups'][$attribute_group['attribute_group_id']]['attribute'][$attribute['attribute_id']]['name'] = $attribute['name'];
					}
				}
			} else {
				unset($this->session->data['compare'][$key]);
			}
		}

		$data['continue'] = $this->url->link('common/home');

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		$this->response->setOutput($this->load->view('product/compare', $data));
	}

	public function add() {
		$this->load->language('product/compare');

		$json = array();

		if (!isset($this->session->data['compare'])) {
			$this->session->data['compare'] = array();
		}

		if (isset($this->request->post['product_id'])) {
			$product_id = $this->request->post['product_id'];
		} else {
			$product_id = 0;
		}

		$this->load->model('catalog/product');

		$product_info = $this->model_catalog_product->getProduct($product_id);

		if ($product_info) {
			if (!in_array($this->request->post['product_id'], $this->session->data['compare'])) {
				if (count($this->session->data['compare']) >= 4) {
					array_shift($this->session->data['compare']);
				}

				$this->session->data['compare'][] = $this->request->post['product_id'];
			}

			$json['success'] = sprintf($this->language->get('text_success'), $this->url->link('product/product', 'product_id=' . $this->request->post['product_id']), $product_info['name'], $this->url->link('product/compare'));

			$json['total'] = sprintf($this->language->get('text_compare'), (isset($this->session->data['compare']) ? count($this->session->data['compare']) : 0));
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}
