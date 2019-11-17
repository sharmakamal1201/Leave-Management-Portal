<?php
include('../tool/functions.php');
include('../tool/header.php');
$role = $_SESSION['role'];
$Lid = $_GET['action'];
$query = "SELECT * FROM leaveapplication WHERE LeaveId='$Lid'";
$res = mysqli_query($mySql_db, $query);
$row = mysqli_fetch_assoc($res);
$Fid_applicant = $row['Fid'];
$startDate = $row['startDate'];
$endDate = $row['endDate'];
$Ltype = $row['Ltype'];
$query1 = "SELECT * FROM leaverecord WHERE Fid='$Fid_applicant'";
$res1 = mysqli_query($mySql_db, $query1);
$row1 = mysqli_fetch_assoc($res1);
$Avail_leaves = $row1['leavesAvailable'];
$status_current_leave = $row1['CurrentStatus'];

/////Mongodb
$collection = $database->leave_application;
$query3 = array('LeaveId' => $Lid);
//checking for existing user
$leave_obj = $collection->findOne($query3);
$iter = sizeof($leave_obj['AppliedBy']) - 1;
$message = $leave_obj['AppliedBy'][$iter]['message'];

?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<body id="hide">
    <div class="container" style="margin-top:50px;">
        <div class="card">
            <h5 class="card-header">leaveRequest</h5>
            <div class="card-body">
                <form class="container">
                    <div class="form-group row">
                        <label for="fromDate" class="col-sm-4 col-form-label">Leave Id</label>
                        <div class="dates col-sm-4">
                            <p class="form-control" id="Lid"><?php echo $Lid; ?></p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fromDate" class="col-sm-4 col-form-label">Application Id</label>
                        <div class="dates col-sm-4">
                            <p class="form-control" id="Fid"><?php echo $Fid_applicant; ?></p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fromDate" class="col-sm-4 col-form-label">Start Date</label>
                        <div class="dates col-sm-4">
                            <p class="form-control" id="startDate"><?php echo $startDate; ?></p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fromDate" class="col-sm-4 col-form-label">End Date</label>
                        <div class="dates col-sm-4">
                            <p class="form-control" id="endDate"><?php echo $endDate; ?></p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fromDate" class="col-sm-4 col-form-label">Leave type</label>
                        <div class="dates col-sm-4">
                            <p class="form-control" id="Ltype"><?php echo $Ltype; ?></p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fromDate" class="col-sm-4 col-form-label">Leaves Remaining</label>
                        <div class="dates col-sm-4">
                            <p class="form-control" id="avail_leaves"><?php echo $Avail_leaves; ?></p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fromDate" class="col-sm-4 col-form-label">Leave status</label>
                        <div class="dates col-sm-4">
                            <p class="form-control" id="Lstatus"><?php echo $status_current_leave; ?></p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="message" class="col-sm-4 col-form-label">Message</label>
                        <div class="col-sm-8">
                            <p class="form-control" id="message" rows="5"><?php echo nl2br($message); ?></p>
                            <textarea class="form-control" id="write_comment" val="" rows="5" placeholder="Write Comment Here..."></textarea>
                            <a href="#" class="btn btn-primary" id="reject" style="margin-top:15px;">Reject</a>
                            <a href='#' class="btn btn-primary" id="comment" style="margin-top:15px;">Comment</a>
                            <a href="#" class="btn btn-primary" id="approve" style="margin-top:15px;">Approve</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="take"></div>
    <script>
        var Lid = "<?php echo $Lid; ?>"
        var fid = "<?php echo $Fid_applicant; ?>";
        var startdate = "<?php echo $startDate; ?>";
        var endDate = "<?php echo $endDate; ?>";
        var avail = <?php echo $Avail_leaves; ?>;
        var Ltype = "<?php echo $Ltype; ?>";
        var diff = <?php   $sd = strtotime($startDate);
                            $ed = strtotime($endDate);
                            $diff = (int) (($ed - $sd) / 60 / 60 / 24);
                            echo $diff;
                    ?>;
        
        if(diff>avail){
            alert("This leave is borrowed from upcoming years available leaves");
        }
        $("#reject").click(function() {
            $.ajax({
                type: "POST",
                url: "actionccf.php?action=reject",
                data: "Lid=" + Lid + "&Fid=" + fid,
                success: function(result) {
                    alert(result);
                    if (result == 1) {
                        window.location.href = "ccf.php";
                    } else {
                        alert('contact ntn!');
                    }
                }
            });
        })

        $("#comment").click(function() {
            $.ajax({
                type: "POST",
                url: "actionccf.php?action=comment",
                data: "Lid=" + Lid + "&applicantid=" + fid +"&comment=" + $("#write_comment").val(),
                success: function(result) {
                    alert(result);
                    if (result == 1) {
                        window.location.href = "ccf.php";
                    } else {
                        alert('contact ntn!');
                    }
                }
            });
        })

        $("#approve").click(function() {
            $.ajax({
                type: "POST",
                url: "actionccf.php?action=approve",
                data: "Fid=" + fid + "&startDate=" + startdate + "&endDate=" + endDate + "&avail=" + avail + "&Ltype=" + Ltype + "&Lid=" + Lid,
                success: function(result) {
                    if (result == 1) {
                        window.location.href = "ccf.php";
                    } else {
                        alert('contact kml!');
                    }
                }
            });
        });
    </script>
</body>

</html>