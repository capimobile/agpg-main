<?php
//ob_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// include_once 'App/db'.DIRECTORY_SEPARATOR.'Config.php';
// include_once 'App/db'.DIRECTORY_SEPARATOR.'Connect.php';

mysql_pconnect("localhost","root","agpgjkt29") or die ("Error: " . mysql_error());  
mysql_select_db("ayamgepuk_jkt") or die ("Error: " . mysql_error()); 

require(__DIR__.'/../../App/lib/sms.php');
require(__DIR__.'/../../App/lib/Table.php');
//require'App/lib/access_db.php';
//require'App/lib/manipulate.php';
//require'App/lib/WebController.php';
//require'App/lib/desc.php';
//require'App/lib/clinic_function';


echo('start update tiket');
echo("<br/>");
	$tgl = date("Y-m-d"); 
	$sql = mysql_query("SELECT * FROM data_bank WHERE terklaim = 0 AND tipe = 'K' AND DATE(tgl_proses) = '$tgl'"); 
	echo("SELECT * FROM data_bank WHERE terklaim = 0 AND tipe = 'K' AND DATE(tgl_proses) = '$tgl'");
	echo("<br/>");
	while  ($res = mysql_fetch_object($sql)) {
			$shipping_cost = 5000;
		    $idtiket = $res->id ;
			$deptiket= $res->jumlah;
			$ket= $res->keterangan ;
			$bank = strtoupper($res->bank);

			$cek = mysql_query("SELECT * FROM deposit WHERE jmldep = '$deptiket' AND STATUS = 0 AND bank = 'AUTO'  AND DATE(tanggal) = '$tgl' ");
			echo("SELECT * FROM deposit WHERE jmldep = '$deptiket' AND STATUS = 0 AND bank = 'AUTO'  AND DATE(tanggal) = '$tgl'");
			echo("<br/>");
			if ($r = mysql_fetch_object($cek)) {		
					$id = $r->id; 
					$jmldep = $r->jmldep;	
					$id_orders = $r->id_orders;	
					$kode_unik = $r->kode_unik;
					$id_cabang = $r->id_cabang;
					//$bank2 = strtoupper($r->bank);
					//$tanggal = selectV('orders',"id_orders='".$id_orders."'",'tgl_order');
					$sqltanggal = mysql_query("select tgl_order, jam_order from orders where id_orders='$id_orders'");
					$arr_tanggal = mysql_fetch_row($sqltanggal);
					$tanggal2 = $arr_tanggal[0].' '.$arr_tanggal[1];
					echo("'".$tanggal2."'");
										
					$sqlupd = "update deposit set status = 1, bank='$bank', catatan='$res->tgl_bank $bank $ket $deptiket REK:$res->no_rek', tanggal_aktif=NOW() where id=$id";	
					echo("update deposit set status = 1, bank='$bank', catatan='$res->tgl_bank $bank $ket $deptiket REK:$res->no_rek', tanggal_aktif=NOW() where id=$id");
					echo("<br/>");

					$sqlbank = "update data_bank set terklaim='1',kode_tiket='$kode_unik', catatan='$r->sender' where id='$idtiket'";	
					$sqlorders = "update orders set status_order=2 where id_orders='$id_orders'";
					$sqljurnal = "insert into jurnal  (id,tanggal,server,id_cabang,bank,report_bank,report_input,jml,input_by,status,jml_input,id_dep,tipe) values ('','$tanggal2','DCS', '$id_cabang', '$bank', '$ket', 'otomatis validasi order cabang   $jmldep [otomatis] ', '$jmldep','[otomatis]','Masuk','$jmldep','$id_orders','Order Agen')"; 
					echo("insert into jurnal  (id,tanggal,server,id_cabang,bank,report_bank,report_input,jml,input_by,status,jml_input,id_dep,tipe) values ('','$tanggal2','DCS', '$id_cabang', '$bank', '$ket', 'otomatis validasi order cabang   $jmldep [otomatis] ', '$jmldep','[otomatis]','Masuk','$jmldep','$id_orders','Order Agen')");
					echo("<br/>");
				
					if (mysql_query($sqlupd)) {
						if (!mysql_query($sqlbank)) echo "Error: $sqlbank";
						if (!mysql_query($sqlorders)) echo "Error: $sqlorders";
						if (!mysql_query($sqljurnal)) echo "Error: $sqljurnal";

						$sqlid = mysql_query("SELECT id_users FROM cabang WHERE id_cabang = '$id_cabang'");
						$res2 = mysql_fetch_row($sqlid);
						$id_users = $res2[0];
						$sqlnumber = mysql_query("SELECT name_users, phone_users FROM users WHERE id_users = '$id_users'");
						$res3 = mysql_fetch_row($sqlnumber);
						$sqlorders2 = mysql_query("SELECT invoice FROM orders WHERE id_orders = '$id_orders'");
						$res4 = mysql_fetch_row($sqlorders2);
						$invoice = $res4[0];
						$name_users = $res3[0];
						$number = $res3[1];
						$message = "Yth ". $name_users ." , transfer anda sebesar Rp. ".number_format($jmldep, 0,",",".")."  invoice INV#00".$invoice." telah diverifikasi oleh sistem. Terimakasih telah telah melakukan pembayaran";
						send_sms($number, $message);
						echo("'".$message."'");

						/*Update tabel tmp_sold & daily stock*/
						$Torder = new Table('orders_detail');
						$stockins = $Torder->findValue("id_orders='".$id."' AND jumlah <> 0");
						foreach($stockins as $stockin){
							$sqlTemp = "INSERT INTO temp_sold_product  (id_product, qty_sold) VALUES('$stockin->id_product', '$stockin->jumlah') ON DUPLICATE KEY UPDATE  `qty_sold` = `qty_sold` + '$stockin->jumlah'";
							if (!mysql_query($sqlTemp)) echo "Error: $sqlTemp";
							$sqlTemp2 = "UPDATE daily_sold_product  set qty_sold=`qty_sold` + '$stockin->jumlah' where id_product='$stockin->id_product' and date_sold='".date('Y-m-d')."'";
					 		if (!mysql_query($sqlTemp2,Connect::getConnection())) echo "Error: $sqlTemp";
						}

						echo("<br/>");

					}
					echo('<br>update tiket success</br>');
			}
	}
 echo( "\n".'no data');
 echo("<br/>");
 // echo(number_format(102548, 0,",","."));
 mysql_close();
 //ob_end_flush();
?>