<?php if(!isset($RUN)) { exit(); } ?>
<?php
$id=Baggeo_Decrypt($_GET['id']); 
if(isset($_POST['subAct'])){	

		$lokasi_file    = $_FILES['fupload']['tmp_name'];
		$size_file = $_FILES['fupload']['size'];
		$valid_formats = array("jpg", "jpeg", "gif", "png", "bmp");
		list($txt, $ext) = explode("/", strtolower($_FILES['fupload']['type']));
			 
	 	if(!empty($lokasi_file) AND in_array($ext,$valid_formats) ){
			unlink('upload/'. $currentModul->images);
			unlink('upload/thu/'. $currentModul->images);
			//if($size<(1024*1024)){
				$nama_file_unik = codeAcak(5).$_FILES['fupload']['name'];
				UploadPhoto($nama_file_unik);
			/*}
			else{
				echo"<script>alert('Tidak Boleh Lebih Dari 1 MB'); window.location=('?page=$page')</script>";
				exit;
			}*/
		}
		elseif(empty($lokasi_file)){
			$nama_file_unik = $currentModul->images;
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
			'content' => $_POST['content'],
			'name_pages' => $_POST['name_pages'],
			'tipe' => 'news',
			'images' => $nama_file_unik
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
			'content' => $_POST['content'],
			'name_pages' => $_POST['name_pages'],
			'tipe' => 'news',
			'images' => $nama_file_unik
		);
		$Tmodul->updateBy('id_pages', $id, $data);
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
		$Tmodul->deleteBy('id_pages', $id);
		echo"<script>alert('Delete Success'); window.location = ('?page=$page')</script>";
		exit;
	  }catch(Exception $e){
		echo "Gagal menghapus user";
		echo '<br/>Error: '.$e->getMessage();
	 }
   	
}

?>