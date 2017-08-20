<?php

require '../App/db/Connect.php';

require '../App/lib/Table.php';

require '../App/lib/access_db.php';

require '../App/lib/manipulate.php';

if(!$_POST['page']) die("0");



$pageaj = (int)$_POST['page'];


?>

<div class="panel-body">
<?php if($_POST['page']==1){?>
<input type="hidden" name="status_po" value="2" />
<div class="col-lg-6 col-sm-6" style="border:3px solid #ff6c60; padding:20px; ">

<fieldset title="Details" class="step" id="default-step-0">

                                          <div class="form-group">

                                              <label class="col-lg-3 control-label"><strong>Note</strong></label>

                                              <div class="col-lg-9">

                                                  <textarea name="note" class="form-control ckeditor" ></textarea>
                                              </div>
                                          </div>


</fieldset>



<input type="submit" class="finish btn btn-danger" name="subAct" value="Finish"/>
</div>
<?php }
elseif($_POST['page']==2){?>
<input type="hidden" name="status_po" value="1" />
<div class="col-lg-6 col-sm-6" style="float:right; border:3px solid #58c9f3; padding:20px; ">

<fieldset title="Details" class="step" id="default-step-0">

                                          <div class="form-group">

                                              <label class="col-lg-3 control-label" style="margin-top:5px;"><strong>Xtra Discount</strong></label>
                                              <div class="col-lg-1" style="width:200px;"> 
                                                  <select style="padding:0px 5px;" class="form-control m-bot15" name="discount" required> 
                                                    <option value="0"> -Pilih Discount- </option>
                                                    <option value="1"> Rp </option>
                                                    <option value="2"> % </option>
                                                     
                                                  </select> 
                                              </div> 
                                              
                                              <div class="col-lg-4">

                                                  <input type="text" class="form-control price" name="xtra" onkeypress="return isNumberKey(event)" placeholder="0">
                                              </div>                        
                                          </div>
                                          <div class="form-group">

                                              <label class="col-lg-3 control-label" style="margin-top:5px;"><strong>Pembayaran</strong></label>

                                              <div class="col-lg-4">

                                                  <input type="text" class="form-control price" name="termin" onkeypress="return isNumberKey(event)" placeholder="0" value="1">
                                              </div>
                                              <div class="col-lg-4" style="margin-top:5px; margin-left:-20px;">
                                                  Termin
                                              </div>
                                          
                                          </div>
                                          <div class="form-group">

                                              <label class="col-lg-3 control-label"><strong>Note</strong></label>

                                              <div class="col-lg-9">

                                                  <textarea name="note" class="form-control ckeditor" ></textarea>
                                              </div>
                                          </div>


</fieldset>



<input type="submit" class="finish btn btn-danger" name="subAct" value="Finish"/>
</div>
<?php }?>
</div>