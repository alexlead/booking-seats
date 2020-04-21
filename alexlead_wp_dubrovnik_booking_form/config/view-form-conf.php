<?php 
/*
class prepare calendar form per month
*/
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

require_once $ALWPDBF_vars->classes().'class-mail-inc.php';
require_once $ALWPDBF_vars->classes().'class-files-inc.php';
require_once $ALWPDBF_vars->classes().'class-records.php';

/*
Function get class for preparing calendar form
@return calendar form
*/
function prepareCalendar(){
    global $ALWPDBF_vars;
    
//    $calendar = "<div id='bookingcalendar'>";
//    
//    $calendar .="<div id='calendBefore'></div>";
    $calendar .="<ul>";
    
    require_once $ALWPDBF_vars->classes().'class-calendar.php';
    $calMonth = date('n');
    $calYear = date('Y');
    $cal = new ALWPDBF_CalendarForm();
    
    for ($i=0;$i<3;$i++){
    $month = $cal->get($calMonth, $calYear);
    
    $calendar .= "<li>".$month."</li>";
    $calMonth++;
    if ($calMonth>12){
        $calMonth -=12;
        $calYear++;
    }
    }
     
    $calendar .= "</ul>";
//    $calendar .="<div id='calendAfter'></div>";
//    $calendar .= "</div>";
    
    return $calendar;
}

/*
function get intervals and seats from class
@return html + js
*/
function prepareIntervals(){
    global $ALWPDBF_vars;
    $intervalList = "";
    require_once $ALWPDBF_vars->classes().'class-intervals.php';
    $getList = new ALWPDBF_Interval_forms();
    
    $intervalList .="<div id='allIntevals'>";
    $intervalList .= $getList->get(date("Ymd"));
    $intervalList .= "</div>";
    
    return $intervalList;
}

/*
function answer for ajax request, get data from class 
@return html + js
*/
function ajaxIntervalsGet(){
    global $ALWPDBF_vars;
    require_once $ALWPDBF_vars->classes().'class-intervals.php';
    $getList = new ALWPDBF_Interval_forms();
    
    $intervalList = $getList->get($_POST['selecteddate']);
    
    echo $intervalList;
     exit;
    
}

/*
getting class contact form
@return html contact form
*/
function prepareContactForm(){
    global $ALWPDBF_vars;
        require_once $ALWPDBF_vars->frontEnd().'contact-form.php';    
}


/*
prepare whole form for 
@return constructor
*/
function prepareForm(){
    global $ALWPDBF_vars;
        require_once $ALWPDBF_vars->frontEnd().'bookingform.php';  
}
 
/*
send all $_POST to Class Ajax Save
Getting answer and send it to Ajax
@return string
*/
function ajaxSaveBookingForm(){
    global $ALWPDBF_vars;
    
    require_once $ALWPDBF_vars->classes().'class-ajax-save.php';
    $saveBooking = new ALWPDBF_Ajax_save();  
    $answer = $saveBooking->get();
    
  echo $answer;
    
    exit;
}


function confirmBooking(){
    global $ALWPDBF_vars;
    
     $bookingOrdersUpdate = new ALWPDBF_records();
    
    if($_GET['act']=='confirm'){
        $bookingOrdersUpdate->updateRecordsBySpecialKeyAndDate($_GET['id'], $_GET['date'], $_GET['specialKey']);
    }
    
    if($_GET['act']=='delete'){
        $bookingOrdersUpdate->deleteRecordsBySpecialKeyAndDate($_GET['id'], $_GET['date'], $_GET['specialKey']);
    }
    
    require_once $ALWPDBF_vars->frontEnd().'confirmation.php';    
}


/*
loading lang files
*/
require_once $ALWPDBF_vars->lang()."lang-front-en.php";
if ($configArray[1]<>""&&file_exists($ALWPDBF_vars->lang()."lang-front-".$currentAdminLang.".php")){
    require_once $ALWPDBF_vars->lang()."lang-front-".$currentAdminLang.".php";
}

/*
WP hooks for ajax requests - getting intervals
*/
add_action('wp_ajax_alwpgetIntervals', 'ajaxIntervalsGet'); //работает для авторизованных пользователей
add_action('wp_ajax_nopriv_alwpgetIntervals', 'ajaxIntervalsGet'); //работает для неавторизованных

add_action('wp_ajax_alwpsaveBooking', 'ajaxSaveBookingForm'); //работает для авторизованных пользователей
add_action('wp_ajax_nopriv_alwpsaveBooking', 'ajaxSaveBookingForm'); //работает для неавторизованных

/*
WP hook for setting form on page
*/
add_shortcode('booking_calendar', 'prepareForm');

add_shortcode('booking_confimation_page', 'confirmBooking');