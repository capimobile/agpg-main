
<?php if(!isset($RUN)) { exit(); } ?>
<div class="row">
<?php switch($_GET['act']){

//dasboard obat 
 default:  ?>

                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                             <?=TITLE?>
                          </header>
                          <div class="panel-body">
                                <div class="adv-table">
                             <form method="get" action="">
                            <input type="hidden" name="page" value="<?=$_GET['page']?>" />
                              <div class="form-group">
                                  <div class="form-group">
                                      <div class="col-sm-2">
                                           <select class="form-control m-bot15" id="tahun" required>
                                              <option value="0">- Tahun -</option>
                                              <?php for ($d = date('Y')-1; $d <= date('Y'); $d++){?>
                                              <option value="<?=$d?>"><?=$d?></option>
                                              <?php }?>
                                          </select>
                                      </div>
                                      <div class="col-sm-2">
                                           <select class="form-control m-bot15" id="bulan" required>
                                              <option value="0">- Bulan -</option>
                                          </select>
                                      </div>
                                      <div class="col-sm-2">
                                           <select class="form-control m-bot15" name="from" id="dari" required>
                                              <option value="0">- Dari -</option>
                                          </select>
                                      </div>
                                      <div class="col-sm-2">
                                           <select class="form-control m-bot15" name="to" id="sampai" required>
                                              <option value="0">- Sampai -</option>
                                          </select>
                                      </div>
                                  </div>
                                  
                                  
                                  <button type="submit" class="btn btn-success btn-sm" style="margin-left:25px; margin-top:3px;">Submit</button>
                              </div>
                          </form>
                          <br />
                          <?php if ($_GET['from'] AND $_GET['to']){?>
                          <!--<div align="center">
                            <a href="web/perproduk.php?from=<?=$_GET['from']?>&to=<?=$_GET['to']?>"> <button type="button" class="btn btn-success">Download PDF</button></a>
                          </div>-->
                          <?php }?>
                          <h4>Laporan Sales Per-Product : <?=changedate($_GET['from'])?> - <?=changedate($_GET['to'])?></h4>
                                    <table  class="display table table-bordered table-striped">
                                      <thead>
                                      <tr>
                                          <th rowspan="2">No</th>
                                          <th rowspan="2">Nama Barang</th>
                                          <th rowspan="2">UOM</th>
                      <th colspan="2">Pending</th>
                                          <th colspan="2">Success</th>
                                      </tr>
                                      <tr>
                                          <th>Qty</th>
                                            <th>Amount</th>
                                            <th>Qty</th>
                                            <th>Amount</th>
                                      </tr>
                                      </thead>
                                      <tbody>
                                      <?php $no=1;
                      foreach($products as $product){ 
                    $totpending=$totpending+$product['amount_pending'];
                    $totsukses=$totsukses+$product['amount_sukses'];
                    ?>
                                      <tr>
                                          <td><?=$no?></td>
                                          <td><?= $product['name_product']?></td>
                                          <td><?= $product['name_satuan']?></td>
                                          <td><?= $product['qty_pending']?> </td>
                                          <td><?=rupiah($product['amount_pending'])?></td>
                                          <td><?= $product['qty_sukses']?> </td>
                      <td><?=rupiah($product['amount_sukses'])?></td>
                                      </tr>    
                                      <?php $no++; } ?>  
                                      <tr>
                                          <td colspan="3">Sub Total</td>
                                          <td></td>
                                          <td><?=rupiah($totpending)?></td>
                                          <td></td>
                                          <td>Rp. <?=rupiah($totsukses)?></td>
                                      </tr> 
                    <?php $discorder=DiscOrder($_GET['from'], $_GET['to']);?>
                                      <tr>
                                          <td colspan="3">Discount</td>
                                          <td colspan="4" align="center">Rp. <?=rupiah($discorder)?></td>
                                      </tr> 
                                      <tr>
                                          <td colspan="3">Grand Total</td>
                                          <td colspan="4" align="center">Rp. <?=rupiah($totpending+$totsukses-$discorder)?></td>
                                      </tr> 
                                      </tbody>        
                          </table>
                                </div>
                          </div>
                      </section>
                  </div>
     <?php break; 

//Form Page
case "form": ?>             
          <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                             <?= $label ?>
                          </header>
                          <div class="panel-body">
                              <form class="form-horizontal tasi-form" method="post" action="<?=$act?>">
                              <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Kategori Obat</label>
                                      <div class="col-sm-5">
                                           <select class="form-control m-bot15 js-example-basic-single" name="id_kategoriobat" id="id_kategoriobat" required>
                                              <option value=" ">- Pilih Kategori -</option>
                                              <?php foreach($kobats as $kobat){?>
                                              <option value="<?= $kobat->id_kategoriobat ?>"<?php if($currentobat->id_kategoriobat == $kobat->id_kategoriobat){ echo "selected";} ?> ><?= $kobat->name_kategoriobat ?></option>
                                              <?php } ?>
                                             
                                          </select>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Vendor</label>
                                      <div class="col-sm-10">
                                          <input type="text" name="id_vendor" class="form-control" placeholder="Barcode" value="<?=$currentobat->id_vendor?>">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Barcode Obat</label>
                                      <div class="col-sm-10">
                                          <input type="text" name="barcode_obat" class="form-control" placeholder="Barcode" value="<?=$currentobat->barcode_obat?>">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Nama Obat</label>
                                      <div class="col-sm-10">
                                          <input type="text" name="name_obat" class="form-control" placeholder="Nama" value="<?=$currentobat->name_obat?>">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Harga Beli Obat</label>
                                      <div class="col-sm-10">
                                          <input type="text" name="hbeli_obat" class="form-control" placeholder="Harga Beli" value="<?=$currentobat->hbeli_obat?>">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label"> Mark Up Obat (%) </label> 
                                      <div class="col-sm-1" style="width:75px;">
                                          <input type="text"  style="width:70px;" name="hj_obat" class="form-control"  value="<?=$currentobat->hj_obat?>">  

                                      </div> 
                                      <div class="col-sm-1" style="width:80px;" > 
                                          <input type="text"  class="form-control" readonly="readonly" value="%"/>
                                      </div> 
                                         
                                     
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Satuan Kemasan</label>
                                      <div class="col-lg-1" style="width:75px;">
                                          <input type="text" name="kemasan_obat" class="form-control"  value="<?=$currentobat->kemasan_obat?>" style="width:70px;">                                           
                                      </div> 
                                      <div class="col-lg-1" style="width:120px;"> 
                                          <select style="padding:0px 5px;" class="form-control m-bot15" name="id_satuanbesar" id="id_satuanbesar" required> 
                                            <option value="0"> - </option>
                                             <?php foreach($satuans as $satuan){?>
                                              <option value="<?= $satuan->id_satuan ?>" <?php if($currentmin->id_satuanbesar == $satuan->id_satuan){ echo "selected";} ?>><?= $satuan->name_satuan ?></option>
                                              <?php } ?>
                                             
                                          </select> 
                                      </div> 
                                      <label class="col-sm-1 control-label" style="width:30px;">Isi : </label> 
                                      <div class="col-sm-1" style="width:75px;">
                                          <input type="text"  style="width:70px;" name="isi_obat" class="form-control"  value="<?=$currentobat->isi_obat?>">  

                                      </div> 
                                      <div class="col-sm-1" style="width:120px;"> 
                                          <select style="padding:0px 5px;" class="form-control m-bot15" name="id_satuankecil" id="id_satuankecil" required> 
                                            <option value="0"> - </option>
                                             <?php foreach($satuans as $satuan){?>
                                              <option value="<?= $satuan->id_satuan ?>" <?php if($currentmin->id_satuankecil == $satuan->id_satuan){ echo "selected";} ?>><?= $satuan->name_satuan ?></option>
                                              <?php } ?>
                                             
                                          </select> 
                                      </div> 
                                         
                                     
                                  </div>
                                  
                                  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Minimal Stock</label> 
                                      <div class="col-sm-1" style="width:75px;">
                                          <input type="text"  style="width:70px;" name="jumlah_satuankecil" class="form-control"  value="<?=$currentmin->jumlah_satuankecil?>">  

                                      </div> 
                                      <div class="col-sm-1" style="width:100px;" id="mins" > 
                                          <input type="text"  class="form-control" readonly="readonly" value="<?= selectQ('satuan','id_satuan',$currentmin->id_satuankecil,'name_satuan'); ?>" />
                                      </div> 
                                         
                                     
                                  </div>
                                  
                                
                                  <button type="button" class="btn btn-danger" onclick=self.history.back()>Cancel</button>
                                  <button type="submit" class="btn btn-info" name="subAct">Submit</button>
                              </form>
                          </div>
                      </section>                  


<?php break; } ?></div>