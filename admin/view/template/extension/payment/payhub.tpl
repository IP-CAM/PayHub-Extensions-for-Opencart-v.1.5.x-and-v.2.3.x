<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="breadcrumb">
    <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
      <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>

  </div>
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>

  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
      <button type="submit" form="form" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
      <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
      </div>
      <h1><i class="fa fa-credit-card"></i> <?php echo $heading_title; ?></h1>
    </div>
  </div>


<div class="container-fluid">
  <div class="panel-body">
    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form" class="form-horizontal">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#tab-general" data-toggle="tab">Settings</a></li>
    </ul>
    <div class="tab-content">
      <div class="tab-pane active" id="tab-general">
      

      <!-- Start LIVE Credentials -->

      <div id="live-box">
        <div class="form-group required">
          <label class="col-sm-2 control-label" for="payhub_org_id"><?php echo $entry_org_id; ?></label>
          <div class="col-sm-10">
          <input type="text" name="payhub_org_id" value="<?php echo $payhub_org_id; ?>" placeholder="<?php echo $payhub_org_id; ?>" id="payhub_org_id" class="form-control" />
          <?php if ($error_org_id) { ?>
            <div class="text-danger"><?php echo $error_org_id; ?></div>
          <?php } ?>
          </div>
        </div>

        <div class="form-group required">
          <label class="col-sm-2 control-label" for="payhub_terminal_id"><?php echo $entry_terminal_id; ?></label>
          <div class="col-sm-10">
          <input type="text" name="payhub_terminal_id" value="<?php echo $payhub_terminal_id; ?>" placeholder="<?php echo $payhub_terminal_id; ?>" id="payhub_terminal_id" class="form-control" />
          <?php if ($error_terminal_id) { ?>
            <div class="text-danger"><?php echo $error_terminal_id; ?></div>
          <?php } ?>
          </div>
        </div>


        <div class="form-group required">
          <label class="col-sm-2 control-label" for="payhub_password"><?php echo $entry_password; ?></label>
          <div class="col-sm-10">
          <input type="text" name="payhub_password" value="<?php echo $payhub_password; ?>" placeholder="<?php echo $payhub_password; ?>" id="payhub_password" class="form-control" />
          <?php if ($error_password) { ?>
            <div class="text-danger"><?php echo $error_password; ?></div>
          <?php } ?>
          </div>
        </div>
      </div>
      <!-- End LIVE Credentials -->

      <!-- Start DEMO Credentials -->
      <div id="test-box">
        <div class="form-group required">
          <label class="col-sm-2 control-label" for="payhub_org_id_demo"><?php echo $entry_org_id; ?></label>
          <div class="col-sm-10">
          <input type="text" name="payhub_org_id_demo" value="<?php echo $payhub_org_id_demo; ?>" placeholder="<?php echo $payhub_org_id_demo; ?>" id="payhub_org_id_demo" class="form-control" />
          <?php if ($error_org_id_demo) { ?>
            <div class="text-danger"><?php echo $error_org_id_demo; ?></div>
          <?php } ?>
          </div>
        </div>

        <div class="form-group required">
          <label class="col-sm-2 control-label" for="payhub_terminal_id_demo"><?php echo $entry_terminal_id; ?></label>
          <div class="col-sm-10">
          <input type="text" name="payhub_terminal_id_demo" value="<?php echo $payhub_terminal_id_demo; ?>" placeholder="<?php echo $payhub_terminal_id_demo; ?>" id="payhub_terminal_id_demo" class="form-control" />
          <?php if ($error_terminal_id_demo) { ?>
            <div class="text-danger"><?php echo $error_terminal_id_demo; ?></div>
          <?php } ?>
          </div>
        </div>


        <div class="form-group required">
          <label class="col-sm-2 control-label" for="payhub_password_demo"><?php echo $entry_password; ?></label>
          <div class="col-sm-10">
          <input type="text" name="payhub_password_demo" value="<?php echo $payhub_password_demo; ?>" placeholder="<?php echo $payhub_password_demo; ?>" id="payhub_password_demo" class="form-control" />
          <?php if ($error_password_demo) { ?>
            <div class="text-danger"><?php echo $error_password_demo; ?></div>
          <?php } ?>
          </div>
        </div>
      </div>
      
      <!-- End DEMO Credentials -->

      <div class="form-group">
        <label class="col-sm-2 control-label" for="payhub_mode"><?php echo $entry_mode; ?></label>
        <div class="col-sm-10">
        <select name="payhub_mode" id="payhub_mode" class="form-control">
          <?php if ($payhub_mode == 'live') { ?>
                <option value="live" selected="selected"><?php echo $text_live; ?></option>
                <?php } else { ?>
                <option value="live"><?php echo $text_live; ?></option>
                <?php } ?>
                <?php if ($payhub_mode == 'test') { ?>
                <option value="test" selected="selected"><?php echo $text_test; ?></option>
                <?php } else { ?>
                <option value="test"><?php echo $text_test; ?></option>
                <?php } ?>
        </select>
        </div>
      </div>
      <div class="form-group">
          <label class="col-sm-2 control-label" for="payhub_test_connection">Test Connection</label>
          <div class="col-sm-10">
            <div class="pull-left">
            <button type="button" data-toggle="tooltip" id="payhub_test_connection" title="Test Connection" class="btn btn-primary">
              Test your Connection (Not Tested)</button>
            </div>
          </div>  
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label" for="payhub_cards_accepted"><?php echo $entry_cards_accepted; ?> </label>
        <div class="col-sm-10">
        <input type="text" name="payhub_cards_accepted" value="<?php echo $payhub_cards_accepted; ?>" placeholder="<?php echo $payhub_cards_accepted; ?>" id="payhub_cards_accepted" class="form-control" />
        <span class="help-block"><?php echo $help_cards_accepted; ?></span> </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label" for="payhub_invoice_prefix"><?php echo $entry_invoice_prefix; ?> </label>
        <div class="col-sm-10">
        <input type="text" name="payhub_invoice_prefix" value="<?php echo $payhub_invoice_prefix; ?>" placeholder="<?php echo $payhub_invoice_prefix; ?>" id="payhub_invoice_prefix" class="form-control" />
        <span class="help-block"><?php echo $help_invoice_prefix; ?></span> </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label" for="payhub_total"><?php echo $entry_total; ?> </label>
        <div class="col-sm-10">
        <input type="text" name="payhub_total" value="<?php echo $payhub_total; ?>" placeholder="<?php echo $payhub_total; ?>" id="payhub_total" class="form-control" />
        <span class="help-block"><?php echo $help_total; ?></span> </div>
      </div>


      <div class="form-group">
        <label class="col-sm-2 control-label" for="payhub_order_status_id"><?php echo $entry_order_status; ?></label>
        <div class="col-sm-10">
        <select name="payhub_order_status_id" id="payhub_order_status_id" class="form-control">
          <?php foreach ($order_statuses as $order_status) { ?>
                <?php if ($order_status['order_status_id'] == $payhub_order_status_id) { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                <?php } ?>
                <?php } ?>
        </select>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label" for="payhub_geo_zone_id"><?php echo $entry_geo_zone; ?></label>
        <div class="col-sm-10">
        <select name="payhub_geo_zone_id" id="payhub_geo_zone_id" class="form-control">
          <option value="0"><?php echo $text_all_zones; ?></option>
              <?php foreach ($geo_zones as $geo_zone) { ?>
                <?php if ($geo_zone['geo_zone_id'] == $payhub_geo_zone_id) { ?>
                  <option value="<?php echo $geo_zone['geo_zone_id']; ?>" selected="selected"><?php echo $geo_zone['name']; ?></option>
                <?php } else { ?>
                  <option value="<?php echo $geo_zone['geo_zone_id']; ?>"><?php echo $geo_zone['name']; ?></option>
              <?php } ?>
              <?php } ?>
        </select>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label" for="payhub_status"><?php echo $entry_status; ?></label>
        <div class="col-sm-10">
        <select name="payhub_status" id="payhub_status" class="form-control">
          <?php if ($payhub_status) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
        </select>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label" for="payhub_sort_order"><?php echo $entry_sort_order; ?></label>
        <div class="col-sm-10">
        <input type="text" name="payhub_sort_order" value="<?php echo $payhub_sort_order; ?>" placeholder="<?php echo $payhub_sort_order; ?>" id="payhub_sort_order" class="form-control" />
        </div>
      </div>


      
     
      </div>
    </div>


    </form>
    </div>
  </div>    

<?php echo $footer; ?> 



<script type="text/javascript">
  $(document).ready(function($) {
    var mode = $("#payhub_mode").val();
    if(mode=='test'){
      enableDemo(); 
    }else{
      disableDemo();
    }
  });

    $("#payhub_mode").on("change",function(){    
      var mode = $("#payhub_mode").val();
      if(mode=='test'){
        enableDemo(); 
      }else{
        disableDemo();
      }
    });


  $('#payhub_test_connection').on('click', function() {
    $("#payhub_test_connection").removeClass( "btn-primary" ).removeClass( "btn-success" ).removeClass( "btn-danger" ).addClass( "btn-warning" );
    $("#payhub_test_connection").html('Connecting');
    var datas = {
        mode:'live',
        token:'',
        org_id:'',
        terminal_id:''
      }

      var mode = $("#payhub_mode").val();
      if(mode=='test'){
        datas.mode = 'test';
        datas.org_id= $("#payhub_org_id_demo").val();
        datas.terminal_id= $("#payhub_terminal_id_demo").val();
        datas.token=$("#payhub_password_demo").val(); 

      }else{
        datas.mode = 'live';
        datas.org_id= $("#payhub_org_id").val();
        datas.terminal_id= $("#payhub_terminal_id").val();
        datas.token=$("#payhub_password").val();
      }

    $.ajax({
      type:"POST",
      url: '<?php echo $testConnection; ?>',
      data: datas,
      success: function(data) {
        data=JSON.parse(data);
        if(data){
         $("#payhub_test_connection").removeClass( "btn-warning" ).removeClass( "btn-danger" ).addClass( "btn-success" );
          $("#payhub_test_connection").html('Connected');
        }else{
          $("#payhub_test_connection").removeClass( "btn-warning" ).removeClass( "btn-success" ).addClass( "btn-danger" );
          $("#payhub_test_connection").html('Not Connected');
        }

      },
      error: function(xhr, ajaxOptions, thrownError) {
        $("#payhub_test_connection").removeClass( "btn-warning" ).addClass( "btn-danger" );
        $("#payhub_test_connection").html('Not Connected');
      }
    });
  });


function enableDemo(){
    $("#live-box").hide();
    $("#test-box").show();
  }
  function disableDemo(){
    $("#live-box").show();
    $("#test-box").hide();
  }

  </script>