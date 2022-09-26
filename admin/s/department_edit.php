<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$department = $_POST['department'];
		$abbreviation = $_POST['abbreviation'];

		$sql = "UPDATE departments SET departments = '$department', abbreviation = '$abbreviation' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Department updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:department.php');

?>