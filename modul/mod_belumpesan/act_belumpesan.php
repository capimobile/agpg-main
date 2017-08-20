<?php if(!isset($RUN)) { exit(); } ?>
<?php
$id=Baggeo_Decrypt($_GET['id']); 
if(isset($_POST['subAct'])){	

		
 switch($_GET['pro']){  
 //aksi input
 case "input":	
 	$orders=selectV('orders',"1=1 ORDER BY id_orders DESC")+1;
	$invoice=selectV('orders',"tgl_order='".$tanggal_skr."' ORDER BY invoice DESC")+1;
	try{
		
		$Tmodul->save(array(
				'id_orders' => $orders,
				'tgl_order' => $tanggal_skr,
				'jam_order' => $jam_skr,
				'id_cabang' => $_GET['order'],
				'invoice' => $invoice
						
		));
		
		$array1=$_POST['id_product'];
		$array2=$_POST['stock'];
		foreach ($array1 as $fr => $idp) {
			$Torder->save(array(
				'id_product' => $idp,
				'jumlah' => $array2[$fr],
				'harga' => selectQ('product', 'id_product', $idp, 'hjual_product'),
				'id_orders' => $orders		
			));
		}
		echo"<script>alert('Input Success'); window.location = ('?page=$page')</script>";	
		exit;
	  }catch(Exception $e){
		echo 'Gagal Menyimpan User';
		echo '<br/>Error: '.$e->getMessage();
	  }	
	
	
	 break;
 //aksi update
     case "update":
     	try{
		$data = array(
			'shipping_cost' => $_POST['shipping_cost']
		);
		$Tmodul->updateBy('id_orders', $id, $data);
		include "modul/mod_order/mail_order.php";
		emailOrder($id);	
		exit;
	    }catch(Exception $e){
		echo 'Gagal Mengedit data User';
		echo '<br/>Error: '.$e->getMessage();
	    }   
        break;

	 }
}

 //aksi delete
else if($_GET['pro'] == "delete"){
try{
		$Tmodul->deleteBy('id_orders', $id);
		echo"<script>alert('Delete Success'); window.location = ('?page=$page')</script>";
		exit;
	  }catch(Exception $e){
		echo "Gagal menghapus user";
		echo '<br/>Error: '.$e->getMessage();
	 } 	
}

?>