<?php

namespace Agmedia\Api\Connection\Soap;

use Agmedia\Helpers\Log;
use Exception;
use SimpleXMLElement;

class Qiqo
{
    /**
     * @var string
     */
    private string $url = 'http://195.29.121.190:9988/WebQReaderNew.asmx';
    
    /**
     * @var string
     */
    private string $korisnik;
    
    /**
     * @var string
     */
    private string $lozinka;
    
    
    public function __construct(?string $korisnik = null, ?string $lozinka = null)
    {
        $this->korisnik = $korisnik ?: agconf('qiqo.username');
        $this->lozinka  = $lozinka  ?: agconf('qiqo.password');
    }
    
    
    /**
     * 📦 Dohvati artikle (qArtikliWeb)
     */
    public function getArticles(string $since = '-120 days'): array
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
    
    
    /**
     * 🧭 Glavna metoda – generički SOAP poziv
     */
    private function fetch(string $method, string $since, string $node): array
    {
        $datum = date('Y-m-d\TH:i:s', strtotime($since));
        $soapAction = "http://www.qiqo.hr/{$method}";
        
        $xml = <<<XML
                <?xml version="1.0" encoding="utf-8"?>
                <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
                               xmlns:xsd="http://www.w3.org/2001/XMLSchema"
                               xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
                  <soap:Body>
                    <{$method} xmlns="http://www.qiqo.hr/">
                      <korisnik>{$this->korisnik}</korisnik>
                      <lozinka>{$this->lozinka}</lozinka>
                      <datum>{$datum}</datum>
                    </{$method}>
                  </soap:Body>
                </soap:Envelope>
                XML;
        
        $response = $this->send($soapAction, $xml);
        if (!$response) {
            Log::store("❌ Empty SOAP response for {$method}", 'qiqo_error');
            return [];
        }
        
        $response = $this->sanitize($response);
        file_put_contents(storage_path("logs/qiqo_{$method}_raw.xml"), $response);
        
        return $this->parse($response, $method, $node);
    }
    
    
    /**
     * 🔹 Izvrši cURL SOAP poziv
     */
    private function send(string $soapAction, string $body): ?string
    {
        try {
            $ch = curl_init($this->url);
            curl_setopt_array($ch, [
                CURLOPT_POST           => true,
                CURLOPT_POSTFIELDS     => $body,
                CURLOPT_RETURNTRANSFER => true,
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
            if ($curlError) Log::store($curlError, 'qiqo_http_error');
            
            return $response;
        } catch (Exception $e) {
            Log::store($e->getMessage(), 'qiqo_exception');
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
    private function parse(string $xml, string $method, string $node): array
    {
        libxml_use_internal_errors(true);
        $parsed = simplexml_load_string($xml);
        
        if ($parsed === false) {
            $errors = array_map(fn($e) => trim($e->message), libxml_get_errors());
            Log::store('❌ XML parse error: ' . implode('; ', $errors), 'qiqo_error');
            return [];
        }
        
        $nsSOAP = 'http://schemas.xmlsoap.org/soap/envelope/';
        $nsQIQO = 'http://www.qiqo.hr/';
        $nsDIFF = 'urn:schemas-microsoft-com:xml-diffgram-v1';
        
        $body = $parsed->children($nsSOAP)->Body;
        $result = $body->children($nsQIQO)
            ->{$method . 'Response'}
            ->{$method . 'Result'};
        
        $diffgram = $result->children($nsDIFF)->diffgram ?? $result->diffgram ?? null;
        if (!$diffgram || !$diffgram->NewDataSet) {
            Log::store("⚠️ No diffgram in {$method}", 'qiqo_empty');
            return [];
        }
        
        $records = [];
        foreach ($diffgram->NewDataSet->{$node} as $item) {
            $row = [];
            foreach ($item as $key => $value) {
                $row[$key] = trim((string) $value);
            }
            $records[] = $row;
        }
        
        Log::store("✅ Parsed " . count($records) . " records from {$method}", 'qiqo_info');
        return $records;
    }
}
