<?php
include("tool/functions.php");

$error = "";
$leaveType = $_POST['leaveType'];
$fromDate = $_POST['fromDate'];
$toDate = $_POST['toDate'];
$message = $_POST['message'];
if (!$fromDate) {
	$error = "From Date is Required!";
}
if (!$toDate) {
	$error = "To Date is Required!";
}
if (!$message) {
	$error = "message is Required!";
}
$role = $_SESSION['role'];
$fid = $_SESSION['email'];
$qry = "";
if ($role == 'hod') {
	$qry = "SELECT * FROM hod WHERE  email = '$fid'";
} else if ($role == 'deanfaa') {
	$qry = "SELECT * FROM dean WHERE  email = '$fid'";
} else if ($role == 'director') {
	$qry = "SELECT * FROM director WHERE  email = '$fid'";
}
if ($role == 'hod' || $role == 'deanfaa' || $role == 'director') {
	$res1 = mysqli_query($mySql_db, $qry);
	$result = mysqli_fetch_assoc($res1);
	$fid = $result['Fid'];
}
$sqlcheck = "SELECT * FROM leaveapplication WHERE Fid = '$fid'";
$res = mysqli_query($mySql_db, $sqlcheck);
if (mysqli_num_rows($res) > 0) {
	$error = "Your previous request is in Pending";
}
if ($error == "") {
	$maxquery = "SELECT max(LeaveId) AS maxi FROM leaveapplication";
	$resmax = mysqli_query($mySql_db, $maxquery);
	$rowdata = mysqli_fetch_assoc($resmax);
	$maximum = $rowdata['maxi'];
	$maximum = $maximum + 1;
	$sq1 = "INSERT INTO leaveapplication(Ltype, startDate,endDate,LeaveId,Fid) VALUES('$leaveType','$fromDate','$toDate','$maximum','$fid')";
	mysqli_query($mySql_db, $sq1);
	$sq11 = "SELECT * FROM leaverecord WHERE Fid='$fid'";
	$r11 = mysqli_query($mySql_db, $sq11);

	if (mysqli_num_rows($r11) == 0) {
		$sq12 = "INSERT INTO leaverecord(leavesAvailable,CurrentStatus,Fid) VALUES('20','applied','$fid')";
		mysqli_query($mySql_db, $sq12);
	} else {
		$sq12 = "UPDATE leaverecord SET CurrentStatus='applied' WHERE Fid='$fid'";
		mysqli_query($mySql_db, $sq12);
	}
	echo 1;
}
if ($error != "") {
	echo $error;
}
