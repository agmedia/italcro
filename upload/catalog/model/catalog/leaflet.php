<?php
require_once DIR_SYSTEM . 'library/leaflet/files.php';

class ModelCatalogLeaflet extends Model {
    private $table_ready = null;

    public function getLeaflets(): array {
        if (!$this->hasTable()) {
            return [];
        }
        $query = $this->db->query('SELECT * FROM `' . DB_PREFIX . 'leaflet` WHERE ' . $this->publishedCondition()
            . ' ORDER BY sort_order ASC, published_at DESC, leaflet_id DESC');
        $leaflets = [];
        foreach ($query->rows as $row) {
            if ($this->pdfPath($row) !== null) {
                $leaflets[] = $row;
            }
        }
        return $leaflets;
    }

    public function getLeaflet($leaflet_id): array {
        if ((int)$leaflet_id <= 0 || !$this->hasTable()) {
            return [];
        }
        $query = $this->db->query('SELECT * FROM `' . DB_PREFIX . 'leaflet` WHERE leaflet_id = '
            . (int)$leaflet_id . ' AND ' . $this->publishedCondition() . ' LIMIT 1');
        return $query->num_rows && $this->pdfPath($query->row) !== null ? $query->row : [];
    }

    /** The same publication and file checks protect both the listing and public streams. */
    public function pdfPath(array $leaflet): ?string {
        $published = (string)($leaflet['published_at'] ?? '');
        $date = DateTimeImmutable::createFromFormat('!Y-m-d', $published);
        if ((int)($leaflet['status'] ?? 0) !== 1 || !$date || $date->format('Y-m-d') !== $published
            || $published < '1000-01-01' || $published > date('Y-m-d')
            || trim((string)($leaflet['title'] ?? '')) === '') {
            return null;
        }
        return LeafletFiles::pdfPath((string)($leaflet['filename'] ?? ''));
    }

    private function publishedCondition(): string {
        return "status = '1' AND published_at >= '1000-01-01' AND published_at <= '"
            . $this->db->escape(date('Y-m-d')) . "'";
    }

    private function hasTable(): bool {
        if ($this->table_ready === null) {
            $table = DB_PREFIX . 'leaflet';
            $query = $this->db->query("SHOW TABLES LIKE '" . $this->db->escape($table) . "'");
            $this->table_ready = false;
            foreach ($query->rows as $row) {
                if (in_array($table, $row, true)) {
                    $this->table_ready = true;
                    break;
                }
            }
        }
        return $this->table_ready;
    }
}
