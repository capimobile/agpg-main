<?php if(!isset($RUN)) { exit(); } ?>
<?php
$page=$_GET[page];
$pag=Baggeo_Decrypt($_GET['page']);
$aksi="obat/mod_$pag/act.php";

$Tproduct = new Table('product'); 
$Tkproduct = new Table('kategoriproduct'); 
$Tstockin = new Table('stockin'); 
$Tdisposal = new Table('disposal'); 

$kproducts = $Tkproduct->findAll();

$stocks = $Tstockin->findValue("id_product='".Baggeo_Decrypt($_GET['id'])."' ORDER BY id_stockin DESC");
$disposals = $Tdisposal->findValue("id_product='".Baggeo_Decrypt($_GET['id'])."' ORDER BY id_disposal DESC");

$objproducts = $dbo->query("CALL sp_sales_daily_report ('".$_GET['from']."','".$_GET['to']."')");
$products = $objproducts->fetchAll();

function Sold($a, $b, $c){
	$Torders = new Table('orders'); 
	$orders = $Torders->findValue("tgl_order>='".$b."' AND tgl_order<='".$c."' AND status_order!=0");
	 foreach($orders as $order){
		 $stockn=$stockn+DetOrder($order->id_orders, $a);
	 }

	return $stockn;
}
function DetOrder($a, $b){
	$Torders = new Table('orders_detail'); 
	$orders = $Torders->findValue("id_orders='".$a."' AND id_product='".$b."'");
	 foreach($orders as $order){
		 $stockn=$stockn+$order->jumlah;
	 }

	return $stockn;
}
function HgOrder($a, $b){
	$Torders = new Table('orders_detail'); 
	$orders = $Torders->findValue("id_orders='".$a."' AND id_product='".$b."'");
	 foreach($orders as $order){
		 $stockn=$stockn+($order->jumlah*$order->harga);
	 }

	return $stockn;
}

function DiscOrder($b,$c){
	$discount=mysql_query("SELECT SUM(discount_order) as discount FROM orders WHERE tgl_order BETWEEN '".$b."' AND '".$c."'", Connect::getConnection());
	$stockn=mysql_fetch_assoc($discount);

	return $stockn['discount'];
}

function StockOut($a, $b, $c){
	$Torders = new Table('orders'); 
	$orders = $Torders->findValue("tgl_order>='".$b."' AND tgl_order<='".$c."' AND status_order='0'");
	 foreach($orders as $order){
		 $stockn=$stockn+DetOrder($order->id_orders, $a);
	 }

	return $stockn;
}

function salesOut($a, $b, $c){
	$Torders = new Table('orders'); 
	$orders = $Torders->findValue("tgl_order>='".$b."' AND tgl_order<='".$c."' AND status_order='0'");
	 foreach($orders as $order){
		 $stockn=$stockn+HgOrder($order->id_orders, $a);
	 }
	

	return $stockn;
}
function salesSold($a, $b, $c){
	$Torders = new Table('orders'); 
	$orders = $Torders->findValue("tgl_order>='".$b."' AND tgl_order<='".$c."' AND status_order!='0'");
	 foreach($orders as $order){
		 $stockn=$stockn+HgOrder($order->id_orders, $a);
	 }
	

	return $stockn;
}
?>
