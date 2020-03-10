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

        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="../assets/custom/css/style.css">
    </head>
    <body>

      <div class="main-content-c" style="margin-top: 30px;">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3">
                    <div class="card">
                      <div class="card-body">
                        <div id="login">
                            <div class="text-center">
                              <img src="../img/fxplor-logo-2.png" alt="" class="img-fluid">
                              <h1 style="font-size: 25px;">Sign in</h1>
                              <h3 style="font-size: 18px;">to continue to Fxplor</h3>
                            </div>
                            <div class="mt-4 mb-2">
                                <div class="row">
                                  <div class="col-10 offset-1">
                                    <form onsubmit="return false;" class="login-form" autocomplete="off">
                                        <div class="form-group">
                                            <input type="email" id="txtEmail" class="form-control form-control-custom" placeholder="E-mail address ..." autofocus>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" id="txtPassword" class="form-control form-control-custom" placeholder="Your password ...">
                                        </div>

                                        <div class="row">
                                          <div class="col-8 pt-3" style="font-size: 0.9em;">
                                            <a href="register">Create account</a><br>
                                            <a href="forgetpassword">Forget password?</a>
                                          </div>
                                          <div class="col-4 text-right">
                                            <div class="form-group pt-3">
                                                <button type="submit" class="btn btn-primary">Log in</button>
                                            </div>
                                          </div>
                                        </div>
                                    </form>
                                  </div>
                                </div>
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
    <script type="text/javascript" src="../node_modules/preload.root.js/dist/js/preload.js"></script>

    <script type="text/javascript" src="../assets/custom/js/core.js"></script>
    <script type="text/javascript" src="../assets/custom/pages/forgetpassword.js"></script>

    <script>


        $(document).ready(function(){
            preload.hide()
        })

        $(function(){

        })
    </script>
</html>
