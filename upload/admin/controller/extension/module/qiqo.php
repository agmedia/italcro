<?php

class ControllerExtensionModuleQiqo extends Controller
{

    private $error = [];


    public function index()
    {
        $this->load->language('extension/module/qiqo');
        $this->document->setTitle($this->language->get('heading_title'));
        $this->load->model('extension/module/qiqo');

        if ($this->request->server['REQUEST_METHOD'] == 'POST' && isset($this->request->post['action'])) {
			if (!$this->user->hasPermission('modify', 'extension/module/qiqo')) {
				$this->session->data['error'] = 'Nemate dopuštenje za izmjenu QIQO modula.';
				$this->response->redirect($this->url->link('extension/module/qiqo', 'user_token=' . $this->session->data['user_token'], true));
				return;
			}

            switch ($this->request->post['action']) {
                case 'import':
                    $count = $this->model_extension_module_qiqo->importArticles();
                    if ($count < 0) {
                        $this->session->data['error'] = 'Import je sigurnosno prekinut. Podaci nisu mijenjani; provjeri QIQO log i konfiguraciju.';
                    } else {
                        $this->session->data['success'] = "Import završen. Uvezeno {$count} novih artikala.";
                    }
                    break;

                case 'update_qty':
                    $count = $this->model_extension_module_qiqo->updateQuantities();
                    $this->session->data['success'] = "Ažurirano količina: {$count} artikala.";
                    break;

                case 'update_price':
                    $count = $this->model_extension_module_qiqo->updatePrices();
                    if ($count < 0) {
                        $this->session->data['error'] = 'Ažuriranje cijena je sigurnosno prekinuto. Cijene nisu namjerno mijenjane; provjeri QIQO log i konfiguraciju.';
                    } else {
                        $this->session->data['success'] = "Ažurirano cijena: {$count} artikala.";
                    }
                    break;

                case 'update_assets':
                    $count = $this->model_extension_module_qiqo->updateAssets();
                    $this->session->data['success'] = "Sinkronizacija dovršena ({$count} datoteka).";
                    $this->response->redirect($this->url->link('extension/module/qiqo', 'user_token=' . $this->session->data['user_token'], true));
                    break;

                case 'update_assets_from_erp':
                    $count = $this->model_extension_module_qiqo->updateAssetsFromERP();
                    $this->session->data['success'] = "Sinkronizacija dovršena ({$count} datoteka).";
                    $this->response->redirect($this->url->link('extension/module/qiqo', 'user_token=' . $this->session->data['user_token'], true));
                    break;

                case 'import_brands':
                    $count = $this->model_extension_module_qiqo->importBrands();
                    $this->session->data['success'] = "Dodano {$count} novih proizvođača (brendova).";
                    break;

                case 'link_brands':
                    $only_empty = !empty($this->request->post['only_empty']); // true ako je checkbox označen
                    $count = $this->model_extension_module_qiqo->linkProductsToBrands($only_empty);
                    $mode  = $only_empty ? 'samo prazni' : 'svi proizvodi (force)';
                    $this->session->data['success'] = "Povezano {$count} proizvoda ({$mode}).";
                    break;

                case 'update_names':
                    $count = $this->model_extension_module_qiqo->updateProductNamesFromERP();
                    $this->session->data['success'] = "Nazivi artikala ažurirani za {$count} proizvoda (dimmodel).";
                    $this->response->redirect($this->url->link('extension/module/qiqo', 'user_token=' . $this->session->data['user_token'], true));
                    break;

                case 'link_related_group':
                    $count = $this->model_extension_module_qiqo->linkRelatedByGroup();
                    $this->session->data['success'] = "Povezano {$count} proizvoda prema ERP grupama (kataloggrupa).";
                    $this->response->redirect($this->url->link('extension/module/qiqo', 'user_token=' . $this->session->data['user_token'], true));
                    break;

                case 'disable_missing':
                    if (!$this->model_extension_module_qiqo->isDisableMissingArticlesEnabled()) {
                        $this->session->data['error'] = 'Sigurnosno blokirano: potreban je potvrđen potpuni qArtikliWeb snapshot i transakcijska product tablica. Nijedan artikl nije onemogućen.';
                    } else {
                        $count = $this->model_extension_module_qiqo->disableMissingArticles();
                        $this->session->data[$count ? 'success' : 'error'] = $count
                            ? "Onemogućeno {$count} proizvoda koji ne postoje u potvrđenom ERP snapshotu."
                            : 'Nijedan artikl nije onemogućen. Provjeri QIQO log i snapshot sanity provjere.';
                    }
                    break;

                case 'sync_sales_reps':
                    $count = $this->model_extension_module_qiqo->syncSalesReps();
                    $this->session->data[$count ? 'success' : 'error'] = $count
                        ? "Sync komercijalista: {$count} slogova."
                        : 'qKomercijalistWeb nije vratio komercijaliste. Provjeri QIQO endpoint/log.';
                    break;

                case 'sync_sales_reps_full':
                    $count = $this->model_extension_module_qiqo->syncSalesRepsFull();
                    $this->session->data[$count ? 'success' : 'error'] = $count
                        ? "Sync komercijalista FULL: {$count} slogova."
                        : 'qKomercijalistWeb FULL nije vratio komercijaliste. Provjeri QIQO endpoint/log.';
                    break;

                case 'sync_partner_base':
                    $stats = $this->model_extension_module_qiqo->syncPartnerBaseData();
                    $this->session->data['success'] = "Partner base sync: partneri {$stats['partners']}, mjesta isporuke {$stats['delivery_places']}, komercijalisti {$stats['sales_reps']}, akcijski cjenik {$stats['action_prices']}.";
                    break;

                case 'sync_partner_base_full':
                    if (!$this->model_extension_module_qiqo->isFullSnapshotReplacementEnabled()) {
                        $this->session->data['error'] = 'FULL sync je sigurnosno blokiran dok ERP ne potvrdi potpuni snapshot i dok se ne postavi eksplicitni početni datum.';
                    } else {
                        $stats = $this->model_extension_module_qiqo->syncPartnerBaseDataFull();
                        $this->session->data['success'] = "Partner base FULL sync: partneri {$stats['partners']}, mjesta isporuke {$stats['delivery_places']}, komercijalisti {$stats['sales_reps']}, akcijski cjenik {$stats['action_prices']}.";
                    }
                    break;

                case 'sync_action_prices':
                    $count = $this->model_extension_module_qiqo->syncActionPrices();
                    $this->session->data['success'] = "Akcijski cjenik sync: {$count} slogova.";
                    break;

                case 'sync_action_prices_full':
                    if (!$this->model_extension_module_qiqo->isFullSnapshotReplacementEnabled()) {
                        $this->session->data['error'] = 'Akcijski cjenik FULL je blokiran dok ERP ne potvrdi potpuni snapshot.';
                    } else {
                        $count = $this->model_extension_module_qiqo->syncActionPricesFull();
                        $this->session->data[$count ? 'success' : 'error'] = $count
                            ? "Akcijski cjenik FULL sync: {$count} slogova."
                            : 'Akcijski cjenik FULL nije zamijenjen; live cache i watermark su sačuvani.';
                    }
                    break;

                case 'sync_partner_discounts':
                    if (!$this->model_extension_module_qiqo->isFullSnapshotReplacementEnabled()) {
                        $this->session->data['error'] = 'Partner-artikl FULL je blokiran dok ERP ne potvrdi potpuni snapshot.';
                    } else {
                        $count = $this->model_extension_module_qiqo->syncPartnerArticleDiscountsFull();
                        $this->session->data[$count ? 'success' : 'error'] = $count
                            ? "Partner-artikl rabati FULL sync: {$count} slogova."
                            : 'Partner-artikl rabati nisu zamijenjeni; live cache i watermark su sačuvani.';
                    }
                    break;

                case 'sync_partner_all':
                    if (!$this->model_extension_module_qiqo->isFullSnapshotReplacementEnabled()) {
                        $this->session->data['error'] = 'Kompletan sync je blokiran jer uključuje destruktivni FULL snapshot. Koristi inkrementalni partner sync.';
                    } else {
                        $stats = $this->model_extension_module_qiqo->syncPartnerBaseData();
                        $count = $this->model_extension_module_qiqo->syncPartnerArticleDiscountsFull();
                        $this->session->data['success'] = "Kompletan partner sync: partneri {$stats['partners']}, mjesta {$stats['delivery_places']}, komercijalisti {$stats['sales_reps']}, akcije {$stats['action_prices']}, partner-artikl rabati {$count}.";
                    }
                    break;

                case 'update_article_partners':
                    $stats = $this->model_extension_module_qiqo->updateArticlePartners();
                    $this->session->data['success'] = "Partner update artikala: ažurirano {$stats['updated']}, bez promjene {$stats['unchanged']}, bez proizvoda {$stats['missing_product']}, bez partnera u API {$stats['missing_partner']}, preskočeno (schema) {$stats['skipped_schema']}.";
                    break;

                case 'clear_log':
                    $log_file = DIR_LOGS . 'qiqo.log';
                    if (file_exists($log_file)) {
                        file_put_contents($log_file, ''); // isprazni log
                        $this->session->data['success'] = 'Log je uspješno obrisan.';
                    } else {
                        $this->session->data['error'] = 'Log datoteka ne postoji.';
                    }
                    $this->response->redirect($this->url->link('extension/module/qiqo', 'user_token=' . $this->session->data['user_token'], true));
                    break;

            }

            $this->response->redirect($this->url->link('extension/module/qiqo', 'user_token=' . $this->session->data['user_token'], true));
        }

        $data['heading_title'] = $this->language->get('heading_title');
        $data['action']        = $this->url->link('extension/module/qiqo', 'user_token=' . $this->session->data['user_token'], true);
        $data['cancel']        = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true);
		$data['order_outbox']  = $this->url->link('extension/module/qiqo/orderOutbox', 'user_token=' . $this->session->data['user_token'], true);
        $data['success']       = $this->session->data['success'] ?? '';
        $data['error']       = $this->session->data['error'] ?? '';
        unset($this->session->data['success']);
        unset($this->session->data['error']);

        $data['last_log'] = $this->model_extension_module_qiqo->getLastLog();
        $data['disable_missing_enabled'] = $this->model_extension_module_qiqo->isDisableMissingArticlesEnabled();
        $data['full_snapshot_enabled'] = $this->model_extension_module_qiqo->isFullSnapshotReplacementEnabled();
        $data['upload_action'] = $this->url->link('extension/module/qiqo/uploadLogos', 'user_token=' . $this->session->data['user_token'], true);

        // --- FILTERI ZA oc_product_asset_sync ---
        $filter_status           = isset($this->request->get['filter_status']) ? $this->request->get['filter_status'] : '';
        $filter_sku              = isset($this->request->get['filter_sku']) ? $this->request->get['filter_sku'] : '';
        $filter_has_product      = isset($this->request->get['filter_has_product']) ? (int)$this->request->get['filter_has_product'] : 0;
        $filter_has_folder       = isset($this->request->get['filter_has_folder']) ? (int)$this->request->get['filter_has_folder'] : 0;
        $filter_missing_images   = isset($this->request->get['filter_missing_images']) ? (int)$this->request->get['filter_missing_images'] : 0;
        $filter_missing_price    = isset($this->request->get['filter_missing_price']) ? (int)$this->request->get['filter_missing_price'] : 0;
        $filter_missing_sku_data = isset($this->request->get['filter_missing_sku_data']) ? (int)$this->request->get['filter_missing_sku_data'] : 0;

        $filter_data = [
            'filter_status'           => $filter_status,
            'filter_sku'              => $filter_sku,
            'filter_has_product'      => $filter_has_product,
            'filter_has_folder'       => $filter_has_folder,
            'filter_missing_images'   => $filter_missing_images,
            'filter_missing_price'    => $filter_missing_price,
            'filter_missing_sku_data' => $filter_missing_sku_data,
            'start'                   => 0,
            'limit'                   => 200
        ];

        // dohvat podataka iz oc_product_asset_sync
        $results = $this->model_extension_module_qiqo->getProductAssetSync($filter_data);

        $data['asset_sync'] = [];

        foreach ($results as $row) {
            $product_link = '';

            if (!empty($row['product_id'])) {
                $product_link = $this->url->link(
                    'catalog/product/edit',
                    'user_token=' . $this->session->data['user_token'] . '&product_id=' . (int)$row['product_id'],
                    true
                );
            }

            $data['asset_sync'][] = [
                'sku'              => $row['sku'],
                'product_id'       => $row['product_id'],
                'product_link'     => $product_link,
                'has_product'      => (int)$row['has_product'],
                'has_folder'       => (int)$row['has_folder'],
                'missing_images'   => (int)$row['missing_images'],
                'missing_price'    => (int)$row['missing_price'],
                'missing_sku_data' => (int)$row['missing_sku_data'],
                'status'           => $row['status'],
                'last_checked'     => $row['last_checked'],
                'message'          => $row['message'],
            ];
        }

        // statistika za status tab
        $data['asset_stats'] = $this->model_extension_module_qiqo->getProductAssetSyncStats();

        // proslijedi filtere u view
        $data['filter_status']           = $filter_status;
        $data['filter_sku']              = $filter_sku;
        $data['filter_has_product']      = $filter_has_product;
        $data['filter_has_folder']       = $filter_has_folder;
        $data['filter_missing_images']   = $filter_missing_images;
        $data['filter_missing_price']    = $filter_missing_price;
        $data['filter_missing_sku_data'] = $filter_missing_sku_data;

        $data['user_token']    = $this->session->data['user_token'];
        $data['filter_action'] = $this->url->link('extension/module/qiqo', 'user_token=' . $this->session->data['user_token'], true);

        // Aktivni tab
        $active_tab = 'sync';

        // eksplicitno iz GET-a
        if (!empty($this->request->get['tab'])) {
            $active_tab = $this->request->get['tab'];
        } else {
            // ako postoji bilo koji filter → prebaci na status tab
            if ($filter_status || $filter_sku || $filter_has_product || $filter_has_folder
                || $filter_missing_images || $filter_missing_price || $filter_missing_sku_data) {
                $active_tab = 'status';
            }
        }

        $data['active_tab'] = $active_tab;

        // Layout
        $data['header']      = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer']      = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('extension/module/qiqo', $data));
    }

	public function orderOutbox()
	{
		$this->load->language('extension/module/qiqo');
		$this->load->model('extension/module/qiqo_order_outbox');
		$this->document->setTitle('QIQO NarudzbaSend');

		$filter_status = isset($this->request->get['filter_status']) ? trim((string)$this->request->get['filter_status']) : '';
		$page = isset($this->request->get['page']) ? max(1, (int)$this->request->get['page']) : 1;
		$limit = 50;

		$data['rows'] = array();
		$rows = $this->model_extension_module_qiqo_order_outbox->getRows(array(
			'filter_status' => $filter_status,
			'start' => ($page - 1) * $limit,
			'limit' => $limit
		));

		foreach ($rows as $row) {
			$decoded = json_decode($row['payload_json'], true);
			$row['payload_pretty'] = is_array($decoded)
				? json_encode($decoded, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRESERVE_ZERO_FRACTION)
				: $row['payload_json'];
			$row['order_link'] = $this->url->link('sale/order/info', 'user_token=' . $this->session->data['user_token'] . '&order_id=' . (int)$row['order_id'], true);
			$data['rows'][] = $row;
		}

		$total = $this->model_extension_module_qiqo_order_outbox->getTotal($filter_status);
		$config = $this->model_extension_module_qiqo_order_outbox->getConfigurationState();
		$data['send_enabled'] = $config['enabled'];
		$data['credentials_configured'] = $config['credentials_configured'];
		$data['endpoint_configured'] = $config['endpoint_configured'];
		$data['secure_transport'] = $config['secure_transport'];
		$data['transport_approved'] = $config['transport_approved'];
		$data['endpoint'] = $config['endpoint'];
		$data['counts'] = $this->model_extension_module_qiqo_order_outbox->getCounts();
		$data['outbox_start_at'] = $this->model_extension_module_qiqo_order_outbox->getOutboxStartAt();
		$data['missing_order_count'] = $this->model_extension_module_qiqo_order_outbox->getMissingEligibleOrderCount();
		$data['missing_orders'] = $this->model_extension_module_qiqo_order_outbox->getMissingEligibleOrders(20);
		$data['filter_status'] = $filter_status;
		$data['modify'] = $this->user->hasPermission('modify', 'extension/module/qiqo');
		$data['user_token'] = $this->session->data['user_token'];

		$data['heading_title'] = 'QIQO NarudzbaSend';
		$data['back'] = $this->url->link('extension/module/qiqo', 'user_token=' . $this->session->data['user_token'], true);
		$data['filter_action'] = $this->url->link('extension/module/qiqo/orderOutbox', 'user_token=' . $this->session->data['user_token'], true);
		$data['action'] = $this->url->link('extension/module/qiqo/orderOutboxAction', 'user_token=' . $this->session->data['user_token'], true);
		$data['success'] = isset($this->session->data['success']) ? $this->session->data['success'] : '';
		$data['error'] = isset($this->session->data['error']) ? $this->session->data['error'] : '';
		unset($this->session->data['success'], $this->session->data['error']);

		$pagination = new Pagination();
		$pagination->total = $total;
		$pagination->page = $page;
		$pagination->limit = $limit;
		$pagination->url = $this->url->link('extension/module/qiqo/orderOutbox', 'user_token=' . $this->session->data['user_token'] . ($filter_status !== '' ? '&filter_status=' . urlencode($filter_status) : '') . '&page={page}', true);
		$data['pagination'] = $pagination->render();
		$data['results'] = sprintf('Prikazano %d–%d od %d zapisa', $total ? (($page - 1) * $limit + 1) : 0, min($page * $limit, $total), $total);

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		$this->response->setOutput($this->load->view('extension/module/qiqo_order_outbox', $data));
	}

	public function orderOutboxAction()
	{
		if ($this->request->server['REQUEST_METHOD'] !== 'POST') {
			$this->response->redirect($this->url->link('extension/module/qiqo/orderOutbox', 'user_token=' . $this->session->data['user_token'], true));
			return;
		}
		if (!$this->user->hasPermission('modify', 'extension/module/qiqo')) {
			$this->session->data['error'] = 'Nemate dopuštenje za izmjenu QIQO modula.';
			$this->response->redirect($this->url->link('extension/module/qiqo/orderOutbox', 'user_token=' . $this->session->data['user_token'], true));
			return;
		}

		$this->load->model('extension/module/qiqo_order_outbox');
		$outbox_id = isset($this->request->post['outbox_id']) ? (int)$this->request->post['outbox_id'] : 0;
		$action = isset($this->request->post['outbox_action']) ? (string)$this->request->post['outbox_action'] : '';

		try {
			switch ($action) {
				case 'rebuild':
					$this->model_extension_module_qiqo_order_outbox->rebuild($outbox_id);
					$this->session->data['success'] = 'Payload je ponovno izgrađen i spreman za provjeru.';
					break;
				case 'send':
					$result = $this->model_extension_module_qiqo_order_outbox->send($outbox_id);
					$this->session->data[$result['state'] === 'sent' ? 'success' : 'error'] = 'NarudzbaSend rezultat: ' . $result['state'] . ' — ' . $result['description'];
					break;
				case 'retry':
					$this->model_extension_module_qiqo_order_outbox->allowRetry($outbox_id);
					$this->session->data['success'] = 'Potvrđeno neuspjelo slanje vraćeno je u red.';
					break;
				case 'mark_sent':
					$this->model_extension_module_qiqo_order_outbox->markVerifiedSent($outbox_id);
					$this->session->data['success'] = 'Zapis je označen poslanim nakon ručne provjere u ERP-u.';
					break;
				case 'mark_not_sent':
					$this->model_extension_module_qiqo_order_outbox->markVerifiedNotSent($outbox_id);
					$this->session->data['success'] = 'Potvrđeno je da zapis nije stigao u ERP; ponovno slanje je sada dopušteno.';
					break;
				case 'mark_uncertain':
					$this->model_extension_module_qiqo_order_outbox->markProcessingUncertain($outbox_id);
					$this->session->data['success'] = 'Prekinuta obrada označena je nepoznatom; prije nastavka provjerite ERP.';
					break;
				default:
					throw new RuntimeException('Nepoznata outbox akcija.');
			}
		} catch (Throwable $e) {
			$this->session->data['error'] = $e->getMessage();
		}

		$this->response->redirect($this->url->link('extension/module/qiqo/orderOutbox', 'user_token=' . $this->session->data['user_token'], true));
	}


    public function uploadLogos()
    {
        $this->load->language('extension/module/qiqo');
        $this->load->model('extension/module/qiqo');
		if (!$this->user->hasPermission('modify', 'extension/module/qiqo')) {
			$this->session->data['error'] = 'Nemate dopuštenje za prijenos QIQO datoteka.';
			$this->response->redirect($this->url->link('extension/module/qiqo', 'user_token=' . $this->session->data['user_token'], true));
			return;
		}

        // Gdje želimo završne slike/dokumente:
        // fizički: /upload/image/Slike/...
        $base_dir = rtrim(DIR_IMAGE, '/\\') . '/catalog/products/';

        if (!is_dir($base_dir)) {
            mkdir($base_dir, 0755, true);
        }

        $document_extensions = $this->model_extension_module_qiqo->getAssetDocumentExtensions();
        $this->model_extension_module_qiqo->ensureMmosAttachmentFileTypes($document_extensions);

        // Ostavili smo samo ZIP upload
        if (empty($this->request->files['zip_file']['name'])) {
            $this->session->data['error'] = 'Nije odabran ZIP.';
            $this->response->redirect($this->url->link('extension/module/qiqo', 'user_token=' . $this->session->data['user_token'], true));
            return;
        }

        $zip      = new ZipArchive();
        $tmp_name = $this->request->files['zip_file']['tmp_name'];

        if ($zip->open($tmp_name) !== true) {
            $this->session->data['error'] = 'Ne mogu otvoriti ZIP datoteku.';
            $this->response->redirect($this->url->link('extension/module/qiqo', 'user_token=' . $this->session->data['user_token'], true));
            return;
        }

        // Privremeni dir gdje raspakiramo ZIP
        $tmp_dir = rtrim(DIR_STORAGE, '/\\') . '/qiqo_zip_' . time() . '/';

        if (!is_dir($tmp_dir)) {
            mkdir($tmp_dir, 0755, true);
        }

        $zip->extractTo($tmp_dir);
        $zip->close();

        // Očekujemo root folder "Database"
        $database_dir = $tmp_dir . 'Database/';

        if (!is_dir($database_dir)) {
            // fallback – možda je samo Database bez točnog imena
            $this->session->data['error'] = 'U ZIP-u se ne nalazi "Database" folder.';
            $this->rrmdir($tmp_dir);
            $this->response->redirect($this->url->link('extension/module/qiqo', 'user_token=' . $this->session->data['user_token'], true));
            return;
        }

        $processed_products = 0;

        // Iteriramo sve SKU foldere unutar Database/
        $sku_dirs = glob($database_dir . '*', GLOB_ONLYDIR);

        foreach ($sku_dirs as $sku_dir) {
            $sku = basename($sku_dir);

            if (!$sku) {
                continue;
            }

            // Nađi product_id po SKU
            $product_id = $this->model_extension_module_qiqo->getProductIdBySku($sku);

            if (!$product_id) {
                // nema proizvoda s tom šifrom – preskoči
                continue;
            }

            $processed_products++;

            // Prođi sve fajlove u tom SKU folderu
            $files = glob($sku_dir . '/*');
            if (is_array($files)) {
                sort($files, SORT_NATURAL | SORT_FLAG_CASE);
            }

            $this->model_extension_module_qiqo->clearSyncedProductDocuments($product_id, $sku, (array)$files);

            foreach ((array)$files as $file) {
                if (!is_file($file)) continue;

                $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));

                if (in_array($ext, ['jpg','jpeg','png'])) {
                    // SLIKA
                    $this->model_extension_module_qiqo->syncProductImageFromFile($product_id, $sku, $file, $base_dir);
                } elseif (in_array($ext, $document_extensions, true)) {
                    // DOKUMENT
                    $this->model_extension_module_qiqo->syncProductDocumentFromFile($product_id, $sku, $file, $base_dir);
                }
            }
        }

        // Po želji obriši privremeni folder
        $this->rrmdir($tmp_dir);

        $this->session->data['success'] = 'Obrađeno proizvoda: ' . $processed_products;
        $this->response->redirect($this->url->link('extension/module/qiqo', 'user_token=' . $this->session->data['user_token'], true));
    }

    /**
     * Rekurzivno briše folder.
     */
    protected function rrmdir($dir)
    {
        if (!is_dir($dir)) return;

        $objects = scandir($dir);
        foreach ($objects as $object) {
            if ($object == '.' || $object == '..') continue;
            $path = $dir . '/' . $object;
            if (is_dir($path)) {
                $this->rrmdir($path);
            } else {
                @unlink($path);
            }
        }
        @rmdir($dir);
    }



}
