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
}
?>
