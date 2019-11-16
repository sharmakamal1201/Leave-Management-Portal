<?php
include('tool/functions.php');
$fid = $_SESSION['email'];
$sqlcheck = "SELECT * FROM leaveapplication WHERE Fid = '$fid'";
$res = mysqli_query($mySql_db, $sqlcheck);
if (mysqli_num_rows($res) > 0) {
    $leave_rec = mysqli_fetch_assoc($res);
    $leaveId = $leave_rec['LeaveId'];
    /////Mongodb
    $collection = $database->leave_application;
    $query = array('LeaveId' => $leaveId);
    //checking for existing user
    $leave_obj = $collection->findOne($query);
    echo "<div class='container' style='padding-top:40px;'><h4>ApprovedBy</h4>";
    echo '<table class="table table-hover table-sm">
        <thead>
        <tr>
            <th scope="col">email</th>
            <th scope="col">role</th>
            <th scope="col">time</th>
        </tr>
        </thead>
        <tbody>';
    $iter = sizeof($leave_obj['ApprovedBy'])-1;
    while ($iter>=0) {
        echo '<tr><td>' . $leave_obj['ApprovedBy'][$iter]['email'] . '
                  </td><td> ' . $leave_obj['ApprovedBy'][$iter]['role'] . '
                  </td><td> ' . $leave_obj['ApprovedBy'][$iter]['time'] . '
                  </td>
             </tr>';
        $iter = $iter - 1;
    }
    echo "</tbody></table></div>";
    echo "<div class='container' style='padding-top:40px;'><h4>Comments</h4><hr>";
    
    $iter = sizeof($leave_obj['CommentBy'])-1;
    while ($iter>=0) {
        echo '<div class="card" style="width:80%;">
                <div class="card-header">
                    <h5 class="modal-title">CommentBy:' . $leave_obj['CommentBy'][$iter]['role'] . '</h5>
                </div>
                <div class="card-body">
                  <p style="white-space: pre-line;">' . $leave_obj['CommentBy'][$iter]['comment'] . '</p>
                </div>
                <div class="card-footer text-muted">
                    <div class ="row">
                    <div class="col">' . $leave_obj['CommentBy'][$iter]['email'] . '</div>
                    <div class="col">' . $leave_obj['CommentBy'][$iter]['time'] . '</div>
                    </div>
                </div>
            </div>';
        $iter = $iter - 1;
    }
    echo "</div>";
}

?>