<?php
include("tool/header.php");
include("tool/functions.php");
if(!isset($_SESSION['email'])){
  header("Location: check.php");
}
$collection = $database->user;
$qry = array('email' => $_SESSION["email"]);
$user = $collection->findOne($qry);
?>


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

<div class="container edit" padding-top="50px">
  <div class="form-group shadow-textarea">
    <label for="biography" padding-bottom="0">Biography</label>
    <textarea class="form-control z-depth-1" value="" id="biography" rows="3" placeholder="Write something here..."></textarea>
  </div>
</div>
<div class="container edit" padding-top="50px">
  <div class="form-group shadow-textarea">
    <label for="research_area" padding-bottom="0">Areas of Research</label>
    <textarea class="form-control z-depth-1" value="" id="research_area" rows="3" placeholder="Write something here..."></textarea>
  </div>
</div>
<div class="container edit" padding-top="50px">
  <div class="form-group shadow-textarea">
    <label for="education" padding-bottom="0">Education</label>
    <textarea class="form-control z-depth-1" value="" id="education" rows="3" placeholder="Write something here..."></textarea>
  </div>
</div>
<div class="container edit" padding-top="50px">
  <div class="form-group shadow-textarea">
    <label for="experience" padding-bottom="0">Work Experience</label>
    <textarea class="form-control z-depth-1" value="" id="experience" rows="3" placeholder="Write something here..."></textarea>
  </div>
</div>
<div class="container edit" padding-top="50px">
  <div class="form-group shadow-textarea">
    <label for="patents" padding-bottom="0">Selected Publications/Patents</label>
    <textarea class="form-control z-depth-1" value="" id="patents" rows="3" placeholder="Write something here..."></textarea>
  </div>
</div>
<div class="container">
  <form class="form-inline my-1">
    <button class="btn btn-outline-white btn-sm my-0 pull-right" type="button" id="save">Save</button>
  </form>
</div>

<script src="jquery/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>


<script type="text/javascript">
  $("#biography").val("<?php echo $user["biography"]; ?>");
  $("#research_area").val("<?php echo $user["research_area"]; ?>");
  $("#education").val("<?php echo $user["education"]; ?>");
  $("#experience").val("<?php echo $user["experience"]; ?>");
  $("#patents").val("<?php echo $user["patents"]; ?>");
  $(document).ready(function(){
    $("#save").click(function() {
        $.ajax({
          type: "POST",
          url: "actions.php?action=save_profile",
          data: "biography=" + $("#biography").val() + "&research_area=" + $("#research_area").val() + "&education=" + $("#education").val() +
            "&experience=" + $("#experience").val() + "&patents=" + $("#patents").val(),
          success: function(result) {
            window.location.replace("http://localhost/practice/project/view_profile.php?action=" + result);
          }
        });
      });
    $("#logout").click(function() {
      $.ajax({
        type: "POST",
        url: "actions.php?action=unset",
        data: "dummy=" + $("#biography").val(),
        success: function(result) {
          window.location.href = "http://localhost/practice/project/index.php";
        }
      });
      $("#logout").val('0');
    });
  });
</script>
<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>
</html>