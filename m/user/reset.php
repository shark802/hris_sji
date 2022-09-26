<?php
	session_start();
	include 'includes/conn.php';

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	require 'path/to/PHPMailer/src/Exception.php';
	require 'path/to/PHPMailer/src/PHPMailer.php';
	require 'path/to/PHPMailer/src/SMTP.php';

	if(isset($_POST['password_reset'])){
		$email = $_POST['email_address'];
		
		$sql = "SELECT email_address FROM employees WHERE email_address = '$email'";
		$query = $conn->query($sql);

		if($query->num_rows > 0){
			$_SESSION['success'] = '<b>Password Reset email already sent to your email. Please check your inbox.</b>';
		}
		else{
			$_SESSION['error'] = 'Email does not exist';
		}
		
	}
	else{
		$_SESSION['error'] = 'Input user credentials first';
	}

	header('location: forgot_password.php');

?>