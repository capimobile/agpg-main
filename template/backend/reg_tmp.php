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

    <title><?=TITLE_REG?> | <?=TITLE_CLINIC?></title>

    <!-- Bootstrap core CSS -->
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

  <body class="login-body" >

    <div class="container">

      <form class="form-signin" action="registration.php" method="post">
        <h2 class="form-signin-heading">registration now</h2>
        <div class="login-wrap">
            
            <p> Enter your account</p>
            <input type="text" class="form-control" placeholder="Full Name" name="name_users" autofocus required value="<?=$_POST['name_users']?>">
            <input type="text" class="form-control" placeholder="Phone"  name="phone_users" autofocus required value="<?=$_POST['phone_users']?>">
            <input type="text" class="form-control" placeholder="Email" name="email_users" autofocus required value="<?=$_POST['email_users']?>">
            <input type="password" class="form-control" name="password_users" placeholder="Password" required>
            <input type="password" class="form-control" name="repassword_users" placeholder="Re-type Password" required>
            <label class="checkbox">
                <input type="checkbox" value="1" name="agree" required> I agree to the Terms of Service and Privacy Policy
            </label>
            
            <div class="registration">
                <font color="#FF0000"><?=$msg?></font>
            </div>
            
            <button class="btn btn-lg btn-login btn-block" type="submit" name="btnSubmit">Submit</button>

            <div class="registration">
                Already Registered.
                <a class="" href="login.php">
                    Login
                </a>
            </div>

        </div>

      </form>

    </div>


  </body>
  
</html>
