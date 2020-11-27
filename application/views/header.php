<!-- This site is developed by Alphinex solutions {alphinex.com} -->
<!DOCTYPE html>

<html lang="en" class="loading">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">

    <meta name="author" content="Alphinex solutions">

    <title><?=@($title) ? $title : "tgLogistics"?></title>

    <meta name="apple-mobile-web-app-capable" content="yes">

    <meta name="apple-touch-fullscreen" content="yes">

    <meta name="apple-mobile-web-app-status-bar-style" content="default">

    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700,900|Montserrat:300,400,500,600,700,800,900" rel="stylesheet">

    <!-- BEGIN VENDOR CSS-->


    <!-- font icons-->

    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/fonts/feather/style.min.css');?>">

    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/fonts/simple-line-icons/style.css');?>">

    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/fonts/font-awesome/css/font-awesome.min.css');?>">

    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/perfect-scrollbar.min.css');?>">

    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/prism.min.css');?>">

    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/chartist.min.css');?>">

    <!-- END VENDOR CSS-->


    <!-- BEGIN Alphinex CSS-->

    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/css/app.css');?>">

    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/css/custom.css');?>">

    <!-- END Alphinex CSS-->


    <!-- END Custom CSS-->

    <script src="<?=base_url('app-assets/vendors/js/core/jquery-3.2.1.min.js')?>" type="text/javascript"></script>

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?=base_url("app-assets/datatable/datatables.min.css")?>"/>
    <script type="text/javascript" src="<?=base_url("app-assets/datatable/datatables.min.js")?>"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="shortcut icon" href="<?=base_url('app-assets/images/logo.jpg')?>">
  </head>

  <body data-col="2-columns" class=" 2-columns ">

    <!-- ////////////////////////////////////////////////////////////////////////////-->
<div class="modal fade" id="viewModaluser" tabindex="0" role="dialog" aria-labelledby="statusModalTitle" aria-hidden="true" style="">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="statusModalTitle">View Details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body view_details_">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>
    <div class="wrapper">
<div class="main-content">
