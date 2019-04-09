<?php
  session_start();
  include_once('../includes/libs/dbh.php');
  
  $dbConnection = new dbConnection();
  $conn = $dbConnection->connect();
  $teacherId = $_SESSION['teacherID'];

  if (isset($_POST['calendar'])) {
    $date = $_POST['calendar'];  // January 02 - 08, 2017
    $date = new DateTime($date);
    $week =  $date->format("W"); //
    $year =  $date->format("Y");
    echo getWeekDates($year, $week);
  }
  elseif (isset($_POST['prev'])) {
    $date = trim($_POST['date']);
    // $year =  trim(substr($date, strlen($date) - 4));
    $keywords = $keywords = preg_split("/[\s,-]+/", $date);
    if (count($keywords) == 6) {
      $year = $keywords[5];
      $date = "$keywords[3] $keywords[4] $year";
    }
    else {
      $year = $keywords[count($keywords) - 1];
      $date = "$keywords[0] $keywords[1], $year";
    }
    $date = new DateTime($date);
    $weekTemp =  $date->format("W");
    $week =  $date->modify('-1 week')->format("W");
    if (($week == 52 OR $week == 53) AND $weekTemp == '01') {
      $year--;
    }
    elseif (count($keywords) == 6) {
      $year--;
    }
    echo getWeekDates($year, $week);
  }
  elseif (isset($_POST['next'])) {
    $date = trim($_POST['date']);
    // $year =  trim(substr($date, strlen($date) - 4));
    $keywords = $keywords = preg_split("/[\s,-]+/", $date);
    if (count($keywords) == 6) {
      $year = $keywords[2];
    }
    else {
      $year = $keywords[count($keywords) - 1];
    }
    $date = "$keywords[0] $keywords[1] $year";
    $date = new DateTime($date);
    $tempWeek = $date->format("W");
    $tempWeek = $date->format("W");
    $week =  $date->modify('+1 week')->format("W");
    if ($tempWeek == '01' AND $week == '02') {
      $year = $keywords[count($keywords) - 1]; 
    }
    elseif ($week == '01') {
      $year++;
    }
    echo getWeekDates($year, $week);
  }
  elseif (isset($_POST['today'])) {
    $date = date('Y-m-d');
    $date = new DateTime($date);
    $week =  $date->format("W");
    $year =  $date->format("Y");
    
    echo getWeekDates($year, $week);
  }
  elseif (isset($_POST['weekly-schedule'])) {
    $date = trim($_POST['date']);
    $keywords = $keywords = preg_split("/[\s,-]+/", $date);
    $v = $_POST['v'];
    if (count($keywords) == 6) {
      $year = $keywords[2];
      $date = "$keywords[0] $keywords[1] $year";
    }
    else {
      if ($v == 1) {
        $year = $keywords[count($keywords) - 1];
        $date = "$keywords[0] $keywords[1], $year";
      }
      else {
        $year = $keywords[count($keywords) - 1];
        $date = "$keywords[0] $keywords[1] $year";
      }
    }
    $tempDate = new DateTime($date);
    $week =  $tempDate->format("W");
    // $year =  $tempDate->format("Y");
    if (count($keywords) == 6 AND $week == '01') {
      $year = $keywords[5];
    }
    $day = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
    $print = '';
    
    for ($i = 0; $i < 7; $i++) {
      $hour = 6;
      $currDate =  date('Y-m-d', strtotime(getFirstMonday($year, $week, $i)));
      $print .=
      '<div class="parent col-lg-12 mx-auto">
        <div class="panel panel-info">
          <div class="panel-heading text-center">
            <strong>'.getFirstMonday($year, $week, $i).'</strong>
          </div>
          <form action="remark-insert.php" method="POST">
          <div class="panel-body p-0">
          <table class="table table-bordered m-0 text-center" style="table-layout:fixed">';
      for ($j = 0; $j < 6; $j++) {
        $print .=
          '<tr>
            '.displayClass($conn, $teacherId, $currDate, $day[$i], $hour.':00').'
            '.displayClass($conn, $teacherId, $currDate, $day[$i], $hour++.':30').'
            '.displayClass($conn, $teacherId, $currDate, $day[$i], $hour.':00').'
            '.displayClass($conn, $teacherId, $currDate, $day[$i], $hour++.':30').'
            '.displayClass($conn, $teacherId, $currDate, $day[$i], $hour.':00').'
            '.displayClass($conn, $teacherId, $currDate, $day[$i], $hour++.':30').'
          </tr>';
      }
      $print .= '</table></div>
      <div class="form-footer panel-footer text-center">
        <input class="btn btn-outline-success btn-sm" type="submit" name="submit" value="Submit remark" onclick="return confirm(\'Are you to save this remark? This will be permanent after remark had been saved.\')">
        </form>
      </div> 
      </div></div>';
    }
    $conn->close();
    echo json_encode(array("r"=>$print));
  }

  function getWeekDates($year, $week) {
		$day1 = date("d", strtotime("{$year}-W{$week}-1")); //Returns the date of monday in week
    $month1 = date("F", strtotime("{$year}-W{$week}-1"));
    $year1 = date("Y", strtotime("{$year}-W{$week}-1"));
    $day2 = date("d", strtotime("{$year}-W{$week}-7"));   //Returns the date of sunday in week
    $month2 = date("F", strtotime("{$year}-W{$week}-7"));
    $year2 =  date("Y", strtotime("{$year}-W{$week}-7"));

    if ($month1 != $month2) {
      if ($year1 != $year2) {
        return "$month1 $day1, $year1 - $month2 $day2, $year2";
      }
      else {
        return "$month1 $day1 - $month2 $day2, $year1";
      }
    }
    else {
  		return "$month1 $day1 - $day2, $year1";
    }
  }

  function getFirstMonday($year, $week, $day) {
    $from = date("l, d F Y", strtotime("{$year}-W{$week}-1"));
    $monday = date('l, d F Y', strtotime('+ '.$day.' day'.$from));  
    return $monday;
  }

  function hasClass($conn, $teacherId, $date) {
    $sql = "SELECT session_details_id FROM session_details WHERE teacher_id=$teacherId AND end_date >= '$date' and start_date <= '$date'";
    $result = $conn->query($sql);
    $rowCount = $result->num_rows;

    if ($rowCount > 0) {
      while ($row = $result->fetch_assoc()) {
        $data[] = $row['session_details_id'];
      }
      return $data;
    }
    else {
      return $rowCount;
    }
  }

  function getStudentSchedule($conn, $teacherId, $date) {
    if (hasClass($conn, $teacherId, $date) > 0) {
      $a = implode(',',hasClass($conn, $teacherId, $date));
      $sql = "SELECT day_schedule, time_schedule, session_details_id FROM session_schedules WHERE session_details_id IN ($a) AND date_schedule='$date'";
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
    else {
      return 0;
    }
  }

  function getSessionDetailsId($conn, $teacherId, $date, $day, $time) {
    $schedule = getStudentSchedule($conn, $teacherId, $date);
    if ($schedule > 0) {
      foreach ($schedule as $row) {
        if (in_array($day, $row) AND in_array($time, $row)) {
          $data = $row['session_details_id'];
          return $data;
          break;
        }
      }
    }
    return 0;
  }

  function getStudents($conn, $teacherId) {
    $sql = "SELECT session_details_id FROM session_details WHERE teacher_id=$teacherId AND end_date>=curdate()";
    $result = $conn->query($sql);
    $rowCount = $result->num_rows;

    if ($rowCount > 0) {
      while ($row = $result->fetch_assoc()) {
        $data[] =   $row['session_details_id'];
      }
      return $data;
    }
    else {
      return $rowCount;
    }
  }

  function getStudentName($conn, $sessionDetailsId) {
    $sql = "SELECT CONCAT(first_name, ' ', last_name) AS name FROM session_details sd INNER JOIN students s WHERE session_details_id=$sessionDetailsId AND sd.student_id=s.student_id";
    $result = $conn->query($sql);
    $rowCount = $result->num_rows;

    if ($rowCount > 0) {
      while ($row = $result->fetch_assoc()) {
        $data =   $row['name'];
      }
      return $data;
    }
    else {
      return $rowCount;
    }
  }

  function getCurrentTime($conn) {
    $sql = "SELECT curtime() FROM dual";
    
    if ($result = $conn->query($sql)) {
      if ($row = $result->fetch_assoc()) {
        $data = $row['curtime()'];
      }
    }
    return $data;
  }

  function getCurrentDate($conn) {
    $sql = "SELECT curdate() FROM dual";
    
    if ($result = $conn->query($sql)) {
      if ($row = $result->fetch_assoc()) {
        $data = $row['curdate()'];
      }
    }
    return $data;
  }
  
  function getSchedule($conn, $sessionDetailsId, $date) {
    $sql = "SELECT  time_schedule, session_status, session_remark FROM session_schedules WHERE session_details_id=$sessionDetailsId AND date_schedule='$date'";
    $result = $conn->query($sql);
    $rowCount = $result->num_rows;

    if ($rowCount > 0) {
      if ($row = $result->fetch_assoc()) {
        $data[] = $row['time_schedule'];
        $data[] = $row['session_status'];
        $data[] = $row['session_remark'];
      }
      return $data;
    }
    else {
      return $rowCount;
    }
  } 

  // print_r(hasClass($conn, 25, '2018-01-28'));
  // print_r(getStudentSchedule($conn, 25, '2018-01-28'));  
  // print_r(getSessionDetailsId($conn, 25, '2018-01-28', 'Sunday', '10:00'));
  // displayClass($conn, 25, '2018-01-29', 'Monday', '10:00');

  
  function displayClass($conn, $teacherId, $date, $day, $time) {
    $color = array();
    $color[0] = 'orangered';
    $color[1] = 'green';
    $color[4] = '#f25268';
    $color[3] = 'maroon';
    $color[2] = 'purple';
    $color[5] = 'deeppink';
    $color[6] = 'salmon';
    $color[7] = 'brown';
    $color[8] = 'navy';
    $color[9] = 'olive';
    $color[10] = 'violet';

    $students = getStudents($conn, $teacherId);
    $sessionDetailsId = getSessionDetailsId($conn, $teacherId, $date, $day, $time);
    $studentName = getStudentName($conn, $sessionDetailsId);
    $session = getSchedule($conn, $sessionDetailsId, $date);
    $time_schedule =  $session[0];
    $status = $session[1];
    $remark = $session[2];
    $currDate = getCurrentDate($conn);
    $currTime = getCurrentTime($conn);
    $interval = (strtotime($time) - strtotime($currTime)) / 3600;

    if ($sessionDetailsId > 0) {
      if ($status == 'student is on leave' OR $status == 'teacher is on leave' OR $status == 'teacher is AWOL') {
        $print = 
        '<td class="text-white" style="background:#b3190f">
          <div>
            <span>'.$time.'</span><br>
            <span>'.$studentName.'</span>  
          </div>
        </td>';
      }
      elseif ($status == 'uncharged' ) {
        $print = 
        '<td class="text-white" style="background:#b3190f">
          <div>
            <span>'.$time.'</span><br>
            <span>'.$studentName.'</span>  
            <p class="m-0 small text-white">'.$remark.'</p>
          </div>
        </td>';
      }
      elseif ($status == 'done') {
        $print =
        '<td class="time-avail">
          <div>
            <span>'.$time.'</span><br>
            <span>'.$studentName.'</span>  
          </div>
        </td>';
      }
      // elseif ($date < $currDate) {
        // $print =
        // '<td class="time-avail">
        //   <div>
        //     <span>'.$time.'</span><br>
        //     <span>'.$studentName.'</span>  
        //   </div>
        // </td>';
      // }
      elseif ($interval <= 0 AND $date == $currDate) {
        $print = 
        '<td class="class-student text-white" style="background:'.$color[array_search($sessionDetailsId, $students)].'">
          <div class="class-click">
            <span>'.$time.'</span><br>
            <span>'.$studentName.'</span>  
          </div>
          <div class="class-select text-center">
            <select class="form-control form-control-sm " name="status[]" id="">
              <option value="" hidden selected disable>Select</option>
              <option value="teacher is on leave" disabled>teacher is on leave</option>
              <option value="uncharged">uncharged</option>
            </select>
            <input type="hidden" name="time[]" value="'.$time.'">
            <input type="hidden" name="date[]" value="'.$date.'">
            <input type="hidden" name="sessionDetailsId[]" value="'.$sessionDetailsId.'">
          </div>
          <div class="class-remark bg-danger text-white mb-1"></div>
        </td>';  
      }
      elseif ($interval <= 2 AND $date == $currDate) {
        $print = 
        '<td class="text-white" style="background:'.$color[array_search($sessionDetailsId, $students)].'">
          <div>
            <span>'.$time.'</span><br>
            <span>'.$studentName.'</span>  
          </div>
        </td>';
      }
      else {
        $print = 
        '<td class="class-student text-white" style="background:'.$color[array_search($sessionDetailsId, $students)].'">
          <div class="class-click">
            <span>'.$time.'</span><br>
            <span>'.$studentName.'</span>  
          </div>
          <div class="class-select text-center">
            <select class="form-control form-control-sm " name="status[]" id="">
              <option value="" hidden selected disable>Select</option>
              <option value="teacher is on leave">teacher is on leave</option>
              <option value="uncharged" disabled>uncharged</option>
            </select>
            <input type="hidden" name="time[]" value="'.$time.'">
            <input type="hidden" name="date[]" value="'.$date.'">
            <input type="hidden" name="sessionDetailsId[]" value="'.$sessionDetailsId.'">
          </div>
          <div class="class-remark bg-danger text-white mb-1"></div>
        </td>';  
      }
    }
    else {
      $print = 
      "<td>$time</td>";
    }
    return $print;
  }

  
  function getRemarks($conn, $sessionDetailsId, $date, $time) {
    $sql = "SELECT date, time_schedule FROM session_remarks WHERE session_details_id=$sessionDetailsId AND date='$date' AND time_schedule='$time'";
    $result = $conn->query($sql);
    $rowCount = $result->num_rows;

    if ($rowCount > 0) {
      if ($row = $result->fetch_assoc()) {
        $data = $row['date'].','.$row['time_schedule'];
      }
      return $data;
    }
    else {
      return $rowCount;
    }
  }

  //  t($conn, $teacherId);

  //  function t($conn, $teacherId) {
  //   $date = '2018-01-15';
  //   $tempDate = new DateTime($date);
  //   $week =  $tempDate->format("W");
  //   $year =  $tempDate->format("Y");
  //   $day = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
  //   $schedule = getStudentSchedule($conn, $teacherId, $date);
  //   $print = '';

  //   for ($i = 0; $i < 7; $i++) {
  //     $hour = 6;
  //     $currDate =  date('Y-m-d', strtotime(getFirstMonday($year, $week, $i)));
  //     echo
  //     '<div class="col-lg-12 mx-auto">
  //       <div class="panel panel-info">
  //         <div class="panel-heading text-center">
  //           <strong>'.getFirstMonday($year, $week, $i).'</strong>
  //         </div>
  //         <div class="panel-body p-0">
  //         <table class="table table-bordered m-0 text-center" style="table-layout:fixed">';
  //       for ($j = 0; $j < 6; $j++) {
  //         echo
  //           '<tr>
  //             <td>'.displayClass($conn, $teacherId, $currDate, $day[$i], $hour.':00').'</td>
  //             <td>'.displayClass($conn, $teacherId, $currDate, $day[$i], $hour++.':30').'</td>
  //             <td>'.displayClass($conn, $teacherId, $currDate, $day[$i], $hour.':00').'</td>
  //             <td>'.displayClass($conn, $teacherId, $currDate, $day[$i], $hour++.':30').'</td>
  //             <td>'.displayClass($conn, $teacherId, $currDate, $day[$i], $hour.':00').'</td>
  //             <td>'.displayClass($conn, $teacherId, $currDate, $day[$i], $hour++.':30').'</td>
  //           </tr>';
  //     }
  //     echo '</table></div></div></div>';
  //   }
  // }
?>