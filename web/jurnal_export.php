<?php
ob_start();
require '../App/db/Connect.php';
require '../App/lib/Table.php';
require '../App/lib/access_db.php';
require '../App/lib/manipulate.php';


    $export_file = "Jurnal-".date('Y-m-d').".xls";
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

  echo"<script>alert('SELECT * FROM transfer where tanggal between '".$tgl1." 00:00:00' and '".$tgl2." 23:59:59');</script>"; 
  $transfers ="(SELECT * FROM jurnal where input_date between '".$tgl1." 00:00:00' and '".$tgl2." 23:59:59')";

  $transfer=mysql_query($transfers, Connect::getConnection());

  $total_out = mysql_query("SELECT SUM(jml) as total_out FROM jurnal  where status ='Masuk' and input_date between '".$tgl1." 00:00:00' and '".$tgl2." 23:59:59'",  Connect::getConnection());
  $total_in = mysql_query("SELECT SUM(jml) as total_in FROM jurnal  where status ='Keluar' and input_date between '".$tgl1." 00:00:00' and '".$tgl2." 23:59:59'",  Connect::getConnection());
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
                          <h4>Laporan Jurnal : <?=changedate($_GET['from'])?> - <?=changedate($_GET['to'])?></h4>
                                    <table border="1" cellpadding="0" cellspacing="0" width="100%" bordercolor="#ccc">
                                      <thead>
                                      <tr  style="font-weight:bold; font-size:14px;">
                                          <th>Tanggal</th>
                                          <th>Report Bank</th>
                                          <th>Jumlah</th>
                                          <th>Bank</th>
                                          <th>Cabang/Supplier</th>
                                          <th>Status</th>
                                          <th>Tipe</th>
                                          <th>Input</th>
                                      </tr>
                                      </thead>
                                      <tbody>
                                      <?php $no=1;
                                        while($r=mysql_fetch_array($transfer)){
                                      ?>
                                      <tr style="font-weight:normal; font-size:14px;">
                                          <td><?= $r[tanggal]?></td>
                                          <td><?= $r[report_bank]?></td>
                                          <td><?= $r[jml]?></td>
                                          <td><?= $r[bank]?> </td>
                                          <td><?= selectV('cabang',"id_cabang='".$r[id_cabang]."'","name_cabang");?></td>
                                          <td><?= $r[status]?> </td>
                                          <td><?= $r[tipe]?></td>
                                          <td><?= $r[input_by]?></td>
                                      </tr>    
                                      <?php $no++; }?>
                                     <?php
                                        while($r=mysql_fetch_object($total_out)){
                                      ?>
                                      <tr style="font-weight:bold; font-size:14px;">
                                        <td colspan="2" align="left" style="font-size:14px; font-weight:bold; padding:5px 10px;">TOTAL PEMASUKAN</td>
                                        <td colspan="6"style="font-size:14px; font-weight:bold;"><?php echo($r->total_out)?></td>
                                      </tr>
                                      <?php }?>
                                      <?php
                                        while($r=mysql_fetch_object($total_in)){
                                      ?>
                                      <tr style="font-weight:bold; font-size:14px;">
                                        <td colspan="2" align="left" style="font-size:14px; font-weight:bold; padding:5px 10px;">TOTAL PENGELUARAN</td>
                                        <td colspan="6"style="font-size:14px; font-weight:bold;"><?php echo($r->total_in)?></td>
                                      </tr>
                                      <?php }?>
                                      </tbody>        
                          </table>
                 </table> 
</body>

</html>
<?php ob_end_flush();?>

