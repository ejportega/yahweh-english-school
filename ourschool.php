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
  <nav class="navbar navbar-expand-lg navbar-light sticky-top">
    <a class="navbar-brand font-weight-bold" href="#">YAHWEH ENGLISH SCHOOL</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mx-auto">
        <li class="nav-item">
          <a class="nav-link" href="index.php">HOME</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="#">OUR SCHOOL<span class="sr-only">(current)</span></a>
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
          <a class="nav-link" href="#"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"><i class="fa fa-twitter-square" aria-hidden="true"></i></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
        </li>
      </ul>
    </div>
  </nav>

  <div id="wrapper">
    <div class="container-fluid">
      <div class="row justify-content-center p-5"> 
        <div id="sub-header" class="col-lg-12 p-0"></div>
        <div class="col-lg-12 mt-5 mb-3">
          <h2 class="font-weight-bold">Mission</h2>
          <p class="mt-4 text-justify">Yahweh English School builds excellent reputation by providing experienced passionate teachers who can deliver mainly quality English education to all ages through online classes, allowing numerous practice drills, and helping these students to achieve English fluency and/or exceed expected grades or test results.</p>
        </div>
        <div class="col-lg-12 my-3">
          <h2 class="font-weight-bold">Vision</h2>
          <p class="mt-4 text-justify">Yahweh English School produces world class English fluent speakers and teachers to inspire the investment and confidence of our investors which promotes economic conditions enhancement to the three aforementioned most integral parts of our school-teachers, students and parents, and investors.</p>
        </div>
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </div>
  <!-- /.wrapper -->
  <?php include_once('includes/home/modals.php')?>
  <?php include_once 'includes/home/footer.php'; ?> 
</body>