<?php
   include_once('../includes/libs/dbh.php');
  
  $dbConnection = new dbConnection();
  $conn = $dbConnection->connect();

  function updateRow($conn, $index) {
    $sql = "UPDATE course_offered SET row_index = row_index - 1 WHERE row_index > $index";
    if ($conn->query($sql) === TRUE) {
      //success
    }
    else {
      // error
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }

  if (isset($_GET['index'])) {
    $index = $_GET['index'];

    $sql = "DELETE FROM course_offered WHERE row_index=$index";
    if ($conn->query($sql) === TRUE) {
      // success
      updateRow($conn, $index);
      header("location: course-offered.php");
    }
    else {
      // error
      // echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
  }
?>