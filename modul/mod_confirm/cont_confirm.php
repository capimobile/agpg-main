<?php if(!isset($RUN)) { exit(); } ?>
<?php
$page=$_GET[page];
$pag=Baggeo_Decrypt($_GET['page']);
$aksi="modul/mod_$pag/act.php";

$Tconfirm = new Table('confirmation'); 
switch($_GET['act']){
  //homepage
  default:
$confirms = $Tconfirm->findAllDesc("id_confirmation");
function statusCon($a){
			$st=selectQ('orders', 'id_orders', $a, 'status_order');
			if($st==1){
				echo"Lunas";
			}
			elseif($st==0){
				echo"Belum Lunas";
			}
		}


     break;
//form page
  case "view":

		$act="?page=$page&act=form&pro=update&id=$_GET[id]";
		$id=Baggeo_Decrypt($_GET['id']);
        $currentConfirm = $Tconfirm->findBy('id_confirmation', $id);
        $currentConfirm = $currentConfirm->current();
	
		
     break;
}
?>
