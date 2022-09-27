<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$employee_id = $_POST['employee_id'];
		$used_leave = $_POST['used_leave'];
		$unused_leave = $_POST['unused_leave'];

		$sql = "UPDATE leave_credit SET used_leave = '$used_leave', unused_leave = '$unused_leave' WHERE id = '$id'";
		$conn->query($sql);

		if($conn->query($sql)){
			$_SESSION['success'] = 'Leave credits updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:http://localhost/hris_sji/admin/s/leave_credit.php?id='.$employee_id);

?>