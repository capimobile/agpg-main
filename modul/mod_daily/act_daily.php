<?php if(!isset($RUN)) { exit(); } ?>
<?php
$id=Baggeo_Decrypt($_GET['id']); 
if(isset($_POST['subAct'])){	

		
 switch($_GET['pro']){  
 //aksi update
     case "update":
     	try{
		$data = array(
			'jasa' => $_POST['jasa'],
			'resi' => $_POST['resi']
		);
		$Tmodul->updateBy('id_orders', $id, $data);
		include "modul/mod_sukses/mail_order.php";
		emailOrder($id);	
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
		echo"<script>alert('Delete Success'); window.location = ('?page=$page')</script>";
		exit;
	  }catch(Exception $e){
		echo "Gagal menghapus user";
		echo '<br/>Error: '.$e->getMessage();
	 } 	
}

?>