<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$amount = $_POST['loan_amount'];
        $obligation = $_POST['obligation'];
        $balance = $_POST['balance'];
        
        $new_balance = $balance - $obligation;
        
        if($new_balance < 1){
            $status = 'Paid';
            $new_balance = 0;
        } else {
            $status = 'Unpaid';
        }
    
        $sql = "UPDATE loantable SET loan_amount = '$amount', obligation = '$obligation', balance = '$new_balance', loan_status= '$status' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Loan Deduct successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:ssscalc.php');

?>