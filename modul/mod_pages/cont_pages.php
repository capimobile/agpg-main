<?php if(!isset($RUN)) { exit(); } ?>
<?php
$page=$_GET[page];
$pag=Baggeo_Decrypt($_GET['page']);
$aksi="modul/mod_$pag/act.php";

$Tmodul = new Table('pages'); 
switch($_GET['act']){
  //homepage
  default:
  $moduls = $Tmodul->findValue("id_menu != '0'");
  break;
//form page
  case "form":

if($_GET[id])
		{
		$act="?page=$page&act=form&pro=update&id=$_GET[id]";
		$id=Baggeo_Decrypt($_GET['id']); 
        $currentModul = $Tmodul->findBy('id_pages', $id);
        $currentModul = $currentModul->current();
		$label="Edit";
		}
		else
		{
		$act="?page=$page&act=form&pro=input";
		$label="Add Data";
		}
		$Tmenu = new Table('menu');
		$hdrs = $Tmenu->findValue("modul_menu='1'");
		
		
     break;
}
?>
