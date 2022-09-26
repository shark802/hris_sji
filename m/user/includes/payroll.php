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
                <th rowspan="3" style="text-align: center; vertical-align: middle;">Employee Name</th>
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
                <th style="text-align: center; vertical-align: middle;">Basic Salary</th>
                <th style="text-align: center; vertical-align: middle;">Financial Aid</th>
                <th style="text-align: center; vertical-align: middle;">Total</th>
                <th style="text-align: center; vertical-align: middle;">Basic Salary</th>
                <th colspan="2" style="text-align: center; vertical-align: middle;">Financial&nbsp;&nbsp;Aid&nbsp;&nbsp;& <br>Masters&nbsp;&nbsp;Degree</th>
                <th></th>
                <?php
                  $id = $_GET['id'];
                  $sql = "SELECT payroll_period FROM payroll WHERE id = '$id'";
                  $query = $conn->query($sql);
                  $row = $query->fetch_assoc();
                  $payroll_period = $row['payroll_period'];
                  if($payroll_period == '1st'){
                    echo '
                      <th style="text-align: center; vertical-align: middle;">SSS Salary Loan</th>
                      <th style="text-align: center; vertical-align: middle;">SSS Calamity Loan</th>
                      <th style="text-align: center; vertical-align: middle;">Pagibig Calamity Loan</th>
                      <th style="text-align: center; vertical-align: middle;">Pagibig MPL</th>
                    ';
                  } else {
                    echo '
                      <th style="text-align: center; vertical-align: middle;">SSS Premium</th>
                      <th style="text-align: center; vertical-align: middle;">Philhealth Premium</th>
                      <th style="text-align: center; vertical-align: middle;">Pagibig Premium</th>
                      <th style="text-align: center; vertical-align: middle;">W/holding Tax</th>
                    ';
                  }
                ?>
                <th style="text-align: center; vertical-align: middle;">Misc&nbsp;&nbsp; & <br>&nbsp;Other Fees (Employee's Dependents)</th>
                <th colspan="2" style="text-align: center; vertical-align: middle;">Absences</th>
                <th rowspan="2" style="text-align: center; vertical-align: middle">Undertime&nbsp;/ Late</th>
                <th></th>
              </tr>
              <tr>       
                <th></th><th></th><th></th><th></th><th></th><th></th>
                <th></th><th></th><th></th><th></th><th></th>
                <th></th><th>Basic</th><th>Financial Aid</th>
                <th>Deductions (C/A)</th><th></th>
              </tr>
                <tbody>
                  <td><td>
                  <td><td>
                  <td><td>
                  <td><td>
                  <td><td>
                  <td><td>
                  <td><td>
                  <td><td>
                  <td><td>
                  <td><td>
                  <td><td>
                  <td><td>
                  <td><td>
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
