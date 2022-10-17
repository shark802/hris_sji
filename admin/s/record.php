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
        Employment Record
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Manage Employee</li>
          <li class="active">Employment Record</li>
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
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <th class="hidden"></th>
                  <th>Employee Name</th>
                  <th>SS</th>
                  <th>PhilHealth</th> 
                  <th>Pagibig</th>
                  <th>TIN</th>  
                  <th>Status</th>
                  <th>Department</th> 
                  <th>Position</th> 
                  <th style="text-align: center" >Tools</th> 
                </thead>
                <tbody>
                  <?php
                    $sql = "SELECT e.id, e.firstname, e.lastname, m.ss, m.pagibig, m.philhealth, 
                            m.tin, er.start_date, st.status, d.abbreviation, p.description, s.time_in
                            FROM employment_records AS er LEFT JOIN employees as e ON er.employee_id = e.id
                            LEFT JOIN mandatory_contribution_record as m ON m.employee_id = er.employee_id
                            LEFT JOIN departments as d ON d.id = er.department_id
                            LEFT JOIN position as p ON p.id = er.position_id
                            LEFT JOIN schedules as s ON s.id = er.schedule_id
                            LEFT JOIN status as st ON er.status = st.id ORDER BY e.lastname";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      echo "
                        <tr>
                          <td class='hidden'></td>
                          <td>".$row['lastname']." ".$row['firstname']."</td>
                          <td>".$row['ss']."</td>
                          <td>".$row['philhealth']."</td>
                          <td>".$row['pagibig']."</td>
                          <td>".$row['tin']."</td>
                          <td>".$row['status']."</td>
                          <td>".$row['abbreviation']."</td>
                          <td>".$row['description']."</td>
                          <td>
                            <button onclick='LeaveCredit(".$row['id'].");' class='btn btn-warning btn-sm btn-flat'><i class='fa fa-eye'></i> View Leave</button>                
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
  <?php include 'includes/record_modal.php'; ?>
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
    url: 'record_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.id').val(response.id);
      $('.mandatory_id').val(response.mandatory_id);
      $('#edit_employee_id').val(response.employee_id);
      $('#edit_ss_num').val(response.ss);
      $('#edit_ph_num').val(response.philhealth);
      $('#edit_hdmf_num').val(response.pagibig);
      $('#edit_tin_num').val(response.tin);
      $('#edit_start_date').val(response.start_date);
      $('#edit_status').val(response.status);
      $('#edit_department_id').val(response.department_id);
      $('#edit_position_id').val(response.position_id);
      $('#edit_schedule_id').val(response.schedule_id);
    }
  });
}

function LeaveCredit(id){
  window.location.href = "http://sjitime.herokuapp.com/admin/s/leave_credit.php?id=" + id;
}
</script>
</body>
</html>
