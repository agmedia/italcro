<?php
class ControllerExtensionModuleFeatured extends Controller {
	public function index($setting) {
		$this->load->language('extension/module/featured');

		$this->load->model('catalog/product');

		$this->load->model('tool/image');

		$data['products'] = array();

		if (!$setting['limit']) {
			$setting['limit'] = 4;
		}

		if (!empty($setting['product'])) {
			$products = array_slice($setting['product'], 0, (int)$setting['limit']);
			$product_info_map = array();
			$sku_quantities = array();
			$base_unit_prices = array();
			$action_skus = array();

			foreach ($products as $product_id) {
				$product_info = $this->model_catalog_product->getProduct($product_id);
				$product_info_map[(int)$product_id] = $product_info;

				if (!$product_info) {
					continue;
				}

				$sku = trim((string)$product_info['sku']);
				$is_single_article = empty($product_info['mpn']) || !isset($product_info['mpn_count']) || (int)$product_info['mpn_count'] <= 1;
				$base_unit = isset($product_info['base_price'])
					? (float)$product_info['base_price']
					: (float)$product_info['price'];

				if ($is_single_article && $sku !== '') {
					$action_skus[] = $sku;

					if ($this->customer->isLogged() && $base_unit > 0) {
						$sku_quantities[$sku] = 1.0;
						$base_unit_prices[$sku] = $base_unit;
					}
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

			$qiqo_action_map = $action_skus
				? $this->model_catalog_product->getQiqoActionArticleMap($action_skus)
				: array();

			foreach ($products as $product_id) {
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
							$has_display_special = isset($pricing['old_unit_price']) && $pricing['old_unit_price'] !== false;
						$display_price_unit = isset($pricing['old_unit_price']) && $pricing['old_unit_price'] !== false
							? (float)$pricing['old_unit_price']
							: (float)$pricing['base_unit_price'];
						$display_special_unit = isset($pricing['old_unit_price']) && $pricing['old_unit_price'] !== false
							? (float)$pricing['final_unit_price']
							: 0.0;
						$qiqo_discount_percent = isset($pricing['discount_percent'])
							? (float)$pricing['discount_percent']
							: 0.0;
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
						$image = $this->model_tool_image->resize($product_info['image'], $setting['width'], $setting['height']);
					} else {
						$image = $this->model_tool_image->resize('placeholder.png', $setting['width'], $setting['height']);
					}

					if ($is_single_article && ($this->customer->isLogged() || !$this->config->get('config_customer_price'))) {
						$price = $this->currency->format($this->tax->calculate($display_price_unit, $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
					} else {
						$price = false;
					}

						if ($has_display_special) {
						$special = $this->currency->format($this->tax->calculate($display_special_unit, $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
						$tax_price = (float)$display_special_unit;
					} else {
						$special = false;
						$tax_price = (float)$display_price_unit;
					}
		
					if ($is_single_article && $this->config->get('config_tax')) {
						$tax = $this->currency->format($tax_price, $this->session->data['currency']);
					} else {
						$tax = false;
					}

					if ($this->config->get('config_review_status')) {
						$rating = $product_info['rating'];
					} else {
						$rating = false;
					}

					$data['products'][] = array(
						'product_id'  => $product_info['product_id'],
						'thumb'       => $image,
						'name'        => $product_info['name'],
						'description' => utf8_substr(strip_tags(html_entity_decode($product_info['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('theme_' . $this->config->get('config_theme') . '_product_description_length')) . '..',
						'price'       => $price,
						'special'     => $special,
						'is_single_article' => $is_single_article,
						'qiqo_discount_percent' => $qiqo_discount_percent,
						'qiqo_action' => $is_single_article && $sku !== '' && !empty($qiqo_action_map[$sku]),
						'tax'         => $tax,
						'rating'      => $rating,
						'href'        => $this->url->link('product/product', 'product_id=' . $product_info['product_id'])
					);
				}
			}
		}

		if ($data['products']) {
			return $this->load->view('extension/module/featured', $data);
		}
	}
}
