<?php if(!isset($RUN)) { exit(); } ?>
<?php
$id=Baggeo_Decrypt($_GET['id']); 
if(isset($_POST['subAct'])){	

		
 switch($_GET['pro']){  
 //aksi input
 case "input":	
 
	try{
		$Tmodul->save(array(
		    'name_kecamatan' => $_POST['name_kecamatan']
			
			
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
			 'name_kecamatan' => $_POST['name_kecamatan']
		);
		$Tmodul->updateBy('id_kecamatan', $id, $data);
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
		$Tmodul->deleteBy('id_kecamatan', $id);
		echo"<script>alert('Delete Success'); window.location = ('?page=$page')</script>";
		exit;
	  }catch(Exception $e){
		echo "Gagal menghapus user";
		echo '<br/>Error: '.$e->getMessage();
	 } 	
}

?>