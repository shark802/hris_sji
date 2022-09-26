<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$fee = $_POST['fee'];
		$status = $_POST['status'];
		$amount = $_POST['amount'];

		if($status == 'UserDefine'){
			$amount = '-';
		}
		
		$sql = "UPDATE additional_fee SET fee = '$fee', status = '$status', amount = '$amount' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Fee updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:fee.php');

?>