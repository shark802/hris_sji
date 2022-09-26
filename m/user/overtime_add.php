<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$employee_id = $_POST['employee_id'];
		$date_overtime = $_POST['date_overtime'];
		$hours = $_POST['hours'];
		$rate = 100;
		$status = 'Pending';


		$check_record_exist = "SELECT employee_id FROM overtime WHERE employee_id = '$employee_id' AND
								date_overtime = '$date_overtime'";
		$count = $conn->query($check_record_exist);
		
		if($count->num_rows > 0){
			$_SESSION['error'] = 'Overtime application already exist';
		} else {	
			$sql = "INSERT INTO overtime (employee_id, date_overtime, hours, rate, status) 
				VALUES ('$employee_id', '$date_overtime', '$hours', '$rate', '$status')";
			if($conn->query($sql)){

				$_SESSION['success'] = 'Overtime applicatio successfully';
			}
			else{
				$_SESSION['error'] = $conn->error;
			}
			
		}	
	} else{
		$_SESSION['error'] = 'Fill up add form first';
		
	}
	header('location: overtime.php');
	
?>