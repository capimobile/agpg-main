<?php if(!isset($RUN)) { exit(); } ?>
<?php
$id=Baggeo_Decrypt($_GET['id']); 
if(isset($_POST['subAct'])){	

 switch($_GET['pro']){
 //aksi input
 case "input":	
 
 $nopo=selectV('po', "id_po!=0 ORDER BY no_po DESC", 'no_po')+1;
 
	try{
		$array1=$_POST['idpr'];
		$array2=$_POST['qtypo'];
		$array3=$_POST['disc'];
		foreach ($array1 as $fr => $idpr) {
			$Tpo->save(array(
				'id_product' => $idpr,
				'qty_po' => $array2[$fr],
				'dsc_po' => $array3[$fr],
				'date_po' => $tanggal_skr,
				'no_po' => $nopo,
				'id_users' => $_SESSION['user_id']
			));
		}
		echo"<script>alert('Input Success'); window.location = ('?page=$page')</script>";	
		exit;
	  }catch(Exception $e){
		echo 'Gagal Menyimpan User';
		echo '<br/>Error: '.$e->getMessage();
	  }	
	
	
	 break;
 //aksi updat
	 
	  case "inputapv":
     	try{
		$data = array(
			'termin' => $_POST['termin'],
			'status_po' => $_POST['status_po'],
			'note' => $_POST['note']
		);
		$Tpo->updateBy('no_po', $_GET['id'], $data);
		
		if($_POST['discount']==1){
			$xtrad=$_POST['xtra'];
		}
		elseif($_POST['discount']==2){
			$prxtra=$_POST['xtra']*$_POST['itotal']/100;
			$xtrad=$prxtra;
		}
		if($_POST['discount']!=0){
			$Txtra->save(array(
				'no_po' => $_GET['id'],
				'jml_xtradiscount' => $xtrad
			));
		}
		echo"<script>alert('Update Success ".$_POST['itotal']."'); window.location = ('?page=$page')</script>";	
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