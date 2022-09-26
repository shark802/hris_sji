<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$fee = $_POST['fee'];
		$amount = $_POST['amount'];
		$status = $_POST['status'];

		if($status == 'UserDefine'){
			$amount = '-';
		}
		
		$sql = "INSERT INTO additional_fee (fee, status, amount) 
				VALUES ('$fee', '$status', '$amount')";
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

	header('location: fee.php');

?>