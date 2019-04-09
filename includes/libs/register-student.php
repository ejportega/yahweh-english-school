<?php
	session_start();
	include_once("dbh.php");  
	// date_default_timezone_get("Asia/Bangkok");

	if (isset($_POST['submit'])) {
		$dbConnection = new dbConnection();
		$conn = $dbConnection->connect();
		$error = '';

		$email = $conn->real_escape_string($_POST['email']);
		$sql = "SELECT email FROM teachers	WHERE email='$email' UNION SELECT email FROM students	WHERE email='$email'";
		$result = $conn->query($sql);
		
		$skype = $conn->real_escape_string($_POST['skype']);
		$sql = "SELECT skype FROM teachers	WHERE skype='$skype' UNION SELECT skype FROM students	WHERE skype='$skype'";
		$result2 = $conn->query($sql);

		if ($result->num_rows > 0) {
			echo 'email';
		}
		elseif ($result2->num_rows > 0) {
			echo 'skype';
		}
		else {
			$confirmPassword = md5($conn->real_escape_string($_POST['confirmPassword']));	
			$fname = $conn->real_escape_string(ucwords(trim($_POST['fname'])));
			$lname = $conn->real_escape_string(ucwords(trim($_POST['lname'])));
			$country = $_POST['country'];
			$age = $_POST['age'];
			$skype = $_POST['skype'];
			// $date = date("Y-m-d");
			// $time = date("H:i:s"); 
			
			$sql = "INSERT INTO students(first_name, last_name, email, password, country, skype, age, date ,time)
			VALUES('$fname', '$lname', '$email', '$confirmPassword', '$country', '$skype', $age, curdate(), curtime())";
	
			if ($conn->query($sql) === TRUE) {
				$error = 'no_error';
				$sql = "SELECT student_id FROM students WHERE email='$email'";
				$result = $conn->query($sql);
 				$row = $result->fetch_assoc(); 
				$_SESSION['studentID'] = $row['student_id'];
				echo $error;
			}
			else {
				// echo "Error: " . $sql . "<br>" . $conn->error;
			}
		}
		$conn->close();
	}
?>