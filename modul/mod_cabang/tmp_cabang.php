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
              <th width="5%">No</th><th>Nama Cabang</th><th>Lokasi</th><th>Kecamatan</th><th>Pemilik</th><th width="10%">Aksi</th>
              </tr>
                    </thead>
           <tbody>
                   <?php $no=1;
            foreach($moduls as $modul){
           ?>
        <tr>
    <td><?php echo $no;?></td>
        <td><?php echo $modul->name_cabang;?></td>
        <td><?php echo $modul->lokasi_cabang;?></td>
        <td><?php echo selectV('master_kecamatan',"id_kecamatan='".$modul->id_kecamatan."'",'name_kecamatan');?></td>
        <td><?php echo selectV('users',"id_users='".$modul->id_users."'",'name_users');?></td>
    <td>
        <?php edit(Baggeo_Encrypt($modul->id_cabang)); hapus(Baggeo_Encrypt($modul->id_cabang));?> 
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
                                      <label class="col-sm-2 col-sm-2 control-label">Nama Cabang</label>
                                      <div class="col-sm-10">
                                          <input type="text"  class="form-control" name="name_cabang" value="<?=$currentModul->name_cabang?>" required>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Lokasi Cabang</label>
                                      <div class="col-sm-10">
                                          <input type="text"  class="form-control" name="lokasi_cabang" value="<?=$currentModul->lokasi_cabang?>" required>
                                      </div>
                                  </div>
                                  
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label col-lg-2" for="inputSuccess">Kecamatan</label>
                                      <div class="col-lg-3">
                                          <select class="form-control m-bot15 js-example-basic-single" name="id_kecamatan">
                                              <option value="0">- Select -</option>
                                              <?php foreach($kecamatans as $kecamatan){?>
                                              <option value="<?=$kecamatan->id_kecamatan?>" <?php if($kecamatan->id_kecamatan==$currentModul->id_kecamatan){?> selected <?php }?>><?=$kecamatan->name_kecamatan?></option>
                                              <?php }?>
                                          </select>
                                      </div>
                                  </div>
                                  
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label col-lg-2" for="inputSuccess">Pemilik</label>
                                      <div class="col-lg-3">
                                          <select class="form-control m-bot15 js-example-basic-single" name="id_users">
                                              <option value="0">- Select -</option>
                                              <?php foreach($members as $member){?>
                                              <option value="<?=$member->id_users?>" <?php if($member->id_users==$currentModul->id_users){?> selected <?php }?>><?=$member->name_users?></option>
                                              <?php }?>
                                          </select>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label col-lg-2" for="inputSuccess">Kurir</label>
                                      <div class="col-lg-3">
                                          <select class="form-control m-bot15 js-example-basic-single" name="id_kurir">
                                              <option value="0">- Pilih Kurir -</option>
                                              <?php foreach($kurirs as $kurir){?>
                                              <option value="<?=$kurir->id_kurir?>" <?php if($kurir->id_kurir==$currentModul->id_kurir){?> selected <?php }?>><?=$kurir->name_kurir?></option>
                                              <?php }?>
                                          </select>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Nama Karyawan</label>
                                      <div class="col-sm-10">
                                          <input type="text"  class="form-control" name="nama_karyawan" value="<?=$currentModul->nama_karyawan?>" required>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Alamat Karyawan</label>
                                      <div class="col-sm-10">
                                          <input type="text"  class="form-control" name="alamat_karyawan" value="<?=$currentModul->alamat_karyawan?>" required>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Phone Karyawan</label>
                                      <div class="col-sm-10">
                                          <input type="text"  class="form-control" name="phone_karyawan" value="<?=$currentModul->phone_karyawan?>" required>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Latitude</label>
                                      <div class="col-sm-10">
                                          <input type="text"  class="form-control" name="lat_cabang" value="<?=$currentModul->lat_cabang?>" required>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Longitude</label>
                                      <div class="col-sm-10">
                                          <input type="text"  class="form-control" name="lon_cabang" value="<?=$currentModul->lon_cabang?>" required>
                                      </div>
                                  </div>
                              <button type="button" class="btn btn-danger" onclick=self.history.back()>Cancel</button>
                                  <button type="submit" class="btn btn-info" name="subAct">Submit</button>
                              </form>
                          </div>
                      </section> 
                 </div>
<?php break; } ?>