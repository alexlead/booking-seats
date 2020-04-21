<?php
/*
admin page initialisation
*/
if (!defined('ABSPATH')) exit;

require_once $ALWPDBF_vars->classes().'class-records.php';
require_once $ALWPDBF_vars->classes().'class-mail-inc.php';
require_once $ALWPDBF_vars->classes().'class-files-inc.php';
require_once $ALWPDBF_vars->classes().'class-intervals-inc.php';

/*
adding menu to admin page 
*/
function adminMenuConfigure() {
    global $menuNames;

    add_menu_page( $menuNames['general'], $menuNames['general'], 'manage_options', 'alexlead_wp_dubrovnik_booking_form', 'selectPage');
        add_submenu_page('alexlead_wp_dubrovnik_booking_form', $menuNames['intervals'], $menuNames['intervals'], 'manage_options', 'alexlead_wp_dubrovnik_booking_form_intervals', 'selectPage');
        add_submenu_page('alexlead_wp_dubrovnik_booking_form', $menuNames['letter'], $menuNames['letter'], 'manage_options', 'alexlead_wp_dubrovnik_booking_form_letter', 'selectPage');
            add_submenu_page('alexlead_wp_dubrovnik_booking_form', $menuNames['letter-remind'], $menuNames['letter-remind'], 'manage_options', 'alexlead_wp_dubrovnik_booking_form_letter_remind', 'selectPage');
            add_submenu_page('alexlead_wp_dubrovnik_booking_form', $menuNames['letter-admin'], $menuNames['letter-admin'], 'manage_options', 'alexlead_wp_dubrovnik_booking_form_letter_admin', 'selectPage');
        add_submenu_page('alexlead_wp_dubrovnik_booking_form', $menuNames['bookers'], $menuNames['bookers'], 'manage_options', 'alexlead_wp_dubrovnik_booking_form_bookers', 'selectPage');
        add_submenu_page('alexlead_wp_dubrovnik_booking_form', $menuNames['option'], $menuNames['option'], 'manage_options', 'alexlead_wp_dubrovnik_booking_form_option', 'selectPage');
}

/*
getting class page 
*/
function selectPage(){
    global $ALWPDBF_vars;
    global $configGet;
    global $mail;
    
    switch($_GET['page']){
    case('alexlead_wp_dubrovnik_booking_form_option'):
            if ($_POST['config'][0]>0){$configGet->saveData($_POST['config']);}
            $configArray = $configGet->getData();
            require_once $ALWPDBF_vars->backEnd()."config.php";
        break;
    case('alexlead_wp_dubrovnik_booking_form_intervals'):
            require_once $ALWPDBF_vars->classes().'class-intervals-inc.php';
            $workTable = new ALWPDBF_intervals();
                if (isset($_POST['newIntTime'])&&preg_match("/[0-2][0-9]:[0-5][0-9]/", $_POST['newIntTime'])&&strlen($_POST['newIntTime'])==5){
                    $workTable->addToDB($_POST['newIntTime'], $_POST['newIntTitle']);
                }
                if (isset($_POST['intervalUpdate'])){
                     $workTable->updateAllIntervals($_POST['intTimeStart'], $_POST['intTitle']);
                     $workTable->removeIntervals($_POST['intDel']);
                 } 
            $res = $workTable->getAllIntervals();
            require_once $ALWPDBF_vars->backEnd()."booking-times.php";
        break;
    case('alexlead_wp_dubrovnik_booking_form_bookers'):
            $workingFile = new ALWPDBF_files($ALWPDBF_vars->managerEmailsList());
            if (strlen($_POST['adminmails'][0])>0){$workingFile->saveData($_POST['adminmails']);}
            $adminMail = $workingFile->getData();
            require_once $ALWPDBF_vars->backEnd()."booker-mails.php";
        break;
    case('alexlead_wp_dubrovnik_booking_form_letter'):
            $workingFile = new ALWPDBF_files($ALWPDBF_vars->mailToCustomer());
            if (strlen($_POST['letter'][1])>0){$workingFile->saveData($_POST['letter']);}
            $letterData = $workingFile->getData();
            require_once $ALWPDBF_vars->backEnd()."letter.php";
            
        break;

        case('alexlead_wp_dubrovnik_booking_form_letter_remind'):
            $workingFile = new ALWPDBF_files($ALWPDBF_vars->reminderToCustomer());
            if (strlen($_POST['letter'][1])>0){$workingFile->saveData($_POST['letter']);}
            $letterData = $workingFile->getData();
            $mail['admin-letter-header'] = $mail['admin-letter-header-remind'];
            require_once $ALWPDBF_vars->backEnd()."letter.php";
            
        break;
        case('alexlead_wp_dubrovnik_booking_form_letter_admin'):
            $workingFile = new ALWPDBF_files($ALWPDBF_vars->mailToAdmin());
            if (strlen($_POST['letter'][1])>0){$workingFile->saveData($_POST['letter']);}
            $letterData = $workingFile->getData();
            $mail['admin-letter-header'] = $mail['admin-letter-header-admin'];
            require_once $ALWPDBF_vars->backEnd()."letter.php";
        break;
    default:
            require_once $ALWPDBF_vars->classes().'class-records.php';
            $workTable = new ALWPDBF_records();
            
            if (isset($_POST['startDate'])&&preg_match("/[2][0][1-5][0-9][0-1][0-9][0-3][0-9]/", $_POST['startDate'])&&strlen($_POST['startDate'])==8) 
            {
                $filterBeginTime = $_POST['startDate'];
            }
            if (isset($_POST['finishDate'])&&preg_match("/[2][0][1-5][0-9][0-1][0-9][0-3][0-9]/", $_POST['finishDate'])&&strlen($_POST['finishDate'])==8&&$_POST['finishDate']>$filterBeginTime)
            {
                $filterFinishTime = $_POST['finishDate'];  
            }
            
            if ($_POST['bookingsDelete']){
                 $workTable->deleteRecordsByID($_POST['intDel']);
             }        
            $res = $workTable->getAllDBRecords($filterBeginTime, $filterFinishTime);
            
            require_once $ALWPDBF_vars->backEnd()."menu.php";
    }
}

/*
daily mail function to send reminders to customers
@todo Get list from DB - send remind letters
*/
function dailyMailTool(){
    
    global $ALWPDBF_vars;
    global $configGet;
    
    $tomorrowRecords = new ALWPDBF_records();
    $listRecords = $tomorrowRecords->getDBRecordsForMails();
    
    
    if(count($listRecords['contact_email'])>0){
    
        $sendMail = new ALWPDBF_mail($ALWPDBF_vars->reminderToCustomer());
        
    foreach($listRecords['contact_email'] as $key=>$value){
        if (strlen($value)>4){
            
            $data["id"] = $listRecords['id'][$key];
            $data["date"] = $listRecords['date'][$key]; 
            $data["intTime"] = $listRecords['intTime'][$key]; 
            $data["seats_qty"] = $listRecords['seats_qty'][$key];
            $data["specialKey"]=$listRecords['specialKey'][$key];
            $data["contact_email"] = $listRecords['contact_email'][$key];
            
            $sendMail->sendLeterToCustomer($data);
        }
    }
    }
}

/*
admin lang load files
*/
require_once $ALWPDBF_vars->lang()."lang-admin-en.php";
if ($configArray[1]<>""&&file_exists($ALWPDBF_vars->lang()."lang-admin-".$currentAdminLang.".php")){
    require_once $ALWPDBF_vars->lang()."lang-admin-".$currentAdminLang.".php";
}

add_action('admin_menu', 'adminMenuConfigure');

add_action('ALWPDBF_daily_reminder', 'dailyMailTool');
