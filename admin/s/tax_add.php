<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$annual_income_from = $_POST['annual_income_from'];
		$annual_income_to = $_POST['annual_income_to'];
		$monthly_income_from = $_POST['monthly_income_from'];
		$monthly_income_to = $_POST['monthly_income_to'];
		$base_tax = $_POST['base_tax'];
		$excess_percentage = $_POST['excess_percentage'];
		$excess_income = $_POST['excess_income'];
		
		$sql = "INSERT INTO tax_table (annual_income_from, annual_income_to, monthly_income_from, 
				monthly_income_to, base_tax, excess_percentage, excess_income) 
				VALUES ('$annual_income_from', '$annual_income_to', '$monthly_income_from', 
					'$monthly_income_to', '$base_tax', '$excess_percentage', '$excess_income')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Tax Table added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}	
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: tax.php');

?>