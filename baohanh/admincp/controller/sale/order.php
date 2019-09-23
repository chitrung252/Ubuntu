<?php
class ControllerSaleOrder extends Controller {
	private $error = array();
    
	public function index() {
		$this->load->language('sale/order');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('sale/order');

		$this->getList();
		
	}

	public function add() {
		$this->load->language('sale/order');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('sale/order');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_sale_order->addOrder($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';
            if (isset($this->request->get['filter_order_id'])) {
			$url .= '&filter_order_id=' . urlencode(html_entity_decode($this->request->get['filter_order_id'], ENT_QUOTES, 'UTF-8'));
		    }
			if (isset($this->request->get['filter_customer'])) {
				$url .= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
			}
			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
		
			$this->response->redirect($this->url->link('sale/order', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function edit() {
		$this->load->language('sale/order');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('sale/order');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_sale_order->editOrder($this->request->get['order_id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';
			
            if (isset($this->request->get['filter_order_id'])) {
			$url .= '&filter_order_id=' . urlencode(html_entity_decode($this->request->get['filter_order_id'], ENT_QUOTES, 'UTF-8'));
		    }
			if (isset($this->request->get['filter_customer'])) {
				$url .= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
			}
			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
			
			$this->response->redirect($this->url->link('sale/order', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function delete() {
		$this->load->language('sale/order');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('sale/order');
       
		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $order_id) {
				$this->model_sale_order->deleteOrder($order_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';
			
            if (isset($this->request->get['filter_order_id'])) {
			$url .= '&filter_order_id=' . urlencode(html_entity_decode($this->request->get['filter_order_id'], ENT_QUOTES, 'UTF-8'));
		    }
			if (isset($this->request->get['filter_customer'])) {
				$url .= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
			}
			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('sale/order', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}
		
		

		$this->getList();
	}

	

	protected function getList() {
		
		 if (isset($this->request->get['filter_order_id'])) {
			$filter_order_id = $this->request->get['filter_order_id'];
		} else {
			$filter_order_id = null;
		}
		 if (isset($this->request->get['filter_customer'])) {
			$filter_customer = $this->request->get['filter_customer'];
		} else {
			$filter_customer = null;
		}
        if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
		$url = '';
		
        if (isset($this->request->get['filter_order_id'])) {
			$url .= '&filter_order_id=' . urlencode(html_entity_decode($this->request->get['filter_order_id'], ENT_QUOTES, 'UTF-8'));
		}
		if (isset($this->request->get['filter_customer'])) {
			$url .= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
		}
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => '<i class="fa fa-home admin"></i>' . $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('sale/order', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		$data['add'] = $this->url->link('sale/order/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['delete'] = $this->url->link('sale/order/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
        
		$data['orders'] = array();

		$filter_data = array(
			'filter_order_id'      => $filter_order_id,
			'filter_customer'	   => $filter_customer,
			'start'                => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit'                => $this->config->get('config_limit_admin')
			
		); 

		
		$order_total = $this->model_sale_order->getTotalOrders($filter_data);

		$results = $this->model_sale_order->getOrders($filter_data);

		foreach ($results as $result) {
			
             if ($result['total']) {
					$total =  $this->model_sale_order->getSubtotal($result['order_id']);
				} else {
					$total = 0 ;
				}
				
			$data['orders'][] = array(
			    'order_id' => $result['order_id'],
				'product_id' => $result['product_id'],
				'date_added' => $result['date_added'],
				'customer_name'       => $result['customer_name'],
				'name_product'       => $result['name_product'],
				'subtotal'            => number_format($total),
				'total'      => number_format($result['total']) ,
				'quantity_order'   => $result['quantity_order'],
				'status'     => ($result['status']) ? $this->language->get('text_enabled') : $this->language->get('text_disabled'),
				'edit'       => $this->url->link('sale/order/edit', 'token=' . $this->session->data['token'] . '&order_id=' . $result['order_id'] . $url, 'SSL'),
				'view'          => $this->url->link('sale/order/info', 'token=' . $this->session->data['token'] . '&order_id=' . $result['order_id'] . $url, 'SSL'),
				'print'          => $this->url->link('sale/order/invoice', 'token=' . $this->session->data['token'] . '&order_id=' . $result['order_id'] . $url, 'SSL'),
				'print_mini'          => $this->url->link('sale/order/invoice_mini', 'token=' . $this->session->data['token'] . '&order_id=' . $result['order_id'] . $url, 'SSL')
			);
		} 
        ## load sum total 
	
		
	
		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_list'] = $this->language->get('text_list');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');

		$data['column_order_id'] = $this->language->get('column_order_id');
		$data['column_date_added'] = $this->language->get('column_date_added');
		$data['column_customer'] = $this->language->get('column_customer');
		$data['column_total'] = $this->language->get('column_total');
		$data['column_product'] = $this->language->get('column_product');
		$data['column_model'] = $this->language->get('column_model');
		$data['column_price'] = $this->language->get('column_price');
		$data['column_quantity'] = $this->language->get('column_quantity');
		$data['column_status'] = $this->language->get('column_status');
		$data['column_action'] = $this->language->get('column_action');

		$data['entry_customer'] = $this->language->get('entry_customer');
		$data['entry_order_id'] = $this->language->get('entry_order_id');
		$data['entry_price'] = $this->language->get('entry_price');
		$data['entry_quantity'] = $this->language->get('entry_quantity');
		$data['entry_status'] = $this->language->get('entry_status');

		$data['button_add'] = $this->language->get('button_add');
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_delete'] = $this->language->get('button_delete');
		$data['button_filter'] = $this->language->get('button_filter');
		$data['button_invoice_print'] = $this->language->get('button_invoice_print');

		$data['token'] = $this->session->data['token'];

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		if (isset($this->request->post['selected'])) {
			$data['selected'] = (array)$this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}
		$url = '';
		if (isset($this->request->get['filter_order_id'])) {
			$url .= '&filter_order_id=' . $this->request->get['filter_order_id'];
		}

		if (isset($this->request->get['filter_customer'])) {
			$url .= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
		}

		
		$pagination = new Pagination();
		$pagination->total = $order_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('sale/order', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
		$data['pagination'] = $pagination->render();
		
		$data['filter_order_id'] = $filter_order_id;
		$data['filter_customer'] = $filter_customer;
		
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('sale/order_list.tpl', $data));
	}

	protected function getForm() {
		$data['heading_title'] = $this->language->get('heading_title');
        if ($this->request->server['HTTPS']) {
			$data['base'] = HTTPS_SERVER;
		} else {
			$data['base'] = HTTP_SERVER;
		}
		$data['text_form'] = !isset($this->request->get['product_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_none'] = $this->language->get('text_none');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		$data['text_default'] = $this->language->get('text_default');
		$data['text_select'] = $this->language->get('text_select');
		$data['entry_customer'] = $this->language->get('entry_customer');
		$data['entry_manufacture'] = $this->language->get('entry_manufacture');
		$data['entry_telephone'] = $this->language->get('entry_telephone');
		$data['entry_address'] = $this->language->get('entry_address');
		$data['entry_add_product'] = $this->language->get('entry_add_product');
		$data['entry_website'] = $this->language->get('entry_website');
		$data['entry_model'] = $this->language->get('entry_model');
		$data['entry_quantity_order'] = $this->language->get('entry_quantity_order');
		$data['entry_quantity'] = $this->language->get('entry_quantity');
		$data['entry_price'] = $this->language->get('entry_price');
		$data['entry_date_added'] = $this->language->get('entry_date_added');
		$data['entry_store'] = $this->language->get('entry_store');
		$data['entry_product'] = $this->language->get('entry_product');
		$data['entry_imei'] = $this->language->get('entry_imei');
		$data['entry_guarantee_date'] = $this->language->get('entry_guarantee_date');
		$data['entry_guarantee'] = $this->language->get('entry_guarantee');
		$data['entry_total'] = $this->language->get('entry_total');
		
		$data['entry_required'] = $this->language->get('entry_required');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_layout'] = $this->language->get('entry_layout');
		$data['help_product'] = $this->language->get('help_product');
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_add_product'] = $this->language->get('button_add_product');
		
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['customer_name'])) {
			$data['error_customer_name'] = $this->error['customer_name'];
		} else {
			$data['error_customer_name'] = array();
		}

		$url = '';
		
        if (isset($this->request->get['filter_order_id'])) {
			$url .= '&filter_order_id=' . $this->request->get['filter_order_id'];
		}

		if (isset($this->request->get['filter_customer'])) {
			$url .= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
		}
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => '<i class="fa fa-home admin"></i>' . $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('sale/order', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		if (!isset($this->request->get['order_id'])) {
			$data['action'] = $this->url->link('sale/order/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$data['action'] = $this->url->link('sale/order/edit', 'token=' . $this->session->data['token'] . '&order_id=' . $this->request->get['order_id'] . $url, 'SSL');
		}

		$data['cancel'] = $this->url->link('sale/order', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['addcustomer'] = $this->url->link('sale/customer/add', 'token=' . $this->session->data['token'] . $url, 'SSL');

		if (isset($this->request->get['order_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$order_info = $this->model_sale_order->getOrder($this->request->get['order_id']);
		}

		$data['token'] = $this->session->data['token'];
		
        if (isset($this->request->get['order_id'])) {
			$data['order_id'] = $this->request->get['order_id'];
		} else {
			$data['order_id'] = 0;
		}
		 if (isset($this->request->post['customer_name'])) {
			$data['customer_name'] = $this->request->post['customer_name'];
		} elseif (!empty($order_info)) {
			$data['customer_name'] = $order_info['customer_name'];
		} else {
			$data['customer_name'] = '';
		}
		 if (isset($this->request->post['address'])) {
			$data['address'] = $this->request->post['address'];
		} elseif (!empty($order_info)) {
			$data['address'] = $order_info['address'];
		} else {
			$data['address'] = '';
		}
		 if (isset($this->request->post['telephone'])) {
			$data['telephone'] = $this->request->post['telephone'];
		} elseif (!empty($order_info)) {
			$data['telephone'] = $order_info['telephone'];
		} else {
			$data['telephone'] = '';
		}
	
		 if (isset($this->request->post['imei'])) {
			$data['imei'] = $this->request->post['imei'];
		} elseif (!empty($order_info)) {
			$data['imei'] = $order_info['imei'];
		} else {
			$data['imei'] = '';
		}
		 if (isset($this->request->post['codecolor'])) {
			$data['codecolor'] = $this->request->post['codecolor'];
		} elseif (!empty($order_info)) {
			$data['codecolor'] = $order_info['codecolor'];
		} else {
			$data['codecolor'] = 0;
		}
		 if (isset($this->request->post['date_added'])) {
			$data['date_added'] = $this->request->post['date_added'];
		} elseif (!empty($order_info)) {
			$data['date_added'] = $order_info['date_added'];
		} else {
			$data['date_added'] = date('d/m/Y');
		}

	
		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($order_info)) {
			$data['status'] = $order_info['status'];
		} else {
			$data['status'] = true;
		}

		#load product
		

		if (isset($this->request->post['product_order'])) {
			$products = $this->request->post['product_order'];
		} elseif (isset($this->request->get['order_id'])) {
			$products = $this->model_sale_order->getOrderProducts($this->request->get['order_id']);
		} else {
			$products = array();
		}
		
		$data['product_orders'] = array();

		foreach ($products as $product_id) {
				$data['product_orders'][] = array(
					'product_id' => $product_id['product_id'],
					'name_product' => $product_id['name_product'],
					'imei' => $product_id['imei'],
					'codecolor' => $product_id['codecolor'],
					'price' => $product_id['price'],
					'quantity_order' => $product_id['quantity_order'],
					'total' => $product_id['total'],
					'website' => $product_id['website'],
					'image' => $product_id['image'],
					'price' => $product_id['price'],
					'manufacturer' => $product_id['manufacturer'],
					'guarantee' => $product_id['guarantee']
					
				);
			
		} 
       		
	
		## load data autocomplete

	  $data['products'] = array();
	  $results = $this->model_sale_order->getProducts();

		foreach ($results as $result) {

			$data['products'][] = array(
				'product_id' => $result['product_id'],
				'name'       => $result['name'],
				'model'      => $result['model'],
				'price'      => $result['price'],
				'quantity'   => $result['quantity'],
				'manufacturer_name'      => $result['manufacturer_name'],
				'website'    => $result['website'],
				'image'      => $result['image'],
				'guarantee_name'      => $result['guarantee_name'],
				'image'      => $result['image']
			);
		}
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('sale/order_form.tpl', $data));
	}
    public function info() {
		$url = '';
		$this->load->language('sale/order');
		$this->load->model('sale/order');

		$this->document->setTitle($this->language->get('heading_title'));
		$data['heading_title'] = $this->language->get('heading_title');
		$data['button_invoice_print'] = $this->language->get('button_invoice_print');
		$data['button_shipping_print'] = $this->language->get('button_shipping_print');
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_cancel'] = $this->language->get('button_cancel');
		
		$data['breadcrumbs'] = array();

			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_home'),
				'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
			);

			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('sale/order', 'token=' . $this->session->data['token'] . $url, 'SSL')
			);
		$data['edit'] = $this->url->link('sale/order/edit', 'token=' . $this->session->data['token'] . '&order_id=' . (int)$this->request->get['order_id'], 'SSL');
		$data['cancel'] = $this->url->link('sale/order', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['invoice'] = $this->url->link('sale/order/invoice', 'token=' . $this->session->data['token'] . '&order_id=' . (int)$this->request->get['order_id'], 'SSL');
		$data['order_id'] = $this->request->get['order_id'];
		
		$data['products'] = array();

		$products = $this->model_sale_order->getOrderInfor($this->request->get['order_id']);
		
		foreach ($products as $product) {
			
			$data['products'][] = array(
			        'order_id'       => $product['order_id'],
					'imei'          => $product['imei'],
					'name_product'          => $product['name_product'],
					'guarantee'       => $product['guarantee'],
					'quantity_order'  => $product['quantity_order'],
					'website'  => $product['website'],
					'total'      => number_format($product['total']),
					
				);
			
		}
		#load infor customer
		$data['infor_customers'] = array();

		$inforcustomers = $this->model_sale_order->getOrderInfor_1($this->request->get['order_id']);
		
		foreach ($inforcustomers as $infor_customer) {
			
			$data['infor_customers'][] = array(
			       'order_id'       => $infor_customer['order_id'],
					'customer_name' => $infor_customer['customer_name'],
					'website' => $infor_customer['website'],
					'address'       => $infor_customer['address'],
					'telephone'     => $infor_customer['telephone'],
					'date_added'  => $infor_customer['date_added']
				);
			
		}
		
		if(isset($this->request->get['order_id'])) {
			$data['subtota'] = $this->model_sale_order->getSubtotal($this->request->get['order_id']);
		}
		else{
			$data['subtota'] ='';
		}
		
		$data['tongtien'] = number_format($data['subtota']);
		
	    $data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
	    $data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('sale/order_info.tpl', $data));
	}
	
	public function invoice() {
		$this->load->language('sale/order');
        $this->load->model('sale/order');
		$data['title'] = $this->language->get('text_shipping');
		

		if ($this->request->server['HTTPS']) {
			$data['base'] = HTTPS_SERVER;
		} else {
			$data['base'] = HTTP_SERVER;
		}

		$data['direction'] = $this->language->get('direction');
		$data['text_invoice'] = $this->language->get('text_invoice');
		$data['text_invoice_select'] = $this->language->get('text_invoice_select');
		$data['text_shipping'] = $this->language->get('text_shipping');
		$data['order_id'] = $this->request->get['order_id'];
		$data['products'] = array();
        $products = $this->model_sale_order->getOrderInfor($this->request->get['order_id']);

		foreach ($products as $product) {
			
			$data['products'][] = array(
			        'order_id'       => $product['order_id'],
					'imei'          => $product['imei'],
					'name_product'          => $product['name_product'],
					'guarantee'       => $product['guarantee'],
					'quantity_order'  => $product['quantity_order'],
					'website'  => $product['website'],
					'total'      => number_format($product['total']),
					
				);
			
		}
		#load infor customer
		$data['infor_customers'] = array();

		$inforcustomers = $this->model_sale_order->getOrderInfor_1($this->request->get['order_id']);
		
		foreach ($inforcustomers as $infor_customer) {
			
			$data['infor_customers'][] = array(
			       'order_id'       => $infor_customer['order_id'],
					'customer_name' => $infor_customer['customer_name'],
					'website' => $infor_customer['website'],
					'address'       => $infor_customer['address'],
					'telephone'     => $infor_customer['telephone'],
					'date_added'  => $infor_customer['date_added'],
					'manufacturer'     => $infor_customer['manufacturer'],
					'image'  => $infor_customer['image']
				);
			
		}
		
		if(isset($this->request->get['order_id'])) {
			$data['subtota'] = $this->model_sale_order->getSubtotal($this->request->get['order_id']);
		}
		else{
			$data['subtota'] ='';
		}
		
		$data['tongtien'] = number_format($data['subtota']);
		
  
		
		
		$this->response->setOutput($this->load->view('sale/order_invoice.tpl', $data));
	}
	
	public function invoice_mini() {
		$this->load->language('sale/order');
        $this->load->model('sale/order');
		$data['title'] = $this->language->get('text_shipping');
		

		if ($this->request->server['HTTPS']) {
			$data['base'] = HTTPS_SERVER;
		} else {
			$data['base'] = HTTP_SERVER;
		}

		$data['direction'] = $this->language->get('direction');
		$data['text_invoice'] = $this->language->get('text_invoice');
		$data['text_invoice_select'] = $this->language->get('text_invoice_select');
		$data['text_shipping'] = $this->language->get('text_shipping');
		$data['order_id'] = $this->request->get['order_id'];
		$data['products'] = array();
        $products = $this->model_sale_order->getOrderInfor($this->request->get['order_id']);

		foreach ($products as $product) {
			
			$data['products'][] = array(
			        'order_id'       => $product['order_id'],
					'imei'          => $product['imei'],
					'name_product'          => $product['name_product'],
					'guarantee'       => $product['guarantee'],
					'quantity_order'  => $product['quantity_order'],
					'website'  => $product['website'],
					'total'      => number_format($product['total']),
					
				);
			
		}
		#load infor customer
		$data['infor_customers'] = array();

		$inforcustomers = $this->model_sale_order->getOrderInfor_1($this->request->get['order_id']);
		
		foreach ($inforcustomers as $infor_customer) {
			
			$data['infor_customers'][] = array(
			       'order_id'       => $infor_customer['order_id'],
					'customer_name' => $infor_customer['customer_name'],
					'address'       => $infor_customer['address'],
					'telephone'     => $infor_customer['telephone'],
					'date_added'  => $infor_customer['date_added'],
					'manufacturer'     => $infor_customer['manufacturer'],
					'image'  => $infor_customer['image']
				);
			
		}
		
		if(isset($this->request->get['order_id'])) {
			$data['subtota'] = $this->model_sale_order->getSubtotal($this->request->get['order_id']);
		}
		else{
			$data['subtota'] ='';
		}
		
		$data['tongtien'] = number_format($data['subtota']);

		$this->response->setOutput($this->load->view('sale/order_invoice_mini.tpl', $data));
	}
	
	
	
	
	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'sale/order')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
        if ((utf8_strlen($this->request->post['customer_name']) < 2) || (utf8_strlen($this->request->post['customer_name']) > 250)) {
			$this->error['customer_name'] = $this->language->get('error_customer_name');
		}
	

		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}

		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'sale/order')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}

}