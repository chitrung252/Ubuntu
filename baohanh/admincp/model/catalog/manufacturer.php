<?php
class ModelCatalogManufacturer extends Model {
	
    public function addManufacturer($data) {
		$this->event->trigger('pre.admin.manufacturer.add', $data);

		$this->db->query(
		"INSERT INTO " . DB_PREFIX . "manufacturer SET manufacturer_name = '" . $this->db->escape(trim($data['manufacturer_name'])) . "',
		website = '" . $this->db->escape(trim($data['website'])) . "',
		status = '" . (int)$data['status'] . "'"
		);
		$manufacturer_id = $this->db->getLastId();
		 if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "manufacturer SET image = '" . $this->db->escape($data['image']) . "' WHERE manufacturer_id = '" . (int)$manufacturer_id . "'");
		}

		$this->cache->delete('manufacturer');

		$this->event->trigger('post.admin.manufacturer.add', $manufacturer_id);

		return $manufacturer_id;
	}

	public function editManufacturer($manufacturer_id, $data) {
		$this->event->trigger('pre.admin.manufacturer.edit', $data);

       
		 $this->db->query(
		"UPDATE " . DB_PREFIX . "manufacturer SET manufacturer_name = '" . $this->db->escape(trim($data['manufacturer_name'])) . "',
		website = '" . $this->db->escape(trim($data['website'])) . "',
		status = '" . (int)$data['status'] . "'
		WHERE manufacturer_id = '" . (int)$manufacturer_id . "'"
		);
		if (isset($data['image'])) {
				$this->db->query("UPDATE " . DB_PREFIX . "manufacturer SET image = '" . $this->db->escape($data['image']) . "' WHERE manufacturer_id = '" . (int)$manufacturer_id . "'");
			}
		$this->cache->delete('manufacturer');

		$this->event->trigger('post.admin.manufacturer.edit', $manufacturer_id);
	}

	public function deleteManufacturer($manufacturer_id) {
		$this->event->trigger('pre.admin.manufacturer.delete', $manufacturer_id);

		$this->db->query("DELETE FROM " . DB_PREFIX . "manufacturer WHERE manufacturer_id = '" . (int)$manufacturer_id . "'");
		
		$this->cache->delete('manufacturer');

		$this->event->trigger('post.admin.manufacturer.delete', $manufacturer_id);
	}

	

	public function getManufacturer($manufacturer_id) {
		//$query = $this->db->query("SELECT DISTINCT *, (SELECT GROUP_CONCAT(cd1.name ORDER BY level SEPARATOR '&nbsp;&nbsp;&gt;&nbsp;&nbsp;') FROM " . DB_PREFIX . "manufacturer_path cp LEFT JOIN " . DB_PREFIX . "manufacturer_description cd1 ON (cp.path_id = cd1.manufacturer_id AND cp.manufacturer_id != cp.path_id) WHERE cp.manufacturer_id = c.manufacturer_id AND cd1.language_id = '" . (int)$this->config->get('config_language_id') . "' GROUP BY cp.manufacturer_id) AS path FROM " . DB_PREFIX . "manufacturer c LEFT JOIN " . DB_PREFIX . "manufacturer_description cd2 ON (c.manufacturer_id = cd2.manufacturer_id) WHERE c.manufacturer_id = '" . (int)$manufacturer_id . "' AND cd2.language_id = '" . (int)$this->config->get('config_language_id') . "'");
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "manufacturer WHERE manufacturer_id = '" . (int)$manufacturer_id . "'");
		return $query->row;
	}

	public function getManufacturers($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "manufacturer ORDER BY manufacturer_id DESC";

		$query = $this->db->query($sql);

		return $query->rows;
	}

	

	public function getTotalManufacturers() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "manufacturer");

		return $query->row['total'];
	}
	
	
  
}
