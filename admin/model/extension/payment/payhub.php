<?php
class ModelExtensionPaymentPayhub extends Model {
	public function install() {
		$this->db->query("
			CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "payhub_order_transaction` (
			  `payhub_order_transaction_id` INT(11) NOT NULL AUTO_INCREMENT,
			  `payhub_order_id` INT(11) NOT NULL,
			  `date_added` DATETIME NOT NULL,			  
			  `amount` DECIMAL( 10, 2 ) NOT NULL,
			  `payhub_settlement_status` VARCHAR(40) DEFAULT NULL,
			  `payhub_void_id` VARCHAR(11) DEFAULT NULL,
			  `payhub_refund_id` VARCHAR(11) DEFAULT NULL,
			  `payhub_total_refunded` DECIMAL( 10, 2 ) NOT NULL,
			  PRIMARY KEY (`payhub_order_transaction_id`)
			) ENGINE=MyISAM DEFAULT COLLATE=utf8_general_ci;");

	}

	public function uninstall() {
		$this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "payhub_order_transaction`;");
	}

	public function addTransactionInfo($payhub_order_id,$payhub_order_transaction_id,$amount,$payhub_settlement_status){
		$this->db->query("INSERT INTO `" . DB_PREFIX . "payhub_order_transaction` SET `payhub_order_id` = '" . (int)$payhub_order_id . "', `payhub_order_transaction_id` = '" . (int)$payhub_order_transaction_id . "', `date_added` = now(), `amount` = '" . (double)$total . "' `payhub_settlement_status` = '" . $payhub_settlement_status . "'");
	}

	public function getTransactionInfo($payhub_order_id){
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "payhub_order_transaction` WHERE `payhub_order_id` = '" . (int)$payhub_order_id . "'");

		$transactions = array();
		if ($query->num_rows) {
			return $query->rows;
		} else {
			return false;
		}
	}

	public function updateTransactionInfoForVoid($payhub_order_id,$payhub_void_id){
		$this->db->query("UPDATE `" . DB_PREFIX . "payhub_order_transaction` SET `payhub_void_id` = '" . $payhub_void_id . "' WHERE `payhub_order_id` = '" . (int)$payhub_order_id . "'");

	}
	public function updateTransactionInfoForRefund($payhub_order_id,$payhub_refund_id,$amount){
		$this->db->query("UPDATE `" . DB_PREFIX . "payhub_order_transaction` SET `payhub_refund_id` = '" . $payhub_refund_id . "', `payhub_total_refunded` = '" . $amount . "' WHERE `payhub_order_id` = '" . (int)$payhub_order_id . "'");
	}
	public function updateSettlementStatus($payhub_order_id,$settlementStatus){
		$this->db->query("UPDATE `" . DB_PREFIX . "payhub_order_transaction` SET `payhub_settlement_status` = '" . $settlementStatus . "' WHERE `payhub_order_id` = '" . (int)$payhub_order_id . "'");
	}

	// public function getStatusRefundOrderId(){
	// 	$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "order_status` WHERE `name` = 'Refunded'");
	// 	if ($query->num_rows) {
	// 		return $query->rows;
	// 	} else {
	// 		return false;
	// 	}
	// }
	// public function getStatusVoidOrderId(){
	// 	$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "order_status` WHERE `name` = 'Voided'");
	// 	if ($query->num_rows) {
	// 		return $query->rows;
	// 	} else {
	// 		return false;
	// 	}
	// }

	public function logger($message) {	
			$log = new Log('payhub.log');
			$log->write($message);
	}
}