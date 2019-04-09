<?php
  session_start();
  include_once('../includes/libs/dbh.php');

  if (isset($_POST['submit'])) {
    if (isset($_POST['specialization'])) {
      $dbConnection = new dbConnection();
      $conn = $dbConnection->connect();
      $teacherId = $_SESSION['teacherID'];
      $image = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
      $education = $_POST['education'];
      $experience = $_POST['experience'];
      $specialization = serialize($_POST['specialization']); // array  
      $self= $_POST['selfIntroduction'];

      $sql = "INSERT INTO teacher_apply(teacher_id, image, education, experience, specialization, about_self, date, time)
              VALUES($teacherId, '$image', '$education', '$experience', '$specialization', '$self', curdate(), curtime())";
      if ($conn->query($sql) === TRUE) {
        //succes
        // echo "New record had been created.";
        echo json_encode(array("c"=>2));
      }
      else {
        // echo "Error: " . $sql . "<br>" . $conn->error;
      }
      $conn->close();
    }
    else {
      echo json_encode(array("c"=>1, "e"=>"Please choose atleast one in specialization."));
    }
  }
?>