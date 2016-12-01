<?php
$path_to_IncludeClases="/payhub/com/payhub/ws/extra/includeClasses.php";
include_once $path_to_IncludeClases;

class ControllerExtensionPaymentPayHub extends Controller {
	public function index() {
		$this->load->language('extension/payment/payhub');
		
		$data['text_credit_card'] = $this->language->get('text_credit_card');
		$data['text_wait'] = $this->language->get('text_wait');
		
		$data['entry_cc_owner'] = $this->language->get('entry_cc_owner');
		$data['entry_cc_number'] = $this->language->get('entry_cc_number');
		$data['entry_cc_expire_date'] = $this->language->get('entry_cc_expire_date');
		$data['entry_cc_cvv2'] = $this->language->get('entry_cc_cvv2');
		
		$data['button_confirm'] = $this->language->get('button_confirm');
		
		$data['months'] = array();
		
		for ($i = 1; $i <= 12; $i++) {
			$data['months'][] = array(
				'text'  => strftime('%B', mktime(0, 0, 0, $i, 1, 2000)), 
				'value' => sprintf('%02d', $i)
			);
		}
		
		$today = getdate();

		$data['year_expire'] = array();

		for ($i = $today['year']; $i < $today['year'] + 11; $i++) {
			$data['year_expire'][] = array(
				'text'  => strftime('%Y', mktime(0, 0, 0, 1, 1, $i)),
				'value' => strftime('%Y', mktime(0, 0, 0, 1, 1, $i)) 
			);
		}
		
		// if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/payhub.tpl')) {
		// 	$this->template = $this->config->get('config_template') . '/template/payment/payhub.tpl';
		// } else {
		// 	$this->template = 'default/template/payment/payhub.tpl';
		// }	
		return $this->load->view('extension/payment/payhub', $data);
		//$this->render();		
	}
	
	public function send() {
        $data = array();

		$this->load->model('checkout/order');
		$order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);	


		$merchant = new Merchant();
			
		if ($this->config->get('payhub_mode') == 'test') {
			$WsURL="https://sandbox-api.payhub.com/api/v2/";
			$oauth_token = $this->config->get('payhub_password_demo');
			$merchant->setOrganizationId( $this->config->get('payhub_org_id_demo'));
			$merchant->setTerminalId( $this->config->get('payhub_terminal_id_demo'));
		} 
	    else {
			$WsURL="https://dc1-api.payhub.com/api/v2/";
			$oauth_token = $this->config->get('payhub_password');
			$merchant->setOrganizationId( $this->config->get('payhub_org_id'));
			$merchant->setTerminalId( $this->config->get('payhub_terminal_id'));
		}

		// bill data
		$bill= new Bill();
		$bill->setBaseAmount( $this->currency->format($order_info['total'], $order_info['currency_code'], 1.00000, false));		
		$bill->setNote(html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));
		$bill->setInvoiceNumber($this->config->get('payhub_invoice_prefix') . $this->session->data['order_id']);
			
		$card_data = new CardData();
		$card_data->setCardNumber(str_replace(' ', '', $this->request->post['cc_number']));
		$card_data->setCardExpiryDate($this->request->post['cc_expire_date_year'].$this->request->post['cc_expire_date_month']);
		$card_data->setCvvData($this->request->post['cc_cvv2']);
		$card_data->setBillingAddress1(html_entity_decode($order_info['payment_address_1'], ENT_QUOTES, 'UTF-8'));
		$card_data->setBillingAddress2(html_entity_decode($order_info['payment_address_2'], ENT_QUOTES, 'UTF-8'));
		$card_data->setBillingCity(html_entity_decode($order_info['payment_city'], ENT_QUOTES, 'UTF-8'));
		$card_data->setBillingState(html_entity_decode($order_info['payment_zone_code'], ENT_QUOTES, 'UTF-8'));
		$card_data->setBillingZip(html_entity_decode($order_info['payment_postcode'], ENT_QUOTES, 'UTF-8'));
		// Customer data
		$customer = new Customer();
		$customer->setFirstName(html_entity_decode($order_info['payment_firstname'], ENT_QUOTES, 'UTF-8'));
		$customer->setLastName(html_entity_decode($order_info['payment_lastname'], ENT_QUOTES, 'UTF-8'));
		$customer->setEmailAddress($order_info['email']);
		$customer->setPhoneNumber($order_info['telephone']);			
		$customer->setPhoneType("M");

		$object = new Sale($merchant,$customer,$bill,$card_data);
		$transaction = new TransactionManager($merchant,$WsURL,$oauth_token);
		$result = $transaction->doSale($object);

		//$this->response->setOutput(json_encode($this->config->get('payhub_status')));

		$json = array();

		if($result->getErrors()==null){
			 // $this->model_checkout_order->addOrderHistory($order_info['order_id'], $this->config->get('config_order_status_id'));
			$amount = $this->currency->format($order_info['total'], $order_info['currency_code'], 1.00000, false);
			$message = 'Authorization Code: ' . $result->getSaleResponse()->getApprovalCode() . "\n";
			$message .= 'AVS Response: ' . $result->getSaleResponse()->getAvsResultCode() . "\n";
			$message .= 'Transaction ID: ' . $result->getSaleResponse()->getSaleId() . "\n";
			$message .= 'CVV Response: ' . $result->getSaleResponse()->getVerificationResultCode() . "\n";

			$this->model_checkout_order->addOrderHistory($this->session->data['order_id'], $this->config->get('payhub_order_status_id'), $message, false);

			$this->load->model('extension/payment/payhub');
			$this->model_extension_payment_payhub->logger(json_encode($result));

			$this->model_extension_payment_payhub->addTransactionInfo($this->session->data['order_id'],$result->getSaleResponse()->getSaleId(),$amount,$result->getSettlementStatus());

			//$this->model_extension_payment_payhub->logger(json_encode("pase por aca"));
			$json['success'] = $this->url->link('checkout/success', '', 'SSL');
		}else{
			$error_message = "The transaction failed to process for the following reason:\n";
				$error_message .= json_encode($result->getErrors());
				$json['error'] = $error_message;
		}
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}
?>