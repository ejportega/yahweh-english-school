<?php
	session_start();
	include_once "header.php";
	include_once "navbar.php";
	// require 'libs/session.php';
	include_once 'libs/manage-payments.php';
	include_once 'libs/paypal-config.php';

	$sid = $_SESSION['studentID'];
	$managePayments = new ManagePayments();
	$pending = $managePayments->isPending($sid);
	$enrolled = $managePayments->isEnrolled($sid);
	$isApplied = $managePayments->isApplied($sid);
	$demoClass = $managePayments->demoClass($sid);

?>
<body class="fixed-nav sticky-footer" id="page-top">
	<div class="content-wrapper">
		<div class="container-fluid">
			<div class="card">
				<div class="card-header">
					Make a Payment
				</div>
				<!-- /.panel-heading -->
				<div class="card-body">
					<?php if (!$isApplied) { ?>
						<span class="font-weight-bold">Please fill up your application form first.</span>
					<?php } else { 
						if (!$demoClass) { ?>
							<input type="hidden" name="session_count" value="1">
							<input type="hidden" name="amount" value="1.00">
							<div class="col-sm-12">
								<strong>Please try first our demo class before you go to a regular class for only $1.</strong>
							</div>
							<div class="col-sm-12 mt-2">
								<button id="btnCheckoutDemo" class="btn btn-success" data-toggle="modal" data-target="#checkoutRegularClassModal">Try now!</button>
							</div>
						<?php } else {  
						 	if($pending) { ?>
							<div class="row">
								<div class="col-lg-6">
									<span class="font-weight-bold">Please wait for the admin to book your class.</span>
								</div>
							</div>	
						<?php } else { 
							if($enrolled) { $endDate = date('F j, Y', strtotime($enrolled->end_date)); ?>
								<div class="col-lg-6">
									<span class="font-weight-bold">You cannot enroll for a class now because you are currently enrolled until <?php echo $endDate; ?>.</span>
								</div>
							<?php } else { ?>
							<div class="row">
								<div class="col-lg-4">
									<div class="panel panel-info">
										<div class="panel-heading">
											Payment Form
										</div>
										<div class="panel-body ">
											<form id="paymentForm">
												<div class="form-group">
													<input id="txtSession" class="form-control" type="number" name="session_count" min="10" placeholder="Number of sessions" required>
												</div>		
												<div class="form-group">
													<label class="text-center bg-info font-weight-bold text-white form-control">Total: &#36; <span id="lblAmount">0:00</span></label>
													<input id="txtAmount" type="hidden" name="amount">
												</div>
												<div class="form-group">
													<input id="btnSubmit" class="btn btn-success btn-block font-weight-bold" type="submit" name="submit" value="Checkout">
												</div>
											</form>	
										</div>
										<div class="panel-footer">
											<small>This payment will proceed to paypal.</small>
										</div>
									</div>
								</div>
							</div>		
						<?php } } } } ?> 		
        </div>
				<!-- panel-body -->
			</div>
			<!-- /.panel -->
		</div>
		<!-- /.container-fluid -->
		<?php include_once("footer.php") ?>
	</div>
	<!-- /.content-wrapper -->
	<!-- modals -->
	<?php include_once 'libs/modals.php'; ?>
	<?php include_once("js.php") ?>
	<script type="text/javascript">
		$('#btnSubmit').click(function() {
			$("#paymentForm").submit(function(e) {
				$('#checkoutRegularClassModal').modal('show');
				e.preventDefault();
			});
		});

		$('#txtSession').change(function() {
			var session = $(this).val();
			var amount = (session * 2.50).toFixed(2);
			$('#lblAmount').text(amount);
			$('#txtAmount').val(amount);
			var hours = session/2;
			$('#checkoutSession').html('<dt class="col-sm-6 text-right">Total Sessions:</dt><dd class="col-sm-6"><span>'+session+'</span><small class="ml-2">(total of '+hours+' hours of class)</small></dd>');
			$('#checkoutAmount').html('<dt class="col-sm-6 text-right">Total Price:</dt><dd class="col-sm-6"><span>&#36;'+amount+'</span><small class="ml-2">($2.50 per session)</small></dd>');
		});

		$('#btnCheckoutDemo').click(function() {
			$('#checkoutSession').html('<dt class="col-sm-6 text-right">Demo Class:</dt><dd class="col-sm-6"><small class="">1 day class</small></dd>');
			$('#checkoutAmount').html('<dt class="col-sm-6 text-right">Total Price:</dt><dd class="col-sm-6"><span>&#36;1.00</span><small class="ml-2">(30 minutes session)</small></dd>');
		});

	</script>
</body>
