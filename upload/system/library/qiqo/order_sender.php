<?php

/**
 * Small NarudzbaSend HTTP client with explicit ambiguous-delivery handling.
 */
class QiqoOrderSender {
	public function send($endpoint, $username, $password, array $credential_free_payload) {
		$endpoint = trim((string)$endpoint);
		$username = (string)$username;
		$password = (string)$password;

		$parts = parse_url($endpoint);
		if (!$parts
			|| empty($parts['scheme'])
			|| !in_array(strtolower($parts['scheme']), array('http', 'https'), true)
			|| empty($parts['host'])
			|| isset($parts['user'])
			|| isset($parts['pass'])) {
			return $this->result('failed', 0, 'CONFIG_ENDPOINT', 'NarudzbaSend endpoint nije valjan.', '');
		}
		if ($username === '' || $password === '') {
			return $this->result('failed', 0, 'CONFIG_CREDENTIALS', 'NarudzbaSend vjerodajnice nisu konfigurirane.', '');
		}
		if (empty($credential_free_payload['narudzba']) || !is_array($credential_free_payload['narudzba'])) {
			return $this->result('failed', 0, 'INVALID_PAYLOAD', 'NarudzbaSend payload nema objekt narudzba.', '');
		}

		$request = array(
			'korisnik' => $username,
			'lozinka' => $password,
			'narudzba' => $credential_free_payload['narudzba']
		);
		$body = json_encode($request, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRESERVE_ZERO_FRACTION);
		if ($body === false) {
			return $this->result('failed', 0, 'INVALID_JSON', 'NarudzbaSend zahtjev nije moguće pretvoriti u JSON.', '');
		}

		$ch = curl_init($endpoint);
		curl_setopt_array($ch, array(
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => $body,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_HEADER => false,
			CURLOPT_CONNECTTIMEOUT => 5,
			CURLOPT_TIMEOUT => 20,
			CURLOPT_HTTPHEADER => array('Content-Type: application/json', 'Accept: application/json'),
			CURLOPT_SSL_VERIFYPEER => true,
			CURLOPT_SSL_VERIFYHOST => 2
		));

		$response = curl_exec($ch);
		$curl_errno = curl_errno($ch);
		$curl_error = curl_error($ch);
		$http_status = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);

		$response_text = $this->summariseUnvalidatedResponse($response === false ? '' : (string)$response);

		if ($curl_errno) {
			$definitely_not_delivered = in_array($curl_errno, array(CURLE_COULDNT_RESOLVE_HOST, CURLE_COULDNT_CONNECT, CURLE_URL_MALFORMAT), true);
			$state = $definitely_not_delivered ? 'failed' : 'uncertain';
			return $this->result($state, $http_status, 'CURL_' . $curl_errno, $this->sanitiseResponse($curl_error, $username, $password), $response_text);
		}

		if ($http_status < 200 || $http_status >= 300) {
			// A 5xx/empty upstream response can arrive after the ERP accepted the order.
			// Mark it uncertain so an operator verifies it before any retry.
			$state = $this->classifyHttpFailureState($http_status);
			return $this->result($state, $http_status, 'HTTP_' . $http_status, 'NarudzbaSend je vratio HTTP ' . $http_status . '.', $response_text);
		}

		return $this->interpretSuccessResponse($http_status, (string)$response, $username, $password);
	}

	protected function interpretSuccessResponse($http_status, $response, $username, $password) {
		$response_text = $this->summariseUnvalidatedResponse((string)$response);
		$decoded = json_decode((string)$response, true);
		if (!is_array($decoded) || !array_key_exists('ErrorCode', $decoded)) {
			return $this->result('uncertain', $http_status, 'INVALID_RESPONSE', 'ERP je vratio neprepoznatljiv odgovor; prije ponavljanja provjeriti bazu Italcro.', $response_text);
		}

		$raw_error_code = $decoded['ErrorCode'];
		$is_integer_code = is_int($raw_error_code)
			|| (is_float($raw_error_code) && is_finite($raw_error_code) && floor($raw_error_code) === $raw_error_code)
			|| (is_string($raw_error_code) && preg_match('/^-?[0-9]+$/', trim($raw_error_code)));
		if (!$is_integer_code) {
			return $this->result('uncertain', $http_status, 'INVALID_ERROR_CODE', 'ERP je vratio nevaljan ErrorCode; prije ponavljanja provjeriti bazu Italcro.', $response_text);
		}

		$error_code = trim((string)$raw_error_code);
		$description = isset($decoded['ErrorDescription']) && is_scalar($decoded['ErrorDescription'])
			? $this->sanitiseResponse((string)$decoded['ErrorDescription'], $username, $password)
			: '';
		$validated_response = json_encode(array(
			'ErrorCode' => $error_code,
			'ErrorDescription' => $description
		), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
		$response_text = is_string($validated_response) ? $validated_response : $response_text;
		if ((int)$raw_error_code === 0) {
			return $this->result('sent', $http_status, $error_code, $description !== '' ? $description : 'OK', $response_text);
		}

		return $this->result('failed', $http_status, $error_code, $description !== '' ? $description : 'ERP je odbio narudžbu.', $response_text);
	}

	protected function classifyHttpFailureState($http_status) {
		$http_status = (int)$http_status;
		$ambiguous_statuses = array(408, 409, 425, 429);
		$is_redirect = $http_status >= 300 && $http_status < 400;

		return $is_redirect || $http_status >= 500 || in_array($http_status, $ambiguous_statuses, true)
			? 'uncertain'
			: 'failed';
	}

	private function result($state, $http_status, $error_code, $description, $response) {
		return array(
			'state' => $state,
			'http_status' => (int)$http_status,
			'error_code' => (string)$error_code,
			'description' => (string)$description,
			'response' => (string)$response
		);
	}

	protected function sanitiseResponse($value, $username, $password) {
		$value = (string)$value;
		foreach (array($username, $password) as $secret) {
			if ($secret !== '') {
				$variants = array(
					(string)$secret,
					rawurlencode((string)$secret),
					urlencode((string)$secret),
					htmlspecialchars((string)$secret, ENT_QUOTES | ENT_HTML5, 'UTF-8')
				);
				foreach (array(
					json_encode((string)$secret),
					json_encode((string)$secret, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
				) as $json_secret) {
					if (is_string($json_secret) && strlen($json_secret) >= 2) {
						$variants[] = substr($json_secret, 1, -1);
					}
				}
				usort($variants, function ($left, $right) {
					return strlen($right) <=> strlen($left);
				});
				$value = str_replace(array_unique($variants), '[REDACTED]', $value);
			}
		}

		$value = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F]/', '', $value);
		return function_exists('mb_substr') ? mb_substr($value, 0, 4000, 'UTF-8') : substr($value, 0, 4000);
	}

	private function summariseUnvalidatedResponse($value) {
		$value = (string)$value;
		return 'unvalidated_response bytes=' . strlen($value) . ' sha256=' . hash('sha256', $value);
	}
}
