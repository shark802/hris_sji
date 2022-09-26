<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$employment_status = $_POST['employment_status'];
		$leave_type = $_POST['leave_type'];
		$abbreviation = $_POST['abbreviation'];
		$total_use = $_POST['total_use'];
		$monthly_accumulation = $_POST['monthly_accumulation'];
		
		$sql = "INSERT INTO leave_types (employment_status, leave_type, abbreviation, total_use, monthly_accumulation) 
				VALUES ('$employment_status', '$leave_type', '$abbreviation', '$total_use', '$monthly_accumulation')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Leave added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}	
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: leave.php');

?>