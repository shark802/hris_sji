<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$range_from = $_POST['range_from'];
		$range_to = $_POST['range_to'];
		$employerShare = $_POST['employerShare'];
		$employeeShare = $_POST['employeeShare'];
	
		$totalMonthly = $employerShare + $employeeShare;

		$sql = "INSERT INTO ph_table (range_from, range_to, employerShare, 
				employeeShare, totalMonthlyPremium) 
				VALUES ('$range_from', '$range_to', '$employerShare', 
					'$employeeShare', '$totalMonthly')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'PhilHealth Table added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}	
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: phTable.php');

?>