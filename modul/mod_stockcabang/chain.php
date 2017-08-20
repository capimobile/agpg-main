<?php
require '../../App/db/Connect.php';
require '../../App/lib/Table.php';
require '../../App/lib/access_db.php';
require '../../App/lib/manipulate.php';

$Tsatuan = new Table('satuan'); 
$Tobat = new Table('obat'); 
if($_GET['sat2']){ 


$currentcode = $Tobat->findBy('id_obat', $_GET['sat2']);
$currentcode = $currentcode->current();
$code= $currentcode->code_obat;

$skecil=selectQ('satuanmin','code_obat',$code,'id_satuankecil');

$currentobat = $Tsatuan->findBy('id_satuan', $skecil);
}
else{
$currentobat = $Tsatuan->findBy('id_satuan', $_GET['sat']);	
}
$currentobat = $currentobat->current();

?>


<input type="text" id="mins" class="form-control" readonly="readonly" value="<?= $currentobat->name_satuan ?>" />
