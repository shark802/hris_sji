<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar_loan.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        SSS Loan
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Payroll</li>
        <li class="active">SSS Loan</li>
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
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th class="hidden"></th>
                  <th>Date</th>
                  <th>Loan</th>
                  <th>Name</th>
                  <th>Loan Amount</th>
                  <th>Obligation</th>
                  <th>Current Balance</th>
                  <th>Status</th>
                  <th>Calculate</th>
                </thead>
                <tbody>
                  <?php
                    $sql = "SELECT *, loantable.id AS loanid, employees.employee_id AS empid FROM loantable LEFT JOIN employees ON employees.id=loantable.employee_id WHERE loan_status = 'Unpaid' ORDER BY loan_type DESC";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      echo "
                        <tr>
                          <td class='hidden'></td>
                          <td>".date('M d, Y', strtotime($row['date_file']))."</td>
                          <td>".$row['loan_type']."</td>
                          <td>".$row['firstname'].' '.$row['lastname']."</td>
                          <td>".number_format($row['loan_amount'], 2)."</td>
                          <td>".number_format($row['obligation'], 2)."</td>
                          <td>".number_format($row['balance'], 2)."</td>
                          <td>".$row['loan_status']."</td>
                          <td>
                            <button class='btn btn-success btn-sm edit btn-flat' data-id='".$row['loanid']."'><i class='fa fa-pencil-square-o'></i>&nbsp; Calculate</button>
                          </td>
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
  <?php include 'includes/ssscalc_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
  $('.edit').click(function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $('.delete').click(function(e){
    e.preventDefault();
    $('#delete').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });
});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'ssscalc_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      console.log(response);
      $('.date').html(response.date_file);
      $('.employee_name').html(response.firstname+' '+response.lastname);
      $('.loanid').val(response.loanid);
      $('#edit_amount').val(response.loan_amount);
      $('#edit_obligation').val(response.obligation);
      $('#edit_balance').val(response.balance);
    }
  });
}
</script>
</body>
</html>
