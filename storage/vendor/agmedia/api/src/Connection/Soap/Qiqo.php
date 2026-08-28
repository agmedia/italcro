<?php

namespace Agmedia\Api\Connection\Soap;

use Agmedia\Helpers\Log;
use Exception;
use SimpleXMLElement;

//require_once __DIR__ . '/../../../../../../../upload/config.php';

class Qiqo
{
    /**
     * @var string
     */
    private string $url;
    
    /**
     * @var string
     */
    private string $korisnik;
    
    /**
     * @var string
     */
    private string $lozinka;

    /** @var array{method:string,success:bool,empty:bool,error:?string,count:int} */
    private array $lastFetchResult = [
        'method' => '',
        'success' => false,
        'empty' => false,
        'error' => 'not_started',
        'count' => 0,
    ];

    private ?string $lastTransportError = null;
    
    
    public function __construct(?string $korisnik = null, ?string $lozinka = null, ?string $url = null)
    {
        $this->korisnik = $this->resolveConfigValue($korisnik, 'qiqo.username');
        $this->lozinka = $this->resolveConfigValue($lozinka, 'qiqo.password');
        $this->url = $this->resolveConfigValue($url, 'qiqo.url');

        $scheme = strtolower((string)parse_url($this->url, PHP_URL_SCHEME));
        if (!filter_var($this->url, FILTER_VALIDATE_URL) || !in_array($scheme, ['http', 'https'], true)) {
            throw new \RuntimeException('Qiqo endpoint configuration is invalid.');
        }

        if ($scheme === 'http' && !$this->isInsecureHttpExplicitlyAllowed()) {
            throw new \RuntimeException('Insecure Qiqo HTTP transport is disabled. Use HTTPS or explicitly set QIQO_ALLOW_INSECURE_HTTP=1 for an approved private tunnel.');
        }
    }

    /**
     * The feed synchronizer uses this status to distinguish a valid empty feed
     * from transport/parser failures. Existing callers can keep consuming rows.
     *
     * @return array{method:string,success:bool,empty:bool,error:?string,count:int}
     */
    public function getLastFetchResult(): array
    {
        return $this->lastFetchResult;
    }
    
    
    /**
     * 📦 Dohvati artikle (qArtikliWeb)
     */
    public function getArticles(string $since = '-2 years'): array
    {
        return $this->fetch('qArtikliWeb', $since, 'lines');
    }
    
    
    /**
     * 📦 Dohvati grupe (qKatalogGrupaWeb)
     */
    public function getGroups(string $since = '-2 years'): array
    {
        return $this->fetch('qKatalogGrupaWeb', $since, 'KatalogGrupa');
    }

    public function getPartners(string $since = '-2 years'): array
    {
        return $this->fetch('qPartnerWeb', $since, 'Partner');
    }

    /**
     * 📦 Dohvati mjesta isporuke (qMjestoIsporukeWeb)
     */
    public function getDeliveryPlaces(string $since = '-2 years'): array
    {
        return $this->fetch('qMjestoIsporukeWeb', $since, null);
    }

    /**
     * 📦 Dohvati komercijaliste (qKomercijalistWeb)
     */
    public function getSalesReps(string $since = '-2 years'): array
    {
        $method = 'qKomercijalistWeb';
        $rows = $this->fetch($method, $since, null);

        if ($rows) {
            Log::store("✅ Sales reps resolved via {$method}", 'qiqo_info');
            return $rows;
        }

        Log::store("⚠️ {$method} returned no sales reps.", 'qiqo_empty');

        return [];
    }

    /**
     * 📦 Dohvati dodatne rabate po artiklu i partneru (qPartnerArtikalRabatWeb)
     */
    public function getPartnerArticleDiscounts(string $since = '-2 years'): array
    {
        return $this->fetch('qPartnerArtikalRabatWeb', $since, null);
    }

    /**
     * 📦 Dohvati akcijski cjenik (qAkcijskiCjenikWeb)
     */
    public function getActionPriceList(string $since = '-2 years'): array
    {
        return $this->fetch('qAkcijskiCjenikWeb', $since, null);
    }
    
    
    /**
     * 🧭 Glavna metoda – generički SOAP poziv
     */
    private function fetch(string $method, string $since, ?string $node): array
    {
        $this->lastFetchResult = [
            'method' => $method,
            'success' => false,
            'empty' => false,
            'error' => 'request_not_completed',
            'count' => 0,
        ];
        $datum = date('Y-m-d\TH:i:s', strtotime($since));
        $soapAction = "http://www.qiqo.hr/{$method}";

        $xmlKorisnik = htmlspecialchars($this->korisnik, ENT_XML1 | ENT_QUOTES, 'UTF-8');
        $xmlLozinka = htmlspecialchars($this->lozinka, ENT_XML1 | ENT_QUOTES, 'UTF-8');
        $xmlDatum = htmlspecialchars($datum, ENT_XML1 | ENT_QUOTES, 'UTF-8');
        
        $xml = <<<XML
                <?xml version="1.0" encoding="utf-8"?>
                <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
                               xmlns:xsd="http://www.w3.org/2001/XMLSchema"
                               xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
                  <soap:Body>
                    <{$method} xmlns="http://www.qiqo.hr/">
                      <korisnik>{$xmlKorisnik}</korisnik>
                      <lozinka>{$xmlLozinka}</lozinka>
                      <datum>{$xmlDatum}</datum>
                    </{$method}>
                  </soap:Body>
                </soap:Envelope>
                XML;
        
        $response = $this->send($soapAction, $xml);
        if (!$response) {
            Log::store("❌ Empty SOAP response for {$method}", 'qiqo_error');
            $this->lastFetchResult['error'] = $this->lastTransportError ?: 'empty_response';
            return [];
        }

        $response = $this->sanitize($response);
        $records = $this->parse($response, $method, $node);

        if ($this->lastFetchResult['success']) {
            $this->lastFetchResult['count'] = count($records);
            $this->lastFetchResult['empty'] = count($records) === 0;
        }

        return $records;
    }
    
    
    /**
     * 🔹 Izvrši cURL SOAP poziv
     */
    private function send(string $soapAction, string $body): ?string
    {
        $this->lastTransportError = null;

        try {
            $ch = curl_init($this->url);
            curl_setopt_array($ch, [
                CURLOPT_POST           => true,
                CURLOPT_POSTFIELDS     => $body,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CONNECTTIMEOUT => 10,
                CURLOPT_TIMEOUT        => 45,
                CURLOPT_HTTPHEADER     => [
                    'Content-Type: text/xml; charset=utf-8',
                    "SOAPAction: \"{$soapAction}\"",
                ],
            ]);
            
            $response  = curl_exec($ch);
            $httpCode  = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $curlError = curl_error($ch);
            curl_close($ch);
            
            Log::store("SOAP {$soapAction} → {$httpCode}", 'qiqo_http');
            if ($response === false || $curlError !== '') {
                $this->lastTransportError = $curlError !== '' ? 'transport_error' : 'empty_transport_response';
                Log::store('Qiqo transport error.', 'qiqo_http_error');
                return null;
            }

            if ($httpCode < 200 || $httpCode >= 300) {
                $this->lastTransportError = 'http_' . (int)$httpCode;
                Log::store("Qiqo HTTP error: {$httpCode}", 'qiqo_http_error');
                return null;
            }

            return (string)$response;
        } catch (Exception $e) {
            $this->lastTransportError = 'transport_exception';
            Log::store('Qiqo transport exception.', 'qiqo_exception');
            return null;
        }
    }
    
    
    /**
     * 🧹 Očisti XML od kontrolnih znakova
     */
    private function sanitize(string $xml): string
    {
        // 1️⃣ Makni nevažeće znakove
        $xml = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]/u', '', $xml);
        // 2️⃣ Makni entitete tipa &#x1C; i &#28;
        $xml = preg_replace('/&#x(?:1C|1D|1E|1F|0[0-9A-F]);?/i', '', $xml);
        $xml = preg_replace('/&#(?:28|29|30|31);?/i', '', $xml);
        // 3️⃣ Osiguraj UTF-8
        return mb_convert_encoding($xml, 'UTF-8', 'UTF-8');
    }
    
    
    /**
     * 🧩 Parsiraj SOAP XML → array
     */
    private function parse(string $xml, string $method, ?string $node): array
    {
        libxml_use_internal_errors(true);
        $parsed = simplexml_load_string($xml);
        
        if ($parsed === false) {
            libxml_clear_errors();
            Log::store("❌ XML parse error in {$method}", 'qiqo_error');
            $this->lastFetchResult['error'] = 'xml_parse_error';
            return [];
        }
        
        $nsSOAP = 'http://schemas.xmlsoap.org/soap/envelope/';
        $nsQIQO = 'http://www.qiqo.hr/';
        $nsDIFF = 'urn:schemas-microsoft-com:xml-diffgram-v1';
        
        $body = $parsed->children($nsSOAP)->Body;

        if (!isset($body[0])) {
            Log::store("❌ SOAP body not found in {$method}", 'qiqo_error');
            $this->lastFetchResult['error'] = 'soap_body_missing';
            return [];
        }

        $fault = $body->children($nsSOAP)->Fault ?? $body->Fault ?? null;
        if ($fault && isset($fault[0])) {
            Log::store("❌ SOAP fault in {$method}", 'qiqo_error');
            $this->lastFetchResult['error'] = 'soap_fault';
            return [];
        }

        $responseName = $method . 'Response';
        $resultName = $method . 'Result';
        $response = $body->children($nsQIQO)->{$responseName} ?? null;

        if (!$response || !isset($response[0])) {
            Log::store("❌ {$responseName} not found in SOAP response", 'qiqo_error');
            $this->lastFetchResult['error'] = 'response_node_missing';
            return [];
        }

        $result = $response->{$resultName} ?? null;

        if (!$result || !isset($result[0])) {
            Log::store("❌ {$resultName} not found in SOAP response", 'qiqo_error');
            $this->lastFetchResult['error'] = 'result_node_missing';
            return [];
        }

        // Pokušaj dohvatiti diffgram s namespace-om
        $diffgram = $result->children($nsDIFF)->diffgram ?? null;

// Ako ga ne vidi, ručno pronađi čvor koji sadrži "diffgram" u nazivu
        if (!$diffgram) {
            foreach ($result->children() as $child) {
                if (stripos($child->getName(), 'diffgram') !== false) {
                    $diffgram = $child;
                    break;
                }
            }
        }

// Ako ga i dalje nema — logiraj i vrati prazan array
        if (!$diffgram) {
            Log::store("❌ diffgram not found in {$method}", 'qiqo_error');
            $this->lastFetchResult['error'] = 'diffgram_missing';
            return [];
        }

// Pokušaj dohvatiti NewDataSet — i ako namespace zeza, koristi fallback
        $newDataSet = $diffgram->NewDataSet ?? null;
        $hasNewDataSet = $newDataSet !== null && isset($newDataSet[0]);
        if (!$hasNewDataSet) {
            $newDataSet = $diffgram->children()->NewDataSet ?? null;
            $hasNewDataSet = $newDataSet !== null && isset($newDataSet[0]);
        }

        if (!$hasNewDataSet) {
            // ADO.NET serializes a successful empty DataSet as an empty
            // <diffgr:diffgram/> (without NewDataSet). Treat only that exact
            // structure as a valid empty feed; unknown child elements remain a
            // parser failure so malformed responses cannot advance watermarks.
            $diffgramChildren = $diffgram->xpath('./*');
            if (is_array($diffgramChildren) && count($diffgramChildren) === 0) {
                Log::store("⚠️ Empty DataSet in {$method}", 'qiqo_empty');
                $this->markFetchSuccess(0);
                return [];
            }

            Log::store("❌ No NewDataSet in {$method}", 'qiqo_error');
            $this->lastFetchResult['error'] = 'dataset_missing';
            return [];
        }


        $resolvedNode = $node;

        if (!$resolvedNode || !isset($newDataSet->{$resolvedNode})) {
            foreach ($newDataSet->children() as $child) {
                $resolvedNode = $child->getName();
                break;
            }
        }

        if (!$resolvedNode || !isset($newDataSet->{$resolvedNode})) {
            Log::store("⚠️ No data node in {$method}", 'qiqo_empty');
            $this->markFetchSuccess(0);
            return [];
        }

        $records = [];
        foreach ($newDataSet->{$resolvedNode} as $item) {
            $row = [];
            foreach ($item as $key => $value) {
                $row[$key] = trim((string) $value);
            }
            $records[] = $row;
        }

        $this->markFetchSuccess(count($records));
        Log::store("✅ Parsed " . count($records) . " records from {$method} (node: {$resolvedNode})", 'qiqo_info');
        return $records;
    }

    private function markFetchSuccess(int $count): void
    {
        $this->lastFetchResult = [
            'method' => $this->lastFetchResult['method'],
            'success' => true,
            'empty' => $count === 0,
            'error' => null,
            'count' => $count,
        ];
    }

    private function resolveConfigValue(?string $explicitValue, string $key): string
    {
        $value = $explicitValue;

        if ($value === null || trim($value) === '') {
            $environmentKeys = [
                'qiqo.username' => ['QIQO_USERNAME'],
                'qiqo.password' => ['QIQO_PASSWORD'],
                'qiqo.url' => ['QIQO_SOAP_URL', 'QIQO_URL'],
            ];

            foreach ($environmentKeys[$key] ?? [] as $environmentKey) {
                if (defined($environmentKey)) {
                    $constantValue = constant($environmentKey);
                    if (is_string($constantValue) && trim($constantValue) !== '') {
                        $value = $constantValue;
                        break;
                    }
                }

                $environmentValue = getenv($environmentKey);
                if (is_string($environmentValue) && trim($environmentValue) !== '') {
                    $value = $environmentValue;
                    break;
                }
            }
        }

        if (($value === null || trim((string)$value) === '') && function_exists('agconf') && defined('OC_ENV')) {
            $configured = agconf($key);
            $value = is_string($configured) ? $configured : '';
        }

        $value = trim((string)$value);
        if ($value === '' || $value === 'Env key not found!') {
            throw new \RuntimeException('Required Qiqo configuration is missing: ' . $key);
        }

        return $value;
    }

    private function isInsecureHttpExplicitlyAllowed(): bool
    {
        if (defined('QIQO_ALLOW_INSECURE_HTTP')) {
            return constant('QIQO_ALLOW_INSECURE_HTTP') === 1;
        }

        return getenv('QIQO_ALLOW_INSECURE_HTTP') === '1';
    }
}
