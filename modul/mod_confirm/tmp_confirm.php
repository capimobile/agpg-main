<?php if(!isset($RUN)) { exit(); } ?>
<?php switch($_GET['act']){
//dasboard confirm	
 default:	 ?>
<div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                             <?= TITLE ?>
                          </header>
                          <div class="panel-body">
                                <div class="adv-table">
                 <table  class="display table table-bordered table-striped" id="example">
                    <thead>
                        <tr> 
							 <th width="5%">No</th><th width="6%">No Invoice</th><th>Dari Rek.</th><th>Nama Rek. Peng</th><th width="6%">Date</th><th>Status</th><th width="10%">action</th>
			  			</tr>
                    </thead>
					 <tbody>
                   <?php $no=1;
				    foreach($confirms as $confirm){?>
                   
                   <tr>
		<td><?php echo $no;?></td>
		<td><a href="showorder.php?id=<?=Baggeo_Encrypt($confirm->id_orders)?>" target="_blank"><?php echo $confirm->invoice;?></a></td>
		<td><?php echo $confirm->rekfrom;?></td>
		<td><?php echo $confirm->namerekfrom;?></td>
        <td><?php echo $confirm->transdate;?></td>
        <td><?=statusCon($confirm->id_orders)?></td>
		<td>
        <?php view(Baggeo_Encrypt($confirm->id_confirmation)); hapus(Baggeo_Encrypt($confirm->id_confirmation)); ?> 
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

//View Page
case "view": ?>
<div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                             <?= $label ?>
                          </header>
                          <div class="panel-body">
                          <font color="#FF0000"><?=$msg?></font>
   <table cellpadding="0" cellspacing="0" border="0" style="font-size:15px;">
                        <tr>
                            <td width="200"><strong>Invoice</strong></td>
                            <td class="head1"><a href="showorder.php?id=<?=Baggeo_Encrypt($currentConfirm->id_orders)?>" target="_blank">: <strong><?php echo $currentConfirm->invoice;?></strong></a></td>
                        </tr>
                        <tr>
                            <td>Tanggal Transfer</td>
                            <td class="head1">: <?= $currentConfirm->transdate; ?></td>
                        </tr>
                        <tr>
                            <td>Dari Rekening</td>
                            <td class="head1">: <?= $currentConfirm->rekfrom; ?></td>
                        </tr>
                        <tr>
                            <td>Nama Pemilik Rekening</td>
                            <td class="head1">: <?= $currentConfirm->namerekfrom; ?></td>
                         </tr>
                        <tr>
                            <td>Transfer Ke Rekening</td>
                            <td class="head1">: <?=selectQ('bank','id_bank',$currentConfirm->id_bank,'name_bank')?> - <?=selectQ('bank','id_bank',$currentConfirm->id_bank,'account_bank')?></td>
                        </tr>
                        <tr>    
                            <td>Jumlah Transfer</td>
                            <td class="head1">: <?= $currentConfirm->transtotal; ?></td>
                        </tr>
                </table> 
                <br />    
                <?php if(selectQ('orders', 'id_orders', $currentConfirm->id_orders, 'status_order')==0){?>
                <div><a href="<?= "?page=$page&pro=done&id=".Baggeo_Encrypt($currentConfirm->id_orders).""; ?>" onclick='return payment()'><button class="btn btn-danger">Successful payment - Click Here</button></a></div>          
                <?php }?>    
                  
        </div>
                      </section> 
                 </div>
 
 
<?php break; } ?>