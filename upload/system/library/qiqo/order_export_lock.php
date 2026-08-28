<?php

/**
 * Cross-application advisory lock for one order's mutable lifecycle/export.
 *
 * The legacy order tables are MyISAM, so transactions/row locks cannot
 * serialize checkout edits with a manual ERP POST. Both catalog and admin must
 * use this identical connection-level lock name.
 */
final class QiqoOrderExportLock {
	public static function name($order_id) {
		return 'qiqo_order_export_' . substr(sha1(DB_DATABASE . ':' . DB_PREFIX . (int)$order_id), 0, 40);
	}

	public static function acquire($db, $order_id, $timeout_seconds) {
		$lock_name = self::name($order_id);
		$query = $db->query("SELECT GET_LOCK('" . $db->escape($lock_name) . "', '" . max(0, (int)$timeout_seconds) . "') AS acquired");

		return isset($query->row['acquired']) && (int)$query->row['acquired'] === 1;
	}

	public static function release($db, $order_id) {
		$lock_name = self::name($order_id);
		$db->query("SELECT RELEASE_LOCK('" . $db->escape($lock_name) . "')");
	}
}
