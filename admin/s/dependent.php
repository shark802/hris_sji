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
        Employees Dependent
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Manage Deduction</li>
          <li class="active">Employees Dependent</li>
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
              <!--
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <th class="hidden"></th>
                  <th>Employees Name</th>
                  <th>No. of Dependent</th>
                  <th>Deduction Amount</th> 
                  <th>Date Deduct</th>
                </thead>
                <tbody>
                  < ?php
                    $sql = "SELECT d.employee_id, d.amount_deduct, d.num_dependent, d.date_deduct, e.firstname, e.lastname 
                            FROM dependent_deduct AS d LEFT JOIN employees AS e ON e.id = d.employee_id";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      echo "
                        <tr>
                          <td class='hidden'></td>
                          <td>".$row['lastname'].', '.$row['fisrtname']."</td>
                          <td>".$row['num_dependent']."</td>
                          <td>".$row['amount_deduct']."</td>
                          <td>".$row['date_deduct']."</td>
                        </tr>
                      ";
                    }
                  ?>
                </tbody>
              </table>
              !-->
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <th class="hidden"></th>
                  <th>Employees Name</th>          
                  <th>Dependent Name</th>
                  <th>Deduction</th> 
                  <th>Status</th>
                  <th>Tools</th>
                </thead>
                <tbody>
                  <?php
                    $sql = "SELECT d.id, d.employee_id, d.dependent_name, d.amount, d.status, e.firstname, e.lastname 
                            FROM dependent AS d LEFT JOIN employees AS e ON e.id = d.employee_id ORDER BY dependent_name";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      echo "
                        <tr>
                          <td class='hidden'></td>
                          <td>".$row['dependent_name']."</td>
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
  <?php include 'includes/dependent_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>

</body>
</html>
