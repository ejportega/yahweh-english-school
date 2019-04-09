<?php
	session_start();
	include_once("../includes/home/header.php");
	include_once("../includes/libs/dbh.php");
	require 'libs/session.php';
	
	if (isset($_GET['skip'])) {
		$dbConnection = new dbConnection();
		$conn = $dbConnection->connect();

		if (isset($_SESSION['studentID'])) {
			$studentId = $_SESSION['studentID'];
			$sql = "UPDATE students SET level='Unrated' WHERE student_id =$studentId";
			if ($conn->query($sql) === TRUE) {
				header('location: application-details.php');
			}
			else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
		}
		$conn->close();
	}
?>
<style>
	a,
	a:hover {
		color: #fff;
		text-decoration: none;
	}
</style>
<body>
	<div id="wrapper">
		<div class="container">
			<div class="row justify-content-center" style="margin-top: 10%;">
				<div class="col-lg-8">
					<div class="panel-heading text-center">
						<h2>Grammar Level Test for Students</h2>
					</div>
					<!-- /.panel-heading -->
					<div class="panel-body lh-2 text-justify">
						<dl>
							<dt>Instructions:</dt>
							<ul>
								<li>The test type is multiple choice questions and the duration is approximately 8 to 10 minutes.</li>
								<li>There are 4 levels of test(Elementary, Intermediate, Upper Intermediate and Advanced).</li>
								<li>Every test you passed will determine the level of your English skills.</li>
								<li>Each question has 3 options.</li>
								<li>Choose the best answer.</li>
								<li>You must answer each question before proceeding to the next question. You will not be able to change an answer once
									you've moved to the next question.</li>
								<li>You can skip the test and proceed to the login page.</li>
							</ul>
						</dl>
					</div>
					<div class="row justify-content-center">
						<a href="exam.php">
							<button class="btn btn-outline-success">Start test</button>
						</a>
						<div class="col-lg-1"></div>
						<form action="#" method="GET">
							<input class="btn btn-outline-danger" type="submit" name="skip" value="Skip test">
						</form>
						<!-- <a href="application-form.php">
							<button class="btn btn-outline-danger">Skip test</button>
						</a> -->
						</form>	
					</div>
					<!-- /.panel-body -->
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<!-- /.row -->
		</div>
		<!-- /.container -->
	</div>
	<!-- /.wrapper -->
</body>
