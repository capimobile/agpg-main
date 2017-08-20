<?php
function emailOrder($a){
$Torder = new Table('orders');	
$Tmember = new Table('members'); 
$Todetail= new Table('orders_detail');
$Tproduct = new Table('product');
$Tbank = new Table('bank');
$banks=$Tbank->findAll(); 

$currentOrder = $Torder->findBy('id_orders', $a);
$currentOrder = $currentOrder->current();

$orders= $Todetail->findBy('id_orders',$currentOrder->id_orders);

$currentMember = $Tmember->findBy('id_members', $currentOrder->id_members);
$currentMember = $currentMember->current();

$strTo = $currentMember->email_members;
$strSubject = "Biaya Total Belanja, Order id: ".$currentOrder->invoice;
$strHeader = 'MIME-Version: 1.0' . "\r\n";
$strHeader .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$strHeader .= 'From: Daylily<order@daylily.co.id>' . "\r\n";
$strMessage = "

<table width='594' border='0' cellspacing='0' cellpadding='0' align='center' style='font-size:12px;'>
	<tr>
    	<td>
        	Dear ".$currentOrder->nama_order .",<br /><br />
 
            Terima kasih telah melakukan order belanja di daylily.co.id . Berikut adalah detail order anda :<br /><br />

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

 $strMessage .=" <tr>
    <td style='border:thin solid #666; padding:3px 8px; font-weight:bold'>".$currentProduct->name_product."</td>
    <td style='border:thin solid #666; padding:0 8px;'>Rp ". rupiah($tjual) ."</td>
    <td style='border:thin solid #666; padding:0 8px;'>". $order->jumlah ."</td>
    <td style='border:thin solid #666; padding:0 8px;'>Rp ". rupiah($tjual * $order->jumlah)."</td>
  </tr>"; 
  $total=$tjual * $order->jumlah;
  $stotal=$stotal+$total;
   }
 $strMessage .=" 
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
    <td style='border-right:thin solid #666; padding:0 8px;'>Rp ".rupiah($_POST['shipping_cost'])."</td>
  </tr>
  <tr>
    <td style='border-left:thin solid #666;border-right:thin solid #666; padding:0 8px; text-align:right; font-weight:bold;' colspan='3'>Biaya Tambahan</td>
    <td style='border-right:thin solid #666; padding:0 8px;'>0</td>
  </tr>
  <tr>
    <td style='border-left:thin solid #666;border-right:thin solid #666;font-size:16px;border-bottom:thin solid #666; padding:0 8px; text-align:right; font-weight:bold;' colspan='3'>Biaya Total Belanja</td>
    <td style='border-right:thin solid #666;border-bottom:thin solid #666; font-size:14px; padding:0 8px;font-weight:bold;'>Rp ". rupiah($stotal + $_POST['shipping_cost']) ."</td>
  </tr>
  
</table>
<table width='594' border='0' cellspacing='0' cellpadding='0' align='center' style='font-size:12px'>
  <tr>
  	<td>
		<br /><br />
Data Diri :<br /><br />
		<table>
        	<tr>
            	<td width='150'>Nama lengkap</td><td>". $currentOrder->nama_order ."</td>
            </tr>
            <tr>
                <td width='150'>Alamat</td><td>". $currentOrder->add_address ."</td>
            </tr>
        </table><br>
		Silahkan transfer ke rekening yang tertera di bawah ini:<br><br>";
		$n=1;
		foreach($banks as $bank){
$strMessage .= "<strong> $n. ".$bank->name_bank." ( ".$bank->rek_bank." a/n ".$bank->account_bank." )</strong><br />

";			
$n++;
		}
		
$strMessage .= "        <br /><br />
Pembayaran kami terima paling lambat 48 jam setelah order, lewat masa tersebut order otomatis dibatalkan. Untuk informasi lebih lanjut tentang order anda silahkan menghubungi CS kami melalui email atau telepon.<br /><br />
Terima kasih sudah mengunjungi website daylily.co.id<br /><br /><br /> 
Salam dan sukses selalu.

    </td>
  </tr>
</table>
";

mail($strTo,$strSubject,$strMessage,$strHeader);
		echo"<script>alert('Update Success'); window.location = ('?page=".$_GET['page']."')</script>";	
}
?>