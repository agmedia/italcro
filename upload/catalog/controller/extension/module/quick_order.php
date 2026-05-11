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

        foreach ($query->rows as $row) {
            $product_info = $this->model_catalog_product->getProduct((int)$row['product_id']);
            if (!$product_info) {
                continue;
            }

            $minimumifc100 = ($row['cent'] === 'C-100') ? 1 : (int)$product_info['minimum'];
            if ($minimumifc100 < 1) {
                $minimumifc100 = 1;
            }

            $base_unit = isset($product_info['base_price']) ? (float)$product_info['base_price'] : (float)$product_info['price'];
            $sku = trim((string)$product_info['sku']);

            if ($sku !== '' && $base_unit > 0) {
                $sku_quantities[$sku] = (float)$minimumifc100;
                $base_unit_prices[$sku] = $base_unit;
            }

            $items[] = [
                'product_info'  => $product_info,
                'cent'          => isset($row['cent']) ? $row['cent'] : '',
                'minimumifc100' => $minimumifc100,
                'base_unit'     => $base_unit
            ];
        }

        $qiqo_price_map = [];
        $qiqo_extra_map = [];
        if ($this->customer->isLogged() && $sku_quantities) {
            $qiqo_price_map = $this->model_catalog_product->getQiqoPricingMap(
                (int)$this->customer->getId(),
                $sku_quantities,
                $base_unit_prices,
                false,
                false
            );
            $qiqo_extra_map = $this->model_catalog_product->getQiqoProformaExtraDiscountMap(array_keys($sku_quantities));
        }

        $results = [];
        foreach ($items as $item) {
            $product_info = $item['product_info'];
            $sku = trim((string)$product_info['sku']);
            $unit_raw = (float)$item['base_unit'];
            $price_old = false;
            $qiqo_discount_percent = 0.0;
            $qiqo_proforma_extra_percent = 0.0;

            if ($sku !== '' && isset($qiqo_price_map[$sku])) {
                $map_row = $qiqo_price_map[$sku];
                if (isset($map_row['final_unit_price'])) {
                    $unit_raw = (float)$map_row['final_unit_price'];
                }
                if (isset($map_row['base_discount_percent'])) {
                    $qiqo_discount_percent = (float)$map_row['base_discount_percent'];
                } elseif (isset($map_row['discount_percent'])) {
                    $qiqo_discount_percent = (float)$map_row['discount_percent'];
                }
                if (isset($map_row['old_unit_price']) && $map_row['old_unit_price'] !== false) {
                    $old_unit_raw = (float)$map_row['old_unit_price'];
                    if ($old_unit_raw > 0 && $old_unit_raw > $unit_raw) {
                        $price_old = $this->currency->format(
                            $this->tax->calculate($old_unit_raw, $product_info['tax_class_id'], (bool)$this->config->get('config_tax')),
                            $this->session->data['currency']
                        );
                    }
                }
            }

            if ($sku !== '' && isset($qiqo_extra_map[$sku])) {
                $qiqo_proforma_extra_percent = (float)$qiqo_extra_map[$sku];
            }

            $taxed = $this->tax->calculate($unit_raw, $product_info['tax_class_id'], (bool)$this->config->get('config_tax'));
            $price_display = $show_price ? $this->currency->format($taxed, $this->session->data['currency']) : '';
            $thumb = $product_info['image'] ? $this->model_tool_image->resize($product_info['image'], 60, 60) : '';

            $results[] = [
                'product_id' => (int)$product_info['product_id'],
                'name'       => html_entity_decode($product_info['name'], ENT_QUOTES, 'UTF-8'),
                'model'      => $product_info['model'],
                'sku'        => $product_info['sku'],
                'price'      => $price_display,
                'price_raw'  => $show_price ? (float)$taxed : 0.0,
                'price_old'  => $show_price ? $price_old : false,
                'qiqo_discount_percent' => $qiqo_discount_percent,
                'qiqo_proforma_extra_percent' => $qiqo_proforma_extra_percent,
                'name_add'       => $product_info['name_add'],
                'description_add'=> $product_info['description_add'],
                'stock'          => $product_info['quantity'],
                'minimum'        => $product_info['minimum'],
                'minimumifc100'  => $item['minimumifc100'],
                'cent'           => $item['cent'],
                'thumb'          => $thumb
            ];
        }

        $this->response->setOutput(json_encode($results));
    }

    /* ========= CART ops ========= */
    public function fastAdd() {
        if (!$this->requireLoginJson()) return; // 🔐

        $this->response->addHeader('Content-Type: application/json');
        $product_id = (int)($this->request->post['product_id'] ?? 0);
        $qty        = (int)($this->request->post['quantity'] ?? 1);
        if ($qty < 1) $qty = 1;

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
            $qty = (int)($it['quantity'] ?? 1);
            if ($qty < 1) $qty = 1;
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
        $qty = (int)($this->request->post['quantity'] ?? 1);
        if ($qty < 1) $qty = 1;
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
        $this->cart->add($product_id, $qty);
        $this->load->language('checkout/cart');
        return ['success'=>true,'message'=>$this->language->get('text_success')];
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
        $qiqo_extra_map = array();
        if ($this->customer->isLogged() && $sku_quantities) {
            $qiqo_price_map = $this->model_catalog_product->getQiqoPricingMap(
                (int)$this->customer->getId(),
                $sku_quantities,
                $base_unit_prices,
                false,
                false
            );
            $qiqo_extra_map = $this->model_catalog_product->getQiqoProformaExtraDiscountMap(array_keys($sku_quantities));
        }

        $items = array();
        foreach ($cart_products as $product) {
            $product_id = (int)$product['product_id'];
            $product_info = isset($product_info_map[$product_id]) ? $product_info_map[$product_id] : array();

            $thumb = '';
            if (!empty($product_info['image'])) {
                $thumb = $this->model_tool_image->resize($product_info['image'], 60, 60);
            }

            $price_raw = (float)$product['price'];
            $price_txt = $this->currency->format(
                $this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax')),
                $this->session->data['currency']
            );

            $product_sku = !empty($product['sku']) ? (string)$product['sku'] : (!empty($product_info['sku']) ? (string)$product_info['sku'] : '');
            $qiqo_discount_percent = 0.0;
            $qiqo_proforma_extra_percent = 0.0;
            $price_old = false;

            if ($product_sku !== '') {
                if (isset($qiqo_price_map[$product_sku]['discount_percent'])) {
                    $qiqo_discount_percent = (float)$qiqo_price_map[$product_sku]['discount_percent'];
                }

                if (isset($qiqo_price_map[$product_sku]['base_discount_percent'])) {
                    $qiqo_discount_percent = (float)$qiqo_price_map[$product_sku]['base_discount_percent'];
                }

                if (isset($qiqo_extra_map[$product_sku])) {
                    $qiqo_proforma_extra_percent = (float)$qiqo_extra_map[$product_sku];
                }

                if (isset($qiqo_price_map[$product_sku]['final_unit_price'])) {
                    $price_raw = (float)$qiqo_price_map[$product_sku]['final_unit_price'];
                    $price_txt = $this->currency->format(
                        $this->tax->calculate($price_raw, $product['tax_class_id'], $this->config->get('config_tax')),
                        $this->session->data['currency']
                    );
                }

                if (isset($qiqo_price_map[$product_sku]['old_unit_price']) &&
                    $qiqo_price_map[$product_sku]['old_unit_price'] !== false) {
                    $old_unit_raw = (float)$qiqo_price_map[$product_sku]['old_unit_price'];
                    $current_unit_raw = $price_raw;

                    if ($old_unit_raw > 0 && $old_unit_raw > $current_unit_raw) {
                        $price_old = $this->currency->format(
                            $this->tax->calculate($old_unit_raw, $product['tax_class_id'], $this->config->get('config_tax')),
                            $this->session->data['currency']
                        );
                    }
                }
            }

            $items[] = array(
                'product_id' => (int)$product['product_id'],
                'name'       => $product['name'],
                'name_add'   => !empty($product_info['name_add']) ? $product_info['name_add'] : '',
                'minimum'    => !empty($product_info['minimum']) ? (int)$product_info['minimum'] : 1,
                'cent'       => !empty($product_info['cent']) ? $product_info['cent'] : '',
                'sku'        => $product_sku,
                'price_raw'  => $price_raw,
                'price'      => $price_txt,
                'price_old'  => $price_old,
                'qiqo_discount_percent' => $qiqo_discount_percent,
                'qiqo_proforma_extra_percent' => $qiqo_proforma_extra_percent,
                'quantity'   => (int)$product['quantity'],
                'thumb'      => $thumb
            );
        }

        $json = array('items' => $items);
        $this->response->setOutput(json_encode($json));
    }
}
