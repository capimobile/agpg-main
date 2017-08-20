<?php if(!isset($RUN)) { exit(); } ?>
<?php
$page=$_GET[page];
$pag=Baggeo_Decrypt($_GET['page']);
$aksi="obat/mod_$pag/act.php";

$Tcabang = new Table('cabang');
$Tbank = new Table('bank');


$cabangs = $Tcabang->findValue("1=1 ORDER BY name_cabang ASC");
$banks = $Tbank->findValue("1=1 ORDER BY name_bank ASC");


switch($_GET['act']){
  //homepage
  default:

	if(isset($_GET['from'])){
		$tgl1=$_GET['from'];
		$tgl2=$_GET['to'];
	} else {
		$tgl1=date('Y-m-d');
		$tgl2=date('Y-m-d');
	}

	echo"<script>alert('SELECT * FROM transfer where tanggal between '".$tgl1." 00:00:00' and '".$tgl2." 23:59:59');</script>";	
	$transfers ="(SELECT * FROM jurnal where input_date between '".$tgl1." 00:00:00' and '".$tgl2." 23:59:59')";

	$transfer=mysql_query($transfers, Connect::getConnection());

	$total_out = mysql_query("SELECT SUM(jml) as total_out FROM jurnal  where status ='Masuk' and input_date between '".$tgl1." 00:00:00' and '".$tgl2." 23:59:59'",  Connect::getConnection());
	$total_in = mysql_query("SELECT SUM(jml) as total_in FROM jurnal  where status ='Keluar' and input_date between '".$tgl1." 00:00:00' and '".$tgl2." 23:59:59'",  Connect::getConnection());

	  break;
//form page
  case "view":
		$id=Baggeo_Decrypt($_GET['id']);
		$orders = $Torder->findValue("id_orders='".$id."' ORDER BY id_product ASC");
  break;
}

?>
