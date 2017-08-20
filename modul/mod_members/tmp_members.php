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
                                          <th>Email</th>
                                          <th>Phone</th>
                                          <th>Address</th>
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
                                         <td><?php echo $admin->phone_users;?></td>
                                         <td><?php echo $admin->address_users;?></td>
                                         <td><?php echo statusaktif($admin->status_users)?></td>
                                         <td class="center hidden-phone">
										 <?php hapus(Baggeo_Encrypt($admin->id_users)); ?>
                                         <?php edit(Baggeo_Encrypt($admin->id_users)); ?> 
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
                                          <input type="text"  class="form-control" name="name_users" placeholder="Name" value="<?= $currentadmin->name_users ?>">
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
                                      <label class="col-sm-2 col-sm-2 control-label">Address</label>
                                      <div class="col-sm-10">
                                          <input type="text"  class="form-control" name="address_users" placeholder="Address" value="<?= $currentadmin->address_users?>">
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