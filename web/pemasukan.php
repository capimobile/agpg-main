<?php 
if(!$_GET['pro']){
include("../mpdf/mpdf.php");
$mpdf=new mPDF('win-650','A4','','',15,10,16,10,10,10);//A4 page in portrait for landscape add -L.
$mpdf->useOnlyCoreFonts = true;    // false is default
$mpdf->SetDisplayMode('fullpage');
// Buffer the following html with PHP so we can store it to a variable later
ob_start();
}
?>
<?php include "../mpdf/pemasukan.php";
 //This is your php page ?>
<?php 

$html = ob_get_contents();
ob_end_clean();
// send the captured HTML from the output buffer to the mPDF class for processing
$mpdf->WriteHTML($html);
$mpdf->Output('LAPORAN PEMASUKAN PO '.changedate($_GET['from']).' - '.changedate($_GET['to']).'.pdf','D'); 
exit;
?>