<?php if(!isset($RUN)) { exit(); } ?>
<?php
$page=$_GET[page];
$pag=Baggeo_Decrypt($_GET['page']);
$aksi="modul/mod_$pag/act.php";

$Tproduct = new Table('product'); 
$Tdeposit = new Table('deposit');

$Tkproduct = new Table('kategoriproduct'); 
$Tstockawal = new Table('stockawal'); 
$Tstockin = new Table('stockin'); 
$Tdisposal = new Table('disposal');
$Ttstock = new Table('temp_stock');


$Tmodul = new Table('orders');
$Torder = new Table('orders_detail');
$Tcabang = new Table('cabang');
$products = $Tproduct->findAll();
$cabangs = $Tcabang->findValue("id_users='".$_SESSION['user_id']."' ORDER BY name_cabang ASC");

$kproducts = $Tkproduct->findAll();

$stocks = $Tstockin->findValue("id_product='".Baggeo_Decrypt($_GET['id'])."' ORDER BY id_stockin DESC");
$disposals = $Tdisposal->findValue("id_product='".Baggeo_Decrypt($_GET['id'])."' ORDER BY id_disposal DESC");


function stockAwal($a){
	$tahunfrom=substr(date('Y-m-d'),0,4);
	$bulanfrom=substr(date('Y-m-d'),5,2);
	$tanggalfrom=substr(date('Y-m-d'),8,2);
	
	$tahunto=substr(date('Y-m-d'),0,4);
	$bulanto=substr(date('Y-m-d'),5,2);
	$tanggalto=substr(date('Y-m-d'),8,2);
	
	$Tstockawal = new Table('stockawal'); 
	$stockawal = $Tstockawal->findValue("id_product='".$a."' AND bulan_stockawal='".(int)$bulanfrom."' AND tahun_stockawal='".$tahunfrom."'");
	$stockawal = $stockawal->current();
	
	$from=$tahunfrom.'-'.$bulanfrom.'-'.'01';
	$to=date("Y-m-d", strtotime("-1 day", strtotime(date('Y-m-d'))));
	if((int)$tanggalfrom==1){
	$awal=$stockawal->qty_stockawal;
	}
	else{
	$awal=((int)$stockawal->qty_stockawal+(int)stockIn($a, $from, $to))-
	((int)Sold($a, $from, $to)+(int)stockDis($a, $from, $to));
	}
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
  $moduls = $Tmodul->findAllDesc('id_orders');

  break;
//form page
  case "form":

if($_GET[id])
		{
		$act="?page=$page&act=form&pro=update&id=$_GET[id]";
		$id=Baggeo_Decrypt($_GET['id']);
        $currentModul = $Tmodul->findBy('id_orders', $id);
        $currentModul = $currentModul->current();
		$currentMember = $Tmember->findBy('id_members', $currentModul->id_members);
        $currentMember = $currentMember->current();
		$orders = $Torder->findBy('id_orders', $currentModul->id_orders);
		$label="Edit";
		}
		else
		{
		$act="?page=$page&act=form&pro=input";
		$label="Add Data";
		}
		//$headers = $Tmodul->findBy('status', '1');
		
		
     break;
}
?>
