<?php
class ControllerExtensionModuleQuickOrder extends Controller {

    // ---------- VIEW ----------
    public function index() {
        if (!$this->config->get('module_quick_order_status')) return;
        $this->load->language('extension/module/quick_order');
        $this->document->addScript('catalog/view/javascript/quick_order.js');

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

    // ---------- DATA: search ----------
    public function autocomplete() {
        $this->response->addHeader('Content-Type: application/json');
        $term = isset($this->request->get['term']) ? trim($this->request->get['term']) : '';
        if (utf8_strlen($term) < 2) {
            $this->response->setOutput(json_encode([]));
            return;
        }

        $this->load->model('catalog/product');
        $this->load->model('tool/image');

        $sql = "SELECT p.product_id 
                FROM " . DB_PREFIX . "product p 
                JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) 
                WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "'
                  AND p.status = 1
                  AND (pd.name LIKE '%" . $this->db->escape($term) . "%'
                    OR p.sku LIKE '%" . $this->db->escape($term) . "%'
                    OR p.model LIKE '%" . $this->db->escape($term) . "%')
                ORDER BY pd.name ASC
                LIMIT 15";
        $query = $this->db->query($sql);

        $results = [];
        foreach ($query->rows as $row) {
            $product_info = $this->model_catalog_product->getProduct((int)$row['product_id']);
            if (!$product_info) continue;

            $price_float = (float)$product_info['price'];
            $special_float = isset($product_info['special']) ? (float)$product_info['special'] : 0;
            $effective = $special_float > 0 ? $special_float : $price_float;

            $taxed = $this->tax->calculate($effective, $product_info['tax_class_id'], (bool)$this->config->get('config_tax'));

            $show_price = true;
            if ($this->config->get('config_customer_price') && !$this->customer->isLogged()) {
                $show_price = false;
            }

            $price_display = $show_price ? $this->currency->format($taxed, $this->session->data['currency']) : '';

            $thumb = $product_info['image'] ? $this->model_tool_image->resize($product_info['image'], 60, 60) : '';

            $results[] = [
                'product_id' => (int)$product_info['product_id'],
                'name'       => html_entity_decode($product_info['name'], ENT_QUOTES, 'UTF-8'),
                'model'      => $product_info['model'],
                'sku'        => $product_info['sku'],
                'price'      => $price_display,
                'price_raw'  => $show_price ? (float)$taxed : 0.0,
                'thumb'      => $thumb
            ];
        }

        $this->response->setOutput(json_encode($results));
    }

    // ---------- CART ops ----------
    public function fastAdd() {
        $this->response->addHeader('Content-Type: application/json');
        $product_id = (int)($this->request->post['product_id'] ?? 0);
        $qty        = (int)($this->request->post['quantity'] ?? 1);
        if ($qty < 1) $qty = 1;

        $resp = $this->addSingleProduct($product_id, $qty);
        $this->response->setOutput(json_encode($resp));
    }

    public function fastAddAll() {
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
        $this->response->addHeader('Content-Type: application/json');
        $this->cart->clear();
        $this->response->setOutput(json_encode(['success'=>true]));
    }

    // Update qty by product_id: remove all entries then add one with new qty (assumes no required options)
    public function updateQty() {
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

    // ---------- HELPERS ----------
    public function format() {
        $this->response->addHeader('Content-Type: application/json');
        $amount = (float)($this->request->post['amount'] ?? 0);
        $this->response->setOutput(json_encode([
            'formatted' => $this->currency->format($amount, $this->session->data['currency'])
        ]));
    }

    public function cartState() {
        $this->response->addHeader('Content-Type: application/json');
        $this->load->model('tool/image');

        // consolidate per product_id (no options assumed)
        $accum = [];
        foreach ($this->cart->getProducts() as $p) {
            $pid = (int)$p['product_id'];
            if (!isset($accum[$pid])) {
                $accum[$pid] = $p;
            } else {
                $accum[$pid]['quantity'] += $p['quantity'];
            }
        }

        $items = [];
        foreach ($accum as $p) {
            $thumb = isset($p['image']) && $p['image'] ? $this->model_tool_image->resize($p['image'], 60, 60) : '';

            $price_taxed = $this->tax->calculate($p['price'], $p['tax_class_id'], (bool)$this->config->get('config_tax'));
            $price_display = $this->currency->format($price_taxed, $this->session->data['currency']);

            $items[] = [
                'product_id' => (int)$p['product_id'],
                'name'       => html_entity_decode($p['name'], ENT_QUOTES, 'UTF-8'),
                'model'      => $p['model'],
                'sku'        => isset($p['sku']) ? $p['sku'] : '',
                'quantity'   => (int)$p['quantity'],
                'price'      => $price_display,
                'price_raw'  => (float)$price_taxed,
                'thumb'      => $thumb
            ];
        }

        $this->response->setOutput(json_encode(['items' => array_values($items)]));
    }
}
