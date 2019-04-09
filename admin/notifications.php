<?php
  include_once('header.php');
  include_once('navbar.php');
  include_once 'libs/manage-data.php';

  $manageData = new ManageData();
  $studSessions  = $manageData->studRemainingSession();
?>

<body class="fixed-nav sticky-footer" id="page-top">
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          Application Form
        </div>
        <!-- /.card-header -->
        <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Date</th>
                  <th>Message</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Date</th>
                  <th>Message</th>
                </tr>
              </tfoot>
              <tbody>
                <!-- Class ends in 3 days notification -->
                <?php if ($studSessions && (($studSessions->session_count)-($studSessions->used)) <= 3 && (($studSessions->session_count)-($studSessions->used)) > 0) { 
                  $studInfos = $manageData->getStudentInfo($studSessions->student_id);
                  $studName = ($studInfos->first_name)." ".($studInfos->last_name);
                  echo $studName;
                ?>
                  <tr>
                    <td><?php echo date('F j, Y'); ?></td>
                    <td><?php echo "$studName has "; echo ($studSessions->session_count)-($studSessions->used);?> remaining session until <?php echo date('F j, Y', strtotime($studSessions->end_date)); ?></td>
                  </tr>      
                <?php } ?>  
              </tbody>
            </table>
          </div>
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