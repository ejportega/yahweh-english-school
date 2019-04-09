<?php
  include_once 'libs/session.php';
?> 
<!-- Navigation-->
<style>
  /* .navbar > a {
    color: white !important;
  }
  #logout, #logout > i {
    color: white !important;
  } */
</style>
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" id="mainNav">
<a class="navbar-brand" href="index.html">Student</a>
<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarResponsive">
  <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Home">
      <a class="nav-link" href="home.php">
        <!-- <i class="fa fa-fw fa-dashboard"></i> -->
        <i class="fa fa-fw fa-home" aria-hidden="true"></i>
        <span class="nav-link-text">Home</span>
      </a>
    </li>
    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="My Account">
      <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#MyAccount" data-parent="#exampleAccordion">
        <i class="fa fa-fw fa-user" aria-hidden="true"></i>
        <span class="nav-link-text">My Profile</span>
      </a>
      <ul class="sidenav-second-level collapse" id="MyAccount">
        <li>
          <a href="application-details.php">Application Form</a>
        </li>
        <li>
          <a href="profile-information.php">Profile Information</a>
        </li>
      </ul>
    </li>
    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Weekly Schedule">
      <a class="nav-link" href="weekly-schedule.php">
        <i class="fa fa-fw fa-calendar" aria-hidden="true"></i>
        <span class="nav-link-text">Weekly Schedule</span>
      </a>
    </li>
    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Payment">
      <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#Payment" data-parent="#exampleAccordion">
        <i class="fas fa-fw fa-money-bill-alt"></i>
        <span class="nav-link-text">Payment</span>
      </a>
      <ul class="sidenav-second-level collapse" id="Payment">
        <li>
          <a href="make-payment.php">Make Payment</a>
        </li>
        <li>
          <a href="payment-records.php">Payment Records</a>
        </li>
        <li>
          <a href="hour-balance.php">Hour Balance</a>
        </li>
      </ul>
    </li>    
    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Weekly Report">
      <a class="nav-link" href="weekly-report.php">
        <i class="fa fa-fw fa-tasks" aria-hidden="true"></i>
        <span class="nav-link-text">Weekly Report</span>
      </a>
    </li>
    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Notification">
      <a class="nav-link" href="notifications.php">
        <i class="fas fa-fw fa-bell"></i>
        <span class="nav-link-text">Notification</span>
      </a>
    </li>
    <!-- <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
      <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
        <i class="fa fa-fw fa-wrench"></i>
        <span class="nav-link-text">Components</span>
      </a>
      <ul class="sidenav-second-level collapse" id="collapseComponents">
        <li>
          <a href="navbar.html">Navbar</a>
        </li>
        <li>
          <a href="cards.html">Cards</a>
        </li>
      </ul>
    </li>
    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Example Pages">
      <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExamplePages" data-parent="#exampleAccordion">
        <i class="fa fa-fw fa-file"></i>
        <span class="nav-link-text">Example Pages</span>
      </a>
      <ul class="sidenav-second-level collapse" id="collapseExamplePages">
        <li>
          <a href="login.html">Login Page</a>
        </li>
        <li>
          <a href="register.html">Registration Page</a>
        </li>
        <li>
          <a href="forgot-password.html">Forgot Password Page</a>
        </li>
        <li>
          <a href="blank.html">Blank Page</a>
        </li>
      </ul>
    </li>
    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Menu Levels">
      <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti" data-parent="#exampleAccordion">
        <i class="fa fa-fw fa-sitemap"></i>
        <span class="nav-link-text">Menu Levels</span>
      </a>
      <ul class="sidenav-second-level collapse" id="collapseMulti">
        <li>
          <a href="#">Second Level Item</a>
        </li>
        <li>
          <a href="#">Second Level Item</a>
        </li>
        <li>
          <a href="#">Second Level Item</a>
        </li>
        <li>
          <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti2">Third Level</a>
          <ul class="sidenav-third-level collapse" id="collapseMulti2">
            <li>
              <a href="#">Third Level Item</a>
            </li>
            <li>
              <a href="#">Third Level Item</a>
            </li>
            <li>
              <a href="#">Third Level Item</a>
            </li>
          </ul>
        </li>
      </ul>
    </li>
    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Link">
      <a class="nav-link" href="#">
        <i class="fa fa-fw fa-link"></i>
        <span class="nav-link-text">Link</span>
      </a>
    </li> -->
  </ul>
  <ul class="navbar-nav sidenav-toggler">
    <li class="nav-item">
      <a class="nav-link text-center" id="sidenavToggler">
        <i class="fa fa-fw fa-angle-left"></i>
      </a>
    </li>
  </ul>
  <ul class="navbar-nav ml-auto">
    <!-- <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle mr-lg-2" id="messagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-fw fa-envelope"></i>
        <span class="d-lg-none">Messages
          <span class="badge badge-pill badge-primary">12 New</span>
        </span>
        <span class="indicator text-primary d-none d-lg-block">
          <i class="fa fa-fw fa-circle"></i>
        </span>
      </a>
      <div class="dropdown-menu" aria-labelledby="messagesDropdown">
        <h6 class="dropdown-header">New Messages:</h6>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#">
          <strong>David Miller</strong>
          <span class="small float-right text-muted">11:21 AM</span>
          <div class="dropdown-message small">Hey there! This new version of SB Admin is pretty awesome! These messages clip off when they reach the end of the box so they don't overflow over to the sides!</div>
        </a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#">
          <strong>Jane Smith</strong>
          <span class="small float-right text-muted">11:21 AM</span>
          <div class="dropdown-message small">I was wondering if you could meet for an appointment at 3:00 instead of 4:00. Thanks!</div>
        </a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#">
          <strong>John Doe</strong>
          <span class="small float-right text-muted">11:21 AM</span>
          <div class="dropdown-message small">I've sent the final files over to you for review. When you're able to sign off of them let me know and we can discuss distribution.</div>
        </a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item small" href="#">View all messages</a>
      </div>
    </li> -->
    <!-- <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-fw fa-bell"></i>
        <span class="d-lg-none">Alerts
          <span class="badge badge-pill badge-warning">6 New</span>
        </span>
        <span class="indicator text-warning d-none d-lg-block">
          <i class="fa fa-fw fa-circle"></i>
        </span>
      </a>
      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
        <h6 class="dropdown-header">New Alerts:</h6>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#">
          <span class="text-success">
            <strong>
              <i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>
          </span>
          <span class="small float-right text-muted">11:21 AM</span>
          <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
        </a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#">
          <span class="text-danger">
            <strong>
              <i class="fa fa-long-arrow-down fa-fw"></i>Status Update</strong>
          </span>
          <span class="small float-right text-muted">11:21 AM</span>
          <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
        </a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#">
          <span class="text-success">
            <strong>
              <i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>
          </span>
          <span class="small float-right text-muted">11:21 AM</span>
          <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
        </a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item small" href="#">View all alerts</a>
      </div>
    </li> -->
    <!-- <li class="nav-item">
      <form class="form-inline my-2 my-lg-0 mr-lg-2">
        <div class="input-group">
          <input class="form-control" type="text" placeholder="Search for...">
          <span class="input-group-btn">
            <button class="btn btn-primary" type="button">
              <i class="fa fa-search"></i>
            </button>
          </span>
        </div>
      </form>
    </li> -->
    <li class="nav-item">
      <!-- <a id="logout" href="../login-student.php" class="nav-link" data-toggle="modal" data-target="#exampleModal"> -->
      <a id="logout" class="nav-link" data-toggle="modal" data-target="#logout-modal">
        <i class="fas fa-fw fa-sign-out-alt"></i>Logout</a>
    </li>
  </ul>
</div>
</nav>

<!-- logout modal -->
<div id="logout-modal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ready to Leave?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Select "Logout" below if you are ready to end you current session.</p>
      </div>
      <div class="modal-footer">
        <a class="btn btn-primary" href="logout.php">Logout</a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

