<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		
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

		$sql = "INSERT INTO sss_table (range_from, range_to, monthly_salaryCredit, 
				er, ee, ec, se_monthlyCredit, se_ssContribution, ss_contribution, total_contribution) 
				VALUES ('$range_from', '$range_to', '$monthly_salaryCredit', 
					'$er', '$ee', '$ec', '$se_monthlyCredit', '$se_ssContribution', '$ss_contribution', '$total_contribution')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'SSS Table added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}	
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}
	
	
	

	# Auto Populate
	/*
		$range_from = 2250;
		$range_to = 2749.99;
		$monthly_salaryCredit = 2500;
		$er = 200;
		$ee = 100;
		$ec = 10;

		$se_monthlyCredit = 2500;
		$se_ssContribution = 300;

		
		for($i = 0; $i < 50; $i++){
			if($monthly_salaryCredit >= 15000){
				$ec = 30;
			}

			$ss_contribution = $er + $ee;
			$total_contribution = $er + $ee + $ec;

			$sql = "INSERT INTO sss_table (range_from, range_to, monthly_salaryCredit, 
					er, ee, ec, se_monthlyCredit, se_ssContribution, ss_contribution, total_contribution) 
					VALUES ('$range_from', '$range_to', '$monthly_salaryCredit', 
						'$er', '$ee', '$ec', '$se_monthlyCredit', '$se_ssContribution', '$ss_contribution', '$total_contribution')";
			$conn->query($sql);
			$range_from += 500;
			$range_to += 500;
			$monthly_salaryCredit += 500;
			$er += 40;
			$ee += 20;

			$se_monthlyCredit += 500;
			$se_ssContribution += 60;
	
		} 
	}
	*/

	header('location: sssTable.php');

?>