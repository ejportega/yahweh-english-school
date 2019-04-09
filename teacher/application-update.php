<?php
  session_start();
  include_once('../includes/libs/dbh.php');

  $dbConnection = new dbConnection();
  $conn = $dbConnection->connect();
  $teacherId = $_SESSION['teacherID'];

  if (isset($_FILES['image'])) {
    $image = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
    
    $sql = "UPDATE teacher_apply SET image='$image' WHERE teacher_id=$teacherId";

    if ($conn->query($sql) === TRUE) {
      // success
    }
    else {
    }
  }
?>