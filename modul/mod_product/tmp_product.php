<?php if(!isset($RUN)) { exit(); } ?>
<div class="row">
<?php switch($_GET['act']){

//dasboard product	
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
                                          <th>Nama</th>
                                          <th>Code Produk</th>
                                          <th>Kategori Produk</th>
                                          <th>Kemasan Produk</th>
                                          <th>Harga Beli</th>
										  <th>Harga Jual</th>
                                          <th>Profit</th>
                                          <th class="hidden-phone">Action</th>
                                      </tr>
                                      </thead>
                                      <tbody>
                                      <?php $no=1;
				    				  foreach($products as $product){
									  ?>
                                      <tr>
                                          <td><?= $no ?></td>
                                          <td><?php echo $product->name_product;?></td>
                                          <td><?php echo $product->code_product;?></td>
                                          <td><?php echo selectV('kategoriproduct',"id_kategoriproduct='".$product->id_kategoriproduct."'",'name_kategoriproduct');?></td>
                                          <td><?php echo selectV('satuan',"id_satuan='".$product->kemasan_product."'",'name_satuan');?></td>
                                          <td>Rp. <?php echo rupiah($product->hbeli_product);?></td>
										  <td>Rp. <?php echo rupiah($product->hjual_product);?></td>
                                          <td>Rp. <?php echo rupiah($product->hjual_product-$product->hbeli_product);?></td>
                                          <td class="center">
										  <?php if($product->id_product!=1){hapus(Baggeo_Encrypt($product->id_product)); }?>
                                          <?php edit(Baggeo_Encrypt($product->id_product)); ?>
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
case "form": ?>             
				  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                             <?= $label ?>
                          </header>
                          <div class="panel-body">
                              <form class="form-horizontal tasi-form" method="post" action="<?=$act?>" enctype="multipart/form-data">
                              <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Kategori Produk</label>
                                      <div class="col-sm-5">
                                           <select class="form-control m-bot15 js-example-basic-single" name="id_kategoriproduct" id="id_kategoriproduct" required>
                                              <option value=" ">- Pilih Kategori -</option>
                                              <?php foreach($kproducts as $kproduct){?>
                                              <option value="<?= $kproduct->id_kategoriproduct ?>"<?php if($currentproduct->id_kategoriproduct == $kproduct->id_kategoriproduct){ echo "selected";} ?> ><?= $kproduct->name_kategoriproduct ?></option>
                                              <?php } ?>
                                             
                                          </select>
                                      </div>
                                  </div>
                
                                  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Nama Produk</label>
                                      <div class="col-sm-10">
                                          <input type="text" name="name_product" class="form-control" placeholder="Nama" value="<?=$currentproduct->name_product?>">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Harga Beli Produk</label>
                                      <div class="col-sm-10">
                                          <input type="text" name="hbeli_product" class="form-control" placeholder="Harga Beli" value="<?=$currentproduct->hbeli_product?>">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Harga Jual Produk</label>
                                      <div class="col-sm-10">
                                          <input type="text" name="hjual_product" class="form-control" placeholder="Harga Jual" value="<?=$currentproduct->hjual_product?>">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Satuan Kemasan</label>
                                      <div class="col-lg-1" style="width:120px;"> 
                                      	  <select style="padding:0px 5px;" class="form-control m-bot15" name="kemasan_product" id="id_satuanbesar" required> 
                                          	<option value="0"> - </option>
                                             <?php foreach($satuans as $satuan){?>
                                              <option value="<?= $satuan->id_satuan ?>" <?php if($currentproduct->kemasan_product == $satuan->id_satuan){ echo "selected";} ?>><?= $satuan->name_satuan ?></option>
                                              <?php } ?>
                                             
                                          </select> 
                                      </div> 
                                     
                                  </div>
                                  <button type="button" class="btn btn-danger" onclick=self.history.back()>Cancel</button>
                                  <button type="submit" class="btn btn-info" name="subAct">Submit</button>
                              </form>
                          </div>
                      </section>                  


<?php break; } ?></div>