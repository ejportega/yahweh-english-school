<?php 
  include_once 'includes/home/header.php';
?>
  <style>
    .navbar {
      background: #fff !important;
      border-bottom: 1px solid #e1e1e1;
    }
    #btn-login:hover {
      color: #fff;
    }
  </style>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
    <a class="navbar-brand font-weight-bold" href="#">YAHWEH ENGLISH SCHOOL</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mx-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">HOME<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="ourschool.php">OUR SCHOOL</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="course-offered.php">COURSE OFFERED</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contact-us.php">CONTACT US</a>
        </li>
      </ul>
      <ul class="navbar-nav">
        <li class="nav-item mr-2">
          <a id="btn-login" class="mt-1 btn btn-outline-dark btn-sm" data-toggle="modal" data-target="#modal-login">LOG IN</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" title="facebook"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" title="twitter"><i class="fa fa-twitter-square" aria-hidden="true"></i></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" title="instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a>
        </li>
      </ul>
    </div>
  </nav>
  <!-- Banner -->
  <div class="main-header">
    <div class="container-fluid ml-5">
      <div class="row">
        <div class="col-lg-6">
          <h1 class="font-weight-bold text-white">WELCOME TO<br>YAHWEH ENGLISH SCHOOL</h1>
          <div class="w-95">
            <p class="text-white text-justify">
            Yahweh English School was established with the combined expertise of quality and passionate teachers. 
            We aim to hone confident and fluent individuals
            in the English language through adequate practice drills and provide financial opportunities to all.
            </p>
          </div>
          <div class="w-95 mt-4">
            <button class="btn btn-lg btn-success text-center btn-block" data-toggle="modal" data-target="#modalGetStarted  ">Get Started</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include_once('includes/home/modals.php')?>
  <?php include_once 'includes/home/footer.php'; ?> 
</body>