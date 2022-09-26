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
        Tax Table
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Manage Setup</li>
          <li class="active">Tax</li>
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
                  <th>Annual Income Range</th>
                  <th>Monthly Income Range</th>
                  <th>Tax Rate</th> 
                  <th>Tools</th>
                </thead>
                <tbody>
                  <?php
                    $sql = "SELECT * FROM tax_table";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      $annual_income_from = number_format($row['annual_income_from'],2);
                      $annual_income_to = $row['annual_income_to'];
                      $monthly_income_from = number_format($row['monthly_income_from'],2);
                      $monthly_income_to = $row['monthly_income_to'];
                      $base_tax = $row['base_tax'];
                      $excess_percentage = $row['excess_percentage'];
                      $excess_income = number_format($row['excess_income'],2);
                      $tax_rate = '';

                      if($excess_percentage == 0 && $excess_percentage == 0){
                        $tax_rate = $row['base_tax'];
                      } else {
                        $tax_rate = $base_tax." + ".$excess_percentage."% of excess over ₱".$excess_income;
                      }

                      echo "
                        <tr>
                          <td class='hidden'></td>
                          <td>"."₱".$annual_income_from." - "."₱".$annual_income_to."</td>
                          <td>"."₱".$monthly_income_from." - "."₱".$monthly_income_to."</td>
                          <td>".$tax_rate."</td>
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
  <?php include 'includes/tax_modal.php'; ?>
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
    url: 'tax_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.id').val(response.id);
      $('#edit_annual_income_from').val(response.annual_income_from);
      $('#edit_annual_income_to').val(response.annual_income_to);
      $('#edit_monthly_income_from').val(response.monthly_income_from);
      $('#edit_monthly_income_to').val(response.monthly_income_to);
      $('#edit_base_tax').val(response.base_tax);
      $('#edit_excess_percentage').val(response.excess_percentage);
      $('#edit_excess_income').val(response.excess_income);
    }
  });
}
</script>
</body>
</html>
