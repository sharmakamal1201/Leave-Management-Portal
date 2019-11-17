<?php
include('tool/functions.php');
$leaveId = $_POST['leaveId'];
$Ltype = "";
$sd = "";
$ed = "";
$flag = 0;
$q = "SELECT * FROM pastrecord WHERE Lid='$leaveId'";
$rs = mysqli_query($mySql_db, $q);
if (mysqli_num_rows($rs) > 0) {
	$rw = mysqli_fetch_assoc($rs);
	$Ltype = $rw['leaveType'];
	$sd = $rw['startDate'];
	$ed = $rw['endDate'];
	$app_id = $rw['Fid'];
	$flag = 1;
}
$q = "SELECT * FROM leaveapplication WHERE LeaveId='$leaveId'";
$rs = mysqli_query($mySql_db, $q);
if (mysqli_num_rows($rs) > 0) {
	$rw = mysqli_fetch_assoc($rs);
	$Ltype = $rw['Ltype'];
	$sd = $rw['startDate'];
	$ed = $rw['endDate'];
	$app_id = $rw['Fid'];
	$flag = 1;
}
if ($flag == 1) {
	echo "<div class='container' style='padding-top:40px;'>";
	echo '<table class="table table-hover table-sm">
		<thead>
		<tr>
			<th scope="col">Applicant ID</th>
			<th scope="col">Leave Type</th>
			<th scope="col">Start Date</th>
			<th scope="col">End Date</th>
		</tr>
		</thead>
		<tbody>
		<tr>
			<td>' . $app_id . '</td>
			<td> ' . $Ltype . '</td>
			<td> ' . $sd . '</td>
			<td> ' . $ed . '</td>
		</tr></tbody>
		</table>
	</div>';
}
/////Mongodb
$collection = $database->leave_application;
$query = array('LeaveId' => $leaveId);
//checking for existing user
$leave_obj = $collection->findOne($query);
if (!empty($leave_obj) || $leave_obj == null) {
	// echo "<div class='container' style='padding-top:40px;'><h4>".$leave_obj['email']."</h4></div>";
	echo "<div class='container' style='padding-top:40px;'><h4>Request message</h4>";
	if (sizeof($leave_obj['ApprovedBy']) > 0) {
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
		$iter = sizeof($leave_obj['ApprovedBy']) - 1;
		while ($iter >= 0) {
			echo '<tr><td>' . $leave_obj['ApprovedBy'][$iter]['email'] . '
				  </td><td> ' . $leave_obj['ApprovedBy'][$iter]['role'] . '
				  </td><td> ' . $leave_obj['ApprovedBy'][$iter]['time'] . '
				  </td>
			 </tr>';
			$iter = $iter - 1;
		}
		echo "</tbody></table></div>";
	}
	if (sizeof($leave_obj['RejectedBy']) > 0) {
		echo "<div class='container' style='padding-top:40px;'><h4>RejectedBy</h4>";
		echo '<table class="table table-hover table-sm">
		<thead>
		<tr>
			<th scope="col">email</th>
			<th scope="col">role</th>
			<th scope="col">time</th>
		</tr>
		</thead>
		<tbody>';
		$iter = sizeof($leave_obj['RejectedBy']) - 1;
		while ($iter >= 0) {
			echo '<tr><td>' . $leave_obj['RejectedBy'][$iter]['email'] . '
				  </td><td> ' . $leave_obj['RejectedBy'][$iter]['role'] . '
				  </td><td> ' . $leave_obj['RejectedBy'][$iter]['time'] . '
				  </td>
			 </tr>';
			$iter = $iter - 1;
		}
		echo "</tbody></table></div>";
	}
	if (sizeof($leave_obj['AppliedBy']) > 0) {
		echo "<div class='container' style='padding-top:40px;'><h4>Requests-Comments series</h4><hr>";

		$iter = sizeof($leave_obj['AppliedBy']) - 1;
		$iter2 = sizeof($leave_obj['CommentBy']) - 1;
		while ($iter >= 0) {
			echo '<div class="card" style="width:80%;">
					<div class="card-header">
						<h5 class="modal-title">RequestBy:' . $leave_obj['AppliedBy'][$iter]['AppliedTime'] . '</h5>
					</div>
					<div class="card-body">
						<p style="white-space: pre-line;">' . $leave_obj['AppliedBy'][$iter]['message'] . '</p>
					</div>
					<div class="card-footer text-muted">
						<div class ="row">
							<div class="col"></div>
							<div class="col"></div>
						</div>
					</div>
				</div>';
			if ($iter2 >= 0) {
				echo '<div class="card" style="width:80%;">
						<div class="card-header">
							<h5 class="modal-title">CommentBy:' . $leave_obj['CommentBy'][$iter2]['role'] . '</h5>
						</div>
						<div class="card-body">
							<p style="white-space: pre-line;">' . $leave_obj['CommentBy'][$iter2]['comment'] . '</p>
						</div>
						<div class="card-footer text-muted">
							<div class ="row">
								<div class="col">' . $leave_obj['CommentBy'][$iter2]['email'] . '</div>
								<div class="col">' . $leave_obj['CommentBy'][$iter2]['time'] . '</div>
							</div>
						</div>
					</div>';
			}
			$iter = $iter - 1;
			$iter2 = $iter2 - 1;
		}
		echo "</div>";
	}
} else {
	echo "<div class='container' style='padding-top:40px;'><h4>No Data Exit On this LeaveId</h4></div>";
}
