<?php
  include_once('../includes/libs/dbh.php');
  
  $dbConnection = new dbConnection();
  $conn = $dbConnection->connect();

  function maxRow($conn) {
     $sql = "SELECT MAX(row_index) AS max_row FROM course_offered";
     $result = $conn->query($sql);
    $rowCount = $result->num_rows;

    if ($rowCount > 0) {
      if ($row = $result->fetch_assoc()) {
        $data = $row['max_row'];
      }
      return $data;
    }
    else {
      return $rowCount;
    }
  }

  function updateRow($conn, $index) {
    $sql = "UPDATE course_offered SET row_index = row_index + 1 WHERE row_index > $index";
    if ($conn->query($sql) === TRUE) {
      //success
    }
    else {
      // error
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }

  if (isset($_POST['submit'])) {
    $title = addslashes(trim($_POST['course_title']));
    $content = explode('$end', (trim($_POST['course_content'])));
    array_pop($content);
    $content = base64_encode(serialize($content));
    $maxRow = maxRow($conn);
    $sql = '';

    if (!empty($_POST['index']) OR $_POST['index'] == '0') {
      $index = $_POST['index'];
      updateRow($conn, $index);
      $sql = "INSERT INTO course_offered(course_title, course_content, row_index) VALUES('$title', '$content', $index + 1)";
    }
    else {
      if ($maxRow > 0) {
        $sql = "INSERT INTO course_offered(course_title, course_content, row_index) VALUES('$title', '$content', $maxRow + 1)";
      }
      else {
        $sql = "INSERT INTO course_offered(course_title, course_content, row_index) VALUES('$title', '$content', 1)";
      }    
    }

    if ($conn->query($sql) === TRUE) {
      // success
      header("location: course-offered.php");
    }
    else {
      // error
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close(); 
  }
?>