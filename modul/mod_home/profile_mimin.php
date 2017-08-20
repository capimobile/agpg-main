<?php if(!isset($RUN)) { exit(); } ?>

<h1>Bio Graph</h1>
   								  <div class="bio-row">
                                      <p><span>Email</span>: <?=selectQ('users', 'id_users', $_SESSION['user_id'], 'email_users')?></p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Phone</span>: <?=selectQ('users', 'id_users', $_SESSION['user_id'], 'phone_users')?></p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>User Group </span>: <?=selectQ('levelusers', 'id_levelusers', $_SESSION['level'], 'name_levelusers')?></p>
                                  </div>

