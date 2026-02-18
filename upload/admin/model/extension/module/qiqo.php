<?php

require_once DIR_STORAGE . 'vendor/agmedia/api/src/Connection/Soap/Qiqo.php';

class ModelExtensionModuleQiqo extends Model
{

    public function importArticles(): int
    {
        $qiqo = new \Agmedia\Api\Connection\Soap\Qiqo();

        $groups   = collect($qiqo->getGroups());
        $articles = collect($qiqo->getArticles());
        $partners = collect($qiqo->getPartners());

        $imported = 0;

        foreach ($articles as $a) {
            // ⚙️ Provjera postoji li već proizvod (po SKU)
            $exists = $this->db->query("SELECT product_id FROM " . DB_PREFIX . "product WHERE sku = '" . $this->db->escape($a['id']) . "' LIMIT 1");

            if ($exists->num_rows) {
                continue; // preskoči ako postoji
            }

            // ⚙️ Nađi grupu
            $group = $groups->firstWhere('id', $a['kataloggrupa']);

            $partner = $partners->firstWhere('id', $a['partner']);

            // ⚙️ Nađi ili kreiraj kategoriju
            $category_id = $this->resolveOrCreateCategory((int) $a['gid']);

            $name = trim((string) ($group['naziv'] ?? 'Artikl ' . $a['id']));
            $dimmodel = trim((string)($a['dimmodel'] ?? ''));
            $opiskatalog  = trim((string)($a['opiskatalog'] ?? ''));
            $price = (float)($a['cijena'] ?? 0);
            $cent  = trim((string)($a['cent'] ?? null));
            $sortid = (int)($a['sortid'] ?? 0);

            // Ako ERP šalje "C-100", cijenu dijelimo sa 100
            if ($cent && strtoupper($cent) === 'C-100') {
                $price = $price / 100;
            } else {
                $cent = null;
            }

            /*if ($dimmodel != '' || $dimmodel != '-') {
                $name = $name . ' ' . $dimmodel;
            }*/

            $minimum = 1;

            if (!empty($a['pak']) && (int)$a['pak'] === 1) {
                $minimum = (float) ($a['pakkol'] ?? 1);
            }

            $data = [
                'model'       => $a['barcode'],
                'sku'         => $a['id'],
                'ean'         => $a['jm'],
                'quantity'    => (float) ($a['zaliha'] ?? 0),
                'price'       => $price,
                'cent'        => $cent,
                'minimum'     => $a['pakkol'],
                'sort_order'  => $sortid,
                'status'      => $a['aktivan'] === 'true' ? 1 : 0,
                'image'       => $group['picpath'] ?? '',
                'category_id' => $category_id,
                'name'        => $name,
                'name_add'    => $dimmodel,
                'isbn' => trim($partner['naziv'] ?? ''),
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
            $sortid     = (int)($a['sortid'] ?? 0);

            // Ako je pak=1 → postavi minimum = pakkol
            if ($pakkol > 1) {
                $this->db->query("UPDATE " . DB_PREFIX . "product 
                              SET quantity = '{$quantity}', minimum = '{$pakkol}', sort_order = '{$sortid}', date_modified = NOW()
                              WHERE product_id = '{$product_id}'");
                $this->log('Quantities', "SKU {$sku} → pak=1, količina={$quantity}, minimum={$pakkol}");
            } else {
                // standardno ažuriranje
                $this->db->query("UPDATE " . DB_PREFIX . "product 
                              SET quantity = '{$quantity}', minimum = 1, sort_order = '{$sortid}', date_modified = NOW()
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
        $this->log('Assets', '=== START ASSETS RESCAN + SYNC (/Portals/0/Database/{sku}/) ===');

        // Root gdje očekujemo SKU foldere
        $base_dir = DIR_PORTALS . 'Database/';

        if (!is_dir($base_dir)) {
            $this->log('Assets', "❌ Base dir ne postoji: {$base_dir}");
            return 0;
        }

        // Svi SKU folderi: catalog/products/{sku}/
        $sku_dirs = glob($base_dir . '*', GLOB_ONLYDIR);
        if (!$sku_dirs) {
            $this->log('Assets', "⚠ Nema SKU foldera u {$base_dir}");
            return 0;
        }

        // Resetiramo "asset sync" tablicu
        $this->db->query("TRUNCATE TABLE " . DB_PREFIX . "product_asset_sync");

        $updated_products = 0;
        $missing_product  = 0;
        $empty_folder     = 0;
        $missing_folder   = 0;
        $partial_products = 0;

        foreach ($sku_dirs as $sku_dir) {
            $sku = basename($sku_dir);
            if ($sku === '' || $sku === '.' || $sku === '..') {
                continue;
            }

            $folder_path  = rtrim($sku_dir, '/\\') . '/';
            $has_folder   = is_dir($folder_path) ? 1 : 0;
            $has_product  = 0;
            $missing_images   = 0;
            $missing_price    = 0;
            $missing_sku_data = 0;
            $status           = 'ok';
            $message          = '';

            // 1) Prođi kroz fajlove da vidimo ima li uopće išta (slike/dokumenti)
            $files          = glob($folder_path . '*');
            $fs_image_count = 0;
            $fs_doc_count   = 0;

            foreach ((array)$files as $file) {
                if (!is_file($file)) {
                    continue;
                }

                $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));

                if (in_array($ext, ['jpg', 'jpeg', 'png'])) {
                    $fs_image_count++;
                } elseif ($ext === 'pdf') {
                    $fs_doc_count++;
                }
            }

            // 2) Ako nema ni slike ni dokumenta → obriši folder i zabilježi kao "prazan"
            if ($has_folder && $fs_image_count === 0 && $fs_doc_count === 0) {
                $this->log('Assets', "SKU {$sku}: folder je prazan (nema jpg/png/pdf) – brišem {$folder_path}");
                //$this->rrmdirAssets($folder_path);
                $has_folder = 1;
                $status     = 'empty_folder';
                $message    = 'Prazan folder (bez slika/dokumenata).';

                // pokušaj ipak naći product da upišemo info
                $product_id = $this->getProductIdBySku($sku);
                $has_product = $product_id ? 1 : 0;
                if ($has_product) {
                    $empty_folder++;
                }

                // upis u asset sync tablicu
                $this->db->query("INSERT INTO " . DB_PREFIX . "product_asset_sync SET
                sku               = '" . $this->db->escape($sku) . "',
                product_id        = " . (int)$product_id . ",
                has_product       = " . (int)$has_product . ",
                has_folder        = " . (int)$has_folder . ",
                missing_images    = 1,
                missing_price     = 0,
                missing_sku_data  = 0,
                status            = '" . $this->db->escape($status) . "',
                last_checked      = NOW(),
                message           = '" . $this->db->escape($message) . "'
            ");

                // idemo na sljedeći SKU
                continue;
            }

            // 3) Nađi product_id
            $product_id = $this->getProductIdBySku($sku);
            $has_product = $product_id ? 1 : 0;

            if (!$has_product && $has_folder) {
                // folder ima fajlove, ali nema proizvoda u bazi
                $status  = 'missing_product';
                $message = 'Folder sa slikama/dokumentima postoji, ali ne postoji proizvod s tim SKU u bazi.';
                $missing_product++;

                $this->log('Assets', "SKU {$sku}: folder ima fajlove ({$fs_image_count} slika / {$fs_doc_count} dokumenata), ali NEMA proizvoda u bazi.");

                // upis u asset sync tablicu
                $this->db->query("INSERT INTO " . DB_PREFIX . "product_asset_sync SET
                sku               = '" . $this->db->escape($sku) . "',
                product_id        = 0,
                has_product       = 0,
                has_folder        = 1,
                missing_images    = 0,
                missing_price     = 0,
                missing_sku_data  = 0,
                status            = '" . $this->db->escape($status) . "',
                last_checked      = NOW(),
                message           = '" . $this->db->escape($message) . "'
            ");

                continue;
            }

            if ($has_product && !$has_folder) {
                // product postoji, ali folder (nakon brisanja) ne postoji
                $status  = 'missing_folder';
                $message = 'Produkt postoji u bazi, ali nema foldera u /Portals/0/Database/{sku}.';
                $missing_folder++;

                $this->log('Assets', "SKU {$sku}: proizvod postoji (product_id={$product_id}), ali folder ne postoji.");

                $this->db->query("INSERT INTO " . DB_PREFIX . "product_asset_sync SET
                sku               = '" . $this->db->escape($sku) . "',
                product_id        = " . (int)$product_id . ",
                has_product       = 1,
                has_folder        = 0,
                missing_images    = 1,
                missing_price     = 0,
                missing_sku_data  = 0,
                status            = '" . $this->db->escape($status) . "',
                last_checked      = NOW(),
                message           = '" . $this->db->escape($message) . "'
            ");

                continue;
            }

            // 4) Imamo i product i folder s fajlovima → SYNC
            $this->log('Assets', "SKU {$sku}: product_id={$product_id}, syncam fajlove ({$fs_image_count} slika / {$fs_doc_count} dokumenata).");

            // ponovno prođi fajlove i pozovi sync metode
            foreach ((array)$files as $file) {
                if (!is_file($file)) {
                    continue;
                }

                $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));

                if (in_array($ext, ['jpg', 'jpeg', 'png'])) {
                    $this->syncProductImageFromFile($product_id, $sku, $file, $base_dir);
                } elseif ($ext === 'pdf') {
                    $this->syncProductDocumentFromFile($product_id, $sku, $file, $base_dir);
                }
            }

            // 5) Provjera koliko slika imamo u bazi za ovaj SKU
            $like_prefix = "catalog/products/" . $this->db->escape($sku) . "/%";

            $img_main_q = $this->db->query("SELECT image 
            FROM " . DB_PREFIX . "product 
            WHERE product_id = '" . (int)$product_id . "' 
              AND image LIKE '" . $like_prefix . "'");

            $img_add_q = $this->db->query("SELECT COUNT(*) AS cnt 
            FROM " . DB_PREFIX . "product_image 
            WHERE product_id = '" . (int)$product_id . "' 
              AND image LIKE '" . $like_prefix . "'");

            $db_image_count = (int)$img_add_q->row['cnt'] + ($img_main_q->num_rows ? 1 : 0);

            if ($fs_image_count > $db_image_count) {
                $missing_images = 1;
                $status         = 'partial';
                $message       .= 'Nedostaju neke slike (FS: ' . $fs_image_count . ', DB: ' . $db_image_count . '). ';
            }

            // 6) Cijena
            $price_q = $this->db->query("SELECT price FROM " . DB_PREFIX . "product WHERE product_id = '" . (int)$product_id . "'");
            if ($price_q->num_rows && (float)$price_q->row['price'] <= 0) {
                $missing_price = 1;
                $status        = 'partial';
                $message      .= 'Cijena nije postavljena (>0). ';
            }

            // 7) SKU data (npr. model)
            $info_q = $this->db->query("SELECT model FROM " . DB_PREFIX . "product WHERE product_id = '" . (int)$product_id . "'");
            if ($info_q->num_rows && ($info_q->row['model'] == '' || $info_q->row['model'] === null)) {
                $missing_sku_data = 1;
                $status           = 'partial';
                $message         .= 'Nedostaje model artikla. ';
            }

            if ($status === 'ok') {
                $message = 'Sve sinkano (slike + dokumenti + osnovni podaci).';
                $updated_products++;
            } else {
                $partial_products++;
            }

            // 8) Upis u asset sync tablicu
            $this->db->query("INSERT INTO " . DB_PREFIX . "product_asset_sync SET
            sku               = '" . $this->db->escape($sku) . "',
            product_id        = " . (int)$product_id . ",
            has_product       = 1,
            has_folder        = 1,
            missing_images    = " . (int)$missing_images . ",
            missing_price     = " . (int)$missing_price . ",
            missing_sku_data  = " . (int)$missing_sku_data . ",
            status            = '" . $this->db->escape($status) . "',
            last_checked      = NOW(),
            message           = '" . $this->db->escape($message) . "'
        ");
        }

        $this->log('Assets', "✅ ASSETS RESCAN dovršen. Proizvoda potpuno OK: {$updated_products}");
        $this->log('Assets', "Missing product: {$missing_product}");
        $this->log('Assets', "Empty folder: {$empty_folder}");
        $this->log('Assets', "Missing folder: {$missing_folder}");
        $this->log('Assets', "Partial (problemi): {$partial_products}");
        $this->log('Assets', '=== END ASSETS RESCAN + SYNC ===');

        return $updated_products;
    }


    public function updateAssetsFromERP(): int
    {
        $qiqo     = new \Agmedia\Api\Connection\Soap\Qiqo();
        $groups   = collect($qiqo->getGroups());
        $articles = collect($qiqo->getArticles());

        $updated_images  = 0;
        $uploaded_logos  = 0;
        $uploaded_docs   = 0;

        $this->log('Assets', '=== START SYNC (ERP images + logos) ===');

        // 🔹 1) UPDATE glavne slike proizvoda iz ERP-a (picpath → DIR_UPLOAD/Portals/0/Photo/...)
        foreach ($articles as $a) {
            $sku = $this->db->escape($a['id']);

            $product = $this->db->query("SELECT product_id, image, image_hash 
            FROM " . DB_PREFIX . "product 
            WHERE sku = '{$sku}' 
            LIMIT 1");

            if (!$product->num_rows) {
                continue;
            }

            $product_id = (int)$product->row['product_id'];

            $group = $groups->firstWhere('id', $a['kataloggrupa']);
            if (!$group) continue;

            $picpath = trim($group['picpath'] ?? '');
            if ($picpath === '') continue;

            // Normaliziraj / i makni leading slash
            $relative = ltrim(str_replace('\\', '/', $picpath), '/');  // Slike/...
            if (strpos($relative, 'Slike/') === 0) {
                $relativePhoto = 'Photo/' . substr($relative, strlen('Slike/'));
            } else {
                $relativePhoto = 'Photo/' . $relative;
            }

            $source_file = rtrim(DIR_PORTALS, '/\\') . '/' . ltrim($relativePhoto, '/\\');

            if (!file_exists($source_file)) {
                // 2) fallback: ignoriraj case ekstenzije (JPG vs jpg)
                $dir       = dirname($source_file);
                $basename  = pathinfo($source_file, PATHINFO_FILENAME); // 0400434500
                $fallbacks = array_merge(
                    glob($dir . '/' . $basename . '.jpg'),
                    glob($dir . '/' . $basename . '.JPG'),
                    glob($dir . '/' . $basename . '.jpeg'),
                    glob($dir . '/' . $basename . '.JPEG'),
                    glob($dir . '/' . $basename . '.png'),
                    glob($dir . '/' . $basename . '.PNG')
                );

                if (!empty($fallbacks)) {
                    // uzmi prvi match (npr. 0400434500.JPG ili 0400434500.jpg)
                    $real = $fallbacks[0];
                    $this->log('Assets', "SKU {$sku}: picpath '{$picpath}' → fallback pronašao fajl: {$real}");
                    $source_file = $real;
                } else {
                    $this->log('Assets', "SKU {$sku}: picpath '{$picpath}' → nema fajla (ni sa fallbackom): {$source_file}");
                    continue;
                }
            }

            $filename   = basename($source_file);
            $target_dir = rtrim(DIR_IMAGE, '/\\') . '/catalog/products/' . $a['id'] . '/'; // folder po SKU

            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0755, true);
            }

            $dest = $target_dir . $filename;

            if (!@copy($source_file, $dest)) {
                $this->log('Assets', "SKU {$sku}: copy FAIL {$source_file} → {$dest}");
                continue;
            }

            if (!file_exists($dest)) {
                $this->log('Assets', "SKU {$sku}: dest ne postoji nakon copy-a: {$dest}");
                continue;
            }

            $hash          = sha1_file($dest);
            $relative_dest = 'catalog/products/' . $a['id'] . '/' . $filename;

            // Ako je već ista slika postavljena
            if ($product->row['image'] === $relative_dest) {
                if (empty($product->row['image_hash']) || $product->row['image_hash'] !== $hash) {
                    $this->db->query("UPDATE " . DB_PREFIX . "product 
                    SET image_hash = '" . $this->db->escape($hash) . "',
                        date_modified = NOW()
                    WHERE product_id = " . $product_id);
                }
                continue;
            }

            // Inače postavi ovu sliku kao glavnu iz ERP-a
            $this->db->query("UPDATE " . DB_PREFIX . "product 
            SET image       = '" . $this->db->escape($relative_dest) . "',
                image_hash  = '" . $this->db->escape($hash) . "',
                date_modified = NOW()
            WHERE product_id = " . $product_id);

            $updated_images++;
        }

        // 🔹 2) SYNC logotipi brendova (ostavljam kao što je bilo – po potrebi možeš isto mappirati)
        // 🔹 2) SYNC logotipi brendova (logopath → DIR_UPLOAD/Portals/0/Photo/... → DIR_IMAGE/catalog/brands/)
        foreach ($groups as $g) {
            $brand_name = trim($g['naziv'] ?? '');
            $logopath   = trim($g['logopath'] ?? '');

            if ($brand_name === '' || $logopath === '') {
                continue;
            }

            // normaliziraj putanju iz ERP-a
            $relative = ltrim(str_replace('\\', '/', $logopath), '/'); // npr. "Slike/Brendovi/LogoXY.png"

            // Slike/... → Photo/...
            if (strpos($relative, 'Slike/') === 0) {
                $relativePhoto = 'Photo/' . substr($relative, strlen('Slike/'));
            } else {
                $relativePhoto = 'Photo/' . $relative;
            }

            // fizički source: DIR_UPLOAD/Portals/0/Photo/...
            $source_file = rtrim(DIR_UPLOAD, '/\\') . '/Portals/0/' . $relativePhoto;

            // ako nema fajla, probaj fallback zbog ekstenzije (JPG/jpg itd.)
            if (!file_exists($source_file)) {
                $dir      = dirname($source_file);
                $basename = pathinfo($source_file, PATHINFO_FILENAME);

                $fallbacks = array_merge(
                    glob($dir . '/' . $basename . '.png'),
                    glob($dir . '/' . $basename . '.PNG'),
                    glob($dir . '/' . $basename . '.jpg'),
                    glob($dir . '/' . $basename . '.JPG'),
                    glob($dir . '/' . $basename . '.jpeg'),
                    glob($dir . '/' . $basename . '.JPEG')
                );

                if (!empty($fallbacks)) {
                    $source_file = $fallbacks[0];
                    $this->log('Assets', "LOGO fallback za '{$logopath}' → {$source_file}");
                } else {
                    $this->log('Assets', "LOGO ne postoji za '{$logopath}' → {$source_file}");
                    continue;
                }
            }

            $filename   = basename($source_file);
            $target_dir = rtrim(DIR_IMAGE, '/\\') . '/catalog/brands/';

            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0755, true);
            }

            $dest = $target_dir . $filename;

            if (!@copy($source_file, $dest)) {
                $this->log('Assets', "LOGO copy FAIL: {$source_file} → {$dest}");
                continue;
            }

            // relativna putanja za bazu
            $relative_logo = 'catalog/brands/' . $filename;

            // nađi manufacturer
            $m = $this->db->query("SELECT manufacturer_id 
        FROM " . DB_PREFIX . "manufacturer 
        WHERE LCASE(name) = '" . $this->db->escape(mb_strtolower($brand_name)) . "' 
        LIMIT 1");

            if (!$m->num_rows) {
                continue;
            }

            $this->db->query("UPDATE " . DB_PREFIX . "manufacturer 
        SET image = '" . $this->db->escape($relative_logo) . "' 
        WHERE manufacturer_id = " . (int)$m->row['manufacturer_id']);

            $uploaded_logos++;
        }

        $this->log('Assets', "Images updated from ERP: {$updated_images}");
        $this->log('Assets', "Logos synced: {$uploaded_logos}");
        $this->log('Assets', '=== END SYNC (ERP) ===');

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
            $desc_add = trim($opiskatalog );

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


    public function getProductIdBySku(string $sku)
    {
        $query = $this->db->query("SELECT product_id FROM " . DB_PREFIX . "product WHERE sku = '" . $this->db->escape($sku) . "'");

        if ($query->num_rows) {
            return (int)$query->row['product_id'];
        }

        return 0;
    }


    public function syncProductImageFromFile(int $product_id, string $sku, string $src_file, string $base_dir)
    {
        $filename   = basename($src_file);
        $target_dir = rtrim($base_dir, '/\\') . '/' . $sku . '/';

        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
        }

        $dest = $target_dir . $filename;

        // --- copy only if source != dest (updateAssets slučaj ima isti path) ---
        $srcReal  = realpath($src_file);
        $destReal = realpath($dest);

        if ($srcReal === false || $destReal === false || $srcReal !== $destReal) {
            if (!@copy($src_file, $dest)) {
                if (!file_exists($dest)) {
                    $this->log('Assets', "copy FAIL: {$src_file} → {$dest}");
                    return;
                }
            }
        }

        if (!file_exists($dest)) {
            $this->log('Assets', "DEST ne postoji nakon copy-a: {$dest}");
            return;
        }

        $hash = sha1_file($dest);

        // --- RELATIVNI PATH ZA BAZU: source minus DIR_IMAGE ---
        $full_src   = str_replace('\\', '/', $src_file);
        $image_root = str_replace('\\', '/', rtrim(DIR_IMAGE, '/\\')) . '/';

        if (strpos($full_src, $image_root) === 0) {
            // npr. "/.../upload/image/Portals/0/Photo/2VijcanaRoba/0200.jpg"
            //  => "Portals/0/Photo/2VijcanaRoba/0200.jpg"
            $relative_path = ltrim(substr($full_src, strlen($image_root)), '/');
        } else {
            // fallback – ako source nije ispod DIR_IMAGE, pokušaj s dest
            $full_dest = str_replace('\\', '/', $dest);
            if (strpos($full_dest, $image_root) === 0) {
                $relative_path = ltrim(substr($full_dest, strlen($image_root)), '/');
            } else {
                // zadnja linija obrane – upiši barem filename
                $relative_path = $filename;
            }
        }

        // 1) PROVJERI GLAVNU SLIKU PROIZVODA
        $product = $this->db->query("SELECT image, image_hash 
        FROM " . DB_PREFIX . "product 
        WHERE product_id = '" . (int)$product_id . "'");

        if ($product->num_rows) {
            $current_image = $product->row['image'];

            // 1a) ako još uopće nema glavne slike → ova postaje glavna
            if ($current_image === '' || $current_image === null) {
                $this->db->query("UPDATE " . DB_PREFIX . "product 
                SET image = '" . $this->db->escape($relative_path) . "',
                    image_hash = '" . $this->db->escape($hash) . "'
                WHERE product_id = '" . (int)$product_id . "'");
                return;
            }

            // 1b) ako je trenutna glavna slika već ova ista putanja → samo osvježi hash
            if ($current_image === $relative_path) {
                if (empty($product->row['image_hash']) || $product->row['image_hash'] !== $hash) {
                    $this->db->query("UPDATE " . DB_PREFIX . "product 
                    SET image_hash = '" . $this->db->escape($hash) . "'
                    WHERE product_id = '" . (int)$product_id . "'");
                }
                return;
            }

            // 1c) ima već neku drugu glavnu sliku → ne diramo je, idemo na dodatne
        }

        // 2) DODATNA SLIKA U oc_product_image
        /*$img_q = $this->db->query("SELECT product_image_id, image_hash
        FROM " . DB_PREFIX . "product_image
        WHERE product_id = '" . (int)$product_id . "'
          AND image = '" . $this->db->escape($relative_path) . "'");

        if ($img_q->num_rows) {
            // postoji zapis za tu sliku – ažuriraj hash ako treba
            if (empty($img_q->row['image_hash']) || $img_q->row['image_hash'] !== $hash) {
                $this->db->query("UPDATE " . DB_PREFIX . "product_image
                SET image_hash = '" . $this->db->escape($hash) . "'
                WHERE product_image_id = '" . (int)$img_q->row['product_image_id'] . "'");
            }
        } else {
            // nema dodatne slike – insert
            $this->db->query("INSERT INTO " . DB_PREFIX . "product_image 
            SET product_id = '" . (int)$product_id . "',
                image      = '" . $this->db->escape($relative_path) . "',
                image_hash = '" . $this->db->escape($hash) . "',
                sort_order = 0");
        }*/

        $this->db->query("TRUNCATE TABLE " . DB_PREFIX . "product_image");

        $this->db->query("INSERT INTO " . DB_PREFIX . "product_image 
            SET product_id = '" . (int)$product_id . "',
                image      = '" . $this->db->escape($relative_path) . "',
                image_hash = '" . $this->db->escape($hash) . "',
                sort_order = 0");
    }



    public function syncProductDocumentFromFile(int $product_id, string $sku, string $src_file, string $base_dir)
    {
        $filename   = basename($src_file);      // npr. 511541_skl.pdf
        $name_noext = pathinfo($filename, PATHINFO_FILENAME);
        $ext        = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        if ($ext !== 'pdf') {
            return;
        }

        $parts  = explode('_', $name_noext);
        $suffix = isset($parts[1]) ? strtolower($parts[1]) : '';

        switch ($suffix) {
            case 'skl':
                $mask = 'Izjava o sukladnosti';
                break;
            case 'man':
                $mask = 'Upute';
                break;
            default:
                $mask = 'Dokument proizvoda';
                break;
        }

        $target_dir = rtrim($base_dir, '/\\') . '/' . $sku . '/';

        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
        }

        $dest = $target_dir . $filename;

        if (!@copy($src_file, $dest)) {
            if (!file_exists($dest)) {
                $this->log('Assets', "DOC copy FAIL: {$src_file} → {$dest}");
                return;
            }
        }

        if (!file_exists($dest)) {
            $this->log('Assets', "DOC DEST ne postoji nakon copy-a: {$dest}");
            return;
        }

        $hash = sha1_file($dest);

        // relativna putanja za attach modul – source minus DIR_IMAGE
        $full_src   = str_replace('\\', '/', $src_file);
        $image_root = str_replace('\\', '/', rtrim(DIR_IMAGE, '/\\')) . '/';

        if (strpos($full_src, $image_root) === 0) {
            $relative_path = ltrim(substr($full_src, strlen($image_root)), '/');
        } else {
            $full_dest = str_replace('\\', '/', $dest);
            if (strpos($full_dest, $image_root) === 0) {
                $relative_path = ltrim(substr($full_dest, strlen($image_root)), '/');
            } else {
                $relative_path = $filename;
            }
        }

        $q = $this->db->query("SELECT product_attach_file_id, hash
        FROM " . DB_PREFIX . "product_attach_file
        WHERE product_id = '" . (int)$product_id . "'
          AND filename = '" . $this->db->escape($relative_path) . "'");

        if ($q->num_rows) {
            if (empty($q->row['hash']) || $q->row['hash'] !== $hash) {
                $this->db->query("UPDATE " . DB_PREFIX . "product_attach_file
                SET hash = '" . $this->db->escape($hash) . "',
                    mask = '" . $this->db->escape($mask) . "'
                WHERE product_attach_file_id = '" . (int)$q->row['product_attach_file_id'] . "'");
            }
        } else {
            $this->db->query("INSERT INTO " . DB_PREFIX . "product_attach_file SET
            product_id     = '" . (int)$product_id . "',
            filename       = '" . $this->db->escape($relative_path) . "',
            mask           = '" . $this->db->escape($mask) . "',
            login_required = 0,
            download       = 0,
            sort_order     = 0,
            hash           = '" . $this->db->escape($hash) . "'");
        }
    }



    /*private function syncFileFromSource(string $relativePath, string $targetSubdir): string
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
    }*/


    public function getProductAssetSync(array $data = [])
    {
        $sql = "SELECT * FROM " . DB_PREFIX . "product_asset_sync WHERE 1 ";

        if (!empty($data['filter_sku'])) {
            $sql .= " AND sku LIKE '%" . $this->db->escape($data['filter_sku']) . "%'";
        }

        if (!empty($data['filter_status'])) {
            $sql .= " AND status = '" . $this->db->escape($data['filter_status']) . "'";
        }

        if (!empty($data['filter_has_product'])) {
            $sql .= " AND has_product = 1";
        }

        if (!empty($data['filter_has_folder'])) {
            $sql .= " AND has_folder = 1";
        }

        if (!empty($data['filter_missing_images'])) {
            $sql .= " AND missing_images = 1";
        }

        if (!empty($data['filter_missing_price'])) {
            $sql .= " AND missing_price = 1";
        }

        if (!empty($data['filter_missing_sku_data'])) {
            $sql .= " AND missing_sku_data = 1";
        }

        $sql .= " ORDER BY last_checked DESC, sku ASC";

        if (isset($data['start']) || isset($data['limit'])) {
            $start = (int)($data['start'] ?? 0);
            $limit = (int)($data['limit'] ?? 200);

            if ($start < 0) $start = 0;
            if ($limit < 1) $limit = 200;

            $sql .= " LIMIT " . $start . "," . $limit;
        }

        $query = $this->db->query($sql);

        return $query->rows;
    }


    public function getProductAssetSyncStats(): array
    {
        $stats = [
            'total'           => 0,
            'ok'              => 0,
            'missing_product' => 0,
            'missing_folder'  => 0,
            'partial'         => 0
        ];

        // ukupno
        $q_total = $this->db->query("SELECT COUNT(*) AS cnt FROM " . DB_PREFIX . "product_asset_sync");
        $stats['total'] = (int)$q_total->row['cnt'];

        if ($stats['total'] === 0) {
            return $stats;
        }

        // po statusu
        $q_status = $this->db->query("
        SELECT status, COUNT(*) AS cnt 
        FROM " . DB_PREFIX . "product_asset_sync 
        GROUP BY status
    ");

        foreach ($q_status->rows as $row) {
            $status = $row['status'];
            $cnt    = (int)$row['cnt'];

            if (isset($stats[$status])) {
                $stats[$status] = $cnt;
            }
        }

        return $stats;
    }


    public function disableMissingArticles(): int
    {
        $qiqo = new \Agmedia\Api\Connection\Soap\Qiqo();
        $articles = $qiqo->getArticles();

        // 1) SKU-ovi iz API-ja
        $api_skus = [];
        foreach ($articles as $a) {
            $sku = trim($a['id'] ?? '');
            if ($sku !== '') {
                $api_skus[$sku] = true;
            }
        }

        // 2) SKU-ovi iz OC baze
        $db = $this->db->query("SELECT product_id, sku 
        FROM " . DB_PREFIX . "product 
        WHERE sku <> ''");

        $disabled = 0;

        foreach ($db->rows as $row) {
            $sku = trim($row['sku']);
            $product_id = (int)$row['product_id'];

            // 3) Ako SKU iz baze NE postoji u API-ju → disable
            if (!isset($api_skus[$sku])) {
                $this->db->query("UPDATE " . DB_PREFIX . "product 
                SET status = 0, date_modified = NOW() 
                WHERE product_id = " . (int)$product_id);

                $disabled++;
                $this->log('DisableCheck', "SKU {$sku} / product_id={$product_id}: DISABLED (nema u ERP API).");
            }
        }

        $this->log('DisableCheck', "Gotovo. Disabled proizvoda: {$disabled}");

        return $disabled;
    }



    /**
     * Rekurzivno brisanje foldera za assets (prazni SKU folderi)
     */
    protected function rrmdirAssets($dir)
    {
        if (!is_dir($dir)) {
            return;
        }

        $items = scandir($dir);
        foreach ($items as $item) {
            if ($item === '.' || $item === '..') {
                continue;
            }

            $path = $dir . DIRECTORY_SEPARATOR . $item;

            if (is_dir($path)) {
                $this->rrmdirAssets($path);
            } else {
                @unlink($path);
            }
        }

        @rmdir($dir);
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
        minimum = '" . (int) $data['minimum'] . "',
        sort_order = '" . (int) $data['sort_order'] . "',
        status = '" . (int) $data['status'] . "',
        image = '" . $this->db->escape($image_path) . "',
        upc = '" . $data['image'] . "',
         ean = '" . $this->db->escape($data['ean']) . "',
        date_added = NOW(),
        date_modified = NOW()");

        $product_id = $this->db->getLastId();

        // 🔹 Opis
        $this->db->query("INSERT INTO " . DB_PREFIX . "product_description SET
        product_id = '" . (int) $product_id . "',
        language_id = 3,
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

    public function syncPartnerBaseData(string $defaultSince = '-30 days'): array
    {
        @set_time_limit(0);
        $this->ensurePartnerSyncTables();

        $qiqo = new \Agmedia\Api\Connection\Soap\Qiqo();
        $now  = date('Y-m-d H:i:s');

        $feeds = [
            [
                'key'     => 'partners',
                'label'   => 'qPartnerWeb',
                'since'   => $this->resolveSince('partners', $defaultSince),
                'fetcher' => 'getPartners',
                'writer'  => 'upsertPartners',
            ],
            [
                'key'     => 'delivery_places',
                'label'   => 'qMjestoIsporukeWeb',
                'since'   => $this->resolveSince('delivery_places', $defaultSince),
                'fetcher' => 'getDeliveryPlaces',
                'writer'  => 'upsertDeliveryPlaces',
            ],
            [
                'key'     => 'action_prices',
                'label'   => 'qAkcijskiCjenikWeb',
                'since'   => $this->resolveSince('action_prices', $defaultSince),
                'fetcher' => 'getActionPriceList',
                'writer'  => 'upsertActionPrices',
            ],
        ];

        $result = [];

        foreach ($feeds as $feed) {
            $this->log('PartnerSync', "START {$feed['label']} since={$feed['since']}");
            $rows = $qiqo->{$feed['fetcher']}($feed['since']);
            $count = $this->{$feed['writer']}($rows);
            $this->setFeedLastSync($feed['key'], $now);
            $this->log('PartnerSync', "END {$feed['label']} rows=" . count($rows) . " upserted={$count}");
            $result[$feed['key']] = $count;
        }

        return $result;
    }

    public function syncPartnerBaseDataFull(string $defaultSince = '-2 years'): array
    {
        return $this->syncPartnerBaseData($defaultSince);
    }

    public function syncPartnerArticleDiscountsFull(string $since = '-2 years'): int
    {
        @set_time_limit(0);
        $this->ensurePartnerSyncTables();

        $this->log('PartnerSync', "START qPartnerArtikalRabatWeb full since={$since}");

        $qiqo = new \Agmedia\Api\Connection\Soap\Qiqo();
        $rows = $qiqo->getPartnerArticleDiscounts($since);

        $this->db->query("TRUNCATE TABLE `" . DB_PREFIX . "qiqo_partner_article_discount`");

        $inserted = 0;
        $batch = [];
        $batchSize = 1000;

        foreach ($rows as $row) {
            $partner = (int)($row['partner'] ?? 0);
            $article = trim((string)($row['artikal'] ?? ''));
            $discount = (float)($row['rabat'] ?? 0);

            if (!$partner || $article === '') {
                continue;
            }

            $batch[] = "("
                . $partner . ", "
                . "'" . $this->db->escape($article) . "', "
                . "'" . (float)$discount . "', "
                . "NOW(), NOW()"
                . ")";

            if (count($batch) >= $batchSize) {
                $this->flushPartnerDiscountBatch($batch);
                $inserted += count($batch);
                $batch = [];
            }
        }

        if ($batch) {
            $this->flushPartnerDiscountBatch($batch);
            $inserted += count($batch);
        }

        $this->setFeedLastSync('partner_article_discounts', date('Y-m-d H:i:s'));
        $this->log('PartnerSync', "END qPartnerArtikalRabatWeb full inserted={$inserted}");

        return $inserted;
    }

    private function flushPartnerDiscountBatch(array $batch): void
    {
        if (!$batch) {
            return;
        }

        $sql = "INSERT INTO `" . DB_PREFIX . "qiqo_partner_article_discount`
                (`partner_id`, `article_code`, `discount`, `date_added`, `date_modified`)
                VALUES " . implode(',', $batch) . "
                ON DUPLICATE KEY UPDATE
                    `discount` = VALUES(`discount`),
                    `date_modified` = NOW()";

        $this->db->query($sql);
    }

    private function upsertPartners(array $rows): int
    {
        $count = 0;

        foreach ($rows as $row) {
            $partnerId = (int)($row['id'] ?? 0);
            if (!$partnerId) {
                continue;
            }

            $name = trim((string)($row['naziv'] ?? ''));
            $oib = trim((string)($row['oib'] ?? ''));
            $address = trim((string)($row['adresa'] ?? ''));
            $place = trim((string)($row['mjesto'] ?? ''));
            $discount = (float)($row['rabat'] ?? 0);
            $activeRaw = strtolower(trim((string)($row['aktivan'] ?? '')));
            $active = in_array($activeRaw, ['1', 'true', 'da', 'yes'], true) ? 1 : 0;
            $apiModified = trim((string)($row['izmjena'] ?? ''));

            $this->db->query("INSERT INTO `" . DB_PREFIX . "qiqo_partner`
                SET `partner_id` = '" . (int)$partnerId . "',
                    `name` = '" . $this->db->escape($name) . "',
                    `oib` = '" . $this->db->escape($oib) . "',
                    `address` = '" . $this->db->escape($address) . "',
                    `place` = '" . $this->db->escape($place) . "',
                    `base_discount` = '" . (float)$discount . "',
                    `active` = '" . (int)$active . "',
                    `api_modified_at` = " . ($apiModified !== '' ? "'" . $this->db->escape($apiModified) . "'" : "NULL") . ",
                    `date_added` = NOW(),
                    `date_modified` = NOW()
                ON DUPLICATE KEY UPDATE
                    `name` = VALUES(`name`),
                    `oib` = VALUES(`oib`),
                    `address` = VALUES(`address`),
                    `place` = VALUES(`place`),
                    `base_discount` = VALUES(`base_discount`),
                    `active` = VALUES(`active`),
                    `api_modified_at` = VALUES(`api_modified_at`),
                    `date_modified` = NOW()");

            $count++;
        }

        return $count;
    }

    private function upsertDeliveryPlaces(array $rows): int
    {
        $count = 0;

        foreach ($rows as $row) {
            $placeId = (int)($row['id'] ?? 0);
            if (!$placeId) {
                continue;
            }

            $partnerId = (int)($row['partner'] ?? 0);
            $code = trim((string)($row['sifra'] ?? ''));
            $name = trim((string)($row['naziv'] ?? ''));
            $address = trim((string)($row['adresa'] ?? ''));
            $place = trim((string)($row['mjesto'] ?? ''));
            $apiModified = trim((string)($row['izmjena'] ?? ''));

            $this->db->query("INSERT INTO `" . DB_PREFIX . "qiqo_delivery_place`
                SET `delivery_place_id` = '" . (int)$placeId . "',
                    `partner_id` = '" . (int)$partnerId . "',
                    `code` = '" . $this->db->escape($code) . "',
                    `name` = '" . $this->db->escape($name) . "',
                    `address` = '" . $this->db->escape($address) . "',
                    `place` = '" . $this->db->escape($place) . "',
                    `api_modified_at` = " . ($apiModified !== '' ? "'" . $this->db->escape($apiModified) . "'" : "NULL") . ",
                    `date_added` = NOW(),
                    `date_modified` = NOW()
                ON DUPLICATE KEY UPDATE
                    `partner_id` = VALUES(`partner_id`),
                    `code` = VALUES(`code`),
                    `name` = VALUES(`name`),
                    `address` = VALUES(`address`),
                    `place` = VALUES(`place`),
                    `api_modified_at` = VALUES(`api_modified_at`),
                    `date_modified` = NOW()");

            $count++;
        }

        return $count;
    }

    private function upsertActionPrices(array $rows): int
    {
        $count = 0;

        foreach ($rows as $row) {
            $article = trim((string)($row['artikal'] ?? ''));
            $indicator = trim((string)($row['indikator'] ?? ''));
            $quantity = (float)($row['kolicina'] ?? 0);
            $price = (float)($row['cijena'] ?? 0);
            $discount = (float)($row['rabat'] ?? 0);

            if ($article === '' || $indicator === '') {
                continue;
            }

            $this->db->query("INSERT INTO `" . DB_PREFIX . "qiqo_action_price`
                SET `article_code` = '" . $this->db->escape($article) . "',
                    `indicator` = '" . $this->db->escape($indicator) . "',
                    `quantity` = '" . (float)$quantity . "',
                    `price` = '" . (float)$price . "',
                    `discount` = '" . (float)$discount . "',
                    `date_added` = NOW(),
                    `date_modified` = NOW()
                ON DUPLICATE KEY UPDATE
                    `price` = VALUES(`price`),
                    `discount` = VALUES(`discount`),
                    `date_modified` = NOW()");

            $count++;
        }

        return $count;
    }

    private function ensurePartnerSyncTables(): void
    {
        $this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "qiqo_partner` (
            `partner_id` INT(11) NOT NULL,
            `name` VARCHAR(255) NOT NULL DEFAULT '',
            `oib` VARCHAR(32) NOT NULL DEFAULT '',
            `address` VARCHAR(255) NOT NULL DEFAULT '',
            `place` VARCHAR(255) NOT NULL DEFAULT '',
            `base_discount` DECIMAL(10,4) NOT NULL DEFAULT 0,
            `active` TINYINT(1) NOT NULL DEFAULT 1,
            `api_modified_at` VARCHAR(64) NULL,
            `date_added` DATETIME NOT NULL,
            `date_modified` DATETIME NOT NULL,
            PRIMARY KEY (`partner_id`),
            KEY `idx_oib` (`oib`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

        $this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "qiqo_delivery_place` (
            `delivery_place_id` INT(11) NOT NULL,
            `partner_id` INT(11) NOT NULL,
            `code` VARCHAR(64) NOT NULL DEFAULT '',
            `name` VARCHAR(255) NOT NULL DEFAULT '',
            `address` VARCHAR(255) NOT NULL DEFAULT '',
            `place` VARCHAR(255) NOT NULL DEFAULT '',
            `api_modified_at` VARCHAR(64) NULL,
            `date_added` DATETIME NOT NULL,
            `date_modified` DATETIME NOT NULL,
            PRIMARY KEY (`delivery_place_id`),
            KEY `idx_partner` (`partner_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

        $this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "qiqo_partner_article_discount` (
            `partner_id` INT(11) NOT NULL,
            `article_code` VARCHAR(64) NOT NULL,
            `discount` DECIMAL(10,4) NOT NULL DEFAULT 0,
            `date_added` DATETIME NOT NULL,
            `date_modified` DATETIME NOT NULL,
            PRIMARY KEY (`partner_id`,`article_code`),
            KEY `idx_article` (`article_code`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

        $this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "qiqo_action_price` (
            `article_code` VARCHAR(64) NOT NULL,
            `indicator` CHAR(1) NOT NULL,
            `quantity` DECIMAL(15,4) NOT NULL DEFAULT 0,
            `price` DECIMAL(15,4) NOT NULL DEFAULT 0,
            `discount` DECIMAL(10,4) NOT NULL DEFAULT 0,
            `date_added` DATETIME NOT NULL,
            `date_modified` DATETIME NOT NULL,
            PRIMARY KEY (`article_code`,`indicator`,`quantity`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

        $this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "qiqo_sync_state` (
            `feed_key` VARCHAR(64) NOT NULL,
            `last_sync_at` DATETIME NOT NULL,
            `date_modified` DATETIME NOT NULL,
            PRIMARY KEY (`feed_key`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
    }

    private function resolveSince(string $feedKey, string $fallback): string
    {
        $last = $this->getFeedLastSync($feedKey);
        if ($last) {
            return $last;
        }

        return $fallback;
    }

    private function getFeedLastSync(string $feedKey): ?string
    {
        $q = $this->db->query("SELECT last_sync_at
                               FROM `" . DB_PREFIX . "qiqo_sync_state`
                               WHERE feed_key = '" . $this->db->escape($feedKey) . "'
                               LIMIT 1");

        if ($q->num_rows && !empty($q->row['last_sync_at'])) {
            return $q->row['last_sync_at'];
        }

        return null;
    }

    private function setFeedLastSync(string $feedKey, string $timestamp): void
    {
        $this->db->query("INSERT INTO `" . DB_PREFIX . "qiqo_sync_state`
            SET `feed_key` = '" . $this->db->escape($feedKey) . "',
                `last_sync_at` = '" . $this->db->escape($timestamp) . "',
                `date_modified` = NOW()
            ON DUPLICATE KEY UPDATE
                `last_sync_at` = VALUES(`last_sync_at`),
                `date_modified` = NOW()");
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
