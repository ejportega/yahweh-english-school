<?php
	include_once("includes/home/header.php");
	include_once("includes/libs/dbh.php");
?>
<body>
	<div id="wrapper">
		<div class="container">
			<div class="row" style="margin-top:10%;">
				<div class="col-lg-6">
					<div class="row justify-content-center">
						<div class="col-lg-10">
							<div class="panel-heading text-center">
								<h3>Login as a Student</h3>
							</div>
							<!-- /.panel-heading -->
							<div class="panel-body">
								<form id="form" action="includes/libs/login-student.php" method="POST">
									<fieldset>
										<div class="form-group">
											<input id="email" class="form-control" placeholder="Email Address" name="email" type="email" autofocus required>
											<div id="invalid-email" class="invalid-feedback"></div>
										</div> 
										<div class="form-group">
											<input id="password" class="form-control" placeholder="Password" name="password" type="password" required>
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
								<h3>New Student Registration</h3>
							</div>
							<!-- /.panel-heading -->
							<div class="panel-body text-justify">
								<!-- <ul class="lh-2 p-0" style="list-style-type:none">
									<li>
										<strong>Step 1: </strong>Fill out registration form.</li>
									<li>
										<strong>Step 2: </strong>Accomplish the test on the website or you can skip and direct to student's page.</li>
									<li>
										<strong>Step 3: </strong>Fill out the application form and profile page.</li>
									<li>
										<strong>Step 4: </strong>Wait for the admin's confirmation on demo schedule via qq email and chat.</li>
								</ul> -->
								<dl class="row p-0 m-0">
									<dt>Step 1:</dt>
									<dd class="col-sm-10">Fill out registration form.</dd>
									<dt>Step 2:</dt>
									<dd class="col-sm-10">Accomplish the test on the website or you can skip and direct to student's page.</dd>
									<dt>Step 3:</dt>
									<dd class="col-sm-10">Fill out the application form and profile page.</dd>
									<dt>Step 4:</dt>
									<dd class="col-sm-10">Wait for the admin's confirmation on demo schedule via qq email and chat.</dd>
								</dl>
								<a href="register-student.php" class="btn btn-lg btn-outline-success btn-block">Sign up now</a>
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
					url: 'includes/libs/login-student.php',
					type: 'post',
					data: {
						'email' : email,
						'password' : password,
						'submit' : submit
					},
					dataType : 'json',
					success: function(response) {
						if (response.c == 1) {
							displayError(response.c, response.e);
						}
						else if (response.c == 2) {
							displayError(response.c, response.e);
						}
						else {
							location.href = "student/home.php";
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