<?php
include("tool/header.php");
include("tool/functions.php");
?>
<style>
	html {
		background-image: url('image/front1.jpg');
		background-repeat: no-repeat;
		background-size: 100% 750px;
	}
</style>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<a class="navbar-brand">Faculty Portal</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="DeptDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Department
				</a>
				<div class="dropdown-menu" aria-labelledby="DeptDropdown">
					<a class="dropdown-item" id="CSE" href="Profiles/faculty.php?action=CSE">CSE</a>
					<a class="dropdown-item" id="EE" href="Profiles/faculty.php?action=EE">Electrical</a>
					<a class="dropdown-item" id="ME" href="Profiles/faculty.php?action=ME">Mechanical</a>
				</div>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="oldhod" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Prev HODs
				</a>
				<div class="dropdown-menu" aria-labelledby="DeptDropdown">
					<a class="dropdown-item" id="oldcsehod" href="CCF/old.php?action=oldcsehod">CSE</a>
					<a class="dropdown-item" id="oldeehod" href="CCF/old.php?action=oldeehod">Electrical</a>
					<a class="dropdown-item" id="oldmehod" href="CCF/old.php?action=oldmehod">Mechanical</a>
				</div>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="oldhod" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Prev CCFs
				</a>
				<div class="dropdown-menu" aria-labelledby="DeptDropdown">
					<a class="dropdown-item" id="oldAdeans" href="CCF/old.php?action=oldAdeans">Associate Deans</a>
					<a class="dropdown-item" id="olddeans" href="CCF/old.php?action=olddeans">Deans</a>
					<a class="dropdown-item" id="olddirectors" href="CCF/old.php?action=olddirectors">Directors</a>
				</div>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="facultycurrentandold" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Faculty
				</a>
				<div class="dropdown-menu" aria-labelledby="DeptDropdown">
					<a class="dropdown-item" id="currentfaculty" href="CCF/old.php?action=currentfaculty">Current</a>
					<a class="dropdown-item" id="oldfaculty" href="CCF/old.php?action=oldfaculty">Previous</a>
				</div>
			</li>
		</ul>
		<form class="form-inline my-2 my-lg-0">
			<button class="btn btn-outline-success my-2 my-sm-0" type="button" id="login">login</button>
		</form>
	</div>
</nav>

<script type="text/javascript">
	var toggle = "<?php
					if (isset($_SESSION['email'])) {
						echo 1;
					} else echo 0;
					?>";
	if (toggle == 0) {
		$("#login").html('login');
		$("#login").click(function() {
			window.location.href = "login.php";
		});
	} else {
		$("#login").html('logout');
		$("#login").click(function() {
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
		})
	}
</script>

</body>

</html>