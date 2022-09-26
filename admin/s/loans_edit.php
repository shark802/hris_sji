<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$loan_type = $_POST['loan_type'];
		$date_loan = $_POST['date_loan'];
		$loan_amount = $_POST['loan_amount'];
		$payment_term = $_POST['payment_term'];
		$balance = $_POST['balance'];
		$obligation = $_POST['obligation'];
		$status = $_POST['status'];
		
		$sql = "UPDATE loantable SET date_loan = '$date_loan', loan_amount = '$loan_amount',
				payment_term = '$payment_term', obligation = '$obligation', balance = '$balance', status = '$status'
				WHERE id = '$id'";
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

	header('location: loans.php?id='.$loan_type);

?>