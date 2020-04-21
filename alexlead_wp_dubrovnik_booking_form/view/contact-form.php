<?php
/*
class define admin page for making letter to customer
*/
if (!defined('ABSPATH')) exit;

global $cont;
global $orderStep;
?>   

<form id='contFormSubm' action="javascript:" method='post'>

<div id='contactForm'>
<input type='hidden' name='order[0]' id='order0' value='<?php echo date('Ymd');?>'><?php // selected date ?>
<input type='hidden' name='order[1]' id='order1'  value=''><?php // selected time ?>
<input type='hidden' name='order[2]' id='order2' value=''><?php // selected seats ?>
   <div>        
    <label for='order[3]'><?php echo $cont['label-phone'];?> <span>*</span> </label><input type='tel' name='order[3]' id='order3'  value='' placeholder='' maxlength='38'><?php // enter ph number ?>
    </div>
    <div>
<label for='order[4]'><?php echo $cont['label-e-mail'];?> <span>*</span></label><input type='email' name='order[4]' id='order4' value='' placeholder='' maxlength='50'><?php // enter e-mail ?>
</div>
</div>

  <div class='bottomBut'><div class="col-50"><div class='prevBut enStep'><?php echo $orderStep['button-back']; ?></div></div><div class="col-50"><input type="submit" value="<?php echo $orderStep['submit']; ?>"></div></div>   

</form>
