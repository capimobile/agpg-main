<?php if(!isset($RUN)) { exit(); } ?>
<?php
$page=$_GET[page];
$pag=Baggeo_Decrypt($_GET['page']);
$aksi="modul/mod_$pag/act.php";

$Tmodul = new Table('modul'); 
 
switch($_GET['act']){
  //homepage
  default:
$moduls = $Tmodul->findDistinct('link_modul','');


     break;
//form page
  case "form":
  $Tlevel = new Table('levelusers');
  $levels = $Tlevel->findAll();
  $Ticon = new Table('icon');
  $icons = $Ticon->findAll();

if($_GET[id])
		{	
		$act="?page=$page&act=form&pro=update&id=$_GET[id]";
		$id=Baggeo_Decrypt($_GET['id']);
        $currentModul = $Tmodul->findBy('link_modul', $id);
        $currentModul = $currentModul->current();
		$label="Edit Data";
		}
		else
		{
		$act="?page=$page&act=form&pro=input";
		$label="Add Data";
		}
		$headers = $Tmodul->findDistinct('link_modul',"WHERE id_unik !='0' AND id_header='0' AND sheader='1'");
		
		
     break;
}
?>
