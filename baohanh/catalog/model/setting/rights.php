<?php
class ModelSettingRights extends Model {

  /*
   SYSTEM Groups
  
   -1 everybody
   -2 guests (visitors)
   -3 users

  */
  public function getRight($object_id, $object_type) {
    
    $group_id = $this->customer->getGroupId();
    $user_id = $this->customer->getId();
    
    $viewable = false;
    
    if (!empty($user_id)) {
    
      //then usergroup, users, everybody
    
      $query = $this->db->query("SELECT object_id FROM ". DB_PREFIX . "allowed_groups WHERE object_id = '" . $object_id. "' AND object_type = '" . $object_type. "' AND group_id IN (-1,-3," . $group_id . ")");
      
      if ($query->row) {
        $viewable = true;      
      }
      
      $query = $this->db->query("SELECT object_id FROM ". DB_PREFIX . "allowed_users WHERE object_id = '" . $object_id. "' AND object_type = '" . $object_type. "' AND user_id = '" . $user_id . "'");
      
      if ($query->row) {
        $viewable = true;      
      }
      
      $query = $this->db->query("SELECT object_id FROM ". DB_PREFIX . "denied_groups WHERE object_id = '" . $object_id. "' AND object_type = '" . $object_type. "' AND group_id IN (-1,-3," . $group_id . ")");
      
      if ($query->row) {
        $viewable = false;      
      }
      
      $query = $this->db->query("SELECT object_id FROM ". DB_PREFIX . "denied_users WHERE object_id = '" . $object_id. "' AND object_type = '" . $object_type. "' AND user_id = '" . $user_id . "'");
      
      if ($query->row) {
        $viewable = false;      
      } 
    
    } else {
      
      //everybody, guests
    
      $query = $this->db->query("SELECT object_id FROM ". DB_PREFIX . "allowed_groups WHERE object_id = '" . $object_id. "' AND object_type = '" . $object_type. "' AND group_id IN (-1,-2)");
      
      if ($query->row) {
        $viewable = true;      
      }
      
      $query = $this->db->query("SELECT object_id FROM ". DB_PREFIX . "denied_groups WHERE object_id = '" . $object_id. "' AND object_type = '" . $object_type. "' AND group_id IN (-1,-2)");
      
      if ($query->row) {
        $viewable = false;      
      }
      
    
    }
    
    return $viewable;
	}
  
}