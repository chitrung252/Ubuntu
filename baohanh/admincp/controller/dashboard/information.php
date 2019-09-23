<?php
class ControllerDashboardInformation extends Controller {
	public function index() {
		$this->load->language('dashboard/information');

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_view'] = $this->language->get('text_view');

		$data['token'] = $this->session->data['token'];

		// Total informations
		$this->load->model('catalog/information');
		
		// Customers Online
		$online_total = $this->model_catalog_information->getTotalInformations();
		
		if ($online_total > 1000000000000) {
			$data['total'] = round($online_total / 1000000000000, 1) . 'T';
		} elseif ($online_total > 1000000000) {
			$data['total'] = round($online_total / 1000000000, 1) . 'B';
		} elseif ($online_total > 1000000) {
			$data['total'] = round($online_total / 1000000, 1) . 'M';
		} elseif ($online_total > 1000) {
			$data['total'] = round($online_total / 1000, 1) . 'K';						
		} else {
			$data['total'] = $online_total;
		}			
		
		$data['information_viewed'] = $this->url->link('report/information_viewed', 'token=' . $this->session->data['token'], 'SSL');

		return $this->load->view('dashboard/information.tpl', $data);
	}
}
