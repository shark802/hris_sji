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
      Pag-Ibig Table
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Manage Setup</li>
          <li class="active">Pag-Ibig Table</li>
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
              <a href="#pagibigTablenew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a>
              
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                  <th colspan="2" style='text-align: center;'>Range of Compensation</th>
                  <th rowspan="2" style='text-align: center;'>Employee Share</th>
                  <th rowspan="2" style='text-align: center;'>Employer Share</th> 
                  <th rowspan="2" style='text-align: center;'>Total Monthly Premium</th>
                  <th rowspan="2" style='text-align: center;'>Action</th>
                  </tr>

                  <tr>
                  <th style='text-align: center;'>From</th> 
                  <th style='text-align: center;'>To</th> 
                  </tr>

                 
                </thead>
                <tbody>
                  <?php
                    $sql = "SELECT * FROM pagibig_table";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      $range_from = number_format($row['range_from'],2);
                      $range_to = $row['range_to'];
                      $employerShare = $row['employerShare'];
                      $employeeShare = $row['employeeShare'];
                      $totalMonthly =$row['totalMonthlyPremium'];
                       
                      echo "
                        <tr>
                          <td>".$range_from."</td>
                          <td>".$range_to."</td>
                          <td style='text-align: center;'>".$employerShare.' %'."</td>
                          <td style='text-align: center;'>".$employeeShare.' %'."</td>
                          <td style='text-align: center;'>".$totalMonthly.' %'."</td>
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
  <?php include 'includes/Table_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
  $(document).on('click', '.edit', function(e){
    e.preventDefault();
    $('#editPagibig').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.delete', function(e){
    e.preventDefault();
    $('#deletePagibig').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'pagibig_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.id').val(response.id);
      $('#editRange_from').val(response.range_from);
      $('#editRange_to').val(response.range_to);
      $('#edit_employerShare').val(response.employerShare);
      $('#edit_employeeShare').val(response.employeeShare);
    }
  });
}
</script>
</body>
</html>
