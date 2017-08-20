<?php if(!isset($RUN)) { exit(); } ?>
<?php
$page=$_GET[page];
$pag=Baggeo_Decrypt($_GET['page']);
$aksi="obat/mod_$pag/act.php";

$Ttrendscotk = new Table('trendstock');

switch($_GET['act']){
  //homepage
  default:

	if(isset($_GET['tanggal'])){
		$tanggal=$_GET['tanggal'];
	} else {
		$tanggal=date('Y-m');
	}


	$trendstocks ="(SELECT * FROM trend_stock where date_stock like '%".$tanggal."%') ORDER BY date_stock";

	$trendstock=mysql_query($trendstocks, Connect::getConnection());

	  break;
//form page
  case "view":
		$id=Baggeo_Decrypt($_GET['id']);
		$orders = $Torder->findValue("id_orders='".$id."' ORDER BY id_product ASC");
  break;
}

?>
