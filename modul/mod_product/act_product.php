<?php if(!isset($RUN)) { exit(); } ?>
<?php
$id=Baggeo_Decrypt($_GET['id']); 
if(isset($_POST['subAct'])){	
  $pnum=selectO('product'," ORDER BY id_product DESC",'id_product');
  $pn=$pnum+1;	
  if(strlen($pn) == 1){
  $pnn='0'.$pn;
  }else{
  $pnn=$pn;	  
  }
  $code_product='D'.$pnn;
  
 switch($_GET['pro']){
 //aksi input
 case "input":	
	
		$Tproduct->save(array(
			'name_product' => $_POST['name_product'],
			'code_product' => $code_product,
			'id_kategoriproduct' => $_POST['id_kategoriproduct'],
			'hjual_product' => $_POST['hjual_product'],
			'hbeli_product' => $_POST['hbeli_product'],
			'kemasan_product' => $_POST['kemasan_product']
		));
		echo"<script>alert('Input Success'); window.location = ('?page=$page')</script>";	
	
	
	
	 break;
 //aksi update
     case "update":
     	
		$data = array(
			'name_product' => $_POST['name_product'],
			'id_kategoriproduct' => $_POST['id_kategoriproduct'],
			'hjual_product' => $_POST['hjual_product'],
			'hbeli_product' => $_POST['hbeli_product'],
			'kemasan_product' => $_POST['kemasan_product']
		);
		$Tproduct->updateBy('id_product', $id, $data);
		
		
		echo"<script>alert('Update Success'); window.location = ('?page=$page')</script>";	
	
	 


     

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

?>