<?php
	include 'includes/session.php';

	if(isset($_POST['delete'])){
		$id = $_POST['id'];
		$loan_type = '';
		
		$sql = "SELECT loan_type FROM loantable WHERE id = '$id'";
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();
		$loan_type = $row['loan_type'];

		$sql = "DELETE FROM loantable WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Loan deleted successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Select item to delete first';
	}

	header('location: loans.php?id='.$loan_type);
	
?>