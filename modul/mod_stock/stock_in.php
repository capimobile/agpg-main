 <?php if(!isset($RUN)) { exit(); } ?>
 <?php
 	if($_GET[id] AND querynum('stockin', 'id_stockin', $_GET['idi'])==0){
		$act="?page=$page&act=stock_in&pro=inputin&id=$_GET[id]";
		$id=Baggeo_Decrypt($_GET['id']);
		$currentmin = $Tproduct->findBy('id_product', $id);
        $currentmin = $currentmin->current();
	}
	elseif($_GET[id] AND querynum('stockin', 'id_stockin', $_GET['idi'])!=0){
		$act="?page=$page&act=stock_in&pro=editin&id=$_GET[id]&idi=$_GET[idi]";
	}
 switch($_GET['hal']){
		
//dasboard product	
 default:	 ?>
 
 <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                             <b>STOCK IN</b><br>
                             Nama Barang : <?=selectQ('product', 'id_product', $id, 'name_product')?>
                             <?php
							 if(querynum('stockin', 'id_stockin', $_GET['idi'])!=0){?>
                             <br>Edit stock in tanggal <?=selectQ('stockin', 'id_stockin', $_GET['idi'], 'date_stockin')?>
                             <?php }?>
                          </header>
                          <div class="panel-body">
                              <form class="form-horizontal tasi-form" method="post" action="<?=$act?>">
                              <a href="<?="?page=$page&act=stock_in&hal=view"?>&id=<?=$_GET['id']?>" title="Add Stock" class="btn btn-success btn-xs">History Stock In</a>
                              <div class="form-group">
                                  <label class="col-sm-2 col-sm-2 control-label">Tanggal Masuk</label>
                                  <div class="col-sm-2">

                                      <div data-date-viewmode="years" data-date-format="yyyy-mm-dd" data-date="2015-01-01"  class="input-append date dpYears">
                                          <input readonly="" type="text" value="<?=selectQ('stockin', 'id_stockin', $_GET['idi'], 'date_stockin')?>" size="16" class="form-control" name="date_stockin" id="tgl" required="required">
                                              <span class="input-group-btn add-on">
                                                <button class="btn btn-danger" type="button"><i class="icon-calendar"></i></button> 
                                              </span>
                                      </div>
                                     
                                  </div>
                                  
                              	  </div>
                                  
                                  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Qty</label>
                                      <div class="col-lg-1" style="width:75px;">
                                          <input type="text" name="satuan_besar" class="form-control"  value="<?=selectQ('stockin', 'id_stockin', $_GET['idi'], 'qty_stockin')?>" style="width:70px;">                                           
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
                             <b>STOCK IN</b><br>
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
				    				  foreach($stocks as $stock){?>
                                      <tr>
                                          <td><?= $no ?></td>
                                          <td><?php echo $stock->date_stockin;?></td>
										  <td><?php echo $stock->qty_stockin;?> </td>
                                          <td class="center">
										  	<a class='btn btn-danger btn-xs' href="?page=<?=$page?>&act=<?=$_GET['act']?>&pro=deletein&idi=<?php echo $stock->id_stockin;?>" onclick='return konfirmasi()'><i class='icon-trash'></i></a>
                                            <a class='btn btn-primary btn-xs' href="?page=<?=$page?>&act=<?=$_GET['act']?>&id=<?=$_GET['id']?>&idi=<?php echo $stock->id_stockin;?>"><i class='icon-pencil'></i></a>
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