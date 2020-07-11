<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">    
    <meta name="description" content="Dokter Tani Kita">
    <meta name="author" content="Holmestech.id">
    <title><?= APP_NAME ?> | <?= $subtitle ?> </title>    
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="icon" href="<?= base_url(); ?>assets_new/img/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="<?=base_url('assets_new/css/bootstrap.min.css')?>">
    <!-- <link href="https://hencework.com/theme/vendors4/vectormap/jquery-jvectormap-2.0.3.css" rel="stylesheet" type="text/css" /> -->
    <link href="<?= base_url(); ?>assets_new/lib/jquery-toggles/css/toggles.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>assets_new/lib/jquery-toggles/css/toggles-light.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>assets_new/lib/morris.js/morris.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>assets_new/lib/jquery-toast-plugin/jquery.toast.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>assets_new/css/style.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>assets_new/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>assets_new/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css">
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">  -->
    <!-- <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>  -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <!-- <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script> -->
    <link href="<?= base_url(); ?>assets_new/css/style.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>assets_new/css/yearpicker.css" rel="stylesheet" type="text/css">    

    <!-- <link href="<?=base_url('assets_new/css/cashier-main.css')?>" rel="stylesheet" type="text/css" media="screen, projection"> -->
    <link href="<?=base_url('assets_new/css/cashier-print.css')?>" rel="stylesheet" type="text/css" media="print" />

    <!-- <link href="<?= base_url(); ?>assets_new/bootstrap-datetimepicker/css/bootstrap.min.css" rel="stylesheet" media="screen"> -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->
    <link href="https://hencework.com/theme/vendors4/ion-rangeslider/css/ion.rangeSlider.css" rel="stylesheet" type="text/css">
    <link href="https://hencework.com/theme/vendors4/ion-rangeslider/css/ion.rangeSlider.skinHTML5.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>assets_new/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
    <style type="text/css">
        table.dataTable.dtr-inline.collapsed > tbody > tr[role="row"] > td:first-child:before{
            display: block;
        }
        .btn{
            font-size: 13px;
        }
        .cp{
            cursor:pointer;
        }
    </style>
    <!-- <link href="<?= base_url(); ?>assets_new/css/daterangepicker.css" rel="stylesheet" type="text/css" /> -->
</head>

<body>
   <div class="hk-wrapper hk-vertical-nav">
        <?php 
            echo $modal;
            echo $nav_top;
            echo $form_search_top;
            echo $nav_side_menu;
            echo $settings_panel;  
        ?>
        
        <div class="hk-pg-wrapper">
          <nav class="hk-breadcrumb no-print" aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-light bg-transparent">
                  <li class="breadcrumb-item"><a href="#"><?=$subtitle?></a></li>
                  <li class="breadcrumb-item active" aria-current="page"><?=$subtitle_small?></li>
              </ol>
          </nav>
            <?=$content?>              
        </div>
    </div>
    <script src="<?= base_url(); ?>assets_new/lib/jquery/jquery.min.js"></script>
    <script src="<?= base_url(); ?>assets_new/lib/umd/popper.min.js"></script>
    <script src="<?= base_url(); ?>assets_new/lib/js/bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>assets_new/js/jquery.slimscroll.js"></script>
    <script src="<?= base_url(); ?>assets_new/js/dropdown-bootstrap-extended.js"></script>
    <script src="<?= base_url(); ?>assets_new/js/feather.min.js"></script>
    <script src="<?= base_url(); ?>assets_new/lib/jquery-toggles/toggles.min.js"></script>
    <script src="<?= base_url(); ?>assets_new/js/toggle-data.js"></script>
    <script src="<?= base_url(); ?>assets_new/lib/raphael/raphael.min.js"></script>
    <script src="<?= base_url(); ?>assets_new/lib/morris.js/morris.min.js"></script>
	<script src="<?= base_url(); ?>assets_new/lib/waypoints/jquery.waypoints.min.js"></script>
	<script src="<?= base_url(); ?>assets_new/lib/jquery.counterup/jquery.counterup.min.js"></script>
    <script src="<?= base_url(); ?>assets_new/lib/echarts/echarts-en.min.js"></script>
    <!-- <script src="<?= base_url(); ?>assets_new/lib/jquery.sparkline/jquery.sparkline.min.js"></script> -->
    <!-- <script src="https://hencework.com/theme/vendors4/vectormap/jquery-jvectormap-2.0.3.min.js"></script>
    <script src="https://hencework.com/theme/vendors4/vectormap/jquery-jvectormap-world-mill-en.js"></script> -->
    <script src="<?= base_url(); ?>assets_new/js/vectormap-data.js"></script>
    <script src="<?= base_url(); ?>assets_new/lib/owl.carousel/owl.carousel.min.js"></script>
    <script src="<?= base_url(); ?>assets_new/lib/jquery-toast-plugin/jquery.toast.min.js"></script>
    <script src="<?= base_url(); ?>assets_new/js/init.js"></script>
	<script src="<?= base_url(); ?>assets_new/js/dashboard-data.js"></script>	

    <!-- <script src="https://hencework.com/theme/vendors4/moment/min/moment.min.js"></script> -->
    <!-- <script src="https://hencework.com/theme/vendors4/daterangepicker/daterangepicker.js"></script> -->
    <!-- <script src="<?= base_url(); ?>assets_new/js/daterangepicker-data.js"></script> -->

    <!-- datatables -->
    <script src="<?= base_url(); ?>assets_new/js/jquery.dataTables.min.js"></script> 
    <script src="<?= base_url(); ?>assets_new/js/dataTables.bootstrap4.min.js"></script> 
    <script src="<?= base_url(); ?>assets_new/js/dataTables.responsive.min.js"></script> 
    <script src="<?= base_url(); ?>assets_new/js/responsive.bootstrap4.min.js"></script>     

    <script src="<?= base_url(); ?>assets_new/js/sweetalert.min.js"></script>    
    <script src="<?= base_url(); ?>assets_new/js/validation-data.js"></script>
    <script src="<?= base_url(); ?>assets_new/js/yearpicker.js" async></script>
    <script src="https://hencework.com/theme/vendors4/ion-rangeslider/js/ion.rangeSlider.min.js"></script>
        
    <script src="<?= base_url(); ?>assets_new/js/rangeslider-data.js"></script>
    <script src="<?= base_url(); ?>assets_new/js/cashier_brain.js"></script>
    <script src="<?= base_url(); ?>assets_new/js/cashier_listeners.js"></script>
    <script src="<?= base_url(); ?>assets_new/js/cashier_utilities.js"></script>


    <!-- <script type="text/javascript" src="./bootstrap/js/bootstrap.min.js"></script> -->
    <!-- <script type="text/javascript" src="../js/bootstrap-datetimepicker.js" charset="UTF-8"></script> -->
    <!-- <script type="text/javascript" src="../js/locales/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script> -->
    
    <script src="<?= base_url(); ?>assets_new/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
    <script src="<?=base_url('assets_new/lib/numeral/numeral.js')?>"></script>
    <?= $ajax ?>
</body>
</html>