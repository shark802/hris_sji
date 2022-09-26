<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$title = $_POST['description'];
		$basic_salary = $_POST['basic_salary'];

		// Compute Daily Rate
		$daily_rate = ($basic_salary / 314) * 12;

		$sql = "UPDATE position SET description = '$title', basic_salary = '$basic_salary', daily_rate = '$daily_rate' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Position updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:position.php');

?>