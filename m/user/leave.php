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
       Leave Application
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Leave & OT Application</li>
          <li class="active">Leave Application</li>
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
              <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i><b> Apply Leave</b></a>
                
            </div>
            <div class="box-body" style="overflow-x:auto;">
              <table id="example3" class="table table-bordered table-striped">
                <thead>
                  <th class="hidden"></th>
                  <th>Leave Type</th>
                  <th style='text-align: center;'>Available Credit</th>
                  <th>Total Leave Used</th>
                </thead>
                <tbody>
                  <?php
                    $employee_id = $user['eid'];
                    $sql = "SELECT * FROM leave_credit WHERE employee_id = '$employee_id'";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      echo "
                        <tr>
                          <td class='hidden'></td>
                          <td>".$row['leave_type']."</td>
                          <td style='text-align: center;'>".$row['unused_leave']."</td>
                          <td style='text-align: center;'>".$row['used_leave']."</td>
                        </tr>
                      ";
                    }
                  ?>
                </tbody>
              </table>
              <hr><hr>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <th class="hidden"></th>
                  <th>Date applied</th>
                  <th>Leave Type</th>
                  <th>Total Used Leave</th>
                  <th>Status</th>  
                  <th></th>  
                </thead>
                <tbody>
                  <?php
                    $sql = "SELECT * FROM applied_leave WHERE employee_id = '$employee_id' ORDER BY date_from DESC";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      echo "
                        <tr>
                          <td class='hidden'></td>
                          <td><b>".$row['date_from'].'</b> - <b>'.$row['date_to']."</b></td>
                          <td>".$row['leave_type']."</td>
                          <td>".$row['num_leave']."</td>";
                          if($row['status'] == 'Approved'){
                            echo "<td style='color: green; font-weight: bold;'>".$row['status']."</td>
                            <td></td>";
                          } else if($row['status'] == 'Pending'){
                            echo "<td style='color: orange; font-weight: bold;'>".$row['status']."</td>
                                  <td>
                                    <button class='btn btn-success btn-sm edit btn-flat' data-id='".$row['id']."'><i class='fa fa-edit'></i> Modify</button>
                               
                                    <button class='btn btn-danger btn-sm delete btn-flat' data-id='".$row['id']."'><i class='fa fa-times'></i> Cancel</button>
                                </td>";
                          } else {
                            echo "<td style='color: red; font-weight: bold;'>".$row['status']."</td>
                                  <td></td>";
                          }
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
  <?php include 'includes/leave_modal.php'; ?>
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

});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'leave_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.id').val(response.id);
      $('#edit_employee_id').val(response.employee_id);
      $('#edit_date_from').val(response.date_from);
      $('#edit_date_to').val(response.date_to);
      $('#edit_leave_type').val(response.leave_type);
      $('#edit_reason').val(response.reason);
      $('#edit_hr_approval').val(response.hr_approval);
      $('#edit_supervisor_approval').val(response.supervisor_approval);
      $('#edit_principal_approval').val(response.principal_approval);
      $('#edit_status').val(response.status);
    }
  });
}
</script>
</body>
</html>
