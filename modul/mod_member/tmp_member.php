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
                                <a href="<?= "?page=$page&act=form"; ?>"> <button type="button" class="btn btn-success">Add Data</button></a>
                 <table  class="display table table-bordered table-striped" id="example">
                    <thead>
                        <tr> 
							<th width="5%">No</th><th>Nama</th><th>Email</th><th>Tlp</th><th width="10%">Aksi</th>
			  			</tr>
                    </thead>
					 <tbody>
                   <?php $no=1;
				    foreach($moduls as $modul){
				   ?>
        <tr>
		<td><?php echo $no;?></td>
        <td><?php echo $modul->name_members;?></td>
        <td><?php echo $modul->email_members;?></td>
        <td><?php echo $modul->tlp_members;?></td>
		<td>
        <?php edit(Baggeo_Encrypt($modul->id_members)); hapus(Baggeo_Encrypt($modul->id_members));?> 
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
                                      <label class="col-sm-2 col-sm-2 control-label">Nama Member</label>
                                      <div class="col-sm-10">
                                          <input type="text"  class="form-control" name="name_members" value="<?=$currentModul->name_members?>" required>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Email Member</label>
                                      <div class="col-sm-10">
                                          <input type="text"  class="form-control" name="email_members" value="<?=$currentModul->email_members?>" required>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Tlp Member</label>
                                      <div class="col-sm-10">
                                          <input type="text"  class="form-control" name="tlp_members" value="<?=$currentModul->tlp_members?>" required>
                                      </div>
                                  </div>
                        		  <button type="button" class="btn btn-danger" onclick=self.history.back()>Cancel</button>
                                  <button type="submit" class="btn btn-info" name="subAct">Submit</button>
                              </form>
                          </div>
                      </section> 
                 </div>
<?php break; } ?>