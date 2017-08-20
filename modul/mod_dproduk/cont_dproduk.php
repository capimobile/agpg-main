<?php if(!isset($RUN)) { exit(); } ?>
<?php
$page=$_GET[page];
$pag=Baggeo_Decrypt($_GET['page']);
$aksi="modul/mod_$pag/act.php";

$Tmodul = new Table('uploads');

switch($_GET['act']){
  //homepage
  default:
  $moduls = $Tmodul->findValue("tipe_uploads='produk'");
  break;
//form page
  case "form":

if($_GET[id])
		{
		$act="?page=$page&act=form&pro=update&id=$_GET[id]";
		$id=Baggeo_Decrypt($_GET['id']);
        $currentModul = $Tmodul->findBy('id_uploads', $id);
        $currentModul = $currentModul->current();
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
