<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$loan_type = $_POST['loan_type'];
		
		$sql = "UPDATE loan_type SET loan_type = '$loan_type' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Loan Type updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:loan_type.php');

?>