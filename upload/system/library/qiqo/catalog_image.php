<?php

/** Pure ERP path handling and read-only local image discovery; PHP 7.4+. */
final class QiqoCatalogImage
{
    /**
     * Return trusted relative candidates. No URL or remote host is inferred.
     * Only the ERP's known UNC share may be translated into a Photo path.
     */
    public static function paths(string $source): array
    {
        if ($source === '' || preg_match('/[\x00-\x1F\x7F]/', $source)) { return []; }
        $path = str_replace('\\', '/', rawurldecode(trim($source)));
        if ($path === '' || preg_match('/[\x00-\x1F\x7F:]/', $path)
            || preg_match('/%[0-9a-f]{2}/i', $path)) { return []; }

        // Examples: \\SRV-TS01\Svasta\Italcro\Photo\... and
        // Slike//SRV-TS01/Svasta/Italcro/Photo/.... Never accept other shares.
        if (preg_match('#^(?:Slike/)?/{1,2}SRV-TS01/Svasta/Italcro/Photo/(.+)$#iD', $path, $match)) {
            $path = 'Photo/' . $match[1];
        } elseif (strpos($path, '//') === 0 || preg_match('#^Slike//#i', $path)) {
            return [];
        }

        $path = ltrim(preg_replace('#/+#', '/', $path), '/');
        if ($path === '' || preg_match('#(?:^|/)\.\.?(?:/|$)#D', $path)
            || substr($path, -1) === '/') { return []; }

        $paths = [$path];
        if (preg_match('#^Slike/(.+)$#iD', $path, $match)) {
            $paths[] = 'Photo/' . $match[1];
            $paths[] = 'Slike/' . $match[1];
        } elseif (preg_match('#^Photo/(.+)$#iD', $path, $match)) {
            $paths[] = 'Slike/' . $match[1];
            $paths[] = 'Photo/' . $match[1];
        }
        return array_values(array_unique($paths));
    }

    /**
     * Resolve the exact path before aliases, checking every explicitly supplied
     * root. Symlinks may resolve within a root; escaping that root is rejected.
     * @return array{path:string,relative:string,root:string}|null
     */
    public static function resolve(string $source, array $roots): ?array
    {
        $directories = [];
        foreach ($roots as $root) {
            if (!is_string($root) || $root === '') { continue; }
            $real = realpath($root);
            if ($real !== false && is_dir($real)) { $directories[$real] = rtrim($real, '/\\') . DIRECTORY_SEPARATOR; }
        }
        foreach (self::paths($source) as $relative) {
            foreach ($directories as $root => $prefix) {
                $file = realpath($prefix . $relative);
                if ($file !== false && strpos($file, $prefix) === 0 && is_file($file)
                    && is_readable($file) && @getimagesize($file) !== false) {
                    return ['path' => $file, 'relative' => $relative, 'root' => $root];
                }
            }
        }
        return null;
    }
}
