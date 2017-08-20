<?php if(!isset($RUN)) { exit(); } ?>
<?php
$id=Baggeo_Decrypt($_GET['id']); 
if(isset($_POST['subAct'])){	
  
 switch($_GET['pro']){
 //aksi input
 case "inputawal":	
	if(querynum3('stockawal',"bulan_stockawal='".$_POST['bulan']."' AND tahun_stockawal='".$_POST['tahun']."'")!=0){
		echo"<script>alert('Tidak bisa di lakukan input stock awal di karenakan data bulan yang di masukan sudah ada di database'); self.history.back()</script>";	
		exit;
	}
	$array1=$_POST['id_product'];
	$array2=$_POST['stock'];

		foreach ($array1 as $fr => $idp) {
			$Tstockawal->save(array(
				'id_product' => $idp,
				'bulan_stockawal' => $_POST['bulan'],
				'tahun_stockawal' => $_POST['tahun'],
				'qty_stockawal' => $array2[$fr]		
			));
		}
		echo"<script>alert('Input Success'); window.location = ('?page=$page')</script>";	
	
	
	
	 break;
 //aksi update
     case "updateawal":
     	$array1=$_POST['id'];
		$array2=$_POST['stock'];
		foreach ($array1 as $fr => $ids) {
			$data = array(
					'qty_stockawal' => $array2[$fr]	
			);
			$Tstockawal->updateBy('id_stockawal', $ids, $data);
		}
		
		echo"<script>alert('Update Success'); window.location = ('?page=$page')</script>";	
	
	 break;
	 case "inputin":	
	
			$Tstockin->save(array(
				'id_product' => $id,
				'date_stockin' => $_POST['date_stockin'],
				'qty_stockin' => $_POST['satuan_besar']
			));
		
		echo"<script>alert('Input Success'); window.location = ('?page=$page')</script>";	
	
	 break;
	  case "editin":	
			$data = array(
				'date_stockin' => $_POST['date_stockin'],
				'qty_stockin' => $_POST['satuan_besar']
			);
			$Tstockin->updateBy('id_stockin', $_GET['idi'], $data);		
		echo"<script>alert('Edit Success'); window.location = ('?page=$page')</script>";	
	
	 break;
	 case "inputdis":	
	
			$Tdisposal->save(array(
				'id_product' => $id,
				'date_disposal' => $_POST['date_disposal'],
				'qty_disposal' => $_POST['satuan_besar']
			));
		
		echo"<script>alert('Input Success'); window.location = ('?page=$page')</script>";	
	
	 break;
	  case "editdis":	
			$data = array(
				'date_disposal' => $_POST['date_disposal'],
				'qty_disposal' => $_POST['satuan_besar']
			);
			$Tdisposal->updateBy('id_disposal', $_GET['idi'], $data);		
		echo"<script>alert('Edit Success'); window.location = ('?page=$page')</script>";	
	
	 break;
	 }

}

 //aksi delete
else if($_GET['pro'] == "delete"){
try{
		$Tproduct->deleteBy('id_product', $id);
		echo"<script>alert('Delete Success'); window.location = ('?page=$page')</script>";
		exit;
	  }catch(Exception $e){
		echo "Gagal menghapus user";
		echo '<br/>Error: '.$e->getMessage();
	 }
   	
}

else if($_GET['pro'] == "deletein"){
try{
		$Tstockin->deleteBy('id_stockin', $_GET['idi']);
		echo"<script>alert('Delete Success'); window.location = ('?page=$page')</script>";
		exit;
	  }catch(Exception $e){
		echo "Gagal menghapus user";
		echo '<br/>Error: '.$e->getMessage();
	 }
   	
}
else if($_GET['pro'] == "deletedis"){
try{
		$Tdisposal->deleteBy('id_disposal', $_GET['idi']);
		echo"<script>alert('Delete Success'); window.location = ('?page=$page')</script>";
		exit;
	  }catch(Exception $e){
		echo "Gagal menghapus user";
		echo '<br/>Error: '.$e->getMessage();
	 }
   	
}

?>