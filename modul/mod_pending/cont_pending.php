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

$Tkurir = new Table('kurir');
$kurirs = $Tkurir->findValue("1=1 ORDER BY name_kurir ASC");


switch($_GET['act']){
  //homepage
  default:
  $p      = new Paging;
  $batas  = 20;
  $posisi = $p->cariPosisi($batas);	
  	
  if(isset($_GET['tanggal'])){
	  $dates="AND o.tgl_order='".$_GET['tanggal']."'";
	  $plusdat="&tanggal=$_GET[tanggal]";
  }
  else{
	  $dates='';
	  $plusdat="";
  }
if($_GET['search']){
	$searchsql="AND c.name_cabang like '%".$_GET['search']."%'";
	$pluscur="&search=$_GET[search]";
}
 
$orderss="(SELECT * FROM orders o LEFT JOIN cabang c ON c.id_cabang = o.id_cabang WHERE o.status_order=0 $dates $searchsql ORDER BY o.id_orders DESC LIMIT $posisi,$batas)";

$moduls=mysql_query($orderss,Connect::getConnection());

$norderss="(SELECT * FROM orders o LEFT JOIN cabang c ON c.id_cabang = o.id_cabang WHERE o.status_order=0 $dates $searchsql)";
$nmoduls=mysql_query($norderss,Connect::getConnection());

  break;
//form page
  case "view":
		$id=Baggeo_Decrypt($_GET['id']);
		$orders = $Torder->findValue("id_orders='".$id."' ORDER BY id_product ASC");
  break;

  case "assign":
    $id=Baggeo_Decrypt($_GET['id']);
    $orders = $Torder->findValue("id_orders='".$id."' ORDER BY id_product ASC");
  break;
}
?>
