<?php
class ModelSettingRights extends Model {
  
  public function getAllowedGroups($id,$type) {
    /*
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer_group cg LEFT JOIN " . DB_PREFIX . "customer_group_description cgd ON (cg.customer_group_id = cgd.customer_group_id) LEFT JOIN " . DB_PREFIX . "allowed_groups ag ON (cg.customer_group_id = ag.group_id) WHERE cgd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND ag.object_id = '" . $id. "' AND ag.object_type = '" . $type. "' ORDER BY cgd.name ASC");

		return $query->rows;
    */
    
    $right_data = array();
    
    $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer_group cg LEFT JOIN " . DB_PREFIX . "customer_group_description cgd ON (cg.customer_group_id = cgd.customer_group_id) LEFT JOIN " . DB_PREFIX . "allowed_groups ag ON (cg.customer_group_id = ag.group_id) WHERE cgd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND ag.object_id = '" . $id. "' AND ag.object_type = '" . $type. "' ORDER BY cgd.name ASC");
    
    	foreach ($query->rows as $result) {
			$right_data[] = $result['customer_group_id'];
		}
    
		return $right_data;
    
	}
  
  public function getDeniedGroups($id,$type) {
  
		$right_data = array();
    
    $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer_group cg LEFT JOIN " . DB_PREFIX . "customer_group_description cgd ON (cg.customer_group_id = cgd.customer_group_id) LEFT JOIN " . DB_PREFIX . "denied_groups dg ON (cg.customer_group_id = dg.group_id) WHERE cgd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND dg.object_id = '" . $id. "' AND dg.object_type = '" . $type. "' ORDER BY cgd.name ASC");
    
    	foreach ($query->rows as $result) {
			$right_data[] = $result['customer_group_id'];
		}
    
		return $right_data;
	}
  
  public function getAllowedUsers($id,$type) {
  
		$right_data = array();
    
    $query = $this->db->query("SELECT *, CONCAT(c.firstname, ' ', c.lastname) AS name FROM " . DB_PREFIX . "customer c LEFT JOIN " . DB_PREFIX . "allowed_users au ON (c.customer_id = au.user_id) WHERE au.object_id = '" . $id. "' AND au.object_type = '" . $type. "' ORDER BY name ASC");
    
    	foreach ($query->rows as $result) {
			$right_data[] = $result['customer_id'];
		}
    
		return $right_data;
	}	
  
   public function getDeniedUsers($id,$type) {
  
		$right_data = array();
    
    $query = $this->db->query("SELECT *, CONCAT(c.firstname, ' ', c.lastname) AS name FROM " . DB_PREFIX . "customer c LEFT JOIN " . DB_PREFIX . "denied_users du ON (c.customer_id = du.user_id) WHERE du.object_id = '" . $id. "' AND du.object_type = '" . $type. "' ORDER BY name ASC");
    
    	foreach ($query->rows as $result) {
			$right_data[] = $result['customer_id'];
		}
    
		return $right_data;
	}
}