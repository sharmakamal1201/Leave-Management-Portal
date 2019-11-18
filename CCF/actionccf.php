<?php
include('../tool/functions.php');
$role = $_SESSION['role'];
$mail = $_SESSION['email'];
if ($_GET['action'] == 'reject') {
    $Lid = $_POST['Lid'];
    $Fid_applicant = $_POST['Fid'];
    $q1 = "SELECT * FROM leaveapplication WHERE Fid='$Fid_applicant'";
    $r1 = mysqli_query($mySql_db, $q1);
    $rw1 = mysqli_fetch_assoc($r1);
    $sd = $rw1['startDate'];
    $ed = $rw1['endDate'];
    $Ltype = $rw1['Ltype'];
    $lvid = $rw1['LeaveId'];
    $query2 = "UPDATE leaverecord SET CurrentStatus = 'not applied' WHERE Fid='$Fid_applicant'";
    $res2 = mysqli_query($mySql_db, $query2);
    $query4 = "DELETE FROM leaveapplication WHERE Fid='$Fid_applicant'";
    $res4 = mysqli_query($mySql_db, $query4);
    $qry = "SELECT * FROM hod WHERE email='$mail'";
    if ($role == 'hod') {
        $qry = "SELECT * FROM hod WHERE email='$mail'";
    } else if ($role == 'associatedean') {
        $qry = "SELECT * FROM associatedean WHERE email='$mail'";
    } else if ($role == 'deanfaa') {
        $qry = "SELECT * FROM dean WHERE email='$mail'";
    } else if ($role == 'director') {
        $qry = "SELECT * FROM director WHERE email='$mail'";
    }
    $rslt = mysqli_query($mySql_db, $qry);
    $rw = mysqli_fetch_assoc($rslt);
    $id = $rw['Fid'];
    $q = "INSERT INTO pastrecord(leaveType,approvalDate,Fid,startDate,endDate,Lid)  VALUES('$Ltype','0000-00-00 00:00:00','$Fid_applicant','$sd','$ed','$lvid')";
    mysqli_query($mySql_db, $q);
    /////Mongo db start here
    $myTimeZone = date_default_timezone_set("Asia/kolkata");
    $today = date('Y-m-d H:i:s');
    $collection = $database->leave_application;
    $query = array('LeaveId' => $Lid);
    //checking for existing user
    $leave_obj = $collection->findOne($query);
    $new_val = array(
        "role" => $role,
        "email" => $id,
        "time" => $today
    );
    $collection->update(
        array("_id" => $leave_obj['_id']),
        array('$push' => array("RejectedBy" => $new_val))
    );
    echo 1;
    /////Mongodb End here
} else if ($_GET['action'] == 'comment') {
    $leaveId = $_POST['Lid'];
    $comment = $_POST['comment'];
    $qry = "SELECT * FROM hod WHERE email='$mail'";
    if ($role == 'hod') {
        $qry = "SELECT * FROM hod WHERE email='$mail'";
    } else if ($role == 'associatedean') {
        $qry = "SELECT * FROM associatedean WHERE email='$mail'";
    } else if ($role == 'deanfaa') {
        $qry = "SELECT * FROM dean WHERE email='$mail'";
    } else if ($role == 'director') {
        $qry = "SELECT * FROM director WHERE email='$mail'";
    }
    $rslt = mysqli_query($mySql_db, $qry);
    $rw = mysqli_fetch_assoc($rslt);
    $id = $rw['Fid'];
    /////Mongo db start here
    $myTimeZone = date_default_timezone_set("Asia/kolkata");
    $today = date('Y-m-d H:i:s');
    $collection = $database->leave_application;
    $query = array('LeaveId' => $leaveId);
    //checking for existing user
    $leave_obj = $collection->findOne($query);
    $new_comment = array(
        "role" => $role,
        "comment" => $comment,
        "email" => $id,
        "time" => $today
    );
    $collection->update(
        array("_id" => $leave_obj['_id']),
        array('$push' => array("CommentBy" => $new_comment))
    );
    /////Mongodb End here
    $applicant_id = $_POST['applicantid'];
    $qry2 = "UPDATE leaverecord SET CurrentStatus='reapply' WHERE Fid='$applicant_id'";
	mysqli_query($mySql_db, $qry2);
    echo 1;
} else if ($_GET['action'] == 'approve') {
    $Fid_applicant = $_POST['Fid'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $Avail_leaves = $_POST['avail'];
    $Ltype = $_POST['Ltype'];
    $Lid = $_POST['Lid'];
    $qry = "SELECT * FROM hod WHERE email='$mail'";
    if ($role == 'hod') {
        $qry = "SELECT * FROM hod WHERE email='$mail'";
    } else if ($role == 'associatedean') {
        $qry = "SELECT * FROM associatedean WHERE email='$mail'";
    } else if ($role == 'deanfaa') {
        $qry = "SELECT * FROM dean WHERE email='$mail'";
    } else if ($role == 'director') {
        $qry = "SELECT * FROM director WHERE email='$mail'";
    }
    $rslt = mysqli_query($mySql_db, $qry);
    $rw = mysqli_fetch_assoc($rslt);
    $id = $rw['Fid'];
    /////Mongo db start here
    $myTimeZone = date_default_timezone_set("Asia/kolkata");
    $today = date('Y-m-d H:i:s');
    $collection = $database->leave_application;
    $query = array('LeaveId' => $Lid);
    $leave_obj = $collection->findOne($query);
    $new_approve = array(
        "role" => $role,
        "email" => $id,
        "time" => $today
    );
    $collection->update(
        array("_id" => $leave_obj['_id']),
        array('$push' => array("ApprovedBy" => $new_approve))
    );
    /////Mongodb End here
    $findpos = "SELECT * FROM hierarchy WHERE From1='$role'";
    $findres = mysqli_query($mySql_db, $findpos);
    if (mysqli_num_rows($findres) == 0) {
        $Lstatus = "approved";
    } else {
        $Lstatus = "approved by " . $role;
    }
    $query1 = "UPDATE leaverecord SET CurrentStatus = '$Lstatus' WHERE Fid='$Fid_applicant'";
    $res1 = mysqli_query($mySql_db, $query1);
    if ($Lstatus == 'approved') {
        $sd = strtotime($startDate);
        $ed = strtotime($endDate);
        $diff = (int) (($ed - $sd) / 60 / 60 / 24);
        $now = $Avail_leaves - $diff;
        $query2 = "UPDATE leaverecord SET leavesAvailable = '$now', CurrentStatus = 'not applied' WHERE Fid='$Fid_applicant'";
        $res2 = mysqli_query($mySql_db, $query2);
        $myTimeZone = date_default_timezone_set("Asia/kolkata");
        $date = date('Y-m-d H:i:s');
        $query3 = "INSERT INTO pastrecord(leaveType,approvalDate,Fid,startDate,endDate,Lid) VALUES('$Ltype','$date','$Fid_applicant','$startDate','$endDate','$Lid')";
        $res3 = mysqli_query($mySql_db, $query3);
        $query4 = "DELETE FROM leaveapplication WHERE Fid='$Fid_applicant'";
        $res4 = mysqli_query($mySql_db, $query4);
    }
    echo 1;
}

?>