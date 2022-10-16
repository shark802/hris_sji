<?php
	include 'includes/session.php';

	if(isset($_POST['delete'])){
		$id = $_POST['id'];
	    $approval = $user['description'];

		if($approval == 'Principal'){
			$sql = "UPDATE applied_leave SET principal_approval = '0' WHERE id = '$id'";
		} else if($approval == 'HR Manager'){
			$sql = "UPDATE applied_leave SET hr_approval = '0' WHERE id = '$id'";
		} else {
			$sql = "UPDATE applied_leave SET supervisor_approval = '0' WHERE id = '$id'";
		} 
 
		if($conn->query($sql)){
			$_SESSION['error'] = 'Application leave deny';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	} 
	

	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:leave_request.php');

?>