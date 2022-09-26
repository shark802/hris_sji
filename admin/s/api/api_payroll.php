<?php 

    include '../includes/conn.php';

    echo '
    <style>
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
        max-width:100%;
        white-space:nowrap;
      }
    </style>
    <table>
    <tr>
      <th rowspan="3" style="text-align: center; vertical-align: middle;" width="30%">Employee Name</th>
      <th colspan="3" style="text-align: center; vertical-align: middle;">Monthly</th>
      <th colspan="4" style="text-align: center; vertical-align: middle;">Payroll</th>
      <th rowspan="3" style="text-align: center; vertical-align: middle;">Position/<br>Honorarium<br>(DH/SC)</th>
      <th rowspan="3" style="text-align: center; vertical-align: middle;">Chinese Premiums</th>
      <th rowspan="3" style="text-align: center; vertical-align: middle;">Advisory</th>
      <th rowspan="3" style="text-align: center; vertical-align: middle;">Moderator</th>
      <th rowspan="3" style="text-align: center; vertical-align: middle;">Overload</th>
      <th rowspan="3" style="text-align: center; vertical-align: middle;">Substitute Pay</th>
      <th rowspan="3" style="text-align: center; vertical-align: middle;">Adjustment Refund</th>
      <th rowspan="3" style="text-align: center; vertical-align: middle;">Overtime Pay</th>
      <th colspan="9" style="text-align: center; vertical-align: middle; color: red;">DEDUCTIONS</th>
      <th rowspan="3" style="text-align: center; vertical-align: middle;">Total Gross&nbsp;Pay</th>
      <th rowspan="3" style="text-align: center; vertical-align: middle;">Total Deduction</th>
      <th rowspan="3" style="text-align: center; vertical-align: middle;">Netpay</th>
    </tr>
    <tr>       

      <th rowspan="2" style="text-align: center; vertical-align: middle;">Basic Salary</th>
      <th rowspan="2" style="text-align: center; vertical-align: middle;">Financial Aid</th>
      <th rowspan="2" style="text-align: center; vertical-align: middle;">Total</th>
      <th rowspan="2" style="text-align: center; vertical-align: middle;">Basic Salary</th>
      <th rowspan="2" colspan="3" style="text-align: center; vertical-align: middle;">Financial&nbsp;&nbsp;Aid&nbsp;&nbsp;& <br>Masters&nbsp;&nbsp;Degree</th>
 

        <th rowspan="2" style="text-align: center; vertical-align: middle;" >SSS <br> Salary Loan</th>
        <th rowspan="2" style="text-align: center; vertical-align: middle;">SSS <br>Calamity Loan</th>
        <th rowspan="2" style="text-align: center; vertical-align: middle;">Pagibig <br>Calamity Loan</th>
        <th rowspan="2" style="text-align: center; vertical-align: middle;">Pagibig <br>MPL</th>
      
        <!--
        <th style="text-align: center; vertical-align: middle;">SSS Premium</th>
        <th style="text-align: center; vertical-align: middle;">Philhealth Premium</th>
        <th style="text-align: center; vertical-align: middle;">Pagibig Premium</th>
        <th style="text-align: center; vertical-align: middle;">W/holding Tax</th>
        !-->
    
        <th rowspan="2" style="text-align: center; vertical-align: middle;">Misc&nbsp;&nbsp; & <br>&nbsp;Other Fees <br>(Employees Dependents)</th>
        <th colspan="2" style="text-align: center; vertical-align: middle;">Absences</th>
        <th rowspan="2" style="text-align: center; vertical-align: middle">Undertime <br>/ Late</th>
        <th rowspan="2" style="text-align: center; vertical-align: middle">Decution <br>C/A</th>
    </tr>
    <tr>
          <th>Basic</th>
          <th>Financial Aid</th>
    </tr>
    <tbody>'
    ;

    $fetch_payroll = "SELECT 
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
                        a.date BETWEEN '2022-08-01' AND '2022-08-15' 
                        AND e.account_info = 'Active' 
                        GROUP BY a.employee_id;
                    ";
    $payroll_query = $conn->query($fetch_payroll);
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
      
      $sss_salaryLoan = 0;
      $sss_calamityLoan = 0;
      $hdmf_calamityLoan = 0;
      $hdmf_mpl = 0;

      $sss = 0;
      $pagibig = 0;
      $ph = 0;
      $wtax = 0;

      $other_ded = 0;
      $absences = 0;
      $undertimeLate = 0;
      $ca = 0;
      $total_grossPay = 0;
      $total_deduction = 0;
      $netPay = 0;

      
      // Check for OT
      $otsql = "SELECT SUM(hours) AS hrs, rate FROM overtime WHERE employee_id='$employee_id' AND date_overtime BETWEEN '2022-08-01' AND '2022-08-15' AND status = 'Approved'";                  
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

      $ed_sql = "SELECT amount FROM dependent WHERE employee_id = '$employee_id' AND status = 'Active'";
      $ed_query = $conn->query($ed_sql);
      $edRow = $ed_query->fetch_assoc();

      $edAmt = isset($edRow['amount']) ? $edRow['amount'] : 0;
      $othersMisc = $laptop_loan + $edAmt;


      //Get Absences / Lates / Undertime
      
      $alu_sql = "SELECT SUM(absent) AS absent, SUM(late) AS late, SUM(undertime) AS undertime FROM attendance WHERE employee_id = '$employee_id' AND date BETWEEN '2022-08-01' AND '2022-08-15'";
      $alu_query = $conn->query($alu_sql);
      $aluRow = $alu_query->fetch_assoc();

      $alu_absent = $aluRow['absent'];
      $alu_late = $aluRow['late'];
      $alu_undertime= $aluRow['undertime'];

      $totalLu = $alu_late + $alu_undertime;

      $contributions = array('SSS', 'Pagibig', 'PhilHealth');

			for($i = 0; $i < count($contributions); $i++){
        $tempRef = $contributions[$i];
        $bcSql = "SELECT deduction, amount FROM benefits_contributions WHERE deduction='$tempRef'";                  
        $bcquery = $conn->query($bcSql);
        $bcrow = $bcquery->fetch_array();

        if($bcrow['deduction'] == 'SSS'){
          $sss = $bcrow['amount'];
        }

        if($bcrow['deduction'] == 'Pagibig'){
          $pagibig = $bcrow['amount'];
        }

        if($bcrow['deduction'] == 'PhilHealth'){
          $ph = $bcrow['amount'];
        }
      }

     
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

      // SUM Gross Pay
      $total_grossPay = $basic_salary_coverage + $financial_aid + $positionHRM + 
                        $chiPrem + $advisory + $moderator + $overload + $sub_pay + $adj_refund + $ot_pay;

      
      $total_deduction = $sss_salaryLoan + $sss_calamityLoan + $hdmf_calamityLoan + $hdmf_mpl + $ot_pay
                          + $deductAbsent + $deductLU + $ca;

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
      $montly_total = intval($basic_salary) + intval($financial_aid);
      
    echo '
        <tr>
            <td>&nbsp;'.$employee_name.'&nbsp;</td>
            <td>&nbsp;'.number_format($basic_salary, 2).'&nbsp;</td>
            <td>&nbsp;'.number_format($financial_aid, 2).'&nbsp;</td>
            <td>&nbsp;'.number_format($montly_total, 2).'&nbsp;</td>
       
            <td>&nbsp;'.number_format($basic_salary_coverage, 2).'&nbsp;</td>
            <td colspan="3">&nbsp;'.number_format($financial_aid, 2).'&nbsp;</td>

            <td>&nbsp;'.number_format($positionHRM, 2).'&nbsp;</td>
            <td>&nbsp;'.number_format($chiPrem, 2).'&nbsp;</td>
            <td>&nbsp;'.number_format($advisory, 2).'&nbsp;</td>
            <td>&nbsp;'.number_format($moderator, 2).'&nbsp;</td>
            <td>&nbsp;'.number_format($overload, 2).'&nbsp;</td>
            <td>&nbsp;'.number_format($sub_pay, 2).'&nbsp;</td>
            <td>&nbsp;'.number_format($adj_refund, 2).'&nbsp;</td>
            <td>&nbsp;'.number_format($ot_pay, 2).'&nbsp;</td>

            <td>&nbsp;'.number_format($sss_salaryLoan, 2).'&nbsp;</td>
            <td>&nbsp;'.number_format($sss_calamityLoan, 2).'&nbsp;</td>
            <td>&nbsp;'.number_format($hdmf_calamityLoan, 2).'&nbsp;</td>
            <td>&nbsp;'.number_format($hdmf_mpl, 2).'&nbsp;</td>
            <td>&nbsp;'.number_format($othersMisc, 2).'&nbsp;</td>

            <td>&nbsp;'.number_format($deductAbsent, 2).'&nbsp;</td>
            <td>&nbsp;'.number_format($deductAid, 2).'&nbsp;</td>
            <td>&nbsp;'.number_format($deductLU, 2).'&nbsp;</td>
            <td>&nbsp;'.number_format($ca, 2).'&nbsp;</td>

            <td>&nbsp;'.number_format($total_grossPay, 2).'&nbsp;</td>
            <td>&nbsp;'.number_format($total_deduction, 2).'&nbsp;</td>
            <td>&nbsp;'.number_format($netPay, 2).'&nbsp;</td>

           
        </tr> ';
    }
    echo '   
    </tbody>
    </table>';
?>