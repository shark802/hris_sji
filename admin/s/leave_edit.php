<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$employment_status = $_POST['employment_status'];
		$leave_type = $_POST['leave_type'];
		$abbreviation = $_POST['abbreviation'];
		$total_use = $_POST['total_use'];
		$monthly_accumulation = $_POST['monthly_accumulation'];

		$sql = "UPDATE leave_types SET employment_status = '$employment_status', leave_type = '$leave_type',
				abbreviation = '$abbreviation', total_use = '$total_use', monthly_accumulation = '$monthly_accumulation'
		 WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Leave Type updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:leave.php');

?>