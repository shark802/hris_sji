<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$time_in = $_POST['time_in'];
		$time_in = date('H:i:s', strtotime($time_in));
		$time_out = $_POST['time_out'];
		$time_out = date('H:i:s', strtotime($time_out));
		$grace_period = $_POST['grace_period'];
		//$workdays = $_POST['workdays'];
		//$check_workdays = '';
		//foreach($workdays as $check_items){
		//	$check_workdays .= $check_items.",";
		//}

		$sql = "INSERT INTO schedules (time_in, time_out, grace_period) 
		VALUES ('$time_in', '$time_out', '$grace_period')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Schedule added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}	
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: schedule.php');

?>