<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
	    $approval = $user['description'];

		if($approval == 'Principal'){
			$sql = "UPDATE applied_leave SET principal_approval = '1' WHERE id = '$id'";
		} else if($approval == 'HR Manager'){
			$sql = "UPDATE applied_leave SET hr_approval = '1' WHERE id = '$id'";
		} else {
			$sql = "UPDATE applied_leave SET supervisor_approval = '1' WHERE id = '$id'";
		} 
 
		if($conn->query($sql)){
			$checkApproval = "SELECT * FROM applied_leave WHERE employee_id = '$id'";
			$query = $conn->query($checkApproval);
			$row = $query->fetch_assoc();
			$status = '';
			
			$principal_approval = $row['principal_approval'];
			$hr_approval = $row['hr_approval'];
			$supervisor_approval = $row['supervisor_approval'];

			if($hr_approval == 1 && $supervisor_approval == 1 && $principal_approval == 1){
				$status = "Approved";
			} else if($hr_approval == 0 || $supervisor_approval == 0 || $principal_approval == 0){
				$status = "Denied";
			} else {
				$status = "Pending";
			}
				
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
	

	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:leave_request.php');

?>