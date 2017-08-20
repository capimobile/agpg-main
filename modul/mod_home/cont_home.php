<?php if(!isset($RUN)) { exit(); } ?>
<?php
$page=$_GET[page];
$pag=Baggeo_Decrypt($_GET['page']);
$aksi="klinik/mod_$pag/act.php";

$Tlog=new Table('log_users');
$log = $Tlog->findValue("id_users='".$_SESSION['user_id']."' AND action='login' ORDER BY id_log DESC");
$log = $log->current();

$Tdoctor = new Table('doctor'); 
$Tpasien = new Table('pasien');  
$Temployee=new Table('employee');

$Tchistory=new Table('chistory');
$Tchistoryp=new Table('chistoryp');
$chistories = $Tchistory->findAll();
$Thistorymed=new Table('historymed');

$Tuser = new Table('users');
 
switch($_GET['act']){
  //homepage
  default:


  break;
//form page
  case "form":


  break;
}
?>
