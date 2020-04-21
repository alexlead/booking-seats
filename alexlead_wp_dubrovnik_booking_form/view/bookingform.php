<?php
/*
class define admin page for making letter to customer
*/
if (!defined('ABSPATH')) exit;

global $ALWPDBF_vars;
global $orderStep;

?>    

<link href='<?php echo $ALWPDBF_vars->cssURL();?>calendar.css'  type='text/css' rel='stylesheet'>

<div id='bookingForm'>
<ul>
<li>
<div class="stepInstruction">
<?php echo $orderStep['step-1'];?>
</div>

<div class='bookFormConstructor'> 
<div id='bookingcalendar'>
<div id='calendBefore'><img src="<?php echo $ALWPDBF_vars->imgURL();?>arrow-back.png" alt=""></div>
<?php echo prepareCalendar();  ?>
<div id='calendAfter'><img src="<?php echo $ALWPDBF_vars->imgURL();?>arrow-forward.png" alt=""></div>
</div>
</div>

<div class='bottomBut'><div class="col-50"></div><div class="col-50"><div class='nextBut'><?php echo $orderStep['button-next']; ?>
</div></div></div>
 </li>

<li>
<div class="stepInstruction">
<?php echo $orderStep['step-2'];?>
</div>
   <div class='bookFormConstructor'> 
    <div id="dateSeats" class="table-wrapper"><div><div><p><span class="orderDate"></span></p></div></div></div>
<?php echo prepareIntervals();?>
    </div>
 <div class='bottomBut'><div class="col-50"><div class='prevBut enStep'><?php echo $orderStep['button-back']; ?></div></div><div class="col-50"><div class='nextBut'><?php echo $orderStep['button-next']; ?></div></div></div>   
</li>
<li>
<div class="stepInstruction">
<?php echo $orderStep['step-3'];?>
</div>
   <div class='bookFormConstructor'> 
<div id="dateSeatsOrder" class="table-wrapper"><div><div><p><span class="orderDate"></span><br/><span class="orderTime"></span>, <?php echo $orderStep['details-3'];?><span class="orderSeats"></span></p></div></div></div>
<?php echo prepareContactForm();?>
</div>
</li>
<li>
<div class="stepInstruction">
<?php echo $orderStep['step-4'];?>
</div>
    <div class="orderDetails">
        <p class="detailsHeader"><?php echo $orderStep['details-0'];?></p>
        <p id="detailsDate"><?php echo $orderStep['details-1'];?><span class="orderDate"></span></p>
        <p id="detailsTime"><?php echo $orderStep['details-2'];?><span class="orderTime"></span></p>
        <p id="detailsSeats"><?php echo $orderStep['details-3'];?><span class="orderSeats"></span></p>
    </div>
</li>
</ul>
</div>


<script src='<?php echo $ALWPDBF_vars->jsURL();?>jquery-3.0.0.min.js'></script>
<script src='<?php echo $ALWPDBF_vars->jsURL();?>booking.js'></script>
<script>
var dt ="<?php echo date('Ymd');?>";
var dt1 = "<?php echo date('Ymd', strtotime("+1 day"));?>";
</script>
