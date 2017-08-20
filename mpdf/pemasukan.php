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

$Tpo = new Table('po'); 
$po = $Tpo->findDistinct("no_po", "WHERE status_po='1' AND date_po>='".$_GET['from']."' AND date_po<='".$_GET['to']."' ORDER BY id_po ASC");

$Tusers = new Table('users'); 
$users = $Tusers->findValue("id_levelusers='6'");

function terminPO($a){
	$Ttermin = new Table('termin'); 
	$termin = $Ttermin->findValue("no_po='".$a."'");
	foreach($termin as $termins){
		$tterm=$tterm+$termins->bayar_termin;		
	}
	return $tterm;
}

function salesPO($a){
	$Tpo = new Table('po'); 
	$po = $Tpo->findValue("no_po='".$a."'");
	foreach($po as $loopp){
		$jual=selectQ('product', 'id_product', $loopp->id_product, 'hjual_product');
								$dsc=$loopp->dsc_po;
								$tjual=$jual-$dsc;
							  $subtotal=$subtotal+($tjual*$loopp->qty_po);
	}
	$grandtotal=$subtotal-selectQ('xtradiscount', 'no_po', $a, 'jml_xtradiscount');
	return $grandtotal;
}?>
<html>
<title></title>
<head>
</head>
<body>
<table align="center" width="700">
<tr><td>
<h4>Laporan pemasukan PO : <?=changedate($_GET['from'])?> - <?=changedate($_GET['to'])?></h4>
</td></tr>
</table>
                                    <table cellspacing="0" cellpadding="0" width="700" align="center" border="1">
                                      <thead>
                                      <tr>
                                          <th width="30">No</th>
                                          <th width="120">Tanggal</th>
                                          <th width="70">No PO</th>
                                          <th width="120">Cabang</th>
                                          <th width="120">Sales</th>
                                          <th width="120">Termin Bayar</th>
                                          <th width="120">Note</th>  
                                      </tr>
                                      </thead>
                                      <tbody>
                                      <?php $no=1;
				    				  foreach($po as $pos){									
									  ?>
                                      <tr>
                                          <td><?= $no ?></td>
                                          <td><?=selectQ('po', 'no_po', $pos->no_po, 'date_po')?></td>
                                          <td>PO<?=$pos->no_po?></td>
                                          <td><?=selectQ('users', 'id_users', selectQ('po', 'no_po', $pos->no_po, 'id_users'), 'name_users')?></td>
										  <td>Rp. <?=rupiah(salesPO($pos->no_po))?></td>
                                          <td>Rp. <?=rupiah(terminPO($pos->no_po))?></td>
                                          <td><?=selectQ('po', 'no_po', $pos->no_po, 'note')?></td>
                                      </tr>      
                                      <?php 
									  $salespo=$salespo+salesPO($pos->no_po);
									  $terminpo=$terminpo+terminPO($pos->no_po);
									  $no++; } ?>
                                      <tr>
                                          <td colspan="4" style="font-weight:bold;">TOTAL</td>
										  <td>Rp. <?=rupiah($salespo)?></td>
                                          <td>Rp. <?=rupiah($terminpo)?></td>
                                          <td></td>
                                      </tr>   
                                      </tbody>        
                          </table>
</body>
</html>