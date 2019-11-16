<?php
include("../tool/header.php");
include("../tool/functions.php");
if (!isset($_SESSION['email'])) {
  header("Location: ../check.php");
} else {
  $mailid = $_SESSION['email'];
  $query = "SELECT * FROM faculty WHERE email= '$mailid'";
  $res = mysqli_query($mySql_db, $query);
  if (mysqli_num_rows($res) == 0) {
    header("Location: ../check.php");
  }
}
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
  <a class="navbar-brand">Faculty Portal</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" id="home" href="#">Home<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="MyProfile" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          My Profile</a>
        <div class="dropdown-menu" aria-labelledby="MyProfile">
          <a class="dropdown-item" id="ViewProfile" href="#">View Profile</a>
          <a class="dropdown-item" id="EditProfile" href="#">Edit Profile</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="ApplyLeave" href="../apply_leave.php">Apply Leave</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="LeaveRecord" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Leave Record
        </a>
        <div class="dropdown-menu" aria-labelledby="LeaveRecord">
          <a class="dropdown-item" href="#">Remaining leaves</a>
          <a class="dropdown-item" id="leaveStatus" href="#">Current leave status</a>
          <a class="dropdown-item" href="#">Past record</a>
        </div>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <button class="btn btn-outline-success my-2 my-sm-0" type="button" id="logout">Logout</button>
    </form>
  </div>
</nav>
<div id="change"></div>
<script type="text/javascript">
  var val = "<?php echo $_SESSION['email']; ?>";
  $("#ViewProfile").click(function() {
    window.location.href = "../view_profile.php?action=" + val;
  })
  $("#EditProfile").click(function() {
    window.location.href = "../edit_profile.php?";
  })

  $(document).ready(function() {
    $("#logout").click(function() {
      $.ajax({
        type: "POST",
        url: "../actions.php?action=unset",
        data: "random",
        success: function(result) {
          if (result == 1) {
            window.location.href = "../index.php";
          } else {
            alert("contact kml");
          }
        }
      });
    });
    $("#leaveStatus").click(function() {
      $.ajax({
        type: "POST",
        url: "../leaveStatus.php",
        data: "random",
        success: function(result) {
          alert(result);
          $("#change").html(result);
        }
      });
    });
  });
</script>

</body>

</html>