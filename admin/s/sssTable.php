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
        SSS Table
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Manage Setup</li>
          <li class="active">SSS Table</li>
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
              <a href="#sssTablenew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a>
              
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                  <th colspan="2" rowspan="2" style='text-align: center;'>Range of Compensation</th>
                  <th rowspan="3" style='text-align: center;'>Monthly Salary Credit</th>
                  <th colspan="7" style='text-align: center;'>Employed</th> 
                  <th colspan="2" style='text-align: center;'>SE / VM / OFW Contribution</th>
                  <th rowspan="3" style='text-align: center;'>Action</th>
                  </tr>

                  <tr>
                  <th colspan="3" style='text-align: center;'>SS Contribution</th> 
                  <th>EC</th> 
                  <th colspan="3">Total Contribution</th>
                  <th rowspan="2" style='text-align: center;' style='text-align: center;'>Monthly Salary Credit</th>
                  <th rowspan="2" style='text-align: center;' style='text-align: center;'>SS Contribution</th> 
                  </tr>

                  <tr>
                  <th>From</th>
                  <th>To</th>
                  <th>ER</th> 
                  <th>EE</th> 
                  <th>Total</th> 
                  <th>ER</th> 
                  <th>ER</th> 
                  <th>EE</th> 
                  <th>Total</th> 
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $sql = "SELECT * FROM sss_table";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      $range_from = number_format($row['range_from'],2);
                      $range_to = $row['range_to'];
                      $monthly_salaryCredit = number_format($row['monthly_salaryCredit'],2);
                      $er = number_format($row['er'],2);
                      $ee = number_format($row['ee'],2);
                      $ec = number_format($row['ec'],2);
                      $total_er = intval($er) + intval($ec);
                      $ss_contribution = number_format($row['ss_contribution'],2);
                      $total_contribution = number_format($row['total_contribution'],2);
                      $se_monthlyCredit = number_format(intval($row['se_monthlyCredit']),2);
                      $se_ssContribution = number_format(intval($row['se_ssContribution']),2);
                      
                      echo "
                        <tr>
                          <td>".$range_from."</td>
                          <td>".$range_to."</td>
                          <td>".$monthly_salaryCredit."</td>
                          <td>".$er."</td>
                          <td>".$ee."</td>
                          <td>".$ss_contribution."</td>
                          <td>".$ec."</td>
                          <td>".number_format($total_er, 2)."</td>
                          <td>".$ee."</td>
                          <td>".$total_contribution."</td>
                          <td>".$se_monthlyCredit."</td>
                          <td>".$se_ssContribution."</td>
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
    $('#editSSS').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.delete', function(e){
    e.preventDefault();
    $('#deleteSSS').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'sss_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.id').val(response.id);
      $('#edit_range_from').val(response.range_from);
      $('#edit_range_to').val(response.range_to);
      $('#edit_monthly_salaryCredit').val(response.monthly_salaryCredit);
      $('#edit_er').val(response.er);
      $('#edit_ee').val(response.ee);
      $('#edit_ec').val(response.ec);
      $('#edit_se_monthlyCredit').val(response.se_monthlyCredit);
      $('#edit_se_ssContribution').val(response.se_ssContribution);
    }
  });
}
</script>
</body>
</html>
