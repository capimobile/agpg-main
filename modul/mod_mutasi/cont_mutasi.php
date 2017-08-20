<?php if(!isset($RUN)) { exit(); } ?>
<?php
$page=$_GET[page];
$pag=Baggeo_Decrypt($_GET['page']);
$aksi="obat/mod_$pag/act.php";


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

	//echo"<script>alert('SELECT * FROM transfer where tanggal between '".$tgl1." 00:00:00' and '".$tgl2." 23:59:59');</script>";	
	$transfers ="(SELECT * FROM data_bank where tgl_proses between '".$tgl1." 00:00:00' and '".$tgl2." 23:59:59')";
	$transfer=mysql_query($transfers, Connect::getConnection());

	$total_out = mysql_query("SELECT SUM(jumlah) as total_out FROM data_bank  where tipe ='K' and tgl_proses between '".$tgl1." 00:00:00' and '".$tgl2." 23:59:59'",  Connect::getConnection());
	$total_in = mysql_query("SELECT SUM(jumlah) as total_in FROM data_bank  where tipe ='D' and tgl_proses between '".$tgl1." 00:00:00' and '".$tgl2." 23:59:59'",  Connect::getConnection());

	  break;
//form page
  case "view":
		$id=Baggeo_Decrypt($_GET['id']);
		$orders = $Torder->findValue("id_orders='".$id."' ORDER BY id_product ASC");
  break;
}

?>
