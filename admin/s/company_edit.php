<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$company_name = $_POST['company_name'];
		$abbreviations = $_POST['abbreviations'];
		$address = $_POST['address'];

		$sql = "UPDATE company SET company_name = '$company_name', abbreviations = '$abbreviations', address = '$address' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Company updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:company.php');

?>