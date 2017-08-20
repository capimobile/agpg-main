<?php
//ob_start();
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

// include_once 'App/db'.DIRECTORY_SEPARATOR.'Config.php';
// include_once 'App/db'.DIRECTORY_SEPARATOR.'Connect.php';
mysql_pconnect("localhost","root","agpgjkt29") or die ("Error: " . mysql_error());  
mysql_select_db("ayamgepuk_jkt") or die ("Error: " . mysql_error()); 

require 'App/lib/sms.php';
//require'App/lib/access_db.php';
//require'App/lib/manipulate.php';
//require'App/lib/WebController.php';
//require'App/lib/desc.php';
//require'App/lib/clinic_function';


echo('start update tiket');
	$tgl = date("Y-m-d"); 
	$sql = mysql_query("SELECT * FROM data_bank WHERE terklaim = 0 AND tipe = 'K' AND DATE(tgl_proses) = '$tgl'"); 

	while  ($res = mysql_fetch_object($sql)) {
			$shipping_cost = 5000;
		    $idtiket = $res->id ;
			$deptiket= $res->jumlah;
			$ket= $res->keterangan ;
			$bank = strtoupper($res->bank);
			

			
			$a = "SELECT * FROM deposit WHERE jmldep = '$deptiket' AND STATUS = 0 AND bank = 'AUTO'  AND DATE(tanggal) = '$tgl' ";
			// echo("SELECT * FROM deposit WHERE jmldep = '$deptiket' AND STATUS = 0 AND bank = 'AUTO'  AND DATE(tanggal) = '$tgl' ");
			$cek = mysql_query($a);
			if ($r = mysql_fetch_object($cek)) {		
					$id = $r->id; 
					$jmldep = $r->jmldep;	
					$id_orders = $r->id_orders;	
					$kode_unik = $r->kode_unik;
					$id_cabang = $r->id_cabang;			 

										
					$sqlupd = "update deposit set status = 1, bank='$bank', catatan='$res->tgl_bank $bank $ket $deptiket REK:$res->no_rek', tanggal_aktif=NOW() where id=$id";		
					$sqlbank = "update data_bank set terklaim='1',kode_tiket='$kode_unik', catatan='$r->sender' where id='$idtiket'";	
					$sqlorders = "update orders set status_order=2 where id_orders='$id_orders'";								
					if (mysql_query($sqlupd)) {
						if (!mysql_query($sqlbank)) echo "Error: $sqlbank";
						if (!mysql_query($sqlorders)) echo "Error: $sqlorders";

						$sqlid = mysql_query("SELECT id_users FROM cabang WHERE id_cabang = '$id_cabang'");
						echo("SELECT id_users FROM cabang WHERE id_cabang = '$id_cabang'");
						$res2 = mysql_fetch_row($sqlid);
						$id_users = $res2[0];
						$sqlnumber = mysql_query("SELECT name_users, phone_users FROM users WHERE id_users = '$id_users'");
						$res3 = mysql_fetch_row($sqlnumber);
						$name_users = $res3[0];
						$number = $res3[1];
						$message = "Yth ". $name_users ." , transfer anda sebesar Rp. ".$jmldep." telah diverifikasi otomatis oleh sistem. Terimakasih telah telah melakukan pembayaran";
						echo($number. 'SEPARATOR'.$message);
						send_sms($number, $message);
						// TODO send SMS
					}
					echo('update tiket success');

			} else {
			  mysql_query("update data_bank set terklaim='2' where id='$idtiket'");

			}
	}
 echo( "\n".'no data');
 mysql_close();
 //ob_end_flush();
?>