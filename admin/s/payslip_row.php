<?php 
	include 'includes/session.php';

	if(isset($_POST['id'])){
		$id = $_POST['id'];
        
        // PhilHealth
        $phsql = "SELECT * FROM deductions where description = 'PhilHealth'";
        $phquery = $conn->query($phsql);
        $phrow = $phquery->fetch_assoc();
        $ph = $phrow['amount'];
                    
        //HDMF
        $hdmfsql = "SELECT * FROM deductions where description = 'HDMF'";
        $hdmfquery = $conn->query($hdmfsql);
        $hdmfrow = $hdmfquery->fetch_assoc();
        $hdmf = $hdmfrow['amount'];
  
        //Attendance
        $sql = "SELECT *, SUM(num_hr) AS total_hr, attendance.employee_id AS empid FROM attendance LEFT JOIN employees ON employees.id=attendance.employee_id LEFT JOIN position ON position.id=employees.position_id WHERE date BETWEEN '$from' AND '$to' GROUP BY attendance.employee_id ORDER BY employees.lastname ASC, employees.firstname ASC";
        $query = $conn->query($sql);
        $total = 0;
        while($row = $query->fetch_assoc()){
        $empid = $row['empid'];
                        
        //Cash Advance
        $casql = "SELECT *, SUM(amount) AS cashamount FROM cashadvance WHERE employee_id='$empid' AND date_advance BETWEEN '$from' AND '$to'";   $caquery = $conn->query($casql);
        $carow = $caquery->fetch_assoc();
        $cashadvance = $carow['cashamount'];
                       
        //Overtime
        $otsql = "SELECT * FROM overtime WHERE employee_id='$empid' AND date_overtime BETWEEN '$from' AND '$to'";                  
        $otquery = $conn->query($otsql);
        $otrow = $otquery->fetch_array();
        $rate = $otrow['rate'];    
        $hour = $otrow['hours'];
        $overtime = $rate * $hour;
                       
        //VLSL Pay
        $paysql = "SELECT *, SUM(amount) AS payamount FROM pay WHERE employee_id='$empid' AND date BETWEEN '$from' AND '$to' AND description ='Vacation Leave' OR description ='Sick Leave' ";                      
        $payquery = $conn->query($paysql);
        $payrow = $payquery->fetch_assoc();
        $pay = $payrow['payamount'];
                       
        //Differential Pay
        $paysql1 = "SELECT *, SUM(amount) AS payamount1 FROM pay WHERE employee_id='$empid' AND date BETWEEN '$from' AND '$to' AND description ='Differential Pay'";                     
        $payquery1 = $conn->query($paysql1);
        $payrow1 = $payquery1->fetch_assoc();
        $pay1 = $payrow1['payamount1'];
                        
        //SSS Loan
        $loansql1 = "SELECT * FROM loantable WHERE employee_id='$empid' AND loan_type ='SSS Loan'";                     
        $loanquery1 = $conn->query($loansql1);
        $loanrow1 = $loanquery1->fetch_assoc();
        $sssloan = $loanrow1['obligation'];
                        
        //HDMF Loan
        $loansql2 = "SELECT * FROM loantable WHERE employee_id='$empid' AND loan_type ='HDMF Loan'";                     
        $loanquery2 = $conn->query($loansql2);
        $loanrow2 = $loanquery2->fetch_assoc();
        $hdmfloan = $loanrow2['obligation'];
                        
        //Summation GrossPay
        $wage = $row['hourlyrate'] * $row['total_hr'];
        $allowance = $row['allowance'] * 15;
        $grosspay = $wage + $allowance + $pay + $overtime + $pay1;
                        
        //Tax
        if ($grosspay < 10418){
            //Bracket 1
            $tax = 0;
        } else if ($grosspay < 13334){
            //Bracket 2
            $tax_calc = $grosspay - 10418;
            $percent = (20/12)/2;
            $tax = $tax_calc * $percent;
        } else if ($grosspay < 23751){
            //Bracket 3
            $tax_calc = $grosspay - 13334;
            $percent = (25/12)/2;
            $tax = ($tax_calc * $percent) + 1250;
        } else if ($grosspay < 52917){
            //Bracket 4
            $tax_calc = $grosspay - 23751;
            $percent = (30/12)/2;
            $tax = ($tax_calc * $percent) + 5146;
        } else if ($grosspay < 127084){
            //Bracket 5
            $tax_calc = $grosspay - 52917;
            $percent = (32/12)/2;
            $tax = ($tax_calc * $percent) + 20416.67;
        }
                          
        //Summation Deduction
        $sss = $grosspay * 0.0363;
        $total_deduction = $cashadvance + $sss + $ph + $hdmf + $sssloan + $hdmfloan + $tax;
                        
        //NetPay
        $net = $grosspay - $total_deduction;

		echo json_encode($row);
	}
?>