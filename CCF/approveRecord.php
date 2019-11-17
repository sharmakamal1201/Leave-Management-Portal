<?php
include("../tool/functions.php");
include("../tool/header.php");

$role = $_GET['role'];
$email = $_GET['email'];
/////Mongodb
$collection = $database->ApproveRequest;
$query = array('email' => $email);
//checking for existing user
$leave_obj = $collection->findOne($query);
?>
<div class="container" style="margin-top:20px;">
    <?php
    echo '<table class="table table-hover table-sm">
    <thead>
    <tr>
        <th scope="col">LeaveId</th>
        <th scope="col">Role</th>
        <th scope="col">Approvedtime</th>
    </tr>
    </thead>
    <tbody>';
    $iter = sizeof($leave_obj['Approve']) - 1;
    while ($iter >= 0) {
        echo '<tr><td>' . $leave_obj['Approve'][$iter]['leaveId'] . '
                </td><td> ' . $leave_obj['Approve'][$iter]['role'] . '
                </td><td> ' . $leave_obj['Approve'][$iter]['time'] . '
                </td>
            </tr>';
        $iter = $iter - 1;
    }
    echo "</tbody></table>";
    ?>
</div>
</body>

</html>