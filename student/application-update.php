<?php
  session_start();
  include_once('../includes/libs/dbh.php');
  // require 'libs/session.php';

  $dbConnection = new dbConnection();
  $conn = $dbConnection->connect();
  $studentId = $_SESSION['studentID'];

  if (isset($_FILES['image'])) {
    $image = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
    
    $sql = "UPDATE student_apply SET image='$image' WHERE student_id=$studentId";

    if ($conn->query($sql) === TRUE) {
      // success
    }
    else {
    }
  }
?>