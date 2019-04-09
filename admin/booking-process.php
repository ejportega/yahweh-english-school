<?php
  include_once('../includes/libs/dbh.php');
  $dbConnection = new dbConnection();
  $conn = $dbConnection->connect();


  if (isset($_GET['teacher'])) {
    $teacher = $_GET['teacher'];
    $studentId = $_GET['studentId'];
    $startDate = $_GET['startDate'];

    $day = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
    $dayTeacherArr = getDay($conn, $teacher);
    $dayArr = unserialize(getStudentSchedule($conn, $studentId));
    $teacherId = getTeacherId($conn, $teacher);
    $response = '';
    for ($i = 0; $i < 7; $i++) {
      $timeArr = unserialize(getTime($conn, $day[$i], $teacher));
      $teacherClass = getTeacherClass($conn, $day[$i], $startDate, $teacher);
      if (in_array($day[$i], $dayArr) AND in_array($day[$i], $dayTeacherArr)) {
        $response .=
        '<div class="schedule-container row mb-2">
          <div class="form-inline col-lg-5">
            <div class="form-check">
              <label class="form-check-label">
                <input type="hidden" name="teacherId" value="'.$teacherId.'"> 
                <input class="form-check-input position-static" type="checkbox" name="schedule[]" value="'.$day[$i].'">
                  '.$day[$i].'
              </label>
            </div>
          </div>
          <div class="time-container col-lg-7">
            <div class="input-group">
              <div class="input-group-addon"><i class="far fa-clock fa-lg"></i></div>
              <select class="form-control" name="schedule[]">
                <option value="" hidden selected disabled selected disabled selected disabled></option>';
        for ($j = 0; $j < count($timeArr); $j++) {
          if (!in_array($timeArr[$j], $teacherClass)) {  
            $response .= '<option value="'.$timeArr[$j].'">'.$timeArr[$j].'</option>';
          }
        }
        $response .= '</select></div></div></div>';
      }
    }
    echo json_encode(array('c'=>1, 'r'=>$response));
    $conn->close();
  }

  function getDay($conn, $name) {
    $sql = "SELECT day_schedule, ta.teacher_id FROM teacher_availability ta
            INNER JOIN teachers t WHERE ta.teacher_id = t.teacher_id AND CONCAT(first_name, ' ', last_name) = '$name'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $data[] = $row['day_schedule'];
      }
      return $data;
    }
    else {
      $data = [];
			return $data;
    }
  }

  function getTime($conn, $day, $name) {
    $sql = "SELECT time_schedule, day_schedule, ta.teacher_id FROM teacher_availability ta
            INNER JOIN teachers t WHERE ta.teacher_id = t.teacher_id AND CONCAT(first_name, ' ', last_name) = '$name' AND day_schedule='$day'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $data = $row['time_schedule'];
      }
      return $data;
    }
    else {
      $data = '';
			return $data;
    }
  }

  function getStudentSchedule($conn, $studentId) {
    $sql = "SELECT preferred_schedule FROM student_apply WHERE student_id='$studentId'";
    $result = $conn->query($sql);
    if ($row = $result->fetch_assoc()) {
      return $row['preferred_schedule'];
    }
  }

  function getTeacherId($conn, $name) {
    $sql = "SELECT teacher_id FROM teachers WHERE CONCAT(first_name, ' ', last_name)='$name'";
    $result = $conn->query($sql);

    if ($row = $result->fetch_assoc()) {
      return $row['teacher_id'];
    }
  }

  function getTeacherClass($conn, $day, $startDate, $name) {
    $sql = "SELECT DISTINCT(ss.time_schedule) FROM teacher_availability ta
    INNER JOIN teachers t
    ON ta.teacher_id = t.teacher_id AND CONCAT(first_name, ' ', last_name)='$name' AND ta.day_schedule='$day'
    INNER JOIN session_details sd 
    ON ta.teacher_id = sd.teacher_id
    INNER JOIN session_schedules ss
    ON sd.session_details_id = ss.session_details_id AND date_schedule > '$startDate' AND ss.day_schedule='$day'";
  
    $result = $conn->query($sql);
  
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $data[] = $row['time_schedule'];
      }
      return $data;
    }
    else {
      $data = [];
      return $data;
    }
  }
?>
