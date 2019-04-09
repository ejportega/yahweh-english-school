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
        <li class="nav-item">
          <a class="nav-link" href="ourschool.php">OUR SCHOOL</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="course-offered.php">COURSE OFFERED</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="#">CONTACT US<span class="sr-only">(current)</span></a>
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
          <h2 class="font-weight-bold">Greetings!</h2>
          <p class="mt-4 text-justify">We are a group of professional teacheres who teach students from pre-beginner to advanced levels. We teach phonics, reading, vocalbulary, Businesse English based on CEFR or an international standard for describing language ability, Medical Englilsh, news reports, etc. Tyr our free 25 minute demo class and send me a message in Skype at aimhigh.englishschool or email me at aimhigh.englishschool@yahoo.com / aimhigh.englishschool@gmail.com.</p>
          <p class="mt-4 text-justify">We receive payments through www.paypal.com.</p>
          <p class="mt-4 text-justify">See our homepage and tons of positive feedback we received from our students. See you!.</p>
        </div>
        <div class="col-lg-12 my-3">
          <h2 class="font-weight-bold">Quick Inquiry</h2> 
          <div class="col-12 p-4 text-center" style="background:#d9d9d9;">
            <form action="">
            <div class="row justify-content-center">
              <div class="col-lg-5">
                <div class="form-group">
                  <input class="form-control-lg w-100" type="text" name="name"  placeholder="Your name" required>
                </div>
                <div class="form-group">
                  <input class="form-control-lg w-100" type="email" name="email"  placeholder="Your email" required>
                </div>
                <div class="form-group">
                  <input class="form-control-lg w-100" type="text" name="contact_number"  placeholder="Your contact number" required>
                </div>
              </div>
              <div class="col-lg-5">
                <div class="form-group">
                  <textarea name="message" class="form-control-lg w-100" cols="30" rows="3" placeholder="Your message"></textarea>
                </div>
                <div class="form-group">
                  <input class="btn btn-block btn-success btn-lg" type="submit" name="submit" value="SEND INQUIRY">
                </div>
              </div>
            </div>
            </form>
          </div>
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