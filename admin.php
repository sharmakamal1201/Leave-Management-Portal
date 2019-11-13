<?php
include("tool/header.php");
include("tool/functions.php");
/*if(!isset($_SESSION['email'])){
  header("Location: ../check.php");
}*/
?>

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
			<li class="nav-item active">
				<a class="nav-link" id="home" href="#">Home<span class="sr-only">(current)</span></a>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="hod" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Hod</a>
				<div class="dropdown-menu" aria-labelledby="hod">
					<a class="dropdown-item" id="addhod" href="register/registerhod.php">Add</a>
					<a class="dropdown-item" id="edithod" href="register/changehod.php">Edit</a>
				</div>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="hod" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Dean</a>
				<div class="dropdown-menu" aria-labelledby="hod">
					<a class="dropdown-item" id="adddean" href="register/registerdean.php">Add</a>
					<a class="dropdown-item" id="editdean" href="register/changedean.php">Edit</a>
				</div>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="hod" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Director</a>
				<div class="dropdown-menu" aria-labelledby="hod">
					<a class="dropdown-item" id="adddirector" href="register/registerdirector.php">Add</a>
					<a class="dropdown-item" id="editdirector" href="register/changedirector.php">Edit</a>
				</div>
			</li>
			<li class="nav-item ">
				<a class="nav-link" id="addfaculty" href="register/registerfaculty.php">Add Faculty</a>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="hierarchy" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Hierarchy</a>
				<div class="dropdown-menu" aria-labelledby="hod">
					<a class="dropdown-item" id="showhierarchy">Show</a>
					<a class="dropdown-item" id="changehierarchy" href="#">Change</a>
				</div>
			</li>
		</ul>
		<form class="form-inline my-2 my-lg-0">
			<button class="btn btn-outline-success my-2 my-sm-0" type="button" id="logout">Logout</button>
		</form>
	</div>
</nav>
<div id="reg"></div>

<div id="hierarchyshow"></div>

<script type="text/javascript">
	$(document).ready(function() {
			$("#logout").click(function() {
				$.ajax({
					type: "POST",
					url: "actions.php?action=unset",
					data: "random",
					success: function(result) {
						if (result == 1) {
							window.location.href = "http://localhost/practice/project/index.php";
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
		});
</script>

</body>

</html>