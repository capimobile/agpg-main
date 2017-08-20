<?php
require '../App/db/Connect.php';
require '../App/lib/Table.php';
require '../App/lib/access_db.php';
require '../App/lib/manipulate.php';

$Tproduct = new Table('product'); 
$Tkproduct = new Table('kategoriproduct'); 
$Tstockin = new Table('stockin'); 
$Tdisposal = new Table('disposal'); 

$kproducts = $Tkproduct->findAll();

$stocks = $Tstockin->findValue("id_product='".Baggeo_Decrypt($_GET['id'])."' ORDER BY id_stockin DESC");
$disposals = $Tdisposal->findValue("id_product='".Baggeo_Decrypt($_GET['id'])."' ORDER BY id_disposal DESC");
$products = $Tproduct->findAll();

function Sold($a, $b, $c){
	$Torders = new Table('orders'); 
	$orders = $Torders->findValue("tgl_order>='".$b."' AND tgl_order<='".$c."' AND status_order='1'");
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

function DiscOrder($a){
								$dsc=selectQ('product', 'id_product', $a, 'discount_product');
								if(selectQ('product', 'id_product', $a, 'drp_product')==1){
									$cdsc=$dsc;
								}
								elseif(selectQ('product', 'id_product', $a, 'drp_product')==2){
									$cdsc=(selectQ('product', 'id_product', $a, 'hjual_product')*$dsc)/100;
								}
								else{
									$cdsc=0;
								}
	return $cdsc;
}

function StockOut($a, $b, $c){
	$Torders = new Table('po'); 
	$orders = $Torders->findValue("date_po>='".$b."' AND date_po<='".$c."' AND status_po='1' AND id_product='".$a."'");
	 foreach($orders as $order){
		 $stockn=$stockn+$order->qty_po;
	 }

	return $stockn;
}

function salesOut($a, $b, $c){
	$Tpo = new Table('po'); 
	$po = $Tpo->findValue("date_po>='".$b."' AND date_po<='".$c."' AND status_po='1' AND id_product='".$a."'");
	foreach($po as $loopp){
		$jual=selectQ('product', 'id_product', $loopp->id_product, 'hjual_product');
								$dsc=$loopp->dsc_po;
								$tjual=$jual-$dsc;
							  $subtotal=$subtotal+($tjual*$loopp->qty_po);
	}
	return $subtotal;
}
function salesSold($a, $b, $c){
	$Torders = new Table('orders'); 
	$orders = $Torders->findValue("tgl_order>='".$b."' AND tgl_order<='".$c."' AND status_order='1'");
	$jual=selectQ('product', 'id_product', $a, 'hjual_product');
	 foreach($orders as $order){
		 $stockn=$stockn+DetOrder($order->id_orders, $a);
		 $jumsold=$stockn*($jual-DiscOrder($a));
	 }
	

	return $jumsold;
}
?>
<html>
<title></title>
<head>
</head>
<body>
<table align="center" width="700">
<tr><td>
<h4>Laporan Sales Per-Product : <?=changedate($_GET['from'])?> - <?=changedate($_GET['to'])?></h4>
</td></tr>
</table>
                                    <table cellspacing="0" cellpadding="0" width="700" align="center" border="1">
                                      <thead>
                                      <tr>
                                          <th rowspan="2" width="30">No</th>
                                          <th rowspan="2" width="270">Nama Barang</th>
                                          <th rowspan="2" width="100">UOM</th>
										  <th colspan="2" width="150">Stock Out</th>
                                          <th colspan="2" width="150">Sold</th>
                                      </tr>
                                      <tr>
                                      		<th width="50">Qty</th>
                                            <th width="100">Sales</th>
                                            <th width="50">Qty</th>
                                            <th width="100">Sales</th>
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
                                          <td> <?=(int)StockOut($product->id_product, $_GET['from'], $_GET['to'])?> </td>
                                          <td>Rp. <?=rupiah(salesOut($product->id_product, $_GET['from'], $_GET['to']))?></td>
                                          <td> <?=(int)Sold($product->id_product, $_GET['from'], $_GET['to'])?> </td>
										  <td>Rp. <?=rupiah(salesSold($product->id_product, $_GET['from'], $_GET['to']))?></td>
                                      </tr>    
                                      <?php $no++; } ?>   
                                      </tbody>        
                          </table>
</body>
</html>