<?php
/*
class define admin page for making letter to customer
*/
if (!defined('ABSPATH')) exit;

        global $mailsList;
?>
<link rel="stylesheet" href="<?php echo $ALWPDBF_vars->cssURL().'admin-styles.css';?>">

<h1><?php echo $mailsList['admin-letter-header'];?></h1>
<p><?php echo $mailsList['admin-letter-manual'];?></p>
<form action='' method='post' class='adminList'>
<textarea name='adminmails[0]'>
<?php 
    foreach($adminMail as $value)
    echo $value;?>
</textarea><br/>
<input type='submit' value='<?php echo $mailsList['admin-letter-button'];?>'>
</form>