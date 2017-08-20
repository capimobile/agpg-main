<?php if(!isset($RUN)) { exit(); } ?>
<?php
$id=Baggeo_Decrypt($_GET['id']); 
if(isset($_POST['subAct'])){	

		
 switch($_GET['pro']){  
 //aksi input
 case "input":	
 

	 break;
 //aksi update
     case "update":
     	try{
		$newp=sha1(md5($_POST['new']));
		if(selectV('users',"id_users='".$_SESSION['user_id']."'",'password_users') != sha1(md5($_POST['old']))){
			echo"<script>alert('Password lama salah.'); window.location = ('?page=$page')</script>";
			exit;	
		}
		elseif($_POST['new'] != $_POST['new2']){
			echo"<script>alert('Password baru yang anda masukan tidak sama.'); window.location = ('?page=$page')</script>";	
			exit;
		}
		else{
			$data = array(
				'password_users' => $newp
			);
			$Tmodul->updateBy('id_users', $id, $data);
			echo"<script>alert('Update Success'); window.location = ('?page=$page')</script>";	
			exit;
		}
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
		$Tmodul->deleteBy('id_bank', $id);
		echo"<script>alert('Delete Success'); window.location = ('?page=$page')</script>";
		exit;
	  }catch(Exception $e){
		echo "Gagal menghapus user";
		echo '<br/>Error: '.$e->getMessage();
	 } 	
}

?>