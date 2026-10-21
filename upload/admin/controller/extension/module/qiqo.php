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
                case 'preview_catalog':
                    $preview = $this->request->post['action'] === 'preview_catalog';
                    $stats = $this->model_extension_module_qiqo->reconcileCatalog(!$preview);
                    if (!$stats['success']) {
                        if ($stats['error'] === 'maintenance_backup_required') {
                            $this->session->data['error'] = 'Pregled je pripremljen, ali uvoz ove baze zahtijeva kontrolirani postupak uz sigurnosnu kopiju i način održavanja. Koristi CLI uvoz kataloga.';
                        } elseif ($stats['partial']) {
                            $this->session->data['error'] = 'Uvoz je prekinut nakon dijela upisa. Provjeri QIQO log i sigurnosnu kopiju prije ponavljanja.';
                        } else {
                            $this->session->data['error'] = 'Uvoz je sigurnosno prekinut prije promjene kataloga. Provjeri QIQO log i ERP podatke.';
                        }
                    } else {
                        $prefix = $preview ? 'Pregled uvoza' : 'Uvoz završen';
                        $this->session->data['success'] = "{$prefix}: novih {$stats['added']}, ažuriranih {$stats['updated']}, bez promjene {$stats['unchanged']}, deaktiviranih {$stats['disabled']}, ponovno aktiviranih {$stats['reactivated']}.";
                    }
                    break;

                case 'update_qty':
                    $count = $this->model_extension_module_qiqo->updateQuantities();
                    $this->session->data[$count < 0 ? 'error' : 'success'] = $count < 0
                        ? 'Ažuriranje količina i statusa je prekinuto. Provjeri QIQO log i ERP podatke.'
                        : "Ažurirane količine i status za {$count} artikala.";
                    break;

                case 'update_price':
                    $count = $this->model_extension_module_qiqo->updatePrices();
                    if ($count < 0) {
                        $this->session->data['error'] = 'Ažuriranje cijena nije dovršeno. Provjerite QIQO log prije ponavljanja; dio cijena možda je već osvježen.';
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
                    if (!$this->model_extension_module_qiqo->hasPartnerArticleDiscountWatermark()) {
                        $this->session->data['error'] = 'Sigurnosno blokirano: početno partner-artikl punjenje (~2 milijuna slogova) nije dopušteno kroz preglednik. Potreban je kontrolirani inicijalni import.';
                    } else {
                        $result = $this->model_extension_module_qiqo->syncPartnerArticleDiscounts();
                        if (!empty($result['success'])) {
                            $this->session->data['success'] = !empty($result['empty'])
                                ? 'Partner-artikl inkrementalni sync završen: ERP nije vratio promjene.'
                                : 'Partner-artikl inkrementalni sync: ' . (int)$result['count'] . ' promjena.';
                        } else {
                            $this->session->data['error'] = 'Partner-artikl inkrementalni sync nije uspio; postojeći rabati i watermark su sačuvani. Provjeri QIQO log.';
                        }
                    }
                    break;

                case 'sync_partner_all':
                    if (!$this->model_extension_module_qiqo->hasPartnerArticleDiscountWatermark()) {
                        $this->session->data['error'] = 'Sigurnosno blokirano: kompletan sync ne može uključiti partner-artikl rabate prije kontroliranog inicijalnog importa.';
                    } else {
                        $stats = $this->model_extension_module_qiqo->syncPartnerBaseData();
                        $discountResult = $this->model_extension_module_qiqo->syncPartnerArticleDiscounts();
                        if (!empty($discountResult['success'])) {
                            $this->session->data['success'] = "Kompletan inkrementalni sync: partneri {$stats['partners']}, mjesta {$stats['delivery_places']}, komercijalisti {$stats['sales_reps']}, akcije {$stats['action_prices']}, partner-artikl rabati " . (int)$discountResult['count'] . '.';
                        } else {
                            $this->session->data['error'] = 'Osnovni partner podaci su obrađeni, ali partner-artikl rabati nisu; postojeći rabati i watermark su sačuvani.';
                        }
                    }
                    break;

                case 'update_article_partners':
                    try {
                        $stats = $this->model_extension_module_qiqo->updateArticlePartners();
                        $this->session->data['success'] = "Partner update artikala: ažurirano {$stats['updated']}, bez promjene {$stats['unchanged']}, bez proizvoda {$stats['missing_product']}, bez partnera u API {$stats['missing_partner']}, preskočeno (schema) {$stats['skipped_schema']}.";
                    } catch (\Throwable $e) {
                        $this->session->data['error'] = 'Ažuriranje dobavljača na artiklima nije uspjelo. Provjeri QIQO vezu i konfiguraciju u upload/env.php (QIQO_SOAP_URL, QIQO_USERNAME, QIQO_PASSWORD). Rabati kupac–artikl ažuriraju se zasebnom sinkronizacijom.';
                    }
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
        $data['partner_discount_incremental_ready'] = $this->model_extension_module_qiqo->hasPartnerArticleDiscountWatermark();
        if (empty($this->session->data['qiqo_discount_job_csrf'])) {
            $this->session->data['qiqo_discount_job_csrf'] = bin2hex(random_bytes(24));
        }
        $data['discount_job_csrf'] = $this->session->data['qiqo_discount_job_csrf'];
        $data['discount_job_start'] = $this->url->link('extension/module/qiqo/discountJobStart', 'user_token=' . $this->session->data['user_token'], true);
        $data['discount_job_status'] = $this->url->link('extension/module/qiqo/discountJobStatus', 'user_token=' . $this->session->data['user_token'], true);
        $job = null;
        if (!empty($this->session->data['qiqo_discount_job_id'])) {
            try {
                require_once DIR_SYSTEM . 'library/qiqo/discount_job.php';
                $job = QiqoDiscountJob::status($this->qiqoJobRoot(), (string)$this->session->data['qiqo_discount_job_id']);
                if (!$job || (int)($job['user_id'] ?? 0) !== (int)$this->user->getId()) $job = null;
            } catch (\Throwable $error) {
                $job = null;
            }
        }
        $data['discount_job_json'] = json_encode($job, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
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

    public function discountJobStart()
    {
        if (!$this->user->hasPermission('modify', 'extension/module/qiqo')) {
            $this->qiqoJobJson(['success' => false, 'error' => 'Nemate dopuštenje za ažuriranje rabata.'], 403);
            return;
        }
        $expected = (string)($this->session->data['qiqo_discount_job_csrf'] ?? '');
        $supplied = (string)($this->request->post['csrf'] ?? '');
        if (($this->request->server['REQUEST_METHOD'] ?? '') !== 'POST' || $expected === '' || !hash_equals($expected, $supplied)) {
            $this->qiqoJobJson(['success' => false, 'error' => 'Sesija je istekla. Osvježite stranicu i pokušajte ponovno.'], 403);
            return;
        }
        $job = null;
        try {
            require_once DIR_SYSTEM . 'library/qiqo/discount_job.php';
            $root = $this->qiqoJobRoot();
            $job = QiqoDiscountJob::create($root, (int)$this->user->getId());
            if ((int)($job['user_id'] ?? 0) !== (int)$this->user->getId()) {
                $this->qiqoJobJson(['success' => false, 'error' => 'Drugi administrator već je pokrenuo uvoz rabata. Pričekajte završetak.'], 409);
                return;
            }
            $this->session->data['qiqo_discount_job_id'] = $job['id'];
            if (!empty($job['existing'])) {
                $this->qiqoJobJson(['success' => true, 'job' => $job]);
                return;
            }
            if (!$this->launchDiscountJob($root, $job['id'])) {
                QiqoDiscountJob::fail($root, $job['id'], 'launch_failed');
                $this->qiqoJobJson(['success' => false, 'error' => 'Server nije uspio pokrenuti uvoz u pozadini. Postojeći rabati su sačuvani.'], 500);
                return;
            }
            $this->qiqoJobJson(['success' => true, 'job' => $job]);
        } catch (\Throwable $error) {
            if ($job && empty($job['existing'])) {
                try { QiqoDiscountJob::fail($this->qiqoJobRoot(), $job['id'], 'launch_failed'); } catch (\Throwable $ignored) {}
            }
            $this->qiqoJobJson(['success' => false, 'error' => 'Uvoz rabata nije pokrenut. Provjerite je li drugi uvoz već u tijeku i pokušajte ponovno.'], 409);
        }
    }

    public function discountJobStatus()
    {
        if (!$this->user->hasPermission('access', 'extension/module/qiqo')) {
            $this->qiqoJobJson(['success' => false, 'error' => 'Nemate dopuštenje za pregled uvoza.'], 403);
            return;
        }
        $id = (string)($this->request->get['job_id'] ?? '');
        if (!preg_match('/^[a-f0-9]{32}$/D', $id)) {
            $this->qiqoJobJson(['success' => false, 'error' => 'Uvoz nije pronađen.'], 404);
            return;
        }
        try {
            require_once DIR_SYSTEM . 'library/qiqo/discount_job.php';
            $job = QiqoDiscountJob::status($this->qiqoJobRoot(), $id);
            if (!$job || (int)($job['user_id'] ?? 0) !== (int)$this->user->getId()) {
                $this->qiqoJobJson(['success' => false, 'error' => 'Uvoz nije pronađen za ovaj korisnički račun.'], 404);
                return;
            }
            $this->qiqoJobJson(['success' => true, 'job' => $job]);
        } catch (\Throwable $error) {
            $this->qiqoJobJson(['success' => false, 'error' => 'Status uvoza trenutačno nije dostupan.'], 500);
        }
    }

    private function qiqoJobRoot(): string
    {
        return dirname(rtrim(DIR_SYSTEM, '/\\'), 2);
    }

    protected function launchDiscountJob(string $root, string $id): bool
    {
        $disabled = array_map('trim', explode(',', (string)ini_get('disable_functions')));
        if (!function_exists('exec') || in_array('exec', $disabled, true)) return false;
        $php = null;
        $matchingCli = preg_replace('/-fpm$/', '', PHP_BINARY);
        foreach ([$matchingCli, PHP_BINDIR . '/php', '/usr/local/bin/php', '/usr/bin/php'] as $candidate) {
            if (preg_match('/^php(?:[0-9.]+)?$/', basename($candidate)) && is_file($candidate) && is_executable($candidate)) { $php = $candidate; break; }
        }
        if ($php === null || !is_file($root . '/scripts/run_qiqo_discount_job.php')) return false;
        $log = QiqoDiscountJob::directory($root) . '/' . $id . '.worker.log';
        $command = 'nohup ' . escapeshellarg($php) . ' ' . escapeshellarg($root . '/scripts/run_qiqo_discount_job.php')
            . ' ' . escapeshellarg('--job=' . $id) . ' > ' . escapeshellarg($log) . ' 2>&1 < /dev/null & echo $!';
        $output = [];
        exec($command, $output, $exit);
        return $exit === 0 && isset($output[0]) && preg_match('/^[1-9][0-9]*$/D', trim($output[0]));
    }

    private function qiqoJobJson(array $value, int $status = 200): void
    {
        if ($status !== 200) {
            $labels = [403 => 'Forbidden', 404 => 'Not Found', 409 => 'Conflict', 500 => 'Internal Server Error'];
            $this->response->addHeader('HTTP/1.1 ' . $status . ' ' . ($labels[$status] ?? 'Error'));
        }
        $this->response->addHeader('Content-Type: application/json; charset=utf-8');
        $this->response->addHeader('Cache-Control: no-store');
        $this->response->setOutput(json_encode($value, JSON_UNESCAPED_UNICODE));
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
