<?php if(!isset($RUN)) { exit(); } 
if(mktimeSelect(selectV('jamorder',"id_jamorder=1",'dari_jam')) <= mktimeSelect($tanggal_skr.' '.$jam_skr) AND mktimeSelect(selectV('jamorder',"id_jamorder=1",'sampai_jam')) >= mktimeSelect($tanggal_skr.' '.$jam_skr)){
?>

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
                               <h4>
                                   <form method="get">
                                   <input type="hidden" name="page" value="<?=$_GET['page']?>" />
                                   Pilih Cabang :
                                   <select name='cabang' class="form-control m-bot15 js-example-basic-single" style="width:300px;">                  <option value="0">- Pilih Cabang -</option>
                                   <?php foreach($cabangs as $cabang){?>
                    <option value='<?=$cabang->id_cabang?>' <?php if($_GET['cabang']==$cabang->id_cabang){?>selected <?php }?>><?=$cabang->name_cabang?></option>
                                   <?php }?>
                   </select>
                   <input type="submit" value="Submit" style="font-size:12px; padding:5px 10px;"/>
                                   </form>
                               </h4>
                 <?php if(querynum3('cabang',"id_cabang='".$_GET['cabang']."' AND id_users='".$_SESSION['user_id']."'")>0){?>
                 <h5>
                          <table>
                          <tr><td style="padding:2px !important;">Cabang </td><td style="padding:2px !important;">: <?=selectV('cabang',"id_cabang='".$_GET['cabang']."'",'name_cabang')?></td></tr>
                          <tr><td style="padding:2px !important;">Alamat </td><td style="padding:2px !important;">: <?=selectV('cabang',"id_cabang='".$_GET['cabang']."'",'lokasi_cabang')?></td></tr>
                          </table>
                 </h5>
                 <form action="?page=<?=$_GET['page']?>&act=orderconfirm&order=<?=$_GET['cabang']?>" method="post">
                 <table  class="display table table-bordered table-striped">
                                      <thead>
                                      <tr>
                                          <th width="50">No</th>
                                          <th width="80">Code</th>
                                          <th>Nama</th>
                                          <th>Satuan</th>
                                          <th width="80">Qty</th>
                                          <th>Harga</th>
                                          <th width="100">Biaya Franchise</th>
                                          <!-- <th width="100">Stok Akhir</th> -->
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
                        <input type="text" name="stock[]" value=""/>
                                          </td>
                                          <td>Rp. <?php echo rupiah($product->hjual_product);?>
                                          <td>Rp. <?php echo rupiah($product->bfranchise_product);?>
                                          </td>
                                      </tr>    
                                      <?php $no++; } ?>
                                      <tr>
                                        <td colspan="7" align="right"><input type="submit" value="Next" name="subAct" /></td>
                                      </tr>     
                                      </tbody>      
                </table>   
                </form>
                <?php }?>    
</div>
                          </div>
                      </section>
                  </div>                         

<?php break; 

//Form Page
case "orderconfirm": ?>
<div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                             KONFIRMASI PESANAN
                          </header>
                          <div class="panel-body">
                          <h5>
                          <table>
                          <tr><td>Cabang </td><td>: <?=selectV('cabang',"id_cabang='".$_GET['order']."'",'name_cabang')?></td></tr>
                          <tr><td>Alamat </td><td>: <?=selectV('cabang',"id_cabang='".$_GET['order']."'",'lokasi_cabang')?></td></tr>
                          </table>
                          </h5>
                          <form action="?page=<?=$_GET['page']?>&act=orderconfirm&order=<?=$_GET['order']?>&pro=input" method="post">
                          <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                      <thead>
                                      <tr style="border-bottom:thin solid #999;">
                                          <th width="50">No</th>
                                          <th width="80">Code</th>
                                          <th>Nama</th>
                                          <th>Satuan</th>
                                          <th width="80">Qty</th>
                                          <th>Harga</th>
                                          <th>Total</th>
                                      </tr>
                                      </thead>
                                      <tbody>
                                      <?php 
                      $array1=$_POST['id_product'];
                      // $array2=$_POST['stock'];
                      $array2=str_replace(",",".",$_POST['stock']);
                      $b_franchise = $array2[0]*selectQ('product', 'id_product', 1, 'bfranchise_product');
                      $no=1;


                    foreach ($array1 as $fr => $idp) {
                      $total=$array2[$fr]*selectQ('product', 'id_product', $idp, 'hjual_product');
                      $grand=$grand+$total;
                    ?>
                                      <tr>
                                          <td><?= $no ?></td>
                                          <td><?=selectQ('product', 'id_product', $idp, 'code_product')?></td>
                                          <td><?=selectQ('product', 'id_product', $idp, 'name_product')?></td>
                                          <td><?=selectQ('satuan', 'id_satuan', selectQ('product', 'id_product', $idp, 'kemasan_product'), 'name_satuan')?></td>
                                          <td class="center">
                                            <input type="hidden" value="<?=$idp?>" name="id_product[]" />
                        <input type="hidden" name="stock[]" value="<?=$array2[$fr]?>"/>
                                            <?=$array2[$fr]?>
                                          </td>
                                          <td>Rp. <?php echo rupiah(selectQ('product', 'id_product', $idp, 'hjual_product'));?></td>
                                          <td>Rp. <?php echo rupiah($total)?></td>
                                      </tr>    
                                      <?php $no++; } 

                                      
                                      ?>
                                      <tr>
                                        <td colspan="6" align="right" style="font-size:12px; font-weight:bold; padding:5px 10px;">GRAND TOTAL</td>
                                        <td style="font-size:12px; font-weight:bold;">Rp. <?php echo rupiah($grand)?></td>
                                      </tr>
                                      <tr>
                                        <td colspan="7" align="right"><input type="submit" value="Submit" name="subAct" /></td>
                                      </tr>     
                                      </tbody>      
                </table>
                </form>
                          </div>
                      </section> 
                 </div>
<?php break; } 
}
else{?>
  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                             <?= TITLE ?>
                          </header>
                          <div class="panel-body">
                            <p>
                              Anda dapat memesan barang pada :<br />
                                <?php
                $tgl1=substr(selectV('jamorder',"id_jamorder=1",'dari_jam'),0,10);
                $jam1=substr(selectV('jamorder',"id_jamorder=1",'dari_jam'),11,8);
                $tgl2=substr(selectV('jamorder',"id_jamorder=1",'sampai_jam'),0,10);
                $jam2=substr(selectV('jamorder',"id_jamorder=1",'sampai_jam'),11,8);
                ?>
                                <strong><?=changedate($tgl1)?> <?=$jam1?> Sampai <?=changedate($tgl2)?> <?=$jam2?></strong>
                            </p>
                          </div>
                      </section>
    </div>
<?php }?>