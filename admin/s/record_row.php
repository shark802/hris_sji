<?php 
	include 'includes/session.php';

	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$sql = "SELECT er.id, er.employee_id, er.mandatory_government, er.start_date, er.status,d.level, er.department_id, er.position_id,
				er.schedule_id, m.id AS mandatory_id, m.ss, m.pagibig, m.philhealth, m.tin FROM employment_records AS er
				LEFT JOIN mandatory_contribution_record AS m ON er.employee_id = m.employee_id 
				LEFT JOIN departments AS d ON d.id = er.department_id
				WHERE er.employee_id = '$id'";
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();
		echo json_encode($row);
	}
?>