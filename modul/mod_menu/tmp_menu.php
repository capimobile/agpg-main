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
							<th width="5%">No</th><th>Nama Menu</th><th>Link</th><th>Urutan</th><th>Main Menu</th><th width="10%">Aksi</th>
			  			</tr>
                    </thead>
					 <tbody>
                   <?php $no=1;
				    foreach($moduls as $modul){
				   ?>
        <tr>
		<td><?php echo $no;?></td>
		<td><?php echo $modul->nama_menu;?></td>
        <td><?=linkMenu($modul->link, $modul->main_menu)?></td>
        <td><?php echo $modul->urutan_menu;?></td>
		<td><?=noteMenu($modul->main_menu, $modul->status)?></td>
		<td>
        <?php edit(Baggeo_Encrypt($modul->id_menu)); hapus(Baggeo_Encrypt($modul->id_menu)); ?> 
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
                        	<label class="col-sm-2 col-sm-2 control-label">Nama Menu/ Sub Menu</label>
                            <div class="col-sm-10"><input type="text" name="nama_menu" class="form-control" value="<?= $currentModul->nama_menu ?>" required/></div>
                        </div>
                        <div class="form-group">
                        	<label class="col-sm-2 col-sm-2 control-label">Urutan</label>
                            <div class="col-sm-10"><input type="text" name="urutan_menu" class="form-control" value="<?= $currentModul->urutan_menu ?>" required/></div>
                        </div>
                        <div class="form-group">
                        	<label class="col-sm-2 col-sm-2 control-label">Link</label>
                            <div class="col-sm-10"><input type="text" name="link" class="form-control" value="<?= $currentModul->link ?>"/></div>
                        </div>
                        <div class="form-group">
                        	<label class="col-sm-2 col-sm-2 control-label">Pages</label>
							<div class="col-sm-10">
                            	<input type="checkbox" name="modul_menu" value="1" <?php if ($currentModul->modul_menu=="1"){echo" checked";}echo">";?> Modul pages <br>
                            </div>
                        </div>
						<div class="form-group">
                        	<label class="col-sm-2 col-sm-2 control-label">Pilih Main Menu</label>
                            <div class="col-sm-10">
							<select name="id_header">
							<option value="0">-Pilih Main Menu-</option>
							<?php foreach($headers as $header){
								if($currentModul->main_menu == $header->id_menu){ ?>
								<option value="<?= $header->id_menu ?>" selected><?= $header->nama_menu ?></option>
								<?php } else{ ?>
								<option value="<?= $header->id_menu ?>"><?= $header->nama_menu ?></option>";	
								<?php }
							} ?>
						</select>
						</div>
                        </div>
                        <div class="form-group">
                        	<label class="col-sm-2 col-sm-2 control-label">View Status</label>
							<div class="col-sm-10">
							<input type="checkbox" name="status" value="1" <?php if ($currentModul->status=="1"){echo" checked";}echo">";?> Tidak Tampil <br>
                            </div>
                        </div>
						 <br />
                        <button type="button" class="btn btn-danger" onclick=self.history.back()>Cancel</button>
                        <button type="submit" class="btn btn-info" name="subAct">Submit</button>
                    </form>     
        </div>
                      </section> 
                 </div>
 
 
 
<?php break; } ?>