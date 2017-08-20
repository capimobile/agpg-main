<?php if(!isset($RUN)) { exit(); } ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link rel="shortcut icon" href="img/favicon.png">

    <title><?=TITLE?> | <?=TITLE_CLINIC?></title>

    <!-- Bootstrap core CSS -->
    <?=$Html->css('template/backend/css/bootstrap.min.css')?>
    <?=$Html->css('template/backend/css/bootstrap-reset.css')?>
    <?=$Html->css('template/backend/assets/bootstrap-datepicker/css/datepicker.css')?>
    <?=$Html->css('template/backend/assets/bootstrap-timepicker/compiled/timepicker.css')?>
    <?=$Html->css('template/backend/assets/font-awesome/css/font-awesome.css')?>
    <?=$Html->css('template/backend/assets/bootstrap-fileupload/bootstrap-fileupload.css')?>
    <?=$Html->css('template/backend/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css')?>
    <?=$Html->css('template/backend/css/owl.carousel.css')?>
    <?=$Html->css('template/backend/assets/advanced-datatable/media/css/demo_page.css')?>
    <?=$Html->css('template/backend/assets/advanced-datatable/media/css/demo_table.css')?>
	<?=$Html->css('template/backend/css/style.css')?>
    <?=$Html->css('template/backend/css/style-responsive.css')?>
    <?=$Html->css('template/backend/dist/css/select2.min.css')?>
    
    <style>
@charset "utf-8";
/* CSS Document */
table.calendar{border-style: solid; border-width: 1px; border-color:#CCC; }
tr.calendar-row { }
.doctersch{
min-height:100px; position:relative; width:130px !important;
}
.caldoc{
	color:#FFF;
	padding:3px;
	-webkit-border-radius: 3px 3px 3px 3px;
	border-radius: 3px 3px 3px 3px;
	margin-bottom:2px;
	font-size:10px;
}
td.calendar-day { height:130px;}
td.calendar-day:hover { background:#FFF; -moz-box-shadow:0px 0px 20px #eeeeee inset; -webkit-box-shadow:0px 0px 20px #eeeeee inset; box-shadow:0px 0px 20px #eeeeee inset;}
td.calendar-day-np { background:#eee; min-height:80px; } * html div.calendar-day-np { height:80px; }
td.calendar-day-head {font-weight:bold; text-shadow:0px 1px 0px #FFF;color:#666; text-align:center; width:130px; padding:12px 6px; border-bottom:1px solid #CCC; border-top:1px solid #CCC; border-right:1px solid #CCC; background: #ffffff;
background: -moz-linear-gradient(top, #ffffff 0%, #ededed 100%);
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#ffffff), color-stop(100%,#ededed));
background: -webkit-linear-gradient(top, #ffffff 0%,#ededed 100%);
background: -o-linear-gradient(top, #ffffff 0%,#ededed 100%);
background: -ms-linear-gradient(top, #ffffff 0%,#ededed 100%);
background: linear-gradient(to bottom, #ffffff 0%,#ededed 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#ededed',GradientType=0 );
}
div.day-number{padding:3px; }
/* shared */
td.calendar-day{padding:5px; border-bottom:1px solid #DBDBDB; border-right:1px solid #DBDBDB; font-size:12px;background: #ffffff;
}
td.calendar-day-np {padding:5px; border-bottom:1px solid #DBDBDB; border-right:1px solid #DBDBDB;background: #f6f6f8;
}
.overday{ color:#164b87; text-shadow:0px 1px 0px #FFF;}
.currentday{
background: #8bb0fc !important;
color:#FFF !important;
}
.currentday:hover{-moz-box-shadow:0px 0px 24px #074080 inset !important; -webkit-box-shadow:0px 0px 24px #074080 inset !important; box-shadow:0px 0px 24px #074080 inset !important;}
.last-prev{
	background:#f6f6f8 !important;
}
</style>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
      <script src="template/backend/js/html5shiv.js"></script>
      <script src="template/backend/js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

  <section id="container" style="min-width:1024px !important;">
      <!--header start-->
      <header class="header white-bg">
            <div class="sidebar-toggle-box">
                <div data-original-title="Toggle Navigation" data-placement="right" class="icon-reorder tooltips"></div>
            </div>
            <!--logo start-->
            <a href="index.php" class="logo" title="Ayam Gepuk Pak Gembus">Ayam Gepuk Pak Gembus
			</a>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">
                <!--  notification start -->
                <ul class="nav top-menu">
                    <!-- settings end -->
                    <!-- notification dropdown start
                    <li id="header_notification_bar waitingpasien" class="dropdown">
                        <a><span id="waitingpasien"></span></a>
                    </li>
                    notification dropdown end -->
                </ul>
                <!--  notification end -->
            </div>
            <div class="top-nav ">
                <!--search & user info start-->
                <ul class="nav pull-right top-menu">
                    <li>
                        <input type="text" class="form-control search" placeholder="Search">
                    </li>
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <img alt="" src="upload/thu/<?=Profile('photo')?>" width="29">
                            <span class="username"><?=Profile('nama')?></span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <div class="log-arrow-up"></div>
                            <li><a href="#"><i class=" icon-suitcase"></i>Profile</a></li>
                            <li><a href="?page=<?=Baggeo_Encrypt('cpassword')?>"><i class="icon-cog"></i>Password</a></li>
                            <li><a href="#"><i class="icon-bell-alt"></i> Notification</a></li>
                            <li><a href="logout.php"><i class="icon-key"></i> Log Out</a></li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->
                </ul>
                <!--search & user info end-->
            </div>
        </header>
      <!--header end-->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <?php include"web/menu.php";?>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->
      <!--main content start-->
      <section id="main-content" style="min-height:1000px;">
          <section class="wrapper">
	<?php 	
	include "$modul_controller";
	include "$modul_action";
	include "$modul_view";		
	?>
          </section>
      </section>
      <!--main content end-->
      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              2015 &copy; concesoft.com.
              <a href="#" class="go-top">
                  <i class="icon-angle-up"></i>
              </a>
          </div>
      </footer>
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <?=$Html->js('template/backend/js/jquery.js')?>
    <?=$Html->js('template/backend/assets/advanced-datatable/media/js/jquery.js')?>
    <?=$Html->js('template/backend/assets/bootstrap-fileupload/bootstrap-fileupload.js')?>
    <?=$Html->js('template/backend/js/jquery-1.8.3.min.js')?>
    <?=$Html->js('template/backend/js/bootstrap.min.js')?>
    <?=$Html->js('template/backend/js/jquery.dcjqaccordion.2.7.js')?>
    <?=$Html->js('template/backend/js/jquery.scrollTo.min.js')?>
    <?=$Html->js('template/backend/js/jquery.nicescroll.js')?>
    <?=$Html->js('template/backend/js/jquery.sparkline.js')?>
    <?=$Html->js('template/backend/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js')?>
    <?=$Html->js('template/backend/js/owl.carousel.js')?>
    <?=$Html->js('template/backend/js/jquery.customSelect.min.js')?>
    <?=$Html->js('template/backend/assets/advanced-datatable/media/js/jquery.dataTables.js')?>
    <?=$Html->js('template/backend/js/respond.min.js')?>
    <?=$Html->js('template/backend/js/jquery.dcjqaccordion.2.7.js')?>
	<?=$Html->js('template/backend/js/common-scripts.js')?>
    <?=$Html->js('template/backend/js/sparkline-chart.js')?>
    <?=$Html->js('template/backend/js/easy-pie-chart.js')?>
    <?=$Html->js('template/backend/js/count.js')?>
    <?=$Html->js('template/backend/js/ch.js')?>
    <?=$Html->js('template/backend/assets/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js')?>
    <?=$Html->js('template/backend/assets/bootstrap-datepicker/js/bootstrap-datepicker.js')?>
    <?=$Html->js('template/backend/assets/bootstrap-timepicker/js/bootstrap-timepicker.js')?>
    <?=$Html->js('template/backend/js/advanced-form-components.js')?>
    
    <?=$Html->js('template/backend/dist/js/select2.min.js')?>
    <?=$Html->js('template/backend/js/clone-form-td.js')?>
    <?=$Html->js('template/backend/js/notifikasi.js')?>
    <?=$Html->js('template/backend/assets/ckeditor/ckeditor.js')?>
 
    <!--script for this page-->

  <script>
  <!--script for select 2-->
  $(document).ready(function() {
        $(".js-example-basic-single").select2();
    });
<!--end select 2-->

      //owl carousel

      $(document).ready(function() {
          $("#owl-demo").owlCarousel({
              navigation : true,
              slideSpeed : 300,
              paginationSpeed : 400,
              singleItem : true,
			  autoPlay:true

          });
      });

      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });

  </script>
  
  <script type="text/javascript" charset="utf-8">
          $(document).ready(function() {
              $('#example').dataTable( {
                  
              } );
          } );
	function konfirmasi() {
		var msg;
		msg='Are you sure to delete the data? ' ;
		var agree=confirm(msg);
		if (agree)
			return true ;
		else
			return false ;
	}
	
  $(document).ready(function() {
    // $('#status_order').change(function() { 
    //   if($('#status_order').is(':checked')){ 
    //      alert("radiobutton 1 checked")
    //   }
    // }
    // $("#status_order") // select the radio by its id
    // .change(function(){ // bind a function to the change event
    //     if( $(this).is(":checked") ){ // check if the radio is checked
    //         var val = $(this).val(); // retrieve the value
    //         alert('clicked');
    //         if (val === '2') {
    //           $("#bank").disabled = false;
    //         }
    //     }
    // });
	$('#tahun').change(function() { 
		var tahun = $(this).val();
		$.ajax({
			type: 'GET',
			url: 'modul/mod_inventory/chain.php',
			data: 'th=' + tahun, // Untuk data di MySQL dengan menggunakan kata kunci tsb
			dataType: 'html',
			beforeSend: function() {
				$('#bulan').html('<option>Loading...</option>');	
			},
			success: function(response) {
				$('#bulan').html(response);
			}
		});
    });
	$('#bulan').change(function() { 
		var bulan = $(this).val();
		$.ajax({
			type: 'GET',
			url: 'modul/mod_inventory/chain.php',
			data: 'bl=' + bulan, // Untuk data di MySQL dengan menggunakan kata kunci tsb
			dataType: 'html',
			beforeSend: function() {
				$('#dari').html('<option>Loading...</option>');	
			},
			success: function(response) {
				$('#dari').html(response);
			}
		});
    });
	$('#dari').change(function() { 
		var dari = $(this).val();
		$.ajax({
			type: 'GET',
			url: 'modul/mod_inventory/chain.php',
			data: 'dr=' + dari, // Untuk data di MySQL dengan menggunakan kata kunci tsb
			dataType: 'html',
			beforeSend: function() {
				$('#sampai').html('<option>Loading...</option>');	
			},
			success: function(response) {
				$('#sampai').html(response);
			}
		});
    });
 });

 </script>
 <script type="text/javascript">
		var checkDisplay = function(check, form) { //check ID, form ID
			form = document.getElementById(form), check = document.getElementById(check);
			check.onclick = function(){
				form.style.display = (this.checked) ? "block" : "none";
				form.reset();
			};
			check.onclick();
		};
 </script>
  
  <?=$Html->js('template/backend/js/jquery.stepy.js')?>
  <?=$Html->js('template/backend/js/ajaxscript.js')?>
  <?=$Html->js('template/backend/js/rupiah.js')?>

  <script>

      //step wizard

      $(function() {
          $('#default').stepy({
              backLabel: 'Previous',
              block: true,
              nextLabel: 'Next',
              titleClick: true,
              titleTarget: '.stepy-tab'
          });
      });
  </script>
<script>
$('.price').keyup(function () { 
    var sum = 0;
    $('.price').each(function() {
        sum += Number($(this).val());
    });
	$('#totalPrice').html(tandaPemisahTitik(sum));
	$('#totalPricePayment').html(tandaPemisahTitik(sum));
	$('#totalPriceHidden').val(sum);
});


$(document).ready(function() {
    $('#formreprint').submit(function() {
        window.open('', 'formpopup', 'width=500,height=420,top=' + (screen.height - 420) / 2 + ',left=' + (screen.width - 500) / 2 + ',menubar=no,toolbar=no,location=no,directories=no,scrollbars=no,status=no,resizable=yes');
        this.target = 'formpopup';
    });
});

		$(document).ready(function () {
                $("#btnoo").click(function () {
                    var dt = $("form").serialize();
                    $.ajax({
                        type: 'POST',
                        url: 'modul/mod_list/prod.php',
                        data: dt,
                        success: function (data) {
                            $("#tete2").append(data);
                        }
                    });
					$('#dsco').val(''); 
					 $('#obt').prop('selectedIndex',0);
                });

     });
	 
	 function noteorder(){
		 $('#inputnote').show();
		 $('#notesq').hide();
	 }
	 function cancelnote(){
		 $('#inputnote').hide();
		 $('#notesq').show();
	 }
</script>

  </body>
</html>
