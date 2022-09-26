<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
        $loan_type = $_POST['loan_type'];
		$employee_id = $_POST['employee_id'];
		$date_loan = $_POST['date_loan'];
		$loan_amount = $_POST['loan_amount'];
		$payment_term = $_POST['payment_term'];
		$obligation = $_POST['obligation'];
		$status = 'Active';
	
		$sql = "SELECT * FROM loantable WHERE loan_type = '$loan_type' && 
				employee_id = '$employee_id' && date_loan = '$date_loan' && loan_amount = '$loan_amount'";
		$query = $conn->query($sql);
		if($query->num_rows > 1){
			$_SESSION['error'] = 'Loan already exist';
		}
		else{
			$sql = "INSERT INTO loantable (employee_id, loan_type, date_loan, loan_amount, payment_term, balance, obligation, total_amount_paid, total_month_paid, status) 
					VALUES ('$employee_id', '$loan_type', '$date_loan', '$loan_amount', '$payment_term', '$loan_amount', '$obligation', 0, 0, '$status')";
			if($conn->query($sql)){
				$_SESSION['success'] = 'Loan added successfully';
			}
			else{
				$_SESSION['error'] = $conn->error;
			}
		}
	}	
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: loans.php?id='.$loan_type);

?>