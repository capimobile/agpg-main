<?php if(!isset($RUN)) { exit(); } ?>
<?php
$page=$_GET[page];
$pag=Baggeo_Decrypt($_GET['page']);
$aksi="kategoriproduct/mod_$pag/act.php";

$Tkategoriproduct = new Table('kategoriproduct'); 
switch($_GET['act']){
  //homepage
  default:
$kategoriproducts = $Tkategoriproduct->findAll();

     break;
//form page
  case "form":
  

if($_GET[id])
		{
		$act="?page=$page&act=form&pro=update&id=$_GET[id]";
		$id=Baggeo_Decrypt($_GET['id']);
        $currentkategoriproduct = $Tkategoriproduct->findBy('id_kategoriproduct', $id);
        $currentkategoriproduct = $currentkategoriproduct->current();
		$label="Edit Data";
		}
		else
		{
		$act="?page=$page&act=form&pro=input";
		$label="Add Data";
		}
		$headers = $Tkategoriproduct->findBy('link', ' ');
		
		
     break;
}
?>
