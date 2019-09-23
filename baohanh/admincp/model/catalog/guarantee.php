<?php
class ModelCatalogGuarantee extends Model {
	public function addGuarantee($data) {
		$this->event->trigger('pre.admin.guarantee.add', $data);

		$this->db->query("INSERT INTO " . DB_PREFIX . "guarantee SET guarantee_name = '" . $this->db->escape(trim($data['guarantee_name'])) . "', status = '" . (int)$data['status'] . "'");

		$guarantee_id = $this->db->getLastId();

		$this->cache->delete('guarantee');

		$this->event->trigger('post.admin.guarantee.add', $guarantee_id);

		return $guarantee_id;
	}

	public function editGuarantee($guarantee_id, $data) {
		$this->event->trigger('pre.admin.guarantee.edit', $data);

       
		 $this->db->query(
		"UPDATE " . DB_PREFIX . "guarantee SET guarantee_name = '" . $this->db->escape(trim($data['guarantee_name'])) . "',
		status = '" . (int)$data['status'] . "'
		WHERE guarantee_id = '" . (int)$guarantee_id . "'"
		);
		$this->cache->delete('guarantee');

		$this->event->trigger('post.admin.guarantee.edit', $guarantee_id);
	}

	public function deleteGuarantee($guarantee_id) {
		$this->event->trigger('pre.admin.guarantee.delete', $guarantee_id);

		$this->db->query("DELETE FROM " . DB_PREFIX . "guarantee WHERE guarantee_id = '" . (int)$guarantee_id . "'");
		
		$this->cache->delete('guarantee');

		$this->event->trigger('post.admin.guarantee.delete', $guarantee_id);
	}

	

	public function getGuarantee($guarantee_id) {
		//$query = $this->db->query("SELECT DISTINCT *, (SELECT GROUP_CONCAT(cd1.name ORDER BY level SEPARATOR '&nbsp;&nbsp;&gt;&nbsp;&nbsp;') FROM " . DB_PREFIX . "guarantee_path cp LEFT JOIN " . DB_PREFIX . "guarantee_description cd1 ON (cp.path_id = cd1.guarantee_id AND cp.guarantee_id != cp.path_id) WHERE cp.guarantee_id = c.guarantee_id AND cd1.language_id = '" . (int)$this->config->get('config_language_id') . "' GROUP BY cp.guarantee_id) AS path FROM " . DB_PREFIX . "guarantee c LEFT JOIN " . DB_PREFIX . "guarantee_description cd2 ON (c.guarantee_id = cd2.guarantee_id) WHERE c.guarantee_id = '" . (int)$guarantee_id . "' AND cd2.language_id = '" . (int)$this->config->get('config_language_id') . "'");
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "guarantee WHERE guarantee_id = '" . (int)$guarantee_id . "'");
		return $query->row;
	}

	public function getGuarantees($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "guarantee ORDER BY guarantee_id DESC";

		$query = $this->db->query($sql);

		return $query->rows;
	}

	

	public function getTotalguarantees() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "guarantee");

		return $query->row['total'];
	}
	
		
}
