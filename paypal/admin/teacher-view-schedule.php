<?php
  include_once('header.php');
  include_once('navbar.php');
  include_once('../includes/libs/dbh.php');

  $dbConnection = new dbConnection();
  $conn = $dbConnection->connect();

  function getTeachers($conn) {
    $sql = "SELECT teacher_id, CONCAT('# id', teacher_id, ': ', first_name, last_name) AS name FROM teachers";
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
          Teachers Schedule
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-sm table-striped" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Teacher</th>
                  <th>Availability schedule</th>
                  <th>Weekly schedule</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Teacher</th>
                  <th>Availability schedule</th>
                  <th>Availability schedule</th>
                </tr>
              </tfoot>
              <tbody>
                <?php
                  $teachers = getTeachers($conn);

                  if ($teachers > 0) {
                    foreach ($teachers AS $row) {
                      $teacherId = $row['teacher_id'];
                      $name = $row['name'];
                      echo 
                      '<tr>
                      <td>'.$name.'</td>
                      <td><a class="text-info" href="teacher-availability-schedule.php?id='.$teacherId.'" ><i class="far fa-fw fa-calendar-alt"></i>VIEW</a></td>
                      <td><a class="text-info" href="teacher-weekly-schedule.php?id='.$teacherId.'" ><i class="far fa-fw fa-calendar-alt"></i>VIEW</a></td>
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