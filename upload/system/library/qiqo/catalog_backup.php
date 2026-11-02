<?php

/** Completed, private, fresh database backups required before nontransactional catalog writes. */
final class QiqoCatalogBackup
{
    public static function verify(string $path, ?string $directory = null, ?string $webRoot = null, int $maxAge = 3600): array
    {
        clearstatcache(true, $path);
        clearstatcache(true, $path . '.sha256');
        $canonical = realpath($path);
        $parent = realpath(dirname($path));
        if (is_link($path) || !$canonical || $canonical !== $path || !$parent
            || ($directory !== null && $parent !== realpath($directory))
            || !is_file($path) || !is_readable($path) || (fileperms($path) & 0777) !== 0600
            || (fileperms($parent) & 0077) !== 0
            || !preg_match('/^qiqo-database-\d{8}T\d{6}Z-[a-f0-9]{12}\.sql$/D', basename($path))
            || is_link($path . '.sha256') || !is_file($path . '.sha256') || !is_readable($path . '.sha256')
            || (fileperms($path . '.sha256') & 0777) !== 0600) {
            throw new RuntimeException('Catalog backup is not a protected completed SQL dump.');
        }
        if ($webRoot !== null) {
            $webRoot = realpath($webRoot);
            if (!$webRoot || $path === $webRoot || strpos($path, $webRoot . DIRECTORY_SEPARATOR) === 0) {
                throw new RuntimeException('Catalog backup must be outside the web root.');
            }
        }
        if ($maxAge > 0) {
            foreach ([$path, $path . '.sha256'] as $file) {
                $modified = filemtime($file);
                if ($modified === false || $modified < time() - $maxAge || $modified > time() + 60) {
                    throw new RuntimeException('Catalog backup is not fresh.');
                }
            }
        }
        $file = fopen($path, 'rb');
        if (!$file || filesize($path) <= 0) throw new RuntimeException('Catalog backup is empty.');
        try {
            $head = fread($file, 65536);
            fseek($file, max(0, filesize($path) - 65536));
            $tail = stream_get_contents($file);
        } finally { fclose($file); }
        if (defined('DB_DATABASE')) {
            $use = 'USE `' . str_replace('`', '``', DB_DATABASE) . '`;';
            if (strpos((string)$head, $use) === false) throw new RuntimeException('Catalog backup database does not match.');
        }
        $hash = hash_file('sha256', $path);
        $checksum = trim((string)file_get_contents($path . '.sha256'));
        if (!$hash || !preg_match('/(?:^|\n)-- Dump completed on [^\r\n]+\s*$/D', (string)$tail)
            || $checksum !== $hash . '  ' . basename($path)) throw new RuntimeException('Catalog backup verification failed.');
        return ['path' => $path, 'sha256' => $hash];
    }
}
