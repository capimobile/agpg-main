<?php if(!isset($RUN)) { exit(); } ?>
<?php
$id=Baggeo_Decrypt($_GET['id']); 
if(isset($_POST['subAct'])){
	
if($_POST['sheader'] == '1' AND $_POST['id_header']== '0'){	
  $pnum=selectV('modul',"sheader='1' ORDER BY id_unik DESC",'id_unik');
  $pn=$pnum+1;	
  $id_unik=$pn;
}
else
{
$id_unik='0';	
}
 switch($_GET['pro']){
 //aksi input
 case "input":	
 
 $jml=$_POST['jml'];
 for($i=1 ; $i<$jml ; $i++){
  if(!empty($_POST['id_levelusers'.$i])){	 
		$Tmodul->save(array(
			'name_modul' => $_POST['name_modul'],
			'link_modul' => $_POST['link_modul'],
			'urutan_modul' => $_POST['urutan_modul'],
			'status_modul' => $_POST['status_modul'],
			'id_header' => $_POST['id_header'],
			'id_icon' => $_POST['id_icon'],
			'id_unik' => $id_unik,
			'sheader' => $_POST['sheader'],
			'id_levelusers' => $_POST['id_levelusers'.$i]
		));
  }

 }
		echo"<script>alert('Input Success'); window.location = ('?page=$page')</script>";		
		  
	
	
	 break;
 //aksi update
     case "update":
	 
	 
    $Tmodul->deleteBy('link_modul', $id);
	
	 $jml=$_POST['jml'];
 for($i=1 ; $i<$jml ; $i++){
  if(!empty($_POST['id_levelusers'.$i])){	 
		$Tmodul->save(array(
			'name_modul' => $_POST['name_modul'],
			'link_modul' => $_POST['link_modul'],
			'urutan_modul' => $_POST['urutan_modul'],
			'status_modul' => $_POST['status_modul'],
			'id_header' => $_POST['id_header'],
			'id_icon' => $_POST['id_icon'],
			'id_unik' => $id_unik,
			'sheader' => $_POST['sheader'],
			'id_levelusers' => $_POST['id_levelusers'.$i]
		));
  }

 }
		echo"<script>alert('Input Success'); window.location = ('?page=$page')</script>";		
	 


     

	 }




}

 //aksi delete
else if($_GET['pro'] == "delete"){
try{
		$Tmodul->deleteBy('link_modul', $id);
		echo"<script>alert('Delete Success'); window.location = ('?page=$page')</script>";
		exit;
	  }catch(Exception $e){
		echo "Gagal menghapus user";
		echo '<br/>Error: '.$e->getMessage();
	 }

echo $id;	 
   	
}

?>