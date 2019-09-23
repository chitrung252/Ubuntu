<?php
class ControllerCommonHeader extends Controller {
	public function index() {
		$data['title'] = $this->document->getTitle();

		if ($this->request->server['HTTPS']) {
			$server = $this->config->get('config_ssl');
		} else {
			$server = $this->config->get('config_url');
		}

		$data['base'] = $server;
		$data['description'] = $this->document->getDescription();
		$data['keywords'] = $this->document->getKeywords();
		$data['links'] = $this->document->getLinks();
		$data['styles'] = $this->document->getStyles();
		$data['scripts'] = $this->document->getScripts();
		$data['lang'] = $this->language->get('code');
		$data['direction'] = $this->language->get('direction');
		$data['google_analytics'] = html_entity_decode($this->config->get('config_google_analytics'), ENT_QUOTES, 'UTF-8');
		$data['name'] = $this->config->get('config_name');

		if (is_file(DIR_IMAGE . $this->config->get('config_icon'))) {
			$data['icon'] = $server . 'image/' . $this->config->get('config_icon');
		} else {
			$data['icon'] = '';
		}

		if (is_file(DIR_IMAGE . $this->config->get('config_logo'))) {
			$data['logo'] = $server . 'image/' . $this->config->get('config_logo');
		} else {
			$data['logo'] = '';
		}

		$this->load->language('common/header');

		$data['text_home'] = $this->language->get('text_home');
		$data['home'] = $this->url->link('common/home');
	    // Call model menu
		$this->load->model('catalog/menu');
       // Destop Menu
		$data['menus'] = array();

		$menus = $this->model_catalog_menu->getMenus(0,0);
    
		$this->load->model('setting/rights');
		
		$this->load->model('tool/rewrite');
    
		foreach ($menus as $menu) {
			if (!$menu['parent_id']) {
				// Level 2
				$children_data = array();

				$children = $this->model_catalog_menu->getMenus($menu['menu_id']);
        
       	foreach ($children as $child) {

          if ($this->model_setting_rights->getRight($child['menu_id'], TYPE_MENU)) {    // 3 is menu type 
  					$children_data[] = array(
  						'name'  => $child['name'] ,//. ($this->config->get('config_product_count') ? ' (' . $this->model_catalog_product->getTotalProducts($filter_data) . ')' : ''),
  						'href'  => $this->model_tool_rewrite->rewrite($child['target_link'])
  					);
          }
          
				}
        
				// Level 1
        if ($this->model_setting_rights->getRight($menu['menu_id'], TYPE_MENU)) {    // 3 is menu type
  				$data['menus'][] = array(
  					'name'     => $menu['name'],
  					'children' => $children_data,
  					'column'   => $menu['column'] ? $menu['column'] : 1,
  					'href'     => $this->model_tool_rewrite->rewrite($menu['target_link'])
  				);
        }
			}
		}

		$data['language'] = $this->load->controller('common/language');
		
		$data['search'] = $this->load->controller('common/search');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/header.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/common/header.tpl', $data);
		} else {
			return $this->load->view('default/template/common/header.tpl', $data);
		}
	}
}