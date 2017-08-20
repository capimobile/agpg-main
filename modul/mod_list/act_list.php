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
 //aksi update
     case "inputapv":
     	try{
		if($_POST['pembayaran']!='' || $_POST['pembayaran']!=0){
			$Ttermin->save(array(
					'jumlah_termin' => querynum3('termin', "no_po='$_GET[id]'")+1,
					'no_po' => $_GET['id'],
					'bayar_termin' => $_POST['pembayaran']
			));
			echo"<script>alert('Input Success'); window.location = ('?page=$page')</script>";	
			exit;
		}
	    }catch(Exception $e){
		echo 'Gagal Memasukan data';
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