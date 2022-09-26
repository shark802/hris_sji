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
        Attendance
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Record</li>
        <li class="active">Attendance</li>
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
                 <a href="#" onclick="window.print()" class="btn btn-success btn-sm btn-flat"><i class="fa fa-print"></i> Print List</a> 
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                <th class="hidden"></th>
                  <th>Date</th>
                  <th>Employee Name</th>
                  <th>Status</th>
                  <th>Time In (AM)</th>
                  <th>Time Out (AM)</th>
                  <th>Time In (PM)</th>
                  <th>Time Out (PM)</th>
                  <th>Total Time (Hrs)</th>
                </thead>
                <tbody>
                  <?php
                    $sql = "SELECT date, attendance.employee_id as eid, CONCAT(lastname, ',', firstname) AS employee_name, 
                            GROUP_CONCAT(clocked, '-', status, '-', shift ORDER BY clocked) AS clocked,
                            GROUP_CONCAT(num_hr) AS totalNumHrs 
                            FROM attendance 
                            LEFT JOIN employees ON employees.id = attendance.employee_id
                            GROUP BY date, eid
                            ORDER BY date DESC;";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      $arr_clocked = $row['clocked'];
                      $arr_numHrs = $row['totalNumHrs'];
		                  $time_arr = explode (",", $arr_clocked); 
                      $xplode_numhrs = explode (",", $arr_numHrs); 
                      $clockin_am = '-';
                      $clockout_am = '-';
                      $clockin_pm = '-';
                      $clockout_pm = '-';
                      $total_numHr = 0;

                      for ($i = 0; $i < count($time_arr); $i++) {
                        if(str_contains($time_arr[$i], '-in') && str_contains($time_arr[$i], '-1')){
                          $temp = $time_arr[$i];
                          $temp_explode = explode ("-", $temp);
                          $clockin_am = date('h:i A', strtotime($temp_explode[0]));
                        } 
                        if(str_contains($time_arr[$i], '-out') && str_contains($time_arr[$i], '-1')){
                          $temp = $time_arr[$i];
                          $temp_explode = explode ("-", $temp);
                          $clockout_am = date('h:i A', strtotime($temp_explode[0]));
                        }
                        if(str_contains($time_arr[$i], '-in') && str_contains($time_arr[$i], '-2')){
                          $temp = $time_arr[$i];
                          $temp_explode = explode ("-", $temp);
                          $clockin_pm = date('h:i A', strtotime($temp_explode[0]));
                        }
                        if(str_contains($time_arr[$i], '-out') && str_contains($time_arr[$i], '-2')){
                          $temp = $time_arr[$i];
                          $temp_explode = explode ("-", $temp);
                          $clockout_pm = date('h:i A', strtotime($temp_explode[0]));
                        }
                      }

                      for ($i = 0; $i < count($xplode_numhrs); $i++) {
                        $total_numHr += $xplode_numhrs[$i];
                      }
                     
                      echo "
                        <tr>
                          <td class='hidden'></td>
                          <td>".date('M d, Y', strtotime($row['date']))."</td>
                          <td>".$row['employee_name']."</td>
                          <td></td>
                          <td>".$clockin_am."</td>
                          <td>".$clockout_am."</td>
                          <td>".$clockin_pm."</td>
                          <td>".$clockout_pm."</td>
                          <td>".$total_numHr."</td>
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
  <?php include 'includes/attendance_modal.php'; ?>
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
});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'attendance_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('#datepicker_edit').val(response.date);
      $('#attendance_date').html(response.date);
      $('#edit_time_in').val(response.time_in);
      $('#edit_time_out').val(response.time_out);
      $('#attid').val(response.attid);
      $('#employee_name').html(response.firstname+' '+response.lastname);
      $('#del_attid').val(response.attid);
      $('#del_employee_name').html(response.firstname+' '+response.lastname);
    }
  });
}
</script>
</body>
</html>
