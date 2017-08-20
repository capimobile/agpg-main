<?php if(!isset($RUN)) { exit(); } ?>
<div class="row">
<?php switch($_GET['act']){

//dasboard obat 
 default:  ?>

                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                             <?=TITLE?>
                          </header>
                          <div class="panel-body">

                                <div class="adv-table">
                             <form method="get" action="">
                            <input type="hidden" name="page" value="<?=$_GET['page']?>" />
                              <div class="form-group">
                                  <div class="form-group">
                                      <div class="col-sm-2">
                                           <select class="form-control m-bot15" id="tahun" required>
                                              <option value="0">- Tahun -</option>
                                              <?php for ($d = date('Y')-1; $d <= date('Y'); $d++){?>
                                              <option value="<?=$d?>"><?=$d?></option>
                                              <?php }?>
                                          </select>
                                      </div>
                                      <div class="col-sm-2">
                                           <select class="form-control m-bot15" id="bulan" required>
                                              <option value="0">- Bulan -</option>
                                          </select>
                                      </div>
                                      <div class="col-sm-2">
                                           <select class="form-control m-bot15" name="from" id="dari" required>
                                              <option value="0">- Dari -</option>
                                          </select>
                                      </div>
                                      <div class="col-sm-2">
                                           <select class="form-control m-bot15" name="to" id="sampai" required>
                                              <option value="0">- Sampai -</option>
                                          </select>
                                      </div>
                                  </div>
                                  
                                  
                                  <button type="submit" class="btn btn-success btn-sm" style="margin-left:25px; margin-top:3px;">Search Data</button>
                              </div>
                          </form>
                          <br />
                          <?php if ($_GET['from'] AND $_GET['to']){?>
                          <?php }?>
                          <h4>Cabang belum melakukan order dari : <?=changedate($_GET['from'])?> - <?=changedate($_GET['to'])?></h4>
                                    <table  class="display table table-bordered table-striped" id="example">
                                      <thead>
                                      <tr>
                                          <th>No</th>
                                          <th>Nama Cabang</th>
                                          <th>Pemilik</th>
                                          <th>Kecamatan</th>
                                          <th>Lokasi</th>
                                      </tr>
                                      </thead>
                                      <tbody>
                                      <?php $no=1;
                                        while($r=mysql_fetch_array($cabang)){
                                      ?>
                                      <tr>
                                          <td><?= $no?></td>
                                          <td><?= $r[name_cabang]?></td>
                                          <td><?= selectV('users',"id_users='".$r[id_users]."'","name_users");?></td>
                                          <td><?= selectV('master_kecamatan',"id_kecamatan='".$r[id_kecamatan]."'","name_kecamatan");?></td>
                                          <td><?= $r[lokasi_cabang]?> </td>
                                      </tr>  
                                      <?php $no++;} ?>  
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
                              <form class="form-horizontal tasi-form" method="post" action="<?=$act?>">
                                  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Bank</label>
                                      <div class="col-sm-5">
                                        <select name='bank' class="form-control m-bot15 js-example-basic-single" style="width:300px;">                   
                                          <option value="">- Pilih Kategori -</option>
                                              <option value="BCA-BISNIS">BCA</option>
                                              <option value="MDR-BISNIS">MANDIRI</option>
                                              <option value="TUNAI">Tunai</option>
                                        </select>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Tanggal Transfer</label>
                                      <div class="col-sm-10">
                                          <input type="text" name="tanggal" class="form-control" placeholder="Date" value="<?php echo date("Y-m-d H:i:s")?>">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">ID Cabang</label>
                                      <div class="col-sm-5">
                                        <select name='cabang' class="form-control m-bot15 js-example-basic-single" style="width:300px;">                   
                                          <option value="">- Pilih Cabang -</option>
                                            <?php foreach($cabangs as $cabang){?>
                                              <option value='<?=$cabang->id_cabang?>' <?php if($_GET['cabang']==$cabang->id_cabang){?>selected <?php }?>><?=$cabang->name_cabang?></option>
                                          <?php }?>
                                              <option value="Suplier">MAIN SUPPLIER</option>
                                              <option value="Administrator">ADMINISTRATOR</option>
                                        </select>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Jumlah Transfer</label>
                                      <div class="col-sm-10">
                                          <input type="number" name="jml" id="jml" class="form-control" placeholder="Rp. ">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Tipe</label>
                                      <div class="col-sm-5">
                                           <select class="form-control m-bot15 js-example-basic-single" name="tipe" id="tipe" required>
                                              <option value="">- Pilih Kategori -</option>
                                              <option value="Order Cabang">Order Cabang</option>
                                              <option value="Order Suplier">Order Suplier</option>
                                              <option value="Biaya">Biaya</option>
                                              <option value="Pendapatan Lain">Pendapatan Lain</option>
                                              <option value="Buffer Cabang">Buffer Cabang</option>
                                              <option value="Buffer Suplier">Buffer Suplier</option>
                                              <option value="Tukar Masuk">Tukar Masuk</option>
                                              <option value="Tukar Keluar">Tukar Keluar</option>
                                          </select>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Report</label>
                                      <div class="col-sm-10">
                                           <textarea class="form-control" name="report_bank"  id="report_bank" placeholder="Report mutasi bank" rows="4" ></textarea>
                                      </div>
                                  </div>                               
                                  <button type="button" class="btn btn-danger" onclick=self.history.back()>Cancel</button>
                                  <button type="submit" class="btn btn-info" name="subAct">Submit</button>
                              </form>
                          </div>
                      </section>                  
<!--         <table class='table table-condensed' width='98%' border='0' cellspacing='1' cellpadding=4 align="center">
        <tr><td width="20%">Tanggal Transfer</td><td colspan="3">
          <input type=text name='TglTransfer' id='TglTransfer' size='18' value='<?php echo date("Y-m-d H:i:s")?>'>
          <input type=hidden name='old' size='10' value='' /></td></tr>

        <tr>
          <td>Bank</td>
          <td width="24%"> 
          <select name="Bank">
           <option value="BCA">BCA-BISNIS</option>
           <option value="MANDIRI">MDR-BISNIS</option>
            <option value="TUNAI">TUNAI</option>
           </select>           
          </td>
          <td width="8%">Jumlah</td>
          <td><input type="text" name="jml"  id="jml" />  </td>
          </tr>
            <tr>
          <td>Kode Agen</td>
          <td><input type="text" name="KodeAgen" id="KodeAgen" /></td>
          <td>Tipe </td>
          <td><select name="Tipe">
            <option value="Dep Agen">Order Cabang</option>
            <option value="Dep Suplier">Dep. Supplier</option>
            <option value="Biaya">Biaya</option>
            <option value="Pendapatan Lain">Pendapatan Lain</option>
            <option value="Tukar Masuk">Tukar Masuk</option>   
            <option value="Tukar Keluar">Tukar Keluar</option>
            <option value="Buffer Agen">Buffer Masuk</option>
            <option value="Buffer Suplier">Buffer Keluar</option>
          </select></td>
          </tr>
              <tr>
    <td>Report </td>
    <td colspan="3">
       <textarea name="ReportBank"  id="ReportBank" cols="90" rows="2" ></textarea></td></tr>
          <tr><td></td><td colspan="3">
            <input class='btn btn-xs btn-primary' type=submit name='submit' value="New" onClick="return cekIsian();">&nbsp;
            <input class='btn btn-xs btn-primary' type=button name='edit' value="Edit" onClick="editClick();">
            </td>
          </tr>
  </table> -->


<?php break; } ?></div>