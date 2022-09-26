<?php
	include 'includes/session.php';
	
	$range = $_POST['date_range'];
	$ex = explode(' - ', $range);
	$from = date('Y-m-d', strtotime($ex[0]));
	$to = date('Y-m-d', strtotime($ex[1]));

	$sql = "SELECT *, SUM(amount) as total_amount FROM deductions";
    $query = $conn->query($sql);
   	$drow = $query->fetch_assoc();
    $deduction = $drow['total_amount'];

	$from_title = date('M d, Y', strtotime($ex[0]));
	$to_title = date('M d, Y', strtotime($ex[1]));

	require_once('../tcpdf/tcpdf.php');  
    $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
    $pdf->SetCreator(PDF_CREATOR);  
    $pdf->SetTitle('Payslip: '.$from_title.' - '.$to_title);  
    $pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
    $pdf->SetDefaultMonospacedFont('helvetica');  
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
    $pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);  
    $pdf->setPrintHeader(false);  
    $pdf->setPrintFooter(false);  
    $pdf->SetAutoPageBreak(TRUE, 10);  
    $pdf->SetFont('helvetica', '', 11);  
    $pdf->AddPage(); 
    $contents = '';

	 $phsql = "SELECT * FROM deductions where description = 'PhilHealth'";
                    $phquery = $conn->query($phsql);
                    $phrow = $phquery->fetch_assoc();
                    $ph = $phrow['amount'];
                    
                    //HDMF
                    $hdmfsql = "SELECT * FROM deductions where description = 'HDMF'";
                    $hdmfquery = $conn->query($hdmfsql);
                    $hdmfrow = $hdmfquery->fetch_assoc();
                    $hdmf = $hdmfrow['amount'];
                    
                   
               
                    $to = date('Y-m-d');
                    $from = date('Y-m-d', strtotime('-30 day', strtotime($to)));

                    if(isset($_GET['range'])){
                      $range = $_GET['range'];
                      $ex = explode(' - ', $range);
                      $from = date('Y-m-d', strtotime($ex[0]));
                      $to = date('Y-m-d', strtotime($ex[1]));
                    }
                    //Attendance
                    $sql = "SELECT *, SUM(num_hr) AS total_hr FROM attendance WHERE employee_id = '$user_id' AND date BETWEEN '$from' AND '$to' GROUP BY employee_id";

                    $query = $conn->query($sql);
                    $total = 0;
                    while($row = $query->fetch_assoc()){
                      
                     $empsql = "SELECT * FROM employees";
                    $empquery = $conn->query($empsql);
                    $emprow = $empquery->fetch_assoc();
                    $pos_id = $emprow['position_id'];
                    
                    $possql = "SELECT * FROM position where id = '$pos_id'";
                    $posquery = $conn->query($possql);
                    $posrow = $posquery->fetch_assoc();
                       
                        
                        
                      //Cash Advance
                      $casql = "SELECT *, SUM(amount) AS cashamount FROM cashadvance WHERE employee_id='$user_id' AND date_advance BETWEEN '$from' AND '$to'";                      
                      $caquery = $conn->query($casql);
                      $carow = $caquery->fetch_assoc();
                      $cashadvance = $carow['cashamount'];
                       
                      //Overtime
                      $otsql = "SELECT * FROM overtime WHERE employee_id='$user_id' AND date_overtime BETWEEN '$from' AND '$to'";                  
                      $otquery = $conn->query($otsql);
                      $otrow = $otquery->fetch_array();
                      $rate = $otrow['rate'];    
                      $hour = $otrow['hours'];
                      $overtime = $rate * $hour;
                       
                      //VLSL Pay
                      $paysql = "SELECT *, SUM(amount) AS payamount FROM pay WHERE employee_id='$user_id' AND date BETWEEN '$from' AND '$to' AND description ='Vacation Leave' OR description ='Sick Leave' ";                      
                      $payquery = $conn->query($paysql);
                      $payrow = $payquery->fetch_assoc();
                      $pay = $payrow['payamount'];
                       
                      //Differential Pay
                      $paysql1 = "SELECT *, SUM(amount) AS payamount1 FROM pay WHERE employee_id='$user_id' AND date BETWEEN '$from' AND '$to' AND description ='Differential Pay'";                     
                      $payquery1 = $conn->query($paysql1);
                      $payrow1 = $payquery1->fetch_assoc();
                      $pay1 = $payrow1['payamount1'];
                        
                      //SSS Loan
                      $loansql1 = "SELECT * FROM loantable WHERE employee_id='$user_id' AND loan_type ='SSS Loan'";                     
                      $loanquery1 = $conn->query($loansql1);
                      $loanrow1 = $loanquery1->fetch_assoc();
                      $sssloan = $loanrow1['obligation'];
                        
                      //HDMF Loan
                      $loansql2 = "SELECT * FROM loantable WHERE employee_id='$user_id' AND loan_type ='HDMF Loan'";                     
                      $loanquery2 = $conn->query($loansql2);
                      $loanrow2 = $loanquery2->fetch_assoc();
                      $hdmfloan = $loanrow2['obligation'];
                        
                      //Summation GrossPay
                      $wage = $posrow['hourlyrate'] * $row['total_hr'];
                      $allowance = $posrow['allowance'] * 15;
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
                      }
                        else if ($grosspay < 127084){
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
		$contents .= '
			<h2 align="center">Prism Import Export Inc.</h2>
			<h4 align="center">Payslip for the period of '.$from_title." - ".$to_title.'</h4>
            <br><br><br>
			<table cellspacing="0" cellpadding="3">  
    	       	<tr>  
            		<td width="25%" align="right">Employee Name: </td>
                 	<td width="25%"><b>'.$emprow['firstname']." ".$emprow['lastname'].'</b></td>
    	    	</tr>
    	    	<tr>
    	    		
				 	<td width="25%" align="right">Total Wage: </td>
				 	<td width="25%" align="right">'.number_format($wage, 2).'</td> 
    	    	</tr>
                  <tr>
    	    		
				 	<td width="25%" align="right">Total Allowance: </td>
				 	<td width="25%" align="right">'.number_format($allowance, 2).'</td> 
    	    	</tr>
                <tr>
    	    		
				 	<td width="25%" align="right">VL/SL Pay: </td>
				 	<td width="25%" align="right">'.number_format($pay, 2).'</td> 
    	    	</tr>
                  <tr>
    	    		
				 	<td width="25%" align="right">Total Overtime: </td>
				 	<td width="25%" align="right">'.number_format($overtime, 2).'</td> 
    	    	</tr>
                  <tr>
    	    		
				 	<td width="25%" align="right">Differential Pay: </td>
				 	<td width="25%" align="right">'.number_format($pay1, 2).'</td> 
    	    	</tr>
                  <tr>
    	    		
				 	<td width="25%" align="right"><b>GrossPay:</b> </td>
				 	<td width="25%" align="right"><b>'.number_format($grosspay, 2).'</b></td> 
    	    	</tr>
    	    	<tr> 
                
    	    		<td></td> 
    	    		<td></td>
			
				 	
    	    	</tr>
    	    	<tr> 
    	    		<td></td> 
    	    		<td></td>
				 	<td width="25%" align="right">Cash Advance: </td>
				 	<td width="25%" align="right">'.number_format($cashadvance, 2).'</td> 
    	    	</tr>
    	    	<tr> 
    	    		<td></td> 
    	    		<td></td>
				 	<td width="25%" align="right">SSS Contribution:</td>
				 	<td width="25%" align="right">'.number_format($sss, 2).'</td> 
    	    	</tr>
                <tr> 
    	    		<td></td> 
    	    		<td></td>
				 	<td width="25%" align="right">PhilHealth Contribution: </td>
				 	<td width="25%" align="right">'.number_format($ph, 2).'</td> 
    	    	</tr>
                <tr> 
    	    		<td></td> 
    	    		<td></td>
				 	<td width="25%" align="right">HDMF Contribution: </td>
				 	<td width="25%" align="right">'.number_format($hdmf, 2).'</td> 
    	    	</tr>
                <tr> 
    	    		<td></td> 
    	    		<td></td>
				 	<td width="25%" align="right">SSS Loan: </td>
				 	<td width="25%" align="right">'.number_format($sssloan, 2).'</td> 
    	    	</tr>
                <tr> 
    	    		<td></td> 
    	    		<td></td>
				 	<td width="25%" align="right">HDMF Loan: </td>
				 	<td width="25%" align="right">'.number_format($hdmfloan, 2).'</td> 
    	    	</tr>
                <tr> 
    	    		<td></td> 
    	    		<td></td>
				 	<td width="25%" align="right">Tax: </td>
				 	<td width="25%" align="right">'.number_format($tax, 2).'</td> 
    	    	</tr>
                <tr> 
    	    		<td></td> 
    	    		<td></td>
				 	<td width="25%" align="right"><b>Total Deduction:</b> </td>
				 	<td width="25%" align="right"><b>'.number_format($total_deduction, 2).'</b></td> 
    	    	</tr>
                
    	    	<tr> 
    	    		<td></td> 
    	    		<td></td>
				 	<td width="25%" align="right"><b>Net Pay:</b></td>
				 	<td width="25%" align="right"><b>'.number_format($net, 2).'</b></td> 
    	    	</tr>
    	    </table>
    	    <br><hr>
		';
	}
    $pdf->writeHTML($contents);  
    $pdf->Output('payslip.pdf', 'I');

?>