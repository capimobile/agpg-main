<?php if(!isset($RUN)) { exit(); } ?>
<?php
$id=Baggeo_Decrypt($_GET['id']); 
if(isset($_POST['subAct'])){	

 switch($_GET['pro']){
 //aksi input
 case "input":	
 
 
	try{
		$Tlevelusers->save(array(
			'name_levelusers' => $_POST['name_levelusers']
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
			'name_levelusers' => $_POST['name_levelusers']
		);
		$Tlevelusers->updateBy('id_levelusers', $id, $data);
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
		$Tlevelusers->deleteBy('id_levelusers', $id);
		echo"<script>alert('Delete Success'); window.location = ('?page=$page')</script>";
		exit;
	  }catch(Exception $e){
		echo "Gagal menghapus user";
		echo '<br/>Error: '.$e->getMessage();
	 }
   	
}

?>