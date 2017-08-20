<?php
function viewUsers($l, $a) {
	echo"<a class='btn btn-primary btn-xs' href=?page=".Baggeo_Encrypt('profile')."&ur=".Baggeo_Encrypt($a)."&act=".Baggeo_Encrypt('profile')."&id=$l><i class='icon-user'></i></a>";
}
function statusaktif($a){
	if($a=0){
		$stat='Not Active';
	}
	elseif($a=1){
		$stat='Active';
	}
	return $stat;
}

function Profile($a){
	if(empty($_SESSION['nouser'])){
		$selecttable = new Table('users');
		$output = $selecttable->findBy('id_users', $_SESSION['user_id']);
		$output = $output->current();
		if($a=='nama'){
			$fld=$output->name_users;
		}
		elseif($a=='photo'){
			$fld="superadmin12345.jpg";
		}
	}
	elseif($_SESSION['level']==11){
		$selecttable = new Table('doctor');
		$output = $selecttable->findBy('no_doctor', $_SESSION['nouser']);
		$output = $output->current();
		if($a=='nama'){
			$fld=$output->name_doctor;
		}
		elseif($a=='photo'){
			$fld=$output->photo_doctor;
		}
	}
	elseif($_SESSION['level']==9){
		$selecttable = new Table('pasien');
		$output = $selecttable->findBy('no_pasien', $_SESSION['nouser']);
		$output = $output->current();
		if($a=='nama'){
			$fld=$output->name_pasien;
		}
		elseif($a=='photo'){
			$fld=$output->photo_pasien;
		}
	}
	else{
		$selecttable = new Table('employee');
		$output = $selecttable->findBy('no_employee', $_SESSION['nouser']);
		$output = $output->current();
		if($a=='nama'){
			$fld=$output->name_employee;
		}
		elseif($a=='photo'){
			$fld=$output->photo_employee;
		}
	}
	
	return $fld;
}

function Appstat($app){
if($app == 0){
$ap="Waiting For Confirmation";
}
else if($app == 1){
$ap="Reschedule";
}
else if($app == 2){
$ap="Confirmed Reschedule";
}
else if($app == 3){
$ap="Reject";
}
else if($app == 4){
$ap="Offline (Input By Resepsionist)";
}
else if($app == 5){
$ap="Confirmed";
}
	
return $ap;	
}

function Relationship($a){
		if($a=='1'){
			$fld='Merried';
		}
		elseif($a=='2'){
			$fld='Single';
		}	
		return $fld;	
}

function detailBilling($a, $b){
		if($a=='0'){
			if($b=='jasa'){
				$nama='Jasa Dokter';
			}
			elseif($b=='treatment'){
				$nama='Tindakan';
			}
			elseif($b=='adm'){
				$nama='Administrasi';
			}
			elseif($b=='obat'){
				$nama='Obat-obatan';
			}
			elseif($b=='lain'){
				$nama='Lain-lain';
			}
		}
		else{
			$nama=selectQ('mr_billing', 'id_mrbilling', $a, 'name_mrbilling');
		}	
		return $nama;	
}

function Sex($a){
		if($a=='1'){
			$fld='Male';
		}
		elseif($a=='2'){
			$fld='Female';
		}	
		return $fld;	
}

function StatusKaryawan($a){
		if($a=='0'){
			$fld='Honor';
		}
		elseif($a=='1'){
			$fld='Permanent';
		}	
		return $fld;	
}

function Log_Users($a){
	if($a=='login'){
		$part="";
	}
	elseif($a=='edit_doctor' || $a=='input_doctor' || $a=='delete_doctor' || $a=='input_patient' || $a=='edit_patient' || $a=='delete_patient' || $a=='input_employee' || $a=='edit_employee' || $a=='delete_employee' || $a=='input_administrator' || $a=='edit_administrator' || $a=='delete_administrator'){
		$part="";
	}
	elseif($a=='login'){
		$part="";
	}
	elseif($a=='login'){
		$part="";
	}
	elseif($a=='login'){
		$part="";
	}
	elseif($a=='login'){
		$part="";
	}
	elseif($a=='login'){
		$part="";
	}
	elseif($a=='login'){
		$part="";
	}
	elseif($a=='login'){
		$part="";
	}
	elseif($a=='login'){
		$part="";
	}
	
	return $part;
	
}

function confirm($c) {
  	echo "<a class='btn btn-primary btn-xs' href=?page=".$_GET[page]."&pro=confirm&id=$c  title='Confirm Appointment'><i class='icon-check-sign'></i></a>";
}
function re($r) {
		echo "<a class='btn btn-success btn-xs' href=?page=".$_GET[page]."&act=form&id=$r title='Reschedule'><i class='icon-refresh'></i></a>";
}
function reject($i) {
  	echo "<a class='btn btn-danger btn-xs' href=?page=".$_GET[page]."&pro=reject&id=$i onclick='return reject()' title='Reject Appointment'><i class='icon-remove'></i></a>";
}

function confirmPatient($c,$t) {
  	echo "<a class='btn btn-primary btn-xs' href=?page=".$_GET[page]."&pro=confirm&id=$c&time=$t  title='Confirm Appointment'><i class='icon-check-sign'></i></a>";
}

function format_rupiah($angka){
  $rupiah='Rp. '.number_format($angka,0,',','.').' ,-';
  return $rupiah;
}

function getUr() {
	$valid_lev = array("1", "3");
	$valid_lev2 = array("9");
	$valid_lev3 = array("11");
	$valid_lev5 = array("5");
	if(in_array($_SESSION['level'], $valid_lev)){
		$getur='mimin';
	}
	elseif(in_array($_SESSION['level'], $valid_lev5)){
		$getur='mimin';
	}
	elseif(in_array($_SESSION['level'], $valid_lev2)){
		$getur='patient';
	}
	elseif(in_array($_SESSION['level'], $valid_lev3)){
		$getur='doctor';
	}
	else{
		$getur='employee';
	}
return $getur;
}
function JasaDoctor($a,$b){
	$typedoctor = selectQ('doctor', 'id_doctor', $a, 'id_typedoctor');
	$nodoctor = selectQ('doctor', 'id_doctor', $a, 'no_doctor');
	$fee=selectQ('fee', 'id_typedoctor', $typedoctor, 'doctor_fee');
	$profitdoctor = selectQ('profitdoctor', 'no_doctor', $nodoctor, 'doctor_fee');
	
	if($b=='fee'){
		$doctorfee=$fee;
	}
	elseif($b=='profit'){
		$doctorfee=($profitdoctor*$fee)/100;
	}
	return $doctorfee;
}

function treaTment($a,$b,$c){
	$Ttreatment = new Table('treatment'); 
	$treatments=$Ttreatment->findValue("id_appointment='".$a."'");
	foreach($treatments as $treatment){
		$btreatment=$treatment->qty_treatment*(selectQ('mr_treatment', 'id', $treatment->id_treatment, 'price_treatment')+selectQ('mr_treatment', 'id', $treatment->id_treatment, 'price_asisten')+selectQ('mr_treatment', 'id', $treatment->id_treatment, 'price_bhp'));
		$biaya=$biaya+$btreatment;
	}
	$nodoctor = selectQ('doctor', 'id_doctor', $b, 'no_doctor');
	$profitdoctor = selectQ('profitdoctor', 'no_doctor', $nodoctor, 'treatment');
	
	if($c=='fee'){
		$doctorfee=$biaya;
	}
	elseif($c=='profit'){
		$doctorfee=($profitdoctor*$biaya)/100;
	}
	return $doctorfee;
}

function adminisTrasi($a){
	if(querynum3('appointment', "id_users='".$a."' AND status_patient='2'")==0){
		$biaya=selectV('klinik', "id_klinik='".$_SESSION['id_klinik']."'", 'reg_klinik');
	}
	else{
		$biaya=selectV('klinik', "id_klinik=".$_SESSION['id_klinik']."", 'afterreg_klinik');
	}
	return $biaya;
}
?>