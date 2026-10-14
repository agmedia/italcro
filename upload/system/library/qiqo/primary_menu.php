<?php

final class QiqoPrimaryMenu
{
    /** Keep the requested main links together, preserving other configured links. */
    public static function normalize(array $rows, int $languageId, string $newProductsUrl): array
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

        $ordered = $home;
        foreach (['quick', 'new', 'special', 'blog', 'brand', 'leaflet'] as $key) {
            if (isset($groups[$key])) {
                $ordered[] = $groups[$key];
            }
        }
        return array_merge($ordered, $other);
    }
}
