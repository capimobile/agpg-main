<?php if(!isset($RUN)) { exit(); } ?>
<div class="row">
<?php switch($_GET['act']){

//dasboard product	
 default:	 
 
 if(querynum3('stockawal',"1=1")!=0){
	 if(querynum3('stockawal',"bulan_stockawal='".(int)date('m')."' AND tahun_stockawal='".(int)date('Y')."'")==0){
		if((int)date('m')==1){
			$tahunfrom=date("Y", strtotime("-1 year", strtotime(date('Y-m-d'))));
		}
		else{
			$tahunfrom=date('Y');
		}
		$bulanfrom=date("m", strtotime("-1 month", strtotime(date('Y-m-d'))));
		$from=$tahunfrom.'-'.$bulanfrom.'-01';
		$to=$tahunfrom.'-'.$bulanfrom.'-'.date('t',mktime(0,0,0,$bulanfrom,1,$tahunfrom));
		foreach($products as $product){
			$Tstockawal->save(array(
					'id_product' => $product->id_product,
					'bulan_stockawal' => (int)date('m'),
					'tahun_stockawal' => date('Y'),
					'qty_stockawal' => StockAkhir($product->id_product, $from, $to)		
			));
		}
	 }
 }
 ?>

                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                             <?=TITLE?>
                          </header>
                          <div class="panel-body">
                                <div class="adv-table">
                               <a href="<?="?page=$page&act=stock_awal"; ?>"> <button type="button" class="btn btn-success">Stock Awal</button></a>
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
                                            <a href="<?="?page=$page&act=stock_in"?>&id=<?=Baggeo_Encrypt($product->id_product)?>" title="Add Stock" class="btn btn-success btn-xs">Stock In</a>
                                            <a href="<?="?page=$page&act=disposal"?>&id=<?=Baggeo_Encrypt($product->id_product)?>" title="Disposal" class="btn btn-danger btn-xs">Disposal</a>
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