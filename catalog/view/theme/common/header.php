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

  <script src="assets/theme/ftage/js/vendor/jquery-3.6.0.min.js"></script>
  <script src="assets/theme/ftage/js/vendor/jquery-migrate-3.3.2.min.js"></script>
  
  <script src="assets/theme/ftage/js/popper.min.js"></script>
  <script src="assets/theme/ftage/js/bootstrap.min.js"></script>
  <?php 
  if(isset($script)){
  foreach ($script as $key => $value) { ?>
    <script src="<?php echo $value;?>"></script>
  <?php } } ?>
</head>
<body class="<?php echo (isset($class_body)?$class_body:''); ?> ">
<!--[if lt IE 8]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="#"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item active">
            <a class="nav-link" href="<?php echo route('home'); ?>">หน้าหลัก <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              สมาชิก
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="<?php echo $link_login; ?>">เข้าสู่ระบบ</a>
              <a class="dropdown-item" href="<?php echo $link_register; ?>">สมัครสมาชิก</a>
              <a class="dropdown-item" href="<?php echo $link_dashboard; ?>">สมาชิก</a>
              <a class="dropdown-item" href="<?php echo $link_deposit; ?>">เติมเงิน</a>
              <a class="dropdown-item" href="<?php echo $link_forgot; ?>">ลืมรหัสผ่าน</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">ออกจากระบบ</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo $link_result; ?>">ผลรางวัล</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo $link_contact; ?>">ติดต่อเรา</a>
          </li>
        </ul>
      </div>
    </nav>