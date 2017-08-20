<?php if(!isset($RUN)) { exit(); } ?>
<?php
$page=$_GET[page];
$pag=Baggeo_Decrypt($_GET['page']);
$aksi="modul/mod_$pag/act.php";

$Tmodul = new Table('menu'); 
switch($_GET['act']){
  //homepage
  default:
  $moduls = $Tmodul->findAll();
  function noteMenu($a, $b){
	  if($b==1){
		  $note='Menu Tidak Tampil';
	  }
	  elseif($a==0){
		  $note='Main Menu';
	  }
	  else{
		  $note=selectQ('menu', 'id_menu', $a, 'nama_menu');
	  }
	  return $note;
  }
  
  function linkMenu($a, $b){
	  if(empty($a) AND $b == '0'){
		  $note='#';
	  }
	  elseif(empty($a) AND $b != '0'){
		  $note='pages';
	  }
	  else{
		  $note=$a;
	  }
	  return $note;
  }
  
  break;
//form page
  case "form":

if($_GET[id])
		{
		$act="?page=$page&act=form&pro=update&id=$_GET[id]";
		$id=Baggeo_Decrypt($_GET['id']);
        $currentModul = $Tmodul->findBy('id_menu', $id);
        $currentModul = $currentModul->current();
		$label="Edit";
		}
		else
		{
		$act="?page=$page&act=form&pro=input";
		$label="Add Data";
		}
		$headers = $Tmodul->findValue("status='1'");
		
		
     break;
}
?>
