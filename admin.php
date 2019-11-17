<?php
include("tool/header.php");
include("tool/functions.php");

if (!isset($_SESSION['email'])) {
	header("Location: check.php");
} else {
	$mailid = $_SESSION['email'];
	$query = "SELECT * FROM admin_db WHERE email= '$mailid'";
	$res = mysqli_query($mySql_db, $query);
	if (mysqli_num_rows($res) == 0) {
		header("Location: check.php");
	}
}
?>

<link rel="stylesheet" href="css/facultypage.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<style>
	.top_div {
		font-family: Serif, Arial, Helvetica, sans-serif;
		font-size: 40px;
		font-weight: bold;
		background-color: #008B8B;
		color: white;
		padding-top: 10px;
		padding-right: 30px;
		padding-bottom: 10px;
		padding-left: 30px;
	}
</style>


<div class="top_div">
	<h2>Leave Management System</h2>
</div>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<a class="navbar-brand">Admin Portal</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="hod" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Hod</a>
				<div class="dropdown-menu" aria-labelledby="hod">
					<a class="dropdown-item" id="addhod" href="register/register.php?action=registerhod">Add</a>
					<a class="dropdown-item" id="edithod" href="register/change.php?action=changehod">Edit</a>
				</div>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="hod" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Associate Dean</a>
				<div class="dropdown-menu" aria-labelledby="hod">
					<a class="dropdown-item" id="addassociatedean" href="register/register.php?action=registerassociatedean">Add</a>
					<a class="dropdown-item" id="editassociatedean" href="register/change.php?action=changeassociatedean">Edit</a>
				</div>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="hod" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Dean</a>
				<div class="dropdown-menu" aria-labelledby="hod">
					<a class="dropdown-item" id="adddean" href="register/register.php?action=registerdean">Add</a>
					<a class="dropdown-item" id="editdean" href="register/change.php?action=changedean">Edit</a>
				</div>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="hod" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Director</a>
				<div class="dropdown-menu" aria-labelledby="hod">
					<a class="dropdown-item" id="adddirector" href="register/register.php?action=registerdirector">Add</a>
					<a class="dropdown-item" id="editdirector" href="register/change.php?action=changedirector">Edit</a>
				</div>
			</li>
			<li class="nav-item ">
				<a class="nav-link" id="addfaculty" href="register/registerfaculty.php">Add Faculty</a>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="hierarchy" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Hierarchy</a>
				<div class="dropdown-menu" aria-labelledby="hod">
					<a class="dropdown-item" id="showhierarchy" href="#">Show</a>
					<a class="dropdown-item" id="changehierarchy" href="changehierarchy.php">Change</a>
				</div>
			</li>
		</ul>
		<form class="form-inline my-2 my-lg-0">
			<button class="btn btn-outline-success my-2 my-sm-0" type="button" id="logout">Logout</button>
		</form>
	</div>
</nav>
<div class="container " style="padding-top:15%; padding-left:25%;">
	<div class="row">
	<div class="form-group col">
		<input type="text" id="leaveId" class="form-control" placeholder="leaveId" value="">
	</div>
	<div class="form-group col">
		<div class="row">
			<div class="col-sm-2 col-sm-offset-3">
				<button class="btn btn-primary"  id="findleaveInfo">Search</button>
			</div>
		</div>
	</div>
	</div>
</div>
<div id="reg"></div>

<div id="hierarchyshow"></div>
<div id="hierarchychange"></div>

<script type="text/javascript">
	$(document).ready(function() {
		$("#logout").click(function() {
			$.ajax({
				type: "POST",
				url: "actions.php?action=unset",
				data: "random",
				success: function(result) {
					if (result == 1) {
						window.location.href = "index.php";
					} else {
						alert("contact kml");
					}
				}
			});
		});

		$("#showhierarchy").click(function() {
			$.ajax({
				type: "POST",
				url: "actions.php?action=showhierarchy",
				data: "random",
				success: function(result) {
					$('#hierarchyshow').html(result);
				}
			})

		});

		$("#findleaveInfo").click(function() {
			var val = $("#leaveId").val();
			$.ajax({
				type: "POST",
				url: "findInfo.php",
				data: "leaveId="+val,
				success: function(result) {
					$('#hierarchyshow').html(result);
				}
			})

		});


	});
</script>

</body>

</html>