<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$employee = $_POST['employee_id'];
        $description = $_POST['description'];
		$amount = $_POST['amount'];
		
		$sql = "SELECT * FROM employees WHERE id = '$employee'";
		$query = $conn->query($sql);
		if($query->num_rows < 1){
			$_SESSION['error'] = 'Employee not found';
		}
		else{
			$row = $query->fetch_assoc();
			$employee_id = $row['id'];
			$sql = "INSERT INTO pay (employee_id, date, description, amount) VALUES ('$employee_id', NOW(), '$description', '$amount')";
			if($conn->query($sql)){
				$_SESSION['success'] = 'Pay added successfully';
			}
			else{
				$_SESSION['error'] = $conn->error;
			}
		}
	}	
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: pay.php');

?>