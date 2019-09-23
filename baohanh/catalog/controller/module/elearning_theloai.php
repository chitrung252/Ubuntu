<?php
class ControllerModuleElearningTheloai extends Controller {
	public function index($setting) {
		$this->load->language('module/elearning_theloai');
        $this->load->model('elearning/elearning_theloai');
		$data['heading_title'] = $this->language->get('heading_title');
		
		# Call data
		$data['categories'] = array();
		$categories = $this->model_elearning_elearning_theloai->getCategoriesViewed(); 
		//$category_total = $this->model_elearning_elearning_theloai->getTotalCategories();
		
		 foreach ($categories as $category) {
			 $children_data = array();

			 $children = $this->model_elearning_elearning_theloai->getCategoriesViewed($category['category_id']);
			 
			 # call 1
			 foreach ($children as $child) {
        
            if (($child['category_id'])) {    
  				$filter_data = array(
  					'filter_category_id'  => $child['category_id'],
  					'filter_sub_category' => true
  				);
  
  				$children_data[] = array(
  					'category_id' => $child['category_id'],
  					'name'        => $child['name'],
					'href'  => $this->url->link('elearning/category', 'path_e=' . $child['category_id']),
					'total' => $this->model_elearning_elearning_theloai->getTotalElearnings($filter_data)
  					
  				         );
                }
        
			}
			# call 2
			
		  if (($category['category_id'])) {
			
  			$filter_data = array(
  				'filter_category_id'  => $category['category_id'],
  				'filter_sub_category' => true
  			);
           
  			$data['categories'][] = array(
  				'category_id' => $category['category_id'],
  				'name'        => $category['name'],
				'href'  => $this->url->link('elearning/category', 'path_e=' . $category['category_id']),
  				'total' => $this->model_elearning_elearning_theloai->getTotalElearnings($filter_data),
				'children'    => $children_data
  				
  			);
         }
			 
			 
		 } #end foreach

       # load position
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/elearning_theloai.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/module/elearning_theloai.tpl', $data);
		} else {
			return $this->load->view('default/template/module/elearning_theloai.tpl', $data);
		}
	}
}