<?php if(!isset($RUN)) { exit(); } ?>
<?php
$Tpasien=new Table('pasien');
$pasien = $Tpasien->findValue("no_pasien='".$_SESSION['nouser']."'");
$pasien = $pasien->current();
?>
<h1>Bio Graph</h1>
   								  <div class="bio-row">
                                      <p><span>Nomor Pasien</span>: <?=$pasien->no_pasien?></p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Family Name</span>: <?=$pasien->name_family?></p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Region </span>: <?=$pasien->suku_pasien?></p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Sex </span>: <?=Sex($pasien->sex_pasien)?></p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Born </span>: <?=$pasien->born_pasien?></p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Born Place </span>: <?=$pasien->bornp_pasien?></p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Relationship Status</span>: <?=Relationship($pasien->married_pasien)?></p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Religion </span>: <?=$pasien->religion_pasien?></p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Work </span>: <?=$pasien->work_pasien?></p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Education</span>: <?=$pasien->edu_pasien?></p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Blood Type</span>: <?=$pasien->blood_pasien?></p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Address</span>: <?=$pasien->address_pasien?></p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Phone</span>: <?=$pasien->phone_pasien?></p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Mobile</span>: <?=$pasien->cell_pasien?></p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Work Address</span>: <?=$pasien->workaddress_pasien?></p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Work Phone</span>: <?=$pasien->workphone_pasien?></p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Askes</span>: <?=$pasien->askes_pasien?></p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Doctor Patient</span>: <?=$pasien->doctor_pasien?></p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Phone Doctor Patient</span>: <?=$pasien->phonedoctor_pasien?></p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Dental Patient</span>: <?=$pasien->dental_pasien?></p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Phone Dental Patient</span>: <?=$pasien->phonedental_pasien?></p>
                                  </div>

