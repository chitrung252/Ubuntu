<?php
class ControllerCatalogGuarantee extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('catalog/guarantee');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/guarantee');

		$this->getList();
	}

	public function add() {
		$this->load->language('catalog/guarantee');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/guarantee');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_guarantee->addGuarantee($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

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

			$this->response->redirect($this->url->link('catalog/guarantee', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function edit() {
		$this->load->language('catalog/guarantee');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/guarantee');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_guarantee->editGuarantee($this->request->get['guarantee_id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

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

			$this->response->redirect($this->url->link('catalog/guarantee', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function delete() {
		$this->load->language('catalog/guarantee');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/guarantee');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $guarantee_id) {
				$this->model_catalog_guarantee->deleteGuarantee($guarantee_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

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

			$this->response->redirect($this->url->link('catalog/guarantee', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
	}


	protected function getList() {
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'name';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

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

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => '<i class="fa fa-home admin"></i>' . $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('catalog/guarantee', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		$data['add'] = $this->url->link('catalog/guarantee/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['delete'] = $this->url->link('catalog/guarantee/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
		

		$data['guarantees'] = array();

		$results = $this->model_catalog_guarantee->getGuarantees();

		foreach ($results as $result) {
			$data['guarantees'][] = array(
				'guarantee_id' => $result['guarantee_id'],
				'guarantee_name'        => $result['guarantee_name'],
				'edit'        => $this->url->link('catalog/guarantee/edit', 'token=' . $this->session->data['token'] . '&guarantee_id=' . $result['guarantee_id'] . $url, 'SSL'),
				'delete'      => $this->url->link('catalog/guarantee/delete', 'token=' . $this->session->data['token'] . '&guarantee_id=' . $result['guarantee_id'] . $url, 'SSL')
			);
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_list'] = $this->language->get('text_list');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');

		$data['column_name'] = $this->language->get('column_name');

		$data['column_action'] = $this->language->get('column_action');

		$data['button_add'] = $this->language->get('button_add');
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_delete'] = $this->language->get('button_delete');

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


		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('catalog/guarantee_list.tpl', $data));
	}

	protected function getForm() {
		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_form'] = !isset($this->request->get['guarantee_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
		$data['text_none'] = $this->language->get('text_none');
		$data['text_default'] = $this->language->get('text_default');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');

		$data['entry_guarantee_name'] = $this->language->get('entry_guarantee_name');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');


		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['guarantee_name'])) {
			$data['error_guarantee_name'] = $this->error['guarantee_name'];
		} else {
			$data['error_guarantee_name'] = array();
		}


		$url = '';


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
			'href' => $this->url->link('catalog/guarantee', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		if (!isset($this->request->get['guarantee_id'])) {
			$data['action'] = $this->url->link('catalog/guarantee/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$data['action'] = $this->url->link('catalog/guarantee/edit', 'token=' . $this->session->data['token'] . '&guarantee_id=' . $this->request->get['guarantee_id'] . $url, 'SSL');
		}

		$data['cancel'] = $this->url->link('catalog/guarantee', 'token=' . $this->session->data['token'] . $url, 'SSL');

		if (isset($this->request->get['guarantee_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$guarantee_info = $this->model_catalog_guarantee->getGuarantee($this->request->get['guarantee_id']);
		}

		$data['token'] = $this->session->data['token'];
		
        if (isset($this->request->post['guarantee_name'])) {
			$data['guarantee_name'] = $this->request->post['guarantee_name'];
		} elseif (!empty($guarantee_info)) {
			$data['guarantee_name'] = $guarantee_info['guarantee_name'];
		} else {
			$data['guarantee_name'] = '';
		}

		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($guarantee_info)) {
			$data['status'] = $guarantee_info['status'];
		} else {
			$data['status'] = true;
		}


		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('catalog/guarantee_form.tpl', $data));
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'catalog/guarantee')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ((utf8_strlen($this->request->post['guarantee_name']) < 3) || (utf8_strlen($this->request->post['guarantee_name']) > 64)) {
			$this->error['guarantee_name'] = $this->language->get('error_guarantee_name');
		}

		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'catalog/guarantee')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}

	protected function validateRepair() {
		if (!$this->user->hasPermission('modify', 'catalog/guarantee')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}

	
}