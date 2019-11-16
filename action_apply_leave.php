<?php
include("tool/functions.php");

$error = "";
$leaveType = $_POST['leaveType'];
$fromDate = $_POST['fromDate'];
$toDate = $_POST['toDate'];
$message = $_POST['message'];
$email = $_SESSION['email'];
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
if ($_GET['action'] == 'reApply' && $error=="") {
	$Lid = $_POST['Lid'];
	$qry1 = "UPDATE leaveapplication SET startDate='$fromDate',endDate='$toDate',Ltype='$leaveType' WHERE LeaveId ='$Lid'";
	mysqli_query($mySql_db, $qry1);
	$qr = "SELECT * FROM leaveapplication WHERE LeaveId='$Lid'";
	$rs=mysqli_query($mySql_db, $qr);
	$rw=mysqli_fetch_assoc($rs);
	$applicant_id = $rw['Fid'];
	$qry2 = "UPDATE leaverecord SET CurrentStatus='applied' WHERE Fid='$applicant_id'";
	mysqli_query($mySql_db, $qry2);
	///mongodb start
	$collection = $database->leave_application;
	$query = array("LeaveId" => $Lid);
	//checking for existing user
	$leave_obj = $collection->findOne($query);
	$new_task = array(
		"role" => $role,
		"message" => $message
	);
	$collection->update(
		array("_id" => $leave_obj['_id']),
		array('$set' => array("AppliedBy" => array($new_task))
	));

	////mongodb end here
} else {
	$qry = "";
	if ($role == 'hod') {
		$qry = "SELECT * FROM hod WHERE  email = '$fid'";
	} else if ($role == 'associatedean') {
		$qry = "SELECT * FROM associatedean WHERE  email = '$fid'";
	} else if ($role == 'deanfaa') {
		$qry = "SELECT * FROM dean WHERE  email = '$fid'";
	} else if ($role == 'director') {
		$qry = "SELECT * FROM director WHERE  email = '$fid'";
	}
	if ($role == 'hod' || $role == 'associatedean' || $role == 'deanfaa' || $role == 'director') {
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
		$sq1 = "INSERT INTO leaveapplication(Ltype, startDate,endDate,Fid) VALUES('$leaveType','$fromDate','$toDate','$fid')";
		mysqli_query($mySql_db, $sq1);
		$sqlleave = "SELECT * FROM leaveapplication WHERE Fid='$fid'";
		$resleave = mysqli_query($mySql_db, $sqlleave);
		$resultleave = mysqli_fetch_assoc($resleave);
		$leaveId = $resultleave['LeaveId'];

		//Mongodb Section//
		//$collection = $database->createCollection("leave_application");
		$today = new MongoDate(strtotime(date('Y-m-d 00:00:00')));
		$collection = $database->leave_application;
		$leave_application = array("LeaveId" => $leaveId, "AppliedTime" => $today, "AppliedBy" => array(), "CommentBy" => array(), "ApprovedBy" => array(), "RejectedBy" => array());
		$collection->save($leave_application);
		$query = array("LeaveId" => $leaveId);
		//checking for existing user
		$leave_obj = $collection->findOne($query);
		if (empty($leave_obj)) {
			echo 4;
		} else {
			echo 5;
		}
		$new_task = array(
			"role" => $role,
			"message" => $message
		);
		$collection->update(
			array("_id" => $leave_obj['_id']),
			array('$push' => array("AppliedBy" => $new_task))
		);
		///Mongodb end here
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
}
if ($error != "") {
	echo $error;
}
