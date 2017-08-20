<?php if(!isset($RUN)) { exit(); } ?>
<?php
$page=$_GET[page];
$pag=Baggeo_Decrypt($_GET['page']);
$aksi="modul/mod_$pag/act.php";

$Tmodul = new Table('jamorder');

switch($_GET['act']){
  //homepage
  default:
  $act="?page=$page&act=form&pro=update&id=".Baggeo_Encrypt('1');
  $currentModul = $Tmodul->findBy('id_jamorder', '1');
  $currentModul = $currentModul->current();
  break;
//form page
  case "form":

  break;
}
?>
