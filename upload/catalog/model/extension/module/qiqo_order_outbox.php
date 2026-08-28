<?php
class ModelExtensionModuleQiqoOrderOutbox extends Model {
	public function enqueueOrder($order_id) {
		$order_id = (int)$order_id;
		if (!$this->tableExists('qiqo_order_outbox')) {
			$this->log->write('QIQO NarudzbaSend: outbox migracija nije primijenjena; narudžba #' . $order_id . ' nije stavljena u red.');
			return false;
		}

		$order_query = $this->db->query("SELECT order_status_id FROM `" . DB_PREFIX . "order` WHERE order_id = '" . $order_id . "' LIMIT 1");
		$existing = $this->db->query("SELECT outbox_id, status FROM `" . DB_PREFIX . "qiqo_order_outbox` WHERE order_id = '" . $order_id . "' LIMIT 1");
		$order_is_accepted = $order_query->num_rows
			&& in_array((int)$order_query->row['order_status_id'], $this->acceptedStatusIds(), true);

		if (!$order_is_accepted) {
			if ($existing->num_rows) {
				$this->db->query("UPDATE `" . DB_PREFIX . "qiqo_order_outbox`
					SET status = 'cancelled', locked_at = NULL,
						last_error_code = 'ORDER_NOT_ACCEPTED',
						last_error_description = 'Narudžba je uređena, otkazana ili više nije u statusu dopuštenom za slanje.',
						date_modified = NOW()
					WHERE outbox_id = '" . (int)$existing->row['outbox_id'] . "'
					  AND status IN ('pending', 'blocked', 'failed', 'verified_not_sent', 'rebuilding')
					  AND NOT EXISTS (
						SELECT 1 FROM `" . DB_PREFIX . "order` o
						WHERE o.order_id = '" . $order_id . "'
						  AND o.order_status_id IN (" . $this->acceptedStatusSql() . ")
					  )");

				// The status may have been re-accepted between the initial read and
				// the guarded cancellation update. Reconcile under current state so a
				// stale cancellation request cannot strand a valid export.
				if ($this->isOrderAccepted($order_id)) {
					$current = $this->db->query("SELECT outbox_id, status
						FROM `" . DB_PREFIX . "qiqo_order_outbox`
						WHERE order_id = '" . $order_id . "' LIMIT 1");
					if ($current->num_rows && $current->row['status'] === 'cancelled') {
						$this->rebuildCancelledSnapshot((int)$current->row['outbox_id'], $order_id);
					}

					return $current->num_rows ? (int)$current->row['outbox_id'] : false;
				}
			}
			return false;
		}

		if ($existing->num_rows) {
			if ($existing->row['status'] === 'cancelled') {
				$this->rebuildCancelledSnapshot((int)$existing->row['outbox_id'], $order_id);
			}
			return (int)$existing->row['outbox_id'];
		}

		require_once DIR_SYSTEM . 'library/qiqo/order_payload.php';

		try {
			$builder = new QiqoOrderPayload($this->registry);
			$data = $builder->build($order_id);

			$this->db->query("INSERT IGNORE INTO `" . DB_PREFIX . "qiqo_order_outbox`
				(order_id, order_status_id, partner_code, delivery_place_code, sales_rep_code,
				 currency_code, payload_json, payload_hash, status, date_added, date_modified)
				SELECT '" . (int)$data['order_id'] . "', '" . (int)$data['order_status_id'] . "',
					'" . $this->db->escape($data['partner_code']) . "',
					'" . $this->db->escape($data['delivery_place_code']) . "',
					'" . $this->db->escape($data['sales_rep_code']) . "',
					'" . $this->db->escape($data['currency_code']) . "',
					'" . $this->db->escape($data['payload_json']) . "',
					'" . $this->db->escape($data['payload_hash']) . "', 'pending', NOW(), NOW()
				FROM `" . DB_PREFIX . "order` o
				WHERE o.order_id = '" . $order_id . "'
				  AND o.order_status_id IN (" . $this->acceptedStatusSql() . ")
				LIMIT 1");
		} catch (Throwable $e) {
			$error = $this->safeError($e->getMessage());
			$this->db->query("INSERT IGNORE INTO `" . DB_PREFIX . "qiqo_order_outbox`
				(order_id, order_status_id, payload_json, payload_hash, status,
				 last_error_code, last_error_description, date_added, date_modified)
				SELECT '" . $order_id . "', o.order_status_id, '{}', '" . hash('sha256', '{}') . "',
					'blocked', 'PAYLOAD_VALIDATION', '" . $this->db->escape($error) . "', NOW(), NOW()
				FROM `" . DB_PREFIX . "order` o
				WHERE o.order_id = '" . $order_id . "'
				  AND o.order_status_id IN (" . $this->acceptedStatusSql() . ")
				LIMIT 1");
			$this->log->write('QIQO NarudzbaSend: narudžba #' . $order_id . ' blokirana: ' . $error);
		}

		$result = $this->db->query("SELECT outbox_id FROM `" . DB_PREFIX . "qiqo_order_outbox` WHERE order_id = '" . (int)$order_id . "' LIMIT 1");
		return $result->num_rows ? (int)$result->row['outbox_id'] : false;
	}

	private function rebuildCancelledSnapshot($outbox_id, $order_id) {
		$this->db->query("UPDATE `" . DB_PREFIX . "qiqo_order_outbox`
			SET status = 'rebuilding', locked_at = NOW(), date_modified = NOW()
			WHERE outbox_id = '" . (int)$outbox_id . "' AND status = 'cancelled'");
		if (!$this->db->countAffected()) {
			return;
		}

		require_once DIR_SYSTEM . 'library/qiqo/order_payload.php';
		try {
			$builder = new QiqoOrderPayload($this->registry);
			$data = $builder->build($order_id);
			if (!in_array((int)$data['order_status_id'], $this->acceptedStatusIds(), true)) {
				throw new RuntimeException('Narudžba više nije u statusu dopuštenom za slanje.');
			}

			$this->db->query("UPDATE `" . DB_PREFIX . "qiqo_order_outbox`
				SET order_status_id = '" . (int)$data['order_status_id'] . "',
					partner_code = '" . $this->db->escape($data['partner_code']) . "',
					delivery_place_code = '" . $this->db->escape($data['delivery_place_code']) . "',
					sales_rep_code = '" . $this->db->escape($data['sales_rep_code']) . "',
					currency_code = '" . $this->db->escape($data['currency_code']) . "',
					payload_json = '" . $this->db->escape($data['payload_json']) . "',
					payload_hash = '" . $this->db->escape($data['payload_hash']) . "',
					status = 'pending', attempts = 0, locked_at = NULL,
					last_http_status = 0, last_error_code = '', last_error_description = '',
					last_response = NULL, sent_at = NULL, date_modified = NOW()
				WHERE outbox_id = '" . (int)$outbox_id . "' AND status = 'rebuilding'
				  AND EXISTS (
					SELECT 1 FROM `" . DB_PREFIX . "order` o
					WHERE o.order_id = '" . (int)$order_id . "'
					  AND o.order_status_id IN (" . $this->acceptedStatusSql() . ")
				  )");
		} catch (Throwable $e) {
			$error = $this->safeError($e->getMessage());
			$state = $this->isOrderAccepted($order_id) ? 'blocked' : 'cancelled';
			$this->db->query("UPDATE `" . DB_PREFIX . "qiqo_order_outbox`
				SET status = '" . $state . "', locked_at = NULL,
					last_error_code = 'PAYLOAD_VALIDATION',
					last_error_description = '" . $this->db->escape($error) . "',
					date_modified = NOW()
				WHERE outbox_id = '" . (int)$outbox_id . "' AND status = 'rebuilding'");
			$this->log->write('QIQO NarudzbaSend: obnovljeni payload narudžbe #' . (int)$order_id . ' nije valjan: ' . $error);
		}
	}

	private function isOrderAccepted($order_id) {
		$query = $this->db->query("SELECT order_status_id FROM `" . DB_PREFIX . "order` WHERE order_id = '" . (int)$order_id . "' LIMIT 1");
		return $query->num_rows && in_array((int)$query->row['order_status_id'], $this->acceptedStatusIds(), true);
	}

	private function acceptedStatusIds() {
		$value = $this->config->get('qiqo_order_accepted_status_ids');
		if (is_array($value)) {
			$values = $value;
		} else {
			$values = preg_split('/\s*,\s*/', trim((string)$value), -1, PREG_SPLIT_NO_EMPTY);
		}
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

	private function tableExists($table) {
		$query = $this->db->query("SELECT 1 FROM INFORMATION_SCHEMA.TABLES
			WHERE TABLE_SCHEMA = DATABASE()
			  AND TABLE_NAME = '" . $this->db->escape(DB_PREFIX . $table) . "'
			LIMIT 1");
		return (bool)$query->num_rows;
	}

	private function safeError($message) {
		$message = preg_replace('/[\x00-\x1F\x7F]/', ' ', (string)$message);
		return function_exists('mb_substr') ? mb_substr($message, 0, 1000, 'UTF-8') : substr($message, 0, 1000);
	}
}
