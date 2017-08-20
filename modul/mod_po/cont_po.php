<?php if(!isset($RUN)) { exit(); } ?>
<?php
$page=$_GET[page];
$pag=Baggeo_Decrypt($_GET['page']);
$aksi="po/mod_$pag/act.php";

$Tpo = new Table('po'); 
$Txtra = new Table('xtradiscount'); 
$Tproduct = new Table('product'); 
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
	$po = $Tpo->findDistinct("no_po", "WHERE id_po!='0' ORDER BY id_po DESC");
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
	 	$looppo = $Tpo->findValue("no_po='".$_GET['id']."'");
		$act="?page=$page&act=termin&pro=inputapv&id=$_GET[id]";
	break;
}
?>
