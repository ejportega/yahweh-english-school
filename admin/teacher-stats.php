<?php
  include_once('header.php');
  include_once('navbar.php');
  date_default_timezone_get('Asia/Bangkok');
  
  $curdate = date('Y-m-d');
?>

<body class="fixed-nav sticky-footer" id="page-top">
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          Teacher Stats
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <form id="form" action="teacher-stats-process.php" method="POST">
            <div class="col-lg-12 my-3">
              <div class="input-daterange row">
                <div class="col-md-3">
                  <label for="">Start date:</label>
                  <input type="date" name="startDate" id="start-date" class="form-control" required>
                </div>
                <div class="col-md-3">
                  <label for="">End date:</label>
                  <input type="date" name="endDate" id="end-date" class="form-control" required>
                </div>
                <div class="col-md-4 mt-auto">
                  <input type="submit" name="search" id="search" value="Go to date" class="btn btn-info" />
                </div>      
              </div>
            </div>
            <!-- /.col-lg-12 -->
          </form>
          <div id="teacher-stats" class="table-responsive">
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
  <!-- Javascript -->
  <script type="text/javascript">
    $(document).ready(function () {
      displayStats();    
      // setInterval(displayStats, 1000);  // 1000 = second
    });

    function displayStats() {
      $.ajax({
        url: 'teacher-stats-process.php',
        type: 'get',
        dataType: 'json',
        success: function(response) {
          $('#teacher-stats').html(response.r);
          $('#dataTable').DataTable();
        },
        error: function(err) {
          // console.log(err);
        }
      });
    }

    $('#form').submit(function(e) {
      var form = $(this)[0];
      var data = new FormData(form);
      data.append('search', $('#search').val());

      $.ajax( {
        url: 'teacher-stats-process.php',
        type: 'POST',
        enctype: 'multipart/form-data',
        dataType: 'json',
        data: data,
        processData: false,
        contentType: false,
        cache: false,
        success: function(response) {
          $('#teacher-stats').html(response.r);
          $('#dataTable').DataTable();
          // console.log(response.r);
        },
        error: function(err) {
          // console.log(err);
        }
      });
      e.preventDefault();
    })    
  </script>
</body>