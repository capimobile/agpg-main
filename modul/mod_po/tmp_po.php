<?php if(!isset($RUN)) { exit(); } ?>
<div class="row">
<?php switch($_GET['act']){

//dasboard levelusers	
 default:	 ?>

                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                             <?=TITLE?>
                          </header>
                          <div class="panel-body">
                                <div class="adv-table">
                               <a href="<?= "?page=$page&act=form"; ?>"> <button type="button" class="btn btn-success">Add Data</button></a>
                                    <table  class="display table table-bordered table-striped" id="example">
                                      <thead>
                                      <tr>
                                          <th>No</th>
                                          <th>No PO</th>
                                          <th>Tanggal</th>
                                          <th>Nama Peminta</th>
                                          <th>Status PO</th>
                                          <th class="hidden-phone">Action</th>
                                      </tr>
                                      </thead>
                                      <tbody>
                                      <?php $no=1;
				    				  foreach($po as $pos){
									  if(selectQ('po', 'no_po', $pos->no_po, 'status_po')==1){
										  $color='style="color:#0C0"';
									  }
									  elseif(selectQ('po', 'no_po', $pos->no_po, 'status_po')==2){
										  $color='style="color:#F00"';
									  }
									  else{
										  $color='';
									  }?>
                                      <tr <?=$color?>>
                                          <td><?= $no ?></td>
                                          <td>PO<?php echo $pos->no_po?></td>
                                          <td><?php echo selectQ('po', 'no_po', $pos->no_po, 'post_date')?></td>
                                          <td><?php echo selectQ('users', 'id_users', selectQ('po', 'no_po', $pos->no_po, 'id_users'), 'name_users')?></td>
                                          <td><?php echo statusPO(selectQ('po', 'no_po', $pos->no_po, 'status_po'))?></td>
                                          <td class="center">
                                          <a class='btn btn-primary btn-xs' href="?page=<?=$_GET[page]?>&act=termin&id=<?=$pos->no_po?>">View</a>
                                          </td>
                                      </tr>    
                                      <?php $no++; } ?>           
                          </table>
                                </div>
                          </div>
                      </section>
                  </div>
     <?php break; 

//Form Page
case "form": ?>             
				  
<?php break; 
case"termin";?>
                  <div class="panel panel-primary">
                      <!--<div class="panel-heading navyblue"> INVOICE</div>-->
                      <div class="panel-body">
                      		<?php if ($_GET['id']){?>
                              <div align="center">
                                <a href="web/cpo.php?id=<?=$_GET['id']?>"> <button type="button" class="btn btn-success">Download PDF</button></a>
                              </div>
                            <?php }?>
							<div class="row invoice-list">
                              <div class="col-lg-4 col-sm-4">
                                  <h4>PO INFO</h4>
                                  <table>
                                      <tr>
                                      	<td>Nama</td><td>: <strong><?=selectQ('users', 'id_users', selectQ('po', 'no_po', $_GET['id'], 'id_users'), 'name_users')?></strong></td>
                                      </tr>
                                      <tr>
                                      	<td>Nomor PO</td><td>: <strong>PO<?=$_GET['id']?></strong></td>
                                      </tr>
                                      <tr>
                                      	<td>Tanggal PO</td><td>: <?=selectQ('po', 'no_po', $_GET['id'], 'post_date')?></td>
                                      </tr>
                                      <tr>
                                      	<td>PO Status</td><td>: <?=statusPO(selectQ('po', 'no_po', $_GET['id'], 'status_po'))?></td>
                                      </tr>
                                  </table>
                              </div>
                          </div>
                          <table class="table table-striped table-hover">
                              <thead>
                              <tr>
                                  <th>#</th>
                                  <th>Item</th>
                                  <th class="">Harga/ Pcs</th>
                                  <th class="">Qty</th>
                                  <th class="">Discount</th>
                                  <th>Total</th>
                              </tr>
                              </thead>
                              <tbody>
                              <?php
							  $no=1;
							  foreach($looppo as $loopp){
								$jual=selectQ('product', 'id_product', $loopp->id_product, 'hjual_product');
								$dsc=$loopp->dsc_po;
								$tjual=$jual-$dsc;
							    $subtotal=$subtotal+($tjual*$loopp->qty_po);
							  ?>
                              
                              <tr>
                                  <td><?=$no?></td>
                                  <td><?=selectQ('product', 'id_product', $loopp->id_product, 'name_product')?></td>
                                  <td>Rp. <?=rupiah($jual)?></td>
                                  <td class=""><?=$loopp->qty_po?></td>
                                  <td class="">Rp. <?=rupiah($dsc)?>/ Pcs</td>
                                  <td>Rp. <?=rupiah($tjual*$loopp->qty_po)?></td>
                              </tr>
                              <?php $no++;}?>
                              </tbody>
                          </table>
                          <?php
						  	$grandtotal=$subtotal-selectQ('xtradiscount', 'no_po', $_GET['id'], 'jml_xtradiscount');
						  ?>
                          <div class="row">
                              <div class="col-lg-4 invoice-block pull-right">
                                  <ul class="unstyled amounts">
                                      <li><strong>Total :</strong> Rp. <?=rupiah($subtotal)?></li>
                                      <?php if(selectQ('po', 'no_po', $_GET['id'], 'status_po')==1){?>
                                      <li><strong>Xtra Discount :</strong> Rp. <?=rupiah(selectQ('xtradiscount', 'no_po', $_GET['id'], 'jml_xtradiscount'))?></li>
                                      <li><strong>Grand Total :</strong> Rp. <?=rupiah($grandtotal)?></li>
                                      <?php }?>
                                  </ul>
                              </div>
                          </div>
                          <div class="text-center invoice-btn">
                              <?php if(selectQ('po', 'no_po', $_GET['id'], 'status_po')==0){?>
                              <a href="#page1" class="btn btn-danger btn-lg">Reject</a>
                              <a href="#page2" class="btn btn-info btn-lg">Accept</a>
                              <?php }?>
                          </div>
                          <form class="form-horizontal" id="default" method="post" action="<?=$act?>" autocomplete='off'>
                          <input type="hidden" name="itotal" value="<?=$subtotal?>" />
                          	<span id="pageContent"></span>
                            <?php if(selectQ('po', 'no_po', $_GET['id'], 'status_po')==1){?>
<div class="col-lg-6 col-sm-6" style="border:3px solid #58c9f3; padding:20px; ">

<fieldset title="Details" class="step" id="default-step-0">

                                          <div class="form-group">

                                              <label class="col-lg-3 control-label" style="margin-top:5px;"><strong>Pembayaran</strong></label>

                                              <div class="col-lg-4">

                                                  <input type="text" class="form-control price" name="termin" onkeypress="return isNumberKey(event)" placeholder="0" disabled="disabled" value="<?=selectQ('po', 'no_po', $_GET['id'], 'termin')?>">
                                              </div>
                                              <div class="col-lg-4" style="margin-top:5px; margin-left:-20px;">
                                                  Termin
                                              </div>
                                          
                                          </div>
                                          <div class="form-group">

                                              <label class="col-lg-3 control-label"><strong>Note</strong></label>

                                              <div class="col-lg-9">

                                                  <textarea name="note" class="form-control" disabled="disabled"><?=selectQ('po', 'no_po', $_GET['id'], 'note')?></textarea>
                                              </div>
                                          </div>


</fieldset>
</div>
<div class="col-lg-6 col-sm-6">

<fieldset title="Details" class="step" id="default-step-0">

                                          <?php for($a=1; $a<=selectQ('po', 'no_po', $_GET['id'], 'termin'); $a++){?>
                                          <div class="form-group">

                                              <label class="col-lg-3 control-label" style="margin-top:5px;"><strong>Termin <?=$a?></strong></label>

                                              <div class="col-lg-4">

                                                  <input type="text" class="form-control price" name="pembayaran" onkeypress="return isNumberKey(event)" placeholder="0" value="<?=selectV('termin', "no_po='".$_GET['id']."' AND jumlah_termin='".$a."'", 'bayar_termin')?>" disabled="disabled">
                                              </div>
                                          </div>
                                          <?php 
										  $tbayar=$tbayar+selectV('termin', "no_po='".$_GET['id']."' AND jumlah_termin='".$a."'", 'bayar_termin');
										  }?>
                                          <div class="form-group">
                                              <label class="col-lg-3 control-label" style="margin-top:5px;"><strong>Jumlah Bayar</strong></label>
                                              <div class="col-lg-9" style="margin-top:14px;">
													Rp. <?=rupiah($tbayar)?>
                                              </div>
                                              
                                              <label class="col-lg-3 control-label" style="margin-top:5px;"><strong>Sisa Bayar</strong></label>
                                              <div class="col-lg-9" style="margin-top:14px;">
													Rp. <?=rupiah($grandtotal-$tbayar)?>
                                              </div>
                                          </div>
</fieldset>
</div>
                             <?php }
							 elseif(selectQ('po', 'no_po', $_GET['id'], 'status_po')==2){?>
<div class="col-lg-6 col-sm-6" style="border:3px solid #ff6c60; padding:20px; ">

<fieldset title="Details" class="step" id="default-step-0">
                                          <div class="form-group">

                                              <label class="col-lg-3 control-label"><strong>Note</strong></label>

                                              <div class="col-lg-9">

                                                  <textarea name="note" class="form-control" disabled="disabled"><?=selectQ('po', 'no_po', $_GET['id'], 'note')?></textarea>
                                              </div>
                                          </div>


</fieldset>
</div>
                             <?php }?>
                          </form>
                          </div>
                  </div>
<?php break;
} ?></div>