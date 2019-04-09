<?php
    include_once("includes/home/header.php");
?>

<body>
	<div id="wrapper">
		<div class="container">
			<div class="row" style="margin-top:10%;">
				<div class="col-lg-6">
					<div class="row justify-content-center">
						<div class="col-lg-10">
							<div class="panel-heading text-center">
								<h3>Login as a Teacher</h3>
							</div>
							<!-- /.panel-heading -->
							<div class="panel-body">
								<form id="form" method="POST" action="includes/libs/login-teacher.php">
									<fieldset>
										<div class="form-group">
											<input id="email" class="form-control" placeholder="Email Address" name="email" type="email" autofocus>
											<div id="invalid-email" class="invalid-feedback"></div>
										</div>
										<div class="form-group">
											<input id="password" class="form-control" placeholder="Password" name="password" type="password" value="">
											<div id="wrong-password" class="invalid-feedback">Password does not match</div>
										</div>
										<input id="submit" class="btn btn-lg btn-outline-success btn-block" type="submit" name="submit" value="Login">
									</fieldset>
								</form>
							</div>
							<!-- /.panel-body -->
						</div>
						<!-- /.row -->
					</div>
					<!-- /.col-lg-6(nested) -->
				</div>
				<!-- /.col-lg-6(first column) -->
				<div class="col-lg-6">
					<div class="row justify-content-center">
						<div class="col-lg-12">
							<div class="panel-heading text-center">
								<h3>New Teacher Registration</h3>
							</div>
							<!-- /.panel-heading -->
							<div class="panel-body text-justify">
								<!-- <ul class="lh-2 p-0" style="list-style-type:none">
									<li>
										<strong>Step 1: </strong>Accomplish the test on the website.</li>
									<li>
										<strong>Step 2: </strong>If you pass the test, input your basic information on the website.</li>
									<li>
										<strong>Step 3: </strong>Wait for the initial interview and final interview schedules.</li>
									<li>
										<strong>Step 4: </strong>After passing the final interview, submit a teaching demo video to
										<span class="orange-text">yahwehenglishschool@gmail.com</span> complete your account registration by inputting your AVAILABILITY TO TEACH
										on the website.</li>
									<li>
										<strong>Step 5: </strong>Wait for the admin's notification on your first demo class with an actual student.</li>
								</ul> -->
								<dl class="row p-0 m-0">
									<dt>Step 1:</dt>
									<dd class="col-sm-10">Accomplish the test on the website.</dd>
									<dt>Step 2:</dt>
									<dd class="col-sm-10">If you pass the test, input your basic information on the website.</dd>
									<dt>Step 3:</dt>
									<dd class="col-sm-10">Wait for the initial interview and final interview schedules.</dd>
									<dt>Step 4:</dt>
									<dd class="col-sm-10">After passing the final interview, submit a teaching demo video to
										<a href="#" class="">yahwehenglishschool@gmail.com</a> complete your account registration by inputting your AVAILABILITY TO TEACH
										on the website.</dd>
									<dt>Step 5:</dt>
									<dd class="col-sm-10">Wait for the admin's notification on your first demo class with an actual student.</dd>
								</dl>
								<a class="btn btn-outline-success btn-lg btn-block" href="teacher/exam-instruction.php">Sign up now</a>
							</div>
							<!-- /.panel-body -->
						</div>
						<!-- /.row -->
					</div>
					<!-- /.col-lg-6(nested) -->
				</div>
				<!-- /.col-lg-6(first column) -->
			</div>
			<!-- /.row -->
		</div>
		<!-- /.container -->
	</div>
	<!-- /.wrapper -->
	<script>
		$(document).ready(function() {
			$('form').submit(function(e) {
				var email = $('#email').val();
				var password = $('#password').val();
				var submit = $('#submit').val();
				$.ajax({
					url: 'includes/libs/login-teacher.php',
					type: 'post',
					data: {
						'email' : email,
						'password' : password,
						'submit' : submit
					},
					dataType : 'json',
					success: function(response) {
						console.log(response.c);
						if (response.c == 1) {
							displayError(response.c, response.e);
						}
						else if (response.c == 2) {
							displayError(response.c, response.e);
						}
						else {
							location.href = "teacher/application-details.php";
						}
					}
				});
				e.preventDefault();
			});
		});

		$('#form').find('input').change(function() {
			var check = $(this).is(':valid');
			if (check == false) {
				$(this).addClass('is-invalid');
			}
			else {
				$(this).removeClass('is-invalid');
			}
		});

		function displayError(c, error) {
			if (c == 1) {
				$('#wrong-password').siblings('input').addClass('is-invalid');
				$('#wrong-password').text(error);
			}
			else {
				$('#invalid-email').siblings('input').addClass('is-invalid');
				$('#invalid-email').text(error);
			}
		}

	</script>
</body>