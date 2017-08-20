<?php if(!isset($RUN)) { exit(); } ?>
<?php
$page=$_GET[page];
$pag=Baggeo_Decrypt($_GET['page']);
$aksi="satuan/mod_$pag/act.php";

$Tsatuan = new Table('satuan'); 
switch($_GET['act']){
  //homepage
  default:
$satuans = $Tsatuan->findAll();

     break;
//form page
  case "form":
  

if($_GET[id])
		{
		$act="?page=$page&act=form&pro=update&id=$_GET[id]";
		$id=Baggeo_Decrypt($_GET['id']);
        $currentsatuan = $Tsatuan->findBy('id_satuan', $id);
        $currentsatuan = $currentsatuan->current();
		$label="Edit Data";
		}
		else
		{
		$act="?page=$page&act=form&pro=input";
		$label="Add Data";
		}
		$headers = $Tsatuan->findBy('link', ' ');
		
		
     break;
}
?>
