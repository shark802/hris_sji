<?php include('header.php'); ?>
<?php include('session.php'); ?>
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
                                <div class="muted pull-left"><i class="icon-plus-sign icon-large"></i> Add Position</div>
                                <div class="muted pull-right"><a id="return" data-placement="left" title="Click to Return" href="basic.php"><i class="icon-arrow-left icon-large"></i> Back</a></div>
																<script type="text/javascript">
																$(document).ready(function(){
																	$('#return').tooltip('show');
																	$('#return').tooltip('hide');
																});
																</script>                          
						    </div>
                            <div class="block-content collapse in">						
						<form id="add_basic" class="form-signin" method="post">
						<!-- span 4 -->
										<div class="span4">
										  
                                            <label><strong>Position:</strong></label>
											<input type="text" class="input-block-level"  name="com_position" placeholder="Position" required>
                                            
                                            <label><strong>Basic Pay:</strong></label>
											<input type="text" class="input-block-level"  name="basic_pay" placeholder="Basic Pay" required>
                                            
                                            <center><button class="btn btn-success" name="save"><i class="icon-save icon-large"></i> Save </button></center>
                                            						
                            </div>
                                
                            
						
						<!-- span 4 -->				
						<!-- span 4 -->				
    	
						
						</form>						
			<script>
			jQuery(document).ready(function($){
				$("#add_basic").submit(function(e){
					e.preventDefault();
					var _this = $(e.target);
					var formData = $(this).serialize();
					$.ajax({
						type: "POST",
						url: "basic_save.php",
						data: formData,
						success: function(html){
							$.jGrowl("Successfully  Added", { header: 'Position Added' });
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