<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="<?php echo $description;?>">
    <title><?php echo $title; ?></title>
    <meta name="author" content="">


  <link rel="icon" href="assets/image/logo.png" type="image/icon type">

  <title><?php echo $title;?></title>
  <?php if(isset($style)){ 
    foreach ($style as $key => $value) { ?>
    <link rel="stylesheet" href="<?php echo $value;?>">
  <?php } } ?>
  <link href="assets/boostrap_jquery/css/bootstrap.css" rel="stylesheet" >
  <link href="assets/fontawesome/css/fontawesome.css" rel="stylesheet">


  <link rel="stylesheet" href="assets/theme/ftage/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/theme/ftage/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/theme/ftage/css/icofont.css">
  <link rel="stylesheet" href="assets/theme/ftage/css/magnific-popup.css">
  <link rel="stylesheet" href="assets/theme/ftage/css/meanmenu.min.css">
  <link rel="stylesheet" href="assets/theme/ftage/css/owl.carousel.min.css">
  <link rel="stylesheet" href="assets/theme/ftage/css/slick.css">
  <link rel="stylesheet" href="assets/theme/ftage/css/plugins.css">
  <link rel="stylesheet" href="assets/theme/ftage/css/shortcode/shortcodes.css">
  <link rel="stylesheet" href="assets/theme/ftage/style.css">
  <link rel="stylesheet" href="assets/theme/ftage/css/responsive.css">
  
  <!-- Revolution Slider CSS -->
  <link href="assets/theme/ftage/assets/revolution/css/settings.css" rel="stylesheet">
  <link href="assets/theme/ftage/assets/revolution/css/navigation.css" rel="stylesheet">
  <link href="assets/theme/ftage/assets/revolution/custom-setting.css" rel="stylesheet">

  
  <?php 
  if(isset($script)){
  foreach ($script as $key => $value) { ?>
    <script src="<?php echo $value;?>"></script>
  <?php } } ?>
</head>
<body class="<?php echo (isset($class_body)?$class_body:''); ?> pt-50">
<!--[if lt IE 8]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
<div class="page-wraper default-bg home-four pb-50" id="main-home" >
  <header>
        <!-- Header Menu Area Start -->
        <div class="header-menu" id="sticky-header" style="background: #000;">
          <div class="container">
            <div class="row">
              <!-- Logo Area Start -->
              <div class="col-md-4">
                <div class="logo-img">
                  <a href="index.html"><img src="uploads/logo/slogo.png" style="width:70px;" alt=""></a>
                </div>
              </div>
              <!-- Logo Area End -->
              <!-- Menu Area Start -->
              <div class="col-md-8">
                <div class="main-menu text-right">
                  <nav>
                    <ul>
                      <li class="active"><a href="<?php echo route('home'); ?>">หน้าหลัก</a></li>
                      <li><a href="<?php echo route('member/dashboard'); ?>">สมาชิก</a>
                        <ul>
                          <li><a href="<?php echo $link_login; ?>">เข้าสู่ระบบ</a></li>
                          <li><a href="<?php echo $link_register; ?>">สมัครสมาชิก</a></li>
                          <li><a href="<?php echo $link_dashboard; ?>">สมาชิก</a></li>
                          <li><a href="<?php echo $link_deposit; ?>">เติมเงิน</a></li>
                          <li><a href="<?php echo $link_forgot; ?>">ลืมรหัสผ่าน</a></li>
                          <li><a href="<?php echo $link_logout; ?>">ออกจากระบบ</a></li>
                        </ul>
                      </li>
                      <li><a href="<?php echo $link_result; ?>">ผลรางวัล</a></li>
                      <li><a href="<?php echo $link_contact; ?>">ติดต่อเรา</a></li>
                    </ul>
                  </nav>
                </div>
              </div>
              <!-- Header Menu Area Start -->
            </div>
          </div>
          <!-- MOBILE-MENU-AREA START --> 
          <div class="mobile-menu-area">
            <div class="container">
              <div class="mobile-area">
                <div class="mobile-menu">
                  <nav id="mobile-nav">
                    <ul>
                      <li class="active"><a href="<?php echo route('home'); ?>">หน้าหลัก</a></li>
                      <li><a href="<?php echo route('member/dashboard'); ?>">สมาชิก</a>
                        <ul>
                          <li><a href="<?php echo $link_login; ?>">เข้าสู่ระบบ</a></li>
                          <li><a href="<?php echo $link_register; ?>">สมัครสมาชิก</a></li>
                          <li><a href="<?php echo $link_dashboard; ?>">สมาชิก</a></li>
                          <li><a href="<?php echo $link_deposit; ?>">เติมเงิน</a></li>
                          <li><a href="<?php echo $link_forgot; ?>">ลืมรหัสผ่าน</a></li>
                          <li><a href="<?php echo $link_logout; ?>">ออกจากระบบ</a></li>
                        </ul>
                      </li>
                      <li><a href="<?php echo $link_result; ?>">ผลรางวัล</a></li>
                      <li><a href="<?php echo $link_contact; ?>">ติดต่อเรา</a></li>
                    </ul>
                  </nav>
                </div>  
              </div>
            </div>
          </div>
          <!-- MOBILE-MENU-AREA END  -->
        </div>
        <!-- Header Menu Area Start -->
        <!-- Slider Area End -->
  </header>
</div>
