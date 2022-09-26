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
  <?php  
      $getId = $_GET['id']; 

      $payrollsql = "SELECT * FROM payroll WHERE id = '$getId'";
      $payrollquery = $conn->query($payrollsql);
      $payrollrow = $payrollquery->fetch_assoc();

      if($payrollrow['payroll_period'] == '1st'){
        $period = '1 - 15';
      } else {
        $period = '16 - 30';
      }

  ?>

  <style>
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
        max-width:100%;
        white-space:nowrap;
      }
    </style>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Payroll
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Printable</li>
        <li class="active">Payroll</li>
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
                 
                  <button type="button" class="btn btn-success btn-sm btn-flat" id='payroll'><span class="glyphicon glyphicon-print"></span> Payroll</button>
                 
                </form>
              </div>
            </div>
            <div class="box-body" style="overflow-x:auto; font-size: 11px;">
              <table id="example1" class="table table-bordered">
              <tr>
                <th rowspan="3" style="text-align: center; vertical-align: middle;" width="30%">Employee Name</th>
                <th colspan="3" style="text-align: center; vertical-align: middle;">Monthly</th>
                <th colspan="4" style="text-align: center; vertical-align: middle;">Payroll <?php echo $period; ?></th>
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

                <?php 
                    if($payrollrow['payroll_period'] == '1st'){
                      echo'
                        <th rowspan="2" style="text-align: center; vertical-align: middle;" >SSS <br> Salary Loan</th>
                        <th rowspan="2" style="text-align: center; vertical-align: middle;">SSS <br>Calamity Loan</th>
                        <th rowspan="2" style="text-align: center; vertical-align: middle;">Pagibig <br>Calamity Loan</th>
                        <th rowspan="2" style="text-align: center; vertical-align: middle;">Pagibig <br>MPL</th>
                      ';
                    } else {
                      echo '
                        <th rowspan="2" style="text-align: center; vertical-align: middle;">SSS Premium</th>
                        <th rowspan="2" style="text-align: center; vertical-align: middle;">Pagibig Premium</th>
                        <th rowspan="2" style="text-align: center; vertical-align: middle;">Philhealth Premium</th>         
                        <th rowspan="2" style="text-align: center; vertical-align: middle;">W/holding Tax</th>
                      ';
                    }
                ?>

                  <th rowspan="2" style="text-align: center; vertical-align: middle;">Misc&nbsp;&nbsp; & <br>&nbsp;Other Fees <br>(Employees Dependents)</th>
                  <th colspan="2" style="text-align: center; vertical-align: middle;">Absences</th>
                  <th rowspan="2" style="text-align: center; vertical-align: middle">Undertime <br>/ Late</th>
                  <th rowspan="2" style="text-align: center; vertical-align: middle">Deduction <br>C/A</th>
              </tr>
              <tr>
                    <th>Basic</th>
                    <th>Financial Aid</th>
              </tr>
                <tbody>
                <?php 
               
              
                $sql = "SELECT * FROM payroll_details WHERE payroll_id = '$getId'";
                $query = $conn->query($sql);
                while($row = $query->fetch_assoc()){
                  echo "
                    <tr>
                      <td>&nbsp;".$row['employee_name'],"&nbsp;</td>
                      <td>&nbsp;".number_format(intval($row['monthly_basic']), 2)."&nbsp;</td>
                      <td>&nbsp;".number_format(round($row['monthly_aid']), 2)."&nbsp;</td>
                      <td>&nbsp;".number_format(round($row['monthly_total'], 2), 2)."&nbsp;</td>
                      <td>&nbsp;".number_format(round($row['payroll_basic'], 2), 2)."&nbsp;</td>
                      <td colspan='3'>&nbsp;".number_format(round($row['payroll_others'], 2), 2)."&nbsp;</td>
                      <td>&nbsp;".number_format(round($row['position_honorarium'], 2), 2)."&nbsp;</td>
                      <td>&nbsp;".number_format(round($row['chinese_prems'], 2), 2)."&nbsp;</td>
                      <td>&nbsp;".number_format(round($row['advisory'], 2), 2)."&nbsp;</td>
                      <td>&nbsp;".number_format(round($row['moderator'], 2), 2)."&nbsp;</td>
                      <td>&nbsp;".number_format(round($row['overload'], 2), 2)."&nbsp;</td>
                      <td>&nbsp;".number_format(round($row['sub_pay'], 2), 2)."&nbsp;</td>
                      <td>&nbsp;".number_format(round($row['adj_refund'], 2), 2)."&nbsp;</td>
                      <td>&nbsp;".number_format(round($row['overtime_pay'], 2), 2)."&nbsp;</td>";

                      if($payrollrow['payroll_period'] == '1st'){
                        echo "
                          <td>&nbsp;".number_format(round($row['sss_salaryLoan'], 2), 2)."&nbsp;</td>
                          <td>&nbsp;".number_format(round($row['sss_calamityLoan'], 2), 2)."&nbsp;</td>
                          <td>&nbsp;".number_format(round($row['hdmf_calamityLoan'], 2), 2)."&nbsp;</td>
                          <td>&nbsp;".number_format(round($row['hdmf_mpl'], 2), 2)."&nbsp;</td>
                        ";
                      } else {
                        echo "
                          <td>&nbsp;".number_format(round($row['sss'], 2), 2)."&nbsp;</td>
                          <td>&nbsp;".number_format(round($row['hdmf'], 2), 2)."&nbsp;</td>
                          <td>&nbsp;".number_format(round($row['philhealth'], 2), 2)."&nbsp;</td>
                          <td>&nbsp;".number_format(round($row['wtax'], 2), 2)."&nbsp;</td>
                        ";
                      }
                      
                      echo "
                      <td>&nbsp;".number_format(round($row['other_deductions'], 2), 2)."&nbsp;</td>
                      <td>&nbsp;".number_format(round($row['absences_total'], 2), 2)."&nbsp;</td>
                      <td>&nbsp;".number_format(round($row['deduction_aid'], 2), 2)."&nbsp;</td>
                      <td>&nbsp;".number_format(round($row['undertime_late'], 2), 2)."&nbsp;</td>
                      <td>&nbsp;".number_format(round($row['ca'], 2), 2)."&nbsp;</td>
                      <td>&nbsp;".number_format(round($row['total_gross_pay'], 2), 2)."&nbsp;</td>
                      <td>&nbsp;".number_format(round($row['total_deduction'], 2), 2)."&nbsp;</td>
                      <td>&nbsp;".number_format(round($row['net_pay'], 2), 2)."&nbsp;</td>
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
</div>
  <?php include 'includes/scripts.php'; ?> 
</body>
</html>
