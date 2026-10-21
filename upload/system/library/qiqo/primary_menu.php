<?php

final class QiqoPrimaryMenu
{
    /** Keep the requested main links together, preserving other configured links. */
    public static function normalize(array $rows, int $languageId, string $newProductsUrl, string $leafletUrl = 'index.php?route=information/leaflet', array $request = []): array
    {
        $groups = [];
        $other = [];
        $home = [];
        foreach ($rows as $row) {
            $name = trim(html_entity_decode(strip_tags((string)($row['name'][$languageId] ?? '')), ENT_QUOTES, 'UTF-8'));
            $key = null;
            switch ($name) {
                case 'Brza narudžba': $key = 'quick'; break;
                case 'Novo':
                case 'Novo u ponudi': $key = 'new'; break;
                case 'Akcije': $key = 'special'; break;
                case 'Blog': $key = 'blog'; break;
                case 'Brandovi': $key = 'brand'; break;
                case 'Letak': $key = 'leaflet'; break;
                case 'Rasprodaja': $key = 'clearance'; break;
            }
            if ($key !== null && !isset($groups[$key])) {
                $groups[$key] = $row;
            } elseif ($name === 'Naslovnica' || $name === 'Home') {
                $home[] = $row;
            } else {
                $other[] = $row;
            }
        }

        // Leave other configured menus alone.
        if (!isset($groups['quick'])) {
            return $rows;
        }
        if (!isset($groups['new'])) {
            $groups['new'] = $groups['quick'];
            $groups['new']['icon'] = false;
            $groups['new']['icon_font'] = '';
            $groups['new']['class_menu'] = '';
            $groups['new']['description'] = false;
            $groups['new']['new_window'] = false;
        }
        $groups['new']['name'][$languageId] = 'Novo';
        $groups['new']['link'] = $newProductsUrl;
        $groups['new']['submenu'] = [];
        if (!isset($groups['leaflet'])) {
            $groups['leaflet'] = $groups['new'];
        }
        $groups['leaflet']['name'][$languageId] = 'Letak';
        $groups['leaflet']['link'] = $leafletUrl;
        $groups['leaflet']['submenu'] = [];
        $groups['leaflet']['new_window'] = false;

        $ordered = $home;
        foreach (['quick', 'new', 'special', 'blog', 'brand', 'leaflet', 'clearance'] as $key) {
            if (isset($groups[$key])) {
                $groups[$key]['qiqo_menu_key'] = $key;
                $ordered[] = $groups[$key];
            }
        }
        $ordered = array_merge($ordered, $other);
        foreach ($ordered as &$row) {
            $row['qiqo_active'] = self::isCurrent((string)($row['link'] ?? ''), (string)($row['qiqo_menu_key'] ?? ''), $request);
        }
        unset($row);
        return $ordered;
    }

    private static function isCurrent(string $link, string $key, array $request): bool
    {
        if ($link === '' || !$request) {
            return false;
        }
        $route = trim((string)($request['route'] ?? 'common/home'), '/');
        $routes = ['new' => 'product/new_product', 'special' => 'product/special', 'leaflet' => 'information/leaflet'];
        if (isset($routes[$key])) {
            return $route === $routes[$key];
        }
        if ($key === 'quick' && $route === 'information/information' && (int)($request['information_id'] ?? 0) === 30) {
            return true;
        }
        if ($key === 'blog' && strpos($route, 'blog/') === 0) {
            return true;
        }
        if ($key === 'brand' && strpos($route, 'product/manufacturer') === 0) {
            return true;
        }

        $target = parse_url(html_entity_decode($link, ENT_QUOTES, 'UTF-8'));
        $currentHost = isset($request['_host']) ? parse_url('http://' . $request['_host'], PHP_URL_HOST) : null;
        if (!$target || (isset($target['host']) && $currentHost && strcasecmp($target['host'], $currentHost) !== 0)) {
            return false;
        }
        $query = [];
        parse_str($target['query'] ?? '', $query);
        if (isset($query['route'])) {
            if (trim((string)$query['route'], '/') !== $route) {
                return false;
            }
            foreach ($query as $name => $value) {
                if (!in_array($name, ['route', 'page', 'sort', 'order', 'limit', 'language', 'currency'], true)
                    && (string)($request[$name] ?? '') !== (string)$value) {
                    return false;
                }
            }
            return true;
        }
        $currentPath = parse_url((string)($request['_request_uri'] ?? ''), PHP_URL_PATH);
        $targetPath = $target['path'] ?? '';
        if ($targetPath === '/') {
            return $route === 'common/home';
        }
        return $targetPath !== '' && trim($targetPath, '/') === trim((string)$currentPath, '/');
    }
}
