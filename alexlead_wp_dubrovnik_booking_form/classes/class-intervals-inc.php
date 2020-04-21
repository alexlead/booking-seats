<?php
if (!defined('ABSPATH')) exit;

/*
work with intervals in admin part
*/

require_once $ALWPDBF_vars->classes().'class-db-tables.php';

class ALWPDBF_intervals extends ALWPDBF_DB_tables{

    /*
    get table name for outclass using
    @return string
    */
    public function getTable(){
        return $this->table;        
    }
    
    /*
    get interval title by id
    @param id (int)
    @todo getting info from DB
    @return string
    */
    public function getTitle($id){
        global $wpdb;
        $interval = $wpdb->get_row("SELECT * FROM ".$this->table." WHERE id=".$id);
        return $interval->title;
    }
    
    /*
    getting list of intervals
    @return Array
    */
    public function getAllIntervals(){
        global $wpdb;
        
        $getIntervals = "SELECT * FROM ".$this->table." ORDER BY timeStart";
        $res = $wpdb->get_results($getIntervals);
        $i = 0;
        foreach ($res as $row){
            $data['id'][$i] = $row->id;
            $data['timeStart'][$i] = $row->timeStart;
            $data['title'][$i] = $row->title;
            $i++;
        }
        return $data;
    }
    
    /*
    getting list of intervals
    @return Array
    */
    public function getIntervalsBookedSeats($date){
        global $wpdb;
        global $configArray;
        
        $allIntervals = $this->getAllIntervals();
        
        foreach ($allIntervals['id'] as $key=>$value){
            $getSeats = "SELECT sum(seats_qty) FROM ".$this->table1." WHERE inteval_id = ".$value." AND date = ".$date;
            $allIntervals['freeSeats'][$key] = $configArray[0] - $wpdb->get_var($getSeats);
        }
        return $allIntervals;
    }
    
    /*
    update all Intervals
    @param Array
    @todo update DB
    */
    public function updateAllIntervals($timeStartList, $titleList){
        global $wpdb;
        
        foreach($timeStartList as $key => $value){
            if (preg_match("/[0-2][0-9]:[0-5][0-9]/", $value)&&strlen($value)<=8&&strlen($value)>=5){
            $wpdb->update( $this->table,
             array('timeStart' => $value,
                 'title' => $titleList[$key]),
            array('id' => $key)
            );
            }
        } 
    }
    
    /*
    Remove selected Intervals
    @param Array
    @todo remove from DB
    */
    public function removeIntervals($removeList){
        global $wpdb;
        
        foreach($removeList as $key => $value){
            if ($value){
            $wpdb->delete( $this->table,
            array( 'id' => $key )
            );
           }
            }
        }
    
    /*
    add new line of intervals to DB
    @param strings 
    */
    public function addToDB($timeStart, $title){
         global $wpdb;
         $user_ID = get_current_user_id();
        
        $wpdb->insert( $this->table,
                      array (
                        'id' => NULL,
                        'user_id' => $user_ID,
                        'timeStart' => $timeStart,
                        'title' => $title,
                        'check' => 0  
                        )
                      );
    }
}