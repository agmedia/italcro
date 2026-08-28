<?php
class ModelExtensionModuleQiqoOrderOutbox extends Model {
	const PROCESSING_LEASE_SECONDS = 300;

	public function getRows($data = array()) {
		$sql = "SELECT qo.*, o.firstname, o.lastname, o.email, o.total AS order_total,
			CASE
				WHEN qo.status = 'processing'
					AND qo.locked_at IS NOT NULL
					AND qo.locked_at <= DATE_SUB(NOW(), INTERVAL " . self::PROCESSING_LEASE_SECONDS . " SECOND)
				THEN 1 ELSE 0
			END AS processing_recoverable
			FROM `" . DB_PREFIX . "qiqo_order_outbox` qo
			LEFT JOIN `" . DB_PREFIX . "order` o ON (o.order_id = qo.order_id)";

		if (!empty($data['filter_status'])) {
			$sql .= " WHERE qo.status = '" . $this->db->escape($data['filter_status']) . "'";
		}

		$sql .= " ORDER BY qo.outbox_id DESC";
		$start = isset($data['start']) ? max(0, (int)$data['start']) : 0;
		$limit = isset($data['limit']) ? max(1, (int)$data['limit']) : 50;
		$sql .= " LIMIT " . $start . "," . $limit;

		return $this->db->query($sql)->rows;
	}

	public function getTotal($filter_status = '') {
		$sql = "SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "qiqo_order_outbox`";
		if ($filter_status !== '') {
			$sql .= " WHERE status = '" . $this->db->escape($filter_status) . "'";
		}
		$query = $this->db->query($sql);
		return (int)$query->row['total'];
	}

	public function getCounts() {
		$counts = array(
			'pending' => 0,
			'blocked' => 0,
			'failed' => 0,
			'verified_not_sent' => 0,
			'uncertain' => 0,
			'processing' => 0,
			'rebuilding' => 0,
			'cancelled' => 0,
			'sent' => 0
		);
		$query = $this->db->query("SELECT status, COUNT(*) AS total FROM `" . DB_PREFIX . "qiqo_order_outbox` GROUP BY status");
		foreach ($query->rows as $row) {
			$counts[$row['status']] = (int)$row['total'];
		}
		return $counts;
	}

	public function getMissingEligibleOrders($limit = 20) {
		$start_at = $this->getOutboxStartAt();
		if ($start_at === '') {
			return array();
		}

		$limit = max(1, min(100, (int)$limit));
		$sql = "SELECT o.order_id, o.date_added, o.total, o.currency_code,
				o.firstname, o.lastname
			FROM `" . DB_PREFIX . "order` o
			INNER JOIN `" . DB_PREFIX . "customer_qiqo_authorization` cqa
				ON cqa.customer_id = o.customer_id
			INNER JOIN `" . DB_PREFIX . "qiqo_partner` qp
				ON qp.partner_id = cqa.partner_id AND qp.active = '1'
			INNER JOIN `" . DB_PREFIX . "qiqo_delivery_place` qdp
				ON qdp.delivery_place_id = cqa.delivery_place_id
				AND qdp.partner_id = cqa.partner_id
			INNER JOIN `" . DB_PREFIX . "qiqo_sales_rep` qsr
				ON qsr.sales_rep_id = cqa.sales_rep_id AND qsr.active = '1'
			LEFT JOIN `" . DB_PREFIX . "qiqo_order_outbox` qo
				ON qo.order_id = o.order_id
			WHERE qo.outbox_id IS NULL
			  AND o.customer_id > 0
			  AND o.order_status_id IN (" . $this->acceptedStatusSql() . ")
			  AND o.date_added >= '" . $this->db->escape($start_at) . "'
			ORDER BY o.order_id ASC
			LIMIT " . $limit;

		return $this->db->query($sql)->rows;
	}

	public function getMissingEligibleOrderCount() {
		$start_at = $this->getOutboxStartAt();
		if ($start_at === '') {
			return 0;
		}

		$query = $this->db->query("SELECT COUNT(*) AS total
			FROM `" . DB_PREFIX . "order` o
			INNER JOIN `" . DB_PREFIX . "customer_qiqo_authorization` cqa
				ON cqa.customer_id = o.customer_id
			INNER JOIN `" . DB_PREFIX . "qiqo_partner` qp
				ON qp.partner_id = cqa.partner_id AND qp.active = '1'
			INNER JOIN `" . DB_PREFIX . "qiqo_delivery_place` qdp
				ON qdp.delivery_place_id = cqa.delivery_place_id
				AND qdp.partner_id = cqa.partner_id
			INNER JOIN `" . DB_PREFIX . "qiqo_sales_rep` qsr
				ON qsr.sales_rep_id = cqa.sales_rep_id AND qsr.active = '1'
			LEFT JOIN `" . DB_PREFIX . "qiqo_order_outbox` qo
				ON qo.order_id = o.order_id
			WHERE qo.outbox_id IS NULL
			  AND o.customer_id > 0
			  AND o.order_status_id IN (" . $this->acceptedStatusSql() . ")
			  AND o.date_added >= '" . $this->db->escape($start_at) . "'");

		return isset($query->row['total']) ? (int)$query->row['total'] : 0;
	}

	public function getOutboxStartAt() {
		$value = trim((string)$this->config->get('qiqo_order_outbox_start_at'));
		$date = DateTime::createFromFormat('!Y-m-d H:i:s', $value);

		return $date && $date->format('Y-m-d H:i:s') === $value ? $value : '';
	}

	public function getRow($outbox_id) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "qiqo_order_outbox` WHERE outbox_id = '" . (int)$outbox_id . "' LIMIT 1");
		return $query->row;
	}

	public function rebuild($outbox_id) {
		$initial_row = $this->getRow($outbox_id);
		if (!$initial_row) {
			throw new RuntimeException('Outbox zapis ne postoji.');
		}

		require_once DIR_SYSTEM . 'library/qiqo/order_export_lock.php';
		if (!QiqoOrderExportLock::acquire($this->db, $initial_row['order_id'], 5)) {
			throw new RuntimeException('Narudžba se trenutačno mijenja ili izvozi. Obnova payloada nije pokrenuta.');
		}

		try {
		$row = $this->getRow($outbox_id);
		if (!$row) {
			throw new RuntimeException('Outbox zapis više ne postoji.');
		}
		if (!in_array($row['status'], array('pending', 'blocked', 'failed'), true)) {
			throw new RuntimeException('Payload se može obnoviti samo za pending, blocked ili failed zapis. Nepoznat ishod prvo provjerite u ERP-u.');
		}

		$this->db->query("UPDATE `" . DB_PREFIX . "qiqo_order_outbox`
			SET status = 'rebuilding', locked_at = NOW(), date_modified = NOW()
			WHERE outbox_id = '" . (int)$outbox_id . "'
			  AND status IN ('pending', 'blocked', 'failed')");
		if (!$this->db->countAffected()) {
			throw new RuntimeException('Zapis je u međuvremenu promijenjen i nije ga moguće obnoviti.');
		}

		require_once DIR_SYSTEM . 'library/qiqo/order_payload.php';
		try {
			$builder = new QiqoOrderPayload($this->registry);
			$data = $builder->build($row['order_id']);
			if (!in_array((int)$data['order_status_id'], $this->acceptedStatusIds(), true)) {
				throw new RuntimeException('Narudžba nije u statusu dopuštenom za NarudzbaSend.');
			}
			$this->db->query("UPDATE `" . DB_PREFIX . "qiqo_order_outbox`
				SET order_status_id = '" . (int)$data['order_status_id'] . "',
					partner_code = '" . $this->db->escape($data['partner_code']) . "',
					delivery_place_code = '" . $this->db->escape($data['delivery_place_code']) . "',
					sales_rep_code = '" . $this->db->escape($data['sales_rep_code']) . "',
					currency_code = '" . $this->db->escape($data['currency_code']) . "',
					payload_json = '" . $this->db->escape($data['payload_json']) . "',
					payload_hash = '" . $this->db->escape($data['payload_hash']) . "',
					status = 'pending',
					locked_at = NULL,
					last_http_status = 0,
					last_error_code = '',
					last_error_description = '',
					last_response = NULL,
					sent_at = NULL,
					date_modified = NOW()
				WHERE outbox_id = '" . (int)$outbox_id . "'
				  AND status = 'rebuilding'
				  AND EXISTS (
					SELECT 1 FROM `" . DB_PREFIX . "order` o
					WHERE o.order_id = '" . (int)$row['order_id'] . "'
					  AND o.order_status_id IN (" . $this->acceptedStatusSql() . ")
				  )");
			if (!$this->db->countAffected()) {
				$this->db->query("UPDATE `" . DB_PREFIX . "qiqo_order_outbox`
					SET status = 'cancelled', locked_at = NULL,
						last_error_code = 'ORDER_NOT_ACCEPTED',
						last_error_description = 'Narudžba više nije u statusu dopuštenom za slanje.',
						date_modified = NOW()
					WHERE outbox_id = '" . (int)$outbox_id . "' AND status = 'rebuilding'");
				throw new RuntimeException('Narudžba je promijenjena tijekom obnove payloada.');
			}
			return true;
		} catch (Throwable $e) {
			$error = $this->safeError($e->getMessage());
			$state = $this->isOrderAccepted($row['order_id']) ? 'blocked' : 'cancelled';
			$this->db->query("UPDATE `" . DB_PREFIX . "qiqo_order_outbox`
				SET status = '" . $state . "', locked_at = NULL,
					last_error_code = 'PAYLOAD_VALIDATION',
					last_error_description = '" . $this->db->escape($error) . "',
					date_modified = NOW()
				WHERE outbox_id = '" . (int)$outbox_id . "' AND status = 'rebuilding'");
			throw new RuntimeException($error);
		}
		} finally {
			try {
				QiqoOrderExportLock::release($this->db, $initial_row['order_id']);
			} catch (Throwable $e) {
				$this->log->write('QIQO NarudzbaSend: rebuild order lock release failed; connection close will release it.');
			}
		}
	}

	public function send($outbox_id) {
		$config = $this->getConfigurationState();
		if (!$config['enabled']) {
			throw new RuntimeException('ERP slanje je sigurnosno isključeno. Najprije potvrditi testni payload i uključiti qiqo_order_send_enabled.');
		}
		if (!$config['credentials_configured']) {
			throw new RuntimeException('QIQO_ORDER_USERNAME/PASSWORD nisu konfigurirani izvan repozitorija.');
		}
		if (!$config['endpoint_configured']) {
			throw new RuntimeException('NarudzbaSend endpoint nije konfiguriran.');
		}
		if (!$config['transport_approved']) {
			throw new RuntimeException('Obični HTTP prijenos vjerodajnica nije odobren. Potvrdite HTTPS/VPN pa izričito uključite qiqo_order_allow_insecure_http.');
		}

		$initial_row = $this->getRow($outbox_id);
		if (!$initial_row) {
			throw new RuntimeException('Outbox zapis ne postoji.');
		}

		require_once DIR_SYSTEM . 'library/qiqo/order_export_lock.php';
		if (!QiqoOrderExportLock::acquire($this->db, $initial_row['order_id'], 5)) {
			throw new RuntimeException('Narudžba se trenutačno mijenja ili izvozi. Pokušajte ponovno nakon završetka obrade.');
		}

		try {
		$before_claim = $this->getRow($outbox_id);
		if (!$before_claim) {
			throw new RuntimeException('Outbox zapis više ne postoji.');
		}
		if ($before_claim['status'] === 'sent') {
			throw new RuntimeException('Narudžba je već poslana; duplo slanje je blokirano.');
		}
		if ($before_claim['status'] === 'uncertain') {
			throw new RuntimeException('Ishod je nepoznat. Prije ponavljanja obavezno provjeriti postoji li narudžba u Italcro bazi.');
		}
		if ($before_claim['status'] === 'blocked') {
			throw new RuntimeException('Payload je blokiran; prvo ispraviti autorizaciju i kliknuti Obnovi payload.');
		}

		$this->db->query("UPDATE `" . DB_PREFIX . "qiqo_order_outbox`
			SET status = 'processing', locked_at = NOW(), date_modified = NOW()
			WHERE outbox_id = '" . (int)$outbox_id . "'
			  AND status IN ('pending', 'verified_not_sent')
			  AND EXISTS (
				SELECT 1 FROM `" . DB_PREFIX . "order` o
				WHERE o.order_id = `" . DB_PREFIX . "qiqo_order_outbox`.order_id
				  AND o.order_status_id IN (" . $this->acceptedStatusSql() . ")
			  )");
		if (!$this->db->countAffected()) {
			if (!$this->isOrderAccepted($before_claim['order_id'])) {
				$this->db->query("UPDATE `" . DB_PREFIX . "qiqo_order_outbox`
					SET status = 'cancelled', locked_at = NULL,
						last_error_code = 'ORDER_NOT_ACCEPTED',
						last_error_description = 'Narudžba više nije u statusu dopuštenom za slanje.',
						date_modified = NOW()
					WHERE outbox_id = '" . (int)$outbox_id . "'
					  AND status IN ('pending', 'failed', 'verified_not_sent')");
				throw new RuntimeException('Narudžba više nije u statusu dopuštenom za slanje.');
			}
			throw new RuntimeException('Zapis je već zaključan ili nije u stanju dopuštenom za slanje.');
		}

		// Always read the immutable snapshot after the atomic claim. A concurrent
		// rebuild that completed just before the claim must not leave us with stale data.
		$row = $this->getRow($outbox_id);
		$calculated_hash = hash('sha256', (string)$row['payload_json']);
		if (!preg_match('/^[a-f0-9]{64}$/i', (string)$row['payload_hash'])
			|| !hash_equals(strtolower((string)$row['payload_hash']), strtolower($calculated_hash))) {
			$this->markBlocked($outbox_id, 'PAYLOAD_HASH_MISMATCH', 'Spremljeni payload ne odgovara SHA-256 otisku; obnova je obavezna.');
			throw new RuntimeException('Payload integritet nije valjan; slanje je blokirano.');
		}

		$payload = json_decode($row['payload_json'], true);
		if (!is_array($payload)) {
			$this->markBlocked($outbox_id, 'INVALID_PAYLOAD', 'Spremljeni payload nije valjan JSON.');
			throw new RuntimeException('Spremljeni payload nije valjan JSON.');
		}

		require_once DIR_SYSTEM . 'library/qiqo/order_sender.php';
		try {
			$sender = new QiqoOrderSender();
			$result = $sender->send($config['endpoint'], $config['username'], $config['password'], $payload);
		} catch (Throwable $e) {
			$this->db->query("UPDATE `" . DB_PREFIX . "qiqo_order_outbox`
				SET status = 'uncertain', attempts = attempts + 1, locked_at = NULL,
					last_error_code = 'INTERNAL_SEND_EXCEPTION',
					last_error_description = 'Neočekivani prekid tijekom slanja; prije ponavljanja provjeriti ERP.',
					date_modified = NOW()
				WHERE outbox_id = '" . (int)$outbox_id . "' AND status = 'processing'");
			throw new RuntimeException('Slanje je neočekivano prekinuto; ishod je označen kao nepoznat.');
		}

		$sent_at = $result['state'] === 'sent' ? 'NOW()' : 'NULL';
		$this->db->query("UPDATE `" . DB_PREFIX . "qiqo_order_outbox`
			SET status = '" . $this->db->escape($result['state']) . "',
				attempts = attempts + 1,
				locked_at = NULL,
				last_http_status = '" . (int)$result['http_status'] . "',
				last_error_code = '" . $this->db->escape($result['error_code']) . "',
				last_error_description = '" . $this->db->escape($this->safeError($result['description'])) . "',
				last_response = '" . $this->db->escape($result['response']) . "',
				sent_at = " . $sent_at . ",
				date_modified = NOW()
			WHERE outbox_id = '" . (int)$outbox_id . "' AND status = 'processing'");
		if (!$this->db->countAffected()) {
			throw new RuntimeException('Stanje zapisa promijenjeno je tijekom slanja; prije ponavljanja provjerite ERP.');
		}

		return $result;
		} finally {
			try {
				QiqoOrderExportLock::release($this->db, $initial_row['order_id']);
			} catch (Throwable $e) {
				$this->log->write('QIQO NarudzbaSend: order export lock release failed; connection close will release it.');
			}
		}
	}

	public function allowRetry($outbox_id) {
		$this->db->query("UPDATE `" . DB_PREFIX . "qiqo_order_outbox`
			SET status = 'pending', locked_at = NULL, date_modified = NOW()
			WHERE outbox_id = '" . (int)$outbox_id . "' AND status = 'failed'");
		if (!$this->db->countAffected()) {
			throw new RuntimeException('Ponovni pokušaj dopušten je samo za potvrđeno neuspjelo slanje.');
		}
	}

	public function markVerifiedNotSent($outbox_id) {
		$this->db->query("UPDATE `" . DB_PREFIX . "qiqo_order_outbox`
			SET status = 'verified_not_sent', locked_at = NULL,
				last_error_code = 'VERIFIED_NOT_IN_ERP',
				last_error_description = 'Ručno potvrđeno da narudžba ne postoji u Italcro bazi.',
				date_modified = NOW()
			WHERE outbox_id = '" . (int)$outbox_id . "' AND status = 'uncertain'");
		if (!$this->db->countAffected()) {
			throw new RuntimeException('Potvrda neuspjelog slanja dopuštena je samo za zapis s nepoznatim ishodom.');
		}
	}

	public function markProcessingUncertain($outbox_id) {
		$row = $this->getRow($outbox_id);
		if (!$row || $row['status'] !== 'processing') {
			throw new RuntimeException('Samo processing zapis može biti označen nepoznatim.');
		}

		require_once DIR_SYSTEM . 'library/qiqo/order_export_lock.php';
		if (!QiqoOrderExportLock::acquire($this->db, $row['order_id'], 0)) {
			throw new RuntimeException('Aktivna ERP obrada još drži zaključavanje i ne može se ručno prekinuti.');
		}

		try {
			$this->db->query("UPDATE `" . DB_PREFIX . "qiqo_order_outbox`
				SET status = 'uncertain', locked_at = NULL,
					last_error_code = 'PROCESS_INTERRUPTED',
					last_error_description = 'Obrada je ručno označena prekinutom; prije ponavljanja provjeriti ERP.',
					date_modified = NOW()
				WHERE outbox_id = '" . (int)$outbox_id . "'
				  AND status = 'processing'
				  AND locked_at IS NOT NULL
				  AND locked_at <= DATE_SUB(NOW(), INTERVAL " . self::PROCESSING_LEASE_SECONDS . " SECOND)");
			if (!$this->db->countAffected()) {
				throw new RuntimeException('Aktivna obrada ne može se prekinuti. Pričekajte najmanje pet minuta od zaključavanja zapisa.');
			}
		} finally {
			try {
				QiqoOrderExportLock::release($this->db, $row['order_id']);
			} catch (Throwable $e) {
				$this->log->write('QIQO NarudzbaSend: stale processing lock release failed; connection close will release it.');
			}
		}
	}

	public function markVerifiedSent($outbox_id) {
		$this->db->query("UPDATE `" . DB_PREFIX . "qiqo_order_outbox`
			SET status = 'sent', locked_at = NULL, sent_at = NOW(),
				last_error_code = 'VERIFIED_IN_ERP',
				last_error_description = 'Ručno potvrđeno postojanje narudžbe u Italcro bazi.',
				date_modified = NOW()
			WHERE outbox_id = '" . (int)$outbox_id . "' AND status = 'uncertain'");
		if (!$this->db->countAffected()) {
			throw new RuntimeException('Ručna potvrda dopuštena je samo za zapis s nepoznatim ishodom.');
		}
	}

	public function getConfigurationState() {
		$username = $this->secret('QIQO_ORDER_USERNAME');
		$password = $this->secret('QIQO_ORDER_PASSWORD');
		$endpoint = $this->secret('QIQO_ORDER_ENDPOINT');
		if ($endpoint === '') {
			$endpoint = trim((string)$this->config->get('qiqo_order_endpoint'));
		}

		$scheme = strtolower((string)parse_url($endpoint, PHP_URL_SCHEME));
		$secure_transport = $scheme === 'https';
		$allow_insecure_http = $this->strictEnabledFlag($this->config->get('qiqo_order_allow_insecure_http'));

		return array(
			'enabled' => $this->strictEnabledFlag($this->config->get('qiqo_order_send_enabled')),
			'credentials_configured' => $username !== '' && $password !== '',
			'endpoint_configured' => $endpoint !== '',
			'secure_transport' => $secure_transport,
			'transport_approved' => $secure_transport || ($scheme === 'http' && $allow_insecure_http),
			'endpoint' => $endpoint,
			'username' => $username,
			'password' => $password
		);
	}

	private function secret($name) {
		if (defined($name) && trim((string)constant($name)) !== '') {
			return trim((string)constant($name));
		}
		$value = getenv($name);
		return $value === false ? '' : trim((string)$value);
	}

	private function markBlocked($outbox_id, $code, $description) {
		$this->db->query("UPDATE `" . DB_PREFIX . "qiqo_order_outbox`
			SET status = 'blocked', locked_at = NULL,
				last_error_code = '" . $this->db->escape($code) . "',
				last_error_description = '" . $this->db->escape($this->safeError($description)) . "',
				date_modified = NOW()
			WHERE outbox_id = '" . (int)$outbox_id . "' AND status = 'processing'");
	}

	private function acceptedStatusIds() {
		$value = $this->config->get('qiqo_order_accepted_status_ids');
		$values = is_array($value)
			? $value
			: preg_split('/\s*,\s*/', trim((string)$value), -1, PREG_SPLIT_NO_EMPTY);
		$ids = array();
		foreach ((array)$values as $candidate) {
			$candidate = trim((string)$candidate);
			if (preg_match('/^[1-9][0-9]*$/D', $candidate)) {
				$id = (int)$candidate;
				if ($id > 0) {
					$ids[$id] = $id;
				}
			}
		}

		return $ids ? array_values($ids) : array(1);
	}

	private function acceptedStatusSql() {
		return implode(',', $this->acceptedStatusIds());
	}

	private function isOrderAccepted($order_id) {
		$query = $this->db->query("SELECT order_status_id FROM `" . DB_PREFIX . "order`
			WHERE order_id = '" . (int)$order_id . "' LIMIT 1");
		return $query->num_rows
			&& in_array((int)$query->row['order_status_id'], $this->acceptedStatusIds(), true);
	}

	private function strictEnabledFlag($value) {
		return $value === true || $value === 1 || (is_string($value) && trim($value) === '1');
	}

	private function safeError($message) {
		$message = preg_replace('/[\x00-\x1F\x7F]/', ' ', (string)$message);
		return function_exists('mb_substr') ? mb_substr($message, 0, 1000, 'UTF-8') : substr($message, 0, 1000);
	}
}
