<?php
if (!defined('ABSPATH')) exit;

/*
set variables and paths
*/

class ALWPDBF_vars {
    
    /* basic paths of the plugin */
        private $baseDir;
        private $baseURL;

    public function __construct($d, $u){
        $this->baseDir = $d;
        $this->baseURL = $u;
    }
    /* paths for other classes 
    @return paths
    */
        public function getDir(){        
            return $this->baseDir;
        }

        public function classes(){        
            return $this->baseDir."/classes/";
        }

        public function vendor_mail(){        
            return $this->baseDir."/classes/mail/";
        }
    
        public function config(){        
            return $this->baseDir."/config/";
        }

        public function backEnd(){
            return $this->baseDir."/view-admin/";
        }

        public function lang(){
            return $this->baseDir."/lang/";
        }

        public function frontEnd(){
            return $this->baseDir."/view/";
        }

    /* paths for other classes 
    @return paths
    */
        public function getURL(){
          return $this->baseURL;  
        }
    
        public function viewURL(){
          return $this->baseURL."/view-front-end/";  
        }
    
        public function cssURL(){
          return $this->baseURL."/css/";  
        } 

        public function jsURL(){
          return $this->baseURL."/js/";  
        } 
    
        public function logoURL(){
          return $this->baseURL."/add/logo.jpg";  
        }
        
        public function imgURL(){
          return $this->baseURL."/img/";  
        }
    
    /* config files 
    @return files paths
    */
        public function basicConfig(){
            return $this->baseDir.'/add/settings.ini';
        }
    
        public function mailToCustomer(){
            return $this->baseDir.'/add/customer-letter.tpl';
        }
    
        public function reminderToCustomer(){
            return $this->baseDir.'/add/customer-letter-reminder.tpl';
        }
    
        public function mailToAdmin(){
            return $this->baseDir.'/add/admin-letter.tpl';
        }
    
        public function managerEmailsList(){
            return $this->baseDir.'/add/bookers-mails.txt';
        }
    
    /* tables names
    @return tables 
    */
        public function tableInterval(){
            global $wpdb;
            return $wpdb->prefix."alexlead_wp_booking_intervals";
        }
    
        public function tableBookings(){
            global $wpdb;
            return $wpdb->prefix."alexlead_wp_bookings";
        }
}