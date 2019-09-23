<?php
class ModelToolScheduledBackup extends Model {

	public function validate_scheduled_backup()
	{
		$backup_configuration = $this->get_scheduled_backup_setting("scheduler", "backup_configuration");
		
		if(empty($backup_configuration))
		{
			// install temporary backup configuration
			$backup_configuration = array(
				  'backup_tables'			=> array()
				, 'backup_tables_excludes' 	=> array()
				, 'backup_options'			=> 'email'				// 'save to server', 'email backup to'
				, 'backup_destination'		=> htmlspecialchars($this->get_scheduled_backup_setting("config", "config_email"))
				, 'backup_next_schedule'	=> date("Y/m/d H:i:s")
				, 'backup_schedule'			=> 'once_daily'		// never, once hourly, twice daily, once daily, once weekly, twice a month
				, 'backup_enable'			=> false				
			);
			
			$table_data = array();
					
			$query = $this->db->query("SHOW TABLES FROM `" . DB_DATABASE . "`");
			
			foreach ($query->rows as $key => $result) {
				$table_name = $result['Tables_in_' . DB_DATABASE];
				$table_data[] = $table_name;
			}
			
			//$backup_configuration['backup_tables'] = serialize($table_data);
			$this->update_backup_configuration($backup_configuration);
		}
		else
		{
			$backup_configuration = unserialize($backup_configuration);
		}
		
		$status = false;
		
		$current_time = time();
		if($backup_configuration['backup_enable'] == true)
		{
			$current_time = time();
			if(($current_time - strtotime($backup_configuration['backup_next_schedule'])) >= 0)
			{
				$status = true;
			} 	
		}
		
		return $status;
	}
	
	public function save_backup_file($filename, $data)
	{
		$file = DIR_BACKUP. $filename;
		$handle = fopen($file, 'w');

    	fwrite($handle, $data);
		
    	fclose($handle);
	}
	
	public function gzip_backup_file($filename)
	{
		/**
		 * Try to compress to gzip, if available 
		 */
		if ( function_exists('gzencode') ) {
			$gz_diskfile = $filename.".gz";
			if ( function_exists('file_get_contents') ) {
				$text = file_get_contents(DIR_BACKUP.$filename);
				$gz_text = gzencode($text, 9);
				$fp = fopen(DIR_BACKUP.$gz_diskfile, "w");
				fwrite($fp, $gz_text);
				if ( fclose($fp) ) {
					unlink(DIR_BACKUP.$filename);
				}
				$filename = $gz_diskfile;
			} 
		}
		return $filename;
	}

	public function delete_backup_file($filename)
	{
		$file = DIR_BACKUP. $filename;
		
		if (file_exists($file)) {
			unlink($file);
		}
	}
	
	public function get_estimated_next_scheduled_backup($backup_configuration)
	{
		switch($backup_configuration['backup_schedule'])
		{
			case "once_hourly":	// Every hour
				$backup_next_schedule = date("Y/m/d H:00:00", strtotime("+1 hour"));			
				break;
			case "twice_daily":	// 00:00, 12:00
				if(date("H") <= 12)
				{
					$backup_next_schedule = date("Y/m/d 11:59:59");
				}
				elseif(date("H") <= 24)
				{
					$backup_next_schedule = date("Y/m/d 00:00:00", strtotime("+1 day"));
				}
				break;
			case "once_daily":	// 00:00
				$backup_next_schedule = date("Y/m/d 00:00:00", strtotime("+1 day"));
				break;
      case "once_weekly":	// 00:00
					$backup_next_schedule = date("Y/m/d 00:00:00", strtotime("+1 week"));
					break;
			case "twice_a_month":	// 15 day, 
					$backup_next_schedule = date("Y/m/d 00:00:00", strtotime("+15 day"));
				  break;
			case "test_now":
				$backup_configuration['backup_schedule'] = 'never';
				$backup_next_schedule = "2020-01-01 00:00:00";
				break;
			case "never":
			default:
				$backup_next_schedule = "2020-01-01 00:00:00";
				break;			
		} 
		$backup_configuration['backup_next_schedule'] = $backup_next_schedule;
		return $backup_configuration;
	}
	
	public function update_backup_configuration($backup_configuration)
	{
		// Update new backup configuration
		$backup_configuration = serialize($backup_configuration);
		$this->update_scheduled_backup_setting("scheduler", "backup_configuration", ($backup_configuration));
		return true;
	}

	public function backup_tables($tables) {
		$output = '';

		foreach ($tables as $table) {
			$output .= 'TRUNCATE TABLE `' . $table . '`;' . "\n\n";
		
			$query = $this->db->query("SELECT * FROM `" . $table . "`");
			
			foreach ($query->rows as $result) {
				$fields = '';
				
				foreach (array_keys($result) as $value) {
					$fields .= '`' . $value . '`, ';
				}
				
				$values = '';
				
				foreach (array_values($result) as $value) {
					$value = str_replace(array("\x00", "\x0a", "\x0d", "\x1a"), array('\0', '\n', '\r', '\Z'), $value);
					$value = str_replace(array("\n", "\r", "\t"), array('\n', '\r', '\t'), $value);
					$value = str_replace('\\', '\\\\',	$value);
					$value = str_replace('\'', '\\\'',	$value);
					$value = str_replace('\\\n', '\n',	$value);
					$value = str_replace('\\\r', '\r',	$value);
					$value = str_replace('\\\t', '\t',	$value);			
					
					$values .= '\'' . $value . '\', ';
				}
				
				$output .= 'INSERT INTO `' . $table . '` (' . preg_replace('/, $/', '', $fields) . ') VALUES (' . preg_replace('/, $/', '', $values) . ');' . "\n";
			}
			
			$output .= "\n\n";
		}

		return $output;	
	}
	
	// Create the function and named to prevent duplication 
	public function get_scheduled_backup_setting($code, $key) {
		$data = array(); 
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "setting WHERE `code` = '" . $this->db->escape($code) . "' AND `key` = '". $this->db->escape($key) ."'");
		
		foreach ($query->rows as $result) {
			$data = $result['value'];
		}
				
		return $data;
	}
	
	public function update_scheduled_backup_setting($code, $key, $value) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "setting WHERE `code` = '" . $this->db->escape($code) . "' AND `key` = '". $this->db->escape($key) ."'"); 
		
		$this->db->query("INSERT INTO " . DB_PREFIX . "setting SET `code` = '" . $this->db->escape($code) . "', `key` = '" . $this->db->escape($key) . "', `value` = '" . $this->db->escape($value) . "'");
		
		return true;
	}
}
?>