<?php

/**
 * Builds the immutable, credential-free NarudzbaSend payload for one order.
 *
 * Credentials are deliberately added only by the sender immediately before the
 * HTTP request. They must never be persisted in the outbox or an application log.
 */
class QiqoOrderPayload {
	const CONTRACT_VERSION = 2;

	private $db;
	private $config;

	public function __construct($registry) {
		$this->db = $registry->get('db');
		$this->config = $registry->get('config');
	}

	public function build($order_id) {
		$order_id = (int)$order_id;

		$order_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "order` WHERE order_id = '" . $order_id . "' LIMIT 1");
		if (!$order_query->num_rows) {
			throw new RuntimeException('Narudžba ne postoji.');
		}

		$order = $order_query->row;
		if ((int)$order['customer_id'] <= 0) {
			throw new RuntimeException('NarudzbaSend je dopušten samo za autoriziranog kupca.');
		}

		if (strtoupper(trim((string)$order['currency_code'])) !== 'EUR') {
			throw new RuntimeException('NarudzbaSend trenutno podržava samo EUR narudžbe.');
		}

		$authorization_query = $this->db->query("SELECT cqa.partner_id,
				cqa.delivery_place_id,
				cqa.sales_rep_id,
				qp.name AS partner_name,
				qdp.code AS delivery_place_code,
				qsr.code AS sales_rep_code
			FROM `" . DB_PREFIX . "customer_qiqo_authorization` cqa
			INNER JOIN `" . DB_PREFIX . "qiqo_partner` qp
				ON (qp.partner_id = cqa.partner_id AND qp.active = '1')
			INNER JOIN `" . DB_PREFIX . "qiqo_delivery_place` qdp
				ON (qdp.delivery_place_id = cqa.delivery_place_id AND qdp.partner_id = cqa.partner_id)
			LEFT JOIN `" . DB_PREFIX . "qiqo_sales_rep` qsr
				ON (qsr.sales_rep_id = cqa.sales_rep_id AND qsr.active = '1')
			WHERE cqa.customer_id = '" . (int)$order['customer_id'] . "'
			LIMIT 1");

		if (!$authorization_query->num_rows) {
			throw new RuntimeException('Kupac nema valjanu QIQO autorizaciju ili mjesto isporuke ne pripada partneru.');
		}

		$authorization = $authorization_query->row;
		$partner_code = trim((string)$authorization['partner_id']);
		$delivery_place_code = trim((string)$authorization['delivery_place_code']);
		$sales_rep_code = trim((string)$authorization['sales_rep_code']);
		$payload_delivery_place_code = $delivery_place_code;
		$shipping_code = strtolower(trim((string)(isset($order['shipping_code']) ? $order['shipping_code'] : '')));
		$is_pickup = $this->isPickupShippingCode($shipping_code);

		if ($is_pickup) {
			$pickup_location_code = trim((string)$this->config->get('qiqo_order_pickup_location_code'));
			if ($pickup_location_code === '') {
				throw new RuntimeException('QIQO lokacija za preuzimanje nije konfigurirana.');
			}
			$payload_delivery_place_code = $pickup_location_code;
		} elseif (!$this->isAllowedDeliveryShippingCode($shipping_code)) {
			throw new RuntimeException('Način dostave nije odobren za NarudzbaSend: ' . ($shipping_code !== '' ? $shipping_code : '(prazno)') . '.');
		}

		if ($partner_code === '' || $partner_code === '0') {
			throw new RuntimeException('QIQO šifra partnera nedostaje.');
		}
		if ($payload_delivery_place_code === '') {
			throw new RuntimeException('QIQO šifra mjesta isporuke nedostaje.');
		}
		if ($sales_rep_code === '') {
			throw new RuntimeException('QIQO komercijalist nije dodijeljen kupcu.');
		}

		$product_query = $this->db->query("SELECT op.order_product_id,
				op.product_id,
				op.quantity,
				op.price,
				op.total,
				COALESCE(NULLIF(TRIM(op.sku), ''), TRIM(p.sku)) AS article_code,
				COALESCE(NULLIF(TRIM(op.qiqo_cent), ''), p.cent) AS cent
			FROM `" . DB_PREFIX . "order_product` op
			LEFT JOIN `" . DB_PREFIX . "product` p ON (p.product_id = op.product_id)
			WHERE op.order_id = '" . $order_id . "'
			ORDER BY op.order_product_id ASC");

		if (!$product_query->num_rows) {
			throw new RuntimeException('Narudžba nema stavki.');
		}

		$items = array();
		$net_items_total = 0.0;
		$exported_items_total = 0.0;
		foreach ($product_query->rows as $product) {
			$article_code = trim((string)$product['article_code']);
			$quantity = (float)$product['quantity'];
			$line_total = (float)$product['total'];

			if ($article_code === '') {
				throw new RuntimeException('Jedna stavka nema QIQO šifru artikla.');
			}
			if (!is_finite($quantity) || $quantity <= 0) {
				throw new RuntimeException('Količina stavke mora biti veća od nule.');
			}
			if (!is_finite($line_total) || $line_total < 0) {
				throw new RuntimeException('Neto iznos stavke ne smije biti negativan.');
			}

			$net_items_total += $line_total;

			// total/quantity preserves the effective line price better than the legacy
			// DECIMAL(15,4) order_product.price column, especially for C-100 items.
			$unit_price = $line_total / $quantity;
			$is_c100 = strtoupper((string)preg_replace('/[^A-Z0-9]/', '', (string)$product['cent'])) === 'C100';

			// QIQO stores/displays a C-100 price per 100 pieces. The storefront total
			// is per piece, therefore restore the ERP price basis for NarudzbaSend.
			if ($is_c100) {
				$unit_price *= 100;
			}
			$exported_unit_price = (float)number_format($unit_price, 5, '.', '');
			$exported_line_total = $exported_unit_price * $quantity / ($is_c100 ? 100 : 1);
			if (!is_finite($exported_line_total)) {
				throw new RuntimeException('Izvezena cijena stavke nije valjana.');
			}
			if (abs($exported_line_total - $line_total) > 0.005) {
				throw new RuntimeException('Cijena stavke na pet decimala ne može reproducirati njezin neto iznos.');
			}
			$exported_items_total += $exported_line_total;

			$items[] = array(
				'artikal' => $article_code,
				'kolicina' => (float)number_format($quantity, 4, '.', ''),
				'cijena' => $exported_unit_price
			);
		}
		if (abs($exported_items_total - $net_items_total) > 0.005) {
			throw new RuntimeException('Cijene stavki na pet decimala ne mogu reproducirati neto osnovicu narudžbe.');
		}

		$totals_query = $this->db->query("SELECT code, COALESCE(SUM(`value`), 0) AS total_value
			FROM `" . DB_PREFIX . "order_total`
			WHERE order_id = '" . $order_id . "'
			GROUP BY code");
		$shipping_total = 0.0;
		$reported_sub_total = 0.0;
		$reported_tax_total = 0.0;
		$reported_grand_total = 0.0;
		$has_shipping_total = false;
		$has_sub_total = false;
		$has_grand_total = false;
		$ignored_total_codes = array('sub_total', 'tax', 'total');
		foreach ($totals_query->rows as $total_row) {
			$code = strtolower(trim((string)$total_row['code']));
			$value = (float)$total_row['total_value'];
			if (!is_finite($value)) {
				throw new RuntimeException('Iznos u sažetku narudžbe nije valjan.');
			}
			if ($code === 'shipping') {
				$has_shipping_total = true;
				$shipping_total += $value;
				continue;
			}
			if ($code === 'sub_total') {
				$has_sub_total = true;
				$reported_sub_total += $value;
			}
			if ($code === 'tax') {
				$reported_tax_total += $value;
			}
			if ($code === 'total') {
				$has_grand_total = true;
				$reported_grand_total += $value;
			}
			if (!in_array($code, $ignored_total_codes, true) && abs($value) > 0.0000001) {
				throw new RuntimeException('Narudžba sadrži nepodržanu total komponentu: ' . $code . '.');
			}
		}
		if (!is_finite($shipping_total) || $shipping_total < 0) {
			throw new RuntimeException('Neto iznos dostave ne smije biti negativan.');
		}
		if (!$has_sub_total || !$has_shipping_total || !$has_grand_total) {
			throw new RuntimeException('Sažetak narudžbe nema obavezne stavke osnovice, dostave i ukupnog iznosa.');
		}
		if (abs($reported_sub_total - $net_items_total) > 0.005) {
			throw new RuntimeException('Neto osnovica narudžbe ne odgovara zbroju stavki.');
		}
		if (abs($reported_grand_total - ($reported_sub_total + $shipping_total + $reported_tax_total)) > 0.01) {
			throw new RuntimeException('Ukupni iznos narudžbe ne odgovara osnovici, dostavi i porezu.');
		}
		if ($is_pickup && abs($shipping_total) > 0.0000001) {
			throw new RuntimeException('Preuzimanje u trgovini ne smije sadržavati trošak dostave.');
		}
		$net_order_total = $exported_items_total + $shipping_total;
		if (number_format($net_order_total, 2, '.', '') !== number_format($net_items_total + $shipping_total, 2, '.', '')) {
			throw new RuntimeException('Cijene stavki na pet decimala mijenjaju zaokruženi neto ukupni iznos narudžbe.');
		}

		$payload = array(
			'narudzba' => array(
				'komercijalist' => $this->numericIdentifier($sales_rep_code),
				'partner' => $this->numericIdentifier($partner_code),
				// Delivery place codes can contain leading zeroes and must stay strings.
				'lokacija' => $payload_delivery_place_code,
				// ERP contract: final net line totals plus net delivery, rounded once
				// to two decimals. Tax and unrelated OpenCart totals are excluded.
				'ukupno' => (float)number_format($net_order_total, 2, '.', ''),
				'napomena' => trim((string)$order['comment']),
				'stavke' => $items
			)
		);

		$json = json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRESERVE_ZERO_FRACTION);
		if ($json === false) {
			throw new RuntimeException('NarudzbaSend payload nije moguće pretvoriti u JSON.');
		}

		return array(
			'payload_contract_version' => self::CONTRACT_VERSION,
			'order_id' => $order_id,
			'order_status_id' => (int)$order['order_status_id'],
			'partner_code' => $partner_code,
			'delivery_place_code' => $payload_delivery_place_code,
			'sales_rep_code' => $sales_rep_code,
			'currency_code' => (string)$order['currency_code'],
			'payload' => $payload,
			'payload_json' => $json,
			'payload_hash' => hash('sha256', $json)
		);
	}

	private function numericIdentifier($value) {
		$value = trim((string)$value);
		return ctype_digit($value) ? (int)$value : $value;
	}

	private function isPickupShippingCode($shipping_code) {
		$shipping_code = strtolower(trim((string)$shipping_code));
		return $shipping_code === 'pickup' || strpos($shipping_code, 'pickup.') === 0;
	}

	private function isAllowedDeliveryShippingCode($shipping_code) {
		$shipping_code = strtolower(trim((string)$shipping_code));
		$configured = trim((string)$this->config->get('qiqo_order_delivery_shipping_codes'));
		if ($configured === '') {
			return false;
		}

		foreach (preg_split('/\s*,\s*/', strtolower($configured), -1, PREG_SPLIT_NO_EMPTY) as $allowed) {
			if ($shipping_code === trim($allowed)) {
				return true;
			}
		}

		return false;
	}
}
