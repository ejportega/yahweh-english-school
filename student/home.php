<?php
  session_start();
  include_once('header.php');
  include_once('navbar.php');
  // require 'libs/session.php';
  include_once 'libs/manage-data.php';
  
  $sid = $_SESSION['studentID'];
  $manageData = new ManageData();
  $studentInfos = $manageData->getStudentInfo($sid);
  $studSessions = $manageData->studRemainingSession($sid);

?>

<body class="fixed-nav sticky-footer" id="page-top">
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          Home
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div>
            <h1>Welcome <?php echo $studentInfos->first_name." ".$studentInfos->last_name;?></h1>
            <!-- <?php if ($studSessions) { ?>
              <strong>You're currently have <?php echo ($studSessions->session_count)-($studSessions->used);?> remaining session until <?php echo date('F j, Y', strtotime($studSessions->end_date)); ?>.</strong>
            <?php } else { ?>
               <strong>You're currently not enrolled in any class.</strong> 
            <?php } ?> -->
            <div class="embed-responsive embed-responsive-16by9">
              <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/y6Y8jq11GMU" allowfullscreen></iframe>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.container-fluid -->
    <?php include_once('footer.php'); ?>
  </div>
  <!-- /.content-wrapper -->
  <?php include_once('js.php'); ?>
</body>