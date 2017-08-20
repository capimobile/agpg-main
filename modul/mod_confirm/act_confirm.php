<?php if(!isset($RUN)) { exit(); } ?>
<?php
$id=Baggeo_Decrypt($_GET['id']); 
if($_GET['pro'] == "delete"){
try{
		$Tconfirm->deleteBy('id_confirmation', $id);
		echo"<script>alert('Delete Success'); window.location = ('?page=$page')</script>";
		exit;
	  }catch(Exception $e){
		echo "Gagal menghapus";
		echo '<br/>Error: '.$e->getMessage();
	 }
   	
}

else if($_GET['pro'] == "done"){
try{
		$Torder = new Table('orders');	
		$data = array(
			'status_order' => 1
		);
		$Torder->updateBy('id_orders', $id, $data);
		include "modul/mod_confirm/mail_order.php";
		emailConfirm($id);
		
		exit;
	  }catch(Exception $e){
		echo "Gagal";
		echo '<br/>Error: '.$e->getMessage();
	 }
   	
}

?>