<?php
    include_once('header.php');
    include_once('navbar.php');
    include_once('../includes/libs/dbh.php');
  
    $dbConnection = new dbConnection();
    $conn = $dbConnection->connect();
  
  function getReports($conn) {
    $sql = "SELECT class_reports_id, teacher_id, student_id, report, date FROM class_reports";
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
          Weekly Reports
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-sm table-striped" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Teacher</th>
                  <th>Student</th>
                  <th>Report</th>
                  <th>Date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Teacher</th>
                  <th>Student</th>
                  <th>Report</th>
                  <th>Date</th>
                  <th>Action</th>
                </tr>
              </tfoot>
              <tbody>
                <?php
                  $weeklyReport = getReports($conn);

                  if ($weeklyReport > 0) {
                    foreach ($weeklyReport AS $row) {
                      $classId = $row['class_reports_id'];
                      $teacher = getTeacher($conn, $row['teacher_id']);
                      $student = getStudent($conn, $row['student_id']);
                      $report = $row['report'];
                      $date = $row['date'];
                      echo 
                      '<tr>
                        <td>'.$teacher.'</td>
                        <td>'.$student.'</td>
                        <td>'.$report.'</td>
                        <td>'.$date.'</td>
                        <td><a class="btn btn-transparent text-danger p-0" href="delete-weekly-reports.php?id='.$classId.'" onclick="return confirm(\'Are you sure to delete this report?\')"><i class="fas fa-fw fa-trash-alt"></i>DELETE</a></td>
                      </tr>';
                    }
                  }
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