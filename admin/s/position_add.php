<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$title = $_POST['description'];
		$basic_salary = $_POST['basic_salary'];

		// Compute Daily Rate
		$daily_rate = ($basic_salary / 314) * 12;
        
        $sql = "INSERT INTO position (description, basic_salary, daily_rate) VALUES ('$title', '$basic_salary', '$daily_rate')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Position added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}	
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: position.php');

?>