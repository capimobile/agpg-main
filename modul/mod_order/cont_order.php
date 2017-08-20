<?php if(!isset($RUN)) { exit(); } ?>
<?php
$page=$_GET[page];
$pag=Baggeo_Decrypt($_GET['page']);
$aksi="modul/mod_$pag/act.php";

$Tproduct = new Table('product'); 
$products = $Tproduct->findAll();

$Tmodul = new Table('orders');
$Torder = new Table('orders_detail');
$Tcabang = new Table('cabang');
$cabangs = $Tcabang->findValue("1=1 ORDER BY name_cabang ASC");

switch($_GET['act']){
  //homepage
  default:
  $moduls = $Tmodul->findAllDesc('id_orders');

  break;
//form page
  case "form":

if($_GET[id])
		{
		$act="?page=$page&act=form&pro=update&id=$_GET[id]";
		$id=Baggeo_Decrypt($_GET['id']);
        $currentModul = $Tmodul->findBy('id_orders', $id);
        $currentModul = $currentModul->current();
		$currentMember = $Tmember->findBy('id_members', $currentModul->id_members);
        $currentMember = $currentMember->current();
		$orders = $Torder->findBy('id_orders', $currentModul->id_orders);
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
