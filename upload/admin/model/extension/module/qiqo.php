<?php

require_once DIR_STORAGE . 'vendor/agmedia/api/src/Connection/Soap/Qiqo.php';

class ModelExtensionModuleQiqo extends Model
{

    public function importArticles(): int
    {
        $qiqo = new \Agmedia\Api\Connection\Soap\Qiqo();

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


    public function updateQuantities(): int
    {
        $qiqo     = new \Agmedia\Api\Connection\Soap\Qiqo();
        $articles = collect($qiqo->getArticles());
        $updated  = 0;

        foreach ($articles as $a) {
            $sku = $this->db->escape($a['id']);
            $exists = $this->db->query("SELECT product_id FROM " . DB_PREFIX . "product WHERE sku = '{$sku}' LIMIT 1");

            if (! $exists->num_rows) continue;

            $quantity = (float) ($a['zaliha'] ?? 0);

            $this->db->query("UPDATE " . DB_PREFIX . "product 
            SET quantity = '{$quantity}', date_modified = NOW() 
            WHERE product_id = '" . (int) $exists->row['product_id'] . "'");

            $updated++;
        }

        $this->log('Quantities', "{$updated} količina ažurirano.");
        return $updated;
    }


    public function updatePrices(): int
    {
        $qiqo     = new \Agmedia\Api\Connection\Soap\Qiqo();
        $articles = collect($qiqo->getArticles());
        $updated  = 0;

        foreach ($articles as $a) {
            $sku = $this->db->escape($a['id']);
            $exists = $this->db->query("SELECT product_id FROM " . DB_PREFIX . "product WHERE sku = '{$sku}' LIMIT 1");

            if (! $exists->num_rows) continue;

            $price = (float) $a['cijena'];

            $this->db->query("UPDATE " . DB_PREFIX . "product 
            SET price = '{$price}', date_modified = NOW() 
            WHERE product_id = '" . (int) $exists->row['product_id'] . "'");

            $updated++;
        }

        $this->log('Prices', "{$updated} cijena ažurirano.");
        return $updated;
    }


    public function updateImages(): int
    {
        $qiqo     = new \Agmedia\Api\Connection\Soap\Qiqo();
        $groups   = collect($qiqo->getGroups());
        $articles = collect($qiqo->getArticles());
        $updated  = 0;

        foreach ($articles as $a) {
            $sku = $this->db->escape($a['id']);
            $exists = $this->db->query("SELECT product_id, image FROM " . DB_PREFIX . "product WHERE sku = '{$sku}' LIMIT 1");

            if (! $exists->num_rows) continue;

            $group = $groups->firstWhere('id', $a['kataloggrupa']);

            if ($group) {
                $new_image = $group['picpath'] ?? '';
                if (empty($new_image)) continue;

                if ($new_image) {
                    $this->db->query("UPDATE " . DB_PREFIX . "product 
                    SET image = '" . $this->db->escape($new_image) . "', date_modified = NOW() 
                    WHERE product_id = '" . (int) $exists->row['product_id'] . "'");

                    $updated++;
                }
            }
        }

        $this->log('Images', "{$updated} slika ažurirano.");
        return $updated;
    }


    public function importBrands(): int
    {
        $src_dir = rtrim(DIR_STORAGE, '/\\') . '/upload/logo-brands/';
        $dst_dir = rtrim(DIR_IMAGE, '/\\')   . '/catalog/brands/';

        if (!is_dir($src_dir)) mkdir($src_dir, 0755, true);
        if (!is_dir($dst_dir)) mkdir($dst_dir, 0755, true);

        $this->log('Brands', '=== START LOCAL BRAND IMPORT ===');
        $this->log('Brands', 'Source: ' . $src_dir);
        $this->log('Brands', 'Destination: ' . $dst_dir);

        $files = glob($src_dir . '*.{jpg,jpeg,png}', GLOB_BRACE);
        $imported = 0;

        foreach ($files as $file) {
            $basename  = pathinfo($file, PATHINFO_FILENAME);
            $ext       = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            $brandName = strtoupper(str_replace(['_', '-'], ' ', $basename)); // "bosch_tools" → "BOSCH TOOLS"
            $slug      = strtolower(preg_replace('/[^a-z0-9]+/i', '_', $brandName));

            $dst_rel  = 'catalog/brands/' . $slug . '.' . $ext;
            $dst_full = $dst_dir . $slug . '.' . $ext;

            // Provjeri postoji li već
            $exists = $this->db->query("SELECT manufacturer_id, image FROM " . DB_PREFIX . "manufacturer 
            WHERE LCASE(name) = '" . $this->db->escape(mb_strtolower($brandName)) . "' LIMIT 1");

            if ($exists->num_rows) {
                // UPDATE slike ako je druga
                $manufacturer_id = (int)$exists->row['manufacturer_id'];
                $existingImage = DIR_IMAGE . $exists->row['image'];

                if (file_exists($existingImage)) {
                    $oldHash = sha1_file($existingImage);
                    $newHash = sha1_file($file);

                    if ($oldHash !== $newHash) {
                        copy($file, $dst_full);
                        $this->db->query("UPDATE " . DB_PREFIX . "manufacturer 
                        SET image = '" . $this->db->escape($dst_rel) . "'
                        WHERE manufacturer_id = '" . (int)$manufacturer_id . "'");
                        $this->log('Brand', "🔁 Slika ažurirana za {$brandName}");
                    } else {
                        $this->log('Brand', "✔️ {$brandName} - slika identična, preskočeno");
                    }
                } else {
                    // ako nema stare slike, samo dodaj
                    copy($file, $dst_full);
                    $this->db->query("UPDATE " . DB_PREFIX . "manufacturer 
                    SET image = '" . $this->db->escape($dst_rel) . "'
                    WHERE manufacturer_id = '" . (int)$manufacturer_id . "'");
                    $this->log('Brand', "📷 Slika dodana za {$brandName}");
                }
                continue;
            }

            // Novi brand
            copy($file, $dst_full);
            $this->db->query("INSERT INTO " . DB_PREFIX . "manufacturer SET 
            name = '" . $this->db->escape($brandName) . "',
            image = '" . $this->db->escape($dst_rel) . "',
            sort_order = 0");

            $manufacturer_id = $this->db->getLastId();
            $this->db->query("INSERT INTO " . DB_PREFIX . "manufacturer_to_store 
            SET manufacturer_id = '" . (int)$manufacturer_id . "', store_id = 0");

            $this->log('Brand', "➕ Dodano: {$brandName}");
            $imported++;
        }

        $this->log('Brands', "=== END LOCAL IMPORT | Ukupno: {$imported} novih ===");
        return $imported;
    }


    public function linkProductsToBrands(): int
    {
        $qiqo = new \Agmedia\Api\Connection\Soap\Qiqo();
        $groups = collect($qiqo->getGroups());
        $linked = 0;

        $this->log('Link', '=== START LINK PRODUCTS → BRANDS ===');
        $this->log('Link', 'Ukupno grupa: ' . $groups->count());

        foreach ($groups as $g) {
            $logopath = trim($g['logopath'] ?? '');
            if ($logopath === '') continue;

            $basename = pathinfo($logopath, PATHINFO_FILENAME);  // npr. Logo/bosch.png → bosch
            $brand_name = strtoupper(str_replace(['_', '-'], ' ', $basename));

            // 🔍 pronađi brand u bazi
            $brand = $this->db->query("SELECT manufacturer_id FROM " . DB_PREFIX . "manufacturer 
            WHERE LCASE(name) = '" . $this->db->escape(mb_strtolower($brand_name)) . "' LIMIT 1");

            if (!$brand->num_rows) {
                $this->log('Link', "⚠️ Nema proizvođača za {$brand_name}");
                continue;
            }

            $manufacturer_id = (int)$brand->row['manufacturer_id'];

            // 🔍 pronađi proizvode iz te grupe (pretpostavlja se da product.sku = article.id i da article.kataloggrupa = group.id)
            $gid = (int)$g['id'];
            $products = $this->db->query("SELECT product_id FROM " . DB_PREFIX . "product_to_category 
            WHERE category_id = '{$gid}'");

            if (!$products->num_rows) {
                $this->log('Link', "⚠️ Nema proizvoda za grupu {$g['naziv']} ({$gid})");
                continue;
            }

            foreach ($products->rows as $p) {
                $pid = (int)$p['product_id'];
                $this->db->query("UPDATE " . DB_PREFIX . "product 
                SET manufacturer_id = '{$manufacturer_id}'
                WHERE product_id = '{$pid}'");
                $linked++;
            }

            $this->log('Link', "✅ {$g['naziv']} → {$brand_name} ({$manufacturer_id}) | {$products->num_rows} proizvoda povezanih");
        }

        $this->log('Link', "=== END LINK | Povezano: {$linked} proizvoda ===");
        return $linked;
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

        $this->db->query("INSERT INTO " . DB_PREFIX . "category_description SET category_id = '" . (int) $category_id . "', language_id = 3, name = '" . $this->db->escape($category_name) . "', meta_title = '" . $this->db->escape($category_name) . "'");
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
