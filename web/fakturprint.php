<?php
ob_start();
require '../App/db/Connect.php';
require '../App/lib/Table.php';
require '../App/lib/access_db.php';
require '../App/lib/manipulate.php';

/*
    $export_file = "Salary ".selectQ('doctor', 'id_doctor', $_GET['idc'], 'name_doctor').' '.getBulan((int)$mh)." ".$yr.".xls";
    header('Content-Type: application/vnd.ms-excel;');
    header("Content-type: application/x-msexcel");
    header('Content-Disposition: attachment; filename="'.basename($export_file).'"');
*/

$Torder = new Table('orders_detail');
$orders = $Torder->findValue("id_orders='".$_GET['id']."' ORDER BY id_product ASC");
$id = $_GET['id'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>FAKTUR <?=$_GET['id']?>, TANGGAL <?=selectV('orders',"id_orders='".$_GET['id']."'",'tgl_order')?></title>

<style>

	body{
		font-size:16px;
		font-family:"Lucida Sans Unicode", "Lucida Grande", sans-serif
	}
	td{
		padding:0px 3px;
		text-transform:uppercase;
	}

</style>

</head>

<body onLoad="window.print();">
<table width="800" style="margin:auto">
<tr>
<td width="100%" colspan="2">
	<table width="100%"><tr>
					<td width="60%">
                          <table>
                          <tr><td style="font-weight:bold; font-size:19px;">AYAM GEPUK PAK GEMBUS</td></tr>
                          <tr><td>JL. MERUYA UTARA 8B, KEMBANGAN, JAKARTA BARAT</td></tr>
                          <tr><td>021 589 09723 </td></tr>
                          </table>
					</td>
					<td width="40%">
                          <table>
                          <tr><td>TANGGAL </td><td>: <?=changedate(selectV('orders',"id_orders='".$_GET['id']."'",'tgl_order'))?></td></tr>
                          <tr><td>NO.FAKTUR </td><td>: <?=selectV('orders',"id_orders='".$_GET['id']."'",'invoice')?></td></tr>
                          <tr><td>JAM ORDER </td><td>: <?=substr(selectV('orders',"id_orders='".$_GET['id']."'",'jam_order'),0,5)?> WIB</td></tr>
                          <tr><td>DUE DATE </td><td>: CASH N' CARRY</td></tr>
                          </table>
					</td>
     </tr></table>
</td>
</tr>
<tr>
	<td width="100%" colspan="2" style="font-weight:bold; padding-top:10px;">Kepada :  <span style="font-size:20px"><?=selectV('cabang',"id_cabang='".selectV('orders',"id_orders='".$_GET['id']."'",'id_cabang')."'",'name_cabang')?></span></td>
</tr>
<tr>
  <td width="100%" colspan="2" style="font-weight:bold;">Alamat :  <span style="font-size:15px;font-weight: normal;"><?=selectV('cabang',"id_cabang='".selectV('orders',"id_orders='".$_GET['id']."'",'id_cabang')."'",'lokasi_cabang')?></span></td>
</tr>
<tr>
	<td width="75%">
                          <table border="1" cellpadding="0" cellspacing="0" width="100%" bordercolor="#ccc">
                                      <thead>
                                      <tr style="border-bottom:thin solid #999;">
                                          <th width="30">No</th>
                                          <th>Material</th>
                                          <th width="50">Qty</th>
                                          <th>Price</th>
                                          <th>Total</th>
                                      </tr>
                                      </thead>
                                      <tbody>
                                      <?php $no=1;
										foreach ($orders as $order) {
											$total=$order->jumlah*$order->harga;
											$grand=$grand+$total;
									  ?>
                                      <tr>
                                          <td><?= $no ?></td>
                                          <td><?=selectQ('product', 'id_product', $order->id_product, 'name_product')?></td>
                                          <td class="center">
                                            <?=$order->jumlah?>
                                          </td>
                                          <td>Rp. <?php echo rupiah($order->harga);?></td>
                                          <td>Rp. <?php echo rupiah($total)?></td>
                                      </tr>    
                                      <?php $no++; } ?>
                                      <?php if(selectV('orders',"id_orders='".$_GET['id']."'",'discount_order')!=0){?>
                                      <tr>
                                      	<td colspan="4" align="right" style="padding:5px 10px;">DISCOUNT</td>
                                        <td>Rp. <?php echo rupiah(selectV('orders',"id_orders='".$_GET['id']."'",'discount_order'))?></td>
                                      </tr>
                                      <?php }?>
                                      <!-- <tr>
                                        <?php 
                                          $jumlah = selectV('orders_detail',"id_orders='".$id."' and id_product = 1",'jumlah');
                                          $item_franchise = selectV('product',"id_product=1",'bfranchise_product');
                                          $biaya_franchise = $jumlah * $item_franchise;
                                        ?>
                                        <td colspan="4" align="right" style="padding:5px 10px;">BIAYA FRANCHISE</td>
                                        <td>Rp. <?php echo($biaya_franchise);?>
                                        </td>
                                      </tr>
                                      <tr>
                                        <?php
                                          $kode_unik=selectV('deposit',"id_orders='".$id."'",'kode_unik');
                                        ?>
                                        <td colspan="4" align="right" style="padding:5px 10px;">KODE UNIK</td>
                                        <td>Rp. <?php echo ($kode_unik);?></td>
                                      </tr> -->
                                      <tr>
                                      	<td colspan="4" align="right" style="padding:5px 10px;">SHIPPING</td>
                                        <td>Rp. <?php echo rupiah(5000)?> <?php $shipping=5000;?></td>
                                      </tr>  
                                      <tr>
                                      	<td colspan="4" align="right" style="font-weight:bold; padding:5px 10px;">GRAND TOTAL</td>
                                        <td style="font-weight:bold;">Rp. <?php echo rupiah(($grand-selectV('orders',"id_orders='".$_GET['id']."'",'discount_order'))+$shipping)?></td>
                                      </tr>  
                                      </tbody>      
                </table>
	</td>
    <td width="25%">
    	<?php if(selectV('orders',"id_orders='".$id."'",'note_order')!=' '){?> 
             <span style="font-weight:bold;">Note :</span>
        <?php }?><br />
    	<?=selectV('orders',"id_orders='".$_GET['id']."'",'note_order')?>
    </td>
</tr>
<tr>
	<td width="100%" colspan="2">
    	<table width="100%">
        	<tr>
            	<td width="25%" align="center">
                	Penerima
                    <br /><br /><br /><br /><br />
                    (.............................)
                </td>
                <td width="25%" align="center">
                	Kurir
                    <br /><br /><br /><br /><br />
                    (.............................)
                </td>
                <td width="25%" align="center">
                	Hormat Kami
                    <br /><br /><br /><br /><br />
                    (.............................)
                </td>
                <td width="25%" align="center">
                	PACKAGER
                    <br /><br /><br /><br /><br />
                    (.............................)
                </td>
            </tr>
        </table>
        <table width="100%" style="border:thin solid #666; padding:10px; margin-top:20px;">
        	<tr>
                <td colspan="4" style="font-weight:bold">Pembayaran Khusus Belanja & Royalty :</td>
            </tr>
            <tr>
                <td>
                    <img src="../../images/mandiri.png" height="30"/>
                </td>
                <td colspan="3">
                    <strong>165-0060-1511-16</strong><br />
					PT YELLOW FOOD INDONESIA
                </td>
            </tr>
            <tr>
                <td style="padding-top:10px;">
                    <img src="../../images/bca.png" height="30"/>
                </td>
                <td colspan="3" style="padding-top:10px;">
                    <strong>4190-555-777</strong><br />
					PT YELLOW FOOD INDONESIA
                </td>
            </tr>
        </table>
<!--         <table width="100%" style="border:thin solid #666; padding:10px; margin-top:10px;">
        	<tr>
                <td colspan="4" style="font-weight:bold">Pembayaran Khusus Franchise :</td>
            </tr>
            <tr>
                <td>
                    <img src="../../images/mandiri.png" height="30"/>
                </td>
                <td colspan="3">
                    <strong>165-002-225-0915</strong><br />
					Rido Nurul Adityawan
                </td>
            </tr>
        </table> -->
    </td>
</tr>
</table>
</body>

</html>
<?php ob_end_flush();?>

