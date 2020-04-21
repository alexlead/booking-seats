<?php
/*
Basic Class for setting tables names 
*/
if (!defined('ABSPATH')) exit;

class ALWPDBF_DB_tables {
 
    public $table;
    public $table1;
    
    public function __construct(){
        global $wpdb;        
        $this->table = $wpdb->prefix."alexlead_wp_booking_intervals";
        $this->table1 = $wpdb->prefix."alexlead_wp_bookings";
    }
}