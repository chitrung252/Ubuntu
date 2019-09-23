<?php
class ControllerInformationSitemap extends Controller {
	public function index() {
		$this->load->language('information/sitemap');

		$this->document->setTitle($this->language->get('heading_title'));

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('information/sitemap')
		);

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_account'] = $this->language->get('text_account');
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_password'] = $this->language->get('text_password');
		$data['text_search'] = $this->language->get('text_search');
		$data['text_information'] = $this->language->get('text_information');
		$data['text_contact'] = $this->language->get('text_contact');
    
    $data['text_information_categories'] = $this->language->get('text_information_categories');
    
    
    $this->load->model('setting/rights');

		$this->load->model('catalog/information_category');
		$this->load->model('catalog/information');
    
		$data['categories'] = array();

		$categories_1 = $this->model_catalog_information_category->getCategories(0);
    
		foreach ($categories_1 as $category_1) {
			$level_2_data = array();
      
			$categories_2 = $this->model_catalog_information_category->getCategories($category_1['category_id']);

			foreach ($categories_2 as $category_2) {
				$level_3_data = array();
        
				$categories_3 = $this->model_catalog_information_category->getCategories($category_2['category_id']);

				foreach ($categories_3 as $category_3) {
        
          if ($this->model_setting_rights->getRight($category_3['category_id'], TYPE_INFORMATION_CATEGORY)) {
          
  					$level_3_data[] = array(
  						'name' => $category_3['name'],
  						'href' => $this->url->link('information/category', 'path=' . $category_1['category_id'] . '_' . $category_2['category_id'] . '_' . $category_3['category_id'])
  					);
          
          }
				}

        if ($this->model_setting_rights->getRight($category_2['category_id'], TYPE_INFORMATION_CATEGORY)) {

  				$level_2_data[] = array(
  					'name'     => $category_2['name'],
  					'children' => $level_3_data,
  					'href'     => $this->url->link('information/category', 'path=' . $category_1['category_id'] . '_' . $category_2['category_id'])
  				);
        }
        
			}

      if ($this->model_setting_rights->getRight($category_1['category_id'], TYPE_INFORMATION_CATEGORY)) {

  			$data['categories'][] = array(
  				'name'     => $category_1['name'],
  				'children' => $level_2_data,
  				'href'     => $this->url->link('information/category', 'path=' . $category_1['category_id'])
  			);
      
      }
      
		}

		$data['account'] = $this->url->link('account/account', '', 'SSL');
		$data['edit'] = $this->url->link('account/edit', '', 'SSL');
		$data['password'] = $this->url->link('account/password', '', 'SSL');
		$data['search'] = $this->url->link('common/searches');
		$data['contact'] = $this->url->link('information/contact');

		$data['informations'] = array();

		foreach ($this->model_catalog_information->getInformations() as $result) {
     if ($this->model_setting_rights->getRight($result['information_id'], TYPE_INFORMATION)) {
			$data['informations'][] = array(
				'title' => $result['title'],
				'href'  => $this->url->link('information/information', 'information_id=' . $result['information_id'])
			);
     } 
		}

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/information/sitemap.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/information/sitemap.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/information/sitemap.tpl', $data));
		}
	}
}