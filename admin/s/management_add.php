<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$position = $_POST['position'];
		
        $sql = "INSERT INTO management (firstname, lastname, position) VALUES ('$firstname', '$lastname', '$position')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Management added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}

	}
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: management.php');
?>