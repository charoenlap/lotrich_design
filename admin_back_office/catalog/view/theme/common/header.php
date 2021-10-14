<?php  
if (!isset($_SESSION['id_admin'])) {
  header('location:index.php?route=home/login');
  exit();
}
?>
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- <title><?php echo $title;?></title> -->
  <meta name="robots" content="noindex, nofollow">
  <link href="assets/boostrap_jquery/css/bootstrap.css" rel="stylesheet" >
  <link href="assets/css/sidebar.css" rel="stylesheet">
  <link href="assets/css/main.css" rel="stylesheet">
  <link href="assets/css/main.css" rel="stylesheet">
  <link href="assets/fontawesome/css/fontawesome.css" rel="stylesheet">
  <?php if(isset($style)){ 
      foreach ($style as $key => $value) { ?>
    <link rel="stylesheet" href="<?php echo $value;?>">
  <?php } } ?>
  <script src="assets/boostrap_jquery/js/jquery.js"></script>
  <script src="assets/boostrap_jquery/js/popper.js"></script>
  <script src="assets/boostrap_jquery/js/bootstrap.js"></script>
  <script src="assets/js/main.js"></script>

  <!-- Custom styles for this template -->
  <script src="assets/fontawesome/js/all.js"></script>
  <?php 
  if(isset($script)){
  foreach ($script as $key => $value) { ?>
    <script src="<?php echo $value;?>"></script>
  <?php } } ?>
</head>
<body class="<?php echo (isset($class_body)?$class_body:'animsition site-navbar-small dashboard mm-wrapper site-menubar-fold site-navbar dashboard'); ?>">
<!--[if lt IE 8]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]--> 
  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="menu-left" id="sidebar-wrapper">
      <div class="sidebar-heading text-theme text-center">
        <img src="../uploads/logo/slogo.png" alt="" width="100"></div>
      <div class="list-group menu-list list-group-flush">
        <a href="<?php echo route('home'); ?>" class="list-group-item list-group-item-action active"> หน้าหลัก</a>
        <a href="<?php echo route('lotto'); ?>" class="list-group-item list-group-item-action"> จัดการหวย</a>
        <a href="<?php echo route('tranfer'); ?>" class="list-group-item list-group-item-action"> แจ้งฝาก (5) /ถอน (3)</a>
        <a href="<?php echo route('deposit'); ?>" class="list-group-item list-group-item-action"> การฝาก</a>
        <a href="<?php echo route('widthdraw'); ?>" class="list-group-item list-group-item-action"> การถอน</a>
        <a href="<?php echo route('customer'); ?>" class="list-group-item list-group-item-action"> ลูกค้า</a>
        <a href="<?php echo route('system'); ?>" class="list-group-item list-group-item-action"> จัดการระบบ</a>
        <!-- <a href="<?php echo route('customer/home'); ?>" id="customer" class="list-group-item list-group-item-action"> ลูกค้า</a>
        <a href="<?php echo route('company/home'); ?>" id="company" class="list-group-item list-group-item-action"> บริษัท</a>
        <a href="<?php echo route('package/home'); ?>" id="package" class="list-group-item list-group-item-action"> แพคเกจ</a>
        <a href="<?php echo route('payment/home'); ?>" id="payment" class="list-group-item list-group-item-action"> แจ้งชำระเงิน</a> -->
        <!-- <a href="<?php echo route('blog/home'); ?>" id="blog" class="list-group-item list-group-item-action"> Blog</a> -->
      </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light">
        <a id="menu-toggle" href="#" style="color: #999;"><i class="fas fa-bars fa-2x"></i></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home </a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Member
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <!-- <a class="dropdown-item" href="#">Profile</a> -->
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo route('home/logout'); ?>">Logout</a>
              </div>
            </li>
          </ul>
        </div>
      </nav>