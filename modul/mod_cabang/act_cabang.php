<?php if(!isset($RUN)) { exit(); } ?>
<?php
$id=Baggeo_Decrypt($_GET['id']); 
if(isset($_POST['subAct'])){	

		
 switch($_GET['pro']){  
 //aksi input
 case "input":	
 
	try{
		$Tmodul->save(array(
		    'name_cabang' => $_POST['name_cabang'],
			'lokasi_cabang' => $_POST['lokasi_cabang'],
			'id_kurir' => $_POST['id_kurir'],
			'lat_cabang' => $_POST['lat_cabang'],
			'lon_cabang' => $_POST['lon_cabang'],
			'nama_karyawan' => $_POST['nama_karyawan'],
			'alamat_karyawan' => $_POST['alamat_karyawan'],
			'phone_karyawan' => $_POST['phone_karyawan'],
			'id_kecamatan' => $_POST['id_kecamatan'],
			'id_users' => $_POST['id_users']
			
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
			'name_cabang' => $_POST['name_cabang'],
			'lokasi_cabang' => $_POST['lokasi_cabang'],
			'id_kurir' => $_POST['id_kurir'],
			'lat_cabang' => $_POST['lat_cabang'],
			'lon_cabang' => $_POST['lon_cabang'],
			'nama_karyawan' => $_POST['nama_karyawan'],
			'alamat_karyawan' => $_POST['alamat_karyawan'],
			'phone_karyawan' => $_POST['phone_karyawan'],
			'id_kecamatan' => $_POST['id_kecamatan'],
			'id_users' => $_POST['id_users']
		);
		$Tmodul->updateBy('id_cabang', $id, $data);
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
		$Tmodul->deleteBy('id_cabang', $id);
		echo"<script>alert('Delete Success'); window.location = ('?page=$page')</script>";
		exit;
	  }catch(Exception $e){
		echo "Gagal menghapus user";
		echo '<br/>Error: '.$e->getMessage();
	 } 	
}

?>