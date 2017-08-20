<?php if(!isset($RUN)) { exit(); } ?>
<div class="row">
<?php switch($_GET['act']){

//dasboard product	
 default:	 ?>

                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                             <?=TITLE?>
                          </header>
                          <div class="panel-body">
                                <div class="adv-table">
                                    <table  class="display table table-bordered table-striped" id="example">
                                      <thead>
                                      <tr>
                                          <th>No</th>
                                          <th>Nama</th>
                                          <th>Code Produk</th>
                                          <th class="hidden-phone">Action</th>
                                      </tr>
                                      </thead>
                                      <tbody>
                                      <?php $no=1;
				    				  foreach($products as $product){
									  ?>
                                      <tr>
                                          <td><?= $no ?></td>
                                          <td><?php echo $product->name_product;?></td>
                                          <td><?php echo $product->code_product;?></td>
                                          <td class="center">
                                            <a href="<?="?page=$page&act=disposal"?>&id=<?=Baggeo_Encrypt($product->id_product)?>" title="Disposal" class="btn btn-danger btn-xs">Return</a>
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
case "stock_awal": 
	include"modul/mod_stock/stock_awal.php";
break;
case "stock_in": 
	include"modul/mod_stock/stock_in.php";
break;
case "disposal": 
	include"modul/mod_stock/disposal.php";
break; 
} ?></div>