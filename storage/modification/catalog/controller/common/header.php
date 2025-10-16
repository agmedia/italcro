<?php
class ControllerCommonHeader extends Controller {
	public function index() {

		// Security Headers 
		$this->load->model('setting/setting');
		$get_security_headers_settings = $this->model_setting_setting->getSetting('module_security_headers', (int)$this->config->get('config_store_id'));
		$security_headers_settings = isset($get_security_headers_settings['module_security_headers_status']) ? $get_security_headers_settings['module_security_headers_status'] : false;
		
		if ($security_headers_settings and $security_headers_settings['status']) {
		
		        if (isset($security_headers_settings['forward']) && $security_headers_settings['forward']) {
		        $forward_headers = array(       'CLIENT_IP','FORWARDED','FORWARDED_FOR',
		                                        'FORWARDED_FOR_IP','VIA','X_FORWARDED',
		                                        'X_FORWARDED_FOR','HTTP_CLIENT_IP',
		                                        'HTTP_FORWARDED','HTTP_FORWARDED_FOR',
                                                        'HTTP_FORWARDED_FOR_IP','HTTP_PROXY_CONNECTION',
                                                        'HTTP_VIA','HTTP_X_FORWARDED','HTTP_X_FORWARDED_FOR'
                                                );
		                foreach ($forward_headers as $key => $header) {
		                                $this->response->delHeader($header);
		                }
		        }
		        
		        if (isset($security_headers_settings['ranges']) && $security_headers_settings['ranges']) {
		        $range_headers = array('Accept-Ranges','Content-Range','Range','If-Range');
		                foreach ($range_headers as $key => $header) {
                                                $this->response->delHeader($header);
		                }
		            $this->response->addHeader("Accept-Ranges: none");    
		        }

		        if (isset($security_headers_settings['proxy']) && $security_headers_settings['proxy']) { 
		                $this->response->delHeader('Proxy');
                        }
                        
		        if (isset($security_headers_settings['X_HTTP_Method_Override']) && $security_headers_settings['X_HTTP_Method_Override']) {
                                $this->response->delHeader('X-HTTP-Method-Override');
                        }
                        
		        if (isset($security_headers_settings['X_Powered_By']) && $security_headers_settings['X_Powered_By']) { 
		                $this->response->delHeader('X-Powered-By');
                        }
                        
		        if (!empty($security_headers_settings['X_XSS_Protection'])) {
		                $this->response->delHeader('X-XSS-Protection');
		                $this->response->addHeader('X-XSS-Protection: '.$security_headers_settings['X_XSS_Protection']);
		        }
		         
		        if (!empty($security_headers_settings['X_Frame_Options'])) { 
		                $this->response->delHeader('X-Frame-Options');
		                $this->response->addHeader('X-Frame-Options: '.$security_headers_settings['X_Frame_Options']);
                        }
                        		                
		        if (!empty($security_headers_settings['X_Content_Type_Options'])) {
		                $this->response->delHeader('X-Content-Type-Options');
		                $this->response->addHeader('X-Content-Type-Options: '.$security_headers_settings['X_Content_Type_Options']);
		        }
		                
		        if (!empty($security_headers_settings['Referrer_Policy'])) { 
		                $this->response->delHeader('Referrer-Policy');
		                $this->response->addHeader('Referrer-Policy: '.$security_headers_settings['Referrer_Policy']);
		        }
		        
		        $isSSL = $this->model_setting_setting->getSetting('config', (int)$this->config->get('config_store_id'))['config_secure'];
		        if ((int)$isSSL > 0) {
        		        if (!empty($security_headers_settings['CSP'])) { 
        		                $this->response->delHeader('Content-Security-Policy');
        		                $this->response->addHeader('Content-Security-Policy: '.$security_headers_settings['CSP']);
        		        }
        		        
        		        if (!empty($security_headers_settings['Strict_Transport_Security'])) {
        		                $this->response->delHeader('Strict-Transport-Security');
                                        $this->response->addHeader('Strict-Transport-Security: max-age='.$security_headers_settings['Strict_Transport_Security'].';');
                                }
                        }
                        if (!empty($security_headers_settings['Expect_CT'])) {
                                $this->response->delHeader('Expect-CT');
                                if (!empty($security_headers_settings['Expect_CT']['max_age'])) {
                                        if (!empty($security_headers_settings['Expect_CT']['report_uri'])) {
                                                $this->response->addHeader('Expect-CT: max-age='.$security_headers_settings['Expect_CT']['max_age'].'; '.$security_headers_settings['Expect_CT']['report_uri']);
                                        } 
                                }
                        }
                        $fp_header = '';
                        $this->response->delHeader('Feature-Policy');
                        foreach ($security_headers_settings['Feature_Policy'] as $key => $value) {
                                if (!empty($value)) {
                                        $fp_header .= $key." ".$value."; ";
                                }
                        }
                        $fp_header = str_replace('_','-',$fp_header);
                        !empty($fp_header) ? $this->response->addHeader('Feature-Policy: '.$fp_header) : false;
		}
		// Security Headers
            

				// << Product Option Image PRO module
				if ( class_exists('\liveopencart\ext\poip') ) {
					liveopencart\ext\poip::getInstance($this->registry);
	
					$data['poip_installed'] = $this->liveopencart_ext_poip->installed();
					$data['poip_settings'] = $this->liveopencart_ext_poip->getModel()->getSettings();
					$data['poip_theme_name'] = $this->liveopencart_ext_poip->getModel()->getThemeName();
					
					$this->liveopencart_ext_poip->getModel()->addHeaderResources();
				}
				// >> Product Option Image PRO module
			

				$mssConfig = $this->config->get( 'msmart_search_s' );
				$mssConfigLf = (array) $this->config->get( 'msmart_search_lf' );
				$mssVer = ! empty( $mssConfig['minify_support'] ) ? '' : '?v' .$this->config->get( 'msmart_search_version' );
				$mssFiles = array(
					'js' => array( 'js_params.js', 'bloodhound.min.js', 'typeahead.jquery.min.js', 'live_search.min.js' ),
					'css' => array( 'style.css', 'style-2.css' ),
				);
				
				foreach( $mssFiles as $mssType => $mssFiles2 ) {
					$mssPath = $mssType == 'js' ? 'catalog/view/javascript/mss/' : 'catalog/view/theme/default/stylesheet/mss/';
					
					foreach( $mssFiles2 as $mssFile ) {
						$this->document->{'add'.($mssType == 'js' ? 'Script' : 'Style')}( $mssPath . $mssFile . $mssVer . ( $mssVer && $mssFile == 'js_params.js' ? '_'.time() : '' ) );
					}
				}
				
				$data['mss_lang_direction'] = $this->language->get('direction');
				
				require_once DIR_SYSTEM . 'library/msmart_search_mobile.php';

				/* @var $mobile Mobile_Detect_MSS */
				$mssMobile = new Mobile_Detect_MSS();

				$data['mss_mode'] = empty( $mssConfigLf['mode'] ) || $mssMobile->isMobile() ? 'standard' : $mssConfigLf['mode'];
			
		// Analytics
		$this->load->model('setting/extension');

		$data['analytics'] = array();
if(file_exists('catalog/model/extension/cmpltguagaf.php')) { 
				$this->load->model('extension/cmpltguagaf');
				$data['analytics'][] = $this->model_extension_cmpltguagaf->pageview();
			}

		$analytics = $this->model_setting_extension->getExtensions('analytics');

		foreach ($analytics as $analytic) {
			if ($this->config->get('analytics_' . $analytic['code'] . '_status')) {
				$data['analytics'][] = $this->load->controller('extension/analytics/' . $analytic['code'], $this->config->get('analytics_' . $analytic['code'] . '_status'));
			}
		}

		if ($this->request->server['HTTPS']) {
			$server = $this->config->get('config_ssl');
		} else {
			$server = $this->config->get('config_url');
		}

		if (is_file(DIR_IMAGE . $this->config->get('config_icon'))) {
			$this->document->addLink($server . 'image/' . $this->config->get('config_icon'), 'icon');
		}

		$data['title'] = $this->document->getTitle();

				if (is_array($this->document->getOpengraph())) { 
				   $data['opengraphs'] = $this->document->getOpengraph();
				}else{
					$data['opengraphs'] = '';
				}
				if (is_array($this->document->getTwittercard())) { 
				   $data['twittercards'] = $this->document->getTwittercard();
				}else{
					$data['twittercards'] = '';
				}
				
				if (is_array($this->document->getStructureddata())) { 
				    $data['jsonld_data'] = $this->document->getStructureddata();
				}else{
				    $data['jsonld_data'] = '';
				}
				

			if ($this->config->get('theme_default_directory') == 'basel') {
			include(DIR_APPLICATION . 'controller/extension/basel/header_helper.php');
			}
			


			/*start gdpr 28-07-2018*/
  			/*mpgdpr starts*/
  			$data['mpgdpr_status'] = $this->config->get('mpgdpr_status');
  			$data['mpgdpr_cbstatus'] = $this->config->get('mpgdpr_cbstatus');
  			/*mpgdpr ends*/
  			/*end gdpr 28-07-2018*/
			
		$data['base'] = $server;
		$data['description'] = $this->document->getDescription();
		$data['keywords'] = $this->document->getKeywords();
		$data['links'] = $this->document->getLinks();
		$data['robots'] = $this->document->getRobots();
		$data['styles'] = $this->document->getStyles();
		$data['scripts'] = $this->document->getScripts('header');
		$data['lang'] = $this->language->get('code');
		$data['direction'] = $this->language->get('direction');

		$data['name'] = $this->config->get('config_name');

		if (is_file(DIR_IMAGE . $this->config->get('config_logo'))) {
			$data['logo'] = $server . 'image/' . $this->config->get('config_logo');
		} else {
			$data['logo'] = '';
		}

		$this->load->language('common/header');

if (!isset($_GET['route']) || (isset($_GET['route']) && $_GET['route'] == 'common/home')) {


	//	if(!isset($this->request->get['route'])  || $this->request->get['route'] =='') {
			$data['is_home'] = 1;
		}


		// Wishlist
		if ($this->customer->isLogged()) {
			$this->load->model('account/wishlist');

			$data['text_wishlist'] = sprintf($this->language->get('text_wishlist'), $this->model_account_wishlist->getTotalWishlist());
		} else {
			$data['text_wishlist'] = sprintf($this->language->get('text_wishlist'), (isset($this->session->data['wishlist']) ? count($this->session->data['wishlist']) : 0));
		}

		$data['text_logged'] = sprintf($this->language->get('text_logged'), $this->url->link('account/account', '', true), $this->customer->getFirstName(), $this->url->link('account/logout', '', true));
		
		$data['home'] = $this->url->link('common/home');

			//// xml ////
			$data['faq'] = $this->url->link('extension/faq');
			$data['text_faq'] = $this->language->get('text_faq');
			
			$faqtitle=$this->config->get('tmdfaqsetting_faqdescription');
			if(!empty($faqtitle[$this->config->get('config_language_id')]['title'])){
				$data['faqtitle']	= $faqtitle[$this->config->get('config_language_id')]['title'];
			} else {
				$data['faqtitle'] = $this->language->get('text_faq');
			}
			//// xml ////
			
		$data['wishlist'] = $this->url->link('account/wishlist', '', true);
		$data['logged'] = $this->customer->isLogged();
		$data['account'] = $this->url->link('account/account', '', true);
		$data['register'] = $this->url->link('account/register', '', true);
		$data['login'] = $this->url->link('account/login', '', true);
		$data['order'] = $this->url->link('account/order', '', true);
		$data['transaction'] = $this->url->link('account/transaction', '', true);
		$data['download'] = $this->url->link('account/download', '', true);
		$data['logout'] = $this->url->link('account/logout', '', true);
		$data['shopping_cart'] = $this->url->link('checkout/cart');
		$data['checkout'] = $this->url->link('checkout/checkout', '', true);
		$data['contact'] = $this->url->link('information/contact');
		$data['telephone'] = $this->config->get('config_telephone');

		
		
		$data['language'] = $this->load->controller('common/language');
		$data['currency'] = $this->load->controller('common/currency');
		$data['search'] = $this->load->controller('common/search');
		$data['cart'] = $this->load->controller('common/cart');
		$data['menu'] = $this->load->controller('common/menu');
		$data['code'] = $this->language->get('code');
		if ($data['code']=='en'){

			$data['kode'] = 'en-gb';


		}

		else if ($data['code']=='de'){

			$data['kode'] = 'de-de';


		}

		else{
			$data['kode'] = 'hr-hr';
		}

		return $this->load->view('common/header', $data);
	}
}
