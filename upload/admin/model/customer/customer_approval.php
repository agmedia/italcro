<?php
class ModelCustomerCustomerApproval extends Model {
	public function getCustomerApprovals($data = array()) {
		$sql = "SELECT *, CONCAT(c.`firstname`, ' ', c.`lastname`) AS name, cgd.`name` AS customer_group, ca.`type` FROM `" . DB_PREFIX . "customer_approval` ca LEFT JOIN `" . DB_PREFIX . "customer` c ON (ca.`customer_id` = c.`customer_id`) LEFT JOIN `" . DB_PREFIX . "customer_group_description` cgd ON (c.`customer_group_id` = cgd.`customer_group_id`) WHERE cgd.`language_id` = '" . (int)$this->config->get('config_language_id') . "'";

		if (!empty($data['filter_name'])) {
			$sql .= " AND CONCAT(c.`firstname`, ' ', c.`lastname`) LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
		}

		if (!empty($data['filter_email'])) {
			$sql .= " AND c.`email` LIKE '" . $this->db->escape($data['filter_email']) . "%'";
		}
		
		if (!empty($data['filter_customer_group_id'])) {
			$sql .= " AND c.`customer_group_id` = '" . (int)$data['filter_customer_group_id'] . "'";
		}
		
		if (!empty($data['filter_type'])) {
			$sql .= " AND ca.`type` = '" . $this->db->escape($data['filter_type']) . "'";
		}
		
		if (!empty($data['filter_date_added'])) {
			$sql .= " AND DATE(c.`date_added`) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
		}

		$sql .= " ORDER BY c.`date_added` DESC";

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$query = $this->db->query($sql);

		return $query->rows;
	}
	
	public function getCustomerApproval($customer_approval_id) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "customer_approval` WHERE `customer_approval_id` = '" . (int)$customer_approval_id . "'");
		
		return $query->row;
	}
	
	public function getTotalCustomerApprovals($data = array()) {
		$sql = "SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "customer_approval` ca LEFT JOIN `" . DB_PREFIX . "customer` c ON (ca.`customer_id` = c.`customer_id`)";

		$implode = array();

		if (!empty($data['filter_name'])) {
			$implode[] = "CONCAT(c.`firstname`, ' ', c.`lastname`) LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
		}

		if (!empty($data['filter_email'])) {
			$implode[] = "c.`email` LIKE '" . $this->db->escape($data['filter_email']) . "%'";
		}

		if (!empty($data['filter_customer_group_id'])) {
			$implode[] = "c.`customer_group_id` = '" . (int)$data['filter_customer_group_id'] . "'";
		}
		
		if (!empty($data['filter_type'])) {
			$implode[] = "ca.`type` = '" . $this->db->escape($data['filter_type']) . "'";
		}
		
		if (!empty($data['filter_date_added'])) {
			$implode[] = "DATE(ca.`date_added`) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
		}

		if ($implode) {
			$sql .= " WHERE " . implode(" AND ", $implode);
		}

		$query = $this->db->query($sql);

		return $query->row['total'];
	}
	
	public function approveCustomer($customer_id) {
		$this->db->query("UPDATE `" . DB_PREFIX . "customer` SET status = '1' WHERE customer_id = '" . (int)$customer_id . "'");
		$this->db->query("DELETE FROM `" . DB_PREFIX . "customer_approval` WHERE customer_id = '" . (int)$customer_id . "' AND `type` = 'customer'");
	}

	public function denyCustomer($customer_id) {
		$this->db->query("DELETE FROM `" . DB_PREFIX . "customer_approval` WHERE customer_id = '" . (int)$customer_id . "' AND `type` = 'customer'");
	}

	public function approveAffiliate($customer_id) {
		$this->db->query("UPDATE `" . DB_PREFIX . "customer_affiliate` SET status = '1' WHERE customer_id = '" . (int)$customer_id . "'");
		$this->db->query("DELETE FROM `" . DB_PREFIX . "customer_approval` WHERE customer_id = '" . (int)$customer_id . "' AND `type` = 'affiliate'");
	}
	
	public function denyAffiliate($customer_id) {
		$this->db->query("DELETE FROM `" . DB_PREFIX . "customer_approval` WHERE customer_id = '" . (int)$customer_id . "' AND `type` = 'affiliate'");
	}

	public function getQiqoPartnerById($partner_id, $ensure_tables = true, $lock_row = false) {
		if ($ensure_tables) {
			$this->ensureQiqoAuthorizationTables();
		}

		$query = $this->db->query("SELECT *
			FROM `" . DB_PREFIX . "qiqo_partner`
			WHERE partner_id = '" . (int)$partner_id . "'
			  AND active = '1'
			LIMIT 1" . ($lock_row ? " FOR UPDATE" : ""));

		return $query->row;
	}

	public function getQiqoDeliveryPlacesByPartnerId($partner_id) {
		$this->ensureQiqoAuthorizationTables();

		$query = $this->db->query("SELECT *
			FROM `" . DB_PREFIX . "qiqo_delivery_place`
			WHERE partner_id = '" . (int)$partner_id . "'
			  AND (TRIM(address) <> '' OR TRIM(name) <> '')
			  AND TRIM(place) <> ''
			ORDER BY name ASC");

		return $query->rows;
	}

	public function getQiqoSalesReps() {
		$this->ensureQiqoAuthorizationTables();

		$query = $this->db->query("SELECT *
			FROM `" . DB_PREFIX . "qiqo_sales_rep`
			WHERE active = '1'
			ORDER BY name ASC");

		return $query->rows;
	}

	public function getQiqoDeliveryPlaceById($delivery_place_id, $ensure_tables = true, $lock_row = false) {
		if ($ensure_tables) {
			$this->ensureQiqoAuthorizationTables();
		}

		$query = $this->db->query("SELECT *
			FROM `" . DB_PREFIX . "qiqo_delivery_place`
			WHERE delivery_place_id = '" . (int)$delivery_place_id . "'
			LIMIT 1" . ($lock_row ? " FOR UPDATE" : ""));

		return $query->row;
	}

	public function getQiqoSalesRepById($sales_rep_id, $ensure_tables = true, $lock_row = false) {
		if ($ensure_tables) {
			$this->ensureQiqoAuthorizationTables();
		}

		$query = $this->db->query("SELECT *
			FROM `" . DB_PREFIX . "qiqo_sales_rep`
			WHERE sales_rep_id = '" . (int)$sales_rep_id . "'
			  AND active = '1'
			LIMIT 1" . ($lock_row ? " FOR UPDATE" : ""));

		return $query->row;
	}

	public function validateQiqoAuthorizationSelection($partner_id, $delivery_place_id, $sales_rep_id, $ensure_tables = true, $lock_rows = false) {
		if ($ensure_tables) {
			$this->ensureQiqoAuthorizationTables();
		}

		$partner_id = (int)$partner_id;
		$delivery_place_id = (int)$delivery_place_id;
		$sales_rep_id = (int)$sales_rep_id;

		$result = array(
			'valid' => false,
			'error' => '',
			'partner' => array(),
			'delivery_place' => array(),
			'sales_rep' => array()
		);

		if (!$partner_id) {
			$result['error'] = 'Partner je obavezan.';

			return $result;
		}

		if (!$delivery_place_id) {
			$result['error'] = 'Mjesto isporuke je obavezno.';

			return $result;
		}

		if (!$sales_rep_id) {
			$result['error'] = 'Aktivni komercijalist iz qKomercijalistWeb je obavezan.';

			return $result;
		}

		$partner = $this->getQiqoPartnerById($partner_id, false, $lock_rows);

		if (!$partner) {
			$result['error'] = 'Partner ne postoji ili nije aktivan u lokalnom QIQO cacheu. Pokrenite partner sync.';

			return $result;
		}

		$delivery_place = $this->getQiqoDeliveryPlaceById($delivery_place_id, false, $lock_rows);

		if (!$delivery_place || (int)$delivery_place['partner_id'] !== $partner_id) {
			$result['error'] = 'Odabrano mjesto isporuke ne pripada aktivnom partneru.';

			return $result;
		}

		$delivery_address = !empty($delivery_place['address']) ? $delivery_place['address'] : $delivery_place['name'];

		if (trim((string)$delivery_address) === '' || trim((string)$delivery_place['place']) === '') {
			$result['error'] = 'Odabrano mjesto isporuke nema potpunu adresu i mjesto u QIQO cacheu.';

			return $result;
		}

		$sales_rep = $this->getQiqoSalesRepById($sales_rep_id, false, $lock_rows);

		if (!$sales_rep) {
			$result['error'] = 'Odabrani komercijalist ne postoji ili nije aktivan u qKomercijalistWeb cacheu. Pokrenite sync komercijalista.';

			return $result;
		}

		$result['valid'] = true;
		$result['partner'] = $partner;
		$result['delivery_place'] = $delivery_place;
		$result['sales_rep'] = $sales_rep;

		return $result;
	}

	public function applyCustomerQiqoAuthorization($customer_id, $data, $approved_by_user_id) {
		$this->ensureQiqoAuthorizationTables();
		$customer_id = (int)$customer_id;
		$lock_name = 'qiqo_auth_' . sha1(DB_DATABASE . ':' . DB_PREFIX . $customer_id);

		if (!$this->acquireQiqoAuthorizationLock($lock_name)) {
			return array(
				'success' => false,
				'changed' => false,
				'error' => 'Autorizaciju kupca trenutačno mijenja drugi proces. Pokušajte ponovno.'
			);
		}

		$transaction_started = false;

		try {
			$this->db->query("START TRANSACTION");
			$transaction_started = true;
			$result = $this->applyCustomerQiqoAuthorizationLocked($customer_id, $data, $approved_by_user_id);

			if ($result['success']) {
				$this->db->query("COMMIT");
			} else {
				$this->db->query("ROLLBACK");
			}

			$transaction_started = false;

			return $result;
		} catch (\Exception $e) {
			if ($transaction_started) {
				$this->db->query("ROLLBACK");
			}

			throw $e;
		} finally {
			$this->releaseQiqoAuthorizationLock($lock_name);
		}
	}

	public function approvePendingCustomerWithQiqoAuthorization($customer_id, $data, $approved_by_user_id) {
		$this->ensureQiqoAuthorizationTables();
		$customer_id = (int)$customer_id;
		$lock_name = 'qiqo_auth_' . sha1(DB_DATABASE . ':' . DB_PREFIX . $customer_id);

		if (!$this->acquireQiqoAuthorizationLock($lock_name)) {
			return array(
				'success' => false,
				'changed' => false,
				'error' => 'Autorizaciju kupca trenutačno mijenja drugi proces. Pokušajte ponovno.'
			);
		}

		$transaction_started = false;

		try {
			$this->db->query("START TRANSACTION");
			$transaction_started = true;

			if (!$customer_id || !$this->hasPendingCustomerApproval($customer_id, true)) {
				$this->db->query("ROLLBACK");
				$transaction_started = false;

				return array(
					'success' => false,
					'changed' => false,
					'error' => 'Za kupca ne postoji aktivan zahtjev za odobrenje.'
				);
			}

			$result = $this->applyCustomerQiqoAuthorizationLocked($customer_id, $data, $approved_by_user_id);

			if ($result['success']) {
				$this->approveCustomer($customer_id);
				$this->db->query("COMMIT");
			} else {
				$this->db->query("ROLLBACK");
			}

			$transaction_started = false;

			return $result;
		} catch (\Exception $e) {
			if ($transaction_started) {
				$this->db->query("ROLLBACK");
			}

			throw $e;
		} finally {
			$this->releaseQiqoAuthorizationLock($lock_name);
		}
	}

	private function applyCustomerQiqoAuthorizationLocked($customer_id, $data, $approved_by_user_id) {
		$customer_query = $this->db->query("SELECT customer_id
			FROM `" . DB_PREFIX . "customer`
			WHERE customer_id = '" . (int)$customer_id . "'
			LIMIT 1 FOR UPDATE");

		if (!$customer_query->num_rows) {
			return array(
				'success' => false,
				'changed' => false,
				'error' => 'Kupac ne postoji.'
			);
		}

		$selection = $this->validateQiqoAuthorizationSelection(
			isset($data['partner_id']) ? $data['partner_id'] : 0,
			isset($data['delivery_place_id']) ? $data['delivery_place_id'] : 0,
			isset($data['sales_rep_id']) ? $data['sales_rep_id'] : 0,
			false,
			true
		);

		if (!$selection['valid']) {
			return array(
				'success' => false,
				'changed' => false,
				'error' => $selection['error']
			);
		}

		$authorization_data = array(
			'partner_id' => (int)$selection['partner']['partner_id'],
			'delivery_place_id' => (int)$selection['delivery_place']['delivery_place_id'],
			'sales_rep_id' => (int)$selection['sales_rep']['sales_rep_id'],
			'partner_discount' => (float)$selection['partner']['base_discount']
		);
		$current = $this->getCustomerQiqoAuthorization($customer_id, false, true);

		if (!$this->isQiqoAuthorizationChanged($current, $authorization_data)) {
			return array(
				'success' => true,
				'changed' => false,
				'error' => ''
			);
		}

		$requires_address_sync = !$current
			|| (int)$current['partner_id'] !== $authorization_data['partner_id']
			|| (int)$current['delivery_place_id'] !== $authorization_data['delivery_place_id'];

		if ($requires_address_sync && !$this->syncCustomerAddressFromDeliveryPlace(
			$customer_id,
			$authorization_data['delivery_place_id'],
			$selection['partner']['name'],
			false
		)) {
			return array(
				'success' => false,
				'changed' => false,
				'error' => 'Mjesto isporuke nije moguće spremiti na adresu kupca.'
			);
		}

		$authorization_changed = $this->saveCustomerQiqoAuthorization($customer_id, $authorization_data, $approved_by_user_id, false);

		return array(
			'success' => true,
			'changed' => (bool)$authorization_changed,
			'error' => ''
		);
	}

	public function saveCustomerQiqoAuthorization($customer_id, $data, $approved_by_user_id, $ensure_tables = true) {
		if ($ensure_tables) {
			$this->ensureQiqoAuthorizationTables();
		}

		$partner_id = (int)$data['partner_id'];
		$delivery_place_id = (int)$data['delivery_place_id'];
		$sales_rep_id = isset($data['sales_rep_id']) && $data['sales_rep_id'] !== '' ? (int)$data['sales_rep_id'] : 0;
		$partner_discount = (float)$data['partner_discount'];
		$sales_rep_sql = $sales_rep_id ? "'" . $sales_rep_id . "'" : 'NULL';
		$changed_sql = "partner_id <> VALUES(partner_id)
			OR delivery_place_id <> VALUES(delivery_place_id)
			OR NOT (sales_rep_id <=> VALUES(sales_rep_id))
			OR partner_discount <> VALUES(partner_discount)";

		$this->db->query("INSERT INTO `" . DB_PREFIX . "customer_qiqo_authorization`
			SET customer_id = '" . (int)$customer_id . "',
				partner_id = '" . $partner_id . "',
				delivery_place_id = '" . $delivery_place_id . "',
				sales_rep_id = " . $sales_rep_sql . ",
				partner_discount = '" . $partner_discount . "',
				approved_by_user_id = '" . (int)$approved_by_user_id . "',
				approved_at = NOW(),
				date_modified = NOW()
			ON DUPLICATE KEY UPDATE
				approved_by_user_id = IF(" . $changed_sql . ", VALUES(approved_by_user_id), approved_by_user_id),
				approved_at = IF(" . $changed_sql . ", NOW(), approved_at),
				date_modified = IF(" . $changed_sql . ", NOW(), date_modified),
				partner_id = VALUES(partner_id),
				delivery_place_id = VALUES(delivery_place_id),
				sales_rep_id = VALUES(sales_rep_id),
				partner_discount = VALUES(partner_discount)");

		return (bool)$this->db->countAffected();
	}

	public function deleteCustomerQiqoAuthorization($customer_id) {
		$this->ensureQiqoAuthorizationTables();
		$customer_id = (int)$customer_id;
		$lock_name = 'qiqo_auth_' . sha1(DB_DATABASE . ':' . DB_PREFIX . $customer_id);

		if (!$this->acquireQiqoAuthorizationLock($lock_name)) {
			return null;
		}

		try {
			$this->db->query("START TRANSACTION");
			$this->db->query("DELETE FROM `" . DB_PREFIX . "customer_qiqo_authorization`
				WHERE customer_id = '" . $customer_id . "'");
			$changed = (bool)$this->db->countAffected();
			$this->db->query("COMMIT");

			return $changed;
		} catch (\Exception $e) {
			$this->db->query("ROLLBACK");

			throw $e;
		} finally {
			$this->releaseQiqoAuthorizationLock($lock_name);
		}
	}

	public function hasPendingCustomerApproval($customer_id, $lock_row = false) {
		$query = $this->db->query("SELECT customer_approval_id
			FROM `" . DB_PREFIX . "customer_approval`
			WHERE customer_id = '" . (int)$customer_id . "'
			  AND `type` = 'customer'
			LIMIT 1" . ($lock_row ? " FOR UPDATE" : ""));

		return (bool)$query->num_rows;
	}

	public function syncCustomerAddressFromDeliveryPlace($customer_id, $delivery_place_id, $partner_name = '', $ensure_tables = true) {
		if ($ensure_tables) {
			$this->ensureQiqoAuthorizationTables();
		}

		$customer_query = $this->db->query("SELECT firstname, lastname, address_id
			FROM `" . DB_PREFIX . "customer`
			WHERE customer_id = '" . (int)$customer_id . "'
			LIMIT 1");

		if (!$customer_query->num_rows) {
			return false;
		}

		$place_query = $this->db->query("SELECT *
			FROM `" . DB_PREFIX . "qiqo_delivery_place`
			WHERE delivery_place_id = '" . (int)$delivery_place_id . "'
			LIMIT 1");

		if (!$place_query->num_rows) {
			return false;
		}

		$customer = $customer_query->row;
		$place = $place_query->row;

		$company = trim((string)$partner_name);
		if ($company === '' && !empty($place['name'])) {
			$company = trim((string)$place['name']);
		}

		$address_1 = !empty($place['address']) ? trim((string)$place['address']) : trim((string)$place['name']);
		$parsed_city = $this->parseCityAndPostcode((string)$place['place']);
		$postcode_update_sql = '';

		if ($parsed_city['postcode'] !== '') {
			$postcode_update_sql = ", postcode = '" . $this->db->escape($parsed_city['postcode']) . "'";
		}

		$country_id = $this->getCroatiaCountryId();
		$zone_id = (int)$this->config->get('config_zone_id');

		$default_address_id = !empty($customer['address_id']) ? (int)$customer['address_id'] : 0;
		$address_id = 0;

		if ($default_address_id > 0) {
			$default_address_query = $this->db->query("SELECT address_id
				FROM `" . DB_PREFIX . "address`
				WHERE address_id = '" . $default_address_id . "'
				  AND customer_id = '" . (int)$customer_id . "'
				LIMIT 1");

			if ($default_address_query->num_rows) {
				$address_id = $default_address_id;
			}
		}

		if (!$address_id) {
			$sql = "SELECT address_id
				FROM `" . DB_PREFIX . "address`
				WHERE customer_id = '" . (int)$customer_id . "'
				  AND firstname = '" . $this->db->escape($customer['firstname']) . "'
				  AND lastname = '" . $this->db->escape($customer['lastname']) . "'
				  AND company = '" . $this->db->escape($company) . "'
				  AND address_1 = '" . $this->db->escape($address_1) . "'
				  AND city = '" . $this->db->escape($parsed_city['city']) . "'
				LIMIT 1";

			$existing_query = $this->db->query($sql);

			if ($existing_query->num_rows) {
				$address_id = (int)$existing_query->row['address_id'];
			}
		}

		if (!$address_id) {
			$this->db->query("INSERT INTO `" . DB_PREFIX . "address`
				SET customer_id = '" . (int)$customer_id . "',
					firstname = '" . $this->db->escape($customer['firstname']) . "',
					lastname = '" . $this->db->escape($customer['lastname']) . "',
					company = '" . $this->db->escape($company) . "',
					address_1 = '" . $this->db->escape($address_1) . "',
					address_2 = '',
					city = '" . $this->db->escape($parsed_city['city']) . "',
					postcode = '" . $this->db->escape($parsed_city['postcode']) . "',
					country_id = '" . (int)$country_id . "',
					zone_id = '" . (int)$zone_id . "',
					custom_field = '[]'");
			$address_id = (int)$this->db->getLastId();
		} else {
			$this->db->query("UPDATE `" . DB_PREFIX . "address`
				SET address_1 = '" . $this->db->escape($address_1) . "',
					city = '" . $this->db->escape($parsed_city['city']) . "'" . $postcode_update_sql . "
				WHERE address_id = '" . (int)$address_id . "'
				  AND customer_id = '" . (int)$customer_id . "'");
		}

		if ($address_id) {
			$this->db->query("UPDATE `" . DB_PREFIX . "customer`
				SET address_id = '" . $address_id . "'
				WHERE customer_id = '" . (int)$customer_id . "'");
		}

		return (bool)$address_id;
	}

	public function getCustomerQiqoAuthorization($customer_id, $ensure_tables = true, $lock_row = false) {
		if ($ensure_tables) {
			$this->ensureQiqoAuthorizationTables();
		}

		$query = $this->db->query("SELECT cqa.*, 
				qp.name AS partner_name,
				qp.oib AS partner_oib,
				qp.base_discount AS partner_base_discount,
				qdp.code AS delivery_place_code,
				qdp.name AS delivery_place_name,
				qdp.address AS delivery_place_address,
				qdp.place AS delivery_place_city,
				qsr.code AS sales_rep_code,
				qsr.name AS sales_rep_name,
				CONCAT(u.firstname, ' ', u.lastname) AS approved_by_name
			FROM `" . DB_PREFIX . "customer_qiqo_authorization` cqa
			LEFT JOIN `" . DB_PREFIX . "qiqo_partner` qp ON (cqa.partner_id = qp.partner_id)
			LEFT JOIN `" . DB_PREFIX . "qiqo_delivery_place` qdp ON (cqa.delivery_place_id = qdp.delivery_place_id)
			LEFT JOIN `" . DB_PREFIX . "qiqo_sales_rep` qsr ON (cqa.sales_rep_id = qsr.sales_rep_id)
			LEFT JOIN `" . DB_PREFIX . "user` u ON (cqa.approved_by_user_id = u.user_id)
			WHERE cqa.customer_id = '" . (int)$customer_id . "'
			LIMIT 1" . ($lock_row ? " FOR UPDATE" : ""));

		return $query->row;
	}

	private function isQiqoAuthorizationChanged($current, $data) {
		if (!$current) {
			return true;
		}

		return (int)$current['partner_id'] !== (int)$data['partner_id']
			|| (int)$current['delivery_place_id'] !== (int)$data['delivery_place_id']
			|| (int)$current['sales_rep_id'] !== (int)$data['sales_rep_id']
			|| abs((float)$current['partner_discount'] - (float)$data['partner_discount']) >= 0.00005;
	}

	private function acquireQiqoAuthorizationLock($lock_name) {
		$query = $this->db->query("SELECT GET_LOCK('" . $this->db->escape($lock_name) . "', 5) AS lock_acquired");

		return isset($query->row['lock_acquired']) && (int)$query->row['lock_acquired'] === 1;
	}

	private function releaseQiqoAuthorizationLock($lock_name) {
		$this->db->query("SELECT RELEASE_LOCK('" . $this->db->escape($lock_name) . "')");
	}

	private function ensureQiqoAuthorizationTables() {
		$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "qiqo_sales_rep` (
			`sales_rep_id` INT(11) NOT NULL AUTO_INCREMENT,
			`code` VARCHAR(64) NOT NULL,
			`name` VARCHAR(255) NOT NULL,
			`active` TINYINT(1) NOT NULL DEFAULT 1,
			`date_added` DATETIME NOT NULL,
			`date_modified` DATETIME NOT NULL,
			PRIMARY KEY (`sales_rep_id`),
			UNIQUE KEY `uq_code` (`code`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

		$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "customer_qiqo_authorization` (
			`customer_id` INT(11) NOT NULL,
			`partner_id` INT(11) NOT NULL,
			`delivery_place_id` INT(11) NOT NULL,
			`sales_rep_id` INT(11) NULL,
			`partner_discount` DECIMAL(10,4) NOT NULL DEFAULT 0,
			`approved_by_user_id` INT(11) NOT NULL,
			`approved_at` DATETIME NOT NULL,
			`date_modified` DATETIME NOT NULL,
			PRIMARY KEY (`customer_id`),
			KEY `idx_partner` (`partner_id`),
			KEY `idx_delivery_place` (`delivery_place_id`),
			KEY `idx_sales_rep` (`sales_rep_id`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

		$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "qiqo_postcode_lookup` (
			`city_key` VARCHAR(191) NOT NULL,
			`city_name` VARCHAR(191) NOT NULL,
			`postcode` VARCHAR(16) NOT NULL,
			`source` VARCHAR(64) NOT NULL DEFAULT 'manual',
			`date_modified` DATETIME NOT NULL,
			PRIMARY KEY (`city_key`),
			KEY `idx_postcode` (`postcode`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
	}

	private function parseCityAndPostcode($raw_place) {
		$raw_place = trim($raw_place);

		$postcode = '';
		$city = $raw_place;

		if ($raw_place !== '') {
			$parts = explode(',', $raw_place, 2);
			$left = trim($parts[0]);

			if (preg_match('/^([0-9]{4,6})\s+(.+)$/u', $left, $m)) {
				$postcode = trim($m[1]);
				$city = trim($m[2]);
			} else {
				$city = $left;
			}
		}

		// 1) Lookup iz tablice popunjene iz mjestaRh.xlsx
		if ($postcode === '' && $city !== '') {
			$postcode = $this->getPostcodeFromLookupByCity($city);
		}

		// 2) Fallback mapa u kodu (zadnja rezerva)
		if ($postcode === '' && $city !== '') {
			$postcode = $this->guessCroatianPostcodeByCity($city);
		}

		return array(
			'postcode' => $postcode,
			'city' => $city
		);
	}

	private function guessCroatianPostcodeByCity($city) {
		$key = $this->normalizeCityKey($city);

		$map = array(
			'ZAGREB' => '10000',
			'RIJEKA' => '51000',
			'SPLIT' => '21000',
			'OSIJEK' => '31000',
			'ZADAR' => '23000',
			'VARAZDIN' => '42000',
			'ČAKOVEC' => '40000',
			'CAKOVEC' => '40000',
			'PULA' => '52100',
			'SLAVONSKI BROD' => '35000',
			'VELIKA GORICA' => '10410',
			'SISAK' => '44000',
			'KARLOVAC' => '47000',
			'DUBROVNIK' => '20000',
			'ŠIBENIK' => '22000',
			'SIBENIK' => '22000',
			'KOPRIVNICA' => '48000',
			'BJELOVAR' => '43000',
			'POZEGA' => '34000',
			'POŽEGA' => '34000',
			'VINKOVCI' => '32100',
			'VUKOVAR' => '32000'
		);

		if (isset($map[$key])) {
			return $map[$key];
		}

		return '';
	}

	private function getPostcodeFromLookupByCity($city) {
		$key = $this->normalizeCityKey($city);

		if ($key === '') {
			return '';
		}

		$query = $this->db->query("SELECT postcode
			FROM `" . DB_PREFIX . "qiqo_postcode_lookup`
			WHERE city_key = '" . $this->db->escape($key) . "'
			LIMIT 1");

		if ($query->num_rows && !empty($query->row['postcode'])) {
			return trim((string)$query->row['postcode']);
		}

		return '';
	}

	private function normalizeCityKey($city) {
		$key = trim((string)$city);
		$key = preg_replace('/\([^)]*\)/u', ' ', $key);
		$key = strtr($key, array(
			'Č' => 'C', 'Ć' => 'C', 'Đ' => 'D', 'Š' => 'S', 'Ž' => 'Z',
			'č' => 'C', 'ć' => 'C', 'đ' => 'D', 'š' => 'S', 'ž' => 'Z'
		));
		$key = utf8_strtoupper($key);
		$key = preg_replace('/[^A-Z0-9 ]+/u', ' ', $key);
		$key = preg_replace('/\s+/u', ' ', $key);

		return trim($key);
	}

	private function getCroatiaCountryId() {
		$query = $this->db->query("SELECT country_id
			FROM `" . DB_PREFIX . "country`
			WHERE (iso_code_2 = 'HR' OR iso_code_3 = 'HRV' OR LCASE(name) LIKE '%croatia%')
			LIMIT 1");

		if ($query->num_rows) {
			return (int)$query->row['country_id'];
		}

		return (int)$this->config->get('config_country_id');
	}
}	
