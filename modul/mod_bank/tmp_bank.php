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
							<th width="5%">No</th><th>Nama Bank</th><th>Rekening Bank</th><th>Atas Nama</th><th width="10%">Aksi</th>
			  			</tr>
                    </thead>
					 <tbody>
                   <?php $no=1;
				    foreach($moduls as $modul){
				   ?>
        <tr>
		<td><?php echo $no;?></td>
        <td><?php echo $modul->name_bank;?></td>
        <td><?php echo $modul->rek_bank;?></td>
        <td><?php echo $modul->account_bank;?></td>
		<td>
        <?php edit(Baggeo_Encrypt($modul->id_bank)); hapus(Baggeo_Encrypt($modul->id_bank));?> 
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
                                      <label class="col-sm-2 col-sm-2 control-label">Nama Bank</label>
                                      <div class="col-sm-10">
                                          <input type="text"  class="form-control" name="name_bank" value="<?=$currentModul->name_bank?>" required>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Rekening Bank</label>
                                      <div class="col-sm-10">
                                          <input type="text"  class="form-control" name="rek_bank" value="<?=$currentModul->rek_bank?>" required>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Atas Nama</label>
                                      <div class="col-sm-10">
                                          <input type="text"  class="form-control" name="account_bank" value="<?=$currentModul->account_bank?>" required>
                                      </div>
                                  </div>
                       			  <button type="button" class="btn btn-danger" onclick=self.history.back()>Cancel</button>
                                  <button type="submit" class="btn btn-info" name="subAct">Submit</button>
                              </form>
                          </div>
                      </section> 
                 </div>
<?php break; } ?>