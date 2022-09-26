<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$deduction = $_POST['deduction'];
		$scheme = $_POST['scheme'];
		$amount = $_POST['amount'];
		
		$sql = "INSERT INTO benefits_contributions (deduction, scheme, amount) 
				VALUES ('$deduction', '$scheme', '$amount')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Benefits & Contributions added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}	
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: benefits.php');

?>