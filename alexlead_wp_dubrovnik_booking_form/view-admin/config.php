<?php
/*
class define admin page for making letter to customer
*/
if (!defined('ABSPATH')) exit;

global $options;
?>
<link rel="stylesheet" href="<?php echo $ALWPDBF_vars->cssURL().'admin-styles.css';?>">
<h1><?php echo $options['options-header']; ?></h1>
<p><?php echo $options['options-manual']; ?></p>
<form action='' method='post' class='config'>
<label for='config[0]'><?php echo $options['options-label-seat']; ?></label><input type='text' name='config[0]' value='<?php echo $configArray[0];?>'  maxlength='4'><br/>
<label for='config[1]'><?php echo $options['options-label-admin-lang'];?></label><input type='text' name='config[1]' value='<?php echo $configArray[1];?>' maxlength='2'><br/>
<label for='config[2]'><?php echo $options['options-label-front-lang'];?></label><input type='text' name='config[2]' value='<?php echo $configArray[2];?>' maxlength='2'><br/>
<label for='config[3]'><?php echo $options['options-label-confirm-page'];?></label><input type='text' name='config[3]' value='<?php echo $configArray[3];?>'><br/>
<input type='submit' value='<?php echo $options['options-button'];?>'>
</form>