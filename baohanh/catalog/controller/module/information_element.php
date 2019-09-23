<?php
class ControllerModuleInformationelement extends Controller {
	public function index($setting) {
    
    $this->load->model('setting/rights');
    
    $data = array();
    
    if (isset($setting['information_id']) && $this->model_setting_rights->getRight($setting['information_id'], TYPE_INFORMATION)) {
    
      $this->load->model('catalog/information');
      $result = $this->model_catalog_information->getInformation($setting['information_id']);	
      
      if ($result) {
    		if (!empty($setting['show_title'])) $data['title'] = $result['title'];
        $data['description'] = html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8');
        
        if ($setting['show_downloads']) {
          $data['button_download'] = $this->language->get('button_download');
          $this->load->model('catalog/download');
          $results = $this->model_catalog_download->getDownloads($setting['information_id'],0, 100);
          $data['downloads'] = array();
          foreach ($results as $result) {
			     if (file_exists(DIR_DOWNLOAD . $result['filename'])) {
				    $size = filesize(DIR_DOWNLOAD . $result['filename']);

    				$i = 0;
    
    				$suffix = array(
    					'B',
    					'KB',
    					'MB',
    					'GB',
    					'TB',
    					'PB',
    					'EB',
    					'ZB',
    					'YB'
    				);
    
    				while (($size / 1024) > 1) {
    					$size = $size / 1024;
    					$i++;
    				}
    
    				$data['downloads'][] = array(
    					'date_added' => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
    					'name'       => $result['name'],
    					'size'       => round(substr($size, 0, strpos($size, '.') + 4), 2) . $suffix[$i],
    					'href'       => $this->url->link('information/information/download', 'information_id=' . $setting['information_id'].'&download_id=' . $result['download_id'], 'SSL')
    				); 
           }
          }
        }
      }
    
      if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/information_element.tpl')) {
  			return $this->load->view($this->config->get('config_template') . '/template/module/information_element.tpl', $data);
  		} else {
  			return $this->load->view('default/template/module/information_element.tpl', $data);
  		}
  			
    }
	}
}