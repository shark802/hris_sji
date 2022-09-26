<?php
	include 'includes/session.php';
	include 'session.php';

	if(isset($_POST['add'])){

		$date_now = date('Y-m-d');
		$sql = "SELECT id from employees WHERE account_info = 'Active'";
		$query = $conn->query($sql);
		while($row = $query->fetch_assoc()){
			$employee_id = $row['id'];

			$dateSql = "SELECT id, employee_id, date FROM attendance WHERE employee_id = '$employee_id' AND date = '$date_now'";
			$dateQuery = $conn->query($dateSql);
			$dateCount = $dateQuery->num_rows;
			$dateRow = $dateQuery->fetch_assoc();

			$selectLeave = "SELECT employee_id FROM applied_leave WHERE employee_id = '$employee_id' AND (status = 'Approved' OR status = 'Pending') AND payroll = 0";
			$leaveQry = $conn->query($selectLeave);
			$leaveAppCount = $leaveQry->num_rows;
			$leaveRow = $leaveQry->fetch_assoc();
			//$date_from = $leaveRow['date_from'];
			//$date_to = $leaveRow['date_to'];

			//$checkDateRange = "SELECT employee_id FROM applied_leave WHERE employee_id = '$employee_id' AND '$date_now' BETWEEN '$date_from' AND '$date_to'";
			//$dRQuery = $conn->query($checkDateRange);
			//$drCount = $dRQuery->num_rows;
			//$leaveRow = $leaveQry->fetch_assoc();
			
			if($dateCount == 0 && $leaveAppCount == 0){
				$sql = "INSERT INTO attendance (date, employee_id, absent) 
				VALUES ('$date_now', '$employee_id', 1)";
				$conn->query($sql);
			} 
			if($leaveAppCount == 1){
				$sql = "INSERT INTO attendance (date, employee_id, absent) 
				VALUES ('$date_now', '$employee_id', 2)";
				$conn->query($sql);
			} 
		}
	}	
	
	header('location: btn.php');

?>