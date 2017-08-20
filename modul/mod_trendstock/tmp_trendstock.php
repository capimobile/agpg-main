<?php if(!isset($RUN)) { exit(); } ?>
<div class="row">
<?php switch($_GET['act']){

 default:  ?>
 <? $_GET['tanggal'] = date('Y-m') ?>
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
                          <h4>Laporan Stock Ayam : <?= $_GET['tanggal']?></h4>
                                    <table  class="display table table-bordered table-striped" >
                                      <thead>
                                      <tr>
                                          <th>No</th>
                                          <th>Tanggal</th>
                                          <th>UOM</th>
                                          <th>Stock Awal</th>
                      <th>Stock In</th>
                      <th>Stock Out</th>
                                          <th>Disposal</th>
                                          <th>Stock Akhir</th>
                                      </tr>
                                      </thead>
                                      <tbody>
                                      <?php $no=1;
                                        while($r=mysql_fetch_array($trendstock)){
                                      ?>
                                      <tr>
                                          <td><?= $no?></td>
                                          <td><?= $r[date_stock]?></td>
                                          <td><?=selectQ('satuan', 'id_satuan', 3, 'name_satuan')?></td>
                                          <td><?= $r[stock_awal]?> </td>
                                          <td><?= $r[stock_in]?> </td>
                                          <td><?= $r[stock_out]?></td>
                                          <td><?= $r[stock_disposal]?></td>
                                          <td><?= $r[stock_awal]+$r[stock_in]-$r[stock_out]-$r[stock_disposal]?></td>
                                      </tr>    
                                      <?php $no++; }?>
<!--                                       <?php $no=1;
                      foreach($trendstocks as $trendstock){                 
                    ?>
                                      <tr>
                                          <td><?= $no ?></td>
                                          <td><?= $product->name_product?></td>
                                          <td><?=selectQ('satuan', 'id_satuan', $product->kemasan_product, 'name_satuan')?></td>
                      <td> <?=(int)stockAwal($product->id_product)?> </td>
                      <td><?=(int)stockIn($product->id_product, $_GET['from'], $_GET['from'])?></td>
                                          <td> <?=(int)Sold($product->id_product, $_GET['from'], $_GET['from'])?> </td>
                                          <td><?=(int)stockDis($product->id_product, $_GET['from'], $_GET['from'])?></td>
                      <td><?=(int)stockAkhir($product->id_product, $_GET['from'], $_GET['from'])?></td>
                                      </tr>    
                                      <?php $no++; } ?>  -->          
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
                                      <label class="col-sm-2 col-sm-2 control-label">Bank</label>
                                      <div class="col-sm-5">
                                        <select name='bank' class="form-control m-bot15 js-example-basic-single" style="width:300px;">                   
                                          <option value="">- Pilih Kategori -</option>
                                              <option value="BCA-BISNIS">BCA</option>
                                              <option value="MDR-BISNIS">MANDIRI</option>
                                              <option value="TUNAI">Tunai</option>
                                        </select>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Tanggal Transfer</label>
                                      <div class="col-sm-10">
                                          <input type="text" name="tanggal" class="form-control" placeholder="Date" value="<?php echo date("Y-m-d H:i:s")?>">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">ID Cabang</label>
                                      <div class="col-sm-5">
                                        <select name='cabang' class="form-control m-bot15 js-example-basic-single" style="width:300px;">                   
                                          <option value="">- Pilih Cabang -</option>
                                            <?php foreach($cabangs as $cabang){?>
                                              <option value='<?=$cabang->id_cabang?>' <?php if($_GET['cabang']==$cabang->id_cabang){?>selected <?php }?>><?=$cabang->name_cabang?></option>
                                          <?php }?>
                                              <option value="Suplier">MAIN SUPPLIER</option>
                                              <option value="Administrator">ADMINISTRATOR</option>
                                        </select>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Jumlah Transfer</label>
                                      <div class="col-sm-10">
                                          <input type="number" name="jml" id="jml" class="form-control" placeholder="Rp. ">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Tipe</label>
                                      <div class="col-sm-5">
                                           <select class="form-control m-bot15 js-example-basic-single" name="tipe" id="tipe" required>
                                              <option value="">- Pilih Kategori -</option>
                                              <option value="Order Cabang">Order Cabang</option>
                                              <option value="Order Suplier">Order Suplier</option>
                                              <option value="Biaya">Biaya</option>
                                              <option value="Pendapatan Lain">Pendapatan Lain</option>
                                              <option value="Buffer Cabang">Buffer Cabang</option>
                                              <option value="Buffer Suplier">Buffer Suplier</option>
                                              <option value="Tukar Masuk">Tukar Masuk</option>
                                              <option value="Tukar Keluar">Tukar Keluar</option>
                                          </select>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Report</label>
                                      <div class="col-sm-10">
                                           <textarea class="form-control" name="report_bank"  id="report_bank" placeholder="Report mutasi bank" rows="4" ></textarea>
                                      </div>
                                  </div>                               
                                  <button type="button" class="btn btn-danger" onclick=self.history.back()>Cancel</button>
                                  <button type="submit" class="btn btn-info" name="subAct">Submit</button>
                              </form>
                          </div>
                      </section>                  



<?php break; } ?></div>