<?php
class ControllerExtensionModuleTfFilterEvent extends Controller {
	private function withoutUnverifiedCatalogPriceControls(array $data): array {
		unset($data['filter_min_price'], $data['filter_max_price'], $data['filter_min_special_perc']);

		if (isset($data['sort']) && in_array($data['sort'], ['p.price', 'ps.price'], true)) {
			$data['sort'] = 'p.sort_order';
			$data['order'] = 'ASC';
		}

		if (!empty($data['sort_order']) && is_array($data['sort_order'])) {
			$data['sort_order'] = array_values(array_filter($data['sort_order'], function ($sortOrder) {
				return empty($sortOrder['sort']) || !in_array($sortOrder['sort'], ['p.price', 'ps.price'], true);
			}));
		}

		return $data;
	}

	public function getProducts($route, $param) {
		$this->load->model('extension/maza/tf_product');

		$data = empty($param[0]) ? array() : $this->withoutUnverifiedCatalogPriceControls($param[0]);
		return $this->model_extension_maza_tf_product->getProducts($data);
	}

	public function getTotalProducts($route, $param) {
		$this->load->model('extension/maza/tf_product');

		$data = empty($param[0]) ? array() : $this->withoutUnverifiedCatalogPriceControls($param[0]);
		return $this->model_extension_maza_tf_product->getTotalProducts($data);
	}
}
