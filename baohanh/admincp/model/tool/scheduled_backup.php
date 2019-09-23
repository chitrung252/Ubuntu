<?php
class ModelToolScheduledBackup extends Model {
	public function updateSettingValue($group, $key, $value)
	{
		$this->db->query("DELETE FROM " . DB_PREFIX . "setting WHERE `code` = '" . $this->db->escape($group) . "' AND `key` = '". $this->db->escape($key) ."'"); 
		
		$this->db->query("INSERT INTO " . DB_PREFIX . "setting SET `code` = '" . $this->db->escape($group) . "', `key` = '" . $this->db->escape($key) . "', `value` = '" . $this->db->escape($value) . "'");
		
		return true;
	}
	
	public function getSettingValue($code, $key) {
		$query = $this->db->query("
			SELECT 
				* 
			FROM " . DB_PREFIX . "setting 
			WHERE 
				`code` = '" . $this->db->escape($code) . "'
			 AND  `key` = '" . $this->db->escape($key) . "'
		");
    
		$setting_value = "";		
		foreach($query->rows as $result)
		{
			$setting_value = $result['value'];
		}
		
    return $setting_value;
	}
	
	public function getTables() {
		$table_data = array();
		
		$query = $this->db->query("SHOW TABLES FROM `" . DB_DATABASE . "`");
	
		foreach ($query->rows as $key => $result) {
			$table_data[] = $result['Tables_in_' . DB_DATABASE];
		}
		
		return $table_data;
	}
	
}
?>