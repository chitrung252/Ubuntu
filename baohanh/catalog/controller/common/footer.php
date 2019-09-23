<?php
class ControllerCommonFooter extends Controller {
	public function index() {
		$this->load->language('common/footer');
        
		$data['text_contact'] = $this->language->get('text_contact');
		$data['text_home'] = $this->language->get('text_home');
		$data['text_chinhsach'] = $this->language->get('text_chinhsach');
		$data['text_hitu'] = $this->language->get('text_hitu');
        $data['text_tvs'] = $this->language->get('text_tvs');
		$data['text_email'] = $this->language->get('text_email');
		$data['text_address'] = $this->language->get('text_address');
		$data['text_website'] = $this->language->get('text_website');
        $data['text_facebook'] = $this->language->get('text_facebook');
		$data['text_youtube'] = $this->language->get('text_youtube');
		$data['text_truycap'] = $this->language->get('text_truycap');
		$data['text_lienhe'] = $this->language->get('text_lienhe');
		$data['text_ketnoi'] = $this->language->get('text_ketnoi');
		$data['contact'] = $this->url->link('information/contact');
		

		$data['powered'] = sprintf($this->language->get('text_powered'), $this->config->get('config_name'), date('Y', time()));
        $data['address'] = $this->config->get('config_address');
		$data['email'] = $this->config->get('config_email');
		$data['website'] = $this->config->get('config_website');
        $data['facebook'] = $this->config->get('config_facebook');
		$data['telephone'] = $this->config->get('config_telephone');
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/footer.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/common/footer.tpl', $data);
		} else {
			return $this->load->view('default/template/common/footer.tpl', $data);
		}
	}
}