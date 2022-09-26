<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];

		$pre = substr($firstname, 0,1);

		$username = strtolower($pre.''.$lastname);
		$password = 12345;

		$hashed_password = password_hash($password, PASSWORD_DEFAULT);


        $sql = "INSERT INTO admin (username, password, firstname, lastname, created_on) VALUES ('$username', '$hashed_password', '$firstname', '$lastname', now())";
		if($conn->query($sql)){
			$_SESSION['success'] = 'User added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}

	}
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: user.php');
?>