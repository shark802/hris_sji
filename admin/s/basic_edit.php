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
                                <div class="muted pull-left"><i class="icon-pencil icon-large"></i> Edit </div>
                                <div class="muted pull-right"><a href="basic.php"><i class="icon-arrow-left icon-large"></i> Back</a></div>
                            </div>
                            <div class="block-content collapse in">
						<?php
						$query = mysqli_query($connection,"select * from com_position where position_id = '$get_id'")or die(mysql_error());
						$row = mysqli_fetch_array($query);
						?>
						<form id="basic_update" class="form-signin" method="post">
						<!-- span 4 -->
										<div class="span4">
										<input type="hidden" value="<?php echo $row['position_id']; ?>" class="input-block-level"  name="position_id" required>
                               
                                            
										 <label><strong>Position:</strong></label>
											<input type="text" class="input-block-level"  name="com_position" value="<?php echo $row['com_position']; ?>" required>
                                       
                                        <label><strong>Basic Pay:</strong></label>
											<input type="text" class="input-block-level"  name="basic_pay" value="<?php echo $row['basic_pay']; ?>" required>
                                            
                                             <center>
                        <button class="btn btn-success" name="update"><i class="icon-save icon-large"></i> Update</button></center>
                                       
										</div>		
						
						<!--end span 4 -->	
						<!-- span 4 -->	
						
                        
						<!--end span 4 -->
						<div class="span12"><hr></div>		
							</form>			
								<script>
									jQuery(document).ready(function($){
										$("#basic_update").submit(function(e){
											e.preventDefault();
											var _this = $(e.target);
											var formData = $(this).serialize();
											$.ajax({
												type: "POST",
												url: "basic_update.php",
												data: formData,
												success: function(html){
													$.jGrowl("Successfully  Updated", { header: 'Basic Info Updated' });
													window.location = 'basic.php';
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