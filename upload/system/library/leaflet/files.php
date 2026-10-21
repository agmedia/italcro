<?php

/** Leaflet PDFs stay private; only validated raster covers enter the image tree. */
final class LeafletFiles
{
    public const MAX_BYTES = 31457280;

    private static function directory(): string
    {
        $base = rtrim(DIR_DOWNLOAD, '/\\') . '/leaflets';
        if (!is_dir($base) && !@mkdir($base, 0700, true) && !is_dir($base)) { throw new RuntimeException('leaflet_storage'); }
        $real = realpath($base);
        $web = realpath(dirname(rtrim(DIR_SYSTEM, '/\\')));
        if (!$real || !$web || $real === $web || strpos($real . '/', $web . '/') === 0) { throw new RuntimeException('leaflet_storage'); }
        @chmod($real, 0700);
        return $real;
    }

    public static function validPdf(string $path): bool
    {
        if (!is_file($path) || !is_readable($path) || filesize($path) < 8 || filesize($path) > self::MAX_BYTES) { return false; }
        $file = @fopen($path, 'rb');
        if (!$file) { return false; }
        $header = fread($file, 5); fclose($file);
        if ($header !== '%PDF-' || !class_exists('finfo')) { return false; }
        $mime = (new finfo(FILEINFO_MIME_TYPE))->file($path);
        return in_array($mime, ['application/pdf', 'application/x-pdf'], true);
    }

    public static function pdfPath(string $filename): ?string
    {
        if (!preg_match('/^[a-f0-9]{32}\.pdf$/D', $filename)) { return null; }
        try { $directory = self::directory(); } catch (Throwable $error) { return null; }
        $path = realpath($directory . '/' . $filename);
        return $path !== false && strpos($path, $directory . '/') === 0 && self::validPdf($path) ? $path : null;
    }

    public static function storeUpload(array $upload): array
    {
        if ((int)($upload['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK
            || !isset($upload['tmp_name']) || !is_uploaded_file($upload['tmp_name'])) { throw new RuntimeException('leaflet_upload'); }
        $original = basename(str_replace('\\', '/', html_entity_decode((string)($upload['name'] ?? 'letak.pdf'), ENT_QUOTES, 'UTF-8')));
        $original = preg_replace('/[\x00-\x1F\x7F]/', '', $original);
        if (!preg_match('/\.pdf$/iD', $original) || !self::validPdf($upload['tmp_name'])) { throw new RuntimeException('leaflet_pdf'); }
        $original = function_exists('mb_substr') ? mb_substr($original, 0, 250, 'UTF-8') : substr($original, 0, 250);
        if (!preg_match('/\.pdf$/iD', $original)) { $original .= '.pdf'; }
        $directory = self::directory();
        $filename = bin2hex(random_bytes(16)) . '.pdf';
        $destination = $directory . '/' . $filename;
        $input = fopen($upload['tmp_name'], 'rb');
        $output = @fopen($destination, 'xb');
        if (!$input || !$output) { if ($input) { fclose($input); } if ($output) { fclose($output); } throw new RuntimeException('leaflet_storage'); }
        @chmod($destination, 0600);
        try {
            $size = stream_copy_to_stream($input, $output, self::MAX_BYTES + 1);
            if ($size !== filesize($upload['tmp_name']) || !fflush($output)) { throw new RuntimeException('leaflet_storage'); }
        } finally { fclose($input); fclose($output); }
        if (!self::validPdf($destination)) { @unlink($destination); throw new RuntimeException('leaflet_pdf'); }
        return ['filename' => $filename, 'original_filename' => $original, 'pdf_size' => $size];
    }

    public static function validThumbnail(string $relative): bool
    {
        if ($relative === '' || preg_match('/[\x00-\x1F\x7F]/', $relative)) { return false; }
        $root = realpath(DIR_IMAGE);
        $file = $root ? realpath($root . '/' . $relative) : false;
        if (!$root || !$file || strpos($file, $root . DIRECTORY_SEPARATOR) !== 0 || !is_file($file)) { return false; }
        $info = @getimagesize($file);
        return $info && in_array($info[2], [IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_GIF, IMAGETYPE_WEBP], true);
    }

    /** Optional first-page cover; unavailable converters simply return no cover. */
    public static function thumbnail(string $filename): string
    {
        $pdf = self::pdfPath($filename);
        if (!$pdf) { return ''; }
        $relative = 'catalog/leaflets/' . substr($filename, 0, 32) . '.jpg';
        if (self::validThumbnail($relative)) { return $relative; }
        $temporary = self::directory() . '/thumb-' . bin2hex(random_bytes(12)) . '.jpg';
        try {
            if (class_exists('Imagick')) {
                try {
                    $image = new Imagick();
                    foreach (['RESOURCETYPE_MEMORY' => 128 * 1024 * 1024, 'RESOURCETYPE_MAP' => 256 * 1024 * 1024, 'RESOURCETYPE_TIME' => 15] as $resource => $limit) {
                        if (defined('Imagick::' . $resource)) { $image->setResourceLimit(constant('Imagick::' . $resource), $limit); }
                    }
                    $image->setResolution(100, 100); $image->readImage($pdf . '[0]');
                    $image->setImageBackgroundColor('white'); $image = $image->mergeImageLayers(Imagick::LAYERMETHOD_FLATTEN);
                    $image->thumbnailImage(900, 1200, true); $image->setImageFormat('jpeg'); $image->setImageCompressionQuality(85);
                    $image->writeImage($temporary); $image->clear(); $image->destroy();
                } catch (Throwable $ignored) { if (is_file($temporary)) { @unlink($temporary); } }
            }
            if (!is_file($temporary) && function_exists('proc_open')) {
                $binary = null;
                $candidates = defined('LEAFLET_PDFTOPPM_BINARY') ? [constant('LEAFLET_PDFTOPPM_BINARY')] : ['/usr/bin/pdftoppm', '/usr/local/bin/pdftoppm', '/opt/homebrew/bin/pdftoppm'];
                foreach ($candidates as $candidate) { if (is_string($candidate) && is_file($candidate) && is_executable($candidate)) { $binary = $candidate; break; } }
                if ($binary) {
                    $prefix = substr($temporary, 0, -4);
                    if (!self::render([$binary, '-f', '1', '-singlefile', '-scale-to', '1200', '-jpeg', '-jpegopt', 'quality=85', $pdf, $prefix])
                        && is_file($temporary)) { @unlink($temporary); }
                }
            }
            if (!is_file($temporary) && function_exists('proc_open')) {
                foreach (['/usr/bin/gs', '/usr/local/bin/gs', '/opt/homebrew/bin/gs'] as $binary) {
                    if (!is_file($binary) || !is_executable($binary)) { continue; }
                    if (!self::render([$binary, '-dSAFER', '-dBATCH', '-dNOPAUSE', '-dFirstPage=1', '-dLastPage=1',
                        '-sDEVICE=jpeg', '-dJPEGQ=85', '-r72', '-g600x850', '-dFIXEDMEDIA', '-dPDFFitPage',
                        '-dNumRenderingThreads=1', '-dBufferSpace=16777216', '-dMaxBitmap=33554432',
                        '-sOutputFile=' . $temporary, $pdf]) && is_file($temporary)) { @unlink($temporary); }
                    break;
                }
            }
            $info = is_file($temporary) ? @getimagesize($temporary) : false;
            if (!$info || $info[2] !== IMAGETYPE_JPEG || filesize($temporary) > 10485760) { return ''; }
            $directory = rtrim(DIR_IMAGE, '/\\') . '/catalog/leaflets';
            if (!is_dir($directory) && !@mkdir($directory, 0755, true) && !is_dir($directory)) { return ''; }
            $root = realpath(DIR_IMAGE); $targetDirectory = realpath($directory);
            if (!$root || !$targetDirectory || strpos($targetDirectory . '/', rtrim($root, '/\\') . '/') !== 0) { return ''; }
            $destination = $targetDirectory . '/' . basename($relative);
            $input = fopen($temporary, 'rb'); $output = @fopen($destination, 'xb');
            if (!$input || !$output) { if ($input) { fclose($input); } if ($output) { fclose($output); } return ''; }
            $size = stream_copy_to_stream($input, $output); fclose($input); fclose($output);
            if ($size !== filesize($temporary)) { @unlink($destination); return ''; }
            @chmod($destination, 0644);
            return $relative;
        } catch (Throwable $ignored) { return ''; }
        finally { if (is_file($temporary)) { @unlink($temporary); } }
    }

    private static function render(array $arguments): bool
    {
        $process = @proc_open($arguments, [0 => ['file', '/dev/null', 'r'], 1 => ['file', '/dev/null', 'w'], 2 => ['file', '/dev/null', 'w']], $pipes);
        if (!is_resource($process)) { return false; }
        $deadline = microtime(true) + 20;
        do { $status = proc_get_status($process); if (!$status['running']) { break; } usleep(50000); } while (microtime(true) < $deadline);
        $timedOut = $status['running'];
        if ($timedOut) { proc_terminate($process, 9); }
        $closed = proc_close($process);
        $exit = $status['exitcode'] >= 0 ? $status['exitcode'] : $closed;
        return !$timedOut && $exit === 0;
    }

    /** Private metadata snapshots allow a replaced/deleted record to be recovered. */
    public static function archive(array $row): void
    {
        $path = self::directory() . '/archive-' . date('YmdHis') . '-' . bin2hex(random_bytes(8)) . '.json';
        $file = @fopen($path, 'xb');
        if (!$file) { throw new RuntimeException('leaflet_storage'); }
        @chmod($path, 0600);
        try {
            $json = json_encode(['archived_at' => date('c'), 'leaflet' => $row], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            if ($json === false || fwrite($file, $json . "\n") !== strlen($json) + 1 || !fflush($file)) { throw new RuntimeException('leaflet_storage'); }
        } finally { fclose($file); }
    }
}
