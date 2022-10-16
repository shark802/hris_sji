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
        <li class="active">Manage DTR</li>
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
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <th class="hidden"></th>
                  <th>Employee Name</th>
                  <th>Date Applied</th>
                  <th>Leave Type</th> 
                  <th>No. of Days</th> 
                  <th>Reason</th> 
                  <th>Available</th>
                  <th colspan="3" style="text-align: center;">Approval</th> 
                  <th>Status</th>
                  <th>Tools</th>
                  <th></th>
                </thead>
                <thead>
                  <th class="hidden"></th>
                  <th></th>
                  <th></th>
                  <th></th> 
                  <th></th> 
                  <th></th> 
                  <th></th> 
             
                  <th>Supervisor</th> 
                  <th>HR</th> 
                  <th>Principal</th>
                  <th></th> 
                  <th></th> 
                     
                </thead>
                <tbody>
                  <?php
                    $description = $user['description'];
                    if($description == 'Principal' || $description == 'HR Manager'){
                        $sql = "SELECT al.id, al.date_from, al.date_to, al.leave_type, al.num_leave, al.reason,
                                al.hr_approval, al.supervisor_approval, al.principal_approval, al.status, e.firstname, e.lastname, lc.unused_leave 
                                FROM applied_leave AS al 
                                LEFT JOIN employees AS e ON e.id = al.employee_id
                                LEFT JOIN leave_credit AS lc ON e.id = lc.employee_id AND al.leave_type = lc.leave_type
                                ORDER BY status DESC";
                    } else if($description == 'Vice Principal'){
                        $sql = "SELECT al.id, al.date_from, al.date_to, al.leave_type, al.num_leave, al.reason,
                                al.hr_approval, al.supervisor_approval, al.principal_approval, al.status, e.firstname, e.lastname, lc.unused_leave 
                                FROM applied_leave AS al 
                                LEFT JOIN employees AS e ON e.id = al.employee_id
                                LEFT JOIN leave_credit AS lc ON e.id = lc.employee_id AND al.leave_type = lc.leave_type
                                LEFT JOIN employment_records AS er ON er.employee_id = e.id
                                LEFT JOIN departments AS d ON er.department_id = d.id
                                LEFT JOIN position AS p ON er.position_id = p.id
                                WHERE d.departments = 'Student Services' OR p.description = 'Department Head'
                                ORDER BY status DESC";
                    } else if($description == 'Department Head'){
                      echo $department = $user['abbreviation'];
                      echo $level = $user['acadLevel'];
                      $sql = "SELECT al.id, al.date_from, al.date_to, al.leave_type, al.num_leave, al.reason,
                              al.hr_approval, al.supervisor_approval, al.principal_approval, al.status, e.firstname, e.lastname, lc.unused_leave 
                              FROM applied_leave AS al 
                              LEFT JOIN employees AS e ON e.id = al.employee_id
                              LEFT JOIN leave_credit AS lc ON e.id = lc.employee_id AND al.leave_type = lc.leave_type
                              LEFT JOIN employment_records AS er ON er.employee_id = e.id
                              LEFT JOIN departments AS d ON er.department_id = d.id
                              WHERE d.abbreviation = '$department' AND d.level = '$level'
                              ORDER BY status DESC";
                    } else {
                              $department = $user['abbreviation'];
                              $sql = "SELECT al.id, al.date_from, al.date_to, al.leave_type, al.num_leave, al.reason,
                                      al.hr_approval, al.supervisor_approval, al.principal_approval, al.status, e.firstname, e.lastname, lc.unused_leave 
                                      FROM applied_leave AS al 
                                      LEFT JOIN employees AS e ON e.id = al.employee_id
                                      LEFT JOIN leave_credit AS lc ON e.id = lc.employee_id AND al.leave_type = lc.leave_type
                                      LEFT JOIN employment_records AS er ON er.employee_id = e.id
                                      LEFT JOIN departments AS d ON er.department_id = d.id
                                      WHERE d.abbreviation = '$department'
                                      ORDER BY status DESC";
                          }
                    


                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      $id = $row['id'];
                      $s_bool = "-";
                      $h_bool = "-";
                      $p_bool = "-";
                      $date_from = date('M j Y', strtotime($row['date_from']));
                      $date_to = date('M j Y', strtotime($row['date_to']));

                      if($row['supervisor_approval'] == 0){
                        $s_bool = "No";
                      } else if($row['supervisor_approval'] == 1){
                        $s_bool = "Yes";
                      }
                      if($row['hr_approval'] == 0){
                        $h_bool = "No";
                      } else if($row['hr_approval'] == 1){
                        $h_bool = "Yes";
                      }
                      if($row['principal_approval'] == 0){
                        $p_bool = "No";
                      } else  if($row['principal_approval'] == 1) {
                        $p_bool = "Yes";
                      }
                      echo "
                        <tr>
                          <td class='hidden'></td>
                          <td>".$row['lastname'].', '.$row['firstname']."</td>
                          <td><b>".$date_from.'</b> to <b>'.$date_to."</b></td>
                          <td>".$row['leave_type']."</td>
                          <td>".$row['num_leave']."</td>
                          <td>".$row['reason']."</td>
                          <td>".$row['unused_leave']."</td>
                          <td>".$s_bool."</td>
                          <td>".$h_bool."</td>
                          <td>".$p_bool."</td>";
                          if($row['status'] == 'Approved'){
                            echo "<td style='color: green; font-weight: bold;'>".$row['status']."</td>";
                          } else if($row['status'] == 'Denied'){
                            echo "<td style='color: red; font-weight: bold;'>".$row['status']."</td>";
                          } else {
                            echo "<td style='color: orange; font-weight: bold;'>".$row['status']."</td>";
                          }
                         
                          if($row['status'] != 'Approved'){
                          echo "<td>
                            <button class='btn btn-success btn-sm edit btn-flat' data-id='".$id."'><i class='fa fa-check'></i> Approve</button>
                           
                          </td>
                          <td> <button class='btn btn-danger btn-sm delete btn-flat' data-id='".$id."'><i class='fa fa-times'></i> Reject</button></td>";
                          }
                       echo " </tr>
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
  <?php include 'includes/application_leave_modal.php'; ?>
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
    url: 'application_leave_row.php',
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
