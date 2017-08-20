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
  $moduls = $Tmodul->findDistinct("id_cabang", "WHERE tgl_order='".$dates."'");
  
  function HgOrder($a){
	$Torders = new Table('orders_detail'); 
	$orders = $Torders->findValue("id_orders='".$a."'");
	 foreach($orders as $order){
		 $stockn=$stockn+($order->jumlah*$order->harga);
	 }

	return $stockn;
  }

/*   function setKurir($a, $b){
   	$Torders = new Table('orders'); 
   	$id_kurir = selectV('orders',"tgl_order='".$a."' AND id_cabang='".$b."'", 'id_kurir');
	$kurirs = selectQ('kurir', 'id_kurir', $id_kurir, name_kurir);
	return $kurirs;
  }*/


  function salesSold($a, $b){
	$Torders = new Table('orders'); 
	$orders = $Torders->findValue("tgl_order='".$a."' AND id_cabang='".$b."'");
	 foreach($orders as $order){
		 $stockn=$stockn+(HgOrder($order->id_orders)-$order->discount_order);
	 }
	

	return $stockn;
  }

  break;
//form page
  case "view":
		$id=Baggeo_Decrypt($_GET['id']);
		$orders = $Torder->findValue("id_orders='".$id."' ORDER BY id_product ASC");
  break;
}
?>
