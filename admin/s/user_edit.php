<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$username = $_POST['username'];
		
        
		$sql = "UPDATE admin SET firstname = '$firstname', lastname = '$lastname', username = '$username' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'User updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}

	} else if(isset($_POST['reset'])){
		$id = $_POST['id'];
		$password = 12345;
		$hashed_password = password_hash($password, PASSWORD_DEFAULT);
		
		$sql = "UPDATE admin SET password = '$hashed_password' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'User password successfully reset';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}

	}
	else{
		$_SESSION['error'] = 'Select user';
	}

	header('location: user.php');
?>