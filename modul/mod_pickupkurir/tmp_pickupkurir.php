<?php if(!isset($RUN)) { exit(); } ?>
<?php switch($_GET['act']){
//dasboard modul  
 default:  ?>

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
                                          <th>No</th>
                                          <th>Name</th>
                                          <th>Email</th>
                                          <th>Tipe Kendaraan</th>
                                          <th>Plat Nomor</th>
                                          <th class="hidden-phone">Action</th>
                                      </tr>
                                      </thead>
                                      <tbody>
                                      <?php $no=1;
            foreach($kurirs as $kurir){
            ?>
                                      <tr>
                                         <td><?= $no ?></td>
                                         <td><?php echo $kurir->name_kurir?></td>
                                         <td><?php echo $kurir->email_kurir;?></td>
                                         <td><?php echo $kurir->type_kend;?></td>
                                         <td><?php echo $kurir->plat_kend?></td>
                                         <td class="center hidden-phone">
                     <?php hapus(Baggeo_Encrypt($kurir->id_kurir)); ?>
                                         <?php edit(Baggeo_Encrypt($kurir->id_kurir)); ?> 
                                         </td>
                                      </tr>  
                      <?php $no++; } ?>                             
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
                                      <label class="col-sm-2 col-sm-2 control-label">Name</label>
                                      <div class="col-sm-10">
                                          <input type="text"  class="form-control" name="name_kurir" placeholder="Name" value="<?= $currentadmin->name_kurir ?>">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Email</label>
                                      <div class="col-sm-10">
                                          <input type="text"  class="form-control" name="email_kurir" placeholder="Email" value="<?= $currentadmin->email_kurir?>">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Type Kendaraan</label>
                                      <div class="col-sm-10">
                                          <input type="text"  class="form-control" name="type_kend" placeholder="Type" value="<?= $currentadmin->type_kend?>">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">No Plat Kendaraan</label>
                                      <div class="col-sm-10">
                                          <input type="text"  class="form-control" name="plat_kend" placeholder="No Plat" value="<?= $currentadmin->plat_kend?>">
                                      </div>
                                  </div>

                                  <button type="button" class="btn btn-danger" onclick=self.history.back()>Cancel</button>
                                  <button type="submit" class="btn btn-info" name="subAct">Submit</button>
                              </form>
                          </div>
                      </section>                  
                    </div>
<?php break; } ?>