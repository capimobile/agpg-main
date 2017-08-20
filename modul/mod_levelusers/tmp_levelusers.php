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
                                          <th>Level Name</th>
                                          <th class="hidden-phone">Action</th>
                                      </tr>
                                      </thead>
                                      <tbody>
                                      <?php $no=1;
				    				  foreach($leveluserss as $levelusers){?>
                                      <tr>
                                          <td><?= $no ?></td>
                                          <td><?php echo $levelusers->name_levelusers;?></td>
                                          <td class="center">
										  <?php hapus(Baggeo_Encrypt($levelusers->id_levelusers)); ?>
                                          <?php edit(Baggeo_Encrypt($levelusers->id_levelusers)); ?>
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
				  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                             <?= $label ?>
                          </header>
                          <div class="panel-body">
                              <form class="form-horizontal tasi-form" method="post" action="<?=$act?>">
                                  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Level Name</label>
                                      <div class="col-sm-10">
                                          <input type="text" name="name_levelusers" class="form-control" placeholder="Level Name" value="<?=$currentlevelusers->name_levelusers?>">
                                      </div>
                                  </div>
                                
                                  <button type="button" class="btn btn-danger" onclick=self.history.back()>Cancel</button>
                                  <button type="submit" class="btn btn-info" name="subAct">Submit</button>
                              </form>
                          </div>
                      </section>                  


<?php break; } ?></div>