<?php
	include 'includes/session.php';

	if(isset($_POST['delete'])){
		$id = $_POST['id'];
		$sql = "DELETE FROM loan_type WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Loan Type deleted successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Select item to delete first';
	}

	header('location: loan_type.php');
	
?>