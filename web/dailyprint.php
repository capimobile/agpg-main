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

$Tmodul = new Table('orders');
$Torder = new Table('orders_detail');
$Tcabang = new Table('cabang');
$cabangs = $Tcabang->findAll();
  
  $dates=$_GET['tanggal'];
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

<title>SALES DAILY REPORT TANGGAL <?=$dates?></title>

<style>

	body{
		font-size:14px;
		font-family:"Lucida Sans Unicode", "Lucida Grande", sans-serif
	}
	td, th{
		padding:4px 2px;
		text-transform:uppercase;
	}
	th{
		background:#f8f8f8;
	}

</style>

</head>

<body onLoad="window.print();">
				 <table style="margin:auto;" cellpadding="0" cellspacing="0" width="800">
                     <tr>
                        <td colspan="5" style="font-weight:bold; font-size:18px" align="center">
                            ORDER DAILY REPORT <BR />
							AYAM GEPUK PAK GEMBUS
                        </td>
                     </tr>
                     <tr>
                        <td colspan="5" style="font-weight:bold;">
                            Tanggal : <?=changedate($dates)?>
                        </td>
                     </tr>
                 </table>
                 <table style="margin:auto;" cellpadding="0" cellspacing="0" border="1" width="800">
                                      <thead>
                                      <tr>
                                          <th width="40">No</th>
                                          <th>Tanggal</th>
                                          <th>Cabang</th>
                                          <th>Amount</th>
                                          <th width="250">Keterangan</th>
                                      </tr>
                                      </thead>
                                      <tbody>
                                      <?php $no=1;
				    				  foreach($moduls as $modul){
										  $ttds=$ttds+salesSold($dates, $modul->id_cabang);
									  ?>
                                      <tr>
                                          <td><?= $no ?></td>
                                          <td><?php echo changedate($dates)?></td>
                                          <td><?=selectQ('cabang', 'id_cabang', $modul->id_cabang, name_cabang)?></td>
                                          <td>
                                          	Rp. <?=rupiah(salesSold($dates, $modul->id_cabang))?>
                                          </td>
                                          <td>
                                          	
                                          </td>
                                      </tr>    
                                      <?php $no++; } ?> 
                                      <tr>
                                      	  <td colspan="3" style="font-weight:bold">TOTAL</td>
                                          <td style="font-weight:bold" colspan="2">Rp. <?=rupiah($ttds)?></td>
                                      </tr>    
                                      </tbody>      
                </table> 
          
</body>

</html>
<?php ob_end_flush();?>

