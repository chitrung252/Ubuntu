<?php
class ControllerCommonDashboard extends Controller {
	public function index() {
		$this->load->language('common/dashboard');
		$this->load->model('dashboard/dashboard');

		$this->document->setTitle($this->language->get('heading_title'));

		$data['heading_title'] = $this->language->get('heading_title');


		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => '<i class="fa fa-home admin"></i>' . $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);
		
		// Check install directory exists
		if (is_dir(dirname(DIR_APPLICATION) . '/install')) {
			$data['error_install'] = $this->language->get('error_install');
		} else {
			$data['error_install'] = '';
		}

		$data['token'] = $this->session->data['token'];
       $url = '';
	   // Related product
	   $data['products'] = array();
	   $results_product = $this->model_dashboard_dashboard->getProducts();
       $data['readmore_product'] = $this->url->link('catalog/product', 'token=' . $this->session->data['token'], 'SSL');
		foreach ($results_product as $result_product) {

			$data['products'][] = array(
				'product_id' => $result_product['product_id'],
				'name'       => $result_product['name'],
				'edit'       => $this->url->link('catalog/product/edit', 'token=' . $this->session->data['token'] . '&product_id=' . $result_product['product_id'] . $url, 'SSL')
			);
		}
	   // Related order
	    $data['readmore_order'] = $this->url->link('sale/order', 'token=' . $this->session->data['token'], 'SSL');
	    $data['orders'] = array();
		$results_order = $this->model_dashboard_dashboard->getOrders();
       
		foreach ($results_order as $result_order) {
             if ($result_order['total']) {
					$total =  $this->model_dashboard_dashboard->getSubtotal($result_order['order_id']);
				} else {
					$total = 0 ;
				}
			$data['orders'][] = array(
			    'order_id' => $result_order['order_id'],
				'product_id' => $result_order['product_id'],
				'customer_name'       => $result_order['customer_name'],
				'date_added'       => $result_order['date_added'],
				'subtotal'            => number_format($total),
				'quantity_order'   => $result_order['quantity_order'],
				'view'          => $this->url->link('sale/order/info', 'token=' . $this->session->data['token'] . '&order_id=' . $result_order['order_id'] . $url, 'SSL'),
				'print'          => $this->url->link('sale/order/invoice', 'token=' . $this->session->data['token'] . '&order_id=' . $result_order['order_id'] . $url, 'SSL'),
				'print_mini'          => $this->url->link('sale/order/invoice_mini', 'token=' . $this->session->data['token'] . '&order_id=' . $result_order['order_id'] . $url, 'SSL')
			);
		} 
		 // Tong doanh thu
		 $data['tongdoanhthu'] = $this->model_dashboard_dashboard->getTotalorderprice();
		 // Tong don hang
		 $data['tongdonhang'] = $this->model_dashboard_dashboard->getTotalorderproduct();
		 // Tong san pham mua
		 $data['tongsanphammua'] = $this->model_dashboard_dashboard->getTotalorderquantity();
		  // Tong san con lai
		 $data['sanphamconlai'] = $this->model_dashboard_dashboard->getTotalproduct();
		 // Tong khach hang
		 $data['tongkhachhang'] = $this->model_dashboard_dashboard->getTotalcustomer();
		// San pham mua nhieu
		$data['spmuanhieu'] = array();
		$results_spmuanhieu = $this->model_dashboard_dashboard->getSanphamuanhieu();
		foreach ($results_spmuanhieu as $result_spmuanhieu) {
			$data['spmuanhieu'][] = array(
			    'order_id' => $result_spmuanhieu['order_id'],
				'name_product' => $result_spmuanhieu['name_product']
				
			);
		} 
		 $data['readmore_productviewed'] = $this->url->link('report/productviewed', 'token=' . $this->session->data['token'], 'SSL');
		#load data
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('common/dashboard.tpl', $data));
	}
}
