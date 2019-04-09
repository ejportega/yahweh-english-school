<?php
  include_once('header.php');
  include_once('navbar.php');
  include_once('../includes/libs/dbh.php');

  $dbConnection = new dbConnection();
  $conn = $dbConnection->connect();

  function getStudents($conn) {
    $sql = "SELECT student_id, CONCAT('# id', student_id, ': ', first_name, last_name) AS name FROM students";
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
?>
<body class="fixed-nav sticky-footer" id="page-top">
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          Students Schedule
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-sm table-striped" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Student</th>
                  <th>Schedule</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Student</th>
                  <th>Schedule</th>
                </tr>
              </tfoot>
              <tbody>
                <?php
                  $students = getStudents($conn);

                  if ($students > 0) {
                    foreach ($students AS $row) {
                      $studentId = $row['student_id'];
                      $name = $row['name'];
                      echo 
                      '<tr>
                      <td>'.$name.'</td>
                      <td><a class="text-info" href="student-weekly-schedule.php?id='.$studentId.'" ><i class="far fa-fw fa-calendar-alt"></i>VIEW</a></td>
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
    <?php include_once('footer.php') ?>
  </div>
  <!-- /.content-wrapper -->
  <?php include_once('js.php') ?>  
</body>