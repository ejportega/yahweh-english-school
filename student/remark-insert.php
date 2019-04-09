<?php
  include_once('../includes/libs/dbh.php');
  // require 'libs/session.php';
  
  $dbConnection = new dbConnection();
  $conn = $dbConnection->connect();

  if (isset($_POST['submit'])) {
    $remark = $_POST['remark'];
    $sessionDetailsId = $_POST['sessionDetailsId'];
    $time = $_POST['time'];
    $date = $_POST['date'];
   
    $plus = 1;
    if ($remark = 'teacher is AWOL') {
      $plus = 2;
    }
   

    $sql = "UPDATE session_schedules SET session_status='$remark' WHERE session_details_id=$sessionDetailsId AND date_schedule='$date'";

    if ($conn->query($sql) === TRUE) {
      echo "Remark has been save successfully.";
      updateSession($conn, $sessionDetailsId, $plus);
    }
    else {
      //error;
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
  }

  function getStartDate($conn, $sessionDetailsId) {
    $sql = "SELECT start_date, session_count FROM session_details WHERE session_details_id=$sessionDetailsId";
    $result = $conn->query($sql);

    if ($row = $result->fetch_assoc()) {
      $data = $row['start_date'].','.$row['session_count'];
    }
    return $data;
  }

  function getSchedule($conn, $sessionDetailsId) {
    $sql = "SELECT day_schedule FROM session_schedules WHERE session_details_id=$sessionDetailsId ORDER BY date_schedule ASC";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
      $data[] = $row['day_schedule'];
    }

    return $data;
  }

  function getTime($conn, $sessionDetailsId, $day) {
    $sql = "SELECT time_schedule FROM session_schedules WHERE session_details_id=$sessionDetailsId  AND day_schedule='$day' ORDER BY date_schedule ASC";
    $result = $conn->query($sql);

    if ($row = $result->fetch_assoc()) {
      $data = $row['time_schedule'];
    }

    return $data;
  }

  
  function updateSession($conn, $sessionDetailsId, $plus) {
    $tempDay = getSchedule($conn, $sessionDetailsId);
    $a =  explode(',', getStartDate($conn, $sessionDetailsId));
    $startDate = $a[0];
    $sessionCount = count($tempDay) + $plus;
    // Check if array have sunday
    $dayArr = [];
    for ($i = 0; $i < 7; $i++) {
      if (in_array($tempDay[$i], $dayArr)) {
        break;
      }
      else {
        $dayArr[] = $tempDay[$i];
      }
    }
    if ($dayArr[count($dayArr) - 1] == 'Sunday') {
      array_unshift($dayArr, array_pop($dayArr));
    }
    $numOfDays = array_search(date('l', strtotime($startDate)), $dayArr); // return false if start day not on array
    for ($i = 0 ; $i < $sessionCount; $i++) {
      $lastDay = $dayArr[$numOfDays];
      $arr[] = $lastDay;
      $numOfDays++;
      if ($numOfDays > count($dayArr) - 1 AND $i < $sessionCount - 1) {
        $numOfDays = 0;
      }
    }
    $count = array_count_values($arr)[$lastDay];
    $endDate = date('Y-m-d', strtotime("+$count $lastDay", strtotime($startDate)));
    $time = getTime($conn, $sessionDetailsId, $lastDay);
    $sql = "UPDATE session_details set end_date='$endDate' WHERE session_details_id=$sessionDetailsId";
    if ($conn->query($sql) === TRUE) {
      //successz
      insertSession($conn, $sessionDetailsId, $endDate, $lastDay, $time);
    }
    else {
      // echo "Error updating record: " . $conn->error;
    }
  }

  function insertSession($conn, $sessionDetailsId, $endDate, $lastDay, $time) {
    $sql = "INSERT INTO session_schedules(session_details_id, date_schedule, day_schedule, time_schedule) 
            VALUES($sessionDetailsId, '$endDate', '$lastDay', '$time')";

    if ($conn->query($sql) === TRUE) {
      echo "Remark has been save successfully.";
    }
    else {
    //error;
    echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }

?>