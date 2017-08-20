<?php if(!isset($RUN)) { exit(); } ?>
<?php
$id=Baggeo_Decrypt($_GET['id']); 
if(isset($_POST['subAct'])){	
$passmd = sha1(md5('123456'));
 switch($_GET['pro']){
 //aksi input
 case "input":	
 	  if(!filter_var($_POST['email_users'], FILTER_VALIDATE_EMAIL)){
		  $msg = "E-mail is not valid";
	  }
	  elseif(querynum('users', 'email_users', $_POST['email_users']) > 0){
		  $msg = "The email address is already in use by another member";
	  }
	  else{
		$Tadmin->save(array(
			'name_users' => $_POST['name_users'],
			'email_users' => $_POST['email_users'],
			'phone_users' => $_POST['phone_users'],
			'address_users' => $_POST['address_users'],
			'password_users' => $passmd,
			'id_members' => 1,
			'id_levelusers' => 7,
			'status_users' => $_POST['status_users'],
			'session_users' => $_POST['password_users']
		));
		
		$Tlog->save(array(
				'id_users' => $_SESSION['user_id'],
				'action' => 'input_administrator',
				'execute' =>  $_POST['email_users']."_".$_POST['name_users'],
				'name_log' => $_SESSION['nama_user']
		));
		echo"<script>alert('Input Success'); window.location = ('?page=$page')</script>";		
	  }
	 break;
 //aksi update
     case "update":
	  if(!filter_var($_POST['email_users'], FILTER_VALIDATE_EMAIL)){
		  $msg = "E-mail is not valid";
	  }
	  elseif(querynum('users', 'email_users', $_POST['email_users']) > 0 AND selectV('users', "id_users='".$id."'",'email_users')!= $_POST['email_users']){
		  $msg = "The email address is already in use by another member";
	  }
	  else{
		$data = array(
			'name_users' => $_POST['name_users'],
			'email_users' => $_POST['email_users'],
			'status_users' => $_POST['status_users'],
			'address_users' => $_POST['address_users'],
			'phone_users' => $_POST['phone_users']
		);
		$Tadmin->updateBy('id_users', $id, $data);
		
		echo"<script>alert('Edit Success'); window.location = ('?page=$page')</script>";		
	  }
	 }

}

 //aksi delete
else if($_GET['pro'] == "delete"){
try{
		$Tlog->save(array(
				'id_users' => $_SESSION['user_id'],
				'action' => 'delete_'.titleLog(Baggeo_Decrypt($_GET['gate'])),
				'execute' =>  selectQ('users', 'id_users', $id, 'email_users')."_".selectQ('users', 'id_users', $id, 'name_users'),
				'name_log' => $_SESSION['nama_user']
		));
		$Tadmin->deleteBy('id_users', $id);
		echo"<script>alert('Delete Success'); window.location = ('?page=$page')</script>";
		exit;
	  }catch(Exception $e){
		echo "Gagal menghapus user";
		echo '<br/>Error: '.$e->getMessage();
	 }

echo $id;	 
   	
}

?>