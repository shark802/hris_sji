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
        <b>Developers</b>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>About Us</li>
        <li class="active">Developers</li>
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
          
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                   <thead>
            <th colspan="4"><center><h4><strong>Prism Import Export Inc. E- Payroll System with Mobile Application <br><br> <i>SYSTEM DEVELOPERS</i></strong></h4></center></th>   
           </thead>
              <tbody>
                <tr>
                  <th width='20%'>Jason Delos Reyes<br>Programmer/Leader<br>
                    Zone V, Pulupandan<br>
                jasondelosreyes114@gmail.com</th>
                   <th width='20%'>Janrenzo Pacia<br>
                      Programmer<br>
                    Brgy. Baga-as, Hinigaran<br>
                janrenzo.pacia@gmail.com<br>
               </th>
                     <th width='20%'>Jerico Cordova<br>
                      Programmer<br>
                    Brgy. Sampinit, Bago City <br>
                jericocordova@gmail.com<br>
                </th>
                     <th width='20%'>Jay Bryan Hilardino<br>
                      Programmer<br>
                    Brgy. Sum-ag, Bacolod City<br>
                jaybryanhilardino@gmail.com</th>
                </tr>
                <tr>
                  
                  <td><strong><img src="../images/jd.jpg" width="200px" height="300px"></strong></td>
                    
                    <td><strong><img src="../images/jp.jpg" width="200px" height="300px"></strong></td>
                    
                    <td><strong><img src="../images/jc.jpg" width="200px" height="300px"></strong></td>
                    
                    <td><strong><img src="../images/jh.jpg" width="200px" height="300px"></strong></td>
                  </tr>
             
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>   
  </div>
    
  <?php include 'includes/footer.php'; ?>
  
</div>
<?php include 'includes/scripts.php'; ?>
</body>
</html>
