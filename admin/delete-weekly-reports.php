<?php
   include_once('../includes/libs/dbh.php');
  
   $dbConnection = new dbConnection();
   $conn = $dbConnection->connect();

  if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM class_reports WHERE class_reports_id=$id";
    if ($conn->query($sql) === TRUE) {
      // success
      header("location: weekly-reports.php");
    }
  }
?>