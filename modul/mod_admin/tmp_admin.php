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
                               <a href="<?= "?page=$page&act=form"; ?>"> <button type="button" class="btn btn-success">Add Data</button></a>
                                    <table  class="display table table-bordered table-striped" id="example">
                                      <thead>
                                      <tr>
                                          <th>No</th>
                                          <th>Name</th>
                                          <th>email</th>
                                          <th>Level User</th>
                                          <th>Phone</th>
                                          <th>Status</th>
                                          <th class="hidden-phone">Action</th>
                                      </tr>
                                      </thead>
                                      <tbody>
                                      <?php $no=1;
				    foreach($admins as $admin){
						?>
                                      <tr>
                                         <td><?= $no ?></td>
                                         <td><?php echo $admin->name_users?></td>
                                         <td><?php echo $admin->email_users;?></td>
                                         <td><?php echo selectQ('levelusers','id_levelusers',$admin->id_levelusers, 'name_levelusers')?></td>
                                         <td><?php echo $admin->phone_users;?></td>
                                         <td><?php echo statusaktif($admin->status_users)?></td>
                                         <td class="center hidden-phone">
										 <?php hapus(Baggeo_Encrypt($admin->id_users)); ?> 
                                         <?php viewUsers(Baggeo_Encrypt($admin->id_users), 'mimin'); ?>
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
                          <font color="#FF0000"><?=$msg?></font>
                              <form class="form-horizontal tasi-form" action="<?= $act ;?>" method="post">
                                  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Name</label>
                                      <div class="col-sm-10">
                                          <input type="text"  class="form-control" name="name_users" placeholder="Administrator Name" value="<?= $currentadmin->name_users ?>">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Phone</label>
                                      <div class="col-sm-10">
                                          <input type="text"  class="form-control" name="phone_users" placeholder="Phone" value="<?= $currentadmin->phone_users?>">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Email</label>
                                      <div class="col-sm-10">
                                          <input type="text"  class="form-control" name="email_users" placeholder="Email" value="<?= $currentadmin->email_users?>">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Password</label>
                                      <div class="col-sm-10">
                                          <input type="password"  class="form-control" name="password_users" placeholder="Password Admin" value="">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Re-password Admin</label>
                                      <div class="col-sm-10">
                                          <input type="password"  class="form-control" name="repassword_users" placeholder="Re-password Admin" value="">
                                      </div>
                                  </div>
                                 
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label col-lg-2" for="inputSuccess">Level User ?</label>
                                      <div class="col-lg-10">
                                      <?php if($_SESSION['level']==1){?>
                                          <div class="radio">
                                              <label>
                                                  <input type="radio" name="id_levelusers" value="1" <?php if ($currentadmin->id_levelusers=="1"){echo" checked";}echo">";?>Superadmin &nbsp;&nbsp;&nbsp;
                                              </label>
                                          </div>
                                      <?php }
									  foreach($levels as $level){ ?>
                                          <div class="radio">
                                              <label>
                                                  <input type="radio" name="id_levelusers" value="<?=$level->id_levelusers?>" <?php if ($currentadmin->id_levelusers==$level->id_levelusers){echo" checked";}?> ><?=$level->name_levelusers?>
                                              </label>
                                          </div>
                                      <?php }?>
                                      </div>
                                  </div>
                                  
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label col-lg-2" for="inputSuccess">Active User ?</label>
                                      <div class="col-lg-10">
                                          <div class="checkbox">
                                              <label>
                                                  <input type="checkbox" name="status_users" value="1" <?php if ($currentadmin->status_users=="1"){echo" checked";}echo">";?>
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