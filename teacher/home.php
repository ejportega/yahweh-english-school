<?php
  session_start();
  include_once('header.php');
  include_once('navbar.php');
  // require 'libs/session.php';
  include_once 'libs/manage-data.php';
  
  $tid = $_SESSION['teacherID'];
  $manageData = new ManageData();
  $teacherInfos = $manageData->getTeacherInfo($tid);

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
            <h1>Welcome <?php echo $teacherInfos->first_name." ".$teacherInfos->last_name;?></h1>
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