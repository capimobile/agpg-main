<?php if(!isset($RUN)) { exit(); } ?>
<?php
$Tdoctor=new Table('doctor');
$doctor = $Tdoctor->findValue("no_doctor='".$_SESSION['nouser']."'");
$doctor = $doctor->current();
?>
<h1>Bio Graph</h1>
   								  <div class="bio-row">
                                      <p><span>Nomor Doctor</span>: <?=$doctor->no_doctor?></p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Phone</span>: <?=$doctor->phone_doctor?></p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Mobile </span>: <?=$doctor->cell_doctor?></p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Address </span>: <?=$doctor->address_doctor?></p>
                                  </div>

