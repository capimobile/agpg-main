<?php if(!isset($RUN)) { exit(); } ?>
<div class="row">
                  <aside class="profile-nav col-lg-3">
                      <section class="panel">
                              <?php include "web/menu_profile.php";?>
                      </section>
                  </aside>
                  <aside class="profile-info col-lg-9">
                      <section class="panel">
                          <div class="bio-graph-heading">
                              <strong>Welcome <?=Profile('nama')?></strong><br />
                              <small>Your Last login : <?=changedate($log->time_stamp)?> <?=substr($log->time_stamp,11,8)?></small> 
                          </div>
                          <div class="panel-body bio-graph-info">
                          	  <?php include"modul/mod_".Baggeo_Decrypt($_GET['page'])."/profile_mimin.php";?>
                              
                              
                          </div>
                          <div align="center" style="padding-bottom:20px; font-size:14px; font-weight:bold;">
                              	<?=changedate($tanggal_skr)?> <?=$jam_skr?>
                          </div>
                      </section>
                  </aside>
</div>