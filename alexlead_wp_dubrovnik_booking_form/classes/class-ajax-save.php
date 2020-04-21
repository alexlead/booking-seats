<?php 
/*
class prepare contact form
*/
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

require_once $ALWPDBF_vars->classes().'class-mail-inc.php';
require_once $ALWPDBF_vars->classes().'class-files-inc.php';
require_once $ALWPDBF_vars->classes().'class-records.php';

class ALWPDBF_Ajax_save {
    
    public function get(){
        global $formSaveMess;
        global $wpdb;
        
        $answer ='';
        $postMistakes = false;
        
        if (!$this->dateChecking()||!$this->intervalChecking()||!$this->seatsChecking()){
            $answer .= $formSaveMess['mistake-data'];
            $answer .= "\n\r";
            $postMistakes = true;
        }
        
        if($this->phoneCheckingReuired()&&(strlen($_POST['order'][3])<6)){
            $answer .= $formSaveMess['mistake-phone-required'];
            $answer .= "\n\r";
            $postMistakes = true;
        }

        if ($this->phoneChecking()){
            $answer .= $formSaveMess['mistake-phone'];
            $answer .= "\n\r";
            $postMistakes = true;
        }
        
        if($this->mailCheckingReuired()&&strlen($_POST['order'][4])<6){
            $answer .= $formSaveMess['mistake-mail-required'];
            $answer .= "\n\r";
            $postMistakes = true;
        }

        
        if (strlen($_POST['order'][4])<=6&&(preg_match('/^(([^<>()[\]\\.,;:\s@"\']+(\.[^<>()[\]\\.,;:\s@"\']+)*)|("[^"\']+"))@((\[\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}\])|(([a-zA-Z\d\-]+\.)+[a-zA-Z]{2,}))$/', $_POST['order'][4]))){
            $answer .= $formSaveMess['mistake-mail'];
            $answer .= "\n\r";
            $postMistakes = true;
        }
        
        if(!$postMistakes){
            $specKey = $this->specStringGenerator(10);
            $this->saveDB($specKey);
            
            for ($i=0; $i<4; $i++){
                $j[$i] = substr($_POST['order'][0], $i*2, 2);
            }
            
            $bookDate = $j[3]."-".$j[2]."-".$j[0].$j[1];
            $seats = $_POST['order'][2];
            $mailCustomer = $_POST['order'][4];
            $interval = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."alexlead_wp_booking_intervals WHERE id=".$_POST['order'][1]);
            $int = $interval->title;
            $this->mailToCustomer($mailCustomer, $specKey, $bookDate, $int, $seats);
            $this->adminMailsList($specKey, $bookDate, $int, $seats);
            $answer = "ok";
        }
        
        return $answer;
    }
    
    /*
    function cheking Date for interval requirements and correct date format
    @attr  $_POST
    @return boolean
    */
    private function dateChecking(){
        
        if (isset($_POST['order'][0])&&strlen($_POST['order'][0])==8&&preg_match("/[2][0][1-5][0-9][0-1][0-9][0-3][0-9]/", $_POST['order'][0])){
            if ($_POST['order'][0]>=date('Ymd')&&$_POST['order'][0]<date('Ymd', strtotime("+93 day"))){
                return true;
            }
        }
    return false;
    }
    
    /*
    function cheking Interval isset
    @attr  $_POST
    @return boolean
    */
    private function intervalChecking(){
        
        if (isset($_POST['order'][1])&&$_POST['order'][1]>0){
            global $wpdb;
            $getInterval = "SELECT count(*) FROM ".$wpdb->prefix."alexlead_wp_booking_intervals WHERE id = ".$_POST['order'][1];
                $hasInterval = $wpdb->get_var($getInterval);
            if($hasInterval>0){
                    return true;
            }
        }
    return false;
    }
    
    /*
    function cheking Seats isset
    @attr  $_POST
    @return boolean
    */
    private function seatsChecking(){
        global $wpdb;
        global $totalSeatsOnBoat;
        
        if (isset($_POST['order'][2])&&$_POST['order'][2]>0){
            
            $getSeats = "SELECT sum(seats_qty) FROM ".$wpdb->prefix."alexlead_wp_bookings WHERE inteval_id = ".$_POST['order'][1]." AND date = ".$_POST['order'][0];
            $bookedSeats = $wpdb->get_var($getSeats);
            
            if (($totalSeatsOnBoat - $bookedSeats - $_POST['order'][2])>=0){
                return true;    
            }            
        }
    return false;
    }
    
    /*
    function cheking phone required 
    @attr  $_POST
    @return boolean
    */
    private function phoneCheckingReuired(){
        if($_POST['order'][0]==date('Ymd')||$_POST['order'][0]==date('Ymd', strtotime("+1 day"))){
            return true;
        }
    return false;
    }

    /*
    function cheking phone correct 
    @attr  $_POST
    @return boolean
    */
    private function phoneChecking(){
            if (strlen($_POST['order'][3])>7||strlen($_POST['order'][3])<38){
                return false;
            }
    return true;
    }
    
    /*
    function cheking mail required 
    @attr  $_POST
    @return boolean
    */
    private function mailCheckingReuired(){
        if($_POST['order'][0]>date('Ymd', strtotime("+1 day"))){
            return true;
        }
    return false;
    }
    
    
    private function specStringGenerator($strinLenth = 8){
        $letterForUse = "ASDFGHJKLZXCVBNMPOIUYTREWQ1234567890_vncmxbzlaksjdhfgqpwieuryt";
        $specString = "";
            for($i=0; $i<$strinLenth; $i++){
                $specString .= $letterForUse[rand(0,strlen($letterForUse)-1)];
            }

        return $specString;
    }
    
    /*
    function saving data to DB 
    @attr  $_POST
    */
    private function saveDB($bookKey){

            global $wpdb;
        

        $wpdb->insert( $wpdb->prefix."alexlead_wp_bookings",
           array(
            'id' => NULL,
            'date'=> $_POST['order'][0],
            'inteval_id'=> $_POST['order'][1],
            'seats_qty'=> $_POST['order'][2],
            'contact_phone' => $_POST['order'][3],
            'contact_email' => $_POST['order'][4],
            'comment' => '',
            'specialKey'=>$bookKey,
            'paidIndicator' => 0
            )
        );
    }
    
    /*
    function prepare current mail to customer and to administrators 
    @attr  $_POST, text letter file, text emails` file 
    */
    private function mailToCustomer($mail, $bookKey, $bookDate, $interv, $seats){
        
        global $ALWPDBF_vars;
                
        $data["date"] = $bookDate; 
        $data["intTime"] = $interv; 
        $data["seats_qty"] = $seats;
        $data["specialKey"]=$bookKey;
        $data["contact_email"] = $mail;
        
        $gettingID = new ALWPDBF_records();
//        
//        $data["id"] = $gettingID->getRecordID($mail, $bookKey, $bookDate);
        
         global $wpdb;
        
        $row = $wpdb->get_row("SELECT * FROM ".$gettingID->table1." WHERE specialKey = ".$bookKey." AND contact_email=".$mail." AND date = ".$bookDate." LIMIT 1");
        $data["id"] = $row->id;
        
        $sendMail = new ALWPDBF_mail($ALWPDBF_vars->mailToCustomer());
        $sendMail->sendLeterToCustomer($data);
    }
    
  /*
    function getting mail list of administrators 
    @attr  $_POST, text letter file, text emails` file 
    */
    private function adminMailsList($bookKey, $bookDate, $interv, $seats){
        global $ALWPDBF_vars;
        
        $data["date"] = $bookDate; 
        $data["intTime"] = $interv; 
        $data["seats_qty"] = $seats;
        $data["specialKey"]=$bookKey;
        
        $data["contact_email"] = '';

        $getAdminMailsList = new ALWPDBF_files($ALWPDBF_vars->managerEmailsList());
        $adminMails = $getAdminMailsList->getData();
        
        for($i=0; $i<count($adminMails); $i++){
            if (strlen($adminMails[$i])>4){
                
                    $data["contact_email"] .= $adminMails[$i].", ";
                
            }
        }
        
        $sendMail = new ALWPDBF_mail($ALWPDBF_vars->mailToAdmin());
        $sendMail->sendLeterToCustomer($data);
    }
    
}