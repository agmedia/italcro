<?php
class ModelCustomerQiqoSalesRep extends Model {
	private function ensureTable() {
		$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "qiqo_sales_rep` (
			`sales_rep_id` INT(11) NOT NULL AUTO_INCREMENT,
			`code` VARCHAR(64) NOT NULL,
			`name` VARCHAR(255) NOT NULL,
			`active` TINYINT(1) NOT NULL DEFAULT 1,
			`date_added` DATETIME NOT NULL,
			`date_modified` DATETIME NOT NULL,
			PRIMARY KEY (`sales_rep_id`),
			UNIQUE KEY `uq_code` (`code`),
			KEY `idx_active` (`active`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
	}

	public function getSalesRep($sales_rep_id) {
		$this->ensureTable();

		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "qiqo_sales_rep` WHERE sales_rep_id = '" . (int)$sales_rep_id . "'");

		return $query->row;
	}

	public function getSalesReps($data = array()) {
		$this->ensureTable();

		$sql = "SELECT * FROM `" . DB_PREFIX . "qiqo_sales_rep`";

		$sort_data = array(
			'code',
			'name',
			'active',
			'date_modified'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY `" . $data['sort'] . "`";
		} else {
			$sql .= " ORDER BY `name`";
		}

		if (isset($data['order']) && $data['order'] == 'DESC') {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}

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

	public function getTotalSalesReps() {
		$this->ensureTable();

		$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "qiqo_sales_rep`");

		return (int)$query->row['total'];
	}
}
