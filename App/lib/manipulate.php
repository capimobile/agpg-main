<?php
date_default_timezone_set('Asia/Jakarta');
$tanggal_skr=date("Y-m-d");
$jam_skr=date("H:i:s");

function hapus($i) {
  	echo "<a class='btn btn-danger btn-xs' href=?page=".$_GET[page]."&pro=delete&id=$i onclick='return konfirmasi()'><i class='icon-trash'></i></a>";
}

function edit($e) {
  	echo "<a class='btn btn-primary btn-xs' href=?page=".$_GET[page]."&act=form&id=$e><i class='icon-pencil'></i></a>";
}
function view($l) {
	echo"<a class='btn btn-success btn-xs' href=?page=".$_GET[page]."&act=view&id=$l><i class='icon-zoom-in'></i></a>";
}
function pay($m) {
	echo"<a class='btn btn-warning btn-xs' href=?page=".$_GET[page]."&act=view&id=$m><i class='icon-money'> Pay</i></a>";
}
function disc($n) {
	echo"<a class='btn btn-primary btn-xs' href=?page=".$_GET[page]."&act=view&id=$n><i class=''>Discount</i></a>";
}
function assign($p) {
	echo"<a class='btn btn-primary btn-xs' href=?page=".$_GET[page]."&act=assign&id=$p><i class=''>Kurir</i></a>";
}
function urllink($data1){
	$nama=$data1;
	$Find = Array(' ', '/', '(', ')', '+', '-', '.', '"','=');
    $Replace = Array('', '', '', '', '', '', '', '','');
	$link=strtr($nama, array_combine($Find, $Replace));
	return $link;
}



function Baggeo_Encrypt($text){

	// $klink= trim(base64_encode($text));

	// return urllink($klink);
	return urllink($text);

}



function Baggeo_Decrypt($text){

    // $klink= trim(base64_decode($text));

	// return $klink;
	return urllink($text);

}



function pageslink($data1){

	$nama=$data1;

	$Find = Array(' ', '/', '(', ')', '+', '-', '.', '"','=');

    $Replace = Array('+', '', '+', '+', '+', '+', '+', '+','+');

	$link=strtr($nama, array_combine($Find, $Replace));

	return strtolower($link);

}



function querynum($a,$b,$c){

		$table=mysql_query("SELECT * FROM $a WHERE $b='$c'",Connect::getConnection());

		$t=mysql_num_rows($table);

		return $t;

}

function querynum2($a,$b,$c,$d,$e){

		$table=mysql_query("SELECT * FROM $a WHERE $b='$c' AND $d='$e'",Connect::getConnection());

		$t=mysql_num_rows($table);

		return $t;

}

function querynum3($a,$b){

		$table=mysql_query("SELECT * FROM $a WHERE $b",Connect::getConnection());

		$t=mysql_num_rows($table);

		return $t;

}

function querynum4($a){

		$table=mysql_query("SELECT * FROM $a",Connect::getConnection());

		$t=mysql_num_rows($table);

		return $t;

}

function selectQ($a,$b,$c,$d){

		$table=mysql_query("SELECT * FROM $a WHERE $b='$c'",Connect::getConnection());

		$t=mysql_fetch_array($table);

		return $t[$d];

}

function selectV($a,$b,$c){
		$table=mysql_query("SELECT * FROM $a WHERE $b",Connect::getConnection());
		$t=mysql_fetch_array($table);
		return $t[$c];
}



function selectO($a,$b,$c){

		$table=mysql_query("SELECT * FROM $a $b",Connect::getConnection());

		$t=mysql_fetch_array($table);

		return $t[$c];

}



function id_encrypt($a){

	$klink = ($a*93247)+83129;

    return $klink;

}



function id_decrypt($a){

    $klink = ($a-83129)/93247;

	return $klink;

}



function UploadFile($fupload_name){

  $vdir_upload = "../upload/";

  $vfile_upload = $vdir_upload . $fupload_name;

  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);

  

  

}



function codeAcak($length){

	$random= "";

	srand((double)microtime()*1000000);

	$data = "ABCD123EFGHIJKLM45NOP67QRSTU890VWXYZ";

	$data .= "ABCDEFGHIJKLM45NOPQ4567RSTU89VWXYZ";

	$data .= "0FGH45OP89";

	for($i = 0; $i < $length; $i++){

		$random .= substr($data, (rand()%(strlen($data))), 1);

	}

		return $random;

}

function langSelect($a, $b){

	if($_GET['lang']=='id'){

		$val=$a;

	}

	elseif($_GET['lang']=='en'){

		$val=$b;

	}

	return $val;

}



function formdate($format) {

 	$date=substr($format,3,-5);

  	$month=substr($format,0,2);

	$year=substr($format,-4,6);



	return $year.'-'.$month.'-'.$date;	  

}



function formdatemiring($format) {

  	$date=substr($format,8,2);

	$month=substr($format,5,2);

	$year=substr($format,0,4);



	return $month.'/'.$date.'/'.$year;	  

}



function mktimeSelect($angka){

	$date_q=$angka;

	$yr=substr($date_q, 0, 4);

	$mn=substr($date_q, 5, 2);

	$dy=substr($date_q, 8, 2);



	$hr=substr($date_q, 11, 2);

	$mt=substr($date_q, 14, 2);

	$sc=substr($date_q, 17, 2);



	$date_select = mktime($hr, $mt, $sc, $mn, $dy, $yr);

	return $date_select;

}



function duration($angka,$b){



	$jumlah_jam = floor($angka/3600);



	$sisa = $angka % 3600;

	$jumlah_menit = floor($sisa/60);



	$sisa = $sisa % 60;

	$jumlah_detik = floor($sisa/1);

	

	if($b=='jam'){

		$take=$jumlah_jam;

	}

	elseif($b=='mnt'){

		$take=$jumlah_menit;

	}

	elseif($b=='dtk'){

		$take=$jumlah_detik;

	}

	if($take<0){

		$tk=0;

	}

	else{

		$tk=$take;

	}

	return $tk;

}



function rupiah($angka){

  $rupiah=number_format($angka,0,',','.');

  return $rupiah;

}


function Uploadphoto($fupload_name){

  $vdir_upload = "../upload/";

  $vfile_upload = $vdir_upload . $fupload_name;

  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);

  

   //identitas file asli

  $im_src = imagecreatefromjpeg($vfile_upload);

  $width = imageSX($im_src);

  $height = imageSY($im_src);

  

  

   $thumb_width = 250;

   $thumb_height = 135;

  

  $original_aspect = $width / $height;

  $thumb_aspect = $thumb_width / $thumb_height;



  if ( $original_aspect >= $thumb_aspect ) {



     // If image is wider than thumbnail (in aspect ratio sense)

     $new_height = $thumb_height;

     $new_width = $width / ($height / $thumb_height);



  }

  else {

     // If the thumbnail is wider than the image

     $new_width = $thumb_width;

     $new_height = $height / ($width / $thumb_width);

  }



  $thumb = imagecreatetruecolor( $thumb_width, $thumb_height );



  //proses perubahan ukuran

  imagecopyresampled($thumb,

         $im_src,

         0 - ($new_width - $thumb_width) / 2, // Center the image horizontally

         0 - ($new_height - $thumb_height) / 2, // Center the image vertically

         0, 0,

         $new_width, $new_height,

         $width, $height);



  //Simpan gambar

  imagejpeg($thumb,$vdir_upload."thu/" . $fupload_name);

}



	function changedate($tgl){

			$tanggal = substr($tgl,8,2);

			$bulan = getBulan(substr($tgl,5,2));

			$tahun = substr($tgl,0,4);

			return $tanggal.' '.$bulan.' '.$tahun;		 

	}	

	





	function getBulan($bln){

				switch ($bln){

					case 1: 

						return "Januari";

						break;

					case 2:

						return "Februari";

						break;

					case 3:

						return "Maret";

						break;

					case 4:

						return "April";

						break;

					case 5:

						return "Mei";

						break;

					case 6:

						return "Juni";

						break;

					case 7:

						return "Juli";

						break;

					case 8:

						return "Agustus";

						break;

					case 9:

						return "September";

						break;

					case 10:

						return "Oktober";

						break;

					case 11:

						return "November";

						break;

					case 12:

						return "Desember";

						break;

				}

			}

			

	function convertDate($tgl2){

            $tglf=explode("-",$tgl2);

			return $tglf[2].'-'.$tglf[0].'-'.$tglf[1];		 

	}	

	

function CurrentDate($d){

	if($d == 'date'){

	$cdate=date('d');	

	}

	else if($d == 'month'){

	$cdate=date('m');	

	}

	else if($d == 'month2'){

	$datee= substr(date('m'),-1);

	$cdate=	$datee;

	}

	else if($d == 'year'){

	$cdate=date('Y');	

	}

	else if($d == 'all'){

	$cdate=date('Y-m-d');	

	}



	return $cdate;

}



function titleLog($data1){

	$nama=$data1;

	$Find = Array(' ', '/', '(', ')', '+', '-', '.', '"','=');

    $Replace = Array('_', '_', '_', '_', '_', '_', '_', '_','_');

	$link=strtr($nama, array_combine($Find, $Replace));

	return strtolower($link);

}



function mkJam($a){

	list($jam, $menit)=explode(':', $a);

	$mk=($jam*3600)+($menit*60);

	return $mk;

}

function grand($ship,$sub){
	$grand=$ship+$sub;
	return $grand;	
}
function login_validate() {
    $timeout = 600;
    $_SESSION["expires_by"] = time() + $timeout;
}

function login_check() {
	$exp_time = $_SESSION["expires_by"];
	if (time() < $exp_time) {
		login_validate();
		return true;
	} else {
		unset($_SESSION["expires_by"]);
		return false;
	}
}

?>
