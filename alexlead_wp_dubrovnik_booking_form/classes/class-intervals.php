    <?php 
/*
class prepare intervals form for front-end
*/
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class ALWPDBF_Interval_forms {
    
    private $f = ALWPDBF_PLUGIN_URL.'/add/settings.ini'; // file for data
    private $f1 = ALWPDBF_PLUGIN_DIR.'/add/settings.ini';
    
    public function get($forDate=20001010){
        return $this->intList($forDate);
    }
    
    private function intList($forDate){
        
        global $wpdb;
        global $ALWPDBF_vars;
        
        $seatsQTY = $this->getTextFromFile();
        
        $disableIntList = "";
        
        $disableIntList.= "<div id='interv'>";
        
        $getTimeIntervals = "SELECT id, timeStart, title FROM ".$wpdb->prefix."alexlead_wp_booking_intervals ORDER BY timeStart";
        $res = $wpdb->get_results($getTimeIntervals);
        
        foreach ($res as $row){
            $classForInt = "intDisable";
            $bookedSeats = 0;
            
            if ($forDate >= date("Ymd")){
            $getSeats = "SELECT sum(seats_qty) FROM ".$wpdb->prefix."alexlead_wp_bookings WHERE inteval_id = ".$row->id." AND date = ".$forDate;
                $bookedSeats = $wpdb->get_var($getSeats);
            }
            
            $totalSeats = $seatsQTY - $bookedSeats; 
            
            if ($forDate >= date("Ymd")&&$totalSeats>0){
                $classForInt = "intEnable ";
                if($totalSeats==$seatsQTY){
                    $classForInt .= "intGreen";
                } else if(($totalSeats<=$seatsQTY/2)&&($totalSeats>=0)){
                    $classForInt .= "intRed";
                }else {
                    $classForInt .= "intYellow";
                }
            }
            
            $disableIntList .="<div class='intervals ".$classForInt."' data-interval='".$row->id."' data-booked-seats='".$bookedSeats."' data-free-seats='".$totalSeats."' data-name='".$row->title."'><p><big>Glassboat</big><br/>".$row->title."</p><span title='avialable seats for booking'>".$totalSeats."</span></div>";
        }
        
        $disableIntList.= "</div>";
        
        $disableIntList.= "<div id='seats'>";
            for($i=0; $i<$seatsQTY; $i++){
                $disableIntList.="<div class='seat'></div>";
            }     
        $disableIntList.= "</div>";
        
   $disableIntList.="<script src='".$ALWPDBF_vars->jsURL()."seats.js'></script>";
        
    return $disableIntList;
    }
    
/*
    return text from file
    */
       private function getTextFromFile(){
        
        if (file_exists($this->f1)){
            $letterText = file($this->f);
            return $letterText[0];
        }
        return false;
    }   
}