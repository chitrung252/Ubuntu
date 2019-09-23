<?php
class ControllerToolFileManagerFrame extends Controller {
	private $error = array();

	public function index() {
  
    $this->load->model('localisation/language');

    $result = $this->model_localisation_language->getLanguage($this->config->get('config_language_id')); 
		
    $data['code'] = $result['code'];

  	$this->response->setOutput($this->load->view('tool/file_manager_frame.tpl', $data));
	}
  
}             