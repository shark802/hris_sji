<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$employee_id = $_POST['employee_id'];
		$dependent_name = $_POST['dependent_name'];
		$amount = $_POST['amount'];
		$status = $_POST['status'];

		$sql = "UPDATE dependent SET employee_id = '$employee_id', dependent_name = '$dependent_name', amount = '$amount', status = '$status' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Dependent details updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:dependent_list.php');

?>