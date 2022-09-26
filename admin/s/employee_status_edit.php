<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$status = $_POST['status'];
		
		$sql = "UPDATE status SET status = '$status' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Employment Status updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}

	}
	else{
		$_SESSION['error'] = 'Select employment status to edit first';
	}

	header('location: employee_status.php');
?>