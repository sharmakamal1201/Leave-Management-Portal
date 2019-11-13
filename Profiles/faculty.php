<?php
include("../tool/header.php");
include("../tool/functions.php");
?>
<link rel="stylesheet" href="../css/facultypage.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<div id="divfaculty"></div>
<button id="show"> show </button>
<script type="text/javascript">
    var val = "<?php echo $_GET['action']; ?>";
    alert(val);
    $.ajax({
        type: "POST",
        url: "../actions.php?action="+val,
        data: "dept=" + val,
        success: function(result) {
            $('#divfaculty').html(result);
        }
    }) 
</script>