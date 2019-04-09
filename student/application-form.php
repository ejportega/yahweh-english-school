<?php
	session_start();
	include_once("header.php");
	include_once("navbar.php");
	// require 'libs/session.php';
?>
<!-- DISPLAY UPLOAD IMAGE -->
<script type="text/javascript">
    function readURL(input) {       

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#displayImage').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#imgUpload").change(function(){
    readURL(this);
});
</script>
<style>
    small {font-size: 14px !important; }
</style>
<body class="fixed-nav sticky-footer" id="page-top">
	<div class="content-wrapper">
		<div class="container-fluid">
			<div class="panel panel-default">
				<div class="panel-heading">
					Application Form
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body">
					<div class="col-lg-6 mx-auto">
						<form id="form" action="application-insert.php" method="POST" enctype="multipart/form-data">
							<!-- Profile picture -->
							<div class="form-group mx-auto" style="width:300px;">
								<div>
									<img src="../images/default-profile-image.png" id="image-chosen" class=" profile-img rounded-circle mx-auto d-block" alt="choose an image">
								</div>
								<div class="text-center my-2">
									<label class="text-left custom-file">
										<input id="image-chooser" type="file" class="custom-file-input" name="image" accept="image/*" required>
										<span class="custom-file-control form-control-sm"></span>
									</label>
									<!-- Display iamge -->
									<script>
										function readURL(input) {
											if (input.files && input.files[0]) {
												var reader = new FileReader();

												reader.onload = function (e) {
													$('#image-chosen').attr('src', e.target.result);
												}

												reader.readAsDataURL(input.files[0]);
											}
										}
										$("#image-chooser").change(function () {
											readURL(this);
										});
									</script>
								</div>
							</div>
							<!-- /.image -->
							<!-- schedule -->
							<div class="form-group">
								<label class="font-weight-bold">Preffered Schedule</label>
								<div id="schedule-error" class="text-danger"></div>
								<div id="time-error" class="text-danger">Start time should be less than end time.</div>
								<!-- Monday -->
								<div class="schedule-container row mb-2">
									<div class="form-inline col-lg-3 ">
										<div class="form-check">
											<label class="form-check-label">
												<input class="form-check-input position-static" type="checkbox" name="day[]" value="Monday">
													Monday
											</label>
										</div>
									</div>
									<!-- /.inline -->
									<div class="time-container form-inline col-lg-8 justify-content-between">
										<div class="input-group">
											<div class="input-group-addon"><i class="far fa-clock fa-lg"></i></div>
											<select class="start form-control form-control-sm" name="day[]">
												<option value="" hidden selected disabled selected disabled selected disabled>start to</option>
												<!-- <option  data-divider="true"></option> -->
												<option value="6:00">6:00</option>
												<option value="6:30">6:30</option>
												<option value="7:00">7:00</option>
												<option value="7:30">7:30</option>
												<option value="8:00">8:00</option>
												<option value="8:30">8:30</option>
												<option value="9:00">9:00</option>
												<option value="9:30">9:30</option>
												<option value="10:00">10:00</option>
												<option value="10:30">10:30</option>
												<option value="11:00">11:00</option>
												<option value="11:30">11:30</option>
												<option value="12:00">12:00</option>
												<option value="12:30">12:30</option>
												<option value="13:00">13:00</option>
												<option value="13:30">13:30</option>
												<option value="14:00">14:00</option>
												<option value="14:30">14:30</option>
												<option value="15:00">15:00</option>
												<option value="15:30">15:30</option>
												<option value="16:00">16:00</option>
												<option value="16:30">16:30</option>
												<option value="17:00">17:00</option>
												<option value="17:30">17:30</option>
												<option value="18:00">18:00</option>
												<option value="18:30">18:30</option>
												<option value="19:00">19:00</option>
												<option value="19:30">19:30</option>
												<option value="20:00">20:00</option>
												<option value="20:30">20:30</option>
												<option value="21:00">21:00</option>
												<option value="21:30">21:30</option>
												<option value="22:00">22:00</option>
												<option value="22:30">22:30</option>
												<option value="23:00">23:00</option>
											</select>
										</div>
										<!-- /.input-group -->
										<span>to</span>
										<div class="input-group">
											<div class="input-group-addon"><i class="far fa-clock fa-lg"></i></div>
											<select class="end form-control form-control-sm" name="day[]">
												<option value="" hidden selected disabled selected disabled selected disabled>end to</option>
												<!-- <option  data-divider="true"></option> -->
												<option value="6:30">6:30</option>
												<option value="7:00">7:00</option>
												<option value="7:30">7:30</option>
												<option value="8:00">8:00</option>
												<option value="8:30">8:30</option>
												<option value="9:00">9:00</option>
												<option value="9:30">9:30</option>
												<option value="10:00">10:00</option>
												<option value="10:30">10:30</option>
												<option value="11:00">11:00</option>
												<option value="11:30">11:30</option>
												<option value="12:00">12:00</option>
												<option value="12:30">12:30</option>
												<option value="13:00">13:00</option>
												<option value="13:30">13:30</option>
												<option value="14:00">14:00</option>
												<option value="14:30">14:30</option>
												<option value="15:00">15:00</option>
												<option value="15:30">15:30</option>
												<option value="16:00">16:00</option>
												<option value="16:30">16:30</option>
												<option value="17:00">17:00</option>
												<option value="17:30">17:30</option>
												<option value="18:00">18:00</option>
												<option value="18:30">18:30</option>
												<option value="19:00">19:00</option>
												<option value="19:30">19:30</option>
												<option value="20:00">20:00</option>
												<option value="20:30">20:30</option>
												<option value="21:00">21:00</option>
												<option value="21:30">21:30</option>
												<option value="22:00">22:00</option>
												<option value="22:30">22:30</option>
												<option value="23:00">23:00</option>
												<option value="23:30">23:30</option>
											</select>
										</div>
										<!-- /.input-group -->
									</div>
									<!-- /.form-inline -->
								</div>
								<!-- /.row -->
								<!-- Tuesday -->
								<div class="schedule-container row mb-2">
									<div class="form-inline col-lg-3 ">
										<div class="form-check">
											<label class="form-check-label">
												<input class="form-check-input position-static" type="checkbox" name="day[]" value="Tuesday">
													Tuesday
											</label>
										</div>
									</div>
									<!-- /.inline -->
									<div class="time-container form-inline col-lg-8 justify-content-between">
										<div class="input-group">
											<div class="input-group-addon"><i class="far fa-clock fa-lg"></i></div>
											<select class="start form-control form-control-sm" name="day[]">
												<option value="" hidden selected disabled selected disabled selected disabled>start to</option>
												<!-- <option  data-divider="true"></option> -->
												<option value="6:00">6:00</option>
												<option value="6:30">6:30</option>
												<option value="7:00">7:00</option>
												<option value="7:30">7:30</option>
												<option value="8:00">8:00</option>
												<option value="8:30">8:30</option>
												<option value="9:00">9:00</option>
												<option value="9:30">9:30</option>
												<option value="10:00">10:00</option>
												<option value="10:30">10:30</option>
												<option value="11:00">11:00</option>
												<option value="11:30">11:30</option>
												<option value="12:00">12:00</option>
												<option value="12:30">12:30</option>
												<option value="13:00">13:00</option>
												<option value="13:30">13:30</option>
												<option value="14:00">14:00</option>
												<option value="14:30">14:30</option>
												<option value="15:00">15:00</option>
												<option value="15:30">15:30</option>
												<option value="16:00">16:00</option>
												<option value="16:30">16:30</option>
												<option value="17:00">17:00</option>
												<option value="17:30">17:30</option>
												<option value="18:00">18:00</option>
												<option value="18:30">18:30</option>
												<option value="19:00">19:00</option>
												<option value="19:30">19:30</option>
												<option value="20:00">20:00</option>
												<option value="20:30">20:30</option>
												<option value="21:00">21:00</option>
												<option value="21:30">21:30</option>
												<option value="22:00">22:00</option>
												<option value="22:30">22:30</option>
												<option value="23:00">23:00</option>
											</select>
										</div>
										<!-- /.input-group -->
										<span>to</span>
										<div class="input-group">
											<div class="input-group-addon"><i class="far fa-clock fa-lg"></i></div>
											<select class="end form-control form-control-sm" name="day[]">
												<option value="" hidden selected disabled selected disabled selected disabled>end to</option>
												<!-- <option  data-divider="true"></option> -->
												<option value="6:30">6:30</option>
												<option value="7:00">7:00</option>
												<option value="7:30">7:30</option>
												<option value="8:00">8:00</option>
												<option value="8:30">8:30</option>
												<option value="9:00">9:00</option>
												<option value="9:30">9:30</option>
												<option value="10:00">10:00</option>
												<option value="10:30">10:30</option>
												<option value="11:00">11:00</option>
												<option value="11:30">11:30</option>
												<option value="12:00">12:00</option>
												<option value="12:30">12:30</option>
												<option value="13:00">13:00</option>
												<option value="13:30">13:30</option>
												<option value="14:00">14:00</option>
												<option value="14:30">14:30</option>
												<option value="15:00">15:00</option>
												<option value="15:30">15:30</option>
												<option value="16:00">16:00</option>
												<option value="16:30">16:30</option>
												<option value="17:00">17:00</option>
												<option value="17:30">17:30</option>
												<option value="18:00">18:00</option>
												<option value="18:30">18:30</option>
												<option value="19:00">19:00</option>
												<option value="19:30">19:30</option>
												<option value="20:00">20:00</option>
												<option value="20:30">20:30</option>
												<option value="21:00">21:00</option>
												<option value="21:30">21:30</option>
												<option value="22:00">22:00</option>
												<option value="22:30">22:30</option>
												<option value="23:00">23:00</option>
												<option value="23:30">23:30</option>
											</select>
										</div>
										<!-- /.input-group -->
									</div>
									<!-- /.form-inline -->
								</div>
								<!-- /.row -->
								<!-- Wednesday -->
								<div class="schedule-container row mb-2">
									<div class="form-inline col-lg-3 ">
										<div class="form-check">
											<label class="form-check-label">
												<input class="form-check-input position-static" type="checkbox" name="day[]" value="Wednesday">
													Wednesday
											</label>
										</div>
									</div>
									<!-- /.inline -->
									<div class="time-container form-inline col-lg-8 justify-content-between">
										<div class="input-group">
											<div class="input-group-addon"><i class="far fa-clock fa-lg"></i></div>
											<select class="start form-control form-control-sm" name="day[]">
												<option value="" hidden selected disabled selected disabled selected disabled>start to</option>
												<!-- <option  data-divider="true"></option> -->
												<option value="6:00">6:00</option>
												<option value="6:30">6:30</option>
												<option value="7:00">7:00</option>
												<option value="7:30">7:30</option>
												<option value="8:00">8:00</option>
												<option value="8:30">8:30</option>
												<option value="9:00">9:00</option>
												<option value="9:30">9:30</option>
												<option value="10:00">10:00</option>
												<option value="10:30">10:30</option>
												<option value="11:00">11:00</option>
												<option value="11:30">11:30</option>
												<option value="12:00">12:00</option>
												<option value="12:30">12:30</option>
												<option value="13:00">13:00</option>
												<option value="13:30">13:30</option>
												<option value="14:00">14:00</option>
												<option value="14:30">14:30</option>
												<option value="15:00">15:00</option>
												<option value="15:30">15:30</option>
												<option value="16:00">16:00</option>
												<option value="16:30">16:30</option>
												<option value="17:00">17:00</option>
												<option value="17:30">17:30</option>
												<option value="18:00">18:00</option>
												<option value="18:30">18:30</option>
												<option value="19:00">19:00</option>
												<option value="19:30">19:30</option>
												<option value="20:00">20:00</option>
												<option value="20:30">20:30</option>
												<option value="21:00">21:00</option>
												<option value="21:30">21:30</option>
												<option value="22:00">22:00</option>
												<option value="22:30">22:30</option>
												<option value="23:00">23:00</option>
											</select>
										</div>
										<!-- /.input-group -->
										<span>to</span>
										<div class="input-group">
											<div class="input-group-addon"><i class="far fa-clock fa-lg"></i></div>
											<select class="end form-control form-control-sm" name="day[]">
												<option value="" hidden selected disabled selected disabled selected disabled>end to</option>
												<!-- <option  data-divider="true"></option> -->
												<option value="6:30">6:30</option>
												<option value="7:00">7:00</option>
												<option value="7:30">7:30</option>
												<option value="8:00">8:00</option>
												<option value="8:30">8:30</option>
												<option value="9:00">9:00</option>
												<option value="9:30">9:30</option>
												<option value="10:00">10:00</option>
												<option value="10:30">10:30</option>
												<option value="11:00">11:00</option>
												<option value="11:30">11:30</option>
												<option value="12:00">12:00</option>
												<option value="12:30">12:30</option>
												<option value="13:00">13:00</option>
												<option value="13:30">13:30</option>
												<option value="14:00">14:00</option>
												<option value="14:30">14:30</option>
												<option value="15:00">15:00</option>
												<option value="15:30">15:30</option>
												<option value="16:00">16:00</option>
												<option value="16:30">16:30</option>
												<option value="17:00">17:00</option>
												<option value="17:30">17:30</option>
												<option value="18:00">18:00</option>
												<option value="18:30">18:30</option>
												<option value="19:00">19:00</option>
												<option value="19:30">19:30</option>
												<option value="20:00">20:00</option>
												<option value="20:30">20:30</option>
												<option value="21:00">21:00</option>
												<option value="21:30">21:30</option>
												<option value="22:00">22:00</option>
												<option value="22:30">22:30</option>
												<option value="23:00">23:00</option>
												<option value="23:30">23:30</option>
											</select>
										</div>
										<!-- /.input-group -->
									</div>
									<!-- /.form-inline -->
								</div>
								<!-- /.row -->
								<!-- Thursday -->
								<div class="schedule-container row mb-2">
									<div class="form-inline col-lg-3 ">
										<div class="form-check">
											<label class="form-check-label">
												<input class="form-check-input position-static" type="checkbox" name="day[]" value="Thursday">
													Thursday
											</label>
										</div>
									</div>
									<!-- /.inline -->
									<div class="time-container form-inline col-lg-8 justify-content-between">
										<div class="input-group">
											<div class="input-group-addon"><i class="far fa-clock fa-lg"></i></div>
											<select class="start form-control form-control-sm" name="day[]">
												<option value="" hidden selected disabled selected disabled selected disabled>start to</option>
												<!-- <option  data-divider="true"></option> -->
												<option value="6:00">6:00</option>
												<option value="6:30">6:30</option>
												<option value="7:00">7:00</option>
												<option value="7:30">7:30</option>
												<option value="8:00">8:00</option>
												<option value="8:30">8:30</option>
												<option value="9:00">9:00</option>
												<option value="9:30">9:30</option>
												<option value="10:00">10:00</option>
												<option value="10:30">10:30</option>
												<option value="11:00">11:00</option>
												<option value="11:30">11:30</option>
												<option value="12:00">12:00</option>
												<option value="12:30">12:30</option>
												<option value="13:00">13:00</option>
												<option value="13:30">13:30</option>
												<option value="14:00">14:00</option>
												<option value="14:30">14:30</option>
												<option value="15:00">15:00</option>
												<option value="15:30">15:30</option>
												<option value="16:00">16:00</option>
												<option value="16:30">16:30</option>
												<option value="17:00">17:00</option>
												<option value="17:30">17:30</option>
												<option value="18:00">18:00</option>
												<option value="18:30">18:30</option>
												<option value="19:00">19:00</option>
												<option value="19:30">19:30</option>
												<option value="20:00">20:00</option>
												<option value="20:30">20:30</option>
												<option value="21:00">21:00</option>
												<option value="21:30">21:30</option>
												<option value="22:00">22:00</option>
												<option value="22:30">22:30</option>
												<option value="23:00">23:00</option>
											</select>
										</div>
										<!-- /.input-group -->
										<span>to</span>
										<div class="input-group">
											<div class="input-group-addon"><i class="far fa-clock fa-lg"></i></div>
											<select class="end form-control form-control-sm" name="day[]">
												<option value="" hidden selected disabled selected disabled selected disabled>end to</option>
												<!-- <option  data-divider="true"></option> -->
												<option value="6:30">6:30</option>
												<option value="7:00">7:00</option>
												<option value="7:30">7:30</option>
												<option value="8:00">8:00</option>
												<option value="8:30">8:30</option>
												<option value="9:00">9:00</option>
												<option value="9:30">9:30</option>
												<option value="10:00">10:00</option>
												<option value="10:30">10:30</option>
												<option value="11:00">11:00</option>
												<option value="11:30">11:30</option>
												<option value="12:00">12:00</option>
												<option value="12:30">12:30</option>
												<option value="13:00">13:00</option>
												<option value="13:30">13:30</option>
												<option value="14:00">14:00</option>
												<option value="14:30">14:30</option>
												<option value="15:00">15:00</option>
												<option value="15:30">15:30</option>
												<option value="16:00">16:00</option>
												<option value="16:30">16:30</option>
												<option value="17:00">17:00</option>
												<option value="17:30">17:30</option>
												<option value="18:00">18:00</option>
												<option value="18:30">18:30</option>
												<option value="19:00">19:00</option>
												<option value="19:30">19:30</option>
												<option value="20:00">20:00</option>
												<option value="20:30">20:30</option>
												<option value="21:00">21:00</option>
												<option value="21:30">21:30</option>
												<option value="22:00">22:00</option>
												<option value="22:30">22:30</option>
												<option value="23:00">23:00</option>
												<option value="23:30">23:30</option>
											</select>
										</div>
										<!-- /.input-group -->
									</div>
									<!-- /.form-inline -->
								</div>
								<!-- /.row -->
								<!-- Friday -->
								<div class="schedule-container row mb-2">
									<div class="form-inline col-lg-3 ">
										<div class="form-check">
											<label class="form-check-label">
												<input class="form-check-input position-static" type="checkbox" name="day[]" value="Friday">
													Friday
											</label>
										</div>
									</div>
									<!-- /.inline -->
									<div class="time-container form-inline col-lg-8 justify-content-between">
										<div class="input-group">
											<div class="input-group-addon"><i class="far fa-clock fa-lg"></i></div>
											<select class="start form-control form-control-sm" name="day[]">
												<option value="" hidden selected disabled selected disabled selected disabled>start to</option>
												<!-- <option  data-divider="true"></option> -->
												<option value="6:00">6:00</option>
												<option value="6:30">6:30</option>
												<option value="7:00">7:00</option>
												<option value="7:30">7:30</option>
												<option value="8:00">8:00</option>
												<option value="8:30">8:30</option>
												<option value="9:00">9:00</option>
												<option value="9:30">9:30</option>
												<option value="10:00">10:00</option>
												<option value="10:30">10:30</option>
												<option value="11:00">11:00</option>
												<option value="11:30">11:30</option>
												<option value="12:00">12:00</option>
												<option value="12:30">12:30</option>
												<option value="13:00">13:00</option>
												<option value="13:30">13:30</option>
												<option value="14:00">14:00</option>
												<option value="14:30">14:30</option>
												<option value="15:00">15:00</option>
												<option value="15:30">15:30</option>
												<option value="16:00">16:00</option>
												<option value="16:30">16:30</option>
												<option value="17:00">17:00</option>
												<option value="17:30">17:30</option>
												<option value="18:00">18:00</option>
												<option value="18:30">18:30</option>
												<option value="19:00">19:00</option>
												<option value="19:30">19:30</option>
												<option value="20:00">20:00</option>
												<option value="20:30">20:30</option>
												<option value="21:00">21:00</option>
												<option value="21:30">21:30</option>
												<option value="22:00">22:00</option>
												<option value="22:30">22:30</option>
												<option value="23:00">23:00</option>
											</select>
										</div>
										<!-- /.input-group -->
										<span>to</span>
										<div class="input-group">
											<div class="input-group-addon"><i class="far fa-clock fa-lg"></i></div>
											<select class="end form-control form-control-sm" name="day[]">
												<option value="" hidden selected disabled selected disabled selected disabled>end to</option>
												<!-- <option  data-divider="true"></option> -->
												<option value="6:30">6:30</option>
												<option value="7:00">7:00</option>
												<option value="7:30">7:30</option>
												<option value="8:00">8:00</option>
												<option value="8:30">8:30</option>
												<option value="9:00">9:00</option>
												<option value="9:30">9:30</option>
												<option value="10:00">10:00</option>
												<option value="10:30">10:30</option>
												<option value="11:00">11:00</option>
												<option value="11:30">11:30</option>
												<option value="12:00">12:00</option>
												<option value="12:30">12:30</option>
												<option value="13:00">13:00</option>
												<option value="13:30">13:30</option>
												<option value="14:00">14:00</option>
												<option value="14:30">14:30</option>
												<option value="15:00">15:00</option>
												<option value="15:30">15:30</option>
												<option value="16:00">16:00</option>
												<option value="16:30">16:30</option>
												<option value="17:00">17:00</option>
												<option value="17:30">17:30</option>
												<option value="18:00">18:00</option>
												<option value="18:30">18:30</option>
												<option value="19:00">19:00</option>
												<option value="19:30">19:30</option>
												<option value="20:00">20:00</option>
												<option value="20:30">20:30</option>
												<option value="21:00">21:00</option>
												<option value="21:30">21:30</option>
												<option value="22:00">22:00</option>
												<option value="22:30">22:30</option>
												<option value="23:00">23:00</option>
												<option value="23:30">23:30</option>
											</select>
										</div>
										<!-- /.input-group -->
									</div>
									<!-- /.form-inline -->
								</div>
								<!-- /.row -->
								<!-- Saturday -->
								<div class="schedule-container row mb-2">
									<div class="form-inline col-lg-3 ">
										<div class="form-check">
											<label class="form-check-label">
												<input class="form-check-input position-static" type="checkbox" name="day[]" value="Saturday">
													Saturday
											</label>
										</div>
									</div>
									<!-- /.inline -->
									<div class="time-container form-inline col-lg-8 justify-content-between">
										<div class="input-group">
											<div class="input-group-addon"><i class="far fa-clock fa-lg"></i></div>
											<select class="start form-control form-control-sm" name="day[]">
												<option value="" hidden selected disabled selected disabled selected disabled>start to</option>
												<!-- <option  data-divider="true"></option> -->
												<option value="6:00">6:00</option>
												<option value="6:30">6:30</option>
												<option value="7:00">7:00</option>
												<option value="7:30">7:30</option>
												<option value="8:00">8:00</option>
												<option value="8:30">8:30</option>
												<option value="9:00">9:00</option>
												<option value="9:30">9:30</option>
												<option value="10:00">10:00</option>
												<option value="10:30">10:30</option>
												<option value="11:00">11:00</option>
												<option value="11:30">11:30</option>
												<option value="12:00">12:00</option>
												<option value="12:30">12:30</option>
												<option value="13:00">13:00</option>
												<option value="13:30">13:30</option>
												<option value="14:00">14:00</option>
												<option value="14:30">14:30</option>
												<option value="15:00">15:00</option>
												<option value="15:30">15:30</option>
												<option value="16:00">16:00</option>
												<option value="16:30">16:30</option>
												<option value="17:00">17:00</option>
												<option value="17:30">17:30</option>
												<option value="18:00">18:00</option>
												<option value="18:30">18:30</option>
												<option value="19:00">19:00</option>
												<option value="19:30">19:30</option>
												<option value="20:00">20:00</option>
												<option value="20:30">20:30</option>
												<option value="21:00">21:00</option>
												<option value="21:30">21:30</option>
												<option value="22:00">22:00</option>
												<option value="22:30">22:30</option>
												<option value="23:00">23:00</option>
											</select>
										</div>
										<!-- /.input-group -->
										<span>to</span>
										<div class="input-group">
											<div class="input-group-addon"><i class="far fa-clock fa-lg"></i></div>
											<select class="end form-control form-control-sm" name="day[]">
												<option value="" hidden selected disabled selected disabled selected disabled>end to</option>
												<!-- <option  data-divider="true"></option> -->
												<option value="6:30">6:30</option>
												<option value="7:00">7:00</option>
												<option value="7:30">7:30</option>
												<option value="8:00">8:00</option>
												<option value="8:30">8:30</option>
												<option value="9:00">9:00</option>
												<option value="9:30">9:30</option>
												<option value="10:00">10:00</option>
												<option value="10:30">10:30</option>
												<option value="11:00">11:00</option>
												<option value="11:30">11:30</option>
												<option value="12:00">12:00</option>
												<option value="12:30">12:30</option>
												<option value="13:00">13:00</option>
												<option value="13:30">13:30</option>
												<option value="14:00">14:00</option>
												<option value="14:30">14:30</option>
												<option value="15:00">15:00</option>
												<option value="15:30">15:30</option>
												<option value="16:00">16:00</option>
												<option value="16:30">16:30</option>
												<option value="17:00">17:00</option>
												<option value="17:30">17:30</option>
												<option value="18:00">18:00</option>
												<option value="18:30">18:30</option>
												<option value="19:00">19:00</option>
												<option value="19:30">19:30</option>
												<option value="20:00">20:00</option>
												<option value="20:30">20:30</option>
												<option value="21:00">21:00</option>
												<option value="21:30">21:30</option>
												<option value="22:00">22:00</option>
												<option value="22:30">22:30</option>
												<option value="23:00">23:00</option>
												<option value="23:30">23:30</option>
											</select>
										</div>
										<!-- /.input-group -->
									</div>
									<!-- /.form-inline -->
								</div>
								<!-- /.row -->
								<!-- Sunday -->
								<div class="schedule-container row mb-2">
									<div class="form-inline col-lg-3 ">
										<div class="form-check">
											<label class="form-check-label">
												<input class="form-check-input position-static" type="checkbox" name="day[]" value="Sunday">
													Sunday
											</label>
										</div>
									</div>
									<!-- /.inline -->
									<div class="time-container form-inline col-lg-8 justify-content-between">
										<div class="input-group">
											<div class="input-group-addon"><i class="far fa-clock fa-lg"></i></div>
											<select class="start form-control form-control-sm" name="day[]">
												<option value="" hidden selected disabled selected disabled selected disabled>start to</option>
												<!-- <option  data-divider="true"></option> -->
												<option value="6:00">6:00</option>
												<option value="6:30">6:30</option>
												<option value="7:00">7:00</option>
												<option value="7:30">7:30</option>
												<option value="8:00">8:00</option>
												<option value="8:30">8:30</option>
												<option value="9:00">9:00</option>
												<option value="9:30">9:30</option>
												<option value="10:00">10:00</option>
												<option value="10:30">10:30</option>
												<option value="11:00">11:00</option>
												<option value="11:30">11:30</option>
												<option value="12:00">12:00</option>
												<option value="12:30">12:30</option>
												<option value="13:00">13:00</option>
												<option value="13:30">13:30</option>
												<option value="14:00">14:00</option>
												<option value="14:30">14:30</option>
												<option value="15:00">15:00</option>
												<option value="15:30">15:30</option>
												<option value="16:00">16:00</option>
												<option value="16:30">16:30</option>
												<option value="17:00">17:00</option>
												<option value="17:30">17:30</option>
												<option value="18:00">18:00</option>
												<option value="18:30">18:30</option>
												<option value="19:00">19:00</option>
												<option value="19:30">19:30</option>
												<option value="20:00">20:00</option>
												<option value="20:30">20:30</option>
												<option value="21:00">21:00</option>
												<option value="21:30">21:30</option>
												<option value="22:00">22:00</option>
												<option value="22:30">22:30</option>
												<option value="23:00">23:00</option>
											</select>
										</div>
										<!-- /.input-group -->
										<span>to</span>
										<div class="input-group">
											<div class="input-group-addon"><i class="far fa-clock fa-lg"></i></div>
											<select class="end form-control form-control-sm" name="day[]">
												<option value="" hidden selected disabled selected disabled selected disabled>end to</option>
												<!-- <option  data-divider="true"></option> -->
												<option value="6:30">6:30</option>
												<option value="7:00">7:00</option>
												<option value="7:30">7:30</option>
												<option value="8:00">8:00</option>
												<option value="8:30">8:30</option>
												<option value="9:00">9:00</option>
												<option value="9:30">9:30</option>
												<option value="10:00">10:00</option>
												<option value="10:30">10:30</option>
												<option value="11:00">11:00</option>
												<option value="11:30">11:30</option>
												<option value="12:00">12:00</option>
												<option value="12:30">12:30</option>
												<option value="13:00">13:00</option>
												<option value="13:30">13:30</option>
												<option value="14:00">14:00</option>
												<option value="14:30">14:30</option>
												<option value="15:00">15:00</option>
												<option value="15:30">15:30</option>
												<option value="16:00">16:00</option>
												<option value="16:30">16:30</option>
												<option value="17:00">17:00</option>
												<option value="17:30">17:30</option>
												<option value="18:00">18:00</option>
												<option value="18:30">18:30</option>
												<option value="19:00">19:00</option>
												<option value="19:30">19:30</option>
												<option value="20:00">20:00</option>
												<option value="20:30">20:30</option>
												<option value="21:00">21:00</option>
												<option value="21:30">21:30</option>
												<option value="22:00">22:00</option>
												<option value="22:30">22:30</option>
												<option value="23:00">23:00</option>
												<option value="23:30">23:30</option>
											</select>
										</div>
										<!-- /.input-group -->
									</div>
									<!-- /.form-inline -->
								</div>
								<!-- /.row -->
							</div>
							<!-- /.schedule -->
							<div class="form-group">
								<label class="font-weight-bold">How long have you studied English?</label>
								<select id="experience" class="form-control" name="experience" required>
									<option value="" hidden selected disabled selected disabled selected disabled>Select</option>
									<option value="none">none</option>
									<option value="0~1 year">0~1 year</option>
									<option value="1~2 years">1~2 years</option>
									<option value="more than 2 years">more than 2 years</option>
								</select>
							</div>
							<!-- <div class="form-group">
								<label class="font-weight-bold">How did you know about us?</label>
								<select id="education" class="form-control" name="searched" required>
									<option value="" hidden selected disable>Select</option>
									<option value="Google">Google</option>
									<option value="Facebook">Facebook</option>
									<option value="Twitter">Twitter</option>
									<option value="Instagram">Instagram</option>
									<option value="Others">Others</option>
								</select>
							</div> -->
							<div class="form-group">
								<label class="font-weight-bold">Goals for studying English</label>
								<textarea id="goals" class="form-control" type="text" name="goals" rows="3" placeholder="Enter your goals" required></textarea>
							</div>
							<div class="form-group">
								<label class="font-weight-bold">Hobbies</label>
								<textarea id="hobbies" class="form-control" type="text" name="hobbies" rows="3" placeholder="Enter your hobbies required"></textarea>     
							</div>
							<div class="form-group">
								<label class="font-weight-bold">Ambition</label>
								<textarea id="ambitions" class="form-control" type="text" name="ambitions" rows="3" placeholder="Enter your ambition required"></textarea>   
							</div>
							<div class="form-group text-center">
								<input id="submit" class="btn btn-lg btn-outline-success btn-block" type="submit" name="submit" value="Save">
							</div>
						</form>
					</div>
					<!-- /.col-lg-6 -->
				</div>
				<!-- panel-body -->
			</div>
			<!-- /.panel -->
		</div>
		<!-- /.container-fluid -->
		<?php include_once("footer.php") ?>
	</div>
	<!-- /.content-wrapper -->
	<?php include_once("js.php") ?>
	<!-- Modal -->
	<div id="modal-done" class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Application Form Complete</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<!-- <span aria-hidden="true">&times;</span> -->
					</button>
				</div>
				<div class="modal-body">
					<p class="card-text">Please try first our demo class before you go to a regular class.</p>
				</div>
				<div class="modal-footer">
						<a class="btn btn-primary" href="make-payment.php">Done</a>
				</div>
			</div>
		</div>
	</div>
<!-- JS -->
<script>
	$(document).ready(function()	{
		// var check = $('input[type="checkbox"]').is(':checked');
		// if (check == true) {
		// 	$('.time-container').show();
		// }
		// else {
		// 	$('.time-container').hide();
		// }
		$('.time-container').hide();
		$('#time-error').hide();
	});	

	$('input[type="checkbox"]').click(function() {
		var container = $(this).closest('.schedule-container').find('.time-container');
		var check = container.is(":visible");
		if (check == false) {
			container.show();
			container.find('select').attr('required', true);
			$('#schedule-error').hide();
		}
		else {
			container.hide();
			container.find('select').prop('selectedIndex', 0);
			container.find('select').attr('required', false);
		}
	});

	$('.time-container').find('.end').change(function() {
		var parent = $(this).closest('.time-container');
		var end = $(this).val();
		var start = parent.find('.start').val();
		var startMinute = start.substring(start.length, start.length - 2);
		var startHour = start.substring(start.length - 3, 0);
		var startTime = new Date();
 		startTime.setHours(startHour, startMinute);

		var endMinute = end.substring(end.length, end.length - 2);
		var endHour = end.substring(end.length - 3, 0);
		var endTime = new Date();
		endTime.setHours(endHour, endMinute);

		if (startTime < endTime) {
			$(this).removeClass("is-invalid");
			$('#time-error').hide();
		}		
		else {
			$(this).addClass("is-invalid");
			$('#time-error').show();
		}
	});

	$(document).ready(function() {
		$('#form').submit(function(e) {
			var form = $(this)[0];
			var data = new FormData(form);
			data.append("submit", $('#submit').val());
			$.ajax({
				url: 'application-insert.php',
				type: 'post',
				enctype: 'multipart/form-data',
				dataType: 'json',
				data: data,
				processData: false,
				contentType: false,
				cache: false,
				success: function(response) {
					console.log(response.c);
					console.log(response.e);
					if (response.c == 1) {
						displayError(response.c, response.e);
					} 
					else if (response.c == 2) {
						$(document).keydown(function (e) {
							return (e.which || e.keyCode) != 116;
						});
						$('#modal-done').modal('show');
					}
				}
			});
			e.preventDefault();			
		});
	});
	function displayError(c, error) {
		if (c == 1) {
			$('#schedule-error').text(error).show();
			$('html, body').animate({
				scrollTop: ($('#image-chooser').offset().top)
			},1000);
		}
	}
	function getSchedule() {
		var day = [];
		$('input[type="checkbox"]').each(function() {
			var check = $(this).is(':checked');
			var container = $(this).closest('.schedule-container');
			if (check == true) {
				$(container).find('input, select').each(function() {
					day.push($(this).val());
				});
			} 
		});
		return day;
	}	
</script>
</body>
