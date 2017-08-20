<?php
ob_start();
require '../App/db/Connect.php';
require '../App/lib/Table.php';
require '../App/lib/access_db.php';
require '../App/lib/manipulate.php';
require '../App/lib/paging.php';

$p      = new Paging;
$batas  = 10;
$posisi = $p->cariPosisi($batas);

if(isset($_GET['users'])){
	$idusers="AND id_users='".$_GET['users']."'";
}

$Tproduct = new Table('product'); 
$products = $Tproduct->findAll();

$Tcabang = new Table('cabang');
$cabangs = $Tcabang->findValue("1=1 $idusers ORDER BY name_cabang ASC LIMIT $posisi,$batas");
$Torder = new Table('orders_detail');
$orders = $Torder->findValue("id_orders='".$_GET['id']."' ORDER BY id_product ASC");

  if(isset($_GET['tanggal'])){
	  $dates=$_GET['tanggal'];
  }
  else{
	  $dates=date('Y-m');
  }

function dataAyam($a, $b){
	$Tord = new Table('orders');
	$ords = $Tord->findValue("tgl_order='".$a."' AND id_cabang='".$b."'");
	foreach($ords as $ord){
		$ayam=$ayam+selectV('orders_detail',"id_orders='".$ord->id_orders."' AND id_product=1",'jumlah');
	}
	return $ayam;
}
function totalAyam($a, $b, $c){
	$Tord = new Table('orders');
	$ords = $Tord->findValue("tgl_order>='".$a."' AND tgl_order<='".$b."' AND id_cabang='".$c."'");
	foreach($ords as $ord){
		$ayam=$ayam+selectV('orders_detail',"id_orders='".$ord->id_orders."' AND id_product=1",'jumlah');
	}
	return $ayam;
}
function totalOrder($a, $b, $c){
	$waktu_dari = $a;
	$waktu_sampai = $b;
	while (strtotime($waktu_dari) <= strtotime($waktu_sampai)) {
		$ttlorder=querynum3('orders',"tgl_order='".$waktu_dari."' AND id_cabang='".$c."'");
		if($ttlorder>0){
			$tto=1;
		}
		else{
			$tto=0;
		}
		$totalorder=$totalorder+$tto;
		$waktu_dari = date ("Y-m-d", strtotime("+1 day", strtotime($waktu_dari)));
	}
	return $totalorder;
}

if($_POST['subAct']==1){
	$Troyalty = new Table("royalty");
	if(querynum3("royalty","id_cabang='".$_POST['cabang']."' AND month_cabang='".$_POST['month']."' AND year_cabang='".$_POST['year']."'")==0){
		$Troyalty->save(array(
				'id_cabang' => $_POST['cabang'],
				'month_cabang' => $_POST['month'],
				'year_cabang' => $_POST['year']		
		));
		echo"<script>alert('Input Success'); self.history.back()</script>";	
		exit;
	}
	else{
		$Troyalty->deleteBy('id_royalty', selectV("royalty","id_cabang='".$_POST['cabang']."' AND month_cabang='".$_POST['month']."' AND year_cabang='".$_POST['year']."'",'id_royalty'));
		echo"<script>alert('Cancel Success'); self.history.back()</script>";	
		exit;
	}
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
		padding:5px 3px;
		text-transform:uppercase;
	}
	table tbody tr:nth-child(odd) { /* Make table like zebra */ background:#fff2cc; }

</style>

</head>

<body>
<div style="margin:auto; width:1600px;">
       				<table cellpadding="0" cellspacing="0" border="1" bordercolor="#000">
                                      <thead>
                                      <tr style="background:#ffe699">
                                          <th width="50" style="padding:5px; text-align:center;">NO</th>
                                          <th width="300" style="padding:5px; text-align:center;">CABANG</th>
                                          <?php
										  $databulan=explode("-",$dates);
										  $mnth=date('t',mktime(0,0,0,$databulan[1],1,$databulan[0]));
										  for($i=1; $i<=$mnth; $i++){
										  ?>
                                          	<th width="40"><?=$i?></th>
                                          <?php }?>
                                          <th width="90">TOTAL</th>
                                          <th width="90">PORSI</th>
                                          <th width="150">ROYALTY</th>
                                          <th width="90">RERATA EKOR</th>
                                          <th width="40">ST</th>
                                      </tr>
                                      </thead>
                                      <tbody>
                                      <?php $no=1+(($_GET['tablepage']-1)*$batas);
				    				  foreach($cabangs as $cabang){
									  ?>
                                      <tr>
                                          <td><?= $no ?></td>
                                          <td><?php echo $cabang->name_cabang;?></td>
                                          <?php
										  for($i=1; $i<=$mnth; $i++){
											  if(strlen($i)==1){
												  $day='0'.$i;
											  }
											  else{
												  $day=$i;
											  }
											  $dtayam=dataAyam($dates.'-'.$day, $cabang->id_cabang);
											  $totalorder=totalOrder($dates.'-01', $dates.'-'.$mnth, $cabang->id_cabang);
											  $total=totalAyam($dates.'-01', $dates.'-'.$mnth, $cabang->id_cabang);
										  ?>
                                          	<td width="40"
                                            <?php
												if(querynum3('orders',"tgl_order='".$dates.'-'.$day."' AND id_cabang='".$cabang->id_cabang."'")==0 AND $dates.'-'.$day < date('Y-m-d')){
													echo'style="background:#f08e4b";';
												}
												else{
													echo'';
												}
											?>
                                            ><?=$dtayam?></td>
                                          <?php }?>
                                          <td width="90"><?=$total?></td>
                                          <td width="90"><?=$total*4?></td>
                                          <td width="170">
                                          	<?php
											$persen=$total/$totalorder;
											if($persen>=18){
												$royalty=($total*4)*600;
											}
											else{
												$royalty=0;
											}
											?>
                                            RP. <?=rupiah($royalty)?>
                                          </td>
                                          <td width="90"><?=$persen?></td>
                                          <td width="40" 
                                          <?php if(querynum3("royalty","id_cabang='".$cabang->id_cabang."' AND month_cabang='".$databulan[1]."' AND year_cabang='".$databulan[0]."'")>0 AND $persen>=18){?>
                                            style="background:#0C0"
                                          <?php }
										  elseif(querynum3("royalty","id_cabang='".$cabang->id_cabang."' AND month_cabang='".$databulan[1]."' AND year_cabang='".$databulan[0]."'")==0 AND $persen>=18){?>
                                          	style="background:#F00"
                                          <?php }
										  else{
											echo" ";
										  }?>
                                          >
                                          	<form name='submit<?=$cabang->id_cabang?>' method='POST' action='fee.php'>
                                            	<input type="hidden" name="month" value="<?=$databulan[1]?>"/>
                                                <input type="hidden" name="year" value="<?=$databulan[0]?>"/>
                                                <input type="hidden" name="cabang" value="<?=$cabang->id_cabang?>"/>
                                                <input type="hidden" name="subAct" value="1" />
                                            </form>
                                          	<a href="javascript:void(0)" <?php if($_SESSION['level']!=7 AND $persen>=18){?>onclick='document.submit<?=$cabang->id_cabang?>.submit();'<?php }?> style="display:block;">&nbsp;</a>
                                          </td>
                                      </tr>    
                                      <?php $no++; } ?>     
                                      </tbody>      
                </table>   
</div>
</body>

</html>
<?php ob_end_flush();?>

