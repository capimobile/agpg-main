<!-- <?php
require '../../App/db/Connect.php';
require '../../App/lib/Table.php';
require '../../App/lib/access_db.php';
require '../../App/lib/manipulate.php';
 
if($_GET['th']){ ?>

										<select class="form-control m-bot15" name="bulan" id="bulan" required>
                                              <option value="0">- Bulan -</option>
                                              <?php for ($a = 1; $a <= 12; $a++){?>
                                              <option value="<?=$_GET['th']?>-<?=$a?>"><?=getBulan($a)?></option>
                                              <?php }?>
                                          </select>
<?php }
if($_GET['bl']){ ?>

										<select class="form-control m-bot15" name="from" id="dari" required>
                                              <option value="0">- Dari -</option>
                                              <?php
											  $days=explode('-', $_GET['bl']); 
											  $days_in_month = date('t',mktime(0,0,0,$days[1],1,$days[0]));
											  for($x = 1; $x <= $days_in_month; $x++){?>
                                              <option value="<?=date('Y-m-d', strtotime($_GET['bl'].'-'.$x))?>"><?=$x?></option>
                                              <?php }?>
                                          </select>
<?php }
if($_GET['dr']){ ?>

										<select class="form-control m-bot15" name="to" id="sampai" required>
                                              <option value="0">- Sampai -</option>
                                              <?php
											  $days=explode('-', $_GET['dr']); 
											  $days_in_month = date('t',mktime(0,0,0,$days[1],1,$days[0]));
											  for($x = (int)$days[2]; $x <= $days_in_month; $x++){?>
                                              <option value="<?=date('Y-m-d', strtotime($days[0].'-'.$days[1].'-'.$x))?>"><?=$x?></option>
                                              <?php }?>
                                          </select>
<?php }?> -->