<?php
require'App/lib/Table.php';
require'App/lib/access_db.php';
require'App/lib/manipulate.php';
require'App/lib/daylily_function.php';

$id=Baggeo_Decrypt($_GET['id']); 

$Torder = new Table('orders');	
$Tmember = new Table('members'); 
$Todetail= new Table('orders_detail');
$Tproduct = new Table('product');
$Tbank = new Table('bank');
$banks=$Tbank->findAll(); 

$currentOrder = $Torder->findBy('id_orders', $id);
$currentOrder = $currentOrder->current();

$orders= $Todetail->findBy('id_orders',$currentOrder->id_orders);

$currentMember = $Tmember->findBy('id_members', $currentOrder->id_members);
$currentMember = $currentMember->current();

echo"<table width='594' border='0' cellspacing='0' cellpadding='0' align='center' style='font-size:12px;'>
	<tr>
    	<td>
        
        </td>
    </tr>
</table>
<table width='594' border='0' cellspacing='0' cellpadding='0' align='center' style='font-size:12px;'>
	<tr>
    	<td><h3 align='center'>Order ID : ". $currentOrder->invoice ."</h3></td>
    </tr>
</table>
<table width='594' border='0' cellspacing='0' cellpadding='0' align='center' style='font-size:12px;'>
  <tr>
    <th style='border:thin solid #666; padding:4px 8px;'>Nama Produk</th>
    <th style='border:thin solid #666;'>Harga</th>
    <th style='border:thin solid #666;'>Jumlah</th>
    <th style='border:thin solid #666;'>Total</th>
  </tr>"; 
   foreach($orders as $order){ 
  $currentProduct = $Tproduct->findBy('id_product', $order->id_product);
  $currentProduct = $currentProduct->current();
  $dsc=selectQ('product', 'id_product', $currentProduct->id_product, 'discount_product');
								if(selectQ('product', 'id_product', $currentProduct->id_product, 'drp_product')==1){
									$tjual=$currentProduct->hjual_product-$dsc;
								}
								elseif(selectQ('product', 'id_product', $currentProduct->id_product, 'drp_product')==2){
									$cdsc=($currentProduct->hjual_product*$dsc)/100;
									$tjual=$currentProduct->hjual_product-$cdsc;
								}
								else{
									$tjual=$currentProduct->hjual_product;
								}
 echo" <tr>
    <td style='border:thin solid #666; padding:3px 8px; font-weight:bold'>".$currentProduct->name_product."</td>
    <td style='border:thin solid #666; padding:0 8px;'>Rp ". rupiah($tjual) ."</td>
    <td style='border:thin solid #666; padding:0 8px;'>". $order->jumlah ."</td>
    <td style='border:thin solid #666; padding:0 8px;'>Rp ". rupiah($tjual * $order->jumlah)."</td>
  </tr>"; 
$total=$tjual * $order->jumlah;
  $stotal=$stotal+$total;
   }
 echo" 
  <tr>
    <td style='border-left:thin solid #666;border-right:thin solid #666; padding:0 8px; text-align:right; font-weight:bold;' colspan='3'>Diskon</td>
    <td style='border-right:thin solid #666; padding:0 8px;'>0</td>
  </tr>
  <tr>
    <td style='border-left:thin solid #666;border-right:thin solid #666;border-bottom:thin solid #666; padding:0 8px; text-align:right; font-weight:bold;' colspan='3'>Jumlah Sub Total Belanja</td>
    <td style='border-right:thin solid #666;border-bottom:thin solid #666; padding:0 8px;'>Rp ". rupiah($stotal) ."</td>
  </tr>
  <tr>
    <td style='border-left:thin solid #666;border-right:thin solid #666; padding:0 8px; text-align:right; font-weight:bold;' colspan='3'>Biaya Pengiriman</td>
    <td style='border-right:thin solid #666; padding:0 8px;'>Rp ".rupiah($currentOrder->shipping_cost)."</td>
  </tr>
  <tr>
    <td style='border-left:thin solid #666;border-right:thin solid #666; padding:0 8px; text-align:right; font-weight:bold;' colspan='3'>Biaya Tambahan</td>
    <td style='border-right:thin solid #666; padding:0 8px;'>0</td>
  </tr>
  <tr>
    <td style='border-left:thin solid #666;border-right:thin solid #666;font-size:16px;border-bottom:thin solid #666; padding:0 8px; text-align:right; font-weight:bold;' colspan='3'>Biaya Total Belanja</td>
    <td style='border-right:thin solid #666;border-bottom:thin solid #666; font-size:14px; padding:0 8px;font-weight:bold;'>Rp ". rupiah($stotal +  $currentOrder->shipping_cost) ."</td>
  </tr>
  
</table>
<table width='594' border='0' cellspacing='0' cellpadding='0' align='center' style='font-size:12px'>
  <tr>
  	<td>
		<br /><br />
Data Pemesan :<br /><br />
		<table>
        	<tr>
            	<td width='150'>Nama lengkap</td><td>". $currentOrder->nama_order ."</td>
            </tr>
            <tr>
                <td width='150'>Alamat</td><td>". $currentOrder->add_address ."</td>
            </tr>
        </table>
    </td>
  </tr>
</table>";
?>