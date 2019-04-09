<?php
  session_start();
  include_once("../includes/libs/dbh.php");

  $dbConnection = new dbConnection();
  $conn = $dbConnection->connect();
  $teacherId = $_SESSION['teacherID'];

  if (isset($_POST['submit'])) {
    $studentId = $_POST['student'];
    $report = $_POST['report'];

    $sql = "INSERT INTO class_reports(teacher_id, student_id, report, date) VALUES($teacherId, $studentId, '$report', curdate())";
    if ($conn->query($sql) === TRUE) {
      // echo '<script>alert("Report had been successfully sumbmitted.")</script>';
      header('location: report.php');
      die();
    }
    else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
  }
?>