<?php
    include_once('../includes/libs/dbh.php');
    date_default_timezone_set("Asia/Bangkok");
    
    $dbConnection = new dbConnection();
    $conn = $dbConnection->connect();

    if (isset($_POST['search'])) {
      $startDate = $_POST['startDate'];
      $endDate = $_POST['endDate'];
    }
    else {
      $endDate = date("Y-m-d");
      $m = date('m');
      $startDate = '2018-'.$m.'-01';
    }

    displayResult($conn, $startDate, $endDate);

    function displayResult($conn, $startDate, $endDate) {
      $print = '';
      
      $print .= 
      '<table class="table table-bordered table-sm table-striped"  id="dataTable" width="100%" cellspacing="0">
      <thead>
        <tr>
          <th>Teacher</th>
          <th>Total session</th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <th>Teacher</th>
          <th>Total session</th>
        </tr>
      </tfoot>
      <tbody>';

      $teacherStats = getStats($conn, $startDate, $endDate); 

      if ($teacherStats > 0) {
        foreach ($teacherStats AS $row) {
          $teacher = getTeacher($conn, $row['teacher_id']);
          $session_count = $row['session_count'];

          if ($session_count > 0) {
            $print .= 
            '<tr>
              <td>'.$teacher.'</td>
              <td>'.$session_count.'</td>
            </tr>';
          }
        }
      }
      else {
        $print .='';
      }
      $print .= '</tbody></table>';
      echo json_encode(array("r"=>$print));
    }

    
    function getStats($conn, $startDate, $endDate) {
      $sql = "SELECT teacher_id,
        SUM(CASE
          WHEN session_status='done' THEN 1
        END) AS session_count
        FROM session_schedules ss
        INNER JOIN session_details sd
        WHERE date_schedule between '$startDate' AND '$endDate'
        AND ss.session_details_id = sd.session_details_id
        GROUP BY teacher_id";
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

    function getTeacher($conn, $teacherId) {
      $sql = "SELECT CONCAT('id #', teacher_id, ': ', first_name, ' ', last_name) AS name FROM teachers WHERE teacher_id=$teacherId";
      $result = $conn->query($sql);
      $rowCount = $result->num_rows;
  
      if ($rowCount > 0) {
        if ($row = $result->fetch_assoc()) {
          $data = $row['name'];
        }
        return $data;
      }
      else {
        return $rowCount;
      }
    }
?>