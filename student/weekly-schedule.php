<?php
	session_start();
	include_once("header.php");
	include_once("navbar.php");
	// require 'libs/session.php';
	
	$week = date('W');
	$year = date('Y');

	// Return date of the week
	function getWeekDates($year, $week) {
		$from = date("F d", strtotime("{$year}-W{$week}-1")); //Returns the date of monday in week
		$month1 = date("F", strtotime("{$year}-W{$week}-1"));
    $to = date("d, Y", strtotime("{$year}-W{$week}-7"));   //Returns the date of sunday in week
    $month2 = date("F", strtotime("{$year}-W{$week}-7"));

			if ($month1 != $month2) {	
				$to = date("F d, Y", strtotime("{$year}-W{$week}-7")); 
				return $from." - ".$to;
			}
			else {
				return $from."-".$to;
		}
	}
?>
<style>
	.class-student:hover {
		font-weight: 900;
		font-size: 17px;
	}
</style>
<body class="fixed-nav sticky-footer" id="page-top">
	<div class="content-wrapper">
		<div class="container-fluid">
			<div class="panel panel-default">
				<div class="panel-heading">
					Weekly Schedule
				</div>
				<!-- /.panel-header -->
				<div class="panel-body">
					<div class="col-lg-12 mx-auto mb-1">
						<div class="row justify-content-between">
							<div class="col-lg-3">
								<a id="prevbtn" class="text-dark"><i class="fa fa-fw fa-arrow-left" aria-hidden="true"></i></a>
								<a id="nextbtn" class="text-dark ml-2"><i class="fa fa-fw fa-arrow-right" aria-hidden="true"></i></a>
								<a id="todaybtn" class="ml-2 btn btn-sm btn-outline-dark">today</a>
							</div>
							<div id="date" class="col-lg-6 text-center font-weight-bold">
								<!-- Date today -->
								<?php
								// $todayDate = date('F d, Y');
								echo getWeekDates($year, $week);
								?>
							</div>
							<!-- /.col-lg-6-->
							<div class="col-lg-3 ">
								<div class="input-group mb-2">
									<span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
									<input id="calendar" class="form-control form-control-sm" type="date">
								</div>  
							</div>
							<!-- /.col-lg-3 -->
						</div>
						<!-- /.row -->
					</div>
					<!-- /.buttons -->
					<div id="weekly-schedule">
					</div>
					<!-- /.weekly-schedule -->
				</div>
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		</div>
		<!-- /.container-fluid-->
		<?php include_once("footer.php") ?>
	</div>
	<!-- /.content-wrapper-->

	<?php include_once("js.php") ?>
<!-- Javascript -->	
<script type="text/javascript">
	$(document).ready(function() {
		$('#calendar').change(function() {
			console.log($(this).val());
			v = '';
			$.ajax({
				url: 'weekly-schedule-process.php',
				type: 'post',
				// dataType: 'json',
				data: {
					'calendar': $(this).val(),
				},
				success: function(response) {
					$('#date').html(response);
					displaySchedule();
				},
				error: function(err) {
					alert(err);
				}
			});
		});
	});
	// PREV BUTTON
	$(document).ready(function() {
		$('#prevbtn').click(function() {
			// console.log($('#date').text());
			v = 1;
			var date = $('#date').text();
			$.ajax({
				url: 'weekly-schedule-process.php',
				type: 'post',
				// dataType: 'json',
				data: {
					'prev': 1,
					'date': date
				},
				success: function(response) {
					$('#date').html(response);
					displaySchedule();
				},
				error: function(err) {
					alert(err);
				}
			});
		});
	});	
	//NEXT BUTTON
	$(document).ready(function() {
		$('#nextbtn').click(function() {
			// console.log($('#date').text());
			v = 2;
			var date = $('#date').text();
			$.ajax({
				url: 'weekly-schedule-process.php',
				type: 'post',
				// dataType: 'json',
				data: {
					'next': 1,
					'date': date
				},
				success: function(response) {
					$('#date').html(response);
					displaySchedule();
				},
				error: function(err) {
					alert(err);
				}
			});
		});
	});
	//TODAY BUTTON
	$(document).ready(function() {
		$('#todaybtn').click(function() {
			// console.log($('#date').text());
			v = '';
			var date = $('#date').text();
			$.ajax({
				url: 'weekly-schedule-process.php',
				type: 'post',
				// dataType: 'json',
				data: {
					'today': 1
				},
				success: function(response) {
					$('#date').html(response);
					displaySchedule();
				},
				error: function(err) {
					alert(err);
				}
			});
		});
	});

	$(document).ready(function() {
		displaySchedule();
	});
	var v = '';
	// Display timetable
	function displaySchedule () {
		// console.log($('#date').text());
		// console.log(v);
		var date = $('#date').text();
		var submit = 'submit';
		$.ajax({
			url: 'weekly-schedule-process.php',
			type: 'post',
			data: {
				'weekly-schedule': 1,
				'date': date,
				'submit': submit,
				'v': v
			},
			dataType: 'json',	
			
			success: function(response) {
				$('#weekly-schedule').html(response.r);
				// console.log(response.y);
				// console.log(response.w);
				// console.log(response.d);
				classActions();
			},
			error: function(err) {
				console.log(err);
			}
		});
	}
	
	function classActions() {
		// Onload
		$(document).ready(function() {
			$('.class-select').hide();
			$('.form-footer').hide();
		});
		// Class click
		$('table').find('.class-click').click(function() {
			var parent = $(this).closest('.parent');
			var footer = parent.find('.form-footer');
			var remarkContainer = parent.find('.class-remark');
			var selectContainer = $(this).siblings('.class-select');
			var check = selectContainer.is(":visible");

			if (check == false) {
				selectContainer.show();
				remarkContainer.html('');
				selectContainer.find('select').attr('required', true);
			}
			else {
				footer.hide();

				selectContainer.hide();
				selectContainer.find('select').prop('selectedIndex', 0);
				selectContainer.find('select').attr('required', false);
			}
		});
		// Class selected
		$('table').find('select').mouseleave(function() {
			var parent = $(this).closest('.parent');
			var footer = parent.find('.form-footer');
			var remarkContainer = parent.find('.class-remark');
			var selectContainer = parent.find('.class-select');
			var selected = $(this).val();
			if (selected.length > 0) {
				var item = '<p class="m-0 small event-text">'+selected+'</p>';
				footer.show();
			}
			else {
			}
			selectContainer.hide();
			remarkContainer.html(item);
		});
		// Submit remark
		$('form').submit(function(e) {
			var form = $(this)[0];
			var data = new FormData(form);
			data.append("submit", 1);
			$.ajax({
				url: 'remark-insert.php',
				type: 'post',
				enctype: 'multipart/form-data',
				// dataType: 'json',
				data: data,
				processData: false,
				contentType: false,
				cache: false,
				success: function(response) {
					alert("Class remark has been successfully saved.");
					displaySchedule();
				},
				error: function(err) {
					alert(err);
				}
			});
			e.preventDefault();
		});
	}
</script>
</body>