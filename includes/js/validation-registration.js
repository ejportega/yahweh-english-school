			$('#parent').find('input').change(function() {
			var length = $(this).val().length;
			var check  = $(this).is(':valid');
			if (check == false) {
				$(this).addClass('is-invalid');
			}
			else {
				$(this).removeClass('is-invalid');
			}
		});

		$('#parent').find('#country, #skype').mouseout(function() {
			var length = $(this).val().length;
			if (length <= 0) {
				$(this).addClass('is-invalid');	
			}
			else {
				$(this).removeClass('is-invalid');
			}
		});

		var password = document.getElementById("password")
		var confirm_password = document.getElementById("confirmPassword");

		function validatePassword(){
			if(password.value != confirm_password.value) {
				confirm_password.setCustomValidity("Passwords don't match");
			} else {
				confirm_password.setCustomValidity('');
			}
		}
		password.onchange = validatePassword;
		confirm_password.onkeyup = validatePassword;




			// $(document).ready(function() {
		// 	var fname = $('#fname');
		// 	var lname = $('#lname');
		// 	var password = $('#password');
		// 	var confirmPassword = $('#confirmPassword');
		// 	var email = $('#email');
		// 	var country = $('#country');
		// 	var age = $('#age');
		// 	var skype = $('#skype');
		// 	if (fname.is(':valid')) {
		// 		$(fname).addClass('is-invalid');
		// 	}

		// 	else {
		// 		$(fname).removeClass('is-invalid');
		// 	}
		// 	if (lname.is(':valid')) {
		// 		$(lname).addClass('is-invalid');
		// 	}
		// 	else {
		// 		$(lname).removeClass('is-invalid');
		// 	}
		// 	if (fname.is(':valid')) {
		// 		$(fname).addClass('is-invalid');
		// 	}
		// 	else {
		// 		$(fname).removeClass('is-invalid');
		// 	}
		// 	if (fname.is(':valid')) {
		// 		$(fname).addClass('is-invalid');
		// 	}
		// 	else {
		// 		$(fname).removeClass('is-invalid');
		// 	}
		// });