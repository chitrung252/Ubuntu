<?php
class ControllerToolFileManager extends Controller {
	private $error = array();

	public function index() {
  
		$this->load->language('tool/file_manager');

		$this->document->setTitle($this->language->get('heading_title'));

		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => '<i class="fa fa-home admin"></i>' . $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('tool/file_manager', 'token=' . $this->session->data['token'], 'SSL')
		);
    
    $data['frame'] = $this->url->link('tool/file_manager_frame', 'token=' . $this->session->data['token'], 'SSL');
    
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
    
		$this->response->setOutput($this->load->view('tool/file_manager.tpl', $data));
	}
  
}             