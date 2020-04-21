<?php
/*
Basic Class for administrate customers bookings 
*/
if (!defined('ABSPATH')) exit;

require_once $ALWPDBF_vars->classes().'class-db-tables.php';

class ALWPDBF_records extends ALWPDBF_DB_tables {
     
    /*
    get entries from booking table and return array
    @param Date, Date
    @return Array
    */
    public function getAllDBRecords($beginDate = 0, $finishDate = 0){
        global $wpdb;
        
        if ($beginDate<1){
            $beginDate = date('Ymd');
        }
        
        $getBookingEntries = "SELECT * , ";
        $getBookingEntries .= $this->table.".timeStart as intTime";
        $getBookingEntries .= "  FROM ".$this->table.", ".$this->table1." WHERE ".$this->table1.".inteval_id =".$this->table.".id AND date >=".$beginDate;
        
        if (isset($finishDate)&&preg_match("/[2][0][1-5][0-9][0-1][0-9][0-3][0-9]/", $finishDate)&&$finishDate>=$beginDate)
        {
          $getBookingEntries .= " AND date <=".$_POST['finishDate'];  
        }
        
        $getBookingEntries .= " ORDER BY date, intTime";
        $res = $wpdb->get_results($getBookingEntries);
        
        $i=0;
        foreach($res as $row){
            
            $data['id'][$i] = $row->id;
            $data['date'][$i] = $row->date;
            $data['inteval_id'][$i] = $row->inteval_id;
            $data['seats_qty'][$i] = $row->seats_qty;
            $data['contact_phone'][$i] = $row->contact_phone;
            $data['contact_email'][$i] = $row->contact_email;
            $data['comment'][$i] = $row->comment;
            $data['specialKey'][$i] = $row->specialKey;
            $data['paidIndicator'][$i] = $row->paidIndicator;
            $data['confirmedIndicator'][$i] = $row->confirmedIndicator;
            $data['intTime'][$i] = $row->intTime;
            $i++;
        }
       return $data;
    }
    
       /*
    get entries from booking table for next day only and return array
    @return Array
    */
     public function getDBRecordsForMails(){
        global $wpdb;
        
        $getBookingEntries = "SELECT * , ";
        $getBookingEntries .= $this->table.".timeStart as intTime";
        $getBookingEntries .= "  FROM ".$this->table.", ".$this->table1." WHERE ".$this->table1.".inteval_id =".$this->table.".id AND date =".date('Ymd', strtotime("+1 day"));
        

        $res = $wpdb->get_results($getBookingEntries);
        
        $i=0;
        foreach($res as $row){
            
            $data['id'][$i] = $row->id;
            $data['date'][$i] = $row->date;
            $data['inteval_id'][$i] = $row->inteval_id;
            $data['seats_qty'][$i] = $row->seats_qty;
            $data['contact_phone'][$i] = $row->contact_phone;
            $data['contact_email'][$i] = $row->contact_email;
            $data['comment'][$i] = $row->comment;
            $data['specialKey'][$i] = $row->specialKey;
            $data['paidIndicator'][$i] = $row->paidIndicator;
            $data['confirmedIndicator'][$i] = $row->confirmedIndicator;
            $data['intTime'][$i] = $row->intTime;
            $i++;
        }
       return $data;
    }
    
    /*
    delete Records from booking table 
    @param array
    @todo delete DB records
    */
    public function deleteRecordsByID($removeList){
        global $wpdb;
        
        foreach($removeList as $key => $value){
            if ($value){
            $wpdb->delete( $this->table1,
            array( 'id' => $key )
            );
           }
            }
    }
    
       /*
    delete Records from booking table 
    @param array
    @todo delete DB records
    @return boolean
    */
    public function deleteRecordsBySpecialKeyAndDate($checkID='', $checkDate, $checkKey){
        global $wpdb;
        
        if (!$checkID){
        list($day, $month, $year) = split('[/.-]', $checkDate);
        } else {
         list($year, $month, $day) = split('[/.-]', $checkDate);
        }
        
        $deleteDate = $year.$month.$day;
        
        if ($deleteDate>=date("Ymd")){
        $wpdb->delete( $this->table1, array( 'date' => $deleteDate, 'specialKey' => $checkKey ) ) ;
        }
}

/*
    update record 
    @param Array
    @todo update DB
    */
    public function updateRecordsBySpecialKeyAndDate($checkID='', $checkDate, $checkKey){
        global $wpdb;
        
        if (!$checkID){
        list($day, $month, $year) = split('[/.-]', $checkDate);
        } else {
         list($year, $month, $day) = split('[/.-]', $checkDate);
        }
        
        $updateDate = $year.$month.$day;
        
        if ($updateDate>=date("Ymd")){
            
            $wpdb->update( $this->table1,
             array('confirmedIndicator' => '1'),
            array( 'date' => $updateDate, 
                  'specialKey' => $checkKey)
            );
        }
   }
    
    /*
    making random string
    @param Integer
    @return String
    */
    public function specStringGenerator($strinLenth = 8){
        $letterForUse = "ASDFGHJKLZXCVBNMPOIUYTREWQ1234567890_vncmxbzlaksjdhfgqpwieuryt";
        $specString = "";
            for($i=0; $i<$strinLenth; $i++){
                $specString .= $letterForUse[rand(0,strlen($letterForUse)-1)];
            }
        return $specString;
    }
    
    /*
    get row by id
    @param id (int)
    @todo getting info from DB
    @return array
    */
    public function getRecordID($mail, $bookKey, $bookDate){
        global $wpdb;
        
        $row = $wpdb->get_results("SELECT * FROM ".$this->table1." WHERE specialKey = ".$bookKey." AND contact_email=".$mail." AND date = ".$bookDate." LIMIT 1");
        
        return $row->id;
    }   
}