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
                                	<div style="position:absolute;">
                                    <style>
										.homeimg{
											width:780px; margin-left:10px; margin-top:10px;
										}
										.homeimg td a{
											display:block;
											height:100%;
    										width:100%;
										}
										.homeimg td:hover{
											background:#06F;
											opacity:0.3;
											cursor:pointer;
										}
									</style>
                                        <table class="homeimg">
                                            <tr>
                                                <td width="230" height="175"><a href="?page=<?=$page?>&act=form&id=1"></a></td>
                                                <td width="225" height="175"><a href="?page=<?=$page?>&act=form&id=2"></a></td>
                                                <td width="325" height="175"><a href="?page=<?=$page?>&act=form&id=5"></a></td>
                                            </tr>
                                            <tr>
                                                <td width="230" height="175"><a href="?page=<?=$page?>&act=form&id=3"></a></td>
                                                <td width="225" height="175"><a href="?page=<?=$page?>&act=form&id=4"></a></td>
                                                <td width="325" height="175"><a href="?page=<?=$page?>&act=form&id=6"></a></td>
                                            </tr>
                                            <tr>
                                                <td height="205" colspan="3"><a href="?page=<?=$page?>&act=form&id=7"></a></td>
                                            </tr>
                                            <tr>
                                                <td height="225" colspan="3"><a href="?page=<?=$page?>&act=form&id=8"></a></td>
                                            </tr>
                                        </table>
                                    </div>
                  					<img src="agpg-home.png" width="800"/>
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
                              <form class="form-horizontal tasi-form" action="<?= $act ;?>" method="post" enctype="multipart/form-data">
                              <?php if($_GET['id'] == 6){?>
                                <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Photo</label>
                                      <div class="col-sm-10">
                                      	  	<div class="fileupload fileupload-new" data-provides="fileupload">
                                                  <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                                      <img src="../upload/<?= $currentModul->content_homepage ?>" alt="" />
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
							  <?php }else{?>
                    			<div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Content</label>
                                      <div class="col-sm-10">
                                      		<textarea class='ckeditor' cols='80' rows='5' name='content_homepage'  class='longinput'><?= $currentModul->content_homepage ?></textarea>
                                      </div>
                                  </div>
                              <?php }?>
                       
						 		<button type="button" class="btn btn-danger" onclick=self.history.back()>Cancel</button>
                                  <button type="submit" class="btn btn-info" name="subAct">Submit</button>
                              </form>
                          </div>
                      </section> 
                 </div>
 
<?php break; } ?>
</div>