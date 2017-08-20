<?php
ob_start();
require'App/lib/Table.php';
require'App/lib/access_db.php';
require'App/lib/manipulate.php';
require'App/lib/WebController.php';
require'App/lib/desc.php';
require'App/lib/clinic_function.php';

$RUN = 1;
$msg = "";
$has_result = login_ses::check_ses($_SESSION['txtLogin'], $_SESSION['txtPass'],$_SESSION['txtSesId']);
if($has_result!=0){
	header("location:index.php?page=".Baggeo_Encrypt('home')."&act=".Baggeo_Encrypt('profile')."&ur=".Baggeo_Encrypt(getUr())."");
        exit;
}
  if(isset($_POST['btnSubmit']) )
  {      
      function anti_injection($data){
  		$filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
  		return $filter;
	  }
		$username = anti_injection($_POST['username']);
		$pass     = anti_injection(sha1(md5($_POST['password'])));
		$post_result = login_ses::post_ses($username, $pass);
      if($post_result!=0)
      {
		  	$login_user=mysql_query("SELECT * FROM users WHERE email_users='$username'");
			$r=mysql_fetch_array($login_user);
			//new session_id
		  	session_regenerate_id();
		    $sid_baru = session_id();
			mysql_query("UPDATE users SET session_users='$sid_baru' WHERE email_users='$username'");
			
            $_SESSION['txtLogin'] 	= $username;
            $_SESSION['txtPass'] 	= $pass;
            $_SESSION['txtSesId'] 	= $sid_baru;
            $_SESSION['user_id'] 	= $r['id_users'];
			$_SESSION['nouser'] 	= $r['no_users'];
			$_SESSION['level']  = $r['id_levelusers'];
			$_SESSION['nama_user']	= $r['name_users'];
			$_SESSION['modul_view']  = $r['id_levelusers'];
			$_SESSION['id_klinik'] 	= $_POST['id_klinik'];
			
			$valid_prev = array("1", "3", "8");
			if(in_array($r['id_levelusers'], $valid_prev)){
				$_SESSION['INVuid']  = 'log_inv';
			}
			
			$Tlog=new Table('log_users');
			$Tlog->save(array(
				'id_users' => $r['id_users'],
				'action' => 'login',
				'name_log' => $_SESSION['nama_user']
			));
			
			//redirect
            	header("location:index.php?page=".Baggeo_Encrypt('home')."&act=".Baggeo_Encrypt('profile')."&ur=".Baggeo_Encrypt(getUr())."");
				
      }
	  $msg = $post_result;
  }


  include "template/backend/login_tmp.php";

ob_end_flush();
?>
