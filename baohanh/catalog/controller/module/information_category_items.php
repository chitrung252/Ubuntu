<?php
class ControllerModuleInformationCategoryItems extends Controller {
	public function index($setting) {
  
    static $module = 0;
    
    $this->document->addScript('catalog/view/javascript/gallery/jquery.masonry.min.js');
  
    $this->load->model('setting/rights');
    
    if (isset($setting['category_id']) && $this->model_setting_rights->getRight($setting['category_id'], 2)) {

  		$this->load->model('catalog/information_category');
      
      $category = $this->model_catalog_information_category->getCategory($setting['category_id']);
      
      if (!empty($category)) {
      
        $this->load->language('module/information_category_items');
      
        $data['button_download'] = $this->language->get('button_download');
        
        $data['heading_title'] = $category['name'];
        
        $data['show_downloads'] = $category['show_downloads'];
        $data['simple_items'] = $category['simple_items'];
        $data['simple_subcategories'] = $category['simple_subcategories'];
        $data['show_item_date'] = $category['show_item_date'];
        
        $data['text_all_items'] = $this->language->get('text_all_items'). ' '. $data['heading_title'];
        
        $data['link'] = $this->url->link('information/category', 'path=' . $setting['category_id']);
       
        $sort = strstr($category['default_sort_order'], "-",true);
      
	    $order = substr(strrchr($category['default_sort_order'], "-"), 1);
      
        $this->load->model('catalog/information');
        
        $this->load->model('tool/image');
        
        if (!empty($setting['where'])) {
          $data['side'] = 1;
        }
    
      $data['items'] = array();
        
        $filter_data = array(
				'filter_category_id' => $setting['category_id'],
				'sort'               => $sort,
				'order'              => $order,
				'start'              => 0,
				'limit'              => $setting['limit']
			);

			$results = $this->model_catalog_information->getInformations_2($filter_data);

			 foreach ($results as $result) {
  				if ($result['list_image']) {
  					$image = $this->model_tool_image->resizeTo($result['list_image'], $this->config->get('config_image_item_list_width'), 0, 'maxwidth', $this->config->get('config_image_item_list_height'));
  				} else {
  					$image = null;
  				}
          
          $downloads = array();
        
        if ($data['show_downloads']) {
          $this->load->model('catalog/download');
          $download_results = $this->model_catalog_download->getDownloads($result['information_id'],0, 100);
          foreach ($download_results as $download) {
			     if (file_exists(DIR_DOWNLOAD . $download['filename'])) {
				    $size = filesize(DIR_DOWNLOAD . $download['filename']);

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
    
    				$downloads[] = array(
    					'date_added' => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
    					'name'       => $download['name'],
    					'size'       => round(substr($size, 0, strpos($size, '.') + 4), 2) . $suffix[$i],
    					'href'       => $this->url->link('information/information/download', 'information_id=' . $result['information_id'].'&download_id=' . $download['download_id'], 'SSL')
    				); 
           }
          }
        }  
          
    			$data['items'][] = array(
    				'item_id'  => $result['information_id'],
    				'thumb'       => $image,
            'downloads'   => $downloads,
    				'name'        => $result['title'],
    				'description' => html_entity_decode($result['short_description'], ENT_QUOTES, 'UTF-8'),
            'date_added'  => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
            'date_modified' => date($this->language->get('date_format_short'), strtotime($result['date_modified'])),
    				'href'        => $this->url->link('information/information', 'information_id=' . $result['information_id'])
    			);
            
        }
    
        $data['module'] = $module++;
    
    		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/information_category_items.tpl')) {
    			return $this->load->view($this->config->get('config_template') . '/template/module/information_category_items.tpl', $data);
    		} else {
    			return $this->load->view('default/template/module/information_category_items.tpl', $data);
    		}
      
      }
    
    }
    
	}
}