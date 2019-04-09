<?php
  include_once('header.php');
  include_once('navbar.php');
  include_once('../includes/libs/dbh.php');

  $dbConnection = new dbConnection();
  $conn = $dbConnection->connect();


  function getStudentApply($conn) {
    $sql = "SELECT CONCAT('id #', s.student_id, ': ', first_name, ' ', last_name) AS name, preferred_schedule, experience, goals, hobbies, ambition FROM student_apply sa
    INNER JOIN students s
    WHERE s.student_id = sa.student_id";
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
          Student Application Form
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-sm table-striped" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Student</th>
                  <th>Schedule</th>
                  <th>Experience</th>
                  <th>Goals</th>
                  <th>Hobbies</th>
                  <th>Ambition</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Student</th>
                  <th>Schedule</th>
                  <th>Experience</th>
                  <th>Goals</th>
                  <th>Hobbies</th>
                  <th>Ambition</th>
                </tr>
              </tfoot>
              <tbody>
              <?php
                $studentApply = getStudentApply($conn);
                if ($studentApply)
                 
                if ($studentApply) {
                  foreach ($studentApply AS $row) {
                    $student = $row['name'];
                    $schedule = unserialize($row['preferred_schedule']);
                    $experience = $row['experience'];
                    $goals = $row['goals'];
                    $hobbies = $row['hobbies'];
                    $ambition = $row['ambition'];

                    echo 
                    '<tr>
                    <td>'.$student.'</td>
                    <td>';
                    for ($i = 0; $i < count($schedule); $i++) {
                      echo 
                      "{$schedule[$i++]} - {$schedule[$i++]}";
                      if ($i <= count($schedule) - 2) {
                        echo ", ";
                      }
                    }
                    echo 
                    '</td>
                    <td>'.$experience.'</td>
                    <td>'.$goals.'</td>
                    <td>'.$hobbies.'</td>
                    <td>'.$ambition.'</td>';
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