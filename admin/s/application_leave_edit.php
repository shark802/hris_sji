<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$employee_id = $_POST['employee_id'];
		$date_from = $_POST['date_from'];
		$date_to = $_POST['date_to'];
		$leave_type = $_POST['leave_type'];
		$reason = $_POST['reason'];
		$hr_approval = $_POST['hr_approval'];
		$supervisor_approval = $_POST['supervisor_approval'];
		$principal_approval = $_POST['principal_approval'];
		$status = '';

		$date_from = date('Y/m/d', strtotime($date_from));
		$date_to = date('Y/m/d', strtotime($date_to));
		$day_of_week = date("N", strtotime($date_from));
		$weekend_exist = false;
		$date_diff = (strtotime($date_to) - strtotime($date_from)) / (60*60*24);
		$days = $day_of_week + $date_diff;
		if($days >= 6){
			$weekend_exist = true;
		} 

		$check_record_exist = "SELECT employee_id, status FROM applied_leave WHERE employee_id = '$employee_id' AND
								date_from = '$date_from' AND date_to = '$date_to' AND leave_type = '$leave_type'";
		$count = $conn->query($check_record_exist);

		$check_leave_details = "SELECT status FROM applied_leave WHERE id = '$id'";
		$leave_details = $conn->query($check_leave_details);
		$row = $leave_details->fetch_assoc();
		$al_status = $row['status'];
		
		if($date_from > $date_to){
			$_SESSION['error'] = 'Date From exceeds Date To';
		} else if($al_status == 'Approved'){
			$_SESSION['error'] = 'Leave Application already Approved. Changes to leave application denied.';
		} else {
			$num_leave = $date_diff += 1;
			if($weekend_exist == true){
				$num_leave -= 2;
			}
			$check_leave_credit_record = "SELECT unused_leave FROM leave_credit 
								WHERE employee_id = '$employee_id' AND leave_type = '$leave_type'";
			$check_query = $conn->query($check_leave_credit_record);
			$row = $check_query->fetch_assoc();
			$leave_available = $row['unused_leave'];
			
			if($leave_available < $num_leave){
				$_SESSION['error'] = '<b>'.$leave_type.'</b> credit for is not enough.';
			} else {
				if($hr_approval == 1 && $supervisor_approval == 1 && $principal_approval == 1){
					$status = "Approved";
				} else if($hr_approval == 0 || $supervisor_approval == 0 || $principal_approval == 0){
					$status = "Denied";
				} else {
					$status = "Pending";
				}
				$sql = "UPDATE applied_leave SET date_from = '$date_from', date_to = '$date_to', leave_type = '$leave_type',
						num_leave = '$num_leave', hr_approval = '$hr_approval', supervisor_approval = '$supervisor_approval',
						principal_approval = '$principal_approval' WHERE id = '$id'";
				if($conn->query($sql)){
					if($status == "Approved"){
						$leave_available -= $num_leave;
						$update_leave_credit = "UPDATE leave_credit SET unused_leave = '$leave_available', 
												used_leave = '$num_leave' WHERE employee_id = '$id'";
						$conn->query($update_leave_credit);
					}
					$_SESSION['success'] = 'Application leave updated successfully';
				}
				else{
					$_SESSION['error'] = $conn->error;
				}
			} 
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:application_leave.php');

?>