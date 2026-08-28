<?php
require_once(DIR_SYSTEM . 'library/qiqo/pricing_resolver.php');

class ModelCatalogProduct extends Model {
	private $qiqo_base_tables_ready = null;
	private $qiqo_partner_article_table_ready = null;
	private $qiqo_action_price_table_ready = null;
	private $product_pak_column_ready = null;
	private $product_vpc_column_ready = null;
	private $product_jm_column_ready = null;
	private $product_pakkol_column_ready = null;

	public function updateViewed($product_id) {
		$this->db->query("UPDATE " . DB_PREFIX . "product SET viewed = (viewed + 1) WHERE product_id = '" . (int)$product_id . "'");
	}

    public function getProduct($product_id) {
        $query = $this->db->query("
        SELECT DISTINCT
            *,
            pd.name AS name,
            p.image,
            m.name AS manufacturer,
            (SELECT price FROM " . DB_PREFIX . "product_discount pd2 
                WHERE pd2.product_id = p.product_id 
                  AND pd2.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' 
                  AND pd2.quantity = '1' 
                  AND ((pd2.date_start = '0000-00-00' OR pd2.date_start < NOW()) 
                  AND (pd2.date_end = '0000-00-00' OR pd2.date_end > NOW()))
                ORDER BY pd2.priority ASC, pd2.price ASC LIMIT 1) AS discount,
            (SELECT price FROM " . DB_PREFIX . "product_special ps 
                WHERE ps.product_id = p.product_id 
                  AND ps.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' 
                  AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) 
                  AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW()))
                ORDER BY ps.priority ASC, ps.price ASC LIMIT 1) AS special,
            (SELECT points FROM " . DB_PREFIX . "product_reward pr 
                WHERE pr.product_id = p.product_id 
                  AND pr.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "') AS reward,
            (SELECT ss.name FROM " . DB_PREFIX . "stock_status ss 
                WHERE ss.stock_status_id = p.stock_status_id 
                  AND ss.language_id = '" . (int)$this->config->get('config_language_id') . "') AS stock_status,
            (SELECT wcd.unit FROM " . DB_PREFIX . "weight_class_description wcd 
                WHERE p.weight_class_id = wcd.weight_class_id 
                  AND wcd.language_id = '" . (int)$this->config->get('config_language_id') . "') AS weight_class,
            (SELECT lcd.unit FROM " . DB_PREFIX . "length_class_description lcd 
                WHERE p.length_class_id = lcd.length_class_id 
                  AND lcd.language_id = '" . (int)$this->config->get('config_language_id') . "') AS length_class,
            (SELECT AVG(rating) AS total FROM " . DB_PREFIX . "review r1 
                WHERE r1.product_id = p.product_id 
                  AND r1.status = '1' 
                GROUP BY r1.product_id) AS rating,
            (SELECT COUNT(*) AS total FROM " . DB_PREFIX . "review r2 
                WHERE r2.product_id = p.product_id 
                  AND r2.status = '1' 
                GROUP BY r2.product_id) AS reviews,
            (SELECT COUNT(*) FROM " . DB_PREFIX . "product p2 
                WHERE p2.mpn = p.mpn 
                  AND p2.status = '1' 
                  AND p2.date_available <= NOW()) AS mpn_count,
            p.sort_order
        FROM " . DB_PREFIX . "product p
        LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id)
        LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id)
        LEFT JOIN " . DB_PREFIX . "manufacturer m ON (p.manufacturer_id = m.manufacturer_id)
        WHERE p.product_id = '" . (int)$product_id . "'
          AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "'
          AND p.status = '1'
          AND p.date_available <= NOW()
          AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'
    ");


		if ($query->num_rows) {
			$jm = isset($query->row['jm']) && trim((string)$query->row['jm']) !== '' ? $query->row['jm'] : $query->row['ean'];
			$pakkol = isset($query->row['pakkol']) ? (float)$query->row['pakkol'] : 0.0;
			if ($pakkol <= 0) {
				$pakkol = isset($query->row['minimum']) ? (float)$query->row['minimum'] : 1.0;
			}
			if ($pakkol <= 0) {
				$pakkol = 1.0;
			}
			$pak = array_key_exists('pak', $query->row)
				? (int)$query->row['pak']
				: (((float)$query->row['minimum'] > 1 && strtoupper(trim((string)$jm)) !== 'MET') ? 1 : 0);

			return array(
				'product_id'       => $query->row['product_id'],
				'name'             => $query->row['name'],
                'name_add'             => $query->row['name_add'],
				'description'      => $query->row['description'],
                'description_add'      => $query->row['description_add'],
				'meta_title'       => $query->row['meta_title'],
				'meta_description' => $query->row['meta_description'],
				'meta_keyword'     => $query->row['meta_keyword'],
				'tag'              => $query->row['tag'],
				'model'            => $query->row['model'],
				'sku'              => $query->row['sku'],
				'upc'              => $query->row['upc'],
					'ean'              => $query->row['ean'],
					'jm'               => $jm,
					'jan'              => $query->row['jan'],
					'isbn'             => $query->row['isbn'],
					'mpn'              => $query->row['mpn'],
					'pak'              => $pak,
					'pakkol'           => $pakkol,
	                'mpn_count'        => (int)$query->row['mpn_count'], // <-- OVO NOVO
				'location'         => $query->row['location'],
                'cent'         => $query->row['cent'],
				'quantity'         => $query->row['quantity'],
				'stock_status'     => $query->row['stock_status'],
				'image'            => $query->row['image'],
				'manufacturer_id'  => $query->row['manufacturer_id'],
					'manufacturer'     => $query->row['manufacturer'],
					'vpc'              => isset($query->row['vpc']) ? (float)$query->row['vpc'] : 0.0,
					'base_price'        => $query->row['price'],
				'price'            => ($query->row['discount'] ? $query->row['discount'] : $query->row['price']),
				'special'          => $query->row['special'],
				'reward'           => $query->row['reward'],
				'points'           => $query->row['points'],
				'tax_class_id'     => $query->row['tax_class_id'],
				'date_available'   => $query->row['date_available'],
				'weight'           => $query->row['weight'],
				'weight_class_id'  => $query->row['weight_class_id'],
				'length'           => $query->row['length'],
				'width'            => $query->row['width'],
				'height'           => $query->row['height'],
				'length_class_id'  => $query->row['length_class_id'],
				'subtract'         => $query->row['subtract'],
				'rating'           => round($query->row['rating']),
				'reviews'          => $query->row['reviews'] ? $query->row['reviews'] : 0,
				'minimum'          => $query->row['minimum'],
				'sort_order'       => $query->row['sort_order'],
				'status'           => $query->row['status'],
				'date_added'       => $query->row['date_added'],
				'date_modified'    => $query->row['date_modified'],
				'viewed'           => $query->row['viewed']
			);
		} else {
			return false;
		}
	}

    public function getProducts($data = array()) {
		$sql = "SELECT p.product_id, (SELECT AVG(rating) AS total FROM " . DB_PREFIX . "review r1 WHERE r1.product_id = p.product_id AND r1.status = '1' GROUP BY r1.product_id) AS rating, (SELECT price FROM " . DB_PREFIX . "product_discount pd2 WHERE pd2.product_id = p.product_id AND pd2.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' AND pd2.quantity = '1' AND ((pd2.date_start = '0000-00-00' OR pd2.date_start < NOW()) AND (pd2.date_end = '0000-00-00' OR pd2.date_end > NOW())) ORDER BY pd2.priority ASC, pd2.price ASC LIMIT 1) AS discount, (SELECT price FROM " . DB_PREFIX . "product_special ps WHERE ps.product_id = p.product_id AND ps.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) ORDER BY ps.priority ASC, ps.price ASC LIMIT 1) AS special";

        if (!empty($data['filter_category_id'])) {
            if (!empty($data['filter_sub_category'])) {
				$sql .= " FROM " . DB_PREFIX . "category_path cp LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (cp.category_id = p2c.category_id)";
            } else {
                $sql .= " FROM " . DB_PREFIX . "product_to_category p2c";
            }

            if (!empty($data['filter_filter'])) {
				$sql .= " LEFT JOIN " . DB_PREFIX . "product_filter pf ON (p2c.product_id = pf.product_id) LEFT JOIN " . DB_PREFIX . "product p ON (pf.product_id = p.product_id)";
            } else {
				$sql .= " LEFT JOIN " . DB_PREFIX . "product p ON (p2c.product_id = p.product_id)";
            }
        } else {
            $sql .= " FROM " . DB_PREFIX . "product p";
        }

		$sql .= " LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'";

        if (!empty($data['filter_category_id'])) {
            if (!empty($data['filter_sub_category'])) {
                $sql .= " AND cp.path_id = '" . (int)$data['filter_category_id'] . "'";
            } else {
                $sql .= " AND p2c.category_id = '" . (int)$data['filter_category_id'] . "'";
            }

            if (!empty($data['filter_filter'])) {
                $implode = array();

                $filters = explode(',', $data['filter_filter']);

                foreach ($filters as $filter_id) {
                    $implode[] = (int)$filter_id;
                }

                $sql .= " AND pf.filter_id IN (" . implode(',', $implode) . ")";
            }
        }

        if (!empty($data['filter_name']) || !empty($data['filter_tag'])) {
            $sql .= " AND (";

            if (!empty($data['filter_name'])) {
                $implode = array();

                $words = explode(' ', trim(preg_replace('/\s+/', ' ', $data['filter_name'])));

                foreach ($words as $word) {
                    $implode[] = "pd.name LIKE '%" . $this->db->escape($word) . "%'";
                }

                if ($implode) {
					$sql .= " " . implode(" AND ", $implode) . "";
                }

                if (!empty($data['filter_description'])) {
                    $sql .= " OR pd.description LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
                }
            }

            if (!empty($data['filter_name']) && !empty($data['filter_tag'])) {
                $sql .= " OR ";
            }

            if (!empty($data['filter_tag'])) {
                $implode = array();

                $words = explode(' ', trim(preg_replace('/\s+/', ' ', $data['filter_tag'])));

                foreach ($words as $word) {
                    $implode[] = "pd.tag LIKE '%" . $this->db->escape($word) . "%'";
                }

                if ($implode) {
					$sql .= " " . implode(" AND ", $implode) . "";
                }
            }

            if (!empty($data['filter_name'])) {
                $sql .= " OR LCASE(p.model) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
                $sql .= " OR LCASE(p.sku) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
                $sql .= " OR LCASE(p.upc) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
                $sql .= " OR LCASE(p.ean) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
                $sql .= " OR LCASE(p.jan) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
                $sql .= " OR LCASE(p.isbn) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
                $sql .= " OR LCASE(p.mpn) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
            }

            $sql .= ")";
        }

        if (!empty($data['filter_manufacturer_id'])) {
            $sql .= " AND p.manufacturer_id = '" . (int)$data['filter_manufacturer_id'] . "'";
        }

        $sql .= " GROUP BY p.product_id";

        $sort_data = array(
            'pd.name',
            'p.model',
            'p.quantity',
            'p.price',
            'rating',
            'p.sort_order',
            'p.date_added'
        );

        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            if ($data['sort'] == 'pd.name' || $data['sort'] == 'p.model') {
                $sql .= " ORDER BY LCASE(" . $data['sort'] . ")";
            } elseif ($data['sort'] == 'p.price') {
                $sql .= " ORDER BY (CASE WHEN special IS NOT NULL THEN special WHEN discount IS NOT NULL THEN discount ELSE p.price END)";
            } else {
                $sql .= " ORDER BY " . $data['sort'];
            }
        } else {

            // DEFAULT sort: numeric UPC filename only
            $base_sql   = "SUBSTRING_INDEX(SUBSTRING_INDEX(p.upc, '/', -1), '.', 1)";
            $num_sql    = "CASE
                      WHEN $base_sql REGEXP '^[0-9]+$' THEN CAST($base_sql AS UNSIGNED)
                      ELSE 999999999999999999
                   END";

            $sql .= " ORDER BY " . $num_sql;
        }

        if (isset($data['order']) && ($data['order'] == 'DESC')) {
            $sql .= " DESC, LCASE(pd.name) DESC";
        } else {
            $sql .= " ASC, LCASE(pd.name) ASC";
        }

        if (isset($data['start']) || isset($data['limit'])) {
            if ($data['start'] < 0) {
                $data['start'] = 0;
            }

            if ($data['limit'] < 1) {
                $data['limit'] = 20;
            }

            $sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
        }

        $product_data = array();

        $query = $this->db->query($sql);

        foreach ($query->rows as $result) {
            $product_data[$result['product_id']] = $this->getProduct($result['product_id']);
        }

        return $product_data;
    }

    public function getProductSpecials($data = array()) {
        if ($this->hasQiqoActionPriceTable()) {
            return $this->getQiqoActionProducts($data);
        }

		$sql = "SELECT DISTINCT ps.product_id, (SELECT AVG(rating) FROM " . DB_PREFIX . "review r1 WHERE r1.product_id = ps.product_id AND r1.status = '1' GROUP BY r1.product_id) AS rating FROM " . DB_PREFIX . "product_special ps LEFT JOIN " . DB_PREFIX . "product p ON (ps.product_id = p.product_id) LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) WHERE p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND ps.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) GROUP BY ps.product_id";

		$sort_data = array(
			'pd.name',
			'p.model',
			'ps.price',
			'rating',
			'p.sort_order'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			if ($data['sort'] == 'pd.name' || $data['sort'] == 'p.model') {
				$sql .= " ORDER BY LCASE(" . $data['sort'] . ")";
			} else {
				$sql .= " ORDER BY " . $data['sort'];
			}
		} else {
			$sql .= " ORDER BY p.sort_order";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC, LCASE(pd.name) DESC";
		} else {
			$sql .= " ASC, LCASE(pd.name) ASC";
		}

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$product_data = array();

		$query = $this->db->query($sql);

		foreach ($query->rows as $result) {
			$product_data[$result['product_id']] = $this->getProduct($result['product_id']);
		}

		return $product_data;
	}

	private function getQiqoActionProducts($data = array()) {
			$sql = "SELECT p.product_id, (SELECT AVG(rating) FROM " . DB_PREFIX . "review r1 WHERE r1.product_id = p.product_id AND r1.status = '1' GROUP BY r1.product_id) AS rating, p.price AS qiqo_sort_price FROM " . DB_PREFIX . "product p INNER JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) INNER JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) INNER JOIN `" . DB_PREFIX . "qiqo_action_price` qap ON (qap.article_code = p.sku) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND UPPER(qap.indicator) <> 'X' GROUP BY p.product_id";

		$sort_data = array(
			'pd.name',
			'p.model',
			'ps.price',
			'p.price',
			'rating',
			'p.sort_order'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			if ($data['sort'] == 'pd.name' || $data['sort'] == 'p.model') {
				$sql .= " ORDER BY LCASE(" . $data['sort'] . ")";
			} elseif ($data['sort'] == 'ps.price' || $data['sort'] == 'p.price') {
				$sql .= " ORDER BY qiqo_sort_price";
			} else {
				$sql .= " ORDER BY " . $data['sort'];
			}
		} else {
			$sql .= " ORDER BY p.sort_order";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC, LCASE(pd.name) DESC";
		} else {
			$sql .= " ASC, LCASE(pd.name) ASC";
		}

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$product_data = array();

		$query = $this->db->query($sql);

		foreach ($query->rows as $result) {
			$product_data[$result['product_id']] = $this->getProduct($result['product_id']);
		}

		return $product_data;
	}

    public function getLatestProducts($limit) {
        $cache_key = 'product.latest.'
            . (int)$this->config->get('config_language_id') . '.'
            . (int)$this->config->get('config_store_id') . '.'
            . $this->config->get('config_customer_group_id') . '.'
            . (int)$limit;

        $product_data = $this->cache->get($cache_key);

        if (!$product_data) {

            // PRVO: uzmi sve proizvode
            $query = $this->db->query("
            SELECT p.product_id, p.mpn 
            FROM " . DB_PREFIX . "product p 
            LEFT JOIN " . DB_PREFIX . "product_to_store p2s 
                ON (p.product_id = p2s.product_id) 
            WHERE 
                p.status = '1' 
                AND p.date_available <= NOW() 
                AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'
            ORDER BY p.date_added DESC
            LIMIT " . (int)$limit
            );

            // DRUGO: grupiraj po MPN
            $grouped = [];

            foreach ($query->rows as $row) {

                // ključevi bez MPN-a da se ne spoje krivi proizvodi
                $mpn_key = ($row['mpn'] !== '') ? $row['mpn'] : ('no_mpn_' . $row['product_id']);

                if (!isset($grouped[$mpn_key])) {
                    $grouped[$mpn_key] = [
                        'product_id' => $row['product_id'],
                        'mpn'        => $row['mpn'],
                        'mpn_count'  => 1
                    ];
                } else {
                    $grouped[$mpn_key]['mpn_count']++;
                }
            }

            // TREĆE: spremi finalne proizvode
            $product_data = [];

            foreach ($grouped as $g) {
                $product = $this->getProduct($g['product_id']);

                // ubaci mpn_count u product array
             //   $product['mpn_count'] = $g['mpn_count'];

                $product_data[$g['product_id']] = $product;
            }

            $this->cache->set($cache_key, $product_data);
        }

        return $product_data;
    }


    public function getPopularProducts($limit) {
		$product_data = $this->cache->get('product.popular.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . $this->config->get('config_customer_group_id') . '.' . (int)$limit);
	
		if (!$product_data) {
			$query = $this->db->query("SELECT p.product_id FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) WHERE p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' ORDER BY p.viewed DESC, p.date_added DESC LIMIT " . (int)$limit);
	
			foreach ($query->rows as $result) {
				$product_data[$result['product_id']] = $this->getProduct($result['product_id']);
			}
			
			$this->cache->set('product.popular.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . $this->config->get('config_customer_group_id') . '.' . (int)$limit, $product_data);
		}
		
		return $product_data;
	}

	public function getBestSellerProducts($limit) {
		$product_data = $this->cache->get('product.bestseller.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . $this->config->get('config_customer_group_id') . '.' . (int)$limit);

		if (!$product_data) {
			$product_data = array();

			$query = $this->db->query("SELECT op.product_id, SUM(op.quantity) AS total FROM " . DB_PREFIX . "order_product op LEFT JOIN `" . DB_PREFIX . "order` o ON (op.order_id = o.order_id) LEFT JOIN `" . DB_PREFIX . "product` p ON (op.product_id = p.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) WHERE o.order_status_id > '0' AND p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' GROUP BY op.product_id ORDER BY total DESC LIMIT " . (int)$limit);

			foreach ($query->rows as $result) {
				$product_data[$result['product_id']] = $this->getProduct($result['product_id']);
			}

			$this->cache->set('product.bestseller.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . $this->config->get('config_customer_group_id') . '.' . (int)$limit, $product_data);
		}

		return $product_data;
	}

	public function getProductAttributes($product_id) {
		$product_attribute_group_data = array();

		$product_attribute_group_query = $this->db->query("SELECT ag.attribute_group_id, agd.name FROM " . DB_PREFIX . "product_attribute pa LEFT JOIN " . DB_PREFIX . "attribute a ON (pa.attribute_id = a.attribute_id) LEFT JOIN " . DB_PREFIX . "attribute_group ag ON (a.attribute_group_id = ag.attribute_group_id) LEFT JOIN " . DB_PREFIX . "attribute_group_description agd ON (ag.attribute_group_id = agd.attribute_group_id) WHERE pa.product_id = '" . (int)$product_id . "' AND agd.language_id = '" . (int)$this->config->get('config_language_id') . "' GROUP BY ag.attribute_group_id ORDER BY ag.sort_order, agd.name");

		foreach ($product_attribute_group_query->rows as $product_attribute_group) {
			$product_attribute_data = array();

			$product_attribute_query = $this->db->query("SELECT a.attribute_id, a.featured,  ad.name, pa.text FROM " . DB_PREFIX . "product_attribute pa LEFT JOIN " . DB_PREFIX . "attribute a ON (pa.attribute_id = a.attribute_id) LEFT JOIN " . DB_PREFIX . "attribute_description ad ON (a.attribute_id = ad.attribute_id) WHERE pa.product_id = '" . (int)$product_id . "' AND a.attribute_group_id = '" . (int)$product_attribute_group['attribute_group_id'] . "' AND ad.language_id = '" . (int)$this->config->get('config_language_id') . "' AND pa.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY a.sort_order, ad.name");

			foreach ($product_attribute_query->rows as $product_attribute) {
				$product_attribute_data[] = array(
					'attribute_id' => $product_attribute['attribute_id'],
					'featured' => $product_attribute['featured'],
					'name'         => $product_attribute['name'],
					'text'         => $product_attribute['text']
				);
			}

			$product_attribute_group_data[] = array(
				'attribute_group_id' => $product_attribute_group['attribute_group_id'],
				'name'               => $product_attribute_group['name'],
				'attribute'          => $product_attribute_data
			);
		}

		return $product_attribute_group_data;
	}

	public function getProductOptions($product_id) {
		$product_option_data = array();

		$product_option_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_option po LEFT JOIN `" . DB_PREFIX . "option` o ON (po.option_id = o.option_id) LEFT JOIN " . DB_PREFIX . "option_description od ON (o.option_id = od.option_id) WHERE po.product_id = '" . (int)$product_id . "' AND od.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY o.sort_order");

		foreach ($product_option_query->rows as $product_option) {
			$product_option_value_data = array();

			$product_option_value_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_option_value pov LEFT JOIN " . DB_PREFIX . "option_value ov ON (pov.option_value_id = ov.option_value_id) LEFT JOIN " . DB_PREFIX . "option_value_description ovd ON (ov.option_value_id = ovd.option_value_id) WHERE pov.product_id = '" . (int)$product_id . "' AND pov.product_option_id = '" . (int)$product_option['product_option_id'] . "' AND ovd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY ov.sort_order");

			foreach ($product_option_value_query->rows as $product_option_value) {
				$product_option_value_data[] = array(
					'product_option_value_id' => $product_option_value['product_option_value_id'],
					'option_value_id'         => $product_option_value['option_value_id'],
					'name'                    => $product_option_value['name'],
					'image'                   => $product_option_value['image'],
					'quantity'                => $product_option_value['quantity'],
					'subtract'                => $product_option_value['subtract'],
					'price'                   => $product_option_value['price'],
                    'color'                   => $product_option_value['color'],
					'price_prefix'            => $product_option_value['price_prefix'],
					'weight'                  => $product_option_value['weight'],
					'weight_prefix'           => $product_option_value['weight_prefix']
				);
			}

			$product_option_data[] = array(
				'product_option_id'    => $product_option['product_option_id'],
				'product_option_value' => $product_option_value_data,
				'option_id'            => $product_option['option_id'],
				'name'                 => $product_option['name'],
				'type'                 => $product_option['type'],
				'value'                => $product_option['value'],
				'required'             => $product_option['required']
			);
		}

		return $product_option_data;
	}

	public function getProductDiscounts($product_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_discount WHERE product_id = '" . (int)$product_id . "' AND customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' AND quantity > 1 AND ((date_start = '0000-00-00' OR date_start < NOW()) AND (date_end = '0000-00-00' OR date_end > NOW())) ORDER BY quantity ASC, priority ASC, price ASC");

		return $query->rows;
	}

	public function getProductImages($product_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_image WHERE product_id = '" . (int)$product_id . "' ORDER BY sort_order ASC");

		return $query->rows;
	}

    public function getProductRelated($product_id) {
		$product_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_related pr LEFT JOIN " . DB_PREFIX . "product p ON (pr.related_id = p.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) WHERE pr.product_id = '" . (int)$product_id . "' AND p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'");

        if ($query->num_rows) {
            foreach ($query->rows as $result) {
                $product_data[$result['related_id']] = $this->getProduct($result['related_id']);
            }

        } else {
           /* $getCat = $this->db->query("SELECT product_id, min(category_id) as category_id FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . (int)$product_id . "' AND category_id not in (SELECT distinct parent_id as category_id FROM oc_category)");
            $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_category WHERE category_id = '" . (int)$getCat->row['category_id'] . "' AND product_id != '" . (int)$product_id . "'  LIMIT 0,5");*/

            $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_category p2c LEFT JOIN " . DB_PREFIX . "product p ON (p2c.product_id = p.product_id) WHERE p2c.category_id IN (SELECT category_id FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . (int)$product_id . "') AND p.product_id != '" . (int)$product_id . "' AND p.status = '1' AND p.date_available <= NOW()  ORDER BY RAND() LIMIT 0, 8");

            foreach ($query->rows as $result) {
                //$product_data[$result['related_id']] = $this->getProduct($result['related_id']);
                $product_data[$result['product_id']] = $this->getProduct($result['product_id']);


            }
        }

		return $product_data;
	}

	public function getProductLayoutId($product_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_layout WHERE product_id = '" . (int)$product_id . "' AND store_id = '" . (int)$this->config->get('config_store_id') . "'");

		if ($query->num_rows) {
			return (int)$query->row['layout_id'];
		} else {
			return 0;
		}
	}

	public function getCategories($product_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . (int)$product_id . "'");

		return $query->rows;
	}

	public function getTotalProducts($data = array()) {
		$sql = "SELECT COUNT(DISTINCT p.product_id) AS total";

		if (!empty($data['filter_category_id'])) {
			if (!empty($data['filter_sub_category'])) {
				$sql .= " FROM " . DB_PREFIX . "category_path cp LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (cp.category_id = p2c.category_id)";
			} else {
				$sql .= " FROM " . DB_PREFIX . "product_to_category p2c";
			}

			if (!empty($data['filter_filter'])) {
				$sql .= " LEFT JOIN " . DB_PREFIX . "product_filter pf ON (p2c.product_id = pf.product_id) LEFT JOIN " . DB_PREFIX . "product p ON (pf.product_id = p.product_id)";
			} else {
				$sql .= " LEFT JOIN " . DB_PREFIX . "product p ON (p2c.product_id = p.product_id)";
			}
		} else {
			$sql .= " FROM " . DB_PREFIX . "product p";
		}

		$sql .= " LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'";

		if (!empty($data['filter_category_id'])) {
			if (!empty($data['filter_sub_category'])) {
				$sql .= " AND cp.path_id = '" . (int)$data['filter_category_id'] . "'";
			} else {
				$sql .= " AND p2c.category_id = '" . (int)$data['filter_category_id'] . "'";
			}

			if (!empty($data['filter_filter'])) {
				$implode = array();

				$filters = explode(',', $data['filter_filter']);

				foreach ($filters as $filter_id) {
					$implode[] = (int)$filter_id;
				}

				$sql .= " AND pf.filter_id IN (" . implode(',', $implode) . ")";
			}
		}

		if (!empty($data['filter_name']) || !empty($data['filter_tag'])) {
			$sql .= " AND (";

			if (!empty($data['filter_name'])) {
				$implode = array();

				$words = explode(' ', trim(preg_replace('/\s+/', ' ', $data['filter_name'])));

				foreach ($words as $word) {
					$implode[] = "pd.name LIKE '%" . $this->db->escape($word) . "%'";
				}

				if ($implode) {
					$sql .= " " . implode(" AND ", $implode) . "";
				}

				if (!empty($data['filter_description'])) {
					$sql .= " OR pd.description LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
				}
			}

			if (!empty($data['filter_name']) && !empty($data['filter_tag'])) {
				$sql .= " OR ";
			}

			if (!empty($data['filter_tag'])) {
				$implode = array();

				$words = explode(' ', trim(preg_replace('/\s+/', ' ', $data['filter_tag'])));

				foreach ($words as $word) {
					$implode[] = "pd.tag LIKE '%" . $this->db->escape($word) . "%'";
				}

				if ($implode) {
					$sql .= " " . implode(" AND ", $implode) . "";
				}
			}

			if (!empty($data['filter_name'])) {
				$sql .= " OR LCASE(p.model) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(p.sku) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(p.upc) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(p.ean) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(p.jan) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(p.isbn) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(p.mpn) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
			}

			$sql .= ")";
		}

		if (!empty($data['filter_manufacturer_id'])) {
			$sql .= " AND p.manufacturer_id = '" . (int)$data['filter_manufacturer_id'] . "'";
		}

		$query = $this->db->query($sql);

		return $query->row['total'];
	}

	public function getProfile($product_id, $recurring_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "recurring r JOIN " . DB_PREFIX . "product_recurring pr ON (pr.recurring_id = r.recurring_id AND pr.product_id = '" . (int)$product_id . "') WHERE pr.recurring_id = '" . (int)$recurring_id . "' AND status = '1' AND pr.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "'");

		return $query->row;
	}

	public function getProfiles($product_id) {
		$query = $this->db->query("SELECT rd.* FROM " . DB_PREFIX . "product_recurring pr JOIN " . DB_PREFIX . "recurring_description rd ON (rd.language_id = " . (int)$this->config->get('config_language_id') . " AND rd.recurring_id = pr.recurring_id) JOIN " . DB_PREFIX . "recurring r ON r.recurring_id = rd.recurring_id WHERE pr.product_id = " . (int)$product_id . " AND status = '1' AND pr.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' ORDER BY sort_order ASC");

		return $query->rows;
	}

	public function getTotalProductSpecials() {
        if ($this->hasQiqoActionPriceTable()) {
            $query = $this->db->query("SELECT COUNT(DISTINCT p.product_id) AS total FROM " . DB_PREFIX . "product p INNER JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) INNER JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) INNER JOIN `" . DB_PREFIX . "qiqo_action_price` qap ON (qap.article_code = p.sku) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND UPPER(qap.indicator) <> 'X'");

            if (isset($query->row['total'])) {
                return $query->row['total'];
            }

            return 0;
        }

		$query = $this->db->query("SELECT COUNT(DISTINCT ps.product_id) AS total FROM " . DB_PREFIX . "product_special ps LEFT JOIN " . DB_PREFIX . "product p ON (ps.product_id = p.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) WHERE p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND ps.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW()))");

		if (isset($query->row['total'])) {
			return $query->row['total'];
		} else {
			return 0;
		}
	}

	public function checkProductCategory($product_id, $category_ids) {
		
		$implode = array();

		foreach ($category_ids as $category_id) {
			$implode[] = (int)$category_id;
		}
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . (int)$product_id . "' AND category_id IN(" . implode(',', $implode) . ")");
  	    return $query->row;
	}

    public function getProductsByMPN($mpn, $exclude_product_id = 0) {
        if (!$mpn) return [];

	        $store_id = (int)$this->config->get('config_store_id');
	        $lang_id  = (int)$this->config->get('config_language_id');
	        $customer_group_id = (int)$this->config->get('config_customer_group_id');
	        $has_jm_column = $this->hasProductJmColumn();
	        $unit_expr = $has_jm_column ? "COALESCE(NULLIF(p.jm, ''), p.ean)" : "p.ean";
	        $pak_select = $this->hasProductPakColumn() ? "p.pak," : "CASE WHEN p.minimum > 1 AND UPPER(TRIM(" . $unit_expr . ")) <> 'MET' THEN 1 ELSE 0 END AS pak,";
	        $vpc_select = $this->hasProductVpcColumn() ? "p.vpc," : "0 AS vpc,";
	        $jm_select = $has_jm_column ? "p.jm," : "'' AS jm,";
	        $pakkol_select = $this->hasProductPakkolColumn() ? "p.pakkol," : "0 AS pakkol,";

        // Special (akcijska) cijena po productu (ako postoji i u datumu)
        $sql = "
        SELECT
            p.product_id,
            p.model,
            p.sku,
	            p.ean,
	            " . $jm_select . "
	            p.mpn,
	            " . $pak_select . "
	            " . $pakkol_select . "
	            p.cent,
            p.quantity,
            p.minimum,
	            p.sort_order,
	            p.price,
	            " . $vpc_select . "
	            p.tax_class_id,
            pd.name,
            pd.description,
            pd.name_add,
            pd.description_add,

            (
                SELECT ps.price
                FROM " . DB_PREFIX . "product_special ps
                WHERE ps.product_id = p.product_id
                  AND ps.customer_group_id = " . $customer_group_id . "
                  AND (ps.date_start = '0000-00-00' OR ps.date_start <= NOW())
                  AND (ps.date_end   = '0000-00-00' OR ps.date_end   >= NOW())
                ORDER BY ps.priority ASC, ps.price ASC
                LIMIT 1
            ) AS special

        FROM " . DB_PREFIX . "product p
        INNER JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id)
        INNER JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id)

        WHERE p.mpn = '" . $this->db->escape($mpn) . "'
          AND p.status = '1'
          AND p.date_available <= NOW()
          AND p2s.store_id = " . $store_id . "
          AND pd.language_id = " . $lang_id . "
    ";

        if ($exclude_product_id) {
            $sql .= " AND p.product_id <> " . (int)$exclude_product_id . " ";
        }

        $sql .= " ORDER BY p.sort_order ASC, pd.name ASC";

        $query = $this->db->query($sql);

        // Vrati kao array po product_id (kao što si imao)
        $products = [];
        foreach ($query->rows as $row) {
            $products[(int)$row['product_id']] = $row;
        }

        return $products;
    }

	public function getQiqoPricingMap($customer_id, $sku_quantities = array(), $base_unit_prices = array(), $is_proforma = false, $include_action_discount = false) {
		$map = array();
		$customer_id = (int)$customer_id;

		if (!$customer_id || !$sku_quantities || !$this->hasQiqoBasePricingTables()) {
			return $map;
		}

		$authorization = $this->getCustomerQiqoAuthorization($customer_id);

		if (!$authorization || empty($authorization['partner_id'])) {
			return $map;
		}

		$partner_id = (int)$authorization['partner_id'];
		$partner_discount = isset($authorization['partner_discount']) ? (float)$authorization['partner_discount'] : 0.0;

		$sku_list = array();
		foreach ($sku_quantities as $sku => $qty) {
			$sku = trim((string)$sku);
			if ($sku !== '') {
				$sku_list[] = $sku;
			}
		}

		$sku_list = array_values(array_unique($sku_list));

		if (!$sku_list) {
			return $map;
		}

		$in = $this->buildEscapedInList($sku_list);

		$article_discounts = array();
		if ($this->hasQiqoPartnerArticleDiscountTable()) {
			$article_q = $this->db->query("SELECT article_code, discount
				FROM `" . DB_PREFIX . "qiqo_partner_article_discount`
				WHERE partner_id = '" . $partner_id . "'
				  AND article_code IN (" . $in . ")");

			foreach ($article_q->rows as $row) {
				$article_discounts[(string)$row['article_code']] = (float)$row['discount'];
			}
		}

		$action_rows_by_article = array();
		$product_cents = array();
		if ($include_action_discount && $this->hasQiqoActionPriceTable()) {
			$action_q = $this->db->query("SELECT article_code, indicator, quantity, price, discount
				FROM `" . DB_PREFIX . "qiqo_action_price`
				WHERE article_code IN (" . $in . ")");

			foreach ($action_q->rows as $row) {
				$code = (string)$row['article_code'];

				if (!isset($action_rows_by_article[$code])) {
					$action_rows_by_article[$code] = array();
				}

				$action_rows_by_article[$code][] = array(
					'indicator' => strtoupper(trim((string)$row['indicator'])),
					'quantity'  => (float)$row['quantity'],
					'price'     => (float)$row['price'],
					'discount'  => (float)$row['discount']
				);
			}

			$cent_q = $this->db->query("SELECT sku, cent
				FROM `" . DB_PREFIX . "product`
				WHERE sku IN (" . $in . ")");
			foreach ($cent_q->rows as $row) {
				$product_cents[(string)$row['sku']] = (string)$row['cent'];
			}
		}

		foreach ($sku_list as $sku) {
			$qty = isset($sku_quantities[$sku]) ? (float)$sku_quantities[$sku] : 1.0;
			if ($qty <= 0) {
				$qty = 1.0;
			}

			$base_unit = isset($base_unit_prices[$sku]) ? (float)$base_unit_prices[$sku] : 0.0;
			if ($base_unit <= 0) {
				continue;
			}

			$has_article_discount = array_key_exists($sku, $article_discounts);
			$base_discount = $has_article_discount ? (float)$article_discounts[$sku] : $partner_discount;
			$base_source = $has_article_discount ? 'article' : 'partner';

			$map[$sku] = QiqoPricingResolver::resolve(
				$base_unit,
				$base_discount,
				$base_source,
				isset($action_rows_by_article[$sku]) ? $action_rows_by_article[$sku] : array(),
				$qty,
				$include_action_discount,
				$is_proforma,
				isset($product_cents[$sku]) ? $product_cents[$sku] : ''
			);
		}

		return $map;
	}

	public function getQiqoActionArticleMap($sku_list = array()) {
		$map = array();

		if (!$sku_list || !$this->hasQiqoActionPriceTable()) {
			return $map;
		}

		$clean = array();
		foreach ($sku_list as $sku) {
			$sku = trim((string)$sku);
			if ($sku !== '') {
				$clean[] = $sku;
			}
		}

		$clean = array_values(array_unique($clean));
		if (!$clean) {
			return $map;
		}

		$in = $this->buildEscapedInList($clean);

		$query = $this->db->query("SELECT DISTINCT article_code
			FROM `" . DB_PREFIX . "qiqo_action_price`
			WHERE article_code IN (" . $in . ")
			  AND UPPER(indicator) <> 'X'");

		foreach ($query->rows as $row) {
			$map[(string)$row['article_code']] = true;
		}

		return $map;
	}

	public function getQiqoActionDetailsMap($sku_list = array()) {
		$map = array();

		if (!$sku_list || !$this->hasQiqoActionPriceTable()) {
			return $map;
		}

		$clean = array();
		foreach ($sku_list as $sku) {
			$sku = trim((string)$sku);
			if ($sku !== '') {
				$clean[] = $sku;
			}
		}

		$clean = array_values(array_unique($clean));
		if (!$clean) {
			return $map;
		}

		$in = $this->buildEscapedInList($clean);

		$query = $this->db->query("SELECT article_code, indicator, quantity, price, discount
			FROM `" . DB_PREFIX . "qiqo_action_price`
			WHERE article_code IN (" . $in . ")
			  AND UPPER(indicator) <> 'X'
			ORDER BY article_code ASC, indicator ASC, quantity ASC");

		foreach ($query->rows as $row) {
			$code = (string)$row['article_code'];

			if (!isset($map[$code])) {
				$map[$code] = array();
			}

			$map[$code][] = array(
				'indicator' => strtoupper(trim((string)$row['indicator'])),
				'quantity'  => (float)$row['quantity'],
				'price'     => (float)$row['price'],
				'discount'  => (float)$row['discount']
			);
		}

		return $map;
	}

	public function getQiqoActionMpnMap($mpn_list = array()) {
		$map = array();

		if (!$mpn_list || !$this->hasQiqoActionPriceTable()) {
			return $map;
		}

		$clean = array();
		foreach ($mpn_list as $mpn) {
			$mpn = trim((string)$mpn);
			if ($mpn !== '') {
				$clean[] = $mpn;
			}
		}

		$clean = array_values(array_unique($clean));
		if (!$clean) {
			return $map;
		}

		$in = $this->buildEscapedInList($clean);

		$query = $this->db->query("SELECT DISTINCT p.mpn
			FROM `" . DB_PREFIX . "product` p
			INNER JOIN `" . DB_PREFIX . "qiqo_action_price` qap ON (qap.article_code = p.sku)
			INNER JOIN `" . DB_PREFIX . "product_to_store` p2s ON (p.product_id = p2s.product_id)
			WHERE p.mpn IN (" . $in . ")
			  AND UPPER(qap.indicator) <> 'X'
			  AND p.status = '1'
			  AND p.date_available <= NOW()
			  AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'");

		foreach ($query->rows as $row) {
			$map[(string)$row['mpn']] = true;
		}

		return $map;
	}

	public function getCustomerQiqoAuthorization($customer_id) {
		$customer_id = (int)$customer_id;

		if (!$customer_id || !$this->hasQiqoBasePricingTables()) {
			return array();
		}

		$query = $this->db->query("SELECT cqa.partner_id,
					cqa.partner_discount,
					qp.base_discount,
					qp.active AS partner_active
			FROM `" . DB_PREFIX . "customer_qiqo_authorization` cqa
			LEFT JOIN `" . DB_PREFIX . "qiqo_partner` qp ON (qp.partner_id = cqa.partner_id)
			WHERE cqa.customer_id = '" . $customer_id . "'
			LIMIT 1");

		if (!$query->num_rows || empty($query->row['partner_active'])) {
			return array();
		}

			// The authorization row identifies the ERP partner; the current partner
			// rebate remains owned by qPartnerWeb and must not become a stale/manual
			// snapshot after approval.
			$partner_discount = isset($query->row['base_discount']) && $query->row['base_discount'] !== null
				? (float)$query->row['base_discount']
				: (isset($query->row['partner_discount']) ? (float)$query->row['partner_discount'] : 0.0);

		return array(
			'partner_id'       => (int)$query->row['partner_id'],
			'partner_discount' => $partner_discount
		);
	}

	public function getQiqoProformaExtraDiscountMap($sku_list = array()) {
		$map = array();

		if (!$sku_list || !$this->hasQiqoActionPriceTable()) {
			return $map;
		}

		$clean = array();
		foreach ($sku_list as $sku) {
			$sku = trim((string)$sku);
			if ($sku !== '') {
				$clean[] = $sku;
			}
		}

		$clean = array_values(array_unique($clean));
		if (!$clean) {
			return $map;
		}

		$in = $this->buildEscapedInList($clean);

		$query = $this->db->query("SELECT article_code, MAX(discount) AS extra_discount
			FROM `" . DB_PREFIX . "qiqo_action_price`
			WHERE indicator = 'X'
			  AND article_code IN (" . $in . ")
			GROUP BY article_code");

		foreach ($query->rows as $row) {
			$map[(string)$row['article_code']] = (float)$row['extra_discount'];
		}

		return $map;
	}

	private function buildEscapedInList($values) {
		$escaped = array();

		foreach ($values as $value) {
			$escaped[] = "'" . $this->db->escape((string)$value) . "'";
		}

		return implode(',', $escaped);
	}

	private function hasQiqoBasePricingTables() {
		if ($this->qiqo_base_tables_ready !== null) {
			return $this->qiqo_base_tables_ready;
		}

		$required = array(
			DB_PREFIX . 'customer_qiqo_authorization',
			DB_PREFIX . 'qiqo_partner'
		);

		foreach ($required as $table) {
			$q = $this->db->query("SHOW TABLES LIKE '" . $this->db->escape($table) . "'");
			if (!$q->num_rows) {
				$this->qiqo_base_tables_ready = false;
				return $this->qiqo_base_tables_ready;
			}
		}

		$this->qiqo_base_tables_ready = true;
		return $this->qiqo_base_tables_ready;
	}

	private function hasQiqoPartnerArticleDiscountTable() {
		if ($this->qiqo_partner_article_table_ready !== null) {
			return $this->qiqo_partner_article_table_ready;
		}

		$q = $this->db->query("SHOW TABLES LIKE '" . $this->db->escape(DB_PREFIX . 'qiqo_partner_article_discount') . "'");
		$this->qiqo_partner_article_table_ready = (bool)$q->num_rows;

		return $this->qiqo_partner_article_table_ready;
	}

	private function hasQiqoActionPriceTable() {
		if ($this->qiqo_action_price_table_ready !== null) {
			return $this->qiqo_action_price_table_ready;
		}

		$q = $this->db->query("SHOW TABLES LIKE '" . $this->db->escape(DB_PREFIX . 'qiqo_action_price') . "'");
		$this->qiqo_action_price_table_ready = (bool)$q->num_rows;

		return $this->qiqo_action_price_table_ready;
	}

	private function hasProductPakColumn() {
		if ($this->product_pak_column_ready !== null) {
			return $this->product_pak_column_ready;
		}

		$q = $this->db->query("SHOW COLUMNS FROM `" . DB_PREFIX . "product` LIKE 'pak'");
		$this->product_pak_column_ready = (bool)$q->num_rows;

		return $this->product_pak_column_ready;
	}

	private function hasProductVpcColumn() {
		if ($this->product_vpc_column_ready !== null) {
			return $this->product_vpc_column_ready;
		}

		$q = $this->db->query("SHOW COLUMNS FROM `" . DB_PREFIX . "product` LIKE 'vpc'");
		$this->product_vpc_column_ready = (bool)$q->num_rows;

		return $this->product_vpc_column_ready;
	}

	private function hasProductJmColumn() {
		if ($this->product_jm_column_ready !== null) {
			return $this->product_jm_column_ready;
		}

		$q = $this->db->query("SHOW COLUMNS FROM `" . DB_PREFIX . "product` LIKE 'jm'");
		$this->product_jm_column_ready = (bool)$q->num_rows;

		return $this->product_jm_column_ready;
	}

	private function hasProductPakkolColumn() {
		if ($this->product_pakkol_column_ready !== null) {
			return $this->product_pakkol_column_ready;
		}

		$q = $this->db->query("SHOW COLUMNS FROM `" . DB_PREFIX . "product` LIKE 'pakkol'");
		$this->product_pakkol_column_ready = (bool)$q->num_rows;

		return $this->product_pakkol_column_ready;
	}


}
