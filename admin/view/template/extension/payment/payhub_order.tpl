<h2><?php echo $text_payment_info; ?></h2>
<div class="alert alert-success" id="payhub_transaction_msg" style="display:none;"></div>
<table class="table table-striped table-bordered">
  <tr>
	<td><?php echo $text_order_ref; ?></td>
	<td id='payhub_order_transaction_id'><?php echo $payhub_order['payhub_order_transaction_id']; ?></td>
  </tr>
  <tr>
	<td><?php echo $text_order_total; ?></td>
	<td id='payhub_trn_total_amount'><?php echo $payhub_order['amount']; ?></td>
  </tr>
  <tr>
	<td><?php echo $text_transaction_status; ?></td>
	
  <td>
  <?php
    echo $payhub_order['payhub_settlement_status'];
    ?>
  </td>
  <?php if ($payhub_order['payhub_settlement_status'] == 'Settled') { ?>
  </tr>
  <tr>
  <td>Total Refunded</td>
  
  <td id="payhub_total_refunded"><?php echo $payhub_order['payhub_total_refunded']; ?></td>

  </tr>
    <?php } ?>

  <tr>

	<td><?php echo $text_refund_status; ?></td>
	<td id="refund_status">
	  <?php if ($payhub_order['payhub_settlement_status'] == 'Settled') { ?>
		  <span class="refund_text"><?php echo $text_yes; ?></span>&nbsp;&nbsp;
       <?php if ($payhub_order['amount'] > 0) { ?>
        <input type="number" width="10" id="refund_amount" />
        <a class="button btn btn-primary" id="btn_refund"><?php echo $button_refund; ?></a>
        <span class="btn btn-primary" id="img_loading_refund" style="display:none;"><i class="fa fa-cog fa-spin fa-lg"></i></span>
      <?php } ?>
	  <?php } if($payhub_order['payhub_settlement_status'] == 'Not settled') { ?>
		  <span class="refund_text"></span>&nbsp;&nbsp;
      <a class="button btn btn-primary" id="btn_void"><?php echo $button_void; ?></a>
        <span class="btn btn-primary" id="img_loading_refund" style="display:none;"><i class="fa fa-cog fa-spin fa-lg"></i></span>
		 
	  <?php } ?>


	</td>
  </tr>

</table>
<script type="text/javascript">

    $("#btn_refund").click(function () {
      var trn_total_amount= parseInt($('#payhub_trn_total_amount').html());
      var trm_refund_amount_left=trn_total_amount - parseInt($('#payhub_total_refunded').html());
      console.log(trm_refund_amount_left);
      if(!$('#refund_amount').val()){
        alert ('must enter the refund amount');

      }else if(trm_refund_amount_left < parseInt($('#refund_amount').val()) || parseInt($('#refund_amount').val())==0){
        alert ('The amount to refund must be less than: '+trm_refund_amount_left);        
      }else{
        if (confirm('<?php echo $text_confirm_refund; ?>')) {
        $.ajax({
          type: 'POST',
          dataType: 'json',
          data: {'order_id': <?php echo $order_id; ?>, 'amount': $('#refund_amount').val(),'payhub_trn_id':<?php echo $payhub_order['payhub_order_transaction_id']; ?>,
            'trn_amount':$('#payhub_trn_total_amount').html(),
            'payhub_total_refunded':$('#payhub_total_refunded').html()
          },
          url: 'index.php?route=extension/payment/payhub/refund&token=<?php echo $token; ?>',
          beforeSend: function () {
            $('#btn_refund').hide();
            $('#refund_amount').hide();
            $('#img_loading_refund').show();
            $('#payhub_transaction_msg').hide();
          },
          success: function (data) {
            if (data.error == false) {              
              $('#payhub_transaction_msg').empty().html('<i class="fa fa-check-circle"></i> ' + data.msg).fadeIn();
              $('#img_loading_refund').hide();
              $('#payhub_total_refunded').html(data.total_refunded);
              if (data.total_refunded < trn_total_amount) {
                $('.refund_text').text('<?php echo $text_yes; ?>');
                $('#btn_refund').show();
                $('#refund_amount').val(0.00).show();
              } else {
                $('.refund_text').text('<?php echo $text_no; ?>');
              }
            }else{
              alert(data.msg);
            }
          }
        });
      }
      }
      
    });


        $("#btn_void").click(function () {
      if (confirm('<?php echo $text_confirm_void; ?>')) {
        $.ajax({
          type: 'POST',
          dataType: 'json',
          data: {'order_id': <?php echo $order_id; ?>,
          'payhub_trn_id':<?php echo $payhub_order['payhub_order_transaction_id']; ?>
        },
          url: 'index.php?route=extension/payment/payhub/voidTransaction&token=<?php echo $token; ?>',
          beforeSend: function () {
            $('#btn_void').hide();
            //$('#refund_amount').hide();
            $('#img_loading_refund').show();
            //$('#payhub_transaction_msg').hide();
          },
          success: function (data) {
            if (data.error == false) {
              $('#payhub_transaction_msg').empty().html('<i class="fa fa-check-circle"></i> ' + data.msg).fadeIn();
              $('#img_loading_refund').hide();
            }
            if (data.error == true) {
              alert(data.msg);
              $('#btn_void').show();
            }
          }
        });
      }
    });

</script>