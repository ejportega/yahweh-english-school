<?php
  include_once('../includes/libs/dbh.php');

  $dbConnection = new dbConnection();
  $conn = $dbConnection->connect();

  function getContent($conn, $courseId) {
    $sql = "SELECT course_title, course_content FROM course_offered WHERE course_offered_id=$courseId";
    $result = $conn->query($sql);
    $rowCount = $result->num_rows;

    if ($rowCount > 0) {
      if ($row = $result->fetch_assoc()) {
        $data[] = $row['course_title'];
        $data[] = $row['course_content'];
      }
      return $data;
    }
    else {
      return $rowCount;
    }
  }

  if (isset($_POST['course_id'])) {
    $courseId = $_POST['course_id'];
    $courseContent = getContent($conn, $courseId);
    $title = $courseContent[0];
    $content = unserialize(base64_decode($courseContent[1]));
    $contentConverted = '';
    for ($i = 0; $i < count($content); $i++) {
      $contentConverted .= $content[$i].'$end';
    }
    echo json_encode(array("t"=>$title, "c"=>$contentConverted));
  }
  elseif (isset($_POST['submit'])) {
    $courseId = trim($_POST['id']);
    $title = addslashes(trim($_POST['course_title']));
    $content = explode('$end', (trim($_POST['course_content'])));
    $content = base64_encode(serialize($content));
    
    $sql = "UPDATE course_offered SET course_title='$title', course_content='$content' WHERE course_offered_id=$courseId";

    if ($conn->query($sql) === TRUE) {
      echo "Record updated successfully";
      header('location: course-offered.php');

    } else {
        echo "Error updating record: " . $conn->error;
    } 
    $conn->close();
  }
?>