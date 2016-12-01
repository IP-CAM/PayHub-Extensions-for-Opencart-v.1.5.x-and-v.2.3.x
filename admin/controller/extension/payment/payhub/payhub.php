<?php 
$path_to_IncludeClases="/payhub/com/payhub/ws/extra/includeClasses.php";
include_once $path_to_IncludeClases;

class ControllerExtensionPaymentPayHub extends Controller {
	private $error = array(); 

	public function index() {
		$this->load->language('extension/payment/payhub');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
			
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('payhub', $this->request->post);				
			
			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'], 'SSL'));
		}


		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_all_zones'] = $this->language->get('text_all_zones');
		$data['text_test'] = $this->language->get('text_test');
		$data['text_live'] = $this->language->get('text_live');
		$data['text_default_cards_accepted'] = $this->language->get('text_default_cards_accepted');
		
		$data['entry_org_id'] = $this->language->get('entry_org_id');
		$data['entry_username'] = $this->language->get('entry_username');
		$data['entry_password'] = $this->language->get('entry_password');
		$data['entry_terminal_id'] = $this->language->get('entry_terminal_id');
		$data['entry_hash'] = $this->language->get('entry_hash');
		$data['entry_mode'] = $this->language->get('entry_mode');
		$data['entry_total'] = $this->language->get('entry_total');	

		$data['help_total'] = $this->language->get('help_total');	

		$data['entry_order_status'] = $this->language->get('entry_order_status');		
		$data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$data['entry_cards_accepted'] = $this->language->get('entry_cards_accepted');
		$data['help_cards_accepted'] = $this->language->get('help_cards_accepted');		
		$data['entry_invoice_prefix'] = $this->language->get('entry_invoice_prefix');
		$data['help_invoice_prefix'] = $this->language->get('help_invoice_prefix');
		
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

 		if (isset($this->error['org_id'])) {
			$data['error_org_id'] = $this->error['org_id'];
		} else {
			$data['error_org_id'] = '';
		}

		if (isset($this->error['password'])) {
			$data['error_password'] = $this->error['password'];
		} else {
			$data['error_password'] = '';
		}

		if (isset($this->error['terminal_id'])) {
			$data['error_terminal_id'] = $this->error['terminal_id'];
		} else {
			$data['error_terminal_id'] = '';
		}



		if (isset($this->error['org_id_demo'])) {
			$data['error_org_id_demo'] = $this->error['org_id_demo'];
		} else {
			$data['error_org_id_demo'] = '';
		}

		if (isset($this->error['password_demo'])) {
			$data['error_password_demo'] = $this->error['password_demo'];
		} else {
			$data['error_password_demo'] = '';
		}

		if (isset($this->error['terminal_id_demo'])) {
			$data['error_terminal_id_demo'] = $this->error['terminal_id_demo'];
		} else {
			$data['error_terminal_id_demo'] = '';
		}



		if (isset($this->error['invoice_prefix'])) {
			$data['error_invoice_prefix'] = $this->error['invoice_prefix'];
		} else {
			$data['error_invoice_prefix'] = '';
		}
		
  		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_payment'),
			'href'      => $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('extension/payment/payhub', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
				
		$data['action'] = $this->url->link('extension/payment/payhub', 'token=' . $this->session->data['token'], 'SSL');

		$data['testConnection'] = $this->url->link('extension/payment/payhub/payhubTestConnection&token=' . $this->session->data['token']);

		$data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'], 'SSL');
		
		if (isset($this->request->post['payhub_org_id'])) {
			$data['payhub_org_id'] = $this->request->post['payhub_org_id'];
		} else {
			$data['payhub_org_id'] = $this->config->get('payhub_org_id');
		}
	
		if (isset($this->request->post['payhub_password'])) {
			$data['payhub_password'] = $this->request->post['payhub_password'];
		} else {
			$data['payhub_password'] = $this->config->get('payhub_password');
		}

		if (isset($this->request->post['payhub_terminal_id'])) {
			$data['payhub_terminal_id'] = $this->request->post['payhub_terminal_id'];
		} else {
			$data['payhub_terminal_id'] = $this->config->get('payhub_terminal_id');
		}

		if (isset($this->request->post['payhub_org_id_demo'])) {
			$data['payhub_org_id_demo'] = $this->request->post['payhub_org_id_demo'];
		} else {
			if(empty($this->config->get('payhub_org_id_demo'))){
				$data['payhub_org_id_demo'] = "10002";
			}else{
				$data['payhub_org_id_demo'] = $this->config->get('payhub_org_id_demo');
			}
			
		}
		if (isset($this->request->post['payhub_password_demo'])) {
			$data['payhub_password_demo'] = $this->request->post['payhub_password_demo'];
		} else {
			if(empty($this->config->get('payhub_password_demo'))){
				$data['payhub_password_demo'] = "26c4296b-0e79-4ea5-941c-a81ece6e15a3";
			}else{
				$data['payhub_password_demo'] = $this->config->get('payhub_password_demo');
			}
			
		}

		if (isset($this->request->post['payhub_terminal_id_demo'])) {
			$data['payhub_terminal_id_demo'] = $this->request->post['payhub_terminal_id_demo'];
		} else {			
			if(empty($this->config->get('payhub_terminal_id_demo'))){
				$data['payhub_terminal_id_demo'] = "2";
			}else{
				$data['payhub_terminal_id_demo'] = $this->config->get('payhub_terminal_id_demo');
			}
		}




		if (isset($this->request->post['payhub_server'])) {
			$data['payhub_server'] = $this->request->post['payhub_server'];
		} else {
			$data['payhub_server'] = $this->config->get('payhub_server');
		}
		
		if (isset($this->request->post['payhub_mode'])) {
			$data['payhub_mode'] = $this->request->post['payhub_mode'];
		} else {
			$data['payhub_mode'] = $this->config->get('payhub_mode');
		}

		if (isset($this->request->post['payhub_cards_accepted'])) {
			$data['payhub_cards_accepted'] = $this->request->post['payhub_cards_accepted'];
		} else {
			$data['payhub_cards_accepted'] = ($this->config->get('payhub_cards_accepted')) ? $this->config->get('payhub_cards_accepted') : $this->language->get('text_default_cards_accepted');
		}

		if (isset($this->request->post['payhub_invoice_prefix'])) {
			$data['payhub_invoice_prefix'] = $this->request->post['payhub_invoice_prefix'];
		} else {
			$data['payhub_invoice_prefix'] = $this->config->get('payhub_invoice_prefix');
		}
		
		if (isset($this->request->post['payhub_method'])) {
			$data['payhub_method'] = $this->request->post['payhub_method'];
		} else {
			$data['payhub_method'] = $this->config->get('payhub_method');
		}
		
		if (isset($this->request->post['payhub_total'])) {
			$data['payhub_total'] = $this->request->post['payhub_total'];
		} else {
			$data['payhub_total'] = $this->config->get('payhub_total'); 
		} 
				
		if (isset($this->request->post['payhub_order_status_id'])) {
			$data['payhub_order_status_id'] = $this->request->post['payhub_order_status_id'];
		} else {
			$data['payhub_order_status_id'] = $this->config->get('payhub_order_status_id'); 
		} 

		$this->load->model('localisation/order_status');
		
		$data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();
		
		if (isset($this->request->post['payhub_geo_zone_id'])) {
			$data['payhub_geo_zone_id'] = $this->request->post['payhub_geo_zone_id'];
		} else {
			$data['payhub_geo_zone_id'] = $this->config->get('payhub_geo_zone_id'); 
		} 
		
		$this->load->model('localisation/geo_zone');
										
		$data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();
		
		if (isset($this->request->post['payhub_status'])) {
			$data['payhub_status'] = $this->request->post['payhub_status'];
		} else {
			$data['payhub_status'] = $this->config->get('payhub_status');
		}
		
		if (isset($this->request->post['payhub_sort_order'])) {
			$data['payhub_sort_order'] = $this->request->post['payhub_sort_order'];
		} else {
			$data['payhub_sort_order'] = $this->config->get('payhub_sort_order');
		}

		// $this->template = 'payment/payhub.tpl';
		// $this->children = array(
		// 	'common/header',
		// 	'common/footer'
		// );
				
		// $this->response->setOutput($this->render());

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		$this->response->setOutput($this->load->view('extension/payment/payhub.tpl', $data));

	}

	public function install() {
		//$this->load->model('extension/payment/payhub');
		//$this->model_extension_payment_worldpay->install();
	}

	public function uninstall() {
		//$this->load->model('extension/payment/payhub');
		//$this->model_extension_payment_worldpay->uninstall();
	}



	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/payment/payhub')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		/// check live or demo is checked
		$mode=$this->request->post['payhub_mode'];
		if($mode=='live'){
			if (!$this->request->post['payhub_org_id']) {
			$this->error['org_id'] = $this->language->get('error_org_id');
			}
			if (!$this->request->post['payhub_password']) {
				$this->error['password'] = $this->language->get('error_password');
			}
			
			if (!$this->request->post['payhub_terminal_id']) {
				$this->error['terminal_id'] = $this->language->get('error_terminal_id');
			}
		
		}else{
			if (!$this->request->post['payhub_org_id_demo']) {
			$this->error['org_id_demo'] = $this->language->get('error_org_id');
			}
			if (!$this->request->post['payhub_password_demo']) {
				$this->error['password_demo'] = $this->language->get('error_password');
			}
			
			if (!$this->request->post['payhub_terminal_id_demo']) {
				$this->error['terminal_id_demo'] = $this->language->get('error_terminal_id');
			}
		}
		
		if (preg_match('/[^0-9a-zA-Z-]/', $this->request->post['payhub_invoice_prefix'])) {
			$this->error['invoice_prefix'] = $this->language->get('error_invoice_prefix');
		}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}

	public function payhubTestConnection() {	
		$mode = $_POST['mode'];
		$token = $_POST['token'];

		//Defining data for the SALE transaction
			// Merchant data (obtained from the payHub Virtual Terminal (3rd party integration)
		$merchant = new Merchant();

		if ($mode == "test") {
			$WsURL="https://sandbox-api.payhub.com/api/v2/";
		} 
	    else {
			$WsURL="https://dc1-api.payhub.com/api/v2/";
		}

		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => $WsURL,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_HTTPHEADER => array(
		    "authorization: Bearer ".$token,
		    "cache-control: no-cache",
		    "postman-token: 5f807105-4375-071e-b66f-dccd493b175d"
		  ),
		));

		$response = curl_exec($curl);
		$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
	    curl_close($curl);
	    //echo $httpcode;
	    $data = json_decode($response, true);

	    if ($httpcode>=200 && $httpcode< 400){
	       $this->response->setOutput(json_encode(true));
	    } else {
	       $this->response->setOutput(json_encode(false));
	    }		
				
	}
}