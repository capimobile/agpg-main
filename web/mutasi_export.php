<?php
ob_start();
require '../App/db/Connect.php';
require '../App/lib/Table.php';
require '../App/lib/access_db.php';
require '../App/lib/manipulate.php';


    $export_file = "Mutasi-".date('Y-m-d').".xls";
    header('Content-Type: application/vnd.ms-excel;');
    header("Content-type: application/x-msexcel");
    header('Content-Disposition: attachment; filename="'.basename($export_file).'"');

  if($_GET['from'] != ''){
    $tgl1=$_GET['from'];
    $tgl2=$_GET['to'];
  } else {
    $tgl1=date('Y-m-d');
    $tgl2=date('Y-m-d');
  }

  //echo"<script>alert('SELECT * FROM transfer where tanggal between '".$tgl1." 00:00:00' and '".$tgl2." 23:59:59');</script>"; 
  $transfers ="(SELECT * FROM data_bank where tgl_proses between '".$tgl1." 00:00:00' and '".$tgl2." 23:59:59')";
  $transfer=mysql_query($transfers, Connect::getConnection());

  $total_out = mysql_query("SELECT SUM(jumlah) as total_out FROM data_bank  where tipe ='K' and tgl_proses between '".$tgl1." 00:00:00' and '".$tgl2." 23:59:59'",  Connect::getConnection());
  $total_in = mysql_query("SELECT SUM(jumlah) as total_in FROM data_bank  where tipe ='D' and tgl_proses between '".$tgl1." 00:00:00' and '".$tgl2." 23:59:59'",  Connect::getConnection());

  ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>JURNAL TANGGAL <? ?></title>

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
                          <h4>Mutasi Bank : <?=changedate($_GET['from'])?> - <?=changedate($_GET['to'])?></h4>
                                    <table  border="1" cellpadding="0" cellspacing="0" width="100%" bordercolor="#ccc">
                                      <thead>
                                      <tr style="font-weight:bold; font-size:14px;">
                                          <th>Tanggal Update</th>
                                          <th>Bank</th>
                                          <th>No. Rekening</th>
                                          <th>D/K</th>
                                          <th>STS</th>
                                          <!-- <th>ID Cabang</th> -->
                                          <th>Mutasi</th>
                                          <th>Saldo</th>
                                          <th>Keterangan</th>
                                      </tr>
                                      </thead>
                                      <tbody>
                                      <?php $no=1;
                                        while($r=mysql_fetch_array($transfer)){
                                      ?>
                                      <tr style="font-weight:normal; font-size:14px;">
                                          <td><?= $r[tgl_proses]?></td>
                                          <td><?= $r[bank]?></td>
                                          <td><?= $r[no_rek]?></td>
                                          <td><?= $r[tipe]?> </td>
                                          <td><?= $r[terklaim]?></td>
                                          <!-- <td><?= $r[catatan]?> </td> -->
                                          <td>Rp.<?= rupiah($r[jumlah])?></td>
                                          <td>Rp.<?= rupiah($r[saldo])?></td>
                                          <td><?= $r[keterangan]?></td>
                                      </tr>    
                                      <?php $no++; }?>
                                      <?php
                                        while($r=mysql_fetch_object($total_out)){
                                      ?>
                                      <tr>
                                        <td colspan="5" align="left" style="font-size:14px; font-weight:bold;">TOTAL PEMASUKAN</td>
                                        <td colspan="3"style="font-size:14px; font-weight:bold;">Rp. <?php echo rupiah($r->total_out)?></td>
                                      </tr>
                                      <?php }?>
                                      <?php
                                        while($r=mysql_fetch_object($total_in)){
                                      ?>
                                      <tr>
                                        <td colspan="5" align="left" style="font-size:14px; font-weight:bold;">TOTAL PENGELUARAN</td>
                                        <td colspan="3"style="font-size:14px; font-weight:bold;">Rp. <?php echo rupiah($r->total_in)?></td>
                                      </tr>
                                      <?php }?>
                                      </tbody>        
                          </table>
                 </table> 
</body>

</html>
<?php ob_end_flush();?>

