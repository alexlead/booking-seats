<?php
/*
class define admin page for making letter to customer
*/
if (!defined('ABSPATH')) exit;

 global $mail;
?>

<link rel="stylesheet" href="<?php echo $ALWPDBF_vars->cssURL().'admin-styles.css';?>">  
<h1><?php echo $mail['admin-letter-header'];?></h1>
<p><?php echo $mail['admin-letter-manual'];?></p>
<form action='' method='post' class='letter'>
    <label for='letter[0]'><?php echo $mail['admin-letter-subject'];?></label><br/>
    <input type='text' name='letter[0]' value='<?php echo $letterData[0];?>'><br/>
<label for='letter[1]'><?php echo $mail['admin-letter-text'];?></label><br/>

<?php 
    for($i=1; $i<count($letterData);$i++)
        $content .= $letterData[$i];
    
    wp_editor($content, 'letter[1]', array(
	'wpautop' => 1,
	'media_buttons' => 1,
	'textarea_name' => 'letter[1]', //нужно указывать!
	'textarea_rows' => 20,
	'tabindex'      => null,
	'editor_css'    => '',
	'editor_class'  => '',
	'teeny'         => 0,
	'dfw'           => 0,
	'tinymce'       => 1,
	'quicktags'     => 1,
	'drag_drop_upload' => false
) );
?>
<input type='submit' value='<?php echo $mail['admin-letter-button'];?>'>
</form>