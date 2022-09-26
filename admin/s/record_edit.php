<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$mandatory_id = $_POST['mandatory_id'];
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

		$basic_salary = 0;

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
					$insert = "INSERT INTO leave_credit (employee_id, leave_type, used_leave, unused_leave) 
								VALUES ('$employee_id', '$leave_type', 0, '$monthly_accumulation')";
					$conn->query($insert);
				}
			} 
		} 

		$sql0 = "UPDATE mandatory_contribution_record SET employee_id = '$employee_id', ss = '$ss_num', pagibig = '$hdmf_num', philhealth = '$ph_num', tin = '$tin_num' WHERE employee_id = '$employee_id'";
		$conn->query($sql0);

		$sql1 = "UPDATE employment_records SET employee_id = '$employee_id', start_date = '$start_date',
				status = '$status', department_id = '$department_id', position_id = '$position_id', schedule_id = '$schedule_id'
				WHERE id = '$id'";
		if($conn->query($sql1)){
			$get_position_detail = "SELECT * from position WHERE id = '$position_id'";
			$pos_query = $conn->query($get_position_detail);
				
				while($row = $pos_query->fetch_assoc()){
					$basic_salary = $row['basic_salary'];
				}

			$sql2 = "UPDATE component SET basic_pay = '$basic_salary' WHERE employee_id = '$employee_id'";
			$conn->query($sql2);

			$_SESSION['success'] = 'Employment record updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:record.php');

?>