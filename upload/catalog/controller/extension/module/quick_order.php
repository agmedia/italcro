<?php
class ControllerExtensionModuleQuickOrder extends Controller {

    /* ========= AUTH HELPERS ========= */
    /** Guard for JSON endpoints */
    private function requireLoginJson() {
        if (!$this->customer->isLogged()) {
            $this->response->addHeader('Content-Type: application/json');
            $this->response->addHeader('HTTP/1.1 401 Unauthorized');
            $this->response->setOutput(json_encode([
                'error'   => 'login_required',
                'message' => 'Morate biti prijavljeni.'
            ]));
            return false;
        }
        return true;
    }

    /* ========= VIEW ========= */
    public function index() {
        if (!$this->config->get('module_quick_order_status')) return;

        if (!$this->customer->isLogged()) {
            // baza (SSL ako je uključeno)
            $base = (!empty($this->request->server['HTTPS']) && $this->request->server['HTTPS'] != 'off')
                ? $this->config->get('config_ssl')
                : $this->config->get('config_url');

            // 🔁 nakon logina ide na information id=30 (tvoj "brza narudžba")
            $this->session->data['redirect'] = $this->url->link('information/information', 'information_id=30', true);

            // redirect na login
            $this->response->redirect($this->url->link('account/login', '', true));
            return;
        }

        $this->load->language('extension/module/quick_order');
        $script_file = DIR_APPLICATION . '../catalog/view/javascript/quick_order.js';
        $script_ver = is_file($script_file) ? filemtime($script_file) : time();
        $this->document->addScript('catalog/view/javascript/quick_order.js?v=' . $script_ver);

        $data['heading_title'] = $this->language->get('heading_title');
        $data['text_search']   = $this->language->get('text_search');
        $data['text_sku']      = $this->language->get('text_sku');
        $data['text_qty']      = $this->language->get('text_qty');
        $data['text_add']      = $this->language->get('text_add');
        $data['text_price']    = $this->language->get('text_price');
        $data['text_name']     = $this->language->get('text_name');

        // Summary labels
        $data['text_total']    = 'Ukupno (odabir)';
        $data['text_checkout'] = 'Završi kupnju';
        $data['text_add_all']  = 'Dodaj sve u košaricu';
        $data['text_clear_all']= 'Obriši sve';

        return $this->load->view('extension/module/quick_order', $data);
    }


    /* ========= DATA: search ========= */
    public function autocomplete() {
        if (!$this->requireLoginJson()) return; // 🔐

        $this->response->addHeader('Content-Type: application/json');
        $term = isset($this->request->get['term']) ? trim($this->request->get['term']) : '';
        if (utf8_strlen($term) < 2) {
            $this->response->setOutput(json_encode([]));
            return;
        }

        $this->load->model('catalog/product');
        $this->load->model('tool/image');

        $term = isset($this->request->get['term']) ? trim($this->request->get['term']) : '';

// normaliziraj višak razmaka: više spaceova -> jedan
        $term_normalized = preg_replace('/\s+/', ' ', $term);
        $term_esc        = $this->db->escape($term_normalized);

// verzija bez razmaka za “grubo” pretraživanje
        $term_nospace    = preg_replace('/\s+/', '', mb_strtolower($term_normalized));
        $term_nospace_esc = $this->db->escape($term_nospace);



        $sql = "SELECT p.product_id, p.cent
        FROM " . DB_PREFIX . "product p 
        JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) 
        WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "'
          AND p.status = 1
          AND (
                pd.name LIKE '%" . $term_esc . "%'
             OR pd.name_add LIKE '%" . $term_esc . "%'
             OR CONCAT(pd.name, ' ', pd.name_add) LIKE '%" . $term_esc . "%'
             OR p.sku LIKE '" . $term_esc . "%'
             OR p.model LIKE '" . $term_esc . "%'

             /* IGNORIRAJ RAZMAKE u kombiniranom nazivu (name + name_add) */
             OR REPLACE(LOWER(CONCAT(pd.name, ' ', pd.name_add)), ' ', '') LIKE '%" . $term_nospace_esc . "%'
          )
        ORDER BY pd.name ASC
        LIMIT 30";

        $query = $this->db->query($sql);

        $show_price = true;
        if ($this->config->get('config_customer_price') && !$this->customer->isLogged()) {
            $show_price = false;
        }

        $items = [];
        $sku_quantities = [];
        $base_unit_prices = [];
        $sku_list = [];

        foreach ($query->rows as $row) {
            $product_info = $this->model_catalog_product->getProduct((int)$row['product_id']);
            if (!$product_info) {
                continue;
            }

            $pak = isset($product_info['pak']) ? (int)$product_info['pak'] : 0;
            $minimum = $this->qiqoPackQuantity($product_info);
            $minimumifc100 = $this->qiqoMinimumStep($product_info['cent'], $pak, $minimum);

            $base_unit = isset($product_info['base_price']) ? (float)$product_info['base_price'] : (float)$product_info['price'];
            $sku = trim((string)$product_info['sku']);

            if ($sku !== '' && $base_unit > 0) {
                $sku_quantities[$sku] = (float)$minimumifc100;
                $base_unit_prices[$sku] = $base_unit;
                $sku_list[] = $sku;
            }

            $items[] = [
                'product_info'  => $product_info,
                'minimumifc100' => $minimumifc100,
                'base_unit'     => $base_unit
            ];
        }

        $qiqo_price_map = [];
        $qiqo_action_details_map = [];
        if ($this->customer->isLogged() && $sku_quantities) {
            $qiqo_price_map = $this->model_catalog_product->getQiqoPricingMap(
                (int)$this->customer->getId(),
                $sku_quantities,
                $base_unit_prices,
                false,
                true
            );
            $qiqo_action_details_map = $this->model_catalog_product->getQiqoActionDetailsMap($sku_list);
        }

        $results = [];
        foreach ($items as $item) {
            $product_info = $item['product_info'];
            $sku = trim((string)$product_info['sku']);
            $results[] = $this->buildQuickOrderItem(
                $product_info,
                $item['minimumifc100'],
                $sku !== '' && isset($qiqo_price_map[$sku]) ? $qiqo_price_map[$sku] : array(),
                $sku !== '' && isset($qiqo_action_details_map[$sku]) ? $qiqo_action_details_map[$sku] : array(),
                $show_price
            );
        }

        $this->response->setOutput(json_encode($results));
    }

    /* ========= CART ops ========= */
    public function fastAdd() {
        if (!$this->requireLoginJson()) return; // 🔐

        $this->response->addHeader('Content-Type: application/json');
        $product_id = (int)($this->request->post['product_id'] ?? 0);
        $qty        = $this->parseQiqoQuantity($this->request->post['quantity'] ?? 1);
        if ($qty <= 0) $qty = 1.0;

        $resp = $this->addSingleProduct($product_id, $qty);
        $this->response->setOutput(json_encode($resp));
    }

    public function fastAddAll() {
        if (!$this->requireLoginJson()) return; // 🔐

        $this->response->addHeader('Content-Type: application/json');
        $items_json = $this->request->post['items'] ?? '[]';
        $items = json_decode($items_json, true);
        if (!is_array($items)) $items = [];

        $result = ['success' => true, 'added' => [], 'errors' => []];

        foreach ($items as $it) {
            $pid = (int)($it['product_id'] ?? 0);
            $qty = $this->parseQiqoQuantity($it['quantity'] ?? 1);
            if ($qty <= 0) $qty = 1.0;
            $r = $this->addSingleProduct($pid, $qty);
            if ($r['success']) {
                $result['added'][] = ['product_id' => $pid, 'quantity' => $qty];
            } else {
                $result['success'] = false;
                $result['errors'][] = ['product_id' => $pid, 'message' => $r['message']];
            }
        }
        $this->response->setOutput(json_encode($result));
    }

    public function removeItem() {
        if (!$this->requireLoginJson()) return; // 🔐

        $this->response->addHeader('Content-Type: application/json');
        $pid = (int)($this->request->post['product_id'] ?? 0);
        if (!$pid) { $this->response->setOutput(json_encode(['success'=>false])); return; }

        $removed = 0;
        foreach ($this->cart->getProducts() as $p) {
            if ((int)$p['product_id'] === $pid) {
                if (!empty($p['cart_id'])) {
                    $this->cart->remove($p['cart_id']);
                    $removed++;
                }
            }
        }
        $this->response->setOutput(json_encode(['success'=>true,'removed'=>$removed]));
    }

    public function clearAll() {
        if (!$this->requireLoginJson()) return; // 🔐

        $this->response->addHeader('Content-Type: application/json');
        $this->cart->clear();
        $this->response->setOutput(json_encode(['success'=>true]));
    }

    // Update qty by product_id: remove all entries then add one with new qty (assumes no required options)
    public function updateQty() {
        if (!$this->requireLoginJson()) return; // 🔐

        $this->response->addHeader('Content-Type: application/json');
        $pid = (int)($this->request->post['product_id'] ?? 0);
        $qty = $this->parseQiqoQuantity($this->request->post['quantity'] ?? 1);
        if ($qty <= 0) $qty = 1.0;
        if (!$pid) { $this->response->setOutput(json_encode(['success'=>false])); return; }

        // remove all entries for pid
        foreach ($this->cart->getProducts() as $p) {
            if ((int)$p['product_id'] === $pid && !empty($p['cart_id'])) {
                $this->cart->remove($p['cart_id']);
            }
        }
        // add new one
        $r = $this->addSingleProduct($pid, $qty);
        $this->response->setOutput(json_encode($r));
    }

    private function addSingleProduct($product_id, $qty) {
        if (!$product_id) return ['success'=>false,'message'=>'Invalid product'];

        $this->load->model('catalog/product');
        $product_info = $this->model_catalog_product->getProduct($product_id);
        if (!$product_info) return ['success'=>false,'message'=>'Product not found'];

        $options = $this->model_catalog_product->getProductOptions($product_id);
        foreach ($options as $option) {
            if ($option['required']) {
                return ['success'=>false,'message'=>'Product requires options. Open product page.'];
            }
        }

        $requested_qty = (float)$qty;
        $pak = isset($product_info['pak']) ? (int)$product_info['pak'] : 0;
        $step = $this->qiqoMinimumStep($product_info['cent'], $pak, $this->qiqoPackQuantity($product_info));
        $allow_decimal = $this->qiqoAllowsDecimalQuantity($product_info);
        $requested_below_minimum = $requested_qty < $step;
        if ($qty < $step) {
            $qty = $step;
        }
        if (!$allow_decimal) {
            $qty = ceil($qty - 0.0000001);
        }
        if (($this->qiqoIsC100($product_info['cent']) || $pak === 1) && $step > 0) {
            $qty = ceil(($qty / $step) - 0.0000001) * $step;
        }

        $this->cart->add($product_id, $qty);
        $this->load->language('checkout/cart');
        $response = ['success'=>true,'message'=>$this->language->get('text_success'), 'quantity' => $qty];
        if (abs($qty - $requested_qty) > 0.00001) {
            if ($requested_below_minimum) {
                $response['notice'] = 'Minimalna količina za ovaj artikl je ' . $this->formatQiqoQuantity($step, $allow_decimal) . '. Količina je postavljena na ' . $this->formatQiqoQuantity($qty, $allow_decimal) . '.';
            } else {
                $response['notice'] = 'Količina je zaokružena na ' . $this->formatQiqoQuantity($qty, $allow_decimal) . ' prema dozvoljenom koraku pakiranja.';
            }
        }

        return $response;
    }

    /* ========= HELPERS ========= */
    public function format() {
        if (!$this->requireLoginJson()) return; // 🔐

        $this->response->addHeader('Content-Type: application/json');
        $amount = (float)($this->request->post['amount'] ?? 0);
        $this->response->setOutput(json_encode([
            'formatted' => $this->currency->format($amount, $this->session->data['currency'])
        ]));
    }

    public function cartState() {
        if (!$this->requireLoginJson()) return; // 🔐

        $this->response->addHeader('Content-Type: application/json');

        $this->load->model('catalog/product');
        $this->load->model('tool/image');
        $this->load->language('product/product');

        $cart_products = $this->cart->getProducts();
        $product_info_map = array();
        $sku_quantities = array();
        $base_unit_prices = array();

        foreach ($cart_products as $cart_product) {
            $product_id = (int)$cart_product['product_id'];
            if (!isset($product_info_map[$product_id])) {
                $product_info_map[$product_id] = $this->model_catalog_product->getProduct($product_id);
            }

            $product_info = isset($product_info_map[$product_id]) ? $product_info_map[$product_id] : array();
            if (!$product_info || empty($product_info['sku'])) {
                continue;
            }

            $sku = trim((string)$product_info['sku']);
            if ($sku === '') {
                continue;
            }

            $qty = (float)$cart_product['quantity'];
            if ($qty <= 0) {
                $qty = 1.0;
            }

            $base_unit = isset($product_info['base_price']) ? (float)$product_info['base_price'] : (float)$product_info['price'];
            if ($base_unit <= 0) {
                continue;
            }

            $sku_quantities[$sku] = $qty;
            $base_unit_prices[$sku] = $base_unit;
        }

        $qiqo_price_map = array();
        $qiqo_action_details_map = array();
        if ($this->customer->isLogged() && $sku_quantities) {
            $qiqo_price_map = $this->model_catalog_product->getQiqoPricingMap(
                (int)$this->customer->getId(),
                $sku_quantities,
                $base_unit_prices,
                false,
                true
            );
            $qiqo_action_details_map = $this->model_catalog_product->getQiqoActionDetailsMap(array_keys($sku_quantities));
        }

        $items = array();
        foreach ($cart_products as $product) {
            $product_id = (int)$product['product_id'];
            $product_info = isset($product_info_map[$product_id]) ? $product_info_map[$product_id] : array();

            $product_sku = !empty($product['sku']) ? (string)$product['sku'] : (!empty($product_info['sku']) ? (string)$product_info['sku'] : '');

            if (!$product_info) {
                continue;
            }

            $items[] = $this->buildQuickOrderItem(
                $product_info,
                (float)$product['quantity'],
                $product_sku !== '' && isset($qiqo_price_map[$product_sku]) ? $qiqo_price_map[$product_sku] : array(),
                $product_sku !== '' && isset($qiqo_action_details_map[$product_sku]) ? $qiqo_action_details_map[$product_sku] : array(),
                true
            );
        }

        $json = array('items' => $items);
        $this->response->setOutput(json_encode($json));
    }

    private function buildQuickOrderItem($product_info, $quantity, $pricing_row = array(), $action_rows = array(), $show_price = true) {
        $quantity = (float)$quantity;
        if ($quantity <= 0) {
            $quantity = 1.0;
        }

        $minimum = $this->qiqoPackQuantity($product_info);

        $pak = isset($product_info['pak']) ? (int)$product_info['pak'] : 0;
        $cent = !empty($product_info['cent']) ? (string)$product_info['cent'] : '';
        $minimum_step = $this->qiqoMinimumStep($cent, $pak, $minimum);

        $base_unit = isset($product_info['base_price']) ? (float)$product_info['base_price'] : (float)$product_info['price'];
        // product.vpc already holds the ERP display VPC; C-100 product.price is stored per unit.
        $vpc_display_raw = (isset($product_info['vpc']) && (float)$product_info['vpc'] > 0)
            ? (float)$product_info['vpc']
            : $this->qiqoDisplayPriceRaw($base_unit, $cent);
        $price_unit = $base_unit;
        $discount_percent = 0.0;
        $action_discount = 0.0;
        $action_net_price_raw = 0.0;
        $has_action = !empty($action_rows) || (!empty($pricing_row) && !empty($pricing_row['has_action']));

        if (!empty($pricing_row)) {
            if (isset($pricing_row['final_unit_price'])) {
                $price_unit = (float)$pricing_row['final_unit_price'];
            }

            if (isset($pricing_row['discount_percent'])) {
                $discount_percent = (float)$pricing_row['discount_percent'];
            }

            if (!empty($pricing_row['action_applied']) && isset($pricing_row['action_discount'])) {
                $action_discount = (float)$pricing_row['action_discount'];
            }

            if (isset($pricing_row['action_net_price']) && $pricing_row['action_net_price'] !== null && (float)$pricing_row['action_net_price'] > 0 && abs($price_unit - (float)$pricing_row['action_net_price']) < 0.00001) {
                $action_net_price_raw = $this->qiqoDisplayPriceRaw((float)$pricing_row['action_net_price'], $cent);
            }
        }

        $price_display_raw = $this->qiqoDisplayPriceRaw($price_unit, $cent);

        if (empty($pricing_row['action_applied']) && $action_net_price_raw <= 0 && $discount_percent > 0 && $vpc_display_raw > 0) {
            $price_display_raw = $vpc_display_raw * (1 - ($discount_percent / 100));
        }

        $vpc_display_raw = round($vpc_display_raw, 5);
        $price_display_raw = round($price_display_raw, 5);
        $line_total_raw = $this->quickOrderLineTotalRaw($price_display_raw, $quantity, $cent);

        $thumb = !empty($product_info['image']) ? $this->model_tool_image->resize($product_info['image'], 60, 60) : '';
        $action_conditions = $this->formatQiqoActionConditions($action_rows);

        return array(
            'product_id' => (int)$product_info['product_id'],
            'name'       => html_entity_decode($product_info['name'], ENT_QUOTES, 'UTF-8'),
            'model'      => $product_info['model'],
            'sku'        => $product_info['sku'],
            'name_add'   => $product_info['name_add'],
            'description_add' => $product_info['description_add'],
            'stock'      => $product_info['quantity'],
            'minimum'    => $minimum,
            'minimumifc100' => $minimum_step,
            'decimal_quantity' => $this->qiqoAllowsDecimalQuantity($product_info),
            'pak'        => $pak,
            'packaging'  => $this->formatQiqoPackaging($this->qiqoJm($product_info), $minimum, $pak),
            'cent'       => $cent,
            'quantity'   => $quantity,
            'vpc_raw'    => $show_price ? $vpc_display_raw : 0.0,
            'vpc'        => $show_price ? $this->currency->format($vpc_display_raw, $this->session->data['currency']) : '',
            'price_raw'  => $show_price ? $price_display_raw : 0.0,
            'price'      => $show_price ? $this->currency->format($price_display_raw, $this->session->data['currency']) : '',
            'line_total_raw' => $show_price ? $line_total_raw : 0.0,
            'line_total' => $show_price ? $this->currency->format($line_total_raw, $this->session->data['currency']) : '',
            'qiqo_discount_percent' => $discount_percent,
            'qiqo_action' => $has_action,
            'qiqo_action_discount' => $action_discount,
            'qiqo_action_net_price_raw' => $action_net_price_raw,
            'qiqo_action_conditions' => $action_conditions,
            'thumb'      => $thumb
        );
    }

    private function qiqoCentNormalized($cent) {
        return strtoupper(preg_replace('/[^A-Z0-9]/', '', (string)$cent));
    }

    private function qiqoIsC100($cent) {
        return $this->qiqoCentNormalized($cent) === 'C100';
    }

    private function parseQiqoQuantity($value) {
        if (is_string($value)) {
            $value = trim($value);
            $value = str_replace(array(' ', "\xc2\xa0"), '', $value);
            if (strpos($value, ',') !== false) {
                $value = str_replace('.', '', $value);
                $value = str_replace(',', '.', $value);
            }
        }

        return (float)$value;
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

    private function qiqoMinimumStep($cent, $pak, $pakkol) {
        $step = 1.0;

        if ($this->qiqoIsC100($cent) || (int)$pak === 1 || abs((float)$pakkol - round((float)$pakkol)) > 0.00001) {
            $step = (float)$pakkol;
        }

        return $step > 0 ? $step : 1.0;
    }

    private function qiqoDisplayPriceRaw($price, $cent) {
        $price = (float)$price;

        return $this->qiqoIsC100($cent) ? ($price * 100) : $price;
    }

    private function quickOrderLineTotalRaw($price_display_raw, $quantity, $cent) {
        $total = (float)$price_display_raw * (float)$quantity;

        if ($this->qiqoIsC100($cent)) {
            $total = $total / 100;
        }

        return round($total, 5);
    }

    private function formatQiqoNumber($value) {
        $value = (float)$value;

        if (abs($value - round($value)) < 0.00001) {
            return number_format($value, 0, ',', '.');
        }

        return rtrim(rtrim(number_format($value, 2, ',', '.'), '0'), ',');
    }

    private function formatQiqoQuantity($value, $allow_decimal) {
        $value = round((float)$value, 4);

        if (!$allow_decimal || abs($value - round($value)) < 0.00001) {
            return (string)(int)ceil($value - 0.0000001);
        }

        return rtrim(rtrim(number_format($value, 4, ',', '.'), '0'), ',');
    }

    private function formatQiqoPackaging($jm, $pakkol, $pak) {
        $parts = array();
        $jm = trim((string)$jm);

        if ($jm !== '') {
            $parts[] = $jm;
        }

        if ((float)$pakkol > 0) {
            $parts[] = $this->formatQiqoNumber($pakkol);
        }

        $label = trim(implode(' ', $parts));

        if ((int)$pak === 1) {
            $label .= '*';
        }

        return $label !== '' ? $label : '-';
    }

    private function formatQiqoActionConditions($rows) {
        $conditions = array();

        foreach ($rows as $row) {
            $indicator = isset($row['indicator']) ? strtoupper(trim((string)$row['indicator'])) : '';
            $quantity = isset($row['quantity']) ? (float)$row['quantity'] : 0.0;
            $price = isset($row['price']) ? (float)$row['price'] : 0.0;
            $discount = isset($row['discount']) ? (float)$row['discount'] : 0.0;

            $parts = array();
            if ($indicator !== '') {
                $parts[] = $indicator;
            }
            if ($quantity > 0) {
                $parts[] = 'kol. ' . $this->formatQiqoNumber($quantity);
            }
            if ($price > 0) {
                $parts[] = 'neto ' . $this->currency->format($price, $this->session->data['currency']);
            }
            if ($discount > 0) {
                $parts[] = '-' . $this->formatQiqoNumber($discount) . '%';
            }

            if ($parts) {
                $conditions[] = implode(' / ', $parts);
            }
        }

        return $conditions;
    }
}
