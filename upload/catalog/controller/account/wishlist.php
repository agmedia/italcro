<?php
class ControllerAccountWishList extends Controller {
	public function index() {
		if (!$this->customer->isLogged()) {
			$this->session->data['redirect'] = $this->url->link('account/wishlist', '', true);

			$this->response->redirect($this->url->link('account/login', '', true));
		}

		$this->load->language('account/wishlist');

		$this->load->model('account/wishlist');

		$this->load->model('catalog/product');

		$this->load->model('tool/image');

		if (isset($this->request->get['remove'])) {
			// Remove Wishlist
			$this->model_account_wishlist->deleteWishlist($this->request->get['remove']);

			$this->session->data['success'] = $this->language->get('text_remove');

			$this->response->redirect($this->url->link('account/wishlist'));
		}

		$this->document->setTitle($this->language->get('heading_title'));

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_account'),
			'href' => $this->url->link('account/account', '', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('account/wishlist')
		);

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		$data['products'] = array();
		$data['wishlist_has_c100'] = false;
		$data['show_prices'] = ($this->customer->isLogged() || !$this->config->get('config_customer_price'));

		$results = $this->model_account_wishlist->getWishlist();
		$wishlist_products = array();
		$wishlist_skus = array();

		foreach ($results as $result) {
			$product_info = $this->model_catalog_product->getProduct($result['product_id']);

			if ($product_info) {
				$wishlist_products[] = $product_info;

				$sku = trim((string)$product_info['sku']);
				if ($sku !== '') {
					$wishlist_skus[] = $sku;
				}
			} else {
				$this->model_account_wishlist->deleteWishlist($result['product_id']);
			}
		}

		$qiqo_price_map = array();
		$qiqo_action_details_map = $wishlist_skus ? $this->model_catalog_product->getQiqoActionDetailsMap($wishlist_skus) : array();

		if ($data['show_prices'] && $wishlist_products) {
			$sku_quantities = array();
			$base_prices = array();

			foreach ($wishlist_products as $product_info) {
				$sku = trim((string)$product_info['sku']);

				if ($sku === '') {
					continue;
				}

				$minimum = ($product_info['minimum'] > 0) ? (int)$product_info['minimum'] : 1;
				$pak = isset($product_info['pak']) ? (int)$product_info['pak'] : 0;
				$minimum_step = $this->qiqoMinimumStep($product_info['cent'], $pak, $minimum);
				$base_unit = isset($product_info['base_price']) ? (float)$product_info['base_price'] : (float)$product_info['price'];

				if ($base_unit <= 0) {
					continue;
				}

				$sku_quantities[$sku] = $minimum_step;
				$base_prices[$sku] = $base_unit;
			}

			if ($sku_quantities) {
				$qiqo_price_map = $this->model_catalog_product->getQiqoPricingMap(
					(int)$this->customer->getId(),
					$sku_quantities,
					$base_prices,
					false,
					false
				);
			}
		}

		foreach ($wishlist_products as $product_info) {
			$minimum = ($product_info['minimum'] > 0) ? (int)$product_info['minimum'] : 1;
			$pak = isset($product_info['pak']) ? (int)$product_info['pak'] : 0;
			$minimum_step = $this->qiqoMinimumStep($product_info['cent'], $pak, $minimum);
			$sku = trim((string)$product_info['sku']);

			if ($this->qiqoIsC100($product_info['cent'])) {
				$data['wishlist_has_c100'] = true;
			}

			$vpc_unit_raw = isset($product_info['base_price']) ? (float)$product_info['base_price'] : (float)$product_info['price'];
			$price_unit_raw = $vpc_unit_raw;
			$discount_percent = 0.0;

			if ($sku !== '' && isset($qiqo_price_map[$sku])) {
				$row_pricing = $qiqo_price_map[$sku];
				$vpc_unit_raw = isset($row_pricing['base_unit_price']) ? (float)$row_pricing['base_unit_price'] : $vpc_unit_raw;
				$price_unit_raw = isset($row_pricing['final_unit_price']) ? (float)$row_pricing['final_unit_price'] : $vpc_unit_raw;
				$discount_percent = isset($row_pricing['base_discount_percent']) ? (float)$row_pricing['base_discount_percent'] : 0.0;
			}

			$vpc_display_raw = (isset($product_info['vpc']) && (float)$product_info['vpc'] > 0)
				? (float)$product_info['vpc']
				: $this->qiqoDisplayPriceRaw($vpc_unit_raw, $product_info['cent']);
			$price_display_raw = $this->qiqoDisplayPriceRaw($price_unit_raw, $product_info['cent']);

			if ($discount_percent > 0 && $vpc_display_raw > 0) {
				$price_display_raw = $vpc_display_raw * (1 - ($discount_percent / 100));
			}

			$action_conditions = ($sku !== '' && isset($qiqo_action_details_map[$sku]))
				? $this->formatQiqoActionConditions($qiqo_action_details_map[$sku])
				: array();

			$data['products'][] = array(
				'product_id' => $product_info['product_id'],
				'code'       => $product_info['sku'],
				'barcode'    => $product_info['model'],
				'ean'        => $product_info['ean'],
				'cent'       => $product_info['cent'],
				'pak'        => $pak,
				'name'       => $product_info['name'],
				'name_add'   => $product_info['name_add'],
				'description_add' => isset($product_info['description_add']) ? $product_info['description_add'] : '',
				'stock'      => $product_info['quantity'],
				'minimum'    => $minimum,
				'packaging'  => $this->formatQiqoPackaging($product_info['ean'], $minimum, $pak),
				'minimumifc100' => $minimum_step,
				'qiqo_discount_percent' => $discount_percent,
				'qiqo_action' => !empty($action_conditions),
				'qiqo_action_conditions' => $action_conditions,
				'vpc'        => $data['show_prices'] ? $this->currency->format($vpc_display_raw, $this->session->data['currency']) : false,
				'final_price' => $data['show_prices'] ? $this->currency->format($price_display_raw, $this->session->data['currency']) : false,
				'price'      => $data['show_prices'] ? $this->currency->format($price_display_raw, $this->session->data['currency']) : false,
				'href'       => $this->url->link('product/product', 'product_id=' . $product_info['product_id']),
				'remove'     => $this->url->link('account/wishlist', 'remove=' . $product_info['product_id'])
			);
		}

		$data['continue'] = $this->url->link('account/account', '', true);

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		$this->response->setOutput($this->load->view('account/wishlist', $data));
	}

	public function add() {
		$this->load->language('account/wishlist');

		$json = array();

		if (isset($this->request->post['product_id'])) {
			$product_id = $this->request->post['product_id'];
		} else {
			$product_id = 0;
		}

		$this->load->model('catalog/product');

		$product_info = $this->model_catalog_product->getProduct($product_id);

		if ($product_info) {
			if ($this->customer->isLogged()) {
				// Edit customers cart
				$this->load->model('account/wishlist');

				$this->model_account_wishlist->addWishlist($this->request->post['product_id']);

				$json['success'] = sprintf($this->language->get('text_success'), $this->url->link('product/product', 'product_id=' . (int)$this->request->post['product_id']), $product_info['name'], $this->url->link('account/wishlist'));

				$json['total'] = sprintf($this->language->get('text_wishlist'), $this->model_account_wishlist->getTotalWishlist());
			} else {
				if (!isset($this->session->data['wishlist'])) {
					$this->session->data['wishlist'] = array();
				}

				$this->session->data['wishlist'][] = $this->request->post['product_id'];

				$this->session->data['wishlist'] = array_unique($this->session->data['wishlist']);

				$json['success'] = sprintf($this->language->get('text_login'), $this->url->link('account/login', '', true), $this->url->link('account/register', '', true), $this->url->link('product/product', 'product_id=' . (int)$this->request->post['product_id']), $product_info['name'], $this->url->link('account/wishlist'));

				$json['total'] = sprintf($this->language->get('text_wishlist'), (isset($this->session->data['wishlist']) ? count($this->session->data['wishlist']) : 0));
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
}
