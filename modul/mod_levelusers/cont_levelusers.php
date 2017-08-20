<?php if(!isset($RUN)) { exit(); } ?>
<?php
$page=$_GET[page];
$pag=Baggeo_Decrypt($_GET['page']);
$aksi="levelusers/mod_$pag/act.php";

$Tlevelusers = new Table('levelusers'); 
switch($_GET['act']){
  //homepage
  default:
$leveluserss = $Tlevelusers->findAll();

     break;
//form page
  case "form":
  

if($_GET[id])
		{
		$act="?page=$page&act=form&pro=update&id=$_GET[id]";
		$id=Baggeo_Decrypt($_GET['id']);
        $currentlevelusers = $Tlevelusers->findBy('id_levelusers', $id);
        $currentlevelusers = $currentlevelusers->current();
		$label="Edit Data";
		}
		else
		{
		$act="?page=$page&act=form&pro=input";
		$label="Add Data";
		}
		$headers = $Tlevelusers->findBy('link', ' ');
		
		
     break;
}
?>
