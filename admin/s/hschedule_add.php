<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$holiday_type = $_POST['holiday_type'];
        $description = $_POST['description'];
        $date = $_POST['date'];


		$sql = "INSERT INTO holidayschedules (holiday_type, description, date) VALUES ('$holiday_type', '$description', '$date')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Holiday Schedule added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}	
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: hschedule.php');

?>