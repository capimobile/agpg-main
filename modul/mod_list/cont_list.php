<?php if(!isset($RUN)) { exit(); } ?>
<?php
$page=$_GET[page];
$pag=Baggeo_Decrypt($_GET['page']);
$aksi="po/mod_$pag/act.php";

$Tpo = new Table('po'); 
$Ttermin = new Table('termin'); 
$Tproduct = new Table('product'); 
$products = $Tproduct->findAll();
	function statusPO($a){
		if($a==1){
			$tp='Sukses';
		}
		elseif($a==2){
			$tp='Di Tolak';
		}
		elseif($a==0){
			$tp='Menunggu';
		}
		return $tp;
	}
switch($_GET['act']){
  //homepage
  default:
	$po = $Tpo->findDistinct("no_po", "WHERE id_users='".$_SESSION['user_id']."' ORDER BY id_po DESC");
  break;
//form page
  case "form":
  

	if($_GET[id]){
		$act="?page=$page&act=form&pro=update&id=$_GET[id]";
		$id=Baggeo_Decrypt($_GET['id']);
        $currentpo = $Tpo->findBy('id_po', $id);
        $currentpo = $currentpo->current();
		$label="Edit Data";
	}
	else{
		$act="?page=$page&act=form&pro=input";
		$label="Add Data";
	}
		
     break;
	
	case"termin";
	    $act="?page=$page&act=termin&pro=inputapv&id=$_GET[id]";
	 	$looppo = $Tpo->findValue("id_users='".$_SESSION['user_id']."' AND no_po='".$_GET['id']."'");
	break;
}
?>
