<?php
	include 'includes/session.php';

	if(isset($_POST['delete'])){
		$id = $_POST['id'];
		$fee = $_POST['additional_fee'];

		$sql = "DELETE FROM additional_fee_details WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Additional Fee deleted successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Select item to delete first';
	}

	header('location:additional_fee.php?id='.$fee);
	
?>