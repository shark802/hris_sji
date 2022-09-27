<?php
	include 'includes/session.php';

	if(isset($_POST['delete'])){
		$id = $_POST['id'];
		$employee_id = $_POST['employee_id'];
		
		$sql = "DELETE FROM leave_credit WHERE id = '$id'";
		$conn->query($sql);
		if($conn->query($sql)){
			$_SESSION['success'] = 'Leave credit deleted successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Select item to delete first';
	}

	header('location:http://localhost/hris_sji/admin/s/leave_credit.php?id='.$employee_id);
	
?>