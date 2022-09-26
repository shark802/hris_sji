<?php
  session_start();
  if(isset($_SESSION['employee'])){
    header('location:home.php');
  }
?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition login-page">
<div class="login-box">
	<div class="login-logo">
	  	<img src="images/sji.png" style="width: 25%;">
        <h2><b>HRIS System <br> Password Reset</b></h2>
  	</div>
  
  	<div class="login-box-body">
    	<p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>

    	<form action="reset.php" method="POST">
      		<div class="form-group has-feedback">
        		<input type="text" class="form-control" name="email_address" placeholder="Email" required autofocus>
        		<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      		</div>
      		<div class="row">
    			<div class="col-xs-12">
				<button type="submit" class="btn btn-primary btn-block btn-flat" name="password_reset"><i class="fa fa-lock"></i> Request New Password</button>
        		</div>
      		</div>
    	</form>
  	</div>
  	<?php
  		if(isset($_SESSION['error'])){
  			echo "
  				<div class='callout callout-danger text-center mt20'>
			  		<p>".$_SESSION['error']."</p> 
			  	</div>
  			";
  			unset($_SESSION['error']);
  		} 

		  if(isset($_SESSION['success'])){
			echo "
				<div class='callout callout-success text-center mt20'>
					<p>".$_SESSION['success']."</p> 
				</div>
			";
			unset($_SESSION['success']);
		} 
  	?>
</div>
	
<?php include 'includes/scripts.php' ?>
</body>
</html>