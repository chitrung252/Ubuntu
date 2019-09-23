<?php
/*
 	This module is generating database backup periodically.
*/
ignore_user_abort(true);

define("DIR_BACKUP", DIR_SYSTEM."backup/");

class ControllerModuleScheduledBackup extends Controller {

	public function index(){
		if ( !empty($_POST) || defined('DOING_CRON') )
		{
			// ignore calling to prevent duplicated action.
			
		}
		else
		{
			define('DOING_CRON', true);
			$this->load->model('tool/scheduled_backup');
      
      if($this->model_tool_scheduled_backup->validate_scheduled_backup() == true)
			{
				$backup_configuration = $this->model_tool_scheduled_backup->get_scheduled_backup_setting("scheduler", "backup_configuration");
				$backup_configuration = unserialize($backup_configuration);
				if($backup_configuration['backup_enable'] == true)
				{
					$sql_statements = $this->model_tool_scheduled_backup->backup_tables($backup_configuration['backup_tables']);
					
					$original_backup_schedule = $backup_configuration['backup_next_schedule'];
					$backup_configuration = $this->model_tool_scheduled_backup->get_estimated_next_scheduled_backup($backup_configuration);	
					$this->model_tool_scheduled_backup->update_backup_configuration($backup_configuration);
					
          if($sql_statements != "")
					{
						switch($backup_configuration['backup_options'])
						{
							case 'email':
								$this->load->model('setting/store');
			
								$store_name = $this->config->get('config_name');
							
								$email = $backup_configuration['backup_destination'];
                
                $this->admin_language->load('tool/scheduled_backup');
								
								$subject = $this->admin_language->get('email_title')." - ".date("Y/m/d");
								$message = $this->admin_language->get('email_message');
								$message .= $this->admin_language->get('text_setup').$original_backup_schedule.".";
								$message .= $this->admin_language->get('text_date').date("Y/m/d H:i:s").".";
								$message .= $this->admin_language->get('text_next').$backup_configuration['backup_next_schedule'].".";
								$message .= $this->admin_language->get('text_hr');
                
  							$mail = new Mail($this->config->get('config_mail'));
												
								$mail->setTo($email);
								
								$mail->setFrom($this->config->get('config_email'));
								$mail->setSender($store_name);
								
								$mail->setSubject($subject);					
								
								$mail->setHtml($message);
								
								$filename = "backup-".date("Y-m-d-H-i-s")."-".md5(time()."-".date("Y-m-d".rand())).".sql";
								$this->model_tool_scheduled_backup->save_backup_file($filename, $sql_statements);
								
								$filename = $this->model_tool_scheduled_backup->gzip_backup_file($filename);
								$mail->addAttachment(DIR_BACKUP.$filename, $filename);
								
								$mail->send();
								$this->model_tool_scheduled_backup->delete_backup_file($filename);
								
							
								break;
							case 'backup_to':
								$filename = "backup-".date("Y-m-d-H-i-s")."-".md5(time()."-".date("Y-m-d".rand())).".sql";
								$this->model_tool_scheduled_backup->save_backup_file($filename, $sql_statements);
								$filename = $this->model_tool_scheduled_backup->gzip_backup_file($filename);
								break;
						}	
					}
	
				}
			}
		}
  	}
}
		