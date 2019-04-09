<?php
  session_start();
  include_once('header.php');
  include_once('navbar.php');
  include_once('../includes/libs/dbh.php');
  // require 'libs/session.php';

  $dbConnection = new dbConnection();
  $conn = $dbConnection->connect();
  $studentId = $_SESSION['studentID'];

  function getImage($conn, $studentId) {
    $sql = "SELECT image FROM student_apply WHERE student_id=$studentId";
    $result = $conn->query($sql);
    $rowCount = $result->num_rows;

    if ($rowCount > 0) {
      if ($row = $result->fetch_assoc()) {
        return base64_encode( $row['image'] );
      }
    }
    else {
      return $rowCount;
    }
  }
?>
<!-- DISPLAY UPLOAD IMAGE -->
<script type="text/javascript">
    function readURL(input) {       

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#displayImage').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#imgUpload").change(function(){
    readURL(this);
});
</script>
<body class="fixed-nav sticky-footer" id="page-top">
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          Application Form
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="row justify-content-center">
<!-- SELECT data from student_apply -->
<?php
  $sql = "SELECT * FROM student_apply WHERE student_id=$studentId";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $schedule = unserialize($row['preferred_schedule']);    
    echo
    '<div class="col-lg-12">
      <div class="form-group" style="width:300px;">
        <div>
        <img class=" profile-img rounded-circle mx-auto d-block" src="data:image/jpeg;base64,'.base64_encode($row['image'] ).'">
        </div>
      </div>  
      <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#changePicture">
      Change picture</button>
      <div class="form-group">
        <dl class="row">';
        for ($i = 0; $i < count($schedule); $i++) {
          echo
          '<dt class="col-lg-2">'.$schedule[$i++].': </dt>
          <dd class="col-lg-10">'.$schedule[$i++].' - '.$schedule[$i].'</dd>';
        }
        echo 
          '<dt class="col-lg-12">
          <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#editSchedule">
            Edit schedule</button>
          </dt>
        </dl>
      </div>';
    echo
    '<div class="form-group">
      <dl class="row">
        <dt class="col-lg-2">Experience: </dt>
        <dd class="col-lg-10">'.$row['experience'].'</dd>
        <dt class="col-lg-2">Goals: </dt>
        <dd class="col-lg-10">'.$row['goals'].'</dd>
        <dt class="col-lg-2">Hobbies: </dt>
        <dd class="col-lg-10">'.$row['hobbies'].'</dd>
        <dt class="col-lg-2">Ambitions: </dt>
        <dd class="col-lg-10">'.$row['ambition'].'</dd>
      </dl>
    </div>';
  }
  else {
    echo
    '<div class="col-lg-12">
      <h3 class="">Application form for new Student</h3>
      <dl class="row">
        <dt class="col-lg-1">Step 1:</dt>
        <dl class="col-lg-11">Fill out application <a href="application-form.php">form</a>.</dl>
        <dt class="col-lg-1">Step 2:</dt>
        <dl class="col-lg-11">Student need to take demo class first before proceeding to regular classes. Demo class is only good for 1 session with a total of 30 minutes class.</dl>
        <dt class="col-lg-1">Step 3:</dt>
        <dl class="col-lg-11">Make a payment on payment tab.</dl>
        <dt class="col-lg-1">Step 4:</dt>
        <dl class="col-lg-11">Wait for the admin\'s message for your demo class schedule.</dl>
        <dt class="col-lg-1">Step 5:</dt>
        <dl class="col-lg-11">Check your Weekly Schedule to view your class schedules.</dl>
      </dl>
      <a class="card-link" href="application-form.php">Go to filling out of application form</a>';
  }
?>              
            </div>
            <!-- /.col-lg-* -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.container-fluid -->
    <?php include_once('footer.php'); ?>
    <!-- Modal change picture -->
    <div class="modal fade" id="changePicture" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Change Picture</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="form1" action="application-insert.php" method="POST" enctype="multipart/form-data">
              <!-- Profile picture -->
              <div class="form-group mx-auto" style="width:300px;">
                <div>
                  <img src="data:image/jpeg;base64,<?php echo getImage($conn, $studentId) ?>" id="image-chosen" class=" profile-img rounded-circle mx-auto d-block" alt="choose an image">
                </div>
                <div class="text-center my-2">
                  <label class="text-left custom-file">
                    <input id="image-chooser" type="file" class="custom-file-input" name="image" accept="image/*" required>
                    <span class="custom-file-control form-control-sm"></span>
                  </label>
                  <!-- Display iamge -->
                  <script>
                    function readURL(input) {
                      if (input.files && input.files[0]) {
                        var reader = new FileReader();

                        reader.onload = function (e) {
                          $('#image-chosen').attr('src', e.target.result);
                        }

                        reader.readAsDataURL(input.files[0]);
                      }
                    }
                    $("#image-chooser").change(function () {
                      readURL(this);
                    });
                  </script>
                </div>
              </div>
              <!-- /.image -->
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            <input class="btn btn-primary" type="submit" value="Save changes">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal edit schedule-->
  <div class="modal fade" id="editSchedule" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Edit Schedule</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="form1" action="application-insert.php" method="POST" enctype="multipart/form-data">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            <input class="btn btn-primary" type="submit" value="Save changes">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.content-wrapper -->
  <?php include_once('js.php'); ?>
  <script text="text/javascript">
    $('#form1').submit(function(e) {
      var form = $(this)[0];
      var data = new FormData(form);
      $.ajax( {
        url: 'application-update.php',
        type: 'post',
        enctype: 'multipart/form-data',
        data: data,
        processData: false,
        contentType: false,
        cache: false,
        success: function(response) {
          location.reload();
        },
        error: function(err) {
          // alert(err);
        }
      });
      e.preventDefault();
    });
  </script>
</body>