<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$holiday_type = $_POST['holiday_type'];
        $description = $_POST['description'];
        $date = $_POST['date'];
		
		$sql = "UPDATE holidayschedules SET holiday_type = '$holiday_type', description = '$description', date = '$date' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Holiday Schedule updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:hschedule.php');

?>