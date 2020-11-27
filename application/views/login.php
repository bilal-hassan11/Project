<!DOCTYPE html>

<html lang="en" class="loading">



<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">

    <meta name="author" content="ALPHINEX">

    <title>brown box ninja</title>

    <meta name="apple-mobile-web-app-capable" content="yes">

    <meta name="apple-touch-fullscreen" content="yes">

    <meta name="apple-mobile-web-app-status-bar-style" content="default">

    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700,900|Montserrat:300,400,500,600,700,800,900" rel="stylesheet">

    <!-- BEGIN VENDOR CSS-->

    <!-- font icons-->

    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/fonts/feather/style.min.css')?>">

    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/fonts/simple-line-icons/style.css')?>">

    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/fonts/font-awesome/css/font-awesome.min.css')?>">

    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/perfect-scrollbar.min.css')?>">

    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/prism.min.css')?>">

    <!-- END VENDOR CSS-->

    <!-- BEGIN APEX CSS-->

    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/css/app.css')?>">

    <!-- END APEX CSS-->

    <!-- BEGIN Page Level CSS-->

    <!-- END Page Level CSS-->

    <!-- BEGIN Custom CSS-->

    <!-- END Custom CSS-->

    <style>

        .logo-txt {

          color: #fff;

        }

        .login_page_heading {
          font-size: 40px;
          color: #000;
          font-weight: bold;
          text-shadow: 0px 0px 3px #fff;
        }
    </style>

  </head>

  <body data-col="1-column" class=" 1-column  blank-page blank-page">

    <!-- ////////////////////////////////////////////////////////////////////////////-->

    <div class="wrapper">

      <div class="main-panel">

        <div class="main-content">

          <div class="content-wrapper"><!--Login Page Starts-->

            <section id="login">

              <div class="container-fluid">

                  <div class="row full-height-vh" style="background-image: url(<?=base_url('app-assets/images/login.jpg')?>);position: relative; background-position: center;background-repeat: no-repeat;background-size: cover;">
                      <div class="col-12 d-flex align-items-center justify-content-center">

                          <div class="card gradient-indigo-purple text-center width-400">

                              <div class="card-img overlap logo-txt">

                                <h3 class="login_page_heading"></h3>

                              </div>

                              <div class="card-body" style="background: #fff; box-shadow: 0 0 2px 1px rgba(0,0,0,.3)">

                                  <div class="card-block">

                                    <br /><br />
                                    <img src="<?=base_url('app-assets/images/logo.jpg')?>" width="100" class="text align-middle" />
                                    <br />
                                    <br />
                                      <form class="login-form" action="<?=site_url('users/login')?>" method="post">

                                          <div class="form-group">

                                              <div class="col-md-12">

                                                <input type="text" class="form-control" name="username" id="username" placeholder="username" required >

                                              </div>

                                          </div>

                                          <div class="form-group">

                                            <div class="col-md-12">

                                              <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>

                                            </div>

                                          </div>

                                          <div class="form-group">

                                              <div class="col-md-12">

                                                  <button type="submit" class="btn btn-primary btn-block btn-raised">Login</button>

                                              </div>

                                          </div>

                                      </form>

                                  </div>

                              </div>

                          </div>

                      </div>

                  </div>

              </div>

          </section>

          <!--Login Page Ends-->

        </div>

      </div>

    </div>

  </div>

    <!-- ////////////////////////////////////////////////////////////////////////////-->



    <!-- BEGIN VENDOR JS-->

    <script src="<?=base_url('app-assets/vendors/js/core/jquery-3.2.1.min.js')?>" type="text/javascript"></script>

    <script src="<?=base_url('app-assets/vendors/js/core/popper.min.js')?>" type="text/javascript"></script>

    <script src="<?=base_url('app-assets/vendors/js/core/bootstrap.min.js')?>" type="text/javascript"></script>

    <script src="<?=base_url('app-assets/vendors/js/perfect-scrollbar.jquery.min.js')?>" type="text/javascript"></script>

    <script src="<?=base_url('app-assets/vendors/js/prism.min.js')?>" type="text/javascript"></script>

    <script src="<?=base_url('app-assets/vendors/js/jquery.matchHeight-min.js')?>" type="text/javascript"></script>

    <script src="<?=base_url('app-assets/vendors/js/screenfull.min.js')?>" type="text/javascript"></script>

    <script src="<?=base_url('app-assets/vendors/js/pace/pace.min.js')?>" type="text/javascript"></script>

    <!-- BEGIN VENDOR JS-->

    <!-- BEGIN PAGE VENDOR JS-->

    <!-- END PAGE VENDOR JS-->

    <!-- BEGIN APEX JS-->

    <script src="<?=base_url('app-assets/js/app-sidebar.js')?>" type="text/javascript"></script>

    <script src="<?=base_url('app-assets/js/notification-sidebar.js')?>" type="text/javascript"></script>

    <script src="<?=base_url('app-assets/js/customizer.js')?>" type="text/javascript"></script>

    <!-- END APEX JS-->

    <!-- BEGIN PAGE LEVEL JS-->

    <!-- END PAGE LEVEL JS-->

  </body>





</html>
