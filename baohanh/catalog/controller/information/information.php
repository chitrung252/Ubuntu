<?php
class ControllerInformationInformation extends Controller {
	public function index() {
  
		$this->load->language('information/information');

		$this->load->model('catalog/information');

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);
    
    $this->load->model('catalog/information_category');

		if (isset($this->request->get['path'])) {
			$path = '';

			$parts = explode('_', (string)$this->request->get['path']);

			$category_id = (int)array_pop($parts);

			foreach ($parts as $path_id) {
				if (!$path) {
					$path = $path_id;
				} else {
					$path .= '_' . $path_id;
				}

				$category_info = $this->model_catalog_information_category->getCategory($path_id);

				if ($category_info) {
					$data['breadcrumbs'][] = array(
						'text' => $category_info['name'],
						'href' => $this->url->link('information/category', 'path=' . $path)
					);
				}
			}

			// Set the last category breadcrumb
			$category_info = $this->model_catalog_information_category->getCategory($category_id);

			if ($category_info) {
				$url = '';

				if (isset($this->request->get['sort'])) {
					$url .= '&sort=' . $this->request->get['sort'];
				}

				if (isset($this->request->get['order'])) {
					$url .= '&order=' . $this->request->get['order'];
				}

				if (isset($this->request->get['page'])) {
					$url .= '&page=' . $this->request->get['page'];
				}

				if (isset($this->request->get['limit'])) {
					$url .= '&limit=' . $this->request->get['limit'];
				}

				$data['breadcrumbs'][] = array(
					'text' => $category_info['name'],
					'href' => $this->url->link('information/category', 'path=' . $this->request->get['path'] . $url)
				);
			}
		}
    
    if (isset($this->request->get['search']) || isset($this->request->get['tag'])) {
			$url = '';

			if (isset($this->request->get['search'])) {
				$url .= '&search=' . $this->request->get['search'];
			}

			if (isset($this->request->get['tag'])) {
				$url .= '&tag=' . $this->request->get['tag'];
			}
      
      if (isset($this->request->get['type'])) {
				$url .= '&type=' . $this->request->get['type'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_search'),
				'href' => $this->url->link('common/searches', $url)
			);
		}
    

		if (isset($this->request->get['information_id'])) {
			$information_id = (int)$this->request->get['information_id'];
		} else {
			$information_id = 0;
		}

		$information_info = $this->model_catalog_information->getInformation($information_id);
    
		if ($information_info) {
    
      $url = '';
      
      if (isset($this->request->get['path'])) {
				$url .= '&path=' . $this->request->get['path'];
			}

			if (isset($this->request->get['search'])) {
				$url .= '&search=' . $this->request->get['search'];
			}

			if (isset($this->request->get['tag'])) {
				$url .= '&tag=' . $this->request->get['tag'];
			}
      
      if (isset($this->request->get['type'])) {
				$url .= '&type=' . $this->request->get['type'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}
      
      
      $this->load->model('setting/rights');
        
      if ($this->model_setting_rights->getRight($information_id, TYPE_INFORMATION)) {    // 1 is information type
      
  			$this->document->setTitle($information_info['meta_title']);
  			$this->document->setDescription($information_info['meta_description']);
  			$this->document->setKeywords($information_info['meta_keyword']);
        $this->document->addLink($this->url->link('information/information', 'information_id=' . $this->request->get['information_id']), 'canonical');
        
  			$data['breadcrumbs'][] = array(
  				'text' => $information_info['title'],
  				'href' => $this->url->link('information/information', $url . '&information_id=' .  $information_id)
  			);
  
  		$data['heading_title'] = $information_info['title'];
		$data['target_link'] = $information_info['target_link'];
		$data['viewed'] = $information_info['viewed'];
		$data['date_added'] = date($this->language->get('date_format_short'), strtotime($information_info['date_added']));
        
        $data['entry_name'] = $this->language->get('entry_name');

        $data['text_download'] = $this->language->get('text_download');
        $data['text_related'] = $this->language->get('text_related');
        $data['text_bamvaoday'] = $this->language->get('text_bamvaoday');        
        $data['text_date_add'] = $this->language->get('text_date_add');
        $data['text_viewed'] = $this->language->get('text_viewed');		
  		$data['button_continue'] = $this->language->get('button_continue');
                
        $data['text_tags'] = $this->language->get('text_tags');
  
  		$data['description'] = html_entity_decode($information_info['description'], ENT_QUOTES, 'UTF-8');
        
  		$data['continue'] = $this->url->link('common/home');
  
        $this->model_catalog_information->updateViewed($this->request->get['information_id']);
        
        $this->load->model('tool/image');
        
        if ($information_info['image']) {
					$data['image'] = $this->model_tool_image->resizeTo($information_info['image'], $this->config->get('config_image_item_width'), 0, 'maxwidth', $this->config->get('config_image_item_height'));
				}
        
        $data['tags'] = array();

  			if ($information_info['tag']) {
  				$tags = explode(',', $information_info['tag']);
  
  				foreach ($tags as $tag) {
  					$data['tags'][] = array(
  						'tag'  => trim($tag),
  						'href' => $this->url->link('common/searches', 'tag=' . trim($tag))
  					);
  				}
  			}
           
  			
        $data['information_id'] = (int)$this->request->get['information_id'];

        //insert        
         
        $setting = array(
          'resize' => $information_info['resize'],
          'insert' => 1
        );
        
        $data['description'] = $this->ReplaceSpecialTags($data['description'],$setting);
        
        $setting = array(
          'filter_information_id' => $information_id,
          'resize' => $information_info['resize'],
          'insert' => 1
        );
        
        $data['informations'] = array();

	   $results = $this->model_catalog_information->getInformationRelateds($information_id);
        
        foreach ($results as $result) {

				$data['informations'][] = array(
  				'information_id'  => $result['information_id'],
                 'title'        => $result['title'],
  				'description' => html_entity_decode($result['short_description'], ENT_QUOTES, 'UTF-8'),
             'date_added'  => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
          'date_modified' => date($this->language->get('date_format_short'), strtotime($result['date_modified'])),
  				'href'        => $this->url->link('information/information', 'information_id=' . $result['information_id'])
  			);
			}
        
  
        
           $data['column_left'] = $this->load->controller('common/column_left');
  			$data['column_right'] = $this->load->controller('common/column_right');
  			$data['content_top'] = $this->load->controller('common/content_top');
  			$data['content_bottom'] = $this->load->controller('common/content_bottom');
  			$data['footer'] = $this->load->controller('common/footer');
  			$data['header'] = $this->load->controller('common/header');
  
  			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/information/information.tpl')) {
  				$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/information/information.tpl', $data));
  			} else {
  				$this->response->setOutput($this->load->view('default/template/information/information.tpl', $data));
  			}
      
      } else {
      
  			$data['breadcrumbs'][] = array(
  				'text' => $this->language->get('text_not_right'),
  				'href' => $this->url->link('information/information', 'information_id=' . $information_id)
  			);
  
  			$this->document->setTitle($this->language->get('text_not_right'));
  
  			$data['heading_title'] = $this->language->get('text_not_right');
  
  			$data['text_error'] = $this->language->get('text_not_right');
  
  			$data['button_continue'] = $this->language->get('button_continue');
  
  			$data['continue'] = $this->url->link('common/home');
  
  			$data['column_left'] = $this->load->controller('common/column_left');
  			$data['column_right'] = $this->load->controller('common/column_right');
  			$data['content_top'] = $this->load->controller('common/content_top');
  			$data['content_bottom'] = $this->load->controller('common/content_bottom');
  			$data['footer'] = $this->load->controller('common/footer');
  			$data['header'] = $this->load->controller('common/header');
        
  			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/error/not_right.tpl')) {
  				$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/error/not_right.tpl', $data));
  			} else {
  				$this->response->setOutput($this->load->view('default/template/error/not_right.tpl', $data));
  			}
		  }
      
		} else {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_error'),
				'href' => $this->url->link('information/information', 'information_id=' . $information_id)
			);

			$this->document->setTitle($this->language->get('text_error'));

			$data['heading_title'] = $this->language->get('text_error');

			$data['text_error'] = $this->language->get('text_error');

			$data['button_continue'] = $this->language->get('button_continue');

			$data['continue'] = $this->url->link('common/home');

			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');
      
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/error/not_found.tpl')) {
				$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/error/not_found.tpl', $data));
			} else {
				$this->response->setOutput($this->load->view('default/template/error/not_found.tpl', $data));
			}
		}
	}

	
  private function ReplaceSpecialTags($string,$setting){
    
    //gallery tags
    $count = preg_match_all("/<gallery>(.*?)<\/gallery>/", $string, $matches);
    if($count > 0) {
      for($i = 0; $i < $count; $i++) {
          $setting['filter_name'] = $matches[1][$i];
          $replacement = $this->load->controller('module/gallery', $setting);
          $string = str_replace('<gallery>'.$matches[1][$i].'</gallery>', $replacement, $string);
      }
    }
    
    return $string;
  }
  
}