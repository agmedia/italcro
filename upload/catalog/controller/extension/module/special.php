<?php
class ControllerExtensionModuleSpecial extends Controller {
	public function index($setting) {
		$this->load->language('extension/module/special');

		$this->load->model('catalog/product');

		$this->load->model('tool/image');

		$data['products'] = array();

		$filter_data = array(
			'sort'  => 'pd.name',
			'order' => 'ASC',
			'start' => 0,
			'limit' => $setting['limit']
		);

		$results = $this->model_catalog_product->getProductSpecials($filter_data);

		if ($results) {
			$qiqo_price_map = array();
			$action_skus = array();
			$sku_quantities = array();
			$base_unit_prices = array();

			foreach ($results as $candidate) {
				$sku = trim((string)$candidate['sku']);
				$is_single_article = empty($candidate['mpn']) || !isset($candidate['mpn_count']) || (int)$candidate['mpn_count'] <= 1;
				$base_unit = isset($candidate['base_price']) ? (float)$candidate['base_price'] : (float)$candidate['price'];
				if ($is_single_article && $sku !== '') {
					$action_skus[] = $sku;
					if ($this->customer->isLogged() && $base_unit > 0) {
						$sku_quantities[$sku] = isset($candidate['pakkol']) && (float)$candidate['pakkol'] > 0
							? (float)$candidate['pakkol']
							: (isset($candidate['minimum']) && (float)$candidate['minimum'] > 0 ? (float)$candidate['minimum'] : 1.0);
						$base_unit_prices[$sku] = $base_unit;
					}
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

			$qiqo_action_map = $action_skus
				? $this->model_catalog_product->getQiqoActionArticleMap($action_skus)
				: array();

			foreach ($results as $result) {
				if ($result['image']) {
					$image = $this->model_tool_image->resize($result['image'], $setting['width'], $setting['height']);
				} else {
					$image = $this->model_tool_image->resize('placeholder.png', $setting['width'], $setting['height']);
				}

				$sku = trim((string)$result['sku']);
				$is_single_article = empty($result['mpn']) || !isset($result['mpn_count']) || (int)$result['mpn_count'] <= 1;
				$cent_normalized = strtoupper(preg_replace('/[^A-Z0-9]/i', '', isset($result['cent']) ? (string)$result['cent'] : ''));
				$display_multiplier = $cent_normalized === 'C100' ? 100 : 1;
				$display_price = isset($result['base_price']) ? (float)$result['base_price'] : (float)$result['price'];
				$display_price *= $display_multiplier;
				if (isset($result['vpc']) && (float)$result['vpc'] > 0) {
					$display_price = (float)$result['vpc'];
				}

					$display_special = 0.0;
					$has_display_special = false;
				$qiqo_discount_percent = 0.0;

					if ($is_single_article && $sku !== '' && isset($qiqo_price_map[$sku])) {
						$pricing = $qiqo_price_map[$sku];
						$has_display_special = isset($pricing['old_unit_price']) && $pricing['old_unit_price'] !== false;
					$qiqo_discount_percent = isset($pricing['discount_percent']) ? (float)$pricing['discount_percent'] : 0.0;
					$display_special = isset($pricing['old_unit_price']) && $pricing['old_unit_price'] !== false
						? $display_price * (1 - ($qiqo_discount_percent / 100))
						: 0.0;
				}

				if ($is_single_article && ($this->customer->isLogged() || !$this->config->get('config_customer_price'))) {
					$price = $this->currency->format($this->tax->calculate($display_price, $result['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
				} else {
					$price = false;
				}

					if ($has_display_special) {
					$special = $this->currency->format($this->tax->calculate($display_special, $result['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
					$tax_price = $display_special;
				} else {
					$special = false;
					$tax_price = $display_price;
				}
	
				if ($is_single_article && $this->config->get('config_tax')) {
					$tax = $this->currency->format($tax_price, $this->session->data['currency']);
				} else {
					$tax = false;
				}

				if ($this->config->get('config_review_status')) {
					$rating = $result['rating'];
				} else {
					$rating = false;
				}

				$data['products'][] = array(
					'product_id'  => $result['product_id'],
					'thumb'       => $image,
					'name'        => $result['name'],
					'description' => utf8_substr(trim(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8'))), 0, $this->config->get('theme_' . $this->config->get('config_theme') . '_product_description_length')) . '..',
					'price'       => $price,
					'special'     => $special,
					'is_single_article' => $is_single_article,
					'qiqo_discount_percent' => $qiqo_discount_percent,
					'qiqo_action' => $is_single_article && $sku !== '' && !empty($qiqo_action_map[$sku]),
					'tax'         => $tax,
					'rating'      => $rating,
					'href'        => $this->url->link('product/product', 'product_id=' . $result['product_id'])
				);
			}

			return $this->load->view('extension/module/special', $data);
		}
	}
}
