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
      PhilHealth Table
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Manage Setup</li>
          <li class="active">PhilHealth Table</li>
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
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                  <th colspan="2" style='text-align: center;'>Range of Compensation</th>
                  <th rowspan="2" style='text-align: center;'>Premium Rate</th>
                
                  <th rowspan="2" style='text-align: center;'>Total Monthly Premium</th>
                 
                  </tr>

                  <tr>
                  <th style='text-align: center;'>From</th> 
                  <th style='text-align: center;'>To</th> 
                  </tr>

                 
                </thead>
                <tbody>
                  <?php
                    $sql = "SELECT * FROM ph_table";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      $range_from = $row['range_from'];
                      $range_to = $row['range_to'];
                      $employerShare = number_format($row['employerShare'],2);
                      $employeeShare = number_format($row['employeeShare'],2);
                      $premiumRate = intval($row['employerShare']) + intval($row['employeeShare']);
                      $totalMonthly = $row['totalMonthlyPremium'];
                       
                      echo "
                        <tr>
                          <td>".$range_from."</td>
                          <td>".$range_to."</td>
                          <td style='text-align: center;'>".$premiumRate.' %'."</td>
                         
                          <td style='text-align: center;'>".$totalMonthly."</td>
                        
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
    $('#editPh').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.delete', function(e){
    e.preventDefault();
    $('#deletePh').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'ph_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.id').val(response.id);
      $('#editPhRange_from').val(response.range_from);
      $('#editPhRange_to').val(response.range_to);
      $('#edit_PhemployerShare').val(response.employerShare);
      $('#edit_PhemployeeShare').val(response.employeeShare);
    }
  });
}
</script>
</body>
</html>
