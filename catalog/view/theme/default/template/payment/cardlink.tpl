<?php
$form_data_array[1] = $mid;
$form_data_array[2] = $order_id;
$form_data_array[3] = $orderDesc;
$form_data_array[4] = $orderAmount;
$form_data_array[5] = $currency_code;
$form_data_array[6] = $extInstallmentoffset;
$form_data_array[7] = $cardlink_selected_installments;
$form_data_array[8] = $confirmUrl;
$form_data_array[9] = $cancelUrl;
$form_data_array[10] = $cardlink_digest;

$form_data = implode("", $form_data_array);
$digest = base64_encode(sha1($form_data,true));
?>
<style>
#payment-confirm-button .secondary-title {
  display:none;
}
.installments {
  font-size: 14px;
  margin-top: 10px;
}
</style>
<form action="<?php echo $action; ?>" id="shopform1" name="demo" method="POST" accept-charset="UTF-8" >
  <?php
  if ($orderAmount >= $minimum_installments_cost && $extInstallmentperiod != 0) {
  ?>
      <input type="hidden" name="extInstallmentoffset" value="<?php echo $extInstallmentoffset; ?>" />
      <div class="form-group">
        <label class="col-sm-2 control-label" for="extInstallmentperiod" style="padding-right:0px;"><h2 class="installments"><?php echo $installments; ?></h2></label>
      <div class="col-sm-4" id="select_installments">
      <select name="extInstallmentperiod" id="extInstallmentperiod" class="form-control" style="margin-bottom: 20px;">
      <option value="">--</option>
      <?php 
      for($i=2; $i<=$extInstallmentperiod; $i++) {
        echo '<option value="'.$i.'"';
        if($i == $cardlink_selected_installments) {echo ' selected="selected"';}
        echo'>'.$i.'</option>';
      }
      ?>
      </select>
      </div>
      </div>
  <?php    
  } else {
  ?>
    <input type="hidden" name="extInstallmentoffset" value="" />
    <input type="hidden" name="extInstallmentperiod" value="" />
  <?php 
  }
  ?>
  
  <input type="hidden" name="mid" value="<?php echo $mid; ?>" />
  <input type="hidden" name="currency" value="<?php echo $currency_code; ?>" />
  <input type="hidden" name="orderDesc" value="<?php echo $orderDesc; ?>" />
  <input type="hidden" name="confirmUrl" value="<?php echo $confirmUrl; ?>" />
  <input type="hidden" name="cancelUrl" value="<?php echo $cancelUrl; ?>" />
  <input type="hidden" name="orderAmount" id="orderAmount" value="<?php echo $orderAmount; ?>" />
  <input type="hidden" name="orderid" value="<?php echo $order_id; ?>" />
  <input type="hidden" name="digest" value="<?php  echo $digest ?>"/>
  <div class="buttons">
    <div class="pull-right">
      <input type="submit" value="<?php echo $button_confirm; ?>" class="btn btn-primary" id="default-btn-primary"/>
    </div>
  </div>
</form>

<script>
  $(document).ready(function() {
    $('#extInstallmentperiod').on('change', function() {
      $.ajax({
        url: 'index.php?route=payment/cardlink/saveInstallments',
        data: {cardlink_installments: this.value},
        method : 'POST',
        beforeSend: function() {
          $('#<?php echo $confirm_button; ?>').button('loading');
          $('#select_installments select[name=\'extInstallmentperiod\']').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');
        },  
        complete: function(){
          $.ajax({
            url: 'index.php?route=<?php echo $ajax_call_route; ?>',  
            dataType: 'html',
            success: function(html) {
              <?php 
              if ($ajax_call_route == "checkout/confirm") {
                echo $cart_div;
              }
              else {
                echo $cart_div;
              }
              ?>
              $('#<?php echo $confirm_button; ?>').button('reset');
              $('.fa-spin').remove();
            }
          });
        }
      });
    });
  });
</script>