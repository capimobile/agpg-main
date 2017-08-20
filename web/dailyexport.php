<?php
ob_start();
require '../App/db/Connect.php';
require '../App/lib/Table.php';
require '../App/lib/access_db.php';
require '../App/lib/manipulate.php';

    $export_file = "DailyReport-".date('Y-m-d').".xls";
    header('Content-Type: application/vnd.ms-excel;');
    header("Content-type: application/x-msexcel");
    header('Content-Disposition: attachment; filename="'.basename($export_file).'"');

$Tproduct = new Table('product'); 
$products = $Tproduct->findAll();

$Tmodul = new Table('orders');
$Torder = new Table('orders_detail');
$Tcabang = new Table('cabang');
$cabangs = $Tcabang->findAll();

if(isset($_GET['tanggal'])){
    $dates=$_GET['tanggal'];
  }
  else{
    $dates=date('Y-m-d');
  }
  $moduls = $Tmodul->findDistinct("id_cabang", "WHERE tgl_order='".$dates."'");
  
  function HgOrder($a){
  $Torders = new Table('orders_detail'); 
  $orders = $Torders->findValue("id_orders='".$a."'");
   foreach($orders as $order){
     $stockn=$stockn+($order->jumlah*$order->harga);
   }

  return $stockn;
  }

  function salesSold($a, $b){
  $Torders = new Table('orders'); 
  $orders = $Torders->findValue("tgl_order='".$a."' AND id_cabang='".$b."'");
   foreach($orders as $order){
     $stockn=$stockn+(HgOrder($order->id_orders)-$order->discount_order);
   }
  

  return $stockn;
  }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>FAKTUR <?=$_GET['id']?>, TANGGAL <?=selectV('orders',"id_orders='".$_GET['id']."'",'tgl_order')?></title>

<style>

	body{

		font-size:11px;

	}
	td{
		padding:5px;
		text-transform:uppercase;
	}

</style>

</head>

<body>
                   <table  width="750" style="margin:auto" >
                    <table border="1" cellpadding="0" cellspacing="0" width="100%" bordercolor="#ccc">
                                      <thead>
                                      <tr style="font-size:16px; font-weight:bold border-bottom:thin solid #999;">
                                          <th width="50">No</th>
                                          <th>Tanggal</th>
                                          <th>Cabang</th>
                                          <th width="850">Lokasi</th>
                                          <th>Kurir</th>
                                          <th>Amount</th>
                                      </tr>
                                      </thead>
                                      <tbody>
                                      <?php $no=1;
                      foreach($moduls as $modul){
                      $ttds=$ttds+salesSold($dates, $modul->id_cabang);
                    ?>
                                      <tr style="font-size:14px; border-bottom:thin solid #999;">
                                          <td><?= $no ?></td>
                                          <td><?php echo changedate($dates)?></td>
                                          <td><?=selectQ('cabang', 'id_cabang', $modul->id_cabang, name_cabang)?></td>
                                          <td><?=selectQ('cabang', 'id_cabang', $modul->id_cabang, lokasi_cabang)?></td>
                                          <td><?= selectQ('kurir', 'id_kurir', selectQ('cabang', 'id_cabang', $modul->id_cabang, id_kurir), name_kurir)?></td>
                                          <!-- <td><?= selectQ('kurir', 'id_kurir', selectV('orders',"tgl_order='".$dates."' AND id_cabang='".$modul->id_cabang."'", 'id_kurir'), name_kurir)?></td> -->
                                          <td>Rp. <?=rupiah(salesSold($dates, $modul->id_cabang))?></td>
                                      </tr>    
                                      <?php $no++; } ?> 
                                      <tr>
                                          <td colspan="5" style="font-weight:bold">TOTAL</td>
                                          <td style="font-weight:bold">Rp. <?=rupiah($ttds)?></td>
                                      </tr>    
                                      </tbody>      
                </table> 
                 </table> 
<!-- <table width="750" style="margin:auto">
<tr>
<td width="50%">
                          <table>
                          <tr><td style="font-weight:bold; font-size:14px;">AYAM GEPUK PAK GEMBUS</td></tr>
                          <tr><td>JL. MERUYA UTARA 8B, KEMBANGAN, JAKARTA BARAT</td></tr>
                          <tr><td>+6285 7700 66705 </td></tr>
                          </table>
</td>
<td width="50%">
                          <table>
                          <tr><td>TANGGAL </td><td>: <?=selectV('orders',"id_orders='".$_GET['id']."'",'tgl_order')?></td></tr>
                          <tr><td>NO.FAKTUR </td><td>: <?=selectV('orders',"id_orders='".$_GET['id']."'",'invoice')?></td></tr>
                          <tr><td>DUE DATE </td><td>: CASH N' CARRY</td></tr>
                          </table>
</td></tr>
<tr>
	<td width="100%" colspan="2">Kepada :  <?=selectV('cabang',"id_cabang='".selectV('orders',"id_orders='".$_GET['id']."'",'id_cabang')."'",'name_cabang')?></td>
</tr>
<tr><td width="100%" colspan="2">
                          <table border="1" cellpadding="0" cellspacing="0" width="100%" bordercolor="#ccc">
                                      <thead>
                                      <tr style="border-bottom:thin solid #999;">
                                          <th width="50">No</th>
                                          <th>Material</th>
                                          <th width="80">Qty</th>
                                          <th>Price</th>
                                          <th>Total</th>
                                      </tr>
                                      </thead>
                                      <tbody>
                                      <?php $no=1;
										foreach ($orders as $order) {
											$total=$order->jumlah*selectQ('product', 'id_product', $order->id_product, 'hjual_product');
											$grand=$grand+$total;
									  ?>
                                      <tr>
                                          <td><?= $no ?></td>
                                          <td><?=selectQ('product', 'id_product', $order->id_product, 'name_product')?></td>
                                          <td class="center">
                                            <?=(int)$order->jumlah?>
                                          </td>
                                          <td>Rp. <?php echo rupiah(selectQ('product', 'id_product', $order->id_product, 'hjual_product'));?></td>
                                          <td>Rp. <?php echo rupiah($total)?></td>
                                      </tr>    
                                      <?php $no++; } ?>
                                      <tr>
                                      	<td colspan="4" align="right" style="font-size:12px; font-weight:bold; padding:5px 10px;">GRAND TOTAL</td>
                                        <td style="font-size:12px; font-weight:bold;">Rp. <?php echo rupiah($grand)?></td>
                                      </tr>  
                                      </tbody>      
                </table>
</td></tr>
<tr>
	<td width="100%" colspan="2">
    	<table>
        	<tr>
            	<td width="20%" align="center">
                	Penerima
                    <br /><br /><br /><br /><br />
                    (.............................)
                </td>
                <td width="20%" align="center">
                	Kurir
                    <br /><br /><br /><br /><br />
                    (.............................)
                </td>
                <td width="20%" align="center">
                	Hormat Kami
                    <br /><br /><br /><br /><br />
                    ( JIMMY S. KURNIAWAN )
                </td>
                <td width="20%" align="center">
                	PACKAGER SAYUR
                    <br /><br /><br /><br /><br />
                    (.............................)
                </td>
                <td width="20%" align="center">
                	PACKAGER AYAM
                    <br /><br /><br /><br /><br />
                    (.............................)
                </td>
            </tr>
            <tr>
            	<td width="100%" colspan="5">
                	*CEK BARANG TERLEBIH DAHULU SEBELUM KURIR MENINGALKAN LOKASI<BR />
                    *COMPLAIN TIDAK DI TERIMA JIKA KURIR SUDAH MENINGGALKAN LOKASI<BR />
                    *PASTIKAN BARANG YANG DI TERIMA SESUAI DENGAN PESANAN ANDA<BR />
                    *PASTIKAN PEMBAYARAN CASH N'  CARRY DAN DI BERIKAN KEPADA KURIR<BR />
                    *BATAS WAKTU PEMESANAN AYAM DAN BAHAN BAKU MAX JAM 01.00, JIKA TELAT ORDERAN DIBATALKAN
                </td>
            </tr>
        </table>
    </td>
</tr>
</table> -->
</body>

</html>
<?php ob_end_flush();?>

