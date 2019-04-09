<?php
  include_once('header.php');
  include_once('navbar.php');
  include_once('../includes/libs/dbh.php');

  $dbConenction = new dbConnection();
  $conn = $dbConenction->connect();

  if (isset($_GET['studentId'])) {
    $studentId = $_GET['studentId'];
    $sessionCount = $_GET['session'];
    $paymentId = $_GET['paymentId'];
  }


  function getTeacher($conn) {
    $sql = "SELECT CONCAT(first_name, ' ', last_name) AS name, t.teacher_id FROM teachers t 
            WHERE EXISTS(SELECT ta.teacher_id FROM teacher_availability ta WHERE ta.teacher_id=t.teacher_id )";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $data[] = $row['name'];
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
          Student's Booking
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="row justify-content-center">
            <!-- BOOKING -->
            <div class="col-lg-4">
              <div class="panel panel-info">
                <div class="panel-heading">
                  <strong>Student booking</strong>
                </div>
                <!-- /.card-header -->
                <div class="panel-body">
                  <form id="form" action="booking-insert.php" method="POST" >
                  <div class="form-row">
                    <div class="col-lg-12">
                      <div id="startDate-error"></div>
                      <div class="input-group mb-2">
                        <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
                        <input id="startDate" class="form-control" type="date" name="startDate" required>
                      </div>  
                    </div>
                    <div class="col-lg-12">
                      <div id="teacherDrop" class="input-group mb-2">
                        <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                        <select id="teacher-select" class="form-control" name="teacher" required>
                          <option value="" hidden selected disable>Select teacher</option>
                            <!-- TEACHERS -->
                            <?php
                              $teachersName = getTeacher($conn);
                              
                              for ($i = 0; $i < count($teachersName); $i++) {
                                echo
                                '<option value="'.$teachersName[$i].'">'.$teachersName[$i].'</option>'; 
                              }
                            ?>
                        </select>
                      </div>
                    </div>
                    <!-- /.col-lg-12 -->
                  </div>
                  <!-- /.form-row -->
                  <div id="schedule-error"></div>
                  <div id="time"></div>
                  <div class="form-group">
                    <input id="paymentId" type="hidden" name="paymentId" value="<?php echo $paymentId ?>">
                    <input id="studentId" type="hidden" name="studentId" value="<?php echo $studentId ?>">
                    <input id="sessionCount" type="hidden" name="sessionCount" value="<?php echo $sessionCount ?>">
                    <input id="submit" class="btn btn-outline-success btn-block" type="submit" name="submit" onclick="return confirm('Are you sure to submit the schedule?')">
                  </div>
                  </form>
                </div>
                <!-- /card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col-lg-6 -->
<!-- BOOKING -->
<script type="text/javascript">
  $(document).ready(function() {
    $('#teacher-select').change(function() {
      var teacherSelect = $(this).val();
      var studentId = $('#studentId').val();
      var startDate = $('#startDate').val();
      $.ajax({
        url : 'booking-process.php',
        type: 'get',
        dataType: 'json',
        data: {
          'teacher': teacherSelect,
          'studentId': studentId,
          'startDate': startDate
        },
        success: function(response) {
          $('#time').html(response.r);
          $('.time-container').hide();
          hideShow();
        },
        error: function(err) {
          console.log(err);
        }
      });
    });
  }); 
</script>
<?php
  $sql = "SELECT image, preferred_schedule, experience, CONCAT(first_name, ' ', last_name) AS name,  level
          FROM student_apply sa INNER JOIN students s 
          WHERE sa.student_id = $studentId AND s.student_id = $studentId";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    if ($row = $result->fetch_assoc()) {
    $schedule = unserialize($row['preferred_schedule']);    
    echo
    '<div class="col-lg-4">
      <div class="panel panel-info">
        <div class="panel-heading">
         <strong>Student profile</strong>
        </div>
        <div class="panel-body">
          <div class="form-group mx-auto" style="width:300px;">
            <div>
            <img class=" profile-img rounded-circle mx-auto d-block" src="data:image/jpeg;base64,'.base64_encode($row['image'] ).'">
            </div>
          </div>  
          <div class="form-group">
            <dl class="row">
            <dt class="col-lg-5">Name: </dt>
            <dd class="col-lg-7">'.$row ['name'].'</dd>';
        for ($i = 0; $i < count($schedule); $i++) {
          echo
          '<dt class="col-lg-5">'.$schedule[$i++].': </dt>
          <dd class="col-lg-7 ">'.$schedule[$i++].' - '.$schedule[$i].'</dd>';
        }
        echo 
        '</dl></div>';
    echo
    '<div class="form-group">
      <dl class="row">
        <dt class="col-lg-5">Experience: </dt>
        <dd class="col-lg-7 ">'.$row ['experience'].'</dd>
        <dt class="col-lg-5">Level: </dt>
        <dd class="col-lg-7 ">'.$row['level'].'</dd>
      </dl>
    </div>
  </div></div></div>';
  } 
  }
?>
            </div>
          <!-- /.row -->
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.container-fluid -->
    <?php include_once('footer.php'); ?>
  </div>
  <!-- MODAL -->
  <!-- Modal -->
  <div class="modal fade" id="modal-submit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Booking</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Are you sure to save this schedule?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button id="save" type="button" class="btn btn-primary"  data-dismiss="modal">Save changes</button>
        </div>
      </div>
    </div>
  </div>
  <!-- /.content-wrapper -->
  <?php include_once('js.php'); ?>
<!-- JS -->
<script type="text/javascript">
  $(document).ready(function() {
    $('#form').submit(function(e) {
      var form = $(this)[0];
      var data = new FormData(form);
      data.append("submit", $('#submit').val());
      $.ajax({
        url: 'booking-insert.php',
        type: 'post',
        data: data,
        dataType: 'json',
        processData: false,
        contentType: false,
        cache: false,
        success: function(response) {
          if (response.c == 3) {
            $('#schedule-error').html(response.r).show();
            hideError();
          }
          else if (response.c == 2) {
            $('#startDate-error').html(response.r).show();
            hideError();
          }
          else {
            $('#startDate-error').hide();
            location.href = "student-payment.php";
          }
        },
        error: function(err) {
          console.log(err);
        } 
      });
      e.preventDefault();
    });
  });
</script>

<script type="text/javascript">
  // $(document).ready(function()	{
	// 	$('.time-container').hide();
  // });	
  function hideShow() {
    $('input[type="checkbox"]').click(function() {
      var container = $(this).closest('.schedule-container').find('.time-container');
      var check = container.is(":visible");
      if (check == false) {
        container.show();
        container.find('select').attr('required', true);
        $('#schedule-error').hide();
      }
      else {
        container.hide();
        container.find('select').prop('selectedIndex', 0);
        container.find('select').attr('required', false);
      }
    });
  }

  function hideError() {
    $('input[type="checkbox"]').click(function() {
      var container = $(this).closest('.schedule-container').find('.time-container');
      var check = container.is(":visible");
      if (check == false) {
        $('#schedule-error').hide();
      }
    });

    $('#startDate, #teacher-select').change(function() {
      $('#startDate-error').hide();
    });
  }

  // Hide and show teacher dropdown 
  $(document).ready(function() {
    $('#teacherDrop').hide();
  });
  $('#startDate').change(function() {
    if ($(this).val().length > 0) {
      $('#teacherDrop').show();
      if ($('select').val().length > 0) {
        $('select').prop('selectedIndex', 0);
        $('.schedule-container').hide();
      }
    }
    else {
      $('#teacherDrop').hide();
    }
  });
</script>
</body>