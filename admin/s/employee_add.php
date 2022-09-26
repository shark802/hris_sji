<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
        
		$email_address = $_POST['email_address'];
       
        $address = $_POST['address'];
		$birthdate = $_POST['birthdate'];
		$contact = $_POST['contact'];
		$gender = $_POST['gender'];
		$filename = $_FILES['photo']['name'];
		if(!empty($filename)){
			move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$filename);	
		}
        
        $employee_id = $email_address;
        $password = $birthdate;
        $hash_password = md5($password); //Format YYYY-MM-DD

		$last_id = 0;
		$check_duplicate_sql = "SELECT firstname, lastname FROM employees WHERE firstname = '$firstname' AND lastname = '$lastname'";
		$count = $conn->query($check_duplicate_sql);
		if($count->num_rows > 0){
			$_SESSION['error'] = 'Employee already exist';
		} else {
			$sql1 = "INSERT INTO employees (employee_id, password, firstname, lastname, email_address, address, birthdate, contact_info, gender, photo, created_on,account_info) VALUES ('$employee_id', '$hash_password', '$firstname', '$lastname', '$email_address', '$address', '$birthdate', '$contact', '$gender', '$filename', NOW(), 'Active')";
			if($conn->query($sql1)){
				$last_id = $conn->insert_id;

				$sql2 = "INSERT INTO employment_records (employee_id) VALUES ('$last_id')";
				$conn->query($sql2);

				$sql3 = "INSERT INTO mandatory_contribution_record (employee_id) VALUES ('$last_id')";
				$conn->query($sql3);

				$sql4 = "INSERT INTO component (employee_id) VALUES ('$last_id')";
				$conn->query($sql4);

				$_SESSION['success'] = 'Employee added successfully';
			}
			else{
				$_SESSION['error'] = $conn->error;
			}
		}

	}
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: employee.php');
?>