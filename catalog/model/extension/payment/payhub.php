<?php 
class ModelExtensionPaymentPayHub extends Model {
  	public function getMethod($address, $total) {
		$this->load->language('extension/payment/payhub');
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "zone_to_geo_zone WHERE geo_zone_id = '" . (int)$this->config->get('payhub_geo_zone_id') . "' AND country_id = '" . (int)$address['country_id'] . "' AND (zone_id = '" . (int)$address['zone_id'] . "' OR zone_id = '0')");
		
		if ($this->config->get('payhub_total') > 0 && $this->config->get('payhub_total') > $total) {
			$status = false;
		} elseif (!$this->config->get('payhub_geo_zone_id')) {
			$status = true;
		} elseif ($query->num_rows) {
			$status = true;
		} else {
			$status = false;
		}	
		
		$method_data = array();
	
		if ($status) {  
      		$method_data = array( 
        		'code'       => 'payhub',
        		'title'      => "PayHub (" . $this->config->get('payhub_cards_accepted') . ")",
        		'terms' => '',
				'sort_order' => $this->config->get('payhub_sort_order')
      		);
    	}
   
    	return $method_data;
  	}

  	public function addTransactionInfo($payhub_order_id,$payhub_order_transaction_id,$amount,$payhub_settlement_status){
		$this->db->query("INSERT INTO `" . DB_PREFIX . "payhub_order_transaction` SET `payhub_order_id` = '" . (int)$payhub_order_id . "', `payhub_order_transaction_id` = '" . (int)$payhub_order_transaction_id . "', `date_added` = now(), `amount` = '" . (double)$amount . "', `payhub_settlement_status` = '" . $payhub_settlement_status . "'");
	}

	public function logger($message) {	
			$log = new Log('payhub.log');
			$log->write($message);
	}

}
?>