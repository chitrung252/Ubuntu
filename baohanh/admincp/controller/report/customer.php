<?php
class ControllerReportCustomer extends Controller {
	public function index() {
		$this->load->language('report/customer');
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

		$data['column_stt'] = $this->language->get('column_stt');
		$data['column_name'] = $this->language->get('column_name');
		$data['column_adress'] = $this->language->get('column_adress');
		$data['column_telephone'] = $this->language->get('column_telephone');
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => '<i class="fa fa-home admin"></i>' . $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('report/customer', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);
		
        #load khach hang
		$data['customers'] = array();
		$filter_data = array(
			'start'                => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit'                => $this->config->get('config_limit_admin')
			
		); 
		$this->load->model('report/customer');
		$customer_total = $this->model_report_customer->getTotalCustomer($filter_data);
	    $results = $this->model_report_customer->getCustomer($filter_data);
         
		foreach ($results as $result) {

			$data['customers'][] = array(
			    'order_id' => $result['order_id'],
				'customer_name'       => $result['customer_name'],
				'address'       => $result['address'],
				'telephone'       => $result['telephone']
			);
		} 
        $pagination = new Pagination();
		$pagination->total = $customer_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('report/customer', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
		$data['pagination'] = $pagination->render();
		
        
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('report/customer_list.tpl', $data));
	}

	
}