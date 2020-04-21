<?php 
/*
class prepare calendar form per month
*/
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class ALWPDBF_CalendarForm {

    
    public function get($month, $year){
        return $this->calendarMonthForm($month , $year );
    }
    
    private function calendarMonthForm($month , $year ){
        
        global $monthNames;
        global $weekDayNames;
        
        $monthFirstWeekDay = date('N', mktime(0, 0, 0, $month, 1, $year));
        $monthTotalDays = date('t', mktime(0, 0, 0, $month, 1, $year));
	    $currentDate = date('d');
        $currentMonth = date('n');
        
if (strlen($month)>1){
    $ajaxMonth = $month;
    } else {
        $ajaxMonth = "0".$month;
    }
        
        $monthCalendarForm ='<div class= "month">';
        $monthCalendarForm .= "<p>".$monthNames[$month]."</p>";
        $monthCalendarForm .= '<table><thead><tr>';
        for($i=0; $i<7; $i++){
        $monthCalendarForm .= '<td>'.$weekDayNames[$i].'</td>';
        }
    $monthCalendarForm .= '</tr></thead>';
        
        $monthCalendarForm .= '<tbody><tr>';
        
        // first week

for ($i=1; $i < $monthFirstWeekDay; $i++){
    $monthCalendarForm .= '<td class="empty"></td>';
}        
        
for ($i=1; $i <= $monthTotalDays; $i++){
    
        $monthCalendarForm .= '<td ';
$di = $i;
    if (strlen($di)<2){
        $di = "0".$di;
    }
        
    if ($month == $currentMonth){
        if($i == $currentDate){
    $monthCalendarForm .= 'id="today" class="chooseenable" data-ajax="'.$year.$ajaxMonth.$di.'" data-date="'.$i.' '.$monthNames[$month].' '.$year.'" ';    
    }}
    if(($month==$currentMonth&&$i>$currentDate)||$month<>$currentMonth){
            $monthCalendarForm .= 'class="chooseenable" data-ajax="'.$year.$ajaxMonth.$di.'" data-date="'.$i.' '.$monthNames[$month].' '.$year.'" ';
        }
    

    $monthCalendarForm .= '><span>'.$i.'</span></td>';
    if (($i+$monthFirstWeekDay-1) % 7 == 0){
        $monthCalendarForm .= '</tr><tr>';
    }
};
        
        $monthCalendarForm .= '</tr></tbody></table>';
        $monthCalendarForm .= '</div>';
        
    return $monthCalendarForm;
    }
}