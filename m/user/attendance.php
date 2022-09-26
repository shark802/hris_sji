<?php include_once 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>
  <?php $employee_id = $user['employee_id']; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Attendance 
      </h1>
      
     
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Records</li>
        <li class="active">Attendance</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body" style="overflow-x:auto;">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <th class="hidden"></th>
                  <th>Date</th>
                  <th></th>
                  <th>Time In (AM)</th>
                  <th>Time Out (AM)</th>
                  <th>Time In (PM)</th>
                  <th>Time Out (PM)</th>
                  <th>Total Time (Hrs)</th>
                </thead>
                <tbody>
                  <?php
                    $employee_id = $user['employee_id'];
                    $sql = "SELECT COUNT(*) AS count_row, employee_id, date, GROUP_CONCAT(clocked, '-', status, '-', shift ORDER BY clocked) AS clocked,
                            SUM(num_hr) AS totalNum_hrs, remarks
                            FROM attendance WHERE employee_id = '$employee_id'
                            GROUP BY date ORDER BY date DESC;";
                    $query = $conn->query($sql);

                    while($row = $query->fetch_assoc()){
                      $date = $row['date'];
                      $rdate = ($date) ? date('M d, Y', strtotime($date)) : '-';
                      $arr_clocked = $row['clocked'];
                      $clockin_am = '-';
                      $clockout_am = '-';
                      $clockin_pm = '-';
                      $clockout_pm = '-';
                      $totalNum_hrs = ($row['totalNum_hrs']) ? $row['totalNum_hrs'] : '-';
                      //$status = ($row['remarks'] == 1)?'<span class="label label-success pull-left">ontime</span> &nbsp;':'<span class="label label-warning pull-left">late</span>';

                      $sqlStat = "SELECT 
                                  (SELECT remarks FROM attendance WHERE employee_id = '$employee_id' AND date = '$date' AND shift = 1 AND status = 'in') AS remarks,
                                  (SELECT undertime FROM attendance WHERE employee_id = '$employee_id' AND date = '$date' AND shift = 2 AND status = 'out') AS undertime,
                                  (SELECT absent FROM attendance WHERE employee_id = '$employee_id' AND date = '$date' GROUP BY date) AS absence 
                                  FROM attendance WHERE employee_id = '$employee_id' AND date = '$date' GROUP BY date;";
                      $queryStat = $conn->query($sqlStat);
                      $rowStat = $queryStat->fetch_assoc();

                      $remarks = $rowStat['remarks'];
                      $ut = $rowStat['undertime'];
                      $absent = $rowStat['absence'];

                      //$status1 = $remarks;
                      //$status2 = $ut;
                      if($absent == 1){
                        $status1 = '<span class="label label-danger pull-left">absent</span> &nbsp;';
                        $status2 = '';
                      }
                      if($absent == 2){
                        $status1 = '<span class="label label-primary pull-left">on leave</span> &nbsp;';
                        $status2 = '';
                      } else {
                        $status1 = ($remarks == 1)?'<span class="label label-success pull-left">ontime</span> &nbsp;':'<span class="label label-warning pull-left">late</span>';
                        $status2 = ($ut == 0)?'':'<span class="label label-warning pull-left">undertime</span>';
                      }
                      

                      // explode row time 
                      $time_arr = explode (",", $arr_clocked); 
            
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
                      echo "
                        <tr>
                          <td class='hidden'></td>
                          <td>".$rdate."</td>         
                          <td>".$status1.$status2."</td> 
                          <td>".$clockin_am."</td>
                          <td>".$clockout_am."</td>
                          <td>".$clockin_pm."</td>
                          <td>".$clockout_pm."</td>
                          <td style='text-align: center;'>".$totalNum_hrs."</td>
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

</body>
</html>
