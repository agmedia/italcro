<?php
require_once(modification(DIR_APPLICATION . 'controller/product/special.php'));

class ControllerProductNewProduct extends ControllerProductSpecial {
    protected $listing_route = 'product/new_product';
    protected $listing_language = 'product/new_product';

    protected function getListingTotal() {
        $this->load->model('catalog/new_product');
        return $this->model_catalog_new_product->getTotalProducts();
    }

    protected function getListingProducts($filter_data) {
        $this->load->model('catalog/new_product');
        return $this->model_catalog_new_product->getProducts($filter_data);
    }
}
