<?php
class ControllerModuleMenu extends Controller {
	public function index($setting) {
		$this->load->language('module/menu');

		$data['heading_title'] = $this->language->get('heading_title');
   /*
   
   azonosítani a jelenlegi helyet
		
    */
		$this->load->model('catalog/menu');

		$data['menus'] = array();
    
    if (isset($setting['menu_group_id'])) {		
    
      $menus = $this->model_catalog_menu->getMenus(0, $setting['menu_group_id']);
  
  		$this->load->model('setting/rights');
      
  		foreach ($menus as $menu) {
  			if (!$menu['parent_id']) {
  				// Level 2
  				$children_data = array();
  
  				$children = $this->model_catalog_menu->getMenus($menu['menu_id'], $setting['menu_group_id']);
          
         	foreach ($children as $child) {
  
            if ($this->model_setting_rights->getRight($child['menu_id'], 3)) {    // 3 is menu type 
    					$children_data[] = array(
                'menu_id' => $child['menu_id'], 
    						'name'  => $child['name'] ,//. ($this->config->get('config_product_count') ? ' (' . $this->model_catalog_product->getTotalProducts($filter_data) . ')' : ''),
    						'href'  => $child['target_link']//$this->url->link($child['target_link'])   //ezt meg kell csinálni
    					);
            }
            
  				}
  
  				// Level 1
          if ($this->model_setting_rights->getRight($menu['menu_id'], 3)) {    // 3 is menu type
    				$data['menus'][] = array(
              'menu_id'  => $menu['menu_id'],
    					'name'     => $menu['name'],
    					'children' => $children_data,
    					'column'   => $menu['column'] ? $menu['column'] : 1,
    					'href'     => $menu['target_link']//$this->url->link($menu['target_link']) //ezt is
    				);
          }
  			}
  		}
    }
    
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/menu.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/module/menu.tpl', $data);
		} else {
			return $this->load->view('default/template/module/menu.tpl', $data);
		}
	}
}