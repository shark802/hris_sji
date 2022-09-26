<?php
	include 'includes/session.php';

	function generateRow($conn){
		$contents = '';
		
		$sql = "SELECT * FROM employees";

		$query = $conn->query($sql);
		$total = 0;
		while($row = $query->fetch_assoc()){
            $pos = $row['position_id'];
            
                $sql1 = "SELECT * FROM position where id = '$pos'";
                $query1= $conn->query($sql1);
                $row1 = $query1->fetch_assoc();
            
			$contents .= "
			<tr>
                <td></td>
				<td>".$row['lastname'].", ".$row['firstname']."</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;".$row1['description']."</td>
                <td></td>
                
                
			
			</tr>
			";
		}

		return $contents;
	}

	require_once('../tcpdf/tcpdf.php');  
    $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
    $pdf->SetCreator(PDF_CREATOR);  
    $pdf->SetTitle('Prism Import Export Inc - Employee List');  
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
    $content = '';  
    $content .= '
      	<h2 align="center">Prism Import Export Inc.</h2>
      	<h4 align="center">Employee List</h4>
      	<table border="1" cellspacing="0" cellpadding="3">  
           <tr>  
                <th width="5%" align="center"></th>
           		<th width="40%" align="center"><b>Employee Name</b></th>
                <th width="30%" align="center"><b>Position</b></th>
                <th width="20%" align="center"></th>
               
               
           </tr>  
      ';  
    $content .= generateRow($conn); 
    $content .= '</table>';  
    $pdf->writeHTML($content);  
    $pdf->Output('schedule.pdf', 'I');

?>