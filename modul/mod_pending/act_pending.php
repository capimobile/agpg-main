<?php if(!isset($RUN)) { exit(); } ?>
<?php
$id=Baggeo_Decrypt($_GET['id']); 

if(isset($_POST['subAct'])){	

		
 switch($_GET['pro']){  
 //aksi update
     case "inputbayar":
     	try{
     		$id = $_GET['order'];
     		if ($_POST['bank'] == 'TUNAI')	{
     			$status_order = '1';
     			$status = 'CASH';
     		} elseif ($_POST['bank'] == 'BCA-BISNIS' || $_POST['bank'] == 'MDR-BISNIS'){
     			$status_order = '2';
     			$status = 'TRANSFER';
     		} else {
     			echo"<script>alert('Input Failed'); window.location = ('?page=$page')</script>";
     		}
			$data = array(
				'status_order' => $status_order
			);
			$Tmodul->updateBy('id_orders', $_GET['order'], $data);

			/*Inser data jurnal*/
			$tanggal = selectV('orders',"id_orders='".$id."'",'tgl_order');
			$tanggal2 = $tanggal.' '.selectV('orders',"id_orders='".$id."'",'jam_order');
			$query1 = mysql_query("SELECT * FROM deposit WHERE id_orders = '$id'");
			if ($r = mysql_fetch_object($query1)) {
				$id_cabang = $r->id_cabang;
				$catatan  = $r->catatan;
				$jmldep = $r->jmldep;
				$user = $_SESSION['nama_user'];
				$bank = $_POST['bank'];
				// echo"<script>alert('Input Success ".$id_cabang." ".$bank." ".$catatan." ".$user." ')</script>";
				$sqljurnal = "insert into jurnal  (id,tanggal,server,id_cabang,bank,report_bank,report_input,jml,input_by,status,jml_input,id_dep,tipe) values ('','$tanggal2','DCS', '$id_cabang', '$bank', '$catatan', 'validasi manual Rp. $jmldep [$status]', '$jmldep','$user','Masuk','$jmldep','".date("ymdhis")."','Order Agen')"; 
				// echo($sqljurnal);
				if (!mysql_query($sqljurnal)) echo "Error: $sqljurnal";
			}

			/*Update tabel tmp_sold & daily stock*/
			$stockins = $Torder->findValue("id_orders='".$id."' AND jumlah <> 0");
			foreach($stockins as $stockin){
				 $sqlTemp = "INSERT INTO temp_sold_product  (id_product, qty_sold) VALUES('$stockin->id_product', '$stockin->jumlah') ON DUPLICATE KEY UPDATE  `qty_sold` = `qty_sold` + '$stockin->jumlah'";
				 if (!mysql_query($sqlTemp)) echo "Error: $sqlTemp";
				 $sqlTemp2 = "UPDATE daily_sold_product  set qty_sold=`qty_sold` + '$stockin->jumlah' where id_product='$stockin->id_product' and date_sold='".$tanggal."'";
				 if (!mysql_query($sqlTemp2,Connect::getConnection())) echo "Error: $sqlTemp";
			}

		//echo"<script>alert('Input Success')</script>";
		echo"<script>alert('Input Success'); window.location = ('?page=$page')</script>";

		exit;
		exit;
	    }catch(Exception $e){
		echo 'Gagal Mengedit data';
		echo '<br/>Error: '.$e->getMessage();
	    }   
        break;
		
	 case "inputdiscount":
     	try{
		$data = array(
			'discount_order' => $_POST['discount_order'],
			'note_discount' => $_POST['note_discount']
		);
		$Tmodul->updateBy('id_orders', $_GET['order'], $data);
		echo"<script>alert('Input Success'); window.location = ('?page=$page')</script>";
		exit;
		exit;
	    }catch(Exception $e){
		echo 'Gagal Mengedit data';
		echo '<br/>Error: '.$e->getMessage();
	    }   
     
	 break;

	 case "inputassign":
     	try{
		$data = array(
			'id_kurir' => $_POST['id_kurir']
		);
		$Tmodul->updateBy('id_orders', $_GET['order'], $data);
		echo"<script>alert('Input Success'); window.location = ('?page=$page')</script>";
		exit;
		exit;
	    }catch(Exception $e){
		echo 'Gagal Mengedit data';
		echo '<br/>Error: '.$e->getMessage();
	    }   
     
	 break;
		
	 }
	 
}

 //aksi delete
else if($_GET['pro'] == "delete"){
try{
		$Tmodul->deleteBy('id_orders', $id);
		$Torder->deleteBy('id_orders', $id);
		$Tdeposit->deleteBy('id_orders', $id);
		echo"<script>alert('Delete Success'); window.location = ('?page=$page')</script>";
		exit;
	  }catch(Exception $e){
		echo "Gagal menghapus user";
		echo '<br/>Error: '.$e->getMessage();
	 } 	
}

?>