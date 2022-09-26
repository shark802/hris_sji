<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$department = $_POST['department'];
		$abbreviation = $_POST['abbreviation'];
		
		$sql = "INSERT INTO departments (departments, abbreviation) 
				VALUES ('$department', '$abbreviation')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Department added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}	
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: department.php');

?>