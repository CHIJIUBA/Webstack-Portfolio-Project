<?php
include('includes/config/config.php');
include('includes/classes/User.php');
include('includes/classes/Account.php');
include('includes/classes/Transaction.php');

if(!isset($_SESSION['user_id'])){
  header("location: login.php");
  exit();
}
$user = new User($con, $_SESSION['user_id']);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <!-- <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png"> -->
  <!-- <link rel="icon" type="image/png" href="assets/img/favicon.png"> -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title id="title">
    Dashborad: VioPay
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="assets1/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets1/css/paper-dashboard.css?v=2.0.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="assets1/demo/demo.css" rel="stylesheet" />
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="white" data-active-color="danger">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
      <div class="logo">
        <a href="#" class="simple-text logo-mini">
          <div class="logo-image-small">
            <img src="assets1/img/logo-small.png">
          </div>
        </a>
        <a href="#" class="simple-text logo-normal">
          VioPay
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li id="dashboard">
            <a href="dashboard1.php">
              <i class="nc-icon nc-bank"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li id="profile">
            <a href="profile1.php">
              <i class="nc-icon nc-single-02"></i>
              <p>Profile</p>
            </a>
          </li>
          <li id="fundaccount">
            <a href="fundaccount1.php">
              <i class="nc-icon nc-money-coins"></i>
              <p>Fund Account</p>
            </a>
          </li>
          <li id="viopaytransfer">
            <a href="viopaytransfer1.php">
              <i class="nc-icon nc-bulb-63"></i>
              <p>Viopay Tranfer</p>
            </a>
          </li>
          <li id="airtime">
            <a href="buyairtime.php">
              <i class="nc-icon nc-layout-11"></i>
              <p>Buy Airtime</p>
            </a>
          </li>
          <li id="banktransfer">
            <a href="transfer.php">
              <i class="nc-icon nc-money-coins"></i>
              <p>Bank Transfer</p>
            </a>
          </li>
          <li id="electricbill">
            <a href="electricbill.php">
              <i class="nc-icon nc-paper"></i>
              <p>Electric Bills</p>
            </a>
          </li>
          <!-- <li id="banktransfer.php">
            <a href="viewcert.php">
              <i class="nc-icon nc-paper"></i>
              <p>Buy Data</p>
            </a>
          </li> -->
          <!-- <li id="addadmin">
            <a href="addadmin.php">
              <i class="nc-icon nc-chart-bar-32"></i>
              <p>Add Admin</p>
            </a>
          </li> -->
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="#pablo"><?php echo $user->full_name; ?></a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <ul class="navbar-nav">
              <li class="nav-item btn-rotate dropdown">
                <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="nc-icon nc-settings-gear-65"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Some Actions</span>
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="includes/processes/processlogout.php">LogOut</a>
                  <a class="dropdown-item" href="profile1.php">Profile</a>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <!-- <div class="panel-header panel-header-lg">

  <canvas id="bigDashboardChart"></canvas>


</div> -->