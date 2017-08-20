<h1>Case History</h1>
<?php
		if(querynum('chistoryp','no_users',$_SESSION['nouser']) > 0){	
			$act="?page=$page&pro=updatecase&ur=".$_GET['ur']."&act=".$_GET['act']."&id=".$_SESSION['nouser']."";
			$currentHistory = $Thistorymed->findBy('no_pasien', $_SESSION['nouser']);
            $currentHistory = $currentHistory->current();
		}
		else{
			$act="?page=$page&pro=inputcase&ur=".$_GET['ur']."&act=".$_GET['act']."&id=".$_SESSION['nouser']."";
		}
?>
<form class="form-horizontal" action="<?=$act?>" method="post">

<div class="form-group" style="border-bottom:thin solid #f8f8f8; padding-bottom:10px;">
                                      <label  class="col-lg-4 control-label">Bagaimana anda menilai kesehatan anda ?</label>
                                      <div class="col-lg-8">
                                                  <input type="radio" name="med_historymed" id="optionsRadios1" value="Sangat Baik" <?php if( trim($currentHistory->med_historymed) == 'SangatBaik' || querynum('historymed', 'no_pasien', $_SESSION['nouser']) == 0){echo"checked";}?>> 
                                                  Sangat Baik &nbsp; &nbsp;
                                                  <input type="radio" name="med_historymed" id="optionsRadios2" value="Baik" <?php if($currentHistory->med_historymed == 'Baik'){echo"checked";}?>>
                                                  Baik &nbsp; &nbsp;
                                                  <input type="radio" name="med_historymed" id="optionsRadios3" value="Cukup" <?php if($currentHistory->med_historymed == 'Cukup'){echo"checked";}?>>
                                                  Cukup &nbsp; &nbsp;
                                                  <input type="radio" name="med_historymed" id="optionsRadios4" value="Buruk" <?php if($currentHistory->med_historymed == 'Buruk'){echo"checked";}?>>
                                                  Buruk
                                              </div>
              
                                  </div>
                                  
                                  <div class="form-group" style="border-bottom:thin solid #f8f8f8; padding-bottom:10px;">
                                      <label  class="col-lg-4 control-label">Kapan Terakhir Kali Pemeriksan Fisik</label>
                                      <div class="col-lg-8">
                                                  <input type="text" class="form-control"  name="fisik_historymed" value="<?= $currentHistory->fisik_historymed ?>">
                                              </div>
              
                                  </div>
                                  
                                  <div class="form-group">
                                      <label class="col-sm-4 control-label col-lg-4">Riwayat perawatan :</label>
                                      <div class="col-lg-8">
                                          <div class="radio">
                                              <label>
                                                  <input type="radio" name="perawatan_historymed" value="1" <?php if($currentHistory->perawatan_historymed == 1 || querynum('historymed', 'no_pasien', $_SESSION['nouser']) == 0){echo"checked";}?> onclick='TidakPernahRawat()'> Belum pernah dirawat &nbsp;&nbsp;&nbsp;
                                              </label>
                                          </div>
                                          <div class="radio" style="margin-bottom:5px;">
                                              <label>
                                                  <input type="radio" name="perawatan_historymed" value="2" onclick='PernahRawat()'  <?php if($currentHistory->perawatan_historymed != 1 AND querynum('historymed', 'no_pasien', $_SESSION['nouser']) != 0){echo"checked";}?>> Pernah di rawat (Jelaskan)&nbsp;&nbsp;&nbsp;
                                              </label>
                                          </div>
                                          <textarea name="case_historymed" class="form-control jelaskan_rawat" <?php if($currentHistory->perawatan_historymed == 1 || querynum('historymed', 'no_pasien', $_SESSION['nouser']) == 0){echo"disabled='disabled'";}?> id="openrawat"><?php if($currentHistory->perawatan_historymed != 1 AND querynum('historymed', 'no_pasien', $_SESSION['nouser']) != 0){echo $currentHistory->case_historymed;}?></textarea>
                                      </div>
                                  </div>
                                  
                                  <div class="form-group" style="border-bottom:thin solid #f8f8f8; padding-bottom:10px;">
                                      <label  class="col-lg-4 control-label">Nama Dokter Yang Merawat </label>
                                      <div class="col-lg-8">
                                                  <input type="text" class="form-control"  name="doctor_historymed" id="doctormed" <?php if($currentHistory->perawatan_historymed == 1 || querynum('historymed', 'no_pasien', $_SESSION['nouser']) == 0){echo"disabled='disabled'";}?>  <?php if($currentHistory->perawatan_historymed != 1 AND querynum('historymed', 'no_pasien', $_SESSION['nouser']) != 0){echo "value='".$currentHistory->doctor_historymed."'";}?>>
                                              </div>
              
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-4 control-label">Alamat Dokter</label>
                                      <div class="col-lg-8">
  
                                  <textarea name="address_historymed" class="form-control" id="alamatmed" <?php if($currentHistory->perawatan_historymed == 1 || querynum('historymed', 'no_pasien', $_SESSION['nouser']) == 0){echo"disabled='disabled'";}?> id="openrawat"><?php if($currentHistory->perawatan_historymed != 1 AND querynum('historymed', 'no_pasien', $_SESSION['nouser']) != 0){echo $currentHistory->address_historymed;}?></textarea>
                                  </div></div>
                                  <div class="form-group" style="border-bottom:thin solid #f8f8f8; padding-bottom:10px;">
                                      <label  class="col-lg-4 control-label">Telepon Dokter </label>
                                      <div class="col-lg-8">
                                                  <input type="text" class="form-control"  name="phone_historymed" id="tlpmed" <?php if($currentHistory->perawatan_historymed == 1 || querynum('historymed', 'no_pasien', $_SESSION['nouser']) == 0){echo"disabled='disabled'";}?>  <?php if($currentHistory->perawatan_historymed != 1 AND querynum('historymed', 'no_pasien', $_SESSION['nouser']) != 0){echo "value='".$currentHistory->phone_historymed."'";}?> >
                                              </div>
              
                                  </div>
                                  
                              <?php $no=1; 
							  foreach($chistories as $chistory){ ?>
                                  <div class="form-group" style="border-bottom:thin solid #f8f8f8; padding-bottom:10px;">
                                      <label  class="col-lg-4 control-label"><?= $chistory->name_chistory ?></label>
                                      <div class="col-lg-8">
                          <?php if(selectV('chistoryp',"no_users='".$_SESSION['nouser']."' AND id_chistory='".$chistory->id_chistory."'",'answer_chistoryp') == 1){?>
                                                  <input type="radio" name="<?= "answer_chistoryp".$no ?>" id="optionsRadios1" value="1" checked>
                                                  Yes
                                              
                                                  <input type="radio" name="<?="answer_chistoryp".$no ?>" id="optionsRadios2" value="0">
                                                 No
                                              <?php }else { ?>
                                       
                                                  <input type="radio" name="<?= "answer_chistoryp".$no ?>" id="optionsRadios1" value="1">
                                                  Yes
                                              
                                                  <input type="radio" name="<?="answer_chistoryp".$no ?>" id="optionsRadios2" value="0" checked>
                                                 No
                                              <?php } ?>
                                              
                                             <input type="text" placeholder="Detail"  class="form-control" name="<?="detail_chistoryp".$no ?>" value="<?=  selectV('chistoryp',"no_users='".$_SESSION['nouser']."' AND id_chistory='".$chistory->id_chistory."'",'detail_chistoryp') ?>" style="margin-top:5px;">
                                              </div>
                              
                               <input type="hidden" name="<?= "id_chistory".$no ?>" value="<?= $chistory->id_chistory ?>">               
                                  </div>
                                  <?php $no++; } 
								  ?>
                                   <input type="hidden" name="no_users" value="<?= $_SESSION['nouser'] ?>"> 
                                  <div class="form-group">
                                      <label  class="col-lg-4 control-label">Lain - Lain</label>
                                      <div class="col-lg-8">
                                      <input type="hidden" name="<?= "id_chistory".$no ?>" value="0">      
                                  <textarea name="<?= "detail_chistoryp".$no ?>" class="form-control"><?=selectV('chistoryp',"no_users='".$_SESSION['nouser']."' AND id_chistory='0'",'detail_chistoryp')?></textarea>
                                  </div></div>
                                  <input type="hidden" name="jml" value="<?= $no+1; ?>"> 
                                   <button type="button" class="btn btn-danger" onclick=self.history.back()>Cancel</button>
                                  <button type="submit" class="btn btn-info" name="subAct">Save</button>
                              </form>