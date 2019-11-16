<?php
include('../tool/functions.php');
$role = $_SESSION['role'];
if ($_GET['action'] == 'comment') {
    
} 
else if ($_GET['action'] == 'approve') {
    $Fid_applicant = $_POST['Fid'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $Avail_leaves = $_POST['avail'];
    $Ltype = $_POST['Ltype'];
    $Lid = $_POST['Lid'];
    $findpos = "SELECT * FROM hierarchy WHERE From1='$role'";
    $findres = mysqli_query($mySql_db, $findpos);
    if (mysqli_num_rows($findres) == 0) {
        $Lstatus = "approved";
    } else {
        $Lstatus = "approved by ".$role;
    }
    $query1 = "UPDATE leaverecord SET CurrentStatus = '$Lstatus' WHERE Fid='$Fid_applicant'";
    $res1 = mysqli_query($mySql_db, $query1);
    if ($Lstatus == 'approved') {
        $sd = strtotime($startDate);
        $ed = strtotime($endDate);
        $diff = (int)(($ed - $sd) / 60 / 60 / 24);
        $now = $Avail_leaves - $diff;
        $query2 = "UPDATE leaverecord SET leavesAvailable = '$now', CurrentStatus = 'not applied' WHERE Fid='$Fid_applicant'";
        $res2 = mysqli_query($mySql_db, $query2);
        $myTimeZone = date_default_timezone_set("Asia/kolkata");
        $date = date('Y-m-d H:i:s');
        $query3 = "INSERT INTO pastrecord(leaveType,appovalDate,Fid,startDate,endDate,Lid) VALUES('$Ltype','$date','$Fid_applicant','$startDate','$endDate','$Lid')";
        $res3 = mysqli_query($mySql_db, $query3);
        $query4 = "DELETE FROM leaveapplication WHERE Fid='$Fid_applicant'";
        $res4 = mysqli_query($mySql_db, $query4);
    }
    echo 1;
}
?>