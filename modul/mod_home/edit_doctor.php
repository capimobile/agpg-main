<h1>Edit Profile</h1>
<?php
$Tdoctor=new Table('doctor');
$doctor = $Tdoctor->findValue("no_doctor='".$_SESSION['nouser']."'");
$doctor = $doctor->current();

$Ttypedoctor = new Table('typedoctor'); 
$typedoctors = $Ttypedoctor->findValue('id_header = 0');
?>
                              <form class="form-horizontal" role="form" method="post" action="?page=<?=$_GET['page']?>&pro=update<?=Baggeo_Decrypt($_GET['ur'])?>&id=<?=Baggeo_Encrypt($doctor->id_doctor)?>" enctype="multipart/form-data">
                                  <div class="form-group">
                                      <label class="col-sm-4 control-label">Doctor Name</label>
                                      <div class="col-sm-8">
                                          <input type="text" name="name_doctor" class="form-control" placeholder="Name" value="<?=$doctor->name_doctor?>" required>
                                      </div>
                                  </div>  
                                  
                                  <div class="form-group">
                                      <label class="col-sm-4 control-label">Doctor Phone Number</label>
                                      <div class="col-sm-8">
                                          <input type="text" name="phone_doctor" class="form-control" placeholder="Phone Number" value="<?=$doctor->phone_doctor?>">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-4 control-label">Doctor Cellphone Number</label>
                                      <div class="col-sm-8">
                                          <input type="text" name="cell_doctor" class="form-control" placeholder="Cellphone Number" value="<?=$doctor->cell_doctor?>">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-4 control-label" >Doctor Address</label>
                                      <div class="col-sm-8">
                                          <textarea name="address_doctor" class="form-control" ><?=$doctor->address_doctor?></textarea>
                                      </div>
                                  </div>
                                  
                                 <div class="form-group">
                                      <label class="col-sm-4 control-label">Photo</label>
                                      <div class="col-sm-8">
                                      	  	<div class="fileupload fileupload-new" data-provides="fileupload">
                                                  <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                                      <img src="upload/<?= $doctor->photo_doctor ?>" alt="" />
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