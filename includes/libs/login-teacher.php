<?php
  session_start();
  include_once('dbh.php');

  $errorMessage = '';
  if (isset($_POST['submit'])) {
    $dbConnection = new dbConnection();
    $conn = $dbConnection->connect();
    $email = $conn->real_escape_string($_POST['email']);
    $password = md5($conn->real_escape_string($_POST['password']));

    $sql = "SELECT * FROM teachers WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      if ($password == $row['password']) {
        $_SESSION['teacherID'] = $row['teacher_id'];
        echo json_encode(array("c"=>3));
        die();
      }
      else {
        echo json_encode(array("c"=>1, "e"=>'Password does not match.'));
      }
    }
    else {
      echo json_encode(array("c"=>2, "e"=>'The email address was not recognized.'));
    }
    $conn->close();
  }
?>