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

            $name = trim((string) ($a['naziv'] ?? 'Artikl ' . $a['id']));
            $dimmodel = trim((string)($a['dimmodel'] ?? ''));
            $opiskatalog  = trim((string)($a['opiskatalog'] ?? ''));
            $price = (float)($a['cijena'] ?? 0);
            $cent  = trim((string)($a['cent'] ?? null));

            // Ako ERP šalje "C-100", cijenu dijelimo sa 100
            if ($cent && strtoupper($cent) === 'C-100') {
                $price = $price / 100;
            } else {
                $cent = null;
            }

            /*if ($dimmodel != '' || $dimmodel != '-') {
                $name = $name . ' ' . $dimmodel;
            }*/

            // ⚙️ Kreiraj proizvod
            $data = [
                'model'       => $a['barcode'],
                'sku'         => $a['id'],
                'quantity'    => (float) ($a['zaliha'] ?? 0),
                'price'       => $price,
                'cent'        => $cent,
                'status'      => $a['aktivan'] === 'true' ? 1 : 0,
                'image'       => $group['picpath'] ?? '',
                'category_id' => $category_id,
                'name'        => $name,
                'name_add'    => $dimmodel,
                'description' => trim($group['opis'] ?? ''),
                'description_add' => $opiskatalog
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

        $this->log('Quantities', '=== START UPDATE QUANTITIES (with pak/pakkol) ===');

        foreach ($articles as $a) {
            $sku = $this->db->escape($a['id']);
            $exists = $this->db->query("SELECT product_id, quantity, minimum FROM " . DB_PREFIX . "product WHERE sku = '{$sku}' LIMIT 1");

            if (! $exists->num_rows) continue;

            $product_id = (int)$exists->row['product_id'];
            $quantity   = (float)($a['zaliha'] ?? 0);
            $pak        = (int)($a['pak'] ?? 0);
            $pakkol     = (float)($a['pakkol'] ?? 0);

            // Ako je pak=1 → postavi minimum = pakkol
            if ($pak === 1 && $pakkol > 0) {
                $this->db->query("UPDATE " . DB_PREFIX . "product 
                              SET quantity = '{$quantity}', minimum = '{$pakkol}', date_modified = NOW()
                              WHERE product_id = '{$product_id}'");
                $this->log('Quantities', "SKU {$sku} → pak=1, količina={$quantity}, minimum={$pakkol}");
            } else {
                // standardno ažuriranje
                $this->db->query("UPDATE " . DB_PREFIX . "product 
                              SET quantity = '{$quantity}', minimum = 1, date_modified = NOW()
                              WHERE product_id = '{$product_id}'");
            }

            $updated++;
        }

        $this->log('Quantities', "=== END UPDATE | Ažurirano {$updated} proizvoda ===");
        return $updated;
    }



    public function updatePrices(): int
    {
        $qiqo     = new \Agmedia\Api\Connection\Soap\Qiqo();
        $articles = collect($qiqo->getArticles());
        $updated  = 0;

        $this->log('Prices', '=== START UPDATE PRICES (with cent factor) ===');

        foreach ($articles as $a) {
            $sku = $this->db->escape($a['id']);
            $exists = $this->db->query("SELECT product_id, price FROM " . DB_PREFIX . "product WHERE sku = '{$sku}' LIMIT 1");
            if (!$exists->num_rows) continue;

            $product_id = (int)$exists->row['product_id'];
            $price = (float)($a['cijena'] ?? 0);
            $cent  = trim((string)($a['cent'] ?? null));

            // Ako ERP šalje "C-100", cijenu dijelimo sa 100
            if ($cent && strtoupper($cent) === 'C-100') {
                $price = $price / 100;
            } else {
                $cent = null;
            }

            $this->db->query("UPDATE " . DB_PREFIX . "product 
                          SET price = '{$price}', cent = '{$cent}', date_modified = NOW()
                          WHERE product_id = '{$product_id}'");

            $updated++;
        }

        $this->log('Prices', "=== END UPDATE | Ažurirano {$updated} proizvoda ===");
        return $updated;
    }



    public function updateAssets(): int
    {
        $qiqo     = new \Agmedia\Api\Connection\Soap\Qiqo();
        $groups   = collect($qiqo->getGroups());
        $articles = collect($qiqo->getArticles());

        $updated_images  = 0;
        $uploaded_logos  = 0;
        $uploaded_docs   = 0;

        $this->log('Assets', '=== START SYNC (images, logos, documents) ===');

        // 🔹 1) UPDATE glavne slike proizvoda iz ERP-a (picpath)
        foreach ($articles as $a) {
            $sku = $this->db->escape($a['id']);
            $product = $this->db->query("SELECT product_id, image FROM " . DB_PREFIX . "product WHERE sku = '{$sku}' LIMIT 1");
            if (!$product->num_rows) continue;

            $group = $groups->firstWhere('id', $a['kataloggrupa']);
            if (!$group) continue;

            $picpath = trim($group['picpath'] ?? '');
            if ($picpath === '') continue;

            // napravi lokalni put do slike (možda s FTP syncom)
            $new_image = $this->syncFileFromSource($picpath, 'catalog/products/');

            if ($new_image && $new_image !== $product->row['image']) {
                $this->db->query("UPDATE " . DB_PREFIX . "product 
                SET image = '" . $this->db->escape($new_image) . "', date_modified = NOW() 
                WHERE product_id = " . (int)$product->row['product_id']);
                $updated_images++;
            }
        }

        // 🔹 2) SYNC logotipi brendova (samo oni s logopath u ERP-u)
        foreach ($groups as $g) {
            $brand_name = trim($g['naziv'] ?? '');
            $logopath   = trim($g['logopath'] ?? '');
            if ($brand_name === '' || $logopath === '') continue;

            // put do logotipa
            $new_logo = $this->syncFileFromSource($logopath, 'catalog/brands/');
            if (!$new_logo) continue;

            // nađi manufacturer
            $m = $this->db->query("SELECT manufacturer_id FROM " . DB_PREFIX . "manufacturer 
                               WHERE LCASE(name) = '" . $this->db->escape(mb_strtolower($brand_name)) . "' LIMIT 1");
            if (!$m->num_rows) continue;

            // ažuriraj logo
            $this->db->query("UPDATE " . DB_PREFIX . "manufacturer 
                          SET image = '" . $this->db->escape($new_logo) . "' 
                          WHERE manufacturer_id = " . (int)$m->row['manufacturer_id']);
            $uploaded_logos++;
        }

        // 🔹 3) SYNC dokumenata iz \\SRV-TS01\Svasta\Italcro\_Database\
        $source_root = '\\\\SRV-TS01\\Svasta\\Italcro\\_Database\\';
        $target_root = DIR_DOWNLOAD; // npr. image/download ili storage/download, po strukturi

        $this->log('Assets', "📂 Sync docs from {$source_root}");
        $uploaded_docs = $this->syncDocumentsFromLocal($source_root, $target_root);

        $this->log('Assets', "Images updated: {$updated_images}");
        $this->log('Assets', "Logos synced: {$uploaded_logos}");
        $this->log('Assets', "Documents synced: {$uploaded_docs}");
        $this->log('Assets', '=== END SYNC ===');

        return $updated_images + $uploaded_logos + $uploaded_docs;
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


    public function linkProductsToBrands(bool $only_empty = true): int
    {
        $qiqo = new \Agmedia\Api\Connection\Soap\Qiqo();
        $groups   = collect($qiqo->getGroups());   // svaka ima id, naziv, logopath
        $articles = collect($qiqo->getArticles()); // svaka ima id (SKU), kataloggrupa
        $linked   = 0;

        $this->log('Link', '=== START LINK PRODUCTS ↔ BRANDS (via ERP) ===');
        $this->log('Link', 'Grupe: ' . $groups->count() . ' | Artikli: ' . $articles->count());

        // 🔹 1) Učitaj sve proizvođače iz OC-a u mapu name->id
        $brands = $this->db->query("SELECT manufacturer_id, name FROM " . DB_PREFIX . "manufacturer");
        $brandMap = [];
        foreach ($brands->rows as $b) {
            $brandMap[mb_strtolower($b['name'])] = (int)$b['manufacturer_id'];
        }

        // 🔹 2) Iteriraj ERP grupe i pronađi one s logopath
        foreach ($groups as $g) {
            $gid = (int)$g['id'];
            $logopath = trim($g['logopath'] ?? '');
            if ($logopath === '') continue;

            // Naziv slike → ime brenda (npr. Logo/bosch.png → BOSCH)
            $base = pathinfo($logopath, PATHINFO_FILENAME);
            $base = preg_replace('/_?logo(_final)?$/i', '', $base);
            $brand_name = strtoupper(str_replace(['_', '-'], ' ', $base));

            $brand_id = $brandMap[mb_strtolower($brand_name)] ?? 0;
            if (!$brand_id) {
                $this->log('Link', "⚠️ Brand nije pronađen u OC: {$brand_name} (grupa #{$gid})");
                continue;
            }

            // 🔹 3) Nađi sve ERP artikle iz te grupe
            $group_articles = $articles->where('kataloggrupa', $gid);
            if ($group_articles->isEmpty()) {
                $this->log('Link', "ℹ️ Nema artikala za grupu {$g['naziv']} (#{$gid})");
                continue;
            }

            // 🔹 4) Prođi kroz artikle i spoji prema SKU
            foreach ($group_articles as $a) {
                $sku = (string) $a['id'];
                if ($sku === '') continue;

                $product = $this->db->query("SELECT product_id, manufacturer_id FROM " . DB_PREFIX . "product 
                                         WHERE sku = '" . $this->db->escape($sku) . "' LIMIT 1");
                if (!$product->num_rows) {
                    $this->log('Link', "⚠️ Nema product za SKU {$sku}");
                    continue;
                }

                $this->log('Link', "🎯 FOUND SKU={$sku}, PID={$product->row['product_id']}, CURR={$product->row['manufacturer_id']}, NEW={$brand_id}");

                $pid = (int) $product->row['product_id'];
                $currentMid = (int) $product->row['manufacturer_id'];

                if ($only_empty && $currentMid > 0) continue;
                if ($currentMid === $brand_id) continue;

                if ($only_empty && $currentMid > 0) {
                    $this->log('Link', "⏩ Preskočeno (ima brand {$currentMid}) SKU {$sku} → target {$brand_id}");
                    continue;
                }
                if ($currentMid === $brand_id) {
                    $this->log('Link', "⏭️ Već ispravno: SKU {$sku}, brand {$brand_id}");
                    continue;
                }

                $this->db->query("UPDATE " . DB_PREFIX . "product 
                              SET manufacturer_id = '{$brand_id}', date_modified = NOW()
                              WHERE product_id = '{$pid}'");

                $linked++;
            }

            $this->log('Link', "✅ Grupa {$g['naziv']} → Brand {$brand_name} (ID {$brand_id}) | {$group_articles->count()} artikala");
        }

        $this->log('Link', "=== END LINK | Povezano: {$linked} proizvoda ===");
        return $linked;
    }


    public function updateProductNamesFromERP(): int
    {
        $qiqo = new \Agmedia\Api\Connection\Soap\Qiqo();
        $articles = $qiqo->getArticles();

        $this->log('NameUpdate', '=== START UPDATE PRODUCT NAMES (dimmodel) ===');
        $updated = 0;

        foreach ($articles as $a) {
            $sku = trim((string)($a['id'] ?? ''));
            $dimmodel = trim((string)($a['dimmodel'] ?? ''));

            if ($sku === '' || $dimmodel === '' || $dimmodel === '-') {
                continue; // preskoči ako nema dimmodel
            }

            // nađi proizvod
            $product = $this->db->query("SELECT p.product_id, pd.name 
                                     FROM " . DB_PREFIX . "product p
                                     LEFT JOIN " . DB_PREFIX . "product_description pd 
                                     ON p.product_id = pd.product_id 
                                     WHERE p.sku = '" . $this->db->escape($sku) . "' 
                                     AND pd.language_id = 3
                                     LIMIT 1");

            if (!$product->num_rows) {
                continue; // ne postoji u OC
            }

            $pid = (int)$product->row['product_id'];
            $oldName = trim($product->row['name']);

            // Ako naziv već sadrži dimmodel, preskoči
            if (stripos($oldName, $dimmodel) !== false) {
                continue;
            }

            // Novi naziv (možeš promijeniti logiku ako želiš drugačiji format)
            $newName = "{$oldName} {$dimmodel}";

            $this->db->query("UPDATE " . DB_PREFIX . "product_description 
                          SET name = '" . $this->db->escape($newName) . "'
                          WHERE product_id = {$pid} AND language_id = 3");

            $updated++;
            $this->log('NameUpdate', "✅ SKU {$sku} | {$oldName} → {$newName}");
        }

        $this->log('NameUpdate', "=== END UPDATE | Ažurirano: {$updated} proizvoda ===");
        return $updated;
    }


    public function linkRelatedByGroup(): int
    {
        $qiqo = new \Agmedia\Api\Connection\Soap\Qiqo();
        $groups   = $qiqo->getGroups();   // svaka ima id, naziv, opis (grupni opis)
        $articles = $qiqo->getArticles(); // svaki ima id (sku), kataloggrupa, dimmodel, opiskatalog
        $updated  = 0;

        $this->log('Related', '=== START LINK PRODUCTS BY kataloggrupa → MPN + name + name_add + description_add ===');
        $this->log('Related', 'Grupe: ' . count($groups) . ' | Artikli: ' . count($articles));

        // 1️⃣ Mapiraj grupu → naziv i opis
        $groupInfoMap = [];
        foreach ($groups as $g) {
            $gid = (int)($g['id'] ?? 0);
            if ($gid === 0) continue;
            $groupInfoMap[$gid] = [
                'naziv' => trim((string)($g['naziv'] ?? '')),
                'opis'  => trim((string)($g['opis'] ?? ''))
            ];
        }

        // 2️⃣ Iteriraj kroz sve artikle
        foreach ($articles as $a) {
            $sku = trim((string)($a['id'] ?? ''));
            $gid = (int)($a['kataloggrupa'] ?? 0);
            if ($sku === '' || $gid === 0) continue;

            $dimmodel     = trim((string)($a['dimmodel'] ?? ''));
            $opiskatalog  = trim((string)($a['opiskatalog'] ?? ''));
            $group_naziv  = $groupInfoMap[$gid]['naziv'] ?? '';
            $group_opis   = $groupInfoMap[$gid]['opis']  ?? '';

            $exists = $this->db->query("SELECT p.product_id, pd.language_id 
                                    FROM " . DB_PREFIX . "product p 
                                    LEFT JOIN " . DB_PREFIX . "product_description pd ON p.product_id = pd.product_id 
                                    WHERE p.sku = '" . $this->db->escape($sku) . "' 
                                    LIMIT 1");

            if (!$exists->num_rows) continue;

            $pid  = (int)$exists->row['product_id'];
            $lang = (int)$exists->row['language_id'];

            // 🔹 Upis u oc_product (mpn = kataloggrupa)
            $this->db->query("UPDATE " . DB_PREFIX . "product 
                          SET mpn = '" . $this->db->escape($gid) . "', date_modified = NOW()
                          WHERE product_id = {$pid}");

            // 🔹 Priprema dodatnih polja
            $name_add = $dimmodel;
            $desc_add = trim($opiskatalog . ($group_opis ? "\n\n" . $group_opis : ''));

            // 🔹 Novi glavni naziv proizvoda (naziv grupe + dimmodel ako postoji)
            $new_name = trim($group_naziv);

            // 🔹 Update u oc_product_description
            $this->db->query("UPDATE " . DB_PREFIX . "product_description 
                          SET name = '" . $this->db->escape($new_name) . "',
                              name_add = '" . $this->db->escape($name_add) . "',
                              description_add = '" . $this->db->escape($desc_add) . "'
                          WHERE product_id = {$pid} AND language_id = {$lang}");

            $updated++;
            $this->log('Related', "✅ SKU {$sku} → group={$gid}, name='{$new_name}', name_add='{$name_add}'");
        }

        $this->log('Related', "=== END LINK PRODUCTS BY GROUP | Ažurirano: {$updated} proizvoda ===");
        return $updated;
    }



    private function syncFileFromSource(string $relativePath, string $targetSubdir): string
    {
        $base_source = '\\\\SRV-TS01\\Svasta\\Italcro\\Photo\\';
        $target_dir  = DIR_IMAGE . $targetSubdir;

        if (!is_dir($target_dir)) mkdir($target_dir, 0755, true);

        $filename = basename($relativePath);
        $source   = $base_source . str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $relativePath);
        $target   = $target_dir . $filename;

        if (!file_exists($source)) {
            $this->log('Assets', "⚠️ Source file not found: {$source}");
            return '';
        }

        // Kopiraj samo ako ne postoji ili je izmijenjen
        if (!file_exists($target) || sha1_file($source) !== sha1_file($target)) {
            copy($source, $target);
            $this->log('Assets', "✅ Copied: {$source} → {$target}");
        }

        return $targetSubdir . $filename;
    }


    private function syncDocumentsFromLocal(string $sourceRoot, string $targetRoot): int
    {
        $synced = 0;

        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($sourceRoot));
        foreach ($iterator as $file) {
            if ($file->isDir()) continue;

            $basename = $file->getBasename();
            if (!preg_match('/_(man|skl|web)\.(pdf|jpg|jpeg|png)$/i', $basename)) continue;

            $relPath = str_replace($sourceRoot, '', $file->getPathname());
            $targetPath = $targetRoot . str_replace(['\\','/'], DIRECTORY_SEPARATOR, $relPath);
            $targetDir = dirname($targetPath);

            if (!is_dir($targetDir)) mkdir($targetDir, 0755, true);

            if (!file_exists($targetPath) || sha1_file($file->getPathname()) !== sha1_file($targetPath)) {
                copy($file->getPathname(), $targetPath);
                $synced++;
                $this->log('Assets', "📄 Copied doc: {$basename}");
            }
        }

        return $synced;
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
        cent = '" . $this->db->escape($data['cent']) . "',
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
        name_add = '" . $this->db->escape($data['name_add']) . "',
        description = '" . $this->db->escape($data['description']) . "',
        description_add = '" . $this->db->escape($data['description_add']) . "',
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
