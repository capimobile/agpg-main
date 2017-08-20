<ul class="sidebar-menu" id="nav-accordion">
<?php 
$head=mysql_query("SELECT * FROM modul WHERE id_levelusers='$_SESSION[modul_view]' AND id_header='0' AND status_modul='1' order by urutan_modul ASC");
while ($h=mysql_fetch_array($head)){
$icon=mysql_query("SELECT * FROM icon WHERE id_icon='$h[id_icon]'");
$i=mysql_fetch_array($icon);

if(selectV('modul', "link_modul='".Baggeo_Decrypt($_GET['page'])."'", 'id_header')==$h['link_modul'] AND $h['sheader']=='1'){
	$active2='active';		
}
else{
	$active2=' ';	
}
if(Baggeo_Encrypt($h['link_modul']) == $_GET['page']){
	$active1='active';		
}
else{
	$active1=' ';	
}

if($h['link_modul']=='home'){
	$link='?page='.Baggeo_Encrypt($h['link_modul']).'&act='.Baggeo_Encrypt('profile').'&ur='.Baggeo_Encrypt(getUr());	
}
elseif($h['sheader']==1){
	$link='#';	
}
else{
	$link='?page='.Baggeo_Encrypt($h['link_modul']);	
}

?>
                  <li class="sub-menu">
                      <a class="<?=$active1?> <?=$active2?>" href="<?=$link?>">
                          <i class="<?=$i['url_icon']?>"></i>
                          <span><?=$h['name_modul']?></span>
                      </a>
                      
                      <?php if($h['sheader']==1){?>
                      <ul class="sub">
                          <?php
					  $mod=mysql_query("SELECT * FROM modul WHERE id_levelusers='$_SESSION[modul_view]' AND id_header='".$h['link_modul']."' AND status_modul='1' order by urutan_modul ASC, id_modul ASC");
while ($m=mysql_fetch_array($mod)){
if(Baggeo_Encrypt($m['link_modul']) == $_GET['page']){
	$active3='active';		
}
else{
	$active3=' ';	
}
?>

                          <li class="<?=$active3?>"><a href="?page=<?=Baggeo_Encrypt($m['link_modul'])?>"><?=$m['name_modul']?></a></li>
                          <?php }?>
                      </ul>
                      <?php }?>
                  </li>
<?php }?>
              </ul>