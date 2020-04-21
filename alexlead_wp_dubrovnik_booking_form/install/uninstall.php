<?php
/*
class define admin page for making letter to customer
*/
if (!defined('ABSPATH')) exit;

function uninstall_database(){
		global $wpdb;
		/* Create */
		$tableDropQuery1 = "DROP TABLE ".$wpdb->prefix."alexlead_wp_booking_intervals";
		$wpdb->query($tableDropQuery1);
    
    $tableDropQuery = "DROP TABLE ".$wpdb->prefix."alexlead_wp_bookings";
		$wpdb->query($tableDropQuery);
    
    wp_clear_scheduled_hook( 'ALWPDBF_daily_reminder');
}