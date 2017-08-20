<?php if(!isset($RUN)) { exit(); } ?>
<?php
$id=Baggeo_Decrypt($_GET['id']); 
$Tjurnal = new Table('jurnal');

if(isset($_POST['subAct'])){
// echo"<script>alert('Input Success'); window.location = ('?page=$page')</script>";	
  // $pnum=selectO('product'," ORDER BY id_product DESC",'id_product');
  // $pn=$pnum+1;	
  // if(strlen($pn) == 1){
  // $pnn='0'.$pn;
  // }else{
  // $pnn=$pn;	  
  // }
  // $code_product='D'.$pnn;

  
 // switch($_GET['pro']){
 // //aksi input
 // case "input":	
	

	$report_input = (isset($_POST['report_input'])) ? $_POST['report_input'] : "";
	$id_cabang = (isset($_POST['cabang'])) ? $_POST['cabang'] : "";
	// $id_cabang = selectV('cabang',"name_cabang='".$_POST['id_cabang']."'",'id_cabang') || "";
	$jml = (isset($_POST['jml'])) ? $_POST['jml'] : "";
	$bank = (isset($_POST['bank'])) ? $_POST['bank'] : "";
	$report_bank = (isset($_POST['report_bank'])) ? $_POST['report_bank'] : "";
	$tanggal = (isset($_POST['tanggal'])) ? $_POST['tanggal'] : "";
	$server = (isset($_POST['server'])) ? $_POST['server'] : "";
	$jml_input = (isset($_POST['jml_input'])) ? $_POST['jml_input'] : "";
	$tipe = (isset($_POST['tipe'])) ? $_POST['tipe'] : "";

	if ($_POST['tipe']=="Order Cabang" || $_POST['tipe']=="Pendapatan Lain" || $_POST['tipe']=="Buffer Cabang"|| $_POST['tipe']=="Tukar Masuk"){
		$status="Masuk";
	}else if($_POST['tipe']=="Order Suplier" || $_POST['tipe']=="Biaya" || $_POST['tipe']=="Buffer Suplier"|| $_POST['tipe']=="Tukar Keluar"){
		$status="Keluar";
	}
	   
	$Tjurnal->save(array(
		'id' => '',
		'bank' => $bank,
		'tanggal' => $tanggal,
		'server'=> 'DCS',
		'id_cabang' => $id_cabang,
		'report_bank' => $report_bank,
		'report_input' => $report_input,
		'jml' => $jml,
		'jml_input' => $jml_input,
		'status' => $status,
		'input_by' => $_SESSION['nama_user'],
		'id_dep' => date('YmdHis'),
		'tipe' => $tipe,
	));
	echo"<script>alert('Input Success'); window.location = ('?page=$page')</script>";	

	
	
	//  break;
 // //aksi update
 //     case "update":
     	
		// $data = array(
		// 	'name_product' => $_POST['name_product'],
		// 	'id_kategoriproduct' => $_POST['id_kategoriproduct'],
		// 	'hjual_product' => $_POST['hjual_product'],
		// 	'hbeli_product' => $_POST['hbeli_product'],
		// 	'kemasan_product' => $_POST['kemasan_product']
		// );
		// $Tproduct->updateBy('id_product', $id, $data);
		
		// echo"<script>alert('Update Success'); window.location = ('?page=$page')</script>";	

     // break;

	 // }
}

//  //aksi delete
// else if($_GET['pro'] == "delete"){
// try{
// 		$Tproduct->deleteBy('id_product', $id);
// 		echo"<script>alert('Delete Success'); window.location = ('?page=$page')</script>";
// 		exit;
// 	  }catch(Exception $e){
// 		echo "Gagal menghapus user";
// 		echo '<br/>Error: '.$e->getMessage();
// 	 }
   	
// }

?>