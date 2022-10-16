<?php
	session_start();
	include 'includes/conn.php';

	if(isset($_POST['login'])){
		$username = $_POST['employee_id'];
		$password = $_POST['password'];

		$hash_password = md5($password);

		$sql = "SELECT * FROM employees WHERE employee_id = '$username' AND password = '$hash_password'";
		$query = $conn->query($sql);

		if($query->num_rows < 1){
			$_SESSION['error'] = 'Incorrect Username or Password';
		}
		else{
			$row = $query->fetch_assoc();
			if($row['password']){
				$_SESSION['employee'] = $row['id'];
               
			}
			else{
				$_SESSION['error'] = 'Incorrect password';
			}
		}
		
	}
	else{
		$_SESSION['error'] = 'Input user credentials first';
	}

	header('location: index.php');

?>