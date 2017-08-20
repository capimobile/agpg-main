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

    <title>500</title>

    <?=$Html->css('template/backend/css/bootstrap.min.css')?>
    <?=$Html->css('template/backend/css/bootstrap-reset.css')?>
    <?=$Html->css('template/backend/assets/font-awesome/css/font-awesome.css')?>
    <?=$Html->css('template/backend/css/style.css')?>
    <?=$Html->css('template/backend/css/style-responsive.css')?>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>

  <body class="body-500">

    <div class="container" style="background:#FFF; width:600px; color:#333; margin-top:60px;">

      <section class="error-wrapper">
<?php if($_GET['page']=='regis'){?>      	  
          <h5 style="font-weight:bold;">Registration Message</h5>
      
          <h5>Terima Kasih, Email aktivasi dengan link untuk mengaktifkan account anda sudah kami kirim ke <?=$_POST['email_users']?>. </h5>

          <h5><i>Thank you for registering, An email has been dispatched to <?=$_POST['email_users']?> with details on how to activate your account.</i> </h5>
          <p class="page-500"> <a href="login.php" style="color:#06F">Go to login page</a></p>
      </section>
<?php }?>
    </div>


  </body>
</html>
