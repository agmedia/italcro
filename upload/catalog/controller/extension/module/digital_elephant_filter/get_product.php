<?php
class ControllerExtensionModuleDigitalElephantFilterGetProduct extends Controller
{
    private $log = null;

    /**
     * @var ControllerExtensionModuleDigitalElephantFilterHelperUrl
     */
    private $helperUrl = null;


    public function __construct($registry)
    {
        parent::__construct($registry);

        $this->log = new Log('DE-filter.2302.log');
        $this->helperUrl = $this->load->controller('extension/module/digital_elephant_filter/helper_url/prototype');
    }


    public function prototype()
    {
        return $this;
    }


    public function index()
    {
        $data_url = $this->helperUrl->getUrlData();

        $this->loadModel();
        $this->loadLanguage();

        $data = $this->getText();
        $data += $this->getFixCoreNotice();

        $data_filter = $this->getFilterDataByUrl($data_url);

        $data['wishlist_products'] = $this->getWishlistProducts();

        $data['cart_products'] = $this->getCartProducts();
		
		// RTL support
		$data['direction'] = $this->language->get('direction');
		if ($this->language->get('direction') == 'rtl') { $data['tooltip_align'] = 'right'; } else { $data['tooltip_align'] = 'left'; }
		$data['basel_list_style'] = $this->config->get('basel_list_style');
		$data['salebadge_status'] = $this->config->get('salebadge_status');
		$data['stock_badge_status'] = $this->config->get('stock_badge_status');
		$data['countdown_status'] = $this->config->get('countdown_status');
		$data['compare'] = $this->url->link('product/compare');
		$data['basel_prod_grid'] = $this->config->get('basel_prod_grid');
		$data['sorts'] = array();
		$data['limits'] = array();

        $data['products'] = $this->getProducts($data_filter);

        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');

        if ($data['products']) {

        $this->response->setOutput($this->load->view('product/category', $data));

        } else {
            return false;
        }
    }

    protected function getFixCoreNotice()
    {
        $data['breadcrumbs'] = [];
        $data['column_left'] = '';
        $data['column_right'] = '';
        $data['content_top'] = '';
        $data['thumb'] = '';
        $data['categories'] = [];
        $data['text_compare'] = '';
        $data['pagination'] = '';
        $data['results'] = '';
        $data['content_bottom'] = '';
        $data['heading_title'] = '';
        $data['description'] = '';
        $data['text_sort'] = '';
        $data['text_limit'] = '';
        $data['sorts'] = '';
        $data['limits'] = '';
        $data['button_grid'] = '';
        $data['button_list'] = '';

        return $data;
    }


    protected function loadModel()
    {
        $this->load->model('extension/module/digitalElephantFilter');
        $this->load->model('catalog/product');
        $this->load->model('tool/image');
		$this->load->model('extension/basel/basel');
    }

    protected function loadLanguage()
    {
        $this->load->language('product/category');
        $this->load->language('extension/module/digitalElephantFilter');
		$this->load->language('basel/basel_theme');
    }

    public function getFilterDataByUrl($data_url) {
        $filter_data = array(
            'filter_sub_category' => true,
            'filter_category_id' => $data_url['category_id'],
            'filter_filter'      => $data_url['opencart_filter'],
            'sub_categories'     => $data_url['sub_categories'],
            'manufacturers'      => $data_url['manufacturers'],
            'options'            => $data_url['option'],
            'attributes'         => $data_url['attribute'],
            'price'              => $data_url['price'],
            'sort'               => $data_url['sort'],
            'order'              => $data_url['order'],
            'start'              => ($data_url['page'] - 1) * $data_url['limit'],
            'limit'              => $data_url['limit'],
        );

        return $filter_data;
    }

    private function getProducts($data_filter) {
		
        $results = $this->model_extension_module_digitalElephantFilter->getProducts($data_filter);

        $products = array();
        $qiqo_price_map = array();
        $qiqo_action_article_map = array();
        $qiqo_action_mpn_map = array();

        if ($results) {
            $sku_quantities = array();
            $base_unit_prices = array();
            $action_skus = array();
            $action_mpns = array();

	            foreach ($results as $r) {
	                $sku_key = trim((string)$r['sku']);
	                $r_mpn_count = isset($r['mpn_count']) ? (int)$r['mpn_count'] : 1;
	                $r_is_single_article = empty($r['mpn']) || $r_mpn_count <= 1;
	                $r_minimum = $this->qiqoPackQuantity($r);
	                $r_pak = isset($r['pak']) ? (int)$r['pak'] : 0;
	                $r_list_min = $this->qiqoMinimumStep($r['cent'], $r_pak, $r_minimum);
	                $r_base_unit = isset($r['base_price']) ? (float)$r['base_price'] : (float)$r['price'];

	                if ($sku_key !== '') {
	                    $action_skus[] = $sku_key;

	                    if ($r_is_single_article && $this->customer->isLogged() && $r_base_unit > 0) {
	                        $sku_quantities[$sku_key] = $r_list_min;
	                        $base_unit_prices[$sku_key] = $r_base_unit;
	                    }
	                }

                if (isset($r['mpn_count']) && (int)$r['mpn_count'] > 1 && !empty($r['mpn'])) {
                    $action_mpns[] = (string)$r['mpn'];
                }
            }

            if ($this->customer->isLogged() && $sku_quantities) {
                $qiqo_price_map = $this->model_catalog_product->getQiqoPricingMap(
                    (int)$this->customer->getId(),
                    $sku_quantities,
                    $base_unit_prices,
	                    false,
	                    false
                );
            }

            if ($action_skus) {
                $qiqo_action_article_map = $this->model_catalog_product->getQiqoActionArticleMap($action_skus);
            }

            if ($action_mpns) {
                $qiqo_action_mpn_map = $this->model_catalog_product->getQiqoActionMpnMap($action_mpns);
            }
        }

	        foreach ($results as $result) {
	            $sku_key = trim((string)$result['sku']);
	            $mpn_count = isset($result['mpn_count']) ? (int)$result['mpn_count'] : 1;
	            $is_single_article = empty($result['mpn']) || $mpn_count <= 1;
	            $minimum = $this->qiqoPackQuantity($result);
	            $pak = isset($result['pak']) ? (int)$result['pak'] : 0;
	            $list_min = $this->qiqoMinimumStep($result['cent'], $pak, $minimum);
		            $display_price_unit = isset($result['base_price']) ? (float)$result['base_price'] : (float)$result['price'];
	            $display_special_unit = 0.0;
	            $has_display_special = false;
            $qiqo_discount_percent = 0.0;
            $qiqo_action = ($sku_key !== '' && !empty($qiqo_action_article_map[$sku_key]))
                || (isset($result['mpn_count']) && (int)$result['mpn_count'] > 1 && !empty($result['mpn']) && !empty($qiqo_action_mpn_map[(string)$result['mpn']]));

	            if ($is_single_article && $sku_key !== '' && isset($qiqo_price_map[$sku_key])) {
		                $pricing = $qiqo_price_map[$sku_key];
		                $has_display_special = isset($pricing['old_unit_price']) && $pricing['old_unit_price'] !== false;
	                $display_price_unit = isset($pricing['old_unit_price']) && $pricing['old_unit_price'] !== false
	                    ? (float)$pricing['old_unit_price']
	                    : (float)$pricing['base_unit_price'];
                $display_special_unit = isset($pricing['old_unit_price']) && $pricing['old_unit_price'] !== false
                    ? (float)$pricing['final_unit_price']
                    : 0.0;
	                $qiqo_discount_percent = isset($pricing['discount_percent']) ? (float)$pricing['discount_percent'] : 0.0;
            }

        	if (VERSION >= '3.0.0.0') {
                $image_width = $this->config->get('theme_' . $this->config->get('config_theme') . '_image_product_width');
                $image_height = $this->config->get('theme_' . $this->config->get('config_theme') . '_image_product_height');
            } else {
                $image_width = $this->config->get($this->config->get('config_theme') . '_image_product_width');
                $image_height = $this->config->get($this->config->get('config_theme') . '_image_product_height');
            }

            if ($result['image'] && file_exists(DIR_IMAGE . $result['image'])) {
                $image = $this->model_tool_image->resize($result['image'], $image_width, $image_height);
            } else {
                $image = $this->model_tool_image->resize('placeholder.png', $image_width, $image_height);
            }
			
			$images = $this->model_catalog_product->getProductImages($result['product_id']);
			if(isset($images[0]['image']) && !empty($images[0]['image'])){
			$images =$images[0]['image'];
			} else {
			$images = false;
            }

            if ($this->customer->isLogged() || !$this->config->get('config_customer_price')) {
                $price = $this->currency->format($this->tax->calculate($display_price_unit, $result['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);

                 if($this->session->data['currency']=='HRK'){
                        $priceeur = $this->currency->format($this->tax->calculate($display_price_unit, $result['tax_class_id'], $this->config->get('config_tax')), 'EUR');
                    }
                    else{
                        $priceeur  ='';

                    }
            } else {
                $price = false;
                 $priceeur  ='';
            }

	            if ($has_display_special) {
                $special = $this->currency->format($this->tax->calculate($display_special_unit, $result['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);

                  if($this->session->data['currency']=='HRK'){
                        $specialeur = $this->currency->format($this->tax->calculate($display_special_unit, $result['tax_class_id'], $this->config->get('config_tax')),  'EUR');
                    }
                    else{
                        $specialeur  ='';

                    }
            } else {
                $special = false;
                   $specialeur  ='';
            }
			
			$image2 = $this->model_catalog_product->getProductImages($result['product_id']);
			if(isset($image2[0]['image']) && !empty($image2[0]['image']) && $this->config->get('basel_thumb_swap')){
				$image2 = $image2[0]['image'];
			} else {
				$image2 = false;
			}
			
			if ($has_display_special && ($this->config->get('salebadge_status')) ) {
			if ($this->config->get('salebadge_status') == '2') {
				$sale_badge = '-' . number_format(((($this->tax->calculate($display_price_unit, $result['tax_class_id'], $this->config->get('config_tax')))-($this->tax->calculate($display_special_unit, $result['tax_class_id'], $this->config->get('config_tax'))))/(($this->tax->calculate($display_price_unit, $result['tax_class_id'], $this->config->get('config_tax')))/100)), 0, ',', '.') . '%';
			} else {
				$sale_badge = $this->language->get('basel_text_sale');
			}		
			} else {
				$sale_badge = false;
			}
		
			if (strtotime($result['date_available']) > strtotime('-' . $this->config->get('newlabel_status') . ' day')) {
				$is_new = true;
			} else {
				$is_new = false;
			}
			
			if ($has_display_special) {
				$date_end = $this->model_extension_basel_basel->getSpecialEndDate($result['product_id']);
			} else {
				$date_end = false;
			}

            if ($this->config->get('config_tax')) {
	                $tax = $this->currency->format($has_display_special ? $display_special_unit : $display_price_unit, $this->session->data['currency']);
            } else {
                $tax = false;
            }

            if ($this->config->get('config_review_status')) {
                $rating = (int)$result['rating'];
            } else {
                $rating = false;
            }

           if (VERSION >= '3.0.0.0') {
                $description = utf8_substr(trim(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8'))), 0, $this->config->get('theme_' . $this->config->get('config_theme') . '_product_description_length')) . '..';
            } else {
                $description = utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get($this->config->get('config_theme') . '_product_description_length')) . '..';
            }

            $price_raw = (float)$display_price_unit;
            $special_raw = (float)$display_special_unit;
            $preview_price_alt = false;
			$preview_price_basis = strtoupper(preg_replace('/[^A-Z0-9]/', '', (string)$result['cent'])) === 'C100' ? 100.0 : $list_min;

	            if ($has_display_special) {
                $preview_price_raw = $special_raw * $preview_price_basis;
                $preview_price_alt_raw = $price_raw * $preview_price_basis;

                $preview_price_alt = $this->currency->format(
                    $this->tax->calculate(
                        $preview_price_alt_raw,
                        $result['tax_class_id'],
                        $this->config->get('config_tax')
                    ),
                    $this->session->data['currency']
                );
            } else {
                $preview_price_raw = $price_raw * $preview_price_basis;
            }

	            $preview_price = ($has_display_special || $preview_price_raw > 0) ? $this->currency->format(
                $this->tax->calculate(
                    $preview_price_raw,
                    $result['tax_class_id'],
                    $this->config->get('config_tax')
                ),
                $this->session->data['currency']
            ) : false;

            $products[] = array(
                'product_id'  => $result['product_id'],
                'thumb'       => $image,
				'thumb2' 	 => $this->model_tool_image->resize($image2, $image_width, $image_height),
				'sale_end_date' => $date_end['date_end'] ?? '',
                'name'        => $result['name'],
                'name_add'    => $result['name_add'],
				'quantity'  => $result['quantity'],
                'description' => $description,
                'price'       => $price,
                   'priceeur'       => $priceeur,
                    'specialeur'     => $specialeur,
				'sale_badge'  => $sale_badge,
				'new_label'   => $is_new,
                'special'     => $special,
                'pak'         => $pak,
                'cent'        => $result['cent'],
                'sku'         => $result['sku'],
                'preview_price' => $preview_price,
                'preview_price_alt' => $preview_price_alt,
	                'mpn_count'   => $mpn_count,
	                'mpn_artikl'  => $this->artiklLabel($mpn_count),
	                'is_single_article' => $is_single_article,
	                'list_min'    => $list_min,
                'decimal_quantity' => $this->qiqoAllowsDecimalQuantity($result),
                'qiqo_discount_percent' => $qiqo_discount_percent,
                'qiqo_action' => $qiqo_action,
                'tax'         => $tax,
                'minimum'     => $minimum,
                'rating'      => $result['rating'],
                'href'        => $this->url->link('product/product', 'path=' . $this->request->get['path'] . '&product_id=' . $result['product_id'])
            );
        }

        return $products;
    }

    private function artiklLabel($broj) {
        $broj = abs($broj) % 100;
        $jedinica = $broj % 10;

        if ($broj > 10 && $broj < 20) {
            return "artikala";
        }

        if ($jedinica == 1) {
            return "artikl";
        }

        if ($jedinica >= 2 && $jedinica <= 4) {
            return "artikla";
        }

        return "artikala";
    }

    private function qiqoPackQuantity($product) {
        $jm = isset($product['jm']) && trim((string)$product['jm']) !== '' ? $product['jm'] : (isset($product['ean']) ? $product['ean'] : '');
        $attribute = isset($product['name_add']) ? str_replace(',', '.', trim((string)$product['name_add'])) : '';
        if (strtoupper(trim((string)$jm)) === 'MET' && preg_match('/(^|[^0-9])([0-9]+(?:\\.[0-9]+)?)\\s*m([^a-z0-9]|$)/i', $attribute, $match)) {
            $meter_length = (float)$match[2];
            if ($meter_length > 0 && abs($meter_length - round($meter_length)) > 0.00001) {
                return $meter_length;
            }
        }

        $pakkol = isset($product['pakkol']) ? (float)$product['pakkol'] : 0.0;
        if ($pakkol <= 0) {
            $pakkol = isset($product['minimum']) ? (float)$product['minimum'] : 1.0;
        }

        return $pakkol > 0 ? $pakkol : 1.0;
    }

    private function qiqoMinimumStep($cent, $pak, $pakkol) {
        $cent_normalized = strtoupper(preg_replace('/[^A-Z0-9]/', '', (string)$cent));
        $step = ($cent_normalized === 'C100' || (int)$pak === 1 || abs((float)$pakkol - round((float)$pakkol)) > 0.00001) ? (float)$pakkol : 1.0;

        return $step > 0 ? $step : 1.0;
    }

    private function qiqoJm($product) {
        if (isset($product['jm']) && trim((string)$product['jm']) !== '') {
            return $product['jm'];
        }

        return isset($product['ean']) ? $product['ean'] : '';
    }

    private function qiqoAllowsDecimalQuantity($product) {
        $jm = strtoupper(trim((string)$this->qiqoJm($product)));
        $pakkol = $this->qiqoPackQuantity($product);
        $attribute = isset($product['name_add']) ? str_replace(',', '.', trim((string)$product['name_add'])) : '';

        return abs($pakkol - round($pakkol)) > 0.00001
            || ($jm === 'MET' && preg_match('/(^|[^0-9])\\d+\\.\\d+\\s*m([^a-z0-9]|$)/i', $attribute));
    }


    private function getCartProducts() {
        $result = array();
        $cart_products = $this->cart->getProducts();
        if ($cart_products) {
            foreach ($cart_products as $p) {
                $result[] = $p['product_id'];
            }
        }

        return $result;
    }

    private function getWishlistProducts() {
        return isset($this->session->data['wishlist']) ? $this->session->data['wishlist'] : array();
    }

    private function getText() {
        $data = array();
        $data['text_tax'] = $this->language->get('text_tax');
        $data['button_cart'] = $this->language->get('button_cart');
        $data['button_wishlist'] = $this->language->get('button_wishlist');
        $data['button_compare'] = $this->language->get('button_compare');
        $data['button_continue'] = $this->language->get('button_continue');
		$data['basel_text_out_of_stock'] = $this->language->get('basel_text_out_of_stock');
		$data['default_button_cart'] = $this->language->get('button_cart');
		$data['basel_button_quickview'] = $this->language->get('basel_button_quickview');
		$data['basel_text_sale'] = $this->language->get('basel_text_sale');
		$data['basel_text_new'] = $this->language->get('basel_text_new');
		$data['basel_text_days'] = $this->language->get('basel_text_days');
		$data['basel_text_hours'] = $this->language->get('basel_text_hours');
		$data['basel_text_mins'] = $this->language->get('basel_text_mins');
		$data['basel_text_secs'] = $this->language->get('basel_text_secs');
		$data['basel_text_out_of_stock'] = $this->language->get('basel_text_out_of_stock');
		$data['default_button_cart'] = $this->language->get('button_cart');

        return $data;
    }

    public function getTotalProducts($data_filter) {
        $this->loadModel();
        return $this->model_extension_module_digitalElephantFilter->getTotalProducts($data_filter);
    }
}
