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
                          <?php if(isset($_GET['tanggal'])){?>
                          <h5>
                          	Tanggal : <?=changedate($_GET['tanggal'])?>
                          </h5>
                          <?php }?>
                          <div align="right" style="margin:5px 0;">
                                    	<form method="get" action="">
                                        <input type="hidden" value="<?=$_GET['page']?>" name="page"/>
                                        <input type="search" name="search" placeholder="Search" value="<?=$_GET['search']?>" style="padding:5px; width:300px;"/> 
                                            <input type="submit" value="Search" style="margin-top:-4px;" class="btn btn-success btn-sm"/>
                                        </form>
                          </div>
                 <table  class="display table table-bordered table-striped">
                                      <thead>
                                      <tr>
                                          <th width="50">No</th>
                                          <th>Tanggal</th>
                                          <th>Faktur</th>
                                          <th>Cabang</th>
                                          <th>Pemilik</th>
                                          <th></th>
                                      </tr>
                                      </thead>
                                      <tbody>
                                      <?php $no=1+(($_GET['tablepage']-1)*$batas);
				    				  while($r=mysql_fetch_array($moduls)){
									  ?>
                                      <tr>
                                          <td><?= $no ?></td>
                                          <td><?php echo $r['tgl_order']?></td>
                                          <td><?php echo $r['invoice']?></td>
                                          <td><?=selectQ('cabang', 'id_cabang', $r['id_cabang'], 'name_cabang')?></td>
                                          <td><?=selectQ('users', 'id_users', selectQ('cabang', 'id_cabang', $r['id_cabang'], 'id_users'), 'name_users')?></td>
                                          <td>
                                          	<?=view(Baggeo_Encrypt($r['id_orders']))?>
                                            <?php if($modul->status_order==0){hapus(Baggeo_Encrypt($r['id_orders']));}?>
                                            <?=pay(Baggeo_Encrypt($r['id_orders']))?>
                                            <?=disc(Baggeo_Encrypt($r['id_orders']))?>
                                            <?=assign(Baggeo_Encrypt($r['id_orders']))?>
                                          </td>
                                      </tr>    
                                      <?php $no++; } ?>     
                                      </tbody>      
                </table>   
                <?php
						  
						  $numr=mysql_num_rows($nmoduls);
						  $jmldata     = $numr;
						  $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
						  $currentpage = $p->currentpage("?page=$_GET[page]$pluscur$plusdat");
  						  $linkHalaman = $p->navHalaman($_GET['tablepage'], $jmlhalaman, $currentpage);
						  ?>
                          <div align='center' style="font-size:14px">
						  	<?=$linkHalaman?> <br /> <?=$jmldata?> entries data
                          </div>
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
                          <div style="text-align:right;">
                          	<a href="<?="?page=$page&act=bayar"?>&id=<?=Baggeo_Encrypt($id)?>" title="Pembayaran" class="btn btn-warning btn-xs">Pembayaran</a>
                            <a href="<?="?page=$page&act=discount"?>&id=<?=Baggeo_Encrypt($id)?>" title="Discount" class="btn btn-primary btn-xs">Discount</a>
                          </div>
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
<?php break;
case "bayar": ?>
<div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                             PEMBAYARAN PESANAN
                          </header>
                          <div class="panel-body">
                          <h5>
                          <table>
                          <tr><td>Tanggal </td><td>: <?=selectV('orders',"id_orders='".$id."'",'tgl_order')?></td></tr>
                          <tr><td>No Faktur </td><td>: <?=selectV('orders',"id_orders='".$id."'",'invoice')?></td></tr>
                          <tr><td>Cabang </td><td>: <?=selectV('cabang',"id_cabang='".selectV('orders',"id_orders='".$id."'",'id_cabang')."'",'name_cabang')?></td></tr>
                          <tr><td>Alamat </td><td>: <?=selectV('cabang',"id_cabang='".selectV('orders',"id_orders='".$id."'",'id_cabang')."'",'lokasi_cabang')?></td></tr>
                          </table>
                          </h5>
                          <BR />
                          <form action="?page=<?=$_GET['page']?>&act=bayar&order=<?=$id?>&pro=inputbayar" method="post">
                          		<div class="form-group">
                                      <label>Pilih Kurir</label>
                        <!--               <div >
                                          <div class="radio">
                                              <label>
                                                  <input type="radio" name="status_order" value="1">Cash
                                              </label>
                                          </div>
                                          <div class="radio">
                                              <label>
                                                  <input type="radio"  id="status_order" name="status_order"  value="2">Transfer
                                              </label>
                                              </div> -->
                                      <!-- <div class="col-sm-5"> -->
                                      <select name='bank' class="form-control m-bot15 js-example-basic-single" style="width:300px;">                   
                                          <option value="">- Pilih Kategori -</option>
                                              <option value="TUNAI">CASH</option>
                                              <option value="BCA-BISNIS">BCA</option>
                                              <option value="MDR-BISNIS">MANDIRI</option>
                                        </select>
                                      <!-- </div> -->
                                <div>
                                <button type="submit" class="btn btn-success btn-sm" style="margin-top:3px;" name="subAct">Submit</button>
                                </div>
                                </div>
                		  </form>
                          </div>
                      </section> 
                 </div>
<?php break;
case "assign": ?>
<div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                            PILIH KURIR
                          </header>
                          <div class="panel-body">
                          <h5>
                          <table>
                          <tr><td>Tanggal </td><td>: <?=selectV('orders',"id_orders='".$id."'",'tgl_order')?></td></tr>
                          <tr><td>No Faktur </td><td>: <?=selectV('orders',"id_orders='".$id."'",'invoice')?></td></tr>
                          <tr><td>Cabang </td><td>: <?=selectV('cabang',"id_cabang='".selectV('orders',"id_orders='".$id."'",'id_cabang')."'",'name_cabang')?></td></tr>
                          <tr><td>Alamat </td><td>: <?=selectV('cabang',"id_cabang='".selectV('orders',"id_orders='".$id."'",'id_cabang')."'",'lokasi_cabang')?></td></tr>
                          </table>
                          </h5>
                          <BR />
                          <form action="?page=<?=$_GET['page']?>&act=bayar&order=<?=$id?>&pro=inputassign" method="post">
                              <div class="form-group">
                                      <label>Pilih Kurir ?</label>
                        <!--               <div >
                                          <div class="radio">
                                              <label>
                                                  <input type="radio" name="status_order" value="1">Cash
                                              </label>
                                          </div>
                                          <div class="radio">
                                              <label>
                                                  <input type="radio"  id="status_order" name="status_order"  value="2">Transfer
                                              </label>
                                              </div> -->
                                      <!-- <div class="col-sm-5"> -->
                                      <select name='id_kurir' class="form-control m-bot15 js-example-basic-single" style="width:300px;">                   <option value="0">- Pilih Kurir -</option>
                                         <?php foreach($kurirs as $kurir){?>
                                            <option value='<?=$kurir->id_kurir?>' <?php if($_GET['id_kurir']==$kurir->id_kurir){?>selected <?php }?>><?=$kurir->name_kurir?></option>
                                         <?php }?>
                                      </select>
                                      <!-- </div> -->
                                <div>
                                <button type="submit" class="btn btn-success btn-sm" style="margin-top:3px;" name="subAct">Submit</button>
                                </div>
                                </div>
                      </form>
                          </div>
                      </section> 
                 </div>
<?php break;
case "discount": ?>
<div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                             DISCOUNT PESANAN
                          </header>
                          <div class="panel-body">
                          <h5>
                          <table>
                          <tr><td>Tanggal </td><td>: <?=changedate(selectV('orders',"id_orders='".$id."'",'tgl_order'))?></td></tr>
                          <tr><td>No Faktur </td><td>: <?=selectV('orders',"id_orders='".$id."'",'invoice')?></td></tr>
                          <tr><td>Cabang </td><td>: <?=selectV('cabang',"id_cabang='".selectV('orders',"id_orders='".$id."'",'id_cabang')."'",'name_cabang')?></td></tr>
                          <tr><td>Alamat </td><td>: <?=selectV('cabang',"id_cabang='".selectV('orders',"id_orders='".$id."'",'id_cabang')."'",'lokasi_cabang')?></td></tr>
                          </table>
                          </h5>
                          <BR />
                          <form action="?page=<?=$_GET['page']?>&act=discount&order=<?=$id?>&pro=inputdiscount" method="post">
                          		<div class="form-group">
                                      <label>Discount ?</label>
                                      <div>
                                          <input type="text" name="discount_order" value="<?=selectV('orders',"id_orders='".$id."'",'discount_order')?>"/>
                                      </div>
                                      <div style="margin-top:10px;">
                                          <textarea name="note_discount" style="height:100px; width:500px;"><?=selectV('orders',"id_orders='".$id."'",'note_discount')?></textarea>
                                      </div>
                                  </div>
                          		  <button type="submit" class="btn btn-success btn-sm" style="margin-top:3px;" name="subAct">Submit</button>
                		  </form>
                          </div>
                      </section> 
                 </div>
<?php break; } ?>

