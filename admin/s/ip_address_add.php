<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$ip_address = $_POST['ip_address'];
		$status = $_POST['status'];
		
		$sql = "INSERT INTO ip_address (ip_address, status) 
				VALUES ('$ip_address', '$status')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'IP Address added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}	
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: ip_address.php');

?>