<?php
  include_once('header.php');
  include_once('navbar.php');
  include_once('../includes/libs/dbh.php');

  $dbConnection = new dbConnection();
  $conn = $dbConnection->connect();

  function getContent($conn) {
    $sql = "SELECT course_offered_id, course_title, row_index FROM course_offered ORDER BY row_index ASC";
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

  function getContent2($conn) {
    $sql = "SELECT course_offered_id, course_title, row_index FROM course_offered WHERE row_index != (SELECT MAX(row_index) FROM course_offered) ORDER BY row_index ASC";
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
          Course Offered
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="row m-0 mb-3">
            <div class="col-lg-6 ">
              <button id="btnAdd" class="btn btn-primary" data-toggle="modal" data-target="#modalAddCourse">Add course </button>
            </div> 
          </div>
          <!-- /.row -->
          <div class="table-responsive">
            <table class="table table-bordered table-sm table-striped" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Index</th>
                  <th>Content Title</th>
                  <th>Actions</th> 
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Index</th>
                  <th>Content Title</th>
                  <th>Actions</th> 
                </tr>
              </tfoot>
              <tbody>
              <?php
                $contents = getContent($conn);
                if ($contents > 0) {
                   
                  foreach ($contents AS $row) {
                    $courseId = $row['course_offered_id'];
                    $title = $row['course_title'];
                    $index = $row['row_index'];
                    echo 
                    '<tr>
                    <input type="hidden" name="course_id" value="'.$courseId.'">
                    <input type="hidden" name="index" value="'.$index.'">
                    <td>'.$index.'</td>
                    <td>'.$title.'</td>
                    <td class="w-25">
                      <div class="row justify-content-between m-0">
                        <div class="col-lg-6">   
                          <button class="btnEdit btn btn-transparent text-info p-0" data-toggle="modal" data-target="#modalEditCourse"><i class="far fa-fw fa-edit"></i>EDIT</button>
                          <input type="hidden" value="'.$courseId.'">
                        </div>
                        <div class="col-lg-6 text-right">
                          <a class="btn btn-transparent text-danger p-0" href="delete-course-offered.php?index='.$index.'" onclick="return confirm(\'Are you sure to delete this course?\')"><i class="fas fa-fw fa-trash-alt"></i>DELETE</a>
                        </div>
                      </div>
                    </td>
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
    <?php include_once('footer.php') ?>
    <!-- Modal Add course -->
    <div class="modal fade" id="modalAddCourse" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Add Course Offered</h5>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-lg-12">
                <form id="addForm" action="insert-course-offered.php" method="POST">
                  <div class="form-group">
                    <label for="">Course title</label>
                    <input class="form-control" id="courseTitle" type="text" name="course_title" require>
                  </div>
                  <div class="form-group">
                    <label for="">Course content</label>
                    <small class="form-text text-muted">Put "$end" not including "" in every end of paragraph/sentence.</small>
                    <textarea class="form-control form-control-sm" id="courseContent" type="text" name="course_content" rows="12" require></textarea>
                  </div>
                  <div class="form-group">
                    <?php
                      $contents = getContent2($conn);

                      if ($contents > 1) {
                        echo 
                        '<label>Insert into(Optional)</label>
                        <select class="custom-select w-100" name="index">
                        <option value="" hidden selected disable>Select</option>
                        <option value="0">at the beggining</option>';
                        foreach ($contents AS $row) {
                          $rowIndex = $row['row_index'];
                          $title = $row['course_title'];
                          echo 
                          '<option value="'.$rowIndex.'">after '.$title.'</option>';
                        }
                        echo '</select>';
                      }
                    ?>
                  </div>
              </div>
              <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.modal-body -->
          <div class="modal-footer">
            <button type="button" class="btnReset btn btn-secondary" data-dismiss="modal">Close</button>
            <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            <input class="btn btn-primary" type="submit" name="submit" onclick="return confirm('Are you sure to add this to course offered?')" value="Save changes">
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- /.modal -->
    <!-- Modal Edit course -->
    <div class="modal fade" id="modalEditCourse" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Edit Course Offered</h5>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-lg-12">
              <form id="editForm" action="update-course-offered.php" method="POST">
                <div class="form-group">
                  <label for="">Course title</label>
                  <input class="form-control" id="editTitle" type="text" name="course_title" require>
                </div>
                <div class="form-group">
                  <label for="">Course content</label>
                  <small class="form-text text-muted">Put "$end" not including "" in every end of paragraph/sentence.</small>
                  <textarea class="form-control" id="editContent" type="text" name="course_content" rows="12" required></textarea>
                </div>
                <div id="hidden"></div>
              </div>
              <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.modal-body -->
          <div class="modal-footer">
            <button  type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            <input class="btn btn-primary" type="submit" name="submit" onclick="return confirm('Are you sure to add this to course offered?')" value="Save changes">
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- /.modal -->
  </div>
  <!-- /.content-wrapper -->
  <?php include_once('js.php') ?>  
  <script type="text/javascript">
    $('.btnReset').click(function() {
      $('#addForm').find('input , select, textarea').val("");
    });
    $('.btnEdit').click(function() {
      var courseId = $(this).siblings('input[type=hidden]').val();
      console.log(courseId);
      console.log("fafdsfsa");
      $.ajax({
        url: 'update-course-offered.php',
        type: 'post',
        // enctype: 'multipart/form-data',
        data: {
          'course_id': courseId,
        },
        dataType: 'json',
        // contentType: false,
        // processData: false,
        // cache: false,
        success: function(response) {
          $('#editTitle').val(response.t);
          $('#editContent').text(response.c);
          $('#hidden').html('<input type="hidden" name="id" value="'+courseId+'">');
        },
        error: function(err) {
          console.log(err);
        }
      });
    });
    // $('#editForm').submit(function(e) {
    //   var form = $(this)[0];
    //   var data = new FormData(form);
    //   data.append('submit', 1);

    //   $.ajax({
    //     url: 'edit-course-offered.php',
    //     type: 'post',
    //     enctype: 'multipart/form-data',
    //     data: data,
    //     contentType: false,
    //     processData: false,
    //     cache: false,
    //     success: function(response) {
    //       // alert(response);
    //       // location.reload();
    //     },
    //     error: function(err) {
    //       console.log(err);
    //     }
    //   });
    //   // e.preventDefault();
    // });
   
    // Modal edit close
    $('#modalEditCourse').on('hidden.bs.modal', function() {
      $('#addForm').find('input , select, textarea').val("");
    });
  </script>
</body>