<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Leave Credit Details
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Leave Credit Details</li>
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
            <div class="box-header with-border"> <a href="http://localhost/payroll/web/admin/record.php"  class="btn btn-danger btn-sm btn-flat"><i class="fa fa-arrow-circle-left"></i> Back</a>
            
            </div>
            <div class="box-body">
            <table id="example" class="table table-bordered table-striped">
                <thead>
                  <th class="hidden"></th>
                  <th>Employee Name</th>
                  <th>Employment Status</th>
                  <th>Monthly Leave Credit</th>
                  <th>Tools</th>
                </thead>
                <tbody>
                  <?php
                    $id = $_GET['id'];
                    $sql = "SELECT e.id, e.firstname, e.lastname, s.status, l.monthly_accumulation
                            FROM employees AS e
                            LEFT JOIN employment_records AS er ON er.employee_id = e.id
                            LEFT JOIN status AS s ON s.id = er.status
                            LEFT JOIN leave_types AS l on l.employment_status = s.id
                            WHERE e.id = '$id' GROUP BY l.monthly_accumulation";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      echo "
                        <tr>
                          <td class='hidden'></td>
                          <td>".$row['lastname'].', '.$row['firstname']."</td>
                          <td>".$row['status']."</td>
                          <td>".$row['monthly_accumulation']."</td>
                          <td>
                          <button class='btn btn-primary btn-sm addnew btn-flat' data-id='".$row['id']."'><i class='fa fa-plus'></i> Add New</button>
                        </td>
                        </tr>
                      ";
                    }
                  ?>
                </tbody>
              </table>
              <hr>
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                  <th class="hidden"></th>
                  <th>Leave Type</th>
                  <th>Leave Credit</th>
                  <th>Used Leave Credit</th> 
                  <th>Tools</th>
                </thead>
                <tbody>
                  <?php
                    $id = $_GET['id'];
                    $sql = "SELECT * FROM leave_credit WHERE employee_id = '$id'";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      echo "
                        <tr>
                          <td class='hidden'></td>
                          <td>".$row['leave_type']."</td>
                          <td>".$row['unused_leave']."</td>
                          <td>".$row['used_leave']."</td>
                          <td>
                            <button class='btn btn-success btn-sm edit btn-flat' data-id='".$row['id']."'><i class='fa fa-edit'></i> Edit</button>
                            <button class='btn btn-danger btn-sm delete btn-flat' data-id='".$row['id']."'><i class='fa fa-trash'></i> Delete</button>
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
  <?php include 'includes/leave_credit_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
  $(document).on('click', '.edit', function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.delete', function(e){
    e.preventDefault();
    $('#delete').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.addnew', function(e){
    e.preventDefault();
    $('#addnew').modal('show');
    var id = $(this).data('id');
    getEmployeeID(id);
  });

});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'leave_credit_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.id').val(response.id);
      $('.edit_employee_id').val(response.employee_id);
      $('#edit_leave_type').val(response.leave_type);
      $('#edit_used_leave').val(response.used_leave);
      $('#edit_unused_leave').val(response.unused_leave);
    }
  });
}

function getEmployeeID(id){
  $.ajax({
    type: 'POST',
    url: 'leave_credit_row_employee_id.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.employee_id').val(response.id);
    }
  });
}

</script>
</body>
</html>
