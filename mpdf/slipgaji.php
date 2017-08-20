<?php
require 'App/lib/Table.php';
require 'App/lib/access_db.php';
require 'App/lib/manipulate.php';

$Tproduct = new Table('product'); 
$Tkproduct = new Table('kategoriproduct'); 
$Tstockin = new Table('stockin'); 
$Tdisposal = new Table('disposal'); 

$kproducts = $Tkproduct->findAll();

$stocks = $Tstockin->findValue("id_product='".Baggeo_Decrypt($_GET['id'])."' ORDER BY id_stockin DESC");
$disposals = $Tdisposal->findValue("id_product='".Baggeo_Decrypt($_GET['id'])."' ORDER BY id_disposal DESC");
$products = $Tproduct->findAll();


function stockAwal($a){
	$tahunfrom=substr($_GET['from'],0,4);
	$bulanfrom=substr($_GET['from'],5,2);
	$tanggalfrom=substr($_GET['from'],8,2);
	
	$tahunto=substr($_GET['to'],0,4);
	$bulanto=substr($_GET['to'],5,2);
	$tanggalto=substr($_GET['to'],8,2);
	
	$Tstockawal = new Table('stockawal'); 
	$stockawal = $Tstockawal->findValue("id_product='".$a."' AND bulan_stockawal='".(int)$bulanfrom."' AND tahun_stockawal='".$tahunfrom."'");
	$stockawal = $stockawal->current();
	
	$from=$tahunfrom.'-'.$bulanfrom.'-'.'01';
	$to=date("Y-m-d", strtotime("-1 day", strtotime($_GET['from'])));
	if((int)$tanggalfrom==1){
	$awal=$stockawal->qty_stockawal;
	}
	else{
	$awal=((int)$stockawal->qty_stockawal+(int)stockIn($a, $from, $to))-
	((int)StockOut($a, $from, $to)+(int)Sold($a, $from, $to)+(int)stockDis($a, $from, $to));
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
	$orders = $Torders->findValue("date_sold>='".$b."' AND date_sold<='".$c."' AND status_order='1'");
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

function StockOut($a, $b, $c){
	$Torders = new Table('po'); 
	$orders = $Torders->findValue("date_po>='".$b."' AND date_po<='".$c."' AND status_po='1' AND id_product='".$a."'");
	 foreach($orders as $order){
		 $stockn=$stockn+$order->qty_po;
	 }

	return $stockn;
}

function StockAkhir($a, $b, $c){
	$stockn=((int)stockAwal($a)+
			(int)stockIn($a, $b, $c))-((int)StockOut($a, $b, $c)
			+(int)Sold($a, $b, $c)+(int)stockDis($a, $b, $c));

	return $stockn;
}
?>
<html>
<title</title>
<head>
</head>
<body>
<h4>Laporan Stock : <?=changedate($_GET['from'])?> - <?=changedate($_GET['to'])?></h4>
                                    <table  class="display table table-bordered table-striped" id="example">
                                      <thead>
                                      <tr>
                                          <th>No</th>
                                          <th>Nama Barang</th>
                                          <th>UOM</th>
                                          <th>Stock Awal</th>
										  <th>Stock In</th>
										  <th>Stock Out</th>
                                          <th>Sold</th>
                                          <th>Disposal</th>
                                          <th>Stock Akhir</th>
                                      </tr>
                                      </thead>
                                      <tbody>
                                      <?php $no=1;
				    				  foreach($products as $product){									
									  ?>
                                      <tr>
                                          <td><?= $no ?></td>
                                          <td><?= $product->name_product?></td>
                                          <td><?=selectQ('satuan', 'id_satuan', $product->kemasan_product, 'name_satuan')?></td>
										  <td> <?=(int)stockAwal($product->id_product)?> </td>
										  <td><?=(int)stockIn($product->id_product, $_GET['from'], $_GET['to'])?></td>
                                          <td> <?=(int)StockOut($product->id_product, $_GET['from'], $_GET['to'])?> </td>
                                          <td> <?=(int)Sold($product->id_product, $_GET['from'], $_GET['to'])?> </td>
                                          <td><?=(int)stockDis($product->id_product, $_GET['from'], $_GET['to'])?></td>
										  <td><?=(int)stockAkhir($product->id_product, $_GET['from'], $_GET['to'])?></td>
                                      </tr>    
                                      <?php $no++; } ?>           
                          </table>
</body>
</html>