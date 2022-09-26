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
        Payroll
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Manage Payroll</li>
          <li class="active">Payroll</li>
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
              <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> Generate Payroll</a>
                
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <th class="hidden"></th>
                  <th>Month</th>
                  <th>Date Covered</th>
                  <th>Period</th> 
                  <th>Status</th> 
                  <th>Tools</th> 
                </thead>
                <tbody>
                  <?php
                    $sql = "SELECT * FROM payroll";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      $monthNum  = $row['month'];
                      $dateObj   = DateTime::createFromFormat('!m', $monthNum);
                      $monthName = $dateObj->format('F'); 

                      echo "
                        <tr>
                          <td class='hidden'></td>
                          <td>".$monthName."</td>
                          <td><b>".$row['date_from'].'</b> - <b>'.$row['date_to']."</b></td>
                          <td>".$row['payroll_period']."</td>";
                          if($row['status'] == 'Approved'){
                            echo "<td style='color: green; font-weight: bold;'>".$row['status']."</td>";
                          } else {
                            echo "<td style='color: red; font-weight: bold;'>".$row['status']."</td>";
                          } 
                          if($row['status'] == 'Approved'){
                            echo "<td>
                            <button class='btn btn-primary btn-sm edit btn-flat' data-id='".$row['id']."'><i class='fa fa-eye'></i> View</button>
                            </td>";
                          } else {
                            echo "<td>
                            <button class='btn btn-primary btn-sm view btn-flat' data-id='".$row['id']."'><i class='fa fa-eye'></i> View</button>
                            <button class='btn btn-danger btn-sm delete btn-flat' data-id='".$row['id']."'><i class='fa fa-trash'></i> Delete</button>
                            <button class='btn btn-success btn-sm approve btn-flat' data-id='".$row['id']."'><i class='fa fa-check'></i> Approve</button>
                          </td>";
                          } 
                        "</tr>
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
  <?php include 'includes/payroll_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
  $(document).on('click', '.view', function(e){
    e.preventDefault();
    var id = $(this).data('id');
    window.location.href = "http://localhost/payroll/web/admin/payroll.php?id=" + id;
  });

  $(document).on('click', '.edit', function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.approve', function(e){
    e.preventDefault();
    $('#approve').modal('show');
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
    url: 'payroll_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.id').val(response.id);
    }
  });
}

</script>
</body>
</html>
