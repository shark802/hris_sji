<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$company_name = $_POST['company_name'];
		$abbreviations = $_POST['abbreviations'];
		$address = $_POST['address'];
		
		$sql = "INSERT INTO company (company_name, abbreviations, address) 
				VALUES ('$company_name', '$abbreviations', '$address')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Company added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}	
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: company.php');

?>