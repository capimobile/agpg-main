<h1>Edit Profile</h1>
<?php
$Temployee=new Table('employee');
$Tleveluser = new Table('levelusers');

$employee = $Temployee->findValue("no_employee='".$_SESSION['nouser']."'");
$employee = $employee->current();

$leveluser = $Tleveluser->findValue("id_levelusers != '1' AND id_levelusers != '11' AND id_levelusers != '3' AND id_levelusers != '5' AND id_levelusers != '9'");
?>
                              <form class="form-horizontal" role="form" method="post" action="?page=<?=$_GET['page']?>&pro=update<?=Baggeo_Decrypt($_GET['ur'])?>&id=<?=Baggeo_Encrypt($employee->id_employee)?>" enctype="multipart/form-data">
                                  <div class="form-group">
                                      <label class="col-sm-4 control-label">Employee Name</label>
                                      <div class="col-sm-8">
                                          <input type="text" name="name_employee" class="form-control" placeholder="Name" value="<?=$employee->name_employee?>" required>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-4 control-label">Employee Phone Number</label>
                                      <div class="col-sm-8">
                                          <input type="text" name="phone_employee" class="form-control" placeholder="Phone Number" value="<?=$employee->phone_employee?>">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-4 control-label">Employee Cellphone Number</label>
                                      <div class="col-sm-8">
                                          <input type="text" name="cell_employee" class="form-control" placeholder="Cellphone Number" value="<?=$employee->cell_employee?>">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-4 control-label" >Employee Address</label>
                                      <div class="col-sm-8">
                                          <textarea name="address_employee" class="form-control" ><?=$employee->address_employee?></textarea>
                                      </div>
                                  </div>
                                  
                                 <div class="form-group">
                                      <label class="col-sm-4 control-label">Photo</label>
                                      <div class="col-sm-8">
                                      	  	<div class="fileupload fileupload-new" data-provides="fileupload">
                                                  <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                                      <img src="upload/<?= $employee->photo_employee ?>" alt="" />
                                                  </div>
                                                  <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                                  <div>
                                                   <span class="btn btn-white btn-file">
                                                   <span class="fileupload-new"><i class="icon-paper-clip"></i> Select image</span>
                                                   <span class="fileupload-exists"><i class="icon-undo"></i> Change</span>
                                                   <input type="file" class="default" name='fupload'/>
                                                   </span>
                                                      <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="icon-trash"></i> Remove</a>
                                                  </div>
                                              </div>
                                              
                                      </div>
                                  </div>
                                  <button type="button" class="btn btn-danger" onclick=self.history.back()>Cancel</button>
                                  <button type="submit" class="btn btn-info" name="subAct">Submit</button>
                              </form>