<?php
  session_start();
  include_once("header.php");
  include_once("navbar.php");
  include_once("../includes/libs/dbh.php");

  $dbConnection = new dbConnection();
  $conn = $dbConnection->connect();
  $teacherId = $_SESSION['teacherID'];

?>

<body class="fixed-nav sticky-footer" id="page-top">
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="panel panel-default">
        <div class="panel-heading">
          Report Tasks
        </div>
        <!-- /.panel-header -->
        <div class="panel-body">
          <div class="col-lg-6">
            <div class="panel panel-info">
              <div class="panel-heading">
                <strong>
                  <?php echo date('l, d F Y') ?>
                </strong>
              </div>
              <!-- /.panel-heading -->
              <div class="panel-body mb">
                <form action="report-insert.php" method="POST">
                    <div class="form-group">
                      <div class="input-group">
                      <div class="input-group-addon"><i class="fa fa-fw fa-users"></i></div>
                      <select id="student" class="form-control form-control-sm" name="student" required>
                      <option value="" hidden selected disable>Choose a student</option>
                        <?php
                          $sql = "SELECT DISTINCT CONCAT(sd.student_id, '#: ', first_name, ' ', last_name) AS name, sd.student_id FROM session_details sd
                          INNER JOIN students s WHERE teacher_id=$teacherId AND sd.student_id = s.student_id";
                          $result = $conn->query($sql);
                          
                          if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                              $studentId = $row['student_id'];
                              $name = $row['name'];
                              echo
                              "<option value='$studentId'>$name</option>";
                            }
                          }
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <textarea id="report" class="form-control" rows="5" name="report" max="300" required></textarea>
                  </div>
                  <div class="form-group">
                    <input class="btn btn-outline-success btn-block mt-2" type="submit" name="submit" >
                  </div>
                </form>
              </div>
              <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
          </div>
          <!-- /.col-lg-6(nested) -->
        </div>
        <!-- /.panel-body -->
      </div>
      <!-- /.panel -->
    </div>
    <!-- /.container-fluid-->
    <?php include_once("footer.php") ?>
  </div>
  <!-- /.content-wrapper-->
  <?php include_once("js.php") ?>
<script type="text/javascript">
  $(document).ready(function() {
    $('form').submit(function(e) {
      var report = $('#report').val();
      var student = $('#student').val();
      var submit = $('#submit').val();
      $.ajax({
        url: 'report-insert.php',
        type: 'post',
        data: {
          'report': report,
          'student': student,
          'submit': submit
        },
        success: function(response) {
          alert("Report had been submit successfully.");
        },
        error: function(err) {
          console.log(err);
        }
      }); 
      // e.preventDefault();
    });
  });
</script>
</body>