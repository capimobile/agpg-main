<?php if(!isset($RUN)) { exit(); } ?>
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
                                <a href="<?= "?page=$page&act=form";?>"> <button type="button" class="btn btn-success">Add Data</button></a>
                 <table  class="display table table-bordered table-striped" id="example">
                    <thead>
                        <tr> 
							<th width="5%">No</th><th>Images</th><th width="10%">Aksi</th>
			  			</tr>
                    </thead>
					 <tbody>
                   <?php $no=1;
				    foreach($moduls as $modul){
				   ?>
        <tr>
		<td><?php echo $no;?></td>
        <td><img src="../upload/<?php echo $modul->image_uploads;?>" alt="" height="100"/></td>
		<td>
        <?php edit(Baggeo_Encrypt($modul->id_uploads)); hapus(Baggeo_Encrypt($modul->id_uploads));?> 
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
                              <form class="form-horizontal tasi-form" action="<?= $act ;?>" method="post" enctype="multipart/form-data">
                                  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Photo</label>
                                      <div class="col-sm-10">
                                      	  	<div class="fileupload fileupload-new" data-provides="fileupload">
                                                  <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                                      <img src="../upload/<?= $currentModul->image_uploads ?>" alt="" />
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
                                  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Urutan</label>
                                      <div class="col-sm-10">
                                          <input type="text"  class="form-control" name="urutan_uploads" value="<?=$currentModul->urutan_uploads?>" required>
                                      </div>
                                  </div>
                       			  <button type="button" class="btn btn-danger" onclick=self.history.back()>Cancel</button>
                                  <button type="submit" class="btn btn-info" name="subAct">Submit</button>
                              </form>
                          </div>
                      </section> 
                 </div>
<?php break; } ?>