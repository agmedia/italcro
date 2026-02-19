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

	public function getQiqoPartnerById($partner_id) {
		$this->ensureQiqoAuthorizationTables();

		$query = $this->db->query("SELECT *
			FROM `" . DB_PREFIX . "qiqo_partner`
			WHERE partner_id = '" . (int)$partner_id . "'
			LIMIT 1");

		return $query->row;
	}

	public function getQiqoDeliveryPlacesByPartnerId($partner_id) {
		$this->ensureQiqoAuthorizationTables();

		$query = $this->db->query("SELECT *
			FROM `" . DB_PREFIX . "qiqo_delivery_place`
			WHERE partner_id = '" . (int)$partner_id . "'
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

	public function saveCustomerQiqoAuthorization($customer_id, $data, $approved_by_user_id) {
		$this->ensureQiqoAuthorizationTables();

		$partner_id = (int)$data['partner_id'];
		$delivery_place_id = (int)$data['delivery_place_id'];
		$sales_rep_id = isset($data['sales_rep_id']) && $data['sales_rep_id'] !== '' ? (int)$data['sales_rep_id'] : 0;
		$partner_discount = (float)$data['partner_discount'];

		$this->db->query("INSERT INTO `" . DB_PREFIX . "customer_qiqo_authorization`
			SET customer_id = '" . (int)$customer_id . "',
				partner_id = '" . $partner_id . "',
				delivery_place_id = '" . $delivery_place_id . "',
				sales_rep_id = " . ($sales_rep_id ? "'" . $sales_rep_id . "'" : "NULL") . ",
				partner_discount = '" . $partner_discount . "',
				approved_by_user_id = '" . (int)$approved_by_user_id . "',
				approved_at = NOW(),
				date_modified = NOW()
			ON DUPLICATE KEY UPDATE
				partner_id = VALUES(partner_id),
				delivery_place_id = VALUES(delivery_place_id),
				sales_rep_id = VALUES(sales_rep_id),
				partner_discount = VALUES(partner_discount),
				approved_by_user_id = VALUES(approved_by_user_id),
				approved_at = NOW(),
				date_modified = NOW()");
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
	}
}	
