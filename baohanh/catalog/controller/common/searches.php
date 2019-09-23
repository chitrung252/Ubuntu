<?php
class ControllerCommonSearches extends Controller {
	public function index() {
		$this->load->language('common/searches');
        $this->load->model('catalog/search');
	    $url = '';
	    $data['text_empty'] = $this->language->get('text_empty');
		$data['text_search'] = $this->language->get('text_search');
		if (isset($this->request->get['search'])) {
			$search = $this->request->get['search'];
		} else {
			$search = '';
		}
		if (isset($this->request->get['search'])) {
			$this->document->setTitle($this->language->get('heading_title') .  ' - ' . $this->request->get['search']);
		}  else {
			$this->document->setTitle($this->language->get('heading_title'));
		}
		if (isset($this->request->get['search'])) {
			$url .= '&search=' . urlencode(html_entity_decode($this->request->get['search'], ENT_QUOTES, 'UTF-8'));
		}
		$data['items'] = array();
		$results = $this->model_catalog_search->getSearch($search);
  			foreach ($results as $result) {
    			$data['items'][] = array(
    				'order_id'  => $result['order_id'],
    				'customer_name'        => $result['customer_name'],
					'address'        => $result['address'],
					'name_product'        => $result['name_product'],
					'quantity_order'        => $result['quantity_order'],
					'guarantee'        => $result['guarantee'],
					'imei'        => $result['imei'],
					'date_added'        => $result['date_added'],
					'website'        => $result['website'],
					'telephone'        => $result['telephone']
    			);
          
  			}
      
			$url = '';

			if (isset($this->request->get['search'])) {
				$url .= '&search=' . urlencode(html_entity_decode($this->request->get['search'], ENT_QUOTES, 'UTF-8'));
			}
		$data['search'] = $search;
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/searches.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/common/searches.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/common/searches.tpl', $data));
		}
	}
}