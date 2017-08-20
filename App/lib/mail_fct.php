<?php
function AppMail($source,$Appid,$nop,$nod,$dt,$tm,$rtm,$to,$from){
	//user input appointment
   if($source="add_user"){	   
   $subject="New Appointment";   
   $txt="
   Hello Doctor,<br/>
   You have new appoinment from patient, Here are the details:<br/><br/>
   Appointment ID   : ".$Appid." <br/>
   Patient's Name   : ".$nop."<br/>
   Appointment Date : ".$dt."<br/>
   Appointment Time : ".$tm."<br/><br/>
   
   Please Confirm, Reject, Or Reschedule Apoointment in Application.<br />
   Thank You.
   ";   
   }
   //doctor confirm appointment
   else if($source="confirm_doctor"){
   $subject="Your Confirmed Appoinment Status";   
   $txt="
   Hello ".$nop.",<br/>
   The doctor's appointment you booked is CONFIRMED by Doctor, Here are the details:<br/><br/>
   Appointment ID   : ".$Appid." <br/>
   Doctor's Name   : ".$nod."<br/>
   Appointment Date : ".$dt."<br/>
   Appointment Time : ".$tm."<br/>
   Patient's Name   : ".$nop."<br/><br/>
   Please Confirm, Reject, Or Reschedule Appointment in Application.<br />
   Thank You.";   
   }
   //doctor reschedule appointment
   else if($source="reschedule_doctor"){
   $subject="Your Reschedule Appointment Status";   
   $txt="
   Hello ".$nop.",<br/>
   The doctor's appointment you booked is RESCHEDULE by Doctor, Here are the details:<br/><br/>
   Appointment ID   : ".$Appid." <br/>
   Doctor's Name   : ".$nod."<br/>
   Appointment Date : ".$dt."<br/>
   Appointment Time : ".$tm."<br/>
   Rescheduled Time : ".$rtm."<br
   Patient's Name   : ".$nop."<br/><br/>
   Please Confirm Or Reject Appointment in Application.<br />
   Thank You.";   
   }
   //doctor reject appointment
   else if($source="reject_doctor"){
   $subject="Your Rejected Appointment Status";   
   $txt="
   Hello ".$nop.",<br/>
   The doctor's appointment you booked is REJECTED by Doctor, Here are the details:<br/><br/>
   Appointment ID   : ".$Appid." <br/>
   Doctor's Name   : ".$nod."<br/>
   Appointment Date : ".$dt."<br/>
   Appointment Time : ".$tm."<br/>
   Patient's Name   : ".$nop."<br/><br/>
   Thank You.";   
   }
   //user confirm reschedule appointment
   else if($source="confirm_user"){
    $subject="Your Reschedule Appointment Status";    
   $txt="
   Hello Doctor,<br/>
   Your Rescheduled appoinment was CONFIRMED by patient, Here are the details:<br/><br/>
   Appointment ID   : ".$Appid." <br/>
   Doctor's Name   : ".$nod."<br/>
   Appointment Date : ".$dt."<br/>
   Appointment Time : ".$tm."<br/>
   Patient's Name   : ".$nop."<br/><br/>
   Thank You.";   
   }
   //user reject appointment
   else if($source="reject_user"){
   $subject="Your Rechedule Appointment Status";   
   $txt="
   Hello ".$nop.",<br/>
   Your Rescheduled appoinment was REJECTED by patient, Here are the details:<br/><br/>
   Appointment ID   : ".$Appid." <br/>
   Doctor's Name   : ".$nod."<br/>
   Appointment Date : ".$dt."<br/>
   Appointment Time : ".$tm."<br/>
   Patient's Name   : ".$nop."<br/><br/>
   Thank You.";   
   }
    $header= 
 "From: ".$from." \n" . 
 "MIME-Version: 1.0\n" . 
 "Content-type: text/html; charset=iso-8859-1"; 
mail($to,$subject, $txt, $header);	   
}

?>