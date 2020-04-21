<?php
/*
Basic Class for administrate customers bookings 
*/
if (!defined('ABSPATH')) exit;

global $bookings;
?>

<link rel="stylesheet" href="<?php echo $ALWPDBF_vars->cssURL().'admin-styles.css';?>">
    
<h1><?php echo $bookings['admin-bookings-header'];?></h1>
<p><?php echo $bookings['admin-bookings-manual'];?></p>
<div id='filter'><form action='' method='post'>
<label for='startDate'><?php echo $bookings['filter-begin-date'];?></label>
<input type='text' name='startDate' 
            <?php 
       if (isset($_POST['startDate'])&&preg_match("/[2][0][1-5][0-9][0-1][0-9][0-3][0-9]/", $_POST['startDate'])&&strlen($_POST['startDate'])==8)
            {
                echo "value='".$_POST['startDate']."'";
            }
       ?>
 maxlength='8'><br/>
 <label for='finishDate'><?php echo $bookings['filter-finish-date'];?></label>
<input type='text' name='finishDate'
       <?php 
        if (isset($_POST['finishDate'])&&preg_match("/[2][0][1-5][0-9][0-1][0-9][0-3][0-9]/", $_POST['finishDate'])&&strlen($_POST['finishDate'])==8)
        {
           echo "value='".$_POST['finishDate']."'";
        }
       ?>
maxlength='8'><br/>
<input type='submit' value='<?php echo $bookings['filter-submit'];?>'>
</form></div>
<form action='' method='post'><div id='table'>
<table><thead>
        <tr><th><?php echo $bookings['table-delete'];?></th>
        <th><?php echo $bookings['table-id'];?></th>
        <th><?php echo $bookings['table-book-confirmed'];?></th>
        <th><?php echo $bookings['table-book-paid'];?></th>
        <th><?php echo $bookings['table-book-date'];?></th>
        <th><?php echo $bookings['table-book-time'];?></th>
        <th><?php echo $bookings['table-book-qty'];?></th>
        <th><?php echo $bookings['table-book-phone'];?></th>
        <th><?php echo $bookings['table-book-mail'];?></th>
        <th><?php echo $bookings['table-book-comment'];?></th>
        </tr></thead><tbody>

        <?php 
           for($i=0; $i<count($res['id']); $i++){ ?>
<tr>
<td><input type='checkbox' name='intDel[<?php echo $res['id'][$i];?>]'></td>
<td><?php echo $res['id'][$i];?></td>
<td><?php if ($res['confirmedIndicator'][$i]) echo '+';?></td> <?php // booking confirmed ?>
<td></td><?php  // paid ?>
<td><?php echo $res['date'][$i];?></td>
<td><?php echo $res['intTime'][$i];?></td>
<td><?php echo $res['seats_qty'][$i];?></td>
<td><?php echo $res['contact_phone'][$i];?></td>
<td><?php echo $res['contact_email'][$i];?></td>
<td><?php echo $res['comment'][$i];?></td>
</tr>
        <?php } ?> 
</tbody></table></div><input type='hidden' name='bookingsDelete' value='1'><br/>
<input type='submit' value='<?php echo $bookings['table-submit'];?>'>
       </form>
