<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$date_from = $_POST['date_from'];
		$date_to = $_POST['date_to'];
		$payroll_period = $_POST['payroll_period'];
        //$month = $_POST['month'];
		$status = 'Pending';
		$month = date('m');
		$monthF = date('F');

		$check_existing_record = "SELECT month, payroll_period FROM payroll WHERE month = '$month' AND payroll_period = '$payroll_period'";
		$count = $conn->query($check_existing_record);
		if($count->num_rows > 0){
			$_SESSION['error'] = 'Payroll for <b>'.$payroll_period.' period</b> of <b>'.$monthF.'</b> already exist';
		} else {
			$sql = "INSERT INTO payroll (date_from, date_to, month, payroll_period, status) 
					VALUES ('$date_from', '$date_to', '$month', '$payroll_period', '$status')";
			if($conn->query($sql)){
				$payroll_id = $conn->insert_id;

				$payrollProcess = "SELECT 
                        e.id AS eID, 
                        CONCAT(e.lastname, ', ', e.firstname) AS employeeName, 
                        p.basic_salary, p.daily_rate, SUM(a.num_hr) AS totalHrs, 
                        a.late, a.undertime, a.absent,
                        GROUP_CONCAT(DISTINCT afd.additional_fee_id) AS additional_fee_group, 
                        GROUP_CONCAT(DISTINCT af.fee) AS fee_group,
                        GROUP_CONCAT(DISTINCT lt.obligation) AS obligation_group, 
                        GROUP_CONCAT(DISTINCT l.loan_type) AS loan_group
                    FROM attendance AS a 
                        LEFT JOIN employees AS e ON e.id = a.employee_id 
                        LEFT JOIN employment_records AS er ON er.employee_id = e.id 
                        LEFT JOIN position AS p ON p.id = er.position_id 
                        LEFT JOIN additional_fee_details AS afd ON afd.employee_id = e.id 
                        LEFT JOIN additional_fee AS af ON af.id = afd.additional_fee_id 
                        LEFT JOIN loantable AS lt ON lt.employee_id = e.id
                        LEFT JOIN loan_type AS l ON l.id = lt.loan_type
                    WHERE 
                        a.date BETWEEN '$date_from' AND '$date_to' 
                        AND e.account_info = 'Active' 
                        GROUP BY a.employee_id;
                    ";
				$payroll_query = $conn->query($payrollProcess);
				while($row = $payroll_query->fetch_assoc()){
					$employee_id = $row['eID'];
					$employee_name = $row['employeeName'];
					$basic_salary = $row['basic_salary'];
					$totalHrs = $row['totalHrs'];
					$daily_rate = $row['daily_rate'];
					$arr_additional_fee = $row['additional_fee_group'];
					$arr_fee = $row['fee_group'];
					$arr_obligation_group = $row['obligation_group'];
					$arr_loan_group = $row['loan_group'];
			  
					$hourly_rate = $daily_rate / 8;
			  
					$ut = $row['undertime'];
						  $late = $row['late'];
						  $absent = $row['absent'];
			  
					$financial_aid = 0;
					$basic_salary_coverage = 0;
					$montly_total = 0;
			  
					$positionHRM = 0;
					$chiPrem = 0;
					$advisory = 0;
					$moderator = 0;
					$overload = 0;
					$sub_pay = 0;
					$adj_refund = 0;
					$ot_pay = 0;
					$laptop_loan = 0;

					// For 1st Period
					$sss_salaryLoan = 0;
					$sss_calamityLoan = 0;
					$hdmf_calamityLoan = 0;
					$hdmf_mpl = 0;

					// For 2nd Period
					$sss = 0;
					$pagibig = 0;
					$philhealth = 0;
					$wtax = 0;

					$other_ded = 0;
					$absences = 0;
					$undertimeLate = 0;
					$ca = 0;
					$total_grossPay = 0;
					$total_deduction = 0;
					$netPay = 0;
			  
					// Check for OT
					$otsql = "SELECT SUM(hours) AS hrs, rate FROM overtime WHERE employee_id='$employee_id' AND date_overtime BETWEEN '$date_from' AND '$date_to' AND status = 'Approved'";                  
					$otquery = $conn->query($otsql);
					$otrow = $otquery->fetch_array();
					$rate = isset($otrow['rate']) ? $otrow['rate'] : 0;
					$hour = isset($otrow['hrs']) ? $otrow['hrs'] : 0;
					$ot_pay = $rate * $hour;
				
					
						  $basic_salary_coverage = $basic_salary / 2;
					//$financial_aid_coverage = $financial_aid;
						  
			  
					$arr_additional_fee = explode(",", $arr_additional_fee); 
					$arr_fee = explode(",", $arr_fee);
			  
					for($i = 0; $i < count($arr_fee); $i++){
					  $get_aidLike = $arr_fee[$i];
					  $aid_sql = "SELECT aFeeId.amount FROM additional_fee AS feeID
								LEFT JOIN additional_fee_details AS aFeeId ON aFeeId.additional_fee_id = feeID.id 
								WHERE feeID.fee LIKE '$get_aidLike%' AND aFeeId.employee_id = '$employee_id'";
					  $aid_query = $conn->query($aid_sql);
					  $aidRow = $aid_query->fetch_assoc();
			  
					  // echo $aidAmt = isset($aidRow['amount']) ? $aidRow['amount'] : 0;
			  
					   if($get_aidLike == "Financial Aid"){
						$financial_aid = isset($aidRow['amount']) ? $aidRow['amount'] : 0;
					   }
			  
					   if($get_aidLike == "Position Honorarium"){
						$positionHRM = isset($aidRow['amount']) ? $aidRow['amount'] : 0;
					   }
			  
					   if($get_aidLike == "Chinese Premiums"){
						$chiPrem = isset($aidRow['amount']) ? $aidRow['amount'] : 0;
					   }
			  
					   if($get_aidLike == "Advisory Pay"){
						$advisory = isset($aidRow['amount']) ? $aidRow['amount'] : 0;
					   }
			  
					   if($get_aidLike == "Overload Pay"){
						$overload = isset($aidRow['amount']) ? $aidRow['amount'] : 0;
					   }
			  
					   if($get_aidLike == "Moderator"){
						$moderator = isset($aidRow['amount']) ? $aidRow['amount'] : 0;
					   }
			  
					   if($get_aidLike == "Substitution Pay"){
						$sub_pay = isset($aidRow['amount']) ? $aidRow['amount'] : 0;
					   }
			  
					   if($get_aidLike == "Adjustment Refund"){
						$adj_refund = isset($aidRow['amount']) ? $aidRow['amount'] : 0;
					   }
					
					// Get Loan details
					$arr_loan = explode(",", $arr_loan_group);
					for($j = 0; $j < count($arr_loan); $j++){
			  
					  $get_LoanLike = $arr_loan[$j];
					  $loan_sql = "SELECT obligation FROM loantable AS l
								LEFT JOIN loan_type AS lt ON lt.id = l.loan_type 
								WHERE lt.loan_type LIKE '$get_LoanLike%' AND l.employee_id = '$employee_id'
								AND l.status = 'Active'";
					  $loan_query = $conn->query($loan_sql);
					  $loanRow = $loan_query->fetch_assoc();
			  
					  // echo isset($loanRow['obligation']) ? $loanRow['obligation'] : 0;
			  
					   if($get_LoanLike == "Laptop Loans"){
						$laptop_loan = isset($loanRow['obligation']) ? $loanRow['obligation'] : 0;
					   }
			  
					   if($get_LoanLike == "Pag-ibig Calamity Loan"){
						$hdmf_calamityLoan = isset($loanRow['obligation']) ? $loanRow['obligation'] : 0;
					   }
			  
					   if($get_LoanLike == "SSS Calamity"){
						$sss_calamityLoan = isset($loanRow['obligation']) ? $loanRow['obligation'] : 0;
					   }
			  
					   if($get_LoanLike == "Pag-ibig MPL"){
						$hdmf_mpl = isset($loanRow['obligation']) ? $loanRow['obligation'] : 0;
					   }
			  
					   if($get_LoanLike == "School Cash Loans"){
						$ca = isset($loanRow['obligation']) ? $loanRow['obligation'] : 0;
					   }
			  
					   if($get_LoanLike == "SSS Salary Loan"){
						$sss_salaryLoan = isset($loanRow['obligation']) ? $loanRow['obligation'] : 0;
					   }
					} 

					// Get Contributions
					// SSS  Pagibig Philhealth wTax
					$baseSalary = intval($basic_salary);
					$sss_select = "SELECT * FROM sss_table WHERE $baseSalary BETWEEN range_from AND range_to";
					$sss_query = $conn->query($sss_select);
					$sssRow = $sss_query->fetch_assoc();

					$sss = $sssRow['ee'];

					// Auto select 4% as Pagbig
					//$pagibig_select = "SELECT id FROM pagibig_table WHERE $basic_salary BETWEEN range_from AND range_to;";
					//$sss_query = $conn->query($sss_select);
					//$sssRow = $sss_query->fetch_assoc();

					$pagibig = $baseSalary * 0.02;
					
					if($basic_salary <= 10000){
						$philhealth = 400;
					} else if ($basic_salary > 10000 && $basic_salary <= 80000){
						$philhealth = intval($basic_salary) * 0.02;
					} else {
						$philhealth = 3200;
					}

					$tax_select = "SELECT * FROM tax_table WHERE {$baseSalary} BETWEEN monthly_income_from AND monthly_income_to";
					$tax_query = $conn->query($tax_select);
					$taxRow = $tax_query->fetch_assoc();

					$excessPercentage = $taxRow['excess_percentage'];
					$base_tax = $taxRow['base_tax'];
					$excess_income = $taxRow['excess_income'];
					$tmp_excess = intval($basic_salary) - intval($excess_income);
					$getPercentage = intval($excessPercentage) / 100;

					$wtax = $base_tax + ($getPercentage * $tmp_excess);

					// Get Employee Dependents
					$ed_sql = "SELECT amount FROM dependent WHERE employee_id = '$employee_id' AND status = 'Active'";
					$ed_query = $conn->query($ed_sql);
					$edRow = $ed_query->fetch_assoc();
			  
					$edAmt = isset($edRow['amount']) ? $edRow['amount'] : 0;
					$othersMisc = $laptop_loan + $edAmt;
  
					//Get Absences / Lates / Undertime
					
					$alu_sql = "SELECT SUM(absent) AS absent, SUM(late) AS late, SUM(undertime) AS undertime FROM attendance WHERE employee_id = '$employee_id' AND date BETWEEN '$date_from' AND '$date_to'";
					$alu_query = $conn->query($alu_sql);
					$aluRow = $alu_query->fetch_assoc();
			  
					$alu_absent = $aluRow['absent'];
					$alu_late = $aluRow['late'];
					$alu_undertime= $aluRow['undertime'];
			  
					$totalLu = $alu_late + $alu_undertime;
			  
					//echo $alu_late.' - '.$employee_id.'Late <br>';
					//echo $alu_undertime.' - '.$employee_id.'UnderTime <br>';
			  
					if($alu_absent == 0){
					  $deductAbsent = 0;
					  $deductAid = 0;
					} else {
					  $deductAbsent = intval($alu_absent) * $daily_rate;
					  $deductAid = intval($alu_absent) * (($financial_aid / 314) * 12);
					}
			  
					if($totalLu == 0){
					  $deductLU = 0;
					} else {
					  $deductLU = $hourly_rate * ($totalLu / 60);
					}

					if($payroll_period == '1st'){
						$deduction1 = $sss_salaryLoan;
						$deduction2 = $sss_calamityLoan;
						$deduction3 = $hdmf_calamityLoan;
						$deduction4 = $hdmf_mpl;

						$sss = 0;
						$pagibig = 0;
						$philhealth = 0;
						$wtax = 0;
					} else {
						$deduction1 = $sss;
						$deduction2 = $pagibig;
						$deduction3 = $philhealth;
						$deduction4 = $wtax;

						$sss_salaryLoan = 0;
						$sss_calamityLoan = 0;
						$hdmf_calamityLoan = 0;
						$hdmf_mpl = 0;
					}
			  
					// SUM Gross Pay
					$total_grossPay = $basic_salary_coverage + $financial_aid + $positionHRM + 
									  $chiPrem + $advisory + $moderator + $overload + $sub_pay + $adj_refund + $ot_pay;
			  
					
					$total_deduction = $deduction1 + $deduction2 + $deduction3 + $deduction4 + $deductAbsent + $deductLU + $ca;
			  
					$netPay = $total_grossPay - $total_deduction;
					}
					/*
					$aid_sql = "SELECT * FROM additional_fee AS feeID
								LEFT JOIN additional_fee_details AS aFeeId ON aFeeId.additional_fee_id = feeID.id 
								WHERE feeID.fee LIKE 'Financial%' AND aFeeId.employee_id = '$employee_id'";
					$aid_query = $conn->query($aid_sql);
					$aidRow = $aid_query->fetch_assoc();
			  
					$financial_aid = isset($aidRow['amount']) ? $aidRow['amount'] : 0;
					*/
					$monthly_total = intval($basic_salary) + intval($financial_aid);

					$insertPayroll = "INSERT INTO payroll_details (payroll_id, 
														employee_id, 
														employee_name, 
														monthly_basic, 
														monthly_aid,
														monthly_total, 
														payroll_basic,
														payroll_others, 
														position_honorarium,
														chinese_prems, 
														advisory, 
														moderator,
														overload, 
														sub_pay, 
														adj_refund,
														overtime_pay,
														sss,
														hdmf,
														philhealth,
														wtax,
														sss_salaryLoan, 
														sss_calamityLoan, 
														hdmf_calamityLoan,
														hdmf_mpl, 
														other_deductions, 
														absences_total,
														deduction_aid,
														undertime_late, 
														ca, 
														total_gross_pay,
														total_deduction,
														net_pay) 
												VALUES ('$payroll_id', 
														'$employee_id', 
														'$employee_name', 
														'$basic_salary', 
														'$financial_aid', 
														'$monthly_total', 													
														'$basic_salary_coverage',
														'$financial_aid', 	
														'$positionHRM', 
														'$chiPrem', 
														'$advisory', 
														'$moderator', 
														'$overload', 
														'$sub_pay', 
														'$adj_refund', 
														'$ot_pay', 
														'$sss', 
														'$pagibig', 
														'$philhealth', 
														'$wtax', 
														'$sss_salaryLoan', 
														'$sss_calamityLoan', 
														'$hdmf_calamityLoan', 
														'$hdmf_mpl', 
														'$othersMisc', 
														'$deductAbsent',
														'$deductAid', 
														'$deductLU', 
														'$ca',
														'$total_grossPay',
														'$total_deduction', 
														'$netPay'
														 )";
					if($conn->query($insertPayroll)){
						$_SESSION['success'] = 'Payroll Successfully Process';
					} else {
						$_SESSION['error'] = $conn->error;
					}
					

				}
			}
			
		}

	}
	else{
		$_SESSION['error'] = 'Fill up first';
	}

	header('location: payroll_list.php');
?>