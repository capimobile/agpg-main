<?php if(!isset($RUN)) { exit(); } ?>
<div class="row">
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
                               <a href="<?="?page=$page&act=form"; ?>"> <button type="button" class="btn btn-success">Add Data</button></a>
                                    <table  class="display table table-bordered table-striped" id="example">
                                      <thead>
                                      <tr>
                                          <th>No</th>
                                          <th>Modul Name</th>
                                          <th>Link</th>
                                          <th>Level User</th>
                                          <th>Urutan</th>
                                          <th>Status Menu</th>
                                          <th class="hidden-phone">Action</th>
                                      </tr>
                                      </thead>
                                      <tbody>
                                      <?php $no=1;
				    foreach($moduls as $modul){
						$currentModul = $Tmodul->findBy('link_modul', $modul->link_modul);
                        $currentModul = $currentModul->current();
						
						?>
                                      <tr>
                                         <td><?= $no ?></td>
                                         <td><?php echo $currentModul->name_modul;?></td>
                                         <td><?php echo $modul->link_modul;?></td>
                                         <td><?php 
										 $levels= $Tmodul->findBy('link_modul', $modul->link_modul);
										 foreach($levels as $level){
										 echo selectQ('levelusers','id_levelusers',$level->id_levelusers, 'name_levelusers') .', '; 
										 
                                         }?>
                                         </td>
                                         <td><?php echo $currentModul->urutan_modul;?></td>
                                         <td><?php echo statusaktif($currentModul->status_modul)?></td>
                                         <td class="center hidden-phone"><?php hapus(Baggeo_Encrypt($modul->link_modul)); edit(Baggeo_Encrypt($modul->link_modul)); ?> </td>
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
                              <form class="form-horizontal tasi-form" action="<?= $act ;?>" method="post">
                                  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Modul Name</label>
                                      <div class="col-sm-10">
                                          <input type="text"  class="form-control" name="name_modul" placeholder="Modul Name" value="<?= $currentModul->name_modul ?>">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Link</label>
                                      <div class="col-sm-10">
                                          <input type="text"  class="form-control" name="link_modul" placeholder="Modul Link" value="<?= $currentModul->link_modul ?>">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Urutan</label>
                                      <div class="col-sm-10">
                                          <input type="text"  class="form-control" name="urutan_modul" placeholder="Modul Urutan" value="<?= $currentModul->urutan_modul ?>">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label col-lg-2" for="inputSuccess">Level user</label>
                                      <div class="col-lg-10">
									  <?php 
									  $noo=1;
									  foreach($levels as $level){ ?>
                                          <div class="checkbox">
                                          
                                              <label>
                                                  <input type="checkbox" name="id_levelusers<?=$noo?>" value="<?php echo $level->id_levelusers;?>" <?php if(querynum3('modul', "id_levelusers='".$level->id_levelusers."' AND link_modul='".$currentModul->link_modul."'")){?>checked="checked"<?php }?>>
                                                  <?php echo $level->name_levelusers;?>
                                              </label>
                                              
                                          </div>
                                      <?php $noo++; } ?>
                                      <input type="hidden" name="jml" value="<?= $noo ;?>">
                                      </div>
                                  </div>
                                  
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label col-lg-2" for="inputSuccess">Icon</label>
                                      <div class="col-lg-10">
									  <?php 
									  $no=1;
									  foreach($icons as $icon){ ?>
                                          <div class="checkbox">
                                          
                                              <label>
                                                  <input type="radio" name="id_icon" value="<?=$icon->id_icon?>" <?php if ($currentModul->id_icon== $icon->id_icon ){echo" checked";}?>>
                                                  <i class="<?=$icon->url_icon?>"></i>
                                              </label>
                                              
                                          </div>
                                      <?php } ?>
                                      </div>
                                  </div>
                                  
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label col-lg-2" for="inputSuccess">Header</label>
                                      <div class="col-lg-10">
                                          <div class="checkbox">
                                              <label>
                                                  <input type="checkbox" name="sheader" value="1" <?php if ($currentModul->sheader=="1"){echo" checked";}echo">";?>
                                                  Yes
                                              </label>
                                          </div>
                                      </div>
                                  </div>
                                  
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label col-lg-2" for="inputSuccess">Select Header</label>
                                      <div class="col-lg-3">
                                          <select class="form-control m-bot15" name="id_header">
                                              <option value="0">- Select Header -</option>
                                              <?php foreach($headers as $header){
											  $nmmodul=selectV("modul", "link_modul='".$header->link_modul."'","name_modul");?>
                                              <option value="<?=$header->link_modul?>" <?php if($header->link_modul==$currentModul->id_header){?> selected <?php }?>><?=$nmmodul?></option>
                                              <?php }?>
                                          </select>
                                      </div>
                                  </div>
                                  
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label col-lg-2" for="inputSuccess">Publish in Menu</label>
                                      <div class="col-lg-10">
                                          <div class="checkbox">
                                              <label>
                                                  <input type="checkbox" name="status_modul" value="1" <?php if ($currentModul->status_modul=="1"){echo" checked";}echo">";?>
                                                  Yes
                                              </label>
                                          </div>
                                      </div>
                                  </div>

                                  <button type="button" class="btn btn-danger" onclick=self.history.back()>Cancel</button>
                                  <button type="submit" class="btn btn-info" name="subAct">Submit</button>
                              </form>
                          </div>
                      </section>                  


<?php break; } ?></div>