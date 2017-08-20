<?php if(!isset($RUN)) { exit(); } ?>
<?php switch($_GET['act']){
//dasboard modul	
 default:	 ?>
<div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                             <?= TITLE ?>
                          </header>
                          <div class="panel-body">
                                <div class="adv-table">
                          <form method="get" action="">
                          	<input type="hidden" name="page" value="<?=$_GET['page']?>" />
                          		<div class="form-group">
                                      <div class="col-md-3 col-xs-3">
                                          <div data-date-minviewmode="months" data-date-viewmode="years" data-date-format="yyyy-mm" data-date="<?=date('Y-m')?>"  class="input-append date dpMonths">
                                              <input type="text" readonly="" size="16" class="form-control" name="tanggal" value="<?=$_GET['tanggal']?>">
                                                  <span class="input-group-btn add-on">
                                                    <button class="btn btn-danger" type="button"><i class="icon-calendar"></i></button>
                                                  </span>
                                          </div>
                                          <span class="help-block">Select month</span>
                                      </div>
                                      <button type="submit" class="btn btn-success btn-sm" style="margin-left:25px; margin-top:3px;">Submit</button>
                                  </div>
                          </form>
                          <br />
                          <h5>
                          	BULAN : <?=$dates?>
                          </h5>
                          <?php if(isset($_GET['tablepage'])){
							  $paging=$_GET['tablepage'];
						  }
						  else{
							  $paging=1;
						  }?>
                			 <iframe src="web/fee.php?tanggal=<?=$dates?>&tablepage=<?=$paging?>" width="100%" height="700" frameborder="0"/></iframe>
</div>
                          </div>
                      </section>
                  </div>                         

<?php break; 

//Form Page
case "view": ?>
<div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                             DETAIL PESANAN
                          </header>
                          <div class="panel-body">
                          <h5>
                          <table>
                          <tr><td>Tanggal </td><td>: <?=selectV('orders',"id_orders='".$id."'",'tgl_order')?></td></tr>
                          <tr><td>No Faktur </td><td>: <?=selectV('orders',"id_orders='".$id."'",'invoice')?></td></tr>
                          <tr><td>Cabang </td><td>: <?=selectV('cabang',"id_cabang='".selectV('orders',"id_orders='".$id."'",'id_cabang')."'",'name_cabang')?></td></tr>
                          <tr><td>Alamat </td><td>: <?=selectV('cabang',"id_cabang='".selectV('orders',"id_orders='".$id."'",'id_cabang')."'",'lokasi_cabang')?></td></tr>
                          <tr><td>Status Pesanan </td><td>: 
						  <?php if(selectV('orders',"id_orders='".$id."'",'status_orders')==0){
							  echo"<font color='#FF0000'>Menunggu Pembayaran</font>";
						  }
						  else{
							  if(selectV('orders',"id_orders='".$id."'",'status_orders')==1){
								  $pembayaran="<font color='#00CC33'>Tunai</font>";
							  }
							  elseif(selectV('orders',"id_orders='".$id."'",'status_orders')==2){
								  $pembayaran="<font color='#00CC33'>Transfer Bank</font>";
							  }
							  echo"Telah Melakukan Pembayaran - ".$pembayaran;
						  }?>
                          
                          </td></tr>
                          </table>
                          </h5>
                          <form action="?page=<?=$_GET['page']?>&act=orderconfirm&order=<?=$_GET['order']?>&pro=input" method="post">
                          <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                      <thead>
                                      <tr style="border-bottom:thin solid #999;">
                                          <th width="50">No</th>
                                          <th width="80">Code</th>
                                          <th>Nama</th>
                                          <th>Satuan</th>
                                          <th width="80">Qty</th>
                                          <th>Harga</th>
                                          <th>Total</th>
                                      </tr>
                                      </thead>
                                      <tbody>
                                      <?php $no=1;
										foreach ($orders as $order) {
											$total=$order->jumlah*selectQ('product', 'id_product', $order->id_product, 'hjual_product');
											$grand=$grand+$total;
									  ?>
                                      <tr>
                                          <td><?= $no ?></td>
                                          <td><?=selectQ('product', 'id_product', $order->id_product, 'code_product')?></td>
                                          <td><?=selectQ('product', 'id_product', $order->id_product, 'name_product')?></td>
                                          <td><?=selectQ('satuan', 'id_satuan', selectQ('product', 'id_product', $order->id_product, 'kemasan_product'), 'name_satuan')?></td>
                                          <td class="center">
                                            <?=(int)$order->jumlah?>
                                          </td>
                                          <td>Rp. <?php echo rupiah(selectQ('product', 'id_product', $order->id_product, 'hjual_product'));?></td>
                                          <td>Rp. <?php echo rupiah($total)?></td>
                                      </tr>    
                                      <?php $no++; } ?>
                                      <tr>
                                      	<td colspan="6" align="right" style="font-size:12px; font-weight:bold; padding:5px 10px;">GRAND TOTAL</td>
                                        <td style="font-size:12px; font-weight:bold;">Rp. <?php echo rupiah($grand)?></td>
                                      </tr>
                                      <tr>
                                      	<td colspan="7" align="center">
                                        	<a href="web/fakturprint.php?id=<?=$id?>" target="_blank"> <button type="button" class="btn btn-success">Cetak Faktur</button></a>
                                            <a href="web/fakturexport.php?id=<?=$id?>" target="_blank"> <button type="button" class="btn btn-success">Export Excell</button></a>
                                        </td>
                                      </tr>     
                                      </tbody>      
                </table>
                </form>
                          </div>
                      </section> 
                 </div>
<?php break; } ?>