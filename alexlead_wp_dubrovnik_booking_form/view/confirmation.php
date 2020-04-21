<?php
/*
class define admin page for making letter to customer
*/
if (!defined('ABSPATH')) exit;

global $confirm;
?>

<h1><?php echo $confirm[$_GET['act']]['header'];?></h1>
<p><?php echo $confirm[$_GET['act']]['text'];?></p>