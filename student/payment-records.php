<?php
  session_start();
  include_once("header.php");
  include_once("navbar.php");
  include_once('../includes/libs/dbh.php');
  // require 'libs/session.php';

  $dbConnection = new dbConnection();
  $conn = $dbConnection->connect();
  $studentId = $_SESSION['studentID'];
?>
<body class="fixed-nav sticky-footer" id="page-top">
	<div class="content-wrapper">
		<div class="container-fluid">
      <div class="card">
        <div class="card-header"> 
          Payment Records
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Payment date</th>
                  <th>Number of session</th>
                  <th>Total payment</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Payment date</th>
                  <th>Number of session</th>
                  <th>Total payment</th>
                </tr>
              </tfoot>
              <tbody>
               <?php
                $sql = "SELECT date, session_count, amount FROM student_payment WHERE student_id=$studentId";
                $result = $conn->query($sql);
                $rowCount = $result->num_rows;

                if ($rowCount > 0) {
                  while ($row = $result->fetch_assoc()) {
                    $paymentDate = $row['date'];
                    $paymentDate = date('F d, Y', strtotime($paymentDate));
                    $sessionCount = $row['session_count'];
                    $amount = $row['amount'];
                    echo 
                      '<tr>
                        <td>'.$paymentDate.'</td>
                        <td>'.$sessionCount.'</td>
                        <td>&#36;'.$amount.'</td>
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
      <!-- /.card -->
		</div>
		<!-- /.container-fluid -->
		<?php include_once("footer.php") ?>
	</div>
	<!-- /.content-wrapper -->
	<?php include_once("js.php") ?>
</body>
