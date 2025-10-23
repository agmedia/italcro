<?php

use Agmedia\Api\Connection\Soap\Qiqo;

class ModelExtensionModuleQiqo extends Model
{

    public function importArticles(): int
    {
        $qiqo = new Qiqo();

        $groups   = collect($qiqo->getGroups());
        $articles = collect($qiqo->getArticles());

        $imported = 0;

        foreach ($articles as $a) {
            // ⚙️ Provjera postoji li već proizvod (po SKU)
            $exists = $this->db->query("SELECT product_id FROM " . DB_PREFIX . "product WHERE sku = '" . $this->db->escape($a['id']) . "' LIMIT 1");

            if ($exists->num_rows) {
                continue; // preskoči ako postoji
            }

            // ⚙️ Nađi grupu
            $group = $groups->firstWhere('id', $a['kataloggrupa']);

            // ⚙️ Nađi ili kreiraj kategoriju
            $category_id = $this->resolveOrCreateCategory((int) $a['gid']);

            // ⚙️ Kreiraj proizvod
            $data = [
                'model'       => $a['barcode'],
                'sku'         => $a['id'],
                'quantity'    => (float) ($a['zaliha'] ?? 0),
                'price'       => (float) $a['cijena'],
                'status'      => $a['aktivan'] === 'true' ? 1 : 0,
                'image'       => $group['picpath'] ?? '',
                'category_id' => $category_id,
                'name'        => trim($group['naziv'] ?? 'Artikl ' . $a['id']),
                'description' => trim($group['opis'] ?? ''),
            ];

            $this->createProduct($data);
            $imported++;
        }

        $this->log('Import', "{$imported} novih artikala uvezeno.");

        return $imported;
    }


    private function resolveOrCreateCategory(int $gid): int
    {
        // Kategorije se definiraju u env.php
        $map = agconf('qiqo.categories');

        $category_name = $map[$gid] ?? 'Nepoznata kategorija';

        // postoji li već?
        $query = $this->db->query("SELECT category_id FROM " . DB_PREFIX . "category_description WHERE name = '" . $this->db->escape($category_name) . "' LIMIT 1");
        if ($query->num_rows) {
            return (int) $query->row['category_id'];
        }

        // ako ne postoji → kreiraj
        $this->db->query("INSERT INTO " . DB_PREFIX . "category SET parent_id = 0, top = 1, status = 1, date_added = NOW(), date_modified = NOW()");
        $category_id = $this->db->getLastId();

        $this->db->query("INSERT INTO " . DB_PREFIX . "category_description SET category_id = '" . (int) $category_id . "', language_id = 1, name = '" . $this->db->escape($category_name) . "', meta_title = '" . $this->db->escape($category_name) . "'");
        $this->db->query("INSERT INTO " . DB_PREFIX . "category_to_store SET category_id = '" . (int) $category_id . "', store_id = 0");

        $this->log('Category', "Nova kategorija '{$category_name}' (#{$category_id}) dodana.");

        return $category_id;
    }


    private function createProduct(array $data)
    {
        $image_path = '';

        // 🖼️ Preuzmi sliku ako postoji picpath
        if ( ! empty($data['image'])) {
            $image_path = $this->downloadImage($data['image']);
        }

        // 🔹 Kreiraj proizvod
        $this->db->query("INSERT INTO " . DB_PREFIX . "product SET
        model = '" . $this->db->escape($data['model']) . "',
        sku = '" . $this->db->escape($data['sku']) . "',
        quantity = '" . (float) $data['quantity'] . "',
        price = '" . (float) $data['price'] . "',
        status = '" . (int) $data['status'] . "',
        image = '" . $this->db->escape($image_path) . "',
        date_added = NOW(),
        date_modified = NOW()");

        $product_id = $this->db->getLastId();

        // 🔹 Opis
        $this->db->query("INSERT INTO " . DB_PREFIX . "product_description SET
        product_id = '" . (int) $product_id . "',
        language_id = 1,
        name = '" . $this->db->escape($data['name']) . "',
        description = '" . $this->db->escape($data['description']) . "',
        meta_title = '" . $this->db->escape($data['name']) . "'");

        // 🔹 Poveži kategoriju
        if ($data['category_id']) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "product_to_category SET product_id = '" . (int) $product_id . "', category_id = '" . (int) $data['category_id'] . "'");
        } else {
            // fallback → nevidljiva kategorija
            $this->db->query("INSERT INTO " . DB_PREFIX . "product_to_category SET product_id = '" . (int) $product_id . "', category_id = 0");
        }

        $this->db->query("INSERT INTO " . DB_PREFIX . "product_to_store SET product_id = '" . (int) $product_id . "', store_id = 0");

        $this->log('Product', "Dodano: {$data['name']} ({$data['sku']})");
    }


    private function downloadImage(string $picpath): string
    {
        // Ako picpath izgleda kao "Slike/9KucnePotrepstine/09000407720.jpg"
        // pokušaj ga dohvatiti s osnovnim URL-om servera (ako postoji)
        $base_url      = agconf('qiqo.image_base_url', 'http://www.qiqo.hr/'); // možeš definirati u env.php
        $relative_path = ltrim($picpath, '/');
        $filename      = basename($relative_path);
        $save_dir      = DIR_IMAGE . 'catalog/qiqo/';

        if ( ! is_dir($save_dir)) {
            mkdir($save_dir, 0755, true);
        }

        $save_path = $save_dir . $filename;
        $db_path   = 'catalog/qiqo/' . $filename;

        // Ako već postoji, ne preuzimaj ponovo
        if (file_exists($save_path)) {
            return $db_path;
        }

        $url = $base_url . $relative_path;

        try {
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            $imageData = curl_exec($ch);
            $httpCode  = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($httpCode == 200 && $imageData) {
                file_put_contents($save_path, $imageData);
                $this->log('Image', "Preuzeta slika: {$url}");

                // Ako preuzimanje nije uspjelo, vrati default dummy sliku.
                return $db_path ?: 'catalog/qiqo/no_image_qiqo.jpg';
            } else {
                $this->log('Image', "⚠️ Neuspješno preuzimanje slike: {$url}");

                return '';
            }
        } catch (Exception $e) {
            $this->log('Image', "❌ Greška prilikom preuzimanja slike {$url}: " . $e->getMessage());

            return '';
        }
    }


    private function log(string $title, string $message)
    {
        $log = new Log('qiqo.log');
        $log->write("[{$title}] {$message}");
    }


    public function getLastLog()
    {
        $log_file = DIR_LOGS . 'qiqo.log';

        return file_exists($log_file) ? implode('', array_slice(file($log_file), -20)) : 'Nema loga.';
    }
}
