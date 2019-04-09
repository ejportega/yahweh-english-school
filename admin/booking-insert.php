<?php
  include_once('../includes/libs/dbh.php');
  $dbConnection = new dbConnection();
  $conn = $dbConnection->connect();

  if (isset($_POST['submit'])) {
    if (isset($_POST['schedule'])) {
      $studentId = $_POST['studentId'];
      $teacherId = $_POST['teacherId'];
      $sessionCount = $_POST['sessionCount'];
      $startDate = $_POST['startDate'];
      $schedule = $_POST['schedule'];
      $paymentId = $_POST['paymentId'];
      // Create an array for day schedule       
      for ($i = 0; $i < count($schedule); $i++) {
        $dayArr[] =  $schedule[$i++];
      }
      for ($i = 1; $i < count($schedule); $i+=2) {
        $timeArr[] = $schedule[$i];
      }
      // Check if array have sunday
      if ($dayArr[count($dayArr) - 1] == 'Sunday') {
        array_unshift($dayArr, array_pop($dayArr));
        array_unshift($timeArr, array_pop($timeArr));
      }
      if (in_array(date('l', strtotime($startDate)), $dayArr) > 0) {
        //true
        $week = 1;
        $numOfDays = array_search(date('l', strtotime($startDate)), $dayArr); // return false if start day not on array
        for ($i = 0 ; $i < $sessionCount ; $i++) {
          $lastDay = $dayArr[$numOfDays];
          $a[] = $lastDay;
          $count = array_count_values($a)[$lastDay];
          $dates[] = date('Y-m-d', strtotime("+$count $lastDay", strtotime($startDate)));
          $dates[] = $dayArr[$numOfDays]; 
          $dates[] = $timeArr[$numOfDays];
          $numOfDays++;
          if ($numOfDays > count($dayArr) - 1 AND $i < $sessionCount - 1) {
            $numOfDays = 0;
            $week++;
          }
        }
        
        $count = array_count_values($a)[$lastDay];
        $endDate = date('Y-m-d', strtotime("+$count $lastDay", strtotime($startDate)));

        $sql = "INSERT INTO session_details(payment_id, teacher_id, student_id, session_count, start_date, end_date) VALUES($paymentId, $teacherId, $studentId, $sessionCount, '$startDate', '$endDate')";

        if ($conn->query($sql) === TRUE) {
          $last_id = $conn->insert_id;
          updatePayment($conn, $paymentId);
          $sql = "";
          for ($i = 0; $i < count($dates); $i++) {
            $sql .= "INSERT INTO session_schedules(session_details_id, date_schedule, day_schedule, time_schedule) VALUES($last_id, '{$dates[$i++]}', '{$dates[$i++]}', '{$dates[$i]}');";
          } 
          if ($conn->multi_query($sql) === TRUE) {
            $response =  "New records created successfully";
            echo json_encode(array("c"=>1, "r"=>$response));
          }
          else {
              // echo "Error: " . $sql . "<br>" . $conn->error;
          }
        } 
        else {
            // echo "Error: " . $sql . "<br>" . $conn->error;
        }
      }
      else {
        //false
        $response = '<span class="text-danger">Start date is not in student\'s schedule.</span>';
        echo json_encode(array("c"=>2, "r"=>$response));
      }
    }
    else {
      $response = '<span class="text-danger">Please choose a schedule.</span>';
      echo json_encode(array("c"=>3, "r"=>$response));
    }
  }

  function updatePayment($conn, $paymentId) {
    $sql = "UPDATE student_payment set status='done' WHERE payment_id=$paymentId";

    if ($conn->query($sql) === TRUE) {
      // sucess
    }
    else {
      // error
    }
  }
?>