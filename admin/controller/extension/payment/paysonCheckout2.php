<?php

class ControllerExtensionPaymentPaysonCheckout2 extends Controller {

    private $error = array();
    //private $data = array();

    public function index() {
        //Load the language file for this module
        $this->load->language('extension/payment/paysonCheckout2');

        //Set the title from the language file $_['heading_title'] string
        $this->document->setTitle($this->language->get('heading_title'));

        //Load the settings model. You can also add any other models you want to load here.
        $this->load->model('setting/setting');
        
        //create the table payson_order in the database
        //$this->load->model('module/paysonCheckout2');
        //$this->model_module_paysonCheckout2->createModuleTables();

        //Save the settings if the user has submitted the admin form (ie if someone has pressed save).		
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->model_setting_setting->editSetting('paysonCheckout2', $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=payment', true));
        }

        $data['heading_title'] = $this->language->get('heading_title');
        $data['text_modul_name'] = $this->language->get('text_modul_name');
        $data['text_modul_version'] = $this->language->get('text_modul_version');
        //$data['modul_version'] = $this->language->get('text_modul_version');

        $data['text_edit'] = $this->language->get('text_edit');
        $data['merchant_id'] = $this->language->get('merchant_id');
        $data['api_key'] = $this->language->get('api_key');

        $data['secure_word'] = $this->language->get('secure_word');
        $data['entry_logg'] = $this->language->get('entry_logg');

        $data['entry_method_mode'] = $this->language->get('entry_method_mode');
        $data['paysonCheckout2_mode'] = $this->language->get('payment_mode');
        $data['text_method_mode_live'] = $this->language->get('text_method_mode_live');
        $data['text_method_mode_sandbox'] = $this->language->get('text_method_mode_sandbox');

        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        $data['text_all_zones'] = $this->language->get('text_all_zones');

        $data['entry_order_status'] = $this->language->get('entry_order_status'); 
        
        $data['entry_status'] = $this->language->get('entry_status');
        
        $data['entry_total'] = $this->language->get('entry_total');
        $data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
        
        $data['entry_order_item_details_to_ignore'] = $this->language->get('entry_order_item_details_to_ignore');
        $data['entry_sort_order'] = $this->language->get('entry_sort_order');
        $data['entry_totals_to_ignore'] = $this->language->get('entry_totals_to_ignore');
        
        $data['entry_color_scheme'] = $this->language->get('entry_color_scheme');
        $data['text_color_scheme_blue'] = $this->language->get('text_color_scheme_blue');
        $data['text_color_scheme_gray'] = $this->language->get('text_color_scheme_gray');
        $data['text_color_scheme_white'] = $this->language->get('text_color_scheme_white');
        $data['text_color_scheme_graysemi'] = $this->language->get('text_color_scheme_graysemi');
        $data['text_color_scheme_pitchblack'] = $this->language->get('text_color_scheme_pitchblack');
        $data['text_color_scheme_bright'] = $this->language->get('text_color_scheme_bright');
           
        $data['entry_verification'] = $this->language->get('entry_verification');
        $data['text_verification_bankid'] = $this->language->get('text_verification_bankid');
        $data['text_verification_none'] = $this->language->get('text_verification_none');
          
        $data['entry_phone'] = $this->language->get('entry_phone');
        $data['text_phone_yes'] = $this->language->get('text_phone_yes');
        $data['text_phone_no'] = $this->language->get('text_phone_no');
        
        $data['entry_iframe_size_width'] = $this->language->get('entry_iframe_size_width');
        $data['entry_iframe_size_width_type'] = $this->language->get('entry_iframe_size_width_type');
        $data['text_iframe_size_width_percent'] = $this->language->get('text_iframe_size_width_percent');
        $data['text_iframe_size_width_px'] = $this->language->get('text_iframe_size_width_px');
        
        $data['entry_iframe_size_height'] = $this->language->get('entry_iframe_size_height');  
        $data['entry_iframe_size_height_type'] = $this->language->get('entry_iframe_size_height_type');
        $data['text_iframe_size_height_percent'] = $this->language->get('text_iframe_size_height_percent');
        $data['text_iframe_size_height_px'] = $this->language->get('text_iframe_size_height_px');  

        $data['entry_show_receipt_page'] = $this->language->get('entry_show_receipt_page');
        $data['entry_show_receipt_page_yes'] = $this->language->get('entry_show_receipt_page_yes');
        $data['entry_show_receipt_page_no'] = $this->language->get('entry_show_receipt_page_no');
        
        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');

        $data['help_merchant_id'] = $this->language->get('help_merchant_id');
        $data['help_api_key'] = $this->language->get('help_api_key');
        $data['help_secure_word'] = $this->language->get('help_secure_word');
        $data['help_logg'] = $this->language->get('help_logg');
        $data['help_total'] = $this->language->get('help_total');
        $data['help_verification'] = $this->language->get('help_verification');
        $data['help_request_phone'] = $this->language->get('help_request_phone');
        $data['help_color_scheme'] = $this->language->get('help_color_scheme');
        $data['help_iframe_size_height'] = $this->language->get('help_iframe_size_height');
        $data['help_iframe_size_width'] = $this->language->get('help_iframe_size_width');
        $data['help_iframe_size_height_type'] = $this->language->get('help_iframe_size_height_type');
        $data['help_iframe_size_width_type'] = $this->language->get('help_iframe_size_width_type'); 
	$data['help_receipt'] = $this->language->get('help_receipt');		
        $data['help_totals_to_ignore'] = $this->language->get('help_totals_to_ignore');
        $data['help_method_mode'] = $this->language->get('help_method_mode');

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->error['merchant_id'])) {
            $data['error_merchant_id'] = $this->error['merchant_id'];
        } else {
            $data['error_merchant_id'] = '';
        }

        if (isset($this->error['api_key'])) {
            $data['error_api_key'] = $this->error['api_key'];
        } else {
            $data['error_api_key'] = '';
        }

        if (isset($this->error['ignored_order_totals'])) {
            $data['error_ignored_order_totals'] = $this->error['ignored_order_totals'];
        } else {
            $data['error_ignored_order_totals'] = '';
        }

        $data['error_invoiceFeeError'] = (isset($this->error['invoiceFeeError']) ? $this->error['invoiceFeeError'] : '');


        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true),
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_payment'),
            'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=payment', true),
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('extension/payment/paysonCheckout2', 'token=' . $this->session->data['token'], true),
        );

        $data['action'] = $this->url->link('extension/payment/paysonCheckout2', 'token=' . $this->session->data['token'], true);

        $data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token']. '&type=payment', true);


        if (isset($this->request->post['paysonCheckout2_modul_version'])) {
            $data['paysonCheckout2_modul_version'] = $this->request->post['paysonCheckout2_modul_version'];
        } else {
            $data['paysonCheckout2_modul_version'] = $this->config->get('paysonCheckout2_modul_version');
        }

        if (isset($this->request->post['paysonCheckout2_merchant_id'])) {
            $data['paysonCheckout2_merchant_id'] = $this->request->post['paysonCheckout2_merchant_id'];
        } else {
            $data['paysonCheckout2_merchant_id'] = $this->config->get('paysonCheckout2_merchant_id');
        }
        if (isset($this->request->post['paysonCheckout2_api_key'])) {
            $data['paysonCheckout2_api_key'] = $this->request->post['paysonCheckout2_api_key'];
        } else {
            $data['paysonCheckout2_api_key'] = $this->config->get('paysonCheckout2_api_key');
        }

        if (isset($this->request->post['paysonCheckout2_mode'])) {
            $data['paysonCheckout2_mode'] = $this->request->post['paysonCheckout2_mode'];
        } else {
            $data['paysonCheckout2_mode'] = $this->config->get('paysonCheckout2_mode');
        }

        if (isset($this->request->post['paysonCheckout2_secure_word'])) {
            $data['paysonCheckout2_secure_word'] = $this->request->post['paysonCheckout2_secure_word'];
        } else {
            $data['paysonCheckout2_secure_word'] = $this->config->get('paysonCheckout2_secure_word');
        }

        if (isset($this->request->post['paysonCheckout2_logg'])) {
            $data['paysonCheckout2_logg'] = $this->request->post['paysonCheckout2_logg'];
        } else {
            $data['paysonCheckout2_logg'] = $this->config->get('paysonCheckout2_logg');
        }

        if (isset($this->request->post['paysonCheckout2_total'])) {
            $data['paysonCheckout2_total'] = $this->request->post['paysonCheckout2_total'];
        } else {
            $data['paysonCheckout2_total'] = $this->config->get('paysonCheckout2_total');
        }

        if (isset($this->request->post['paysonCheckout2_order_status_id'])) {
            $data['paysonCheckout2_order_status_id'] = $this->request->post['paysonCheckout2_order_status_id'];
        } else {
            $data['paysonCheckout2_order_status_id'] = $this->config->get('paysonCheckout2_order_status_id');
        }

        $this->load->model('localisation/order_status');
        
        

        $data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

        if (isset($this->request->post['paysonCheckout2_geo_zone_id'])) {
            $data['paysonCheckout2_geo_zone_id'] = $this->request->post['paysonCheckout2_geo_zone_id'];
        } else {
            $data['paysonCheckout2_geo_zone_id'] = $this->config->get('paysonCheckout2_geo_zone_id');
        }

        $this->load->model('localisation/geo_zone');

        $data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();

        if (isset($this->request->post['paysonCheckout2_status'])) {
            $data['paysonCheckout2_status'] = $this->request->post['paysonCheckout2_status'];
        } else {
            $data['paysonCheckout2_status'] = $this->config->get('paysonCheckout2_status');
        }

        if (isset($this->request->post['paysonCheckout2_sort_order'])) {
            $data['paysonCheckout2_sort_order'] = $this->request->post['paysonCheckout2_sort_order'];
        } else {
            $data['paysonCheckout2_sort_order'] = $this->config->get('paysonCheckout2_sort_order');
        }  
                
        if (isset($this->request->post['paysonCheckout2_gui_verification'])) {
            $data['paysonCheckout2_gui_verification'] = $this->request->post['paysonCheckout2_gui_verification'];
        } else {
            $data['paysonCheckout2_gui_verification'] = $this->config->get('PaysonCheckout2_gui_verification');
        }

        if (isset($this->request->post['paysonCheckout2_request_phone'])) {
            $data['paysonCheckout2_request_phone'] = $this->request->post['paysonCheckout2_request_phone'];
        } else {
            $data['paysonCheckout2_request_phone'] = $this->config->get('paysonCheckout2_request_phone');
        }
        
        if (isset($this->request->post['paysonCheckout2_color_scheme'])) {
            $data['paysonCheckout2_color_scheme'] = $this->request->post['paysonCheckout2_color_scheme'];
        } else {
            $data['paysonCheckout2_color_scheme'] = $this->config->get('paysonCheckout2_color_scheme');
        }
        
        if (isset($this->request->post['paysonCheckout2_iframe_size_width'])) {
            $data['paysonCheckout2_iframe_size_width'] = $this->request->post['paysonCheckout2_iframe_size_width'];
        } else {
            if($this->config->get('paysonCheckout2_iframe_size_width') == Null){
                $data['paysonCheckout2_iframe_size_width'] = '100';
            }else{
                $data['paysonCheckout2_iframe_size_width'] = $this->config->get('paysonCheckout2_iframe_size_width');
            }
        }
        
        if (isset($this->request->post['paysonCheckout2_iframe_size_width_type'])) {
            $data['paysonCheckout2_iframe_size_width_type'] = $this->request->post['paysonCheckout2_iframe_size_width_type'];
        } else {
            $data['paysonCheckout2_iframe_size_width_type'] = $this->config->get('paysonCheckout2_iframe_size_width_type');
        }
        
        if (isset($this->request->post['paysonCheckout2_iframe_size_height'])) {
            $data['paysonCheckout2_iframe_size_height'] = $this->request->post['paysonCheckout2_iframe_size_height'];
        } else {
            if($this->config->get('paysonCheckout2_iframe_size_height') == Null){
                $data['paysonCheckout2_iframe_size_height'] = '900';
            }else{
                $data['paysonCheckout2_iframe_size_height'] = $this->config->get('paysonCheckout2_iframe_size_height');
            }
        }
        
        if (isset($this->request->post['paysonCheckout2_iframe_size_height_type'])) {
            $data['paysonCheckout2_iframe_size_height_type'] = $this->request->post['paysonCheckout2_iframe_size_height_type'];
        } else {
            $data['paysonCheckout2_iframe_size_height_type'] = $this->config->get('paysonCheckout2_iframe_size_height_type');
        }
        if (isset($this->request->post['paysonCheckout2_receipt'])) {
            $data['paysonCheckout2_receipt'] = $this->request->post['paysonCheckout2_receipt'];
        } else {
            $data['paysonCheckout2_receipt'] = $this->config->get('paysonCheckout2_receipt');
        }
        
        if (isset($this->request->post['paysonCheckout2_ignored_order_totals'])) {
            $data['paysonCheckout2_ignored_order_totals'] = $this->request->post['paysonCheckout2_ignored_order_totals'];
        } else {
            if ($this->config->get('paysonCheckout2_ignored_order_totals') == null) {
                $data['paysonCheckout2_ignored_order_totals'] = 'sub_total, total, taxes, tax';
            } else
                $data['paysonCheckout2_ignored_order_totals'] = $this->config->get('paysonCheckout2_ignored_order_totals');
        }

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('extension/payment/paysonCheckout2.tpl', $data));
    }

    private function validate() {

        if (!$this->user->hasPermission('modify', 'extension/payment/paysonCheckout2')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if (isset($this->request->post['paysonCheckout2_mode']) and $this->request->post['paysonCheckout2_mode'] != 0) {
            
            if (!isset($this->request->post['paysonCheckout2_merchant_id']) || !$this->request->post['paysonCheckout2_merchant_id']) {
                $this->error['merchant_id'] = $this->language->get('error_merchant_id');
            }

            if (!isset($this->request->post['paysonCheckout2_api_key']) || !$this->request->post['paysonCheckout2_api_key']) {
                $this->error['api_key'] = $this->language->get('error_api_key');
            }
        }
        if (isset($this->request->post['paysonCheckout2_ignored_order_totals']) and !$this->request->post['paysonCheckout2_ignored_order_totals']) {
            $this->error['ignored_order_totals'] = $this->language->get('error_ignored_order_totals');
        }

        return !$this->error;
    }
    
    	public function install() {
		$this->load->model('extension/payment/paysonCheckout2');

		$this->model_extension_payment_paysonCheckout2->install();
	}
}
?>