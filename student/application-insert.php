<?php 
  session_start();
  include_once('../includes/libs/dbh.php');
  // require 'libs/session.php';
  
  $dbConnection = new dbConnection();
  $conn = $dbConnection->connect();

  if (isset($_POST['submit'])) {
    if (isset($_POST['day'])) {
      
      $studentId = $_SESSION['studentID'];
      $image = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
      $experience = $_POST['experience'];
      $goals = trim($_POST['goals']);
      $hobbies = trim($_POST['hobbies']);
      $ambitions = trim($_POST['ambitions']);
      $preferredSched = serialize($_POST['day']); //array
      
      $sql = "INSERT INTO student_apply(student_id, image, preferred_schedule, experience, goals, hobbies, ambition, date, time)
              VALUES($studentId, '$image', '$preferredSched', '$experience', '$goals', '$hobbies', '$ambitions', curdate(), curtime())";
      if ($conn->query($sql) === TRUE) {
        // success
        // echo "New record created successfully";
        echo json_encode(array("c"=>2));
      }
      else {
        // echo "Error: " . $sql . "<br>" . $conn->error;
      }
      $conn->close();
    }
    else {
      echo json_encode(array("c"=>1, "e"=> "Please choose a preferred schedule."));      
    }    
  }
  else {
  }
?>