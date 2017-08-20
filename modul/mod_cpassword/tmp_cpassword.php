<?php if(!isset($RUN)) { exit(); } ?>
<?php switch($_GET['act']){
//dasboard modul	
 default:	 ?>
<div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                             <?=TITLE?>
                          </header>
                          <div class="panel-body">
                          <font color="#FF0000"><?=$msg?></font>
                              <form class="form-horizontal tasi-form" action="<?= $act ;?>" method="post">
                              	  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Password Lama</label>
                                      <div class="col-sm-3">
                                          <input type="password"  class="form-control" name="old" value="" required>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Password Baru</label>
                                      <div class="col-sm-3">
                                          <input type="password"  class="form-control" name="new" value="" required>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Masukan Kembali Password Baru</label>
                                      <div class="col-sm-3">
                                          <input type="password"  class="form-control" name="new2" value="" required>
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