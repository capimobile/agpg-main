<?php if(!isset($RUN)) { exit(); } ?>
<?php
$id=Baggeo_Decrypt($_GET['id']); 
if(isset($_POST['subAct'])){	

 switch($_GET['pro']){
 //aksi input
 case "input":	
 
 
	try{
		$Tmodul->save(array(
			'nama_menu' => $_POST['nama_menu'],
			'urutan_menu' => $_POST['urutan_menu'],
			'modul_menu' => $_POST['modul_menu'],
			'link' => $_POST['link'],
			'status' => $_POST['status'],
			'main_menu' => $_POST['id_header']
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
			'nama_menu' => $_POST['nama_menu'],
			'urutan_menu' => $_POST['urutan_menu'],
			'modul_menu' => $_POST['modul_menu'],
			'link' => $_POST['link'],
			'status' => $_POST['status'],
			'main_menu' => $_POST['id_header']
		);
		$Tmodul->updateBy('id_menu', $id, $data);
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
		$Tmodul->deleteBy('id_menu', $id);
		echo"<script>alert('Delete Success'); window.location = ('?page=$page')</script>";
		exit;
	  }catch(Exception $e){
		echo "Gagal menghapus user";
		echo '<br/>Error: '.$e->getMessage();
	 }
   	
}

?>