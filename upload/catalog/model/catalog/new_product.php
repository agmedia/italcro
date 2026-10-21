<?php
require_once(DIR_SYSTEM . 'library/qiqo/new_product.php');

class ModelCatalogNewProduct extends Model {
    private $date_windows = array();

    public function getProducts($data = array()) {
        if ((int)$this->config->get('newlabel_status') <= 0) {
            return array();
        }

        $sql = "SELECT p.product_id, (SELECT AVG(r.rating) FROM " . DB_PREFIX . "review r WHERE r.product_id = p.product_id AND r.status = '1') AS rating
            FROM (" . $this->groupedQuery() . ") n
            INNER JOIN " . DB_PREFIX . "product p ON p.product_id = n.product_id
            INNER JOIN " . DB_PREFIX . "product_description pd ON pd.product_id = p.product_id AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "'";
        $sorts = array('pd.name', 'p.model', 'p.sort_order', 'rating');
        $sort = isset($data['sort']) && in_array($data['sort'], $sorts, true) ? $data['sort'] : 'n.added_at';
        $direction = isset($data['order']) && $data['order'] === 'ASC' ? 'ASC' : 'DESC';
        $sql .= " ORDER BY " . $sort . " " . $direction . ", p.product_id ASC";
        $sql .= " LIMIT " . max(0, (int)($data['start'] ?? 0)) . "," . max(1, (int)($data['limit'] ?? 20));

        $this->load->model('catalog/product');
        $products = array();
        foreach ($this->db->query($sql)->rows as $row) {
            $product = $this->model_catalog_product->getProduct($row['product_id']);
            if ($product) {
                $products[$row['product_id']] = $product;
            }
        }
        return $products;
    }

    public function getTotalProducts() {
        if ((int)$this->config->get('newlabel_status') <= 0) {
            return 0;
        }
        $query = $this->db->query("SELECT COUNT(*) AS total FROM (" . $this->groupedQuery() . ") n");
        return (int)$query->row['total'];
    }

    private function groupedQuery() {
        $days = (int)$this->config->get('newlabel_status');
        if (!isset($this->date_windows[$days])) {
            $this->date_windows[$days] = QiqoNewProduct::dateWindow($days);
        }
        [$cutoff, $now] = $this->date_windows[$days];
        return "SELECT MIN(p.product_id) AS product_id, MAX(p.date_added) AS added_at
            FROM " . DB_PREFIX . "product p
            INNER JOIN " . DB_PREFIX . "product_to_store p2s ON p2s.product_id = p.product_id
            INNER JOIN " . DB_PREFIX . "product_description pd ON pd.product_id = p.product_id AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "'
            WHERE p.status = '1' AND p.date_available <= NOW()
                AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'
                AND p.date_added >= '" . $this->db->escape($cutoff) . "'
                AND p.date_added <= '" . $this->db->escape($now) . "'
            GROUP BY NULLIF(TRIM(p.mpn), ''), CASE WHEN TRIM(COALESCE(p.mpn, '')) = '' THEN p.product_id ELSE NULL END";
    }
}
