<?php
  include_once('header.php');
  include_once('navbar.php');
  include_once('../includes/libs/dbh.php');

  $dbConnection = new dbConnection();
  $conn = $dbConnection->connect();


  function getTeacherApply($conn) {
    $sql = "SELECT CONCAT('id #', s.teacher_id, ': ', first_name, ' ', last_name) AS name, education, experience, specialization, about_self FROM teacher_apply sa
    INNER JOIN teachers s
    WHERE s.teacher_id = sa.teacher_id";
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
         Teacher Application Form
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-sm table-striped" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Teacher</th>
                  <th>Education</th>
                  <th>Experience</th>
                  <th>Specialization</th>
                  <th>About self</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Teacher</th>
                  <th>Education</th>
                  <th>Experience</th>
                  <th>Specialization</th>
                  <th>About self</th>
                </tr>
              </tfoot>
              <tbody>
              <?php
                $teacherApply = getTeacherApply($conn);
                if ($teacherApply) {
                  foreach ($teacherApply AS $row) {
                    $teacher = $row['name'];
                    $specialization = unserialize($row['specialization']);
                    $experience = $row['experience'];
                    $education = $row['education'];
                    $experience = $row['experience'];
                    $about_self = $row['about_self'];

                    echo 
                    '<tr>
                    <td>'.$teacher.'</td>
                    <td>';
                    for ($i = 0; $i < count($specialization); $i++) {
                      echo 
                      "{$specialization[$i]}";
                      if ($i <= count($specialization) - 2) {
                        echo ", ";
                      }
                    }
                    echo 
                    '</td>
                    <td>'.$experience.'</td>
                    <td>'.$education.'</td>
                    <td>'.$about_self.'</td>';
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
    <?php include_once('footer.php') ?>
  </div>
  <!-- /.content-wrapper -->
  <?php include_once('js.php') ?>  
</body>