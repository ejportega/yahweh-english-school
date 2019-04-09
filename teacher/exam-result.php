<?php
	session_start();
	include_once("../includes/home/header.php"); 
	
	function score() {
			if(isset($_GET['score'])) {
					$score = $_GET['score'];
					if($score > 7) {
							echo "<span class='text-success col-lg-10 p-0'>$score/15</span>";
					}
					else {
							echo "<span class='text-danger col-lg-10 p-0'>$score/15</span>";
					}
			}
	}

	function result() {
			if(isset($_GET['score'])) {
					$score = $_GET['score'];
					if($score > 7) {
							echo "<span class=''>Congratulation you passed the exam.</span>";
					}
					else {
							echo "<span class=''>Sorry you failed the exam. You may retake the exam.</span>";
					}
			}
	}

	function getProceed() {
			if (isset($_GET['score'])) {
					$score = $_GET['score'];
					if ($score > 7) {
							echo '<a class="btn btn-outline-success btn-block" href="../register-teacher.php">Done</a>';
					}
					else {
							echo '<a class="btn btn-outline-success btn-block" href="../login-teacher.php">Done</a>';
					}
			}
	}

?>
	<style>
		* {
			font-size: 16px;
		}
	</style>

<body>
	<div id="wrapper">
		<div class="container">
			<div class="row justify-content-center" style="margin-top: 10%">
				<div class="col-lg-6">
					<div class="panel-heading text-center">
						<h2>Test Result</h2>
					</div>
					<div class="panel-body lh-2">
						<div class="row">
							<strong class="col-lg-2 text-left">Test:</strong>
							<span class="col-lg-10 p-0">Grammar Level Test for Teachers</span>
							<strong class="col-lg-2 text-left">Score:</strong>
							<?php score(); ?>
							<strong class="col-lg-2 text-left">Result:</strong>
							<?php result(); ?>
						</div>
						<?php getProceed() ?>
					</div>
				</div>
			</div>
		</div>
		<?php include_once("../includes/home/js.php") ?>
</body>