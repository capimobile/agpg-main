<?php if(!isset($RUN)) { exit(); } ?>
<?php
$page=$_GET[page];
$pag=Baggeo_Decrypt($_GET['page']);
$aksi="modul/mod_$pag/act.php";

$Tmodul = new Table('cabang');
$Tmember = new Table('users');
$Tkecamatan = new Table('master_kecamatan');

$Tkurir = new Table('kurir');
$kurirs = $Tkurir->findValue("1=1 ORDER BY name_kurir ASC");

switch($_GET['act']){
  //homepage
  default:
  $moduls = $Tmodul->findAll();
  break;
//form page
  case "form":

if($_GET[id])
		{
		$act="?page=$page&act=form&pro=update&id=$_GET[id]";
		$id=Baggeo_Decrypt($_GET['id']);
        $currentModul = $Tmodul->findBy('id_cabang', $id);
        $currentModul = $currentModul->current();
		$label="Edit";
		}
		else
		{
		$act="?page=$page&act=form&pro=input";
		$label="Add Data";
		}
		$headers = $Tmodul->findBy('status', '1');
		$kecamatans = $Tkecamatan->findAll();
		$members = $Tmember->findValue("id_levelusers=7");
		
     break;
}
?>
