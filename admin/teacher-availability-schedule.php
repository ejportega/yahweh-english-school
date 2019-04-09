<?php
	session_start();
	include_once("header.php");
	include_once("navbar.php");
	include_once("../includes/libs/dbh.php");

	$dbConnection = new dbConnection();
	$conn = $dbConnection->connect();
	$teacherId = $_GET['id'];
	
	function getDays($conn, $teacherId) {
		$sql = "SELECT day_schedule FROM teacher_availability WHERE teacher_id=$teacherId";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$day[] = $row['day_schedule'];
			}
			return $day;
		}
		else {
			$day = [];
			return $day;
		}
	}

	function getTime($conn, $teacherId, $day) {
		$sql = "SELECT time_schedule FROM teacher_availability WHERE teacher_id=$teacherId AND day_schedule='$day'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$time = $row['time_schedule'];
		}
		return $time;
	}

	function getAvailabilityId($conn, $teacherId, $day) {
		$sql = "SELECT teacher_availability_id FROM teacher_availability WHERE teacher_id=$teacherId AND day_schedule='$day'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$id = $row['teacher_availability_id'];
		}
		return $id;
	}

	function displayTimeAvail($hour, $timeArr) {
		$print = '';
		if (in_array($hour, $timeArr)) {
			$print = '<td class="time-avail">'.$hour.'</td>';
		}
		else {
			$print = '<td>'.$hour.'</td>';
		}
		return $print;
	}

	function getTeacher($conn, $teacherId) {
    $sql = "SELECT CONCAT('id #', teacher_id, ': ', first_name, ' ', last_name) AS name FROM teachers WHERE teacher_id=$teacherId";
    $result = $conn->query($sql);
    $rowCount = $result->num_rows;

    if ($rowCount > 0) {
      if ($row = $result->fetch_assoc()) {
        return $row['name'];
      }
    }
    else {
      return $rowCount;
    }
  }
?>
<style>
input[type="checkbox"] {
	display: none
}
</style>

<body class="fixed-nav sticky-footer" id="page-top">
	<div class="content-wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							Teacher Availability Schedule
							<?php
								echo  '<div class=""><span class="font-weight-bold">'.getTeacher($conn, $teacherId).'</span></div>';
							?> 
						</div>
						<!-- /.panel-heading -->
						<div class="panel-body">
<!-- Timetable -->
<?php
$dayArr = getDays($conn, $teacherId);
$day = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
for ($i = 0; $i < 7; $i++) {
	if (in_array($day[$i], $dayArr)) {
		$timeArr =  unserialize(getTime($conn, $teacherId, $day[$i]));
		$hour = 6;
		echo
		'<div class="col-lg-12 mx-auto">
				<div class="panel panel-info ">
						<div class="panel-heading text-center">
								<strong>'.$day[$i].'</strong>
						</div>
						<div class="card-body p-0">
								<table class="table table-bordered m-0 text-center">';
										for ($j = 0; $j < 6; $j++) {
											echo 
											'<tr>
													'.displayTimeAvail($hour.':00', $timeArr).'
													'.displayTimeAvail($hour++.':30', $timeArr).'
													'.displayTimeAvail($hour.':00', $timeArr).'
													'.displayTimeAvail($hour++.':30', $timeArr).'
													'.displayTimeAvail($hour.':00', $timeArr).'
													'.displayTimeAvail($hour++.':30', $timeArr).'											
											</tr>';
										}
								echo    
								'</table>
						</div>
						<form id="form1" action="teacher-availability-schedule-reset.php?id='.$teacherId.'" method="POST">
							<div class="options panel-footer text-center">
										<input type="hidden" name="teacher_availability_id" value="'.getAvailabilityId($conn, $teacherId, $day[$i]).'">
										<input class="btn btn-outline-danger" type="submit" name="submit" value="Reset" onclick="return confirm(\'Are you sure to reset this schedule?\')">
							</div>
						</form>
				</div>
		</div>';
	}
	else {
		$hour = 6;
		echo 
		'<div class="col-lg-12 mx-auto">
			<div class="parent panel panel-info">
					<div class="panel-heading text-center">
							<strong>'.$day[$i].'</strong>
					</div>
					<div class="panel-body p-0">
							<table class="table table-bordered m-0 text-center">';
									for ($j = 0; $j < 6; $j++) {
										echo
										'<tr>
											<td class="input-checkbox"><input type="checkbox" value="'.$hour.':00" name="time[]">'.$hour.':00</td>
											<td class="input-checkbox"><input type="checkbox" value="'.$hour.':30" name="time[]">'.$hour++.':30</td>
											<td class="input-checkbox"><input type="checkbox" value="'.$hour.':00" name="time[]">'.$hour.':00</td>
											<td class="input-checkbox"><input type="checkbox" value="'.$hour.':30" name="time[]">'.$hour++.':30</td>
											<td class="input-checkbox"><input type="checkbox" value="'.$hour.':00" name="time[]">'.$hour.':00</td>
											<td class="input-checkbox"><input type="checkbox" value="'.$hour.':30" name="time[]">'.$hour++.':30</td>
										</tr>';
									}
							echo    
							'</table>
					</div>
			</div>
		</div>';
	}
}
?>
						</div>
						<!-- /.panel-body -->
					</div>
					<!-- /.panel -->
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<!-- /.row -->
		</div>
		<!-- /.container-fluid-->
		<?php include_once("footer.php") ?>
	</div>
	<!-- /.content-wrapper-->
	<!-- Modal -->
	<div id="modal-confirmation" class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
					<!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button> -->
				</div>
				<div id="modal-text" class="modal-body">
					Are you sure to save this schedule as your availability? Editing your schedule after it's saved needs the confirmation of the admin.
				</div>
				<div class="modal-footer">
					<button id="close" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button id="save" type="button" class="btn btn-primary">Save changes</button>
				</div>
			</div>
		</div>
	</div>
	<!-- <?php include_once("js.php") ?> -->
	<!-- Javascript -->
	<!-- <script type="text/javascript">
		$(document).ready(function () {
			$('#form1').submit(function(e) {
				var form = $(this)[0];
				var data = new FormData(form);
				data.append("submit", "submit");
				$.ajax({
					url: "teacher-availability-schedule-reset.php",
					type: "post",
					enctype: 'multipart/form-data',
					data: data,
					processData: false,
					contentType: false,
					cache: false,
					success: function (respone) {
						
					},
					error: function (err) {
						alert(err);
					}
				});
				e.preventDefault();
			}); 
		});
	</script> -->
	<!-- <script type="text/javascript">
		$(document).ready(function() {
			$('form').submit(function(e) {
					var parent = $(this).closest('.parent');
					var footer = $(parent).find('.panel-footer');
					var form = $(this)[0];
					var data = new FormData(form);
					data.append("submit", $(this).closest('#submit').val());
						$.ajax({
							url: 'availability-insert.php',
							type: 'post',
							enctype: 'multipart/form-data',
							// dataType: 'json'
							data: data,
							processData: false,
							contentType: false,
							cache: false,
							success: function(response) {
									if (response == "error") {
										alert("No schedule had been choosen.");
									}
									else {
										$(footer).children().hide();
										location.reload();	
									}
							},
							error: function(err) {
								alert(err);
							}
						});
				e.preventDefault();
			});
		});
		// avail time
		$('table').find('.input-checkbox').click(function () {
			$(this).toggleClass("time-avail");
			var checkbox = $(this).find("input[type='checkbox']");
			var isChecked = checkbox.prop("checked");
			if (!isChecked) {
				checkbox.attr('checked', true);
			}
			else {
				checkbox.attr('checked', false);
			}
		});
		// reset table
		$('button').click(function () {
			var panel = $(this).closest('div.col-lg-12');
			var table = panel.find('table');
			table.find('.input-checkbox').each(function () {
				var checkbox = $(this).find('input[type="checkbox"]');
				var isChecked = checkbox.prop("checked");
				if (isChecked == true) {
					checkbox.attr('checked', false);
					$(this).toggleClass('time-avail');
				}
			});
		});
	</script> -->
</body>