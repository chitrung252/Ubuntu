<?php
class ControllerReportProductviewed extends Controller {
	public function index() {
		$this->load->language('report/productviewed');
		$this->document->setTitle($this->language->get('heading_title'));
		$url = '';
		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_list'] = $this->language->get('text_list');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => '<i class="fa fa-home admin"></i>' . $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('report/productviewed', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);
		
        #load product
		$data['productviewed'] = array();
		$filter_data = array(
			'start'                => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit'                => $this->config->get('config_limit_admin')
			
		); 
		$this->load->model('report/productviewed');
		$productviewed_total = $this->model_report_productviewed->getTotalproduct($filter_data);
	    $results = $this->model_report_productviewed->getProducts($filter_data);
         
		foreach ($results as $result) {
            if ($result['quantity_order']) {
					$quantity_order =  $this->model_report_productviewed->getTotalquantity($result['order_id']);
				} else {
					$quantity_order = 0 ;
				}
			$data['productviewed'][] = array(
				'name_product'       => $result['name_product'],
				'manufacturer'       => $result['manufacturer'],
				'quantity_order'            => $quantity_order
			);
		} 
        $pagination = new Pagination();
		$pagination->total = $productviewed_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('report/customer', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
		$data['pagination'] = $pagination->render();
		
        
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('report/productviewed_list.tpl', $data));
	}

	
}