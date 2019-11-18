<?php
include("tool/functions.php");
if(!isset($_SESSION['email'])){
  header("Location: index.php");
} 
?>

<!doctype html>
<html>
<title> Change password </title>
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
								<a href="#" class="active" id="login-form-link">ChangePassword</a>
							</div>
						</div>
						<hr>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form id="login-form" role="form" style="display: block;">
									<div class="form-group">
										<input type="password" id="newpass" tabindex="1" class="form-control" placeholder="New Password">
									</div>
									<div class="form-group">
										<input type="password" id="confirmpass" tabindex="2" class="form-control" placeholder="Confirm Password">
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="button" id="change" tabindex="4" class="form-control btn btn-login" value="Change">
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

		$("#change").click(function() {
			var val = $("#newpass").val();
			$.ajax({
				type: "POST",
				url: "actions.php?action=changepass",
				data:  "&newpass=" + val + "&confirmpass=" + $("#confirmpass").val(),
				success: function(result) {
					if (result == 1) {
						window.location.assign("Faculty/faculty.php");
					}
					else if(result==2){
						window.location.assign("CCF/ccf.php");
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