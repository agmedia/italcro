<?php
class ControllerExtensionCaptchaGoogle extends Controller {
    public function index($error = array()) {
        $this->load->language('extension/captcha/google');

        if (isset($error['captcha'])) {
			$data['error_captcha'] = $error['captcha'];
		} else {
			$data['error_captcha'] = '';
		}

		$data['site_key'] = $this->config->get('captcha_google_key');

        $data['route'] = $this->request->get['route']; 

            
            $data['recaptcha_action'] = str_replace('/', '', $data['route']);
            
			

		return $this->load->view('extension/captcha/google', $data);
    }

    
    
    		public function validate()
    		{    		
				if (empty($this->session->data['gcapcha'])) {
					$this->load->language('extension/captcha/google');

					if (!isset($this->request->post['recaptcha_response'])) {
						return $this->language->get('error_captcha');
					}
					
					if (version_compare(VERSION, '3.0', '>=')) {
						$secret = $this->config->get('captcha_google_secret');
					} else {
						$secret = $this->config->get('google_captcha_secret');
					}
					
    				$curl = curl_init();
    				
    				$curl_options = array(
        				CURLOPT_URL => "https://www.google.com/recaptcha/api/siteverify",
        				CURLOPT_POST => true,
        				CURLOPT_RETURNTRANSFER => true,
        				CURLOPT_POSTFIELDS => array(
            				'secret' => $secret,
            				'response' => $this->request->post['recaptcha_response'],
            				'remoteip' => $_SERVER['REMOTE_ADDR']));
    
    				curl_setopt_array($curl, $curl_options);
    
    				$response = curl_exec($curl);
    					
        			curl_close($curl);
					
                    $result = json_decode($response, true);
                    
					if (!empty($result['success']) && ($result['score'] >= $this->config->get('captcha_google_score'))) {
						$this->session->data['gcapcha']	= true;
					} else {
						return $this->language->get('error_captcha');						
					}
				}
			}
			
			public function validateOld() {
			
		if (empty($this->session->data['gcapcha'])) {
			$this->load->language('extension/captcha/google');

			if (!isset($this->request->post['g-recaptcha-response'])) {
				return $this->language->get('error_captcha');
			}

			$recaptcha = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($this->config->get('captcha_google_secret')) . '&response=' . $this->request->post['g-recaptcha-response'] . '&remoteip=' . $this->request->server['REMOTE_ADDR']);

			$recaptcha = json_decode($recaptcha, true);

			if ($recaptcha['success']) {
				$this->session->data['gcapcha']	= true;
			} else {
				return $this->language->get('error_captcha');
			}
		}
    }
}
