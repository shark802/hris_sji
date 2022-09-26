<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
     
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">HOME</li>
        <li class=""><a href="home.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        
        
        <li class="header">MANAGE PROFILE</li>
        <li><a href="employee.php"><i class="fa fa-users"></i> <span>Personal Profile</span></a></li>
       
          <li class="header">MANAGE DTR</li>
            <li class="treeview">
          <a href="#">
            <i class="fa fa-calendar"></i>
            <span>Employee DTR</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="attendance.php"><i class="fa fa-clock-o"></i> Attendance</a></li>
            <li><a href="hschedule.php"><i class="fa fa-calendar"></i>Holiday Schedules</a></li>
          </ul>
        </li>
          <li class="treeview">
          <a href="#">
            <i class="fa fa-cubes"></i>
            <span>Loans</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
              <?php
                $sql = "SELECT * FROM loan_type ORDER BY loan_type";
                $query = $conn->query($sql);
                $count = $query->num_rows;
                //echo '<script>alert('.$count.')</script>';
                while($row = $query->fetch_assoc()){
                  echo '    
                      <li><a href="loans.php?id='.$row['id'].'"><i class="fa fa-calendar-minus-o"></i>'.$row['loan_type'].'</a></li>
                  ';
                }
              ?>
              </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-coffee"></i>
            <span>Leave & OT Application</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="leave.php"><i class="fa fa-trello"></i> Leave Application</a></li>
            <li><a href="overtime.php"><i class="fa fa-black-tie"></i> Overtime Application</a></li>
          </ul>
        </li>
        
        <?php 
          if($user['supervisory_level'] == 2 || $user['supervisory_level'] == 1){
              echo '
                <li class="header">MANAGE LEAVE REQUEST</li>
                <li><a href="leave_request.php"><i class="fa fa-comments-o"></i> <span>Leave Requests</span></a></li>
                <li><a href="ot_request.php"><i class="fa fa-street-view"></i> <span>OT Requests</span></a></li>
              ';
          }
        ?>
       
        
        <li class="header">PAYSLIP</li>
        <li><a href="payroll.php"><i class="fa fa-files-o"></i> <span>Payslip</span></a></li>
        
        <li class="header">MANAGEMENTS</li>
        <li><a href="management.php"><i class="fa fa-institution"></i> <span>Managements</span></a></li>
         <!-- 
        <li class="header">ABOUT US</li>
        <li><a href="aboutus.php"><i class="fa fa-info-circle"></i> <span>Developers</span></a></li>
      </ul> -->
    </section>
    <!-- /.sidebar -->
  </aside>