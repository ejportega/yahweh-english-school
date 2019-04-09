<?php
    include_once('header.php');
    include_once('navbar.php');
    include_once('../includes/libs/dbh.php');
  
    $dbConnection = new dbConnection();
    $conn = $dbConnection->connect();

  function hourBalance($conn) {
    $sql = "SELECT student_id, ss.session_details_id, end_date, start_date, session_count,
    SUM(CASE
      WHEN session_status='done' THEN 1
      END) AS used, 
    SUM(CASE 
      WHEN session_status='teacher is AWOL' OR session_status='teacher is on leave' OR session_status='uncharged' OR session_status='student is on leave' THEN 1
      END)AS uncharged
    FROM session_schedules ss
    INNER JOIN session_details sd
    WHERE sd.session_details_id=ss.session_details_id
    GROUP BY ss.session_details_id, end_date, start_date, session_count";
    $result = $conn->query($sql);
    $rowCount = $result->num_rows;

    if ($rowCount > 0) {
      while ($row = $result->fetch_assoc()) {
        $data[] = $row;
      }
      return $data;
    }
    else {
      return $rowCount;
    }
  }

  function getStudent($conn, $studentId) {
    $sql = "SELECT CONCAT('id #', student_id, ': ', first_name, last_name) AS name FROM students WHERE student_id=$studentId";
    $result = $conn->query($sql);
    $rowCount = $result->num_rows;

    if ($rowCount > 0) {
      if ($row = $result->fetch_assoc()) {
        return $row['name'];
      }
    } 
    else {
      return $rowCount;
    }
  }
?>
<body class="fixed-nav sticky-footer" id="page-top">
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          Student Hour Balance
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-sm table-striped" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Student</th>
                  <th>Start date</th>
                  <th>Total sessions</th>
                  <th>Used</th>
                  <th>Uncharged</th>
                  <th>Remaining</th>
                  <th>End date</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Student</th>
                  <th>Start date</th>
                  <th>Total sessions</th>
                  <th>Used</th>
                  <th>Uncharged</th>
                  <th>Remaining</th>
                  <th>End date</th>
                </tr>
              </tfoot>
              <tbody>
              <?php
                $hourBalanceArr = hourBalance($conn);

                if ($hourBalanceArr > 0) {
                  foreach ($hourBalanceArr AS $row) {
                    $studentId = $row['student_id'];
                    $student = getStudent($conn, $studentId);
                    $startDate = $row['start_date'];
                    $endDate = $row['end_date'];
                    $totalSession = $row['session_count'];
                    $used = $row['used'];
                    $uncharged = $row['uncharged'];
                    $remaining = $totalSession - ($used);  
                    if ($uncharged === NULL) {
                      $uncharged = 0;
                    }
                    if ($used === NULL) {
                      $used = 0;
                    }
                      echo
                    '<tr>
                    <td>'.$student.'</td> 
                    <td>'.$startDate.'</td>
                    <td>'.$totalSession.'</td>
                    <td>'.$used.'</td>
                    <td>'.$uncharged.'</td> 
                    <td>'.$remaining.'</td>
                    <td>'.$endDate.'</td></tr>';
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