<?php
	include 'includes/session.php';

	if(isset($_POST['delete'])){
		$id = $_POST['id'];
		$sql = "DELETE FROM payroll WHERE id = '$id'";
		if($conn->query($sql)){
			$sql_pd = "DELETE FROM payroll_details WHERE payroll_id = '$id'";
			$conn->query($sql_pd);
			$_SESSION['success'] = 'Payroll deleted successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	

	if(isset($_POST['approve'])){
		$id = $_POST['id'];
		$sql = "UPDATE payroll SET status = 'Approved' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Payroll Approved successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	

	header('location: payroll_list.php');
	
?>