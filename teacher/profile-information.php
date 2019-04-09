<?php
  session_start();
  include_once('header.php');
	include_once('navbar.php');
	include_once('../includes/libs/dbh.php');

	$dbConnection = new dbConnection();
  $conn = $dbConnection->connect();
  $teacherId = $_SESSION['teacherID'];
?>

<body class="fixed-nav sticky-footer" id="page-top">
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          Profile Information
        </div>
        <!-- /.card-heading -->
        <div class="card-body">
					<div class="row justify-content-center">
						<div class="col-lg-12">
							<dl class="row">
<!-- Get data in database -->
<?php
  $sql = "SELECT * FROM teachers WHERE teacher_id=$teacherId";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc(); 
  echo 
  '<dt class="col-lg-2">Name:</dt>
  <dd class="col-lg-9">'.$row['first_name'].'&nbsp;'.$row['last_name'].'</dd>
  <dt class="col-lg-2">Email:</dt>
  <dd class="col-lg-9">'.$row['email'].'</dd>
  <dt class="col-lg-2">Skype:</dt>
  <dd class="col-lg-9">'.$row['skype'].'</dd>
  <dt class="col-lg-2">Age:</dt>
  <dd class="col-lg-9">'.$row['age'].'</dd>
  <dt class="col-lg-2">Country:</dt>
  <dd class="col-lg-9">'.$row['country'].'</dd>
  <dt class="col-lg-2">Join date:</dt>
  <dd class="col-lg-10">'.$row['date'].'</dd>';
?>            
              <dt class="col-lg-12">
                <a class="btn  btn-sm btn-info" href="#">
                <i class="fa fa-fw fa-key"></i>Change password</a>
              </dt>
							</dl>
							<!-- /.row -->
						</div>
						<!-- /.col-lg-6 -->
					</div>
					<!-- /.row -->
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.container-fluid -->
    <?php include_once("footer.php") ?>
  </div>
  <!-- /.content-wrapper -->
  <?php include_once("js.php") ?>
</body>