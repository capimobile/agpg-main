<?php if(!isset($RUN)) { exit(); } ?>
<?php 
		if($_GET['bulan'] AND $_GET['tahun']){
			$act="?page=$page&act=stock_awal&pro=updateawal&bulan=".$_GET['bulan']."&tahun=".$_GET['tahun'];
		}
		else{
			$act="?page=$page&act=stock_awal&pro=inputawal";
		}
		
		if($_GET['tahun']){
			$tahun=$_GET['tahun'];
		}
		else{
			$tahun=date('Y');
		}
		
switch($_GET['hal']){
		
//dasboard product	
 default:	 ?>

                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                             Stock Awal
                          </header>
                          <div class="panel-body">
                                <div class="adv-table">
                               <form action="<?=$act?>" method="post">
                               <h4>
                               <?php if($_GET['bulan'] AND $_GET['tahun']){?>
                               		Edit Stock Awal <?=getBulan($_GET['bulan'])?> <?=$_GET['tahun']?>
                               <?php }
							   else{?>
                               		<a href="<?= "?page=$page&act=".$_GET['act']."&hal=history"; ?>"> <button type="button" class="btn btn-success">History</button></a><br />
                               		Stock Awal untuk bulan
                               	   <select name='bulan'>
                                   <?php for($a=1; $a<=12; $a++){?>
										<option value='<?=$a?>' <?php if((int)date('m')==$a){?>selected <?php }?>><?=getBulan($a)?></option>
                                   <?php }?>
								   </select>
								   <select name='tahun'>
										<?php for($b=date('Y')-1; $b<=date('Y')+1; $b++){?>
										<option value='<?=$b?>' <?php if(date('Y')==$b){?>selected <?php }?>><?=$b?></option>
                                   <?php }?>
								   </select>
                               <?php }?>
                               </h4>
                                    <table  class="display table table-bordered table-striped">
                                      <thead>
                                      <tr>
                                          <th width="50">No</th>
                                          <th>Code Produk</th>
                                          <th>Nama</th>
                                          <th>Satuan</th>
                                          <th width="100">Qty</th>
                                      </tr>
                                      </thead>
                                      <tbody>
                                      <?php $no=1;
				    				  foreach($products as $product){
									  ?>
                                      <tr>
                                          <td><?= $no ?></td>
                                          <td><?php echo $product->code_product;?></td>
                                          <td><?php echo $product->name_product;?></td>
                                          <td><?=selectQ('satuan', 'id_satuan', $product->kemasan_product, name_satuan)?></td>
                                          <td class="center">
                                            <input type="hidden" value="<?=$product->id_product;?>" name="id_product[]" />
                                            <input type="hidden" value="<?=selectV('stockawal', "bulan_stockawal='".$_GET['bulan']."' AND tahun_stockawal='".$_GET['tahun']."' AND id_product='".$product->id_product."'", 'id_stockawal')?>" name="id[]" />
										  	<input type="text" name="stock[]" value="<?=selectV('stockawal', "bulan_stockawal='".$_GET['bulan']."' AND tahun_stockawal='".$_GET['tahun']."' AND id_product='".$product->id_product."'", 'qty_stockawal')?>"/>
                                          </td>
                                      </tr>    
                                      <?php $no++; } ?>
                                      <tr>
                                      	<td colspan="5" align="right"><input type="submit" value="Submit" name="subAct" /></td>
                                      </tr>     
                                      </tbody>      
                          </table>
                          </form>
                                </div>
                          </div>
                      </section>
                  </div>
     <?php break; 

//Form Page
case "history":?> 
	<div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                             Stock Awal
                          </header>
                          <div class="panel-body">
                                <div class="adv-table">
                      
                               <h4> 
                               <form action="<?=$act?>" method="get" name="col"> 
                                   <input type="hidden" name="page" value="<?=$_GET['page']?>" />
                                   <input type="hidden" name="act" value="<?=$_GET['act']?>" />
                                   <input type="hidden" name="hal" value="<?=$_GET['hal']?>" />
								   <select name='tahun' onchange='document.col.submit()'>
										<?php for($b=date('Y')-1; $b<=date('Y'); $b++){?>
										<option value='<?=$b?>' <?php if($tahun==$b){?>selected <?php }?>><?=$b?></option>
                                   <?php }?>
								   </select>
                               </form>
                               </h4>
                                    <table  class="display table table-bordered table-striped">
                                      <thead>
                                      <tr>
                                          <th width="50">No</th>
                                          <th>Code</th>
                                          <th>Nama</th>
                                          <th>Satuan</th>
                                          <?php for($a=1; $a<=12; $a++){?>
                                          <th width="50"><?=substr(getBulan($a),0,3)?></th>
                                          <?php }?>
                                      </tr>
                                      </thead>
                                      <tbody>
                                      <?php $no=1;
				    				  foreach($products as $product){
									  ?>
                                      <tr>
                                          <td><?= $no ?></td>
                                          <td><?php echo $product->code_product;?></td>
                                          <td><?php echo $product->name_product;?></td>
                                          <td><?=selectQ('satuan', 'id_satuan', $product->kemasan_product, name_satuan)?></td>
                                          <?php for($a=1; $a<=12; $a++){?>
                                          <td><?=selectV('stockawal', "bulan_stockawal='".$a."' AND tahun_stockawal='".$tahun."' AND id_product='".$product->id_product."'", 'qty_stockawal')?></ts>
                                          <?php }?>
                                      </tr>    
                                      <?php $no++; } ?> 
                                      <tr>
                                          <td colspan="4"> </td>
                                          <?php for($a=1; $a<=12; $a++){?>
                                          <td>
                                          <?php if(querynum4("stockawal WHERE bulan_stockawal='".$a."' AND tahun_stockawal='".$tahun."'")!=0){?>
                                          <a class='btn btn-primary btn-xs' href="?page=<?=$page?>&act=<?=$_GET['act']?>&bulan=<?=$a?>&tahun=<?=$tahun?>"><i class='icon-pencil'></i></a></ts>
                                          
										  <?php }
										  }?>
                                      </tr>
                                      </tbody>      
                          </table>
                                </div>
                          </div>
                      </section>
                  </div>
<?php break;
} ?>