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
        $sql = "SELECT * FROM additional_fee WHERE id = '$id'";
        $query = $conn->query($sql);
        $row = $query->fetch_assoc();
        echo "<h1>".$row['fee']."</h1>";
     
   
        echo '
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Manage Salary Component</li>
            <li class="active">'.$row['fee'].'</li>
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
              <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a>
                
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <th class="hidden"></th>
                  <th>Employee Name</th>
                  <th>Amount</th>
                  <th>Status</th> 
                  <th>Tools</th>
                </thead>
                <tbody>
                  <?php
                    $sql = "SELECT e.firstname, e.lastname, afd.id, afd.employee_id, afd.additional_fee_id,
                                    afd.amount, afd.amount, afd.status FROM additional_fee_details AS afd 
                                    LEFT JOIN employees AS e ON afd.employee_id = e.id
                                    WHERE afd.additional_fee_id = '$id'
                                    ORDER BY lastname";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      echo "
                        <tr>
                          <td class='hidden'></td>
                          <td>".$row['lastname'].', '.$row['firstname']."</td>
                          <td>".$row['amount']."</td>
                          <td>".$row['status']."</td>
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
  <?php include 'includes/additional_fee_modal.php'; ?>
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
    url: 'additional_fee_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.id').val(response.id);
      $('.additional_fee').val(response.additional_fee_id);
      $('#edit_employee_id').val(response.employee_id);
      $('#edit_additional_fee').val(response.additional_fee_id);
      $('#edit_amount').val(response.amount);
      $('#edit_status').val(response.status);
    }
  });
}

$('#status').change(function(){
    var status_val = $(this).val();
    if(status_val == 'Fixed'){
      $('#amount').attr("disabled", false); 
      $('#amount').attr("required", true);
    } else {
      $('#amount').attr("disabled", true); 
      $('#amount').attr("required", false);
    }
})
</script>
</body>
</html>
