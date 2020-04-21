<?php

/*  --  calendar --  */
  $monthNames = array("", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
  $weekDayNames = array("Mo","Tu", "We", "Th", "Fr", "Sa", "Su");

/* -- Contact form -- */
    $cont['label-phone'] = "Enter phone number";
    $cont['label-e-mail'] = "Enter e-mail";
    $cont['label-payment'] = "Check if want to pay now";
    $cont['submit'] = "Order";

/* --  Form saving messages  --  */
$formSaveMess['mistake-data'] = "Please check your selections again. There are some mistake with date.";
$formSaveMess['mistake-phone'] = "Please check phone number again. There is some mistake with it.";
$formSaveMess['mistake-phone-required'] = "Please input phone number again. This is required attribute.";
$formSaveMess['mistake-mail'] = "Please check e-mail again. There is some mistake with it.";
$formSaveMess['mistake-mail-required'] = "Please input e-mail again. This is required attribute.";
$formSaveMess['data-accepted'] = "Data accepted. The seats are booked for you.";

/* -- Confirmation page -- */
$confirm['confirm']['header'] = "Confirm booking";
$confirm['confirm']['text'] = "Thank you. Your booking confirmed. We are waiting you on time.";
$confirm['confirm']['error'] = "There is error with your booking. Please contact us by phone or re-book seats.";
$confirm['delete']['header'] = "Delete booking";
$confirm['delete']['text'] = "Your booking was delete. We are glad to see you back If you`ll have any changes.";
$confirm['delete']['error'] = "There is error with your booking. Tthe booking was deleted before or any other mistake.";
$confirm['payment']['header'] = "Payment booking";
$confirm['payment']['text'] = "Your payment accepted. Thank you. We are waiting you on time.";
$confirm['payment']['error'] = "There is error with your payment. Please contact us by phone or try again later seats.";

/* -- Display steps -- */
$orderStep['name'] = "Step";
$orderStep['step-1'] = "Step 1 - Choose the date";
$orderStep['step-2'] = "Step 2 - Choose the time and the number of seats";
$orderStep['step-3'] = "Step 3 - Fill contact data";
$orderStep['step-4'] = "Thank you for booking seats on our boat!<br/>You `ll receive confirmation soon.";
$orderStep['details-0'] = "Order details:";
$orderStep['details-1'] = "Date: ";
$orderStep['details-2'] = "Time: ";
$orderStep['details-3'] = "Seats: ";
$orderStep['button-back'] = "Back";
$orderStep['button-next'] = "Next";
$orderStep['submit'] = "Order";
