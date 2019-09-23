<?php
class ModelCatalogMenu extends Model {
	
	public function getMenus($parent_id = 0, $group_id = 0) {

		$menu_data = $this->cache->get('menu.'. $group_id . $parent_id . '.' . $this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id'));

		if (!$menu_data) {
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "menu m LEFT JOIN " . DB_PREFIX . "menu_description md ON (m.menu_id = md.menu_id) LEFT JOIN " . DB_PREFIX . "menu_to_store m2s ON (m.menu_id = m2s.menu_id) WHERE m.parent_id = '" . (int)$parent_id . "' AND md.language_id = '" . (int)$this->config->get('config_language_id') . "' AND m2s.store_id = '" . (int)$this->config->get('config_store_id') . "'  AND m.status = '1' AND m.group_id = '".$group_id."' ORDER BY m.sort_order, LCASE(md.name)");

			$menu_data = $query->rows;

			$this->cache->set('menu.'. $group_id . $parent_id . '.' . $this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id'), $menu_data);
		}

		return $menu_data;
	}
	
	 public function getMenu_mobile() {
		$sql = "SELECT * FROM " . DB_PREFIX . "menu_mobile WHERE status=1 ORDER BY sort_order ASC";

		$query = $this->db->query($sql);

		return $query->rows;
	}
}
?>