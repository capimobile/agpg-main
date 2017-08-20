<?php
require '../App/db/Connect.php';
require '../App/lib/Table.php';
require '../App/lib/access_db.php';
require '../App/lib/manipulate.php';

$Tpo = new Table('po'); 
$Ttermin = new Table('termin'); 
$Tproduct = new Table('product'); 
$products = $Tproduct->findAll();
	function statusPO($a){
		if($a==1){
			$tp='Sukses';
		}
		elseif($a==2){
			$tp='Di Tolak';
		}
		elseif($a==0){
			$tp='Menunggu';
		}
		return $tp;
	}
$looppo = $Tpo->findValue("id_users='".$_SESSION['user_id']."' AND no_po='".$_GET['id']."'");
?>
<html>
<title></title>
<head>
</head>
<body>
								  <table width="1200" align="center">
                                  	  <tr>
                                  	  	<td width="100">Nama</td><td>: <strong><?=selectQ('users', 'id_users', selectQ('po', 'no_po', $_GET['id'], 'id_users'), 'name_users')?></strong></td>
                                      </tr>
                                      <tr>
                                      	<td>Nomor PO</td><td>: <strong>PO<?=$_GET['id']?></strong></td>
                                      </tr>
                                      <tr>
                                      	<td>Tanggal PO</td><td>: <?=selectQ('po', 'no_po', $_GET['id'], 'post_date')?></td>
                                      </tr>
                                      <tr>
                                      	<td>PO Status</td><td>: <?=statusPO(selectQ('po', 'no_po', $_GET['id'], 'status_po'))?></td>
                                      </tr>
                                  </table>
                            <table cellspacing="0" cellpadding="0" width="1200" align="center" border="1">
                              <thead>
                              <tr>
                                  <th width="50">#</th>
                                  <th width="350">Item</th>
                                  <th class="" width="200">Harga/ Pcs</th>
                                  <th class="" width="200">Qty</th>
                                  <th class="" width="200">Discount</th>
                                  <th width="200">Total</th>
                              </tr>
                              </thead>
                              <tbody>
                              <?php
							  $no=1;
							  foreach($looppo as $loopp){
								$jual=selectQ('product', 'id_product', $loopp->id_product, 'hjual_product');
								$dsc=$loopp->dsc_po;
								$tjual=$jual-$dsc;
							  $subtotal=$subtotal+($tjual*$loopp->qty_po);
							  ?>
                              
                              <tr>
                                  <td><?=$no?></td>
                                  <td><?=selectQ('product', 'id_product', $loopp->id_product, 'name_product')?></td>
                                  <td>Rp. <?=rupiah($jual)?></td>
                                  <td class=""><?=$loopp->qty_po?></td>
                                  <td class="">Rp. <?=rupiah($dsc)?>/ Pcs</td>
                                  <td>Rp. <?=rupiah($tjual*$loopp->qty_po)?></td>
                              </tr>
                              <?php $no++;}
							  $grandtotal=$subtotal-selectQ('xtradiscount', 'no_po', $_GET['id'], 'jml_xtradiscount');?>
                              <tr>
                              	  <td colspan="5" align="right" style="font-weight:bold">Total</td>
                                  <td style="font-weight:bold">: Rp. <?=rupiah($subtotal)?></td>
                              </tr>
                              <tr>
                              	  <td colspan="5" align="right" style="font-weight:bold">Xtra Discount</td>
                                  <td style="font-weight:bold">: Rp. <?=rupiah(selectQ('xtradiscount', 'no_po', $_GET['id'], 'jml_xtradiscount'))?></td>
                              </tr>
                              <tr>
                              	  <td colspan="5" align="right" style="font-weight:bold">Grand Total</td>
                                  <td style="font-weight:bold">: Rp. <?=rupiah($grandtotal)?></td>
                              </tr>
                              <?php if(selectQ('po', 'no_po', $_GET['id'], 'status_po')==1){?>
                              <tr>
                              	  <td colspan="2" align="right" style="font-weight:bold;">Pembayaran</td>
                                  <td colspan="4" style="font-weight:bold">
                                      <?php for($a=1; $a<=selectQ('po', 'no_po', $_GET['id'], 'termin'); $a++){?>
                                          Termin <?=$a?> : Rp. <?=rupiah(selectV('termin', "no_po='".$_GET['id']."' AND jumlah_termin='".$a."'", 'bayar_termin'))?><br>
                                          <?php 
										  $tbayar=$tbayar+selectV('termin', "no_po='".$_GET['id']."' AND jumlah_termin='".$a."'", 'bayar_termin');
										  }?>
                                          
                                  </td>
                              </tr>
                              <tr>
                              	  <td colspan="2" align="right" style="font-weight:bold">Note</td>
                                  <td colspan="4" style="font-weight:bold"><?=selectQ('po', 'no_po', $_GET['id'], 'note')?></td>
                              </tr>
                          	  <?php }?>
                              </tbody>        
                          </table>
</body>
</html>