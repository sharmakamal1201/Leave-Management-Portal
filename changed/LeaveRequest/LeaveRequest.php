<?php
include("../tool/header.php");
include("../tool/functions.php");
/*
if(!isset($_SESSION['email'])){
  header("Location: ../check.php");
} else {
	$mailid = $_SESSION['email'];
	$query = "SELECT * FROM hod WHERE email= '$mailid'";
	$res = mysqli_query($mySql_db, $query);
	$query1 = "SELECT * FROM dean WHERE email= '$mailid'";
	$res1 = mysqli_query($mySql_db, $query);
	$query2 = "SELECT * FROM director WHERE email= '$mailid'";
	$res2 = mysqli_query($mySql_db, $query);
	if (mysqli_num_rows($res)==0 || mysqli_num_rows($res1)==0 || mysqli_num_rows($res2)==0) {
		header("Location: ../check.php");
	}
}
*/


$role = 'hod';
$mail = $_SESSION['email'];
$query = "SELECT * FROM leaveapplication";
$res = mysqli_query($mySql_db, $query);
while ($row = mysqli_fetch_assoc($res)) {
    $Fid = $row['Fid'];
    $type = $row['Ltype'];
    $startDate = $row['startDate'];
    $endDate = $row['endDate'];
    $qry = "SELECT * FROM leaverecord WHERE Fid='$Fid'";
    $rslt = mysqli_query($mySql_db, $qry);
    $row_new = mysqli_fetch_assoc($rslt);
    $Avail = $row_new['leavesAvailable'];
    $status = $row_new['CurrentStatus'];
    $sd = strtotime($startDate);
    $ed = strtotime($endDate);
    $diff = (int) (($ed - $sd) / 60 / 60 / 24);
    $q = "SELECT * FROM faculty WHERE email='$Fid'";
    $r = mysqli_query($mySql_db, $q);
    $rw = mysqli_fetch_assoc($r);
    $dept = $rw['department'];
    $check = 1;
    if ($role = 'hod') {
        $q1 = "SELECT * FROM hod WHERE email='$mail'";
        $r1 = mysqli_query($mySql_db, $q1);
        $rw1 = mysqli_fetch_assoc($r1);
        $dept1 = $rw1['department'];
        if ($dept != $dept1) {
            $check = 0;
        }
    }
    if ($status == 'applied' && $role == 'hod' && $check == 1 && $diff <= $Avail) {
        echo '<p>Applied by: ' . $Fid . '
            <br>leaves available: ' . $Avail . '
            <br>start date: ' . $startDate . '
            <br>end date: ' . $endDate . '
            <br>leave type: ' . $type . '
            <br></p>';
    }
}
