<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
     
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">HOME</li>
        <li class=""><a href="home.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <li class="header">MANAGE EMPLOYEE</li>
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i>
            <span>Employees</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
            
          <ul class="treeview-menu">
            <li><a href="employee.php"><i class="fa fa-address-card-o"></i> Employee List</a></li>
            <li><a href="record.php"><i class="fa fa-folder-open"></i> Employment Record</a></li>
          </ul>
        </li>
          
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
            <li><a href="attendance.php"><i class="fa fa-clock-o"></i> <span>Attendance</span></a></li>
            <li><a href="overtime.php"><i class="fa fa-suitcase"></i> Overtime</a></li>
            <li><a href="application_leave.php"><i class="fa fa-money"></i> Leave Application</a></li>      
          </ul>
        </li>
        
        <li class="header">MANAGE SALARY COMPONENT</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-angle-double-up"></i>
            <span>Additional Fee</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <?php
                $sql = "SELECT * FROM additional_fee ORDER BY fee";
                $query = $conn->query($sql);
                $count = $query->num_rows;
                //echo '<script>alert('.$count.')</script>';
                while($row = $query->fetch_assoc()){
                  echo '    
                      <li><a href="additional_fee.php?id='.$row['id'].'"><i class="fa fa-calendar-plus-o"></i>'.$row['fee'].'</a></li>
                  ';
                }
              ?>
          
                <!-- further checking if Needed
              <li><a href="wholding_tax.php"><i class="fa fa-fax"></i> Withholding Tax</a></li>
               !-->
              </ul>  
            </li>
         
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-minus-square"></i>
            <span>Deduction</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
           <!-- <li><a href="mandatory.php"><i class="fa fa-thumb-tack"></i> Mandatory Contributions</a></li>
            <li><a href="absences_late.php"><i class="fa fa-hourglass-end"></i> Absences / Lates / Undertime</a></li>
              --> 
            <li><a href="dependent_list.php"><i class="fa fa-mortar-board"></i> Employees Dependent</a></li>
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
                <!-- further checking if Needed
              <li><a href="wholding_tax.php"><i class="fa fa-fax"></i> Withholding Tax</a></li>
               !-->
              </ul>  
            </li>
         
        </li>

        
        <li class="header">MANAGE PAYROLL</li>
        <li><a href="payroll_list.php"><i class="fa fa-files-o"></i> <span>Payroll</span></a></li>
        <li><a href="payroll_list.php"><i class="fa fa-file-o"></i> <span>Paylip</span></a></li>
        
        <li class="header">MANAGEMENTS</li>
        <li><a href="management.php"><i class="fa fa-institution"></i> <span>Managements</span></a></li>

        <li class="header">SYSTEM</li>
        <li><a href="user.php"><i class="fa fa-user-circle-o"></i> <span>Manage Users</span></a></li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-cog"></i>
            <span>Setup</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <!--<li><a href="benefits.php"><i class="fa fa-universal-access"></i> Benefits</a></li> -->
            <li class="treeview">
              <a href="#">
                <i class="fa fa-universal-access"></i>
                <span>Benefits</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="sssTable.php"><i class="fa fa-calendar"></i>SSS Table</a></li>
                <li><a href="pagibigTable.php"><i class="fa fa-calendar"></i>Pag-ibig Table</a></li>
                <li><a href="phTable.php"><i class="fa fa-calendar"></i>PhilHealth Table</a></li>
                <li><a href="tax.php"><i class="fa fa-tags"></i> Tax Table</a></li>
                }
              ?>
              </ul>
            </li>
            <li><a href="company.php"><i class="fa fa-building"></i> Company</a></li>
            <li><a href="department.php"><i class="fa fa-columns"></i>Departments</a></li>
            <li><a href="employee_status.php"><i class="fa fa-scribd"></i>Employment Status</a></li>
            <li><a href="fee.php"><i class="fa fa-puzzle-piece"></i> Fee</a></li>
            <li><a href="hschedule.php"><i class="fa fa-calendar"></i>Holiday Schedules</a></li>
            <li><a href="ip_address.php"><i class="fa fa-map-marker"></i>IP Addresses</a></li>
            <li><a href="leave.php"><i class="fa fa-life-saver"></i>Leave Type</a></li>
            <li><a href="loan_type.php"><i class="fa fa-ticket"></i>Loan Type</a></li>
    <!--    <li><a href="setup_payroll.php"><i class="fa fa-cogs"></i>Payroll Setting</a></li> -->
            <li><a href="position.php"><i class="fa fa-id-badge"></i>Positions</a></li>
            <li><a href="schedule.php"><i class="fa fa-clipboard"></i> Schedules</a></li>
            
          </ul>
        </li>
          <!--
         <li class="header">ABOUT US</li>
        <li><a href="aboutus.php"><i class="fa fa-info-circle"></i> <span>Developers</span></a></li>
-->
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>