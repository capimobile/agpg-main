<h1>Edit Profile</h1>
<?php
$Tpasien=new Table('pasien');
$pasien = $Tpasien->findValue("no_pasien='".$_SESSION['nouser']."'");
$pasien = $pasien->current();
?>
                              <form class="form-horizontal" role="form" method="post" action="?page=<?=$_GET['page']?>&pro=update<?=Baggeo_Decrypt($_GET['ur'])?>&id=<?=Baggeo_Encrypt($pasien->id_pasien)?>" enctype="multipart/form-data">
                                  <div class="form-group">
                                      <label class="col-sm-4 control-label">Patient Name</label>
                                      <div class="col-sm-8">
                                          <input type="text" name="name_pasien" class="form-control" placeholder="Name" value="<?=$pasien->name_pasien?>" required>
                                      </div>
                                  </div> 
                                   <div class="form-group">
                                      <label class="col-sm-4 control-label">Family Name</label>
                                      <div class="col-sm-8">
                                          <input type="text" name="name_family" class="form-control" placeholder="Family Name" value="<?=$pasien->name_family?>" required>
                                      </div>
                                  </div> 
                                  <div class="form-group">
                                      <label class="col-sm-4 control-label" required>Patient Phone Number</label>
                                      <div class="col-sm-8">
                                          <input type="text" name="phone_pasien" class="form-control" placeholder="Number" value="<?=$pasien->phone_pasien?>" required>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-4 control-label" required>Patient Cell Number</label>
                                      <div class="col-sm-8">
                                          <input type="text" name="cell_pasien" class="form-control" placeholder="Number" value="<?=$pasien->cell_pasien?>" required>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-4 control-label" required>Patient Region</label>
                                      <div class="col-sm-8">
                                          <input type="text" name="suku_pasien" class="form-control" placeholder="Patient Region" value="<?=$pasien->suku_pasien?>" required>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-4 control-label" required>Patient Gender</label>
                                      <div class="col-sm-8">
                                          	  <label>
                                                  <input type="radio" name="sex_pasien" id="optionsRadios1" value="1" 
                                                  <?php if($pasien->sex_pasien=='1'){?>checked <?php }?>>
                                                  Male
                                              </label>&nbsp;&nbsp;
                                              <label>
                                                  <input type="radio" name="sex_pasien" id="optionsRadios1" value="2" 
                                                  <?php if($pasien->sex_pasien=='2'){?>checked <?php }?>>
                                                  Female
                                              </label>&nbsp;&nbsp;
                                      </div>
                                  </div>
                                 
                                  <div class="form-group">
                                      <label class="col-sm-4 control-label" required>Born Place</label>
                                      <div class="col-sm-4">
                                          <input type="text" name="bornp_pasien" class="form-control" placeholder="Born Place" value="<?=$pasien->bornp_pasien?>" required>
                                      </div>
                                  </div>
                                  
                                  <div class="form-group">
                                  <label class="col-sm-4 control-label" required>Born Date</label>
                                  <div class="col-sm-4">

                                      <div data-date-viewmode="years" data-date-format="yyyy-mm-dd" data-date="2015-01-01"  class="input-append date dpYears">
                                          <input type="text" readonly="" value="<?=$pasien->born_pasien?>" size="16" class="form-control" name="born_pasien">
                                              <span class="input-group-btn add-on">
                                                <button class="btn btn-danger" type="button"><i class="icon-calendar"></i></button>
                                              </span>
                                      </div>
                                      
                                  </div>
                              	  </div>
                              
                                  
                                  <div class="form-group">
                                      <label class="col-sm-4 control-label">Marrital Status</label>
                                      <div class="col-sm-8">
                                          	  <label>
                                                  <input type="radio" name="married_pasien" id="optionsRadios1" value="1" 
                                                  <?php if($pasien->married_pasien=='1'){?>checked <?php }?>>
                                                  Merried
                                              </label>&nbsp;&nbsp;
                                              <label>
                                                  <input type="radio" name="married_pasien" id="optionsRadios1" value="2" 
                                                  <?php if($pasien->married_pasien=='2'){?>checked <?php }?>>
                                                  Single
                                              </label>&nbsp;&nbsp;
                                      </div>
                                  </div>
                                  
                                  <div class="form-group">
                                      <label class="col-sm-4 control-label">Religion</label>
                                      <div class="col-sm-8">
                                          <input type="text" name="religion_pasien" class="form-control" placeholder="Patient Religion" value="<?=$pasien->religion_pasien?>">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-4 control-label" >Patient Address</label>
                                      <div class="col-sm-8">
                                          <textarea name="address_pasien" class="form-control" ><?=$pasien->address_pasien?></textarea>
                                      </div>
                                  </div>
                                  
                                  
                                  <div class="form-group">
                                      <label class="col-sm-4 control-label" >Patient Education</label>
                                      <div class="col-sm-8">
                                       <input type="text" name="edu_pasien" class="form-control" placeholder="Education" value="<?=$pasien->edu_pasien?>">
                                      </div>
                                  </div>
                                 <div class="form-group">
                                      <label class="col-sm-4 control-label" for="inputSuccess">Blood Type</label>
                                      <div class="col-lg-8">
                          
                                              <label>
                                                  <input type="radio" name="blood_pasien" id="optionsRadios1" value="A+" 
                                                  <?php if($pasien->blood_pasien=='A+'){?>checked <?php }?>>
                                                  A+
                                              </label>&nbsp;&nbsp;
                                              <label>
                                                  <input type="radio" name="blood_pasien" id="optionsRadios1" value="A-" 
                                                  <?php if($pasien->blood_pasien=='A-'){?>checked <?php }?>>
                                                  A-
                                              </label>&nbsp;&nbsp;
                                              <label>
                                                  <input type="radio" name="blood_pasien" id="optionsRadios2" value="B+" 
                                                  <?php if($pasien->blood_pasien=='B+'){?>checked <?php }?>>
                                                 B+
                                              </label>&nbsp;&nbsp;
                                              <label>
                                                  <input type="radio" name="blood_pasien" id="optionsRadios2" value="B-" 
                                                  <?php if($pasien->blood_pasien=='B-'){?>checked <?php }?>>
                                                 B-
                                              </label>&nbsp;&nbsp;
                                              <label>
                                                  <input type="radio" name="blood_pasien" id="optionsRadios3" value="AB+" 
                                                  <?php if($pasien->blood_pasien=='AB+'){?>checked <?php }?>>
                                                 AB+
                                              </label>&nbsp;&nbsp;
                                              <label>
                                                  <input type="radio" name="blood_pasien" id="optionsRadios3" value="AB-" 
                                                  <?php if($pasien->blood_pasien=='AB-'){?>checked <?php }?>>
                                                 AB-
                                              </label>&nbsp;&nbsp;
                                              <label>
                                                  <input type="radio" name="blood_pasien" id="optionsRadios3" value="O+" 
                                                  <?php if($pasien->blood_pasien=='O+'){?>checked <?php }?>>
                                                 O+
                                              </label>&nbsp;&nbsp;
                                              <label>
                                                  <input type="radio" name="blood_pasien" id="optionsRadios3" value="O-" 
                                                  <?php if($pasien->blood_pasien=='O-'){?>checked <?php }?>>
                                                 O-
                                              </label></div></div>
                                      <div class="form-group">
                                      <label class="col-sm-4 control-label">Patient Work</label>
                                      <div class="col-sm-8">
                                          <input type="text" name="work_pasien" class="form-control" placeholder="Work" value="<?=$pasien->work_pasien?>">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-4 control-label" >Patient Work Address</label>
                                      <div class="col-sm-8">
                                          <textarea name="workaddress_pasien" class="form-control" ><?=$pasien->workaddress_pasien?></textarea>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-4 control-label">Patient Work Phone</label>
                                      <div class="col-sm-8">
                                          <input type="text" name="workphone_pasien" class="form-control" placeholder="Work Phone Number" value="<?=$pasien->workphone_pasien?>">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-4 control-label">Askes</label>
                                      <div class="col-sm-8">
                                          <input type="text" name="askes_pasien" class="form-control" placeholder="Askes" value="<?=$pasien->askes_pasien?>">
                                      </div>
                                  </div>   
                                  <div class="form-group">
                                      <label class="col-sm-4 control-label">Doctor</label>
                                      <div class="col-sm-8">
                                          <input type="text" name="doctor_pasien" class="form-control" placeholder="Doctor Name" value="<?=$pasien->doctor_pasien?>">
                                      </div>
                                  </div>
                                  
                                   <div class="form-group">
                                      <label class="col-sm-4 control-label">Doctor Phone Number</label>
                                      <div class="col-sm-8">
                                          <input type="text" name="phonedoctor_pasien" class="form-control" placeholder="Doctor Phone Number" value="<?=$pasien->phonedoctor_pasien?>">
                                      </div>
                                  </div>
                                  
                                   <div class="form-group">
                                      <label class="col-sm-4 control-label">Dental</label>
                                      <div class="col-sm-8">
                                          <input type="text" name="dental_pasien" class="form-control" placeholder="Dental Name" value="<?=$pasien->doctor_pasien?>">
                                      </div>
                                  </div>
                                  
                                   <div class="form-group">
                                      <label class="col-sm-4 control-label">Dental Phone Number</label>
                                      <div class="col-sm-8">
                                          <input type="text" name="phonedental_pasien" class="form-control" placeholder="Dental Phone Number" value="<?=$pasien->phonedental_pasien?>">
                                      </div>
                                  </div>
                                  
                                  <?php if($pasien->baby==1){ ?>
                                  <div class="form-group">
                                      <label class="col-sm-4 control-label">Dad's Name</label>
                                      <div class="col-sm-8">
                                          <input type="text" name="dad_pasien" class="form-control" placeholder="Dad" value="<?=$pasien->dad_pasien?>">
                                      </div>
                                  </div>
                                  
                                  <div class="form-group">
                                      <label class="col-sm-4 control-label">Mom's Name</label>
                                      <div class="col-sm-8">
                                          <input type="text" name="mom_pasien" class="form-control" placeholder="Mom" value="<?=$pasien->mom_pasien?>">
                                      </div>
                                  </div>
                                          <?php } ?>    


                                 
                                  
                                 <div class="form-group">
                                      <label class="col-sm-4 control-label">Photo</label>
                                      <div class="col-sm-8">
                                      	  	<div class="fileupload fileupload-new" data-provides="fileupload">
                                                  <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                                      <img src="upload/<?= $pasien->photo_pasien ?>" alt="" />
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
                                      <input type="hidden" name="no_pasien" value="<?=$_SESSION['nouser']?>">
                                  </div>
                                  <button type="button" class="btn btn-danger" onclick=self.history.back()>Cancel</button>
                                  <button type="submit" class="btn btn-info" name="subAct">Submit</button>
                              </form>