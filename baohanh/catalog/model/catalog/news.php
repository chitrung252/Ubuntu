<?php
class ModelCatalogNews extends Model {
	
  public function getInformations_2($data = array()) {
  
    
		$sql = "SELECT i.information_id";

		if (!empty($data['filter_category_id'])) {
			if (!empty($data['filter_sub_category'])) {
				$sql .= " FROM " . DB_PREFIX . "information_category_path cp LEFT JOIN " . DB_PREFIX . "information_to_category i2c ON (cp.category_id = i2c.category_id)";
			} else {
				$sql .= " FROM " . DB_PREFIX . "information_to_category i2c";
			}
			
			$sql .= " LEFT JOIN " . DB_PREFIX . "information i ON (i2c.information_id = i.information_id)";

		} else {
			$sql .= " FROM " . DB_PREFIX . "information i";
		}


		$sql .= " LEFT JOIN " . DB_PREFIX . "information_description id ON (i.information_id = id.information_id) LEFT JOIN " . DB_PREFIX . "information_to_store i2s ON (i.information_id = i2s.information_id)";
    
  
    
    $sql .= " id.language_id = '" . (int)$this->config->get('config_language_id') . "' AND i.status = '1' AND i2s.store_id = '" . (int)$this->config->get('config_store_id') . "'";

		if (!empty($data['filter_category_id'])) {
			if (!empty($data['filter_sub_category'])) {
				$sql .= " AND cp.path_id = '" . (int)$data['filter_category_id'] . "'";
			} else {
				$sql .= " AND i2c.category_id = '" . (int)$data['filter_category_id'] . "'";
			}
			
		}

		$sql .= " GROUP BY i.information_id";

		$information_data = array();
     
		$query = $this->db->query($sql);
		
       foreach ($query->rows as $result) {
			$information_data[$result['information_id']] = $this->getInformation($result['information_id']);
		}
    
		return $information_data;
    
    
    //return $query->rows;
    
	}
  
  
}