<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$employee_id = $_POST['employee_id'];
		$fee = $_POST['additional_fee'];
		$amount = $_POST['amount_fee'];
		$status = $_POST['status'];

		$chk_sql = "SELECT employee_id FROM additional_fee_details WHERE employee_id = '$employee_id' AND additional_fee_id = '$fee'";
		$chk_query = $conn->query($chk_sql);
		$count_query = $chk_query->num_rows;

		if($count_query > 0){
			$_SESSION['error'] = 'Fee already added';
		} else {
			$sql = "INSERT INTO additional_fee_details (employee_id, additional_fee_id, amount, status) 
				VALUES ('$employee_id', '$fee', '$amount', '$status')";
			if($conn->query($sql)){
				$_SESSION['success'] = 'Additional fee added successfully';
			}
			else{
				$_SESSION['error'] = $conn->error;
			}
		}

		
	}	
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: additional_fee.php?id='.$fee);

?>