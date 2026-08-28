<?php
namespace Cart;
require_once(DIR_SYSTEM . 'library/qiqo/pricing_resolver.php');

class Cart {
	private $data = array();
	private $qiqo_base_tables_ready = null;
	private $qiqo_partner_article_table_ready = null;
	private $qiqo_action_table_ready = null;
	private $qiqo_authorization = null;
	private $qiqo_article_discount_cache = array();
	private $qiqo_action_rows_cache = array();

	public function __construct($registry) {
		$this->config = $registry->get('config');
		$this->customer = $registry->get('customer');
		$this->session = $registry->get('session');
		$this->db = $registry->get('db');
		$this->tax = $registry->get('tax');
		$this->weight = $registry->get('weight');

		// Remove all the expired carts with no customer ID
		$this->db->query("DELETE FROM " . DB_PREFIX . "cart WHERE (api_id > '0' OR customer_id = '0') AND date_added < DATE_SUB(NOW(), INTERVAL 1 HOUR)");

		if ($this->customer->getId()) {
			// We want to change the session ID on all the old items in the customers cart
			$this->db->query("UPDATE " . DB_PREFIX . "cart SET session_id = '" . $this->db->escape($this->session->getId()) . "' WHERE api_id = '0' AND customer_id = '" . (int)$this->customer->getId() . "'");

			// Once the customer is logged in we want to update the customers cart
			$cart_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "cart WHERE api_id = '0' AND customer_id = '0' AND session_id = '" . $this->db->escape($this->session->getId()) . "'");

			foreach ($cart_query->rows as $cart) {
				$this->db->query("DELETE FROM " . DB_PREFIX . "cart WHERE cart_id = '" . (int)$cart['cart_id'] . "'");

				// The advantage of using $this->add is that it will check if the products already exist and increaser the quantity if necessary.
					$this->add($cart['product_id'], $cart['quantity'], json_decode($cart['option']), $cart['recurring_id'], true);
			}
		}
	}

	private function normalizeQiqoQuantity($quantity) {
		if (is_string($quantity)) {
			$quantity = trim($quantity);
			$quantity = str_replace(array(' ', "\xc2\xa0"), '', $quantity);
			if (strpos($quantity, ',') !== false) {
				$quantity = str_replace('.', '', $quantity);
				$quantity = str_replace(',', '.', $quantity);
			}
		}

		$value = (float)$quantity;
		if ($value < 0) {
			$value = 0;
		}

		return number_format($value, 4, '.', '');
	}

	public function getProducts() {
		$product_data = array();

		$cart_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "cart WHERE api_id = '" . (isset($this->session->data['api_id']) ? (int)$this->session->data['api_id'] : 0) . "' AND customer_id = '" . (int)$this->customer->getId() . "' AND session_id = '" . $this->db->escape($this->session->getId()) . "'");

		foreach ($cart_query->rows as $cart) {
			$stock = true;

			$product_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_store p2s LEFT JOIN " . DB_PREFIX . "product p ON (p2s.product_id = p.product_id) LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) WHERE p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND p2s.product_id = '" . (int)$cart['product_id'] . "' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p.date_available <= NOW() AND p.status = '1'");

			if ($product_query->num_rows && ($cart['quantity'] > 0)) {
				$option_price = 0;
				$option_points = 0;
				$option_weight = 0;

				$option_data = array();

				foreach (json_decode($cart['option']) as $product_option_id => $value) {
					$option_query = $this->db->query("SELECT po.product_option_id, po.option_id, od.name, o.type FROM " . DB_PREFIX . "product_option po LEFT JOIN `" . DB_PREFIX . "option` o ON (po.option_id = o.option_id) LEFT JOIN " . DB_PREFIX . "option_description od ON (o.option_id = od.option_id) WHERE po.product_option_id = '" . (int)$product_option_id . "' AND po.product_id = '" . (int)$cart['product_id'] . "' AND od.language_id = '" . (int)$this->config->get('config_language_id') . "'");

					if ($option_query->num_rows) {
						if ($option_query->row['type'] == 'select' || $option_query->row['type'] == 'radio') {
							$option_value_query = $this->db->query("SELECT pov.option_value_id, ovd.name, pov.quantity, pov.subtract, pov.price, pov.price_prefix, pov.points, pov.points_prefix, pov.weight, pov.weight_prefix FROM " . DB_PREFIX . "product_option_value pov LEFT JOIN " . DB_PREFIX . "option_value ov ON (pov.option_value_id = ov.option_value_id) LEFT JOIN " . DB_PREFIX . "option_value_description ovd ON (ov.option_value_id = ovd.option_value_id) WHERE pov.product_option_value_id = '" . (int)$value . "' AND pov.product_option_id = '" . (int)$product_option_id . "' AND ovd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

							if ($option_value_query->num_rows) {
								if ($option_value_query->row['price_prefix'] == '+') {
									$option_price += $option_value_query->row['price'];
								} elseif ($option_value_query->row['price_prefix'] == '-') {
									$option_price -= $option_value_query->row['price'];
								}

								if ($option_value_query->row['points_prefix'] == '+') {
									$option_points += $option_value_query->row['points'];
								} elseif ($option_value_query->row['points_prefix'] == '-') {
									$option_points -= $option_value_query->row['points'];
								}

								if ($option_value_query->row['weight_prefix'] == '+') {
									$option_weight += $option_value_query->row['weight'];
								} elseif ($option_value_query->row['weight_prefix'] == '-') {
									$option_weight -= $option_value_query->row['weight'];
								}

								if ($option_value_query->row['subtract'] && (!$option_value_query->row['quantity'] || ($option_value_query->row['quantity'] < $cart['quantity']))) {
									$stock = false;
								}

								$option_data[] = array(
									'product_option_id'       => $product_option_id,
									'product_option_value_id' => $value,
									'option_id'               => $option_query->row['option_id'],
									'option_value_id'         => $option_value_query->row['option_value_id'],
									'name'                    => $option_query->row['name'],
									'value'                   => $option_value_query->row['name'],
									'type'                    => $option_query->row['type'],
									'quantity'                => $option_value_query->row['quantity'],
									'subtract'                => $option_value_query->row['subtract'],
									'price'                   => $option_value_query->row['price'],
									'price_prefix'            => $option_value_query->row['price_prefix'],
									'points'                  => $option_value_query->row['points'],
									'points_prefix'           => $option_value_query->row['points_prefix'],
									'weight'                  => $option_value_query->row['weight'],
									'weight_prefix'           => $option_value_query->row['weight_prefix']
								);
							}
						} elseif ($option_query->row['type'] == 'checkbox' && is_array($value)) {
							foreach ($value as $product_option_value_id) {
								$option_value_query = $this->db->query("SELECT pov.option_value_id, pov.quantity, pov.subtract, pov.price, pov.price_prefix, pov.points, pov.points_prefix, pov.weight, pov.weight_prefix, ovd.name FROM " . DB_PREFIX . "product_option_value pov LEFT JOIN " . DB_PREFIX . "option_value_description ovd ON (pov.option_value_id = ovd.option_value_id) WHERE pov.product_option_value_id = '" . (int)$product_option_value_id . "' AND pov.product_option_id = '" . (int)$product_option_id . "' AND ovd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

								if ($option_value_query->num_rows) {
									if ($option_value_query->row['price_prefix'] == '+') {
										$option_price += $option_value_query->row['price'];
									} elseif ($option_value_query->row['price_prefix'] == '-') {
										$option_price -= $option_value_query->row['price'];
									}

									if ($option_value_query->row['points_prefix'] == '+') {
										$option_points += $option_value_query->row['points'];
									} elseif ($option_value_query->row['points_prefix'] == '-') {
										$option_points -= $option_value_query->row['points'];
									}

									if ($option_value_query->row['weight_prefix'] == '+') {
										$option_weight += $option_value_query->row['weight'];
									} elseif ($option_value_query->row['weight_prefix'] == '-') {
										$option_weight -= $option_value_query->row['weight'];
									}

									if ($option_value_query->row['subtract'] && (!$option_value_query->row['quantity'] || ($option_value_query->row['quantity'] < $cart['quantity']))) {
										$stock = false;
									}

									$option_data[] = array(
										'product_option_id'       => $product_option_id,
										'product_option_value_id' => $product_option_value_id,
										'option_id'               => $option_query->row['option_id'],
										'option_value_id'         => $option_value_query->row['option_value_id'],
										'name'                    => $option_query->row['name'],
										'value'                   => $option_value_query->row['name'],
										'type'                    => $option_query->row['type'],
										'quantity'                => $option_value_query->row['quantity'],
										'subtract'                => $option_value_query->row['subtract'],
										'price'                   => $option_value_query->row['price'],
										'price_prefix'            => $option_value_query->row['price_prefix'],
										'points'                  => $option_value_query->row['points'],
										'points_prefix'           => $option_value_query->row['points_prefix'],
										'weight'                  => $option_value_query->row['weight'],
										'weight_prefix'           => $option_value_query->row['weight_prefix']
									);
								}
							}
						} elseif ($option_query->row['type'] == 'text' || $option_query->row['type'] == 'textarea' || $option_query->row['type'] == 'file' || $option_query->row['type'] == 'date' || $option_query->row['type'] == 'datetime' || $option_query->row['type'] == 'time') {
							$option_data[] = array(
								'product_option_id'       => $product_option_id,
								'product_option_value_id' => '',
								'option_id'               => $option_query->row['option_id'],
								'option_value_id'         => '',
								'name'                    => $option_query->row['name'],
								'value'                   => $value,
								'type'                    => $option_query->row['type'],
								'quantity'                => '',
								'subtract'                => '',
								'price'                   => '',
								'price_prefix'            => '',
								'points'                  => '',
								'points_prefix'           => '',
								'weight'                  => '',
								'weight_prefix'           => ''
							);
						}
					}
				}

				$price = $product_query->row['price'];

				// Product Discounts
				$discount_quantity = 0;

				foreach ($cart_query->rows as $cart_2) {
					if ($cart_2['product_id'] == $cart['product_id']) {
						$discount_quantity += $cart_2['quantity'];
					}
				}

				$product_discount_query = $this->db->query("SELECT price FROM " . DB_PREFIX . "product_discount WHERE product_id = '" . (int)$cart['product_id'] . "' AND customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' AND quantity <= '" . (int)$discount_quantity . "' AND ((date_start = '0000-00-00' OR date_start < NOW()) AND (date_end = '0000-00-00' OR date_end > NOW())) ORDER BY quantity DESC, priority ASC, price ASC LIMIT 1");

				if ($product_discount_query->num_rows) {
					$price = $product_discount_query->row['price'];
				}

				// Product Specials
				$product_special_query = $this->db->query("SELECT price FROM " . DB_PREFIX . "product_special WHERE product_id = '" . (int)$cart['product_id'] . "' AND customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' AND ((date_start = '0000-00-00' OR date_start < NOW()) AND (date_end = '0000-00-00' OR date_end > NOW())) ORDER BY priority ASC, price ASC LIMIT 1");

				if ($product_special_query->num_rows) {
					$price = $product_special_query->row['price'];
				}

				$legacy_price = (float)$price;
					$price = $this->applyQiqoCartPrice(
						(string)$product_query->row['sku'],
						(float)$product_query->row['price'],
						(float)$discount_quantity,
						isset($product_query->row['cent']) ? (string)$product_query->row['cent'] : '',
						$legacy_price
					);

				// Reward Points
				$product_reward_query = $this->db->query("SELECT points FROM " . DB_PREFIX . "product_reward WHERE product_id = '" . (int)$cart['product_id'] . "' AND customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "'");

				if ($product_reward_query->num_rows) {
					$reward = $product_reward_query->row['points'];
				} else {
					$reward = 0;
				}

				// Downloads
				$download_data = array();

				$download_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_download p2d LEFT JOIN " . DB_PREFIX . "download d ON (p2d.download_id = d.download_id) LEFT JOIN " . DB_PREFIX . "download_description dd ON (d.download_id = dd.download_id) WHERE p2d.product_id = '" . (int)$cart['product_id'] . "' AND dd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

				foreach ($download_query->rows as $download) {
					$download_data[] = array(
						'download_id' => $download['download_id'],
						'name'        => $download['name'],
						'filename'    => $download['filename'],
						'mask'        => $download['mask']
					);
				}

				// Stock
				if (!$product_query->row['quantity'] || ($product_query->row['quantity'] < $cart['quantity'])) {
					$stock = false;
				}

				$recurring_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "recurring r LEFT JOIN " . DB_PREFIX . "product_recurring pr ON (r.recurring_id = pr.recurring_id) LEFT JOIN " . DB_PREFIX . "recurring_description rd ON (r.recurring_id = rd.recurring_id) WHERE r.recurring_id = '" . (int)$cart['recurring_id'] . "' AND pr.product_id = '" . (int)$cart['product_id'] . "' AND rd.language_id = " . (int)$this->config->get('config_language_id') . " AND r.status = 1 AND pr.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "'");

				if ($recurring_query->num_rows) {
					$recurring = array(
						'recurring_id'    => $cart['recurring_id'],
						'name'            => $recurring_query->row['name'],
						'frequency'       => $recurring_query->row['frequency'],
						'price'           => $recurring_query->row['price'],
						'cycle'           => $recurring_query->row['cycle'],
						'duration'        => $recurring_query->row['duration'],
						'trial'           => $recurring_query->row['trial_status'],
						'trial_frequency' => $recurring_query->row['trial_frequency'],
						'trial_price'     => $recurring_query->row['trial_price'],
						'trial_cycle'     => $recurring_query->row['trial_cycle'],
						'trial_duration'  => $recurring_query->row['trial_duration']
					);
				} else {
					$recurring = false;
				}

					$minimum_step = 1.0;
					$cent_normalized = strtoupper(preg_replace('/[^A-Z0-9]/', '', (string)$product_query->row['cent']));
					$pak_required = isset($product_query->row['pak']) && (int)$product_query->row['pak'] === 1;
					$jm = isset($product_query->row['jm']) && trim((string)$product_query->row['jm']) !== '' ? $product_query->row['jm'] : $product_query->row['ean'];
					$pack_quantity = isset($product_query->row['pakkol']) ? (float)$product_query->row['pakkol'] : 0.0;
					$attribute = isset($product_query->row['name_add']) ? str_replace(',', '.', trim((string)$product_query->row['name_add'])) : '';
					if (strtoupper(trim((string)$jm)) === 'MET' && preg_match('/(^|[^0-9])([0-9]+(?:\\.[0-9]+)?)\\s*m([^a-z0-9]|$)/i', $attribute, $match)) {
						$meter_length = (float)$match[2];
						if ($meter_length > 0 && abs($meter_length - round($meter_length)) > 0.00001) {
							$pack_quantity = $meter_length;
						}
					}
					if ($pack_quantity <= 0) {
						$pack_quantity = $product_query->row['minimum'] ? (float)$product_query->row['minimum'] : 1.0;
					}
					if ($cent_normalized === 'C100' || $pak_required || abs($pack_quantity - round($pack_quantity)) > 0.00001) {
						$minimum_step = $pack_quantity;
					}
					if ($minimum_step <= 0) {
						$minimum_step = 1.0;
					}

					$unit_price_scale = \QiqoPricingResolver::isC100($product_query->row['cent']) ? 7 : 5;
					$resolved_unit_price = round((float)$price + (float)$option_price, $unit_price_scale);
					$resolved_line_total = round($resolved_unit_price * (float)$cart['quantity'], 5);

					$product_data[] = array(
					'cart_id'         => $cart['cart_id'],
					'product_id'      => $product_query->row['product_id'],
					'name'            => $product_query->row['name'],
					'name_add'        => isset($product_query->row['name_add']) ? $product_query->row['name_add'] : '',
					'model'           => $product_query->row['model'],
					'sku'             => $product_query->row['sku'],
						'jm'              => $jm,
						'pakkol'          => $pack_quantity,
					'vpc'             => isset($product_query->row['vpc']) ? (float)$product_query->row['vpc'] : 0.0,
					'shipping'        => $product_query->row['shipping'],
					'image'           => $product_query->row['image'],
					'option'          => $option_data,
					'download'        => $download_data,
					'quantity'        => $cart['quantity'],
					'minimum'         => $product_query->row['minimum'],
					'minimumifc100'   => $minimum_step,
					'cent'            => $product_query->row['cent'],
					'pak'             => isset($product_query->row['pak']) ? (int)$product_query->row['pak'] : 0,
					'subtract'        => $product_query->row['subtract'],
					'stock'           => $stock,
						'ocm_special'     => abs((float)$price - (float)$product_query->row['price']) > 0.0000001,
						'price'           => $resolved_unit_price,
						'total'           => $resolved_line_total,
					'reward'          => $reward * $cart['quantity'],
					'points'          => ($product_query->row['points'] ? ($product_query->row['points'] + $option_points) * $cart['quantity'] : 0),
					'tax_class_id'    => $product_query->row['tax_class_id'],
					'weight'          => ($product_query->row['weight'] + $option_weight) * $cart['quantity'],
					'weight_class_id' => $product_query->row['weight_class_id'],
					'length'          => $product_query->row['length'],
					'width'           => $product_query->row['width'],
					'height'          => $product_query->row['height'],
					'length_class_id' => $product_query->row['length_class_id'],
					'recurring'       => $recurring
				);
			} else {
				$this->remove($cart['cart_id']);
			}
		}

		return $product_data;
	}

	private function applyQiqoCartPrice($sku, $base_price, $qty, $cent = '', $fallback_price = null) {
		$sku = trim((string)$sku);
		$base_price = (float)$base_price;
		$qty = (float)$qty;
		$fallback_price = $fallback_price !== null ? (float)$fallback_price : $base_price;

		if (!$this->customer->getId() || $sku === '' || $base_price <= 0 || $qty <= 0) {
			return $fallback_price;
		}

		if (!$this->hasQiqoBasePricingTables()) {
			return $fallback_price;
		}

		$auth = $this->getQiqoAuthorization();
		if (!$auth || empty($auth['partner_id'])) {
			return $fallback_price;
		}

		$partner_id = (int)$auth['partner_id'];
		$base_discount = isset($auth['partner_discount']) ? (float)$auth['partner_discount'] : 0.0;

		$article_discount = $this->hasQiqoPartnerArticleDiscountTable()
			? $this->getQiqoArticleDiscount($partner_id, $sku)
			: null;
		$base_source = 'partner';
		if ($article_discount !== null) {
			$base_discount = (float)$article_discount;
			$base_source = 'article';
		}

		$pricing = \QiqoPricingResolver::resolve(
			$base_price,
			$base_discount,
			$base_source,
			$this->hasQiqoActionPriceTable() ? $this->getQiqoActionRows($sku) : array(),
			$qty,
			true,
			$this->isQiqoProformaPayment(),
			$cent
		);

		return (float)$pricing['final_unit_price'];
	}

	private function getQiqoAuthorization() {
		if ($this->qiqo_authorization !== null) {
			return $this->qiqo_authorization;
		}

		$customer_id = (int)$this->customer->getId();
		if (!$customer_id) {
			$this->qiqo_authorization = array();
			return $this->qiqo_authorization;
		}

		$query = $this->db->query("SELECT cqa.partner_id,
					cqa.partner_discount,
					qp.base_discount,
					qp.active AS partner_active
			FROM `" . DB_PREFIX . "customer_qiqo_authorization` cqa
			LEFT JOIN `" . DB_PREFIX . "qiqo_partner` qp ON (qp.partner_id = cqa.partner_id)
			WHERE cqa.customer_id = '" . $customer_id . "'
			LIMIT 1");

		if (!$query->num_rows || empty($query->row['partner_active'])) {
			$this->qiqo_authorization = array();
			return $this->qiqo_authorization;
		}

			// The authorization selects the ERP partner. Always price from the
			// partner's current qPartnerWeb rebate; the copied approval value is only
			// a fallback for legacy/incomplete cache rows.
			$partner_discount = isset($query->row['base_discount']) && $query->row['base_discount'] !== null
				? (float)$query->row['base_discount']
				: (isset($query->row['partner_discount']) ? (float)$query->row['partner_discount'] : 0.0);

		$this->qiqo_authorization = array(
			'partner_id' => (int)$query->row['partner_id'],
			'partner_discount' => (float)$partner_discount
		);

		return $this->qiqo_authorization;
	}

	private function getQiqoArticleDiscount($partner_id, $sku) {
		$key = (int)$partner_id . '|' . (string)$sku;

		if (array_key_exists($key, $this->qiqo_article_discount_cache)) {
			return $this->qiqo_article_discount_cache[$key];
		}

		$query = $this->db->query("SELECT discount
			FROM `" . DB_PREFIX . "qiqo_partner_article_discount`
			WHERE partner_id = '" . (int)$partner_id . "'
			  AND article_code = '" . $this->db->escape((string)$sku) . "'
			LIMIT 1");

		if ($query->num_rows) {
			$this->qiqo_article_discount_cache[$key] = (float)$query->row['discount'];
		} else {
			$this->qiqo_article_discount_cache[$key] = null;
		}

		return $this->qiqo_article_discount_cache[$key];
	}

	private function getQiqoActionRows($sku) {
		$sku = (string)$sku;

		if (isset($this->qiqo_action_rows_cache[$sku])) {
			return $this->qiqo_action_rows_cache[$sku];
		}

		$query = $this->db->query("SELECT indicator, quantity, price, discount
			FROM `" . DB_PREFIX . "qiqo_action_price`
			WHERE article_code = '" . $this->db->escape($sku) . "'");

		$rows = array();
		foreach ($query->rows as $row) {
			$rows[] = array(
				'indicator' => strtoupper(trim((string)$row['indicator'])),
				'quantity'  => (float)$row['quantity'],
				'price'     => (float)$row['price'],
				'discount'  => (float)$row['discount']
			);
		}

		$this->qiqo_action_rows_cache[$sku] = $rows;
		return $this->qiqo_action_rows_cache[$sku];
	}

	private function isQiqoProformaPayment() {
		$code = '';

		if (isset($this->session->data['payment_method']['code'])) {
			$code = (string)$this->session->data['payment_method']['code'];
		} elseif (isset($this->session->data['payment_code'])) {
			$code = (string)$this->session->data['payment_code'];
		}

		$code = strtolower(trim($code));

		if ($code === '') {
			return false;
		}

		$proforma_tokens = array(
			'bank_transfer',
			'free_checkout',
			'predrac',
			'virman'
		);

		foreach ($proforma_tokens as $token) {
			if (strpos($code, $token) !== false) {
				return true;
			}
		}

		return false;
	}

	private function hasQiqoBasePricingTables() {
		if ($this->qiqo_base_tables_ready !== null) {
			return $this->qiqo_base_tables_ready;
		}

		$required = array(
			DB_PREFIX . 'customer_qiqo_authorization',
			DB_PREFIX . 'qiqo_partner'
		);

		foreach ($required as $table) {
			$q = $this->db->query("SHOW TABLES LIKE '" . $this->db->escape($table) . "'");
			if (!$q->num_rows) {
				$this->qiqo_base_tables_ready = false;
				return $this->qiqo_base_tables_ready;
			}
		}

		$this->qiqo_base_tables_ready = true;
		return $this->qiqo_base_tables_ready;
	}

	private function hasQiqoPartnerArticleDiscountTable() {
		if ($this->qiqo_partner_article_table_ready !== null) {
			return $this->qiqo_partner_article_table_ready;
		}

		$q = $this->db->query("SHOW TABLES LIKE '" . $this->db->escape(DB_PREFIX . 'qiqo_partner_article_discount') . "'");
		$this->qiqo_partner_article_table_ready = (bool)$q->num_rows;
		return $this->qiqo_partner_article_table_ready;
	}

	private function hasQiqoActionPriceTable() {
		if ($this->qiqo_action_table_ready !== null) {
			return $this->qiqo_action_table_ready;
		}

		$q = $this->db->query("SHOW TABLES LIKE '" . $this->db->escape(DB_PREFIX . 'qiqo_action_price') . "'");
		$this->qiqo_action_table_ready = (bool)$q->num_rows;
		return $this->qiqo_action_table_ready;
	}

	private function isQiqoGroupedProduct($product_id) {
		$product_query = $this->db->query("SELECT `mpn` FROM " . DB_PREFIX . "product WHERE `product_id` = '" . (int)$product_id . "' LIMIT 1");

		if (!$product_query->num_rows) {
			return false;
		}

		$mpn = trim((string)$product_query->row['mpn']);
		if ($mpn === '') {
			return false;
		}

		$count_query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product WHERE `mpn` = '" . $this->db->escape($mpn) . "' AND `status` = '1' AND `date_available` <= NOW()");

		return isset($count_query->row['total']) && (int)$count_query->row['total'] > 1;
	}

	public function add($product_id, $quantity = 1, $option = array(), $recurring_id = 0, $allow_grouped_variant = false) {
		// A grouped catalog card represents several real SKUs. Generic/stale
		// add-to-cart calls must not silently choose its representative SKU.
		// Surfaces where the buyer explicitly selected an exact variant opt in.
		if (!$allow_grouped_variant && $this->isQiqoGroupedProduct($product_id)) {
			return false;
		}

		$quantity_sql = $this->normalizeQiqoQuantity($quantity);
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "cart WHERE api_id = '" . (isset($this->session->data['api_id']) ? (int)$this->session->data['api_id'] : 0) . "' AND customer_id = '" . (int)$this->customer->getId() . "' AND session_id = '" . $this->db->escape($this->session->getId()) . "' AND product_id = '" . (int)$product_id . "' AND recurring_id = '" . (int)$recurring_id . "' AND `option` = '" . $this->db->escape(json_encode($option)) . "'");

		if (!$query->row['total']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "cart SET api_id = '" . (isset($this->session->data['api_id']) ? (int)$this->session->data['api_id'] : 0) . "', customer_id = '" . (int)$this->customer->getId() . "', session_id = '" . $this->db->escape($this->session->getId()) . "', product_id = '" . (int)$product_id . "', recurring_id = '" . (int)$recurring_id . "', `option` = '" . $this->db->escape(json_encode($option)) . "', quantity = '" . $quantity_sql . "', date_added = NOW()");
		} else {
			$this->db->query("UPDATE " . DB_PREFIX . "cart SET quantity = (quantity + " . $quantity_sql . ") WHERE api_id = '" . (isset($this->session->data['api_id']) ? (int)$this->session->data['api_id'] : 0) . "' AND customer_id = '" . (int)$this->customer->getId() . "' AND session_id = '" . $this->db->escape($this->session->getId()) . "' AND product_id = '" . (int)$product_id . "' AND recurring_id = '" . (int)$recurring_id . "' AND `option` = '" . $this->db->escape(json_encode($option)) . "'");
		}

		return true;
	}

	public function update($cart_id, $quantity) {
		$quantity_sql = $this->normalizeQiqoQuantity($quantity);
		$this->db->query("UPDATE " . DB_PREFIX . "cart SET quantity = '" . $quantity_sql . "' WHERE cart_id = '" . (int)$cart_id . "' AND api_id = '" . (isset($this->session->data['api_id']) ? (int)$this->session->data['api_id'] : 0) . "' AND customer_id = '" . (int)$this->customer->getId() . "' AND session_id = '" . $this->db->escape($this->session->getId()) . "'");
	}

	public function remove($cart_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "cart WHERE cart_id = '" . (int)$cart_id . "' AND api_id = '" . (isset($this->session->data['api_id']) ? (int)$this->session->data['api_id'] : 0) . "' AND customer_id = '" . (int)$this->customer->getId() . "' AND session_id = '" . $this->db->escape($this->session->getId()) . "'");
	}

	public function clear() {
		$this->db->query("DELETE FROM " . DB_PREFIX . "cart WHERE api_id = '" . (isset($this->session->data['api_id']) ? (int)$this->session->data['api_id'] : 0) . "' AND customer_id = '" . (int)$this->customer->getId() . "' AND session_id = '" . $this->db->escape($this->session->getId()) . "'");
	}

	public function getRecurringProducts() {
		$product_data = array();

		foreach ($this->getProducts() as $value) {
			if ($value['recurring']) {
				$product_data[] = $value;
			}
		}

		return $product_data;
	}

	public function getWeight() {
		$weight = 0;

		foreach ($this->getProducts() as $product) {
			if ($product['shipping']) {
				$weight += $this->weight->convert($product['weight'], $product['weight_class_id'], $this->config->get('config_weight_class_id'));
			}
		}

		return $weight;
	}

	public function getSubTotal() {
		$total = 0;

		foreach ($this->getProducts() as $product) {
			$total += $product['total'];
		}

		return round($total, 5);
	}

	public function getTaxes() {
		$tax_data = array();

		foreach ($this->getProducts() as $product) {
			if ($product['tax_class_id']) {
				$tax_rates = $this->tax->getRates($product['price'], $product['tax_class_id']);

				foreach ($tax_rates as $tax_rate) {
					if (!isset($tax_data[$tax_rate['tax_rate_id']])) {
						$tax_data[$tax_rate['tax_rate_id']] = ($tax_rate['amount'] * $product['quantity']);
					} else {
						$tax_data[$tax_rate['tax_rate_id']] += ($tax_rate['amount'] * $product['quantity']);
					}
				}
			}
		}

		return $tax_data;
	}

	public function getTotal() {
		$total = 0;

		foreach ($this->getProducts() as $product) {
			$total += round(
				$this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax')) * $product['quantity'],
				5
			);
		}

		return round($total, 5);
	}

	public function countProducts() {
		$product_total = 0;

		$products = $this->getProducts();

		foreach ($products as $product) {
			$product_total += $product['quantity'];
		}

		return $product_total;
	}

	public function hasProducts() {
		return count($this->getProducts());
	}

	public function hasRecurringProducts() {
		return count($this->getRecurringProducts());
	}

	public function hasStock() {
		foreach ($this->getProducts() as $product) {
			if (!$product['stock']) {
				return false;
			}
		}

		return true;
	}

	public function hasShipping() {
		foreach ($this->getProducts() as $product) {
			if ($product['shipping']) {
				return true;
			}
		}

		return false;
	}

	public function hasDownload() {
		foreach ($this->getProducts() as $product) {
			if ($product['download']) {
				return true;
			}
		}

		return false;
	}
}
