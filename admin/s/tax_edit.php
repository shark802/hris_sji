<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$annual_income_from = $_POST['annual_income_from'];
		$annual_income_to = $_POST['annual_income_to'];
		$monthly_income_from = $_POST['monthly_income_from'];
		$monthly_income_to = $_POST['monthly_income_to'];
		$excess_percentage = $_POST['excess_percentage'];
		$base_tax = $_POST['base_tax'];
		$excess_income = $_POST['excess_income'];

		$sql = "UPDATE tax_table SET annual_income_from = '$annual_income_from', annual_income_to = '$annual_income_to',
					monthly_income_from = '$monthly_income_from', monthly_income_to = '$monthly_income_to',
					excess_percentage = '$excess_percentage', base_tax = '$base_tax',
					excess_income = '$excess_income'
				 WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Tax updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:tax.php');

?>