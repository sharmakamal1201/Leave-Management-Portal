<?php
include("../tool/functions.php");

if (!isset($_SESSION['email'])) {
    header("Location: ../check.php");
} else {
    $mailid = $_SESSION['email'];
    $query = "SELECT * FROM hod WHERE email= '$mailid'";
    $res = mysqli_query($mySql_db, $query);
    $query1 = "SELECT * FROM dean WHERE email= '$mailid'";
    $res1 = mysqli_query($mySql_db, $query1);
    $query2 = "SELECT * FROM director WHERE email= '$mailid'";
    $res2 = mysqli_query($mySql_db, $query2);
    if (mysqli_num_rows($res) == 0 && mysqli_num_rows($res1) == 0 && mysqli_num_rows($res2) == 0) {
        header("Location: ../check.php");
    }
}

$role = $_SESSION['role'];
$mail = $_SESSION['email'];
$findpos = "SELECT * FROM hierarchy WHERE To1='$role'";
$findres = mysqli_query($mySql_db, $findpos);
$findrow = mysqli_fetch_assoc($findres);
$curr = $findrow['To1'];
$prevrole = $findrow['From1'];
$query = "SELECT * FROM leaveapplication";
$res = mysqli_query($mySql_db, $query);
echo '<table class="table table-hover table-sm">
        <thead>
        <tr>
            <th scope="col">Leave id</th>
            <th scope="col">Applied by</th>
            <th scope="col">leaves available</th>
            <th scope="col">start date</th>
            <th scope="col">end date</th>
            <th scope="col">leave type</th>
            <th scope="col">Leave current status</th>
            <th scope="col">view</th>
            </tr>
        </thead>
        <tbody>';
while ($row = mysqli_fetch_assoc($res)) {
    $Lid = $row['LeaveId'];
    $Fid_applicant = $row['Fid'];
    $Ltype = $row['Ltype'];
    $startDate = $row['startDate'];
    $endDate = $row['endDate'];
    $qry = "SELECT * FROM leaverecord WHERE Fid='$Fid_applicant'";
    $rslt = mysqli_query($mySql_db, $qry);
    $row_new = mysqli_fetch_assoc($rslt);
    $Avail_leaves = $row_new['leavesAvailable'];
    $status_current_leave = $row_new['CurrentStatus'];
    $sd = strtotime($startDate);
    $ed = strtotime($endDate);
    $diff = (int) (($ed - $sd) / 60 / 60 / 24);
    $q = "SELECT * FROM faculty WHERE email='$Fid_applicant'";
    $r = mysqli_query($mySql_db, $q);
    $rw = mysqli_fetch_assoc($r);
    $dept_applicant = $rw['department'];
    $role_applicant = $rw['role'];

    $check = 1;
    if ($role_applicant == $prevrole) {
        if ($status_current_leave != 'applied') {
            $check = 0;
        }
    } else if (($role_applicant != $prevrole)) {
        if ($status_current_leave != ('approved by ' . $prevrole)) {
            $check = 0;
        }
    }
    if ($role == 'hod') {
        $q1 = "SELECT * FROM hod WHERE email='$mail'";
        $r1 = mysqli_query($mySql_db, $q1);
        $rw1 = mysqli_fetch_assoc($r1);
        $dept_hod = $rw1['department'];
        if ($dept_hod != $dept_applicant) {
            $check = 0;
        }
    }
    if ($check == 1) {
        echo '<tr><td>' . $Lid . '
        </td><td> ' . $Fid_applicant . '
        </td><td> ' . $Avail_leaves . '
        </td><td> ' . $startDate . '
        </td><td> ' . $endDate . '
        </td><td> ' . $Ltype . '
        </td><td> ' . $status_current_leave . '
        </td><td><a href="commentrequest.php?action='.$Lid.'">view</a>
        </td></tr>';
    }
}
echo "</tbody></table>";
?>