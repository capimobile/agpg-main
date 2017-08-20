<?php if(!isset($RUN)) { exit(); } ?>
<?php
$page=$_GET[page];
$pag=Baggeo_Decrypt($_GET['page']);
$aksi="product/mod_$pag/act.php";

$Tproduct = new Table('product'); 
$Tkproduct = new Table('kategoriproduct'); 
$Tsatuan = new Table('satuan'); 

$kproducts = $Tkproduct->findAll();
$satuans = $Tsatuan->findAll();

switch($_GET['act']){
  //homepage
  default:
$products = $Tproduct->findAll();
     break;
//form page
  case "form":
  

if($_GET[id])
		{
		$act="?page=$page&act=form&pro=update&id=$_GET[id]";
		$id=Baggeo_Decrypt($_GET['id']);
        $currentproduct = $Tproduct->findBy('id_product', $id);
        $currentproduct = $currentproduct->current();
		$label="Edit Data";
		}
		else
		{
		$act="?page=$page&act=form&pro=input";
		$label="Add Data";
		}
		$headers = $Tproduct->findBy('link', ' ');
		
		
     break;
}
?>
