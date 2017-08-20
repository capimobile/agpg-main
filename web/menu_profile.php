						  <div class="user-heading round">
                              <a href="#">
                                  <img src="upload/thu/<?=Profile('photo')?>" alt="" width="140" height="140">
                              </a>
                              <h1><?=Profile('nama')?></h1>
                              <p><?=$_SESSION['txtLogin']?></p>
                          </div>
                          
                          <ul class="nav nav-pills nav-stacked"> 
                              <li <?php if(Baggeo_Decrypt($_GET[act])=='profile'){?>class="active" <?php }?>><a href="?page=<?=$_GET['page']?>&act=<?=Baggeo_Encrypt('profile')?>&ur=<?=$_GET['ur']?>"> <i class="icon-user"></i> Profile</a></li>
                              <li <?php if(Baggeo_Decrypt($_GET[act])=='recent'){?>class="active" <?php }?>><a href="?page=<?=$_GET['page']?>&act=<?=Baggeo_Encrypt('recent')?>&ur=<?=$_GET['ur']?>"> <i class="icon-calendar"></i>Recent Activity</a></li>
                              <li <?php if(Baggeo_Decrypt($_GET[act])=='edit'){?>class="active" <?php }?>><a href="?page=<?=$_GET['page']?>&act=<?=Baggeo_Encrypt('edit')?>&ur=<?=$_GET['ur']?>"> <i class="icon-edit"></i>Edit profile</a></li>
                          </ul>