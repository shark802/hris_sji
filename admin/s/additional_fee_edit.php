<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$employee_id = $_POST['employee_id'];
		$fee = $_POST['additional_fee'];
		$amount = $_POST['amount_fee'];
		$status = $_POST['status'];
		
		$sql = "UPDATE additional_fee_details SET amount = '$amount', status = '$status' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Additional Fee updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:additional_fee.php?id='.$fee);

?>