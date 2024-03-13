<?php

if (isset($_SESSION["user_id"])) {
    
    $mysqli = require __DIR__ . "/db.php";
    
    $sql = "SELECT * FROM users
            WHERE id = {$_SESSION["user_id"]}";
            
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
}

if (isset($_SESSION["admins_id"])) {
    
  $mysqli2 = require __DIR__ . "/db.php";
  
  $sql2 = "SELECT * FROM admins
          WHERE id = {$_SESSION["admins_id"]}";
          
  $result2 = $mysqli2->query($sql2);
  
  $admin = $result2->fetch_assoc();
}

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">

    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link rel="icon" href="images/favicon.ico">

    <link rel="stylesheet" href="css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
    <!-- Style -->
    <style>
    body {
    font-family: "Open Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
    background-color: #fff;
    /* height: 200vh; */
    position: relative; }
    body:before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: rgba(0, 0, 0, 0.5);
      -webkit-transition: .3s all ease;
      -o-transition: .3s all ease;
      transition: .3s all ease;
      opacity: 0;
      visibility: hidden;
      z-index: 1; }
    body.offcanvas-menu:before {
      opacity: 1;
      z-index: 2000;
      visibility: visible; }
  
  p {
    color: #b3b3b3;
    font-weight: 300; }
  

  a {
    -webkit-transition: .3s all ease;
    -o-transition: .3s all ease;
    transition: .3s all ease; }
    a, a:hover {
      text-decoration: none !important; }
  
  .top-bar {
    padding: .5rem 0;
    background: #eee; }
    .top-bar a {
      color: #666666; }
  
  .site-navbar {
    margin-bottom: 0px;
    z-index: 1999;
    position: relative;
    width: 100%;
    padding: 1rem; }
    @media (max-width: 991.98px) {
      .site-navbar {
        padding-top: 3rem;
        padding-bottom: 3rem; } }
    .site-navbar .toggle-button {
      position: absolute;
      right: 0px; }
    .site-navbar .site-logo {
      position: absolute;
      font-size: 2rem;
      text-transform: uppercase;
      font-weight: 900;
      line-height: 0;
      margin: 0;
      padding: 0;
      z-index: 3; }
      @media (max-width: 991.98px) {
        .site-navbar .site-logo {
          float: left;
          position: relative; } }
    .site-navbar .site-navigation.border-bottom {
      border-bottom: 1px solid white !important; }
    .site-navbar .site-navigation .site-menu {
      margin-bottom: 0; }
      .site-navbar .site-navigation .site-menu .active {
        color: #007bff !important; }
      .site-navbar .site-navigation .site-menu a {
        text-decoration: none !important;
        display: inline-block; }
      .site-navbar .site-navigation .site-menu > li {
        display: inline-block; }
        .site-navbar .site-navigation .site-menu > li > a {
          margin-left: 15px;
          margin-right: 15px;
          padding: 20px 0px;
          color: #000 !important;
          display: inline-block;
          text-decoration: none !important; }
          .site-navbar .site-navigation .site-menu > li > a:hover {
            color: #007bff; }
      .site-navbar .site-navigation .site-menu .has-children {
        position: relative; }
        .site-navbar .site-navigation .site-menu .has-children > a {
          position: relative;
          padding-right: 20px; }
          .site-navbar .site-navigation .site-menu .has-children > a:before {
            position: absolute;
            content: "\e313";
            font-size: 16px;
            top: 50%;
            right: 0;
            -webkit-transform: translateY(-50%);
            -ms-transform: translateY(-50%);
            transform: translateY(-50%);
            font-family: 'icomoon'; }
        .site-navbar .site-navigation .site-menu .has-children .dropdown {
          visibility: hidden;
          opacity: 0;
          top: 100%;
          position: absolute;
          text-align: left;
          border-top: 2px solid #007bff;
          -webkit-box-shadow: 0 2px 10px -2px rgba(0, 0, 0, 0.1);
          box-shadow: 0 2px 10px -2px rgba(0, 0, 0, 0.1);
          padding: 0px 0;
          margin-top: 20px;
          margin-left: 0px;
          background: #fff;
          -webkit-transition: 0.2s 0s;
          -o-transition: 0.2s 0s;
          transition: 0.2s 0s; }
          .site-navbar .site-navigation .site-menu .has-children .dropdown.arrow-top {
            position: absolute; }
            .site-navbar .site-navigation .site-menu .has-children .dropdown.arrow-top:before {
              display: none;
              bottom: 100%;
              left: 20%;
              border: solid transparent;
              content: " ";
              height: 0;
              width: 0;
              position: absolute;
              pointer-events: none; }
            .site-navbar .site-navigation .site-menu .has-children .dropdown.arrow-top:before {
              border-color: rgba(136, 183, 213, 0);
              border-bottom-color: #fff;
              border-width: 10px;
              margin-left: -10px; }
          .site-navbar .site-navigation .site-menu .has-children .dropdown a {
            text-transform: none;
            letter-spacing: normal;
            -webkit-transition: 0s all;
            -o-transition: 0s all;
            transition: 0s all;
            color: #000 !important; }
            .site-navbar .site-navigation .site-menu .has-children .dropdown a.active {
              color: #007bff !important;
              background: #f8f9fa; }
          .site-navbar .site-navigation .site-menu .has-children .dropdown > li {
            list-style: none;
            padding: 0;
            margin: 0;
            min-width: 200px; }
            .site-navbar .site-navigation .site-menu .has-children .dropdown > li > a {
              padding: 9px 20px;
              display: block; }
              .site-navbar .site-navigation .site-menu .has-children .dropdown > li > a:hover {
                background: #f8f9fa;
                color: #ced4da; }
            .site-navbar .site-navigation .site-menu .has-children .dropdown > li.has-children > a:before {
              content: "\e315";
              right: 20px; }
            .site-navbar .site-navigation .site-menu .has-children .dropdown > li.has-children > .dropdown, .site-navbar .site-navigation .site-menu .has-children .dropdown > li.has-children > ul {
              left: 100%;
              top: 0; }
            .site-navbar .site-navigation .site-menu .has-children .dropdown > li.has-children:hover > a, .site-navbar .site-navigation .site-menu .has-children .dropdown > li.has-children:active > a, .site-navbar .site-navigation .site-menu .has-children .dropdown > li.has-children:focus > a {
              background: #f8f9fa;
              color: #ced4da; }
        .site-navbar .site-navigation .site-menu .has-children:hover > a, .site-navbar .site-navigation .site-menu .has-children:focus > a, .site-navbar .site-navigation .site-menu .has-children:active > a {
          color: #007bff; }
        .site-navbar .site-navigation .site-menu .has-children:hover, .site-navbar .site-navigation .site-menu .has-children:focus, .site-navbar .site-navigation .site-menu .has-children:active {
          cursor: pointer; }
          .site-navbar .site-navigation .site-menu .has-children:hover > .dropdown, .site-navbar .site-navigation .site-menu .has-children:focus > .dropdown, .site-navbar .site-navigation .site-menu .has-children:active > .dropdown {
            -webkit-transition-delay: 0s;
            -o-transition-delay: 0s;
            transition-delay: 0s;
            margin-top: 0px;
            visibility: visible;
            opacity: 1; }
  
  .site-mobile-menu {
    width: 300px;
    position: fixed;
    right: 0;
    z-index: 2000;
    padding-top: 20px;
    background: #fff;
    height: calc(100vh);
    -webkit-transform: translateX(110%);
    -ms-transform: translateX(110%);
    transform: translateX(110%);
    -webkit-box-shadow: -10px 0 20px -10px rgba(0, 0, 0, 0.1);
    box-shadow: -10px 0 20px -10px rgba(0, 0, 0, 0.1);
    -webkit-transition: .3s all ease-in-out;
    -o-transition: .3s all ease-in-out;
    transition: .3s all ease-in-out; }
    .offcanvas-menu .site-mobile-menu {
      -webkit-transform: translateX(0%);
      -ms-transform: translateX(0%);
      transform: translateX(0%); }
    .site-mobile-menu .site-mobile-menu-header {
      width: 100%;
      float: left;
      padding-left: 20px;
      padding-right: 20px; }
      .site-mobile-menu .site-mobile-menu-header .site-mobile-menu-close {
        float: right;
        margin-top: 8px; }
        .site-mobile-menu .site-mobile-menu-header .site-mobile-menu-close span {
          font-size: 30px;
          display: inline-block;
          padding-left: 10px;
          padding-right: 0px;
          line-height: 1;
          cursor: pointer;
          -webkit-transition: .3s all ease;
          -o-transition: .3s all ease;
          transition: .3s all ease; }
          .site-mobile-menu .site-mobile-menu-header .site-mobile-menu-close span:hover {
            color: #ced4da; }
      .site-mobile-menu .site-mobile-menu-header .site-mobile-menu-logo {
        float: left;
        margin-top: 10px;
        margin-left: 0px; }
        .site-mobile-menu .site-mobile-menu-header .site-mobile-menu-logo a {
          display: inline-block;
          text-transform: uppercase; }
          .site-mobile-menu .site-mobile-menu-header .site-mobile-menu-logo a img {
            max-width: 70px; }
          .site-mobile-menu .site-mobile-menu-header .site-mobile-menu-logo a:hover {
            text-decoration: none; }
    .site-mobile-menu .site-mobile-menu-body {
      overflow-y: scroll;
      -webkit-overflow-scrolling: touch;
      position: relative;
      padding: 0 20px 20px 20px;
      height: calc(100vh - 52px);
      padding-bottom: 150px; }
    .site-mobile-menu .site-nav-wrap {
      padding: 0;
      margin: 0;
      list-style: none;
      position: relative; }
      .site-mobile-menu .site-nav-wrap a {
        padding: 10px 20px;
        display: block;
        position: relative;
        color: #212529; }
        .site-mobile-menu .site-nav-wrap a:hover {
          color: #007bff; }
      .site-mobile-menu .site-nav-wrap li {
        position: relative;
        display: block; }
        .site-mobile-menu .site-nav-wrap li .nav-link.active {
          color: #007bff; }
      .site-mobile-menu .site-nav-wrap .arrow-collapse {
        position: absolute;
        right: 0px;
        top: 10px;
        z-index: 20;
        width: 36px;
        height: 36px;
        text-align: center;
        cursor: pointer;
        border-radius: 50%; }
        .site-mobile-menu .site-nav-wrap .arrow-collapse:hover {
          background: #f8f9fa; }
        .site-mobile-menu .site-nav-wrap .arrow-collapse:before {
          font-size: 12px;
          z-index: 20;
          font-family: "icomoon";
          content: "\f078";
          position: absolute;
          top: 50%;
          left: 50%;
          -webkit-transform: translate(-50%, -50%) rotate(-180deg);
          -ms-transform: translate(-50%, -50%) rotate(-180deg);
          transform: translate(-50%, -50%) rotate(-180deg);
          -webkit-transition: .3s all ease;
          -o-transition: .3s all ease;
          transition: .3s all ease; }
        .site-mobile-menu .site-nav-wrap .arrow-collapse.collapsed:before {
          -webkit-transform: translate(-50%, -50%);
          -ms-transform: translate(-50%, -50%);
          transform: translate(-50%, -50%); }
      .site-mobile-menu .site-nav-wrap > li {
        display: block;
        position: relative;
        float: left;
        width: 100%; }
        .site-mobile-menu .site-nav-wrap > li > a {
          padding-left: 20px;
          font-size: 20px; }
        .site-mobile-menu .site-nav-wrap > li > ul {
          padding: 0;
          margin: 0;
          list-style: none; }
          .site-mobile-menu .site-nav-wrap > li > ul > li {
            display: block; }
            .site-mobile-menu .site-nav-wrap > li > ul > li > a {
              padding-left: 40px;
              font-size: 16px; }
            .site-mobile-menu .site-nav-wrap > li > ul > li > ul {
              padding: 0;
              margin: 0; }
              .site-mobile-menu .site-nav-wrap > li > ul > li > ul > li {
                display: block; }
                .site-mobile-menu .site-nav-wrap > li > ul > li > ul > li > a {
                  font-size: 16px;
                  padding-left: 60px; }
      .site-mobile-menu .site-nav-wrap[data-class="social"] {
        float: left;
        width: 100%;
        margin-top: 30px;
        padding-bottom: 5em; }
        .site-mobile-menu .site-nav-wrap[data-class="social"] > li {
          width: auto; }
          .site-mobile-menu .site-nav-wrap[data-class="social"] > li:first-child a {
            padding-left: 15px !important; }
  
  .sticky-wrapper {
    position: relative;
    z-index: 100;
    width: 100%; }
    .sticky-wrapper .site-navbar {
      -webkit-transition: .3s all ease;
      -o-transition: .3s all ease;
      transition: .3s all ease; }
    .sticky-wrapper .site-navbar {
      background: #fff; }
      .sticky-wrapper .site-navbar .site-logo a {
        color: #fff; }
      .sticky-wrapper .site-navbar ul li a {
        color: rgba(255, 255, 255, 0.7) !important; }
        .sticky-wrapper .site-navbar ul li a.active {
          color: #fff !important; }
    .sticky-wrapper.is-sticky .site-navbar {
      background: #fff;
      -webkit-box-shadow: 4px 0 20px -5px rgba(0, 0, 0, 0.2);
      box-shadow: 4px 0 20px -5px rgba(0, 0, 0, 0.2); }
      .sticky-wrapper.is-sticky .site-navbar .site-logo a {
        color: #007bff; }
      .sticky-wrapper.is-sticky .site-navbar ul li a {
        color: #000 !important; }
        .sticky-wrapper.is-sticky .site-navbar ul li a.active {
          color: #007bff !important; }
    .sticky-wrapper .shrink {
      padding-top: 0px !important;
      padding-bottom: 0px !important; }
      @media (max-width: 991.98px) {
        .sticky-wrapper .shrink {
          padding-top: 30px !important;
          padding-bottom: 30px !important; } }
  /* @extend display-flex; */

</style>
  </head>
  <body>


    <div class="site-mobile-menu site-navbar-target">
        <div class="site-mobile-menu-header">
          <div class="site-mobile-menu-close mt-3">
            <span class="icon-close2 js-menu-toggle"></span>
          </div>
        </div>
        <div class="site-mobile-menu-body"></div>
      </div>

      <header class="site-navbar js-sticky-header site-navbar-target" role="banner">

        <div class="container">
          <div class="row align-items-center position-relative">


            <div class="site-logo">
            <a href="index.php"><img width="100px" height="auto" src="images/about.jpg"></a>
            </div>

            <div class="col-12">
              <nav class="site-navigation text-right ml-auto " role="navigation">

                <ul class="site-menu main-menu js-clone-nav ml-auto d-none d-lg-block">
                  <li><a href="index.php" class="nav-link">Home</a></li>
                  <!-- <li><a href="#services-section" class="nav-link">Services</a></li>


                  <li class="has-children">
                    <a href="#about-section" class="nav-link">About Us</a>
                    <ul class="dropdown arrow-top">
                      <li><a href="#team-section" class="nav-link">Team</a></li>
                      <li><a href="#pricing-section" class="nav-link">Pricing</a></li>
                      <li><a href="#faq-section" class="nav-link">FAQ</a></li>
                    </ul>
                  </li>

                  <li><a href="#why-us-section" class="nav-link">Why Us</a></li>

                  <li><a href="#testimonials-section" class="nav-link">Testimonials</a></li>
                  <li><a href="#blog-section" class="nav-link">Blog</a></li> -->
                  <?php if (isset($user)): ?>
                    <li><a href="dashboard.php" class="nav-link">Dashboard</a></li>
                  <?php else: ?>
                    <li><a href="signup.php" class="nav-link">Signup</a></li>
                  <?php endif; ?>
                  <?php if (isset($admin)): ?>
                    <li><a href="admindashboard.php" class="nav-link">Admin Dashboard</a></li>
                  <?php endif; ?>
                </ul>
              </nav>

            </div>

            <div class="toggle-button d-inline-block d-lg-none"><a href="#" class="site-menu-toggle py-5 js-menu-toggle text-black"><span class="icon-menu h3"></span></a></div>

          </div>
        </div>

      </header>

    

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.sticky.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>