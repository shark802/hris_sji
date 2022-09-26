<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$empid = $_POST['id'];
		$employee_id = $_POST['employee_id'];
		$password = $_POST['password'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$email_address = $_POST['email_address'];
		$address = $_POST['address'];
		$birthdate = $_POST['birthdate'];
		$contact = $_POST['contact_info'];
		$gender = $_POST['gender'];
		$status = $_POST['account_info'];
        
		$sql = "UPDATE employees SET firstname = '$firstname', lastname = '$lastname', email_address = '$email_address', address = '$address', birthdate = '$birthdate', contact_info = '$contact', gender = '$gender', account_info = '$status' WHERE id = '$empid'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Employee updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}

	}
	else{
		$_SESSION['error'] = 'Select employee to edit first';
	}

	header('location: employee.php');
?>