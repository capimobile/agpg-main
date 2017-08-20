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
							<th width="5%">No</th><th>Pages</th><th width="10%">Aksi</th>
			  			</tr>
                    </thead>
					 <tbody>
                   <?php $no=1;
				    foreach($moduls as $modul){
				   ?>
        <tr>
		<td><?php echo $no;?></td>
		<td><?=selectQ('menu', 'link', $modul->id_menu, 'nama_menu')?></td>
		<td>
        <?php edit(Baggeo_Encrypt($modul->id_pages)); hapus(Baggeo_Encrypt($modul->id_pages)); ?> 
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
                    	<p>
                        	<label>Pilih Menu</label>
                            <span class="field">
							<select name="id_menu">
							<option value="0">-Pilih Main Menu-</option>
							<?php foreach($hdrs as $hdr){
								if($currentModul->id_menu == $hdr->link){ ?>
								<option value="<?= $hdr->link ?>" selected><?= $hdr->nama_menu ?></option>
								<?php } else{ ?>
								<option value="<?= $hdr->link ?>"><?= $hdr->nama_menu ?></option>";	
								<?php }
							} ?>
						</select>
						</span>
                        </p>
						<p>
                        	<label>Content</label>
                            <span class='field'><textarea class='ckeditor' cols='80' rows='5' name='content'  class='longinput'><?= $currentModul->content ?></textarea></span> 
                        </p>
						<button type="button" class="btn btn-danger" onclick=self.history.back()>Cancel</button>
                                  <button type="submit" class="btn btn-info" name="subAct">Submit</button>
                              </form>
                          </div>
                      </section> 
                 </div>
<?php break; } ?>