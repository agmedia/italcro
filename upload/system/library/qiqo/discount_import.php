<?php

/** Bounded-memory reader for a verified ERP partner/article discount export. */
final class QiqoDiscountImport
{
    public static function rows(string $path): Generator
    {
        $real = realpath($path);
        if (!$real || !is_file($real) || !is_readable($real)) {
            throw new RuntimeException('Export file is not readable.');
        }
        $name = preg_replace('/\.gz$/i', '', $real);
        $compressed = (bool)preg_match('/\.gz$/i', $real);
        if ($compressed) { self::validateGzip($real); }
        $input = $compressed ? 'compress.zlib://' . $real : $real;
        if (preg_match('/\.csv$/i', $name)) {
            yield from self::csvRows($input);
        } elseif (preg_match('/\.xml$/i', $name)) {
            yield from self::xmlRows($input);
        } else {
            throw new RuntimeException('Use a CSV or XML export, optionally compressed with gzip.');
        }
    }

    public static function normalize(array $row): array
    {
        $row = array_change_key_case($row, CASE_LOWER);
        foreach (['partner', 'artikal', 'rabat'] as $field) {
            if (!array_key_exists($field, $row) || !is_scalar($row[$field])) {
                throw new RuntimeException('Export row is missing a required field.');
            }
        }
        $partner = trim((string)$row['partner']);
        $article = trim((string)$row['artikal']);
        $discount = trim((string)$row['rabat']);
        if (!preg_match('/^[1-9][0-9]*$/D', $partner) || (float)$partner > 2147483647
            || $article === '' || strlen($article) > 64 || preg_match('/[\x00-\x1F\x7F]/', $article)
            || !preg_match('/^(?:[0-9]+(?:[.,][0-9]{1,4})?|[.,][0-9]{1,4})$/D', $discount)) {
            throw new RuntimeException('Export contains an invalid partner, article or discount.');
        }
        $discount = str_replace(',', '.', $discount);
        if ((float)$discount > 100) {
            throw new RuntimeException('Export discount is outside 0 to 100 percent.');
        }
        return ['partner' => (int)$partner, 'article' => $article, 'discount' => number_format((float)$discount, 4, '.', '')];
    }

    private static function csvRows(string $input): Generator
    {
        $file = fopen($input, 'rb');
        if (!$file) {
            throw new RuntimeException('Cannot open CSV export.');
        }
        try {
            $line = fgets($file);
            if ($line === false) {
                throw new RuntimeException('CSV export is empty.');
            }
            $line = preg_replace('/^\xEF\xBB\xBF/', '', $line);
            $delimiter = substr_count($line, ';') > substr_count($line, ',') ? ';' : ',';
            $headers = array_map(static function ($value) { return strtolower(trim($value)); }, self::csvLine($line, $delimiter));
            if (count($headers) !== count(array_unique($headers)) || array_diff(['partner', 'artikal', 'rabat'], $headers)) {
                throw new RuntimeException('CSV header must contain partner, artikal and rabat once.');
            }
            while (($line = fgets($file, 65538)) !== false) {
                if (trim($line) === '') {
                    continue;
                }
                $cells = self::csvLine($line, $delimiter);
                if (count($headers) !== count($cells)) {
                    throw new RuntimeException('CSV row has an unexpected field count.');
                }
                yield self::normalize(array_combine($headers, $cells));
            }
            if (!feof($file)) {
                throw new RuntimeException('CSV export was not read completely.');
            }
        } finally {
            fclose($file);
        }
    }

    private static function csvLine(string $line, string $delimiter): array
    {
        $line = rtrim($line, "\r\n");
        if (strlen($line) > 65536 || strpos($line, "\n") !== false || strpos($line, "\r") !== false) {
            throw new RuntimeException('CSV discount records must fit one line.');
        }
        $quoted = false;
        $closed = false;
        $start = true;
        for ($i = 0, $length = strlen($line); $i < $length; ++$i) {
            $character = $line[$i];
            if ($quoted) {
                if ($character === '"') {
                    if ($i + 1 < $length && $line[$i + 1] === '"') { ++$i; }
                    else { $quoted = false; $closed = true; }
                }
            } elseif ($character === $delimiter) {
                $start = true;
                $closed = false;
            } elseif ($closed || ($character === '"' && !$start)) {
                throw new RuntimeException('CSV record has an invalid or unfinished quoted field.');
            } elseif ($character === '"') {
                $quoted = true;
            } else { $start = false; }
        }
        if ($quoted) { throw new RuntimeException('CSV export ends inside a quoted field.'); }
        return str_getcsv($line, $delimiter, '"', '');
    }

    private static function validateGzip(string $path): void
    {
        $raw = fopen($path, 'rb');
        if (!$raw || fseek($raw, -8, SEEK_END) !== 0) {
            if ($raw) { fclose($raw); }
            throw new RuntimeException('Compressed export is truncated.');
        }
        $footer = fread($raw, 8);
        fclose($raw);
        $expected = strlen($footer) === 8 ? unpack('Vcrc/Visize', $footer) : false;
        if (!$expected) { throw new RuntimeException('Compressed export trailer is missing.'); }
        $stream = gzopen($path, 'rb');
        if (!$stream) { throw new RuntimeException('Cannot open compressed export.'); }
        $crc = hash_init('crc32b');
        $size = 0;
        set_error_handler(static function () { throw new RuntimeException('Compressed export failed its integrity check.'); });
        try {
            while (!gzeof($stream)) {
                $chunk = gzread($stream, 65536);
                if ($chunk === false || ($chunk === '' && !gzeof($stream))) {
                    throw new RuntimeException('Compressed export was not read completely.');
                }
                hash_update($crc, $chunk);
                $size = ($size + strlen($chunk)) & 0xffffffff;
            }
            if ($size !== $expected['isize'] || hash_final($crc) !== sprintf('%08x', $expected['crc'])) {
                throw new RuntimeException('Compressed export checksum or trailer is invalid.');
            }
        } finally {
            restore_error_handler();
            gzclose($stream);
        }
    }

    private static function xmlRows(string $input): Generator
    {
        $previous = libxml_use_internal_errors(true);
        libxml_clear_errors();
        $reader = new XMLReader();
        if (!$reader->open($input, null, LIBXML_NONET | LIBXML_COMPACT)) {
            libxml_use_internal_errors($previous);
            throw new RuntimeException('Cannot open XML export.');
        }
        $datasetDepth = null;
        $datasets = 0;
        $datasetClosed = false;
        try {
            while ($reader->read()) {
                if ($reader->nodeType === XMLReader::DOC_TYPE || $reader->nodeType === XMLReader::ENTITY_REF) {
                    throw new RuntimeException('XML document types and entities are not accepted.');
                }
                if ($reader->nodeType === XMLReader::ELEMENT && $reader->localName === 'Fault') {
                    throw new RuntimeException('ERP export contains a SOAP fault.');
                }
                if ($reader->nodeType === XMLReader::ELEMENT && $reader->localName === 'NewDataSet') {
                    if (++$datasets !== 1 || $reader->isEmptyElement) {
                        throw new RuntimeException('XML export must contain one nonempty NewDataSet.');
                    }
                    $datasetDepth = $reader->depth;
                } elseif ($datasetDepth !== null && $reader->nodeType === XMLReader::ELEMENT && $reader->depth === $datasetDepth + 1) {
                    $xml = $reader->readOuterXml();
                    if (strlen($xml) > 65536) {
                        throw new RuntimeException('XML discount row is unexpectedly large.');
                    }
                    $element = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NONET);
                    if ($element === false) {
                        throw new RuntimeException('XML discount row is invalid.');
                    }
                    $row = [];
                    foreach ($element->children() as $key => $value) {
                        $key = strtolower((string)$key);
                        if (array_key_exists($key, $row) || count($value->children()) > 0) {
                            throw new RuntimeException('XML discount row has duplicate or nested fields.');
                        }
                        $row[$key] = (string)$value;
                    }
                    yield self::normalize($row);
                } elseif ($datasetDepth !== null && $reader->nodeType === XMLReader::END_ELEMENT
                    && $reader->depth === $datasetDepth && $reader->localName === 'NewDataSet') {
                    $datasetDepth = null;
                    $datasetClosed = true;
                }
            }
            if (libxml_get_errors() || $datasets !== 1 || !$datasetClosed) {
                throw new RuntimeException('XML export is truncated or has an unexpected structure.');
            }
        } finally {
            $reader->close();
            libxml_clear_errors();
            libxml_use_internal_errors($previous);
        }
    }
}
