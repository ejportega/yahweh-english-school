<?php
  include_once('header.php');
  include_once('navbar.php');
  include_once('../includes/libs/dbh.php');

  $dbConenction = new dbConnection();
  $conn = $dbConenction->connect();


  function getSessions($conn) {
    $sql = "SELECT ss.session_details_id, teacher_id, student_id, end_date, start_date, session_count,
    SUM(CASE
      WHEN session_status='done' THEN 1
      END) AS used, 
    SUM(CASE 
      WHEN session_status='teacher is AWOL' OR session_status='teacher is on leave' OR session_status='uncharged' OR session_status='student is on leave' THEN 1
      END)AS uncharged,
      CASE
      	WHEN end_date < curdate() THEN 'Done'
        ELSE 'Ongoing'
      END as class_status
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

  function getTeacher($conn, $teacherId) {
    $sql = "SELECT CONCAT('id #', teacher_id, ': ', first_name, last_name) AS name FROM teachers WHERE teacher_id=$teacherId";
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
          Class Sessions
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-sm table-striped" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Teacher</th>
                  <th>Student</th>
                  <th>Total sessions</th>
                  <th>Used</th>
                  <th>Uncharged</th>
                  <th>Remaining</th>
                  <th>Start date</th>
                  <th>End date</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                <th>Teacher</th>
                  <th>Student</th>
                  <th>Total sessions</th>
                  <th>Used</th>
                  <th>Uncharged</th>
                  <th>Remaining</th>
                  <th>Start date</th>
                  <th>End date</th>
                  <th>Status</th>
                </tr>
              </tfoot>
              <tbody>
              <?php
                $classSessions = getSessions($conn);

                if ($classSessions > 0) {
                  foreach ($classSessions AS $row) {
                    $teacher = getTeacher($conn, $row['teacher_id']);
                    $student = getStudent($conn, $row['student_id']);
                    $totalSession = $row['session_count'];
                    $used = $row['used'];
                    $uncharged = $row['uncharged'];
                    $remaining = $totalSession - ($used); 
                    $startDate = $row['start_date'];
                    $endDate = $row['end_date'];
                    $status = $row['class_status'];
                    if ($uncharged === NULL) {
                      $uncharged = 0;
                    } 
                    if ($used === NULL) {
                      $used = 0;
                    }
                    $dispayStatus = '';
                    if ($status == 'Ongoing') {
                      $dispayStatus = '<td><a title="Edit schedule"class="btn btn-transparent text-info p-0" href=""><i class="far fa-fw fa-edit"></i>'.$status.'</a></td>';
                    }
                    elseif ($status == 'Done') {
                      $dispayStatus = '<td><span class="text-success">'.$status.'</td>';
                    }
                    echo 
                    '<tr>
                    <td>'.$student.'</td>
                    <td>'.$teacher.'</td>
                    <td>'.$totalSession.'</td>
                    <td>'.$used.'</td>
                    <td>'.$uncharged.'</td>
                    <td>'.$remaining.'</td>
                    <td>'.$startDate.'</td>
                    <td>'.$endDate.'</td>
                    '.$dispayStatus.'
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