<?php if(!isset($RUN)) { exit(); } ?>
<?php
$id=Baggeo_Decrypt($_GET['id']); 
if(isset($_POST['subAct'])){	

		
 switch($_GET['pro']){  
 //aksi input
 case "input":	
 
	try{
		$Tkurir->save(array(
			'name_kurir' => $_POST['name_kurir'],
			'email_kurir' => $_POST['email_kurir'],
			'type_kend' => $_POST['type_kend'],
			'plat_kend' => $_POST['plat_kend']
		));
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
			'name_kurir' => $_POST['name_kurir'],
			'email_kurir' => $_POST['email_kurir'],
			'type_kend' => $_POST['type_kend'],
			'plat_kend' => $_POST['plat_kend']
		);
		$Tkurir->updateBy('id_kurir', $id, $data);
		echo"<script>alert('Update Success'); window.location = ('?page=$page')</script>";	
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
		$Tkurir->deleteBy('id_kurir', $id);
		echo"<script>alert('Delete Success'); window.location = ('?page=$page')</script>";
		exit;
	  }catch(Exception $e){
		echo "Gagal menghapus user";
		echo '<br/>Error: '.$e->getMessage();
	 } 	
}

?>
