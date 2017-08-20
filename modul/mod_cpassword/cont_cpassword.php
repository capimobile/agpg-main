<?php if(!isset($RUN)) { exit(); } ?>
<?php
$page=$_GET[page];
$pag=Baggeo_Decrypt($_GET['page']);
$aksi="modul/mod_$pag/act.php";

$Tmodul = new Table('users');

switch($_GET['act']){
  //homepage
  default:
  $act="?page=$page&act=form&pro=update&id=".Baggeo_Encrypt($_SESSION['user_id']);
  break;
//form page
  case "form":

  break;
}
?>
