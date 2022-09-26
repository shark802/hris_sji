<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$deduction = $_POST['deduction'];
		$scheme = $_POST['scheme'];
		$amount = $_POST['amount'];

		$sql = "UPDATE benefits_contributions SET deduction = '$deduction', scheme = '$scheme', amount = '$amount' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Benefit updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:benefits.php');

?>