<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$employee_id = $_POST['employee_id'];
		$leave_type = $_POST['leave_type'];
		$used_leave = $_POST['used_leave'];
		$unused_leave = $_POST['unused_leave'];

		echo $employee_id;

		$check_leave_exist = "SELECT * FROM leave_credit WHERE leave_type = '$leave_type' AND employee_id = '$employee_id'";
		$count = $conn->query($check_leave_exist);
		if($count->num_rows > 0){
			$_SESSION['error'] = 'Leave Type already exist';
		} else {

			
			$sql = "INSERT INTO leave_credit (employee_id, leave_type, used_leave, unused_leave) 
			VALUES ('$employee_id', '$leave_type', '$used_leave', '$unused_leave')";
			if($conn->query($sql)){
				$_SESSION['success'] = 'Leace credit added successfully';
			}
			else{
				$_SESSION['error'] = $conn->error;
			} 	
		} 
	
	header('location:http://localhost/payroll/web/admin/leave_credit.php?id='.$employee_id);
	}
	
?>