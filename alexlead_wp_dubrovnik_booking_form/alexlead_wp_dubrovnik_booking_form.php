<?php
/*
Plugin Name: alexlead-wp-dubrovnik-booking-form 
Plugin URI: https://codepen.io/alexlead/
Description: Booking form pugin. The plugin build booking form on front page. Please set short code [booking_calendar] on page for booking seats. For confirming|deleting bookings please make page with short code [booking_confimation_page]. Register confirming page on options page. Please check all data on the options page. Set total seats quantity (more than zero, less than 10000). Function for auto sending reminding letter "ALWPDBF_daily_reminder" - register it in wp-cron.
Version: 1.0.1
Author: Alex Lead
Author URI: https://codepen.io/alexlead/
License: Special issue by customer order

*/

//reject direct using
if (!defined('ABSPATH')) exit;

//define base paths

if (!defined('ALWPDBF_PLUGIN_DIR')) {
    define('ALWPDBF_PLUGIN_DIR', untrailingslashit(dirname(__FILE__)));
}
if (!defined('ALWPDBF_PLUGIN_URL')) {
    define('ALWPDBF_PLUGIN_URL', untrailingslashit(plugins_url('', __FILE__)));
}

//for test only
//define('AL_WP_BOOKING_FORM_BASEURL','http://test1.ru/wordpress/wp-content/plugins/admin/');

/* -- load installation file and start instalation procedure -- */
function installing()
{
    require_once ALWPDBF_PLUGIN_DIR . '/install/install.php';
    install_database();
}

/* -- load uninstalling file and start uninstalling procedure -- */
function uninstalling()
{
    require_once ALWPDBF_PLUGIN_DIR . '/install/uninstall.php';
    uninstall_database();
}



register_activation_hook(__FILE__, 'installing');
register_deactivation_hook(__FILE__, 'uninstalling');

function sendMails()
{
    echo 'something';
}

add_action('ALWPDBF_wp_reminder', 'sendMails');



/* --- New configuration --- */

require_once untrailingslashit(dirname(__FILE__)) . '/config/paths-variables.php';
$ALWPDBF_vars = new ALWPDBF_vars(ALWPDBF_PLUGIN_DIR, ALWPDBF_PLUGIN_URL);


require_once $ALWPDBF_vars->config() . 'admin-tools.php';

require_once $ALWPDBF_vars->config() . 'view-form-conf.php';

/*  --  Configuration load  --   */
require_once $ALWPDBF_vars->classes() . 'class-files-inc.php';
$configGet = new ALWPDBF_files($ALWPDBF_vars->basicConfig());
$configArray = $configGet->getData();
$totalSeatsOnBoat = $configArray[0];
$currentAdminLang = $configArray[1];
$currentFrontLang = $configArray[2];
