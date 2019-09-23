<?php
class ModelCatalogMenubox extends Model {
	public function getMenubox($menubox_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "menubox_image bi LEFT JOIN " . DB_PREFIX . "menubox_image_description bid ON (bi.menubox_image_id  = bid.menubox_image_id) WHERE bi.menubox_id = '" . (int)$menubox_id . "' AND bid.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY bi.sort_order ASC");

		return $query->rows;
	}
  
  public function getMenuboxs($data = array()) {
		$sql = "SELECT title, image, link FROM";
    
    if (!empty($data['filter_information_id'])) {
     $sql .=" " . DB_PREFIX . "menubox_to_information b2i LEFT JOIN " . DB_PREFIX . "menubox_image bi ON (b2i.menubox_id = bi.menubox_id)";
    } else {
     $sql .=" " . DB_PREFIX . "menubox_image bi";
    }
    
    $sql .=" LEFT JOIN " . DB_PREFIX . "menubox b ON (b.menubox_id  = bi.menubox_id) LEFT JOIN " . DB_PREFIX . "menubox_image_description bid ON (bi.menubox_image_id  = bid.menubox_image_id) WHERE bid.language_id = '" . (int)$this->config->get('config_language_id') . "'";
    
    if (!empty($data['filter_menubox_id'])) {
     $sql .=" AND b.menubox_id = '" . (int)$data['filter_menubox_id'] . "'";
    }
    
    if (!empty($data['filter_information_id'])) {
     $sql .=" AND b2i.information_id = '" . (int)$data['filter_information_id'] . "'";
    }
    
    if (!empty($data['filter_name'])) {
			 $sql .= " AND b.name LIKE '" . $this->db->escape($data['filter_name']) . "'";
		}
    
    $sql .=" ORDER BY bi.sort_order ASC";
    
    $query = $this->db->query($sql);    

		return $query->rows;
	}
}