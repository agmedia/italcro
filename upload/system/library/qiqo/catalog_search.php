<?php

final class QiqoCatalogSearch {
	public static function isArticleCode($phrase) {
		return preg_match('/^[0-9]{4,}$/D', trim((string)$phrase)) === 1;
	}

	public static function articleCodeCondition($db, $phrase) {
		$code = $db->escape(trim((string)$phrase));

		// QIQO stores the article code in sku and the complete barcode in model.
		return "(p.sku = '" . $code . "' OR p.model = '" . $code . "')";
	}
}
