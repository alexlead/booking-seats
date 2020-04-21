<?php
if (!defined('ABSPATH')) exit;

/*
mail functions
*/

require_once $ALWPDBF_vars->classes().'class-files-inc.php';
require_once $ALWPDBF_vars->classes().'class-intervals-inc.php';
require_once $ALWPDBF_vars->classes().'class-records.php';


class ALWPDBF_mail extends ALWPDBF_files {
   
    /*
    checking if e-mail is correct
    @param string
    @return boolean
    */
    public function isEmail($address){
        
        if(strlen($address)>5&&(preg_match('/^(([^<>()[\]\\.,;:\s@"\']+(\.[^<>()[\]\\.,;:\s@"\']+)*)|("[^"\']+"))@((\[\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}\])|(([a-zA-Z\d\-]+\.)+[a-zA-Z]{2,}))$/', $address))) {
            return true;
        }
        return false;
    }
    
    
    /*
    prepare letter text for sending e-mail
    @param Array
    */
    public function sendLeterToCustomer($data){
        global $configArray;
        global $ALWPDBF_vars;
        
        $keyArray = array ("[booking_date]", "[booking_time]", "[booking_qty]", "[booking_key_confirm]", "[booking_key_delete]", "[booking_mail_logo]", "[booking_key_payment]" );
        
        
        $dataFromDB = new ALWPDBF_records();
        
        $url = str_replace(array("\r","\n"),"",$configArray[3]); 
        
        $valueArray = array ($data["date"], $data["intTime"], $data["seats_qty"]);
        $valueArray[] = $url."?id=".$data["id"]."&specialKey=".$data["specialKey"]."&date=".$data["date"]."&act=confirm";
        $valueArray[] = $url."?id=".$data["id"]."&specialKey=".$data["specialKey"]."&date=".$data["date"]."&act=delete";
        $valueArray[] = $ALWPDBF_vars->logoURL();
        $valueArray[] = $configArray[3]."?id=".$data["id"]."&specialKey=".$data["specialKey"]."&date=".$data["date"]."&act=payment";
        
        $text = $this->getData();
        
        $subject = $text[0];
        $letter = '';
        for($i = 1; $i < count($text); $i++){
            $letter .= $text[$i];
        }
        
        $subject = str_replace($keyArray, $valueArray, $subject);
        $letter = str_replace($keyArray, $valueArray, $letter);

        $header[] = 'content-type: text/html';
        $header[] = "From:  trip-booking < trip-booking@".$_SERVER['SERVER_NAME'].">\r\n";

        wp_mail( $data["contact_email"], $subject, $letter, $header);   
    }    
}