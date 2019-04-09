<?php
  session_start();
  include_once("header.php");
  include_once("navbar.php");
  include_once("../includes/libs/dbh.php");
  // require 'libs/session.php';
  
  $dbConnection = new dbConnection();
  $conn = $dbConnection->connect();
  $studentId = $_SESSION['studentID'];

?>
<body class="fixed-nav sticky-footer" id="page-top">
	<div class="content-wrapper">
		<div class="container-fluid">
			<div class="panel panel-default">
				<div class="panel-heading">
					Weekly Report
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Teacher</th>
                    <th>Report</th>
                    <th>Date</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Teacher</th>
                    <th>Report</th>
                    <th>Date</th>
                  </tr>
                </tfoot>
                <tbody>
                  <?php
                    $sql = "SELECT CONCAT(first_name, ' ', last_name) AS name, report, cr.date FROM class_reports cr INNER JOIN teachers t 
                            WHERE cr.student_id=$studentId AND cr.teacher_id=t.teacher_id";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                      while ($row = $result->fetch_assoc()) {
                        echo  
                        '<tr>
                          <td>'.$row['name'].'</td>
                          <td>'.$row['report'].'</td>
                          <td>'.$row['date'].'</td>
                        </tr>';
                      }
                    }

                    $conn->close();
                  ?>
                </tbody>
              </table>
            </div>
            <!-- /.table-responsive -->
          </div>
          <!-- /.card-body -->    
        </div>
				<!-- panel-body -->
			</div>
			<!-- /.panel -->
		</div>
		<!-- /.container-fluid -->
		<?php include_once("footer.php") ?>
	</div>
	<!-- /.content-wrapper -->
	<?php include_once("js.php") ?>
</body>
