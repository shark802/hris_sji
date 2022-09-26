<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
        $loan_type = $_POST['loan_type'];
		$user = $_POST['id'];
     
		$sql = "SELECT * FROM loan_type WHERE loan_type = '$loan_type'";
		$query = $conn->query($sql);
		if($query->num_rows > 1){
			$_SESSION['error'] = 'Loan Type already exist';
		}
		else{
			$sql = "INSERT INTO loan_type (loan_type, modified_by, modified_date) VALUES ('$loan_type', '$user', NOW())";
			if($conn->query($sql)){
				$_SESSION['success'] = 'Loan Type added successfully';
			}
			else{
				$_SESSION['error'] = $conn->error;
			}
		}
	}	
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: loan_type.php');

?>