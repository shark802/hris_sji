<?php include('header.php'); ?>
<?php include('session.php'); ?>
<?php $get_id = $_GET['id']; ?>
    <body>
		<?php include('navbar.php'); ?>
		 
        <div class="container-fluid">
            <div class="row-fluid">
				<?php include('sidebar.php'); ?>
                <div class="span9" id="">
                     <div class="row-fluid">
                        <!-- block -->
                        <div  id="block_bg" class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left"><i class="icon-pencil icon-large"></i> Account Information</div>
                                <div class="muted pull-right"><a href="employee.php"><i class="icon-arrow-left icon-large"></i> Back</a></div>
                            </div>
                            <div class="block-content collapse in">
						<?php
						$query = mysqli_query($connection,"select * from employee where employee_id = '$get_id'")or die(mysql_error());
						$row = mysqli_fetch_array($query);
						?>
						<form id="grosspay_update" class="form-signin" method="post">
						<!-- span 4 -->
										<div class="span4">
										<input type="hidden" value="<?php echo $row['employee_id']; ?>" class="input-block-level"  name="employee_id" required>
										  
                                            	
									<label><strong>Account:</strong></label>
								<select name="account_info" class="span5" required>
								    <option><?php echo $row['account_info']; ?></option>
								    <option>Active</option>
								    <option>Unactive</option>
								</select>
										
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<button class="btn btn-success" name="update"><i class="icon-share icon-large"></i> &nbsp; &nbsp; Modify</button>
						</div>
						<!--end span 4 -->	
						<!-- span 4 -->	
						
						<!--end span 4 -->
						<div class="span12"><hr></div>		
							</form>			
								<script>
									jQuery(document).ready(function($){
										$("#grosspay_update").submit(function(e){
											e.preventDefault();
											var _this = $(e.target);
											var formData = $(this).serialize();
											$.ajax({
												type: "POST",
												url: "account_update.php",
												data: formData,
												success: function(html){
													$.jGrowl("Successfully  Updated", { header: 'Gross Pay Updated' });
													window.location = 'employee.php';
												}
											});
										});
									});
								</script>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
                </div>
            </div>
		<?php include('footer.php'); ?>
        </div>
		<?php include('script.php'); ?>
    </body>	
</html>