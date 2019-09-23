<?php
class ModelDesignBanner extends Model {
	public function getBanner($banner_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "banner_image bi LEFT JOIN " . DB_PREFIX . "banner_image_description bid ON (bi.banner_image_id  = bid.banner_image_id) WHERE bi.banner_id = '" . (int)$banner_id . "' AND bid.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY bi.sort_order ASC");

		return $query->rows;
	}
  
  public function getBanners($data = array()) {
		$sql = "SELECT title, image, link FROM";
    
    if (!empty($data['filter_information_id'])) {
     $sql .=" " . DB_PREFIX . "banner_to_information b2i LEFT JOIN " . DB_PREFIX . "banner_image bi ON (b2i.banner_id = bi.banner_id)";
    } else {
     $sql .=" " . DB_PREFIX . "banner_image bi";
    }
    
    $sql .=" LEFT JOIN " . DB_PREFIX . "banner b ON (b.banner_id  = bi.banner_id) LEFT JOIN " . DB_PREFIX . "banner_image_description bid ON (bi.banner_image_id  = bid.banner_image_id) WHERE bid.language_id = '" . (int)$this->config->get('config_language_id') . "'";
    
    if (!empty($data['filter_banner_id'])) {
     $sql .=" AND b.banner_id = '" . (int)$data['filter_banner_id'] . "'";
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