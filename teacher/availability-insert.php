<?php
  session_start();
  include_once('../includes/libs/dbh.php');
  
  if (isset($_POST['submit']) AND !empty($_POST['time'])) {
    $dbConnection = new dbConnection();
    $conn = $dbConnection->connect();
    $teacherId = $_SESSION['teacherID'];
    $day = $_POST['day'];
    $time = serialize($_POST['time']); // array
    $sql = "INSERT INTO teacher_availability(teacher_id,  day_schedule, time_schedule)
            VALUES($teacherId, '$day', '$time')";
    if ($conn->query($sql)) {
      // success
      
    }
    else {
      // echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
  }
  else {
    echo 'error';
  }

?>