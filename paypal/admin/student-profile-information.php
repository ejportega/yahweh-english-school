<?php
  include_once('header.php');
  include_once('navbar.php');
  include_once('../includes/libs/dbh.php');

  $dbConnection = new dbConnection();
  $conn = $dbConnection->connect();


  function getStudents($conn) {
    $sql = "SELECT student_id, CONCAT('id #', student_id, ': ', first_name, ' ', last_name) AS name, email, skype, country, level, date, age FROM students 
    ORDER BY student_id DESC";
    $result = $conn->query($sql);
    $rowCount = $result->num_rows;

    if ($rowCount > 0) {
      while ($row = $result->fetch_array()) {
        $data[] = $row;
      }
      return $data;
    }
  }
?>

<body class="fixed-nav sticky-footer" id="page-top">
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          Student Profiles
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-sm table-striped" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Join Date</th>
                  <th>Student</th>
                  <th>Email</th>
                  <th>Skype</th>
                  <th>Level</th>
                  <th>Country</th>
                  <th>Age</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Join Date</th>
                  <th>Student</th>
                  <th>Email</th>
                  <th>Skype</th>
                  <th>Level</th>
                  <th>Country</th>
                  <th>Age</th>
                </tr>
              </tfoot>
              <tbody>
<!-- Profile information -->
<?php
  $students = getStudents($conn);
  foreach($students as $row) {
    echo
    "<tr>
      <td>{$row['date']}</td>
      <td>{$row['name']}</td> 
      <td>{$row['email']}</td>
      <td>{$row['skype']}</td>
      <td>{$row['level']}</td>
      <td>{$row['country']}</td>
      <td>{$row['age']}</td>
    </tr>";
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