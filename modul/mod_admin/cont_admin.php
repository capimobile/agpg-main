<?php if(!isset($RUN)) { exit(); } ?>
<?php
$page=$_GET[page];
$pag=Baggeo_Decrypt($_GET['page']);
$aksi="modul/mod_$pag/act.php";

$Tadmin = new Table('users'); 
 
switch($_GET['act']){
  //homepage
  default:
if($_SESSION['level']==1){
	$admins = $Tadmin->findValue("id_levelusers!='7'");
}
elseif($_SESSION['level']==3){
	$admins = $Tadmin->findValue("id_levelusers!='1' AND id_levelusers!='7'");
}

     break;
//form page
  case "form":
  $Tlevel = new Table('levelusers');
  $levels = $Tlevel->findValue("id_levelusers!='1' AND id_levelusers!='7'");
  $Ticon = new Table('icon');
  $icons = $Ticon->findAll();

if($_GET[id])
		{	
		$act="?page=$page&act=form&pro=update&id=$_GET[id]";
		$id=Baggeo_Decrypt($_GET['id']);
        $currentadmin = $Tadmin->findBy('link_admin', $id);
        $currentadmin = $currentadmin->current();
		$label="Edit Data";
		}
		else
		{
		$act="?page=$page&act=form&pro=input";
		$label="Add Data";
		}
		$headers = $Tadmin->findBy('link', ' ');
		
		
     break;
}
?>
