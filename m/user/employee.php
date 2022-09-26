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
        <b>Personal Profile</b>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Manage Profile</li>
        <li class="active">Personal Profile</li>
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
           
            <div class="box-body" style="overflow-x:auto;">
              <table id="example1" class="table table-bordered table-striped">
              <tbody>
                <tr>
                  <th width='10%' colspan='2' style='text-align: center;'>Personal Profile</th>
                  <th width='15%' colspan='2' style='text-align: center;'>Employment Record</th>
                </tr>
                <tr>
                  <th style='text-align: right;'>Username </th>
                  <td><strong><?php echo $user['username']; ?></strong></td>   
                  <th style='text-align: right;'>SSS No.</th>
                  <td><strong><?php echo $user['ss']; ?></strong></td>   
                </tr>
                
                <tr>
                  <th style='text-align: right;'>Name</th>
                  <td><strong><?php echo $user['firstname'].' '.$user['lastname']; ?></strong></td>
                  <th style='text-align: right;'>Pag-ibig No.</th>
                  <td><strong><?php echo $user['pagibig'];?></strong></td>
                </tr>
                <tr>
                  <th style='text-align: right;'>Address</th>
                  <td><strong><?php echo $user['address']; ?></strong></td>
                  <th style='text-align: right;'>Philhealth No.</th>
                  <td><strong><?php echo $user['philhealth']; ?></strong></td>
                </tr>
                <tr>
                  <th style='text-align: right;'>Birthdate</th>
                  <td><strong><?php echo $user['birthdate']; ?></strong></td>
                  <th style='text-align: right;'>TIN No.</th>
                  <td><strong><?php echo $user['tin']; ?></strong></td>
                </tr>
                <tr>
                  <th style='text-align: right;'>Gender</th>
                  <td><strong><?php echo $user['gender']; ?></strong></td>
                  <th style='text-align: right;'>Department</th>
                  <td><strong><?php echo $user['departments']; ?></strong></td>
                </tr>
                <tr>
                  <th style='text-align: right;'>Contact</th>
                  <td><strong><?php echo $user['contact_info']; ?></strong></td>
                  <th style='text-align: right;'>Position</th>
                  <td><strong><?php echo $user['description']; ?></strong></td>
                </tr>
              
                <tr>
                  <th style='text-align: right;'>Status</th>
                  <td><strong><?php echo $user['status']; ?></strong></td>
                  <th></th>
                  <td></td>
                </tr>
                
             
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>   
  </div>
    
  <?php include 'includes/footer.php'; ?>
  <?php include 'includes/employee_modal.php'; ?>
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

  $('.photo').click(function(e){
    e.preventDefault();
    var id = $(this).data('id');
    getRow(id);
  });

});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'employee_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.empid').val(response.empid);
      $('.employee_id').html(response.employee_id);
      $('.del_employee_name').html(response.firstname+' '+response.lastname);
      $('#employee_name').html(response.firstname+' '+response.lastname);
      $('#edit_employee_id').val(response.employee_id);
      $('#edit_password').val(response.password);
      $('#edit_firstname').val(response.firstname);
      $('#edit_lastname').val(response.lastname);
      $('#edit_address').val(response.address);
      $('#datepicker_edit').val(response.birthdate);
      $('#edit_contact').val(response.contact_info);
      $('#edit_account_info').val(response.account_info);
      $('#gender_val').val(response.gender).html(response.gender);
      $('#position_val').val(response.position_id).html(response.description);
      $('#schedule_val').val(response.schedule_id).html(response.time_in+' - '+response.time_out);
      $('#status_val').val(response.status).html(response.status);
    }
  });
}
</script>
</body>
</html>
