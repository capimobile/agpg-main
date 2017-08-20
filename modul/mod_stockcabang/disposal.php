 <?php if(!isset($RUN)) { exit(); } ?>
 <?php
 	if($_GET[id] AND querynum('disposal', 'id_disposal', $_GET['idi'])==0){
		$act="?page=$page&act=disposal&pro=inputdis&id=$_GET[id]";
		$id=Baggeo_Decrypt($_GET['id']);
		$currentmin = $Tproduct->findBy('id_product', $id);
        $currentmin = $currentmin->current();
	}
	elseif($_GET[id] AND querynum('disposal', 'id_disposal', $_GET['idi'])!=0){
		$act="?page=$page&act=disposal&pro=editdis&id=$_GET[id]&idi=$_GET[idi]";
	}
 switch($_GET['hal']){
		
//dasboard product	
 default:	 ?>
 
 <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                             <b>DISPOSAL</b><br>
                             Nama Barang : <?=selectQ('product', 'id_product', $id, 'name_product')?>
                             <?php
							 if(querynum('disposal', 'id_disposal', $_GET['idi'])!=0){?>
                             <br>Edit stock in tanggal <?=selectQ('disposal', 'id_disposal', $_GET['idi'], 'date_disposal')?>
                             <?php }?>
                          </header>
                          <div class="panel-body">
                              <form class="form-horizontal tasi-form" method="post" action="<?=$act?>">
                              <a href="<?="?page=$page&act=disposal&hal=view"?>&id=<?=$_GET['id']?>" title="Add Stock" class="btn btn-success btn-xs">History Disposal</a>
                              <div class="form-group">
                                  <label class="col-sm-2 col-sm-2 control-label">Tanggal Disposal</label>
                                  <div class="col-sm-2">

                                      <div data-date-viewmode="years" data-date-format="yyyy-mm-dd" data-date="2015-01-01"  class="input-append date dpYears">
                                          <input readonly="" type="text" value="<?=selectQ('disposal', 'id_disposal', $_GET['idi'], 'date_disposal')?>" size="16" class="form-control" name="date_disposal" id="tgl" required="required">
                                              <span class="input-group-btn add-on">
                                                <button class="btn btn-danger" type="button"><i class="icon-calendar"></i></button> 
                                              </span>
                                      </div>
                                     
                                  </div>
                                  
                              	  </div>
                                  
                                  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Qty</label>
                                      <div class="col-lg-1" style="width:75px;">
                                          <input type="text" name="satuan_besar" class="form-control"  value="<?=selectQ('disposal', 'id_disposal', $_GET['idi'], 'qty_disposal')?>" style="width:70px;">                                           
                                      </div> 
                                      <div class="col-lg-1" style="width:120px;"> 
                                      	  <input type="text" class="form-control" value="<?= selectQ('satuan','id_satuan',$currentmin->kemasan_product,'name_satuan') ?>" readonly="readonly" />
                                      </div> 
                                      
                                  </div>
                                  
            
                                  <button type="button" class="btn btn-danger" onclick=self.history.back()>Cancel</button>
                                  <button type="submit" class="btn btn-info" name="subAct">Submit</button>
                              </form>
                          </div>
                      </section>
  <?php break; 

//Form Page
case "view":?> 
			<div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                          	 <b>DISPOSAL</b><br>
                             Nama Barang : <?=selectQ('product', 'id_product', $id, 'name_product')?>
                          </header>
                          <div class="panel-body">
                                <div class="adv-table">
                               
                                    <table  class="display table table-bordered table-striped" id="example">
                                      <thead>
                                      <tr>
                                          <th>No</th>
                                          <th>Tanggal</th>
										  <th>Qty</th>
                                          <th class="hidden-phone">Action</th>
                                      </tr>
                                      </thead>
                                      <tbody>
                                      <?php $no=1;
				    				  foreach($disposals as $disposal){?>
                                      <tr>
                                          <td><?= $no ?></td>
                                          <td><?php echo $disposal->date_disposal;?></td>
										  <td><?php echo $disposal->qty_disposal;?> </td>
                                          <td class="center">
										  	<a class='btn btn-danger btn-xs' href="?page=<?=$page?>&act=<?=$_GET['act']?>&pro=deletedis&idi=<?php echo $disposal->id_disposal;?>" onclick='return konfirmasi()'><i class='icon-trash'></i></a>
                                            <a class='btn btn-primary btn-xs' href="?page=<?=$page?>&act=<?=$_GET['act']?>&id=<?=$_GET['id']?>&idi=<?php echo $disposal->id_disposal;?>"><i class='icon-pencil'></i></a>
                                          </td>
                                      </tr>    
                                      <?php $no++; } ?>           
                          </table>
                                </div>
                          </div>
                      </section>
                  </div>
<?php break; 
} ?>