<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <?php 
        $id = $_GET['id'];
        $sql = "SELECT * FROM loan_type WHERE id = '$id'";
        $query = $conn->query($sql);
        $row = $query->fetch_assoc();
        echo "<h1>".$row['loan_type']."</h1>";
     
   
        echo '
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Manage Deductions</li>
            <li class="active">'.$row['loan_type'].'</li>
          </ol>
        ';
    ?>
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
            <div class="box-body" style="overflow-x:auto;">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th class="hidden"></th>
                  <th>Date Loan</th>
                  <th>Loan Amount</th>
                  <th>Payment Term</th>
                  <th>Balance</th>
                  <th>Monthly Obligation</th>
                  <th>Total Amount Paid</th>
                  <th>Status</th>
                </thead>
                <tbody>
                  <?php
                    $id = $_GET['id'];
                    $sql = "SELECT lt.loan_type, l.id, l.employee_id, 
                            l.loan_type AS loan_type_id, l.date_loan, l.loan_amount, l.payment_term,
                            l.balance, l.obligation, l.total_amount_paid, l.status 
                            FROM loantable AS l 
                            LEFT JOIN loan_type AS lt ON l.loan_type = lt.id
                            WHERE l.loan_type = '$id'";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      echo "
                        <tr>
                          <td class='hidden'></td>
                          <td>".$row['date_loan']."</td>
                          <td>".number_format($row['loan_amount'], 2)."</td>
                          <td>".$row['payment_term']."</td>
                          <td>".number_format(intval($row['balance']), 2)."</td>
                          <td>".number_format($row['obligation'], 2)."</td>
                          <td>".number_format($row['total_amount_paid'], 2)."</td>";
                          if($row['status'] == 'Paid'){
                            echo "<td style='color: green; font-weight: bold;'>".$row['status']."</td>";
                          } else {
                            echo "<td style='color: red; font-weight: bold;'>".$row['status']."</td>";
                          };
                          echo "</tr>";
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
  <?php include 'includes/loan_modal.php'; ?>
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
    url: 'loans_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.id').val(response.id);
      $('loan_type').val(response.loan_type);
      $('#edit_employee_id').val(response.employee_id);
      $('#edit_loan_type').val(response.loan_type);
      $('#edit_date_loan').val(response.date_loan);
      $('#edit_payment_term').val(response.payment_term);
      $('#edit_balance').val(response.balance);
      $('#edit_loan_amount').val(response.loan_amount);
      $('#edit_obligation').val(response.obligation);
      $('#edit_total_amount_paid').val(response.total_amount_paid);
      $('#edit_status').val(response.status);
    }
  });
}
</script>
</body>
</html>
