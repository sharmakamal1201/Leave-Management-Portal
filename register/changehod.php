<!doctype html>
<html>

<head>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link rel="stylesheet" href="../css/login_signup.css">
	<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
	<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/styles.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link href='../lib/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css' rel='stylesheet' type='text/css'>
    <script src='../lib/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js' type='text/javascript'></script>
    <script type="text/javascript" src="../lib/bootstrap-datepicker.js"></script>
    <link rel="stylesheet" type="text/css" href="../lib/bootstrap-datepicker.css">
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
								<a href="#" class="active" id="register-form-link">Change HOD</a>
							</div>
						</div>
						<hr>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form id="register-form" style="display: block;">
                                    <div class="form-group">
										<input type="email" id="Fid" tabindex="1" class="form-control" placeholder="Faculty email">
                                    </div>
                                    <div class="form-group">
										<input type="text" id="username" tabindex="1" class="form-control" placeholder="Name">
									</div>
									<div class="form-group row">
										<label for="exampleFormControlSelect1" class="col-sm-2 col-form-label">Department</label>
										<div class="col-sm-12">
											<select class="form-control" id="department">
												<option>cse</option>
												<option>me</option>
												<option>ee</option>
											</select>
										</div>
									</div>
									<div class="form-group row">
										<label for="inputPassword" class="col-sm-4 col-form-label">Today's Date</label>
										<div class="dates col-sm-12" style="color:#2471a3;">
											<input type="text" style="background-color:#aed6f1;" class="form-control" id="startDate" name="event_date" placeholder="YYYY-MM-DD" autocomplete="off">
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="button" id="change" tabindex="4" class="form-control btn btn-register" value="Change Now">
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
	<div class="alert alert-danger loginAlert"></div>
	<script type="text/javascript">
		$("#change").click(function() {
			$.ajax({
				type: "POST",
				url: "actionreg.php?action=changehod",
				data: "&username=" + $("#username").val()+"&department=" + $("#department").val()+"&startDate=" + $("#startDate").val() + "&Fid=" + $("#Fid").val(),
				success: function(result) {
					if (result == 1) {
						window.location.assign("../admin.php");
						alert("every thing is fine");
					} else {
                        alert("not fine");
						$(".loginAlert").html(result).show();
					}
				}
			})
		})
	</script>
	<script>
		$(function() {
			$('.dates #startDate').datepicker({
				'format': 'yyyy-mm-dd',
				'autoclose': true
			});
		});
	</script>
</body>

</html>