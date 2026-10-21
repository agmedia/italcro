<?php
class ModelCatalogLeaflet extends Model {
    public function getLeaflet($leafletId) {
        return $this->db->query('SELECT * FROM `' . DB_PREFIX . 'leaflet` WHERE leaflet_id=' . (int)$leafletId)->row;
    }

    public function getLeaflets($data = array()) {
        $sorts = ['title', 'published_at', 'status', 'sort_order'];
        $sort = isset($data['sort']) && in_array($data['sort'], $sorts, true) ? $data['sort'] : 'published_at';
        $direction = isset($data['order']) && $data['order'] === 'ASC' ? 'ASC' : 'DESC';
        $sql = 'SELECT * FROM `' . DB_PREFIX . 'leaflet` ORDER BY ' . $sort . ' ' . $direction . ',leaflet_id DESC';
        if (isset($data['start']) || isset($data['limit'])) { $sql .= ' LIMIT ' . max(0, (int)($data['start'] ?? 0)) . ',' . max(1, (int)($data['limit'] ?? 20)); }
        return $this->db->query($sql)->rows;
    }

    public function getTotalLeaflets() { return (int)$this->db->query('SELECT COUNT(*) total FROM `' . DB_PREFIX . 'leaflet`')->row['total']; }

    public function addLeaflet($data) {
        $this->db->query('INSERT INTO `' . DB_PREFIX . 'leaflet` SET ' . $this->assignments($data) . ',date_added=NOW(),date_modified=NOW()');
        $id = $this->db->getLastId(); $this->invalidateCache(); return $id;
    }

    public function editLeaflet($leafletId, $data) {
        require_once DIR_SYSTEM . 'library/leaflet/files.php';
        $old = $this->getLeaflet($leafletId);
        if (!$old) { throw new RuntimeException('leaflet_missing'); }
        LeafletFiles::archive($old);
        $this->db->query('UPDATE `' . DB_PREFIX . 'leaflet` SET ' . $this->assignments($data) . ',date_modified=NOW() WHERE leaflet_id=' . (int)$leafletId);
        $this->invalidateCache();
    }

    public function deleteLeaflet($leafletId) {
        require_once DIR_SYSTEM . 'library/leaflet/files.php';
        $old = $this->getLeaflet($leafletId);
        if (!$old) { return; }
        LeafletFiles::archive($old);
        $this->db->query('DELETE FROM `' . DB_PREFIX . 'leaflet` WHERE leaflet_id=' . (int)$leafletId);
        $this->invalidateCache();
    }

    private function invalidateCache(): void { try { $this->cache->delete('leaflet'); } catch (Throwable $ignored) {} }

    private function assignments(array $data): string {
        $values = [];
        foreach (['title', 'published_at', 'filename', 'original_filename', 'thumbnail'] as $field) { $values[] = '`' . $field . "`='" . $this->db->escape((string)$data[$field]) . "'"; }
        $values[] = 'pdf_size=' . max(0, (int)$data['pdf_size']);
        $values[] = 'status=' . (!empty($data['status']) ? 1 : 0);
        $values[] = 'sort_order=' . (int)$data['sort_order'];
        return implode(',', $values);
    }
}
