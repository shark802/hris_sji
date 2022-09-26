<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$position = $_POST['position'];
		
        
		$sql = "UPDATE management SET firstname = '$firstname', lastname = '$lastname', position = '$position' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Management updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}

	}
	else{
		$_SESSION['error'] = 'Select employee to edit first';
	}

	header('location: management.php');
?>