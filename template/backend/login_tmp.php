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

    <title><?=TITLE_LOGIN?> | <?=TITLE_CLINIC?></title>

    <!-- Bootstrap core CSS -->
    <?=$Html->css('template/backend/css/bootstrap.min.css')?>
    <?=$Html->css('template/backend/css/bootstrap-reset.css')?>
    <?=$Html->css('template/backend/assets/font-awesome/css/font-awesome.css')?>
    <?=$Html->css('template/backend/css/style.css')?>
    <?=$Html->css('template/backend/css/style-responsive.css')?>
    <!--external css-->
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script src="template/backend/js/html5shiv.js"></script>
    <script src="template/backend/js/respond.min.js"></script>
    <![endif]-->
</head>

  <body class="login-body">

    <div class="container">

      <form class="form-signin" action="login.php" method="post">
        <h2 class="form-signin-heading">sign in now</h2>
        <div class="login-wrap">
        	
            <input type="text" class="form-control" placeholder="Email" name="username" autofocus>
            <input type="password" class="form-control" placeholder="Password" name="password">
            <label class="checkbox">
                <span class="pull-right">
                    <a data-toggle="modal" href="#myModal"> Forgot Password?</a>

                </span>
            </label>
            <button class="btn btn-lg btn-login btn-block" type="submit" name="btnSubmit">Sign in</button>
      
            
            <div class="registration">
                Don't have an account yet?
                <a class="" href="registration.php">
                    Create an account
                </a>
            </div>

        </div>

          <!-- Modal -->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title">Forgot Password ?</h4>
                      </div>
                      <div class="modal-body">
                          <p>Enter your e-mail address below to reset your password.</p>
                          <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">

                      </div>
                      <div class="modal-footer">
                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                          <button class="btn btn-success" type="button">Submit</button>
                      </div>
                  </div>
              </div>
          </div>
          <!-- modal -->

      </form>

    </div>



    <!-- js placed at the end of the document so the pages load faster -->
    <?=$Html->js('template/backend/js/jquery.js')?>
    <?=$Html->js('template/backend/js/bootstrap.min.js')?>

  </body>
</html>
