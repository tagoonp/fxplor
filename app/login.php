<?php
include "../../configuration/fxplor/config.inc.php";
include "../connect.inc.php";
include "../function.inc.php";
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Argon Dashboard - Free Dashboard for Bootstrap 4</title>
  <!-- Favicon -->
  <link rel="icon" href="../vendor/assets/img/brand/favicon.png" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="../vendor/assets/vendor/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="../vendor/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
  <!-- Page plugins -->
  <!-- Argon CSS -->
  <link rel="stylesheet" href="../vendor/assets/css/argon.css?v=1.2.0" type="text/css">
  <link rel="stylesheet" href="../vendor/custom/css/style.css?v=1.2.0" type="text/css">
</head>

<div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-9" style="position: absolute; width: 100%;">
  <div class="container">
    <div class="header-body text-center mb-7">
      <div class="row justify-content-center">
        <div class="col-xl-12">

        </div>
      </div>
    </div>
  </div>
  <div class="separator separator-bottom separator-skew zindex-100">
    <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
      <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
    </svg>
  </div>
</div>

<body class="" style="background: #172b4d;">
  <div class="d-flex vh-100">
    <div class="d-flex w-100 justify-content-center align-self-center">
      <div class="" style="width: 380px; max-width: 400px;">
        <div class="card bg-white mb-0" style="border: solid; border-width: 1px 1px 1px 1px; border-color: rgb(245, 245, 245); box-shadow: none;">
          <div class="card-body">
            <div class="text-center">
              <img src="../img/fxplor-logo-2.png" alt="" class="img-fluid">
            </div>
            <div class="text-center text-muted mb-4">
              <small>Sign in with credentials</small>
            </div>
            <form role="form" class="loginForm" onsubmit="return false;">
              <div class="form-group mb-3">
                <div class="input-group input-group-merge input-group-alternative" id="txtUsername_box" style="box-shadow: none; border: solid; border-width: 0px 0px 2px 0px; border-color: rgb(227, 227, 227); border-radius: 0px;">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                  </div>
                  <input class="form-control" placeholder="Email" type="email" id="txtUsername">
                </div>
              </div>
              <div class="form-group">
                <div class="input-group input-group-merge input-group-alternative" id="txtPassword_box" style="box-shadow: none; border: solid; border-width: 0px 0px 2px 0px; border-color: rgb(227, 227, 227); border-radius: 0px;">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                  </div>
                  <input class="form-control" placeholder="Password" type="password" id="txtPassword">
                </div>
              </div>
              <div class="custom-control custom-control-alternative custom-checkbox text-center">
                <input class="custom-control-input" id=" customCheckLogin" type="checkbox">
                <label class="custom-control-label" for=" customCheckLogin">
                  <span class="text-muted">Remember me</span>
                </label>
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-primary my-4">Sign in</button>
              </div>
            </form>
          </div>
          <div class="card-footer bg-secondary">
            <div class="row">
              <div class="col-6">
                <a href="resetpwd.php" class="text-light"><small>Forgot password?</small></a>
              </div>
              <div class="col-6 text-right">
                <a href="register.php" class="text-light"><small>Create new account</small></a>
              </div>
            </div>
          </div>
        </div>

      </div>
      <!-- // -->
    </div>
  </div>

  <!-- Core -->
  <script src="../vendor/assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="../vendor/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../vendor/assets/vendor/js-cookie/js.cookie.js"></script>
  <script src="../vendor/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="../vendor/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
  <!-- Optional JS -->
  <script src="../vendor/assets/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="../vendor/assets/vendor/chart.js/dist/Chart.extension.js"></script>
  <!-- Argon JS -->
  <script src="../vendor/assets/js/argon.js?v=1.2.0"></script>
  <script src="../vendor/custom/js/config.js?v=<?php echo $sysdateu; ?>"></script>
  <script src="../vendor/custom/js/core.js?v=<?php echo $sysdateu; ?>"></script>
  <script src="../vendor/custom/js/token.js?v=<?php echo $sysdateu; ?>"></script>
  <script src="../vendor/custom/js/authen.js?v=<?php echo $sysdateu; ?>"></script>

  <script type="text/javascript">
    $('.loginForm').submit(function(){
      $check = 0;
      $('.input-group-merge').css('border-color', 'rgb(245, 245, 245)')
      if($('#txtUsername').val() == ''){
        $('#txtUsername_box').css('border-color', 'red')
        $check++;
      }
      if($('#txtPassword').val() == ''){
        $('#txtPassword_box').css('border-color', 'red')
        $check++;
      }
      if($check != 0){
        return ;
      }
      var param = {
        token: current_token,
        username: $('#txtUsername').val(),
        password: $('#txtPassword').val()
      }
      authen.login(param)
    })
  </script>
</body>

</html>
