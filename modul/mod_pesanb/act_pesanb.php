<?php if(!isset($RUN)) { exit(); } ?>
<?php
require'App/lib/sms.php';

$id=Baggeo_Decrypt($_GET['id']); 
$tanggal_skr2=selectV('jamorder',"1=1 ORDER BY id_jamorder DESC",'order_date');

if(isset($_POST['subAct'])){	

		
 switch($_GET['pro']){  
 //aksi input
 case "input":	
 	$shipping_cost = 5000;
 	$kode_unik = mt_rand(100, 999);
 	$bank = 'AUTO';
    $id_cabang = selectV('cabang',"id_cabang='".$_GET['order']."'",'id_cabang');
    $nama_cabang = selectV('cabang',"id_cabang='".$_GET['order']."'",'name_cabang');
    
 	$orders=selectV('orders',"1=1 ORDER BY id_orders DESC",'id_orders')+1;
	$invoice=selectV('orders',"tgl_order='".$tanggal_skr2."' ORDER BY invoice DESC","invoice")+1;

	try{
		
		$Tmodul->save(array(
				'id_orders' => $orders,
				'tgl_order' => $tanggal_skr2,
				'jam_order' => $jam_skr,
				'id_cabang' => $_GET['order'],
				'invoice' => $invoice
						
		));
		
		$array1=$_POST['id_product'];
		$array2=$_POST['stock'];
		foreach ($array1 as $fr => $idp) {
			$harga = selectQ('product', 'id_product', $idp, 'hjual_product');
			$Torder->save(array(
				'id_product' => $idp,
				'jumlah' => $array2[$fr],
				'harga' => $harga,
				'id_orders' => $orders		
			));
			$total=$array2[$fr]*$harga;
            $grand=$grand+$total;
		}
	    $jumlah = selectV('orders_detail',"id_orders='".$orders."' and id_product = 1",'jumlah');
	    $item_franchise = selectV('product',"id_product=1",'bfranchise_product');
	    $biaya_franchise = $jumlah * $item_franchise;
		$total_trf = $grand + $kode_unik + $shipping_cost + $biaya_franchise;

		/* Process autodeposit */
		mysql_query("INSERT INTO deposit (tanggal, id_cabang, id_orders, bank, jmldep, kode_unik, sender) VALUES (now(), '$id_cabang', '$orders', '$bank', '$total_trf', '$kode_unik', '$nama_cabang')");
		$sqlid = mysql_query("SELECT id_users FROM cabang WHERE id_cabang = '$id_cabang'");
		$res2 = mysql_fetch_row($sqlid);
		$id_users = $res2[0];
		$sqlnumber = mysql_query("SELECT name_users, phone_users FROM users WHERE id_users = '$id_users'");
		$res3 = mysql_fetch_row($sqlnumber);
		$name_users = $res3[0];
		$number = $res3[1];
		$message = 'Yth '. $name_users .' ,Silahkan Trf tepat Rp. '. rupiah($total_trf).' ke Nomor Rekening MANDIRI 165-006-015-1116, BCA 41-905-55-777 a/n PT. Yellow Food Indonesia untuk konfirmasi pesanan otomatis';
		send_sms($number, $message);

		/* TODO : Hitung stok akhir setelah update */
		// echo"<script>alert('Input Success'); window.location = ('?page=cml3YXlhdA&act=view&id=".Baggeo_Encrypt($orders)."')</script>";
		// mysql_query("DELETE FROM temp_stock");
		// $no=1;
		// foreach($products as $product){
		// 	// if($product->managed == 1) {
		// 		$stock_akhir = (int)stockAkhir($product->id_product, date('Y-m-d'), date('Y-m-d'));
		// 		mysql_query("INSERT INTO temp_stock (id_product, qty_tstock) VALUES ('$product->id_product', '$stock_akhir')");
		// 	// }
		// }
		echo"<script>alert('Input Success'); window.location = ('?page=riwayat&act=view&id=".Baggeo_Encrypt($orders)."')</script>";
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
			'shipping_cost' => $_POST['shipping_cost']
		);
		$Tmodul->updateBy('id_orders', $id, $data);
		include "modul/mod_order/mail_order.php";
		emailOrder($id);	
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
		$Tmodul->deleteBy('id_orders', $id);
		$Tdeposit->deleteBy('id_orders', $id);
		// mysql_query("DELETE FROM deposit where id_orders = '$id'", Connect::getConnection());
		echo"<script>alert('Delete Success'); window.location = ('?page=$page')</script>";
		exit;
	  }catch(Exception $e){
		echo "Gagal menghapus user";
		echo '<br/>Error: '.$e->getMessage();
	 } 	
}

?>