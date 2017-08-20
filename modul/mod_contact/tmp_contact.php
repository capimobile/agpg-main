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
                 <table  class="display table table-bordered table-striped" id="example">
                    <thead>
                        <tr> 
						<th>Content</th><th width="10%">Aksi</th>
			  			</tr>
                    </thead>
					 <tbody>
                   <?php $no=1;
				    foreach($moduls as $modul){
				   ?>
        <tr>
        <td><?php echo $modul->content;?></td>
		<td>
        <?php edit(Baggeo_Encrypt($modul->id_pages));?> 
		</td>
        </tr>
                   
                   <?php $no++; } ?>
</tbody>
                </table>       
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
                              <form class="form-horizontal tasi-form" action="<?= $act ;?>" method="post">
                    			<div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Edit Content</label>
                                      <div class="col-sm-10">
                                      		<textarea class='ckeditor' cols='80' rows='5' name='content'  class='longinput'><?= $currentModul->content ?></textarea>
                                      </div>
                                  </div>
                                  
                                  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Location Maps</label>
                                      <div class="col-sm-10">
                                      		<textarea class='ckeditor' cols='80' rows='5' name='content_en'  class='longinput'><?= $currentModul->content_en ?></textarea>
                                      </div>
                                  </div>
                       
						 		<button type="button" class="btn btn-danger" onclick=self.history.back()>Cancel</button>
                                  <button type="submit" class="btn btn-info" name="subAct">Submit</button>
                              </form>
                          </div>
                      </section> 
                 </div>
 
<?php break; } ?>
</div>