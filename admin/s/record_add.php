<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$employee_id = $_POST['employee_id'];
		$ss_num = $_POST['ss_num'];
		$ph_num = $_POST['ph_num'];
		$hdmf_num = $_POST['hdmf_num'];
		$tin_num = $_POST['tin_num'];
		$start_date = $_POST['start_date'];
		$department_id = $_POST['department_id'];
		$position_id = $_POST['position_id'];
		$schedule_id = $_POST['schedule_id'];
		$status = $_POST['status'];
		$last_id = 0;

		$check_duplicate_sql = "SELECT employee_id FROM mandatory_contribution_record WHERE employee_id = '$employee_id'";
		$count = $conn->query($check_duplicate_sql);
		if($count->num_rows > 0){
			$_SESSION['error'] = 'Employee record already exist';
		} else {

			$check_update_status = "SELECT status from employment_records WHERE status = '$status' AND employee_id = '$employee_id'";
			$check_query = $conn->query($check_update_status);
			$count = $check_query->num_rows;

			if($count == 0){
			
				$check_leave_record = "SELECT employee_id from leave_credit WHERE employee_id = '$employee_id'";
				$check_leave_query = $conn->query($check_leave_record);
				$checkItem = $check_leave_query->num_rows;
				
				// if no employee id exist
				// insert leave credits record
				if($checkItem = 1){		
					//check all leave types available
					$check_leave_types = "SELECT * from leave_types WHERE employment_status = '$status'";
					$leave_type_query = $conn->query($check_leave_types);
					
					while($row = $leave_type_query->fetch_assoc()){
						//add new record
						$leave_type = strval($row['leave_type']);
						$monthly_accumulation = strval($row['monthly_accumulation']);
	
						echo $leave_type;
						echo $monthly_accumulation;
	
						$insert = "INSERT INTO leave_credit (employee_id, leave_type, used_leave, unused_leave) 
									VALUES ('$employee_id', '$leave_type', 0, '$monthly_accumulation')";
						$conn->query($insert);
					}
				} 
			} 
			
			$sql0 = "INSERT INTO mandatory_contribution_record (employee_id, ss, pagibig, philhealth, tin) 
			VALUES ('$employee_id', '$ss_num', '$hdmf_num', '$ph_num', '$tin_num')";
			if($conn->query($sql0) === TRUE){
				$last_id = $conn->insert_id;
			}
			$sql1 = "INSERT INTO employment_records (employee_id, mandatory_government, start_date, status, department_id, position_id, schedule_id) 
				VALUES ('$employee_id', '$last_id', '$start_date',  '$status', '$department_id', '$position_id', '$schedule_id')";
			if($conn->query($sql1)){
				$_SESSION['success'] = 'Employee record added successfully';
			}
			else{
				$_SESSION['error'] = $conn->error;
			} 	
		} 
	}
	header('location: record.php');
?>