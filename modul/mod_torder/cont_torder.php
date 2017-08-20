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

	$cabangs ="(SELECT * FROM cabang WHERE id_cabang NOT IN (SELECT id_cabang FROM orders WHERE `tgl_order` BETWEEN '".$tgl1."' AND '".$tgl2."' ORDER BY id_cabang) AND id_users <> 0)";

	$cabang=mysql_query($cabangs, Connect::getConnection());

	  break;
//form page
  case "view":
		$id=Baggeo_Decrypt($_GET['id']);
		$orders = $Torder->findValue("id_orders='".$id."' ORDER BY id_product ASC");
  break;
}

?>
