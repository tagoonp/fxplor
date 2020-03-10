<?php
// header('Location: ./authentication/');
// die();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <title>Fxplor :: Factor Relation Explore and Visulization Tool</title>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css" >
        <link rel="stylesheet" href="../node_modules/@fortawesome/fontawesome-free/css/all.css">
        <link rel="stylesheet" href="../node_modules/sweetalert/dist/sweetalert.css">
        <link rel="stylesheet" href="../node_modules/preload.js/dist/css/preload.css">

        <link href="https://fonts.googleapis.com/css?family=Sen&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="../assets/custom/css/style.css">
    </head>
    <body>

      <div class="main-content-c" style="margin-top: 30px;">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-10 offset-sm-1">
                    <div class="card">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-7">
                            <div id="login">
                                <div class="text-left">
                                  <img src="../img/fxplor-logo-1.png" alt="" width="200">
                                  <h1 style="font-size: 25px;">Create your Account</h1>
                                  <h3 style="font-size: 18px;">to continue to Fxplor</h3>
                                </div>
                                <div class="mt-4 mb-2">
                                  <form onsubmit="return false;" class="register-form" autocomplete="off">
                                    <div class="row">
                                      <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <input type="text" id="txtFname" class="form-control form-control-custom" placeholder="First name ..." autofocus>
                                        </div>
                                      </div>
                                      <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <input type="text" id="txtLname" class="form-control form-control-custom" placeholder="Last name ...">
                                        </div>
                                      </div>
                                    </div>

                                    <div class="form-group">
                                        <input type="email" id="txtEmail" class="form-control form-control-custom" placeholder="E-mail address ...">
                                    </div>

                                    <div class="form-group">
                                        <input type="password" id="txtPassword" class="form-control form-control-custom" placeholder="Password ...">
                                    </div>

                                      <div class="row">
                                        <div class="col-8 pt-3" style="font-size: 0.9em;">
                                          <a href="login">Back to log in</a>
                                        </div>
                                        <div class="col-4 text-right">
                                          <div class="form-group pt-3">
                                              <button type="submit" class="btn btn-primary">Create</button>
                                          </div>
                                        </div>
                                      </div>
                                  </form>
                                </div>
                            </div>
                          </div>
                          <div class="col-5 d-none d-sm-block text-center pt-5">
                            <img src="../img/Protection-1.png" alt="" style="max-width: 200px;">
                            <p>
                              <strong>Personal info protection</strong><br>
                              <span style="font-size: 0.9em;">You can use Wisnior account for all relate products.</span>
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="card-div-footer pt-2 pl-2">
                      <a href="#" class="pr-3 text-muted" style="font-size: 0.8em;">Help</a>
                      <a href="#" class="pr-3 pl-3 text-muted" style="font-size: 0.8em;">Privacy</a>
                      <a href="#" class="pr-3 pl-3 text-muted" style="font-size: 0.8em;">Terms</a>
                      <a href="#" class="pl-3 text-muted" style="font-size: 0.8em;">Contact us</a>
                    </div>
                </div>
            </div>
        </div>
      </div>
      <!-- .main-content -->
    </body>
    <script type="text/javascript" src="../node_modules/jquery/dist/jquery.min.js" ></script>
    <script type="text/javascript" src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="../node_modules/popper.js/dist/umd/popper.min.js"></script>
    <script type="text/javascript" src="../node_modules/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript" src="../node_modules/moment/min/moment.min.js"></script>
    <script type="text/javascript" src="../node_modules/preload.js/dist/js/preload.js"></script>

    <script type="text/javascript" src="../assets/custom/js/config.js"></script>
    <script type="text/javascript" src="../assets/custom/js/core.js"></script>
    <script type="text/javascript" src="../assets/custom/pages/register.js"></script>

    <script>


        $(document).ready(function(){
            preload.hide()
        })

        $(function(){

        })
    </script>
</html>
