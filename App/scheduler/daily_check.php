<?php
// ob_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// require'App/lib/Table.php';
require(__DIR__.'/../../App/lib/Table.php');

echo('start daily maintenance db');
echo("<br/>");

/* INSERT DATA TEMP SOLD PRODUCT TO TABLE DAILY_STOCK_PRODUCT*/
$Ttsolds = new Table('temp_sold_product');
$tsolds = $Ttsolds->findAll();
// echo("'".$tsolds."'");
foreach($tsolds as $tsold){
	echo("INSERT INTO daily_sold_product  (id_product, date_sold, qty_sold) VALUES('".$tsold->id_product."',".date('Y-m-d').", '".$tsold->qty_sold."')");
	echo("<br/>");
 	$sqlTemp = "INSERT INTO daily_sold_product  (id_product, date_sold, qty_sold) VALUES('".$tsold->id_product."','".date('Y-m-d')."', '".$tsold->qty_sold."')";
 if (!mysql_query($sqlTemp, Connect::getConnection())) echo "Error: $sqlTemp";
}
		
/*DELETE TABLE TEMP_SOLD_PRODUCT*/		
$sqldelete = "DELETE FROM temp_sold_product;";
if (!mysql_query($sqldelete, Connect::getConnection())) echo "Error: $sqldelete";
echo('table temp_sold_product empty');
echo("<br/>");

/*ADD NEW ROW TABLE DAILY SOLD PRODUCT*/
$Tproduct = new Table('product');
$products = $Tproduct->findAll();
// echo("'".$tsolds."'");
foreach($products as $product){
	echo("INSERT INTO daily_sold_product  (id_product, date_sold, qty_sold) VALUES('".$product->id_product."',".date('Y-m-d',  strtotime(date('Y-m-d') . ' +1 day')).", '".$product->qty_sold."')");
	echo("<br/>");
 	$sqlTemp = "INSERT INTO daily_sold_product  (id_product, date_sold, qty_sold) VALUES('".$product->id_product."','".date('Y-m-d', strtotime(date('Y-m-d') . ' +1 day'))."', '".$product->qty_sold."')";
 if (!mysql_query($sqlTemp,Connect::getConnection())) echo "Error: $sqlTemp";
}

echo('finish daily maintenance db');

 mysql_close();
 //ob_end_flush();
?>