<?php if(!isset($RUN)) { exit(); } ?>
<?php
$page=$_GET[page];
$pag=Baggeo_Decrypt($_GET['page']);
$aksi="modul/mod_$pag/act.php";

$Tadmin = new Table('users'); 
 
switch($_GET['act']){
  //homepage
  default:
	$admins = $Tadmin->findValue("id_levelusers='7'");

     break;
//form page
  case "form":
if($_GET[id])
		{	
		$act="?page=$page&act=form&pro=update&id=$_GET[id]";
		$id=Baggeo_Decrypt($_GET['id']);
        $currentadmin = $Tadmin->findBy('id_users', $id);
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
