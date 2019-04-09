<?php
  session_start();
	include_once("../includes/libs/dbh.php");
	require 'libs/session.php';
	date_default_timezone_get("Asia/Bangkok");

	if (isset($_POST['submit'])) {
		$dbConnection = new dbConnection();
		$conn = $dbConnection->connect();

		$studentId = $_SESSION['studentID'];
		$session = $_POST['session'];
		$amount = $_POST['amount'];

		$sql = "INSERT INTO student_payment(student_id, session_count, amount, date, time)
						VALUES($studentId, $session, $amount, curdate(), curtime())";
		
		if ($conn->query($sql) === TRUE) {
      //success
      header('location: make-payment.php');
    }
    else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
		$conn->close();
	}
	else 
		echo "Error: " . $sql . "<br>" . $conn->error;
?>