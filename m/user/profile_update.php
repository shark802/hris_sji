<?php
	include 'includes/session.php';

	if(isset($_GET['return'])){
		$return = $_GET['return'];
		
	}
	else{
		$return = 'home.php';
	}

	if(isset($_POST['save'])){
		$username = $_POST['employee_id'];
		$password = $_POST['password'];
		$photo = $_FILES['photo']['name'];

		// encrypt password
		$password = md5($password);
		
		if(!empty($photo)){
			move_uploaded_file($_FILES['photo']['tmp_name'], '../../images/'.$photo);
			$filename = $photo;	
		}
		else{
			$filename = $user['photo'];
		}

		$sql = "UPDATE employees SET employee_id = '$username', password = '$password', photo = '$filename' WHERE id = '".$user['employee_id']."'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Profile updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up required details first';
	}

	header('location:'.$return);

?>