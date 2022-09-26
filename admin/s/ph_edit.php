<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$range_from = $_POST['range_from'];
		$range_to = $_POST['range_to'];
		$employerShare = $_POST['employerShare'];
		$employeeShare = $_POST['employeeShare'];
	
		$totalMonthly = $employerShare + $employeeShare;
        
		$sql = "UPDATE ph_table SET range_from = '$range_from',range_to = '$range_to',
				employerShare = '$employerShare',employeeShare = '$employeeShare',
				totalMonthlyPremium = '$totalMonthly'
				WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'PhilHealth Table updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location: phTable.php');

?>