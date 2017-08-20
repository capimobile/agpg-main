<?php
class Paging{
	function currentpage($a){
		return $a;
	}
	// Fungsi untuk mencek halaman dan posisi data
	function cariPosisi($batas){
	if(empty($_GET['tablepage'])){
		$posisi=0;
		$_GET['tablepage']=1;
	}
	else{
		$posisi = ($_GET['tablepage']-1) * $batas;
	}
	return $posisi;
	}
	
	// Fungsi untuk menghitung total halaman
	function jumlahHalaman($jmldata, $batas){
	$jmlhalaman = ceil($jmldata/$batas);
	return $jmlhalaman;
	}
	
	// Fungsi untuk link halaman 1,2,3 
	function navHalaman($halaman_aktif, $jmlhalaman, $currentpage){
	$link_halaman = "";
	
	// Link ke halaman pertama (first) dan sebelumnya (prev)
	if($halaman_aktif > 1){
		$prev = $halaman_aktif-1;
		$link_halaman .= "<a href=$currentpage&tablepage=1>First</a> | <a href=$currentpage&tablepage=$prev>Prev</a>  ";
	}
	else{ 
		$link_halaman .= "<a>First</a> | <a>Prev</a>  ";
	}
	
	// Link halaman 1,2,3, ...
	$angka = ($halaman_aktif > 3 ? "| ... " : " "); 
	for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
	  if ($i < 1)
		continue;
		  $angka .= "| <a href=$currentpage&tablepage=$i>$i</a> ";
	 }
		  $angka .= "| <a><b>$halaman_aktif</b></a> ";
		  
		for($i=$halaman_aktif+1; $i<($halaman_aktif+6); $i++){
		if($i > $jmlhalaman)
		  break;
		  $angka .= "| <a href=$currentpage&tablepage=$i>$i</a> ";
		}
		  $angka .= ($halaman_aktif+5<$jmlhalaman ? "| <a> ... </a> | <a href=$currentpage&tablepage=$jmlhalaman>$jmlhalaman</a> " : " ");
	
	$link_halaman .= "$angka";
	
	// Link ke halaman berikutnya (Next) dan terakhir (Last) 
	if($halaman_aktif < $jmlhalaman){
		$next = $halaman_aktif+1;
		$link_halaman .= "|<a href=$currentpage&tablepage=$next> Next</a> | <a href=$currentpage&tablepage=$jmlhalaman>Last</a> ";
	}
	else{
		$link_halaman .= "|<a> Next</a> | <a>Last</a>";
	}
	return $link_halaman;
	}
}

//category
class Paging2{
function cariPosisi($batas){
if(empty($_GET['categorypage'])){
	$posisi=0;
	$_GET['categorypage']=1;
}
else{
	$posisi = ($_GET['categorypage']-1) * $batas;
}
return $posisi;
}

// Fungsi untuk menghitung total halaman
function jumlahHalaman($jmldata, $batas){
$jmlhalaman = ceil($jmldata/$batas);
return $jmlhalaman;
}

// Fungsi untuk link halaman 1,2,3 
function navHalaman($halaman_aktif, $jmlhalaman){
$link_halaman = "";

// Link ke halaman pertama (first) dan sebelumnya (prev)
if($halaman_aktif > 1){
	$prev = $halaman_aktif-1;
	$link_halaman .= "<a href=categorypage-$_GET[id]-1><< First</a>  
                    <a href=categorypage-$_GET[id]-$prev>< Prev</a>  ";
}
else{ 
	$link_halaman .= "<a> << First </a>  <a> < Prev </a>  ";
}

// Link halaman 1,2,3, ...
$angka = ($halaman_aktif > 3 ? " ... " : " "); 
for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
  if ($i < 1)
  	continue;
	  $angka .= "<a href=categorypage-$_GET[id]-$i>$i</a>  ";
  }
	  $angka .= " <a><b>$halaman_aktif</b></a>  ";
	  
    for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
    if($i > $jmlhalaman)
      break;
	  $angka .= "<a href=categorypage-$_GET[id]-$i>$i</a>";
    }
	  $angka .= ($halaman_aktif+2<$jmlhalaman ? " ...  <a href=categorypage-$_GET[id]-$jmlhalaman>$jmlhalaman</a>  " : " ");

$link_halaman .= "$angka";

// Link ke halaman berikutnya (Next) dan terakhir (Last) 
if($halaman_aktif < $jmlhalaman){
	$next = $halaman_aktif+1;
	$link_halaman .= " <a href=categorypage-$_GET[id]-$next>Next ></a>  
                     <a href=categorypage-$_GET[id]-$jmlhalaman>Last >></a> ";
}
else{
	$link_halaman .= "<a> Next > </a>  <a> Last >> </a>";
}
return $link_halaman;
}
}


class Paging3{
// Fungsi untuk mencek halaman dan posisi data
function cariPosisi($batas){
if(empty($_GET['accountpage'])){
	$posisi=0;
	$_GET['accountpage']=1;
}
else{
	$posisi = ($_GET['accountpage']-1) * $batas;
}
return $posisi;
}

// Fungsi untuk menghitung total halaman
function jumlahHalaman($jmldata, $batas){
$jmlhalaman = ceil($jmldata/$batas);
return $jmlhalaman;
}

// Fungsi untuk link halaman 1,2,3 
function navHalaman($halaman_aktif, $jmlhalaman){
$link_halaman = "";

// Link ke halaman pertama (first) dan sebelumnya (prev)
if($halaman_aktif > 1){
	$prev = $halaman_aktif-1;
	$link_halaman .= "<a href=accountpage-1><< First</a>  
                    <a href=accountpage-$prev>< Prev</a>  ";
}
else{ 
	$link_halaman .= "<a> << First </a>  <a> < Prev </a>  ";
}

// Link halaman 1,2,3, ...
$angka = ($halaman_aktif > 3 ? " ... " : " "); 
for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
  if ($i < 1)
  	continue;
	  $angka .= "<a href=accountpage-$i>$i</a>  ";
  }
	  $angka .= " <a><b>$halaman_aktif</b></a>  ";
	  
    for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
    if($i > $jmlhalaman)
      break;
	  $angka .= "<a href=accountpage-$i>$i</a>  ";
    }
	  $angka .= ($halaman_aktif+2<$jmlhalaman ? " <a> ... </a>  <a href=accountpage-$jmlhalaman>$jmlhalaman</a>  " : " ");

$link_halaman .= "$angka";

// Link ke halaman berikutnya (Next) dan terakhir (Last) 
if($halaman_aktif < $jmlhalaman){
	$next = $halaman_aktif+1;
	$link_halaman .= " <a href=accountpage-$next>Next ></a>  
                     <a href=accountpage-$jmlhalaman>Last >></a> ";
}
else{
	$link_halaman .= "<a> Next > </a>  <a> Last >> </a>";
}
return $link_halaman;
}
}


?>