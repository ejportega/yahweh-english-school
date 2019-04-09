<?php
	session_start();
	include_once("../includes/home/header.php"); 
	include_once("../includes/libs/dbh.php");
	require 'libs/session.php';

	$level = $_GET['level'];
	if (isset($_GET['done'])) {
		$dbConnection = new dbConnection();
		$conn = $dbConnection->connect();

		if (isset($_SESSION['studentID'])) {
			$studentId = $_SESSION['studentID'];
			$studentLevel = $_GET['studentLevel'];
			echo $studentLevel;	
			$sql = "UPDATE students SET level='$studentLevel' WHERE student_id=$studentId";
			if ($conn->query($sql) === TRUE) {
				header('location: application-details.php');
			}
			else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
		}
		$conn->close();
	}

	function score() {
			if(isset($_GET['score'])) {
					$score = $_GET['score'];
					$overall = $_GET['overall'];
					if($score >= ceil($overall/2)) {
							echo "<span class='text-success'>$score/$overall</span>";
					}
					else {
							echo "<span class='text-danger'>$score/$overall</span>";
					}
			}
	}

	function result() {
		if(isset($_GET['score'])) {
			$score = $_GET['score'];
			$overall = $_GET['overall'];
			$level = $_GET['level'];
			if($score >= ceil($overall/2)) {
					echo "<span>You passed the ".getLevel($level)."</span>";
			}
			else {
					echo "<span>You failed the ".getLevel($level)."</span>";
			}
		}
	}

	function getLevel($level) {
		switch($level) {
			case 0:
					return "Unrated";
					break;
			case 1:
					return "Elementary Level";
					break;
			case 2:
					return "Intermediate Level";
					break;
			case 3:
					return "Upper Intermediate Level";
					break;
			case 4:
					return "Advanced Level";
					break;
		}
	}

	function getProceed() {
			$score = $_GET['score'];
			$overall = $_GET['overall'];
			$level = $_GET['level'];
			if ($level < 4) {
				if ($score >= ceil($overall/2)) {
						echo '<a class="btn btn-outline-success btn-block" href="exam.php?level='.++$level.'">Next</a>';
				}
				else {
					echo
					'<form method="GET" action="#">
						<input class="a-btn btn btn-outline-success btn-block" type="submit" name="done" value="Done">
						<input type="hidden" name="studentLevel" value="'.getLevel(--$level).'">
					</form>';
				}
			}
			else {
				echo 
					'<form method="GET" action="#">
						<input class="a-btn btn btn-outline-success btn-block" type="submit" name="done" value="Done">';
				if ($score >= ceil($overall/2)) {
					echo	
					'<input type="hidden" name="studentLevel" value="'.getLevel($level).'">';
				}
				else {
					echo
					'<input type="hidden" name="studentLevel" value="'.getLevel(--$level).'">';
				}
				echo
					'</form>';
			}
	}
?>

<body>
	<div id="wrapper">
		<div class="container">
			<div class="row justify-content-center" style="margin-top: 10%">
				<div class="col-lg-6">
					<div class="panel-heading text-center">
						<h2>Test Result</h2>
					</div>
					<div class="panel-body">
						<dl class="row m-0">
							<dt class="col-lg-2">Test:</dt>
							<dd class="col-lg-10">Grammar Test for
								<?php echo getLevel($level)?>
							</dd>
						</dl>
						<dl class="row m-0">
							<dt class="col-lg-2">Score:</dt>
							<dd class="col-lg-10">
								<?php score()?>
							</dd>
						</dl>
						<dl class="row m-0">
							<dt class="col-lg-2">Result:</dt>
							<dd class="col-lg-10">
								<?php result() ?>
							</dd>
						</dl>
						<dl class="row m-0">
<?php
	$score = $_GET['score'];
	$overall = $_GET['overall'];
	$level = $_GET['level'];
	if ($level < 4) {
			if ($score >= ceil($overall/2)) {
			}
			else {
				echo
				'<dt class="col-lg-2">Status:</dt>
				<dd class="col-lg-10">'.getLevel(--$level).'</dd>';
			}
	}
	else {
		if ($score >= ceil($overall/2)) {
			echo
			'<dt class="col-lg-2">Status:</dt>
			<dd class="col-lg-10">'.getLevel($level).'</dd>';
		}
		else {
			echo
			'<dt class="col-lg-2">Status:</dt>
			<dd class="col-lg-10">'.getLevel(--$level).'</dd>';
		}
	}
?>
						</dl>
						<!-- Done -->
						<div class="row mt-3 m-0">
							<div class="col-lg-12">
								<?php getProceed() ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php include_once("../includes/home/js.php") ?>
</body>