<?php if(!isset($RUN)) { exit(); } ?>
<?php switch($_GET['act']){
//dasboard modul	
 default:	 ?>
<div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                             Jam Order
                          </header>
                          <div class="panel-body">
                          <font color="#FF0000"><?=$msg?></font>
                              <form class="form-horizontal tasi-form" action="<?= $act ;?>" method="post">
                              	  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Dari Jam</label>
                                      <div class="col-md-3 col-xs-3" style="margin-right:20px;">
                                          <div data-date-viewmode="years" data-date-format="yyyy-mm-dd" data-date="<?=$_GET['tanggal']?>"  class="input-append date dpYears">
                                              <input type="text" readonly="" size="16" class="form-control" name="dari_tanggal" value="<?=substr($currentModul->dari_jam,0,10)?>">
                                                  <span class="input-group-btn add-on">
                                                    <button class="btn btn-danger" type="button"><i class="icon-calendar"></i></button>
                                                  </span>
                                          </div>
                                          <span class="help-block">Select date</span>
                                      </div>
                                      <div class="col-sm-3">
                                          <input type="text"  class="form-control" name="dari_jam" value="<?=substr($currentModul->dari_jam,11,8)?>" required>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Sampai Jam</label>
                                      <div class="col-md-3 col-xs-3" style="margin-right:20px;">
                                          <div data-date-viewmode="years" data-date-format="yyyy-mm-dd" data-date="<?=$_GET['tanggal']?>"  class="input-append date dpYears">
                                              <input type="text" readonly="" size="16" class="form-control" name="sampai_tanggal" value="<?=substr($currentModul->sampai_jam,0,10)?>">
                                                  <span class="input-group-btn add-on">
                                                    <button class="btn btn-danger" type="button"><i class="icon-calendar"></i></button>
                                                  </span>
                                          </div>
                                          <span class="help-block">Select date</span>
                                      </div>
                                      <div class="col-sm-3">
                                          <input type="text"  class="form-control" name="sampai_jam" value="<?=substr($currentModul->sampai_jam,11,8)?>" required>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Tanggal Orderan</label>
                                      <div class="col-md-3 col-xs-3" style="margin-right:20px;">
                                          <div data-date-viewmode="years" data-date-format="yyyy-mm-dd" data-date="<?=$currentModul->order_date?>"  class="input-append date dpYears">
                                              <input type="text" readonly="" size="16" class="form-control" name="order_date" value="<?=$currentModul->order_date?>">
                                                  <span class="input-group-btn add-on">
                                                    <button class="btn btn-danger" type="button"><i class="icon-calendar"></i></button>
                                                  </span>
                                          </div>
                                          <span class="help-block">Select date</span>
                                      </div>
                                  </div>
                       			  <button type="button" class="btn btn-danger" onclick=self.history.back()>Cancel</button>
                                  <button type="submit" class="btn btn-info" name="subAct">Submit</button>
                              </form>
                          </div>
                      </section> 
                 </div>                                

<?php break; 

//Form Page
case "form": ?>

<?php break; } ?>