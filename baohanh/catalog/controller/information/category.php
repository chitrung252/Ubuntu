<?php
class ControllerInformationCategory extends Controller {
	public function index() {
		$this->load->language('information/category');

		$this->load->model('catalog/information_category');

		$this->load->model('catalog/information');

		$this->load->model('tool/image');
    
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'i.date_added';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'DESC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		if (isset($this->request->get['limit'])) {
			$limit = $this->request->get['limit'];
		} else {
			$limit = $this->config->get('config_product_limit');
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		if (isset($this->request->get['path'])) {
			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$path = '';

			$parts = explode('_', (string)$this->request->get['path']);

			$category_id = (int)array_pop($parts);

			foreach ($parts as $path_id) {
				if (!$path) {
					$path = (int)$path_id;
				} else {
					$path .= '_' . (int)$path_id;
				}

				$category_info = $this->model_catalog_information_category->getCategory($path_id);

				if ($category_info) {
					$data['breadcrumbs'][] = array(
						'text' => $category_info['name'],
						'href' => $this->url->link('information/category', 'path=' . $path . $url)
					);
				}
			}
		} else {
			$category_id = 0;
		}

		$category_info = $this->model_catalog_information_category->getCategory($category_id);

		if ($category_info) {
    
      $this->load->model('setting/rights');
        
      if ($this->model_setting_rights->getRight($category_id, TYPE_INFORMATION_CATEGORY)) {
    
			$this->document->setTitle($category_info['meta_title']);
			$this->document->setDescription($category_info['meta_description']);
			$this->document->setKeywords($category_info['meta_keyword']);
			$this->document->addLink($this->url->link('information/category', 'path=' . $this->request->get['path']), 'canonical');
      //$this->document->addScript('catalog/view/javascript/gallery/jquery.masonry.min.js');
     
      if (!isset($this->request->get['sort'])) {
        $sort = strstr($category_info['default_sort_order'], "-",true);
      }
      
      if (!isset($this->request->get['order'])) {
			 $order = substr(strrchr($category_info['default_sort_order'], "-"), 1);
      }

			$data['heading_title'] = $category_info['name'];
			$data['simple_items'] = $category_info['simple_items'];
			$data['simple_subcategories'] = $category_info['simple_subcategories'];
			$data['text_refine'] = $this->language->get('text_refine');
			$data['text_empty'] = $this->language->get('text_empty');
			$data['text_quantity'] = $this->language->get('text_quantity');
			$data['text_sort'] = $this->language->get('text_sort');
			$data['text_limit'] = $this->language->get('text_limit');

			$data['button_continue'] = $this->language->get('button_continue');
			$data['button_download'] = $this->language->get('button_download');

			// Set the last category breadcrumb
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
				'href' => $this->url->link('information/category', 'path=' . $this->request->get['path'])
			);

			if ($category_info['image']) {
				$data['thumb'] = $this->model_tool_image->resize($category_info['image'], $this->config->get('config_image_category_width'), $this->config->get('config_image_category_height'));
			} else {
				$data['thumb'] = '';
			}

			$data['description'] = html_entity_decode($category_info['description'], ENT_QUOTES, 'UTF-8');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$data['categories'] = array();

			$results = $this->model_catalog_information_category->getCategories($category_id);

			foreach ($results as $result) {
        if ($this->model_setting_rights->getRight($result['category_id'], TYPE_INFORMATION_CATEGORY)) {
  				$filter_data = array(
  					'filter_category_id'  => $result['category_id'],
  					'filter_sub_category' => true
  				);
  
  				$data['categories'][] = array(
  					'name'  => $result['name'] . ($this->config->get('config_product_count') ? ' (' . $this->model_catalog_information->getTotalInformations($filter_data) . ')' : ''),
  					'href'  => $this->url->link('information/category', 'path=' . $this->request->get['path'] . '_' . $result['category_id'] . $url)
  				);
			  }
      }

			$data['informations'] = array();

			$filter_data = array(
				'filter_category_id' => $category_id,
				'sort'               => $sort,
				'order'              => $order,
				'start'              => ($page - 1) * $limit,
				'limit'              => $limit
			);

			$information_total = $this->model_catalog_information->getTotalInformations($filter_data);

			$results = $this->model_catalog_information->getInformations_2($filter_data);

			foreach ($results as $result) {
				if ($result['image']) {
					$image = $this->model_tool_image->resizeTo($result['image'], $this->config->get('config_image_item_list_width'), 0, 'maxwidth',$this->config->get('config_image_item_list_height'));
				} else {
					$image = null;// $this->model_tool_image->resizeTo('placeholder.png', $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'), 'maxwidth');
				}
        
        
        
       
  			
        $data['informations'][] = array(
  				'information_id'  => $result['information_id'],
  				'thumb'       => $image,
  				'name'        => $result['title'],
  				'description' => html_entity_decode($result['short_description'], ENT_QUOTES, 'UTF-8'),
                'date_added'  => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
                'date_modified' => date($this->language->get('date_format_short'), strtotime($result['date_modified'])),
  				'href'        => $this->url->link('information/information', 'path=' . $this->request->get['path'] . '&information_id=' . $result['information_id'] . $url)
  			);
        
			}

			$url = '';

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$data['sorts'] = array();

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_date_desc'),
				'value' => 'i.date_added-DESC',
				'href'  => $this->url->link('information/category', 'path=' . $this->request->get['path'] . '&sort=i.date_added&order=DESC' . $url)
			);
      
      $data['sorts'][] = array(
				'text'  => $this->language->get('text_date_asc'),
				'value' => 'i.date_added-ASC',
				'href'  => $this->url->link('information/category', 'path=' . $this->request->get['path'] . '&sort=i.date_added&order=ASC' . $url)
			);
      

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_name_asc'),
				'value' => 'id.title-ASC',
				'href'  => $this->url->link('information/category', 'path=' . $this->request->get['path'] . '&sort=id.title&order=ASC' . $url)
			);

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_name_desc'),
				'value' => 'id.title-DESC',
				'href'  => $this->url->link('information/category', 'path=' . $this->request->get['path'] . '&sort=id.title&order=DESC' . $url)
			);

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			$data['limits'] = array();

			$limits = array_unique(array($this->config->get('config_product_limit'), 25, 50, 75, 100));

			sort($limits);

			foreach($limits as $value) {
				$data['limits'][] = array(
					'text'  => $value,
					'value' => $value,
					'href'  => $this->url->link('information/category', 'path=' . $this->request->get['path'] . $url . '&limit=' . $value)
				);
			}

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$pagination = new Pagination();
			$pagination->total = $information_total;
			$pagination->page = $page;
			$pagination->limit = $limit;
			$pagination->url = $this->url->link('information/category', 'path=' . $this->request->get['path'] . $url . '&page={page}');

			$data['pagination'] = $pagination->render();

			$this->document->addLink($this->url->link('information/category', 'path=' . $this->request->get['path'] . $url . '&page=' . $pagination->page), 'canonical');

			if ($pagination->limit && ceil($pagination->total / $pagination->limit) > $pagination->page) {
				$this->document->addLink($this->url->link('information/category', 'path=' . $this->request->get['path'] . $url . '&page=' . ($pagination->page + 1)), 'next');
			}

			if ($pagination->page > 1) {
				$this->document->addLink($this->url->link('information/category', 'path=' . $this->request->get['path'] . $url . '&page=' . ($pagination->page - 1)), 'prev');
			}

			$data['results'] = sprintf($this->language->get('text_pagination'), ($information_total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($information_total - $limit)) ? $information_total : ((($page - 1) * $limit) + $limit), $information_total, ceil($information_total / $limit));

			$data['sort'] = $sort;
			$data['order'] = $order;
			$data['limit'] = $limit;

			$data['continue'] = $this->url->link('common/home');

			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/information/category.tpl')) {
				$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/information/category.tpl', $data));
			} else {
				$this->response->setOutput($this->load->view('default/template/information/category.tpl', $data));
			}
      
      } else {
      
  			$data['breadcrumbs'][] = array(
  				'text' => $this->language->get('text_not_right'),
  				'href' => $this->url->link('information/category', 'path=' . $this->request->get['path'])
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
			$url = '';

			if (isset($this->request->get['path'])) {
				$url .= '&path=' . $this->request->get['path'];
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
				'text' => $this->language->get('text_error'),
				'href' => $this->url->link('information/category', $url)
			);

			$this->document->setTitle($this->language->get('text_error'));

			$data['heading_title'] = $this->language->get('text_error');

			$data['text_error'] = $this->language->get('text_error');

			$data['button_continue'] = $this->language->get('button_continue');

			$data['continue'] = $this->url->link('common/home');

			$this->response->addHeader($this->request->server['SERVER_PROTOCOL'] . ' 404 Not Found');

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
}