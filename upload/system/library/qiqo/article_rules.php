<?php

final class QiqoArticleRules
{
    public static function classifications($db, array $skus): array
    {
        if (!$skus) return [];
        $ready = $db->query("SHOW TABLES LIKE '" . $db->escape(DB_PREFIX . 'qiqo_article_classification') . "'");
        if (!$ready->num_rows) return [];
        $in = [];
        foreach (array_unique($skus) as $sku) $in[] = "'" . $db->escape((string)$sku) . "'";
        $result = $db->query('SELECT article_code, classification FROM `' . DB_PREFIX
            . 'qiqo_article_classification` WHERE article_code IN (' . implode(',', $in) . ')');
        $map = [];
        foreach ($result->rows as $row) $map[(string)$row['article_code']] = (int)$row['classification'];
        return $map;
    }
}
