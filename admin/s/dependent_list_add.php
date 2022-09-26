<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$employee_id = $_POST['employee_id'];
		$dependent_name = $_POST['dependent_name'];
		$amount = $_POST['amount'];
		$status = "Active";
		
		$sql = "INSERT INTO dependent (employee_id, dependent_name, amount, status) 
				VALUES ('$employee_id', '$dependent_name', '$amount', '$status')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Employee dependent added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}	
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: dependent_list.php');

?>