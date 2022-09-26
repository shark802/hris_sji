<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$status = $_POST['status'];

		$sql = "INSERT INTO status (status) VALUES ('$status')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Employment Status added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}

	}
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: employee_status.php');
?>