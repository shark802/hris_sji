<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$ip_address = $_POST['ip_address'];
		$status = $_POST['status'];

		$sql = "UPDATE ip_address SET ip_address = '$ip_address', status = '$status' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'IP Address updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	} else if(isset($_POST['restrictUpdate'])){
		$status = $_POST['status'];

		if($status == 1){
			$status = 0;
		} else {
			$status = 1;
		}
		
		$sql = "UPDATE ip_restrict SET status = '$status'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'IP Restriction updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:ip_address.php');

?>