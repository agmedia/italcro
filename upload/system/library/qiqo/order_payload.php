<?php

/**
 * Builds the immutable, credential-free NarudzbaSend payload for one order.
 *
 * Credentials are deliberately added only by the sender immediately before the
 * HTTP request. They must never be persisted in the outbox or an application log.
 */
class QiqoOrderPayload {
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

		if ($partner_code === '' || $partner_code === '0') {
			throw new RuntimeException('QIQO šifra partnera nedostaje.');
		}
		if ($delivery_place_code === '') {
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

		$price_mode = (string)$this->config->get('qiqo_order_price_mode');
		if ($price_mode === '') {
			$price_mode = 'erp_display';
		}

		$items = array();
		foreach ($product_query->rows as $product) {
			$article_code = trim((string)$product['article_code']);
			$quantity = (float)$product['quantity'];

			if ($article_code === '') {
				throw new RuntimeException('Jedna stavka nema QIQO šifru artikla.');
			}
			if ($quantity <= 0) {
				throw new RuntimeException('Količina stavke mora biti veća od nule.');
			}

			// total/quantity preserves the effective line price better than the legacy
			// DECIMAL(15,4) order_product.price column, especially for C-100 items.
			$unit_price = (float)$product['total'] / $quantity;
			$is_c100 = strtoupper((string)preg_replace('/[^A-Z0-9]/', '', (string)$product['cent'])) === 'C100';

			// QIQO stores/displays a C-100 price per 100 pieces. The storefront total
			// is per piece, therefore restore the ERP price basis for NarudzbaSend.
			if ($price_mode === 'erp_display' && $is_c100) {
				$unit_price *= 100;
			}

			$items[] = array(
				'artikal' => $article_code,
				'kolicina' => (float)number_format($quantity, 4, '.', ''),
				'cijena' => (float)number_format($unit_price, 5, '.', '')
			);
		}

		$payload = array(
			'narudzba' => array(
				'komercijalist' => $this->numericIdentifier($sales_rep_code),
				'partner' => $this->numericIdentifier($partner_code),
				// Delivery place codes can contain leading zeroes and must stay strings.
				'lokacija' => $delivery_place_code,
				'ukupno' => (float)number_format((float)$order['total'], 2, '.', ''),
				'napomena' => trim((string)$order['comment']),
				'stavke' => $items
			)
		);

		$json = json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRESERVE_ZERO_FRACTION);
		if ($json === false) {
			throw new RuntimeException('NarudzbaSend payload nije moguće pretvoriti u JSON.');
		}

		return array(
			'order_id' => $order_id,
			'order_status_id' => (int)$order['order_status_id'],
			'partner_code' => $partner_code,
			'delivery_place_code' => $delivery_place_code,
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
}
