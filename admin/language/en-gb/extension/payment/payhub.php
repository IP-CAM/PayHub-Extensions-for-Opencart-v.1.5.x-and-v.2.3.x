<?php
// Heading
$_['heading_title']      = 'PayHub Gateway';

// Text 
$_['text_payment']       = 'Payment';
$_['text_success']       = 'Success: You have modified PayHub account details!';
$_['text_test']          = 'Test';
$_['text_live']          = 'Live';
$_['text_payhub']		 = '<a href="http://www.payhub.com" target="_blank"><img src="http://www.payhub.com/images/payhub_finalorangelogotm.png" alt="PayHub Website" title="PayHub Website" style="border: 1px solid #EEEEEE; height: 32px" /></a>';
$_['text_default_cards_accepted']	= 'Visa/MC';

// Entry Titles
$_['entry_org_id']     	 = 'Organization ID:';
$_['entry_username']     = 'API Username:';
$_['entry_password']     = 'API Token:';
$_['entry_terminal_id']  = 'API Terminal ID:';
$_['entry_mode']         = 'Transaction Mode:';
$_['entry_total']        = 'Total:';
$_['help_total']        = 'The checkout total the order must reach before this payment method becomes active.';

$_['entry_order_status'] = 'Order Status:';
$_['entry_geo_zone']     = 'Geo Zone:'; 
$_['entry_status']       = 'Status:';
$_['entry_sort_order']   = 'Sort Order:';
$_['entry_cards_accepted'] = 'Card Types Accepted:';
$_['help_cards_accepted'] = 'This will appear at the point where the user chooses the payment method during the checkout process.';
$_['entry_invoice_prefix'] = 'Invoice Prefix:';

$_['help_invoice_prefix'] = 'This will automatically be prepended to the order ID and sent to PayHub in the "invoice" field.';

// Error 
$_['error_permission']   = 'Warning: You do not have permission to modify payment PayHub (SIM)!';
$_['error_org_id']       = 'Organization ID Required!';
$_['error_username']     = 'username Required!';
$_['error_password']     = 'API Token Required!';
$_['error_terminal_id']  = 'Terminal ID Required!';
$_['error_invoice_prefix']  = 'Invoice Prefix can only contain numbers, letters and dash (-) characters!';


// Order page - payment tab
$_['text_payment_info']			         = 'Payment information';
$_['text_refund_status']		         = 'Payment Operation';
$_['text_order_ref']			         = 'Payhub Transaction Id';
$_['text_order_total']			         = 'Total authorised';
$_['text_transaction_status']		     = 'Transaction Status';
$_['text_transactions']			         = 'Transactions';
$_['text_column_amount']		         = 'Amount';
$_['text_column_type']			         = 'Type';
$_['text_column_date_added']	         = 'Added';

$_['text_confirm_refund']		         = 'Are you sure you want to refund the payment?';
$_['text_confirm_void']		         = 'Are you sure you want to void the payment?';

$_['button_refund']				         = 'Rebate / refund';
$_['button_void']				         = 'Discard / void';
?>