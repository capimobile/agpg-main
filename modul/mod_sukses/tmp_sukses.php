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
                                          <div data-date-viewmode="years" data-date-format="yyyy-mm-dd" data-date="<?=$_GET['tanggal']?>"  class="input-append date dpYears">
                                              <input type="text" readonly="" size="16" class="form-control" name="tanggal" value="<?=$_GET['tanggal']?>">
                                                  <span class="input-group-btn add-on">
                                                    <button class="btn btn-danger" type="button"><i class="icon-calendar"></i></button>
                                                  </span>
                                          </div>
                                          <span class="help-block">Select date</span>
                                      </div>
                                      <button type="submit" class="btn btn-success btn-sm" style="margin-left:25px; margin-top:3px;">Submit</button>
                                  </div>
                          </form>
                          <br />
                          <h5>
                          	Tanggal : <?=$dates?>
                          </h5>
                 <table  class="display table table-bordered table-striped">
                                      <thead>
                                      <tr>
                                          <th width="50">No</th>
                                          <th>Tanggal</th>
                                          <th>Faktur</th>
                                          <th>Cabang</th>
                                          <th>Pemilik</th>
                                          <th>Pembayaran</th>
                                          <th></th>
                                      </tr>
                                      </thead>
                                      <tbody>
                                      <?php $no=1;
				    				  foreach($moduls as $modul){
									  ?>
                                      <tr>
                                          <td><?= $no ?></td>
                                          <td><?php echo $modul->tgl_order;?></td>
                                          <td><?php echo $modul->invoice;?></td>
                                          <td><?=selectQ('cabang', 'id_cabang', $modul->id_cabang, name_cabang)?></td>
                                          <td><?=selectQ('users', 'id_users', selectQ('cabang', 'id_cabang', $modul->id_cabang, 'id_users'), 'name_users')?></td>
                                          <td><?php if($modul->status_order==1){echo"Cash";}elseif($modul->status_order==2){echo"Transfer";}?></td>
                                          <td>
                                          	<a href="<?="?page=$page&act=view"?>&id=<?=Baggeo_Encrypt($modul->id_orders)?>" title="View" class="btn btn-success btn-xs">View</a>
                                            <?php if($modul->status_order==0){hapus(Baggeo_Encrypt($modul->id_orders));}?>
                                          </td>
                                      </tr>    
                                      <?php $no++; } ?>     
                                      </tbody>      
                </table>   
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
						  <?php if(selectV('orders',"id_orders='".$id."'",'status_order')==0){
							  echo"<font color='#FF0000'>Menunggu Pembayaran</font>";
						  }
						  else{
							  if(selectV('orders',"id_orders='".$id."'",'status_order')==1){
								  $pembayaran="<font color='#00CC33'>Tunai</font>";
							  }
							  elseif(selectV('orders',"id_orders='".$id."'",'status_order')==2){
								  $pembayaran="<font color='#00CC33'>Transfer Bank</font>";
							  }
							  echo"Telah Melakukan Pembayaran - ".$pembayaran;
						  }?>
                          
                          </td></tr>
                          </table>
                          </h5>
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
											$total=$order->jumlah*$order->harga;
											$grand=$grand+$total;
									  ?>
                                      <tr>
                                          <td><?= $no ?></td>
                                          <td><?=selectQ('product', 'id_product', $order->id_product, 'code_product')?></td>
                                          <td><?=selectQ('product', 'id_product', $order->id_product, 'name_product')?></td>
                                          <td><?=selectQ('satuan', 'id_satuan', selectQ('product', 'id_product', $order->id_product, 'kemasan_product'), 'name_satuan')?></td>
                                          <td class="center">
                                            <?=$order->jumlah?>
                                          </td>
                                          <td>Rp. <?php echo rupiah($order->harga);?></td>
                                          <td>Rp. <?php echo rupiah($total)?></td>
                                      </tr>    
                                      <?php $no++; } ?>
                                      <?php if(selectV('orders',"id_orders='".$id."'",'discount_order')!=0){?>
                                      <tr>
                                        <td colspan="6" align="right" style="font-size:12px; padding:5px 10px;">DISCOUNT</td>
                                        <td style="font-size:12px;">Rp. <?php echo rupiah(selectV('orders',"id_orders='".$id."'",'discount_order'))?></td>
                                      </tr>
                                      <?php }?>
                                      <tr>
                                        <?php 
                                          $jumlah = selectV('orders_detail',"id_orders='".$id."' and id_product = 1",'jumlah');
                                          $item_franchise = selectV('product',"id_product=1",'bfranchise_product');
                                          $biaya_franchise = $jumlah * $item_franchise;
                                        ?>
                                        <td colspan="6" align="right" style="font-size:12px; font-weight:bold; padding:5px 10px;">BIAYA FRANCHISE</td>
                                        <td style="font-size:12px; font-weight:bold;">Rp. <?php echo($biaya_franchise);?>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td colspan="6" align="right" style="font-size:12px; font-weight:bold; padding:5px 10px;">SHIPPING</td>
                                        <td style="font-size:12px; font-weight:bold;">Rp. <?php echo rupiah(5000)?></td>
                                        <?php $shipping=5000;?>
                                      </tr>
                                      <tr>
                                        <td colspan="6" align="right" style="font-size:12px; font-weight:bold; padding:5px 10px;">KODE UNIK</td>
                                        <?php
                                        $kode_unik=selectV('deposit',"id_orders='".$id."'",'kode_unik');
                                        ?>
                                        <td style="font-size:12px; font-weight:bold;">Rp. <?php echo ($kode_unik);?></td>
                                      </tr>
                                      <tr>
                                        <td colspan="6" align="right" style="font-size:12px; font-weight:bold; padding:5px 10px;">GRAND TOTAL</td>
                                        <td style="font-size:12px; font-weight:bold;">Rp. <?php echo rupiah(($grand-selectV('orders',"id_orders='".$id."'",'discount_order'))+$shipping+$kode_unik+$biaya_franchise)?></td>
                                      </tr>
                                      <tr>
                                      	<td colspan="7" style="font-weight:bold;">
                                        	NOTE :
                                            <a href="javascript:void(0)" onclick="noteorder()">
                                                <?php if(selectV('orders',"id_orders='".$id."'",'note_order')==' '){?> 
                                                	Input Note
                                                <?php }else{?> 
                                                	Edit Note
                                                <?php }?>
                                            </a><br />
                                            <div id="notesq">
                                            	<?=selectV('orders',"id_orders='".$id."'",'note_order')?>
                                            </div>
                                            <?php
											if(isset($_POST['subnote'])){
												$data = array(
													'note_order' => $_POST['note_order']
												);
												$Tmodul->updateBy('id_orders', $id, $data);
												echo"<script>alert('Input Success'); window.location = ('?page=$page&act=".$_GET['act']."&id=".$_GET['id']."')</script>";	
												exit;
											}
											?>
                                            <form action="" method="post">
                                            <div id="inputnote" style="display:none">
                                                <textarea name="note_order" style="width:500px; height:100px;"><?=selectV('orders',"id_orders='".$id."'",'note_order')?></textarea><br />
                                                <button class="btn btn-success btn-xs" type="submit" style="margin-top:5px;" name="subnote">Submit</button>
                                                <button class="btn btn-danger btn-xs" style="margin-top:5px;" onclick="cancelnote()" type="button">Cancel</button>
                                        	</div>
                                            </form>
                                        </td>
                                      </tr>  
                                      <tr>
                                      	<td colspan="7" align="center" style="padding-top:20px;">
                                        	<a href="web/fakturprint.php?id=<?=$id?>" target="_blank"> <button type="button" class="btn btn-success">Cetak Faktur</button></a>
                                        </td>
                                      </tr>     
                                      </tbody>      
                </table>
                          </div>
                      </section> 
                 </div>
<?php break; } ?>