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
$Tdeposit = new Table('deposit');

switch($_GET['act']){
  //homepage
  default:
  if(isset($_GET['tanggal'])){
	  $dates=$_GET['tanggal'];
  }
  else{
	  $dates=date('Y-m-d');
  }
  $orders=" (SELECT * FROM orders o LEFT JOIN cabang c ON c.id_cabang = o.id_cabang WHERE c.id_users='".$_SESSION['user_id']."' AND o.tgl_order='".$dates."')";
  $order=mysql_query($orders,Connect::getConnection());

  break;
//form page
  case "view":
		$id=Baggeo_Decrypt($_GET['id']);
		$orders = $Torder->findValue("id_orders='".$id."' ORDER BY id_product ASC");
  break;
}
?>
