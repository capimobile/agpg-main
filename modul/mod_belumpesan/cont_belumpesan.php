<?php if(!isset($RUN)) { exit(); } ?>
<?php
$page=$_GET[page];
$pag=Baggeo_Decrypt($_GET['page']);
$aksi="modul/mod_$pag/act.php";

$Tproduct = new Table('product'); 
$products = $Tproduct->findAll();

$Tmodul = new Table('orders');
$Torder = new Table('orders_detail');
$Tcabang = new Table('cabang');
$cabangs = $Tcabang->findAll();

switch($_GET['act']){
  //homepage
  default:
  if(isset($_GET['tanggal'])){
	  $dates=$_GET['tanggal'];
  }
  else{
	  $dates=date('Y-m-d');
  }
  $moduls = $Tmodul->findValue("tgl_order='".$dates."'");

  break;
//form page
  case "view":
		$id=Baggeo_Decrypt($_GET['id']);
		$orders = $Torder->findValue("id_orders='".$id."' ORDER BY id_product ASC");
  break;
}
?>
