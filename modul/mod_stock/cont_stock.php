<?php if(!isset($RUN)) { exit(); } ?>
<?php
$page=$_GET[page];
$pag=Baggeo_Decrypt($_GET['page']);
$aksi="product/mod_$pag/act.php";

$Tproduct = new Table('product'); 
$Tkproduct = new Table('kategoriproduct'); 
$Tstockawal = new Table('stockawal'); 
$Tstockin = new Table('stockin'); 
$Tdisposal = new Table('disposal'); 

$kproducts = $Tkproduct->findAll();

$stocks = $Tstockin->findValue("id_product='".Baggeo_Decrypt($_GET['id'])."' ORDER BY id_stockin DESC");
$disposals = $Tdisposal->findValue("id_product='".Baggeo_Decrypt($_GET['id'])."' ORDER BY id_disposal DESC");


function stockAwal($a, $b, $c){
	if((int)date('m')==1){
		$tahunfrom=date("Y", strtotime("-1 year", strtotime(date('Y-m-d'))));
	}
	else{
		$tahunfrom=date('Y');
	}
	$bulanfrom=date("m", strtotime("-1 month", strtotime(date('Y-m-d'))));
		
	$Tstockawal = new Table('stockawal'); 
	$stockawal = $Tstockawal->findValue("id_product='".$a."' AND bulan_stockawal='".(int)$bulanfrom."' AND tahun_stockawal='".$tahunfrom."'");
	$stockawal = $stockawal->current();
	$awal=$stockawal->qty_stockawal;
	
	return $awal;
}
function stockIn($a, $b, $c){
	$Tstockawal = new Table('stockin'); 
	$stockin = $Tstockawal->findValue("id_product='".$a."' AND date_stockin>='".$b."' AND date_stockin<='".$c."'");
	 foreach($stockin as $stockins){
		 $stockn=$stockn+$stockins->qty_stockin;
	 }

	return $stockn;
}
function stockDis($a, $b, $c){
	$Tstockawal = new Table('disposal'); 
	$stockin = $Tstockawal->findValue("id_product='".$a."' AND date_disposal>='".$b."' AND date_disposal<='".$c."'");
	 foreach($stockin as $stockins){
		 $stockn=$stockn+$stockins->qty_disposal;
	 }

	return $stockn;
}
function Sold($a, $b, $c){
	$Torders = new Table('orders'); 
	$orders = $Torders->findValue("tgl_order>='".$b."' AND tgl_order<='".$c."'");
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


function StockAkhir($a, $b, $c){
	$stockn=((int)stockAwal($a)+
			(int)stockIn($a, $b, $c))-((int)Sold($a, $b, $c)+(int)stockDis($a, $b, $c));

	return $stockn;
}

switch($_GET['act']){
  //homepage
  default:
$products = $Tproduct->findAll();
     break;
//form page
  case "form":
  	
  break;
}
?>
