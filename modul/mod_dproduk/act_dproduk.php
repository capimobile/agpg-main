<?php if(!isset($RUN)) { exit(); } ?>
<?php
$id=Baggeo_Decrypt($_GET['id']); 
if(isset($_POST['subAct'])){	

//	upload
 		$lokasi_file    = $_FILES['fupload']['tmp_name'];
		$size_file = $_FILES['fupload']['size'];
		$valid_formats = array("jpg", "jpeg", "gif", "png", "bmp");
		list($txt, $ext) = explode("/", strtolower($_FILES['fupload']['type']));
			 
	 	if(!empty($lokasi_file) AND in_array($ext,$valid_formats) ){
			unlink('upload/'. $currentModul->image_uploads);
			unlink('upload/thu/'. $currentModul->image_uploads);
			//if($size<(1024*1024)){
				$nama_file_unik = codeAcak(15).'.'.$ext;
				UploadPhoto($nama_file_unik);
			/*}
			else{
				echo"<script>alert('Tidak Boleh Lebih Dari 1 MB'); window.location=('?page=$page')</script>";
				exit;
			}*/
		}
		elseif(empty($lokasi_file)){
			$nama_file_unik = $currentModul->image_uploads;
		}
		else{
			echo"<script>alert('Wrong Format'); window.location = ('?page=$page')</script>";	
			exit;
		}
		
 switch($_GET['pro']){  
 //aksi input
 case "input":	
 
	try{
		$Tmodul->save(array(
		    'image_uploads' => $nama_file_unik,
			'name_uploads' => $_POST['name_uploads'],
			'desc_uploads' => $_POST['desc_uploads'],
			'tipe_uploads' => 'produk'
			
			
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
			 'image_uploads' => $nama_file_unik,
			'name_uploads' => $_POST['name_uploads'],
			'desc_uploads' => $_POST['desc_uploads'],
			'tipe_uploads' => 'produk'
		);
		$Tmodul->updateBy('id_uploads', $id, $data);
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
		unlink('upload/'. $currentModul->image_uploads);
		unlink('upload/thu/'. $currentModul->image_uploads);
		$Tmodul->deleteBy('id_uploads', $id);
		echo"<script>alert('Delete Success'); window.location = ('?page=$page')</script>";
		exit;
	  }catch(Exception $e){
		echo "Gagal menghapus user";
		echo '<br/>Error: '.$e->getMessage();
	 } 	
}

?>