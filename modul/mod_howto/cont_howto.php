<?php if(!isset($RUN)) { exit(); } ?>
<?php
$page=$_GET[page];
$pag=Baggeo_Decrypt($_GET['page']);
$aksi="modul/mod_$pag/act.php";

$Tmodul = new Table('homepage');
switch($_GET['act']){
  //homepage
  default:
  $moduls = $Tmodul->findBy('tipe','site');
  break;
//form page
  case "form":

if($_GET[id])
		{
		$act="?page=$page&act=form&pro=update&id=$_GET[id]";
		$id=$_GET['id'];
        $currentModul = $Tmodul->findBy('alias_homepage', $id);
        $currentModul = $currentModul->current();
		$label="Edit";
		}
		else
		{
		$act="?page=$page&act=form&pro=input";
		$label="Add Data";
		}
		//$headers = $Tmodul->findBy('status', '1');
		
		
     break;
}
?>
