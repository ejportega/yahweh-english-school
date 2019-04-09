<?php
  include_once('../includes/libs/dbh.php');

  $dbConnection=new dbConnection();
  $conn=$dbConnection->connect();

  if (isset($_POST['submit'])) {
    $teacher_availability_id=$_POST['teacher_availability_id'];
    $teacherId=$_GET['id'];
    $sql="DELETE FROM teacher_availability WHERE teacher_availability_id=$teacher_availability_id";
    
    if ($conn->query($sql) === TRUE) {
      //success
      header("location: teacher-availability-schedule.php?id=$teacherId");
    }
    else 
      // error

    $conn->close();
  }
?>