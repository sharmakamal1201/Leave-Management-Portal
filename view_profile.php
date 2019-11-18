<?php
include("tool/header.php");
include("tool/functions.php");
$collection = $database->user;
$query = array('email' => $_GET["action"]);
//checking for existing user
$user = $collection->findOne($query);
/*$email = $_GET["action"];
$biography = $user["biography"];
$research_area = $user["research_area"];
$education = $user["education"];
$experience = $user["experience"];
$patents = $user["patents"];*/

?>
<link rel="stylesheet" href="css/facultypage.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<style>
    .navbar {
    max-height: 60px;
	background-color: #008B8B;
	color: white;
	font-family:    Serif, Arial, Helvetica, sans-serif;
	font-size:      30px;
  }
</style>

<nav class="navbar">
	<a>Profile</a>
	<form class="form-inline my-1">
		<button class="btn btn-outline-white btn-sm my-0 pull-right" type="button" id="toggle-login-logout" value="1">Logout</button>
	</form>
</nav>

<!------ Include the above in your HEAD tag ---------->
<div class="card mb-3">
</div>
<div class="container">
<div id="primaryContent1">
        <div class="fac_row">
        <div class="fac_img">
        <img style="border:1px #e5e5e5 solid;" src="image/images.jpg">
        </div>    
        <p><strong></strong>
        	<br><i id="mail"><?php echo $_GET["action"];?></i>
			<br>
		</p>
	</div>
</div>
</div>
<div class="card container ">
	<div class="card-header">
		Biography
	</div>
	<div class="card-body">
		<div id="biography"><?php echo nl2br($user["biography"]); ?> </div>
	</div>
</div>

<div class="card container">
	<div class="card-header">
		Areas of Research
	</div>
	<div class="card-body">
		<div id="research_area"><?php echo nl2br($user["research_area"]); ?> </div>
	</div>
</div>

<div class="card container">
	<div class="card-header">
		Education
	</div>
	<div class="card-body">
		<div id="education"><?php echo nl2br($user["education"]); ?> </div>
	</div>
</div>
<div class="card container">
	<div class="card-header">
		Work Experience
	</div>
	<div class="card-body">
		<div id="experience"> <?php echo nl2br($user["experience"]); ?></div>
	</div>
</div>
<div class="card container">
	<div class="card-header">
		Selected Publications/Patents
	</div>
	<div class="card-body">
		<div id="patents"> <?php echo nl2br($user["patents"]); ?></div>
	</div>
</div>

<script type="text/javascript">

	var sess='0';
	sess = "<?php if (isset($_SESSION['email']) && $_SESSION['email']==$_GET["action"]) echo 1; else echo 0;?>";
	if (sess == '1') {
		$("#toggle-login-logout").html('Logout');
		$("#toggle-login-logout").val('1');
	}
	else if (sess == '0') {
		$("#toggle-login-logout").html('Login');
		$("#toggle-login-logout").val('0');
	}
	$("#toggle-login-logout").click(function() 
	{
		if ($("#toggle-login-logout").val() == "1") 
		{
			$("#toggle-login-logout").val('0');
			alert('Logged out');
			$.ajax({
				type: "POST",
				url: "actions.php?action=unset",
				data: "dummy=" + $("#biography").val(),
				success: function(result) {
					$("#toggle-login-logout").html('Login');
				}
			});
		} 
		window.location.href = "index.php";
	})
</script>
</body>

</html>