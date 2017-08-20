<?php if(!isset($RUN)) { exit(); } ?>
<div class="row">
<?php switch($_GET['act']){

//dasboard obat	
 default:	 ?>

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
                          <h4>Laporan Stock : <?=changedate($_GET['from'])?> - <?=changedate($_GET['to'])?></h4>
                                    <table  class="display table table-bordered table-striped" id="example">
                                      <thead>
                                      <tr>
                                          <th>No</th>
                                          <th>Nama Barang</th>
                                          <th>UOM</th>
                                          <th>Stock Awal</th>
										  <th>Stock In</th>
										  <th>Stock Out</th>
                                          <th>Sold</th>
                                          <th>Disposal</th>
                                          <th>Stock Akhir</th>
                                      </tr>
                                      </thead>
                                      <tbody>
                                      <?php $no=1;
				    				  foreach($products as $product){									
									  ?>
                                      <tr>
                                          <td><?= $no ?></td>
                                          <td><?= $product->name_product?></td>
                                          <td><?=selectQ('satuan', 'id_satuan', $product->kemasan_product, 'name_satuan')?></td>
										  <td> <?=(int)stockAwal($product->id_product)?> </td>
										  <td><?=(int)stockIn($product->id_product, $_GET['from'], $_GET['to'])?></td>
                                          <td> <?=(int)StockOut($product->id_product, $_GET['from'], $_GET['to'])?> </td>
                                          <td> <?=(int)Sold($product->id_product, $_GET['from'], $_GET['to'])?> </td>
                                          <td><?=(int)stockDis($product->id_product, $_GET['from'], $_GET['to'])?></td>
										  <td><?=(int)stockAkhir($product->id_product, $_GET['from'], $_GET['to'])?></td>
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