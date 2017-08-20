<?php
/*
$mysql_hostname = "localhost";
$mysql_user = "root";
$mysql_password = "090887";
$mysql_database = "ayam_gepuk";
*/
require '../App/db/Connect.php';
require '../App/lib/manipulate.php';

function unique_sort($arrs, $id) {
    $unique_arr = array();
    foreach ($arrs AS $arr) {

        if (!in_array($arr[$id], $unique_arr)) {
            $unique_arr[] = $arr[$id];
        }
    }
    sort($unique_arr);
    return $unique_arr;
}

function req_sort($arrs, $cabang, $tgl) {
	$unique_arr='';
    foreach ($arrs AS $arr) {
		if($arr['name_cabang']==$cabang AND $arr['tanggal']==$tgl){
			$unique_arr = $unique_arr+$arr['jumlah'];
		}
    }
    
	return $unique_arr;
}

function total_sort($arrs, $cabang) {
	$unique_arr='';
	$fx=0;
    foreach ($arrs AS $arr) {
		if($arr['name_cabang']==$cabang){
			$unique_arr = $unique_arr+$arr['jumlah'];
			$fx++;
		}
    }
    
	return $unique_arr.'-'.$fx;
}

try{
	if(isset($_GET['tanggal'])){
	      $dates=$_GET['tanggal'];
	}
	else{
		  $dates="2016-11";
	}
	$spdate=explode('-',$dates);
	//$dbo = new PDO("mysql:host=".$mysql_hostname.";dbname=".$mysql_database,$mysql_user,$mysql_password);
	$obj= $dbo->query("CALL sp_royalty_fee('".$spdate[0]."','".$spdate[1]."')");
	$result= $obj->fetchAll();
	$sort_arr = unique_sort($result, 'name_cabang');
	
	//$clear_array = array_unique($result);?>
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
	<?php
	$no=1;
	foreach($sort_arr as $row){?>
		<tr>
              <td><?= $no ?></td>
              <td><?=$row?></td>
    		  <?php
			  for($i=1; $i<=$mnth; $i++){
					if(strlen($i)==1){
						$day='0'.$i;
					}
					else{
						$day=$i;
					}
			  ?>
              <td width="40" align="center" 
              <?php
			  $getrow=req_sort($result, $row, $dates.'-'.$day);
			  $subtotal=explode('-',total_sort($result, $row));
              if($getrow=='' AND $dates.'-'.$day < date('Y-m-d')){
													echo'style="background:#f08e4b";';
												}
												else{
													echo'';
												}?>>
                <?=$getrow?>
              
              </td>
              <?php }?>
              <td><?=$subtotal[0]?></td>
              <td><?=$subtotal[0]*4?></td>
              <td>
			  <?php
					$persen=number_format($subtotal[0]/$subtotal[1],2);
					if($persen>=18){
						$royalty=($subtotal[0]*4)*600;
					}
					else{
						$royalty=0;
				   }
				   ?>
                   <?=rupiah($royalty)?>
       		  </td>
              <td><?=$persen?></td>
              <td></td>
       </tr>
	<?php $no++;}?>
    </tbody>
    </table>
    </div>
<?php }
catch(PDOException $e){
	return $e->getMessage();
}