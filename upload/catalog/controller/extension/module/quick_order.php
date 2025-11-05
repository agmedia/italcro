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

            $price_float   = (float)$product_info['price'];
            $special_float = isset($product_info['special']) ? (float)$product_info['special'] : 0;
            $effective     = $special_float > 0 ? $special_float : $price_float;

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

        $items = array();
        foreach ($this->cart->getProducts() as $product) {
            $product_info = $this->model_catalog_product->getProduct($product['product_id']);

            $thumb = '';
            if (!empty($product_info['image'])) {
                $thumb = $this->model_tool_image->resize($product_info['image'], 60, 60);
            }

            $price_raw = (float)$product['price'];
            $price_txt = $this->currency->format(
                $this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax')),
                $this->session->data['currency']
            );

            $items[] = array(
                'product_id' => (int)$product['product_id'],
                'name'       => $product['name'],
                'sku'        => isset($product_info['sku']) ? $product_info['sku'] : '', // KLJUČNO
                'price_raw'  => $price_raw,
                'price'      => $price_txt,
                'quantity'   => (int)$product['quantity'],
                'thumb'      => $thumb
            );
        }

        $json = array('items' => $items);
        $this->response->setOutput(json_encode($json));
    }
}
