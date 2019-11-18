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
if ($_GET['action'] == 'reApply' && $error == "") {
	$Lid = $_POST['Lid'];
	$qry1 = "UPDATE leaveapplication SET startDate='$fromDate',endDate='$toDate',Ltype='$leaveType' WHERE LeaveId ='$Lid'";
	mysqli_query($mySql_db, $qry1);
	$qr = "SELECT * FROM leaveapplication WHERE LeaveId='$Lid'";
	$rs = mysqli_query($mySql_db, $qr);
	$rw = mysqli_fetch_assoc($rs);
	$applicant_id = $rw['Fid'];
	$qry2 = "UPDATE leaverecord SET CurrentStatus='applied' WHERE Fid='$applicant_id'";
	mysqli_query($mySql_db, $qry2);
	$sq13 = "SELECT * FROM leaverecord WHERE Fid='$fid'";
	$rs13 = mysqli_query($mySql_db, $sq13);
	$rw13 = mysqli_fetch_assoc($rs13);
	$sd = strtotime($fromDate);
	$ed = strtotime($toDate);
	$diff = (int) (($ed - $sd) / 60 / 60 / 24);
	$temp = 0;
	if ($rw13['leavesAvailable'] < $diff) {
		echo -1;
		$temp = 1;
	}
	$leaveStatus = 'regular';
	if ($temp == 1)
		$leaveStatus = 'borrowed';
	$myTimeZone = date_default_timezone_set("Asia/kolkata");
	$today = date('Y-m-d H:i:s');
	///mongodb start
	$collection = $database->leave_application;
	$query = array("LeaveId" => $Lid);
	//checking for existing user
	$leave_obj = $collection->findOne($query);
	$new_task = array(
		"AppliedTime" => $today,
		"message" => $message
	);
	$collection->update(
		array("_id" => $leave_obj['_id']),
		array(
			'$push' => array("AppliedBy" => $new_task)
		)
	);
	$collection->update(
		array("_id" => $leave_obj['_id']),
		array(
			'$set' => array("leaveStatus" => $leaveStatus)
		)
	);
	echo 1;
	////mongodb end here
} else if($error==""){
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
		$q = "SELECT * FROM faculty WHERE email='$fid'";
		$r = mysqli_query($mySql_db, $q);
		$rw = mysqli_fetch_assoc($r);
		$role = $rw['role'];


		$sq11 = "SELECT * FROM leaverecord WHERE Fid='$fid'";
		$r11 = mysqli_query($mySql_db, $sq11);
		$temp = 0;
		if (mysqli_num_rows($r11) == 0) {
			$sq12 = "INSERT INTO leaverecord(leavesAvailable,CurrentStatus,Fid) VALUES('20','applied','$fid')";
			mysqli_query($mySql_db, $sq12);
		} else {
			$sq12 = "UPDATE leaverecord SET CurrentStatus='applied' WHERE Fid='$fid'";
			mysqli_query($mySql_db, $sq12);
			$sq13 = "SELECT * FROM leaverecord WHERE Fid='$fid'";
			$rs13 = mysqli_query($mySql_db, $sq13);
			$rw13 = mysqli_fetch_assoc($rs13);
			$sd = strtotime($fromDate);
			$ed = strtotime($toDate);
			$diff = (int) (($ed - $sd) / 60 / 60 / 24);
			if ($rw13['leavesAvailable'] < $diff) {
				echo -1;
				$temp = 1;
			}
		}

		//Mongodb Section//
		//$collection = $database->createCollection("leave_application");
		$myTimeZone = date_default_timezone_set("Asia/kolkata");
		$today = date('Y-m-d H:i:s');
		$collection = $database->leave_application;
		$leaveStatus = 'regular';
		if ($temp == 1)
			$leaveStatus = 'borrowed';
		$leave_application = array("LeaveId" => $leaveId, "leaveStatus" => $leaveStatus, "email" => $fid, "role" => $role, "AppliedBy" => array(), "CommentBy" => array(), "ApprovedBy" => array(), "RejectedBy" => array());
		$collection->save($leave_application);
		$query = array("LeaveId" => $leaveId);
		//checking for existing user
		$leave_obj = $collection->findOne($query);
		if (empty($leave_obj)) {
			echo 4;
		}
		$new_task = array(
			"AppliedTime" => $today,
			"message" => $message
		);
		$collection->update(
			array("_id" => $leave_obj['_id']),
			array('$push' => array("AppliedBy" => $new_task))
		);
		///Mongodb end here
		echo 1;
	}
}
if ($error != "") {
	echo $error;
}
