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
       Overtime Application
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Leave & OT Application</li>
          <li class="active">Overtime Application</li>
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
              <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i><b> Apply Overtime</b></a>
                
            </div>
            <div class="box-body" style="overflow-x:auto;">
           
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <th class="hidden"></th>
                  <th>Date Application</th>
                  <th>Number of Hours</th>
                  <th>Rate per Hrs.</th>
                  <th>Total</th> 
                  <th>Status</th>  
                  <th></th>  
                </thead>
                <tbody>
                  <?php
                    $employee_id = $user['employee_id'];
                    $sql = "SELECT *, rate*hours AS totalWorkHrs FROM overtime WHERE employee_id = '$employee_id' ORDER BY date_overtime DESC";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){

                      echo "
                        <tr>
                          <td class='hidden'></td>
                          <td><b>".$row['date_overtime']."</b></td>
                          <td>".$row['hours']."</td>
                          <td>".number_format($row['rate'], 2)."</td>
                          <td>".number_format($row['totalWorkHrs'], 2)."</td>";
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
  <?php include 'includes/overtime_modal.php'; ?>
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
    url: 'overtime_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.id').val(response.id);
      $('#edit_employee_id').val(response.employee_id);
      $('#edit_date_overtime').val(response.date_overtime);
      $('#edit_hours').val(response.hours);
      $('#edit_status').val(response.status);
    }
  });
}
</script>
</body>
</html>
