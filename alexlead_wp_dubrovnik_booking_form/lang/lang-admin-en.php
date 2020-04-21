<?php
/*
EN lang messages for Admin area
*/
if (!defined('ABSPATH')) exit;

/* -- admin menu parameters -- */
$menuNames['general'] = "Booking";
$menuNames['option'] = "Options";
$menuNames['intervals'] = "Intervals";
$menuNames['letter'] = "Customer letter";
$menuNames['letter-remind'] = "Remind letter";
$menuNames['letter-admin'] = "Admin letter";
$menuNames['bookers'] = "Bookers mails";

/*  --  booking list --  */
$bookings['admin-bookings-header'] = "All bookings";
$bookings['admin-bookings-manual'] = "The booking list is from today. Please use filter settings if you want to see any orders before today.<br/>
For removing order please check row and save changes.";

$bookings['filter-begin-date'] = "Start from (YYYYMMDD)";
$bookings['filter-finish-date'] = "Show until (YYYYMMDD)";
$bookings['filter-submit'] = "Use filter";

$bookings['table-delete'] = "Del";
$bookings['table-id'] = "ID";
$bookings['table-book-confirmed'] = "Conf";
$bookings['table-book-paid'] = "Paid";
$bookings['table-book-date'] = "Date";
$bookings['table-book-time'] = "Time";
$bookings['table-book-qty'] = "Seats qty";
$bookings['table-book-phone'] = "Phone";
$bookings['table-book-mail'] = "E-mail";
$bookings['table-book-comment'] = "Comment";
$bookings['table-submit'] ="Delete selected";


/* -- setting time intervals -- */
$timeInterval['admin-intervals-header'] = "Intervals setting";
$timeInterval['admin-intervals-manual'] = "Below intervals are for booking by your customers. Interval start from time you set in Interval Start field. Title of an interval is time your customer see on front-end form.";
$timeInterval['table-delete'] = "Del";
$timeInterval['table-id'] = "ID";
$timeInterval['table-IntStart'] = "Interval Start (HH:MM)";
$timeInterval['table-intTitle'] = "Interval Title";
$timeInterval['table-submit'] ="Submit";
$timeInterval['admin-intervals-addnew-header'] = "Add New Interval";
$timeInterval['addnew-time'] = "Set Interval Start time (format: HH:MM  - 24h Standard)";
$timeInterval['addnew-title'] = "Set Interval Title";
$timeInterval['addnew-submit'] ="Save";

/* -- mail to customer option page -- */
$mail['admin-letter-header'] = "Letter to customer";
$mail['admin-letter-header-remind'] = "Letter for remind to customer";
$mail['admin-letter-header-admin'] = "Letter to administrator";
$mail['admin-letter-manual'] = "Please fill below form with a letter for your customer. Use special tags for adding booking details:<ul> 
<li>[booking_date] - will be replaces with booking date in the letter; </li>
<li>[booking_time] - will be replaces with booking time in the letter; </li>
<li>[booking_qty] - will be replaces with quatity of seats booked by the customer; </li>
<li>[booking_key_confirm] - will be replaces with link of confirming booking; </li>
<li>[booking_key_delete] - will be replaces with link of deleting booking; </li>
</ul>
";
$mail['admin-letter-button'] = "Save changes";

/* -- booker managers mails list  -- */

$mailsList['admin-letter-header'] = "List bookers e-mails";
$mailsList['admin-letter-manual'] = "Add e-mails to below text area, the system will send mails about booked seats to these e-mails. Please put one e-mail to one row";
$mailsList['admin-letter-button'] = "Save";


/*  --  Basic options   --  */

$options['options-header'] = "Basic options";
$options['options-manual'] = "Please put configuration";
$options['options-button'] = "Save";
$options['options-label-seat'] = "Please set seats quatity on a board";
$options['options-label-admin-lang'] = "Please set admin lang (en, ru ...)";
$options['options-label-front-lang'] = "Please set front-end lang (en, ru ...)";
$options['options-label-confirm-page'] = "Please enter page for confirming/deleting bookings from customer";
