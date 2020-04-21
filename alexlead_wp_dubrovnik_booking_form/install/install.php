<?php
/*
Installation of the plugin: DB confugure, basic settings
*/
if (!defined('ABSPATH')) exit;

function install_database(){
		global $wpdb;
		/* Create */
		$tableCreateQuery1 = "CREATE TABLE IF NOT EXISTS `".$wpdb->prefix."alexlead_wp_booking_intervals` (
			`id` INT NOT NULL AUTO_INCREMENT,
			`user_id` INT NOT NULL,
            `timeStart` TIME NOT NULL,
			`title` VARCHAR(128) NOT NULL,
            `check` TINYINT NOT NULL,
			PRIMARY KEY (`id`)
		  ) DEFAULT CHARSET=utf8;";
		$wpdb->query($tableCreateQuery1);

		$tableCreateQuery = "CREATE TABLE IF NOT EXISTS `".$wpdb->prefix."alexlead_wp_bookings` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`date` DATE NOT NULL,
            `inteval_id` INT NOT NULL,
            `seats_qty` INT NOT NULL,
            `contact_phone` VARCHAR(20),
            `contact_email` VARCHAR(128),
            `comment` VARCHAR(250),
            `specialKey` VARCHAR(15) NOT NULL,
            `paidIndicator` TINYINT NOT NULL DEFAULT '0',
            `confirmedIndicator` TINYINT NOT NULL DEFAULT '0',
			PRIMARY KEY (`id`)
		  ) DEFAULT CHARSET=utf8;";
		$wpdb->query($tableCreateQuery);
    
    
    wp_clear_scheduled_hook( 'ALWPDBF_daily_reminder');
    wp_schedule_event( time(), 'daily', 'ALWPDBF_daily_reminder');
}