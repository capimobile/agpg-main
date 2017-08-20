<?php
ob_start();
require'App/lib/Table.php';
require'App/lib/access_db.php';
require'App/lib/manipulate.php';
require'App/lib/WebController.php';
require'App/lib/desc.php';
require'App/lib/clinic_function.php';
require'App/lib/mail_fct.php';
require'App/lib/paging.php';
$RUN = 1;
$Tlog=new Table('log_users');
$has_result = login_ses::check_ses($_SESSION['txtLogin'], $_SESSION['txtPass'],$_SESSION['txtSesId']);
if($has_result==0){
	header("location:login.php");
       exit;
}
else {
		$d_link=Baggeo_Decrypt($_GET['page']);

		$sql=mysql_query("SELECT * FROM modul WHERE  id_levelusers= '".$_SESSION[modul_view]."' AND link_modul='".$d_link."' ");
  		$modulnum = mysql_num_rows($sql);
		if ($modulnum != 0){
			$modul_controller = "modul/mod_$d_link/cont_$d_link.php";
			$modul_action = "modul/mod_$d_link/act_$d_link.php";
			$modul_view = "modul/mod_$d_link/tmp_$d_link.php";
			$nama_modul = mysql_fetch_array($sql);
			define("TITLE", $nama_modul['name_modul']);
		}
		else{
			define("TITLE", 'Not Found');
			$modul_view = "modul/mod_notfound/view.php";
		}

	include "template/backend/index_tmp.php";
}
ob_end_flush();
?>
