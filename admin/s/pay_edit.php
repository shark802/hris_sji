<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$amount = $_POST['amount'];
		$description = $_POST['description'];
        
		$sql = "UPDATE pay SET amount = '$amount',description = '$description' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Pay updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:pay.php');

?>