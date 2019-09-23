<?php
class ControllerCommonMenu extends Controller {
	public function index() {
		$this->load->language('common/menu');
    
		$data['text_menu'] = $this->language->get('text_menu');

		
		$data['text_product'] = $this->language->get('text_product');
		$data['text_guarantee'] = $this->language->get('text_guarantee');
		$data['text_product_list'] = $this->language->get('text_product_list');
		$data['text_website_by'] = $this->language->get('text_website_by');
		$data['text_order'] = $this->language->get('text_order');
		$data['text_menu_group'] = $this->language->get('text_menu_group');
		$data['text_main_menu'] = $this->language->get('text_main_menu');
		$data['text_all_menu'] = $this->language->get('text_all_menu');
		$data['text_api'] = $this->language->get('text_api');
		$data['text_backup'] = $this->language->get('text_backup');
		$data['text_banner'] = $this->language->get('text_banner');
		$data['text_catalog'] = $this->language->get('text_catalog');
		$data['text_manufacturer'] = $this->language->get('text_manufacturer');
		$data['text_category'] = $this->language->get('text_category');
		$data['text_report_product'] = $this->language->get('text_report_product');
		$data['text_report_sale'] = $this->language->get('text_report_sale');
		$data['text_report_warehouse'] = $this->language->get('text_report_warehouse');
		$data['text_filter_category'] = $this->language->get('text_filter_category');
		$data['text_confirm'] = $this->language->get('text_confirm');
		$data['text_sale'] = $this->language->get('text_sale');
		$data['text_order'] = $this->language->get('text_order');
		$data['text_print_order'] = $this->language->get('text_print_order');
		$data['text_preport_customer'] = $this->language->get('text_preport_customer');
		$data['text_preport_productviewed'] = $this->language->get('text_preport_productviewed');
		
		
		$data['text_contact'] = $this->language->get('text_contact');
		$data['text_country'] = $this->language->get('text_country');
		$data['text_customer'] = $this->language->get('text_customer');
		$data['text_customer_group'] = $this->language->get('text_customer_group');
		$data['text_customer_ban_ip'] = $this->language->get('text_customer_ban_ip');
		$data['text_design'] = $this->language->get('text_design');
		
		$data['text_error_log'] = $this->language->get('text_error_log');
		$data['text_extension'] = $this->language->get('text_extension');
		$data['text_feed'] = $this->language->get('text_feed');
		$data['text_dashboard'] = $this->language->get('text_dashboard');
		$data['text_help'] = $this->language->get('text_help');
		$data['text_information'] = $this->language->get('text_information');
		$data['text_installer'] = $this->language->get('text_installer');
		$data['text_language'] = $this->language->get('text_language');
		$data['text_layout'] = $this->language->get('text_layout');
		$data['text_localisation'] = $this->language->get('text_localisation');
		$data['text_modification'] = $this->language->get('text_modification');
		$data['text_module'] = $this->language->get('text_module');
		$data['text_reports'] = $this->language->get('text_reports');


		$data['text_report_viewed'] = $this->language->get('text_report_viewed');

        $data['text_report_downloaded'] = $this->language->get('text_report_downloaded');
		$data['text_report_customer_activity'] = $this->language->get('text_report_customer_activity');
		$data['text_report_customer_online'] = $this->language->get('text_report_customer_online');

		$data['text_setting'] = $this->language->get('text_setting');
		$data['text_system'] = $this->language->get('text_system');
		$data['text_tools'] = $this->language->get('text_tools');

		$data['text_total'] = $this->language->get('text_total');

		$data['text_tracking'] = $this->language->get('text_tracking');
		$data['text_user'] = $this->language->get('text_user');
		$data['text_user_group'] = $this->language->get('text_user_group');
		$data['text_users'] = $this->language->get('text_users');
        $data['text_admins'] = $this->language->get('text_admins');
    
		$data['text_review'] = $this->language->get('text_review');
		$data['text_file_manager'] = $this->language->get('text_file_manager');
		$data['text_scheduled_backup'] = $this->language->get('text_scheduled_backup');
    
        $data['home'] = $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL');

		$data['api'] = $this->url->link('user/api', 'token=' . $this->session->data['token'], 'SSL');
		$data['backup'] = $this->url->link('tool/backup', 'token=' . $this->session->data['token'], 'SSL');
		
		$data['category'] = $this->url->link('catalog/category', 'token=' . $this->session->data['token'], 'SSL');
		$data['guarantee'] = $this->url->link('catalog/guarantee', 'token=' . $this->session->data['token'], 'SSL');
		$data['manufacturer'] = $this->url->link('catalog/manufacturer', 'token=' . $this->session->data['token'], 'SSL');
		$data['filter_category'] = $this->url->link('catalog/information_filter_category', 'token=' . $this->session->data['token'], 'SSL');
		$data['product'] = $this->url->link('catalog/product', 'token=' . $this->session->data['token'], 'SSL');
		$data['report_customer'] = $this->url->link('report/customer', 'token=' . $this->session->data['token'], 'SSL');
		$data['report_sale'] = $this->url->link('report/sale_order', 'token=' . $this->session->data['token'], 'SSL');
		$data['report_productviewed'] = $this->url->link('report/productviewed', 'token=' . $this->session->data['token'], 'SSL');
		$data['report_warehouse'] = $this->url->link('report/warehouse', 'token=' . $this->session->data['token'], 'SSL');
		$data['country'] = $this->url->link('localisation/country', 'token=' . $this->session->data['token'], 'SSL');
		$data['contact'] = $this->url->link('marketing/contact', 'token=' . $this->session->data['token'], 'SSL');
		$data['customer'] = $this->url->link('sale/customer', 'token=' . $this->session->data['token'], 'SSL');
		$data['customer_group'] = $this->url->link('sale/customer_group', 'token=' . $this->session->data['token'], 'SSL');
		$data['customer_ban_ip'] = $this->url->link('sale/customer_ban_ip', 'token=' . $this->session->data['token'], 'SSL');
		$data['download'] = $this->url->link('catalog/download', 'token=' . $this->session->data['token'], 'SSL');
		$data['error_log'] = $this->url->link('tool/error_log', 'token=' . $this->session->data['token'], 'SSL');
		$data['feed'] = $this->url->link('extension/feed', 'token=' . $this->session->data['token'], 'SSL');
		$data['information'] = $this->url->link('catalog/information', 'token=' . $this->session->data['token'], 'SSL');
		$data['installer'] = $this->url->link('extension/installer', 'token=' . $this->session->data['token'], 'SSL');
		$data['language'] = $this->url->link('localisation/language', 'token=' . $this->session->data['token'], 'SSL');
		$data['layout'] = $this->url->link('design/layout', 'token=' . $this->session->data['token'], 'SSL');
		$data['order'] = $this->url->link('sale/order', 'token=' . $this->session->data['token'], 'SSL');
		$data['banhang'] = $this->url->link('sale/order/add', 'token=' . $this->session->data['token'], 'SSL');
		
		$data['modification'] = $this->url->link('extension/modification', 'token=' . $this->session->data['token'], 'SSL');
		$data['module'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
		
		$data['report_main'] = $this->url->link('report/report_main', 'token=' . $this->session->data['token'], 'SSL');
		$data['report_information_viewed'] = $this->url->link('report/information_viewed', 'token=' . $this->session->data['token'], 'SSL');
        $data['report_download_downloaded'] = $this->url->link('report/download_downloaded', 'token=' . $this->session->data['token'], 'SSL');
    
		$data['report_customer_activity'] = $this->url->link('report/customer_activity', 'token=' . $this->session->data['token'], 'SSL');
		$data['report_customer_online'] = $this->url->link('report/customer_online', 'token=' . $this->session->data['token'], 'SSL');
		$data['report_elearning_viewed'] = $this->url->link('report/elearning_viewed', 'token=' . $this->session->data['token'], 'SSL');
		
		$data['review'] = $this->url->link('catalog/review', 'token=' . $this->session->data['token'], 'SSL');
		$data['setting'] = $this->url->link('setting/store', 'token=' . $this->session->data['token'], 'SSL');
		$data['user'] = $this->url->link('user/user', 'token=' . $this->session->data['token'], 'SSL');
		$data['user_group'] = $this->url->link('user/user_permission', 'token=' . $this->session->data['token'], 'SSL');
    
    $data['menu'] = $this->url->link('catalog/menu', 'token=' . $this->session->data['token'], 'SSL');
    
    $data['main_menu'] = $this->url->link('catalog/menu', 'token=' . $this->session->data['token'] . '&group_id=0', 'SSL');
    $data['information_category'] = $this->url->link('catalog/information_category', 'token=' . $this->session->data['token'], 'SSL');
    $data['download_category'] = $this->url->link('catalog/download_category', 'token=' . $this->session->data['token'], 'SSL');
    $data['file_manager'] = $this->url->link('tool/file_manager', 'token=' . $this->session->data['token'], 'SSL');
    $data['scheduled_backup'] = $this->url->link('tool/scheduled_backup', 'token=' . $this->session->data['token'], 'SSL');
    
   

    $data['review_information'] = $this->url->link('catalog/review', 'token=' . $this->session->data['token'] , 'SSL');
		
		return $this->load->view('common/menu.tpl', $data);
	}
}