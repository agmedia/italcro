<?php
class ControllerExtensionModulePpcache extends Controller {

    private function bumpKey($key) {
        $ver = $this->cache->get($key);
        $ver = ($ver === false || $ver === null) ? 2 : ((int)$ver + 1);
        $this->cache->set($key, $ver);
        return $ver;
    }

    /**
     * Admin product add/edit/delete -> bump product page + global catalog listing
     * Triggers:
     * - admin/model/catalog/product/editProduct/after
     * - admin/model/catalog/product/addProduct/after
     * - admin/model/catalog/product/deleteProduct/after
     */
    public function bump(&$route, &$args, &$output) {
        // args[0] = product_id (za edit/delete)
        // kod addProduct, često je output = product_id, a args[0] je $data
        $product_id = 0;

        if (!empty($args[0]) && is_numeric($args[0])) {
            $product_id = (int)$args[0];
        } elseif (!empty($output) && is_numeric($output)) {
            $product_id = (int)$output;
        }

        // 1) product page cache key version
        if ($product_id > 0) {
            $this->bumpKey('ppver.' . $product_id);
        }

        // 2) global catalog version (category listing cache)
        $this->bumpKey('catalogver');

        // 3) (OPCIONALNO) bump catver za sve kategorije u kojima je proizvod
        //    Ovo je korisno ako cacheiraš i subcats/count ili category info agresivnije.
        //    Ako ti ne treba, slobodno zakomentiraj ovaj blok.
        if ($product_id > 0) {
            $q = $this->db->query("SELECT category_id FROM " . DB_PREFIX . "product_to_category WHERE product_id = " . (int)$product_id);
            foreach ($q->rows as $r) {
                $cid = (int)$r['category_id'];
                if ($cid > 0) {
                    $this->bumpKey('catver.' . $cid);
                }
            }
        }
    }

    /**
     * Admin category add/edit/delete -> bump category version + global catalog
     * Triggers:
     * - admin/model/catalog/category/addCategory/after
     * - admin/model/catalog/category/editCategory/after
     * - admin/model/catalog/category/deleteCategory/after
     */
    public function bumpCategory(&$route, &$args, &$output) {
        $category_id = 0;

        if (!empty($args[0]) && is_numeric($args[0])) {
            $category_id = (int)$args[0];
        } elseif (!empty($output) && is_numeric($output)) {
            $category_id = (int)$output;
        }

        if ($category_id > 0) {
            $this->bumpKey('catver.' . $category_id);
        }

        // i listing se mijenja kad mijenjaš kategorije (naziv, opis, status, itd.)
        $this->bumpKey('catalogver');
    }

    /**
     * Manual hook (ako kasnije želiš bumpati katalog iz drugih eventova)
     */
    public function bumpCatalog(&$route, &$args, &$output) {
        $this->bumpKey('catalogver');
    }
}
