<?php
class ModelCatalogMenu extends Model {

	public function addMenu($data) {
    $this->event->trigger('pre.admin.add.menu', $data);
    
		$this->db->query("INSERT INTO " . DB_PREFIX . "menu SET parent_id = '" . (int)$data['parent_id'] . "', `column` = '" . (int)$data['column'] . "', sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', target_link = '". $this->db->escape($data['target_link']) . "', group_id = '" . (int)$data['group_id'] . "'");
	
		$menu_id = $this->db->getLastId();
		
		foreach ($data['menu_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "menu_description SET menu_id = '" . (int)$menu_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape(trim($value['name'])) . "', description = '" . $this->db->escape(trim($value['description'])) . "'");
		}
		
		if (isset($data['menu_store'])) {
			foreach ($data['menu_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "menu_to_store SET menu_id = '" . (int)$menu_id . "', store_id = '" . (int)$store_id . "'");
			}
		}
    
    	// MySQL Hierarchical Data Closure Table Pattern
		$level = 0;

		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "menu_path` WHERE menu_id = '" . (int)$data['parent_id'] . "' ORDER BY `level` ASC");

		foreach ($query->rows as $result) {
			$this->db->query("INSERT INTO `" . DB_PREFIX . "menu_path` SET `menu_id` = '" . (int)$menu_id . "', `path_id` = '" . (int)$result['path_id'] . "', `level` = '" . (int)$level . "'");

			$level++;
		}

		$this->db->query("INSERT INTO `" . DB_PREFIX . "menu_path` SET `menu_id` = '" . (int)$menu_id . "', `path_id` = '" . (int)$menu_id . "', `level` = '" . (int)$level . "'");


		$this->cache->delete('menu');
    
    $this->event->trigger('post.admin.add.menu', $menu_id);

    return $menu_id;    
    
	}
	
	public function editMenu($menu_id, $data) {
  
    $this->event->trigger('pre.admin.edit.menu', $data);
    
		$this->db->query("UPDATE " . DB_PREFIX . "menu SET parent_id = '" . (int)$data['parent_id'] . "', `column` = '" . (int)$data['column'] . "', sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', target_link ='". $this->db->escape($data['target_link']) . "' WHERE menu_id = '" . (int)$menu_id . "'");

		$this->db->query("DELETE FROM " . DB_PREFIX . "menu_description WHERE menu_id = '" . (int)$menu_id . "'");

		foreach ($data['menu_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "menu_description SET menu_id = '" . (int)$menu_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape(trim($value['name'])) . "', description = '" . $this->db->escape(trim($value['description'])) . "'");
		}
		
    // MySQL Hierarchical Data Closure Table Pattern
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "menu_path` WHERE path_id = '" . (int)$menu_id . "' ORDER BY level ASC");

		if ($query->rows) {
			foreach ($query->rows as $menu_path) {
				// Delete the path below the current one
				$this->db->query("DELETE FROM `" . DB_PREFIX . "menu_path` WHERE menu_id = '" . (int)$menu_path['menu_id'] . "' AND level < '" . (int)$menu_path['level'] . "'");

				$path = array();

				// Get the nodes new parents
				$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "menu_path` WHERE menu_id = '" . (int)$data['parent_id'] . "' ORDER BY level ASC");

				foreach ($query->rows as $result) {
					$path[] = $result['path_id'];
				}

				// Get whats left of the nodes current path
				$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "menu_path` WHERE menu_id = '" . (int)$menu_path['menu_id'] . "' ORDER BY level ASC");

				foreach ($query->rows as $result) {
					$path[] = $result['path_id'];
				}

				// Combine the paths with a new level
				$level = 0;

				foreach ($path as $path_id) {
					$this->db->query("REPLACE INTO `" . DB_PREFIX . "menu_path` SET menu_id = '" . (int)$menu_path['menu_id'] . "', `path_id` = '" . (int)$path_id . "', level = '" . (int)$level . "'");

					$level++;
				}
			}
		} else {
			// Delete the path below the current one
			$this->db->query("DELETE FROM `" . DB_PREFIX . "menu_path` WHERE menu_id = '" . (int)$menu_id . "'");

			// Fix for records with no paths
			$level = 0;

			$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "menu_path` WHERE menu_id = '" . (int)$data['parent_id'] . "' ORDER BY level ASC");

			foreach ($query->rows as $result) {
				$this->db->query("INSERT INTO `" . DB_PREFIX . "menu_path` SET menu_id = '" . (int)$menu_id . "', `path_id` = '" . (int)$result['path_id'] . "', level = '" . (int)$level . "'");

				$level++;
			}

			$this->db->query("REPLACE INTO `" . DB_PREFIX . "menu_path` SET menu_id = '" . (int)$menu_id . "', `path_id` = '" . (int)$menu_id . "', level = '" . (int)$level . "'");
		}
    
		$this->db->query("DELETE FROM " . DB_PREFIX . "menu_to_store WHERE menu_id = '" . (int)$menu_id . "'");
		
		if (isset($data['menu_store'])) {		
			foreach ($data['menu_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "menu_to_store SET menu_id = '" . (int)$menu_id . "', store_id = '" . (int)$store_id . "'");
			}
		}
		
		$this->cache->delete('menu');
    
    $this->event->trigger('post.admin.edit.menu', $menu_id);
	}
	
	public function deleteMenu($menu_id) {
    $this->event->trigger('pre.admin.delete.menu', $menu_id);
    
    $this->db->query("DELETE FROM " . DB_PREFIX . "menu_path WHERE menu_id = '" . (int)$menu_id . "'");

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "menu_path WHERE path_id = '" . (int)$menu_id . "'");

		foreach ($query->rows as $result) {
			$this->deleteMenu($result['menu_id']);
		}
  
		$this->db->query("DELETE FROM " . DB_PREFIX . "menu WHERE menu_id = '" . (int)$menu_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "menu_description WHERE menu_id = '" . (int)$menu_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "menu_to_store WHERE menu_id = '" . (int)$menu_id . "'");
   
		$this->cache->delete('menu');
    
    $this->event->trigger('post.admin.delete.menu', $menu_id);
	} 

	public function getMenu($menu_id) {
   $query = $this->db->query("SELECT DISTINCT *, (SELECT GROUP_CONCAT(md1.name ORDER BY level SEPARATOR '&nbsp;&nbsp;&gt;&nbsp;&nbsp;') FROM " . DB_PREFIX . "menu_path mp LEFT JOIN " . DB_PREFIX . "menu_description md1 ON (mp.path_id = md1.menu_id AND mp.menu_id != mp.path_id) WHERE mp.menu_id = m.menu_id AND md1.language_id = '" . (int)$this->config->get('config_language_id') . "' GROUP BY mp.menu_id) AS path FROM " . DB_PREFIX . "menu m LEFT JOIN " . DB_PREFIX . "menu_description md2 ON (m.menu_id = md2.menu_id) WHERE m.menu_id = '" . (int)$menu_id . "' AND md2.language_id = '" . (int)$this->config->get('config_language_id') . "'");
	 return $query->row;
	}
	
  public function getMenus($data) {
		$sql = "SELECT mp.menu_id AS menu_id, m1.group_id AS group_id, GROUP_CONCAT(md1.name ORDER BY mp.level SEPARATOR '&nbsp;&nbsp;&gt;&nbsp;&nbsp;') AS name, m1.parent_id, m1.sort_order FROM " . DB_PREFIX . "menu_path mp LEFT JOIN " . DB_PREFIX . "menu m1 ON (mp.menu_id = m1.menu_id) LEFT JOIN " . DB_PREFIX . "menu m2 ON (mp.path_id = m2.menu_id) LEFT JOIN " . DB_PREFIX . "menu_description md1 ON (mp.path_id = md1.menu_id) LEFT JOIN " . DB_PREFIX . "menu_description md2 ON (mp.menu_id = md2.menu_id) WHERE md1.language_id = '" . (int)$this->config->get('config_language_id') . "' AND md2.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (!empty($data['filter_name'])) {
			$sql .= " AND md2.name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
		}
    
    if (isset($data['filter_group_id']) && ($data['filter_group_id'] > -1)) {
			$sql .= " AND m1.group_id = '" . (int)$data['filter_group_id'] . "'";
		}

		$sql .= " GROUP BY mp.menu_id";

		$sort_data = array(
			'name',
			'sort_order'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY name";
		}
    
		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}
    
		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}
    
    $query = $this->db->query($sql);

		return $query->rows;
	}
	
	public function getMenuDescriptions($menu_id) {
		$menu_description_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "menu_description WHERE menu_id = '" . (int)$menu_id . "'");
		
		foreach ($query->rows as $result) {
			$menu_description_data[$result['language_id']] = array(
				'name'             => $result['name'],
				'description'      => $result['description']
			);
		}
		
		return $menu_description_data;
	}	

	public function getMenuStores($menu_id) {
		$menu_store_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "menu_to_store WHERE menu_id = '" . (int)$menu_id . "'");

		foreach ($query->rows as $result) {
			$menu_store_data[] = $result['store_id'];
		}
		
		return $menu_store_data;
	}
	
	public function getTotalMenus($filter_group_id = -1) {
    
    $sql = ("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "menu");
    
    if (isset($filter_group_id) && ($filter_group_id > -1)) {
			$sql .= " WHERE group_id = '" . (int)$filter_group_id . "'";
		}
      	$query = $this->db->query($sql);
		
		return $query->row['total'];
	}	
	
  public function repairMenus($parent_id = 0) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "menu WHERE parent_id = '" . (int)$parent_id . "'");

		foreach ($query->rows as $menu) {
			// Delete the path below the current one
			$this->db->query("DELETE FROM `" . DB_PREFIX . "menu_path` WHERE menu_id = '" . (int)$menu['menu_id'] . "'");

			// Fix for records with no paths
			$level = 0;

			$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "menu_path` WHERE menu_id = '" . (int)$parent_id . "' ORDER BY level ASC");

			foreach ($query->rows as $result) {
				$this->db->query("INSERT INTO `" . DB_PREFIX . "menu_path` SET menu_id = '" . (int)$menu['menu_id'] . "', `path_id` = '" . (int)$result['path_id'] . "', level = '" . (int)$level . "'");

				$level++;
			}

			$this->db->query("REPLACE INTO `" . DB_PREFIX . "menu_path` SET menu_id = '" . (int)$menu['menu_id'] . "', `path_id` = '" . (int)$menu['menu_id'] . "', level = '" . (int)$level . "'");

			$this->repairMenus($menu['menu_id']);
		}
	}
  
  public function getTotalMenusByGroupId($menu_group_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "menu WHERE group_id = '" . (int)$menu_group_id . "'");

		return $query->row['total'];
	}	
  
}
?>