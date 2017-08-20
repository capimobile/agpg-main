<?php
$Tappointment = new Table('appointment'); 

//HAPUS APPOINTMENT BY RECEPTIONIST
$appointments=$Tappointment->findValue("status_appointment='4' AND status_patient='0' ORDER BY id_appointment DESC");
foreach($appointments as $appointment){
	$date_q=$appointment->time_stamp;
	$yr=substr($date_q, 0, 4);
	$mn=substr($date_q, 5, 2);
	$dy=substr($date_q, 8, 2);

	$hr=substr($date_q, 11, 2);
	$mt=substr($date_q, 14, 2);
	$sc=substr($date_q, 17, 2);

	$date_select = mktime($hr, $mt, $sc, $mn, $dy, $yr);
	$date_now = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y"));
	$selisih=$date_now-$date_select;
	$add_time = 6*3600;
	if($selisih > $add_time){
		$Tappointment->deleteBy('id_appointment', $appointment->id_appointment);
	}
}
//END HAPUS APPOINTMENT BY RECEPTIONIST


//HAPUS APPOINTMENT BY ONLINE
$appointments2=$Tappointment->findValue("status_appointment!='4' AND status_patient='0' ORDER BY id_appointment DESC");
foreach($appointments2 as $appointment2){
	$date_q=$appointment2->date_appointment;
	$time_q=$appointment2->time_appointment;
	$yr=substr($date_q, 0, 4);
	$mn=substr($date_q, 5, 2);
	$dy=substr($date_q, 8, 2);

	$hr=substr($time_q, 0, 2);
	$mt=substr($time_q, 3, 2);
	
	$date_app = mktime($hr, $mt, 0, $mn, $dy, $yr);	
	$date_now = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y"));
	$selisih=$date_now-$date_app;
	$add_time = 1*3600;
	if($selisih > $add_time){
		$Tappointment->deleteBy('id_appointment', $appointment2->id_appointment);
	}
	
}
//END HAPUS APPOINTMENT BY ONLINE
?>