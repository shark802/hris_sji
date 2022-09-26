<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Add Additional Fee</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="additional_fee_add.php">
          		  <div class="form-group">
                    <label for="employee_id" class="col-sm-4 control-label">Employee Name</label>

                    <div class="col-sm-7">
                      <select class="form-control" id="employee_id" name="employee_id" required>
                        <option value="" selected>- Select -</option>
                        <?php
                          $sql = "SELECT * FROM employees WHERE account_info = 'Active'";
                          $query = $conn->query($sql);
                          while($erow = $query->fetch_assoc()){
                            echo "
                              <option value='".$erow['id']."'>".$erow['lastname'].' - '.$erow['firstname']."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="additional_fee" class="col-sm-4 control-label">Additional Fee</label>
                    <?php 
                      $fee_id = $_GET['id'];
                      $sql = "SELECT * FROM additional_fee WHERE id = '$fee_id'";
                      $query = $conn->query($sql);
                      $row = $query->fetch_assoc();
                      $fee = $row['fee'];
                      $status = $row['status'];
                      $amount = 0;

                      if($status == 'Fixed'){
                        $amount = $row['amount'];
                      }
                      echo '
                        <div class="col-sm-7">
                          <input type="text" class="form-control" value="'.$fee.'" readonly>
                          <input type="hidden" class="form-control" id="additional_fee" name="additional_fee" value="'.$fee_id.'" readonly>
                        </div>
                      ';
                    ?>       
                   
                </div>
 
                <div class="form-group">
                    <label for="amount_fee" class="col-sm-4 control-label">Amount</label>

                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="amount_fee" name="amount_fee" value="<?php echo $amount; ?>" required>
                    </div>
                </div>
              
                <div class="form-group">
                    <label for="status" class="col-sm-4 control-label">Status</label>

                    <div class="col-sm-7"> 
                      <select class="form-control" name="status" id="status" required>
                        <option value="" selected>- Select -</option>
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                      </select>
                    </div>
                </div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i> Save</button>
            	</form>
          	</div>
        </div>
    </div>
</div>

<!-- Edit -->
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b><span class="date"></span> Edit Additional Fee Details <span class="employee_name"></span></b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="additional_fee_edit.php">
            		<input type="hidden" class="id" name="id">
                <div class="form-group">
                    <label for="edit_employee_id" class="col-sm-4 control-label">Employee Name</label>

                    <div class="col-sm-7">
                      <select class="form-control" id="edit_employee_id" name="employee_id" disabled>
                        <option value="" selected>- Select -</option>
                        <?php
                          $sql = "SELECT * FROM employees";
                          $query = $conn->query($sql);
                          while($erow = $query->fetch_assoc()){
                            echo "
                              <option value='".$erow['id']."'>".$erow['lastname'].' - '.$erow['firstname']."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_additional_fee" class="col-sm-4 control-label">Additional Fee</label>
                    <?php 
                      $fee_id = $_GET['id'];
                      $sql = "SELECT * FROM additional_fee WHERE id = '$fee_id'";
                      $query = $conn->query($sql);
                      $row = $query->fetch_assoc();
                      $fee = $row['fee'];
                      echo '
                        <div class="col-sm-7">
                          <input type="text" class="form-control" value="'.$fee.'" readonly>
                          <input type="hidden" class="form-control" id="edit_additional_fee" name="additional_fee" value="'.$fee_id.'" readonly>
                        </div>
                      ';
                    ?>       
                   
                </div>
   
                <div class="form-group">
                    <label for="edit_amount" class="col-sm-4 control-label">Amount</label>

                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="edit_amount" name="amount_fee" required>
                    </div>
                </div>
              
                <div class="form-group">
                    <label for="edit_status" class="col-sm-4 control-label">Status</label>

                    <div class="col-sm-7"> 
                      <select class="form-control" name="status" id="edit_status" required>
                        <option value="" selected>- Select -</option>
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                      </select>
                    </div>
                </div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-success btn-flat" name="edit"><i class="fa fa-check-square-o"></i> Update</button>
            	</form>
          	</div>
        </div>
    </div>
</div>

<!-- Delete -->
<div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b><span class="date"></span></b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="additional_fee_delete.php">
            		<input type="hidden" class="id" name="id">
                <input type="hidden" class="additional_fee" name="additional_fee">

            		<div class="text-center">
	                	
	                	<h3><p>Delete this addional fee record?</p></h3>
	            	</div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-danger btn-flat" name="delete"><i class="fa fa-trash"></i> Delete</button>
            	</form>
          	</div>
        </div>
    </div>
</div>


     