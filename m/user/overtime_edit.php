<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$employee_id = $_POST['employee_id'];
		$date_overtime = $_POST['date_overtime'];
		$hours = $_POST['hours'];
		$rate = 100;
		$status = 'Pending';

		$check_record_exist = "SELECT employee_id, status FROM overtime WHERE employee_id = '$employee_id' AND
		date_overtime = '$date_overtime'";
		$count = $conn->query($check_record_exist);

		if($count->num_rows > 0){
			$_SESSION['error'] = 'Leave application already exist';
		} else {
			
			$sql = "UPDATE overtime SET date_overtime = '$date_overtime', hours = '$hours' WHERE id = '$id'";
			if($conn->query($sql)){
				$_SESSION['success'] = 'Overtime application updated successfully';
			}
			else{
				$_SESSION['error'] = $conn->error;
			}
			
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location: overtime.php');

?>