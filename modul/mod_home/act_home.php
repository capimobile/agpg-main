<?php if(!isset($RUN)) { exit(); } ?>
<?php
$id=Baggeo_Decrypt($_GET['id']); 

if(isset($_POST['subAct'])){	

 		//	upload
 		$lokasi_file    = $_FILES['fupload']['tmp_name'];
		$size_file = $_FILES['fupload']['size'];
		list($txt, $ext) = explode("/", strtolower($_FILES['fupload']['type']));
		$valid_formats = array("jpg", "jpeg", "gif", "png", "bmp");
			 
		if(!empty($lokasi_file) AND in_array($ext,$valid_formats) ){
			if($_SESSION['level']==9){
				unlink('upload/'.selectQ('pasien' ,'id_pasien', $id, 'photo_pasien'));	
				unlink('upload/thu/'.selectQ('pasien' ,'id_pasien', $id, 'photo_pasien'));	
			}
			elseif($_SESSION['level']==11){
				unlink('upload/'.selectQ('doctor' ,'id_doctor', $id, 'photo_doctor'));	
				unlink('upload/thu/'.selectQ('doctor' ,'id_doctor', $id, 'photo_doctor'));	
			}
			else{
				unlink('upload/'.selectQ('employee' ,'id_employee', $id, 'photo_employee'));	
			    unlink('upload/thu/'.selectQ('employee' ,'id_employee', $id, 'photo_employee'));	
			}
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
			if($_SESSION['level']==9){
				$nama_file_unik = selectQ('pasien', 'id_pasien', $id, 'photo_pasien');	
			}
			elseif($_SESSION['level']==11){
				$nama_file_unik = selectQ('doctor', 'id_doctor', $id, 'photo_doctor');
			}
			else{
				$nama_file_unik = selectQ('employee' ,'id_employee', $id, 'photo_employee');
			}
		}
		else{
			echo"<script>alert('Wrong Format'); window.location = ('?page=".Baggeo_Encrypt('home')."&act=".Baggeo_Encrypt('edit')."&ur=".Baggeo_Encrypt(getUr())."')</script>";	
			exit;
		}
		 
 switch($_GET['pro']){
 //aksi update
     case "updatedoctor":
		$datau = array(
		'name_users' => $_POST['name_doctor'],
		);
		$Tuser->updateBy('no_users', $_SESSION['nouser'], $datau);
		
		$data = array(
			'name_doctor' => $_POST['name_doctor'],
			'phone_doctor' => $_POST['phone_doctor'],
			'cell_doctor' => $_POST['cell_doctor'],
			'address_doctor' => $_POST['address_doctor'],
			'photo_doctor' => $nama_file_unik
		);
		$Tdoctor->updateBy('id_doctor', $id, $data);
		
		$Tlog->save(array(
				'id_users' => $_SESSION['user_id'],
				'action' => 'edit_doctor',
				'execute' =>  $_SESSION['nouser']."_".$_POST['name_doctor'],
				'name_log' => $_SESSION['nama_user']
			));
		
		echo"<script>alert('Update Success'); window.location = ('?page=".Baggeo_Encrypt('home')."&act=".Baggeo_Encrypt('profile')."&ur=".Baggeo_Encrypt(getUr())."')</script>";	
		exit;

     break;		
	 
	 case "updatepatient":
		$datau = array(
		'name_users' => $_POST['name_pasien']
		);
		$Tuser->updateBy('no_users', $_SESSION['nouser'], $datau);
		
		$data = array(
			'name_pasien' => $_POST['name_pasien'],
			'phone_pasien' => $_POST['phone_pasien'],
			'cell_pasien' => $_POST['cell_pasien'],
			'address_pasien' => $_POST['address_pasien'],
            'name_family' => $_POST['name_family'],
			'suku_pasien' => $_POST['suku_pasien'],
			'sex_pasien' => $_POST['sex_pasien'],
			'born_pasien' => $_POST['born_pasien'],
			'bornp_pasien' => $_POST['bornp_pasien'],
			'married_pasien' => $_POST['married_pasien'],
			'religion_pasien' => $_POST['religion_pasien'],
			'work_pasien' => $_POST['work_pasien'],
			'edu_pasien' => $_POST['edu_pasien'],
			'blood_pasien' => $_POST['blood_pasien'],
			'workaddress_pasien' => $_POST['workaddress_pasien'],
			'workphone_pasien' => $_POST['workphone_pasien'],
			'askes_pasien' => $_POST['askes_pasien'],
			'doctor_pasien' => $_POST['doctor_pasien'],
			'phonedoctor_pasien' => $_POST['phonedoctor_pasien'],
			'dental_pasien' => $_POST['dental_pasien'],
			'phonedental_pasien' => $_POST['phonedental_pasien'],
			'dad_pasien' => $_POST['dad_pasien'],
			'mom_pasien' => $_POST['mom_pasien'],
			'photo_pasien' => $nama_file_unik
		);
		$Tpasien->updateBy('id_pasien', $id, $data);
		
		$Tlog->save(array(
				'id_users' => $_SESSION['user_id'],
				'action' => 'edit_patient',
				'execute' =>  $_POST['no_pasien']."_".$_POST['name_pasien'],
				'name_log' => $_SESSION['nama_user']
			));
		
		
		
		echo"<script>alert('Update Success'); window.location = ('?page=".Baggeo_Encrypt('home')."&act=".Baggeo_Encrypt('profile')."&ur=".Baggeo_Encrypt(getUr())."')</script>";	
		exit;

     break;	
	 
	 case "updateemployee":
		$datau = array(
		'name_users' => $_POST['name_employee']
		);
		$Tuser->updateBy('no_users', $_SESSION['nouser'], $datau);
		
		$data = array(
			'name_employee' => $_POST['name_employee'],
			'phone_employee' => $_POST['phone_employee'],
			'cell_employee' => $_POST['cell_employee'],
			'address_employee' => $_POST['address_employee'],
			'photo_employee' => $nama_file_unik
		);
		$Temployee->updateBy('id_employee', $id, $data);
		
		$Tlog->save(array(
				'id_users' => $_SESSION['user_id'],
				'action' => 'edit_employee',
				'execute' =>  $_SESSION['nouser']."_".$_POST['name_employee'],
				'name_log' => $_SESSION['nama_user']
			));
		
		echo"<script>alert('Update Success'); window.location = ('?page=".Baggeo_Encrypt('home')."&act=".Baggeo_Encrypt('profile')."&ur=".Baggeo_Encrypt(getUr())."')</script>";	
		exit;

     break;		
	 
	 case "inputcase":
 
  $Thistorymed->save(array(
			'no_pasien' => $_POST['no_users'],
			'med_historymed' => $_POST['med_historymed'],
			'fisik_historymed' => $_POST['fisik_historymed'],
			'perawatan_historymed' => $_POST['perawatan_historymed'],
			'case_historymed' => $_POST['case_historymed'],
			'doctor_historymed' => $_POST['doctor_historymed'],
			'address_historymed' => $_POST['address_historymed'],
			'phone_historymed' => $_POST['phone_historymed']

		));
 
 $jml=$_POST['jml'];
 for($i=1 ; $i<$jml ; $i++){
 $Tchistoryp->save(array(
			'no_users' => $_POST['no_users'],
			'id_chistory' => $_POST['id_chistory'.$i],
			'answer_chistoryp' => $_POST['answer_chistoryp'.$i],
			'detail_chistoryp' => $_POST['detail_chistoryp'.$i]
		));	 
 }
 
echo"<script>alert('Input Success'); window.location = ('?page=".Baggeo_Encrypt('home')."&act=".Baggeo_Encrypt('case')."&ur=".Baggeo_Encrypt(getUr())."')</script>";		
 
 break;
 //aksi update
     case "updatecase":
	 $data = array(
			'med_historymed' => $_POST['med_historymed'],
			'fisik_historymed' => $_POST['fisik_historymed'],
			'perawatan_historymed' => $_POST['perawatan_historymed'],
			'case_historymed' => $_POST['case_historymed'],
			'doctor_historymed' => $_POST['doctor_historymed'],
			'address_historymed' => $_POST['address_historymed'],
			'phone_historymed' => $_POST['phone_historymed']
		);
		$Thistorymed->updateBy('no_pasien', $_POST['no_users'], $data);
	 
     $Tchistoryp->deleteBy('no_users', $_POST['no_users']);
	 $jml=$_POST['jml'];
     for($i=1 ; $i<$jml ; $i++){
     $Tchistoryp->save(array(
			'no_users' => $_POST['no_users'],
			'id_chistory' => $_POST['id_chistory'.$i],
			'answer_chistoryp' => $_POST['answer_chistoryp'.$i],
			'detail_chistoryp' => $_POST['detail_chistoryp'.$i]
		));	 
 }
echo"<script>alert('Update Success'); window.location = ('?page=".Baggeo_Encrypt('home')."&act=".Baggeo_Encrypt('case')."&ur=".Baggeo_Encrypt(getUr())."')</script>";		
	 

        break;	
	 
	 }


}

?>