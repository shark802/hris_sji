<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$range_from = $_POST['range_from'];
		$range_to = $_POST['range_to'];
		$monthly_salaryCredit = $_POST['monthly_salaryCredit'];
		$er = $_POST['er'];
		$ee = $_POST['ee'];
		$ec = $_POST['ec'];

		$se_monthlyCredit = $_POST['se_monthlyCredit'];
		$se_ssContribution = $_POST['se_ssContribution'];

		$ss_contribution = $er + $ee;
		$total_contribution = $er + $ee + $ec;
        
		$sql = "UPDATE sss_table SET range_from = '$range_from',range_to = '$range_to',
				range_from = '$range_from',range_to = '$range_to',
				monthly_salaryCredit = '$monthly_salaryCredit',er = '$er',
				ee = '$ee',ec = '$ec',
				se_monthlyCredit = '$se_monthlyCredit',se_ssContribution = '$se_ssContribution',
				ss_contribution = '$ss_contribution',total_contribution = '$total_contribution' 
				WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'SSS Table updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location: sssTable.php');

?>