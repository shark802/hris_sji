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
        Database
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Back-up</li>
        <li class="active">Database</li>
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
           <center><h2 class="page-header"><strong><font face="Lucida Calligraphy">BACKUP DATABASE</font></strong></h2></center>	
              
    <?php
    require_once('backup_restore_class.php'); 

    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db = 'apsystem';

    $newImport = new backup_restore($host,$db,$user,$pass);

    if(isset($_GET['process'])){
        $process = $_GET['process'];
        if($process == 'backup'){
            $message = $newImport -> backup ();   
        }else if($process == 'restore'){
            $message = $newImport -> restore (); 
            @unlink('backup_db/database_'.$db.'.sql');
            
        }
    }
    if(isset($_POST['submit'])){        
        $db = 'database_'.$db.'.sql';
        $target_path = 'backup_db';
        move_uploaded_file($_FILES["file"]["tmp_name"], $db);    
        $message = 'Successfully uploaded. You can now <a href=backup.php?process=restore>restore</a> the database!';
    }
?>
    <?php if(isset($_GET['process'])): ?>
            <?php 
                $msg = $_GET['process'];   
                $class = 'text-center';
                switch($msg){
                    case 'backup':
                        $msg = 'Backup successful!<br />Download THE <a href="'.$message.'" target=_blank >SQL FILE </a> OR RESTORE IT ANY TIME'; 
                        break;
                    case 'restore':
                        $msg = $message; 
                        break;
                    case 'upload':
                        $msg = $message; 
                        break;
                    default:
                        $class = 'hide';
                            }                                
                ?>
        <div class="alert alert-info <?php echo $class;?>">
        <strong><?php echo $msg; ?></strong>
        </div>
            <?php endif; ?>
              
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-offset-1 col-md-6">
                <a href="backup.php?process=backup">
                    <button type="button" class="btn btn-success btn-lg span7"><i class="fa fa-database"></i> BACKUP DATABASE</button>
                </a>
                </div>
            
                <div class="col-md-5">
                    <a href="backup.php?process=restore">
                    <button type="button" class="btn btn-info btn-lg span7"><i class="fa fa-database"></i> RESTORE DATABASE</button>
                    </a>
                </div>                        
            </div>
        </div>
                
        <div class="upload alert alert-warning">
            <hr/>
            <form method="POST" enctype="multipart/form-data">
                <label>Upload SQL File:</label>
                <input type="file" name="file" class="form-control"><br>
                <input type="submit" name="submit" class="btn btn-success" value="Upload Database" />
            </form>
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
