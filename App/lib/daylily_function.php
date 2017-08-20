<?php
function Gelombang($id_cmembers, $mata_uang){
	$today=date ("Y-m-d");
	$tgl_today = strtotime($today);
	$gel_1 = strtotime('2014-11-15');
	$gel_2 = strtotime('2015-02-15');
 
	if($tgl_today <= $gel_1){
		if($id_cmembers==1){
			$idr=1250000;
			$usd=250;
		}
		elseif($id_cmembers==2){
			$idr=950000;
			$usd=175;
		}
		elseif($id_cmembers==3){
			$idr=1200000;
			$usd=225;
		}
		elseif($id_cmembers==4){
			$idr=900000;
			$usd=150;
		}
	}
	elseif($tgl_today <= $gel_2){
		if($id_cmembers==1){
			$idr=1750000;
			$usd=300;
		}
		elseif($id_cmembers==2){
			$idr=1250000;
			$usd=200;
		}
		elseif($id_cmembers==3){
			$idr=1200000;
			$usd=225;
		}
		elseif($id_cmembers==4){
			$idr=900000;
			$usd=150;
		}
	}
	
	if($mata_uang=='idr'){
		$mu=$idr;
	}
	elseif($mata_uang=='usd'){
		$mu=$usd;
	}
	
	return $mu;
}

function StatusRegister($a){
	if($a==0){
		$stat='Not yet';
	}
	elseif($a==1){
		$stat='Done';
	}
	elseif($a==2){
		$stat='Confirmation';
	}
	return $stat;
}
function paymenMethod($a){
	if($a==1){
		$stat='Transfer';
	}
	elseif($a==2){
		$stat='Internet Banking';
	}
	elseif($a==3){
		$stat='Mobile Banking';
	}
	elseif($a==4){
		$stat='Cash';
	}
	return $stat;
}
?>