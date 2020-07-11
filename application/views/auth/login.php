<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title><?= APP_NAME ?> | Admin Sign In </title>    
    <meta name="description" content="<?= APP_DESC ?>">
    <meta name="author" content="Holmestech.id">
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link href="<?= base_url(); ?>assets_new/css/style.css" rel="stylesheet" type="text/css">    
</head>
<body>
	<div class="hk-wrapper">
        <div class="hk-pg-wrapper hk-auth-wrapper" style="background: white !important">
            <header class="d-flex justify-content-between align-items-center">
                <a class="d-flex auth-brand" href="<?= base_url(); ?>" style="font-weight: bold; color: white">
                    <img class="brand-img" src="<?php echo base_url('assets_new/img/logo.png')?>" alt="brand" width="70px"/>
                </a>
            </header>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-7 pa-0">
                        <div id="owl_demo_1" class="owl-carousel dots-on-item owl-theme">
                            <div class="fadeOut item auth-cover-img overlay-wrap" style="background-image:url(<?= base_url(); ?>assets_new/img/bengkel1.jpg);">
                                <div class="auth-cover-info py-xl-0 pt-100 pb-50">
                                    <div class="auth-cover-content text-center w-xxl-75 w-sm-90 w-xs-100">
                                        <h1 class="display-3 text-white mb-20">Satisfied.</h1>
                                        <p class="text-white">Kenyamanan dan Kepuasan Pelanggan adalah Prioritas kita</p>
                                    </div>
                                </div>
                                <div class="bg-overlay bg-trans-dark-50"></div>
                            </div>
                            <div class="fadeOut item auth-cover-img overlay-wrap" style="background-image:url(<?= base_url(); ?>assets_new/img/bengkel2.jpg);">
                                <div class="auth-cover-info py-xl-0 pt-100 pb-50">
                                    <div class="auth-cover-content text-center w-xxl-75 w-sm-90 w-xs-100">
                                        <h1 class="display-3 text-white mb-20">Believe.</h1>
                                        <p class="text-white">Mari bangun kepercayaan untuk pelanggan kita</p>
                                    </div>
                                </div>

								<div class="bg-overlay bg-trans-dark-50"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 pa-0">                        
                        <!-- <div class="py-xl-0 py-50"> -->
                            <div class="text-center" style="margin: 10px auto;">
                                <img src="<?php echo base_url('assets_new/img/logo.png')?>" width="100px">
                                <h3 class="mt-2"  style="color: black"><?=APP_NAME?></h3>
                                <p class="p-t-b-20" style="color: black"><?=APP_DESC?></p>
                            </div>
                            
                            <div style="margin:10px auto; background-color: #dc3545; border-radius: 5px" class="w-xxl-65 w-xl-75 w-sm-90 w-100  pa-25">
                                <form  action="<?php echo base_url()?>auth/login" method="post">
                                    <h1 class="display-4 mb-10" style="color: white">Welcome Back!</h1>
                                    <p class="mb-30" style="color: white">Sign in to continue.</p>
                                    <h6 class="text-center" style="color: orange"><?php echo $errorlogin; ?></h6>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Username" type="text" name="username">
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input class="form-control" placeholder="Password" type="password" name="password">
                                        </div>
                                    </div>
                                    <!-- <div class="custom-control custom-checkbox mb-25">
                                        <input class="custom-control-input" id="same-address" type="checkbox" checked>
                                        <label class="custom-control-label font-14" for="same-address">Keep me logged in</label>
                                    </div> -->
                                    <button class="btn btn-light btn-block" type="submit">Login</button>
                                    <!-- <p class="font-14 text-center mt-15">Having trouble logging in?</p>
                                    <div class="option-sep">or</div>
                                    <div class="form-row">
                                        <div class="col-sm-6 mb-20">
                                            <button class="btn btn-indigo btn-block btn-wth-icon"> <span class="icon-label"><i class="fa fa-facebook"></i> </span><span class="btn-text">Login with facebook</span></button>
                                        </div>
                                        <div class="col-sm-6 mb-20">
                                            <button class="btn btn-primary btn-block btn-wth-icon"> <span class="icon-label"><i class="fa fa-twitter"></i> </span><span class="btn-text">Login with Twitter</span></button>
                                        </div>
                                    </div> -->
                                    <!-- <p class="text-center">Do have an account yet? <a href="#">Sign Up</a></p> -->
                                </form>                                                                
                            </div>
                        <!-- </div> -->
                        <center>
                            <img src="<?= base_url(); ?>assets_new/img/run_car.gif" alt="" height="80px">                            
                            <br>
                            <a href="apk/app-debug.apk" title="Link Download Aplikasi Pegawai" style="color: black">
                                <p>Aplikasi Pegawai</p>
                                <img src="<?=base_url('assets_new/img/get_in_playstore.png')?>" alt="" width="150px">
                            </a>
                        </center> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= base_url(); ?>assets_new/lib/jquery/jquery.min.js"></script>    
    <script src="<?= base_url(); ?>assets_new/lib/owl.carousel/owl.carousel.min.js"></script>
    <script src="<?= base_url(); ?>assets_new/lib/umd/popper.min.js"></script>
    <script src="<?= base_url(); ?>assets_new/lib/js/bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>assets_new/js/jquery.slimscroll.js"></script>
    <script src="<?= base_url(); ?>assets_new/js/dropdown-bootstrap-extended.js"></script>
    <script src="<?= base_url(); ?>assets_new/js/feather.min.js"></script>
    <script src="<?= base_url(); ?>assets_new/js/init.js"></script>
    <script src="<?= base_url(); ?>assets_new/js/login-data.js"></script>
</body>
</html>