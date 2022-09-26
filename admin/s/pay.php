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
      <h1>
        Pay 
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Manage Employee</li>
        <li class="active">Pay</li>
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
              <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th class="hidden"></th>
                  <th>Employee Name</th>
                  <th>Date From</th>
                  <th>Date To</th>
                  <th>Leave Type</th>
                  <th>Leave Use</th>
                </thead>
                <tbody>
                  <?php
                    $sql = "SELECT * FROM pay;
                    ";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      $employee_id = $row['employee_id'];
                      $leave_type = $row['leave_type'];
                      $sql1 = "SELECT * FROM employees where id = '$employee_id'";
                      $query1 = $conn->query($sql1);
                      $emp_row = $query1->fetch_assoc();

                      $sql2 = "SELECT * FROM leave_types where id = '$leave_type'";
                      $query2 = $conn->query($sql2);
                      $leave_row = $query2->fetch_assoc();
                      echo "
                      <tr>
                        <td>".$emp_row['firstname'].',&nbsp'.$emp_row['lastname']."</td>
                        <td>".$row['date_from']."</td>
                        <td>".$row['date_to']."</td>
                        <td>".$leave_row['leave_type']."</td>
                        <td>".$row['leave_use']."</td>
                        <td>
                          <button class='btn btn-success btn-sm btn-flat' onclick='payrollLoad(".$row['id'].")'><i class='fa fa-eye'></i> View</button>  
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
  <?php include 'includes/pay_modal.php'; ?>
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
    url: 'pay_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      console.log(response);
      $('.date').html(response.date_advance);
      $('.employee_name').html(response.firstname+' '+response.lastname);
      $('.description').val(response.description);
      $('.pid').val(response.pid);
      $('#edit_amount').val(response.amount);
      $('#edit_description').val(response.description);
    }
  });
}
</script>
</body>
</html>
