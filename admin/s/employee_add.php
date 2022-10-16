<?php
	use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
	include 'includes/session.php';
	require '../../vendor/autoload.php';

	if(isset($_POST['add'])){
		$firstname = $_POST['firstname'];
		$middlename = $_POST['middlename'];
		$lastname = $_POST['lastname'];

		$employeeName = $firstname.' '.$lastname;
        
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
			
			$sql1 = "INSERT INTO employees (employee_id, password, firstname, middlename, lastname, email_address, address, birthdate, contact_info, gender, photo, created_on,account_info) VALUES ('$employee_id', '$hash_password', '$firstname', '$middlename', '$lastname', '$email_address', '$address', '$birthdate', '$contact', '$gender', '$filename', NOW(), 'Active')";
			if($conn->query($sql1)){
				$last_id = $conn->insert_id;
 
				/* Enable until Production
				$mail = new PHPMailer(true);
				//$mail->SMTPDebug = 2;                                       
				$mail->isSMTP();                                            
				$mail->Host       = 'smtp.gmail.com;';                    
				$mail->SMTPAuth   = true;                             
				$mail->Username   = 'hris@sji.edu.ph';                 
				$mail->Password   = 'hrissji2022';                        
				$mail->SMTPSecure = 'tls';                              
				$mail->Port       = 25;  
	
				$mail->setFrom('hris@sji.edu.ph', 'HRIS SJI');           
				//$mail->addAddress('receiver1@gfg.com');
				$mail->addAddress($employee_id, $employeeName);
				
				$mail->isHTML(true);                                  
				$mail->Subject = 'HRIS SJI Account';
				$mail->Body    = 'Hi, <br><br>
								
								Your HRIS SJI Account has been activated successfully. You may now login your account to using this username and password: <br><br>
								
								Username: '.$employee_id.'
								<br>
								Password: '.$password.'
	
								<br><br>
								Thank you, <br>
								HRIS SJI
								';
				$mail->send();
				*/
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