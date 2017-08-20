<?php 

require '../../App/db/Connect.php';

require '../../App/lib/Table.php';

require '../../App/lib/access_db.php';

require '../../App/lib/manipulate.php';

require '../../App/lib/clinic_function.php';

if($_POST['id_product']!=0 || $_POST['qty_po']!=' '){?>

							<div class="alert alert-info fade in" style="margin-bottom:5px; padding:6px;">

                                  <button data-dismiss="alert" class="close close-sm" type="button">

                                      <i class="icon-remove"></i>

                                  </button>
<?php
$jual=selectQ('product', 'id_product', $_POST['id_product'], 'hjual_product');
if(selectQ('product', 'id_product', $_POST['id_product'], 'drp_product')==1){
	$dsc=selectQ('product', 'id_product', $_POST['id_product'], 'discount_product');
	$tjual=$jual-$dsc;
}
elseif(selectQ('product', 'id_product', $_POST['id_product'], 'drp_product')==2){
	$dsc=($jual*selectQ('product', 'id_product', $_POST['id_product'], 'discount_product'))/100;
	$tjual=$jual-$dsc;
}
else{
	$tjual=$jual;
}
?>
                                  <strong>Nama Barang :</strong> <?=selectQ('product', 'id_product', $_POST['id_product'], 'name_product')?> | <?= $_POST['qty_po'] ?> * Rp <?=rupiah($tjual)?> (@Discount Rp <?=rupiah($dsc)?>) = Rp <?= rupiah($tjual*$_POST['qty_po']) ?></strong>

                              	  <input type="hidden" name="idpr[]" value="<?=$_POST['id_product']?>" />

                                  <input type="hidden" name="qtypo[]" value="<?=$_POST['qty_po']?>" />

                                  <input type="hidden" name="disc[]" value="<?=$dsc?>" />

                              </div>

<?php }?>