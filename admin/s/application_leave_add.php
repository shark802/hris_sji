<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
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

		$check_record_exist = "SELECT employee_id FROM applied_leave WHERE employee_id = '$employee_id' AND
								date_from = '$date_from' AND date_to = '$date_to' AND leave_type = '$leave_type'";
		$count = $conn->query($check_record_exist);
		
		if($count->num_rows > 0){
			$_SESSION['error'] = 'Leave application already exist';
		} else if($date_from > $date_to){
			$_SESSION['error'] = 'Date From exceeds Date To';
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
				$application_reference = "LV-".$date_from.$employee_id;
				echo $application_reference;

				$sql = "INSERT INTO applied_leave (application_reference, employee_id, date_from, date_to, leave_type, num_leave, reason,
					hr_approval, supervisor_approval, principal_approval, status) 
					VALUES ('$application_reference', '$employee_id', '$date_from', '$date_to', '$leave_type', '$num_leave', '$reason',
					'$hr_approval', '$supervisor_approval', '$principal_approval', '$status')";
				if($conn->query($sql)){
					if($status == "Approved"){
						$leave_available -= $num_leave;
						$update_leave_credit = "UPDATE leave_credit SET unused_leave = '$leave_available', 
												used_leave = '$num_leave' WHERE employee_id";
						$conn->query($update_leave_credit);
					}
					$_SESSION['success'] = 'Application leave added successfully';
				}
				else{
					$_SESSION['error'] = $conn->error;
				}
			} 
		}	
	} else{
		$_SESSION['error'] = 'Fill up add form first';
		
	}
	header('location: application_leave.php');
	
?>