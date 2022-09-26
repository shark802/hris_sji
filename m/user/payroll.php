<?php include 'includes/session.php'; ?>
<?php
  include '../timezone.php';
  $range_to = date('m/d/Y');
  $range_from = date('m/d/Y', strtotime('-30 day', strtotime($range_to)));
?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Payroll
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Payslip</li>
      </ol>
    </section>
      
    <!-- Main content -->
    <section class="content">
    
      <?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              ".$_SESSION['error']."
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              ".$_SESSION['success']."
            </div>
          ";
          unset($_SESSION['success']);
        }
      ?>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <div class="pull-right">
                <form method="POST" class="form-inline" id="payForm">
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right col-sm-8" id="reservation" name="date_range" value="<?php echo (isset($_GET['range'])) ? $_GET['range'] : $range_from.' - '.$range_to; ?>">
                  </div>
                 
                </form>
              </div> 
                <button type="button" class="btn btn-success btn-sm btn-flat" id='payslip'><span class="glyphicon glyphicon-save-file"></span> Save Payslip</button>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                  <th></th>
                <thead>
                 
                  <th colspan="2"><center>Payslip from period of  <?php echo $range_from. '&nbsp;&nbsp;to&nbsp;&nbsp;' .$range_to ?></center></th>
               
            
              
                </thead>
                <tbody>
                  <?php
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
                      /*
                      $otsql = "SELECT * FROM overtime WHERE employee_id='$user_id' AND date_overtime BETWEEN '$from' AND '$to'";                  
                      $otquery = $conn->query($otsql);
                      $otrow = $otquery->fetch_array();
                      $rate = $otrow['rate'];    
                      $hour = $otrow['hours'];
                      $overtime = $rate * $hour;
                      */ 
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
                      /*
                      $loansql2 = "SELECT * FROM loantable WHERE employee_id='$user_id' AND loan_type ='HDMF Loan'";                     
                      $loanquery2 = $conn->query($loansql2);
                      $loanrow2 = $loanquery2->fetch_assoc();
                      $hdmfloan = $loanrow2['obligation'];
                        */
                      //Summation GrossPay
                      $overtime = 0;
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
                      $hdmfloan = 0;
                      $total_deduction = $cashadvance + $sss + $ph + $hdmf + $sssloan + $hdmfloan + $tax;
                        
                      //NetPay
                      $net = $grosspay - $total_deduction;

                      echo "
                           <tr>
                              <th width='40%'>TotalWage</th>
                              <td>".number_format($wage, 2)."</td>
                           </tr>
                          <tr>
                               <th>Total Meal Allowance</th>
                               <td>".number_format($allowance, 2)."</td>
                          </tr>
                          <tr>
                              <th>VL/SL Pay</th>
                              <td>".number_format($pay, 2)."</td>
                          </tr>
                          <tr>
                              <th>Total Overtime</th>
                              <td>".number_format($overtime, 2)."</td>
                          </tr>
                          <tr>
                              <th>Diff Pay</th>
                              <td>".number_format($pay1, 2)."</td>
                          </tr>
                          <tr>
                              <th>GrossPay</th>
                              <td>".number_format($grosspay, 2)."</td>
                          </tr>
                          <tr>
                              <th>C/A</th>
                              <td>".number_format($cashadvance, 2)."</td>
                          </tr>
                          <tr>
                              <th>SSS Con.</th>
                              <td>".number_format($sss, 2)."</td>
                          </tr>
                          <tr>
                              <th>PH Con.</th>
                              <td>".number_format($ph, 2)."</td>
                          </tr>
                          <tr>
                              <th>HDMF Con.</th>
                              <td>".number_format($hdmf, 2)."</td>
                          </tr>
                          <tr>
                              <th>SSS Loan</th>
                              <td>".number_format($sssloan, 2)."</td>
                          </tr>
                          <tr>
                              <th>HDMF Loan</th>
                              <td>".number_format($hdmfloan, 2)."</td>
                          </tr>
                          <tr>
                              <th>Tax</th>
                              <td>".number_format($tax, 2)."</td>
                          </tr>
                          <tr>
                              <th>Total Deduction</th>
                              <td>".number_format($total_deduction, 2)."</td>
                          </tr>
                          <tr>
                              <th>Netpay</th>
                              <td>".number_format($net, 2)."</td>     
                          </tr>
                      ";
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>   
  </div>
    
  <?php include 'includes/footer.php'; ?>
  <?php include 'includes/payroll_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?> 
<script>
$(function(){
  $('.edit').click(function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('empid');
    getRow(id);
  });

  $('.delete').click(function(e){
    e.preventDefault();
    $('#delete').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $("#reservation").on('change', function(){
    var range = encodeURI($(this).val());
    window.location = 'payroll.php?range='+range;
  });

  $('#payroll').click(function(e){
    e.preventDefault();
    $('#payForm').attr('action', 'payroll_generate.php');
    $('#payForm').submit();
  });

  $('#payslip').click(function(e){
    e.preventDefault();
    $('#payForm').attr('action', 'payslip_generate.php');
    $('#payForm').submit();
  });

});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'payroll_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('#empid').val(response.id);
      $('#edit_lastname').val(response.lastname);
      $('#edit_rate').val(response.rate);
      $('#edit_allowance').val(response.allowance);
      $('#del_posid').val(response.id);
      $('#del_position').html(response.description);
    }
  });
}


</script>
</body>
</html>
