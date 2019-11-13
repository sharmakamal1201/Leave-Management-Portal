<?php
include("tool/functions.php");
if(isset($_SESSION['email'])){
  header("Location: index.php");
} 
?>

<!doctype html>
<html>

<head>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link rel="stylesheet" href="css/login_signup.css">
	<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
	<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</head>

<body id="body">
	<!------ Include the above in your HEAD tag ---------->

	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-login">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-12">
								<a href="#" class="active" id="login-form-link">Login</a>
							</div>
						</div>
						<hr>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form id="login-form" role="form" style="display: block;">
									<div class="form-group">
										<input type="email" id="loginemail" tabindex="1" class="form-control" placeholder="Email" value="">
									</div>
									<div class="form-group">
										<input type="password" id="loginpassword" tabindex="2" class="form-control" placeholder="Password">
									</div>
									<div class="form-group row">
										<label for="exampleFormControlSelect1" class="col-sm-2 col-form-label">Login as</label>
										<div class="col-sm-12">
											<select class="form-control" id="role">
												<option>faculty</option>
												<option>hod</option>
												<option>deanfaa</option>
												<option>director</option>
												<option>admin</option>
											</select>
										</div>
									</div>
									<div class="form-group text-center">
										<input type="checkbox" tabindex="3" class="" name="remember" id="remember">
										<label for="remember"> Remember Me</label>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="button" id="login" tabindex="4" class="form-control btn btn-login" value="Log In">
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-lg-12">
												<div class="text-center">
													<a href="#" tabindex="5" class="forgot-password">Forgot Password?</a>
												</div>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="alert alert-danger loginAlert" style="display:none;"></div>
	<script type="text/javascript">
		$(function() {

			$('#login-form-link').click(function(e) {
				$("#login-form").delay(100).fadeIn(100);
				$("#register-form").fadeOut(100);
				$('#register-form-link').removeClass('active');
				$(this).addClass('active');
				e.preventDefault();
			});

		});

		$("#login").click(function() {
			var val = $("#loginemail").val();
			alert(val);
			$.ajax({
				type: "POST",
				url: "actions.php?action=login",
				data: "role=" + $("#role").val() + "&email=" + val + "&password=" + $("#loginpassword").val(),
				success: function(result) {
					if (result == 1) {
						window.location.assign("Faculty/faculty.php");
					} else if (result == 2) {
						window.location.assign("CCF/ccf.php");
					} else if (result == 3) {
						window.location.assign("admin.php");
					}
					else {
						$(".loginAlert").html(result).show();
					}
				}
			})
		})
	</script>
</body>

</html>