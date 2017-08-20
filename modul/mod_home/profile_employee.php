<?php if(!isset($RUN)) { exit(); } ?>
<?php
$Temployee=new Table('employee');
$employee = $Temployee->findValue("no_employee='".$_SESSION['nouser']."'");
$employee = $employee->current();
?>
<h1>Bio Graph</h1>
   								  <div class="bio-row">
                                      <p><span>NIK</span>: <?=$employee->no_employee?></p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Phone</span>: <?=$employee->phone_employee?></p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Mobile </span>: <?=$employee->cell_employee?></p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Address </span>: <?=$employee->address_employee?></p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>User Group </span>: <?=selectQ('levelusers', 'id_levelusers', selectQ('users', 'no_users', $_GET['id'], 'id_levelusers'), 'name_levelusers')?></p>
                                  </div>

