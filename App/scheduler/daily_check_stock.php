<?php
// ob_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// require'App/lib/Table.php';
// require'App/lib/Select.php';
require(__DIR__.'/../../App/lib/Table.php');
require(__DIR__.'/../../App/lib/Select.php');

echo('start daily check stock db');
echo("<br/>");

$Ttrendstock = new Table('trend_stock');
$Tproduct = new Table('product'); 
$Tstockin = new Table('stockin'); 
$Tdisposal = new Table('disposal'); 

// $kproducts = $Tkproduct->findAll();


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
	$stockin = $Tstockawal->findValue("id_product='".$a."' AND date_stockin='".$b."'");
	 foreach($stockin as $stockins){
		 $stockn=$stockn+$stockins->qty_stockin;
	 }

	return $stockn;
}
function stockDis($a, $b, $c){
	$Tstockawal = new Table('disposal'); 
	$stockin = $Tstockawal->findValue("id_product='".$a."' AND date_disposal='".$b."'");
	 foreach($stockin as $stockins){
		 $stockn=$stockn+$stockins->qty_disposal;
	 }

	return $stockn;
}
function Sold($a, $b, $c){
	$Torders = new Table('orders'); 
	$orders = $Torders->findValue("tgl_order='".$b."'");
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


/*Define variable stock*/
$stock_awal = stockAwal(1);
$stock_in = (int)stockIn(1, date('Y-m'), date('Y-m'));
$stock_out = (int)Sold(1, date('Y-m'), date('Y-m'));
$stock_disposal = (int)stockDis(1, date('Y-m'), date('Y-m'));
$stock_akhir = $stock_awal + $stock_in - $stock_out + $stock_disposal;

/*Insert into trend stock*/
	$Ttrendstock->save(array(
		'id_product' => 1,
		'date_stock' => date('Y-m-d'),
		'stock_awal' => $stock_awal,
		'stock_in'=> $stock_in,
		'stock_out'=> $stock_out,
		'stock_disposal'=> $stock_disposal
	));
echo("<br/>");
echo('finish daily maintenance db');


/*echo("".(int)Sold(1, date('Y-m-d'), date('Y-m-d'))."");
echo("<br/>");*/


// echo("AYAM :".(int)Sold(3, '2017-08-04', '2017-08-04')."");
// echo("<br/>");
// echo("DLL :".(int)Sold(2, '2017-08-05', '2017-08-05')."");
// echo("<br/>");
// echo("DLL :".(int)Sold(3, '2017-08-05', '2017-08-05')."");
// echo("<br/>");
// echo("DLL :".(int)Sold(4, '2017-08-05', '2017-08-05')."");
// echo("<br/>");
// echo("DLL :".(int)Sold(5, '2017-08-05', '2017-08-05')."");
// echo("<br/>");
// echo("DLL :".(int)Sold(6, '2017-08-05', '2017-08-05')."");
// echo("<br/>");




 mysql_close();
 //ob_end_flush();
?>