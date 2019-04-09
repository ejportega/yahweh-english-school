<?php
  include_once('header.php');
  include_once('navbar.php');
  include_once('../includes/libs/dbh.php');

  $dbConenction = new dbConnection();
  $conn = $dbConenction->connect();

  function getStudentName($conn, $studentId) {
    $sql = "SELECT concat(first_name, ' ', last_name) AS name FROM students WHERE student_id=$studentId";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    return $row['name'];
  }

  function isScheduled($conn, $studentId, $sessionCount, $paymentId) {
    $sql = "SELECT student_id,
    CASE
      WHEN end_date < curdate() THEN 'CLASS COMPLETED'
      WHEN end_date >= curdate() THEN 'ENROLLED'
    END AS status
    FROM session_details WHERE payment_id = $paymentId";
    $result = $conn->query($sql);
    $rowCount = $result->num_rows;
   
    if ($rowCount > 0) {
      if ($row = $result->fetch_assoc()) {
        if (strcasecmp($row['status'], 'class completed') == 0) {
          $data = '<td class="text-success">Class compeleted</td>';
        }
        elseif (strcasecmp($row['status'], 'enrolled') == 0) {
          $data = '<td class="text-success">Enrolled</td>';
        }
      }
    }
    else {
      $data = '<td><a href="booking.php?studentId='.$studentId.'&session='.$sessionCount.'&paymentId='.$paymentId.'" class="text-danger">Not yet enrolled</a></td>';
    }
    return $data;
  }
?>

<body class="fixed-nav sticky-footer" id="page-top">
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          Student's Payment
        </div>
        <!-- /.card-header -->
        <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-sm table-striped" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Payment date</th>
                  <th>Student</th>
                  <th>Number of session</th>
                  <th>Amount</th>
                  <th>Type</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Payment date</th>
                  <th>Student</th>
                  <th>Number of session</th>
                  <th>Amount</th>
                  <th>Type</th>
                  <th>Status</th>
                </tr>
              </tfoot>
              <tbody>
<!-- PHP -->
<?php
  

  $sql = "SELECT * FROM student_payment";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $date = $row['date'];
      $studentId = $row['student_id'];
      $sessionCount = $row['session_count'];
      $amount = $row['amount'];
      $paymentId = $row['payment_id'];
      $type = $row['type'];
      echo
        '<tr>
          <td>'.$date.'</td>
          <td>id #'.$studentId.':&nbsp;'.getStudentName($conn, $studentId).'</td>
          <td>'.$sessionCount.'</td>
          <td>&#36;'.$amount.'</td>
          <td>'.$type.' </td>
          '.isScheduled($conn, $studentId, $sessionCount, $paymentId).'
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
    <?php include_once('footer.php'); ?>
  </div>
  <!-- /.content-wrapper -->
  <?php include_once('js.php'); ?>
</body>