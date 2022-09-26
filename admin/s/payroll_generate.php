<?php
require_once('../tcpdf/tcpdf.php');
include 'includes/session.php';
//============================================================+
// File name   : example_002.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 002 for TCPDF class
//               Removing Header and Footer
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Removing Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
function generateRow($from, $to, $conn){
    
 
    //***** WORK ON THIS SHIT *****
    
    $contents = '';
    $sql = "SELECT *, sum(num_hr) AS total_hr, attendance.employee_id AS empid FROM attendance LEFT JOIN employees ON employees.id=attendance.employee_id LEFT JOIN position ON position.id=employees.position_id WHERE date BETWEEN '$from' AND '$to' GROUP BY attendance.employee_id ORDER BY employees.lastname ASC, employees.firstname ASC";
    
   
    
    $query = $conn->query($sql);
    $totalwage = 0;
    $totalallowance = 0;
    $totalpay = 0;
    $totalovertime = 0;
    $totalpay1 = 0;
    $totalgrosspay = 0;
    $totalcashadvance = 0;
    $totalsss = 0;
    $totalph = 0;
    $totalhdmf = 0;
    $totalsssloan = 0;
    $totalhdmfloan = 0;
    $totaltax = 0;
    $totaldeduction = 0;
    $totalnetpay = 0;
    while($row = $query->fetch_assoc()){
        $empid = $row['empid'];
        
        //Cash Advance
          $casql = "SELECT *, SUM(amount) AS cashamount FROM cashadvance WHERE employee_id='$empid' AND date_advance BETWEEN '$from' AND '$to'";
        $caquery = $conn->query($casql);
          $carow = $caquery->fetch_assoc();
          $cashadvance = $carow['cashamount'];
        
        //SSS Loan
        /*
        $loansql1 = "SELECT * FROM loantable WHERE employee_id='$empid' AND loan_type ='SSS Loan'";       $loanquery1 = $conn->query($loansql1);
        $loanrow1 = $loanquery1->fetch_assoc();
        $sssloan = $loanrow1['obligation'];
                    
        //HDMF Loan
        $loansql2 = "SELECT * FROM loantable WHERE employee_id='$empid' AND loan_type ='HDMF Loan'";     $loanquery2 = $conn->query($loansql2);
        $loanrow2 = $loanquery2->fetch_assoc();
        $hdmfloan = $loanrow2['obligation'];
        */
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
                    
        
        //Overtime
        /*
        $otsql = "SELECT * FROM overtime WHERE employee_id='$empid' AND date_overtime BETWEEN '$from' AND '$to'";                  
        $otquery = $conn->query($otsql);
        $otrow = $otquery->fetch_array();
        $rate = $otrow['rate'];    
        $hour = $otrow['hours'];
        $overtime = $rate * $hour;
        */
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
        
        //Summation GrossPay
        $overtime = 0;
        $wage = $row['hourlyrate'] * $row['total_hr'];
        $allowance = $row['allowance'] * 15;
        $grosspay = $wage + $allowance + $pay + $overtime + $pay1;
        /*
        $masql1 = "SELECT * FROM management where position = 'CEO'";
        $maquery1 = $conn->query($masql1);
        $marow1 = $maquery1->fetch_assoc();
        $ma1 = $marow1['firstname'];
        */
        //Summation Tax
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
        
        //Deduction
        $sss = $grosspay * 0.0363;
        $sssloan = 0;
        $hdmfloan = 0;
        $total_deduction = $cashadvance + $sss + $ph + $hdmf + $sssloan + $hdmfloan + $tax;
        
        //NetPay
          $net = $grosspay - $total_deduction;
        
        //Total Summary
        $totalwage += $wage;
        $totalallowance += $allowance;
        $totalpay += $pay;
        $totalovertime += $overtime;
        $totalpay1 += $pay1;
        $totalgrosspay += $grosspay;
        $totalcashadvance += $cashadvance;
        $totalsss += $sss;
        $totalph += $ph; 
        $totalhdmf += $hdmf;
        $totalsssloan += $sssloan;
        $totalhdmfloan += $hdmfloan;
        $totaltax += $tax;
        $totaldeduction += $total_deduction;
        $totalnetpay += $net;
        $contents .= '
        <tr>
            <td width="8%">'.$row['lastname'].', '.$row['firstname'].'</td> 
            <td>'.number_format($wage, 2).'</td>
            <td>'.number_format($allowance, 2).'</td>
            <td>'.number_format($pay, 2).'</td>
            <td>'.number_format($overtime, 2).'</td>
            <td>'.number_format($pay1, 2).'</td>
            <td>'.number_format($grosspay, 2).'</td>
            <td>'.number_format($cashadvance, 2).'</td>
            <td>'.number_format($sss, 2).'</td>
            <td>'.number_format($ph, 2).'</td>
            <td>'.number_format($hdmf, 2).'</td>
            <td>'.number_format($sssloan, 2).'</td>
            <td>'.number_format($hdmfloan, 2).'</td>
            <td>'.number_format($tax, 2).'</td>
            <td>'.number_format($total_deduction, 2).'</td>
            <td align="right">'.number_format($net, 2).'</td>
        </tr>
        ';
    }

    $contents .= '
        <tr>
            <td align="right"><b>Total</b></td>
            <td align="right"><b>'.number_format($totalwage, 2).'</b></td>
            <td align="right"><b>'.number_format($totalallowance, 2).'</b></td>
            <td align="right"><b>'.number_format($totalpay, 2).'</b></td>
            <td align="right"><b>'.number_format($totalovertime, 2).'</b></td>
            <td align="right"><b>'.number_format($totalpay1, 2).'</b></td>
            <td align="right"><b>'.number_format($totalgrosspay, 2).'</b></td>
            <td align="right"><b>'.number_format($totalcashadvance, 2).'</b></td>
            <td align="right"><b>'.number_format($totalsss, 2).'</b></td>
            <td align="right"><b>'.number_format($totalph, 2).'</b></td>
            <td align="right"><b>'.number_format($totalhdmf, 2).'</b></td>
            <td align="right"><b>'.number_format($totalsssloan, 2).'</b></td>
            <td align="right"><b>'.number_format($totalhdmfloan, 2).'</b></td>
            <td align="right"><b>'.number_format($totaltax, 2).'</b></td>
            <td align="right"><b>'.number_format($totaldeduction, 2).'</b></td>
            <td align="right"><b>'.number_format($totalnetpay, 2).'</b></td>
         </tr>
     <br> 

    <br>    
    <br>    
     
   
Prepared by:
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Checked by: 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Verified by: 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Approved/Disapproved by:
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<br><br>    
<br><br>       
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Leizel Gonzaga
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

Arthur Dela Cruz
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

Elizabeth Mondragon
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

&nbsp;&nbsp;&nbsp;&nbsp;Fredirick Asuncion
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Admin Officer

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Auditor

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Accountant/Bookkeeper

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

Operation Manager

    ';
    return $contents;
}


$pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, 'LETTER', true, 'UTF-8', false);  
    $pdf->SetCreator(PDF_CREATOR);  
    $pdf->SetTitle('Payroll: ');  
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
    $resolution= array(500, 240);
    $pdf->AddPage('L', $resolution);  

    $content = '';  
    $content .= '
    
      	<h2 align="center">St.Johns Institute.</h2>
        <h5 align = "center">
    
<img src="">
<h3>Payroll Period from  </h3>
<h2> &nbsp;&nbsp;PAYROLL </h2>
</h5>
      	<h4 align="right">Payroll Period from: &nbsp</h4>
      	<table border="1" cellspacing="0" cellpadding="3">  
           <tr>  
           		<th width="8%"><b>Employee Name</b></th>
				<th><b>Total Wage</b></th> 
                <th><b>Total Meal Allowance</b></th> 
                <th><b>VL/SL Pay</b></th>
                <th><b>Total Overtime</b></th> 
                <th><b>Diff Pay</b></th> 
                <th><b>Gross Pay</b></th>
                <th><b>Cash Adv.</b></th> 
                <th><b>SSS Con.</b></th> 
                <th><b>PHealth. Con.</b></th> 
                <th><b>HDMF Con.</b></th> 
                <th><b>SSS Loan</b></th> 
                <th><b>HDMF Loan</b></th> 
                <th><b>w Holding Tax</b></th> 
                <th><b>Total Deduction</b></th>
                <th><b>Net Pay</b></th> 
           </tr>  
          
';  $from = '2018-08-01';
    $to = '2018-08-31';
    
    $content .= generateRow($from, $to, $conn);  
    $content .= '</table>'; 
    $pdf->writeHTML($content);  
    $pdf->Output('payroll.pdf', 'I');
